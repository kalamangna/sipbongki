@extends('layouts.admin')

@section('title','Dashboard')
@section('subtitle','Sistem Informasi dan Pelayanan Kelurahan Bongki')

@section('content')

{{-- ============================================================
    HERO BANNER
============================================================ --}}
<div class="p-5 mb-6 bg-gradient-to-r from-green-700 to-green-900 rounded-2xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">
                Selamat Datang, {{ auth()->user()->name }}
                <span class="ms-2 inline-flex items-center rounded-full bg-white/20 px-2 py-0.5 text-xs font-medium text-white capitalize">{{ auth()->user()->role }}</span>
            </h2>
            <p class="text-sm text-green-200 mt-0.5">{{ now()->translatedFormat('d F Y') }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.penduduk.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-semibold rounded-lg bg-white text-green-800 hover:bg-green-50 transition-colors">
                <i class="fa-solid fa-user-plus"></i> Tambah Penduduk
            </a>
            <a href="{{ route('admin.permohonan-surat.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-semibold rounded-lg bg-green-600 text-white hover:bg-green-500 border border-green-500 transition-colors">
                <i class="fa-solid fa-file-circle-plus"></i> Layanan Surat
            </a>
        </div>
    </div>
</div>

{{-- ============================================================
    STAT CARDS — Flowbite Cards
============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

    {{-- Total Penduduk --}}
    <div class="p-4 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide dark:text-gray-400">Total Penduduk</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ number_format($totalPenduduk) }}</p>
        </div>
    </div>

    {{-- Kartu Keluarga --}}
    <div class="p-4 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-address-card"></i>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide dark:text-gray-400">Kartu Keluarga</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ number_format($totalKK) }}</p>
        </div>
    </div>

    {{-- Aparat Kelurahan --}}
    <div class="p-4 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide dark:text-gray-400">Aparat Kelurahan</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ number_format($totalPerangkat) }}</p>
        </div>
    </div>

    {{-- Permohonan Surat --}}
    <div class="p-4 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-file-signature"></i>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide dark:text-gray-400">Permohonan Surat</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ number_format($totalPermohonan) }}</p>
        </div>
    </div>

</div>

{{-- ============================================================
    QUICK ACCESS — Flowbite Cards with hover
============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

    <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-2xl shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group dark:bg-gray-800 dark:border-gray-700">
        <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-base shrink-0 group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-users"></i>
        </div>
        <p class="text-sm font-bold text-gray-900 dark:text-white">Data Penduduk</p>
    </a>

    <a href="{{ route('admin.kartu-keluarga.index') }}" class="flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-2xl shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group dark:bg-gray-800 dark:border-gray-700">
        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-base shrink-0 group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-address-card"></i>
        </div>
        <p class="text-sm font-bold text-gray-900 dark:text-white">Kartu Keluarga</p>
    </a>

    <a href="{{ route('admin.permohonan-surat.index') }}" class="flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-2xl shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group dark:bg-gray-800 dark:border-gray-700">
        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-base shrink-0 group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-file-signature"></i>
        </div>
        <p class="text-sm font-bold text-gray-900 dark:text-white">Persuratan</p>
    </a>

    <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-2xl shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group dark:bg-gray-800 dark:border-gray-700">
        <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-base shrink-0 group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <p class="text-sm font-bold text-gray-900 dark:text-white">Aparat Kelurahan</p>
    </a>

</div>

{{-- ============================================================
    GRAFIK & AKTIVITAS
============================================================ --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-6">

    {{-- Chart Pelayanan --}}
    <div class="xl:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-base font-bold text-gray-900 dark:text-white">Statistik Pelayanan</h5>
            <button onclick="downloadChart()" type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-green-700 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                <i class="fa-solid fa-download"></i> Export
            </button>
        </div>
        <div class="p-5">
            <div id="chartPelayanan"></div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700">
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-base font-bold text-gray-900 dark:text-white">Aktivitas Terbaru</h5>
        </div>
        <ul class="divide-y divide-gray-100 dark:divide-gray-700">
            <li class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 transition-colors">
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 text-xs">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <p class="text-sm font-medium text-gray-800 dark:text-white">Penduduk Baru</p>
            </li>
            <li class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 transition-colors">
                <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0 text-xs">
                    <i class="fa-solid fa-house-user"></i>
                </div>
                <p class="text-sm font-medium text-gray-800 dark:text-white">Kartu Keluarga</p>
            </li>
            <li class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 transition-colors">
                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 text-xs">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <p class="text-sm font-medium text-gray-800 dark:text-white">Permohonan Surat</p>
            </li>
            <li class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 transition-colors">
                <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 text-xs">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <p class="text-sm font-medium text-gray-800 dark:text-white">Sistem Aktif</p>
            </li>
        </ul>
    </div>

</div>

{{-- ============================================================
    PERMOHONAN TERBARU + KOMPOSISI PENDUDUK
============================================================ --}}
<div class="grid grid-cols-1 xl:grid-cols-4 gap-4 mb-6">

    {{-- Tabel Permohonan --}}
    <div class="xl:col-span-3 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-base font-bold text-gray-900 dark:text-white">Permohonan Surat Terbaru</h5>
            <a href="{{ route('admin.permohonan-surat.index') }}" class="text-xs font-semibold text-green-700 bg-green-50 border border-green-200 hover:bg-green-100 transition-colors px-3 py-1.5 rounded-lg dark:bg-green-900 dark:text-green-300 dark:border-green-700">
                Lihat Semua
            </a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                <thead class="text-xs font-semibold text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-5 py-3">Nama</th>
                        <th scope="col" class="px-5 py-3">Jenis Surat</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($permohonanTerbaru as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-5 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ optional($item->penduduk)->nama_lengkap ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-400">
                                {{ optional($item->jenisSurat)->nama ?? '-' }}
                            </td>
                            <td class="px-5 py-3">
                                @switch($item->status)
                                    @case('Menunggu')
                                        <span class="inline-flex items-center bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Menunggu</span>
                                    @break
                                    @case('Diproses')
                                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Diproses</span>
                                    @break
                                    @case('Selesai')
                                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Selesai</span>
                                    @break
                                    @case('Ditolak')
                                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Ditolak</span>
                                    @break
                                    @default
                                        <span class="inline-flex items-center bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $item->status }}</span>
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center text-sm text-gray-400">Belum ada data permohonan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Komposisi Penduduk --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700">
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-base font-bold text-gray-900 dark:text-white">Komposisi Penduduk</h5>
        </div>
        <div class="p-5">
            <div id="chartPenduduk" style="min-height:230px;"></div>
        </div>
    </div>

</div>

{{-- ============================================================
    STATISTIK PENDUDUK
============================================================ --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700 mb-6">
    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <h5 class="text-base font-bold text-gray-900 dark:text-white">Statistik Penduduk</h5>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 divide-y md:divide-y-0 md:divide-x divide-gray-100 dark:divide-gray-700">

        {{-- Pekerjaan --}}
        <div class="p-5">
            <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Pekerjaan</h6>
            @if($pekerjaanStat->isNotEmpty())
                @foreach($pekerjaanStat as $item)
                    <div class="mb-3">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-300">{{ $item->nama }}</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $item->total }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                            <div class="bg-green-600 h-1.5 rounded-full" style="width: {{ $totalPenduduk > 0 ? ($item->total / $totalPenduduk) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-400">Belum ada data.</p>
            @endif
        </div>

        {{-- Agama --}}
        <div class="p-5">
            <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Agama</h6>
            @if($agamaStat->isNotEmpty())
                @foreach($agamaStat as $item)
                    <div class="mb-3">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-300">{{ $item->nama }}</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $item->total }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                            <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $totalPenduduk > 0 ? ($item->total / $totalPenduduk) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-400">Belum ada data.</p>
            @endif
        </div>

        {{-- Status Perkawinan + Usia --}}
        <div class="p-5 space-y-5">
            <div>
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Status Perkawinan</h6>
                @if($statusNikahStat->isNotEmpty())
                    @foreach($statusNikahStat as $item)
                        <div class="mb-3">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-300">{{ $item->nama }}</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $item->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                <div class="bg-amber-400 h-1.5 rounded-full" style="width: {{ $totalPenduduk > 0 ? ($item->total / $totalPenduduk) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-gray-400">Belum ada data.</p>
                @endif
            </div>

            <div>
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Kelompok Usia</h6>
                @if(array_sum($usiaStat) > 0)
                    @foreach($usiaStat as $usia => $jumlah)
                        <div class="flex justify-between items-center py-1.5 border-b border-gray-100 dark:border-gray-700 last:border-0">
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $usia }}</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($jumlah) }}</span>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-gray-400">Belum ada data.</p>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- ============================================================
    INFORMASI KELURAHAN + STATISTIK LINGKUNGAN
============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Info Kelurahan --}}
    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700">
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-base font-bold text-gray-900 dark:text-white">Informasi Kelurahan Bongki</h5>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-3 gap-3 mb-5">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl dark:bg-gray-700">
                    <div class="w-9 h-9 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-sm shrink-0"><i class="fa-solid fa-map-location-dot"></i></div>
                    <div>
                        <p class="text-xs text-gray-400">Lingkungan</p>
                        <p class="text-lg font-extrabold text-gray-900 dark:text-white">4</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl dark:bg-gray-700">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm shrink-0"><i class="fa-solid fa-road"></i></div>
                    <div>
                        <p class="text-xs text-gray-400">RT</p>
                        <p class="text-lg font-extrabold text-gray-900 dark:text-white">28</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl dark:bg-gray-700">
                    <div class="w-9 h-9 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center text-sm shrink-0"><i class="fa-solid fa-sitemap"></i></div>
                    <div>
                        <p class="text-xs text-gray-400">RW</p>
                        <p class="text-lg font-extrabold text-gray-900 dark:text-white">10</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-gray-500">Kelurahan</span><span class="font-semibold text-gray-900 dark:text-white">Bongki</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-gray-500">Provinsi</span><span class="font-semibold text-gray-900 dark:text-white">Sulawesi Selatan</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-gray-500">Kecamatan</span><span class="font-semibold text-gray-900 dark:text-white">Sinjai Utara</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-gray-500">Kabupaten</span><span class="font-semibold text-gray-900 dark:text-white">Sinjai</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik Lingkungan --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700">
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-base font-bold text-gray-900 dark:text-white">Statistik Lingkungan</h5>
        </div>
        <div class="p-5">
            @forelse($lingkungan as $item)
                @php $persen = $totalPenduduk > 0 ? ($item->penduduk_count / $totalPenduduk) * 100 : 0; @endphp
                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-1.5">
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $item->nama }}</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ number_format($item->penduduk_count) }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $persen }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-center text-gray-400 py-8">Belum ada data lingkungan.</p>
            @endforelse
        </div>
    </div>

</div>

{{-- ============================================================
    PENDUDUK TERBARU — Flowbite Table
============================================================ --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-xs dark:bg-gray-800 dark:border-gray-700 mb-6">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <h5 class="text-base font-bold text-gray-900 dark:text-white">Penduduk Terbaru</h5>
        <a href="{{ route('admin.penduduk.index') }}" class="text-xs font-semibold text-green-700 bg-green-50 border border-green-200 hover:bg-green-100 transition-colors px-3 py-1.5 rounded-lg dark:bg-green-900 dark:text-green-300 dark:border-green-700">
            Lihat Semua
        </a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
            <thead class="text-xs font-semibold text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-5 py-3">NIK</th>
                    <th scope="col" class="px-5 py-3">Nama</th>
                    <th scope="col" class="px-5 py-3">Lingkungan</th>
                    <th scope="col" class="px-5 py-3">Status Perkawinan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($pendudukTerbaru as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-5 py-3 font-mono text-xs text-gray-500 dark:text-gray-400">{{ $item->nik }}</td>
                        <td class="px-5 py-3">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $item->nama_lengkap }}</p>
                            <p class="text-xs text-gray-400">@gender($item->jenis_kelamin) &bull; {{ $item->tanggal_lahir?->translatedFormat('d M Y') ?? '-' }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-600 dark:text-gray-400">{{ optional($item->lingkungan)->nama ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                {{ $item->status_perkawinan ?? 'N/A' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-sm text-gray-400">Belum ada data penduduk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@php
    $bulanIndonesia = [
        'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
        'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
        'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
        'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember',
    ];
    $bulan = $bulanIndonesia[date('F')];
@endphp

<script>
let pelayananChart;

document.addEventListener('DOMContentLoaded', function () {

    // ===========================
    // CHART PELAYANAN
    // ===========================
    const pelayanan = @json($chartPelayanan);
    const pelayananEl = document.getElementById('chartPelayanan');

    if (pelayananEl && pelayanan) {
        pelayananChart = new ApexCharts(pelayananEl, {
            series: [{ name: 'Jumlah', data: pelayanan.data }],
            chart: { type: 'bar', height: 300, toolbar: { show: false }, fontFamily: 'Plus Jakarta Sans, sans-serif' },
            plotOptions: { bar: { borderRadius: 6, distributed: true, columnWidth: '50%' } },
            colors: ['#16a34a', '#059669', '#d97706', '#dc2626'],
            dataLabels: { enabled: false },
            xaxis: { categories: pelayanan.labels, axisBorder: { show: false }, axisTicks: { show: false } },
            yaxis: { labels: { formatter: val => Math.round(val) } },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            legend: { show: false }
        });
        pelayananChart.render();
    }

    // ===========================
    // CHART KOMPOSISI PENDUDUK
    // ===========================
    const chartJK = @json($chartJK);
    const pendudukEl = document.getElementById('chartPenduduk');

    if (pendudukEl && chartJK) {
        new ApexCharts(pendudukEl, {
            series: chartJK.data,
            chart: { type: 'donut', height: 230, fontFamily: 'Plus Jakarta Sans, sans-serif' },
            labels: chartJK.labels,
            colors: ['#16a34a', '#ec4899'],
            plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', fontSize: '12px' } } } } },
            legend: { position: 'bottom', markers: { radius: 8 } },
            dataLabels: { enabled: false }
        }).render();
    }

});

async function downloadChart() {
    if (!pelayananChart) { alert('Grafik belum tersedia'); return; }
    try {
        const { imgURI } = await pelayananChart.dataURI();
        const link = document.createElement('a');
        link.download = 'Laporan-Pelayanan-{{ $bulan }}-{{ date("Y") }}.png';
        link.href = imgURI;
        link.click();
    } catch (e) { alert('Gagal mengunduh grafik'); }
}
</script>

@endsection
