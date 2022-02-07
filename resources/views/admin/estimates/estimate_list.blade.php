@extends('layouts.app')
@section('page_title')
    Estimates List
@endsection
@section('content')

    {{-- Table starts from here --}}
    <div class="container wrapper">
        <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="col-md-2">SL</th>
                    <th class="col-md-2">Customer</th>
                    <th class="col-md-2">Subject</th>
                    <th class="col-md-2">Date</th>
                    <th class="col-md-2">Due Date</th>
                    <th class="col-md-2">Status</th>
                    <th class="col-md-2">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Customer</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $i => $estdata)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $estdata->customer->company_name }}</td>
                        <td>{{ $estdata->subject }}</td>
                        <td>{{ $estdata->date }}</td>
                        <td>{{ $estdata->due_date }}</td>
                        <td>{{ $estdata->status }}</td>
                        <td>
                            <form action="{{ route('estimate.destroy', $estdata->id) }}" method="post"
                                id="delete{{ $estdata->id }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('estimate.show', $estdata->id) }}" class="text-success"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('estimate.edit', $estdata->id) }}" class="text-success"><i
                                        class="fas fa-edit"></i></a>
                                <a title="delete" onclick="document.getElementById('delete{{ $estdata->id }}').submit()"
                                    class="text-danger"><i class="fas fa-trash-alt"></i></a>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    {{-- Table ends here --}}
@endsection
