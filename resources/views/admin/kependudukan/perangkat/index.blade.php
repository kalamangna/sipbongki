@extends('layouts.admin')

@section('title', 'Perangkat Kelurahan')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Perangkat Kelurahan</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data aparatur dan perangkat kelurahan</p>
        </div>
        <a href="{{ route('admin.perangkat.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 active:scale-95 cursor-pointer">
            <i class="fa-solid fa-circle-plus"></i> Tambah Perangkat
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                    <tr>
                        <th width="80" class="px-6 py-4 border-b border-slate-100 text-center">Foto</th>
                        <th class="px-6 py-4 border-b border-slate-100">Nama Lengkap</th>
                        <th class="px-6 py-4 border-b border-slate-100">NIP</th>
                        <th class="px-6 py-4 border-b border-slate-100">Jabatan</th>
                        <th width="100" class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th width="120" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($perangkats as $perangkat)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center">
                            @if($perangkat->foto)
                                <img src="{{ asset('storage/'.$perangkat->foto) }}" alt="Foto {{ $perangkat->nama_lengkap }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm mx-auto">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 ring-2 ring-white shadow-sm mx-auto">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">{{ $perangkat->nama_lengkap }}</td>
                        <td class="px-6 py-4 font-mono text-slate-700">{{ $perangkat->nip ?? '-' }}</td>
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $perangkat->jabatan->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($perangkat->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.perangkat.show', $perangkat->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-all active:scale-95 cursor-pointer" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-user-tie text-4xl mb-4 text-slate-300"></i>
                            <p class="text-sm">Belum ada data perangkat kelurahan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($perangkats->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $perangkats->links() }}
        </div>
        @endif

    </div>
</div>
@endsection