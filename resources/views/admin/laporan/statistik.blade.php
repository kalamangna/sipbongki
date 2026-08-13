@extends('layouts.admin')

@section('title', 'Laporan Statistik')

@section('content')

<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Laporan Statistik Kelurahan</h2>
            <p class="text-sm text-slate-500 mt-1">Berbasis data statistik yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    {{-- First Row Charts --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
        {{-- Pekerjaan --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Jenis Pekerjaan</h3>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div style="height:260px; width:100%;">
                    <div id="chartPekerjaan"></div>
                </div>
            </div>
        </div>

        {{-- Agama --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-hands-praying"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Agama</h3>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div style="height:260px; width:100%;">
                    <div id="chartAgama"></div>
                </div>
            </div>
        </div>

        {{-- Status Perkawinan --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i class="fa-solid fa-ring"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Status Perkawinan</h3>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div style="height:260px; width:100%;">
                    <div id="chartStatusNikah"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Second Row Charts --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        {{-- Kelompok Usia --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                    <i class="fa-solid fa-cake-candles"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Kelompok Usia</h3>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div style="height:260px; width:100%;">
                    <div id="chartUsia"></div>
                </div>
            </div>
        </div>

        {{-- Pendidikan --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Pendidikan</h3>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div style="height:260px; width:100%;">
                    <div id="chartPendidikan"></div>
                </div>
            </div>
        </div>

        {{-- Lingkungan --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Statistik per Lingkungan</h3>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-100 text-primary-700">Lingkungan</span>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div style="height:260px; width:100%;">
                    <div id="chartLingkungan"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    if (!window.ApexCharts) return;

    const pekerjaan = @json($pekerjaanStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const agama = @json($agamaStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const statusNikah = @json($statusNikahStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const usiaObj = @json($usiaStat ?? []);
    const pendidikan = @json($pendidikanStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const lingkungan = @json($statistikLingkungan->map(fn($i)=>[$i->nama,$i->penduduk_count])->all() ?? []);

    const createDoughnut = (ctx, labels, data, colors, opts = {}) => {
        const options = {
            series: data,
            chart: { type: 'donut', height: 280 },
            labels: labels,
            colors: colors,
            plotOptions: { pie: { donut: { size: '65%' } } },
            legend: { position: 'bottom', markers: { radius: 12 } },
            ...opts
        };
        new ApexCharts(ctx, options).render();
    };

    const createBar = (ctx, labels, data, color) => {
        const options = {
            series: [{ name: 'Jumlah', data: data }],
            chart: { type: 'bar', height: 280, toolbar: { show: false } },
            plotOptions: { bar: { horizontal: true, borderRadius: 4, barHeight: '60%' } },
            colors: [color],
            dataLabels: { enabled: false },
            xaxis: { categories: labels, labels: { style: { cssClass: 'text-xs font-sans text-slate-500' } } },
            yaxis: { labels: { style: { cssClass: 'text-xs font-sans text-slate-600 font-medium' } } },
            grid: { strokeDashArray: 4, borderColor: '#f1f5f9' }
        };
        new ApexCharts(ctx, options).render();
    };

    // PEKERJAAN
    if (document.getElementById('chartPekerjaan') && pekerjaan.length) {
        createBar(
            document.getElementById('chartPekerjaan'),
            pekerjaan.map(i => i[0]),
            pekerjaan.map(i => i[1]),
            '#F59E0B'
        );
    }

    // AGAMA
    if (document.getElementById('chartAgama') && agama.length) {
        createDoughnut(
            document.getElementById('chartAgama'),
            agama.map(i => i[0]),
            agama.map(i => i[1]),
            ['#2563EB','#10B981','#F59B0B','#EF4444','#8B5CF6','#A855F7']
        );
    }

    // STATUS NIKAH
    if (document.getElementById('chartStatusNikah')) {
        if (statusNikah.length) {
            createDoughnut(
                document.getElementById('chartStatusNikah'),
                statusNikah.map(i => i[0]),
                statusNikah.map(i => i[1]),
                ['#2563EB','#10B981','#F59B0B','#8B5CF6']
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

    // USIA
    if (document.getElementById('chartUsia') && Object.keys(usiaObj).length) {
        const usiaOptions = {
            series: [{ name: 'Jumlah', data: Object.values(usiaObj) }],
            chart: { type: 'bar', height: 280, toolbar: { show: false } },
            plotOptions: { bar: { horizontal: false, borderRadius: 4, columnWidth: '40%' } },
            colors: ['#F43F5E'],
            dataLabels: { enabled: false },
            xaxis: { categories: Object.keys(usiaObj), labels: { style: { cssClass: 'text-xs font-sans text-slate-500' } } },
            yaxis: { labels: { style: { cssClass: 'text-xs font-sans text-slate-500' } } },
            grid: { strokeDashArray: 4, borderColor: '#f1f5f9' }
        };
        new ApexCharts(document.getElementById('chartUsia'), usiaOptions).render();
    }

    // PENDIDIKAN
    if (document.getElementById('chartPendidikan')) {
        if (pendidikan.length) {
            createBar(
                document.getElementById('chartPendidikan'),
                pendidikan.map(i => i[0]),
                pendidikan.map(i => i[1]),
                '#8B5CF6'
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

    // LINGKUNGAN
    if (document.getElementById('chartLingkungan') && lingkungan.length) {
        createBar(
            document.getElementById('chartLingkungan'),
            lingkungan.map(i => i[0]),
            lingkungan.map(i => i[1]),
            '#2563EB'
        );
    }
});
</script>
@endpush
