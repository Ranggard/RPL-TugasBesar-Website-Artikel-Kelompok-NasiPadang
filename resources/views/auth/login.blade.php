@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg p-4 text-center" style="width: 100%; max-width: 400px; border-radius: 20px;">
        <h3 class="fw-bold text-primary mb-2">Masuk</h3>
        <p class="text-muted small mb-4">Silakan masuk ke akun Anda</p>

        <form method="POST" action="{{ route('login') }}" class="text-start">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold">Email</label>
                <input type="email" name="email" class="form-control rounded-pill px-3" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label small fw-bold">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control rounded-start-pill px-3" required style="border-right: none;">
                    <span class="input-group-text bg-white rounded-end-pill px-3" style="border-left: none; cursor: pointer;" onclick="togglePassword('password', 'toggleIcon')">
                        <i class="fas fa-lock text-muted" id="toggleIcon"></i>
                    </span>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">Login</button>
        </form>
        
        <p class="small text-muted mt-4">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none text-primary">Daftar</a></p>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            // Ganti gembok tertutup jadi gembok terbuka
            toggleIcon.classList.remove("fa-lock");
            toggleIcon.classList.add("fa-lock-open");
        } else {
            passwordInput.type = "password";
            // Kembalikan ke gembok tertutup
            toggleIcon.classList.remove("fa-lock-open");
            toggleIcon.classList.add("fa-lock");
        }
    }
</script>
@endsection