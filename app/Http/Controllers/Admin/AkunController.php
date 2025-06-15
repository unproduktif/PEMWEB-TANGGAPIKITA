<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function showProfil()
    {
        return view('admin.profil');
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        auth()->user()->update([
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateFoto(Request $request)
    {
        $user = auth()->user();

        // Hapus foto jika tombol hapus diklik
        if ($request->has('hapus')) {
            if ($user->foto && Storage::exists($user->foto)) {
                Storage::delete($user->foto);
            }
            $user->update(['foto' => null]);
            return back()->with('success', 'Foto profil dihapus.');
        }

        // Validasi dan simpan foto baru
        $request->validate([
            'foto' => 'required|image|max:2048',
        ]);

        if ($user->foto && Storage::exists($user->foto)) {
            Storage::delete($user->foto);
        }

        $path = $request->file('foto')->store('profil', 'public');
        $user->update(['foto' => $path]);

        return back()->with('success', 'Foto profil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
