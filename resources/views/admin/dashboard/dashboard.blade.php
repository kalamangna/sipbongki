@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle','Ringkasan Data & Aktivitas Sistem')

@section('content')

{{-- ============================================================
 HERO SECTION
============================================================ --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
            Selamat Datang, {{ auth()->user()->name }}
            <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-50 text-primary-700 capitalize border border-primary-100">
                {{ auth()->user()->role }}
            </span>
        </h2>
        <p class="text-sm text-slate-500 mt-1">Berikut adalah ringkasan data kelurahan per tanggal <span class="font-medium text-slate-700">{{ now()->translatedFormat('d F Y') }}</span></p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        @if(in_array(auth()->user()->role, ['admin', 'operator']))
        <a href="{{ route('admin.penduduk.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-700 border border-slate-200 shadow-sm hover:bg-slate-50 hover:text-primary-600 transition-all">
            <i class="fa-solid fa-user-plus text-slate-400"></i> Data Penduduk
        </a>
        @endif
        <a href="{{ route('admin.permohonan-surat.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white shadow-md shadow-primary-500/20 hover:bg-primary-700 hover:shadow-primary-500/30 transition-all hover:-translate-y-0.5">
            <i class="fa-solid fa-file-signature"></i> Layanan Surat
        </a>
    </div>
</div>

{{-- ============================================================
 STATISTIC CARDS
============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    {{-- Total Penduduk --}}
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Total Penduduk</p>
                <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalPenduduk) }}</p>
            </div>
        </div>
    </div>

    {{-- Kartu Keluarga --}}
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-address-card"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Kartu Keluarga</p>
                <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalKK) }}</p>
            </div>
        </div>
    </div>

    {{-- Aparat Kelurahan --}}
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Aparat Desa</p>
                <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalPerangkat) }}</p>
            </div>
        </div>
    </div>

    {{-- Permohonan Surat --}}
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Permohonan</p>
                <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalPermohonan) }}</p>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
 MAIN CONTENT GRID
============================================================ --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    
    {{-- Chart Pelayanan --}}
    <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h5 class="text-base font-bold text-slate-900">Statistik Pelayanan</h5>
            <button onclick="downloadChart()" type="button" class="group flex items-center gap-2 px-3 py-1.5 text-xs font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-primary-600 transition-all">
                <i class="fa-solid fa-download text-slate-400 group-hover:text-primary-500 transition-colors"></i> Export
            </button>
        </div>
        <div class="p-6 flex-1">
            <div id="chartPelayanan"></div>
        </div>
    </div>

    {{-- Aktivitas & Akses Cepat --}}
    <div class="flex flex-col gap-6">
        
        {{-- Quick Access --}}
        <div class="bg-white rounded-3xl p-6 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
            <h5 class="text-sm font-bold text-slate-900 mb-4">Akses Cepat</h5>
            <div class="grid grid-cols-2 gap-3">
                @if(in_array(auth()->user()->role, ['admin', 'operator']))
                <a href="{{ route('admin.penduduk.index') }}" class="group flex flex-col items-center justify-center gap-2 p-4 rounded-2xl bg-slate-50 hover:bg-primary-50 border border-transparent hover:border-primary-100 transition-all">
                    <div class="w-10 h-10 rounded-full bg-white text-primary-600 shadow-sm flex items-center justify-center text-lg group-hover:scale-110 transition-transform"><i class="fa-solid fa-users"></i></div>
                    <span class="text-xs font-semibold text-slate-700 group-hover:text-primary-700">Penduduk</span>
                </a>
                @endif
                <a href="{{ route('admin.permohonan-surat.index') }}" class="group flex flex-col items-center justify-center gap-2 p-4 rounded-2xl bg-slate-50 hover:bg-amber-50 border border-transparent hover:border-amber-100 transition-all">
                    <div class="w-10 h-10 rounded-full bg-white text-amber-600 shadow-sm flex items-center justify-center text-lg group-hover:scale-110 transition-transform"><i class="fa-solid fa-envelope-open-text"></i></div>
                    <span class="text-xs font-semibold text-slate-700 group-hover:text-amber-700">Surat</span>
                </a>
                @if(in_array(auth()->user()->role, ['admin', 'pimpinan']))
                <a href="{{ route('admin.laporan.index') }}" class="group flex flex-col items-center justify-center gap-2 p-4 rounded-2xl bg-slate-50 hover:bg-sky-50 border border-transparent hover:border-sky-100 transition-all">
                    <div class="w-10 h-10 rounded-full bg-white text-sky-600 shadow-sm flex items-center justify-center text-lg group-hover:scale-110 transition-transform"><i class="fa-solid fa-print"></i></div>
                    <span class="text-xs font-semibold text-slate-700 group-hover:text-sky-700">Laporan</span>
                </a>
                @endif
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.website.berita.index') }}" class="group flex flex-col items-center justify-center gap-2 p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50 border border-transparent hover:border-emerald-100 transition-all">
                    <div class="w-10 h-10 rounded-full bg-white text-emerald-600 shadow-sm flex items-center justify-center text-lg group-hover:scale-110 transition-transform"><i class="fa-solid fa-newspaper"></i></div>
                    <span class="text-xs font-semibold text-slate-700 group-hover:text-emerald-700">Berita</span>
                </a>
                @endif
            </div>
        </div>

        {{-- Demographics Chart --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex-1 flex flex-col">
            <div class="px-6 py-5 border-b border-slate-100">
                <h5 class="text-sm font-bold text-slate-900">Komposisi Penduduk</h5>
            </div>
            <div class="p-6 flex-1 flex items-center justify-center">
                <div id="chartPenduduk" class="w-full" style="min-height:230px;"></div>
            </div>
        </div>

    </div>
</div>

{{-- ============================================================
 TABEL PERMOHONAN & DATA LAIN
============================================================ --}}
<div class="grid grid-cols-1 xl:grid-cols-4 gap-6 mb-8">
    
    {{-- Tabel Permohonan --}}
    <div class="xl:col-span-3 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h5 class="text-base font-bold text-slate-900">Permohonan Terbaru</h5>
            <a href="{{ route('admin.permohonan-surat.index') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition-colors flex items-center gap-1 group">
                Lihat Semua <i class="fa-solid fa-arrow-right-long text-[10px] group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 border-b border-slate-100">Pemohon</th>
                        <th class="px-6 py-4 border-b border-slate-100">Jenis Surat</th>
                        <th class="px-6 py-4 border-b border-slate-100">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($permohonanTerbaru as $item)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">{{ optional($item->penduduk)->nama_lengkap ?? '-' }}</td>
                        <td class="px-6 py-4">{{ optional($item->jenisSurat)->nama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($item->status == 'Menunggu')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 tracking-wide">{{ $item->status }}</span>
                            @elseif($item->status == 'Diproses')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 tracking-wide">{{ $item->status }}</span>
                            @elseif($item->status == 'Selesai')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">{{ $item->status }}</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">{{ $item->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-6 py-8 text-center text-sm text-slate-400">Belum ada data permohonan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Statistik Lingkungan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h5 class="text-sm font-bold text-slate-900">Distribusi Penduduk</h5>
        </div>
        <div class="p-6">
            @forelse($lingkungan as $item)
                @php $persen = $totalPenduduk > 0 ? ($item->penduduk_count / $totalPenduduk) * 100 : 0; @endphp
                <div class="mb-5 last:mb-0">
                    <div class="flex justify-between text-xs font-semibold mb-2">
                        <span class="text-slate-700">{{ $item->nama }}</span>
                        <span class="text-slate-900">{{ number_format($item->penduduk_count) }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-primary-500 h-1.5 rounded-full" style="width: {{ $persen }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-center text-slate-400 py-4">Belum ada data.</p>
            @endforelse
        </div>
    </div>

</div>


{{-- ============================================================
 DEMOGRAFI & STATISTIK TAMBAHAN
============================================================ --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    
    {{-- Pekerjaan --}}
    <div class="bg-white rounded-3xl p-6 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
        <h6 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-5">Pekerjaan</h6>
        @if($pekerjaanStat->isNotEmpty())
            <div class="space-y-4">
            @foreach($pekerjaanStat->take(5) as $item)
                @php $pct = $totalPenduduk > 0 ? ($item->total / $totalPenduduk) * 100 : 0; @endphp
                <div>
                    <div class="flex justify-between text-xs font-semibold mb-1.5">
                        <span class="text-slate-700 truncate pr-2">{{ $item->nama }}</span>
                        <span class="text-slate-900 shrink-0">{{ $item->total }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-sky-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <p class="text-sm text-slate-400">Belum ada data.</p>
        @endif
    </div>

    {{-- Agama --}}
    <div class="bg-white rounded-3xl p-6 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
        <h6 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-5">Agama</h6>
        @if($agamaStat->isNotEmpty())
            <div class="space-y-4">
            @foreach($agamaStat as $item)
                @php $pct = $totalPenduduk > 0 ? ($item->total / $totalPenduduk) * 100 : 0; @endphp
                <div>
                    <div class="flex justify-between text-xs font-semibold mb-1.5">
                        <span class="text-slate-700">{{ $item->nama }}</span>
                        <span class="text-slate-900">{{ $item->total }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <p class="text-sm text-slate-400">Belum ada data.</p>
        @endif
    </div>

    {{-- Status Perkawinan --}}
    <div class="bg-white rounded-3xl p-6 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
        <h6 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-5">Status Perkawinan</h6>
        @if($statusNikahStat->isNotEmpty())
            <div class="space-y-4">
            @foreach($statusNikahStat as $item)
                @php $pct = $totalPenduduk > 0 ? ($item->total / $totalPenduduk) * 100 : 0; @endphp
                <div>
                    <div class="flex justify-between text-xs font-semibold mb-1.5">
                        <span class="text-slate-700">{{ $item->nama }}</span>
                        <span class="text-slate-900">{{ $item->total }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <p class="text-sm text-slate-400">Belum ada data.</p>
        @endif
    </div>

    {{-- Kelompok Usia --}}
    <div class="bg-white rounded-3xl p-6 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
        <h6 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-5">Kelompok Usia</h6>
        @if(array_sum($usiaStat) > 0)
            <div class="flex flex-col gap-3">
            @foreach($usiaStat as $usia => $jumlah)
                <div class="flex justify-between items-center px-3 py-2 bg-slate-50 rounded-xl">
                    <span class="text-xs font-semibold text-slate-600">{{ $usia }}</span>
                    <span class="text-sm font-extrabold text-slate-900">{{ number_format($jumlah) }}</span>
                </div>
            @endforeach
            </div>
        @else
            <p class="text-sm text-slate-400">Belum ada data.</p>
        @endif
    </div>

</div>

{{-- ============================================================
 PENDUDUK TERBARU
============================================================ --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
        <h5 class="text-base font-bold text-slate-900">Penduduk Baru Terdaftar</h5>
        <a href="{{ route('admin.penduduk.index') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition-colors flex items-center gap-1 group">
            Lihat Semua <i class="fa-solid fa-arrow-right-long text-[10px] group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                <tr>
                    <th class="px-6 py-4 border-b border-slate-100">Data Diri</th>
                    <th class="px-6 py-4 border-b border-slate-100">NIK / KK</th>
                    <th class="px-6 py-4 border-b border-slate-100">Alamat</th>
                    <th class="px-6 py-4 border-b border-slate-100">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pendudukTerbaru as $item)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <p class="font-bold text-slate-900">{{ $item->nama_lengkap }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">@gender($item->jenis_kelamin) &bull; {{ $item->tanggal_lahir?->translatedFormat('d M Y') ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-mono text-xs text-slate-600 font-medium">{{ $item->nik }}</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">KK: {{ optional($item->kartuKeluarga)->nomor_kk ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-slate-600">{{ optional($item->lingkungan)->nama ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 tracking-wide">{{ $item->status_perkawinan ?? 'N/A' }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-sm text-slate-400">Belum ada data penduduk.</td></tr>
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
    const fontFam = 'Inter, ui-sans-serif, system-ui, -apple-system, sans-serif';

    // CHART PELAYANAN
    const pelayanan = @json($chartPelayanan);
    const pelayananEl = document.getElementById('chartPelayanan');

    if (pelayananEl && pelayanan) {
        pelayananChart = new ApexCharts(pelayananEl, {
            series: [{ name: 'Jumlah', data: pelayanan.data }],
            chart: { type: 'bar', height: 320, toolbar: { show: false }, fontFamily: fontFam },
            plotOptions: { bar: { borderRadius: 6, columnWidth: '40%', colors: { ranges: [{ from: 0, to: 100000, color: '#0ea5e9' }] } } },
            dataLabels: { enabled: false },
            xaxis: { 
                categories: pelayanan.labels, 
                axisBorder: { show: false }, 
                axisTicks: { show: false },
                labels: { style: { colors: '#64748b', fontWeight: 500 } }
            },
            yaxis: { labels: { formatter: val => Math.round(val), style: { colors: '#64748b', fontWeight: 500 } } },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4, padding: { top: 0, right: 0, bottom: 0, left: 10 } },
            legend: { show: false }
        });
        pelayananChart.render();
    }

    // CHART KOMPOSISI PENDUDUK
    const chartJK = @json($chartJK);
    const pendudukEl = document.getElementById('chartPenduduk');

    if (pendudukEl && chartJK) {
        new ApexCharts(pendudukEl, {
            series: chartJK.data,
            chart: { type: 'donut', height: 260, fontFamily: fontFam },
            labels: chartJK.labels,
            colors: ['#0ea5e9', '#ec4899'],
            plotOptions: { pie: { donut: { size: '75%', labels: { show: true, name: { color: '#64748b', fontSize: '11px', fontWeight: 600, offsetY: 20 }, value: { color: '#0f172a', fontSize: '24px', fontWeight: 800, offsetY: -10 }, total: { show: true, label: 'TOTAL', fontSize: '11px', fontWeight: 700, color: '#94a3b8' } } } } },
            legend: { show: false },
            dataLabels: { enabled: false },
            stroke: { show: false }
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
