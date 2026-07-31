@extends('surat.layouts.surat')

@section('content')


@php
    $judul = 'SURAT KETERANGAN KURANG MAMPU';
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
    <td><strong>{{ strtoupper($permohonan->penduduk->nama_lengkap) }}</strong></td>
    </tr>

    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $permohonan->penduduk->nik }}</td>
    </tr>

    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>:</td>
        <td>
            {{ $permohonan->penduduk->tempat_lahir }},
            {{ \Carbon\Carbon::parse($permohonan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
        </td>
    </tr>

    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>
    {{ $permohonan->penduduk->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
</td>
    </tr>

    <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{ $permohonan->penduduk->agama }}</td>
    </tr>

    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ $permohonan->penduduk->pekerjaan }}</td>
    </tr>

    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>
            {{ $permohonan->penduduk->alamat }}
        </td>
    </tr>
    <tr>
    <td>Lingkungan</td>
    <td>:</td>
    <td>{{ $permohonan->penduduk->lingkungan?->nama ?? '-' }}</td>
</tr>
</table>

<p style="margin-left:2px; text-align:justify;">
    Yang tersebut namanya di atas adalah benar penduduk yang berdomisili di
    <strong>{{ $permohonan->penduduk->lingkungan?->nama ?? '-' }}</strong>,
    Kelurahan Bongki, Kecamatan Sinjai Utara, Kabupaten Sinjai dan yang bersangkutan
    benar merupakan warga yang termasuk dalam kategori keluarga
    <strong>Kurang Mampu</strong>.
</p>

<p style="margin-top:15px; margin-left:2px; text-align:justify;">
    Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan untuk
    dipergunakan sebagaimana mestinya.
</p>

@include('surat.partials.tanda-tangan')

@endsection