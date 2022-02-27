@extends('layouts.app')
@section('page_title')
    <span>Task {{$id}}</span>
@endsection

@section('content')

    <style>
        .task-single-col-right {
            background-image: linear-gradient(to left bottom, #b6c3d6, #b4c8dc, #b0cce1, #add1e5, #a9d6e8);
            padding: 45px;
        }
        .next i {
            margin-right: 11px;
        }
        .task-single-col-left {
            padding: 45px;
            background: #fff;
        }
        .components ul li {
            margin-bottom: 10px;
        }
         #chartdiv {
             width: 100%;
             height: 300px;
         }

        .button-group ul li{
            margin-right: 12px;
        }
        .components ul li i {
            margin-right: 11px;
        }
    </style>

    <div class="container-fluid wrapper">
        <div class="card">
            <div class="card-body" style="padding: 0">
                <div class="row">
                    <div class="col-md-8 task-single-col-left">
                        <div class="button-group" style=" border-bottom: 1px solid #CCCCCC;margin-bottom: 20px ; padding-bottom: 20px;">
                            <ul style="list-style: none;margin: 0;padding: 0" class="d-flex">
                                <li><a href="" title="Mark as Complete" class="btn btn-light-gray"><i class="fas fa-check"></i></a></li>
                                <li><a href="" data-id="{{$singleTasks->id}}" data-toggle="modal" data-target="#statistics" title="Statistics" class="btn btn-light-gray statistics"><i class="fas fa-chart-bar"></i></a></li>
                                <li><a href="{{route('timesheets.index')}}"  title="Timesheets" class="btn btn-light-gray"><i class="fas fa-tasks"></i></a></li>
                                <li><a href=""  class="btn btn-success"><i class="fas fa-clock"></i> START TIMER</a></li>
                            </ul>
                        </div>

                        <!--task subject -->
                        <div class="taskDescription" style=" border-bottom: 1px solid #CCCCCC;margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Subject</h4>
                            <p>{{$singleTasks->subject}}</p>
                        </div>

                        <!--task description -->
                        <div class="taskDescription" style=" margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Task Description</h4>
                            <p>{{$singleTasks->description}}</p>
                        </div>

                    </div>
                    <div class="col-md-4 task-single-col-right">
                        <div class="task-info" style=" border-bottom: 1px solid #9da2dd;margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Task Info</h4>
                            <p>{{$singleTasks->created_at}}</p>
                        </div>

                        <!--components-->
                        <div class="components" style=" border-bottom: 1px solid #9da2dd !important;margin-bottom: 20px ; padding-bottom: 20px;">
                            <ul style="list-style: none;margin: 0;padding: 0" >
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-star"></i>
                                        <span >
                                            <strong>Status:
                                                @if($singleTasks->status == 'pending')
                                                    <span style="color: #ff0000">{{  $singleTasks->status  }}</span>

                                                @elseif($singleTasks->status == 'in_progress')
                                                    <span style="color: green">{{  "In Progress"  }}</span>

                                                @elseif($singleTasks->status == 'testing')
                                                    <span style="color: green">{{  "Testing"  }}</span>

                                                @elseif($singleTasks->status == 'feedback')
                                                    <span style="color: green">{{  "Feedback"  }}</span>

                                                @elseif($singleTasks->status == 'complete')
                                                    <span style="color: green">{{  "Complete"  }}</span>

                                                @endif
                                            </strong>

                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar"></i>
                                        <span > <strong>Start Date:</strong>  {{  $singleTasks->start_date  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar"></i>
                                        <span > <strong>End Date:</strong>  {{  $singleTasks->end_date  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-bolt"></i>
                                        <span > <strong>Priority: </strong> {{  $singleTasks->priority  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar-times"></i>
                                        <span > <strong>Duration:</strong>  {{  $singleTasks->duration  }} </span>
                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div class="next d-flex" style=" border-bottom: 1px solid #9da2dd !important;margin-bottom: 20px ; padding-bottom: 20px;" >
                            <i class="fas fa-user"></i>
                            <span > Assigned To:  {{  $singleTasks->user->name  }}</span>
                        </div>

                        <div class="next d-flex" style=" border-bottom: 1px solid #9da2dd !important;margin-bottom: 20px ; padding-bottom: 20px;">
                            <i class="fas fa-project-diagram"></i>
                            <span > Project Name:  {{  $singleTasks->project->name  }}</span>
                        </div>

                        <div class="next d-flex" >


                            <span > Milestone Info:  {{  $singleTasks->milestones->name  }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statistics" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(to right,#226faa 0,#2989d8 37%,#72c0d3 100%);">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Task <span id="statId"></span> Statistics</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chartdiv" style="width: 100%; height: 300px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" class="btn btn-primary" style="background: linear-gradient(to right,#226faa 0,#2989d8 37%,#72c0d3 100%);"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script type="text/javascript">


        $(document).ready( function (){

            $(document).on('click', '.statistics', function (){
                var id = $(this).data('id');
                document.getElementById('statId').innerText =  id;
            })

            //make json data for bar braph
            var timeData = JSON.parse('<?php echo $timesheet ?>');

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
// https://www.amcharts.com/docs/v5/charts/xy-chart/
                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX"
                }));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
                xRenderer.labels.template.setAll({
                    rotation: -90,
                    centerY: am5.p50,
                    centerX: am5.p100,
                    paddingRight: 15
                });

                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0.3,
                    categoryField: "task",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                }));

                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                    maxDeviation: 1,

                    renderer: am5xy.AxisRendererY.new(root, {})
                }));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: "Series 1",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "time",
                    sequencedInterpolation: true,
                    categoryXField: "task",
                    tooltip: am5.Tooltip.new(root, {
                        labelText:"{valueY}"
                    })
                }));

                series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
                series.columns.template.adapters.add("fill", (fill, target) => {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                series.columns.template.adapters.add("stroke", (stroke, target) => {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });


// Set data


                //make data array for bar graph
                var dataArray = [];
                $.each(timeData, function( index, value ) {
                    dataArray.push({
                        task: index,
                        time: value.total_time
                    });
                });
                var data = dataArray;

                xAxis.data.setAll(data);
                series.data.setAll(data);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
                series.appear(1000);
                chart.appear(1000, 100);

            }); // end am5.ready()


        });
    </script>

@endsection
