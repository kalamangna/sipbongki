<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="mb-1 text-danger">Hapus Akun</h5>
        <small class="text-muted">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</small>
    </div>
</div>

<form method="post" action="{{ route('profile.destroy') }}">
    @csrf
    @method('delete')

    <div class="alert alert-warning border-0 mb-3">
        Setelah akun dihapus, semua data dan akses Anda akan hilang secara permanen. Harap pastikan Anda sudah menyiapkan data penting sebelum melanjutkan.
    </div>

    <div class="row g-3 align-items-end">
        <div class="col-md-8">
            <label for="delete_account_password" class="form-label">Konfirmasi Password</label>
            <input id="delete_account_password" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Masukkan password Anda">
            @error('password', 'userDeletion')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4 text-md-end">
            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus akun?');">
                <i class="fa-solid fa-trash me-2"></i>
                Hapus Akun
            </button>
        </div>
    </div>
</form>
