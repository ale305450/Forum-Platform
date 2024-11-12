<?php

use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UserController::class, 'logout']);

    Route::middleware('role:admin')->group(function () {});
    Route::get('users', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    Route::post('user/{id}', [UserController::class, 'update']);

    //Route::resource('topic',TopicController::class);
    Route::prefix('topic')->group(function () {
        Route::get('', [TopicController::class, 'index']);
        Route::post('', [TopicController::class, 'store']);
        Route::get('/{id}', [TopicController::class, 'show']);
        Route::post('/{id}', [TopicController::class, 'update']);
        Route::delete('/{id}', [TopicController::class, 'destroy']);
    });
});
