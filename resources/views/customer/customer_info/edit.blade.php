@extends('layouts.app')
@section('page_title')
Update Customer
@endsection

@section('content')
<div class="container wrapper">

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @section('error_message')
       @if ($errors->all())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>

      @endif
    @endsection
   <form action="{{route('customer.update', $customers->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{$customers->user->name}}" >

            </div>
            <div class="form-group col-md-6">
                <label for="com_name">Company Name</label>
                <input type="text" class="form-control" name="company_name" id="cmp_name" value="{{$customers->company_name}}" >
            </div>
       </div>

       <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{$customers->phone}}" >
        </div>
        <div class="form-group col-md-4">
            <label for="vat">Vat</label>
            <input type="text" class="form-control" name="vat_number" id="vat" value="{{$customers->vat_number}}" >
        </div>
        <div class="form-group col-md-4">
            <label for="customFile">Photo</label>
            <div class="custom-file">
                <input type="file"  class="custom-file-input" name="photo" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" id="city" value="{{$customers->city}}" >
        </div>
        <div class="form-group col-md-4">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" name="zip" id="vat" value="{{$customers->zip}}" >
        </div>
        <div class="form-group col-md-4">
            <label for="country">Country</label>
            <input type="text" class="form-control" name="country" id="country" value="{{$customers->country}}" >
        </div>
      </div>


      <div class="form-row">
          <div class="form-group">
             <label for="addr">Address</label>
             <textarea  class="form-control ckEditor" id="address" name="address">{{$customers->address}}</textarea>
           </div>
      </div>

      <div class="form-row">
          <div class="form-group">
              <input type="submit" class="btn btn-block btn-primary" value="Submit">
          </div>
      </div>
   </form>
</div>
@endsection
