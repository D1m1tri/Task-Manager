<!DOCTYPE html>
<html>
    <head>
        <title>Task List</title>
    </head>

    <body>
        <h1>Task List</h1>

        <ul>
            @foreach ($users as $user)
                <h2>{{ $user->name }}</h2>
                <ul>
                @foreach ($user->tasks as $task)
                    <li>{{ $task->task }}</li>
                @endforeach
                </ul>
            @endforeach
        </ul>
        <button onclick="window.location='{{ route('logout') }}'">Logout</button>
        <button onclick="window.location='{{ route('delete_user', ['id' => Auth::user()->id]) }}'">Delete Account</button>
        <button onclick="window.location='{{ route('change_password') }}'">Change Password</button>
    </body>
</html>
