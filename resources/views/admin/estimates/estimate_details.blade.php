@extends('layouts.app')
@section('page_title')
	 Estimate Informations
@endsection
@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="jumbotron">
			<i class="fas fa-user fa-3x"></i>
			 <hr class="my-4">
			 <span class="text-success">Customer Name</span>
			<h3>{{ $data->customer->company_name}}</h3>
		</div>
	</div>

	<div class="col-md-4">
		<div class="jumbotron">
			<i class="fas fa-sticky-note fa-3x"></i>
			 <hr class="my-4">
			 <span class="text-success">Subject</span>
			<h3>{{ $data->subject}}</h3>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="jumbotron">
			<i class="fas fa-calendar-alt fa-3x"></i>
			 <hr class="my-4">
			 <span class="text-success">Date</span>
			<h3>{{ $data->date }}</h3>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="jumbotron">
			<i class="fas fa-calendar-alt fa-3x"></i>
			 <hr class="my-4">
			 <span class="text-success">Due Date</span>
			<h3>{{ $data->due_date }}</h3>
		</div>
	</div>
	<div class="col-md-4">
		<div class="jumbotron">
			<i class="fas fa-battery-empty fa-3x"></i>
			 <hr class="my-4">
			 <span class="text-success">Status</span>
			<h3>{{ $data->status }}</h3>
		</div>
	</div>
</div>


 <!-- item info -->
 <div class="row">
	<div class="col-md-7">
		<div class="jumbotron">
			<h2 class="text-success">Items Information</h2>
			<hr class="my-4">
			<table class="table table-borderless">
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
					$i=0;  
					$sub =0;
					$tax=0;
					$totalSum =0;
					@endphp

					 @foreach ($est_item as $item)
					 @php
						 $sub += $item->price*$item->qty;
						 $taxFix = $item->Item->tax->rules ?? 0;

						 $tax += ($item->price*$item->qty) * $taxFix/100;

						 $totalSum += ($item->price*$item->qty) + ($item->price*$item->qty) * $taxFix/100;
					 @endphp
					 
				<tr>
					<td>{{++$i;}}</td>
					<td>{{ $item->item->name }}</td>
					<td>{{ $item->Item->unit->unit_name }}</td>
					<td>{{$item->Item->tax->rules ?? '0'}}</td>
					<td>{{ $item->price }}</td>
					<td>{{ $item->qty }}</td>
					<td>{{ $item->price*$item->qty }}</td>
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
		  </div>
	   </div>

	<div class="col-md-5">
		<div class="card">
			<div class="card-header d-flex">
				<i style="margin-right: 5px" class="fas fa-book fa-2x "></i>
				<h4>Summery</h4><br></div>
				<div>
					  
		   
				</div>
		</div>
	</div>

</div>

@endsection