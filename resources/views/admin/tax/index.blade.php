@extends('layouts.app')
@section('page_title')
<span>Tax Info</span>
@endsection

@section('content')

@if (session('delete'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session('delete')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
  </div>
@endif
{{-- Table starts from here --}}
<div class="container wrapper">

{{-- <a href="{{ route('tax.create') }}" class="btn btn-sm btn-success">Add</a> --}}
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">Serial</th>
                <th class="col-md-2">Tax Rule Name</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tfoot>           
           <tr>
                <th class="col-md-2">Serial</th>
                <th class="col-md-2">Tax Rule Name</th>
                <th class="col-md-2"></th>
            </tr>
        </tfoot>
        <tbody>
        @forelse ($datas as $key => $value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->rules}}</td>
                <td>
                <form action="{{ route('tax.destroy',$value->id) }}" method="post">
                      <a href="{{ route ('tax.edit',$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    
                        @csrf
                        @method('delete')
                    
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')">Delete</button>
                </form>                  
                </td>                
            </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</div>
{{-- Table ends here --}}
    @endsection