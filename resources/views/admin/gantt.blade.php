@extends('layouts.app')
@section('page_title')
<span>Gantt</span>
@endsection
@section('content')
<script src="{{ asset('js/daypilot-all.min.js') }}" type="text/javascript"></script>

{{-- {{ dd($start_date) }} --}}
<div id="dp"></div>



<script type="text/javascript">
    const dp = new DayPilot.Gantt("dp");
    dp.startDate = "{{$start_date}}";
    dp.days = {{$days}};
    dp.init();
    loadTasks();
    function loadTasks() {
        dp.tasks.load("http://localhost:8000/api/project/{{$p_id}}");
    }
</script>
@endsection