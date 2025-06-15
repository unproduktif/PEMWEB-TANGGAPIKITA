@extends('components.layout')

@section('content')
<div class="container mt-4 mb-5">

    <div class="text-center mb-5">
        <h3 class="fw-bold display-6">
            <span class="text-dark">Ubah Konten Edukasi</span><br>
            <span class="text-info">Perbarui Informasi yang Relevan</span>
        </h3>
        <p class="text-muted fs-5 mt-3">
            <strong class="text-dark">TanggapiKita</strong> — Selalu Tanggap, Selalu Tahu.
        </p>
    </div>

    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.edukasi.update', $edukasi->id_edukasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Edukasi</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $edukasi->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Konten Edukasi</label>
                    <textarea name="isi" id="isi" class="form-control" rows="7" required>{{ old('isi', $edukasi->konten) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Gambar Pendukung</label>
                    @if ($edukasi->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="Gambar Edukasi" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    @endif
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.edukasi.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
