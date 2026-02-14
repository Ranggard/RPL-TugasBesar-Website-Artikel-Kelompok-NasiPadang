@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<div class="container mt-5" style="max-width: 800px; padding-bottom: 100px;">
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST" id="articleForm">
        @csrf
        
        <div class="mb-4">
            <input type="text" name="title" 
                   class="form-control border-0 fs-1 fw-bold p-0" 
                   placeholder="Judul Karya..." 
                   value="{{ old('title') }}"
                   style="box-shadow: none; outline: none; letter-spacing: -1px;" required>
        </div>

        <div class="mb-4 d-flex align-items-center gap-3 border-bottom pb-3">
            <select name="categoryId[]" class="form-select border-0 bg-light rounded-pill px-3" style="width: auto;" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->categoryId }}" {{ collect(old('categoryId'))->contains($category->categoryId) ? 'selected' : '' }}>
                        {{ $category->categoryName }}
                    </option>
                @endforeach
            </select>
            <span class="text-muted small" id="statusIndicator">Ide baru</span>
        </div>

        <div class="mb-5">
            <input id="content" type="hidden" name="content" value="{{ old('content') }}">
            <trix-editor input="content" placeholder="Ceritakan ide Anda..." class="border-0 shadow-none p-0 fs-5" style="min-height: 50vh;"></trix-editor>
        </div>

        <div class="fixed-bottom bg-white border-top p-3 shadow-sm">
            <div class="container d-flex justify-content-between align-items-center" style="max-width: 800px;">
                <a href="{{ route('articles.management') }}" class="btn btn-link text-muted text-decoration-none">Batal</a>
                
                <button type="submit" class="btn btn-dark rounded-pill px-5 fw-bold shadow-sm">
                    Simpan ke Draft
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    /* Styling Editor agar bersih tanpa garis border */
    trix-editor { border: none !important; outline: none !important; }
    trix-editor:focus { outline: none !important; border: none !important; box-shadow: none !important; }
    
    /* Toolbar styling */
    trix-toolbar .trix-button-group { 
        border: none !important; 
        background: #f8f9fa; 
        border-radius: 12px; 
        margin-bottom: 15px; 
        padding: 5px;
    }
    
    body { background-color: #fff !important; }
    
    /* Menghilangkan tombol upload file di Trix jika tidak diperlukan */
    .trix-button--icon-attach { display: none !important; }

    /* Custom placeholder font-size */
    trix-editor:empty:not(:focus)::before {
        font-size: 1.25rem;
        color: #adb5bd;
    }
</style>

<script>
    // Indikator status saat mengetik
    document.addEventListener("trix-change", function(event) {
        document.getElementById('statusIndicator').innerText = "Draf sedang ditulis...";
    });

    // Validasi sederhana sebelum submit
    document.getElementById('articleForm').onsubmit = function() {
        let content = document.getElementById('content').value;
        if(content.trim() === "") {
            alert("Konten artikel tidak boleh kosong!");
            return false;
        }
        return true;
    };
</script>
@endsection