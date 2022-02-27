@extends('layouts.app')
@section('page_title')
<span>Payment</span>
@endsection
@section('content')
<div class="card">
  <div class="card-body">

    <form action="{{ route('payments.update', $datas->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Invoice No.</label>
                @error('invoice_id')
                <span style="color:red">{{$message}}</span>
                @enderror
                <select class="form-control" name="invoice_id">
                   
                   @forelse($invoices as $invoice)
                     @if($invoice->id == $datas->invoice_id) 
                        <option value="{{$datas->invoice_id}}" selected>{{$datas->invoice->invoice_number}}</option>
                     @else
                        <option value="{{$invoice->id}}" >{{$invoice->invoice_number}}</option>
                     @endif
                   @empty
                   @endforelse
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>User Name</label>
                @error('user_id')
                <span style="color:red">{{$message}}</span>
                @enderror

                <select class="form-control" name="user_id">  
                   @forelse($users as $user)
                     @if($user->id == $datas->user_id) 
                        <option value="{{$datas->user_id}}" selected>{{$datas->user->name}}</option>
                     @else
                        <option value="{{$user->id}}" >{{$user->name}}</option>
                     @endif
                   @empty
                   @endforelse
                </select>
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Payment Method</label>
                @error('paymentMethod_id')
                <span style="color:red">{{$message}}</span>
                @enderror 

                <select class="form-control" name="paymentMethod_id">      
                   @forelse($payment_methods as $methods)
                     @if($methods->id == $datas->name) 
                        <option value="{{$datas->name}}" selected>{{$datas->methods->name}}</option>
                     @else
                        <option value="{{$methods->id}}" >{{$methods->name}}</option>
                     @endif
                   @empty
                   @endforelse
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Paid Amount</label>
                @error('amount')
                <span style="color:red">{{$message}}</span>
                @enderror

                <input type="text" class="form-control" name="amount" value="{{($datas->amount)}}">
            </div>
        </div>

     <input type="submit" class="btn btn-block btn-primary" value="Update">
    </form> 

  </div>
</div>
@stop