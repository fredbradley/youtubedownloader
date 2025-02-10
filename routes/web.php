<?php

use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
})->name('form');
Route::post('show', [DownloadController::class, 'show'])->name('show');
Route::get('download', [DownloadController::class, 'download'])->name('download');
Route::view('terms', 'terms')->name('terms');
