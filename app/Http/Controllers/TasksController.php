<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use App\Models\Project;
use App\Models\Milestones;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;



class TasksController extends Controller
{

    public function index()
    {
        $datas = Tasks::get();
        return view('admin.Tasks.index', compact('datas'));
    }


    public function create($projectId)
    {
        $project_data = project::get();
        $User_data = User::where('role', 'admin')->get();
        $Milestone_data = Milestones::get();
        return view('admin.tasks.create', compact('project_data', 'User_data', 'Milestone_data', 'projectId'));
    }


    public function store(TasksRequest $request)
    {
        if ($request->visible_to_customer == 'on') {
            $visible_to_customer = "yes";
        } else {
            $visible_to_customer = "no";
        }
        try {
            $data = new Tasks();
            $data->project_id = $request->project_id;
            $data->user_id = $request->user_id;
            $data->milestone_id = $request->milestone_id;
            $data->subject = $request->subject;
            $data->duration = $request->duration;
            $data->status = $request->status;
            $data->description = $request->description;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->visible_to_customer = $visible_to_customer;
            $data->priority = $request->priority;
            $data->save();
            return redirect()->route('tasks.create', $request->project_id)->with('success', 'Tasks created successfully');
        } catch (\Exception $e) {
            return $e;
            return redirect()->route('tasks.create', $request->project_id)->with('error', 'Tasks not created successfully');
        }
    }



    public function edit($projectId, $id)
    {
        $tasks = Tasks::find($id);
        $project_data = Project::get();
        $User_data = User::get();
        $Milestone_data = Milestones::get();
        return view('admin.tasks.edit', compact('tasks', 'projectId', 'project_data', 'User_data', 'Milestone_data'));
    }


    public function update(Request $request, $id)
    {

        if ($request->visible_to_customer == 'on') {
            $visible_to_customer = "yes";
        } else {
            $visible_to_customer = "no";
        }
        try {
            $data = Tasks::find($id);
            $data->project_id = $request->project_id;
            $data->user_id = $request->user_id;
            $data->milestone_id = $request->milestone_id;
            $data->subject = $request->subject;
            $data->duration = $request->duration;
            $data->status = $request->status;
            $data->description = $request->description;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->visible_to_customer = $visible_to_customer;
            $data->priority = $request->priority;
            $data->save();
            return redirect()->route('project.tasks',  $data->project_id)->with('success', 'Tasks updated successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($projectId, $id)
    {
        try {
            Tasks::destroy($id);
            return redirect()->route('project.tasks', $projectId)->with('danger', 'Tasks deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
