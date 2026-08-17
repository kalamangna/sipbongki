<section id="statistik" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Statistik Kelurahan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Data Penduduk & Wilayah</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            {{-- Jenis Pekerjaan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Jenis Pekerjaan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartPekerjaan"></div>
                </div>
            </div>

            {{-- Agama --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Agama</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartAgama"></div>
                </div>
            </div>

            {{-- Status Perkawinan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Status Perkawinan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartStatusNikah"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            {{-- Kelompok Usia --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Kelompok Usia</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartUsia"></div>
                </div>
            </div>

            {{-- Pendidikan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Pendidikan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartPendidikan"></div>
                </div>
            </div>

            {{-- Wajib Pilih --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Wajib Pilih (>=17 Tahun)</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartWajibPilih"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- RT / RW --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">RT & RW</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartRTRW"></div>
                </div>
            </div>

            {{-- Lingkungan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <h3 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200/80 pb-3">Persebaran Penduduk Lingkungan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartLingkungan"></div>
                </div>
            </div>
        </div>

    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function(){
    if (!window.ApexCharts) return;

    const vibrantPalette = ['#059669', '#0284c7', '#d97706', '#7c3aed', '#e11d48', '#0d9488', '#ea580c', '#4f46e5'];

    const pekerjaan = @json($pekerjaanStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const agama = @json($agamaStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const statusNikah = @json($statusNikahStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const usiaObj = @json($usiaStat ?? []);
    const pendidikan = @json($pendidikanStat->map(fn($i)=>[$i->nama,$i->total])->all() ?? []);
    const lingkungan = @json($statistikLingkungan->map(fn($i)=>[$i->nama,$i->penduduk_count])->all() ?? []);
    const wajibPilih = [
        ['Wajib Pilih (≥17 th)', Object.values(usiaObj).slice(1).reduce((sum, value) => sum + value, 0)],
        ['Belum Wajib (<17 th)', usiaObj['0-17'] ?? 0]
    ];

    const createDoughnut = (ctx, labels, data, colors, opts = {}) => {
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
                                color: '#475569',
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
                markers: { radius: 12, offsetX: -2 },
                itemMargin: { horizontal: 6, vertical: 3 }
            },
            stroke: { width: 2, colors: ['#ffffff'] },
            ...opts
        };
        new ApexCharts(ctx, options).render();
    };

    const createBar = (ctx, labels, data, colors) => {
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
            xaxis: { categories: labels, labels: { style: { fontSize: '11px', colors: '#64748b' } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: '#334155' } } },
            legend: { show: false },
            grid: { strokeDashArray: 4, borderColor: '#e2e8f0' }
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
            xaxis: { categories: Object.keys(usiaObj), labels: { style: { fontSize: '11px', colors: '#64748b' } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: '#334155' } } },
            legend: { show: false },
            grid: { strokeDashArray: 4, borderColor: '#e2e8f0' }
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

    // ==================== WAJIB PILIH ====================
    if (document.getElementById('chartWajibPilih')) {
        createDoughnut(
            document.getElementById('chartWajibPilih'),
            wajibPilih.map(i => i[0]),
            wajibPilih.map(i => i[1]),
            ['#059669', '#f59e0b']
        );
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

    // ==================== RT / RW ====================
    const rtRw = @json($statistikRtRw->all() ?? []);

    if (document.getElementById('chartRTRW') && rtRw.length) {
        const rtrwOptions = {
            series: [
                { name: 'RT', data: rtRw.map(item => item.rt) },
                { name: 'RW', data: rtRw.map(item => item.rw) }
            ],
            chart: { type: 'bar', height: 280, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
            plotOptions: { 
                bar: { 
                    horizontal: false, 
                    borderRadius: 6, 
                    columnWidth: '50%' 
                } 
            },
            colors: ['#059669', '#0284c7'],
            dataLabels: { enabled: false },
            xaxis: { categories: rtRw.map(item => item.nama), labels: { style: { fontSize: '11px', colors: '#64748b' } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: '#334155' } } },
            legend: { 
                position: 'top', 
                fontSize: '12px',
                markers: { radius: 12, offsetX: -2 },
                itemMargin: { horizontal: 8, vertical: 4 }
            },
            grid: { strokeDashArray: 4, borderColor: '#e2e8f0' }
        };
        new ApexCharts(document.getElementById('chartRTRW'), rtrwOptions).render();
    }

});
</script>