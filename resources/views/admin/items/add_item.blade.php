@extends('layouts.app')
@section('page_title')
	<span>Add New Item</span>
@endsection
@section('content')
	<form action="{{ route('item.store') }}" method="POST">
		@csrf
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Item Name">
				<span style="color: red">@error('name'){{ $message }}</span>@enderror
			</div>
			<div class="form-group col-md-6">
				<label for="rate">Rate</label>
				<input type="text" name="rate" class="form-control" placeholder="Rate" value="{{ old('rate') }}">
				<span style="color: red">@error('rate'){{ $message }}</span>@enderror
			</div>	
		</div>

		<div class="form-row">
		
			<div class="form-group col-md-6">
				<label for="tax_id">Tax Rule</label><br>
				<span style="color: red">@error('tax_id'){{ $message }}</span>@enderror
				<select id="tax_id" class="custom-select" name="tax_id">
					<option disabled value="">Select Rule</option>
					@foreach ($tax as $t )
					 @if (old('tax_id')==$t->id)
					<option value="{{ $t->id }}" {{ 'selected' }}>{{ $t->rules }}</option>
						@else
					 <option value="{{ $t->id }}">{{ $t->rules }}</option>
						@endif
					 @endforeach
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="unit_id">Unit Name</label><br>
				<span style="color: red">@error('unit_id'){{ $message }}</span>@enderror
				<select id="unit_id" class="custom-select" name="unit_id">
					<option disabled value="">Select Unit</option>

		        	@foreach ($unit as $u )
							@if (old('unit_id') == $u->id)
							<option value="{{ $u->id }}" {{ "selected" }}>{{ $u->unit_name }}</option>
							@else
							<option value="{{ $u->id }}">{{ $u->unit_name }}</option>
							@endif
						@endforeach
				</select>
			</div>

		</div>

		<div class="form-row">
			
			<div class="form-group col-md-12">
				<label for="desc">Description</label>
             <textarea id="desc" class="form-control" name="description" value="" placeholder="Description">{{ old('description') }}</textarea>
			 <span style="color: red">@error('description'){{ $message }}</span>@enderror
			</div>
		</div>

		<div class="form-row">
	

			{{-- Datalis code --}}
    {{-- <div class="form-group col-md-6">
		<label for="unit_id">Unit Name</label><br>
				<span style="color: red">@error('unit_id'){{ $message }}</span>@enderror
        <input type="text" list="unit_id" value="" name="unit_id" class="custom-select">
        <datalist id="unit_id">
            <option value="">Select</option>
            @foreach ($unit as $u )
				@if (old('unit_id') == $u->id)
					<option value="{{ $u->id }}" {{ "selected" }}>{{ $u->unit_name }}</option>
					@else
					<option value="{{ $u->id }}">{{ $u->unit_name }}</option>
				@endif
				@endforeach
        </datalist>
    </div> --}}

			<div class="form-group col-md-12">
				<strong>&nbsp;&nbsp;</strong>
				<input type="submit" value="Save" class="btn btn-primary btn-block">
			</div>
		</div>
	</form>
@endsection