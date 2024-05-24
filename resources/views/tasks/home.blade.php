<!DOCTYPE html>
<html>
    <head>
        <title>home</title>
    </head>

    <body>
        <h1>home</h1>
        <button onclick="window.location='{{ route('tasks.create') }}'">Create Task</button>
        <button onclick="window.location='{{ route('user.password') }}'">Change Password</button>
        <button onclick="window.location='{{ route('user.logout') }}'">Logout</button>
        <button onclick="window.location='{{ route('user.delete', ['id' => Auth::user()->id]) }}'">Delete Account</button>
        <button onclick="window.location='{{ route('tasks.list') }}'">View All Tasks</button>

        <h1> Your Owned Tasks </h1>
        <table border="1">
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assignees</th>
                <th>Actions</th>
            </tr>
            @foreach ($ownedTasks as $task)
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <select id="status" name="status" required onchange="this.form.submit()" value="{{ $task->status }}">
                                <option value="0" @if ($task->status == 0) selected @endif>Not Started</option>
                                <option value="1" @if ($task->status == 1) selected @endif>In Progress</option>
                                <option value="2" @if ($task->status == 2) selected @endif>Completed</option>
                                <option value="3" @if ($task->status == 3) selected @endif>Archived</option>
                            </select>
                        </form>
                        @if ($task->status == 2)
                            <p> marked as completed at {{ $task->completed_at }}</p>
                        @endif
                    </td>
                    @if (isset($task->owner->name))
                        <td>{{ $task->owner->name }}</td>
                    @endif
                    <td>
                        <ul>
                            @foreach ($task->assignees as $assignee)
                                <li>{{ $assignee->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    @if (!isset($task->owner->name))
                        <td>
                            <button onclick="window.location='{{ route('tasks.edit', ['id' => $task->id]) }}'">Edit Task</button>
                            <button onclick="window.location='{{ route('tasks.delete', ['id' => $task->id]) }}'">Delete Task</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
        <h1> Tasks Assigned to You </h1>
        <table border="1">
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Status</th>
                <th>Owner</th>
                <th>Assignees</th>
            </tr>
            @foreach ($assignedTasks as $task)
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <select id="status" name="status" required onchange="this.form.submit()" value="{{ $task->status }}">
                                <option value="0" @if ($task->status == 0) selected @endif>Not Started</option>
                                <option value="1" @if ($task->status == 1) selected @endif>In Progress</option>
                                <option value="2" @if ($task->status == 2) selected @endif>Completed</option>
                                <option value="3" @if ($task->status == 3) selected @endif>Archived</option>
                            </select>
                        </form>
                        @if ($task->status == 2)
                            <p> marked as completed at {{ $task->completed_at }}</p>
                        @endif
                    </td>
                    @if (isset($task->owner->name))
                        <td>{{ $task->owner->name }}</td>
                    @endif
                    <td>
                        <ul>
                            @foreach ($task->assignees as $assignee)
                                <li>{{ $assignee->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    @if (!isset($task->owner->name))
                        <td>
                            <button onclick="window.location='{{ route('tasks.edit', ['id' => $task->id]) }}'">Edit Task</button>
                            <button onclick="window.location='{{ route('tasks.delete', ['id' => $task->id]) }}'">Delete Task</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </body>
</html>
