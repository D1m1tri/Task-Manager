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
