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


<thead class="px-4 py-3 font-medium text-slate-700">

<tr>

<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;" class="px-4 py-3 font-medium text-slate-700">
No.
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;" class="px-4 py-3 font-medium text-slate-700">
Nomor KK
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;" class="px-4 py-3 font-medium text-slate-700">
Kepala Keluarga
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;" class="px-4 py-3 font-medium text-slate-700">
Jumlah Anggota
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;" class="px-4 py-3 font-medium text-slate-700">
Lingkungan
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;" class="px-4 py-3 font-medium text-slate-700">
Alamat
</th>


</tr>

</thead>



<tbody>


@foreach($kartuKeluargas as $kk)


<tr>


<td style="border:1px solid #000;padding:6px;text-align:center;" class="px-4 py-3 border-b border-slate-100">

{{ $loop->iteration }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;" class="px-4 py-3 border-b border-slate-100">

{{ $kk->no_kk }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;" class="px-4 py-3 border-b border-slate-100">

{{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;" class="px-4 py-3 border-b border-slate-100">

{{ $kk->anggota_count ?? 0 }}

Orang

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;" class="px-4 py-3 border-b border-slate-100">

{{ optional($kk->lingkungan)->nama ?? '-' }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;" class="px-4 py-3 border-b border-slate-100">

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

<td style="width:50%; text-align:left; padding-left:18px; vertical-align:top;" class="px-4 py-3 border-b border-slate-100">


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

<td style="width:50%; text-align:left; padding-left:120px; vertical-align:top;" class="px-4 py-3 border-b border-slate-100">


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