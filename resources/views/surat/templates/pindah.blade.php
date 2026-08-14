@extends('surat.layouts.surat')

@section('content')

@php
    $judul = 'SURAT KETERANGAN PINDAH';
@endphp

@include('surat.partials.nomor')

@include('surat.partials.identitas-pejabat')

<table class="no-border" style="margin-left:35px; margin-bottom:20px;">
    <tr>
        <td width="200">Nama Kepala Keluarga</td>
        <td width="20">:</td>
        <td>{{ strtoupper($permohonan->pemohon->nama_lengkap) }}</td>
    </tr>
    <tr>
        <td>Nomor Kartu Keluarga</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->no_kk }}</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->nik }}</td>
    </tr>
    <tr>
        <td>Alamat Asal</td>
        <td>:</td>
        <td>{{ $permohonan->pemohon->alamat }}</td>
    </tr>
    <tr>
        <td>Alamat Tujuan</td>
        <td>:</td>
        <td>{{ $permohonan->alamat_tujuan }}</td>
    </tr>
    <tr>
        <td>Kelurahan/Desa Tujuan</td>
        <td>:</td>
        <td>{{ $permohonan->kelurahan_tujuan }}</td>
    </tr>
    <tr>
        <td>Kecamatan Tujuan</td>
        <td>:</td>
        <td>{{ $permohonan->kecamatan_tujuan }}</td>
    </tr>
    <tr>
        <td>Kabupaten/Kota Tujuan</td>
        <td>:</td>
        <td>{{ $permohonan->kabupaten_tujuan }}</td>
    </tr>
    <tr>
        <td>Provinsi Tujuan</td>
        <td>:</td>
        <td>{{ $permohonan->provinsi_tujuan }}</td>
    </tr>
    <tr>
        <td>Alasan Pindah</td>
        <td>:</td>
        <td>{{ $permohonan->alasan_pindah }}</td>
    </tr>
    <tr>
        <td>Jenis Kepindahan</td>
        <td>:</td>
        <td>{{ $permohonan->jenis_kepindahan }}</td>
    </tr>
</table>

<div class="mt-4 mb-2">
    <strong>Anggota Keluarga Yang Ikut Pindah</strong>
</div>

<table border="1" cellpadding="5">
    <thead>
        <tr style="text-align:center; font-weight:bold;">
            <th width="40">No</th>
            <th>Nama</th>
            <th width="170">NIK</th>
            <th width="80">JK</th>
            <th>Status Hubungan</th>
        </tr>
    </thead>
    <tbody>
    @forelse($anggotaPindah as $anggota)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ strtoupper($anggota->nama_lengkap) }}</td>
            <td>{{ $anggota->nik }}</td>
            <td align="center">{{ $anggota->jenis_kelamin }}</td>
            <td>{{ $anggota->status_hubungan_keluarga }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" align="center">
                Tidak ada anggota keluarga.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

<p class="mt-4">
    Surat keterangan ini diberikan kepada yang bersangkutan sebagai salah satu
    persyaratan administrasi perpindahan penduduk dan dapat dipergunakan
    sebagaimana mestinya.
</p>

@include('surat.partials.tanda-tangan')

@endsection