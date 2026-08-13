<section id="statistik" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Statistik Kelurahan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Data Penduduk & Wilayah</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            {{-- Jenis Pekerjaan --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Jenis Pekerjaan</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartPekerjaan"></div>
                </div>
            </div>

            {{-- Agama --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Agama</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartAgama"></div>
                </div>
            </div>

            {{-- Status Perkawinan --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Status Perkawinan</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartStatusNikah"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            {{-- Kelompok Usia --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Kelompok Usia</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartUsia"></div>
                </div>
            </div>

            {{-- Pendidikan --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Pendidikan</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartPendidikan"></div>
                </div>
            </div>

            {{-- Wajib Pilih --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Wajib Pilih (>=17 Tahun)</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartWajibPilih"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- RT / RW --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">RT & RW</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartRTRW"></div>
                </div>
            </div>

            {{-- Lingkungan --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col h-full">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Lingkungan</h3>
                <div class="flex-1 relative" style="height:260px;">
                    <div id="chartLingkungan"></div>
                </div>
            </div>
        </div>

    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function(){
    if (!window.ApexCharts) return;

    const pekerjaan = @json($pekerjaanStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const agama = @json($agamaStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const statusNikah = @json($statusNikahStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const usiaObj = @json($usiaStat ?? []);
    const pendidikan = @json($pendidikanStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const lingkungan = @json($statistikLingkungan->map(fn($i)=>[$i->nama,$i->penduduk_count])->all() ?? []);
    const wajibPilih = [
        ['Sudah 17 Tahun', Object.values(usiaObj).slice(1).reduce((sum, value) => sum + value, 0)],
        ['Belum 17 Tahun', usiaObj['0-17'] ?? 0]
    ];

    const createDoughnut = (ctx, labels, data, colors, opts = {}) => {
        const options = {
            series: data,
            chart: { type: 'donut', height: 300 },
            labels: labels,
            colors: colors,
            dataLabels: { enabled: false },
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

   // ==================== PEKERJAAN ====================
if (document.getElementById('chartPekerjaan') && pekerjaan.length) {
    createBar(
        document.getElementById('chartPekerjaan'),
        pekerjaan.map(i => i[0]),
        pekerjaan.map(i => i[1]),
        '#F59E0B'
    );
}

// ==================== AGAMA ====================
if (document.getElementById('chartAgama') && agama.length) {
    createDoughnut(
        document.getElementById('chartAgama'),
        agama.map(i => i[0]),
        agama.map(i => i[1]),
        ['#2563EB','#10B981','#F59B0B','#EF4444','#8B5CF6','#A855F7']
    );
}

// ==================== STATUS PERKAWINAN ====================
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

// ==================== KELOMPOK USIA ====================//
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

// ==================== PENDIDIKAN ====================
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

// ==================== WAJIB PILIH ====================
if (document.getElementById('chartWajibPilih')) {
    createDoughnut(
        document.getElementById('chartWajibPilih'),
        wajibPilih.map(i => i[0]),
        wajibPilih.map(i => i[1]),
        ['#10B981', '#F59E0B']
    );
}


// ==================== LINGKUNGAN ====================

if (document.getElementById('chartLingkungan') && lingkungan.length) {
    createBar(
        document.getElementById('chartLingkungan'),
        lingkungan.map(i => i[0]),
        lingkungan.map(i => i[1]),
        '#2563EB'
    );
}

// ==================== RT / RW ====================

const rtRw = @json($statistikRtRw->all() ?? []);

if (document.getElementById('chartRTRW') && rtRw.length) {
    const rtrwOptions = {
        series: [
            { name: 'RT', data: rtRw.map(item => item.rt) },
            { name: 'RW', data: rtRw.map(item => item.rw) }
        ],
        chart: { type: 'bar', height: 350, toolbar: { show: false } },
        plotOptions: { bar: { horizontal: false, borderRadius: 4, columnWidth: '50%' } },
        colors: ['#2563EB', '#10B981'],
        dataLabels: { enabled: false },
        xaxis: { categories: rtRw.map(item => item.nama) },
        legend: { position: 'top', markers: { radius: 12 } },
        grid: { strokeDashArray: 4 }
    };
    new ApexCharts(document.getElementById('chartRTRW'), rtrwOptions).render();
}

});
</script>