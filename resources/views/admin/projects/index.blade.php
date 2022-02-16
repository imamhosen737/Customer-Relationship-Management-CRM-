@extends('layouts.app')
@section('page_title')
<span>Project</span>
@endsection

@section('content')
{{-- Table starts from here --}}
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

<div class="container">
 <a href="{{url('admin/project/create')}}" class="btn btn-primary btn-lg" title="Add New project"> <i class="fa fa-plus" aria-hidden="true"></i> Add New Project
            </a>
            <br/>
            <br/>
        </div>

            <div class="container wrapper">
                <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th class="col-md-2">Name</th>
                            <th class="col-md-2">Status</th>
                            <th class="col-md-2">Discription</th>
                            <th class="col-md-2">Start date</th>
                            <th class="col-md-2">End Date</th>
                            <th class="col-md-2">Coustomer Name</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                     @foreach($contact as $item)
                     <tr>

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->discription }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->end_date }}</td>
                        <td>{{ $item->customer->company_name }}</td>
                        <td>
                           <a href="{{ url('admin/project/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                           <a href="{{ url('admin/project/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                           <form method="POST" action="{{ url('admin/project' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm('&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>




{{-- Table ends here --}}
@endsection