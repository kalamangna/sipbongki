@extends('layouts.public')

@section('title', $berita->judul)

@section('content')

<section class="py-5 bg-light border-bottom">
    <div class="container">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item active">
                    Detail Berita
                </li>
            </ol>
        </nav>

        <h1 class="detail-judul-berita fw-bold mb-3">
    {{ $berita->judul }}
</h1>

        <div class="d-flex flex-wrap gap-3 text-muted">

            <span>
                <i class="bi bi-calendar-event me-1"></i>

                {{ optional($berita->tanggal_publish)->translatedFormat('d F Y')
                    ?? $berita->created_at->translatedFormat('d F Y') }}
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

            {{-- ISI BERITA --}}
            <div class="col-lg-10 mx-auto">

                <div class="card border-0 shadow-sm">

                    @if($berita->gambar)

<img
    src="{{ asset('storage/'.$berita->gambar) }}"
    class="detail-gambar-berita"
    alt="{{ $berita->judul }}">

@endif

                    <div class="card-body p-4">

                        <div class="content-berita">

    {!! $berita->isi !!}

</div>

                    </div>

                </div>

                <div class="mt-4">

                    <a href="{{ route('home') }}#berita"
                       class="btn btn-outline-primary">

                        <i class="bi bi-arrow-left"></i>

                        Kembali ke Beranda

                    </a>

                </div>

            </div>


         

        </div>

    </div>

</section>

@endsection