@extends('layouts.app')

@section('page_title_extra')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
            {{-- <li class="breadcrumb-item active" aria-current="page">Users</li> --}}
        {{-- </ol> --}}
    {{-- </nav> --}} 
    <h1 class="m-0"><span>Users</span></h1>
    <a class="float-right btn btn-blue btn-create-user" href="javascript:;" style="font-size: 18px;"> <i class="fa fa-plus"></i> Create </a>
    <a class="float-right btn btn-danger btn-create-cancel-user" href="javascript:;" style="font-size: 18px; display: none;"> <i class="fa fa-times"></i> Cancel </a>
@endsection

@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success  alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    @if (session('status'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> {{ session('status') }} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
   @endif
</div>


{{-- Table starts from here --}}
<div class="container wrapper table-responsive">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="create-user" style="display: none;">
                        @include('admin.users.create')
                    </div>

                    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th  >##</th>
                                <th  >Name</th>
                                <th  >Email</th>
                                <th  >Role</th>
                                <th  >Status</th>
                                <th  >Department Name</th>
                                <th  >Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  >##</th>
                                <th  >Name</th>
                                <th  >Email</th>
                                <th  >Role</th>
                                <th  >Status</th>
                                <th  >Department Name</th>
                                <th  >Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as  $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td class="highlight">{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    @if ($user->status == 'active')
                                    <span style="color: green; font-weight:bold">{{$user->status}}</span>
                                    @else
                                    <span style="color: red; font-weight:bold">{{$user->status}}</span>
                                    @endif
                                </td>
                                <td>{{$user->departments->name}}</td>
                                <td>
                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-blue">Edit</a>
                                    <a href="javascript:void()" class="delete-user btn btn-sm btn-danger" data-id="{{$user->id}}">Delete</a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
{{-- Table ends here --}}

<script type="text/javascript">
    $(document).ready( function() {

        $(".btn-create-user").on('click', function() {
            $(".create-user").show();
            $(this).hide().next().show();
        });

        $(".btn-create-cancel-user").on('click', function() {
            $(".create-user").hide();
            $(this).hide().prev().show();
        });

        $(".delete-user").on('click', function() {
            if (!confirm('Do you want to delete ?')) {
                return false
            }
            var thisAttr = $(this)
            var id = thisAttr.data('id');
            var url = '{{ route("users.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'DELETE'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message, 'Success !');
                        thisAttr.parent().parent().remove()
                    } else {
                        toastr.error(response.message, 'Error !');
                    }
                },
                error: function(error) {
                    console.log(error)
                    toastr.error('Something went wrong !', 'Error !');
                }
            })
        });

    });
</script>

@endsection
