<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'createNewUser'])->name(name: 'users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name(name: 'user.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name(name: 'user.delete');