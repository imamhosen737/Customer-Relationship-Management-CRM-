@extends('layouts.app')
@section('page_title')
<span>Update Tasks</span>
@endsection
@section('content')
<div class="container wrapper">
   <div class="card">
     <div class="card-body">
        <form action="{{route('tasks.update', $tasks->id)}}" method="post">
            {!! csrf_field() !!}
            {{ method_field('put') }}
            <div class="form-row">

                <div class="form-group col-md-2">
                    <label for="project_name"> Select Project</label><br>
                    <select class="form-control" name="project_id" id="project_name">
                          @foreach($project_data as $project)
                            <option value="{{$project->id}}" {{$project->id == $tasks->project_id ? 'selected' : ''}}>{{$project->name}}</option>
                            @endforeach
                    </select>
                 </div>

                  <div class="form-group col-md-2">
                    <label for="user_name"> Select user</label><br>
                    <select class="form-control" name="user_id" id="user_name">
                            @forelse ($User_data as $tata )
                                <option value="{{$tata->id}}" {{$tata->id == $tasks->user_id ? 'selected' : ''}}">{{$tata->name}}</option>
                            @empty

                            @endforelse
                </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="milestone_name"> Select milestone</label><br>
                    <select class="form-control" name="milestone_id" id="milestone_name">
                            @forelse ($Milestone_data as $m )
                                <option value="{{$m->id}}" {{$m->id == $tasks->milestone_id ? 'selected' : ''}}">{{$m->name}}</option>
                            @empty

                            @endforelse
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="subject">Subject</label>
                    <input type="text" name='subject' value="{{$tasks->subject}}" class="form-control" id="tasks_subject">
                    <input type="hidden" name="tasks_id" value="{{$tasks->id}}">
                </div>

                <div class="form-group col-md-2">
                    <label for="duration">Duration</label>
                    <input type="text" name='duration' value="{{$tasks->duration}}" class="form-control" id="tasks_duration">
                    <input type="hidden" name="tasks_id" value="{{$tasks->id}}">
                </div>

                <div class="form-group col-md-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="custom-select" name="status">
                        <option value="pending"{{$tasks->status =='pending' ? 'selected' : ''}}>Pending</option>
                        <option value="in_progress"{{$tasks->status == 'in_progress' ? 'selected' : ''}}>In_progress</option>

                        <option value="testing"{{$tasks->status =='testing' ? 'selected' : ''}}>Testing</option>
                        <option value="feedback"{{$tasks->status == 'feedback' ? 'selected' : ''}}>Feedback</option>
                        <option value="complete"{{$tasks->status == 'complete' ? 'selected' : ''}}>Complete</option>
                    </select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="description" class="form-label"> Description</label>
                    <textarea id="desc" class="form-control ckEditor" style="height: 300px;" name="description"  placeholder="Description">{{$tasks->description}}</textarea>
                </div>                     
            </div>


        <div class="form-row">
            <div class="form-group col-md-4">
               <label for="start_date"  class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{$tasks->start_date}}" placeholder="Start_date">
            </div>

            <div class="form-group col-md-4">
                <label for="end_date"  class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{$tasks->end_date}}" placeholder="End_date">
            </div>
            
            <div class="form-group col-md-4">
                <label for="priority">Priority</label>
                <select name="priority" class="custom-select" id="priority">
                    <option value="low"{{$tasks->priority == 'low' ? 'selected' : ''}}>Low</option><option value="medium"{{$tasks->priority == 'medium' ? 'selected' : ''}}>Medium</option>
                    <option value="high"{{$tasks->priority == 'high' ? 'selected' : ''}}>High</option>
                </select>
            </div>        
        </div>


        <div class="form-row">
            <label for="visible" class="form-label  mr-2">Visible To Customer??</label>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" style="opacity:1" class="custom-control-input " name="visible_to_customer" id="visible" {{  ($tasks->visible_to_customer == 'yes' ? ' checked' : '') }}>
                
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">               
                <button type="submit" class="btn btn-block btn-primary">Update</button>
            </div>
        </div>


        </form>
     </div>
   </div>
</div>
@endsection