@extends('layouts.admin')


@section('title', 'Detail Galeri')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">


        <div>

            <h3 class="font-bold mb-1">
                Detail Galeri
            </h3>


            <p class="text-slate-500 mb-0">
                Informasi dokumentasi kegiatan Kelurahan Bongki.
            </p>


        </div>




        <a href="{{ route('admin.website.galeri.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">


            <i class="bi bi-arrow-left mr-2"></i>

            Kembali


        </a>



    </div>







    <div class="flex flex-wrap -mx-3">



        {{-- GAMBAR --}}

        <div class="col-lg-5">


            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


                <div class="p-6 text-center">


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


            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


                <div class="p-6">



                    <h4 class="font-bold mb-4">

                        {{ $galeri->judul }}

                    </h4>





                    <table class="w-full text-left border-collapse text-sm table-borderless">


                        <tr>

                            <th width="180">
                                Status
                            </th>


                            <td>


                                @if($galeri->status == 'aktif')


                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

                                        Aktif

                                    </span>


                                @else


                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

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

                                {{ $galeri->created_at->format('d F Y') }} WITA

                            </td>


                        </tr>







                        <tr>

                            <th>
                                Terakhir Update
                            </th>


                            <td>

                                {{ $galeri->updated_at->format('d F Y H:i') }} WITA

                            </td>


                        </tr>



                    </table>







                    <hr>





                    <h6 class="font-bold">

                        Deskripsi

                    </h6>




                    <p class="text-slate-500" style="text-align: justify; text-justify: inter-word;">

                        {{ $galeri->deskripsi ?: 'Tidak ada deskripsi.' }}

                    </p>







                    <a href="{{ route('admin.website.galeri.edit',$galeri->id) }}"
                       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">


                        <i class="bi bi-pencil mr-2"></i>

                        Edit Galeri


                    </a>



                </div>


            </div>


        </div>



    </div>


</div>


@endsection