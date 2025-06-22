@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-journal-text me-2"></i> Buat Laporan Donasi
        </h3>

        <form action="{{ route('admin.laporandonasi.store', $donasi->id_donasi) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul Donasi</label>
                <input type="text" class="form-control" value="{{ $donasi->judul }}" readonly>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi Laporan</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="total" class="form-label fw-semibold">Total Dana Terkumpul</label>
                    <input type="number" name="total" id="total" class="form-control" value="{{ old('total', $donasi->total) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="sisa" class="form-label fw-semibold">Sisa Dana</label>
                    <input type="number" name="sisa" id="sisa" class="form-control" value="{{ old('sisa', 0) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal Laporan</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-3">Alokasi Dana</h5>
            <div id="alokasi-container">
                <div class="row alokasi-item mb-3">
                    <div class="col-md-3">
                        <input type="text" name="alokasi[0][keterangan]" class="form-control" placeholder="Keterangan" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="alokasi[0][tujuan]" class="form-control" placeholder="Tujuan" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="alokasi[0][jumlah]" class="form-control" placeholder="Jumlah (Rp)" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-alokasi">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" id="add-alokasi" class="btn btn-outline-success mb-4">
                <i class="bi bi-plus-circle me-1"></i> Tambah Alokasi
            </button>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.laporandonasi.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-save me-1"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let index = 1;
    document.getElementById('add-alokasi').addEventListener('click', function () {
        const container = document.getElementById('alokasi-container');
        const html = `
            <div class="row alokasi-item mb-3">
                <div class="col-md-3">
                    <input type="text" name="alokasi[${index}][keterangan]" class="form-control" placeholder="Keterangan" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="alokasi[${index}][tujuan]" class="form-control" placeholder="Tujuan" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="alokasi[${index}][jumlah]" class="form-control" placeholder="Jumlah (Rp)" required>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-alokasi">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-alokasi')) {
            e.target.closest('.alokasi-item').remove();
        }
    });
</script>
@endsection
