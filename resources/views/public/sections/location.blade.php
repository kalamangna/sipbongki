<section id="lokasi" class="location-section py-5 fade-up">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-badge">
                Lokasi & Kontak
            </span>


            <p class="section-description">
               Informasi alamat kantor, peta lokasi, serta sarana komunikasi untuk memudahkan masyarakat menghubungi Kelurahan Bongki.
            </p>

        </div>

        <div class="row g-5 align-items-stretch">

            {{-- INFORMASI --}}
            <div class="col-lg-5">

                <div class="contact-card h-100">

                    <div class="contact-item">

                        <div class="contact-icon">

                            <i class="bi bi-geo-alt-fill"></i>

                        </div>

                        <div>

                            <h5>Alamat</h5>

                            <p>

                                {{ $website?->alamat ?? 'Kelurahan Bongki' }}

                                <br>

                                Kecamatan Sinjai Utara

                                <br>

                                Kabupaten Sinjai

                            </p>

                        </div>

                    </div>

                    <div class="contact-item">

                        <div class="contact-icon">

                            <i class="bi bi-telephone-fill"></i>

                        </div>

                        <div>

                            <h5>Telepon</h5>

                            <p>{{ $website?->telepon ?? '-' }}</p>

                        </div>

                    </div>

                    <div class="contact-item">

                        <div class="contact-icon">

                            <i class="bi bi-envelope-fill"></i>

                        </div>

                        <div>

                            <h5>Email</h5>

                            <p>{{ $website?->email ?? '-' }}</p>

                        </div>

                    </div>

                    <div class="contact-item">

                        <div class="contact-icon">

                            <i class="bi bi-clock-fill"></i>

                        </div>

                        <div>

                            <h5>Jam Pelayanan</h5>

                            <p>

                                {{ $website?->jam_pelayanan ?? 'Senin - Jumat, 08.00 - 16.00 WITA' }}

                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ $website?->google_maps ?? '#' }}"
                        target="_blank"
                        class="btn btn-primary btn-lg w-100 rounded-4 mt-4">

                        <i class="bi bi-map-fill me-2"></i>

                        Buka Google Maps

                    </a>

                </div>

            </div>

            {{-- MAP --}}
            <div class="col-lg-7">

                <div class="map-card">

                    <iframe
                        src="{{ $website?->google_maps ?? 'https://www.google.com/maps?q=Kelurahan+Bongki&output=embed' }}"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                </div>

            </div>

        </div>

    </div>

</section>