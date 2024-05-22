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
      $oldTask = Task::find($request->id);
      if (is_null($oldTask)) {
        return redirect()->route('task_list');
      }
      $oldTask->task = $request->task;
      $oldTask->description = $request->description;
      $oldTask->save();
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
    foreach ($assignees as $assignee) {
      $task->assignees()->attach($assignee);
    }
    return redirect()->route('task_list');
  }
}
