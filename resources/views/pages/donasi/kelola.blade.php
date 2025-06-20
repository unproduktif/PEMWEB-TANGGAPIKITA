@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-gear me-2"></i> Kelola Donasi
        </h3>

        @if($donasiKelola->isEmpty())
            <div class="alert alert-warning">Belum ada donasi yang dikelola.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul Donasi</th>
                            <th>Terkumpul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donasiKelola as $index => $donasi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $donasi->judul }}</td>
                                <td>Rp {{ number_format($donasi->jumlah_terkumpul, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($donasi->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('donasi.index', $donasi->id_donasi) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
