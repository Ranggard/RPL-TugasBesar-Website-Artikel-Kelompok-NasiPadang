@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. LOCK GLOBAL SCROLLBAR */
    html, body {
        height: 100%;
        overflow: hidden; 
        background-color: #f8fafc;
    }

    /* 2. AREA KONTEN DENGAN SCROLLBAR INDIVIDU PADA TABEL */
    .manage-wrapper {
        height: calc(100vh - 72px); /* Menyesuaikan tinggi navbar */
        display: flex;
        flex-direction: column;
        padding: 30px;
    }

    .table-container {
        background: white;
        border-radius: 20px;
        flex-grow: 1;
        overflow: hidden; /* Lock container */
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .scrollable-table {
        overflow-y: auto;
        flex-grow: 1;
    }

    /* Styling Scrollbar */
    .scrollable-table::-webkit-scrollbar { width: 6px; }
    .scrollable-table::-webkit-scrollbar-track { background: transparent; }
    .scrollable-table::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #f8f9fa;
    }

    .input-search {
        background-color: #f1f5f9;
        border: none;
        padding: 10px 20px;
        border-radius: 50rem;
    }
</style>

<div class="manage-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Artikel</h4>
            <p class="text-muted small">Cari, filter, dan kelola karya publikasi Anda.</p>
        </div>
        <a href="{{ route('articles.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
            <i class="fas fa-plus me-2"></i>Tulis Baru
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <form action="" method="GET" class="position-relative">
                <input type="text" name="search" class="form-control input-search" placeholder="Cari judul atau kategori..." value="{{ request('search') }}">
                <i class="fas fa-search position-absolute text-muted" style="right: 20px; top: 13px;"></i>
            </form>
        </div>
        <div class="col-md-4">
            <form action="" method="GET" id="filterForm">
                <select name="status" class="form-select input-search" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <div class="scrollable-table">
            <table class="table align-middle mb-0">
                <thead class="sticky-header">
                    <tr>
                        <th class="ps-4 py-3 text-muted small fw-bold">JUDUL & KATEGORI</th>
                        <th class="py-3 text-muted small fw-bold">STATUS</th>
                        <th class="py-3 text-muted small fw-bold">TANGGAL</th>
                        <th class="pe-4 py-3 text-muted small fw-bold text-end">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myArticles as $art)
                    <tr class="border-bottom">
                        <td class="ps-4 py-4">
                            <span class="fw-bold d-block text-dark">{{ $art->title }}</span>
                            @foreach($art->categories as $cat)
                                <span class="badge bg-light text-primary border me-1" style="font-size: 0.7rem;">
                                    {{ $cat->categoryName }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @if($art->isPublished)
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-medium">
                                    <i class="fas fa-check-circle me-1"></i> Published
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2 fw-medium">
                                    <i class="fas fa-clock me-1"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td class="small text-muted">
                            {{ $art->created_at->format('d M Y') }}
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                @if(!$art->isPublished)
                                    <form action="{{ route('articles.publish', $art->articleId) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3 fw-bold">Publish</button>
                                    </form>
                                @endif
                                <a href="{{ route('articles.show', $art->articleId) }}" class="btn btn-sm btn-outline-primary rounded-circle"><i class="fas fa-eye"></i></a>
                                
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle" onclick="confirmDelete('{{ $art->articleId }}', '{{ $art->title }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                
                                <form id="delete-form-{{ $art->articleId }}" action="{{ route('articles.destroy', $art->articleId) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-body p-4 text-center">
                <div class="text-danger mb-3">
                    <i class="fas fa-exclamation-circle fa-4x"></i>
                </div>
                <h5 class="fw-bold">Hapus Artikel?</h5>
                <p class="text-muted small">Anda akan menghapus artikel <br><strong id="deleteArticleTitle"></strong>. Tindakan ini tidak bisa dibatalkan.</p>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btnConfirmDelete" class="btn btn-danger rounded-pill px-4 fw-bold">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentDeleteId = null;

    function confirmDelete(id, title) {
        currentDeleteId = id;
        document.getElementById('deleteArticleTitle').innerText = title;
        var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        myModal.show();
    }

    document.getElementById('btnConfirmDelete').addEventListener('click', function() {
        if(currentDeleteId) {
            document.getElementById('delete-form-' + currentDeleteId).submit();
        }
    });
</script>

<style>
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    tbody tr:hover { background-color: #fcfcfc; }
</style>
@endsection