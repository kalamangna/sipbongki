@extends('surat.layouts.surat')

@section('content')


{{-- =====================================================
JUDUL LAPORAN
===================================================== --}}

<div class="judul-surat">

    <h3>
        <strong>
            LAPORAN DATA KARTU KELUARGA
        </strong>
    </h3>

</div>

<br>



{{-- =====================================================
TABEL DATA KARTU KELUARGA
===================================================== --}}


<table style="width:100%;border-collapse:collapse;">


<thead>

<tr>

<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
No.
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Nomor KK
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Kepala Keluarga
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Jumlah Anggota
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Lingkungan
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Alamat
</th>


</tr>

</thead>



<tbody>


@foreach($kartuKeluargas as $kk)


<tr>


<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $loop->iteration }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $kk->no_kk }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $kk->anggota_count ?? 0 }}

Orang

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ optional($kk->lingkungan)->nama ?? '-' }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $kk->alamat ?? '-' }}

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

<td style="width:50%; text-align:left; padding-left:120px; vertical-align:top;">


<p style="margin:0;">

Bongki, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

</p>


<strong>
Kasi Pemerintahan,
</strong>


<br><br><br>


<strong style="text-decoration: underline;">
FIRMAN, S.E
</strong>


<br>


NIP. 19800313 200901 1 007


</td>


</tr>


</table>



@endsection