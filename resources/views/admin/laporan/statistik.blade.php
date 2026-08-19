@extends('layouts.admin')

@section('title', 'Laporan Statistik Kelurahan')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan Statistik Kelurahan</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400">Visualisasi data demografi dan statistik kependudukan Kelurahan Bongki</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.laporan.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

{{-- STATISTIK UTAMA --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Total Penduduk</p>
        <p class="text-3xl font-extrabold text-slate-900 dark:text-slate-100">{{ number_format($totalPenduduk ?? 0) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Laki-laki</p>
        <p class="text-3xl font-extrabold text-sky-600 dark:text-sky-400">{{ number_format($totalLaki ?? 0) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Perempuan</p>
        <p class="text-3xl font-extrabold text-rose-500 dark:text-rose-400">{{ number_format($totalPerempuan ?? 0) }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-sm text-center dark:bg-slate-900 dark:ring-slate-800">
        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Kartu Keluarga</p>
        <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ number_format($totalKK ?? 0) }}</p>
    </div>
</div>

{{-- BARIS GRAFIK 1 --}}
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
    {{-- Jenis Pekerjaan --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Jenis Pekerjaan</h3>
        <div class="flex-1 relative min-h-[280px]">
            <div id="chartPekerjaan"></div>
        </div>
    </div>

    {{-- Agama --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Agama</h3>
        <div class="flex-1 relative min-h-[280px]">
            <div id="chartAgama"></div>
        </div>
    </div>

    {{-- Status Perkawinan --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Status Perkawinan</h3>
        <div class="flex-1 relative min-h-[280px]">
            <div id="chartStatusNikah"></div>
        </div>
    </div>
</div>

{{-- BARIS GRAFIK 2 --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    {{-- Kelompok Usia --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Kelompok Usia</h3>
        <div class="flex-1 relative min-h-[280px]">
            <div id="chartUsia"></div>
        </div>
    </div>

    {{-- Pendidikan --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Pendidikan</h3>
        <div class="flex-1 relative min-h-[280px]">
            <div id="chartPendidikan"></div>
        </div>
    </div>

    {{-- Persebaran Lingkungan --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Persebaran Penduduk Lingkungan</h3>
        <div class="flex-1 relative min-h-[280px]">
            <div id="chartLingkungan"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    if (!window.ApexCharts) return;

    const vibrantPalette = ['#059669', '#0284c7', '#d97706', '#7c3aed', '#e11d48', '#0d9488', '#ea580c', '#4f46e5'];

    const pekerjaan = @json($pekerjaanStat->map(fn($i)=>[$i->nama ?: 'Lainnya', (int)$i->total])->all() ?? []);
    const agama = @json($agamaStat->map(fn($i)=>[$i->nama ?: 'Lainnya', (int)$i->total])->all() ?? []);
    const statusNikah = @json($statusNikahStat->map(fn($i)=>[$i->nama ?: 'Lainnya', (int)$i->total])->all() ?? []);
    const usiaObj = @json($usiaStat ?? []);
    const pendidikan = @json($pendidikanStat->map(fn($i)=>[$i->nama ?: 'Lainnya', (int)$i->total])->all() ?? []);
    const lingkungan = @json($statistikLingkungan->map(fn($i)=>[$i->nama, (int)$i->penduduk_count])->all() ?? []);

    const isDarkMode = document.documentElement.classList.contains('dark');
    const labelColor = isDarkMode ? '#94a3b8' : '#475569';
    const gridColor = isDarkMode ? '#334155' : '#e2e8f0';
    const strokeColor = isDarkMode ? '#0f172a' : '#ffffff';

    const createDoughnut = (ctx, labels, data, colors, opts = {}) => {
        if (!ctx) return;
        if (!data || data.length === 0 || data.every(v => v === 0)) {
            ctx.innerHTML = '<div class="flex items-center justify-center h-56 text-slate-400 text-sm italic">Belum ada data</div>';
            return;
        }

        const options = {
            series: data,
            chart: { type: 'donut', height: 280, fontFamily: 'Inter, sans-serif' },
            labels: labels,
            colors: colors,
            dataLabels: { enabled: false },
            plotOptions: { 
                pie: { 
                    donut: { 
                        size: '68%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '12px',
                                fontWeight: 700,
                                color: labelColor,
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString('id-ID');
                                }
                            }
                        }
                    } 
                } 
            },
            legend: { 
                position: 'bottom', 
                fontSize: '11px',
                labels: { colors: labelColor },
                markers: { radius: 12, offsetX: -2 },
                itemMargin: { horizontal: 6, vertical: 3 }
            },
            stroke: { width: 2, colors: [strokeColor] },
            ...opts
        };
        new ApexCharts(ctx, options).render();
    };

    const createBar = (ctx, labels, data, colors) => {
        if (!ctx) return;
        if (!data || data.length === 0 || data.every(v => v === 0)) {
            ctx.innerHTML = '<div class="flex items-center justify-center h-56 text-slate-400 text-sm italic">Belum ada data</div>';
            return;
        }

        const isMultiColor = Array.isArray(colors);
        const options = {
            series: [{ name: 'Jumlah', data: data }],
            chart: { type: 'bar', height: 280, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
            plotOptions: { 
                bar: { 
                    horizontal: true, 
                    borderRadius: 6, 
                    barHeight: '65%',
                    distributed: isMultiColor
                } 
            },
            colors: isMultiColor ? colors : [colors],
            dataLabels: { enabled: false },
            xaxis: { categories: labels, labels: { style: { fontSize: '11px', colors: labelColor } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: labelColor } } },
            legend: { show: false },
            grid: { strokeDashArray: 4, borderColor: gridColor }
        };
        new ApexCharts(ctx, options).render();
    };

    // ==================== PEKERJAAN ====================
    if (document.getElementById('chartPekerjaan') && pekerjaan.length) {
        createBar(
            document.getElementById('chartPekerjaan'),
            pekerjaan.map(i => i[0]),
            pekerjaan.map(i => i[1]),
            vibrantPalette
        );
    }

    // ==================== AGAMA ====================
    if (document.getElementById('chartAgama') && agama.length) {
        createDoughnut(
            document.getElementById('chartAgama'),
            agama.map(i => i[0]),
            agama.map(i => i[1]),
            ['#059669', '#0284c7', '#d97706', '#7c3aed', '#e11d48', '#0d9488']
        );
    }

    // ==================== STATUS PERKAWINAN ====================
    if (document.getElementById('chartStatusNikah')) {
        if (statusNikah.length) {
            createDoughnut(
                document.getElementById('chartStatusNikah'),
                statusNikah.map(i => i[0]),
                statusNikah.map(i => i[1]),
                ['#059669', '#0284c7', '#d97706', '#7c3aed']
            );
        } else {
            createDoughnut(
                document.getElementById('chartStatusNikah'),
                ['Data tidak tersedia'],
                [1],
                ['#CBD5E1'],
                { legend: { show: false }, tooltip: { enabled: false } }
            );
        }
    }

    // ==================== KELOMPOK USIA ====================
    if (document.getElementById('chartUsia') && Object.keys(usiaObj).length) {
        const usiaOptions = {
            series: [{ name: 'Jumlah', data: Object.values(usiaObj) }],
            chart: { type: 'bar', height: 280, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
            plotOptions: { 
                bar: { 
                    horizontal: false, 
                    borderRadius: 6, 
                    columnWidth: '55%',
                    distributed: true
                } 
            },
            colors: ['#0284c7', '#059669', '#d97706', '#7c3aed', '#ea580c'],
            dataLabels: { enabled: false },
            xaxis: { categories: Object.keys(usiaObj), labels: { style: { fontSize: '11px', colors: labelColor } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: labelColor } } },
            legend: { show: false },
            grid: { strokeDashArray: 4, borderColor: gridColor }
        };
        new ApexCharts(document.getElementById('chartUsia'), usiaOptions).render();
    }

    // ==================== PENDIDIKAN ====================
    if (document.getElementById('chartPendidikan')) {
        if (pendidikan.length) {
            createBar(
                document.getElementById('chartPendidikan'),
                pendidikan.map(i => i[0]),
                pendidikan.map(i => i[1]),
                vibrantPalette
            );
        } else {
            createDoughnut(
                document.getElementById('chartPendidikan'),
                ['Data tidak tersedia'],
                [1],
                ['#CBD5E1'],
                { legend: { show: false }, tooltip: { enabled: false } }
            );
        }
    }

    // ==================== LINGKUNGAN ====================
    if (document.getElementById('chartLingkungan') && lingkungan.length) {
        createBar(
            document.getElementById('chartLingkungan'),
            lingkungan.map(i => i[0]),
            lingkungan.map(i => i[1]),
            vibrantPalette
        );
    }
});
</script>
@endpush
