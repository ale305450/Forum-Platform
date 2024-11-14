<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResponseController;
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
    Route::patch('user/{id}', [UserController::class, 'update']);
    Route::post('user/filter', [UserController::class, 'filter']);
    Route::post('user/search', [UserController::class, 'search']);

    //Route::resource('topic',TopicController::class);
    Route::prefix('topic')->group(function () {
        Route::get('', [TopicController::class, 'index']);
        Route::post('', [TopicController::class, 'store']);
        Route::get('/{id}', [TopicController::class, 'show']);
        Route::post('/{id}', [TopicController::class, 'update']);
        Route::delete('/{id}', [TopicController::class, 'destroy']);
    });

    Route::prefix('category')->group(function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::post('', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('response')->group(function () {
        Route::get('', [ResponseController::class, 'index']);
        Route::post('', [ResponseController::class, 'store']);
        Route::get('/{id}', [ResponseController::class, 'show']);
        Route::post('/{id}', [ResponseController::class, 'update']);
        Route::delete('/{id}', [ResponseController::class, 'destroy']);
    });
});
