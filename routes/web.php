<?php

use App\Http\Controllers\SerpController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SerpController::class, 'index'])->name('serp.index');
Route::post('serp/check', [SerpController::class, 'check'])->name('serp.rank');
