@extends('layouts.app')
@section('page_title')
View Pending Proposal
@endsection

@section('content')
{{-- Table starts from here --}}
<div class="container wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>##</th>
                <th class="col-md-2">Customer Name</th>
                <th class="col-md-2">Subject</th>
                <th class="col-md-2">Date</th>
                <th class="col-md-2">Due Date</th>
                <th class="col-md-2">Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
         
            </tr>
        </tfoot>
        <tbody>
            @forelse ($pending as $pendingValue)
             <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$pendingValue->customer->user->name}}</td>
                <td class="highlight">{{$pendingValue->subject}}</td>
                <td>{{$pendingValue->date}}</td>
                <td>{{$pendingValue->due_date}}</td>
                <td>
                    <a href="" class="btn btn-sm btn-primary">Details</a>
                </td>
            </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</div>
{{-- Table ends here --}}
@endsection