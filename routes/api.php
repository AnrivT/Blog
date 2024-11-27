<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

Route::post("/register", [AuthController::class,'register']);
Route::post("/login", [AuthController::class,'login']);
Route::post("/logout", [AuthController::class,'logout'])->middleware("auth:sanctum");

//Route::apiResource('transaction',TransactionController::class)->middleware('auth:sanctum');

Route::apiResource('users',UserController::class)->middleware('auth:sanctum');

// Route::post('login', [AuthController::class,'login']);
// Route::post('register', [AuthController::class,'register']);
// Route::post('logout', [AuthController::class,'register']);