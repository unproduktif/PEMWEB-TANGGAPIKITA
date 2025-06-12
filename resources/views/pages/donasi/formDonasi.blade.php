@extends('components.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Form Donasi</h2>
    
    <form action="{{ route('donasi.store') }}" method="POST">
        @csrf

        <input type="hidden" name="id_donasi" value="{{ $donasi->id_donasi }}">
        <input type="hidden" name="id_user" value="1"> {{-- sementara hardcode ID user 1 --}}


        <div class="mb-3">
            <label for="judul" class="form-label">Judul Donasi</label>
            <input type="text" class="form-control" value="{{ $donasi->judul }}" disabled>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Donasi (Rp)</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1000" step="1000" placeholder="Contoh: 10000">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Donasi</button>
        <a href="{{ route('donasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
