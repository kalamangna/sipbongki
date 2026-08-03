@extends('layouts.admin')


@section('title', 'Detail Galeri')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Detail Galeri
            </h3>


            <p class="text-muted mb-0">
                Informasi dokumentasi kegiatan Kelurahan Bongki.
            </p>


        </div>




        <a href="{{ route('admin.website.galeri.index') }}"
           class="btn btn-secondary">


            <i class="fa-solid fa-arrow-left me-2"></i>

            Kembali


        </a>



    </div>







    <div class="row g-4">



        {{-- GAMBAR --}}

        <div class="col-lg-5">


            <div class="card border-0 shadow-sm">


                <div class="card-body text-center">


                    <img
                        src="{{ asset('storage/'.$galeri->gambar) }}"
                        class="img-fluid rounded"
                        style="max-height:400px;object-fit:cover;"
                        alt="{{ $galeri->judul }}"
                    >


                </div>


            </div>


        </div>








        {{-- INFORMASI --}}

        <div class="col-lg-7">


            <div class="card border-0 shadow-sm">


                <div class="card-body">



                    <h4 class="fw-bold mb-3">

                        {{ $galeri->judul }}

                    </h4>





                    <table class="table table-borderless">


                        <tr>

                            <th width="180">
                                Status
                            </th>


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


                        </tr>







                        <tr>

                            <th>
                                Tanggal Dibuat
                            </th>


                            <td>

                                {{ $galeri->created_at->format('d F Y') }}

                            </td>


                        </tr>







                        <tr>

                            <th>
                                Terakhir Update
                            </th>


                            <td>

                                {{ $galeri->updated_at->format('d F Y H:i') }}

                            </td>


                        </tr>



                    </table>







                    <hr>





                    <h6 class="fw-bold">

                        Deskripsi

                    </h6>




                    <p class="text-muted">

                        {{ $galeri->deskripsi ?: 'Tidak ada deskripsi.' }}

                    </p>







                    <a href="{{ route('admin.website.galeri.edit',$galeri->id) }}"
                       class="btn btn-warning">


                        <i class="fa-solid fa-pen me-2"></i>

                        Edit Galeri


                    </a>



                </div>


            </div>


        </div>



    </div>


</div>


@endsection