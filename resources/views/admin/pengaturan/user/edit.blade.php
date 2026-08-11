@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="w-full">
 <div class="flex justify-between items-center mb-6">
 <div>
 <h4 class="mb-1">Edit Pengguna</h4>
 <p class="text-slate-500 mb-0">Perbarui data akun pengguna.</p>
 </div>
 <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-outline-secondary">
 <i class="fa-solid fa-arrow-left"></i> Kembali
 </a>
 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">
 <div class="p-6">
 <form method="POST" action="{{ route('admin.user.update', $user) }}">
 @csrf
 @method('PUT')

 <div class="flex flex-wrap -mx-3 gap-4">
 <div class="w-full md:w-1/2 px-3">
 <label class="form-label">Nama</label>
 <input type="text" name="name" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" value="{{ old('name', $user->name) }}" required>
 </div>

 <div class="w-full md:w-1/2 px-3">
 <label class="form-label">Username</label>
 <input type="text" name="username" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" value="{{ old('username', $user->username) }}" required>
 </div>

 <div class="w-full md:w-1/2 px-3">
 <label class="form-label">Role</label>
 <select name="role" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
 <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
 <option value="operator" {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>Operator</option>
 <option value="pimpinan" {{ old('role', $user->role) === 'pimpinan' ? 'selected' : '' }}>Pimpinan (Lurah/Sekretaris)</option>
 </select>
 </div>

 <div class="w-full md:w-1/2 px-3">
 <label class="form-label">Password Baru</label>
 <input type="password" name="password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
 </div>

 <div class="w-full md:w-1/2 px-3">
 <label class="form-label">Konfirmasi Password Baru</label>
 <input type="password" name="password_confirmation" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
 </div>
 </div>

 <div class="mt-6">
 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">Simpan Perubahan</button>
 <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">Batal</a>
 </div>
 </form>
 </div>
 </div>
</div>
@endsection
