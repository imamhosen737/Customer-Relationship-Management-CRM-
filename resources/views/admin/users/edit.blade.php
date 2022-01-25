@extends('layouts.app')
@section('page_title')
Edit User
@endsection

@section('content')
@if ($errors->any())

  @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> @php  echo $error; @endphp </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endforeach

@endif


@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> {{ session('success') }} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('users.update', $user->id)}}" method="post">

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">Name</label>
            <input type="text" class="form-control"  name="name" id="name" value="{{$user->name}}" placeholder="Name">
            <input type="hidden" name="user_id" value="{{$user->id}}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="status">Status</label><br>
            <select id="status" class="custom-select" name="status">
                @if ($user->status == 'active')
                  <option value="active" selected>Active</option>
                  @else
                  <option value="inactive">Inactive</option>
                @endif
            </select>
        </div>

         <div class="form-group col-md-6">
            <label for="dpt_id">Department Name</label><br>
            <select id="dpt_id"  class="custom-select" name="department_id">
               @forelse ($departments as $department)
                  @if ($department->id == $user->department_id)
                    <option value="{{ $department->id }}" selected>{{ $department->name }}</option>

                    @else
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                  @endif
               @empty

               @endforelse


            </select>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <select id="role" class="custom-select" hidden name="role">
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
            </select>
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-block btn-primary" value="Submit">
        </div>
    </div>

</form>
@endsection
