@extends('layouts.app')
@section('page_title')
<span>Add Customer</span>
@endsection
@section('content')
<form action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Full Name</label>
            @error('name')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"
                placeholder="Enter Name">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            @error('email')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}"
                placeholder="Enter Email">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="company_name">Company Name</label>
            @error('company_name')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="company_name" id="company_name"
                value="{{old('company_name')}}" placeholder="Enter Company Name">
        </div>
        <div class="form-group col-md-4">
            <label for="password">Password</label>
            @error('password')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}"
                placeholder="Enter Password">
        </div>
        <div class="form-group col-md-4">
            <label for="status">Status</label><br>
            @error('status')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <select id="status" class="custom-select" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="address">Address</label>
            @error('address')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}"
                placeholder="Enter Address">
        </div>
        <div class="form-group col-md-6">
            <label for="phone">Phone</label>
            @error('phone')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}"
                placeholder="Enter Phone">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="customFile">Photo</label>
            @error('photo')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="vat_number">Vat Number</label>
            @error('vat_number')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="vat_number" id="vat_number" value="{{old('vat_number')}}"
                placeholder="Enter Vat Number">
        </div>
        <input type="submit" class="btn btn-block btn-primary" value="Add Customer">

    </div>
</form>
@endsection