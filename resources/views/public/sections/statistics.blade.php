<section id="statistik" class="py-24 bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">Statistik Kelurahan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4">Data Penduduk & Wilayah</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            {{-- Jenis Pekerjaan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Jenis Pekerjaan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartPekerjaan"></div>
                </div>
            </div>

            {{-- Agama --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Agama</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartAgama"></div>
                </div>
            </div>

            {{-- Status Perkawinan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Status Perkawinan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartStatusNikah"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            {{-- Kelompok Usia --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Kelompok Usia</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartUsia"></div>
                </div>
            </div>

            {{-- Pendidikan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Pendidikan</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartPendidikan"></div>
                </div>
            </div>

            {{-- Wajib Pilih --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Wajib Pilih (>=17 Tahun)</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartWajibPilih"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- RT / RW --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">RT & RW</h3>
                <div class="flex-1 relative min-h-[280px]">
                    <div id="chartRTRW"></div>
                </div>
            </div>

            {{-- Lingkungan --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-slate-200/80 dark:border-slate-800 pb-3">Persebaran Penduduk Lingkungan</h3>
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
    const rtRw = @json($statistikRtRw->all() ?? []);
    const wajibPilih = [
        ['Wajib Pilih (≥17 th)', Object.values(usiaObj).slice(1).reduce((sum, value) => sum + value, 0)],
        ['Belum Wajib (<17 th)', usiaObj['0-17'] ?? 0]
    ];

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

        // ==================== WAJIB PILIH ====================
        createOrUpdateDoughnut('chartWajibPilih', wajibPilih.map(i => i[0]), wajibPilih.map(i => i[1]), ['#059669', '#f59e0b']);

        // ==================== LINGKUNGAN ====================
        if (lingkungan.length) {
            createOrUpdateBar('chartLingkungan', lingkungan.map(i => i[0]), lingkungan.map(i => i[1]), vibrantPalette, true);
        }

        // ==================== RT / RW ====================
        if (rtRw.length) {
            const ctx = document.getElementById('chartRTRW');
            if (ctx) {
                const rtrwOptions = {
                    series: [
                        { name: 'RT', data: rtRw.map(item => item.rt) },
                        { name: 'RW', data: rtRw.map(item => item.rw) }
                    ],
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
                        y: { formatter: val => val !== undefined ? `${val.toLocaleString('id-ID')} Unit` : '' }
                    },
                    plotOptions: { 
                        bar: { 
                            horizontal: false, 
                            borderRadius: 6, 
                            columnWidth: '50%' 
                        } 
                    },
                    colors: ['#059669', '#0284c7'],
                    dataLabels: { enabled: false },
                    xaxis: { categories: rtRw.map(item => item.nama), labels: { style: { fontSize: '11px', colors: textColor } } },
                    yaxis: { labels: { style: { fontSize: '11px', colors: headingColor } } },
                    legend: { 
                        position: 'top', 
                        fontSize: '12px',
                        labels: { colors: textColor },
                        markers: { radius: 12, offsetX: -2 },
                        itemMargin: { horizontal: 8, vertical: 4 }
                    },
                    grid: { strokeDashArray: 4, borderColor: gridColor }
                };

                if (chartInstances['chartRTRW']) {
                    chartInstances['chartRTRW'].destroy();
                }
                chartInstances['chartRTRW'] = new ApexCharts(ctx, rtrwOptions);
                chartInstances['chartRTRW'].render();
            }
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