@extends('layouts.app')

@section('content')
<style>
    /* Menghilangkan scroll total */
    body, html {
        height: 100%;
        overflow: hidden;
        background-color: #ffffff;
    }

    .hero-wrapper {
        height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 20px;
    }

    .main-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        letter-spacing: -2px;
        color: #1a202c;
        line-height: 1.1;
    }

    .sub-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 550px;
        margin: 20px auto;
    }

    /* Tombol Utama */
    .btn-main {
        background: #0d6efd;
        color: white;
        padding: 16px 40px;
        border-radius: 14px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        border: none;
        box-shadow: 0 4px 14px rgba(13, 110, 253, 0.3);
    }

    .btn-main:hover {
        background: #0a58ca;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.4);
        color: white;
    }

    /* Card Klik (Pengganti Link Teks) */
    .action-card {
        background: #ffffff;
        border: 2px solid #f1f5f9;
        padding: 14px 25px;
        border-radius: 14px;
        text-decoration: none;
        color: #1a202c;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .action-card:hover {
        border-color: #0d6efd;
        background: #f8faff;
        color: #0d6efd;
        transform: translateY(-2px);
    }

    .feature-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f1f5f9;
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #475569;
        margin: 5px;
    }

    .blob {
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(13, 110, 253, 0.05);
        filter: blur(80px);
        border-radius: 50%;
        z-index: -1;
    }
</style>

<div class="hero-wrapper text-center position-relative">
    <div class="blob" style="top: 10%; left: 10%;"></div>
    <div class="blob" style="bottom: 10%; right: 10%; background: rgba(0, 255, 255, 0.05);"></div>

    <div class="container">
        <div class="mb-4">
            <span class="text-primary fw-bold small text-uppercase tracking-widest bg-primary bg-opacity-10 px-3 py-2 rounded-pill">
                ✨ Tempat Cerita Berkualitas Dimulai
            </span>
        </div>

        <h1 class="main-title mb-3">
            Tulis Ceritamu.<br>
            Temukan <span class="text-primary">Inspirasimu.</span>
        </h1>

        <p class="sub-text">
            Platform sederhana untuk menulis artikel, berbagi ide, dan tumbuh bersama komunitas literasi terbaik.
        </p>

        <div class="mb-5 d-flex flex-wrap justify-content-center">
            <div class="feature-tag"><i class="fas fa-feather text-primary"></i> Editor Simpel</div>
            <div class="feature-tag"><i class="fas fa-book-reader text-primary"></i> Baca Nyaman</div>
            <div class="feature-tag"><i class="fas fa-check-double text-primary"></i> Sistem Draf</div>
        </div>

        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center align-items-center">
            @guest
                {{-- TAMPILAN JIKA BELUM LOGIN --}}
                <a href="{{ route('register') }}" class="btn-main">
                    Daftar Sekarang — Gratis
                </a>
                <a href="{{ route('articles.index') }}" class="action-card shadow-sm">
                    <i class="fas fa-book-open me-2"></i> Mulai Membaca
                </a>
            @else
                {{-- CEK ROLE USER --}}
                @if(Auth::user()->role == 'penulis')
                    {{-- TAMPILAN KHUSUS PENULIS --}}
                    <a href="{{ route('articles.create') }}" class="btn-main">
                        <i class="fas fa-plus me-2"></i> Buat Karya Baru
                    </a>
                    <a href="{{ route('articles.management') }}" class="action-card shadow-sm">
                        <i class="fas fa-tasks me-2"></i> Manajemen Artikel
                    </a>
                @else
                    {{-- TAMPILAN KHUSUS PEMBACA --}}
                    <a href="{{ route('articles.index') }}" class="btn-main">
                        <i class="fas fa-book-open me-2"></i> Mulai Membaca Artikel
                    </a>
                @endif
            @endguest
        </div>
        
        <div class="mt-5 pt-4 opacity-50 small">
            @if(Auth::check() && Auth::user()->role == 'penulis')
                <i class="fas fa-info-circle me-1"></i> Tulis 5 artikel untuk membuka lencana <strong>"Penulis Berpengalaman"</strong>
            @else
                <i class="fas fa-star text-warning me-1"></i> Jelajahi ribuan ide menarik dari penulis favorit Anda.
            @endif
        </div>
    </div>
</div>
@endsection