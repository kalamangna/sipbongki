@extends('layouts.admin')


@section('title', 'Pengaturan Website')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h5 class="fw-bold mb-1">
                Pengaturan Website
            </h5>


            <p class="text-muted mb-0">
                Kelola identitas dan informasi utama website
            </p>


        </div>





        <a href="{{ route('admin.website.pengaturan.edit') }}"
           class="btn btn-primary">


            <i class="fa-solid fa-pen-square me-2"></i>

            Edit Pengaturan


        </a>


    </div>







   



    <div class="row g-4">







        {{-- LOGO --}}

        <div class="col-lg-4">


            <div class="card border-0 shadow-sm h-100">


                <div class="card-body text-center">



                    <h5 class="fw-bold mb-4">

                        Logo Website

                    </h5>





                    @if($setting && $setting->logo)


                        <img
                            src="{{ asset('storage/'.$setting->logo) }}"
                            class="img-fluid rounded mb-3"
                            style="max-height:200px;"
                        >


                    @else


                        <div class="text-muted py-5">


                            <i class="fa-solid fa-image fs-1"></i>


                            <p class="mt-2">

                                Logo belum tersedia

                            </p>


                        </div>


                    @endif




                </div>


            </div>


        </div>









        {{-- INFORMASI WEBSITE --}}

        <div class="col-lg-8">


            <div class="card border-0 shadow-sm">


                <div class="card-body">



                    <h5 class="fw-bold mb-4">

                        Informasi Website

                    </h5>






                    <table class="table table-borderless">



                        <tr>

                            <th width="220">
                                Nama Website
                            </th>


                            <td>

                                {{ $setting->nama_website ?? '-' }}

                            </td>


                        </tr>







                        <tr>

                            <th>
                                Nama Kelurahan
                            </th>


                            <td>

                                {{ $setting->nama_kelurahan ?? '-' }}

                            </td>


                        </tr>







                        <tr>

                            <th>
                                Telepon
                            </th>


                            <td>

                                {{ $setting->telepon ?? '-' }}

                            </td>


                        </tr>







                        <tr>

                            <th>
                                Email
                            </th>


                            <td>

                                {{ $setting->email ?? '-' }}

                            </td>


                        </tr>







                        <tr>

                            <th>
                                Alamat
                            </th>


                            <td>

                                {{ $setting->alamat ?? '-' }}

                            </td>


                        </tr>





                    </table>




                </div>


            </div>



        </div>









        {{-- SOSIAL MEDIA --}}

        <div class="col-12">


            <div class="card border-0 shadow-sm">


                <div class="card-body">



                    <h5 class="fw-bold mb-4">

                        Sosial Media

                    </h5>






                    <div class="row">



                        <div class="col-md-4 mb-3">


                            <strong>
                                Facebook
                            </strong>


                            <p class="text-muted mb-0">

                                {{ $setting->facebook ?? '-' }}

                            </p>


                        </div>






                        <div class="col-md-4 mb-3">


                            <strong>
                                Instagram
                            </strong>


                            <p class="text-muted mb-0">

                                {{ $setting->instagram ?? '-' }}

                            </p>


                        </div>







                        <div class="col-md-4 mb-3">


                            <strong>
                                Youtube
                            </strong>


                            <p class="text-muted mb-0">

                                {{ $setting->youtube ?? '-' }}

                            </p>


                        </div>




                    </div>




                </div>


            </div>


        </div>









        {{-- DESKRIPSI --}}

        <div class="col-12">


            <div class="card border-0 shadow-sm">


                <div class="card-body">


                    <h5 class="fw-bold mb-3">

                        Deskripsi Website

                    </h5>



                    <p class="text-muted">

                        {{ $setting->deskripsi ?? 'Belum ada deskripsi.' }}

                    </p>



                </div>


            </div>


        </div>






    </div>


</div>


@endsection