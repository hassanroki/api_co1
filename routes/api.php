<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





// // Categories
// Route::get('/categories', [CategoryController::class, 'index']);
// Route::get('/categories-products', [CategoryController::class, 'categoryWithProduct']);

// Multi Route -> API Resource
Route::apiResource('tasks', TaskController::class);

// Version Control Or Multi url
Route::prefix('/v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/test', action: [TaskController::class, 'test']);

    // Group
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout', [AuthController::class, 'logout']);
        // All Task
        Route::get('/list', action: [TaskController::class, 'list']);
        Route::get('/list/{id}/single', action: [TaskController::class, 'single']);
        Route::post('/store', action: [TaskController::class, 'store']);
        Route::post('/task/{id}', action: [TaskController::class, 'update']);
        Route::delete('/delete/{id}', action: [TaskController::class, 'destroy']);

        // Categories
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories-products', [CategoryController::class, 'categoryWithProduct']);
    });

});
