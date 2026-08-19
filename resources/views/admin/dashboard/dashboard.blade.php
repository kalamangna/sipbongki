@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle','Ringkasan Data & Aktivitas Sistem')

@section('content')

{{-- ============================================================
     HEADER SECTION
============================================================ --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">
            Selamat Datang, {{ auth()->user()->name }}
        </h2>
        <p class="text-xs text-slate-500 mt-1 dark:text-slate-400">
            Per {{ now()->translatedFormat('d F Y') }}
        </p>
    </div>
    <div class="flex flex-wrap items-center gap-2.5">
        @if(in_array(auth()->user()->role, ['admin', 'pimpinan']))
        <a href="{{ route('admin.laporan.statistik') }}" class="group inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white text-slate-700 border border-slate-200 shadow-sm hover:bg-slate-50 hover:text-primary-600 transition-all active:scale-95 dark:bg-slate-900 dark:border-slate-800 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-primary-400">
            <i class="fa-solid fa-chart-pie text-slate-400 group-hover:text-primary-600 dark:text-slate-400 dark:group-hover:text-primary-400 transition-colors"></i> Statistik
        </a>
        @endif
        <a href="{{ route('permohonan.create') }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white shadow-sm hover:bg-primary-700 transition-all active:scale-95">
            <i class="fa-solid fa-plus"></i> Permohonan
        </a>
    </div>
</div>

{{-- ============================================================
     STATISTIC CARDS (KPI)
============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    {{-- Total Penduduk --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Total Penduduk</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalPenduduk) }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0 dark:bg-emerald-950/60 dark:text-emerald-400">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    {{-- Kartu Keluarga --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Kartu Keluarga</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalKK) }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-lg shrink-0 dark:bg-sky-950/60 dark:text-sky-400">
                <i class="fa-solid fa-address-card"></i>
            </div>
        </div>
    </div>

    {{-- Aparatur Kelurahan --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Aparatur</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalPerangkat) }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg shrink-0 dark:bg-amber-950/60 dark:text-amber-400">
                <i class="fa-solid fa-user-tie"></i>
            </div>
        </div>
    </div>

    {{-- Permohonan Surat --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Permohonan Surat</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalPermohonan) }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg shrink-0 dark:bg-rose-950/60 dark:text-rose-400">
                <i class="fa-solid fa-file-signature"></i>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     VISUAL INSIGHTS (CHARTS)
============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    
    {{-- Chart Pelayanan Surat --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Pelayanan Surat</h3>
            <button onclick="downloadChart()" type="button" class="group flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-slate-600 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-100 hover:text-primary-600 transition-all dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-primary-400">
                <i class="fa-solid fa-download text-slate-400 group-hover:text-primary-500 transition-colors"></i> Export
            </button>
        </div>
        <div class="p-5 flex-1 flex flex-col justify-center">
            <div id="chartPelayanan" class="w-full"></div>
        </div>
    </div>

    {{-- Komposisi Penduduk Donut --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Komposisi Penduduk</h3>
            <a href="{{ route('admin.laporan.statistik') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition-colors dark:text-primary-400">
                Detail
            </a>
        </div>
        <div class="p-5 flex-1 flex flex-col justify-center items-center">
            <div id="chartPenduduk" class="w-full flex justify-center"></div>
        </div>
    </div>

</div>

{{-- ============================================================
     OPERASIONAL & DISTRIBUSI WILAYAH
============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Tabel Permohonan Surat Terbaru --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Permohonan Terbaru</h3>
            <a href="{{ route('admin.permohonan-surat.index') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition-colors flex items-center gap-1 group dark:text-primary-400 dark:hover:text-primary-300">
                Lihat Semua <i class="fa-solid fa-arrow-right-long text-[10px] group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="overflow-x-auto flex-1">
            <table class="w-full text-sm text-left text-slate-600 min-w-[480px] dark:text-slate-300">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/70 dark:bg-slate-800/60 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3 border-b border-slate-100 dark:border-slate-800">Pemohon</th>
                        <th class="px-5 py-3 border-b border-slate-100 dark:border-slate-800">Surat</th>
                        <th class="px-5 py-3 border-b border-slate-100 dark:border-slate-800">Status</th>
                        <th class="px-5 py-3 border-b border-slate-100 text-right dark:border-slate-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($permohonanTerbaru as $item)
                    <tr class="hover:bg-slate-50/80 transition-colors dark:hover:bg-slate-800/50">
                        <td class="px-5 py-3">
                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ optional($item->pemohon)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $item->created_at?->diffForHumans() }}</p>
                        </td>
                        <td class="px-5 py-3 text-slate-600 dark:text-slate-300">
                            <span class="font-medium">{{ optional($item->jenisSurat)->nama ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-3">
                            @if($item->status == 'Menunggu')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300">{{ $item->status }}</span>
                            @elseif($item->status == 'Diproses')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700 dark:bg-sky-950/60 dark:text-sky-300">{{ $item->status }}</span>
                            @elseif($item->status == 'Selesai')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">{{ $item->status }}</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.permohonan-surat.show', $item) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-primary-600 hover:text-primary-700 hover:underline dark:text-primary-400">
                                Proses <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-sm text-slate-400">
                            <i class="fa-regular fa-folder-open text-2xl text-slate-300 mb-2 block dark:text-slate-600"></i>
                            Belum ada permohonan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Distribusi Penduduk per Lingkungan --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Distribusi Wilayah</h3>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.lingkungan.index') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition-colors dark:text-primary-400">
                Kelola
            </a>
            @endif
        </div>
        <div class="p-5 flex-1 flex flex-col justify-center space-y-3.5">
            @forelse($lingkungan->take(5) as $item)
                @php $persen = $totalPenduduk > 0 ? ($item->penduduk_count / $totalPenduduk) * 100 : 0; @endphp
                <div>
                    <div class="flex justify-between text-xs font-semibold mb-1">
                        <span class="text-slate-700 dark:text-slate-300">{{ $item->nama }}</span>
                        <span class="text-slate-900 dark:text-slate-100">{{ number_format($item->penduduk_count) }} Jiwa <span class="text-slate-400 font-normal">({{ round($persen, 1) }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden dark:bg-slate-800">
                        <div class="bg-primary-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-center text-slate-400 py-4">Belum ada data.</p>
            @endforelse
        </div>
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

@endsection

@push('scripts')
<script>
let pelayananChart;
let pendudukChart;

document.addEventListener('DOMContentLoaded', function () {
    if (!window.ApexCharts) return;

    const pelayanan = @json($chartPelayanan);
    const pelayananEl = document.getElementById('chartPelayanan');
    const chartJK = @json($chartJK);
    const pendudukEl = document.getElementById('chartPenduduk');

    function renderCharts() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#94a3b8' : '#64748b';
        const headingColor = isDark ? '#cbd5e1' : '#334155';
        const gridColor = isDark ? '#334155' : '#e2e8f0';
        const strokeColor = isDark ? '#0f172a' : '#ffffff';
        const themeMode = isDark ? 'dark' : 'light';

        // CHART PELAYANAN
        if (pelayananEl && pelayanan) {
            const options = {
                series: [{ name: 'Jumlah', data: pelayanan.data }],
                chart: { 
                    type: 'bar', 
                    height: 320, 
                    toolbar: { show: false }, 
                    fontFamily: 'Inter, sans-serif',
                    background: 'transparent',
                    foreColor: textColor
                },
                theme: { mode: themeMode },
                tooltip: { 
                    theme: themeMode,
                    y: { formatter: val => val !== undefined ? `${val.toLocaleString('id-ID')} Permohonan` : '' }
                },
                plotOptions: { 
                    bar: { 
                        horizontal: false,
                        borderRadius: 6, 
                        columnWidth: '45%', 
                        distributed: true 
                    } 
                },
                colors: ['#f59e0b', '#0ea5e9', '#10b981', '#f43f5e'],
                dataLabels: { enabled: false },
                xaxis: { 
                    categories: pelayanan.labels, 
                    axisBorder: { show: false }, 
                    axisTicks: { show: false },
                    labels: { style: { fontSize: '11px', colors: textColor } }
                },
                yaxis: { labels: { formatter: val => Math.round(val), style: { fontSize: '11px', colors: headingColor } } },
                grid: { borderColor: gridColor, strokeDashArray: 4, padding: { top: 0, right: 0, bottom: 0, left: 10 } },
                legend: { show: false }
            };

            if (pelayananChart) {
                pelayananChart.destroy();
            }
            pelayananChart = new ApexCharts(pelayananEl, options);
            pelayananChart.render();
        }

        // CHART KOMPOSISI PENDUDUK
        if (pendudukEl && chartJK) {
            const options = {
                series: chartJK.data,
                chart: { 
                    type: 'donut', 
                    height: 260, 
                    fontFamily: 'Inter, sans-serif',
                    background: 'transparent',
                    foreColor: textColor
                },
                theme: { mode: themeMode },
                tooltip: { 
                    theme: themeMode,
                    y: { formatter: val => val !== undefined ? `${val.toLocaleString('id-ID')} Jiwa` : '' }
                },
                labels: chartJK.labels,
                colors: ['#0ea5e9', '#ec4899'],
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
                                    label: 'TOTAL', 
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
                legend: { show: false },
                dataLabels: { enabled: false },
                stroke: { show: true, width: 2, colors: [strokeColor] }
            };

            if (pendudukChart) {
                pendudukChart.destroy();
            }
            pendudukChart = new ApexCharts(pendudukEl, options);
            pendudukChart.render();
        }
    }

    renderCharts();

    // Reaktif saat tema di-toggle di navbar
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.attributeName === 'class') {
                renderCharts();
            }
        });
    });
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
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
@endpush
