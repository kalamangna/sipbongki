@extends('surat.layouts.surat')

@section('content')





{{-- =====================================================
JUDUL LAPORAN
===================================================== --}}

<div class="judul-surat">

    <h3>
        <strong>
            LAPORAN DATA PENDUDUK
        </strong>
    </h3>

</div>

<br>





{{-- =====================================================
TABEL DATA PENDUDUK
===================================================== --}}


<table style="width:100%;border-collapse:collapse;">


<thead>

<tr>

<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
No.
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
NIK
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Nama Lengkap
</th>


<th style="text-align:center; vertical-align:middle; border:1px solid #000; padding:6px;">
Jenis Kelamin
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


@foreach($penduduks as $penduduk)

<tr>


<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $loop->iteration }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $penduduk->nik }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $penduduk->nama_lengkap }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ optional($penduduk->lingkungan)->nama ?? '-' }}

</td>



<td style="border:1px solid #000;padding:6px;text-align:center;">

{{ $penduduk->alamat }}

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