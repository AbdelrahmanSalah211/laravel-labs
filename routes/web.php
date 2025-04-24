<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
  Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
  Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
  Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->where('id', '[0-9]+')->name('posts.edit');
  Route::put('/posts/{id}', [PostController::class, 'update'])->where('id', '[0-9]+')->name('posts.update');
  Route::delete('/posts/{id}', [PostController::class, 'destroy'])->where('id', '[0-9]+')->name('posts.destroy');
});

require __DIR__.'/auth.php';


Route::get('/posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('posts.show');

Route::fallback(function (){
  return view('layouts.fallback', ['title' => 'Fallback', 'message' => '404 This page does not exist.']);
});
