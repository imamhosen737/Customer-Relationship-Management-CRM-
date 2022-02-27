<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\Milestones;
use App\Models\Timesheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $id=4;
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

        return view('dashboard',compact('user_id','proj_task','total_task','p_t_spend','contacts', 'id', 'task_count', 'milestone_count', 'project_count', 'projects'));
    }
    public function customer ()
    {
        return view('customer');
    }
}
