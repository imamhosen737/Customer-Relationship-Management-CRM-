@extends('layouts.app')
@section('page_title')
	<span>Items</span>
@endsection
@section('content')

	{{-- Table starts from here --}}
<div class="container wrapper">
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">SL</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-2">Description</th>
                <th class="col-md-2">Rate</th>
                <th class="col-md-2">Tax</th>
                <th class="col-md-2">Unit</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Description</th>
                <th>Rate</th>
                <th>Tax</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
			@foreach ($data as $i=>$item_data)
            <tr>
				<td>{{ ++$i }}</td>
				<td class="highlight">{{ $item_data->name }}</td>
				<td>{{ $item_data->description }}</td>
				<td>{{ $item_data->rate }}</td>
				<td>{{ $item_data->tax->rules  }}</td>
				<td>{{ $item_data->unit->unit_name }}</td>
				<td>
					<form action="{{ route('item.destroy',$item_data->id) }}" method="post" id="delete{{$item_data->id}}">
						@csrf
						@method('delete')
					<a href="{{ route('item.edit',$item_data->id) }}"  class="text-success mr-2"><i class="fas fa-edit"></i></a>
					{{-- <button class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button> --}}
                    <a title="delete" onclick="document.getElementById('delete{{$item_data->id}}').submit()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
				</form>
				</td>
            </tr>
			@endforeach

        </tbody>
    </table>
</div>
{{-- Table ends here --}}
	
@endsection