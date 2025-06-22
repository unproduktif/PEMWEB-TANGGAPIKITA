<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    public function index()
    {
        $users = User::with('akun')
            ->when(request('search'), function($query) {
                $query->whereHas('akun', function($q) {
                    $q->where('nama', 'like', '%'.request('search').'%')
                      ->orWhere('email', 'like', '%'.request('search').'%');
                });
            })
            ->paginate(10);

        return view('admin.akun.index', compact('users'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:akun,email',
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->akun()->create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.akun.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:akun,email,'.$user->id.',user_id',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        $user->akun()->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->akun()->delete();
        $user->delete();

        return redirect()->route('admin.akun.index')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}