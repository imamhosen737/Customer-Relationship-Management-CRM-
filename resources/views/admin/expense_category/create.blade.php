@extends('layouts.app')
@section('page_title')
<span>Create Expense Category</span>
@endsection
@section('content')

<div class="card">
  <div class="card-header">Create expense</div>
  <div class="card-body">
      
      <form action="{{ route('expensecat.store') }}" method="post">
       @csrf
       <div class="form-row">
       	<div class="col">
        <label>Name</label></br>
        
        @error('name')
        <span style="color: red">{{ $message }}</span>
        @enderror
        <input type="text" name="name" class="form-control" value="{{ old('name') }}"></br>
        </div>
        <div class="col mt-2">
        	<strong>&nbsp;&nbsp;</strong>
        <input type="submit" value="Submit" class="btn btn-block btn-primary"></br>
    </div>
        </div>
    </form>
  
  </div>
</div>
@endsection

