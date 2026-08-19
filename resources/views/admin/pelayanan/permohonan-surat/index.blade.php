@extends('layouts.admin')

@section('title', 'Persuratan')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Persuratan</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Kelola data permohonan surat masuk dan status pelayanannya.</p>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-6">
        {{-- Menunggu --}}
        <a href="{{ route('admin.permohonan-surat.index', array_merge(request()->except(['page']), ['status' => request('status') === 'Menunggu' ? null : 'Menunggu'])) }}" 
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 transition-all hover:-translate-y-0.5 hover:shadow-md block dark:bg-slate-900 {{ request('status') === 'Menunggu' ? 'ring-amber-500 shadow-md ring-2 dark:ring-amber-500' : 'ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shrink-0 dark:bg-amber-950/60 dark:text-amber-400">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Menunggu</p>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($stats['menunggu']) }}</span>
                        <span class="text-xs text-slate-400 font-medium dark:text-slate-500">Permohonan</span>
                    </div>
                </div>
            </div>
        </a>

        {{-- Diproses --}}
        <a href="{{ route('admin.permohonan-surat.index', array_merge(request()->except(['page']), ['status' => request('status') === 'Diproses' ? null : 'Diproses'])) }}" 
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 transition-all hover:-translate-y-0.5 hover:shadow-md block dark:bg-slate-900 {{ request('status') === 'Diproses' ? 'ring-sky-500 shadow-md ring-2 dark:ring-sky-500' : 'ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shrink-0 dark:bg-sky-950/60 dark:text-sky-400">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Diproses</p>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($stats['diproses']) }}</span>
                        <span class="text-xs text-slate-400 font-medium dark:text-slate-500">Permohonan</span>
                    </div>
                </div>
            </div>
        </a>

        {{-- Selesai --}}
        <a href="{{ route('admin.permohonan-surat.index', array_merge(request()->except(['page']), ['status' => request('status') === 'Selesai' ? null : 'Selesai'])) }}" 
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 transition-all hover:-translate-y-0.5 hover:shadow-md block dark:bg-slate-900 {{ request('status') === 'Selesai' ? 'ring-emerald-500 shadow-md ring-2 dark:ring-emerald-500' : 'ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0 dark:bg-emerald-950/60 dark:text-emerald-400">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Selesai</p>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($stats['selesai']) }}</span>
                        <span class="text-xs text-slate-400 font-medium dark:text-slate-500">Permohonan</span>
                    </div>
                </div>
            </div>
        </a>

        {{-- Ditolak --}}
        <a href="{{ route('admin.permohonan-surat.index', array_merge(request()->except(['page']), ['status' => request('status') === 'Ditolak' ? null : 'Ditolak'])) }}" 
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 transition-all hover:-translate-y-0.5 hover:shadow-md block dark:bg-slate-900 {{ request('status') === 'Ditolak' ? 'ring-rose-500 shadow-md ring-2 dark:ring-rose-500' : 'ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shrink-0 dark:bg-rose-950/60 dark:text-rose-400">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Ditolak</p>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($stats['ditolak']) }}</span>
                        <span class="text-xs text-slate-400 font-medium dark:text-slate-500">Permohonan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        
        {{-- Toolbar: Search & Filter --}}
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:bg-slate-800/50 dark:border-slate-800">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. Permohonan atau Nama Pemohon..." class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary pl-10 pr-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                </div>
                <div class="w-full md:w-48">
                    <select name="jenis_pemohon" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Pemohon</option>
                        <option value="bongki" {{ request('jenis_pemohon') == 'bongki' ? 'selected' : '' }}>Penduduk Bongki</option>
                        <option value="luar" {{ request('jenis_pemohon') == 'luar' ? 'selected' : '' }}>Penduduk Luar Bongki</option>
                    </select>
                </div>

                <div class="w-full md:w-48">
                    <select name="jenis_surat_id" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Jenis Surat</option>
                        @foreach($jenisSurats as $js)
                            <option value="{{ $js->id }}" {{ request('jenis_surat_id') == $js->id ? 'selected' : '' }}>{{ $js->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-40">
                    <select name="status" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-primary-600 dark:hover:bg-primary-700">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if(request('search') || request('jenis_surat_id') || request('jenis_pemohon') || request('status'))
                        <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 min-w-[850px] dark:text-slate-300">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80 dark:bg-slate-800/80 dark:text-slate-400">
                    <tr>
                        <th width="70" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">No</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 whitespace-nowrap dark:border-slate-800">No. Permohonan</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 whitespace-nowrap dark:border-slate-800">Tanggal</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 whitespace-nowrap dark:border-slate-800">Pemohon</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 whitespace-nowrap dark:border-slate-800">Jenis Surat</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">Status</th>
                        <th width="120" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($permohonans as $permohonan)
                    <tr class="hover:bg-slate-50/80 transition-colors dark:hover:bg-slate-800/50">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">{{ $permohonans->firstItem() + $loop->index }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono font-medium text-slate-900 whitespace-nowrap dark:text-slate-100">{{ $permohonan->nomor_permohonan }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 whitespace-nowrap">{{ $permohonan->tanggal_permohonan->format('d/m/Y') }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 whitespace-nowrap">
                            <div class="font-bold text-slate-900 dark:text-slate-100">
                                {{ optional($permohonan->penduduk)->nama_lengkap ?? data_get($permohonan->data_surat, 'nama_lengkap') ?? '-' }}
                            </div>
                            <div class="mt-1">
                                @if($permohonan->penduduk_id)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 ring-1 ring-emerald-500/30 dark:bg-emerald-950/60 dark:text-emerald-300 dark:ring-emerald-800/40">
                                        <i class="fa-solid fa-circle-check text-[10px] text-emerald-600 dark:text-emerald-400"></i>
                                        Penduduk Bongki
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-900 ring-1 ring-amber-500/30 dark:bg-amber-950/60 dark:text-amber-300 dark:ring-amber-800/40">
                                        <i class="fa-solid fa-circle-info text-[10px] text-amber-600 dark:text-amber-400"></i>
                                        Penduduk Luar Bongki
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 whitespace-nowrap">
                            @php
                                $colorThemes = [
                                    0 => 'bg-emerald-50 text-emerald-600 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/50',
                                    1 => 'bg-rose-50 text-rose-600 border-rose-200 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/50',
                                    2 => 'bg-sky-50 text-sky-600 border-sky-200 dark:bg-sky-950/40 dark:text-sky-300 dark:border-sky-800/50',
                                    3 => 'bg-slate-50 text-slate-600 border-slate-200 dark:bg-slate-800/60 dark:text-slate-300 dark:border-slate-700',
                                    4 => 'bg-indigo-50 text-indigo-600 border-indigo-200 dark:bg-indigo-950/40 dark:text-indigo-300 dark:border-indigo-800/50',
                                    5 => 'bg-amber-50 text-amber-600 border-amber-200 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/50',
                                ];
                                $jenisIndex = isset($jenisSurats) ? $jenisSurats->values()->search(fn($item) => $item->id === $permohonan->jenis_surat_id) : 0;
                                $badgeTheme = $colorThemes[($jenisIndex !== false ? $jenisIndex : 0) % count($colorThemes)];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold border {{ $badgeTheme }}">
                                {{ optional($permohonan->jenisSurat)->nama ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            @php
                                $statusColors = [
                                    'menunggu'   => 'bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300',
                                    'pending'    => 'bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300',
                                    'diproses'   => 'bg-sky-100 text-sky-700 dark:bg-sky-950/60 dark:text-sky-300',
                                    'selesai'    => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300',
                                    'ditolak'    => 'bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300',
                                    'dibatalkan' => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300'
                                ];
                                $statusIcon = [
                                    'menunggu'   => 'fa-clock',
                                    'pending'    => 'fa-clock',
                                    'diproses'   => 'fa-spinner',
                                    'selesai'    => 'fa-check-circle',
                                    'ditolak'    => 'fa-xmark-circle',
                                    'dibatalkan' => 'fa-ban'
                                ];
                                $statusKey = strtolower($permohonan->status);
                                $color = $statusColors[$statusKey] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300';
                                $icon = $statusIcon[$statusKey] ?? 'fa-circle-info';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wide {{ $color }} uppercase">
                                <i class="fa-solid {{ $icon }}"></i> {{ $permohonan->status }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.permohonan-surat.show', $permohonan->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors shadow-sm focus:outline-none active:scale-95 cursor-pointer dark:bg-sky-950/60 dark:text-sky-300 dark:hover:bg-sky-900/50" title="Detail & Proses">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 sm:px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                            <i class="fa-solid fa-file-signature text-4xl mb-4 text-slate-300 dark:text-slate-600"></i>
                            <p class="text-sm font-medium">Belum ada data permohonan surat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($permohonans->hasPages())
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100 bg-white dark:border-slate-800 dark:bg-slate-900">
            {{ $permohonans->links() }}
        </div>
        @endif

    </div>
</div>
@endsection