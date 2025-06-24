<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'jabatan' => 'required|string|max:100',
        ]);

        $akun = Auth::user();
        // Update data akun
        $akun->nama = $request->nama;
        $akun->no_hp = $request->no_hp;
        $akun->alamat = $request->alamat;

        $akun->save();
        if ($akun->admin) {
            $akun->admin->update([
                'jabatan' => $request->jabatan,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048',
        ]);
        $akun = Auth::user();

        if ($request->hasFile('foto')) {
            if ($akun->foto) {
                Storage::disk('public')->delete($akun->foto);
            }
            $foto = $request->file('foto')->store('foto_admin', 'public');
            $akun->foto = $foto;
        }
        $akun->save();

        return back()->with('success', 'Foto profil diperbarui.');
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('akuns', 'email'),
            ],
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
        ]);

        \DB::beginTransaction();
        try {
            // Create the Akun first
            $akun = Akun::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'role' => 'user',
            ]);

            // Then create the User with the same ID
            $user = new User([
                'kode_pos' => $validated['kode_pos'],
                'kota' => $validated['kota'],
                'provinsi' => $validated['provinsi'],
            ]);
            
            // Set the id_user explicitly
            $user->id_user = $akun->id_akun;
            $user->save();

            \DB::commit();

            return redirect()->route('admin.akun.index')
                ->with('success', 'Akun pengguna berhasil dibuat!');

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal membuat akun: ' . $e->getMessage());
        }
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

    public function show($id)
    {
        $user = User::with('akun')->findOrFail($id);
        
        if (!$user->akun) {
            abort(404, 'Data akun tidak ditemukan');
        }

        return view('admin.akun.show', compact('user'));
    }
}

