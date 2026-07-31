<section id="agenda" class="agenda-section py-5 fade-up">


    <div class="container">



        {{-- HEADER --}}
        <div class="text-center mb-5">


            <span class="section-badge">

                Agenda

            </span>


            <p class="section-description">

                Jadwal kegiatan dan pelayanan Kelurahan Bongki
                yang akan dilaksanakan.

            </p>



        </div>







        <div class="row g-4">





        @forelse($agendas as $agenda)



            <div class="col-lg-4 col-md-6">



                <div class="agenda-card h-100">





                    {{-- TANGGAL --}}
                    <div class="agenda-date">


                        <span>

                            {{ $agenda->tanggal
                                ? $agenda->tanggal->format('d')
                                : '-'
                            }}

                        </span>


                        {{ 
                            $agenda->tanggal
                            ? strtoupper($agenda->tanggal->format('M'))
                            : ''
                        }}


                    </div>







                    {{-- KONTEN --}}
                    <div class="agenda-content">





                        <h5>

                            {{ $agenda->judul }}

                        </h5>





                        <p>


                            <i class="bi bi-geo-alt-fill me-1"></i>


                            {{ $agenda->lokasi ?? 'Lokasi belum ditentukan' }}


                        </p>







                        <small>


                            <i class="bi bi-clock me-1"></i>


                            {{ $agenda->waktu ?? '-' }}

                            WITA


                        </small>






                    </div>




                </div>



            </div>





        @empty



            <div class="col-12">


                <div class="alert alert-light border text-center">


                    <i class="bi bi-calendar-x me-2"></i>


                    Belum ada agenda kegiatan.


                </div>


            </div>



        @endforelse





        </div>





    </div>



</section>