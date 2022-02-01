@extends('layouts.app')
@section('page_title')
<span>Contact List</span>
@endsection
@section('content')
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
            @foreach ($data as $key=>$c)
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
@endsection