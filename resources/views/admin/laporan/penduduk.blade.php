@extends('layouts.admin')

@section('title', 'Laporan Penduduk')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan Kependudukan</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400">Statistik dan rekapitulasi data penduduk Kelurahan Bongki</p>
    </div>
    <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
        <a href="{{ route('admin.laporan.index') }}"
            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('admin.laporan.print-penduduk', array_merge(request()->query(), ['from' => 'penduduk'])) }}"
            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-print"></i> Cetak
        </a>
        <a href="{{ route('admin.laporan.export-penduduk') }}"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-file-excel"></i> Export Excel
        </a>
    </div>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5 mb-6">
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Total Penduduk</p>
        <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-slate-100">{{ number_format($statistik['total']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Laki-laki</p>
        <p class="text-3xl sm:text-4xl font-extrabold text-sky-600 dark:text-sky-400">{{ number_format($statistik['laki']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 sm:p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Perempuan</p>
        <p class="text-3xl sm:text-4xl font-extrabold text-rose-500 dark:text-rose-400">{{ number_format($statistik['perempuan']) }}</p>
    </div>
</div>

{{-- FILTER BAR (1 BARIS) --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-5 mb-6 dark:bg-slate-900 dark:border-slate-800">
    <form method="GET" action="{{ route('admin.laporan.penduduk') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        {{-- Search Keyword --}}
        <div class="relative flex-1 min-w-[200px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-xs pointer-events-none"></i>
            <input type="text" name="keyword"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary pl-9 pr-3.5 py-2.5 transition-colors placeholder:text-slate-400 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                placeholder="Cari Nama atau NIK..."
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

        {{-- Status Kependudukan --}}
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
                <a href="{{ route('admin.laporan.penduduk') }}"
                    class="inline-flex items-center justify-center p-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                    title="Reset Filter">
                    <i class="fa-solid fa-rotate-left text-xs"></i>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- REKAP LINGKUNGAN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
        <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Rekap Penduduk per Lingkungan</h5>
    </div>
    <div class="p-4 sm:p-6 grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($rekapLingkungan as $item)
        <div class="text-center p-4 rounded-xl border border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">{{ $item->nama }}</p>
            <p class="text-2xl font-extrabold text-primary-600 dark:text-primary-400">{{ number_format($item->penduduk_count) }}</p>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Penduduk</p>
        </div>
        @endforeach
    </div>
</div>

{{-- ANALISIS DATA --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    {{-- Agama --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Berdasarkan Agama</h5>
        </div>
        <div class="p-4 sm:p-6 space-y-3">
            @forelse($rekapAgama as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600 dark:text-slate-300">{{ $item->agama ?: '-' }}</span>
                <span class="font-bold text-slate-900 dark:text-slate-100">{{ number_format($item->total) }}</span>
            </div>
            @empty
            <p class="text-sm text-slate-400 dark:text-slate-500">Tidak ada data.</p>
            @endforelse
        </div>
    </div>
    {{-- Pendidikan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Berdasarkan Pendidikan</h5>
        </div>
        <div class="p-4 sm:p-6 space-y-3">
            @forelse($rekapPendidikan as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600 dark:text-slate-300">{{ $item->pendidikan ?: '-' }}</span>
                <span class="font-bold text-slate-900 dark:text-slate-100">{{ number_format($item->total) }}</span>
            </div>
            @empty
            <p class="text-sm text-slate-400 dark:text-slate-500">Tidak ada data.</p>
            @endforelse
        </div>
    </div>
    {{-- Pekerjaan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Berdasarkan Pekerjaan</h5>
        </div>
        <div class="p-4 sm:p-6 space-y-3">
            @forelse($rekapPekerjaan as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600 dark:text-slate-300">{{ $item->pekerjaan ?: '-' }}</span>
                <span class="font-bold text-slate-900 dark:text-slate-100">{{ number_format($item->total) }}</span>
            </div>
            @empty
            <p class="text-sm text-slate-400 dark:text-slate-500">Tidak ada data.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- TABEL DATA PENDUDUK --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 dark:border-slate-800 dark:bg-slate-800/50">
        <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Data Penduduk</h5>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 dark:bg-primary-950/60 dark:text-primary-300">
            {{ $penduduks->total() }} Data
        </span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300 min-w-[700px]">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/50 dark:text-slate-400">
                <tr>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 w-12">No</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">NIK</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Nama Lengkap</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Jenis Kelamin</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Lingkungan</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Alamat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($penduduks as $penduduk)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-400 text-xs">
                        {{ $loop->iteration + (($penduduks->currentPage()-1) * $penduduks->perPage()) }}
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-xs text-slate-600 dark:text-slate-400">{{ $penduduk->nik }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-900 dark:text-slate-100">
                        <span title="No. KK: {{ optional($penduduk->kartuKeluarga)->nomor_kk ?? '-' }}">
                            {{ $penduduk->nama_lengkap }}
                        </span>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                        @if($penduduk->jenis_kelamin == 'L')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700 dark:bg-sky-950/60 dark:text-sky-300">Laki-laki</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300">Perempuan</span>
                        @endif
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">{{ optional($penduduk->lingkungan)->nama ?? '-' }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-500 dark:text-slate-400">{{ $penduduk->alamat ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 sm:px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-inbox text-2xl mb-2 block text-slate-300 dark:text-slate-600"></i>
                        Belum ada data penduduk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($penduduks->hasPages())
    <div class="px-4 sm:px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
        {{ $penduduks->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
