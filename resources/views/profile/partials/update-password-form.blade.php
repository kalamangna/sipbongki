<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">Keamanan Akun</h5>
        <small class="text-muted">Pastikan password Anda kuat dan aman.</small>
    </div>
</div>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="row g-3">
        <div class="col-md-12">
            <label for="update_password_current_password" class="form-label">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="update_password_password" class="form-label">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="update_password_password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-key me-2"></i>
            Ubah Password
        </button>

        @if (session('status') === 'password-updated')
            <span class="text-success small fw-semibold">Password berhasil diperbarui.</span>
        @endif
    </div>
</form>
