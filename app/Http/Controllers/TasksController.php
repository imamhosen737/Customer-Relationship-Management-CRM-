<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;



class TasksController extends Controller
{

    public function index()
    {
        $datas = Tasks::all();
        return view('admin.Tasks.index', compact('datas'));
    }

    public function create($projectId)
    {
        $project_data = project::get();
        return view('admin.Tasks.create', compact('project_data', 'projectId'));
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
            $data->subject = $request->subject;
            $data->status = $request->status;
            $data->description = $request->description;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->visible_to_customer = $visible_to_customer;
            $data->priority = $request->priority;
            $data->save();
            return redirect()->route('tasks.create', $request->project_id)->with('success', 'Tasks created successfully');
        } catch (\Exception $e) {
            return redirect()->route('tasks.create', $request->project_id) - with('error', 'tasks not created successfully');
        }
    }



    public function edit($projectId, $id)
    {
        $tasks = Tasks::find($id);
        $project_data = Project::get();
        return view('admin.tasks.edit', compact('tasks', 'project_data', 'projectId'));
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
            $data->subject = $request->subject;
            $data->status = $request->status;
            $data->description = $request->description;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->visible_to_customer = $visible_to_customer;
            $data->priority = $request->priority;
            $data->save();
            return redirect()->route('project.tasks',  $data->project_id)->with('success', 'tasks updated successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($projectId, $id)
    {
        try {
            Tasks::destroy($id);
            return redirect()->route('project.tasks', $projectId)->with('danger', 'tasks deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
