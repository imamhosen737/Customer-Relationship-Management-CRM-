
        {{-- Table ends here --}}

@extends('layouts.app')
@section('page_title__extra')
<h1><span>Add timesheets</span></h1>

<div class="  justify-content-between">
 <a href="{{url()->previous()}}" class="btn btn-lg btn-primary">Back</a>
</div>
@endsection
@section('content')
<div class="card">
  <div class="card-body">

       @if ($errors->any())
       <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
       
         @endif
   
       <div class="form-row">
         <div class="form-group col-md-4">
            <form action="{{ url('admin/timesheets') }}" method="post">
             {!! csrf_field() !!}

             

     <div class="form-group col-md-6">
              <label for="task_name">Task Name</label>


         <select id="task_name" class="custom-select"  class="form-control" id="item" name='task_id'>
          

                      @forelse ($Timesheetdata as $data )

                    <option value="{{$data->id}}">{{$data->subject}}</option>
                               

                     @endforeach -->
               </select>

            </div>

             
     <div class="form-group col-md-12">
        
            <label for="note">Note</label>
            <input type="text" class="form-control" name="note" id="" value="" placeholder="Enter your note ">
            </div>
           
            </div>
            <div class="form-group col-md-4">
             <label for="date">Start Date</label>
              <input type="datetime-local" class="form-control datetimepicker" name="start_time" id="" value="" placeholder="start time">
           
            </div>
            
            <div class="form-group col-md-4">           
            <label for="end_time">End Date</label>
            <input type="datetime-local" class="form-control datetimepicker" name="end_time" id="" value="" placeholder="Enter your end time">
             </div>
              <input type="submit" class="btn btn-block btn-primary" value="Submit">
             </form>
           </div>
       
 
  </div>
</div>

@endsection