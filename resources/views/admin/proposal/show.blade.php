@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- {{dd($ProposalItem)}} --}}
        <a href="{{ url('admin/download/') }}/{{ $contacts->id }}">Download PDF File</a>



        <div class="row">
            <div class="col-md-3">
                <div class="jumbotron">
                    <i class="fas fa-user fa-3x"></i>
                    <hr class="my-4">
                    <span>Customer Name</span>
                    <h3>{{ $contacts->customers->company_name }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="jumbotron">
                    <i class="fas fa-sticky-note fa-3x"></i>
                    <hr class="my-4">
                    <span>Proposal Subject</span>
                    <h3>{{ $contacts->subject }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="jumbotron">
                    <i class="fas fa-calendar-alt fa-3x"></i>
                    <hr class="my-4">
                    <span>Due Date</span>
                    <h3>{{ $contacts->due_date }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="jumbotron">
                    <i class="fas fa-battery-empty fa-3x"></i>
                    <hr class="my-4">
                    <span>Status</span>
                    <h3>{{ $contacts->status }}</h3>
                </div>
            </div>
        </div>


        <!-- item info -->
        <div class="row">
            <div class="col-md-7">
                <div class="jumbotron">
                    <h3>Items Info</h3>
                    <hr class="my-4">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Unit</th>
                                <th>Tax</th>
                                <th>price</th>
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

                            @foreach ($contacts->proposalItem as $ProposalIt)

                                @php
                                    $sub += $ProposalIt->price * $ProposalIt->qty;
                                    $taxFix = $ProposalIt->Item->tax->rules ?? 0;
                                    
                                    $tax += ($ProposalIt->price * $ProposalIt->qty * $taxFix) / 100;
                                    
                                    $totalSum += $ProposalIt->price * $ProposalIt->qty + ($ProposalIt->price * $ProposalIt->qty * $taxFix) / 100;
                                @endphp


                                <tr>
                                    <td>{{ ++$i }}</td>

                                    {{-- <td>{{ $ProposalIt->proposal->customers->company_name }}</td> --}}
                                    <td>{{ $ProposalIt->item->name }}</td>
                                    <td>{{ $ProposalIt->item->unit->unit_name }}</td>
                                    <td>{{ $ProposalIt->item->tax->rules ?? '0' }}</td>
                                    <td>{{ $ProposalIt->price }}</td>
                                    <td>{{ $ProposalIt->qty }}</td>
                                    <td>{{ $ProposalIt->price * $ProposalIt->qty }}</td>
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
                                <td colspan="6" style="text-align:right">Total</td>
                                <td>{{ $totalSum }}</td>
                            </tr>



                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header d-flex">
                        <i style="margin-right: 5px" class="fas fa-book fa-2x "></i>
                        <h4>Summery</h4><br>
                    </div>
                    <div>


                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
