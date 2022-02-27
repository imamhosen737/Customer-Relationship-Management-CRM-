    @extends('layouts.app')
    @section('page_title__extra')

    <div class="d-flex  justify-content-between">
        <span>timesheets List</span>
        <a href="{{url('/admin/timesheets/')}}" class="btn btn-lg btn-info">Back to Project Overview</a>
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
               <a href="{{ route('timesheets.create')}}"class="btn btn-lg btn-info">Add timesheets</a>
      <hr>

      
<hr>
       <table  class="table table-bordered table-hover" id="milestone" cellspacing="0" width="100%">

        <thead>
            <tr>
           
            
            <th class="col-md-2">Note</th>
            <th class="col-md-2">Start_date</th>
            <th class="col-md-2">End_date</th>
            <th class="col-md-2">Time Spent</th>
            <th class="col-md-2">Action </th>
            </tr>
        </thead>

        <tbody>

        @forelse ($datas as $key => $value)
                  <tr>
                  
                    
                    <td>{{$value->note}}</td>
                    <td>{{$value->start_time}}</td>
                    <td>{{$value->end_time}}</td>
                    
                    <td>@php
                    $to_time = strtotime($value->end_time);
    $from_time = strtotime($value->start_time);
    echo $a=round(abs($to_time - $from_time) / 60,2);

                    @endphp</td>
                    <td>
                    <form action="{{ route('timesheets.destroy',$value->id) }}" method="post">
                       

                        @csrf
                        @method('delete')

                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')"><i class="fas fa-trash"></i></button>
                    </form>
                    </td>
                </tr>

     

        @empty

     @endforelse

        </tbody>
      </table>

           </div>
       </div>
    </div>

    @endsection





