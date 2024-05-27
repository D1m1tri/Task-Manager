@extends('base')
@section('title', 'Task List')
@section('content')
    <div class="container justify-content-center align-items-center bg-primary-subtle p-5 rounded-3">
        <div class="d-flex justify-content-between">
            <h1>Task List</h1>
            <div class="d-flex">
                <button onclick="window.location='{{ route('home') }}'" class="m-1 my-2 btn btn-primary">Home</button>
            </div>
        </div>

        <table class="table table-striped w-100">
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Status</th>
                <th>Owner</th>
                <th>Assignees</th>
            </tr>
            <tbody class="table-group-divider">
                @php $owner_ids = $tasks->pluck('id')->unique(); @endphp
                @foreach ($tasks as $task)
                    @include('partials.table')
                @endforeach
        </table>
    </div>
@endsection
