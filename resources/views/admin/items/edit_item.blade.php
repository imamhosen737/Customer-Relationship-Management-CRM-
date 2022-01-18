@extends('layouts.app')
@section('page_title')
	<span>Update Item</span>
@endsection
@section('content')
	<form action="{{ route('item.update',$data->id) }}" method="post">
		@csrf
		@method('PUT')
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" value="@if (old($data->name)){{ old($data->name)}}@else{{ $data->name }}@endif" placeholder="Item Name">
				<span style="color: red">@error('name'){{ $message }}</span>@enderror
			</div>
			<div class="form-group col-md-6">
				<label for="rate">Rate</label>
				{{-- <input type="text" name="rate" class="form-control" placeholder="Rate" value="@if (old($data->rate)){{ old($data->rate) }}@else{{ $data->rate }}@endif"> --}}
				<input type="text" name="rate" class="form-control" placeholder="Rate" value="{{ old('rate',$data->rate) }}">
				<span style="color: red">@error('rate'){{ $message }}</span>@enderror
			</div>	
		</div>

		<div class="form-row">

			<div class="form-group col-md-6">
				<label for="tax_id">Tax Rule</label><br>
				<span style="color: red">@error('tax_id'){{ $message }}</span>@enderror
				<select id="tax_id" class="custom-select" name="tax_id">
					<option disabled value="">Select Rule</option>
					@foreach ($tax as $t)
							@if (old('tax_id') == $t->id)
							<option value="{{ $t->id }}" @if ($data->tax->rules == $t->rules) {{ 'selected' }}	
								@endif>{{ $t->rules }}</option>
							@else
							<option value="{{ $t->id }}" @if ($data->tax->rules == $t->rules) {{ 'selected' }}	
								@endif>{{ $t->rules }}</option>
							@endif
							@endforeach
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="unit_id">Unit Name</label><br>
				<span style="color: red">@error('unit_id'){{ $message }}</span>@enderror
				<select id="unit_id" class="custom-select" name="unit_id">
					<option disabled value="">Select Unit</option>

		        	@foreach ($unit as $u)
							@if (old('unit_id') == $u->id)
							<option value="{{ $u->id }}" @if ($data->unit->unit_name == $u->unit_name) {{ 'selected' }}	
								@endif>{{ $u->unit_name }}</option>
							@else
							<option value="{{ $u->id }}" @if ($data->unit->unit_name == $u->unit_name) {{ 'selected' }}	
								@endif>{{ $u->unit_name }}</option>
							@endif
							
							@endforeach
				</select>
			</div>

		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="desc">Description</label>
             <textarea id="desc" class="form-control" name="description" value="" placeholder="Description">@if ( old($data->description)) {{ old($data->description) }} @else{{ $data->description }}@endif</textarea>
			 <span style="color: red">@error('description'){{ $message }}</span>@enderror
			</div>
		</div>

		<div class="form-row">
		

			<div class="form-group col-md-12">
				<strong>&nbsp;</strong>
				<input type="submit" value="Save" class="btn btn-primary btn-block">
			</div>
		</div>
	</form>
@endsection