 
@extends('layouts.app')
@section('page_title')
{{-- <span>New Expense Add</span> --}}
@endsection
@section('content')

     <h3>New Expense Add</h3><br><br>

    <form action="{{ route('expense.store')}}" method="POST">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="" >Name</label>
          <input type="text" class="form-control" name="name" id="name"
          value="{{ old('name') }}" placeholder="Enter your name" >
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-md-4">
          <label for="">Note</label>
          <input type="text" class="form-control" name="note"
          value="{{ old('note') }}" placeholder="Enter your note" >
          @error('note')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-md-4">
        <label for="" >Expense Date</label>
        <input type="date" class="form-control" name="expense_date" value="{{ old('expense_date') }}"   placeholder="Enter your Expense Date" >
        @error('expense_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
         </div>

      </div>


     
       <div class="form-row">

         <div class="form-group col-md-4">

        <label for="" >Amount</label>
        <input type="text" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Enter your amount" >
        @error('amount')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group col-md-4">
        <label for="project_id" >Project Name</label><br>
        <span style="color: tomato">@error('project_id'){{ $message }}</span>@enderror
        <select id="project_id"  class="custom-select" name='project_id'>
          <option disabled value="">Select Project</option>

               @foreach ($project as $p)
               @if (old('project_id')==$p->id)

               <option value="{{$p->id}}" {{'selected'}}>{{$p->name}}</option>
               @else
               <option value="{{$p->id}}" >{{$p->name}}</option>
               @endif
               @endforeach
           </select>
           </div>

           <div class="form-group col-md-4">

        <label for="" >Expense Category Name</label>
        
        <span style="color: tomato">@error('expenseCategory_id'){{ $message }}</span>@enderror
        <select id="expenseCategory_id"  class="custom-select" name='expenseCategory_id'>
          <option disabled value="">Select Rule</option>

               @foreach ($expenseCategory as $expCat)
               @if (old('expenseCategory_id')==$expCat->id)

               <option value="{{$expCat->id}}" {{'selected'}}>{{$expCat->name}}</option>
               @else
               <option value="{{$expCat->id}}" >{{$expCat->name}}</option>
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
      
    <!-- </div> -->
@endsection