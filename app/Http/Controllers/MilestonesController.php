<?php

namespace App\Http\Controllers;

use App\Models\Milestones;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\MilestoneRequest;

class MilestonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Milestones::all();
        return view('admin.milestones.milestones_list', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $project_data = project::get();
        return view('admin.milestones.milestones_create', compact('project_data', 'projectId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MilestoneRequest $request)
    {
       
        try{
            if ($request->visible_to_customer == 'on') {
                        $visible_to_customer = "yes";
                    } else {
                        $visible_to_customer = "no";
                    }
            $data = new Milestones();
            $data->project_id = $request->project_id;
            $data->name = $request->name;
            $data->end_date = $request->end_date;
            $data->description = $request->description;
            $data->visible_to_customer = $visible_to_customer;
            $data->ordering = $request->ordering;
            $data->save();
            return redirect()->route('milestones.milestones_create', $request->project_id);
        }
        catch(\Exception $e){
            return $e->getMessage();
            return redirect()->route('milestones.milestones_create', $request->project_id);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId, $id)
    {

        $Milestones = Milestones::find($id);
        $project_data = Project::get();
        return view('admin.milestones.milestones_edit', compact('Milestones', 'project_data', 'projectId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MilestoneRequest $request, $id)
    {
        try {
            if ($request->visible_to_customer == 'on') {
                $visible_to_customer = "yes";
            } else {
                $visible_to_customer = "no";
            }

            $data = Milestones::find($id);
            $data->project_id = $request->project_id;
            $data->name = $request->name;
            $data->end_date = $request->end_date;
            $data->description = $request->description;
            $data->visible_to_customer = $visible_to_customer;
            $data->ordering = $request->ordering;
            $data->save();
            return redirect()->route('project.milestones', $data->project_id)->with('success', 'Milestone updated successfully');
        } catch (\exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $id)
    {

        try {
            Milestones::destroy($id);
            return redirect()->route('project.milestones', $projectId)->with('danger', 'Milestone deleted Successfully');
        } catch (\exception $e) {
            return $e->getMessage();
        }
    }
}
