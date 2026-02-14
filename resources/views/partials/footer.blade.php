<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold text-primary">NasiPadang Blog</h5>
                <p class="text-muted">Platform berbagi pengetahuan untuk penulis dan pembaca. Memberikan ruang lebih bagi penulis baru untuk berkembang.</p>
            </div>
            <div class="col-md-3">
                <h6>Tautan Cepat</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                    <li><a href="{{ route('articles.index') }}" class="text-decoration-none text-muted">Jelajah Artikel</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Bantuan</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-muted">Tentang Kami</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Kontak</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="text-center text-muted">
            <small>&copy; {{ date('Y') }} Kelompok Nasi Padang. Dibuat untuk Tugas Besar IF2.</small>
        </div>
    </div>
</footer>