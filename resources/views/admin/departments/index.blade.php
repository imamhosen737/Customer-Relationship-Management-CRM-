@extends('layouts.app')
@section('page_title')
<span>Department</span>
@endsection
@section('content')
    <div class="container">
        
                <div class="card">
                    <div class="card-header">Departments</div>
                    <div class="card-body">
                        <a href="{{url('admin/department/create')}}" class="btn btn-primary" title="Add New Department">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>

                       @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                      <p>{{ $message }}</p>
                      </div>
                         @endif


                <div class="container wrapper">
                  <table class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                             <tr>
                          <th class="col-md-2">#</th>
                          <th class="col-md-2">Name</th>
                          <th class="col-md-2">Actions</th>

                          </tr>
                       </thead>
                         <tbody>
                                @foreach($contacts as $key=>$item)
                                @if ($key!=0)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ url('admin/department/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{ url('admin/department' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                    
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- </div>
        </div> --}}
    </div>
@endsection