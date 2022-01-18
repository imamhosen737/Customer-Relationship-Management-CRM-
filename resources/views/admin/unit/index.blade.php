@extends('layouts.app')
@section('page_title')
<span>Unit</span>
@endsection

@section('content')
{{-- Table starts from here --}}
<div class="container wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    {{-- <a href="{{ route('unit.create') }}" class="btn btn-success btn-sm" title="Add New Uint">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New </a> --}}
        <thead>
            <tr>
                <th class="col-md-2">Serial</th>
                <th class="col-md-2">Unit Name</th>
                <th class="col-md-2">Action</th>
            </tr>
         
        </thead>
        <tfoot>           
           <tr></tr>
        </tfoot>
        <tbody>
       @foreach($unit as $i=>$item)
            <tr>
                <td>{{ ++$i }}</td>
                 <td>{{ $item->unit_name }}</td>
                                    
                 <td>     
                    <form action="{{ route('unit.destroy',$item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{ route('unit.edit',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>  
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                 </td>
             </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{-- Table ends here --}}
    @endsection