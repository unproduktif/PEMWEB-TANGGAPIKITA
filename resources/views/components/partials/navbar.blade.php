<nav class="navbar navbar-expand-lg navbar-dark fixed-top admin-navbar">
    <div class="container-fluid px-4">
        <!-- Logo and Toggle -->
        <div class="d-flex align-items-center">
            <button class="btn sidebar-toggle d-lg-none me-3 text-white" type="button">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                <i class="bi bi-shield-lock me-2"></i>
                <span class="brand-text">Admin Panel</span>
            </a>
        </div>

        <!-- Separate toggle for profile menu on mobile -->
        <div class="d-flex align-items-center">
            <!-- Profile dropdown - always visible -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center user-dropdown" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-container me-2">
                        <img src="{{ 
                            auth()->user()->foto ? 
                                (filter_var(auth()->user()->foto, FILTER_VALIDATE_URL) ? 
                                    auth()->user()->foto : 
                                    asset('storage/' . auth()->user()->foto)) 
                                : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->nama).'&background=fff&color=2c3e50' 
                        }}" 
                        alt="Admin Avatar" 
                        class="user-avatar"
                        onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=fff&color=2c3e50'">
                        <span class="online-status"></span>
                    </div>
                    <span class="user-name d-none d-md-inline">{{ auth()->user()->nama ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow admin-dropdown-menu" aria-labelledby="adminDropdown">
                    <li class="dropdown-header text-center py-3">
                        <div class="dropdown-avatar-container mb-2">
                            <img src="{{ 
                                auth()->user()->foto ? 
                                    (filter_var(auth()->user()->foto, FILTER_VALIDATE_URL) ? 
                                        auth()->user()->foto : 
                                        asset('storage/' . auth()->user()->foto)) 
                                    : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->nama).'&background=fff&color=2c3e50' 
                            }}" 
                            alt="Admin Avatar" 
                            class="dropdown-avatar"
                            onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=fff&color=2c3e50'">
                        </div>
                        <h6 class="mb-0">{{ auth()->user()->nama }}</h6>
                        <small class="text-muted">{{ auth()->user()->email }}</small>
                        <span class="badge admin-badge mt-1">Administrator</span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profil') }}">
                            <i class="bi bi-person-gear me-2"></i>Admin Profile
                        </a>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>
                    
                    <li>
                        <form action="/logout" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn w-100 text-start">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar Styles */
    .admin-navbar {
        background: #8DBCC7;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        height: 60px;
        transition: all 0.3s ease;
        z-index: 1030;
    }
    
    .navbar-brand {
        color: white !important;
        font-size: 1.25rem;
    }
    
    .brand-text {
        transition: all 0.3s ease;
    }
    
    .sidebar-toggle {
        font-size: 1.25rem;
        padding: 0.25rem 0.5rem;
        border: none;
        background: transparent;
    }
    
    /* User Dropdown Styles */
    .user-dropdown {
        color: white !important;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .user-dropdown:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .avatar-container {
        position: relative;
    }
    
    .user-avatar {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }
    
    .online-status {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 10px;
        height: 10px;
        background-color: #2ecc71;
        border-radius: 50%;
        border: 2px solid #2c3e50;
        animation: pulse 2s infinite;
    }
    
    .user-name {
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }
    
    /* Dropdown Menu Styles */
    .admin-dropdown-menu {
        border: none;
        border-radius: 10px;
        margin-top: 10px;
        min-width: 280px;
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .dropdown-header {
        background-color: #f8f9fa;
        border-radius: 10px 10px 0 0;
    }
    
    .dropdown-avatar-container {
        display: flex;
        justify-content: center;
    }
    
    .dropdown-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #3498db;
    }
    
    .admin-badge {
        background-color: #3498db;
        color: white;
        font-weight: 500;
        padding: 0.25rem 0.5rem;
        border-radius: 50px;
    }
    
    .dropdown-item {
        padding: 0.75rem 1.5rem;
        color: #2c3e50;
        transition: all 0.2s ease;
        border-radius: 5px;
        margin: 0.15rem 0.5rem;
        width: auto;
    }
    
    .dropdown-item:hover {
        background-color: #f1f8fe;
        color: #3498db;
        padding-left: 1.75rem !important;
    }
    
    .logout-btn:hover {
        color: #e74c3c !important;
    }
    
    /* Animation */
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .brand-text {
            display: none;
        }
        
        .user-name {
            display: none;
        }
        
        .user-dropdown {
            padding: 0.5rem;
        }
    }
</style>