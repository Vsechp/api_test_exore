<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;


//Route::middleware('auth:sanctum')->group(function () {
//    Route::post('/create-employee', [UserController::class, 'createEmployee']);
//    Route::get('/user', [UserController::class, 'getUser']);
//    Route::delete('/users/{user}', [UserController::class, 'destroy']);
//});
