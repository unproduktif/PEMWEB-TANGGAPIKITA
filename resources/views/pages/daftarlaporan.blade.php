@extends('components.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Laporan Bencana</h1>

    {{-- Tabel daftar laporan --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Keterangan</th>
                    <th>Lokasi</th>
                    <th>Tanggal Publish</th>
                    <th>Media</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->judul }}</td>
                        <td>{{ $laporan->deskripsi }}</td>
                        <td>{{ $laporan->keterangan }}</td>
                        <td>{{ $laporan->lokasi }}</td>
                        <td>{{ $laporan->tgl_publish }}</td>
                        <td>
                            @if(Str::contains($laporan->media, ['.mp4', '.mov', '.avi']))
                                <video width="100" controls>
                                    <source src="{{ asset('storage/' . $laporan->media) }}" type="video/mp4">
                                    Browser tidak mendukung video.
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $laporan->media) }}" width="100" alt="Media">
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol Tambah Laporan --}}
    <div class="text-center mt-4">
        <a href="{{ url('/lapor') }}" class="btn btn-success">
            + Tambah Laporan
        </a>
    </div>
</div>
@endsection
