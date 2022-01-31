
@extends('layouts.app')
@section('page_title')
{{-- <span>Update department</span> --}}
@endsection
@section('content')
    <div class="container">
        
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/proposal/create') }}" class="btn btn-primary" title="Add New department">  
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Proposal
                        </a>
                        <br/>
                        <br/>

                       @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                      <p>{{ $message }}</p>
                      </div>
                         @endif

                <div class="container wrapper">
                        <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th class="">#</th>
                            <th class="col-md-2">User Name</th>
                            <th class="col-md-2">Subject</th>
                            <th class="col-md-2">Date</th>
                            <th class="col-md-2">Due_Date</th>
                            <th class="col-md-2">Status</th>
                             <th class="col-md-2">Actions</th>
                            </tr>
                        </thead>
                                <tbody>
                                @foreach($contacts as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->customers->company_name}}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->due_date }}</td>
                                         <td>sent</td>
                                        {{-- <td style=" color:@php if($item->status=='sent'){ echo 'yellow'; }elseif($item->status=='acceptd'){echo 'green';}else{echo 'red';}@endphp;">{{ $item->status }}</td> --}}
                                        
                                        <td>
                                            <a href="{{ url('admin/proposal/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="far fa-eye"></i></button></a>
                                            <a href="{{ url('admin/proposal/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i></button></a>
                                            <form method="POST" action="{{ url('admin/proposal' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"> <i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                             @endforeach
                          </tbody>
                     </table>
                </div>
             </div>
        </div>
    </div>
@endsection