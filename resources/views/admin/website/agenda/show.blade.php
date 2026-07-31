@extends('layouts.admin')


@section('title', 'Detail Agenda')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Detail Agenda
            </h3>


            <p class="text-muted mb-0">
                Informasi lengkap kegiatan Kelurahan Bongki.
            </p>


        </div>




        <div>


            <a href="{{ route('admin.website.agenda.edit',$agenda->id) }}"
               class="btn btn-warning me-2">


                <i class="bi bi-pencil me-1"></i>

                Edit


            </a>



            <a href="{{ route('admin.website.agenda.index') }}"
               class="btn btn-secondary">


                <i class="bi bi-arrow-left me-1"></i>

                Kembali


            </a>


        </div>



    </div>








    <div class="row g-4">



        {{-- INFORMASI UTAMA --}}
        <div class="col-lg-8">


            <div class="card border-0 shadow-sm">


                <div class="card-body">



                    <h4 class="fw-bold mb-3">

                        {{ $agenda->judul }}

                    </h4>





                    <div class="mb-4">


                        @if($agenda->status == 'aktif')


                            <span class="badge bg-success">

                                Aktif

                            </span>


                        @else


                            <span class="badge bg-secondary">

                                Nonaktif

                            </span>


                        @endif


                    </div>







                    <h6 class="fw-bold">

                        Deskripsi Kegiatan

                    </h6>



                    <p class="text-muted">

                        {{ $agenda->deskripsi ?: 'Tidak ada deskripsi kegiatan.' }}

                    </p>




                </div>


            </div>


        </div>







        {{-- DETAIL WAKTU --}}
        <div class="col-lg-4">


            <div class="card border-0 shadow-sm">


                <div class="card-body">



                    <h5 class="fw-bold mb-4">

                        Informasi Agenda

                    </h5>





                    <div class="mb-3">


                        <small class="text-muted d-block">

                            <i class="bi bi-calendar-event me-2"></i>

                            Tanggal

                        </small>


                        <strong>

                            {{ 
                                $agenda->tanggal
                                ? $agenda->tanggal->format('d F Y')
                                : '-'
                            }}

                        </strong>


                    </div>








                    <div class="mb-3">


                        <small class="text-muted d-block">


                            <i class="bi bi-clock me-2"></i>

                            Waktu


                        </small>



                        <strong>

                            {{ $agenda->waktu ?? '-' }}

                            WITA

                        </strong>


                    </div>







                    <div class="mb-3">


                        <small class="text-muted d-block">


                            <i class="bi bi-geo-alt me-2"></i>

                            Lokasi


                        </small>



                        <strong>

                            {{ $agenda->lokasi ?? '-' }}

                        </strong>


                    </div>







                    <div>


                        <small class="text-muted d-block">


                            <i class="bi bi-clock-history me-2"></i>

                            Dibuat


                        </small>


                        <strong>

                            {{ $agenda->created_at->format('d M Y H:i') }}

                        </strong>


                    </div>




                </div>


            </div>



        </div>




    </div>




</div>


@endsection