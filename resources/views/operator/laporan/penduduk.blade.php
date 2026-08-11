@extends('layouts.operator')

@section('title', 'Laporan Penduduk')

@section('content')

<div class="container-fluid pt-4">


{{-- ==========================================================
    HEADER
========================================================== --}}

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

    <div>

        
        <p class="text-muted mb-0">
            Statistik dan rekapitulasi data penduduk Kelurahan Bongki.
        </p>

    </div>


    <div class="d-flex gap-2 mt-3 mt-lg-0">


        {{-- EXPORT EXCEL --}}
        <a
            href="{{ route('operator.laporan.export-penduduk') }}"
            class="btn btn-success btn-sm">

            <i class="bi bi-file-earmark-excel me-1"></i>

            Export Excel

        </a>



        {{-- PREVIEW LAPORAN --}}
        <a
            href="{{ route('operator.laporan.print-penduduk', array_merge(request()->query(), ['from' => 'penduduk'])) }}"
            class="btn btn-danger btn-sm">

            <i class="bi bi-printer me-1"></i>

            Cetak

        </a>



        {{-- REFRESH --}}
        <a href="{{ route('operator.laporan.penduduk') }}"
   class="btn btn-light border shadow-sm btn-sm">

    <i class="bi bi-arrow-clockwise me-1"></i>

    Refresh

</a>


    </div>



</div>


{{-- ==========================================================
    STATISTIK
========================================================== --}}

<div class="row g-4 mb-4">


    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Total Penduduk
                        </small>

                        <h2 class="fw-bold mt-2">

                            {{ number_format($statistik['total']) }}

                        </h2>

                    </div>

                    <div
                        class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:60px;height:60px;">

                        <i class="bi bi-people-fill fs-3 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>




    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Laki-laki
                        </small>

                        <h2 class="fw-bold text-primary mt-2">

                            {{ number_format($statistik['laki_laki']) }}

                        </h2>

                    </div>

                    <div
                        class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:60px;height:60px;">

                        <i class="bi bi-gender-male fs-3 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Perempuan
                        </small>

                        <h2 class="fw-bold text-danger mt-2">

                            {{ number_format($statistik['perempuan']) }}

                        </h2>

                    </div>

                    <div
                        class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:60px;height:60px;">

                        <i class="bi bi-gender-female fs-3 text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



</div>





{{-- ==========================================================
    FILTER DATA
========================================================== --}}


<div class="card border-0 shadow-sm mb-4">


<div class="card-header bg-white">

<h6 class="fw-bold mb-0 fs-5 d-flex align-items-center gap-2">

    <i class="bi bi-funnel-fill text-primary"></i>

    Filter Data Penduduk

</h6>


</div>



<div class="card-body">


<form method="GET"
      action="{{ route('operator.laporan.penduduk') }}">


<div class="row g-3">



<div class="col-lg-4">

<label class="form-label">

Nama / NIK

</label>


<input
type="text"
name="keyword"
class="form-control"
placeholder="Cari Nama atau NIK..."
value="{{ request('keyword') }}">


</div>




<div class="col-lg-3">

<label class="form-label">

Lingkungan

</label>


<select
name="lingkungan"
class="form-select">


<option value="">

Semua Lingkungan

</option>



@foreach($lingkungans as $lingkungan)


<option value="{{ $lingkungan->id }}"
@selected(request('lingkungan')==$lingkungan->id)>


{{ $lingkungan->nama }}


</option>


@endforeach


</select>


</div>




<div class="col-lg-2">


<label class="form-label">
    Jenis Kelamin
</label>

<select name="jk" class="form-select">

    <option value="">
        Semua
    </option>

    <option value="L"
        @selected(request('jk')=='L')>
        Laki-laki
    </option>

    <option value="P"
        @selected(request('jk')=='P')>
        Perempuan
    </option>

</select>


</div>





<div class="col-lg-3">


<label class="form-label">

Agama

</label>


<select
name="agama"
class="form-select">


<option value="">

Semua Agama

</option>



@foreach($agamaList as $agama)


<option value="{{ $agama }}"
@selected(request('agama')==$agama)>


{{ $agama }}


</option>


@endforeach


</select>


</div>



</div>




<div class="mt-4 d-flex gap-2">


<button type="submit"
class="btn btn-primary">


<i class="bi bi-search"></i>

Tampilkan


</button>



<a href="{{ route('operator.laporan.penduduk') }}"
class="btn btn-outline-secondary">


<i class="bi bi-arrow-clockwise"></i>

Reset


</a>


</div>



</form>


</div>


</div>




{{-- ==========================================================
    REKAP LINGKUNGAN
========================================================== --}}


<div class="card border-0 shadow-sm mb-4">


<div class="card-header bg-white">

<h6 class="fw-bold mb-0 fs-5 d-flex align-items-center gap-2">

    <i class="bi bi-geo-alt-fill text-primary"></i>

    Rekap Penduduk per Lingkungan

</h6>

</div>



<div class="card-body">


<div class="row g-3">


@foreach($rekapLingkungan as $item)


<div class="col-lg-3 col-md-6">


<div class="border rounded-3 p-3 h-100">


<div class="small text-muted">

    {{ $item->nama }}

</div>


<h2 class="fw-bold text-primary mt-2">

    {{ number_format($item->penduduk_count) }}

</h2>


<small class="text-muted">

    Penduduk

</small>


</div>


</div>


@endforeach


</div>


</div>


</div>






{{-- ==========================================================
    ANALISIS DATA
========================================================== --}}


<div class="row g-4 mb-4">



<div class="col-lg-4">

<div class="card border-0 shadow-sm h-100">


<div class="card-header bg-white justify-content-center text-center">

<h6 class="fw-bold mb-0 w-100">

    <span class="d-inline-flex align-items-center justify-content-center gap-2 w-100">

        <i class="bi bi-bookmarks-fill text-primary"></i>

        Berdasarkan Agama

    </span>

</h6>

</div>



<div class="card-body">


@forelse($rekapAgama as $item)


<div class="d-flex justify-content-between mb-2">


<span>

{{ $item->agama ?: '-' }}

</span>


<strong>

{{ $item->total }}

</strong>


</div>


@empty


<p class="text-muted">

Tidak ada data.

</p>


@endforelse


</div>


</div>


</div>






<div class="col-lg-4">

<div class="card border-0 shadow-sm h-100">


<div class="card-header bg-white justify-content-center text-center">

<h6 class="fw-bold mb-0 w-100">

    <span class="d-inline-flex align-items-center justify-content-center gap-2 w-100">

        <i class="bi bi-mortarboard-fill text-primary"></i>

        Berdasarkan Pendidikan

    </span>

</h6>

</div>



<div class="card-body">


@forelse($rekapPendidikan as $item)


<div class="d-flex justify-content-between mb-2">


<span>

{{ $item->pendidikan ?: '-' }}

</span>


<strong>

{{ $item->total }}

</strong>


</div>


@empty


<p class="text-muted">

Tidak ada data.

</p>


@endforelse


</div>


</div>


</div>






<div class="col-lg-4">

<div class="card border-0 shadow-sm h-100">


<div class="card-header bg-white justify-content-center text-center">

<h6 class="fw-bold mb-0 w-100">

    <span class="d-inline-flex align-items-center justify-content-center gap-2 w-100">

        <i class="bi bi-briefcase-fill text-primary"></i>

        Berdasarkan Pekerjaan

    </span>

</h6>

</div>



<div class="card-body">


@forelse($rekapPekerjaan as $item)


<div class="d-flex justify-content-between mb-2">


<span>

{{ $item->pekerjaan ?: '-' }}

</span>


<strong>

{{ $item->total }}

</strong>


</div>


@empty


<p class="text-muted">

Tidak ada data.

</p>


@endforelse


</div>


</div>


</div>



</div>







{{-- ==========================================================
    TABEL DATA PENDUDUK
========================================================== --}}



<div class="card border-0 shadow-sm">


<div class="card-header bg-white d-flex justify-content-start align-items-center gap-3">


<h6 class="fw-bold mb-0 fs-5 d-flex align-items-center gap-2">

    <i class="bi bi-people-fill text-primary"></i>

    Data Penduduk

</h6>



<span class="badge bg-primary">

{{ $penduduks->total() }} Data

</span>


</div>





<div class="card-body p-0">


<div class="table-responsive">


<table class="table table-hover align-middle mb-0 table-soft-border">


<thead class="table-light">


<tr>

<th width="60">No</th>

<th>NIK</th>

<th>Nama Lengkap</th>

<th>JK</th>

<th>KK</th>

<th>Lingkungan</th>

<th>Alamat</th>


</tr>


</thead>




<tbody>


@forelse($penduduks as $penduduk)



<tr>


<td>

{{ $loop->iteration + (($penduduks->currentPage()-1)*$penduduks->perPage()) }}

</td>



<td>

{{ $penduduk->nik }}

</td>



<td>

<strong>

{{ $penduduk->nama_lengkap }}

</strong>

</td>




<td>


@if($penduduk->jenis_kelamin=='L')


<span class="badge bg-primary">

L

</span>


@else


<span class="badge bg-danger">

P

</span>


@endif


</td>



<td>

{{ optional($penduduk->kartuKeluarga)->no_kk ?? '-' }}

</td>



<td>

{{ optional($penduduk->lingkungan)->nama ?? '-' }}

</td>



<td>

{{ $penduduk->alamat }}

</td>



</tr>



@empty


<tr>

<td colspan="7"
class="text-center py-5 text-muted">


Belum ada data penduduk.


</td>

</tr>


@endforelse



</tbody>


</table>


</div>


</div>





<div class="card-footer bg-white">


{{ $penduduks->withQueryString()->links() }}


</div>


</div>



</div>


@endsection