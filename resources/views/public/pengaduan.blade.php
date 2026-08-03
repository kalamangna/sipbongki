@extends('layouts.public')

@section('title', 'Pengaduan Masyarakat')

@section('content')

{{-- ==========================================================
    HERO
========================================================== --}}
<section class="complaint-hero py-5">
    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-7">

                <span class="badge bg-success px-3 py-2 rounded-pill mb-3">
                    Layanan Pengaduan
                </span>

                <h1 class="display-5 fw-bold mb-4">
                    Sampaikan Pengaduan, Keluhan, dan Aspirasi Anda
                </h1>

                <p class="lead text-secondary mb-4">
                    Pemerintah Kelurahan Bongki berkomitmen memberikan pelayanan
                    yang cepat, transparan, dan responsif terhadap setiap
                    pengaduan masyarakat.
                </p>

                <a href="#kirim-pengaduan"
                   class="btn btn-success btn-lg rounded-pill px-4">
                    <i class="bi bi-whatsapp me-2"></i>
                    Kirim Pengaduan
                </a>

            </div>

            <div class="col-lg-5 text-center complaint-image-wrapper">

        <img
        src="{{ asset('images/ilustrations/pengaduan.png') }}"
        class="img-fluid complaint-image"
        alt="Ilustrasi Pengaduan Masyarakat">

</div>

        </div>

    </div>
</section>

{{-- ==========================================================
    JENIS PENGADUAN
========================================================== --}}
<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Jenis Pengaduan
            </h2>

            <p class="text-muted">
                Beberapa laporan yang dapat disampaikan masyarakat.
            </p>

        </div>

        <div class="row g-4">

            @php
                $items = [
                    ['bi-signpost-2','Jalan Rusak'],
                    ['bi-lightbulb','Lampu Jalan Mati'],
                    ['bi-trash','Sampah'],
                    ['bi-water','Drainase'],
                    ['bi-tree','Pohon Tumbang'],
                    ['bi-building','Fasilitas Umum'],
                    ['bi-file-earmark-text','Pelayanan'],
                    ['bi-chat-dots','Saran & Masukan'],
                ];
            @endphp

            @foreach($items as $item)

                <div class="col-md-6 col-lg-3">

                    <div class="card border-0 shadow-sm h-100 text-center">

                        <div class="card-body p-4">

                            <i class="bi {{ $item[0] }} display-5 text-success"></i>

                            <h5 class="mt-3">
                                {{ $item[1] }}
                            </h5>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- ==========================================================
    CARA MELAPOR
========================================================== --}}
<section class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Cara Menyampaikan Pengaduan
            </h2>

        </div>

        <div class="row text-center g-4">

            <div class="col-md-3">
                <h1>1</h1>
                <p>Siapkan informasi dan lokasi kejadian.</p>
            </div>

            <div class="col-md-3">
                <h1>2</h1>
                <p>Jelaskan kronologi secara singkat dan jelas.</p>
            </div>

            <div class="col-md-3">
                <h1>3</h1>
                <p>Lampirkan foto apabila memungkinkan.</p>
            </div>

            <div class="col-md-3">
                <h1>4</h1>
                <p>Kirim laporan melalui WhatsApp/Website.</p>
            </div>

        </div>

    </div>

</section>

{{-- ==========================================================
    FORM PENGADUAN
========================================================== --}}
<section
    id="kirim-pengaduan"
    class="py-5 bg-success text-white">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Kirim Pengaduan
            </h2>

            <p>
                Isi formulir berikut untuk menyampaikan laporan kepada Kelurahan Bongki.
            </p>

        </div>


        @if(session('success'))

            <div class="alert alert-light">
                {{ session('success') }}
            </div>

        @endif


        <div class="card border-0 shadow">

            <div class="card-body p-4 text-dark">


                <form action="{{ route('pengaduan.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf


                    <div class="row g-3">


                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   required>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Nomor Telepon
                            </label>

                            <input type="text"
                                   name="telepon"
                                   class="form-control"
                                   required>

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="2"
                                required></textarea>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Kategori Pengaduan
                            </label>

                            <select name="kategori"
                                    class="form-select"
                                    required>

                                <option value="">
                                    Pilih kategori
                                </option>

                                <option>
                                    Jalan Rusak
                                </option>

                                <option>
                                    Lampu Jalan Mati
                                </option>

                                <option>
                                    Sampah
                                </option>

                                <option>
                                    Drainase
                                </option>

                                <option>
                                    Pelayanan
                                </option>

                            </select>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Lokasi Kejadian
                            </label>

                            <input type="text"
                                   name="lokasi"
                                   class="form-control"
                                   required>

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Uraian Pengaduan
                            </label>

                            <textarea
                                name="uraian"
                                class="form-control"
                                rows="4"
                                required></textarea>

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Foto Bukti (opsional)
                            </label>

                            <input type="file"
                                   name="foto"
                                   class="form-control">

                        </div>


                    </div>


                    <div class="text-center mt-4">

                        <button type="submit"
                                class="btn btn-success btn-lg rounded-pill px-5">

                            <i class="bi bi-send me-2"></i>

                            Kirim Pengaduan

                        </button>

                    </div>


                </form>


            </div>

        </div>

    </div>

</section>
@endsection