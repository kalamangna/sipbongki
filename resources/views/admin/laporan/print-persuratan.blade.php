@extends('surat.layouts.surat')

@section('content')

@php
    $tanggalAwal = trim((string) request('tanggal_awal'));
    $tanggalAkhir = trim((string) request('tanggal_akhir'));
    $subJudul = 'Rekapitulasi Pelayanan Persuratan &bull; Kelurahan Bongki';

    $formatTanggal = function ($value) {
        if (empty($value)) {
            return '-';
        }
        try {
            return \Carbon\Carbon::parse($value)->translatedFormat('d F Y');
        } catch (\Throwable $e) {
            return (string) $value;
        }
    };

    if ($tanggalAwal && $tanggalAkhir) {
        $subJudul = 'Periode ' . $formatTanggal($tanggalAwal) . ' s.d. ' . $formatTanggal($tanggalAkhir);
    } elseif ($tanggalAwal) {
        $subJudul = 'Sejak ' . $formatTanggal($tanggalAwal);
    } elseif ($tanggalAkhir) {
        $subJudul = 'Hingga ' . $formatTanggal($tanggalAkhir);
    }
@endphp

{{-- =====================================================
     JUDUL LAPORAN
===================================================== --}}
<div class="judul-surat">
    <h3><strong>LAPORAN DATA PERSURATAN</strong></h3>
    <p style="margin:4px 0 0; font-size:11pt;">
        {!! $subJudul !!}
    </p>
</div>

<br>

{{-- =====================================================
     TABEL DATA PERSURATAN
===================================================== --}}
<table style="width:100%; border-collapse:collapse; font-size:10pt;">
    <thead style="font-weight:bold; text-transform:uppercase;">
        <tr>
            <th style="width:4%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 3px; font-weight:bold;">NO</th>
            <th style="width:18%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">NOMOR PERMOHONAN</th>
            <th style="width:18%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">NOMOR SURAT</th>
            <th style="width:22%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 6px; font-weight:bold;">NAMA PEMOHON</th>
            <th style="width:18%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">JENIS SURAT</th>
            <th style="width:11%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 3px; font-weight:bold;">TANGGAL</th>
            <th style="width:9%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 3px; font-weight:bold;">STATUS</th>
        </tr>
    </thead>
    <tbody>
        @forelse($permohonans as $permohonan)
            @php
                $tanggalPermohonan = '-';
                if (!empty($permohonan->tanggal_permohonan)) {
                    try {
                        $tanggalPermohonan = \Carbon\Carbon::parse($permohonan->tanggal_permohonan)->translatedFormat('d/m/Y');
                    } catch (\Throwable $e) {
                        $tanggalPermohonan = '-';
                    }
                }
            @endphp
            <tr>
                <td style="border:1px solid #000; padding:5px 3px; text-align:center; vertical-align:top;">{{ $loop->iteration }}</td>
                <td style="border:1px solid #000; padding:5px 4px; text-align:center; vertical-align:top; font-family:'Courier New', monospace; font-size:9.5pt;">{{ $permohonan->nomor_permohonan ?? '-' }}</td>
                <td style="border:1px solid #000; padding:5px 4px; text-align:center; vertical-align:top; font-family:'Courier New', monospace; font-size:9.5pt;">{{ $permohonan->nomor_surat ?? '-' }}</td>
                <td style="border:1px solid #000; padding:5px 6px; vertical-align:top;">{{ optional($permohonan->penduduk)->nama_lengkap ?? data_get($permohonan->data_surat, 'nama_lengkap') ?? '-' }}</td>
                <td style="border:1px solid #000; padding:5px 4px; vertical-align:top;">{{ optional($permohonan->jenisSurat)->nama ?? '-' }}</td>
                <td style="border:1px solid #000; padding:5px 3px; text-align:center; vertical-align:top;">{{ $tanggalPermohonan }}</td>
                <td style="border:1px solid #000; padding:5px 3px; text-align:center; vertical-align:top;">{{ $permohonan->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="border:1px solid #000; padding:12px; text-align:center; font-style:italic; color:#555;">Tidak ada data permohonan surat yang ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- =====================================================
     TANDA TANGAN
===================================================== --}}
<table style="width:100%; border:none; border-collapse:collapse; margin-top:24px;">
    <tr>
        {{-- KIRI --}}
        <td style="width:50%; text-align:left; vertical-align:top; border:none; padding:0 10px 0 18px;">
            Mengetahui :<br>
            <strong>Plt. Lurah Bongki,</strong>
            <br><br><br><br>
            <strong style="text-decoration: underline;">ASHARI, S.Sos.,MM.</strong><br>
            <span style="white-space: nowrap; display: inline-block;">NIP. 19760822 200804 1 001</span>
        </td>

        {{-- KANAN --}}
        <td style="width:50%; text-align:left; vertical-align:top; border:none; padding:0 10px 0 100px;">
            <p style="margin:0;">Bongki, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <strong>Kasi Pelayanan Umum,</strong>
            <br><br><br><br>
            <strong style="text-decoration: underline;">MUHAMMAD RUSMIN, S.IP</strong><br>
            <span style="white-space: nowrap; display: inline-block;">NIP. 19790506 200801 1 023</span>
        </td>
    </tr>
</table>

@endsection
