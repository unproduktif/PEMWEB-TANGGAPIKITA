@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold display-5 mb-2" style="color: #2c3e50;">
                <span class="text-gradient" style="background: linear-gradient(to right, #8DBCC7, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Buat Laporan Donasi</span>
            </h1>
            <p class="text-muted mb-0">
                <i class="bi bi-clipboard2-check-fill me-1" style="color: #8DBCC7;"></i>
                Buat laporan pertanggungjawaban untuk donasi yang telah selesai
            </p>
        </div>
        <div class="d-none d-md-block" style="width: 80px; height: 4px; background: linear-gradient(to right, #8DBCC7, #00ADB5); border-radius: 2px;"></div>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        <div class="card-header bg-white py-3 border-0">
            <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                <i class="bi bi-file-earmark-text me-2" style="color: #8DBCC7;"></i>
                Form Laporan Donasi
            </h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.laporandonasi.store', $donasi->id_donasi) }}" method="POST">
                @csrf

                {{-- Donation Info --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted mb-2">Judul Donasi</label>
                    <div class="form-control bg-light border-0 py-3" style="color: #2c3e50; border-radius: 12px;">
                        <i class="bi bi-bookmark-check-fill me-2" style="color: #8DBCC7;"></i>
                        {{ $donasi->judul }}
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold text-muted mb-2">Deskripsi Laporan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control border-0 bg-light" rows="5" required 
                              style="border-radius: 12px; min-height: 120px; resize: none;">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Financial Summary --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="total" class="form-label fw-semibold text-muted mb-2">Total Dana Terkumpul</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0" style="color: #8DBCC7;">Rp</span>
                            <input type="number" name="total" id="total" class="form-control border-0 bg-light" 
                                   value="{{ old('total', $donasi->total) }}" required style="border-radius: 12px;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sisa" class="form-label fw-semibold text-muted mb-2">Sisa Dana</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0" style="color: #8DBCC7;">Rp</span>
                            <input type="number" name="sisa" id="sisa" class="form-control border-0 bg-light" 
                                   value="{{ old('sisa', 0) }}" required style="border-radius: 12px;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label fw-semibold text-muted mb-2">Tanggal Laporan</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control border-0 bg-light" 
                               value="{{ old('tanggal', now()->format('Y-m-d')) }}" required style="border-radius: 12px;">
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(140, 188, 199, 0.3);">

                {{-- Fund Allocation --}}
                <div class="mb-3">
                    <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-pie-chart-fill me-2" style="color: #8DBCC7;"></i>
                        Alokasi Dana
                    </h5>
                    <p class="text-muted small mb-4">Detail penggunaan dana yang terkumpul dari donasi ini</p>
                    
                    <div id="alokasi-container">
                        <div class="row alokasi-item mb-3 g-2">
                            <div class="col-md-3">
                                <input type="text" name="alokasi[0][keterangan]" class="form-control border-0 bg-light" 
                                       placeholder="Keterangan" required style="border-radius: 12px;">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="alokasi[0][tujuan]" class="form-control border-0 bg-light" 
                                       placeholder="Tujuan" required style="border-radius: 12px;">
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0" style="color: #8DBCC7;">Rp</span>
                                    <input type="number" name="alokasi[0][jumlah]" class="form-control border-0 bg-light" 
                                           placeholder="Jumlah" required style="border-radius: 12px;">
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-alokasi rounded-pill px-3">
                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-alokasi" class="btn btn-hover mt-2" 
                            style="background-color: #EBFFD8; color: #2c3e50; border-radius: 12px;">
                        <i class="bi bi-plus-circle-fill me-1" style="color: #8DBCC7;"></i> Tambah Alokasi
                    </button>
                </div>

                {{-- Form Actions --}}
                <div class="d-flex justify-content-between mt-5 pt-3">
                    <a href="{{ route('admin.laporandonasi.index') }}" class="btn btn-hover rounded-pill px-4 py-2"
                       style="background-color: #f8f9fa; color: #2c3e50;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-hover rounded-pill px-4 py-2"
                            style="background: linear-gradient(to right, #8DBCC7, #00ADB5); color: white;">
                        <i class="bi bi-save-fill me-1"></i> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(140, 188, 199, 0.25);
        border-color: #8DBCC7;
    }
</style>
@endsection

@section('scripts')
<script>
    let index = 1;
    document.getElementById('add-alokasi').addEventListener('click', function () {
        const container = document.getElementById('alokasi-container');
        const html = `
            <div class="row alokasi-item mb-3 g-2">
                <div class="col-md-3">
                    <input type="text" name="alokasi[${index}][keterangan]" class="form-control border-0 bg-light" 
                           placeholder="Keterangan" required style="border-radius: 12px;">
                </div>
                <div class="col-md-3">
                    <input type="text" name="alokasi[${index}][tujuan]" class="form-control border-0 bg-light" 
                           placeholder="Tujuan" required style="border-radius: 12px;">
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0" style="color: #8DBCC7;">Rp</span>
                        <input type="number" name="alokasi[${index}][jumlah]" class="form-control border-0 bg-light" 
                               placeholder="Jumlah" required style="border-radius: 12px;">
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-alokasi rounded-pill px-3">
                        <i class="bi bi-trash-fill me-1"></i> Hapus
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