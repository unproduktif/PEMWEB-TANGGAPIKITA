@extends('components.layout')

@section('content')
<div class="container-fluid py-5 d-flex align-items-center justify-content-center">
    <div class="row shadow-lg rounded-5 overflow-hidden p-0" style="max-width: 960px; width: 100%; background-color: #ffffff;">
        
        {{-- Kolom Gambar --}}
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="{{ asset('images/figurelogin.jpg') }}" 
                 alt="Register Illustration" 
                 class="img-fluid w-100 h-100 object-fit-cover"
                 style="transition: transform 0.3s ease-in-out;">
        </div>

        {{-- Kolom Form --}}
        <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
            <h2 class="text-center text-primary fw-bold mb-3">Buat Akun Baru</h2>
            <p class="text-muted text-center mb-4">
                Daftarkan diri Anda untuk mulai berdonasi dan membantu sesama.
            </p>

            <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control rounded-pill" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control rounded-pill" required placeholder="Masukkan email aktif">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-pill" required placeholder="Masukkan password">
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control rounded-pill" required placeholder="Contoh: 081234567890">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="2" class="form-control rounded-4" required placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Profil (opsional)</label>
                    <input type="file" name="foto" class="form-control rounded-pill" accept="image/*">
                </div>

                {{-- Dua kolom dalam satu baris --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control rounded-pill" required placeholder="Contoh: 12345">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control rounded-pill" required placeholder="Contoh: Mataram">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control rounded-pill" required placeholder="Contoh: Nusa Tenggara Barat">
                </div>

                <button type="submit" class="btn w-100 rounded-pill shadow-sm" style="background-color: #1e90ff; color: white;">Daftar</button>

                <div class="mt-4 text-center">
                    <small>Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
