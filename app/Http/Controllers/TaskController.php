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
    // if the request has a status, then we are updating the status
    if ($request->has('status')) {
      $request->validate([
        'status' => 'required'
      ]);
    }
    else {
      $request->validate([
        'task' => 'required'
      ]);
    }

    $task = new Task();
    // if the request has an id, then we are updating a task
    if ($request->has('id')) {
      $task = Task::find($request->id);
      if (is_null($task)) {
        return redirect()->route('task_list');
      }
    }
    else {
      $task->owner_id = Auth::id();
    }

    // only the owner can change name and description
    if ($task->owner_id == Auth::id() && $request->has('task')) {
      $task->task = $request->task;
      $task->description = $request->description;
      $task->save();
      $assignees = $request->assignees;
      $assignees = array_unique($assignees);
      $assignees = array_filter($assignees);
      $task->assignees()->sync($assignees);
    }

    // only the owner and the assignees can change the status
    if ($request->has('status')) {
      $task->status = $request->status;
      if ($request->status == 2) {
        $task->completed_at = now();
      }
      else {
        $task->completed_at = null;
      }
    }
    if ($task->owner_id == Auth::id() || $task->assignees->contains(Auth::id())) {
      $task->save();
    }

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
