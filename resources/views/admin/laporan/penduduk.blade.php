@extends('layouts.admin')

@section('title', 'Laporan Penduduk')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Laporan Kependudukan</h3>
        <p class="text-sm text-slate-500">Statistik dan rekapitulasi data penduduk Kelurahan Bongki</p>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('admin.laporan.print-penduduk', array_merge(request()->query(), ['from' => 'penduduk'])) }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-print"></i> Cetak
        </a>
        <a href="{{ route('admin.laporan.export-penduduk') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-file-excel"></i> Export Excel
        </a>
    </div>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Total Penduduk</p>
        <p class="text-4xl font-extrabold text-slate-900">{{ number_format($statistik['total']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Laki-laki</p>
        <p class="text-4xl font-extrabold text-sky-600">{{ number_format($statistik['laki']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Perempuan</p>
        <p class="text-4xl font-extrabold text-rose-500">{{ number_format($statistik['perempuan']) }}</p>
    </div>
</div>

{{-- FILTER --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
        <h5 class="text-sm font-bold text-slate-800">Filter Data</h5>
    </div>
    <div class="p-6">
        <form method="GET" action="{{ route('admin.laporan.penduduk') }}">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama / NIK</label>
                    <input type="text" name="keyword"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors"
                        placeholder="Cari nama atau NIK..."
                        value="{{ request('keyword') }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Lingkungan</label>
                    <select name="lingkungan"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors">
                        <option value="">Semua Lingkungan</option>
                        @foreach($lingkungans as $lingkungan)
                        <option value="{{ $lingkungan->id }}" @selected(request('lingkungan') == $lingkungan->id)>
                            {{ $lingkungan->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Jenis Kelamin</label>
                    <select name="jk"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors">
                        <option value="">Semua</option>
                        <option value="L" @selected(request('jk')=='L')>Laki-laki</option>
                        <option value="P" @selected(request('jk')=='P')>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Agama</label>
                    <select name="agama"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors">
                        <option value="">Semua Agama</option>
                        @foreach($agamaList as $agama)
                        <option value="{{ $agama }}" @selected(request('agama') == $agama)>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all active:scale-95 focus:outline-none">
                    <i class="fa-solid fa-magnifying-glass"></i> Tampilkan
                </button>
                <a href="{{ route('admin.laporan.penduduk') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95"
                    title="Reset Filter">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- REKAP LINGKUNGAN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
        <h5 class="text-sm font-bold text-slate-800">Rekap Penduduk per Lingkungan</h5>
    </div>
    <div class="p-6 grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($rekapLingkungan as $item)
        <div class="text-center p-4 rounded-xl border border-slate-100 bg-slate-50/50">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ $item->nama }}</p>
            <p class="text-2xl font-extrabold text-primary-600">{{ number_format($item->penduduk_count) }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Penduduk</p>
        </div>
        @endforeach
    </div>
</div>

{{-- ANALISIS DATA --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    {{-- Agama --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h5 class="text-sm font-bold text-slate-800">Berdasarkan Agama</h5>
        </div>
        <div class="p-6 space-y-3">
            @forelse($rekapAgama as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600">{{ $item->agama ?: '-' }}</span>
                <span class="font-bold text-slate-900">{{ number_format($item->total) }}</span>
            </div>
            @empty
            <p class="text-sm text-slate-400">Tidak ada data.</p>
            @endforelse
        </div>
    </div>
    {{-- Pendidikan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h5 class="text-sm font-bold text-slate-800">Berdasarkan Pendidikan</h5>
        </div>
        <div class="p-6 space-y-3">
            @forelse($rekapPendidikan as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600">{{ $item->pendidikan ?: '-' }}</span>
                <span class="font-bold text-slate-900">{{ number_format($item->total) }}</span>
            </div>
            @empty
            <p class="text-sm text-slate-400">Tidak ada data.</p>
            @endforelse
        </div>
    </div>
    {{-- Pekerjaan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h5 class="text-sm font-bold text-slate-800">Berdasarkan Pekerjaan</h5>
        </div>
        <div class="p-6 space-y-3">
            @forelse($rekapPekerjaan as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600">{{ $item->pekerjaan ?: '-' }}</span>
                <span class="font-bold text-slate-900">{{ number_format($item->total) }}</span>
            </div>
            @empty
            <p class="text-sm text-slate-400">Tidak ada data.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- TABEL DATA PENDUDUK --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
        <h5 class="text-sm font-bold text-slate-800">Data Penduduk</h5>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700">
            {{ $penduduks->total() }} Data
        </span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                <tr>
                    <th class="px-6 py-4 border-b border-slate-100 w-12">No</th>
                    <th class="px-6 py-4 border-b border-slate-100">NIK</th>
                    <th class="px-6 py-4 border-b border-slate-100">Nama Lengkap</th>
                    <th class="px-6 py-4 border-b border-slate-100">Jenis Kelamin</th>
                    <th class="px-6 py-4 border-b border-slate-100">Lingkungan</th>
                    <th class="px-6 py-4 border-b border-slate-100">Alamat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($penduduks as $penduduk)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 text-slate-400 text-xs">
                        {{ $loop->iteration + (($penduduks->currentPage()-1) * $penduduks->perPage()) }}
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-600">{{ $penduduk->nik }}</td>
                    <td class="px-6 py-4 font-medium text-slate-900">
                        <span title="No. KK: {{ optional($penduduk->kartuKeluarga)->nomor_kk ?? '-' }}">
                            {{ $penduduk->nama_lengkap }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($penduduk->jenis_kelamin == 'L')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700">Laki-laki</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700">Perempuan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ optional($penduduk->lingkungan)->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $penduduk->alamat ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-400">
                        <i class="fa-solid fa-inbox text-2xl mb-2 block text-slate-300"></i>
                        Belum ada data penduduk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($penduduks->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $penduduks->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
