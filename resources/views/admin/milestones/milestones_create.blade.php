@extends('layouts.app')
@section('page_title')
<span>Milestone</span>
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
        <a href="{{url('admin/project', $projectId)}}" class="btn btn-lg btn-info">Back to project Milestone</a>
    </div>
    <div class="card-body">
       <form action="{{ route('milestones.store')}}" method="post">

            @csrf

                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="project_name"  class="form-label">Select Project</label>
                    <select class="form-control" name="project_id" id="project_name">
                        @forelse ($project_data as $data )
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @empty

                        @endforelse
                    </select>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="milestone_name"  class="form-label">Milestones name</label>
                    <input type="text" name='name' class="form-control" id="milestone_name">
                    </div>
                    <div class="form-group col-md-4">
                    <label for="end_date"  class="form-label">End Date</label>
                    <input type="date" name='end_date' class="form-control" id="end_date">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description"  class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ordering"  class="form-label">Ordering</label>
                        <input type="text" name='ordering' class="form-control" id="ordering">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status"  class="form-label">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="visible"  class="form-label  mr-2">Visible To Customer?</label>
                        <input type="checkbox"  id="" name="visible_to_customer">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
    </div>
</div>

@endsection
