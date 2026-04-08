<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;




Route::post('/test', [TaskController::class, 'test']);

Route::get('/login', function(){
    return view('login');
});

Route::get('/', function () {
    return view('task.task');
});

Route::get('/task/create', function(){
    return view('task.create');
})->name('task.create');
