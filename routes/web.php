<?php

use App\Http\Controllers\SerpApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('serp')->group(function () {
    Route::get('/index', [SerpApiController::class, 'index'])->name('serp.index');
    Route::post('/check', [SerpApiController::class, 'check'])->name('serp.rank');
});
