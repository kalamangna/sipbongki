@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="w-full">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">Tambah Pengguna</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Buat akun pengguna baru untuk sistem.</p>
        </div>
        <a href="{{ route('admin.user.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-slate-100">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.user.store') }}">
        @csrf
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
            <div class="p-4 sm:p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" class="w-full bg-slate-50 dark:bg-slate-800 border @error('name') border-rose-300 dark:border-rose-700 bg-rose-50/20 dark:bg-rose-950/20 focus:ring-rose-500 focus:border-rose-500 @else border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary @enderror text-slate-900 dark:text-slate-100 dark:placeholder-slate-500 text-sm rounded-xl focus:outline-none focus:ring-2 px-4 py-3 transition-colors shadow-sm" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Username <span class="text-rose-500">*</span></label>
                        <input type="text" name="username" class="w-full bg-slate-50 dark:bg-slate-800 border @error('username') border-rose-300 dark:border-rose-700 bg-rose-50/20 dark:bg-rose-950/20 focus:ring-rose-500 focus:border-rose-500 @else border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary @enderror text-slate-900 dark:text-slate-100 dark:placeholder-slate-500 text-sm rounded-xl focus:outline-none focus:ring-2 px-4 py-3 transition-colors shadow-sm" placeholder="Masukkan username (tanpa spasi)" value="{{ old('username') }}" required>
                        @error('username')
                            <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Role</label>
                        <select name="role" class="w-full bg-slate-50 dark:bg-slate-800 border @error('role') border-rose-300 dark:border-rose-700 bg-rose-50/20 dark:bg-rose-950/20 focus:ring-rose-500 focus:border-rose-500 @else border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary @enderror text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 px-4 py-3 transition-colors shadow-sm" required>
                            <option value="" disabled selected>Pilih hak akses</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role') === 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="pimpinan" {{ old('role') === 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                        </select>
                        @error('role')
                            <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password <span class="text-rose-500">*</span></label>
                        <input type="password" name="password" class="w-full bg-slate-50 dark:bg-slate-800 border @error('password') border-rose-300 dark:border-rose-700 bg-rose-50/20 dark:bg-rose-950/20 focus:ring-rose-500 focus:border-rose-500 @else border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary @enderror text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 px-4 py-3 transition-colors shadow-sm" placeholder="Minimal 8 karakter" required>
                        @error('password')
                            <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Konfirmasi Password <span class="text-rose-500">*</span></label>
                        <input type="password" name="password_confirmation" class="w-full bg-slate-50 dark:bg-slate-800 border @error('password_confirmation') border-rose-300 dark:border-rose-700 bg-rose-50/20 dark:bg-rose-950/20 focus:ring-rose-500 focus:border-rose-500 @else border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary @enderror text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 px-4 py-3 transition-colors shadow-sm" placeholder="Ketik ulang password" required>
                        @error('password_confirmation')
                            <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
            
            <div class="bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 px-4 sm:px-6 md:px-8 py-4 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3">
                <a href="{{ route('admin.user.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-slate-100">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer active:scale-95">
                    <i class="fa-solid fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
