<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/','index');

Route::get('/administrator/users/',[UserController::class,'index'])->name('users.index');

Route::get('/administrator/people/',[PersonController::class,'index'])->name('people.index');