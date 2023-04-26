<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('index');
});


Route::post('upload', FileController::class)->name('upload');