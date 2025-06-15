<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edukasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EdukasiController extends Controller
{
    // Menampilkan semua edukasi
    public function index()
    {
        $edukasis = Edukasi::with('admin')->latest()->get();
        return view('admin.Edukasi.index', compact('edukasis'));
    }

    // Tampilkan form tambah edukasi
    public function create()
    {
        return view('admin.edukasi.create');
    }

    // Simpan data edukasi baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'id_admin' => Auth::id(),
        ];

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('edukasi', 'public');
        }

        Edukasi::create($data);

        return redirect()->route('admin.edukasi.index')->with('success', 'Edukasi berhasil ditambahkan.');
    }

    // Tampilkan detail edukasi
    public function show($id)
    {
        $edukasi = Edukasi::with('admin')->findOrFail($id);
        return view('admin.edukasi.show', compact('edukasi'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        return view('admin.edukasi.edit', compact('edukasi'));
    }

    // Update data edukasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $edukasi = Edukasi::findOrFail($id);
        $edukasi->judul = $request->judul;
        $edukasi->konten = $request->konten;
      
        // Update gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($edukasi->gambar) {
                Storage::disk('public')->delete($edukasi->gambar);
            }
            $edukasi->gambar = $request->file('gambar')->store('edukasi', 'public');
        }

        $edukasi->save();

        return redirect()->route('admin.edukasi.index')->with('success', 'Edukasi berhasil diperbarui.');
    }

    // Hapus edukasi
    public function destroy($id)
    {
        $edukasi = Edukasi::findOrFail($id);

        if ($edukasi->gambar) {
            Storage::disk('public')->delete($edukasi->gambar);
        }

        $edukasi->delete();

        return redirect()->route('admin.edukasi.index')->with('success', 'Edukasi berhasil dihapus.');
    }
}
