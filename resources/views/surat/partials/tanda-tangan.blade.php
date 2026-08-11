@php
    $namaJabatan = strtolower($penandatangan->jabatan->nama ?? '');

    $isLurah = str_contains($namaJabatan, 'lurah') &&
               !str_contains($namaJabatan, 'plt');

    $isPlt = str_contains($namaJabatan, 'plt');

    $nama = $penandatangan->nama_lengkap;

    if (str_contains($nama, ',')) {
        [$namaOrang, $gelar] = explode(',', $nama, 2);

        $namaTampil = strtoupper(trim($namaOrang)) . ', ' . trim($gelar);
    } else {
        $namaTampil = strtoupper($nama);
    }
@endphp

<div class="ttd">

    <div class="tanggal">
        Bongki, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <div class="jabatan">

        @if($isLurah)
            LURAH BONGKI
        @elseif($isPlt)
            Plt. LURAH BONGKI
        @else
            a.n. LURAH BONGKI
        @endif

    </div>

    <div class="nama nama-ttd">
        {{ $namaTampil }}
    </div>

    <div class="nip">
        NIP. {{ $penandatangan->nip }}
    </div>

</div>