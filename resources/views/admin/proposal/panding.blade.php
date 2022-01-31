@extends('layouts.app')
@section('page_title')
	<span>PENDING PROPOSALS</span>
@endsection
@section('content')
<div class="container wrapper">
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">SL</th>
                <th class="col-md-2">Customer</th>
                <th class="col-md-2">Subject</th>
                <th class="col-md-2">Date</th>
                <th class="col-md-2">Due Date</th>
                <th class="col-md-2">Signature</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SL</th>
                <th>Customer</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Due Date</th>
                <th>Signature</th>
            </tr>
        </tfoot>
        <tbody>
			@foreach ($data as $k=>$d )
		
			<tr>
				<td>{{ ++$k }}</td>
				<td>{{ $d->customer->company_name }}</td>
				<td>{{ $d->subject }}</td>
				<td>{{ $d->date }}</td>
				<td>{{ $d->due_date }}</td>
				<td>{{ $d->sign }}</td>
			</tr>
			@endforeach
        </tbody>
    </table>
</div>
{{-- Table ends here --}}
@endsection
	
