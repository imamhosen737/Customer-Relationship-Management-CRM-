@extends('layouts.app')
@section('page_title_extra')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoices</li>
        </ol>
    </nav>
    <h1 class="m-0"><span>Invoice Details</span></h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success  alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    <div class="container wrapper">
       <div class="card">
           <div class="card-body">
           @if (count($invoices) > 0)
                @php
                     $customer = $invoices[0]->customer;
                @endphp
                <div class="addr-wrap d-flex justify-content-between">


                    <div id="billToWrap">
                        <h4><strong>Bill To</strong></h4>
                        <div class="billTo">
                            <span><strong>Name: </strong>  {{$customer->user->name}}</span> <br>
                            <span><strong>Address: </strong> {{$customer->address}}</span> <br>
                            <span><strong>Email: </strong> {{$customer->user->email}}</span> <br>
                            <span><strong>Phone: </strong> {{$customer->phone}}</span> <br>
                        </div>
                    </div>

                    <div class="invId">
                        <table border="1" class="table">
                            <tr>
                                <td><strong>Invoice No</strong></td>
                                <td>{{$invoices[0]->invoice_number}}</td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td>{{$invoices[0]->date}}</td>
                            </tr>
                            <tr>
                                <td><strong>Type</strong></td>
                                <td>{{$invoices[0]->invoice_type}}</td>
                            </tr>
                        </table>
                    </div>



                </div>
                   <br>

               <!--total payable-->
               <div class="payable bg-dark " style="padding: 10px">
                   <h3 class="text-white  text-center mb-0"><strong>Invoice Total: {{$payable}} /-</strong></h3>
               </div>
                   <br>

               <!--Product Details -->
               <div class="items-info">
                   <h4><strong>Product Details</strong></h4>
                   <table border="1" class="table">
                       <tr>
                           <td><strong>SL</strong></td>
                           <td><strong>Product Name</strong></td>
                           <td><strong>Unit</strong></td>
                           <td><strong>Price</strong></td>
                           <td><strong>Quantity</strong></td>
                           <td><strong>Tax (%)</strong></td>
                           <td><strong>Discount (%)</strong></td>
                           <td><strong>Total</strong></td>
                       </tr>

                       @php
                          $subTotal = 0;
                          $tax=0;
                          $discount=0;
                       @endphp

                       @forelse($invoices as $value)

                           @php
                              $subTotal += $value->total;

                              $mrp = $value->items->rate * $value->qty;
                              $subTax = $mrp * $value->tax/100;
                              $tax +=  $subTax;

                              $subDiscount = $mrp *$value->discount/100;
                              $discount += $subDiscount;


                           @endphp

                           <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$value->items->name}}</td>
                               <td>{{$value->items->unit->name}}</td>
                               <td>{{$value->items->rate}}/-</td>
                               <td>{{$value->qty}}</td>
                               <td>{{$value->tax}}</td>
                               <td>{{$value->discount}}/-</td>
                               <td>{{$value->total}}</td>
                           </tr>
                       @empty
                       @endforelse

                       @php
                            $grandTotal = ($subTotal + $tax) -  $discount;
                       @endphp



                   </table>


                   <!---new summery -->
                   <div class="table-responsive">
                       <table class="table table-bordered table-striped" style="width:30% ;margin-left: auto;">
                           <thead style="text-align: center">
                                <th colspan="2">Invoice Summery</th>
                           </thead>
                           <tr>

                               <td><strong>SubTotal</strong></td>
                               <td><strong>{{$subTotal}}/-</strong></td>
                           </tr>
                           <tr>

                               <td><strong>Tax</strong></td>
                               <td><strong>{{$tax }}/-</strong></td>
                           </tr>
                           <tr>

                               <td><strong>Discount</strong></td>
                               <td><strong>{{$discount}}/-</strong></td>
                           </tr>
                           <tr>

                               <td><strong>GrandTotal</strong></td>
                               <td><strong>{{$grandTotal}}/-</strong></td>
                           </tr>
                       </table>
                   </div>


               </div>
           @else
                <p> No Data Found ! </p>
           @endif


{{--               <div class="button-custom d-flex justify-content-center">--}}
{{--                   <form action="{{route('mail', $value->invoice_number)}}" method="post">--}}
{{--                       @csrf--}}
{{--                      <button class="btn btn-lg btn-dark" type="submit"><i class="fa fa-envelope"></i>  Mail Invoice</button>--}}
{{--                   </form>--}}
{{--               </div>--}}

           </div>
       </div>
    </div>
@endsection
