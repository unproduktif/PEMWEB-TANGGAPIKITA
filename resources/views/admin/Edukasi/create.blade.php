@extends('components.layout')

@section('content')
<div class="container mt-4 mb-5">

    <div class="text-center mb-5">
        <h3 class="fw-bold display-6">
            <span class="text-dark">Bagikan Pengetahuan,</span><br>
            <span class="text-info">Untuk Kesadaran Bersama</span>
        </h3>
        <p class="text-muted fs-5 mt-3">
            <strong class="text-dark">TanggapiKita</strong> — Edukasi adalah Kekuatan.
        </p>
    </div>

    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.edukasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Edukasi</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label for="konten" class="form-label fw-semibold">Konten Edukasi</label>
                    <textarea name="konten" id="konten" class="form-control" rows="7" required>{{ old('konten') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Gambar Pendukung (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.edukasi.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="bi bi-upload me-1"></i> Unggah Edukasi
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
