@extends('layouts.operator')


@section('title','Permohonan Surat')


@section(
    'subtitle',
    'Pelayanan surat masyarakat Kelurahan Bongki'
)



@section('content')


<div class="dashboard-container">


<div class="card dashboard-card">


<div class="card-header d-flex justify-content-start align-items-center gap-3">


<div>



<small class="text-muted">

Daftar pelayanan surat masyarakat

</small>


</div>



<a href="{{ route('operator.permohonan-surat.create') }}"
class="btn btn-primary">


<i class="fa-solid fa-plus me-2"></i>

Tambah Permohonan


</a>


</div>





@if(session('success'))

<div class="alert alert-success m-3">

{{ session('success') }}

</div>

@endif





<div class="card-body p-0">


<div class="table-responsive">


<table class="table table-hover align-middle mb-0">


<thead>


<tr>


<th width="70">
No
</th>


<th>
Pemohon
</th>


<th>
Jenis Surat
</th>


<th>
Tanggal
</th>


<th>
Status
</th>


<th width="150">
Aksi
</th>


</tr>


</thead>



<tbody>



@forelse($permohonan as $item)



<tr>



<td>

{{ $loop->iteration }}

</td>




<td>


<strong>

{{ optional($item->penduduk)->nama_lengkap }}

</strong>


<br>


<small class="text-muted">

{{ optional($item->penduduk)->nik }}

</small>


</td>





<td>


{{ optional($item->jenisSurat)->nama }}


</td>





<td>


{{ $item->created_at->format('d-m-Y') }}


</td>





<td>


@if($item->status == 'Selesai')


<span class="badge bg-success">

Selesai

</span>


@elseif($item->status == 'Diproses')


<span class="badge bg-warning">

Diproses

</span>


@else


<span class="badge bg-secondary">

{{ $item->status }}

</span>


@endif


</td>





<td class="text-center">

    <div class="action-buttons">

        <a href="{{ route('operator.permohonan-surat.show',$item) }}"
           class="btn btn-info btn-sm text-white">

            <i class="fa-solid fa-eye"></i>

        </a>





        <a href="{{ route('operator.permohonan-surat.preview',$item) }}"
           class="btn btn-warning btn-sm">

            <i class="fa-solid fa-file-lines"></i>

        </a>

    </div>
</td>


</tr>



@empty


<tr>


<td colspan="6"
class="text-center py-5">


<i class="fa-solid fa-envelope-open-text fs-1 mb-3"></i>


<br>


Belum ada permohonan surat.



</td>


</tr>


@endforelse



</tbody>



</table>


</div>


</div>




<div class="card-footer">

{{ $permohonan->links() }}

</div>



</div>


</div>


@endsection