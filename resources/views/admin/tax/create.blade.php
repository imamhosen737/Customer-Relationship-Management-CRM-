@extends('layouts.app')
@section('page_title')
<span>Tax Rule</span>
@endsection
@section('content')
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session('success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
@endif

<form action="{{ route('tax.store') }}" method="post">

   @csrf
    <div class="form-row">
      <div class="col">
        <label for="Taxname"  class="form-label">Rule Name</label>
        <input type="text" name='rules' class="form-control" id="Taxname" placeholder="Tax Rule">
        @if($errors->has('rules'))
         <div style="color:red;font-weight:bold">{{ $errors->first('rules') }}</div>
       @endif
      </div>
      <div class="col mb-3">
        <strong>&nbsp; &nbsp;</strong>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
      </div>
  </div>

</form>

@endsection


