@extends('layouts.app')
@section('page_title')
<span>Payment Status</span>
@endsection
@section('content')
<div class="container wrapper">
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">SL</th>
                <th class="col-md-2">Invoice Number</th>
                <th class="col-md-2">Payable</th>
                <th class="col-md-2">Payment</th>
                <th class="col-md-2">Payable Remaining</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SL</th>
                <th>Invoice Number</th>
                <th>Payable</th>
                <th>Payment</th>
                <th>Payable Remaining</th>
            </tr>
        </tfoot>
		<tbody>
			
			@foreach ($invoice_info as $i => $info)
            @php
                $remaining = $info->payable - $info->payment->sum('amount');
            @endphp
				<tr>
					<td>{{ ++$i }}</td>
					<td>{{ $info->invoice_number }}</td>
					<td>{{ $info->payable }}</td>
					<td>{{ $info->payment->sum('amount') }}</td>
					<td>{{ $remaining }}</td>
				</tr>
			@endforeach

		</tbody>
    </table>
</div>
@endsection