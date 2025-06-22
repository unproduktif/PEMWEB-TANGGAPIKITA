{{-- sukses.blade.php --}}
@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5 text-center">
    <div class="card p-4 shadow border-0 rounded-4">
        <h2 class="text-success mb-3">
            <i class="bi bi-check-circle-fill"></i> Pembayaran Berhasil!
        </h2>
        <p>Terima kasih atas donasi Anda.</p>
        <a href="{{ route('donasi.index') }}" class="btn btn-primary mt-3">Kembali ke Halaman Donasi</a>
    </div>
</div>
@endsection
