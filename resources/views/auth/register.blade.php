@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. LOCK GLOBAL SCROLLBAR */
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden; 
        background-color: #f8fafc;
    }

    /* 2. WRAPPER POSISI TENGAH */
    .auth-wrapper {
        height: calc(100vh - 72px); 
        display: flex;
        align-items: center; 
        justify-content: center;
        padding: 20px;
    }

    /* 3. CARD AUTH - DESIGN COMPACT */
    .card-auth {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        border-radius: 25px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .card-body-padding {
        /* Padding bawah dijaga minimal agar footer tidak melorot */
        padding: 30px 40px 20px 40px; 
    }

    /* 4. FORM SPACING (RAPAT) */
    .mb-tight {
        margin-bottom: 10px !important; /* Jarak antar elemen diperketat */
    }

    .form-label-sm {
        font-size: 0.85rem;
        font-weight: 600;
        color: #495057;
        margin-left: 5px;
        margin-bottom: 3px;
    }

    .input-soft {
        background-color: #f1f5f9 !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 9px 15px !important;
        font-size: 0.9rem;
    }

    .input-group-text {
        background-color: #f1f5f9 !important;
        border: none !important;
        border-radius: 0 12px 12px 0 !important;
        color: #adb5bd;
    }

    .btn-register {
        background-color: #5c7cfa;
        border: none;
        border-radius: 12px;
        padding: 11px;
        font-weight: 700;
        margin-top: 10px;
        color: white;
    }

    /* 5. FOOTER LINK */
    .login-footer {
        margin-top: 15px;
        padding-top: 10px;
        font-size: 0.85rem;
        border-top: 1px solid #f8fafc;
    }
</style>

<div class="auth-wrapper">
    <div class="card-auth">
        <div class="card-body-padding">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary mb-1" style="letter-spacing: -0.5px;">Daftar Akun</h3>
                <p class="text-muted small">Pilih peran Anda dan mulai berkontribusi</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-tight">
                    <label class="form-label-sm">Username</label>
                    <input type="text" name="username" class="form-control input-soft" required placeholder="Masukkan username">
                </div>

                <div class="mb-tight">
                    <label class="form-label-sm">Email</label>
                    <input type="email" name="email" class="form-control input-soft" required placeholder="nama@email.com">
                </div>

                <div class="mb-tight">
                    <label class="form-label-sm">Daftar Sebagai</label>
                    <select name="role" class="form-select input-soft" required>
                        <option value="pembaca">Pembaca</option>
                        <option value="penulis">Penulis</option>
                    </select>
                </div>

                <div class="mb-tight">
                    <label class="form-label-sm">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password_reg" class="form-control input-soft" required placeholder="********" style="border-radius: 12px 0 0 12px !important;">
                        <span class="input-group-text" onclick="togglePassword('password_reg', 'icon_reg')" style="cursor: pointer;">
                            <i class="fas fa-lock" id="icon_reg"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-tight">
                    <label class="form-label-sm">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_conf" class="form-control input-soft" required placeholder="********" style="border-radius: 12px 0 0 12px !important;">
                        <span class="input-group-text" onclick="togglePassword('password_conf', 'icon_conf')" style="cursor: pointer;">
                            <i class="fas fa-lock" id="icon_conf"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-register w-100 shadow-sm">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center login-footer">
                <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none text-primary">Masuk</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("fa-lock", "fa-lock-open");
        } else {
            input.type = "password";
            icon.classList.replace("fa-lock-open", "fa-lock");
        }
    }
</script>
@endsection