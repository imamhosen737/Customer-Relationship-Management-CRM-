<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Tasks;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Milestones;
use App\Models\Timesheets;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Project::get();
        return  view('admin.projects.index', compact('contact'));
    }

    public function create()
    {
        $contact = Customer::get();
        return view('admin.projects.Create', compact('contact'));
    }

    public function tasks($id)
    {
        $projectId = $id;
        $datas = Tasks::where('project_id', $id)->get();
        return view('admin.tasks.index', compact('datas', 'projectId'));
    }
    public function milestones($id)
    {
        $projectId = $id;
        $datas = Milestones::where('project_id', $id)->get();
        return view('admin.milestones.milestones_list', compact('datas', 'projectId'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'discription' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $input = $request->all();
        Project::create($input);
        return redirect('admin/project')->with('success', 'Projects created successfully');
    }


    public function show($id)
    {
        $contacts = Project::find($id);
        $projects = Project::find($id);
        $project = Project::get();
        $project_count = count($project);
        $milestone = Milestones::where('project_id', $id)->get();
        $milestone_count = count($milestone);
        $task = Tasks::where('project_id', $id)->get();
        $task_count = count($task);
        $total_task = Tasks::where('project_id', $id)->sum('duration');
        $proj_task = Tasks::where('project_id', $id)->get();
        $p_t_spend = 0;
        // dd($total_task);
        foreach ($proj_task as $key => $v) {
            $timesheet = Timesheets::where('task_id', $v->id)->get();
            foreach ($timesheet as $t) {
                    $from_time = strtotime($t->start_time);
                    $to_time = strtotime($t->end_time);
                    $a=round(abs($to_time - $from_time) /60,2);
                    $p_t_spend+=$a;
            }
        }

        return view('admin.Projects.show', compact('proj_task','total_task','p_t_spend','contacts', 'id', 'task_count', 'milestone_count', 'project_count', 'projects'));
    }
    public function edit($id)
    {

        $contacts = Project::find($id);
        $custom = Customer::get();
        return view('admin.projects.edit', compact('contacts', 'custom'));
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'discription' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            $project = Project::find($id);
            $input = $request->all();
            $project->update($input);
            // return $project;
            return redirect('admin/project')->with('success', 'projects updated successfully');
        } catch (\exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {
        Project::destroy($id);
        return redirect('admin/project')->with('success', ' projects deleted successfully');
    }
    public function overview()

    {
        $contacts = Project::get();
        return  view('admin.projects.overview', compact('contacts'));

        //
    }
}
