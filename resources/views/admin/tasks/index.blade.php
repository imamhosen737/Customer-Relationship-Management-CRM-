@extends('layouts.app')
@section('page_title_extra')

<div class="d-flex  justify-content-between">
    <span>Tasks List</span>


    @if ($projectId)

    <a href="{{ url('admin/project', $projectId) }}" class="btn btn-lg btn-primary">
        <i class="fas fa-plus"></i>
        Back to Project
    @endif

    </a>
</div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif


{{-- Table starts from here --}}
<div class="container wrapper">
	<div class="card">
       <div class="card-body">
	<a href="{{ route('tasks.create', $projectId)}}" class="btn btn-lg btn-primary">Add New Tasks</a><hr>
	<table class="table table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr>
                <th class="col-md-2">id</th>
				<th class="col-md-2">Project Name</th>
				<th class="col-md-2">Subject</th>
				<th class="col-md-2">Status</th>
				<th class="col-md-2">Description</th>
				<th class="col-md-2">Start Date</th>
				<th class="col-md-2">End date</th>
				<th class="col-md-2">Priority</th>
				<!-- <th class="col-md-2">Visible_to_customer</th>  -->
				<th class="col-md-2">Action</th>
			</tr>
		</thead>

		<tbody>
           @if(auth()->user()->role == 'customer')
               @forelse ($datas as $key => $value)

                            @if ($value->visible_to_customer == 'yes')
                                <tr>
                                    <td class="highlight">{{ $value->project_id }}</td>
                                    <td class="highlight">{{ $value->project->name }}</td>
                                    <td class="highlight">{{ $value->subject }}</td>
                                    <td class="highlight">{{ $value->status }}</td>
                                    <td class="highlight">{!! $value->description !!}</td>
                                    <td class="highlight">{{ $value->start_date }}</td>
                                    <td class="highlight">{{ $value->end_date }}</td>
                                    <td class="highlight">{{ $value->priority }}</td>
                                    <!-- <td class="highlight">{{ $value->visible_to_customer }}</td> -->

                                    <td>
                                        <form  action="{{url('admin/project/'.$projectId.'/tasks') }}/{{$value->id}}"
                                        method="post">

                                            <a href="{{url('admin/project/'.$projectId.'/tasks/'.$value->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>

                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete tasks" onclick="return confirm('Are You sure to delete this?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif


                @empty
                @endforelse


            @else
               @forelse ($datas as $key => $value)
			<tr>

                <td class="highlight">{{ $value->project_id }}</td>
				 <td class="highlight">{{ $value->project->name }}</td>
				<td class="highlight">{{ $value->subject }}</td>
				<td class="highlight">{{ $value->status }}</td>
				<td class="highlight">{!! $value->description !!}</td>
				<td class="highlight">{{ $value->start_date }}</td>
				<td class="highlight">{{ $value->end_date }}</td>
				<td class="highlight">{{ $value->priority }}</td>
				<!-- <td class="highlight">{{ $value->visible_to_customer }}</td> -->

				<td>
					<form  action="{{url('admin/project/'.$projectId.'/tasks') }}/{{$value->id}}"
					method="post">

						<a href="{{url('admin/project/'.$projectId.'/tasks/'.$value->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>

						{{ method_field('DELETE') }}
						{{ csrf_field() }}


						<button type="submit" class="btn btn-sm btn-danger" title="Delete tasks" onclick="return confirm('Are You sure to delete this?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
					</form>
				</td>
			</tr>
			@empty
			@endforelse
        @endif


		</tbody>
	</table>
</div>
</div>
</div>
{{-- Table ends here --}}
@endsection
