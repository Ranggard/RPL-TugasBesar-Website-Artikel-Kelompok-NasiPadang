<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmLogout() {
        Swal.fire({
            title: '<span style="font-size: 1.5rem; font-weight: 700;">Konfirmasi Keluar</span>',
            html: 'Apakah Anda yakin ingin mengakhiri sesi ini?<br><small class="text-muted">Pastikan semua pekerjaan Anda telah tersimpan.</small>',
            icon: 'warning',
            iconColor: '#ef4444',
            showCancelButton: true,
            
            // Pengaturan Tombol
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Kembali',
            confirmButtonColor: '#ef4444', // Merah Modern (Tailwind Red 500)
            cancelButtonColor: '#6b7280',  // Abu-abu Modern (Tailwind Gray 500)
            
            // Posisi: Ya Keluar di Kanan, Batal di Kiri
            reverseButtons: true, 
            
            // Estetika Popup
            backdrop: `rgba(15, 23, 42, 0.5)`, // Overlay biru gelap transparan (tanpa blur)
            allowOutsideClick: false,
            customClass: {
                popup: 'modern-popup',
                confirmButton: 'px-4 py-2 rounded-pill fw-bold ms-2',
                cancelButton: 'px-4 py-2 rounded-pill fw-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Efek loading saat tombol diklik (Opsional tapi keren)
                Swal.fire({
                    title: 'Harap Tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>

<style>
    /* Hilangkan Blur Efek */
    .swal2-backdrop-show {
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }

    /* Styling Popup Modern */
    .modern-popup {
        border-radius: 20px !important;
        padding: 2rem !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }

    /* Perbaikan spasi tombol jika perlu */
    .swal2-actions {
        gap: 10px;
        margin-top: 1.5rem !important;
    }
</style>