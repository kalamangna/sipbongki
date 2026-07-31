<section id="berita" class="news-section py-5 fade-up">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-badge">
                Berita
            </span>


            <p class="section-description">
               Informasi terbaru mengenai kegiatan, program, pengumuman, dan perkembangan Pemerintah Kelurahan Bongki.
            </p>

        </div>

        <div class="row g-4">

            @forelse($beritas as $berita)

                <div class="col-lg-4 col-md-6">

                    <article class="news-card h-100">

                        <div class="news-image">

                            <img
                                src="{{ $berita->gambar ? asset('storage/'.$berita->gambar) : asset('images/kantor.png') }}"
                                alt="{{ $berita->judul }}"
                                loading="lazy">

                            <div class="news-date">

                                <span>

                                    {{ optional($berita->tanggal_publish)->format('d') ?? $berita->created_at->format('d') }}

                                </span>

                                <small>

                                    {{ optional($berita->tanggal_publish)->format('M') ?? $berita->created_at->format('M') }}

                                </small>

                            </div>

                        </div>

                        <div class="news-body">

                            <h5>

                                {{ $berita->judul }}

                            </h5>

                            <p>

                                {{ Str::limit(strip_tags($berita->isi),140) }}

                            </p>

                            <a href="#" class="news-link">

                                Baca Selengkapnya

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </article>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-card">

                        <i class="bi bi-newspaper"></i>

                        <h5 class="mt-3">

                            Belum Ada Berita

                        </h5>

                        <p>

                            Berita akan muncul setelah dipublikasikan
                            melalui Dashboard Admin.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>