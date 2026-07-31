@extends('layouts.admin')

@section('title', 'Detail Berita')


@section('content')

<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Detail Berita
            </h3>


            <p class="text-muted mb-0">
                Informasi lengkap berita Kelurahan Bongki.
            </p>

        </div>



        <div class="d-flex gap-2">


            <a href="{{ route('admin.website.berita.edit', $berita) }}"
               class="btn btn-warning">


                <i class="bi bi-pencil-square"></i>

                Edit


            </a>



            <a href="{{ route('admin.website.berita.index') }}"
               class="btn btn-outline-secondary">


                <i class="bi bi-arrow-left"></i>

                Kembali


            </a>


        </div>


    </div>







    <div class="row g-4">



        {{-- KONTEN BERITA --}}
        <div class="col-lg-8">


            <div class="card border-0 shadow-sm">


                <div class="card-body">



                    <h2 class="fw-bold mb-3">

                        {{ $berita->judul }}

                    </h2>





                    <div class="d-flex gap-3 text-muted mb-4">


                        <span>

                            <i class="bi bi-calendar-event"></i>

                            {{ optional($berita->tanggal_publish)->format('d M Y') ?? '-' }}

                        </span>



                        <span>

                            <i class="bi bi-circle-fill small"></i>

                            {{ ucfirst($berita->status) }}

                        </span>


                    </div>






                    @if($berita->gambar)


                    <div class="mb-4 text-center">


                        <img src="{{ asset('storage/'.$berita->gambar) }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height:420px; object-fit:cover;"
                             alt="{{ $berita->judul }}">


                    </div>


                    @endif







                    <div class="article-content">


                        {!! nl2br(e($berita->isi)) !!}


                    </div>



                </div>


            </div>


        </div>









        {{-- INFORMASI --}}
        <div class="col-lg-4">


            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">


                    <h5 class="fw-bold mb-0">

                        Informasi Berita

                    </h5>


                </div>





                <div class="card-body">



                    <div class="mb-3">


                        <small class="text-muted d-block">
                            Judul
                        </small>


                        <strong>
                            {{ $berita->judul }}
                        </strong>


                    </div>






                    <div class="mb-3">


                        <small class="text-muted d-block">
                            Slug
                        </small>


                        <span>
                            {{ $berita->slug }}
                        </span>


                    </div>






                    <div class="mb-3">


                        <small class="text-muted d-block">
                            Status
                        </small>



                        @if($berita->status == 'publish')


                            <span class="badge bg-success">

                                Publish

                            </span>


                        @else


                            <span class="badge bg-secondary">

                                Draft

                            </span>


                        @endif


                    </div>







                    <div class="mb-3">


                        <small class="text-muted d-block">
                            Dibuat
                        </small>


                        <span>

                            {{ $berita->created_at->format('d M Y H:i') }}

                        </span>


                    </div>







                    <div>


                        <small class="text-muted d-block">
                            Terakhir diperbarui
                        </small>


                        <span>

                            {{ $berita->updated_at->format('d M Y H:i') }}

                        </span>


                    </div>



                </div>


            </div>


        </div>




    </div>


</div>


@endsection