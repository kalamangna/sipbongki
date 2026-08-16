@php
    $successMessage = session('success') ?? (
        session('status') === 'profile-updated' ? 'Profil berhasil diperbarui.' : (
            session('status') === 'password-updated' ? 'Password berhasil diperbarui.' : (
                session('status') && !in_array(session('status'), ['verification-link-sent']) ? session('status') : null
            )
        )
    );
@endphp

@if($successMessage)
    <div id="alert-success" class="flex items-center p-4 mb-4 text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-200 auto-dismiss shadow-sm transition-all duration-500 ease-out" role="alert">
        <i class="fa-solid fa-circle-check text-emerald-600 mr-3 text-lg shrink-0"></i>
        <div class="text-sm font-medium flex-1">
            {{ $successMessage }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex items-center justify-center h-8 w-8 transition-colors cursor-pointer" data-dismiss-target="#alert-success" aria-label="Close">
            <span class="sr-only">Tutup</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div id="alert-error" class="flex items-center p-4 mb-4 text-rose-800 rounded-2xl bg-rose-50 border border-rose-200 shadow-sm transition-all duration-500 ease-out" role="alert">
        <i class="fa-solid fa-circle-exclamation text-rose-600 mr-3 text-lg shrink-0"></i>
        <div class="text-sm font-medium flex-1">
            {{ session('error') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-rose-50 text-rose-500 rounded-lg focus:ring-2 focus:ring-rose-400 p-1.5 hover:bg-rose-100 inline-flex items-center justify-center h-8 w-8 transition-colors cursor-pointer" data-dismiss-target="#alert-error" aria-label="Close">
            <span class="sr-only">Tutup</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if(session('warning'))
    <div id="alert-warning" class="flex items-center p-4 mb-4 text-amber-800 rounded-2xl bg-amber-50 border border-amber-200 shadow-sm transition-all duration-500 ease-out" role="alert">
        <i class="fa-solid fa-triangle-exclamation text-amber-600 mr-3 text-lg shrink-0"></i>
        <div class="text-sm font-medium flex-1">
            {{ session('warning') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-amber-50 text-amber-500 rounded-lg focus:ring-2 focus:ring-amber-400 p-1.5 hover:bg-amber-100 inline-flex items-center justify-center h-8 w-8 transition-colors cursor-pointer" data-dismiss-target="#alert-warning" aria-label="Close">
            <span class="sr-only">Tutup</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if(session('info'))
    <div id="alert-info" class="flex items-center p-4 mb-4 text-sky-800 rounded-2xl bg-sky-50 border border-sky-200 auto-dismiss shadow-sm transition-all duration-500 ease-out" role="alert">
        <i class="fa-solid fa-circle-info text-sky-600 mr-3 text-lg shrink-0"></i>
        <div class="text-sm font-medium flex-1">
            {{ session('info') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-sky-50 text-sky-500 rounded-lg focus:ring-2 focus:ring-sky-400 p-1.5 hover:bg-sky-100 inline-flex items-center justify-center h-8 w-8 transition-colors cursor-pointer" data-dismiss-target="#alert-info" aria-label="Close">
            <span class="sr-only">Tutup</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi animasi fade-out & dismiss
    function dismissAlert(alertEl) {
        if (!alertEl) return;
        alertEl.style.opacity = '0';
        alertEl.style.transform = 'translateY(-6px)';
        setTimeout(function () {
            alertEl.style.height = '0';
            alertEl.style.padding = '0';
            alertEl.style.margin = '0';
            alertEl.style.overflow = 'hidden';
            setTimeout(function () {
                alertEl.remove();
            }, 300);
        }, 300);
    }

    // Tombol close manual
    document.querySelectorAll('[data-dismiss-target]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const targetSelector = btn.getAttribute('data-dismiss-target');
            const targetEl = document.querySelector(targetSelector);
            dismissAlert(targetEl);
        });
    });

    // Auto dismiss setelah 3.5 detik untuk alert dengan class .auto-dismiss
    document.querySelectorAll('.auto-dismiss').forEach(function (alert) {
        setTimeout(function () {
            dismissAlert(alert);
        }, 3500);
    });
});
</script>