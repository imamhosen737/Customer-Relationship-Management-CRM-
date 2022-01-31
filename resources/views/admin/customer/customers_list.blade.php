@extends('layouts.app')
@section('page_title')
<span>Customers List</span>
@endsection
@section('content')
{{-- Table starts from here --}}
<div class="container wrapper">
    <table class="table data_table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Password</th>
                <th>Status</th>
                <th>Company Name</th>
                <th>Photo</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Vat Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Password</th>
                <th>Status</th>
                <th>Company Name</th>
                <th>Photo</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Vat Number</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>

            @foreach ($data as $key=>$c)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$c->user->name}}</td>
                <td>{{$c->user->email}}</td>
                <td>***</td>
                <td>{{$c->user->status}}</td>
                <td>{{$c->company_name}}</td>
                <td><img src="{{asset('assets/images/customers/'.$c->photo)}}" class="img-fluid" alt=""></td>
                <td>{{$c->phone}}</td>
                <td>{{$c->address}}</td>
                <td>{{$c->vat_number}}</td>
                <td>
                    <form action="{{route('customers.destroy',$c->user->id)}}" method="POST" id="del{{$c->id}}">
                        @csrf
                        @method('delete')
                        <a title="edit" href="{{route('customers.edit',$c->id)}}" class="text-success mr-2"><i class="fas fa-user-edit"></i></a>
                        <a title="delete" onclick="document.getElementById('del{{$c->id}}').submit()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
{{-- Table ends here --}}
@endsection