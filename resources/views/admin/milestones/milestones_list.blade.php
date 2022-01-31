@extends('layouts.app')
@section('page_title__extra')

    <div class="d-flex  justify-content-between">
        <span>Milestone List</span>

        @if ($projectId)

            <a href="{{ url('admin/project', $projectId) }}" class="btn btn-lg btn-info">
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

    <div class="container-fluid wrapper">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('milestones.milestones_create', $projectId) }}" class="btn btn-lg btn-info">Add
                    Milestone</a>
                <hr>

                <table class="table table-bordered table-hover" id="milestone" cellspacing="0" width="100%">

                    <thead>
                        <tr>
                            <th class="col-md-2">Project Name </th>
                            <th class="col-md-2">Name</th>
                            <th class="col-md-2">End_date</th>
                            <th class="col-md-2">Description</th>
                            <th class="col-md-2">Ordering</th>
                            {{-- <th class="col-md-2">Visible_to_customer </th> --}}
                            <th class="col-md-2">Status </th>
                            <th class="col-md-2">Action </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($datas as $key => $value)

                            @if ($value->visible_to_customer == 'yes')
                                <tr>
                                    <td>{{ $value->project->name }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->end_date }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->ordering }}</td>
                                    <td>{{ $value->visible_to_customer }}</td>
                                    <td>{{ $value->status }}</td>
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

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
