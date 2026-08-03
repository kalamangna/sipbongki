<section id="galeri" class="gallery-section home-zone zone-primary">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-badge">
                Galeri
            </span>

          
            <p class="section-description">
                Dokumentasi foto berbagai kegiatan, pelayanan, dan pembangunan yang dilaksanakan di Kelurahan Bongki.
            </p>

        </div>

        <div class="row g-4">

            @forelse($galeris as $galeri)

                <div class="col-lg-4 col-md-6">

                    <div class="gallery-card">

                        <img
                            src="{{ asset('storage/'.$galeri->gambar) }}"
                            alt="{{ $galeri->judul }}"
                            loading="lazy">

                        <div class="gallery-overlay">

                            <div>

                                <i class="bi bi-images"></i>

                                <h5>

                                    {{ $galeri->judul }}

                                </h5>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-card">

                        <i class="bi bi-images"></i>

                        <h5 class="mt-3">

                            Galeri Belum Tersedia

                        </h5>

                        <p>

                            Dokumentasi kegiatan akan ditampilkan setelah dipublikasikan.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>