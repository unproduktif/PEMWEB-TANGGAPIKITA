@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4 p-4">
                <h3 class="fw-bold text-primary mb-4">
                    <i class="bi bi-credit-card-2-front-fill me-2"></i>Konfirmasi Pembayaran
                </h3>

                {{-- Judul Donasi --}}
                @if(isset($donasi) && $donasi->judul)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Donasi</label>
                        <input type="text" class="form-control bg-light" value="{{ $donasi->judul }}" disabled>
                    </div>
                @endif

                {{-- Jumlah Donasi --}}
                @if(isset($user_donasi->jumlah))
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah Donasi</label>
                        <input type="text" class="form-control bg-light" 
                            value="Rp {{ number_format($user_donasi->jumlah, 0, ',', '.') }}" disabled>
                    </div>
                @endif

                {{-- Metode Pembayaran (jika ada) --}}
                @if(!empty($user_donasi->metode))
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pembayaran</label>
                        <input type="text" class="form-control bg-light" 
                            value="{{ ucfirst($user_donasi->metode) }}" disabled>
                    </div>
                @endif

                {{-- Pesan --}}
                @if(!empty($user_donasi->pesan))
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pesan untuk Penerima</label>
                        <textarea class="form-control bg-light" rows="3" disabled>{{ $user_donasi->pesan }}</textarea>
                    </div>
                @endif

                {{-- Tombol Bayar --}}
                <div class="text-center mt-4">
                    <button id="pay-button" class="btn btn-success rounded-pill px-5">
                        <i class="bi bi-wallet2 me-1"></i> Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Midtrans Snap JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                window.location.href = "/donasi/sukses";
            },
            onPending: function(result){
                alert("Menunggu pembayaran...");
                window.location.href = "/donasi/pending";
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            },
        });
    });
</script>
@endsection
