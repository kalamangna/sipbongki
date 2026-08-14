@extends('layouts.admin')

@section('title', 'Laporan Persuratan')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Laporan Persuratan</h3>
        <p class="text-sm text-slate-500">Rekapitulasi seluruh pelayanan persuratan Kelurahan Bongki</p>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.laporan.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('admin.laporan.print-persuratan', request()->query()) }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-print"></i> Cetak
        </a>
        <a href="{{ route('admin.laporan.export-persuratan') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-file-excel"></i> Export Excel
        </a>
    </div>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-5 mb-6">
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Total Permohonan</p>
        <p class="text-3xl font-extrabold text-slate-900">{{ number_format($statistik['total']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Menunggu</p>
        <p class="text-3xl font-extrabold text-amber-500">{{ number_format($statistik['menunggu']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Diproses</p>
        <p class="text-3xl font-extrabold text-sky-600">{{ number_format($statistik['diproses']) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Selesai</p>
        <p class="text-3xl font-extrabold text-emerald-600">{{ number_format($statistik['selesai']) }}</p>
    </div>
</div>

{{-- FILTER BAR (1 BARIS) --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 mb-6">
    <form method="GET" action="{{ route('admin.laporan.persuratan') }}" class="flex flex-col xl:flex-row items-stretch xl:items-center gap-3">
        {{-- Search Keyword --}}
        <div class="relative flex-1 min-w-[200px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
            <input type="text" name="keyword"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 pl-9 pr-3.5 py-2.5 transition-colors placeholder:text-slate-400"
                placeholder="Cari No. Permohonan atau Nama Pemohon..."
                value="{{ request('keyword') }}">
        </div>

        {{-- Jenis Surat --}}
        <div class="w-full sm:w-48 xl:w-52 shrink-0">
            <select name="jenis_surat"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors">
                <option value="">Jenis Surat</option>
                @foreach($jenisSurats as $jenis)
                    <option value="{{ $jenis->id }}" @selected(request('jenis_surat') == $jenis->id)>
                        {{ $jenis->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="w-full sm:w-36 xl:w-36 shrink-0">
            <select name="status"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors">
                <option value="">Status</option>
                @foreach(['Menunggu', 'Diproses', 'Selesai', 'Ditolak'] as $st)
                    <option value="{{ $st }}" @selected(request('status') == $st)>{{ $st }}</option>
                @endforeach
            </select>
        </div>

        {{-- Rentang Tanggal --}}
        <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 shrink-0">
            <span class="text-xs font-semibold text-slate-400 mr-1"><i class="fa-regular fa-calendar text-[11px]"></i></span>
            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                class="bg-transparent text-xs text-slate-800 focus:outline-none border-0 p-0" title="Tanggal Mulai">
            <span class="text-xs text-slate-400 font-medium px-1">s/d</span>
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                class="bg-transparent text-xs text-slate-800 focus:outline-none border-0 p-0" title="Tanggal Selesai">
        </div>

        {{-- Buttons --}}
        <div class="flex items-center gap-2 shrink-0">
            <button type="submit"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-primary text-white hover:bg-primary-dark shadow-sm transition-all active:scale-95 focus:outline-none cursor-pointer">
                <i class="fa-solid fa-filter text-xs"></i> Filter
            </button>
            @if(request()->filled('keyword') || request()->filled('jenis_surat') || request()->filled('status') || request()->filled('tanggal_awal') || request()->filled('tanggal_akhir'))
                <a href="{{ route('admin.laporan.persuratan') }}"
                    class="inline-flex items-center justify-center p-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95"
                    title="Reset Filter">
                    <i class="fa-solid fa-rotate-left text-xs"></i>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- REKAP JENIS SURAT --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
        <h5 class="text-sm font-bold text-slate-800">Rekap Berdasarkan Jenis Surat</h5>
    </div>
    <div class="p-6 grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
        @php $colors = ['primary', 'emerald', 'amber', 'rose', 'sky', 'violet']; @endphp
        @forelse($rekapJenis as $index => $item)
        @php $color = $colors[$index % count($colors)]; @endphp
        <div class="text-center p-4 rounded-xl border border-slate-100 bg-slate-50/50">
            <p class="text-xs font-semibold text-slate-500 mb-1 truncate" title="{{ $item->nama }}">{{ $item->nama }}</p>
            <p class="text-2xl font-extrabold text-{{ $color }}-600">{{ number_format($item->permohonan_surats_count) }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Permohonan</p>
        </div>
        @empty
        <div class="col-span-4 text-center text-sm text-slate-400 py-6">Belum ada data jenis surat.</div>
        @endforelse
    </div>
</div>

{{-- TABEL DATA PERSURATAN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
        <h5 class="text-sm font-bold text-slate-800">Data Permohonan Surat</h5>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700">
            {{ $permohonans->total() }} Data
        </span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                <tr>
                    <th class="px-4 py-4 border-b border-slate-100 w-10">No</th>
                    <th class="px-4 py-4 border-b border-slate-100" style="min-width:180px">No. Permohonan</th>
                    <th class="px-4 py-4 border-b border-slate-100" style="min-width:130px">No. Surat</th>
                    <th class="px-4 py-4 border-b border-slate-100" style="min-width:160px">Pemohon</th>
                    <th class="px-4 py-4 border-b border-slate-100" style="min-width:200px">Jenis Surat</th>
                    <th class="px-4 py-4 border-b border-slate-100" style="min-width:110px">Tanggal</th>
                    <th class="px-4 py-4 border-b border-slate-100" style="min-width:180px">Penandatangan</th>
                    <th class="px-4 py-4 border-b border-slate-100 text-center">Status</th>
                    <th class="px-4 py-4 border-b border-slate-100 text-center w-16">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($permohonans as $item)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3 text-slate-400 text-xs">{{ $permohonans->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-mono text-xs text-slate-600">{{ $item->nomor_permohonan }}</td>
                    <td class="px-4 py-3 font-mono text-xs text-slate-500">{{ $item->nomor_surat ?: '-' }}</td>
                    <td class="px-4 py-3">
                        <p class="font-medium text-slate-900 leading-tight">{{ optional($item->penduduk)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ optional($item->penduduk)->nik ?? data_get($item->data_surat, 'nik') ?? '-' }}</p>
                    </td>
                    <td class="px-4 py-3 text-slate-700">{{ optional($item->jenisSurat)->nama }}</td>
                    <td class="px-4 py-3 text-slate-500">{{ optional($item->tanggal_permohonan)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        <p class="font-medium text-slate-800 leading-tight">{{ optional($item->penandatangan)->nama_lengkap ?? '-' }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ optional(optional($item->penandatangan)->jabatan)->nama ?? '' }}</p>
                    </td>
                    <td class="px-4 py-3 text-center">
                        @switch($item->status)
                            @case('Menunggu')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700">Menunggu</span>
                                @break
                            @case('Diproses')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700">Diproses</span>
                                @break
                            @case('Selesai')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">Selesai</span>
                                @break
                            @default
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700">Ditolak</span>
                        @endswitch
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('admin.laporan.persuratan.show', $item->id) }}"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition-colors"
                            title="Detail">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-10 text-center text-sm text-slate-400">
                        <i class="fa-solid fa-inbox text-2xl mb-2 block text-slate-300"></i>
                        Belum ada data permohonan surat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($permohonans->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $permohonans->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection