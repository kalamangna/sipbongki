@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            

            <p class="text-muted mb-0">
                Data Kependudukan Kelurahan Bongki
            </p>
        </div>

        <a href="{{ route('admin.penduduk.create') }}"
            class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Penduduk
        </a>
    </div>

    <div class="card shadow-sm">

     <div class="card-header bg-white">

<form method="GET">

<div class="row g-0">


    <div class="col-md-3">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            class="form-control"
            placeholder="Nama / NIK">

    </div>



    <div class="col-md-3">

        <select
            name="lingkungan"
            class="form-select">

            <option value="">
                Semua Lingkungan
            </option>


            @foreach($lingkungans as $item)

            <option value="{{ $item->id }}"
                {{ $lingkungan == $item->id ? 'selected':'' }}>

                {{ $item->nama }}

            </option>

            @endforeach


        </select>

    </div>



    <div class="col-md-2">

        <select
            name="jenis_kelamin"
            class="form-select">


            <option value="">
                Semua JK
            </option>


            <option value="L"
            {{ $jenis_kelamin == 'L' ? 'selected':'' }}>
                Laki-laki
            </option>


            <option value="P"
            {{ $jenis_kelamin == 'P' ? 'selected':'' }}>
                Perempuan
            </option>


        </select>

    </div>




    <div class="col-md-2">


        <select
            name="agama"
            class="form-select">


            <option value="">
                Semua Agama
            </option>


            @foreach($agamas as $item)

            <option value="{{ $item }}"
            {{ $agama == $item ? 'selected':'' }}>

                {{ $item }}

            </option>

            @endforeach


        </select>


    </div>




    <div class="col-md-2">


        <button
            class="btn btn-primary w-100">

            <i class="bi bi-search"></i>
            Tampilkan

        </button>


    </div>


</div>



@if($search || $lingkungan || $jenis_kelamin || $agama)

<div class="mt-3">

<a href="{{ route('admin.penduduk.index') }}"
class="btn btn-secondary btn-sm">

<i class="bi bi-arrow-counterclockwise"></i>

Reset

</a>

</div>

@endif



</form>


</div>   

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

              <thead class="table-light">

<tr>

<th width="50">
No
</th>


<th>
<a href="{{ request()->fullUrlWithQuery([
'sort'=>'nik',
'direction'=>$direction=='asc'?'desc':'asc'
]) }}"
class="text-decoration-none text-dark">

NIK
<i class="bi bi-arrow-down-up"></i>

</a>
</th>



<th>

<a href="{{ request()->fullUrlWithQuery([
'sort'=>'nama_lengkap',
'direction'=>$direction=='asc'?'desc':'asc'
]) }}"
class="text-decoration-none text-dark">


Nama
<i class="bi bi-arrow-down-up"></i>


</a>


</th>



<th>
JK
</th>


<th>
Lingkungan
</th>


<th>
Agama
</th>


<th>
Status
</th>


<th width="100" class="text-center">
Aksi
</th>


</tr>

</thead>  

                <tbody>

                @forelse($penduduks as $penduduk)

                    <tr>
                        <td>
                            {{ $penduduks->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ $penduduk->nik }}
                        </td>

                        <td>
                            {{ $penduduk->nama_lengkap }}
                        </td>

                        <td>
                            {{ $penduduk->jenis_kelamin }}
                        </td>
                        <td>
    {{ $penduduk->agama ?? '-' }}
</td>

                        <td>
                            {{ $penduduk->lingkungan->nama ?? '-' }}
                        </td>

                        <td>
                            @if($penduduk->aktif)
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

        {{-- Detail --}}
        <a
            href="{{ route('admin.penduduk.show', $penduduk) }}"
            class="btn btn-info btn-sm"
            title="Detail">

            <i class="bi bi-eye"></i>

        </a>

        {{-- Edit --}}
        <a
            href="{{ route('admin.penduduk.edit', $penduduk) }}"
            class="btn btn-warning btn-sm"
            title="Edit">

            <i class="bi bi-pencil"></i>

        </a>

        {{-- Hapus --}}
        <form
            action="{{ route('admin.penduduk.destroy', $penduduk) }}"
            method="POST"
            class="d-inline mb-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus"
                onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </div>

</td>     

                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center py-5">

                            <i class="bi bi-people fs-1 d-block mb-3"></i>

                            <span class="text-muted">
                                Belum ada data penduduk.
                            </span>

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($penduduks->hasPages())
            <div class="card-footer bg-white">
                {{ $penduduks->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>
@endsection