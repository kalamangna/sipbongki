@extends('surat.layouts.surat')

@section('content')

@php

    $judul = 'SURAT KETERANGAN KEMATIAN';

    $kematian = $permohonan->data_surat ?? [];

    $pelapor = $permohonan->pelapor;

@endphp

@include('surat.partials.nomor')

@include('surat.partials.identitas-pejabat')

<p style="margin-top:8px;margin-bottom:8px;">
    Menerangkan dengan sesungguhnya bahwa :
</p>

<table class="no-border" style="margin-left:35px;margin-bottom:8px;">

    <tr>
        <td width="180">Nama</td>
        <td width="20">:</td>
        <td>
            <strong>{{ strtoupper($permohonan->pemohon->nama_lengkap) }}</strong>
        </td>
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
            {{ $permohonan->pemohon->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
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

</table>

<p style="margin-bottom:8px;">
    Telah meninggal dunia pada :
</p>

<table class="no-border" style="margin-left:35px;margin-bottom:8px;">

    <tr>
        <td width="180">Hari</td>
        <td width="20">:</td>
        <td>{{ $kematian['hari_meninggal'] ?? '-' }}</td>
    </tr>

    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>
            @if(!empty($kematian['tanggal_meninggal']))
                {{ \Carbon\Carbon::parse($kematian['tanggal_meninggal'])->translatedFormat('d F Y') }}
            @else
                -
            @endif
        </td>
    </tr>

    <tr>
    <td>Jam</td>
    <td>:</td>
    <td>
        @if(!empty($kematian['jam_meninggal']))
            {{ str_replace(':', '.', $kematian['jam_meninggal']) }} WITA
        @else
            -
        @endif
    </td>
</tr>

    <tr>
        <td>Tempat</td>
        <td>:</td>
        <td>{{ $kematian['tempat_meninggal'] ?? '-' }}</td>
    </tr>

    <tr>
        <td>Penyebab</td>
        <td>:</td>
        <td>{{ $kematian['penyebab_kematian'] ?? '-' }}</td>
    </tr>

</table>

<p style="margin-bottom:8px;">
    Yang melaporkan :
</p>

<table class="no-border" style="margin-left:35px;margin-bottom:8px;">

    <tr>
        <td width="180">Nama</td>
        <td width="20">:</td>
        <td>
            <strong>{{ strtoupper(optional($pelapor)->nama_lengkap ?? '-') }}</strong>
        </td>
    </tr>

    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ optional($pelapor)->nik ?? '-' }}</td>
    </tr>

    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>:</td>
        <td>
            @if($pelapor)
                {{ $pelapor->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pelapor->tanggal_lahir)->translatedFormat('d F Y') }}
            @else
                -
            @endif
        </td>
    </tr>

    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>
            @if($pelapor)
                {{ $pelapor->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
            @else
                -
            @endif
        </td>
    </tr>

    <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{ optional($pelapor)->agama ?? '-' }}</td>
    </tr>

    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ optional($pelapor)->pekerjaan ?? '-' }}</td>
    </tr>

    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ optional($pelapor)->alamat ?? '-' }}</td>
    </tr>

    <tr>
        <td>Hubungan dengan Almarhum</td>
        <td>:</td>
        <td>{{ $kematian['hubungan_pelapor'] ?? '-' }}</td>
    </tr>

</table>

<p style="margin-top:8px;text-align:justify;">

    Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.

</p>

@include('surat.partials.tanda-tangan')

@endsection