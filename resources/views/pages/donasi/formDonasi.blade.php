@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4 p-4">
                <h3 class="fw-bold text-primary mb-4">
                    <i class="bi bi-cash-coin me-2"></i>Form Donasi
                </h3>
                
                <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_donasi" value="{{ $donasi->id_donasi }}">
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id_user ?? 1 }}"> {{-- sementara --}}

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Donasi</label>
                        <input type="text" class="form-control bg-light" value="{{ $donasi->judul }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label fw-semibold">Jumlah Donasi <span class="text-muted">(Rp)</span></label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1000" step="1000" placeholder="Contoh: 10000">
                    </div>

                    <div class="mb-3">
                        <label for="metode" class="form-label fw-semibold">Metode Pembayaran</label>
                        <select name="metode" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="qris">QRIS</option>
                            <option value="e-wallet">E-Wallet</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label fw-semibold">Upload Bukti Transfer <span class="text-muted">(Opsional)</span></label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="pesan" class="form-label fw-semibold">Pesan untuk Penerima (Opsional)</label>
                        <textarea name="pesan" id="pesan" rows="3" class="form-control" placeholder="Contoh: Semoga tetap kuat dan tabah."></textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('donasi.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-send-check-fill me-1"></i> Kirim Donasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
