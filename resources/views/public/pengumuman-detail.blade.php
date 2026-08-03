@extends('layouts.public')

@section('title', $pengumuman->judul)

@section('content')

<section class="py-5 bg-light border-bottom">
    <div class="container">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Detail Pengumuman
                </li>

            </ol>
        </nav>


        <h1 class="detail-judul-berita fw-bold mb-3">
            {{ $pengumuman->judul }}
        </h1>


        <div class="d-flex flex-wrap gap-3 text-muted">

            <span>
                <i class="bi bi-calendar-event me-1"></i>

                {{ optional($pengumuman->tanggal_publish)->translatedFormat('d F Y')
                    ?? $pengumuman->created_at->translatedFormat('d F Y') }}
            </span>


            <span>
                <i class="bi bi-person-circle me-1"></i>

                Pemerintah Kelurahan Bongki

            </span>

        </div>

    </div>
</section>



<section class="py-5">

    <div class="container">

        <div class="row">

            <div class="col-lg-10 mx-auto">


                <div class="card border-0 shadow-sm">


                    @if($pengumuman->gambar)

                    <img
                        src="{{ asset('storage/'.$pengumuman->gambar) }}"
                        class="detail-gambar-pengumuman"
                        alt="{{ $pengumuman->judul }}">

                    @endif



                    <div class="card-body p-4">


                        <div class="content-berita">

                            {!! $pengumuman->isi !!}

                        </div>


                    </div>


                </div>



                <div class="mt-4">

                    <a href="{{ route('home') }}#pengumuman"
                       class="btn btn-outline-primary">

                        <i class="bi bi-arrow-left"></i>

                        Kembali ke Pengumuman

                    </a>

                </div>



            </div>


        </div>

    </div>

</section>


@endsection