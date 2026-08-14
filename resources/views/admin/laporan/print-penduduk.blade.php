@extends('surat.layouts.surat')

@section('content')

@php
    $lingkunganId = request('lingkungan');
    $lingkunganNama = null;
    if ($lingkunganId) {
        $lingkunganNama = optional(\App\Models\Lingkungan::find($lingkunganId))->nama;
    }
    $statusFilter = request('status');
@endphp

{{-- =====================================================
     JUDUL LAPORAN
===================================================== --}}
<div class="judul-surat">
    <h3><strong>LAPORAN DATA PENDUDUK</strong></h3>
    <p style="margin:4px 0 0; font-size:11pt;">
        @if($lingkunganNama)
            Lingkungan {{ $lingkunganNama }} &bull; Kelurahan Bongki
        @else
            Kelurahan Bongki, Kecamatan Sinjai Utara
        @endif
        @if($statusFilter === '1')
            (Status: Aktif)
        @elseif($statusFilter === '0')
            (Status: Tidak Aktif)
        @endif
    </p>
</div>

<br>

{{-- =====================================================
     TABEL DATA PENDUDUK
===================================================== --}}
<table style="width:100%; border-collapse:collapse; font-size:10.5pt;">
    <thead style="font-weight:bold; text-transform:uppercase;">
        <tr>
            <th style="width:5%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">NO</th>
            <th style="width:18%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">NIK</th>
            <th style="width:25%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 6px; font-weight:bold;">NAMA LENGKAP</th>
            <th style="width:12%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">JENIS KELAMIN</th>
            <th style="width:18%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 4px; font-weight:bold;">LINGKUNGAN</th>
            <th style="width:22%; text-align:center; vertical-align:middle; border:1px solid #000; padding:6px 6px; font-weight:bold;">ALAMAT</th>
        </tr>
    </thead>
    <tbody>
        @forelse($penduduks as $penduduk)
            <tr>
                <td style="border:1px solid #000; padding:5px 4px; text-align:center; vertical-align:top;">{{ $loop->iteration }}</td>
                <td style="border:1px solid #000; padding:5px 4px; text-align:center; vertical-align:top; font-family:'Courier New', monospace; font-size:10pt;">{{ $penduduk->nik }}</td>
                <td style="border:1px solid #000; padding:5px 6px; vertical-align:top;">{{ $penduduk->nama_lengkap }}</td>
                <td style="border:1px solid #000; padding:5px 4px; text-align:center; vertical-align:top;">{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td style="border:1px solid #000; padding:5px 4px; text-align:center; vertical-align:top;">{{ optional($penduduk->lingkungan)->nama ?? '-' }}</td>
                <td style="border:1px solid #000; padding:5px 6px; vertical-align:top;">{{ $penduduk->alamat ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="border:1px solid #000; padding:12px; text-align:center; font-style:italic; color:#555;">Tidak ada data penduduk yang ditemukan.</td>
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
            <strong>Kasi Pemerintahan,</strong>
            <br><br><br><br>
            <strong style="text-decoration: underline;">FIRMAN, S.E</strong><br>
            <span style="white-space: nowrap; display: inline-block;">NIP. 19800313 200901 1 007</span>
        </td>
    </tr>
</table>

@endsection