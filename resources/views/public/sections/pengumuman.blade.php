<section id="pengumuman" class="pengumuman-section py-5">

<div class="container">


    {{-- HEADER --}}
    <div class="text-center mb-5">

        <span class="section-badge">
            Pengumuman
        </span>


       
        <p class="section-description">
            Informasi resmi, pemberitahuan dan kegiatan
            Pemerintah Kelurahan Bongki.
        </p>


    </div>



    {{-- LIST --}}
    <div class="row g-4">


        @php

        $dataPengumuman = [

            [
            'tanggal'=>'30 Juli 2026',
            'judul'=>'Pelayanan Administrasi Kelurahan',
            'isi'=>'Informasi jadwal pelayanan administrasi masyarakat Kelurahan Bongki.'
            ],


            [
            'tanggal'=>'25 Juli 2026',
            'judul'=>'Pemutakhiran Data Penduduk',
            'isi'=>'Pemerintah Kelurahan Bongki melakukan pemutakhiran data penduduk.'
            ],


            [
            'tanggal'=>'20 Juli 2026',
            'judul'=>'Layanan Digital SiPBongki',
            'isi'=>'Gunakan layanan digital untuk pengajuan administrasi kelurahan.'
            ]

        ];

        @endphp




        @foreach($dataPengumuman as $item)


        <div class="col-lg-4 col-md-6">


            <article class="pengumuman-card">


                <div class="pengumuman-top">


                    <span class="pengumuman-date">

                        {{ $item['tanggal'] }}

                    </span>


                </div>



                <h4>

                    {{ $item['judul'] }}

                </h4>



                <p>

                    {{ $item['isi'] }}

                </p>




                <div class="pengumuman-footer">


                    <a href="#">

                        Baca Selengkapnya

                        <i class="bi bi-arrow-right"></i>

                    </a>


                </div>



            </article>


        </div>


        @endforeach



    </div>


</div>


</section>