@extends('layouts.app')
@section('page_title')
Customer Detail
@endsection

@section('content')

{{-- Table starts from here --}}
<div class="container wrapper">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th >##</th>
                <th>Customer Name</th>
                <th>Company Name</th>
                <th>Photo</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>


            @foreach ($customerInfo as $customer)
            <tr>
                <td>{{$loop->first}}</td>
                <td>{{$customer->User->name}}</td>
                <td>{{$customer->company_name}}</td>
                <td>
                    <img style="max-width: 70px;" src="{{asset('images/customer/'.$customer->photo)}}" alt="">
                </td>
                <td>{{$customer->phone}}</td>
                <td>
                    <a href="{{route('customer.edit', $customer->id)}}" class="btn btn-sm btn-blue">Edit</a>
                    <a href="{{ route('customer.show' , $customer->id) }}" class="btn btn-sm btn-blue" id="viewCustomer">View</a>

                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
{{-- Table ends here --}}


@endsection


