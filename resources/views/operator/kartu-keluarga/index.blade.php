@extends('layouts.operator')

@section('title','Data Kartu Keluarga')

@section('subtitle','Pengelolaan data kartu keluarga masyarakat Kelurahan Bongki')


@section('content')

<div class="dashboard-container">


<div class="card dashboard-card">


<div class="card-header d-flex justify-content-start align-items-center gap-3">


<div>




<small class="text-muted">

Daftar kartu keluarga Kelurahan Bongki

</small>

</div>



<a href="{{ route('operator.kartu-keluarga.create') }}"
   class="btn btn-primary">

<i class="fa-solid fa-plus me-2"></i>

Tambah KK

</a>


</div>




<div class="table-responsive">


<table class="table table-hover align-middle mb-0">


<thead>

<tr>

<th width="5%">No</th>

<th>No KK</th>

<th>Kepala Keluarga</th>

<th>Lingkungan</th>

<th>Anggota</th>

<th>Status</th>

<th width="15%">Aksi</th>

</tr>

</thead>



<tbody>


@forelse($kartuKeluarga as $kk)


<tr>


<td>

{{ $loop->iteration }}

</td>



<td>

<strong>

{{ $kk->no_kk }}

</strong>

</td>



<td>

{{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}

</td>



<td>

{{ optional($kk->lingkungan)->nama ?? '-' }}

</td>



<td>

<span class="badge bg-info">

{{ $kk->anggota()->count() }} Orang

</span>

</td>



<td>


@if($kk->aktif)

<span class="badge bg-success">

Aktif

</span>

@else

<span class="badge bg-danger">

Tidak Aktif

</span>

@endif


</td>



<td class="text-center">

    <div class="action-buttons">

        <a href="{{ route('operator.kartu-keluarga.show',$kk->id) }}"
           class="btn btn-sm btn-info text-white">

            <i class="fa-solid fa-eye"></i>

        </a>

        <a href="{{ route('operator.kartu-keluarga.edit',$kk->id) }}"
           class="btn btn-sm btn-warning">

            <i class="fa-solid fa-pen"></i>

        </a>

    </div>

</td>


</tr>



@empty


<tr>

<td colspan="7"
class="text-center py-4">


Belum ada data kartu keluarga.


</td>

</tr>


@endforelse


</tbody>


</table>


</div>



<div class="card-footer">


{{ $kartuKeluarga->links() }}


</div>



</div>


</div>


@endsection