<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


// force auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('task_list');


    Route::get('change-password', [UserController::class, 'showChangePasswordForm'])->name('change_password');
    Route::post('password', [UserController::class, 'changePassword'])->name('password');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('remove/{id}', [UserController::class, 'delete'])->name('delete_user');
});

Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('register', [UserController::class, 'register'])->name('register');
