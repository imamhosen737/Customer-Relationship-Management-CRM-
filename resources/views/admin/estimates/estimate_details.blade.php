@extends('layouts.app')
@section('page_title')
    Estimate Informations
@endsection
@section('content')
    <div class="container">



        <div class="row">
            <div class="col-md-6 mt-5">
                <b>Street Address:</b> <br>
                <b>Dhanmondi, Zigatola</b> <br>
                <b>Zigatola, Dhaka 1205</b> <br>
                <b>Phone: 01839*******</b> <br>
            </div>
            <div class="col-md-4 offset-md-2">
                <h4 class="text-center">ESTIMATE</h4>
                <table class="table table-bordered text-center">
                    <tr>
                        <td>Estimate ID</td>
                        <td>{{ $data->id }}</td>
                    </tr>
                    <tr>
                        <td>Creat Date</td>
                        <td>{{ $data->date }}</td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td>{{ $data->due_date }}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>{{ $data->subject }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{ $data->status }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-4">
                <table class="table table-bordered">
                    <tr>
                        <th>SEND TO</th>
                    </tr>
                    <tr>
                        <td>
                            <b>Name: {{ $data->customer->company_name }}</b> <br>
                            <b>Address: {{ $data->customer->address }} </b> <br>
                            <b>Email: {{ $data->customer->user->email }}</b> <br>
                            <b>Phone: {{ $data->customer->phone }}</b> <br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>



    <!-- item info -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h2 class="text-success">Product List</h2>
                    <hr class="my-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Item Name</th>
                                <th>Unit</th>
                                <th>Tax</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $sub = 0;
                                $tax = 0;
                                $totalSum = 0;
                            @endphp

                            @foreach ($est_item as $item)
                                @php
                                    $sub += $item->price * $item->qty;
                                    $taxFix = $item->Item->tax->rules ?? 0;
                                    
                                    $tax += ($item->price * $item->qty * $taxFix) / 100;
                                    
                                    $totalSum += $item->price * $item->qty + ($item->price * $item->qty * $taxFix) / 100;
                                @endphp

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->item->name }}</td>
                                    <td>{{ $item->Item->unit->unit_name }}</td>
                                    <td>{{ $item->Item->tax->rules ?? '0' }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price * $item->qty }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align:right">Sub Total</td>
                                <td>{{ $sub }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right">Tax</td>
                                <td>{{ $tax }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right">Gross Total</td>
                                <td>{{ $totalSum }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('est_invoice',[$data->customer_id,$data->id]) }}"
                        class="btn btn-block btn-success">Convert Invoice</a>
                        
                </div>
            </div>
        </div>

    </div>

@endsection
