@extends('layouts.app')
@section('page_title')
<span>Payment Received Report </span>
@endsection
@section('content')
<div class="container wrapper">
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">Serial</th>
                <th class="col-md-2">Received By</th>
                <th class="col-md-2">Customer Name</th>
                <th class="col-md-2">Method Name</th>
                <th class="col-md-2">Invoice</th>
                <th class="col-md-2">Amount</th>
            </tr>
        </thead>

        <tbody>
            {{-- {{dd($payments)}} --}}

            {{-- {{dd($payment)}}; --}}
            @php
                $amount=0;
            @endphp
              <tr>
                  @foreach ($payment as $Payments)
                  @php
                        $amount=$amount+$Payments->amount;
                  @endphp

                <td>{{ $loop->iteration }}</td>
                <td>{{$Payments->user->name}}</td>
                <td>{{$Payments->Invoice->customer->user->name}}</td>
                <td>{{$Payments->paymentMethod->name}}</td>
                <td>{{$Payments->Invoice->invoice_number}}</td>
                <td>{{$Payments->amount}}</td>

                </tr>
                @endforeach


        </tbody>
        <tfoot>
             <div class="col-md-12 offset-9">
                   <td class="text-right " colspan="5">Total:
                   </td>
                     <td class="text-left" colspan="1">
                          {{number_format("$amount",2)}}

        </tfoot>
    </table>
</div>
@endsection
