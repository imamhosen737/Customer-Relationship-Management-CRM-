@extends('layouts.app')
@section('page_title')
<span>Update Tax</span>
@endsection

@section('content')

@if (session('updateStatus'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('updateStatus')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
@endif
<form action="{{ route ('tax.update' ,$tax->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
      <label for="Taxname"  class="form-label">Tax name</label>
      <input type="text" name='rules' value="{{$tax->rules}}" class="form-control" id="Taxname">
      @if($errors->has('rules'))
       <div style="color:red;font-weight:bold">{{ $errors->first('rules') }}</div>
      @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
