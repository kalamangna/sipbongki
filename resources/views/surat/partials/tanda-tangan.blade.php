@php
    $jabatanNama = trim($penandatangan->jabatan->nama ?? '');
    $namaJabatanLower = strtolower($jabatanNama);

    // Deteksi apakah pejabat adalah Plt. / Plh. Lurah
    $isPlt = str_contains($namaJabatanLower, 'plt') && (str_contains($namaJabatanLower, 'lurah') || !str_contains($namaJabatanLower, 'sekretaris'));
    $isPlh = str_contains($namaJabatanLower, 'plh') && (str_contains($namaJabatanLower, 'lurah') || !str_contains($namaJabatanLower, 'sekretaris'));

    // Deteksi apakah pejabat adalah Lurah Definitif (bukan Sekretaris, bukan Kasi, bukan Staf, bukan Plt/Plh)
    $isLurah = ! $isPlt && ! $isPlh &&
               (in_array($namaJabatanLower, ['lurah', 'lurah bongki', 'kepala kelurahan', 'kepala kelurahan bongki']) ||
                (str_contains($namaJabatanLower, 'lurah') &&
                 !str_contains($namaJabatanLower, 'sekretaris') &&
                 !str_contains($namaJabatanLower, 'seklur') &&
                 !str_contains($namaJabatanLower, 'kasi') &&
                 !str_contains($namaJabatanLower, 'seksi') &&
                 !str_contains($namaJabatanLower, 'staf')));

    $nama = $penandatangan->nama_lengkap ?? '';

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
            LURAH BONGKI,
        @elseif($isPlt)
            Plt. LURAH BONGKI,
        @elseif($isPlh)
            Plh. LURAH BONGKI,
        @else
            a.n. LURAH BONGKI<br>
            {{ strtoupper($jabatanNama) }},
        @endif
    </div>

    <div class="nama nama-ttd">
        {{ $namaTampil }}
    </div>

    <div class="nip">
        NIP. {{ $penandatangan->nip ?? '-' }}
    </div>
</div>