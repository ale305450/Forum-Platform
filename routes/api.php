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

    Route::get('users', [UserController::class, 'index'])->middleware('permission:all-users');
    Route::get('user/{id}', [UserController::class, 'show'])->middleware('permission:find-user');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->middleware('permission:delete-user');
    Route::patch('user/{id}', [UserController::class, 'update']);
    Route::post('user/filter', [UserController::class, 'filter']);
    Route::post('user/search', [UserController::class, 'search']);

    //Route::resource('topic',TopicController::class);
    Route::prefix('topic')->group(function () {
        Route::get('', [TopicController::class, 'index'])->middleware('permission:all-topics');
        Route::post('', [TopicController::class, 'store'])->middleware('permission:create-topic');
        Route::get('/{id}', [TopicController::class, 'show']);
        Route::patch('/{id}', [TopicController::class, 'update'])->middleware('permission:update-topic');
        Route::delete('/{id}', [TopicController::class, 'destroy'])->middleware('permission:delete-topic');
        Route::post('/filter', [TopicController::class, 'filter']);
        Route::post('/search', [TopicController::class, 'search']);
    });

    Route::prefix('category')->middleware('role:Admin')->group(function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::post('', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::patch('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('response')->group(function () {
        Route::get('', [ResponseController::class, 'index']);
        Route::post('', [ResponseController::class, 'store'])->middleware('permission:create-response');
        Route::get('/{id}', [ResponseController::class, 'show']);
        Route::get('/topic/{id}', [ResponseController::class, 'topicResponses']);
        Route::patch('/{id}', [ResponseController::class, 'update'])->middleware('permission:update-response');
        Route::delete('/{id}', [ResponseController::class, 'destroy'])->middleware('permission:delete-response');
    });
});
