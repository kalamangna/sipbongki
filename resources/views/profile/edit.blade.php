@extends('layouts.admin')

@section('title', 'Profil Pengguna')

@section('content')
<div class="w-full space-y-6">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Profil Pengguna</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data profil akun dan keamanan akses Anda.</p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Akun Aktif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── LEFT: USER SUMMARY CARD ──────────────── --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h5 class="text-sm font-bold text-slate-800">Ringkasan Akun</h5>
                </div>
                
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-primary-100 text-primary-700 flex items-center justify-center text-2xl font-extrabold shadow-sm mb-4 border border-primary-200">
                        {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                    </div>

                    <h4 class="text-base font-bold text-slate-900 mb-1">{{ $user->name ?? 'Administrator' }}</h4>
                    <p class="text-xs font-mono text-slate-500 mb-4 bg-slate-100 px-3 py-1 rounded-full">&#64;{{ $user->username ?? '-' }}</p>

                    <div class="w-full divide-y divide-slate-100 text-left text-sm mt-2 border-t border-slate-100">
                        <div class="flex items-center justify-between py-3">
                            <span class="text-xs font-medium text-slate-500">Peran / Role</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ ucfirst($user->role ?? 'admin') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="text-xs font-medium text-slate-500">Status</span>
                            <span class="text-xs font-semibold text-emerald-600">Aktif</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="text-xs font-medium text-slate-500">Terdaftar</span>
                            <span class="text-xs font-medium text-slate-700">{{ $user->created_at ? $user->created_at->translatedFormat('d M Y') : '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="text-xs font-medium text-slate-500">Pembaruan</span>
                            <span class="text-xs font-medium text-slate-700">{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── RIGHT: EDIT FORMS ────────────────────── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- 1. INFORMASI PROFIL FORM --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h5 class="text-sm font-bold text-slate-800">Informasi Profil</h5>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="p-6 md:p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" required
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                       value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="username" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Username <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="username" id="username" required
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('username') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                       value="{{ old('username', $user->username) }}" placeholder="Masukkan username">
                                @error('username')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Peran / Role</label>
                                <input type="text" disabled
                                       class="w-full bg-slate-100 border border-slate-200 text-slate-500 text-sm rounded-xl px-4 py-3 cursor-not-allowed font-medium shadow-sm"
                                       value="{{ ucfirst($user->role ?? 'admin') }}">
                            </div>

                            @if($user->penduduk)
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tautan Penduduk</label>
                                <div class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 flex items-center justify-between shadow-sm">
                                    <span class="truncate font-medium">{{ $user->penduduk->nama_lengkap }} ({{ $user->penduduk->nik }})</span>
                                    <span class="text-xs text-emerald-600 font-semibold shrink-0 ml-2">Terkait</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-slate-50/50 border-t border-slate-200 px-6 md:px-8 py-4 flex items-center justify-end">
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                            <i class="fa-solid fa-save"></i> Simpan Profil
                        </button>
                    </div>
                </form>
            </div>

            {{-- 2. UBAH PASSWORD FORM --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h5 class="text-sm font-bold text-slate-800">Keamanan & Password</h5>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="p-6 md:p-8 space-y-6">
                        <div>
                            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                Password Saat Ini <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="current_password" id="update_password_current_password" required
                                   class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('current_password', 'updatePassword') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                   autocomplete="current-password" placeholder="Masukkan password saat ini">
                            @error('current_password', 'updatePassword')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Password Baru <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" id="update_password_password" required
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('password', 'updatePassword') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                       autocomplete="new-password" placeholder="Minimal 8 karakter">
                                @error('password', 'updatePassword')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Konfirmasi Password Baru <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="update_password_password_confirmation" required
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('password_confirmation', 'updatePassword') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                       autocomplete="new-password" placeholder="Ulangi password baru">
                                @error('password_confirmation', 'updatePassword')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50/50 border-t border-slate-200 px-6 md:px-8 py-4 flex items-center justify-end">
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                            <i class="fa-solid fa-key"></i> Perbarui Password
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
@endsection
