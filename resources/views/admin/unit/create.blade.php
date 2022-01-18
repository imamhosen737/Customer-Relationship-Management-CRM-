@extends('layouts.app')
@section('page_title')
<span>Unit</span>
@endsection
@section('content')
<div class="card">
  <div class="card-header">Units Page</div>
  <div class="card-body">

    <form action="{{ route('unit.store') }}" method="post">
        @csrf
      <label for="">Unit Name</label><br>
      @error('unit_name')
        <span style="color:red">{{ $message }}</span>
      @enderror
      <input type="text" name="unit_name"  class="form-control" value="{{ old('unit_name') }}"><br>
      <input type="submit"  class="btn btn-success"><br>
    </form> 

  </div>
</div>
@stop