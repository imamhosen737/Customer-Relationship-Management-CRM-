@extends('layouts.app')
@section('page_title')
<span>Estimate list</span>
@endsection
@section('content')
<div class="container wrapper">
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>no</th>
                <th>Subject</th>
                <th>Recieved Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>no</th>
                <th>Subject</th>
                <th>Recieved Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            
            
                @foreach ($estimate as $k=>$e)
                <tr>
                    <td>{{++$k}}</td>
                    <td>{{$e->subject}}</td>
                    <td>{{$e->date}}</td>
                    <td>{{$e->due_date}}</td>
                    <td>{{ucfirst(trans($e->status))}}</td>
                    <td><a href="{{route('cm_estimate_view', $e->id)}}" class="btn btn-primary btn-sm" title="View"><i class="fas fa-eye"></i> View</a> </td>
                </tr>
                @endforeach
            

        </tbody>
    </table>
</div>
@endsection