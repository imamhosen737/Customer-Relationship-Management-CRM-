@extends('layouts.app')
@section('page_title')
<span>Unit</span>
@endsection
@section('content')
<div class="card">
  <div class="card-header">Units Page</div>
  <div class="card-body">
      
      <form action="{{ route('unit.update',$unit->id) }}" method="post">
        @csrf
        @method('PUT')
        <label>Unit Name</label></br>
        @error('unit_name')
        <span style="color:red">{{$message}}</span>
        @enderror
        <input type="text" name="unit_name" id="unitname" value="@if(old($unit->unit_name)){{old($unit->unit_name)}} @else{{$unit->unit_name}}@endif" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
  
  </div>
</div>
@stop