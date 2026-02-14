<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8faff; font-family: 'Inter', sans-serif; }
        .navbar { background: white; padding: 15px 0; border-bottom: 1px solid #edf2f7; }
        .btn-primary { background: #4e5ed4; border: none; border-radius: 50px; }
        .nav-link.active { color: #4e5ed4 !important; font-weight: bold; }
        .dropdown-menu { border-radius: 15px; padding: 10px; }
        .dropdown-item { border-radius: 8px; padding: 8px 15px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <i class="fas fa-feather-alt me-2"></i> ARTICLES
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('articles*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Daftar Artikel</a>
                    </li>
                    @auth
                        @if(Auth::user()->role == 'penulis')
                            <li class="nav-item border-start ms-lg-3 ps-lg-3">
                                <a class="nav-link text-success fw-bold" href="{{ route('articles.create') }}">
                                    <i class="fas fa-plus-circle me-1"></i> Buat Artikel
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('my-articles') ? 'active' : '' }}" href="{{ route('articles.mine') }}">
                                    Manajemen Artikel
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn text-primary fw-bold me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Daftar</a>
                    @endguest

                    @auth
                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                                <span class="fw-bold small">{{ Auth::user()->username }}</span>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                                <li>
                                    <div class="dropdown-header">
                                        <span class="badge bg-light text-primary">Aktor: {{ ucfirst(Auth::user()->role) }}</span>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>                                
                                @if(Auth::user()->role == 'penulis')
                                    <li><a class="dropdown-item" href="{{ route('articles.mine') }}"><i class="fas fa-book me-2"></i> Artikel Saya</a></li>
                                @endif

                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger fw-bold" href="javascript:void(0)" onclick="confirmLogout()">
                                        <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        @include('auth.logout')
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>