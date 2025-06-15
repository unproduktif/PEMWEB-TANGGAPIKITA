<nav class="navbar navbar-dark bg-dark fixed-top shadow px-3">
    <a class="navbar-brand me-auto" href="#">Dashboard Admin</a>
    <div class="dropdown">
        <a class="btn btn-outline-light btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->nama ?? 'Admin' }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li>
                <a class="dropdown-item" href="{{ route('admin.profil') }}">
                    <i class="bi bi-person-circle me-2"></i>Profil
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
