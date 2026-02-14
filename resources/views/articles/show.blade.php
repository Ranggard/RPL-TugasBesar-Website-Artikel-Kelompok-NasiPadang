@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active">{{ $article->categories->first()->categoryName ?? 'Umum' }}</li>
                </ol>
            </nav>

            <h1 class="display-4 fw-bold mb-4 text-dark" style="letter-spacing: -1px; line-height: 1.2;">{{ $article->title }}</h1>

            <div class="d-flex align-items-center justify-content-between mb-5 p-3 bg-white rounded-4 shadow-sm border">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; font-weight: bold;">
                        {{ strtoupper(substr($article->author->username, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $article->author->username }}</h6>
                        <small class="text-muted">
                            {{ $article->isPublished ? 'Terbit' : 'Draf' }} · {{ $article->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
                
                <div class="d-flex gap-2">
                    @guest
                        <button onclick="requireLogin('menyukai artikel')" class="btn btn-outline-danger rounded-pill px-3 shadow-sm">
                            <i class="far fa-heart me-1"></i> {{ $article->likes->count() }}
                        </button>
                    @else
                        <form action="{{ route('articles.like', $article->articleId) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn {{ $article->likes->where('userId', Auth::id())->count() ? 'btn-danger text-white' : 'btn-outline-danger' }} rounded-pill px-3 shadow-sm">
                                <i class="{{ $article->likes->where('userId', Auth::id())->count() ? 'fas' : 'far' }} fa-heart me-1"></i> {{ $article->likes->count() }}
                            </button>
                        </form>
                    @endguest

                    <button onclick="shareArticle()" class="btn btn-outline-secondary rounded-circle shadow-sm">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>

            <article class="article-content fs-5 text-secondary mb-5" style="line-height: 1.8;">
                {!! $article->content !!}
            </article>

            <hr class="my-5 opacity-25">

            <section class="comments-section mb-5">
                <h4 class="fw-bold mb-4">
                    <i class="far fa-comment-dots me-2"></i> Komentar ({{ $article->comments->count() }})
                </h4>
                
                @auth
                    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white border">
                        <div class="card-body p-4">
                            <form action="{{ route('comments.store', $article->articleId) }}" method="POST">
                                @csrf
                                <textarea name="content" class="form-control border-0 bg-light rounded-3 mb-3" rows="3" placeholder="Tulis pendapat Anda..." required></textarea>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Kirim Komentar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-light border text-center" style="cursor: pointer; border-style: dashed !important;" onclick="requireLogin('menulis komentar')">
                        <div class="card-body p-4">
                            <p class="text-muted mb-0">
                                <i class="fas fa-lock me-2"></i> Mau ikut berdiskusi? 
                                <span class="text-primary fw-bold">Klik di sini untuk Masuk</span>
                            </p>
                        </div>
                    </div>
                @endauth

                <div class="comment-list mt-4">
                    @forelse($article->comments->where('parent_id', null) as $comment)
                        <div class="mb-4">
                            <div class="d-flex p-3 rounded-4 bg-white shadow-sm border-start border-primary border-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="min-width: 40px; height: 40px;">
                                    {{ strtoupper(substr($comment->user->username, 0, 1)) }}
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold">{{ $comment->user->username }}</span>
                                            <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        @auth
                                            @if(Auth::id() == $comment->userId)
                                            <form action="{{ route('comments.destroy', $comment->commentId) }}" method="POST" id="delete-form-{{ $comment->commentId }}">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-link text-danger p-0" onclick="confirmDelete('{{ $comment->commentId }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-secondary mb-2">{{ $comment->content }}</p>
                                    
                                    <div class="d-flex gap-3">
                                        @auth
                                            <button class="btn btn-sm btn-link text-primary p-0 text-decoration-none fw-bold" onclick="toggleReplyForm({{ $comment->commentId }})">
                                                <i class="fas fa-reply me-1"></i> Balas
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-link text-muted p-0 text-decoration-none fw-bold" onclick="requireLogin('membalas komentar')">
                                                <i class="fas fa-reply me-1"></i> Balas
                                            </button>
                                        @endauth
                                        
                                        @if($comment->replies->count() > 0)
                                            <button class="btn btn-sm btn-link text-muted p-0 text-decoration-none fw-bold" onclick="toggleRepliesList({{ $comment->commentId }})">
                                                <i class="fas fa-comments me-1"></i> {{ $comment->replies->count() }} Balasan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div id="reply-form-{{ $comment->commentId }}" class="mt-2 ms-5 d-none">
                                <form action="{{ route('comments.store', $article->articleId) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->commentId }}">
                                    <textarea name="content" class="form-control form-control-sm rounded-3 mb-2" rows="2" placeholder="Tulis balasan..." required></textarea>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Kirim</button>
                                    </div>
                                </form>
                            </div>

                            <div id="replies-list-{{ $comment->commentId }}" class="ms-5 mt-3 border-start ps-3 d-none">
                                @foreach($comment->replies as $reply)
                                    <div class="d-flex p-2 mb-2 rounded-3 bg-light border-bottom">
                                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="min-width: 30px; height: 30px; font-size: 0.7rem;">
                                            {{ strtoupper(substr($reply->user->username, 0, 1)) }}
                                        </div>
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold small">{{ $reply->user->username }}</span>
                                                @auth
                                                    @if(Auth::id() == $reply->userId)
                                                    <form action="{{ route('comments.destroy', $reply->commentId) }}" method="POST" id="delete-form-{{ $reply->commentId }}">
                                                        @csrf @method('DELETE')
                                                        <button type="button" class="btn btn-link text-danger p-0 border-0" onclick="confirmDelete('{{ $reply->commentId }}')">
                                                            <i class="fas fa-trash-alt" style="font-size: 0.75rem;"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                @endauth
                                            </div>
                                            <p class="mb-0 small text-secondary">{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-4">Belum ada diskusi di artikel ini.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</div>

<script>
// 1. Fungsi Pop-up Login Terpadu
function requireLogin(actionText) {
    Swal.fire({
        title: 'Mau ' + actionText + '?',
        text: 'Anda harus masuk ke akun terlebih dahulu untuk berinteraksi.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Masuk Sekarang',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        footer: '<a href="{{ route("register") }}" class="text-decoration-none">Belum punya akun? Daftar gratis</a>'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('login') }}";
        }
    })
}

// 2. Toggle Form Balas
function toggleReplyForm(id) {
    const form = document.getElementById('reply-form-' + id);
    form.classList.toggle('d-none');
}

// 3. Toggle List Balasan
function toggleRepliesList(id) {
    const list = document.getElementById('replies-list-' + id);
    list.classList.toggle('d-none');
}

// 4. Share Article API
async function shareArticle() {
    if (navigator.share) {
        try {
            await navigator.share({
                title: document.title,
                url: window.location.href
            });
        } catch (err) { console.log('Share failed', err); }
    } else {
        navigator.clipboard.writeText(window.location.href);
        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Link disalin!', showConfirmButton: false, timer: 2000 });
    }
}

// 5. Konfirmasi Hapus Komentar
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Komentar?',
        text: "Komentar yang dihapus tidak bisa dikembalikan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}

// 6. Alert Flash Message
@if(session('success'))
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: "{{ session('success') }}", showConfirmButton: false, timer: 3000 });
@endif
@if(session('error'))
    Swal.fire({ icon: 'error', title: 'Kesalahan', text: "{{ session('error') }}" });
@endif
</script>

<style>
    .article-content img { max-width: 100%; border-radius: 15px; margin: 20px 0; }
    .article-content div { margin-bottom: 1rem; }
    .breadcrumb-item + .breadcrumb-item::before { content: "·"; }
</style>
@endsection