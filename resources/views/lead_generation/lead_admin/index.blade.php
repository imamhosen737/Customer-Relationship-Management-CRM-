@extends('layouts.app')

@section('page_title')
View Leads
@endsection

@section('content')

{{-- Table starts from here --}}
<div class="container-fluid wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>##</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Service Interest</th>
            </tr>
        </thead>

        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td class="highlight">{{$lead->name}}</td>
                <td>{{$lead->email}}</td>
                <td>{{$lead->phone}}</td>
                <td>{{$lead->address}}</td>
                <td>{{$lead->service_interest}}</td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>
{{-- Table ends here --}}
@endsection
