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
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('bencana') ? 'active' : '' }}" href="/bencana">Bencana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('laporan-saya') ? 'active' : '' }}"
                    href="{{ route('laporan.index') }}">
                    Lapor
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('donasi') ? 'active' : '' }}" href="/donasi">Donasi</a>
                </li>
            </ul>

            <!-- Login/Register atau Dropdown User -->
            <div class="d-flex">
                @auth
                <!-- Jika user sudah login -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary d-flex align-items-center gap-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->nama).'&background=0D8ABC&color=fff' }}" alt="Avatar" class="rounded-circle" width="32" height="32">
                        <span>{{ auth()->user()->nama ?? 'Akun' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuButton">
                        <li class="dropdown-header text-center">
                            <strong>{{ auth()->user()->nama }}</strong><br>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        
                        @if(auth()->user()->role === 'admin')
                            <li><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                        @else
                            <li><a class="dropdown-item" href="/user/profil"><i class="bi bi-person-circle me-2"></i>Profil</a></li>
                        @endif

                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <!-- Jika belum login -->
                <a href="/login" class="btn btn-outline-primary me-2"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                <a href="/register" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Register</a>
            @endauth

            </div>
        </div>
    </div>
</nav>
