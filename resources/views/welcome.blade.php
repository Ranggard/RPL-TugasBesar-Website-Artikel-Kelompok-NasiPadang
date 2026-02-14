<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Artikel - Platform Penulis Baru</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --new-author-color: #ffb703;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --card-hover-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 56px;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 30px 30px;
        }
        
        .article-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 1.5rem;
            height: 100%;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .new-author-badge {
            background-color: var(--new-author-color);
            color: #000;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .article-category {
            display: inline-block;
            background-color: #e9ecef;
            color: #495057;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .article-stats {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .article-stats i {
            margin-right: 0.25rem;
        }
        
        .guidance-section {
            background-color: #e3f2fd;
            border-left: 5px solid var(--primary-color);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        
        .guidance-icon {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .login-modal .modal-content {
            border-radius: 15px;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .feature-card {
            text-align: center;
            padding: 2rem;
            border-radius: 15px;
            background-color: white;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .article-image {
            height: 200px;
            background: linear-gradient(45deg, #4361ee, #4cc9f0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        
        .trending-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--warning-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .recommended-section {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-top: 3rem;
        }
        
        .footer {
            background-color: #343a40;
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }
        
        .alert-toast {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
        }
        
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .create-article-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 100;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
                text-align: center;
            }
            
            .article-card {
                margin-bottom: 1rem;
            }
            
            .create-article-btn {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loader"></div>
    </div>

    <!-- Toast Notifications -->
    <div id="toastContainer" class="alert-toast"></div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-newspaper me-2"></i>ArticlePlatform
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="loadArticles()">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#articles" onclick="loadArticles()">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                </ul>
                <div class="d-flex" id="authButtons">
                    <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="fas fa-sign-in-alt me-1"></i> Masuk
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i class="fas fa-user-plus me-1"></i> Daftar
                    </button>
                </div>
                <div class="d-flex align-items-center" id="userMenu" style="display: none;">
                    <span class="me-3" id="userGreeting"></span>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" id="myArticlesBtn">Artikel Saya</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#createArticleModal">Tulis Artikel</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="logout()">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3" id="heroTitle">Platform untuk Penulis Baru</h1>
                    <p class="lead mb-4" id="heroDescription">Mulai perjalanan menulis Anda dengan panduan khusus, sistem rekomendasi, dan dukungan komunitas untuk membantu Anda berkembang sebagai penulis.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-light text-dark p-2"><i class="fas fa-check-circle me-1 text-success"></i> Panduan Penulis Baru</span>
                        <span class="badge bg-light text-dark p-2"><i class="fas fa-check-circle me-1 text-success"></i> Rekomendasi Artikel</span>
                        <span class="badge bg-light text-dark p-2"><i class="fas fa-check-circle me-1 text-success"></i> Statistik Interaksi</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="article-image rounded-3 shadow-lg">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Guidance Section -->
    <div class="container">
        <div class="guidance-section" id="guidanceSection">
            <div class="d-flex align-items-start">
                <div class="guidance-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-2">Tips untuk Penulis Baru</h4>
                    <p class="mb-2">Selamat datang di komunitas penulis kami! Berikut beberapa tips untuk memulai perjalanan menulis Anda:</p>
                    <ul class="mb-0">
                        <li>Menulislah secara teratur untuk membangun audiens Anda</li>
                        <li>Terlibatlah dengan pembaca melalui komentar</li>
                        <li>Gunakan kategori yang relevan untuk visibilitas yang lebih baik</li>
                        <li>Fokus pada kualitas konten daripada kuantitas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Articles Section -->
    <section class="container" id="articles">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Artikel Terbaru</h2>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="loadArticles()">Semua Artikel</a></li>
                    <li><a class="dropdown-item" href="#" onclick="loadArticles('new')">Penulis Baru</a></li>
                    <li><a class="dropdown-item" href="#" onclick="loadArticles('popular')">Terpopuler</a></li>
                </ul>
            </div>
        </div>

        <div class="row" id="articlesContainer">
            <div class="col-12 text-center">
                <div class="loader"></div>
                <p class="mt-2">Memuat artikel...</p>
            </div>
        </div>
        
        <!-- Pagination -->
        <nav id="paginationContainer" class="mt-4">
            <ul class="pagination justify-content-center">
                <!-- Pagination akan di-generate oleh JavaScript -->
            </ul>
        </nav>
    </section>

    <!-- Recommended Articles Section -->
    <section class="recommended-section" id="recommended">
        <div class="container">
            <h3 class="fw-bold mb-4 text-center">
                <i class="fas fa-star me-2 text-warning"></i>Rekomendasi untuk Anda
            </h3>
            <div class="row" id="recommendedArticlesContainer">
                <div class="col-12 text-center">
                    <div class="loader"></div>
                    <p class="mt-2">Memuat rekomendasi...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container my-5" id="features">
        <h2 class="fw-bold text-center mb-5">Fitur Platform Kami</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="fw-bold">Panduan Penulis Baru</h4>
                    <p class="text-muted">Dapatkan tips dan panduan khusus untuk membantu Anda memulai perjalanan menulis dengan baik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="fw-bold">Promosi Otomatis</h4>
                    <p class="text-muted">Setelah menerbitkan 5 artikel, status Anda akan naik menjadi penulis berpengalaman.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="fw-bold">Interaksi Komunitas</h4>
                    <p class="text-muted">Berinteraksi dengan pembaca melalui komentar dan likes untuk mendapatkan umpan balik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-newspaper me-2"></i>ArticlePlatform
                    </h4>
                    <p>Platform untuk penulis baru untuk mengembangkan keterampilan menulis dan berinteraksi dengan pembaca.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none" onclick="loadArticles()">Beranda</a></li>
                        <li class="mb-2"><a href="#articles" class="text-white text-decoration-none" onclick="loadArticles()">Artikel</a></li>
                        <li class="mb-2"><a href="#features" class="text-white text-decoration-none">Fitur</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">Kategori</h5>
                    <div class="d-flex flex-wrap gap-2" id="categoriesList">
                        <!-- Kategori akan diisi oleh JavaScript -->
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> support@articleplatform.com</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (021) 1234-5678</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center pt-3">
                <p class="mb-0">&copy; 2023 ArticlePlatform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Masuk ke Akun Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" placeholder="nama@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Masukkan password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ingat saya</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-1"></i> Masuk
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Belum punya akun? <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Akun Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="registerUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="registerUsername" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" placeholder="nama@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerRole" class="form-label">Saya ingin mendaftar sebagai:</label>
                            <select class="form-select" id="registerRole" required>
                                <option value="">Pilih peran</option>
                                <option value="author">Penulis</option>
                                <option value="reader">Pembaca</option>
                            </select>
                            <div class="form-text">Penulis baru akan mendapatkan panduan khusus dan rekomendasi.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-user-plus me-1"></i> Daftar
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Sudah punya akun? <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Article Modal -->
    <div class="modal fade" id="createArticleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tulis Artikel Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createArticleForm">
                        <div class="mb-3">
                            <label for="articleTitle" class="form-label">Judul Artikel</label>
                            <input type="text" class="form-control" id="articleTitle" placeholder="Masukkan judul artikel" required>
                        </div>
                        <div class="mb-3">
                            <label for="articleContent" class="form-label">Konten Artikel</label>
                            <textarea class="form-control" id="articleContent" rows="10" placeholder="Tulis konten artikel di sini..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <div id="categoriesCheckboxes" class="d-flex flex-wrap gap-2">
                                <!-- Kategori akan diisi oleh JavaScript -->
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="saveAsDraft">
                            <label class="form-check-label" for="saveAsDraft">Simpan sebagai draft</label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Detail Modal -->
    <div class="modal fade" id="articleDetailModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailArticleTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="author-avatar me-2" id="detailAuthorAvatar"></div>
                            <div>
                                <h6 class="mb-0 fw-bold" id="detailAuthorName"></h6>
                                <small class="text-muted" id="detailPublishedDate"></small>
                            </div>
                        </div>
                        <div id="detailArticleBadges"></div>
                    </div>
                    
                    <div class="mb-4" id="detailCategories"></div>
                    
                    <div class="article-content mb-4" id="detailArticleContent"></div>
                    
                    <div class="d-flex justify-content-between article-stats mb-4" id="detailArticleStats">
                        <!-- Stats akan diisi oleh JavaScript -->
                    </div>
                    
                    <!-- Comments Section -->
                    <div class="comments-section">
                        <h6 class="fw-bold mb-3">Komentar (<span id="commentsCount">0</span>)</h6>
                        <div id="commentsList" class="mb-3">
                            <!-- Komentar akan diisi oleh JavaScript -->
                        </div>
                        
                        <!-- Add Comment Form (only if logged in) -->
                        <form id="addCommentForm" style="display: none;">
                            <div class="mb-3">
                                <textarea class="form-control" id="commentContent" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Kirim Komentar</button>
                        </form>
                        <div id="loginToComment" class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Silakan <a href="#" class="alert-link" data-bs-toggle="modal" data-bs-target="#loginModal">masuk</a> untuk menambahkan komentar.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <button class="btn btn-outline-danger btn-sm" id="likeButton" onclick="toggleLike()">
                                <i class="fas fa-heart"></i> <span id="likeCount">0</span>
                            </button>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Article Button (Floating) -->
    <button class="btn btn-primary create-article-btn" id="createArticleBtn" style="display: none;" data-bs-toggle="modal" data-bs-target="#createArticleModal">
        <i class="fas fa-pen"></i>
    </button>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
        // Global variables
        let currentUser = null;
        let currentToken = null;
        let categories = [];
        let currentArticleId = null;
        let isLiked = false;

        // API Base URL
        const API_BASE_URL = window.location.origin + '/api';

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            checkAuthStatus();
            loadArticles();
            loadCategories();
            setupEventListeners();
            setupSmoothScrolling();
        });

        // Setup event listeners
        function setupEventListeners() {
            // Login form
            document.getElementById('loginForm').addEventListener('submit', handleLogin);
            
            // Register form
            document.getElementById('registerForm').addEventListener('submit', handleRegister);
            
            // Create article form
            document.getElementById('createArticleForm').addEventListener('submit', handleCreateArticle);
            
            // Add comment form
            document.getElementById('addCommentForm').addEventListener('submit', handleAddComment);
            
            // My articles button
            document.getElementById('myArticlesBtn')?.addEventListener('click', loadMyArticles);
        }

        // Setup smooth scrolling
        function setupSmoothScrolling() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }

        // Check authentication status
        function checkAuthStatus() {
            const token = localStorage.getItem('auth_token');
            const user = localStorage.getItem('auth_user');
            
            if (token && user) {
                currentToken = token;
                currentUser = JSON.parse(user);
                updateUIForLoggedInUser();
            }
        }

        // Update UI for logged in user
        function updateUIForLoggedInUser() {
            // Show user menu, hide auth buttons
            document.getElementById('authButtons').style.display = 'none';
            document.getElementById('userMenu').style.display = 'flex';
            document.getElementById('userGreeting').textContent = `Halo, ${currentUser.username}!`;
            
            // Show create article button if user is author
            if (currentUser.role === 'author') {
                document.getElementById('createArticleBtn').style.display = 'flex';
            }
            
            // Update guidance section for new authors
            if (currentUser.role === 'author' && currentUser.isNewAuthor) {
                updateGuidanceForNewAuthor();
            }
            
            // Update hero section
            updateHeroSection();
        }

        // Update guidance section for new authors
        function updateGuidanceForNewAuthor() {
            const guidanceSection = document.getElementById('guidanceSection');
            guidanceSection.innerHTML = `
                <div class="d-flex align-items-start">
                    <div class="guidance-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-2">Selamat datang, ${currentUser.username}!</h4>
                        <p class="mb-2">Anda telah berhasil masuk sebagai penulis baru. Berikut beberapa tips untuk memulai:</p>
                        <ul class="mb-0">
                            <li>Buat artikel pertama Anda dengan mengklik tombol <i class="fas fa-pen"></i></li>
                            <li>Gunakan kategori yang relevan untuk artikel Anda</li>
                            <li>Terbitkan 5 artikel untuk naik status menjadi penulis berpengalaman</li>
                            <li>Jangan lupa berinteraksi dengan pembaca melalui komentar</li>
                        </ul>
                    </div>
                </div>
            `;
        }

        // Update hero section based on user role
        function updateHeroSection() {
            const heroTitle = document.getElementById('heroTitle');
            const heroDescription = document.getElementById('heroDescription');
            
            if (currentUser) {
                if (currentUser.role === 'author') {
                    if (currentUser.isNewAuthor) {
                        heroTitle.textContent = 'Selamat Datang, Penulis Baru!';
                        heroDescription.textContent = 'Mulai perjalanan menulismu dengan panduan khusus dan dukungan komunitas kami.';
                    } else {
                        heroTitle.textContent = 'Selamat Datang Kembali, Penulis Berpengalaman!';
                        heroDescription.textContent = 'Terus berkarya dan bagikan pengetahuanmu dengan komunitas penulis kami.';
                    }
                } else {
                    heroTitle.textContent = 'Selamat Datang, Pembaca!';
                    heroDescription.textContent = 'Temukan artikel menarik dari penulis baru dan berpengalaman di platform kami.';
                }
            }
        }

        // Handle login
        async function handleLogin(e) {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            try {
                showLoading();
                
                const response = await axios.post(`${API_BASE_URL}/login`, {
                    email: email,
                    password: password
                });
                
                if (response.data.token) {
                    // Save token and user data
                    currentToken = response.data.token;
                    currentUser = response.data.user;
                    
                    localStorage.setItem('auth_token', currentToken);
                    localStorage.setItem('auth_user', JSON.stringify(currentUser));
                    
                    // Update UI
                    updateUIForLoggedInUser();
                    
                    // Close modal and show success message
                    bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
                    showToast('Login berhasil!', 'success');
                    
                    // Clear form
                    document.getElementById('loginForm').reset();
                    
                    // Reload articles
                    loadArticles();
                }
            } catch (error) {
                showToast('Login gagal. Periksa email dan password Anda.', 'danger');
                console.error('Login error:', error);
            } finally {
                hideLoading();
            }
        }

        // Handle register
        async function handleRegister(e) {
            e.preventDefault();
            
            const username = document.getElementById('registerUsername').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const role = document.getElementById('registerRole').value;
            
            if (!role) {
                showToast('Pilih peran terlebih dahulu.', 'warning');
                return;
            }
            
            try {
                showLoading();
                
                const response = await axios.post(`${API_BASE_URL}/register`, {
                    username: username,
                    email: email,
                    password: password,
                    role: role
                });
                
                // Close modal and show success message
                bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
                showToast('Pendaftaran berhasil! Silakan login.', 'success');
                
                // Clear form
                document.getElementById('registerForm').reset();
                
                // Auto-open login modal
                setTimeout(() => {
                    document.getElementById('loginEmail').value = email;
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('loginModal')).show();
                }, 500);
                
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = error.response.data.errors;
                    const errorMessage = Object.values(errors).join(' ');
                    showToast(errorMessage, 'danger');
                } else {
                    showToast('Pendaftaran gagal. Silakan coba lagi.', 'danger');
                }
                console.error('Register error:', error);
            } finally {
                hideLoading();
            }
        }

        // Handle logout
        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                // In a real implementation, you would call the logout API
                // For now, we just clear local storage
                localStorage.removeItem('auth_token');
                localStorage.removeItem('auth_user');
                
                currentToken = null;
                currentUser = null;
                
                // Update UI
                document.getElementById('authButtons').style.display = 'flex';
                document.getElementById('userMenu').style.display = 'none';
                document.getElementById('createArticleBtn').style.display = 'none';
                
                // Reset guidance section
                document.getElementById('guidanceSection').innerHTML = `
                    <div class="d-flex align-items-start">
                        <div class="guidance-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-2">Tips untuk Penulis Baru</h4>
                            <p class="mb-2">Selamat datang di komunitas penulis kami! Berikut beberapa tips untuk memulai perjalanan menulis Anda:</p>
                            <ul class="mb-0">
                                <li>Menulislah secara teratur untuk membangun audiens Anda</li>
                                <li>Terlibatlah dengan pembaca melalui komentar</li>
                                <li>Gunakan kategori yang relevan untuk visibilitas yang lebih baik</li>
                                <li>Fokus pada kualitas konten daripada kuantitas</li>
                            </ul>
                        </div>
                    </div>
                `;
                
                // Reset hero section
                document.getElementById('heroTitle').textContent = 'Platform untuk Penulis Baru';
                document.getElementById('heroDescription').textContent = 'Mulai perjalanan menulis Anda dengan panduan khusus, sistem rekomendasi, dan dukungan komunitas untuk membantu Anda berkembang sebagai penulis.';
                
                showToast('Anda telah berhasil keluar.', 'info');
            }
        }

        // Load articles
        async function loadArticles(filter = '') {
            try {
                showLoading();
                
                let url = `${API_BASE_URL}/articles`;
                
                // Add filter if specified
                if (filter === 'new') {
                    // This would require a backend endpoint for filtering by new authors
                    // For now, we'll just load all articles and filter client-side
                } else if (filter === 'popular') {
                    // This would require a backend endpoint for popular articles
                }
                
                const config = currentToken ? {
                    headers: { Authorization: `Bearer ${currentToken}` }
                } : {};
                
                const response = await axios.get(url, config);
                
                // Display articles
                displayArticles(response.data.articles?.data || []);
                
                // Display recommended articles
                if (response.data.recommended_articles) {
                    displayRecommendedArticles(response.data.recommended_articles);
                }
                
                // Display pagination
                if (response.data.articles?.links) {
                    displayPagination(response.data.articles);
                }
                
            } catch (error) {
                console.error('Error loading articles:', error);
                showToast('Gagal memuat artikel.', 'danger');
                
                // Fallback to sample data if API fails
                displaySampleArticles();
            } finally {
                hideLoading();
            }
        }

        // Load my articles (for authors)
        async function loadMyArticles() {
            if (!currentUser || currentUser.role !== 'author') {
                showToast('Hanya penulis yang dapat melihat artikel mereka sendiri.', 'warning');
                return;
            }
            
            try {
                showLoading();
                
                // Note: This endpoint doesn't exist yet in your backend
                // You would need to create it in ArticleController
                const response = await axios.get(`${API_BASE_URL}/my-articles`, {
                    headers: { Authorization: `Bearer ${currentToken}` }
                });
                
                displayArticles(response.data.articles || []);
                showToast('Menampilkan artikel Anda.', 'info');
                
            } catch (error) {
                console.error('Error loading my articles:', error);
                showToast('Gagal memuat artikel Anda.', 'danger');
            } finally {
                hideLoading();
            }
        }

        // Load categories
        async function loadCategories() {
            try {
                // Note: You need to create a categories endpoint in your backend
                // For now, we'll use sample categories
                categories = [
                    { categoryId: 1, name: 'Teknologi', description: 'Artikel tentang teknologi' },
                    { categoryId: 2, name: 'Pendidikan', description: 'Artikel tentang pendidikan' },
                    { categoryId: 3, name: 'Kesehatan', description: 'Artikel tentang kesehatan' },
                    { categoryId: 4, name: 'Bisnis', description: 'Artikel tentang bisnis' },
                    { categoryId: 5, name: 'Hiburan', description: 'Artikel tentang hiburan' },
                ];
                
                // Display categories in footer
                displayCategories();
                
                // Display categories in create article modal
                displayCategoriesForArticleForm();
                
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        }

        // Display articles
        function displayArticles(articles) {
            const container = document.getElementById('articlesContainer');
            
            if (articles.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada artikel</h5>
                        <p class="text-muted">Jadilah yang pertama menulis artikel!</p>
                        ${currentUser?.role === 'author' ? 
                            `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createArticleModal">
                                <i class="fas fa-pen me-1"></i>Tulis Artikel Pertama
                            </button>` : 
                            ''
                        }
                    </div>
                `;
                return;
            }
            
            let html = '';
            
            articles.forEach(article => {
                // Format date
                const publishedDate = article.publishedAt ? 
                    new Date(article.publishedAt).toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }) : 'Belum diterbitkan';
                
                // Get author info
                const authorName = article.author?.username || 'Unknown Author';
                const isNewAuthor = article.author?.isNewAuthor || false;
                
                // Get categories
                const articleCategories = article.categories || [];
                
                // Get stats
                const viewCount = article.viewCount || 0;
                const commentCount = article.comments?.length || 0;
                const likeCount = article.likes?.length || 0;
                
                // Determine if trending (example logic)
                const isTrending = viewCount > 100;
                
                html += `
                    <div class="col-lg-6">
                        <div class="card article-card">
                            ${isTrending ? '<div class="trending-badge"><i class="fas fa-fire me-1"></i>Trending</div>' : ''}
                            <div class="article-image" onclick="viewArticleDetail(${article.articleId || article.id})" style="cursor: pointer;"></div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="author-avatar me-2">
                                            ${authorName.charAt(0).toUpperCase()}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">${authorName}</h6>
                                            <small class="text-muted">${publishedDate}</small>
                                        </div>
                                    </div>
                                    ${isNewAuthor ? '<span class="new-author-badge"><i class="fas fa-seedling me-1"></i>Penulis Baru</span>' : ''}
                                </div>
                                
                                <h5 class="card-title fw-bold" style="cursor: pointer;" onclick="viewArticleDetail(${article.articleId || article.id})">
                                    ${article.title}
                                </h5>
                                <p class="card-text text-muted">${article.content?.substring(0, 150)}${article.content?.length > 150 ? '...' : ''}</p>
                                
                                <div class="mb-3">
                                    ${articleCategories.map(cat => 
                                        `<span class="article-category">${cat.name}</span>`
                                    ).join('')}
                                </div>
                                
                                <div class="d-flex justify-content-between article-stats">
                                    <div>
                                        <i class="fas fa-eye"></i> ${viewCount} views
                                    </div>
                                    <div>
                                        <i class="fas fa-comment"></i> ${commentCount} comments
                                    </div>
                                    <div>
                                        <i class="fas fa-heart"></i> ${likeCount} likes
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-outline-primary btn-sm" onclick="viewArticleDetail(${article.articleId || article.id})">
                                        <i class="fas fa-book-reader me-1"></i> Baca Artikel
                                    </button>
                                    <div>
                                        <button class="btn btn-outline-danger btn-sm me-1" onclick="toggleLikeFromList(${article.articleId || article.id})">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="viewArticleDetail(${article.articleId || article.id})">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }

        // Display recommended articles
        function displayRecommendedArticles(articles) {
            const container = document.getElementById('recommendedArticlesContainer');
            
            if (!articles || articles.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada rekomendasi artikel.</p>
                    </div>
                `;
                return;
            }
            
            let html = '';
            
            articles.slice(0, 3).forEach(article => {
                const authorName = article.author?.username || 'Unknown Author';
                const isNewAuthor = article.author?.isNewAuthor || false;
                const viewCount = article.viewCount || 0;
                
                html += `
                    <div class="col-md-4">
                        <div class="card article-card h-100">
                            <div class="card-body">
                                ${isNewAuthor ? '<span class="new-author-badge"><i class="fas fa-seedling me-1"></i>Penulis Baru</span>' : ''}
                                <h5 class="card-title fw-bold">${article.title}</h5>
                                <p class="card-text text-muted">${article.content?.substring(0, 100)}${article.content?.length > 100 ? '...' : ''}</p>
                                
                                <div class="mb-3">
                                    ${(article.categories || []).map(cat => 
                                        `<span class="article-category">${cat.name}</span>`
                                    ).join('')}
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="article-stats">
                                        <i class="fas fa-eye"></i> ${viewCount} views
                                    </div>
                                    <button class="btn btn-primary btn-sm" onclick="viewArticleDetail(${article.articleId || article.id})">
                                        Baca
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }

        // Display categories
        function displayCategories() {
            const container = document.getElementById('categoriesList');
            
            if (categories.length === 0) {
                container.innerHTML = '<span class="text-muted">Belum ada kategori</span>';
                return;
            }
            
            let html = '';
            categories.slice(0, 5).forEach(category => {
                html += `<span class="article-category bg-light">${category.name}</span>`;
            });
            
            container.innerHTML = html;
        }

        // Display categories for article form
        function displayCategoriesForArticleForm() {
            const container = document.getElementById('categoriesCheckboxes');
            
            if (categories.length === 0) {
                container.innerHTML = '<p class="text-muted">Belum ada kategori</p>';
                return;
            }
            
            let html = '';
            categories.forEach(category => {
                html += `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="${category.categoryId}" id="category-${category.categoryId}">
                        <label class="form-check-label" for="category-${category.categoryId}">
                            ${category.name}
                        </label>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }

        // Display pagination
        function displayPagination(paginationData) {
            const container = document.getElementById('paginationContainer');
            const links = paginationData.links;
            
            if (!links || links.length <= 3) {
                container.style.display = 'none';
                return;
            }
            
            let html = '<ul class="pagination justify-content-center">';
            
            links.forEach(link => {
                if (link.url) {
                    const activeClass = link.active ? 'active' : '';
                    const pageNum = link.label;
                    
                    html += `
                        <li class="page-item ${activeClass}">
                            <a class="page-link" href="#" onclick="loadPage('${link.url}'); return false;">
                                ${pageNum}
                            </a>
                        </li>
                    `;
                }
            });
            
            html += '</ul>';
            container.innerHTML = html;
            container.style.display = 'block';
        }

        // Load a specific page
        async function loadPage(url) {
            try {
                showLoading();
                
                const config = currentToken ? {
                    headers: { Authorization: `Bearer ${currentToken}` }
                } : {};
                
                const response = await axios.get(url, config);
                
                displayArticles(response.data.articles?.data || []);
                
                // Scroll to articles section
                document.getElementById('articles').scrollIntoView({ behavior: 'smooth' });
                
            } catch (error) {
                console.error('Error loading page:', error);
                showToast('Gagal memuat halaman.', 'danger');
            } finally {
                hideLoading();
            }
        }

        // Handle create article
        async function handleCreateArticle(e) {
            e.preventDefault();
            
            if (!currentUser || currentUser.role !== 'author') {
                showToast('Hanya penulis yang dapat membuat artikel.', 'warning');
                return;
            }
            
            const title = document.getElementById('articleTitle').value;
            const content = document.getElementById('articleContent').value;
            const isDraft = document.getElementById('saveAsDraft').checked;
            
            // Get selected categories
            const selectedCategories = [];
            document.querySelectorAll('#categoriesCheckboxes input:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.value);
            });
            
            try {
                showLoading();
                
                const response = await axios.post(`${API_BASE_URL}/articles`, {
                    title: title,
                    content: content,
                    categories: selectedCategories,
                    isDraft: isDraft
                }, {
                    headers: { Authorization: `Bearer ${currentToken}` }
                });
                
                // Close modal and show success message
                bootstrap.Modal.getInstance(document.getElementById('createArticleModal')).hide();
                showToast(isDraft ? 'Artikel disimpan sebagai draft!' : 'Artikel berhasil dibuat!', 'success');
                
                // Clear form
                document.getElementById('createArticleForm').reset();
                
                // Reload articles
                loadArticles();
                
                // Show guidance if it exists in response
                if (response.data.guidance) {
                    console.log('Guidance for new author:', response.data.guidance);
                }
                
            } catch (error) {
                if (error.response?.data?.message) {
                    showToast(error.response.data.message, 'danger');
                } else {
                    showToast('Gagal membuat artikel. Silakan coba lagi.', 'danger');
                }
                console.error('Create article error:', error);
            } finally {
                hideLoading();
            }
        }

        // View article detail
        async function viewArticleDetail(articleId) {
            currentArticleId = articleId;
            
            try {
                showLoading();
                
                const url = `${API_BASE_URL}/articles/${articleId}`;
                const config = currentToken ? {
                    headers: { Authorization: `Bearer ${currentToken}` }
                } : {};
                
                const response = await axios.get(url, config);
                const article = response.data;
                
                // Update modal content
                document.getElementById('detailArticleTitle').textContent = article.title;
                document.getElementById('detailAuthorAvatar').textContent = article.author?.username?.charAt(0).toUpperCase() || 'A';
                document.getElementById('detailAuthorName').textContent = article.author?.username || 'Unknown Author';
                document.getElementById('detailPublishedDate').textContent = article.publishedAt ? 
                    new Date(article.publishedAt).toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }) : 'Belum diterbitkan';
                
                // Badges
                let badgesHtml = '';
                if (article.author?.isNewAuthor) {
                    badgesHtml += '<span class="new-author-badge"><i class="fas fa-seedling me-1"></i>Penulis Baru</span> ';
                }
                if (article.viewCount > 100) {
                    badgesHtml += '<span class="trending-badge"><i class="fas fa-fire me-1"></i>Trending</span>';
                }
                document.getElementById('detailArticleBadges').innerHTML = badgesHtml;
                
                // Categories
                const categoriesHtml = (article.categories || []).map(cat => 
                    `<span class="article-category">${cat.name}</span>`
                ).join('');
                document.getElementById('detailCategories').innerHTML = categoriesHtml || '<span class="text-muted">Tidak ada kategori</span>';
                
                // Content
                document.getElementById('detailArticleContent').innerHTML = `
                    <div style="white-space: pre-wrap; line-height: 1.6;">${article.content}</div>
                `;
                
                // Stats
                const viewCount = article.viewCount || 0;
                const commentCount = article.comments?.length || 0;
                const likeCount = article.likes?.length || 0;
                
                document.getElementById('detailArticleStats').innerHTML = `
                    <div><i class="fas fa-eye"></i> ${viewCount} views</div>
                    <div><i class="fas fa-comment"></i> ${commentCount} comments</div>
                    <div><i class="fas fa-heart"></i> ${likeCount} likes</div>
                `;
                
                // Comments
                document.getElementById('commentsCount').textContent = commentCount;
                displayComments(article.comments || []);
                
                // Like button
                isLiked = checkIfLiked(article.likes || []);
                updateLikeButton();
                
                // Show/hide comment form based on login status
                if (currentUser) {
                    document.getElementById('addCommentForm').style.display = 'block';
                    document.getElementById('loginToComment').style.display = 'none';
                } else {
                    document.getElementById('addCommentForm').style.display = 'none';
                    document.getElementById('loginToComment').style.display = 'block';
                }
                
                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('articleDetailModal'));
                modal.show();
                
            } catch (error) {
                console.error('Error loading article detail:', error);
                showToast('Gagal memuat detail artikel.', 'danger');
            } finally {
                hideLoading();
            }
        }

        // Display comments
        function displayComments(comments) {
            const container = document.getElementById('commentsList');
            
            if (comments.length === 0) {
                container.innerHTML = '<p class="text-muted text-center">Belum ada komentar. Jadilah yang pertama berkomentar!</p>';
                return;
            }
            
            let html = '';
            comments.forEach(comment => {
                const commentDate = new Date(comment.created_at).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                html += `
                    <div class="card mb-2">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between">
                                <strong>${comment.user?.username || 'Unknown User'}</strong>
                                <small class="text-muted">${commentDate}</small>
                            </div>
                            <p class="mb-0 mt-1">${comment.content}</p>
                            ${currentUser && comment.userId === currentUser.userid ? 
                                `<small>
                                    <a href="#" class="text-danger" onclick="deleteComment(${comment.commentId})">Hapus</a>
                                </small>` : 
                                ''
                            }
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }

        // Check if current user liked the article
        function checkIfLiked(likes) {
            if (!currentUser) return false;
            return likes.some(like => like.userId === currentUser.userid);
        }

        // Update like button
        function updateLikeButton() {
            const likeButton = document.getElementById('likeButton');
            const likeCountElement = document.getElementById('likeCount');
            
            // Note: We need to get the actual like count from somewhere
            // For now, we'll use a placeholder
            const likeCount = parseInt(likeCountElement.textContent) || 0;
            
            if (isLiked) {
                likeButton.classList.remove('btn-outline-danger');
                likeButton.classList.add('btn-danger');
                likeButton.innerHTML = `<i class="fas fa-heart"></i> <span id="likeCount">${likeCount}</span>`;
            } else {
                likeButton.classList.remove('btn-danger');
                likeButton.classList.add('btn-outline-danger');
                likeButton.innerHTML = `<i class="far fa-heart"></i> <span id="likeCount">${likeCount}</span>`;
            }
        }

        // Toggle like
        async function toggleLike() {
            if (!currentUser) {
                showToast('Silakan login untuk menyukai artikel.', 'warning');
                return;
            }
            
            try {
                if (isLiked) {
                    // Unlike
                    await axios.delete(`${API_BASE_URL}/articles/${currentArticleId}/unlike`, {
                        headers: { Authorization: `Bearer ${currentToken}` }
                    });
                    isLiked = false;
                    showToast('Artikel tidak disukai.', 'info');
                } else {
                    // Like
                    await axios.post(`${API_BASE_URL}/articles/${currentArticleId}/like`, {}, {
                        headers: { Authorization: `Bearer ${currentToken}` }
                    });
                    isLiked = true;
                    showToast('Artikel disukai!', 'success');
                }
                
                updateLikeButton();
                
                // Update like count
                const likeCountElement = document.getElementById('likeCount');
                let likeCount = parseInt(likeCountElement.textContent) || 0;
                likeCount = isLiked ? likeCount + 1 : likeCount - 1;
                likeCountElement.textContent = Math.max(0, likeCount);
                
            } catch (error) {
                console.error('Error toggling like:', error);
                showToast('Gagal memperbarui suka.', 'danger');
            }
        }

        // Toggle like from list
        async function toggleLikeFromList(articleId) {
            if (!currentUser) {
                showToast('Silakan login untuk menyukai artikel.', 'warning');
                return;
            }
            
            try {
                // Check if already liked
                const checkResponse = await axios.get(`${API_BASE_URL}/articles/${articleId}`, {
                    headers: { Authorization: `Bearer ${currentToken}` }
                });
                
                const article = checkResponse.data;
                const alreadyLiked = (article.likes || []).some(like => like.userId === currentUser.userid);
                
                if (alreadyLiked) {
                    // Unlike
                    await axios.delete(`${API_BASE_URL}/articles/${articleId}/unlike`, {
                        headers: { Authorization: `Bearer ${currentToken}` }
                    });
                    showToast('Artikel tidak disukai.', 'info');
                } else {
                    // Like
                    await axios.post(`${API_BASE_URL}/articles/${articleId}/like`, {}, {
                        headers: { Authorization: `Bearer ${currentToken}` }
                    });
                    showToast('Artikel disukai!', 'success');
                }
                
                // Reload articles to update counts
                loadArticles();
                
            } catch (error) {
                console.error('Error toggling like:', error);
                showToast('Gagal memperbarui suka.', 'danger');
            }
        }

        // Handle add comment
        async function handleAddComment(e) {
            e.preventDefault();
            
            if (!currentUser) {
                showToast('Silakan login untuk menambahkan komentar.', 'warning');
                return;
            }
            
            const content = document.getElementById('commentContent').value;
            
            if (!content.trim()) {
                showToast('Komentar tidak boleh kosong.', 'warning');
                return;
            }
            
            try {
                const response = await axios.post(`${API_BASE_URL}/articles/${currentArticleId}/comments`, {
                    content: content
                }, {
                    headers: { Authorization: `Bearer ${currentToken}` }
                });
                
                // Clear form
                document.getElementById('commentContent').value = '';
                
                // Show success message
                showToast('Komentar berhasil ditambahkan!', 'success');
                
                // Reload article to show new comment
                viewArticleDetail(currentArticleId);
                
            } catch (error) {
                console.error('Error adding comment:', error);
                showToast('Gagal menambahkan komentar.', 'danger');
            }
        }

        // Delete comment
        async function deleteComment(commentId) {
            if (!confirm('Apakah Anda yakin ingin menghapus komentar ini?')) {
                return;
            }
            
            try {
                await axios.delete(`${API_BASE_URL}/comments/${commentId}`, {
                    headers: { Authorization: `Bearer ${currentToken}` }
                });
                
                showToast('Komentar berhasil dihapus.', 'success');
                
                // Reload article to update comments
                viewArticleDetail(currentArticleId);
                
            } catch (error) {
                console.error('Error deleting comment:', error);
                showToast('Gagal menghapus komentar.', 'danger');
            }
        }

        // Display sample articles (fallback)
        function displaySampleArticles() {
            const sampleArticles = [
                {
                    id: 1,
                    title: "Memulai Perjalanan Menulis: Panduan untuk Penulis Baru",
                    content: "Menjadi penulis baru bisa menjadi tantangan, tetapi dengan panduan yang tepat Anda bisa memulai dengan baik...",
                    author: { username: "Penulis Baru", isNewAuthor: true },
                    categories: [{ name: "Pendidikan" }, { name: "Menulis" }],
                    viewCount: 245,
                    comments: [],
                    likes: [],
                    publishedAt: "2023-10-15T00:00:00"
                },
                {
                    id: 2,
                    title: "Teknologi AI dalam Dunia Penulisan Konten",
                    content: "Bagaimana kecerdasan buatan mengubah cara kita menulis dan menghasilkan konten di era digital...",
                    author: { username: "Tech Writer", isNewAuthor: false },
                    categories: [{ name: "Teknologi" }, { name: "AI" }],
                    viewCount: 512,
                    comments: [],
                    likes: [],
                    publishedAt: "2023-10-10T00:00:00"
                }
            ];
            
            displayArticles(sampleArticles);
            displayRecommendedArticles(sampleArticles);
        }

        // Show loading overlay
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        // Hide loading overlay
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show`;
            toast.role = 'alert';
            toast.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            toastContainer.appendChild(toast);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 5000);
        }

        // Initialize with sample data if needed
        function initializeWithSampleData() {
            // This function can be called if API is not available
            displaySampleArticles();
            loadCategories();
        }

        // Call initialize if needed
        setTimeout(() => {
            if (document.getElementById('articlesContainer').innerHTML.includes('Memuat artikel...')) {
                initializeWithSampleData();
            }
        }, 3000);
    </script>
</body>
</html>