@extends('layouts.app')
@section('page_title')
<span>Tasks</span>
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
	
       <a href="{{ route('tasks.create', $projectId)}}"class="btn btn-lg btn-primary">Add New Tasks</a><hr>
		<table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr>
				
				<th class="col-md-2">##</th>
				<th class="col-md-2">Project Name</th>
				<th class="col-md-2">User Name</th>
				<th class="col-md-2">Milestone Name</th>
				<th class="col-md-2">Subject</th>
				<th class="col-md-2">Duration</th>
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
		@forelse ($datas as $key => $value)
			
                
       @if ($value->visible_to_customer == 'yes')
              
			
			<tr>
				<td>{{ $key+1 }}</td>
				<td class="highlight">{{ $value->project->name }}</td> 
				<td class="highlight">{{ $value->User->name }}</td> 
				<td class="highlight">{{ $value->Milestones->name }}</td> 
				<td class="highlight">{{ $value->subject }}</td>
				<td class="highlight">{{ $value->duration }}</td>
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
		</tbody>
	</table>

</div>
{{-- Table ends here --}}
@endsection