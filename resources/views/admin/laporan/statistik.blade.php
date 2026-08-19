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
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm transition-all active:scale-95 focus:outline-none cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
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

    const chartInstances = {};

    function renderAllCharts() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#94a3b8' : '#64748b';
        const headingColor = isDark ? '#cbd5e1' : '#334155';
        const gridColor = isDark ? '#334155' : '#e2e8f0';
        const strokeColor = isDark ? '#0f172a' : '#ffffff';
        const themeMode = isDark ? 'dark' : 'light';

        const createOrUpdateDoughnut = (id, labels, data, colors, opts = {}) => {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            if (!data || data.length === 0 || data.every(v => v === 0)) {
                ctx.innerHTML = '<div class="flex items-center justify-center h-56 text-slate-400 text-sm italic">Belum ada data</div>';
                return;
            }

            const options = {
                series: data,
                chart: { 
                    type: 'donut', 
                    height: 280, 
                    fontFamily: 'Inter, sans-serif', 
                    background: 'transparent',
                    foreColor: textColor
                },
                theme: { mode: themeMode },
                tooltip: { 
                    theme: themeMode,
                    y: { formatter: val => val !== undefined ? `${val.toLocaleString('id-ID')} Jiwa` : '' }
                },
                labels: labels,
                colors: colors,
                dataLabels: { enabled: false },
                plotOptions: { 
                    pie: { 
                        donut: { 
                            size: '68%',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '11px',
                                    fontWeight: 600,
                                    color: textColor,
                                    offsetY: 20
                                },
                                value: {
                                    show: true,
                                    fontSize: '22px',
                                    fontWeight: 800,
                                    color: isDark ? '#f8fafc' : '#0f172a',
                                    offsetY: -10
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '12px',
                                    fontWeight: 700,
                                    color: isDark ? '#cbd5e1' : '#475569',
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
                    labels: { colors: textColor },
                    markers: { radius: 12, offsetX: -2 },
                    itemMargin: { horizontal: 6, vertical: 3 }
                },
                stroke: { width: 2, colors: [strokeColor] },
                ...opts
            };

            if (chartInstances[id]) {
                chartInstances[id].destroy();
            }
            chartInstances[id] = new ApexCharts(ctx, options);
            chartInstances[id].render();
        };

        const createOrUpdateBar = (id, labels, data, colors, isHorizontal = true) => {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            if (!data || data.length === 0 || data.every(v => v === 0)) {
                ctx.innerHTML = '<div class="flex items-center justify-center h-56 text-slate-400 text-sm italic">Belum ada data</div>';
                return;
            }

            const isMultiColor = Array.isArray(colors);
            const options = {
                series: [{ name: 'Jumlah', data: data }],
                chart: { 
                    type: 'bar', 
                    height: 280, 
                    toolbar: { show: false }, 
                    fontFamily: 'Inter, sans-serif', 
                    background: 'transparent',
                    foreColor: textColor
                },
                theme: { mode: themeMode },
                tooltip: { 
                    theme: themeMode,
                    y: { formatter: val => val !== undefined ? `${val.toLocaleString('id-ID')} Jiwa` : '' }
                },
                plotOptions: { 
                    bar: { 
                        horizontal: isHorizontal, 
                        borderRadius: 6, 
                        barHeight: isHorizontal ? '65%' : undefined,
                        columnWidth: !isHorizontal ? '55%' : undefined,
                        distributed: isMultiColor
                    } 
                },
                colors: isMultiColor ? colors : [colors],
                dataLabels: { enabled: false },
                xaxis: { categories: labels, labels: { style: { fontSize: '11px', colors: textColor } } },
                yaxis: { labels: { style: { fontSize: '11px', colors: headingColor } } },
                legend: { show: false },
                grid: { strokeDashArray: 4, borderColor: gridColor }
            };

            if (chartInstances[id]) {
                chartInstances[id].destroy();
            }
            chartInstances[id] = new ApexCharts(ctx, options);
            chartInstances[id].render();
        };

        // ==================== PEKERJAAN ====================
        if (pekerjaan.length) {
            createOrUpdateBar('chartPekerjaan', pekerjaan.map(i => i[0]), pekerjaan.map(i => i[1]), vibrantPalette, true);
        }

        // ==================== AGAMA ====================
        if (agama.length) {
            createOrUpdateDoughnut('chartAgama', agama.map(i => i[0]), agama.map(i => i[1]), ['#059669', '#0284c7', '#d97706', '#7c3aed', '#e11d48', '#0d9488']);
        }

        // ==================== STATUS PERKAWINAN ====================
        if (statusNikah.length) {
            createOrUpdateDoughnut('chartStatusNikah', statusNikah.map(i => i[0]), statusNikah.map(i => i[1]), ['#059669', '#0284c7', '#d97706', '#7c3aed']);
        } else {
            createOrUpdateDoughnut('chartStatusNikah', ['Data tidak tersedia'], [1], ['#CBD5E1'], { legend: { show: false }, tooltip: { enabled: false } });
        }

        // ==================== KELOMPOK USIA ====================
        if (Object.keys(usiaObj).length) {
            createOrUpdateBar('chartUsia', Object.keys(usiaObj), Object.values(usiaObj), ['#0284c7', '#059669', '#d97706', '#7c3aed', '#ea580c'], false);
        }

        // ==================== PENDIDIKAN ====================
        if (pendidikan.length) {
            createOrUpdateBar('chartPendidikan', pendidikan.map(i => i[0]), pendidikan.map(i => i[1]), vibrantPalette, true);
        } else {
            createOrUpdateDoughnut('chartPendidikan', ['Data tidak tersedia'], [1], ['#CBD5E1'], { legend: { show: false }, tooltip: { enabled: false } });
        }

        // ==================== LINGKUNGAN ====================
        if (lingkungan.length) {
            createOrUpdateBar('chartLingkungan', lingkungan.map(i => i[0]), lingkungan.map(i => i[1]), vibrantPalette, true);
        }
    }

    renderAllCharts();

    // Reaktif saat tema di-toggle di navbar
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.attributeName === 'class') {
                renderAllCharts();
            }
        });
    });
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
});
</script>
@endpush
