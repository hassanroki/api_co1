<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/list', action: [TaskController::class, 'list']);
Route::get('/list/{id}/single', action: [TaskController::class, 'single']);
Route::post('/test', action: [TaskController::class, 'test']);
Route::post('/store', action: [TaskController::class, 'store']);
Route::post('/task/{id}', action: [TaskController::class, 'update']);
Route::delete('/delete/{id}', action: [TaskController::class, 'destory']);
