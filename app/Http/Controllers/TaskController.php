<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    //
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
}
