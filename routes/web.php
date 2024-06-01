<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


// force auth middleware
Route::middleware(['auth'])->group(function () {
  Route::get('/', [TaskController::class, 'showTasks'])->name('home');


  Route::get('tasks', [TaskController::class, 'index'])->name('tasks.list');
  Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
  Route::post('tasks/search', [TaskController::class, 'search'])->name('tasks.search');
  Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
  Route::post('tasks/store', [TaskController::class, 'store'])->name('tasks.store');
  Route::get('tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
  Route::get('tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');


  Route::get('password', [UserController::class, 'showChangePasswordForm'])->name('user.password');
  Route::post('password', [UserController::class, 'changePassword'])->name('user.password');
  Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
  Route::get('remove/{id}', [UserController::class, 'delete'])->name('user.delete');
});

Route::get('login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('login', [UserController::class, 'login'])->name('user.login');
Route::post('register', [UserController::class, 'register'])->name('user.register');
