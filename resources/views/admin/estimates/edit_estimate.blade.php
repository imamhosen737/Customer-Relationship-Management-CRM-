@extends('layouts.app')
@section('page_title')
	Update Estimate
@endsection
@section('content')
<form action="{{ route('estimate.update',$data->id) }}" method="post">
	@method('PUT')
	@csrf

	<div class="form-row mb-4">
		<div class="col">
			<label for="customer_id">Select Customer</label><br>
			<select id="customer_id" class="custom-select" name="customer_id">

				<option value="">Select Customer</option>
			
				@foreach ($customer as $c)
				@if (old('customer_id')==$c->id)
	  
				<option value="{{$c->id}}" @if ($data->customer->company_name == $c->company_name) {{'selected'}} @endif>{{ $c->company_name}}</option>
				@else
				<option value="{{ $c->id }}" @if ($data->customer->company_name == $c->company_name) {{ 'selected' }} 
				  @endif>{{ $c->company_name }}</option>
				  @endif
				  @endforeach
			</select>
			@error('customer_id')
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
		<div class="col">
			<label for="date">Date</label>
			<input type="date" class="form-control" name="date" placeholder="Date" value="@if (old($data->date)){{ old($data->date) }}@else{{ $data->date }}@endif">
			@error('date')
			<span style="color: red">{{ $message }}</span>
		@enderror
		</div>

		<div class="col">
			<label for="due_date">Due Date</label>
			<input type="date" class="form-control" name="due_date" value="@if (old($data->due_date)){{ old($data->due_date) }}@else{{ $data->due_date }}@endif">
		@error('due_date')
			<span style="color: red">{{ $message }}</span>
		 @enderror
		</div>
	</div>
	<div class="form-row">
		{{-- <div class="form-group col-md-6 pt-4"> --}}
		{{-- <div class="form-check form-check-inline"> --}}
			{{-- <input class="form-check-input" type="radio" name="status" value="sent"{{ old('status')=='sent'? 'checked':'' }}  > --}}
			{{-- <input class="form-check-input" type="radio" name="status" value="sent"{{ old('status',$data->status) == 'sent' ? 'checked' : '' }}>
			<label class="form-check-label" for="sent">
				Pending
			</label>
		</div>
		 --}}
		{{-- <div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" value="accepted" {{ old('status',$data->status)=='accepted'? 'checked':'' }} >
			<label class="form-check-label" for="accepted">
				Accepted
			</label>
		</div> --}}
		{{-- <div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" value="declined" {{ old('status',$data->status)=='declined'? 'checked':'' }} >
			<label class="form-check-label" for="declined">
				Declined
			</label>
		</div> --}}
	{{-- </div> --}}


	

	<div class="col">
		<label for="subject">Subject</label>
		<textarea id="subject" class="form-control" name="subject" value="" rows="5" cols="50">@if (old($data->subject)){{ old($data->subject) }}@else{{ $data->subject }}@endif</textarea>
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
	


	<div class="form-row">
		<strong>&nbsp;</strong>
		<input type="submit" value="SUBMIT" class="form-control btn-primary btn-block">
	</div>
</form>
@endsection