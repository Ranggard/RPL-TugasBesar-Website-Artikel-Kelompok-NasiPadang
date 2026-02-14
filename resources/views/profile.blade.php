@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="mb-4">
                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow" style="width: 100px; height: 100px; font-size: 2.5rem;">
                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
                <h3 class="fw-bold">{{ Auth::user()->username }}</h3>
                <span class="badge bg-primary rounded-pill px-3">{{ ucfirst(Auth::user()->role) }}</span>
            </div>

            <div class="row g-3 mb-5">
                <div class="col-6">
                    <div class="p-3 border rounded-4 bg-white">
                        <div class="h4 fw-bold mb-0">12</div>
                        <div class="text-muted small">Artikel</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 border rounded-4 bg-white">
                        <div class="h4 fw-bold mb-0">340</div>
                        <div class="text-muted small">Total Like</div>
                    </div>
                </div>
            </div>

            <div class="text-start p-4 border rounded-4 bg-white">
                <h6 class="fw-bold mb-3 border-bottom pb-2">Detail Akun</h6>
                <div class="mb-3">
                    <label class="text-muted small d-block">Email</label>
                    <span class="fw-bold">{{ Auth::user()->email }}</span>
                </div>
                @if(Auth::user()->role == 'penulis')
                <div class="mb-3">
                    <label class="text-muted small d-block">Status Penulis</label>
                    <span class="fw-bold">{{ Auth::user()->isNewAuthor ? 'Penulis Baru' : 'Penulis Berpengalaman' }}</span>
                </div>
                @endif
                <button class="btn btn-outline-dark w-100 rounded-pill mt-3">Edit Pengaturan Profil</button>
            </div>
        </div>
    </div>
</div>
@endsection