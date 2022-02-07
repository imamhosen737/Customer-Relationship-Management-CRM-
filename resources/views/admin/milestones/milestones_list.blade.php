@extends('layouts.app')
@section('page_title_extra')
    <div class="d-flex  justify-content-between">
        <h1 class="m-0">Milestone List</h1>

        @if ($projectId)

            <a href="{{ url('admin/project', $projectId) }}" class="btn btn-lg btn-blue">
                <i class="fas fa-plus"></i>
                Back to Project
            </a>
        @endif
        
    </div>
@endsection




@section('content')
    <div class="container-fluid wrapper">
    <div class="card mb-2">
       <div class="card-body">
            <a href="{{ route('milestones.milestones_create', $projectId) }}" class="btn btn-lg btn-blue">Add
                    Milestone</a>
       </div>    
    </div>


       <div class="card">
            <div class="card-body">

                <table class="table data_table table-bordered table-hover"  cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="col-md-2">Project Name </th>
                            <th class="col-md-2">Name</th>
                            <th class="col-md-2">End_date</th>
                            <th class="col-md-2">Description</th>
                            <th class="col-md-2">Ordering</th>
                            @if (auth()->user()->role  == 'admin')
                                <th class="col-md-2">Visible_to_customer </th>
                            @endif

                            <th class="col-md-2">Status </th>
                            <th class="col-md-2">Action </th>
                        </tr>
                    </thead>

                    
                    <tbody>

                       @if ( auth()->user()->role  == 'customer' )
                           @forelse ($datas as $key => $value)

                            @if ($value->visible_to_customer == 'yes')
                                <tr>
                                    <td>{{ $value->project->name }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->end_date }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->ordering }}</td>
                                    {{-- <td>{{ $value->visible_to_customer }}</td> --}}
                                    <td>
                                       @if($value->status  == 'active')
                                            <span style="color:green;font-weight:bolder">Active</span>
                                       @else
                                            <span style="color:red;font-weight:bolder">Inactive</span>                                            
                                       @endif
                                    </td>
                                    <td>
                                        <form
                                            action="{{ url('admin/project/' . $projectId . '/milestones') }}/{{ $value->id }}"
                                            method="post">
                                            <a href="{{ url('admin/project/' . $projectId . '/milestones/' . $value->id . '/edit') }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are You Sure?')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif


                        @empty

                        @endforelse

                        @else
                          @forelse ($datas as $key=>$value)
                               <tr>
                                    <td>{{ $value->project->name }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->end_date }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->ordering }}</td>
                                    <td>{{ $value->visible_to_customer }}</td>
                                    <td>
                                       @if($value->status  == 'active')
                                            <span style="color:green;font-weight:bolder">Active</span>
                                        @else
                                            <span style="color:red;font-weight:bolder">Inactive</span>  
                                       @endif
                                    </td>
                                    <td>
                                        <form
                                            action="{{ url('admin/project/' . $projectId . '/milestones') }}/{{ $value->id }}"
                                            method="post">
                                            <a href="{{ url('admin/project/' . $projectId . '/milestones/' . $value->id . '/edit') }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are You Sure?')"><i
                                                    class="fas fa-trash"></i></button>
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
@endsection
