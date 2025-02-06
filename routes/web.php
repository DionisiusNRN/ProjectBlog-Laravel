<?php

// use App\Http\Controllers\HelloController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('posts', [PostController::class,'store']);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/create', [PostController::class,'create']); // di atas ID supaya /create tdk dibaca sebagai id
Route::get('posts/{id}', [PostController::class,'show']);
Route::get('posts/{id}/edit', [PostController::class,'edit']);
Route::patch('posts/{id}', [PostController::class,'update']);
Route::delete('posts/{id}', [PostController::class,'destroy']);
