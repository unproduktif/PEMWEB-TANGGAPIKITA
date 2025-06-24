<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            padding-top: 60px;
            min-height: 100vh;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
        }
        
        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
            border-radius: 10px 10px 0 0 !important;
        }
    </style>
</head>
<body>
    @include('components.partials.navbar')
    @include('components.partials.sidebar')

    <main class="main-content">
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <!-- JS & SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="flash-message"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}">
    </div>


    <script>
    // SIDEBAR TOGGLE SCRIPT (MOBILE SUPPORT)
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.querySelector('.sidebar-toggle');
            const closeBtn = document.querySelector('.sidebar-close');
            const sidebar = document.querySelector('.admin-sidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });
            }

            if (closeBtn && sidebar) {
                closeBtn.addEventListener('click', function () {
                    sidebar.classList.remove('show');
                });
            }

            document.addEventListener('click', function (event) {
                if (window.innerWidth < 992 &&
                    sidebar && !sidebar.contains(event.target) &&
                    toggleBtn && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            });
        });

        // SWEETALERT SESSION
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
                background: 'white',
                backdrop: 'rgba(0, 0, 0, 0.1)'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 2500,
                showConfirmButton: false,
                background: 'white',
                backdrop: 'rgba(0, 0, 0, 0.1)'
            });
        @endif
    </script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>