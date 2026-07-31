@extends('surat.layouts.surat')

@section('content')


{{-- =====================================================
JUDUL LAPORAN
===================================================== --}}

<div class="judul-surat">

    <h5>
        <strong style="text-transform: capitalize;">
    Rekapitulasi Data Layanan Persuratan Seksi Pelayanan Umum 
    <p>
    Bulan Juli Tahun 2026
</strong>
</h5>

</div>

<br>



{{-- =====================================================
TABEL DATA PERSURATAN
===================================================== --}}

<table style="width:100%;border-collapse:collapse;">


<thead>

<tr>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
No.
</th>

<th style="
    width:15%;
    text-align:center;
    vertical-align:middle;
    border:1px solid #000;
    padding:20px;
    white-space:nowrap;
">
    Nomor Surat
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Nama Pemohon
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Jenis Surat
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Tanggal Permohonan
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Status
</th>


</tr>

</thead>




<tbody>


@foreach($permohonans as $permohonan)


<tr>


<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $loop->iteration }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $permohonan->nomor_surat ?? '-' }}

</td>




<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ optional($permohonan->penduduk)->nama_lengkap ?? '-' }}

</td>




<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ optional($permohonan->jenisSurat)->nama ?? '-' }}

</td>




<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ \Carbon\Carbon::parse($permohonan->tanggal_permohonan)->translatedFormat('d F Y') }}

</td>




<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $permohonan->status }}

</td>



</tr>


@endforeach


</tbody>


</table>






{{-- =====================================================
TANDA TANGAN
===================================================== --}}


<table style="width:100%; border-collapse:collapse;">

<tr>

<br>



{{-- KIRI --}}

<td style="width:50%; text-align:left; padding-left:18px; vertical-align:top;">


Mengetahui :


<br>


<strong>
Plt. Lurah Bongki,
</strong>


<br><br><br>


<strong style="text-decoration: underline;">
ASHARI, S.Sos.,MM.
</strong>


<br>


NIP. 19760822 200804 1 001


</td>





{{-- KANAN --}}

<td style="width:50%; text-align:left; padding-left:100px; vertical-align:top;">


<p style="margin:0;">

Bongki, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

</p>



<strong>
Kasi Pelayanan Umum,
</strong>



<br><br><br>



<strong style="text-decoration: underline;">
MUHAMMAD RUSMIN, S.IP
</strong>



<br>


NIP. 19790506 200801 1 023



</td>


</tr>


</table>



@endsection