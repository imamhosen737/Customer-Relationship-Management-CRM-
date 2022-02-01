@extends('layouts.app')
@section('page_title')
<span>Customers Details</span>
@endsection
@section('content')

<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary btnGroup" data-toggle="collapse" data-target="#basic" aria-expanded="false"
        aria-controls="basic">Basic</button>
    <button type="button" class="btn btn-primary btnGroup" data-toggle="collapse" data-target="#contact" aria-expanded="false"
        aria-controls="contact">Contact</button>
</div>
<div class="collapse show" id="basic">
    <h2 class="text-center">Customer Basic</h2>
    <form action="{{route('customers.update',$data->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Full Name</label>
                @error('name')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name ',$data->user->name)}}" placeholder="Enter Name">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                @error('email')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <input type="email" class="form-control" name="email" id="email"
                    value="{{old('email',$data->user->email)}}" placeholder="Enter Email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="company_name">Company Name</label>
                @error('company_name')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <input type="text" class="form-control" name="company_name" id="company_name"
                    value="{{old('company_name',$data->company_name)}}" placeholder="Enter Company Name">
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                @error('password')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <input type="text" class="form-control" name="password" id="password"
                    value="{{old('password',$data->user->password)}}" placeholder="Enter Password">
            </div>
            <div class="form-group col-md-4">
                <label for="status">Status</label><br>
                @error('status')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <select id="status" class="custom-select" name="status">
                    <option value="active" {{$data->user->status =='active'?'selected':''}}>Active</option>
                    <option value="inactive" {{ $data->user->status =='inactive'?'selected':''}}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                @error('address')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <input type="text" class="form-control" name="address" id="address"
                    value="{{old('address',$data->address)}}" placeholder="Enter Address">
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                @error('phone')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
                <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone',$data->phone)}}"
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
                <input type="text" class="form-control" name="vat_number" id="vat_number"
                    value="{{old('vat_number',$data->vat_number)}}" placeholder="Enter Vat Number">
            </div>
            <input type="submit" class="btn btn-block btn-primary" value="Edit Customer">

        </div>
    </form>
</div>
<div class="collapse" id="contact">
    <h2 class="text-center">Customer Contact</h2>
    {{-- Table starts from here --}}
<div class="container wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Customer</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Customer</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($dataCon as $key=>$c)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$c->customers->user->name}}</td>
                <td>{{$c->name}}</td>
                <td>{{$c->email}}</td>
                <td>{{$c->phone}}</td>
                <td>{{$c->address}}</td>
                <td>
                    <form action="{{route('contacts.destroy',$c->id)}}" method="POST" id="del{{$c->id}}">
                        @csrf
                        @method('delete')
                        <a title="edit" href="{{route('contacts.edit',$c->id)}}" class="text-success mr-2"><i class="fas fa-user-edit"></i></a>
                        <a title="delete" onclick="document.getElementById('del{{$c->id}}').submit()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
{{-- Table ends here --}}
</div>




@endsection
