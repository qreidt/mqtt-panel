<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

if (app()->isLocal() && class_exists(Controllers\DevController::class)) {
    Route::get('/dev', Controllers\DevController::class);
}
