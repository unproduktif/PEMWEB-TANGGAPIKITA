{{-- pending.blade.php --}}
@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5 text-center">
    <div class="card p-4 shadow border-0 rounded-4">
        <h2 class="text-warning mb-3">
            <i class="bi bi-hourglass-split"></i> Menunggu Pembayaran
        </h2>
        <p>Pembayaran Anda sedang diproses. Mohon selesaikan pembayaran melalui metode yang dipilih.</p>
        <a href="{{ route('donasi.index') }}" class="btn btn-secondary mt-3">Kembali ke Donasi</a>
    </div>
</div>
@endsection
