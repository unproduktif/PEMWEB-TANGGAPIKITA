@extends('components.layout')

@section('content')
<div class="container mt-4 mb-5">

    <div class="text-center mb-5">
        <h3 class="fw-bold display-6">
            <span class="text-dark">Laporkan Bencana,</span><br>
            <span class="text-primary">Agar Tanggapan Segera Tiba</span>
        </h3>
        <p class="text-muted fs-5 mt-3">
            <strong class="text-dark">TanggapiKita</strong> — Suaramu Adalah Aksi.
        </p>
    </div>

    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Laporan</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label fw-semibold">Jenis Bencana</label>
                    <select name="keterangan" id="keterangan" class="form-select" required>
                        <option value="">-- Pilih Jenis Bencana --</option>
                        <option value="Banjir" {{ old('keterangan') == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                        <option value="Gempa" {{ old('keterangan') == 'Gempa' ? 'selected' : '' }}>Gempa</option>
                        <option value="Kebakaran" {{ old('keterangan') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                        <option value="Tanah Longsor" {{ old('keterangan') == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                        <option value="Lainnya" {{ old('keterangan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-semibold">Lokasi Kejadian</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
                </div>

                <div class="mb-3">
                    <label for="media" class="form-label fw-semibold">Unggah Foto (Opsional)</label>
                    <input type="file" name="media" id="media" class="form-control" accept="image/*" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send-fill me-1"></i> Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
