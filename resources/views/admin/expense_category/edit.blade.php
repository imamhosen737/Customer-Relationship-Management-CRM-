@extends('layouts.app')
@section('page_title')
<span>Update Expense Category</span>
@endsection
@section('content')

<div class="card">
  <div class="card-header">Update expense</div>
  <div class="card-body">
      
      <form action="{{ url('admin/expensecat/'.$expense_category->id) }}" method="post">
        {!! csrf_field() !!}
        {{ method_field('put') }}
          <div class="form-row">
        <div class="col">
        <label>Name</label></br>
        
        @error('name')
        <span style="color: red">{{ $message }}</span>
        @enderror
        <input type="text" name="name" class="form-control" value="{{ old('name',$expense_category->name) }}"></br>
        </div>
        <div class="col mt-2">
          <strong>&nbsp;&nbsp;</strong>
        <input type="submit" value="Update" class="btn btn-block btn-primary"></br>
    </div>
        </div>
    </form>
  
  </div>
</div>
@endsection