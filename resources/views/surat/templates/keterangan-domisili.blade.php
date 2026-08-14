@extends('surat.layouts.surat')

@section('content')

@php
    $judul = 'SURAT KETERANGAN DOMISILI';
    $data = $permohonan->data_surat;
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
        <td><strong>{{ strtoupper($data['nama_lengkap'] ?? '-') }}</strong></td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $data['nik'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>:</td>
        <td>
            {{ $data['tempat_lahir'] ?? '-' }},
            @if(!empty($data['tanggal_lahir']))
                {{ \Carbon\Carbon::parse($data['tanggal_lahir'])->translatedFormat('d F Y') }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>
            @if(($data['jenis_kelamin'] ?? '') == 'L')
                Laki-laki
            @elseif(($data['jenis_kelamin'] ?? '') == 'P')
                Perempuan
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{ $data['agama'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ $data['pekerjaan'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Telepon</td>
        <td>:</td>
        <td>{{ $data['telepon'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Alamat Domisili</td>
        <td>:</td>
        <td>
            {{ $data['alamat'] ?? '-' }}
            <br>
            RT {{ $data['rt'] ?? '-' }} / RW {{ $data['rw'] ?? '-' }}
        </td>
    </tr>
    <tr>
        <td>Alamat Asal</td>
        <td>:</td>
        <td>{{ $data['alamat_asal'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Lama Tinggal</td>
        <td>:</td>
        <td>{{ $data['lama_tinggal'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Status Tempat Tinggal</td>
        <td>:</td>
        <td>{{ $data['status_tempat_tinggal'] ?? '-' }}</td>
    </tr>
</table>

<p style="margin-top:25px; text-align:justify;">
    Berdasarkan keterangan yang bersangkutan, benar bahwa nama tersebut di atas
    saat ini berdomisili di wilayah Kelurahan Bongki. Surat keterangan ini dibuat untuk
    dipergunakan sebagaimana mestinya.
</p>

@include('surat.partials.tanda-tangan')

@endsection