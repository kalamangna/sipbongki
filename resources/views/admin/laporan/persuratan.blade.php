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
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('admin.laporan.print-persuratan', request()->query()) }}" target="_blank"
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

{{-- FILTER --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
        <h5 class="text-sm font-bold text-slate-800">Filter Data</h5>
    </div>
    <div class="p-6">
        <form method="GET" action="{{ route('admin.laporan.persuratan') }}">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">
                <div class="xl:col-span-2">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nomor / Nama / NIK</label>
                    <input type="text" name="keyword"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors"
                        placeholder="Cari nomor surat, nama, atau NIK..."
                        value="{{ request('keyword') }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Jenis Surat</label>
                    <select name="jenis_surat"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors">
                        <option value="">Semua Jenis Surat</option>
                        @foreach($jenisSurats as $jenis)
                        <option value="{{ $jenis->id }}" @selected(request('jenis_surat') == $jenis->id)>{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Status</label>
                    <select name="status"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors">
                        <option value="">Semua</option>
                        <option value="Menunggu" @selected(request('status')=='Menunggu')>Menunggu</option>
                        <option value="Diproses" @selected(request('status')=='Diproses')>Diproses</option>
                        <option value="Selesai" @selected(request('status')=='Selesai')>Selesai</option>
                        <option value="Ditolak" @selected(request('status')=='Ditolak')>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Dari</label>
                    <input type="date" name="tanggal_awal"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-4 py-2.5 transition-colors"
                        value="{{ request('tanggal_awal') }}">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Sampai</label>
                    <input type="date" name="tanggal_akhir"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-4 py-2.5 transition-colors"
                        value="{{ request('tanggal_akhir') }}">
                </div>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all active:scale-95 focus:outline-none">
                    <i class="fa-solid fa-magnifying-glass"></i> Tampilkan
                </button>
                <a href="{{ route('admin.laporan.persuratan') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95"
                    title="Reset Filter">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>
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