<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #8DBCC7; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center fw-bold" href="#" style="color: #2c3e50;">
            Tanggapikita
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-3 {{ Request::is('home') ? 'active' : '' }}" href="/home" style="{{ Request::is('home') ? 'background-color: rgba(164, 204, 217, 0.5); color: #2c3e50;' : 'color: #2c3e50;' }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-3 {{ Request::is('bencana') ? 'active' : '' }}" href="/bencana" style="{{ Request::is('bencana') ? 'background-color: rgba(164, 204, 217, 0.5); color: #2c3e50;' : 'color: #2c3e50;' }}">
                        <i class="bi bi-exclamation-triangle me-1"></i> Bencana
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-3 {{ Request::is('laporan-saya') ? 'active' : '' }}" href="{{ route('laporan.index') }}" style="{{ Request::is('laporan-saya') ? 'background-color: rgba(164, 204, 217, 0.5); color: #2c3e50;' : 'color: #2c3e50;' }}">
                        <i class="bi bi-megaphone me-1"></i> Lapor
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-3 {{ Request::is('donasi') ? 'active' : '' }}" href="/donasi" style="{{ Request::is('donasi') ? 'background-color: rgba(164, 204, 217, 0.5); color: #2c3e50;' : 'color: #2c3e50;' }}">
                        <i class="bi bi-heart me-1"></i> Donasi
                    </a>
                </li>
            </ul>

            <!-- Auth Section -->
            <div class="d-flex align-items-center">
                @auth
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2 dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: #2c3e50;">
                            <div class="position-relative">
                                <img src="{{ 
                                    auth()->user()->foto ? 
                                        (filter_var(auth()->user()->foto, FILTER_VALIDATE_URL) ? 
                                            auth()->user()->foto : 
                                            asset('storage/' . auth()->user()->foto)) 
                                        : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->nama).'&background=2c3e50&color=fff' 
                                }}" 
                                alt="Avatar" 
                                class="rounded-circle" 
                                width="36" 
                                height="36" 
                                style="object-fit: cover; border: 2px solid #A4CCD9;"
                                onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=2c3e50&color=fff'">
                            </div>
                            <span class="d-none d-lg-inline">{{ auth()->user()->nama ?? 'Akun' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userDropdown" style="background-color: #EBFFD8; border: none;">
                            <li class="dropdown-header text-center py-2" style="background-color: rgba(164, 204, 217, 0.3);">
                                <div class="d-flex justify-content-center mb-2">
                                    <img src="{{ 
                                        auth()->user()->foto ? 
                                            (filter_var(auth()->user()->foto, FILTER_VALIDATE_URL) ? 
                                                auth()->user()->foto : 
                                                asset('storage/' . auth()->user()->foto)) 
                                            : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->nama).'&background=2c3e50&color=fff' 
                                    }}" 
                                    alt="Avatar" 
                                    class="rounded-circle" 
                                    width="36" 
                                    height="36" 
                                    style="object-fit: cover; border: 2px solid #A4CCD9;"
                                    onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=2c3e50&color=fff'">
                                </div>
                                <strong class="d-block">{{ auth()->user()->nama }}</strong>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </li>
                            <li><hr class="dropdown-divider" style="border-color: var(--secondary);"></li>
                            
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item py-2" href="/admin/dashboard" style="transition: all 0.3s; color: #2c3e50;">
                                        <i class="bi bi-speedometer2 me-2" style="color: #8DBCC7;"></i>Dashboard Admin
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('profil') }}" style="transition: all 0.3s; color: #2c3e50;">
                                        <i class="bi bi-person-circle me-2" style="color: #8DBCC7;"></i>Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('donasi.riwayat') }}" style="transition: all 0.3s; color: #2c3e50;">
                                        <i class="bi bi-clock-history me-2" style="color: #8DBCC7;"></i>Riwayat Donasi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('donasi.kelola') }}" style="transition: all 0.3s; color: #2c3e50;">
                                        <i class="bi bi-gear me-2" style="color: #8DBCC7;"></i>Kelola Donasi
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider" style="border-color: var(--secondary);"></li>
                            <li>
                                <form action="/logout" method="POST" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 w-100 text-start" style="transition: all 0.3s; color: #2c3e50;">
                                        <i class="bi bi-box-arrow-right me-2" style="color: #8DBCC7;"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Login/Register Buttons -->
                    <a href="/login" class="btn btn-outline-dark me-2 px-3" style="border-color: #2c3e50; transition: all 0.3s;">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                    <a href="/register" class="btn px-3" style="background-color: #A4CCD9; color: #2c3e50; transition: all 0.3s;">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>