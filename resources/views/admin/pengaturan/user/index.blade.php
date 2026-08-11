@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="w-full">
 <div class="flex justify-between items-center mb-6">
 <div>
 
 <p class="text-slate-500 mb-0">Kelola akun pengguna yang memiliki akses ke sistem.</p>
 </div>
 <a href="{{ route('admin.user.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
 <i class="fa-solid fa-circle-plus"></i>
 Pengguna
 </a>
 </div>

 @if(session('success'))
 <div class="p-4 mb-4 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200">{{ session('success') }}</div>
 @endif

 @if(session('error'))
 <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200">{{ session('error') }}</div>
 @endif

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">
 <div class="px-6 py-4 border-b border-slate-200 bg-white">
 <form method="GET">
 <div class="flex flex-wrap -mx-3 gap-2 items-center">
 <div class="w-full md:w-1/2 px-3">
 <input
 type="text"
 name="search"
 value="{{ $search }}"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Cari nama atau username">
 </div>

 <div class="shrink-0">
 <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
 <i class="fa-solid fa-magnifying-glass"></i> Cari
 </button>
 </div>

 @if($search)
 <div class="shrink-0">
 <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">
 Reset
 </a>
 </div>
 @endif
 </div>
 </form>
 </div>

 <div class="p-6 p-0">
 <table class="w-full text-sm text-left text-slate-500">
 <thead class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\">
 <tr>
 <th width="60" class="px-4 py-3 font-medium text-slate-700">No</th>
 <th class="px-4 py-3 font-medium text-slate-700">Nama</th>
 <th class="px-4 py-3 font-medium text-slate-700">Username</th>
 <th class="px-4 py-3 font-medium text-slate-700">Role</th>
 <th class="px-4 py-3 font-medium text-slate-700">Terhubung</th>
 <th width="180" class="px-4 py-3 font-medium text-slate-700">Aksi</th>
 </tr>
 </thead>
 <tbody>
 @forelse($users as $user)
 <tr>
 <td class="px-4 py-3 border-b border-slate-100">{{ $users->firstItem() + $loop->index }}</td>
 <td class="px-4 py-3 border-b border-slate-100">{{ $user->name }}</td>
 <td class="px-4 py-3 border-b border-slate-100">{{ $user->username ?? '-' }}</td>
 <td class="px-4 py-3 border-b border-slate-100">
 @if($user->role === 'admin')
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Admin</span>
 @elseif($user->role === 'operator')
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">Operator</span>
 @elseif($user->role === 'pimpinan')
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Pimpinan</span>
 @else
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">{{ ucfirst($user->role ?? 'n/a') }}</span>
 @endif
 </td>
 <td class="px-4 py-3 border-b border-slate-100">{{ $user->penduduk?->nama_lengkap ?? 'Tidak ada' }}</td>
 <td class=\"text-center px-4 py-3 border-b border-slate-100\">
 <div class="action-buttons">
 <a href="{{ route('admin.user.edit', $user) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs" title="Edit">
 <i class="fa-solid fa-pen-to-square"></i>
 </a>
 <form method="POST" action="{{ route('admin.user.destroy', $user) }}" class="inline mb-0" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
 @csrf
 @method('DELETE')
 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs" title="Hapus">
 <i class="fa-solid fa-trash"></i>
 </button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="7" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">
 <i class="fa-solid fa-inbox block mb-4"></i>
 <span class="text-slate-500">Tidak ada akun pengguna.</span>
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
