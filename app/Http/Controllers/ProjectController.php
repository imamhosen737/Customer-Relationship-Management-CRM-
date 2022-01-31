<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Tasks;
use App\Models\Milestones;

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
        return view('admin.Projects.show', compact('contacts', 'id'));
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
