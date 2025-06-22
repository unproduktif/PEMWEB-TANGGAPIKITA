<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $akun = Auth::user();
        return view('pages.profil', compact('akun'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        $akun = Auth::user();
        // Update data akun
        $akun->nama = $request->nama;
        $akun->no_hp = $request->no_hp;
        $akun->alamat = $request->alamat;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            if ($akun->foto) {
                Storage::disk('public')->delete($akun->foto);
            }
            $foto = $request->file('foto')->store('foto_users', 'public');
            $akun->foto = $foto; // hasil: foto_profil/namafile.jpg
        }

        $akun->save();
        if ($akun->user) {
            $akun->user->update([
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $akun = Auth::user();

        if (!Hash::check($request->password_lama, $akun->password)) {
            return back()->with('error', 'Password lama tidak cocok.');
        }

        $akun->password = Hash::make($request->password_baru);
        $akun->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
