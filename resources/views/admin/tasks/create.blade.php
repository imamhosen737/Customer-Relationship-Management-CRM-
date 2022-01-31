@extends('layouts.app')
@section('page_title')
<span>Create Tasks</span>
@endsection
@section('content')


@if ($errors->any())
   <div class="alert alert-danger alert-dismissible fade show">
       @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
   </div>
@endif



@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
    </div>

@endif




<div class="card">
  <div class="card-header">
    <a href="{{url('admin/project', $projectId)}}" class="btn btn-lg btn-info">Back to Projects task</a>
</div>

  <div class="card-body">
      <form action="{{ route('tasks.store')}}" method="post">

       @csrf

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="project_name"> Select Project</label><br>
            <select class="form-control" name="project_id" id="project_name">
                            @forelse ($project_data as $data )
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @empty

                            @endforelse
            </select>
         </div>

        <div class="form-group col-md-4">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
        </div>

        <div class="form-group col-md-4">
            <label for="status">Status</label>

            <select name="status" id="status" class="custom-select" name="status">
                <option value="active">active</option>
                <option value="inactive">inactive</option>
            </select>
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="description" class="form-label"> Description</label>
            <textarea id="desc" class="form-control ckEditor" style="height: 300px;" name="description"  placeholder="Description"></textarea>
        </div>


    </div>


    <div class="form-row">
        <div class="form-group col-md-4">
           <label for="start_date"  class="form-label">Start Date</label>
                    <input type="date" name='start_date' class="form-control" id="start_date">
        </div>

        <div class="form-group col-md-4">
            <label for="end_date"  class="form-label">End Date</label>
                    <input type="date" name='end_date' class="form-control" id="end_date">
        </div>

        <div class="form-group col-md-4">
            <label for="priority">Priority</label>
            <select name="priority" class="form-control" id="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="visible" class="form-label  mr-2">Visible To Customer</label>
            <input type="checkbox"  name="visible_to_customer" id="">
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-block btn-primary">Submit</button>
        </div>
    </div>

</form>
</div>
</div>



@endsection

