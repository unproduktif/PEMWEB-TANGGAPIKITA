<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
