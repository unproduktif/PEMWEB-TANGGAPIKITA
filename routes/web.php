<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/bencana', function () {
    return view('pages.bencana');
});

Route::get('/lapor', function () {
    return view('pages.laporan');
});

Route::get('/donasi', function () {
    return view('pages.donasi');
});

Route::get('/bencana', [LaporanController::class, 'index']);

Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');

Route::get('/laporans/{laporan}', [LaporanController::class, 'show'])->name('laporans.show');