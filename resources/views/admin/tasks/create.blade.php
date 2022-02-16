    @extends('layouts.app')
    @section('page_title')
        <span>Create Tasks</span>
    @endsection
    @section('content')


        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif



        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif




        <div class="card">
            <div class="card-header">
                <a href="{{ url('admin/project', $projectId) }}" class="btn btn-lg btn-info">Back to tasks</a>
            </div>

            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="post">

                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="project_name"> Select Project</label><br>
                            <select class="form-control" name="project_id" id="project_name">
                                <option value="0">Select Project</option>
                                @forelse ($project_data as $data )
                                    @if (old('project_id') == $data->id)
                                        <option value="{{ $data->id }}" {{ 'selected' }}>
                                            {{ $data->name }}</option>

                                    @else
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endif
                                @empty

                                @endforelse
                            </select>
                        </div>


                        <div class="form-group col-md-2">
                            <label for="user_name"> Select User</label><br>
                            <select class="form-control" name="user_id" id="user_name">
                                <option value="0">Select User</option>
                                @forelse ($User_data as $tata )
                                    @if (old('user_id') == $tata->id)
                                        <option value="{{ $tata->id }}" {{ 'selected' }}>
                                            {{ $tata->name }}</option>
                                    @else
                                        <option value="{{ $tata->id }}">{{ $tata->name }}</option>
                                    @endif
                                @empty

                                @endforelse
                            </select>

                        </div>

                        <div class="form-group col-md-2">
                            <label for="milestone_name"> Select Milestone</label><br>
                            <select class="form-control" name="milestone_id" id="milestone_name">
                                <option value="0">Select Milestone</option>
                                @forelse ($Milestone_data as $m )
                                    @if (old('milestone_id') == $m->id)
                                        <option value="{{ $m->id }}" {{ 'selected' }}>
                                            {{ $m->name }}</option>
                                    @else
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endif
                                @empty

                                @endforelse
                            </select>
                            @error('milestone_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                value="{{ old('subject') }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" name="duration" id="duration" placeholder="duration"
                                value="{{ old('duration') }}">
                        </div>

                        <!-- {{ old('status') }} -->
                        <div class="form-group col-md-2">
                            <label for="status">Status</label>

                            <select name="status" id="status" class="custom-select">


                                <option value="pending" @if (old('status') == 'pending'){{ 'selected' }} @endif>pending</option>

                                <option value="in_progress" @if (old('status') == 'in_progress'){{ 'selected' }} @endif>in_progress</option>

                                <option value="testing" @if (old('status') == 'testing'){{ 'selected' }} @endif>testing</option>

                                <option value="feedback" @if (old('status') == 'feedback'){{ 'selected' }} @endif>feedback</option>

                                <option value="complete" @if (old('status') == 'complete'){{ 'selected' }} @endif>complete</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description" class="form-label"> Description</label>
                            <textarea id="desc" class="form-control ckEditor" style="height: 300px;" name="description"
                                placeholder="Description">{{ old('description') }}</textarea>
                        </div>


                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name='start_date' class="form-control" id="start_date"
                                value="{{ old('start_date') }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name='end_date' class="form-control" id="end_date"
                                value="{{ old('end_date') }}">
                        </div>

                        <!-- {{ old('priority') }} -->
                        <div class="form-group col-md-4">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="custom-select">

                                <option value="low" @if (old('priority') == 'low'){{ 'selected' }} @endif>Low</option>
                                <option value="medium" @if (old('priority') == 'medium'){{ 'selected' }} @endif>Medium</option>

                                <option value="high" @if (old('priority') == 'high'){{ 'selected' }} @endif>High</option>


                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="visible" class="form-label  mr-2">Visible To Customer</label>
                            <input type="checkbox" name="visible_to_customer" id="">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-block btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>



    @endsection
