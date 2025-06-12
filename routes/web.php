<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DonasiController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


// Auth Routes
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/laporan-saya', [LaporanController::class, 'laporanSaya'])->name('laporan.index');
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
});




Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/{id_donasi}', [DonasiController::class, 'show'])->name('donasi.show');
Route::get('/donasi/form/{id_donasi}', [DonasiController::class, 'createForm'])->name('donasi.form');
Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');


Route::get('/bencana', [LaporanController::class, 'indexBencana'])->name('bencana');
