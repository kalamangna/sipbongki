@extends('surat.layouts.surat')

@section('content')

@php
    $judul = 'SURAT KETERANGAN ORANG YANG SAMA';
@endphp

@include('surat.partials.nomor')

@include('surat.partials.identitas-pejabat')

<p style="margin-top:18px; margin-bottom:16px; margin-left:0;">
    Menerangkan dengan sesungguhnya bahwa :
</p>

<table class="no-border" style="margin-left:35px; margin-bottom:20px;">
    <tr>
        <td width="180">Nama</td>
        <td width="20">:</td>
        <td><strong>{{ strtoupper($permohonan->pemohon->nama_lengkap) }}</strong></td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->nik }}</td>
    </tr>
    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>:</td>
        <td>
            {{ $permohonan->pemohon->tempat_lahir }},
            {{ \Carbon\Carbon::parse($permohonan->pemohon->tanggal_lahir)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>
            {{ $permohonan->pemohon->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
        </td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->agama }}</td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->pekerjaan }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->alamat }}</td>
    </tr>
    <tr>
        <td>Lingkungan</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->lingkungan?->nama ?? '-' }}</td>
    </tr>
</table>

<p style="margin-left:2px; text-align:justify;">
    Berdasarkan data kependudukan dan dokumen administrasi yang ada,
    bahwa nama tersebut di atas adalah benar merupakan orang yang sama
    dengan identitas yang tercantum pada dokumen berikut:
</p>

<table class="no-border" style="margin-left:35px; margin-top:12px; margin-bottom:20px;">
    <tr>
        <td width="180">Nama Dalam Dokumen</td>
        <td width="20">:</td>
        <td><strong>{{ strtoupper($permohonan->data_surat['nama_lain'] ?? '-') }}</strong></td>
    </tr>
    <tr>
        <td>Jenis Dokumen</td>
        <td>:</td>
        <td>{{ $permohonan->data_surat['jenis_dokumen'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Nomor Dokumen</td>
        <td>:</td>
        <td>{{ $permohonan->data_surat['nomor_dokumen'] ?? '-' }}</td>
    </tr>
</table>

@if(!empty($permohonan->data_surat['keterangan_perbedaan']))
<p style="margin-left:2px; text-align:justify;">
    Perbedaan penulisan identitas tersebut disebabkan karena
    {{ $permohonan->data_surat['keterangan_perbedaan'] }}.
</p>
@endif

<p style="margin-left:2px; text-align:justify;">
    Dengan demikian dapat diterangkan bahwa identitas sebagaimana
    tercantum dalam dokumen tersebut adalah benar milik orang yang sama
    dengan identitas kependudukan yang bersangkutan dan tidak terdapat
    perbedaan subjek hukum.
</p>

<p style="margin-top:15px; margin-left:2px; text-align:justify;">
    Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat
    dipergunakan sebagaimana mestinya.
</p>

@include('surat.partials.tanda-tangan')

@endsection