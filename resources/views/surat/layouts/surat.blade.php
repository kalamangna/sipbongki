<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ $judul ?? 'Surat Keterangan' }}
    </title>

    @vite('resources/css/app.css')

    @include('surat.partials.style')

    @stack('styles')

</head>

<body>


<div class="preview-action">

    @php
        $backUrl = url('/');

        try {
            if (request()->routeIs('admin.laporan.print-kartu-keluarga') || request()->routeIs('operator.laporan.print-kartu-keluarga')) {
                $backUrl = request()->routeIs('admin.*')
                    ? route('admin.laporan.kartu-keluarga')
                    : route('operator.laporan.kartu-keluarga');
            } elseif (request()->routeIs('admin.laporan.print-persuratan') || request()->routeIs('operator.laporan.print-persuratan')) {
                $backUrl = request()->routeIs('admin.*')
                    ? route('admin.laporan.persuratan')
                    : route('operator.laporan.persuratan');
            } elseif (request()->query('from') === 'riwayat') {
                $backUrl = request()->routeIs('admin.*')
                    ? route('admin.riwayat-pelayanan.index')
                    : route('operator.riwayat-pelayanan.index');
            } elseif (request()->query('from') === 'penduduk') {
                $backUrl = request()->routeIs('admin.*')
                    ? route('admin.laporan.penduduk')
                    : route('operator.laporan.penduduk');
            } else {
                $backUrl = request()->routeIs('admin.*')
                    ? route('admin.permohonan-surat.index')
                    : route('operator.permohonan-surat.index');
            }
        } catch (\Throwable $e) {
            $backUrl = url()->previous() ?: url('/');
        }
    @endphp

    <a href="{{ $backUrl }}" class="btn-kembali">
        ← Kembali
    </a>

    <button type="button"
            onclick="window.print()"
            class="btn-cetak">
        🖨 Cetak
    </button>

</div>



<div class="page">

    {{-- KOP SURAT / LAPORAN --}}
    @include('surat.partials.kop')


    @yield('content')

</div>



@stack('scripts')


</body>

</html>