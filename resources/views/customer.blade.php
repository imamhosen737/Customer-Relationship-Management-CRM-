@extends('layouts.app')
@section('page_title')
Customer Panel

@endsection

@section('content')

{{-- @php
// $invoices = Helper::getRecurringInvoice();

@endphp --}}


@forelse($invoices as $value)

@php
$recurringPay = date('Y-m-d', strtotime($value->due_date. ' + '. $value->interval .'days'));
@endphp


<div class="alert alert-secondary alert-dismissible" role="alert">
    New recurring invoice <strong>({{$value->invoice_number}})</strong> from due date
    <strong>({{$value->due_date}})</strong> was created for you!! <br> Pay within
    <strong>{{$recurringPay}} <br> Total Payable: {{$value->payable}}</strong>
    <a href="{{route('invoice.show', $value->invoice_number)}}" style="margin-left: 5px"
        class="btn btn-sm btn-outline-blue"><i class="fas fa-eye"></i></a>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>

@empty
@endforelse
<h1 class="text-center mt-5">Regular Due Invoice</h1>
<table class="table table-active">
    <tr>
        <th>Invoice Number</th>
        <th>Due Date</th>
    </tr>

    @forelse ($invoice_due as $due)
    <tr>
        <td>{{ $due->invoice_number }}</td>
        <td>{{ $due->due_date }}</td>
    </tr>
    @empty

    @endforelse
    <tr>

    </tr>
</table>

@endsection