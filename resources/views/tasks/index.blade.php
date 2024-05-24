<!DOCTYPE html>
<html>
    <head>
        <title>Task List</title>
    </head>

    <body>
        <h1>Task List</h1>

        <table border="1">
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Status</th>
                <th>Owner</th>
                <th>Assignees</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if ($task->owner_id == $user->id || $task->assignees->contains($user))
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
                        @else
                            @switch($task->status)
                                @case(0)
                                    <p>Not Started</p>
                                    @break
                                @case(1)
                                    <p>In Progress</p>
                                    @break
                                @case(2)
                                    <p>Completed</p>
                                    @break
                                @case(3)
                                    <p>Archived</p>
                                    @break
                            @endswitch
                        @endif
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
        <button onclick="window.location='{{ route('user.logout') }}'">Logout</button>
        <button onclick="window.location='{{ route('tasks.create') }}'">Create Task</button>
    </body>
</html>
