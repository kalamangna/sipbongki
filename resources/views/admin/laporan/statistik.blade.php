@extends('layouts.admin')

@section('title','Laporan Statistik')

@section('content')

<div class="container-fluid">

    <div class="flex flex-wrap -mx-3 mb-4">
        <div class="col">
            <h4 class="mb-0">Laporan Statistik Kelurahan</h4>
            <p class="text-slate-500">Berbasis data statistik yang tampil di halaman publik.</p>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">

        <div class="w-full px-3 col-lg-6 col-xl-4">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-100">
                <div class="px-6 py-4 border-b border-slate-200"><h5>Jenis Pekerjaan</h5></div>
                <div class="p-6"><div style="height:260px;"><div id="chartPekerjaan"></div></div></div>
            </div>
        </div>

        <div class="w-full px-3 col-lg-6 col-xl-4">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-100">
                <div class="px-6 py-4 border-b border-slate-200"><h5>Agama</h5></div>
                <div class="p-6"><div style="height:260px;"><div id="chartAgama"></div></div></div>
            </div>
        </div>

        <div class="w-full px-3 col-xl-4">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-100">
                <div class="px-6 py-4 border-b border-slate-200"><h5>Status Perkawinan</h5></div>
                <div class="p-6"><div style="height:260px;"><div id="chartStatusNikah"></div></div></div>
            </div>
        </div>

    </div>

    <div class="flex flex-wrap -mx-3 mt-6">

        <div class="w-full px-3 md:w-1/2 col-xl-4">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-100">
                <div class="px-6 py-4 border-b border-slate-200"><h5>Kelompok Usia</h5></div>
                <div class="p-6"><div style="height:260px;"><div id="chartUsia"></div></div></div>
            </div>
        </div>

        <div class="w-full px-3 md:w-1/2 col-xl-4">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-100">
                <div class="px-6 py-4 border-b border-slate-200"><h5>Pendidikan</h5></div>
                <div class="p-6"><div style="height:260px;"><div id="chartPendidikan"></div></div></div>
            </div>
        </div>

        <div class="w-full px-3 col-md-12 col-xl-4">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-100">
                <div class="px-6 py-4 border-b border-slate-200 flex justify-start items-center gap-3">
                    <h5 class="mb-0">Statistik Penduduk per Lingkungan</h5>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">Lingkungan</span>
                </div>
                <div class="p-6"><div style="height:260px;"><div id="chartLingkungan"></div></div></div>
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
            chart: { type: 'donut', height: 300 },
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
            chart: { type: 'bar', height: 350, toolbar: { show: false } },
            plotOptions: { bar: { horizontal: true, borderRadius: 4, barHeight: '70%' } },
            colors: [color],
            dataLabels: { enabled: false },
            xaxis: { categories: labels, labels: { style: { cssClass: 'text-xs' } } },
            grid: { strokeDashArray: 4 }
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
            chart: { type: 'bar', height: 350, toolbar: { show: false } },
            plotOptions: { bar: { horizontal: false, borderRadius: 4, columnWidth: '60%' } },
            colors: ['#2563EB'],
            dataLabels: { enabled: false },
            xaxis: { categories: Object.keys(usiaObj) },
            grid: { strokeDashArray: 4 }
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
                '#7C3AED'
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
