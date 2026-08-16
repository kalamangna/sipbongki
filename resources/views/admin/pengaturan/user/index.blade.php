@extends('layouts.admin')

@section('title', 'Pengguna')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Pengguna</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola akun pengguna yang memiliki akses ke sistem.</p>
        </div>
        <a href="{{ route('admin.user.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer">
            <i class="fa-solid fa-circle-plus"></i> Tambah Pengguna
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm" placeholder="Cari Nama atau Username...">
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if($search)
                        <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600 min-w-[650px]">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                <tr>
                    <th width="60" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">No</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Nama</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Username</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Role</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Terhubung</th>
                    <th width="120" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 text-center font-medium">{{ $users->firstItem() + $loop->index }}</td>
                    <td class="px-6 py-4 font-medium text-slate-900">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->username ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($user->role === 'admin')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Admin</span>
                        @elseif($user->role === 'operator')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700 tracking-wide">Operator</span>
                        @elseif($user->role === 'pimpinan')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 tracking-wide">Pimpinan</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 tracking-wide">{{ ucfirst($user->role ?? 'n/a') }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $user->penduduk?->nama_lengkap ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.user.edit', $user) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.user.destroy', $user) }}" class="inline mb-0" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors focus:outline-none" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
 @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <i class="fa-solid fa-users text-4xl mb-4 text-slate-300"></i>
                            <p class="text-sm">Tidak ada akun pengguna.</p>
                        </div>
                    </td>
                </tr>
 @endforelse
 </tbody>
 </table>
 </div>

 @if($users->hasPages())
 <div class="px-6 py-4 border-t border-slate-200 bg-white">
 {{ $users->links() }}
 </div>
 @endif
 </div>
</div>
@endsection
