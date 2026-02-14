@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. LOCK GLOBAL SCROLLBAR (Sesuai Permintaan) */
    html, body {
        height: 100%;
        overflow: hidden; 
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    /* 2. LAYOUT CONTAINER */
    .app-container {
        height: calc(100vh - 72px); 
        display: flex;
        gap: 24px;
        padding: 20px 24px;
    }

    /* 3. SIDEBAR FILTER */
    .sidebar-filter {
        width: 280px;
        flex-shrink: 0;
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        height: fit-content; 
        max-height: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* 4. CONTENT AREA */
    .content-area {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 20px;
        overflow: hidden;
        min-height: 0; 
    }

    /* 5. INDIVIDUAL SCROLL CONTAINERS */
    .scroll-view {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        min-height: 0; 
    }

    .custom-scroll {
        overflow-y: auto;
        padding-right: 10px;
        flex-grow: 1;
    }

    /* Styling Scrollbar */
    .custom-scroll::-webkit-scrollbar { width: 5px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    /* 6. COMPONENT STYLING */
    .text-blue-web { color: #0d6efd !important; }
    
    .badge-category {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd !important;
        border: 1px solid rgba(13, 110, 253, 0.2);
        font-size: 0.7rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 8px;
    }

    .card-minimal {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        transition: all 0.2s ease;
        cursor: pointer;
        display: block;
        width: 100%;
    }

    .card-minimal:hover {
        border-color: #0d6efd;
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    .input-soft {
        background-color: #f1f5f9 !important;
        border: none !important;
        border-radius: 12px !important;
        font-size: 0.9rem;
    }
</style>

<div class="app-container">
    <aside class="sidebar-filter">
        <form action="{{ route('articles.index') }}" method="GET" id="filterForm">
            <h6 class="fw-bold mb-3 small" style="color: #1e293b; letter-spacing: 0.5px;">CARI ARTIKEL</h6>
            <div class="mb-4">
                <input type="text" name="search" class="form-control input-soft py-2 px-3" placeholder="Judul..." value="{{ request('search') }}">
            </div>

            <h6 class="fw-bold mb-3 small" style="color: #1e293b;">URUTKAN</h6>
            <select name="filter" class="form-select input-soft mb-4 shadow-none" onchange="this.form.submit()">
                <option value="terbaru" {{ request('filter') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="populer" {{ request('filter') == 'populer' ? 'selected' : '' }}>Populer</option>
            </select>

            <h6 class="fw-bold mb-3 small" style="color: #1e293b;">KATEGORI</h6>
            <div class="custom-scroll overflow-auto mb-3" style="max-height: 150px;">
                @foreach($allCategories as $cat)
                <div class="form-check mb-2">
                    <input class="form-check-input shadow-none" type="checkbox" name="categories[]" value="{{ $cat->categoryId }}" id="cat{{ $cat->categoryId }}" 
                        {{ is_array(request('categories')) && in_array($cat->categoryId, request('categories')) ? 'checked' : '' }}
                        onchange="this.form.submit()">
                    <label class="form-check-label small text-muted" for="cat{{ $cat->categoryId }}">{{ $cat->categoryName }}</label>
                </div>
                @endforeach
            </div>
            
            <div class="pt-3 border-top text-center mt-auto">
                <a href="{{ route('articles.index') }}" class="text-danger small text-decoration-none fw-bold">Hapus Filter</a>
            </div>
        </form>
    </aside>

    <main class="content-area">
        @if($newAuthorArticles->count() > 0 && !request('search'))
        <section class="flex-shrink-0">
            <h6 class="fw-bold mb-3 text-muted small text-uppercase">Rekomendasi Penulis Baru</h6>
            <div class="row g-3">
                @foreach($newAuthorArticles as $item)
                <div class="col-md-4">
                    <div class="card card-minimal p-3 h-100 border-0 shadow-sm" onclick="window.location='{{ route('articles.show', $item->articleId) }}'">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge-category">{{ $item->categories->first()->categoryName ?? 'Umum' }}</span>
                            <div class="d-flex gap-2 text-muted" style="font-size: 0.7rem;">
                                <span><i class="fas fa-heart text-danger"></i> {{ $item->likes->count() }}</span>
                                <span><i class="fas fa-comment text-blue-web"></i> {{ $item->comments->count() }}</span>
                            </div>
                        </div>
                        <h6 class="fw-bold mb-2 small" style="line-height: 1.5; color: #1e293b;">{{ Str::limit($item->title, 45) }}</h6>
                        <div class="mt-auto">
                            <small class="text-blue-web fw-bold" style="font-size: 0.7rem;">
                                <i class="far fa-user-circle me-1"></i>{{ $item->author->username }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $newAuthorArticles->appends(['page' => $articles->currentPage()])->links('pagination::bootstrap-4') }}
            </div>
        </section>
        @endif

        <section class="scroll-view shadow-sm">
            <h6 class="fw-bold mb-4 text-muted small text-uppercase">Semua Artikel</h6>
            
            <div class="custom-scroll">
                @forelse($articles as $article)
                <div class="card card-minimal p-4 mb-3 border-0 shadow-sm" onclick="window.location='{{ route('articles.show', $article->articleId) }}'">
                    <div class="d-flex align-items-center mb-2" style="font-size: 0.75rem;">
                        <span class="fw-bold text-blue-web">{{ $article->author->username }}</span>
                        <span class="mx-2 text-muted">•</span>
                        <span class="text-muted">{{ $article->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <h5 class="fw-bold mb-2" style="color: #1e293b;">{{ $article->title }}</h5>
                    <p class="text-muted mb-3" style="font-size: 0.85rem; line-height: 1.6;">
                        {{ Str::limit(strip_tags($article->content), 160) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-4 text-muted" style="font-size: 0.8rem;">
                            <span><i class="far fa-eye me-1"></i>{{ $article->viewCount ?? 0 }}</span>
                            <span><i class="far fa-heart me-1 text-danger"></i>{{ $article->likes->count() }}</span>
                            <span><i class="far fa-comment me-1 text-blue-web"></i>{{ $article->comments->count() }}</span>
                        </div>
                        <span class="badge-category">{{ $article->categories->first()->categoryName ?? 'Umum' }}</span>
                    </div>
                </div>
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted">Tidak ada artikel yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-auto pt-3 border-top d-flex justify-content-center">
                {{ $articles->appends(['newAuthors' => $newAuthorArticles->currentPage()])->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </main>
</div>
@endsection