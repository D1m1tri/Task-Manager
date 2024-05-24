<!DOCTYPE html>
<html>
  <head>
    <title>@if (isset($task)) Edit Task @else Create Task @endif</title>
  </head>

  <body>
    <h1>@if (isset($task)) Edit Task @else Create Task @endif</h1>

    <form method="POST" action="{{ route('store_task') }}">
      @csrf
      @if (isset($task))
        <input type="hidden" name="id" value="{{ $task->id }}">
      @endif
      <label for="title">Title</label>
      <input type="text" id="task" name="task" required value="{{ isset($task) ? $task->task : old('task') ?? '' }}">
      <label for="description">Description</label>
      <textarea id="description" name="description">{{ isset($task) ? $task->description : old('description') ?? '' }}</textarea>

      // Add users as assignees
      <label for="assignees_div">Assignees</label>
      <div id="assignees_div">
        <select id="assignees" name="assignees[]">
          <option value="">Select Assignees</option>
          @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div id="assigned_div">
      @if (isset($task))
        @foreach($task->assignees as $assignee)
          <div style="display: flex; background-color: lightgray; padding: 5px; margin: 5px;">
            <input type="hidden" name="assignees[]" value="{{ $assignee->id }}">
            {{ $assignee->name }}
            <button onclick="this.parentElement.remove()">Remove</button>
          </div>
        @endforeach
      @endif
      </div>

      <button type="submit">@if (isset($task)) Update Task @else Create Task @endif</button>
      <button type="button" onclick="window.location='{{ route('task_list') }}'">Cancel</button>
    </form>


  </body>


  <script>
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
      selected_user.style.display = 'flex';
      selected_user.style.backgroundColor = 'lightgray';
      selected_user.style.padding = '5px';
      selected_user.style.margin = '5px';
      selected_user.innerHTML = this.options[this.selectedIndex].text;
      selected_user.innerHTML += '<input type="hidden" name="assignees[]" value="' + this.value + '">';
      var remove_button = document.createElement('button');
      remove_button.innerHTML = 'Remove';
      remove_button.onclick = function() {
        this.parentElement.remove();
      }
      selected_user.appendChild(remove_button);
      assigned_div.appendChild(selected_user);
      this.value = '';
    }

    // add event listener to the first select element
    document.getElementById('assignees').addEventListener('change', addAssignee);
  </script>
</html>
