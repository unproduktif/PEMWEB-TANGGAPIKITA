<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function formLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $akuns = Akun::where('email', $credentials['email'])->first();

        if ($akuns && Hash::check($credentials['password'], $akuns->password)) {
            Auth::login($akuns);

            if ($akuns->role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Login berhasil sebagai admin!');
            }

            return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang, ' . $akuns->nama);
        }

        return back()->with('error', 'Login gagal! Email atau password salah.');
    }


    public function formRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'email'     => 'required|email|unique:akuns,email',
            'password'  => 'required|min:6',
            'no_hp'     => 'required|string',
            'alamat'    => 'required|string',
            'kode_pos'  => 'required|string',
            'kota'      => 'required|string',
            'provinsi'  => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        // Upload foto jika ada
        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_users', 'public');
        }

        // 1. Simpan ke tabel akun
        $akuns = Akun::create([
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'foto'     => $foto,
            'no_hp'    => $validated['no_hp'],
            'alamat'   => $validated['alamat'],
            'role'     => 'user', // default role
        ]);

        // 2. Simpan ke tabel user (dengan foreign key ke akun)
        User::create([
            'id_user'   => $akuns->id_akun,
            'kode_pos'  => $validated['kode_pos'],
            'kota'      => $validated['kota'],
            'provinsi'  => $validated['provinsi'],
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Keluar dari session
        $request->session()->invalidate(); // Nonaktifkan session
        $request->session()->regenerateToken(); // Amankan CSRF token baru

        return redirect()->route('home')->with('success', 'Logout berhasil!'); // Redirect ke halaman home
    }
}
