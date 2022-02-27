@extends('layouts.app')
@section('page_title')
<span></span>
@endsection
@section('content')
<div class="card">
  <div class="card-header">Payment</div>
  <div class="card-body">
    
    <form action="{{ route('payments.store') }}" method="post">
      @csrf

      <div class="form-row">
          <div class="form-group col-md-6">
              <label>Invoice No</label>
              @error('invoice_id')
              <span style="color:red">{{ $message }}</span>
            @enderror
              <select class="form-control" name="invoice_id">
                  <option value="">Select Invoice Number</option>
                  @forelse($invoices as $invoice)
                  <option value="{{ $invoice->id }}"> {{ $invoice->invoice_number }} </option>
                  @empty
                  @endforelse
              </select>
          </div>
          <div class="form-group col-md-6">
              <label>User Name</label>
              @error('user_id')
              <span style="color:red">{{ $message }}</span>
            @enderror
              <select class="form-control" name="user_id">
                <option value="">Select User Name</option>
                @forelse($users as $user)
                <option value="{{ $user->id }}"> {{ $user->name }} </option>
                @empty
                @endforelse
            </select>
          </div>
      </div>
      <div class="form-row">
          <div class="form-group col-md-6">
              <label>Payment Method</label>
              @error('paymentMethod_id')
              <span style="color:red">{{ $message }}</span>
            @enderror
              <select class="form-control" name="paymentMethod_id">
                <option value="">Select Payment Method</option>
                @forelse($payment_methods as $methods)
                <option value="{{ $methods->id }}"> {{ $methods->name }} </option>
                @empty
                @endforelse
            </select>
          </div>
          <div class="form-group col-md-6">
              <label>Paid Amount</label>
              @error('amount')
              <span style="color:red">{{ $message }}</span>
            @enderror
              <input type="text" class="form-control" name="amount"  value="" placeholder="">
          </div>
      </div>

   <input type="submit" class="btn btn-block btn-success" value="Submit">
  </form> 

  </div>
</div>
@stop