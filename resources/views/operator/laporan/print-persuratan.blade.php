@extends('surat.layouts.surat')

@section('content')

@php
    $tanggalAwal = trim((string) request('tanggal_awal'));
    $tanggalAkhir = trim((string) request('tanggal_akhir'));
    $subJudul = 'Rekapitulasi seluruh pelayanan persuratan Kelurahan Bongki';

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

<div class="judul-surat">
    <h3>
        <strong>
            LAPORAN DATA PERSURATAN
        </strong>
    </h3>
    <p style="margin:8px 0 0; font-size:12px;">
        {{ $subJudul }}
    </p>
</div>

<br>

<table style="width:100%;border-collapse:collapse;">
    <thead>
        <tr>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">No.</th>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">Nomor Permohonan</th>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">Nomor Surat</th>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">Nama Pemohon</th>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">Jenis Surat</th>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">Tanggal Permohonan</th>
            <th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permohonans as $permohonan)
            <tr>
                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ $loop->iteration }}</td>
                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ $permohonan->nomor_permohonan ?? '-' }}</td>
                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ $permohonan->nomor_surat ?? '-' }}</td>
                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ optional($permohonan->penduduk)->nama_lengkap ?? '-' }}</td>
                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ optional($permohonan->jenisSurat)->nama ?? '-' }}</td>
                <td style="border:1px solid #000;padding:6px;text-align:center;">
                    @php
                        $tanggalPermohonan = '-';
                        if (!empty($permohonan->tanggal_permohonan)) {
                            try {
                                $tanggalPermohonan = \Carbon\Carbon::parse($permohonan->tanggal_permohonan)->translatedFormat('d F Y');
                            } catch (\Throwable $e) {
                                $tanggalPermohonan = '-';
                            }
                        }
                    @endphp
                    {{ $tanggalPermohonan }}
                </td>
                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ $permohonan->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table style="width:100%; border-collapse:collapse;">
    <tr>
        <br>
        <td style="width:50%; text-align:left; padding-left:18px; vertical-align:top;">
            Mengetahui :
            <br>
            <strong>Plt. Lurah Bongki,</strong>
            <br><br><br>
            <strong style="text-decoration: underline;">ASHARI, S.Sos.,MM.</strong>
            <br>
            NIP. 19760822 200804 1 001
        </td>
        <td style="width:50%; text-align:left; padding-left:100px; vertical-align:top;">
            <p style="margin:0;">Bongki, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <strong>Kasi Pelayanan Umum,</strong>
            <br><br><br>
            <strong style="text-decoration: underline;">MUHAMMAD RUSMIN, S.IP</strong>
            <br>
            NIP. 19790506 200801 1 023
        </td>
    </tr>
</table>

@endsection
