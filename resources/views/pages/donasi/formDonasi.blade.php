@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4 p-4">
                <h3 class="fw-bold text-primary mb-4">
                    <i class="bi bi-cash-coin me-2"></i>Form Donasi
                </h3>
                
                <form action="{{ route('donasi.midtrans') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_donasi" value="{{ $donasi->id_donasi }}">
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id_user ?? 1 }}">

                    {{-- Judul Donasi (Hanya tampilan) --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Donasi</label>
                        <input type="text" class="form-control bg-light" value="{{ $donasi->judul }}" disabled>
                    </div>

                    {{-- Jumlah Donasi --}}
                    <div class="mb-3">
                        <label for="jumlah" class="form-label fw-semibold">Jumlah Donasi <span class="text-muted">(Rp)</span></label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1000" step="1000" placeholder="Contoh: 10000">
                    </div>

                    {{-- Pesan Opsional --}}
                    <div class="mb-3">
                        <label for="pesan" class="form-label fw-semibold">Pesan untuk Penerima <span class="text-muted">(Opsional)</span></label>
                        <textarea name="pesan" id="pesan" rows="3" class="form-control" placeholder="Contoh: Semoga tetap kuat dan tabah."></textarea>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('donasi.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-send-check-fill me-1"></i> Lanjut ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
