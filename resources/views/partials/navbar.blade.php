<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-newspaper"></i> RPL Artikel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li>
            </ul>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
            </div>
        </div>
    </div>
</nav>