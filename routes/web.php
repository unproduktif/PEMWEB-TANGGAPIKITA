<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\LaporanDonasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\EdukasiController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
Route::get('/home', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::prefix('admin/informasi')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [InformasiController::class, 'index'])->name('admin.informasi.index');
    Route::get('/admin/informasi/{id}', [InformasiController::class, 'show'])->name('admin.informasi.show');
    Route::delete('/hapus/{id}', [InformasiController::class, 'destroy'])->name('admin.informasi.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/user', [AkunController::class, 'index'])->name('admin.user.index');
});

Route::prefix('admin/laporandonasi')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\LaporanDonasiController::class, 'index'])->name('admin.laporandonasi.index');
    Route::get('/buat/{id_donasi}', [App\Http\Controllers\Admin\LaporanDonasiController::class, 'create'])->name('admin.laporandonasi.create');
    Route::post('/simpan/{id_donasi}', [App\Http\Controllers\Admin\LaporanDonasiController::class, 'store'])->name('admin.laporandonasi.store');
});

Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/profil', [App\Http\Controllers\UserController::class, 'index'])->name('profil');
    Route::patch('/profil', [App\Http\Controllers\UserController::class, 'update'])->name('profil.update');
    Route::patch('/profil/foto', [App\Http\Controllers\UserController::class, 'updateFoto'])->name('foto.update');
    Route::patch('/profil/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('password.update');
});

// HARUS LOGIN
Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id_laporan}/edit',[LaporanController::class, 'edit'])->name('laporan.edit');
    Route::patch('/laporan/{id_laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id_laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    
});
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
Route::get('/laporan-saya', [LaporanController::class, 'laporanSaya'])->name('laporan.index');

Route::middleware(['auth', 'is_user'])->group(function(){
    Route::get('/donasi/form/{id_donasi}', [DonasiController::class, 'createForm'])->name('donasi.form');
    Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
    Route::get('/donasi/campaign/{id_laporan}', [DonasiController::class, 'createCampaign'])->name('donasi.createCampaign');
    Route::post('/donasi/campaign/store', [DonasiController::class, 'storeCampaign'])->name('donasi.storeCampaign');
    Route::get('donasi/edit/{id_donasi}', [DonasiController::class, 'edit'])->name('donasi.edit');
    Route::put('/donasi/update/{id_donasi}', [DonasiController::class, 'update'])->name('donasi.update');
    Route::put('donasi/selesaikan/{id_donasi}', [DonasiController::class, 'selesaikan'])->name('donasi.selesaikan');
    Route::get('/donasi/riwayat', [DonasiController::class, 'riwayat'])->name('donasi.riwayat');
    Route::get('/donasi/kelola', [DonasiController::class, 'kelola'])->name('donasi.kelola');
    Route::post('/donasi/midtrans', [DonasiController::class, 'createMidtrans'])->name('donasi.midtrans');
    Route::get('/donasi/payment/{order_id}', [DonasiController::class, 'redirectToPayment'])->name('donasi.payment.redirect');
    Route::get('/donasi/sukses', function () {
        return view('pages.donasi.sukses');
    })->name('donasi.sukses');
    Route::get('/donasi/pending', function () {
        return view('pages.donasi.pending');
    })->name('donasi.pending');
});
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/{id_donasi}', [DonasiController::class, 'show'])->name('donasi.show');


Route::get('/bencana', [LaporanController::class, 'indexBencana'])->name('bencana');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
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

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/edukasi/create', [EdukasiController::class, 'create'])->name('admin.edukasi.create'); // letakkan ini di atas
    Route::get('/edukasi', [EdukasiController::class, 'index'])->name('admin.edukasi.index');
    Route::post('/edukasi', [EdukasiController::class, 'store'])->name('admin.edukasi.store');
    Route::get('/edukasi/{id_edukasi}/edit', [EdukasiController::class, 'edit'])->name('admin.edukasi.edit');
    Route::get('/edukasi/{id_edukasi}', [EdukasiController::class, 'show'])->name('admin.edukasi.show');
    Route::put('/edukasi/{id_edukasi}', [EdukasiController::class, 'update'])->name('admin.edukasi.update');
    Route::delete('/edukasi/{id_edukasi}', [EdukasiController::class, 'destroy'])->name('admin.edukasi.destroy');
});
Route::get('/edukasi/{id_edukasi}', [EdukasiController::class, 'show'])->name('pages.edukasi');

Route::get('/lupa-password', [AuthController::class, 'formLupaPassword'])->name('password.request');
Route::post('/lupa-password', [AuthController::class, 'resetPassword'])->name('password.reset');

Route::prefix('admin/akun')->name('admin.akun.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::get('/create', [AkunController::class, 'create'])->name('create');
    Route::post('/', [AkunController::class, 'store'])->name('store');
    Route::get('/{user}', [AkunController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/laporandonasi/pdf/{id_laporandonasi}', [LaporanDonasiController::class, 'generatePDF'])
        ->name('admin.laporandonasi.pdf');
});

Route::get('/donasi/{id_donasi}/laporan/download', [\App\Http\Controllers\DonasiController::class, 'downloadLaporan'])->name('donasi.downloadLaporan');
