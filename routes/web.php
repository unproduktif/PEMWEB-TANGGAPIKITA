<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('home');
})->name('home');

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
    })->name('admin.dashboard');
});

// BISA DIAKSES TANPA LOGIN
Route::get('/laporan-saya', [LaporanController::class, 'laporanSaya'])->name('laporan.index');

// HARUS LOGIN
Route::middleware('auth')->group(function () {
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id_laporan}/edit',[LaporanController::class, 'edit'])->name('laporan.edit');
    Route::patch('/laporan/{id_laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id_laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');

});


Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/{id_donasi}', [DonasiController::class, 'show'])->name('donasi.show');

Route::middleware('auth')->group(function(){
    Route::get('/donasi/form/{id_donasi}', [DonasiController::class, 'createForm'])->name('donasi.form');
    Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
    Route::get('/donasi/campaign/{id_laporan}', [DonasiController::class, 'createCampaign'])->name('donasi.createCampaign');
    Route::post('/donasi/campaign/store', [DonasiController::class, 'storeCampaign'])->name('donasi.storeCampaign');
});


Route::get('/bencana', [LaporanController::class, 'indexBencana'])->name('bencana');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profil', function () {
        return view('admin.profil');
    })->name('admin.profil');
    Route::get('/admin/profil', [AkunController::class, 'showProfil'])->name('admin.profil');
    Route::patch('/admin/profil', [AkunController::class, 'updateProfil'])->name('admin.profil.update');
    Route::patch('/admin/profil/foto', [AkunController::class, 'updateFoto'])->name('admin.foto.update');
    Route::patch('/admin/profil/password', [AkunController::class, 'updatePassword'])->name('admin.password.update');

});


Route::prefix('admin/laporan')->group(function () {
    Route::get('/', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::patch('/verifikasi/{id}', [AdminLaporanController::class, 'verifikasi'])->name('admin.laporan.verifikasi');
    Route::delete('/hapus/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.hapus');
});

