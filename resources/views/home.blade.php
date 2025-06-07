<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tanggapikita Navbar</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo kiri -->
                <a class="navbar-brand" href="#">Tanggapikita</a>

                <!-- Toggle button untuk mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu dan Login -->
                <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu navigasi -->
                <ul class="navbar-nav ms-auto me-3 nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('home') ? 'active': ''}}" href="\home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('bencana') ? 'active': ''}}" href="\bencana">Bencana</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('lapor') ? 'active': ''}}" href="\lapor">Laporkan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('donasi') ? 'active': ''}}" href="\donasi">Donasi</a>
                    </li>
                </ul>

                <!-- Login/Register -->
                <div class="d-flex">
                    <a href="#" class="btn btn-login">Login</a>
                </div>
                </div>
            </div>
        </nav>

        <div class="container mt-3">
            @yield('content')
        </div>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>