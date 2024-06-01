@extends('base')
@section('title', 'User Search')
@section('content')
    <div class="container justify-content-center align-items-center bg-primary-subtle p-5 rounded-3">
        <div class="d-flex justify-content-between">
            <h1>Tasks for user {{ $user->name }}</h1>
            <div class="d-flex">
                <form method=POST action="{{ route('tasks.search') }}" class="mx-2 my-2 h-100">
                    @csrf
                    <select name="user_id" onchange="this.form.submit()" class="form-select h-80">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </form>
                <button onclick="window.location='{{ route('tasks.list') }}'" class="m-1 my-2 btn btn-primary">View All Tasks</button>
            </div>
        </div>


        <div class="d-flex mt-5 flex-column">
            <div class="d-flex justify-content-between">
                <h4> Tasks Owned by {{ $user->name }} </h4>
                <button onclick="window.location='{{ route('tasks.create') }}'" class="m-1 btn btn-primary">Create Task</button>
            </div>
            <table class="table table-striped w-100 rounded-3">
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Owner</th>
                    <th>Assignees</th>
                </tr>
                <tbody class="table-group-divider">
                    @php $owner_ids = $ownedTasks->pluck('owner_id')->unique(); @endphp
                    @foreach ($ownedTasks as $task)
                        @include('partials.table')
                    @endforeach
            </table>
        </div>

        <div class="d-flex mt-5 flex-column">
            <h4> Tasks Assigned to {{ $user->name }} </h4>
            <table class="table table-striped w-100">
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Owner</th>
                    <th>Assignees</th>
                </tr>
                <tbody class="table-group-divider">
                    @php $owner_ids = $assignedTasks->pluck('owner_id')->unique(); @endphp
                    @foreach ($assignedTasks as $task)
                        @include('partials.table')
                    @endforeach
            </table>
        </div>
    </div>
@endsection
