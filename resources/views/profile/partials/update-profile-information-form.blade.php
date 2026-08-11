<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">Informasi Profil</h5>
        <small class="text-muted">Perbarui data diri dan email akun Anda.</small>
    </div>
</div>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-3 alert alert-warning mb-0">
            <small>
                Email Anda belum diverifikasi.
                <button form="send-verification" type="submit" class="btn btn-link p-0 align-baseline text-decoration-none">
                    Kirim ulang tautan verifikasi
                </button>
            </small>
        </div>

        @if (session('status') === 'verification-link-sent')
            <div class="mt-3 text-success small fw-semibold">
                Tautan verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif
    @endif

    <div class="d-flex align-items-center gap-3 mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk me-2"></i>
            Simpan
        </button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small fw-semibold">Berhasil disimpan.</span>
        @endif
    </div>
</form>
