@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-pencil-square me-2"></i> Edit Kampanye Donasi
        </h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('donasi.update', $donasi->id_donasi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Donasi</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $donasi->judul) }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $donasi->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="target" class="form-label">Target Donasi (Rp)</label>
                <input type="number" name="target" id="target" class="form-control" value="{{ old('target', $donasi->target) }}" required min="10000">
            </div>

            <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="{{ old('tgl_mulai', $donasi->tgl_mulai) }}" required>
            </div>

            <div class="mb-3">
                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="{{ old('tgl_selesai', $donasi->tgl_selesai) }}" required>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2">
                <a href="{{ route('donasi.kelola') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
