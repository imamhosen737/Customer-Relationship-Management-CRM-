@extends('layouts.app')
@section('page_title')
<span>Add Contact</span>
@endsection
@section('content')
<form action="{{route('contacts.update',$con->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="customer_id">Select Customer</label><br>
            @error('customer_id')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <select id="customer_id" class="custom-select" name="customer_id">
                <option value="" selected>Select Customer</option>
                @foreach ($data as $c)
                <option value="{{$c->id}}" {{$c->id==$con->customer_id?'selected':''}} >{{$c->user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            @error('name')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{old('name',$con->name)}}"
                placeholder="Enter Name">
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            @error('email')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="email" class="form-control" name="email" id="email" value="{{old('email',$con->email)}}"
                placeholder="Enter Email">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone">Phone</label>
            @error('phone')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone',$con->phone)}}"
                placeholder="Enter Phone">
        </div>
        <div class="form-group col-md-6">
            <label for="address">Address</label>
            @error('address')
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="address" id="address" value="{{old('address',$con->address)}}"
                placeholder="Enter Address">
        </div>
    </div>
    <input type="submit" class="btn btn-block btn-primary" value="Edit Contact">
</form>
@endsection