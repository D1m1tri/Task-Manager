@extends('base')
@section('title')
    @if (isset($task)) Edit Task @else Create Task @endif
@endsection

@section('content')
    <div class="container justify-content-center align-items-center bg-primary-subtle p-5 rounded-3">
        <div class="d-flex justify-content-between">
            <h1>@if (isset($task)) Edit Task @else Create Task @endif</h1>
            <div class="d-flex">
                <button onclick="window.location='{{ route('home') }}'" class="m-1 my-2 btn btn-primary">Home</button>
            </div>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            @if (isset($task))
                <input type="hidden" name="id" value="{{ $task->id }}">
            @endif
            <div class="mb-3">
                <label for="task" class="form-label">Title</label>
                <input type="text" id="task" name="task" required value="{{ isset($task) ? $task->task : old('task') ?? '' }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control">{{ isset($task) ? $task->description : old('description') ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label for="assignees_div" class="form-label">Assignees</label>
                <div id="assignees_div">
                    <select id="assignees" name="assignees[]" class="form-control">
                        <option value="">Select Assignees</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="assigned_div" class="d-flex flex-wrap">
                @if (isset($task))
                    @foreach($task->assignees as $assignee)
                        <div class="d-flex bg-primary p-2 m-1 rounded-3">
                            <input type="hidden" name="assignees[]" value="{{ $assignee->id }}">
                            {{ $assignee->name }}
                            <span class="btn-close m-0 h-100 p-0 ms-2" onclick="this.parentElement.remove()"></span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary w-100 me-1">@if (isset($task)) Update Task @else Create Task @endif</button>
                <button type="button" onclick="window.location='{{ route('home') }}'" class="btn btn-warning">Cancel</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
        // function to add a new select element to the assignees_div
        // when the user selects an assignee, removing the selected
        // assignee from the list of assignees
        function addAssignee() {
            var assignees_div = document.getElementById('assignees_div');
            var assigned_div = document.getElementById('assigned_div');
            var assignees = document.getElementById('assignees');
            var selected_assignees = document.querySelectorAll('input[name="assignees[]"]');
            if (this.value === '') {
                return;
            }
            // print the selected assignees to the console
            console.log(selected_assignees);
            for (var i = 0; i < selected_assignees.length; i++) {
                if (selected_assignees[i].value === '') {
                    return;
                }
                if (selected_assignees[i].value === this.value) {
                    alert('This user is already assigned to the task');
                    return;
                }
            }
            var selected_user = document.createElement('div');
            selected_user.classList.add('d-flex', 'bg-primary', 'p-2', 'm-1', 'rounded-3');
            selected_user.innerHTML = this.options[this.selectedIndex].text;
            selected_user.innerHTML += '<input type="hidden" name="assignees[]" value="' + this.value + '">';
            var remove_button = document.createElement('span');
            remove_button.classList.add('btn-close', 'm-0', 'h-100', 'p-0', 'ms-2');
            remove_button.onclick = function() {
                this.parentElement.remove();
            }
            selected_user.appendChild(remove_button);
            assigned_div.appendChild(selected_user);
            this.value = '';
        }

        // add event listener to the first select element
        document.getElementById('assignees').addEventListener('change', addAssignee);
@endsection
