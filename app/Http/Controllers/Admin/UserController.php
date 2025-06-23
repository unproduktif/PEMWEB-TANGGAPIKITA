<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('akun')->get();
        return view('admin.akun.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::with('akun')->findOrFail($id);

        if (!$user->akun) {
            abort(404, 'Data akun tidak ditemukan');
        }

        return view('admin.akun.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
        ]);

        $user = User::with('akun')->findOrFail($id);
        $user->akun->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $user->update([
            'kode_pos' => $request->kode_pos,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete(); // akan error kalau masih terpakai di relasi

            Akun::where('id_akun', $id)->delete(); // opsional

            return redirect()->route('admin.akun.index')->with('success', 'Akun pengguna berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.akun.index')->with('error', 'Gagal menghapus akun. Data masih digunakan di tabel lain.');
        }
    }

}
