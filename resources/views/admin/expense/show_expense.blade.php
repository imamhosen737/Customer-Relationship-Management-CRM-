 
@extends('layouts.app')
@section('page_title')
<span>Expense</span>
@endsection
@section('content')

<div class="container wrapper">
    <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
           <tr>
                <th class="col-md-2">SL</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-2">Note</th>
                <th class="col-md-2">Expense Date</th>
                <th class="col-md-2">Amount</th>
                <th class="col-md-2">Project Name</th>
                <th class="col-md-2">Expense Category Name</th>
                <th class="col-md-2">Action</th>
               
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Note</th>
                <th>Expense Date</th>
                <th>Amount</th>
                <th>Project Name</th>
                <th>Expense Category Name</th>
                <th>Action</th>
                
            </tr>
        </tfoot>
        <tbody>
          @foreach($data as $i=>$expense_data)

          
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{$expense_data->name}}</td>
                <td>{{$expense_data->note}}</td>
                <td>{{$expense_data->expense_date}}</td>
                <td>{{$expense_data->amount}}</td>
                <td>{{ $expense_data->project->name  }}</td>
                <td>{{ $expense_data->expenseCategory->name }}</td>

                <td>
                  <form action="{{ route('expense.destroy',$expense_data->id) }}" method="post" id="delete{{$expense_data->id}}">
                    @csrf
                    @method('delete')
                    <a href="{{ route('expense.edit',$expense_data->id) }}"  class="text-success mr-2"><i class="fas fa-edit"></i></a>
                    
                    <a title="delete" onclick="document.getElementById('delete{{$expense_data->id}}').submit()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                  </form>
                </td>
               
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection