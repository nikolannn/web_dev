<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;




Route::get('/', [UserController::class, 'index'])->name(name: 'users.index');
Route::post('/users', [UserController::class, 'createNewUser'])->name(name: 'users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/{user}', [UserController::class, 'delete'])->name('user.delete');

//loginAuth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');