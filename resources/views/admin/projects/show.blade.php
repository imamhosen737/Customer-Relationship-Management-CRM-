@extends('layouts.app')
@section('page_title')
<span>Project overview</span>
@endsection

@section('content')

<a href="{{ route('project.index') }}" class="btn btn-secondary">Back To Projects</a>
<a href="{{ route('project.tasks', $id) }}" class="btn btn-info">Task ({{ $task_count }})</a>
<a href="{{ route('project.milestones', $id) }}" class="btn btn-info">Milestone ({{ $milestone_count }})</a>
<a href="{{ route('gantt',$contacts->id) }}" class="btn btn-info">Gantt Chart</a>

<div class="container mt-5">
  <div class="row mb-5">
    <div class="col-md-6">
      <table class="table">
        <tbody>
          <tr>
            <th width='30%'>Project name:</th>
            <td>{{$projects->name}}</td>
          </tr>
          <tr>
            <th>Description:</th>
            <td>{{$projects->discription}}</td>
          </tr>
          <tr>
            <th>Status:</th>
            <td>{{$projects->status}}</td>
          </tr>
          <tr>
            <th>Start Date:</th>
            <td>{{$projects->start_date}}</td>
          </tr>
          <tr>
            <th>Deadline:</th>
            <td>{{$projects->end_date}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <style>
        #chartdiv {
          width: 100%;
          height: 500px;
        }
      </style>
      <!-- Resources -->
      <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

      <!-- Chart code -->
      <script>
        am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(
  am5percent.PieChart.new(root, {
    endAngle: 270
  })
);

// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category",
    endAngle: 270
  })
);

series.states.create("hidden", {
  endAngle: -90
});
@php
$remaining=$total_task-$p_t_spend;
@endphp
// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll([{
  category: "Remaining",
  value: {{$remaining}}
}, {
  category: "Completed",
  value: {{$p_t_spend}}
}, ]);

series.appear(1000, 100);

}); // end am5.ready()
      </script>

      <!-- HTML -->
      <div id="chartdiv"></div>
    </div>
  </div>
  <h2 class="text-center mt-5">Task Progress</h2>
  <div class="row mt-5">
    @foreach ($proj_task as $pt)
    @php
    $p_spend=0;
    $time_sheet=DB::table('timesheets')->where('task_id',$pt->id)->get();
    foreach ($time_sheet as $t) {
    $from_time = strtotime($t->start_time);
    $to_time = strtotime($t->end_time);
    $a=round(abs($to_time - $from_time) /60,2);
    $p_spend+=$a;
    }
    $prog=($p_spend/$pt->duration)*100;
    @endphp
    <p class="mt-5">{{$pt->subject}}</p>
    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: {{$prog}}%" aria-valuenow="{{$prog}}" aria-valuemin="0"
        aria-valuemax="{{$pt->duration}}"></div>
    </div>
    @endforeach

  </div>
</div>


@endsection