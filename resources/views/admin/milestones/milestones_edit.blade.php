@extends('layouts.app')
@section('page_title')
    <span>Update Milestone</span>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('milestones.update', $Milestones->id) }}" method="post">

                @csrf
                {{ method_field('PUT') }}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="project_name" class="form-label">Select Project</label>
                        <select class="form-control" name="project_id" id="project_name">
                            <option value="">Select Project</option>
                            @foreach ($project_data as $project)
                                <option value="{{ $project->id }}"
                                    {{ $project->id == $Milestones->project_id ? 'selected' : '' }}>{{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="milestone_name" class="form-label">Milestones name</label>
                        <input type="text" name='name' value="{{ $Milestones->name }}" class="form-control"
                            id="milestone_name">
                        <input type="hidden" name="milestone_id" value="{{ $Milestones->id }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date" class="form-label">Start Date</label>
                        <input type="date" name='start_date' value="{{ $Milestones->start_date }}" class="form-control"
                            id="start_date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name='end_date' value="{{ $Milestones->end_date }}" class="form-control"
                            id="end_date">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30"
                            rows="5">{{ $Milestones->description }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ordering" class="form-label">Ordering</label>
                        <input type="text" name='ordering' value="{{ $Milestones->ordering }}" class="form-control"
                            id="ordering">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="active" {{ $Milestones->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $Milestones->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="visible" class="form-label  mr-2">Visible To Customer?</label>
                        <input type="checkbox" id="" name="visible_to_customer">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>

@endsection
