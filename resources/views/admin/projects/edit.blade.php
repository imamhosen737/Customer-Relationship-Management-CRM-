@extends('layouts.app')
@section('page_title')
<span>Edit Project</span>
@endsection
@section('content')
<div class="card">
  <div class="card-header">Project Page</div>
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



      <form action="{{url('admin/project/' .$contacts->id)}}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
 <div class="form-row">
                <div class="form-group col-md-4">
                      <label for="company name">Company Name</label>

         <select  id="company_name" class="custom-select" name='customer_id'>

                         @foreach ($custom as $cont)  
                        <option value="{{$cont->id}}" {{ $contacts->customs->company_name==$cont->company_name ? 'selected': ''}}>{{$cont->company_name}}</option>
                          @endforeach
                   </select>
                </div>
                <div class="form-group col-md-4">
         <input type="hidden" name="id" id="id" value="{{$contacts->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$contacts->name}}" class="form-control"></br>
                </div>
                <div class="form-group col-md-4">
                     <label>Start_date</label></br>
           <input type="date" name="start_date" id="start_date" value="{{$contacts->start_date}}" class="form-control"></br>
                    
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                     <label>Discription</label></br>
           <input type="text" name="discription" id="discription" value="{{$contacts->discription}}" class="form-control"></br>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                     <label>End_date</label></br>
            <input type="date" name="end_date" id="end_date" value="{{$contacts->end_date}}" class="form-control"></br>
                </div>
                <div class="form-group col-md-6">
                     <label for="country">Status</label><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                 <input class="form-check-input" type="radio" name="status" id="Radios1" value="active" checked>&nbsp;
             <label class="form-check-label" for="Radios1">
                    Active
                  </label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="status" id="Radios2"value="pending">
             <label class="form-check-label" for="Radios2">
                  Pending
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
</div>

@endsection
