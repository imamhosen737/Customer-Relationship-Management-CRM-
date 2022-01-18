 
@extends('layouts.app')
@section('page_title')
{{-- <span>Update Expense</span> --}}
@endsection
@section('content')
<!-- <div class="container"> -->
    <!-- <a href="{{url('/expense')}}" class="btn btn-primary my-3">Show Data</a> 
    -->
    <H3 style="text-align: center; color: hsl(248, 53%, 58%);">Update Expense</H3><br><br>

    <form action="{{ route('expense.update',$data->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="" style="color: hsl(0, 100%, 0%);">Name</label>
          <input type="text" class="form-control" name="name" id="name"
          value="@if (old($data->name)){{ old($data->name) }}@else{{ $data->name }}@endif">
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-md-4">
          <label for="" style="color: hsl(0, 100%, 0%);">Note</label>
          <input type="text" class="form-control" name="note"
          value="@if (old($data->note)){{ old($data->note) }}@else{{ ($data->note) }}@endif">
          @error('note')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      
      
       <div class="form-group col-md-4">
        <label for="" style="color: hsl(0, 100%, 0%);">Expense Date</label>
        <input type="date" class="form-control" name="expense_date"
        value="@if (old($data->expense_date)){{ old($data->expense_date) }}@else{{ ($data->expense_date) }}@endif">
        @error('expense_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      </div>

      <div class="form-row">

      <div class="form-group col-md-4">

        <label for="" style="color: hsl(0, 100%, 0%);">Amount</label>

        <input type="text" class="form-control" name="amount"
        value="@if (old($data->amount)){{ old($data->amount) }}@else{{ ($data->amount) }}@endif">
        @error('amount')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    <!-- </div> -->


      <div class="form-group col-md-4">
        <label for="project_id" style="color: hsl(0, 100%, 0%);">Project Name</label><br>
        <span style="color: tomato">@error('project_id'){{ $message }}</span>@enderror
        <select id="project_id"  class="custom-select" name='project_id'>
          <option disabled value="">Select Project</option>

          @foreach ($project as $p)
          @if (old('project_id')==$p->id)

          <option value="{{$p->id}}" @if ($data->project->name == $p->name) {{'selected'}} @endif>{{ $p->name}}</option>
          @else
          <option value="{{ $p->id }}" @if ($data->project->name == $p->name) {{ 'selected' }} 
            @endif>{{ $p->name }}</option>
            @endif
            @endforeach



          </select>
        </div>

        <div class="form-group col-md-4">

          <label for="" style="color: hsl(0, 100%, 0%);">Expense Category Name</label>

          <span style="color: tomato">@error('expenseCategory_id'){{ $message }}</span>@enderror
          <select id="expenseCategory_id"  class="custom-select" name='expenseCategory_id'>
            <option disabled value="">Select Rule</option>

            @foreach ($expenseCategory as $expCat)
              @if (old('expenseCategory_id')==$expCat->id)


            <option value="{{$expCat->id}}" @if ($data->expenseCategory->name == $expCat->name) {{'selected'}} @endif>{{ $expCat->name}}</option>
            @else
            <option value="{{ $expCat->id }}" @if ($data->expenseCategory->name == $expCat->name) {{ 'selected' }} 
              @endif>
              {{ $expCat->name }}</option>
              
              @endif
                @endforeach 
            </select>
          </div>

        </div>

        <!--  <input type="submit" class="btn btn-primary my-3" value="Submit"> -->
        <div class="form-group col-md-12">
          <strong>&nbsp;&nbsp;</strong>
          <input type="submit" value="Save" class="btn btn-primary btn-block">
        </div>
      </form>
      
      
      @endsection