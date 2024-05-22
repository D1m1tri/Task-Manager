<!DOCTYPE html>
<html>
  <head>
    <title>Create Task</title>
  </head>

  <body>
    <h1>Create Task</h1>

    <form method="POST" action="{{ route('store_task') }}">
      @csrf
      <label for="title">Title</label>
      <input type="text" id="task" name="task" required>
      <label for="description">Description</label>
      <textarea id="description" name="description"></textarea>
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

      <button type="submit">Create Task</button>
    </form>
  </body>
  <script>
    // function to add a new select element to the assignees_div
    // when the user selects an assignee, removing the selected
    // assignee from the list of assignees
    function addAssignee() {
      var assignees_div = document.getElementById('assignees_div');
      var assignees = document.getElementById('assignees');
      var selected_assignees = document.querySelectorAll('select[name="assignees[]"]');
      var count = 0;
      for (var i = 0; i < selected_assignees.length; i++) {
        if (selected_assignees[i].value === '') {
          count++;
        }
        if (count > 1) {
          selected_assignees[i].remove();
        }
      }
      if (this.value === '') {
        return;
      }
      for (var i = 0; i < selected_assignees.length; i++) {
        if (selected_assignees[i].value === '') {
          return;
        }
        if (selected_assignees[i].value === this.value && selected_assignees[i] !== this) {
          this.value = '';
          alert('This user is already an assignee');
          return;
        }
      }
      var new_select = assignees.cloneNode(true);
      assignees_div.appendChild(new_select);
      new_select.addEventListener('change', addAssignee);
    }

    // add event listener to the first select element
    document.getElementById('assignees').addEventListener('change', addAssignee);
  </script>
</html>
