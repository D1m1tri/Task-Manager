<!DOCTYPE html>
<html>
    <head>
        <title>Task List</title>
    </head>

    <body>
        <h1>Task List</h1>

        <ul>
            @foreach ($users as $user)
                <h2>{{ $user->name }} Tasks</h2>
                <ul>
                @foreach ($user->tasks as $task)
                    <li>{{ $task->task }} - {{ $task->description }}</li>
                    <form method="POST" action="{{ route('store_task') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <select id="status" name="status" required onchange="this.form.submit()" value="{{ $task->status }}">
                            <option value="0" @if ($task->status == 0) selected @endif>Not Started</option>
                            <option value="1" @if ($task->status == 1) selected @endif>In Progress</option>
                            <option value="2" @if ($task->status == 2) selected @endif>Completed</option>
                            <option value="3" @if ($task->status == 3) selected @endif>Archived</option>
                        </select>
                    </form>
                    <button onclick="window.location='{{ route('delete_task', ['id' => $task->id]) }}'">Delete Task</button>
                    <button onclick="window.location='{{ route('edit_task', ['id' => $task->id]) }}'">Edit Task</button>
                    <h3>Assignees</h3>
                    <ul>
                        @foreach ($task->assignees as $assignee)
                            <li>{{ $assignee->name }}</li>
                        @endforeach
                    </ul>

                @endforeach
                </ul>
            @endforeach
        </ul>
        <button onclick="window.location='{{ route('logout') }}'">Logout</button>
        <button onclick="window.location='{{ route('delete_user', ['id' => Auth::user()->id]) }}'">Delete Account</button>
        <button onclick="window.location='{{ route('change_password') }}'">Change Password</button>
        <button onclick="window.location='{{ route('create_task') }}'">Create Task</button>
    </body>
</html>
