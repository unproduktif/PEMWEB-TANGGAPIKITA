@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-dark mb-4">Buat Kampanye Donasi</h3>

        <form action="{{ route('donasi.storeCampaign') }}" method="POST">
            @csrf
            <input type="hidden" name="id_user" value="{{ auth()->user()->id_user }}">
            <input type="hidden" name="id_laporan" value="{{ $laporan->id_laporan }}">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Kampanye</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="target" class="form-label">Target Donasi (Rp)</label>
                <input type="number" class="form-control" id="target" name="target" min="10000" required>
            </div>

            <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
            </div>

            <div class="mb-3">
                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send-check-fill me-1"></i> Simpan Kampanye
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
