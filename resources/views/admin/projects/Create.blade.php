
        {{-- Table ends here --}}

@extends('layouts.app')
@section('page_title__extra')
<h1><span>Add Project</span></h1>

<div class="  justify-content-between">
 <a href="{{url()->previous()}}" class="btn btn-lg btn-primary">Back</a>
</div>
@endsection
@section('content')
<div class="card">
  <div class="card-body">

       @if ($errors->any())
       <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
       
         @endif
   
       <div class="form-row">
         <div class="form-group col-md-4">
            <form action="{{ url('admin/project') }}" method="post">
             {!! csrf_field() !!}
        
            <label for="customer name">Customer Name</label>

              
         <select id="company_name" class="custom-select"  class="form-control" id="item" name='customer_id'>

                     @foreach ($contact as $cont)
                      
                      <option value="{{$cont->id}}">{{$cont->company_name}}</option>
                      @endforeach
               </select>

            </div>
            <div class="form-group col-md-4">
        
            <label for="Name">Name</label>
            <input type="text" class="form-control" name="name" id="" value="" placeholder="Enter your name ">
            </div>
            <div class="form-group col-md-4">
        
            <label for="Discription">Discription</label>
            <input type="text" class="form-control" name="discription" id="" value="" placeholder="Enter your discription ">
            </div>
            <div class="form-group col-md-4">
            <label for="date">Start Date</label>
            <input type="date" class="form-control" name="start_date" id="" value="" placeholder="start date">
           
            </div>
            
            <div class="form-group col-md-4">           
            <label for="due_date">End Date</label>
            <input type="date" class="form-control" name="end_date" id="" value="" placeholder="Enter your end date">
             </div>
             <div class="form-group col-md-2 offset-md-2"></div>
            <div class="form-group col-md-4" style="align-content: center">
            <label for="country">Status</label><br>
                &nbsp;&nbsp;&nbsp;&nbsp; 
             <input class="form-check-input" type="radio" name="status" id="Radios1" value="active" checked>&nbsp;
        <label class="form-check-label" for="Radios1">active</label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="status" id="Radios2"value="pending">
        <label class="form-check-label" for="Radios2">pending</label></div><br>
              <input type="submit" class="btn btn-block btn-primary" value="Submit">
             </form>
           </div>
 
  </div>
</div>

@endsection