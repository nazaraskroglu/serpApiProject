<?php

use App\Http\Controllers\SerpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('serp')->group(function () {
    Route::get('/index', [SerpController::class, 'index'])->name('serp.index');
    Route::post('/check', [SerpController::class, 'check'])->name('serp.rank');
});
