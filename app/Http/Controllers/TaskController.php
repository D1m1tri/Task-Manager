<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
  // show all users and tasks
  public function index()
  {
    $users = User::all();

    return view('tasks.index', [
      'users' => $users
    ]);
  }

  // show all tasks for the authenticated user
  public function showTasks()
  {
    $tasks = Auth::user()->tasks;

    return view('tasks.show', [
      'tasks' => $tasks
    ]);
  }

  // create a new task
  public function create()
  {
    $users = User::all();
    return view('tasks.create', [
      'users' => $users
    ]);
  }

  // store the task, checking weather to
  // create a new or update an existing task
  public function store(Request $request)
  {
    $request->validate([
      'task' => 'required',
    ]);

    if ($request->has('id')) {
      $task = Task::find($request->id);
      if (is_null($task)) {
        return redirect()->route('task_list');
      }
      $task->task = $request->task;
      $task->description = $request->description;
      $task->save();
    }
    else {
      $task = new Task();
      $task->task = $request->task;
      $task->description = $request->description;
      $task->owner_id = Auth::id();
      $task->save();
    }
    $assignees = $request->assignees;
    // remove repeated assignees
    $assignees = array_unique($assignees);
    // remove null values
    $assignees = array_filter($assignees);

    // assign the task to the selected users, removing the previous assignees
    $task->assignees()->sync($assignees);

    return redirect()->route('task_list');
  }

  // edit a task
  public function edit($id)
  {
    $task = Task::find($id);
    $users = User::all();
    return view('tasks.create', [
      'task' => $task,
      'users' => $users
    ]);
  }

  // delete a task
  public function delete($id)
  {
    $task = Task::find($id);
    $task->delete();
    return redirect()->route('task_list');
  }
}
