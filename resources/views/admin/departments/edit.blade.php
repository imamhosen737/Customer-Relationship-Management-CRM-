@extends('layouts.app')
@section('page_title')
{{-- <span>Update department</span> --}}
@endsection
@section('content')
<div class="card">
  
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Must be input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif



      <form action="{{ url('admin/department/' .$contacts->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$contacts->id}}" id="id" />
        <label>Update department</label></br>
        <input type="text" name="name" id="name" value="{{$contacts->name}}" class="form-control"></br>
        <input type="submit" class="btn btn-primary" value="Update">
    </form>
  
  {{-- </div> --}}
</div>
@endsection