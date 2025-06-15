@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow p-4 border-0 rounded-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-pencil-square me-2"></i>Edit Laporan
        </h3>

        <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="judul" class="form-label fw-semibold">Judul Laporan</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $laporan->judul) }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Jenis Bencana</label>
                <select name="keterangan" id="keterangan" class="form-select" required>
                    <option value="banjir" {{ $laporan->keterangan == 'banjir' ? 'selected' : '' }}>Banjir</option>
                    <option value="gempa" {{ $laporan->keterangan == 'gempa' ? 'selected' : '' }}>Gempa</option>
                    <option value="kebakaran" {{ $laporan->keterangan == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                    <option value="lainnya" {{ $laporan->keterangan == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label fw-semibold">Lokasi Kejadian</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi', $laporan->lokasi) }}" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" class="form-control">
                @if ($laporan->foto)
                    <small class="text-muted">Foto saat ini: <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank">Lihat</a></small>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
