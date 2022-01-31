@extends('layouts.app')
@section('page_title')
<span>add department</span>
@endsection
@section('content')
<div class="card">
  <div class="card-body">

       {{-- @if ($errors->any())
       <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
         @endif --}}
       <div class="form-group">
      <form action="{{ url('admin/department') }}" method="post">
        {!! csrf_field() !!}
       <label for="name">Department Name</label>
        <input id="name" type="text" class="form-control" name="name" value="" placeholder="Enter Your Department Name">
         <input type="submit" class="btn btn-primary" value="Submit">
         @error('name')
                   <span style="color: red">{{ $message }}</span>
        @enderror
    </form>
  </div>
  </div>
  </div>

@endsection