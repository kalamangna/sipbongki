@extends('layouts.admin')

@section('title', 'Laporan Kartu Keluarga')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan Kartu Keluarga</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400">Rekapitulasi data Kartu Keluarga Kelurahan Bongki</p>
    </div>
    <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
        <a href="{{ route('admin.laporan.index') }}"
            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('admin.laporan.print-kartu-keluarga', request()->query()) }}"
            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-print"></i> Cetak
        </a>
        <a href="{{ route('admin.laporan.export-kartu-keluarga') }}"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-file-excel"></i> Export Excel
        </a>
    </div>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-5 mb-6">
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Total KK</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-slate-100">{{ number_format($statistik['total_kk']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Total Anggota</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ number_format($statistik['total_anggota']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">KK Aktif</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-sky-600 dark:text-sky-400">{{ number_format($statistik['kk_aktif']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Rata-rata / KK</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-amber-600 dark:text-amber-400">{{ $statistik['rata_anggota'] }}</p>
    </div>
</div>

{{-- FILTER BAR (1 BARIS) --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-5 mb-6 dark:bg-slate-900 dark:border-slate-800">
    <form method="GET" action="{{ route('admin.laporan.kartu-keluarga') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        {{-- Search Keyword --}}
        <div class="relative flex-1 min-w-[200px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-xs pointer-events-none"></i>
            <input type="text" name="keyword"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary pl-9 pr-3.5 py-2.5 transition-colors placeholder:text-slate-400 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                placeholder="Cari No. KK atau Nama Kepala Keluarga..."
                value="{{ request('keyword') }}">
        </div>

        {{-- Lingkungan --}}
        <div class="w-full sm:w-48 xl:w-52 shrink-0">
            <select name="lingkungan"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                <option value="">Semua Lingkungan</option>
                @foreach($lingkungans as $lingkungan)
                    <option value="{{ $lingkungan->id }}" @selected(request('lingkungan') == $lingkungan->id)>
                        {{ $lingkungan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="w-full sm:w-36 xl:w-40 shrink-0">
            <select name="status"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                <option value="">Semua Status</option>
                <option value="1" @selected(request('status') === '1')>Aktif</option>
                <option value="0" @selected(request('status') === '0')>Tidak Aktif</option>
            </select>
        </div>

        {{-- Buttons --}}
        <div class="flex items-center gap-2 shrink-0">
            <button type="submit"
                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all active:scale-95 focus:outline-none cursor-pointer dark:bg-primary-600 dark:hover:bg-primary-700">
                <i class="fa-solid fa-filter text-xs"></i> Filter
            </button>
            @if(request()->filled('keyword') || request()->filled('lingkungan') || request()->filled('status'))
                <a href="{{ route('admin.laporan.kartu-keluarga') }}"
                    class="inline-flex items-center justify-center p-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                    title="Reset Filter">
                    <i class="fa-solid fa-rotate-left text-xs"></i>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- REKAP PER LINGKUNGAN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
        <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Rekap Kartu Keluarga per Lingkungan</h5>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300 min-w-[600px]">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/50 dark:text-slate-400">
                <tr>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 w-12">No</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Lingkungan</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Jumlah KK</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Jumlah Penduduk</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($rekapLingkungan as $item)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-400 text-xs">{{ $loop->iteration }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-800 dark:text-slate-200">{{ $item->nama }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 dark:bg-primary-950/60 dark:text-primary-300">
                            {{ number_format($item->kartu_keluargas_count) }} KK
                        </span>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">
                            {{ number_format($item->penduduk_count) }} Jiwa
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-4 sm:px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-500">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- TABEL DATA KK --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 dark:border-slate-800 dark:bg-slate-800/50">
        <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Data Kartu Keluarga</h5>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 dark:bg-primary-950/60 dark:text-primary-300">
            {{ $kartuKeluargas->total() }} Data
        </span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300 min-w-[800px]">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/50 dark:text-slate-400">
                <tr>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 w-12">No</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">No. KK</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Kepala Keluarga</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Anggota</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Lingkungan</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">RT/RW</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Status</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($kartuKeluargas as $kk)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-400 text-xs">{{ $kartuKeluargas->firstItem() + $loop->index }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-xs text-slate-600 dark:text-slate-400">{{ $kk->no_kk }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-900 dark:text-slate-100">{{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-sky-700 dark:bg-sky-950/60 dark:text-sky-300">
                            {{ $kk->anggota_count }} Orang
                        </span>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">{{ optional($kk->lingkungan)->nama ?? '-' }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center text-slate-500 dark:text-slate-400">{{ $kk->rt }}/{{ $kk->rw }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        @if($kk->aktif)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        <a href="{{ route('admin.laporan.kartu-keluarga.show', $kk->id) }}"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 dark:bg-sky-950/40 dark:text-sky-300 dark:hover:bg-sky-900/60 transition-colors"
                            title="Detail">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 sm:px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-inbox text-2xl mb-2 block text-slate-300 dark:text-slate-600"></i>
                        Tidak ada data Kartu Keluarga.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kartuKeluargas->hasPages())
    <div class="px-4 sm:px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
        {{ $kartuKeluargas->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection