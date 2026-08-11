@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container-fluid">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h4 class="mb-1">Edit Pengguna</h4>
            <p class="text-slate-500 mb-0">Perbarui data akun pengguna.</p>
        </div>
        <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.user.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="flex flex-wrap -mx-3 g-3">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="pimpinan" {{ old('role', $user->role) === 'pimpinan' ? 'selected' : '' }}>Pimpinan (Lurah/Sekretaris)</option>
                        </select>
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">Simpan Perubahan</button>
                    <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
