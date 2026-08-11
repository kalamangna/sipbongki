@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">
        <div>
            

            <p class="text-slate-500 mb-0">
                Data Kependudukan Kelurahan Bongki
            </p>
        </div>

        <a href="{{ route('admin.penduduk.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
            <i class="bi bi-plus-circle"></i>
            Penduduk
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

     <div class="px-6 py-4 border-b border-slate-200 bg-white">

<form method="GET">

<div class="flex flex-wrap -mx-3 g-0">


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
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm w-100">

            <i class="bi bi-search"></i>
            Tampilkan

        </button>


    </div>


</div>



@if($search || $lingkungan || $jenis_kelamin || $agama)

<div class="mt-3">

<a href="{{ route('admin.penduduk.index') }}"
class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary !px-3 !py-1.5 !text-xs">

<i class="bi bi-arrow-counterclockwise"></i>

Reset

</a>

</div>

@endif



</form>


</div>   

        <div class="p-6 p-0">

            <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">

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
                            @gender($penduduk->jenis_kelamin)
                        </td>
                        <td>
                            {{ $penduduk->lingkungan->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $penduduk->agama ?? '-' }}
                        </td>

                        <td>
                            @if($penduduk->aktif)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>

<td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a
            href="{{ route('admin.penduduk.show', $penduduk) }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
            title="Detail">

            <i class="bi bi-eye"></i>

        </a>

        </form>

    </div>

</td>     

                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center py-8">

                            <i class="bi bi-people fs-1 d-block mb-4"></i>

                            <span class="text-slate-500">
                                Belum ada data penduduk.
                            </span>

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($penduduks->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-white">
                {{ $penduduks->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>
@endsection