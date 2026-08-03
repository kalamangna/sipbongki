@extends('layouts.admin')


@section('title', 'Manajemen Galeri')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

           

            <p class="text-muted mb-0">
                Kelola dokumentasi kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.galeri.create') }}"
           class="btn btn-primary">

            <i class="fa-solid fa-circle-plus me-2"></i>

            Tambah Galeri

        </a>


    </div>








    {{-- CARD --}}
    <div class="card border-0 shadow-sm">


        <div class="card-body">



            <div class="table-responsive">


                <table class="table table-hover align-middle">


                    <thead>

                        <tr>

                            <th width="70">
                                No
                            </th>


                            <th width="120">
                                Foto
                            </th>


                            <th>
                                Judul
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Dibuat
                            </th>


                            <th width="150">
                                Aksi
                            </th>

                        </tr>


                    </thead>




                    <tbody>


                    @forelse($galeris as $index => $galeri)


                        <tr>


                            <td>

                                {{ $galeris->firstItem() + $index }}

                            </td>





                            <td>


                                <img 
                                    src="{{ asset('storage/'.$galeri->gambar) }}"
                                    width="90"
                                    height="60"
                                    class="rounded object-fit-cover"
                                    alt="{{ $galeri->judul }}"
                                >


                            </td>






                            <td>


                                <strong>

                                    {{ $galeri->judul }}

                                </strong>


                                @if($galeri->deskripsi)

                                    <br>

                                    <small class="text-muted">

                                        {{ Str::limit($galeri->deskripsi,60) }}

                                    </small>

                                @endif


                            </td>






                            <td>


                                @if($galeri->status == 'aktif')


                                    <span class="badge bg-success">

                                        Aktif

                                    </span>


                                @else


                                    <span class="badge bg-secondary">

                                        Nonaktif

                                    </span>


                                @endif


                            </td>







                            <td>

                                {{ $galeri->created_at->format('d M Y') }}

                            </td>







<td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.website.galeri.show',$galeri->id) }}"
           class="btn btn-info btn-sm"
           title="Detail">

            <i class="fa-solid fa-eye"></i>

        </a>

        {{-- Edit --}}
        <a href="{{ route('admin.website.galeri.edit',$galeri->id) }}"
           class="btn btn-warning btn-sm"
           title="Edit">

            <i class="fa-solid fa-pen"></i>

        </a>

        {{-- Hapus --}}
        <form action="{{ route('admin.website.galeri.destroy',$galeri->id) }}"
              method="POST"
              class="d-inline m-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus"
                onclick="return confirm('Hapus galeri ini?')">

                <i class="fa-solid fa-trash"></i>

            </button>

        </form>

    </div>

</td>

                        </tr>


                    @empty


                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-4">


                                Belum ada dokumentasi.


                            </td>

                        </tr>


                    @endforelse



                    </tbody>


                </table>


            </div>





            {{ $galeris->links() }}




        </div>


    </div>


</div>


@endsection