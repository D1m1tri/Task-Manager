<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


// force auth middleware
Route::middleware(['auth'])->group(function () {
  Route::get('/', [TaskController::class, 'index'])->name('task_list');


  Route::get('tasks/create', [TaskController::class, 'create'])->name('create_task');
  Route::post('tasks/create', [TaskController::class, 'store'])->name('store_task');
  Route::get('tasks/edit/{id}', [TaskController::class, 'edit'])->name('edit_task');
  Route::get('tasks/delete/{id}', [TaskController::class, 'delete'])->name('delete_task');


  Route::get('change-password', [UserController::class, 'showChangePasswordForm'])->name('change_password');
  Route::post('password', [UserController::class, 'changePassword'])->name('password');
  Route::get('logout', [UserController::class, 'logout'])->name('logout');
  Route::get('remove/{id}', [UserController::class, 'delete'])->name('delete_user');
});

Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('register', [UserController::class, 'register'])->name('register');
