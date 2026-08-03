@extends('layouts.admin')


@section('title','Manajemen Halaman Website')


@section('content')


<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">


    <div>

      

        <p class="text-muted mb-0">
            Kelola halaman informasi publik SiPBongki.
        </p>

    </div>



    <a href="{{ route('admin.website.halaman.create') }}"
       class="btn btn-primary">

        <i class="fa-solid fa-circle-plus me-2"></i>

        Tambah Halaman

    </a>


</div>








<div class="card border-0 shadow-sm">

<div class="card-body">


<div class="table-responsive">


<table class="table table-hover align-middle">


<thead>

<tr>

<th width="70">
No
</th>

<th>
Judul
</th>

<th>
Slug
</th>

<th>
Status
</th>

<th width="180">
Aksi
</th>

</tr>

</thead>




<tbody>


@forelse($halamans as $index=>$halaman)


<tr>


<td>
{{ $index+1 }}
</td>



<td>

<strong>
{{ $halaman->judul }}
</strong>

<br>

<small class="text-muted">

{{ Str::limit(strip_tags($halaman->isi),60) }}

</small>


</td>




<td>

{{ $halaman->slug }}

</td>




<td>


@if($halaman->status == 'aktif')


<span class="badge bg-success">

Aktif

</span>


@else


<span class="badge bg-secondary">

Draft

</span>


@endif


</td>




<td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.website.halaman.show',$halaman->id) }}"
           class="btn btn-info btn-sm"
           title="Detail">

            <i class="fa-solid fa-eye"></i>

        </a>

        {{-- Edit --}}
        <a href="{{ route('admin.website.halaman.edit',$halaman->id) }}"
           class="btn btn-warning btn-sm"
           title="Edit">

            <i class="fa-solid fa-pen"></i>

        </a>

        {{-- Hapus --}}
        <form action="{{ route('admin.website.halaman.destroy',$halaman->id) }}"
              method="POST"
              class="d-inline m-0">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    title="Hapus"
                    onclick="return confirm('Hapus halaman ini?')">

                <i class="fa-solid fa-trash"></i>

            </button>

        </form>

    </div>

</td>


</tr>


@empty


<tr>

<td colspan="5"
class="text-center text-muted py-4">

Belum ada halaman.

</td>

</tr>


@endforelse


</tbody>


</table>


</div>


</div>

</div>


</div>


@endsection