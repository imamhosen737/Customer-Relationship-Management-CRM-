@extends('layouts.app')
@section('page_title')
	Create New Estimates
@endsection
@section('content')
		<form action="{{ route('estimate.store') }}" method="post">
			@csrf
			<div class="container">
			<div class="form-row mb-4">
				<div class="col">
					<label for="customer_id">Select Customer</label><br>
					<select id="customer_id" class="custom-select" name="customer_id">

						<option value="">Select Customer</option>
						@foreach ($customer as $c)
							@if (old('customer_id') == $c->id)
							<option value="{{ $c->id }}" {{ 'selected' }}>{{ $c->company_name }}</option>
							@else
							<option value="{{ $c->id }}">{{ $c->company_name }}</option>
							@endif
						@endforeach
					</select>
					
					@error('customer_id')
						<span style="color: red">{{ $message }}</span>
					@enderror
				</div>
				<div class="col">
					<label for="date">Date</label>
					<input type="date" class="form-control" name="date" placeholder="Date" value="{{ old('date') }}">
					@error('date')
					<span style="color: red">{{ $message }}</span>
				@enderror
				</div>

				<div class="col">
					<label for="due_date">Due Date</label>
					<input type="date" class="form-control" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}">
				@error('due_date')
					<span style="color: red">{{ $message }}</span>
				 @enderror
				</div>
			</div>

			<div class="form-row">

			<div class="col">
				<label for="subject">Subject</label>
				<textarea id="subject" class="form-control" name="subject" value="" placeholder="Subject" rows="5" cols="50">{{ old('subject') }}</textarea>
			@error('subject')
				<span style="color: red">{{ $message }}</span>
			@enderror
			</div>

			<div class="col">
				<label for="user_id">User</label>
				<select name="user_id[]" class="form-control" multiple size = 6>
					<option value="0">Select User</option>
					@foreach ($user as $u)
						<option value="{{ $u->id }}">{{ $u->name }}</option>
					@endforeach
				</select>
			</div>

			</div>
			</div>


			{{-- code for add item informations by ajax: --}}
			
			<div class="container wrapper mt-5">
				<label for="estimate">Item Name</label>
				<select id="estimate" class="form-control">
					<option value="">Select Item</option>
					@foreach ($itemm as $p )
					<option value="{{ $p->id }}">{{ $p->name }}</option>
					@endforeach
					
				</select>
				<table id="mytable" class=" table-bordered text-center mt-3" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th>Name</th>
						<th></th>
						<th>Rate</th>
						<th>QTY</th>
						<th>Tax</th>
						<th>Total</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table>
				<div class="col-md-12 offset-10">
				  <h2>Gross Total:</h2>
				<input type="text" class="sub_total" readonly>
				</div>
			</div>
			 

			<div class="form-row">
				<strong>&nbsp;</strong>
				<input type="submit" value="SUBMIT" class="form-control btn-primary btn-block">
			</div>
		</form>

			
			<script>

				$(document).ready(function(){
					
					$('#estimate').change(function(){

					let id = $(this).val()	
					$.ajax({
						type:"GET",
						url:"/api/get_item/"+id,
						data:{
							'id': id
						},
						dataType: "json",
						success: function(data){
							var rate= parseInt(data.rate);
							var tax= parseInt(data.tax);
							var t_rate=(rate/100)*tax;
							var total= rate+t_rate;
							let ht = "	<tr><td> " + data.name +"</td><td><input type='hidden' name='item_id[]'  type='text' value='" + data.id + "'></td><td><input class='rate' name='price[]'  type='text' value='" + data.rate + "'></td><td ><input class='qty' name='qty[]' type='text' value='1'></td><td><input type='text' class='tax' value='" + data.tax + "'></td><td ><input class='total' readonly type='text' value='"+total+"'></td><td><span  id='DeleteButton'><i class='fas fa-trash-alt'></i></span></td></tr>";
							
							$('.odd').hide();
							
							$('tbody').append(ht);
							$.fn.calculate_sub();
						}
							});

						})

						$(".table-bordered tbody").on('keyup', '.qty,.rate,.tax', function() {
                    var qty = $(this).closest('tr').find('.qty').val();
                    var rate = $(this).closest('tr').find('.rate').val();
                    var tax = $(this).closest('tr').find('.tax').val();
						var t_rate=(rate/100)*tax;
						var total= (rate*qty)+(t_rate*qty);
						$(this).closest('tr').find('.total').val(total)
						$.fn.calculate_sub();
						
						})

						$("#mytable").on("click", "#DeleteButton", function() {
                       $(this).closest("tr").remove();
					   $.fn.calculate_sub();

                        });

				$.fn.calculate_sub = function() {
                    var s = 0;
                    $(".qty").closest('tr').each(function(index, value) {
                         var ss = parseInt($(this).find('.total').val());
                         s += ss;
                         $(".sub_total").val(s);
						 
                    });
               }
						
				})
			

				
		


			</script>
		
@endsection