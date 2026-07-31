@extends('surat.layouts.surat')

@section('content')


@php
    $judul = 'SURAT KETERANGAN USAHA';

    $usaha = $permohonan->data_surat ?? [];
@endphp

@include('surat.partials.nomor')

@include('surat.partials.identitas-pejabat')

<p style="margin-top:18px;margin-bottom:16px;">
    Menerangkan dengan sebenarnya bahwa :
</p>

<table class="no-border" style="margin-left:35px;margin-bottom:20px;">

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
            {{ $permohonan->penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
        </td>
    </tr>

    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ $permohonan->penduduk->pekerjaan }}</td>
    </tr>

    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $permohonan->penduduk->alamat }}</td>
    </tr>

</table>

<p style="margin-bottom:12px;">
    Yang bersangkutan benar memiliki usaha sebagai berikut :
</p>

<table class="no-border" style="margin-left:35px;margin-bottom:20px;">

    <tr>
        <td width="180">Nama Usaha</td>
        <td width="20">:</td>
        <td>
            <strong>{{ $usaha['nama_usaha'] ?? '-' }}</strong>
        </td>
    </tr>

    <tr>
        <td>Jenis Usaha</td>
        <td>:</td>
        <td>{{ $usaha['jenis_usaha'] ?? '-' }}</td>
    </tr>

    <tr>
        <td>Alamat Usaha</td>
        <td>:</td>
        <td>{{ $usaha['alamat_usaha'] ?? '-' }}</td>
    </tr>

    <tr>
        <td>Lama Usaha</td>
        <td>:</td>
        <td>{{ $usaha['lama_usaha'] ?? '-' }}</td>
    </tr>

</table>

<p style="text-align:justify;">

    Berdasarkan hasil pengamatan Pemerintah Kelurahan Bongki, usaha tersebut
    benar berada di wilayah Kelurahan Bongki Kecamatan Sinjai Utara
    Kabupaten Sinjai dan sampai saat ini masih aktif menjalankan kegiatan
    usahanya.

</p>

<p style="margin-top:15px;text-align:justify;">

    Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.

</p>

@include('surat.partials.tanda-tangan')

@endsection