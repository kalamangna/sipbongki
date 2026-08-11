@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid">
    <div class="flex justify-between items-center mb-6">
        <div>
        
            <p class="text-slate-500 mb-0">Kelola akun pengguna yang memiliki akses ke sistem.</p>
        </div>
        <a href="{{ route('admin.user.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
            <i class="bi bi-plus-circle"></i>
            Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-200 bg-white">
            <form method="GET">
                <div class="flex flex-wrap -mx-3 g-2 items-center">
                    <div class="w-full md:w-1/2 px-3">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Cari nama atau username">
                    </div>

                    <div class="col-auto">
                        <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    @if($search)
                        <div class="col-auto">
                            <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">
                                Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="p-6 p-0">
            <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Terhubung</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username ?? '-' }}</td>
                            <td>
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
                            <td>{{ $user->penduduk?->nama_lengkap ?? 'Tidak ada' }}</td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.user.edit', $user) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.user.destroy', $user) }}" class="d-inline mb-0" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8">
                                <i class="bi bi-inbox fs-1 d-block mb-4"></i>
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
