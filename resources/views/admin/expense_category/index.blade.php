@extends('layouts.app')
@section('page_title')
<span>Expense Category</span>
@endsection
@section('content')
{{-- Table starts from here --}}
<div class="container wrapper">
	<table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="col-md-2">SL</th>
				<th class="col-md-2">Name</th>
				<th class="col-md-2">Action</th>
			</tr>
		</thead>
		<tfoot>
	
		</tfoot>
		<tbody>
			@forelse ($expense as $key=> $expense_value)
			<tr>
				<td>{{ $key+1 }}</td>
				<td class="highlight">{{ $expense_value->name }}</td>
				<td>
					<a href="{{ route('expensecat.edit',$expense_value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>

					<form method="POST" action="{{route('expensecat.destroy',$expense_value->id) }}" accept-charset="UTF-8" style="display:inline">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}


						<button type="submit" class="btn btn-danger btn-sm" title="Delete expensecat" onclick="return confirm('Are You sure to delete this?')"><i class="fa fa-trash"></i></button>
					</form>
				</td>
			</tr>
			@empty
			@endforelse
		</tbody>
	</table>
</div>
{{-- Table ends here --}}
@endsection