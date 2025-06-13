@extends('components.admin-layout')

@section('content')
<h2 class="mb-4">Kelola Laporan</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive shadow rounded">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Pelapor</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Waktu Lapor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $laporan->user->akun->nama ?? 'Tidak diketahui' }}</td>
                <td>{{ $laporan->judul }}</td>
                <td>{{ Str::limit($laporan->deskripsi, 50) }}</td>
                <td>
                    @if($laporan->media)
                        <img src="{{ asset('storage/' . $laporan->media) }}" alt="Gambar Laporan" width="80" class="rounded shadow-sm">
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </td>
                <td>{{ $laporan->lokasi }}</td>
                <td>
                    <span class="badge bg-{{ $laporan->status === 'verifikasi' ? 'success' : 'secondary' }}">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y, H:i') }}</td>
                <td>
                    @if($laporan->status !== 'verifikasi')
                    <form action="{{ route('admin.laporan.verifikasi', $laporan->id_laporan) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
                    </form>
                    @endif

                    <form action="{{ route('admin.laporan.hapus', $laporan->id_laporan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus laporan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="9" class="text-center text-muted">Tidak ada laporan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
