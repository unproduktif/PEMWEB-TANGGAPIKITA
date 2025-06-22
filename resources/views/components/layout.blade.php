<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tanggapikita - Platform Laporan Bencana</title>
    <meta name="description" content="Platform pelaporan dan penanganan bencana secara cepat dan transparan">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary: #8DBCC7;
            --secondary: #A4CCD9;
            --light-accent: #C4E1E6;
            --light: #EBFFD8;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container-main {
            flex: 1;
            padding-top: 80px;
            background-color: #f8f9fa;
        }
        
        footer {
            background-color: var(--primary);
            color: #2c3e50;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        .swal2-popup {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .bg-primary {
            background-color: var(--primary) !important;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #2c3e50;
        }
        
        .btn-primary:hover {
            background-color: #7daab5;
            border-color: #7daab5;
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        a {
            text-decoration: none;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: #2c3e50;
        }
    </style>
</head>
<body>
    @include('components.navbar')
    
    <main class="container-main">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold">Tanggapikita</h5>
                    <p class="small">Platform pelaporan dan penanganan bencana secara cepat dan transparan.</p>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h6 class="fw-bold">Navigasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="/home" class="text-dark">Beranda</a></li>
                        <li><a href="/bencana" class="text-dark">Bencana</a></li>
                        <li><a href="{{ route('laporan.index') }}" class="text-dark">Lapor</a></li>
                        <li><a href="/donasi" class="text-dark">Donasi</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="fw-bold">Kontak</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-telephone me-2"></i> 085237949283</li>
                        <li><i class="bi bi-envelope me-2"></i> info@tanggapikita.id</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold">Sosial Media</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-dark"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-youtube fs-5"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--secondary);">
            <div class="text-center small">
                <p class="mb-0">&copy; 2025 Tanggapikita. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500,
                background: 'var(--light)',
                color: '#2c3e50'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500,
                background: 'var(--light)',
                color: '#2c3e50'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                showConfirmButton: true,
                background: 'var(--light)',
                color: '#2c3e50'
            });
        @endif

        document.getElementById('btn-buat-laporan')?.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Login Diperlukan',
                text: 'Anda harus login terlebih dahulu untuk membuat laporan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Login Sekarang',
                cancelButtonText: 'Batal',
                background: 'var(--light)',
                color: '#2c3e50',
                confirmButtonColor: 'var(--primary)'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    </script>
</body>
</html>