@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-pencil-square me-2"></i> Edit Akun Pengguna
        </h3>

        <div class="collapse show" id="formPerbarui">
            <div class="border rounded-4 p-4 mb-4 bg-light">
                <form action="{{ route('admin.akun.update', $user->id_user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->akun->nama) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->akun->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->akun->no_hp) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $user->akun->alamat) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota</label>
                            <input type="text" name="kota" class="form-control" value="{{ old('kota', $user->kota) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $user->provinsi) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $user->kode_pos) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Foto Profil</label><br>
                            @if($user->akun->foto)
                                <img src="{{ asset('storage/' . $user->akun->foto) }}" alt="Foto" width="100" class="rounded mb-2">
                            @endif
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
