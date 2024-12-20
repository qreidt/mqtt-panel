<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

if (app()->isLocal() && class_exists(Controllers\DevController::class)) {
    Route::get('/dev', Controllers\DevController::class);
}

Route::redirect('/login', '/app/login')->name('login');
