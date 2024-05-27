<tr>
    <td>{{ $task->task }}</td>
    <td>{{ $task->description }}</td>
    <td>
        @if ($owner_ids->count() == 1 or $task->owner->id == Auth::user()->id or $task->assignees->contains(Auth::user()->id))
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $task->id }}">
                <select id="status" name="status" required onchange="this.form.submit()" value="{{ $task->status }}" class="form-select">
                    <option value="0" @if ($task->status == 0) selected @endif>Not Started</option>
                    <option value="1" @if ($task->status == 1) selected @endif>In Progress</option>
                    <option value="2" @if ($task->status == 2) selected @endif>Completed</option>
                    <option value="3" @if ($task->status == 3) selected @endif>Archived</option>
                </select>
            </form>
        @else
            <p>
                @switch($task->status)
                    @case(0)
                        Not Started
                        @break
                    @case(1)
                        In Progress
                        @break
                    @case(2)
                        Completed
                        @break
                    @case(3)
                        Archived
                        @break
                @endswitch
            </p>
        @endif

        @if ($task->status == 2)
            <p> marked as completed at {{ $task->completed_at }}</p>
        @endif
    </td>
    @if (isset($task->owner->name))
        <td>
            @if ($task->owner->id == Auth::user()->id)
                <strong>You</strong>
            @else
                {{ $task->owner->name }}
            @endif
        </td>
    @endif
    <td>
        @php
            // change the name of the logged in user to 'You'
            $assignees = $task->assignees->pluck('name')->toArray();
            if (in_array(Auth::user()->name, $assignees)) {
                $key = array_search(Auth::user()->name, $assignees);
                $assignees[$key] = 'You';
            }
            // implode the assignees array to a string
            $assignees = implode(', ', $assignees);
            echo $assignees;
        @endphp
    </td>
    @if (!isset($task->owner->name))
        <td>
            <a href="{{route('tasks.edit', ['id' => $task->id])}}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{route('tasks.delete', ['id' => $task->id])}}" class="btn btn-danger btn-sm">Delete</a>
        </td>
    @endif
</tr>
