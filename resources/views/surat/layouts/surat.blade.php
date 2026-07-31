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

    <a href="{{ request()->routeIs('admin.*') ? route('admin.permohonan-surat.index') : route('operator.permohonan-surat.index') }}"
       class="btn-kembali">
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