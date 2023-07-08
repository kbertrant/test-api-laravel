<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BeatController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// routes/api.php
Route::middleware('auth:api')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/store/post', [PostController::class,'store'])->name('store.poster');
    Route::post('/store/beat', [BeatController::class,'store'])->name('store.beat');

    Route::post('/like/post', [LikeController::class,'likePost'])->name('like.post');
    Route::post('/like/beat', [LikeController::class,'likeBeat'])->name('like.beat');
    Route::post('/store/comment', [CommentController::class,'store'])->name('store.comm');
    
});

