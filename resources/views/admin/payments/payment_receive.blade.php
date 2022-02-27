@extends('layouts.app')
@section('page_title')
<span>Payment Receives</span>
@endsection

@section('content')
{{-- Table starts from here --}}
<div class="form-group">
    
    <a href="{{ route('payments.create') }}" class="btn btn-success btn-sm" title="Add New Payment">
        <i class="fa fa-plus" aria-hidden="true"></i> Add New </a>
   
</div>
<div class="container-fluid wrapper">
    <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="col-md-1">Serial</th>
                        <th class="col-md-2">Invoice No.</th>
                        <th class="col-md-3">User Name</th>
                        <th class="col-md-3">Payment Method</th>
                        <th class="col-md-3">Paid Amount</th>
                        <th class="col-md-2">Action</th>
                    </tr>         
               </thead>
               <tfoot>           
                  <tr></tr>
               </tfoot>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @forelse($datas as $payment)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $payment->invoice->invoice_number }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->paymentMethod->name }}</td>
                        <td>{{ $payment->amount }}</td>

                        <td>     
                            <form action="{{ route('payments.destroy',$payment->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <a href="{{ route('payments.edit',$payment->id) }}" class="btn btn-primary btn-sm">Edit</a>  
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                         
                     </tr>
                     @empty
                @endforelse
                   
               </tbody>
         </table>
      </div>
   </div>
</div>
{{-- Table ends here --}}
@endsection