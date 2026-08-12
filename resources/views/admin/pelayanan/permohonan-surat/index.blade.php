@extends('layouts.admin')

@section('title', 'Permohonan Surat')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Permohonan Surat</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data permohonan surat masuk dan status pelayanannya.</p>
        </div>
        <a href="{{ route('admin.permohonan-surat.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 active:scale-95 cursor-pointer focus:outline-none active:scale-95 cursor-pointer">
            <i class="fa-solid fa-circle-plus"></i> Buat Permohonan Baru
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- Toolbar: Search & Filter --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nomor / Nama Pemohon..." class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 pl-10 pr-4 py-2.5 shadow-sm">
                </div>
                
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95" title="Reset Filter">
    <i class="fa-solid fa-rotate-left"></i>
</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th width="70" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">No. Permohonan</th>
                        <th class="px-6 py-4 border-b border-slate-100">Tanggal</th>
                        <th class="px-6 py-4 border-b border-slate-100">Pemohon</th>
                        <th class="px-6 py-4 border-b border-slate-100">Jenis Surat</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th width="200" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($permohonans as $permohonan)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center">{{ $permohonans->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-mono font-medium text-slate-900">{{ $permohonan->nomor_permohonan }}</td>
                        <td class="px-6 py-4">{{ $permohonan->tanggal_permohonan->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900">
                            {{ optional($permohonan->penduduk)->nama_lengkap ?? data_get($permohonan->data_surat, 'nama_lengkap') ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-700">
                                {{ optional($permohonan->jenisSurat)->nama ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'diproses' => 'bg-sky-100 text-sky-700',
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'ditolak' => 'bg-rose-100 text-rose-700',
                                    'dibatalkan' => 'bg-slate-100 text-slate-700'
                                ];
                                $statusIcon = [
                                    'pending' => 'fa-clock',
                                    'diproses' => 'fa-spinner',
                                    'selesai' => 'fa-check-circle',
                                    'ditolak' => 'fa-xmark-circle',
                                    'dibatalkan' => 'fa-ban'
                                ];
                                $color = $statusColors[strtolower($permohonan->status)] ?? 'bg-slate-100 text-slate-700';
                                $icon = $statusIcon[strtolower($permohonan->status)] ?? 'fa-circle-info';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wide {{ $color }} uppercase">
                                <i class="fa-solid {{ $icon }}"></i> {{ $permohonan->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.permohonan-surat.show', $permohonan->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors shadow-sm focus:outline-none active:scale-95 cursor-pointer" title="Detail & Proses">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-file-signature text-4xl mb-4 text-slate-300"></i>
                            <p class="text-sm font-medium">Belum ada data permohonan surat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($permohonans->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $permohonans->links() }}
        </div>
        @endif

    </div>
</div>
@endsection