@extends('layouts.app')
@section('page_title')
    Invoices
@endsection

@section('content')
{{-- Table starts from here --}}
<div class="container-fluid wrapper">
    <div class="card mb-4">
        <div class="card-body pt-3 pb-3">
            <a href="{{url('admin/invoice/create')}}" class="btn btn-md btn-blue"><i class="fas fa-plus"></i> New Invoice</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table data_table table-bordered table-hover"  width="100%">
                <thead>
                    <tr>
                        <th>##</th>
                        <th >Invoice No.</th>
                        <th class="col-md-2">Total Payable Amount</th>
                        <th >Date</th>
                        <th >Due date</th>
                         @if (auth()->user()->role == 'admin')
                         <th>Customer</th>
                         @endif
                        <th >Status</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($invoices as   $invoice)
                       <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>Inv-{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->total}}</td>
                            <td>{{$invoice->date}}</td>
                            <td>{{$invoice->due_date}}</td>
                            @if (auth()->user()->role == 'admin')
                            <td>{{ $invoice->customer }}</td>
                            @endif
                            <td><span class="  btn btn-sm btn-outline-dark">{{$invoice->status}}</span></td>
                            <td>
                                  
                                <a href="{{url('admin/invoice', $invoice->invoice_number)}}" class="btn btn-sm btn-blue"><i class="fas fa-eye"></i> View</a>
                                
                                @if (auth()->user()->role == 'admin')
                                <a href="javascript:;" class="delete-invoice btn btn-sm btn-danger" data-id="{{$invoice->invoice_number}}"><i class="fas fa-eye"></i> Delete</a>
                                @endif
                                

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


<script type="text/javascript">
    $(document).ready( function (){
        $(document).on('click', '.delete-invoice', function (){
            if(!confirm('Are you sure to delete this invoice?')){
                return false;
            }
            var thisAttr = $(this)
            var id = thisAttr.data('id');
            var url = '{{ url("admin/invoice", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data:{
                    '_method':'DELETE'
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response){
                    if (response.status == 'success') {
                        toastr.success(response.message, 'Success !');
                        thisAttr.parent().parent().remove()
                    } else {
                        toastr.error(response.message, 'Error !');
                    }
                    console.log(response)
                },
                error: function(error) {
                    console.log(error)
                    toastr.error('Something went wrong !', 'Error !');
                }
            })
        })
    })
</script>
@endsection
