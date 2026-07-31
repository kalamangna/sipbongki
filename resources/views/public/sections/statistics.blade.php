<section class="statistics-section py-5 fade-up">

    <div class="container">


        {{-- HEADER SECTION --}}
        <div class="section-header text-center mb-5">


            <span class="section-badge">
                Statistik Kelurahan
            </span>



            <p class="section-subtitle">
                Menyajikan data statistik Kelurahan Bongki sebagai gambaran kondisi kependudukan dan wilayah secara informatif.
            </p>


        </div>





        <div class="row g-4">





            {{-- PENDUDUK --}}
            <div class="col-lg-4 col-md-6">


                <div class="stat-card h-100">


                    <div class="stat-icon bg-primary-subtle text-primary">

                        <i class="bi bi-people-fill"></i>

                    </div>




                    <div class="stat-content">


                        <h2>
                            {{ number_format($jumlahPenduduk ?? 0) }}
                        </h2>


                        <h6>
                            Total Penduduk
                        </h6>


                        <small>
                            Data penduduk yang telah terdaftar.
                        </small>


                    </div>


                </div>


            </div>







            {{-- KK --}}
            <div class="col-lg-4 col-md-6">


                <div class="stat-card h-100">


                    <div class="stat-icon bg-success-subtle text-success">

                        <i class="bi bi-house-fill"></i>

                    </div>




                    <div class="stat-content">


                        <h2>
                            {{ number_format($jumlahKK ?? 0) }}
                        </h2>


                        <h6>
                            Kartu Keluarga
                        </h6>


                        <small>
                            Jumlah kartu keluarga aktif.
                        </small>


                    </div>


                </div>


            </div>







            {{-- PERANGKAT --}}
            <div class="col-lg-4 col-md-6">


                <div class="stat-card h-100">


                    <div class="stat-icon bg-info-subtle text-info">

                        <i class="bi bi-person-badge-fill"></i>

                    </div>




                    <div class="stat-content">


                        <h2>
                            {{ number_format($jumlahPerangkat ?? 0) }}
                        </h2>


                        <h6>
                            Perangkat Kelurahan
                        </h6>


                        <small>
                            Aparatur yang sedang aktif.
                        </small>


                    </div>


                </div>


            </div>







            {{-- LINGKUNGAN --}}
            <div class="col-lg-4 col-md-6">


                <div class="stat-card h-100">


                    <div class="stat-icon bg-warning-subtle text-warning">

                        <i class="bi bi-geo-alt-fill"></i>

                    </div>




                    <div class="stat-content">


                        <h2>
                            {{ number_format($jumlahLingkungan ?? 0) }}
                        </h2>


                        <h6>
                            Lingkungan
                        </h6>


                        <small>
                            Wilayah administrasi Kelurahan Bongki.
                        </small>


                    </div>


                </div>


            </div>







            {{-- JENIS SURAT --}}
            <div class="col-lg-4 col-md-6">


                <div class="stat-card h-100">


                    <div class="stat-icon bg-danger-subtle text-danger">

                        <i class="bi bi-file-earmark-text-fill"></i>

                    </div>




                    <div class="stat-content">


                        <h2>
                            {{ number_format($jumlahJenisSurat ?? 0) }}
                        </h2>


                        <h6>
                            Jenis Layanan
                        </h6>


                        <small>
                            Layanan administrasi yang tersedia.
                        </small>


                    </div>


                </div>


            </div>







            {{-- PELAYANAN --}}
            <div class="col-lg-4 col-md-6">


                <div class="stat-card h-100">


                    <div class="stat-icon bg-secondary-subtle text-secondary">

                        <i class="bi bi-clipboard-check-fill"></i>

                    </div>




                    <div class="stat-content">


                        <h2>
                            {{ number_format($jumlahPelayanan ?? 0) }}
                        </h2>


                        <h6>
                            Permohonan Pelayanan
                        </h6>


                        <small>
                            Total permohonan pelayanan yang tercatat.
                        </small>


                    </div>


                </div>


            </div>




        </div>



    </div>


</section>