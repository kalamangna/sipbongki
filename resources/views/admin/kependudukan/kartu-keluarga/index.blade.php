@extends('layouts.admin')

@section('title', 'Data Kartu Keluarga')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Kartu Keluarga</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data Kartu Keluarga (KK) Kelurahan Bongki</p>
        </div>
        <a href="{{ route('admin.kartu-keluarga.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5">
            <i class="fa-solid fa-circle-plus"></i> Tambah KK
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
        
        {{-- Filters --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.kartu-keluarga.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm" placeholder="Cari No. KK / NIK / Nama Kepala Keluarga / Anggota...">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all w-full sm:w-auto">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if(request('keyword'))
                        <a href="{{ route('admin.kartu-keluarga.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                    <tr>
                        <th width="50" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">No. KK</th>
                        <th class="px-6 py-4 border-b border-slate-100">Kepala Keluarga</th>
                        <th class="px-6 py-4 border-b border-slate-100">Lingkungan</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Anggota</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th width="120" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kartuKeluargas as $kk)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ ($kartuKeluargas->firstItem() ?? 0) + $loop->index }}</td>
                        <td class="px-6 py-4 font-mono font-medium text-slate-900">{{ $kk->no_kk }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $kk->kepalaKeluarga->nama_lengkap ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-800">{{ $kk->lingkungan->nama ?? '-' }}</p>
                            <p class="text-[11px] text-slate-500 mt-0.5">RT {{ $kk->rt ?? '00' }} / RW {{ $kk->rw ?? '00' }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $jumlahAnggota = $kk->anggota->where('id', '!=', $kk->kepala_keluarga_id)->count();
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-600 tracking-wide">
                                {{ $jumlahAnggota }} Orang
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($kk->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.kartu-keluarga.show', $kk->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.kartu-keluarga.edit', $kk->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.kartu-keluarga.destroy', $kk->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus Kartu Keluarga ini? Semua data penduduk di dalamnya akan kehilangan relasi KK ini.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-address-card text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada data Kartu Keluarga yang sesuai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($kartuKeluargas->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $kartuKeluargas->links() }}
        </div>
        @endif

    </div>
</div>
@endsection