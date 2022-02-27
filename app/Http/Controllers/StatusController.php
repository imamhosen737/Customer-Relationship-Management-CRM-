<?php

namespace App\Http\Controllers;


use App\Models\Tasks;
use App\Models\Timesheets;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
// use App\Http\Requests\TasksRequest;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Carbon\Carbon;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tasksProgress = Tasks::whereIn('status', ['in_progress'])
          ->get();
        $tasksPending = Tasks::whereIn('status', ['pending'])
          ->get();

        $tasksTesting = Tasks::whereIn('status', ['testing'])
          ->get();

        $tasksFeedback = Tasks::whereIn('status', ['feedback'])
          ->get();
        $tasksComplete = Tasks::whereIn('status', ['complete'])
          ->get();



        return view('admin.task_status.index', compact('tasksProgress', 'tasksPending','tasksTesting','tasksFeedback','tasksComplete'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timesheet = Timesheets::with('task')
            ->where('task_id', $id)
            ->get()
            ->map(function($q) {
                $key = date('Y-m-d', strtotime($q->start_time));
                $q->start_date = $key;
                $startTime = Carbon::parse($q->start_time);
                $endTime = Carbon::parse($q->end_time);
                $q->total_duration =  round($startTime->floatDiffInHours($endTime), 2);
                return $q;
            })
            ->groupBy('start_date')
            ->map(function($q) {
                $q->sum = round($q->sum('total_duration'), 2);
                return ['total_time' => $q->sum];
            });

       //wait
        $timesheet = json_encode($timesheet);
        $singleTasks = Tasks::with('project', 'Milestones', 'User')
           ->where('id' , $id)->first();
        return view('admin.task_status.show', compact('id', 'singleTasks', 'timesheet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
