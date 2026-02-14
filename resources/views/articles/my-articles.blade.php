@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold mb-1">Artikel Saya</h2>
            <p class="text-muted small mb-0">Kelola konten yang telah Anda publikasikan.</p>
        </div>
        <a href="{{ route('articles.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm">Tulis Lagi</a>
    </div>

    <div class="article-list shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="p-3 border-bottom d-none d-md-flex fw-bold text-muted small bg-light">
            <div class="flex-grow-1 ps-3">JUDUL ARTIKEL</div>
            <div style="width: 150px;">KATEGORI</div>
            <div style="width: 150px;">STATUS</div>
            <div style="width: 150px;" class="text-end pe-3">AKSI</div>
        </div>

        <div class="p-3 d-flex align-items-center border-bottom">
            <div class="flex-grow-1 ps-3">
                <div class="fw-bold">Belajar Laravel Dasar</div>
                <div class="text-muted" style="font-size: 0.75rem;">Terakhir diedit: 2 jam yang lalu</div>
            </div>
            <div style="width: 150px;"><span class="badge bg-light text-dark border">Teknologi</span></div>
            <div style="width: 150px;"><span class="text-success small fw-bold">● Publik</span></div>
            <div style="width: 150px;" class="text-end pe-3">
                <button class="btn btn-sm btn-light rounded-circle me-1"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-light text-danger rounded-circle"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection