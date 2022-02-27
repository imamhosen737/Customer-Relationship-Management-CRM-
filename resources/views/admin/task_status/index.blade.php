    @extends('layouts.app')
    @section('page_title')
    <span>Task List</span>
    @endsection

    @section('content')
    <style type="text/css">
        .box {
            width: 365px;
            background: #e3e8ee;
            margin-right: 10px;
            min-height: 500px;
            position: relative;
            float: left;
        }
    .panel-heading-bg {
      padding: 9px;
      position: relative;
      border-bottom: 1px solid #e4e5e7;
  }
  .panel-body {
      background: #f2dede!important;
      padding: 10px 15px;
      margin: 10px;
      border-radius: 5px;
      border: 1px solid #eab8b7!important;
  }
  .kan-ban-step-indicator {
      width: 38px;
      height: 38px;
      position: absolute;
      top: -1px;
      right: -1px;
      border-top-right-radius: 3px;
      border-bottom-right-radius: 3px;
      z-index: 39;
      background: url(../../assets/images/stage.svg) no-repeat top left;
  }
    </style>

    <div class="container-fluid wrapper">
        <div class="card">
            <div class="card-body">
                <a href="" class="btn btn-info btn-lg">Show Tasks List</a>
            </div>
        </div>
      <div class="table-responsive">

         <table>
             <tr>
                 <td>
                     <div class="box1 box ">
                         <div class="panel-heading-bg" style="background:#989898;border-color:#989898;color:#fff; ?>" >
                             <div class="kan-ban-step-indicator"></div>
                             <span class="heading">Not Started</span>

                         </div>
                         <ul  style="list-style: none;margin: 0;padding: 0" >

                             @if(count($tasksPending) > 0)
                                 @forelse($tasksPending as $value)
                                     <li>
                                         <div class="panel-body">
                                             <a style="color: white" href="{{route('task_list.show', $value->id)}}">{{ $value->subject }}</a>
                                         </div>
                                     </li>
                                 @empty
                                 @endforelse

                             @else
                                 <div class="panel-body">
                                     <span style="color: darkblue">No Task Found</span>
                                 </div>
                             @endif
                         </ul>
                     </div>
                 </td>
                 <td>
                     <div class="box2 box">
                         <div class="panel-heading-bg" style="background:#03A9F4;border-color:#03A9F4;color:#fff; ?>" >
                             <div class="kan-ban-step-indicator"></div>
                             <span class="heading">In Progress</span>

                         </div>
                         <ul  style="list-style: none; margin: 0;padding: 0" >

                             @if(count($tasksProgress) > 0 )
                                 @forelse($tasksProgress as $value)
                                     <li>
                                         <div class="panel-body">
                                             <a style="color: darkblue" href="{{route('task_list.show', $value->id)}}">{{ $value->subject }}</a>
                                         </div>
                                     </li>
                                 @empty
                                 @endforelse

                             @else
                                 <div class="panel-body">
                                     <span style="color: darkblue">No Task Found</span>
                                 </div>
                             @endif
                         </ul>
                     </div>
                 </td>
                 <td>
                     <div class="box3 box">
                         <div class="panel-heading-bg" style="background:#2d2d2d;border-color:#2d2d2d;color:#fff; ?>" >
                             <div class="kan-ban-step-indicator"></div>
                             <span class="heading">Testing</span>

                         </div>
                         <ul  style="list-style: none; margin: 0;padding: 0" >

                             @if(count($tasksTesting) > 0 )
                                 @forelse($tasksTesting as $value)
                                     <li>
                                         <div class="panel-body">
                                             <a style="color: darkblue" href="{{route('task_list.show', $value->id)}}">{{ $value->subject }}</a>
                                         </div>
                                     </li>
                                 @empty
                                 @endforelse

                             @else
                                 <div class="panel-body">
                                     <span style="color: darkblue">No Task Found</span>
                                 </div>
                             @endif
                         </ul>
                     </div>
                 </td>
                 <td>
                     <div class="box4 box">
                         <div class="panel-heading-bg" style="background:#adca65;border-color:#adca65;color:#fff; ?>" >
                             <div class="kan-ban-step-indicator"></div>
                             <span class="heading">Feedback</span>

                         </div>
                         <ul  style="list-style: none; margin: 0;padding: 0" >

                             @if(count($tasksFeedback) > 0 )
                                 @forelse($tasksFeedback as $value)
                                     <li>
                                         <div class="panel-body">
                                             <a style="color: darkblue" href="{{route('task_list.show', $value->id)}}">{{ $value->subject }}</a>
                                         </div>
                                     </li>
                                 @empty
                                 @endforelse

                             @else
                                 <div class="panel-body">
                                     <span style="color: darkblue">No Task Found</span>
                                 </div>
                             @endif
                         </ul>
                     </div>
                 </td>
                 <td>
                     <div class="box5 box">
                         <div class="panel-heading-bg" style="background:#84c529;border-color:#84c529;color:#fff; ?>" >
                             <div class="kan-ban-step-indicator"></div>
                             <span class="heading">Complete</span>

                         </div>
                         <ul  style="list-style: none; margin: 0;padding: 0" >

                             @if(count($tasksComplete) > 0 )
                                 @forelse($tasksComplete as $value)
                                     <li>
                                         <div class="panel-body">
                                             <a style="color: darkblue" href="{{route('task_list.show', $value->id)}}">{{ $value->subject }}</a>
                                         </div>
                                     </li>
                                 @empty
                                 @endforelse

                             @else
                                 <div class="panel-body">
                                     <span style="color: darkblue">No Task Found</span>
                                 </div>
                             @endif
                         </ul>
                     </div>
                 </td>
             </tr>

         </table>

      </div>
    </div>



  @endsection













