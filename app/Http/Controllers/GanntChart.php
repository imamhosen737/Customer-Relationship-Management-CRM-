<?php

namespace App\Http\Controllers;

use App\Models\Milestones;
use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Http\Request;

class GanntChart extends Controller
{
    public function show($id)
    {

        $milestone = Milestones::where('project_id', $id)->get();

        $gannt = [];
        $k = 0;
        foreach ($milestone as $m) {
            $ms['text'] = $m['name'];
            $ms['start'] = $m['start_date'];
            $ms['end'] = $m['end_date'];
            $ms['id'] = ++$k;

            $task = Tasks::where('milestone_id', $m['id'])->get();
            
            $tas = [];
            foreach ($task as $ta) {
                $ts['text'] = $ta['subject'];
                $ts['start'] = $ta['start_date'];
                $ts['end'] = $ta['end_date'];
                $ts['id'] = ++$k;
                $ts['complete'] = ++$k+50;
                array_push($tas, $ts);
            }
            $ms['children'] = $tas;
            array_push($gannt, $ms);
        }
        return response(
            $gannt
        );
    }
}
