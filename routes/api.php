<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostAPIController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  Route::get('/posts', [PostAPIController::class, 'index']);
  Route::get('/posts/{id}', [PostAPIController::class, 'show']);
  Route::post('/posts', [PostAPIController::class, 'store']);
  Route::put('/posts/{id}', [PostAPIController::class, 'update']);
  Route::delete('/posts/{id}', [PostAPIController::class, 'destroy']);
});
