<section id="layanan" class="services-section home-zone zone-primary">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5">

            <span class="section-badge">
                Pelayanan
            </span>

           
            <p class="section-description">
                Berbagai layanan administrasi yang dapat diajukan masyarakat Kelurahan Bongki secara mudah, cepat, dan transparan.
            </p>

        </div>

        <div class="row g-4">

            @forelse($jenisSurats ?? [] as $jenisSurat)

                <div class="col-lg-4 col-md-6">

                    <div class="service-card h-100">

                        <div class="service-icon">

                            <i class="bi {{ $jenisSurat->icon ?? 'bi-file-earmark-text-fill' }}"></i>

                        </div>

                        <h5>

                            {{ $jenisSurat->nama }}

                        </h5>

                        <p>

                            {{ $jenisSurat->deskripsi ?: 'Pelayanan administrasi Kelurahan Bongki.' }}

                        </p>

                        <div class="mt-auto">

                            <a
                                href="{{ route('login') }}"
                                class="service-link">

                                Ajukan Pelayanan

                                <i class="bi bi-arrow-right ms-2"></i>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-card">

                        <i class="bi bi-info-circle-fill"></i>

                        <h5 class="mt-3">
                            Belum Ada Layanan
                        </h5>

                        <p>
                            Jenis pelayanan akan ditampilkan setelah dipublikasikan
                            melalui Dashboard Admin.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>