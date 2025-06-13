@extends('components.admin-layout')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body row">
            <div class="col-md-4 text-center">
                <img src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('default-profile.png') }}" 
                     class="rounded-circle mb-3 border shadow-sm" width="150" height="150" alt="Foto Profil">

                <form action="{{ route('admin.foto.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <input type="file" name="foto" class="form-control form-control-sm">
                    </div>
                    <button class="btn btn-sm btn-primary">Ubah Foto</button>
                    @if(auth()->user()->foto)
                        <button type="submit" name="hapus" value="1" class="btn btn-sm btn-outline-danger ms-2">Hapus Foto</button>
                    @endif
                </form>
            </div>

            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.profil.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" value="{{ auth()->user()->nama }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="form-control" disabled>
                    </div>

                    <button class="btn btn-success">Simpan Perubahan</button>
                </form>

                <hr>

                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf
                    @method('PATCH')

                    <h5 class="mt-4">Ubah Password</h5>

                    <div class="mb-2">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn btn-warning">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
