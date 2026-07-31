<section class="hero-section fade-up">

    <div class="container">

        <div class="row align-items-center min-vh-100 gy-5">

            {{-- =========================
                HERO CONTENT
            ========================== --}}
            <div class="col-lg-6">

                <span class="hero-badge">
                    <i class="bi bi-shield-check"></i>
                    Sistem Informasi & Pelayanan
                </span>

                <h1 class="hero-title">

                    {{ $website?->judul_hero ?? 'Kelurahan' }}

                    <span>
                        {{ $website?->subjudul_hero ?? 'Bongki' }}
                    </span>

                </h1>

                <h4 class="fw-semibold text-dark mb-4">
                    Melayani dengan Transparan, Cepat dan Profesional
                </h4>

                <p class="hero-description">

                    {{ $website?->deskripsi_hero ??
                    'SIP Bongki merupakan sistem pelayanan digital Kelurahan Bongki yang memberikan kemudahan kepada masyarakat dalam memperoleh informasi, mengajukan pelayanan administrasi, serta memantau proses permohonan surat secara cepat, transparan, dan profesional.' }}

                </p>

                <div class="hero-buttons">

                    <a href="{{ $website?->hero_button_1_link ?? '#layanan' }}"
                       class="btn btn-primary btn-lg hero-btn-primary">

                        <i class="bi bi-send-check me-2"></i>

                        {{ $website?->hero_button_1_text ?? 'Ajukan Permohonan' }}

                    </a>

                    <a href="{{ $website?->hero_button_2_link ?? '#layanan' }}"
                       class="btn btn-outline-primary btn-lg hero-btn-outline">

                        <i class="bi bi-grid me-2"></i>

                        {{ $website?->hero_button_2_text ?? 'Lihat Layanan' }}

                    </a>

                </div>

            </div>



            {{-- =========================
                HERO IMAGE
            ========================== --}}
            <div class="col-lg-6">

                <div class="hero-image-wrapper">

                    <img
                        src="{{ $website?->gambar_hero
                            ? asset('storage/'.$website->gambar_hero)
                            : asset('images/kantor.png') }}"
                        alt="Kelurahan Bongki"
                        class="hero-image">

                </div>



                {{-- =========================
                    QUICK INFO
                ========================== --}}
                <div class="hero-info-card">

                    <div class="hero-info-item">

                        <i class="bi bi-clock-history"></i>

                        <div>

                            <strong>Jam Pelayanan</strong>

                            <span>
                                {{ $website?->jam_pelayanan ?? '08.00 - 16.00 WITA' }}
                            </span>

                        </div>

                    </div>



                    <div class="hero-info-item">

                        <i class="bi bi-geo-alt-fill"></i>

                        <div>

                            <strong>Lokasi</strong>

                            <span>Kel. Bongki</span>

                        </div>

                    </div>



                    <div class="hero-info-item">

                        <i class="bi bi-whatsapp"></i>

                        <div>

                            <strong>WhatsApp</strong>

                            <span>
                                {{ $website?->whatsapp ?? '-' }}
                            </span>

                        </div>

                    </div>



                    <div class="hero-info-item">

                        <i class="bi bi-headset"></i>

                        <div>

                            <strong>Layanan</strong>

                            <span>Cepat & Profesional</span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



       {{-- =========================
    STATISTIK HERO
========================== --}}
<div class="hero-statistics">

    {{-- Penduduk --}}
    <div class="hero-stat">

        <div class="hero-stat-icon stat-green">
            <i class="bi bi-people-fill"></i>
        </div>

        <div class="hero-stat-content stat-green-text">

            <h3>{{ number_format($jumlahPenduduk ?? 0) }}</h3>

            <span>Penduduk</span>

            <small>Data Terdaftar</small>

        </div>

    </div>

    <div class="hero-divider"></div>

    {{-- Kartu Keluarga --}}
    <div class="hero-stat">

        <div class="hero-stat-icon stat-blue">
            <i class="bi bi-house-door-fill"></i>
        </div>

        <div class="hero-stat-content stat-blue-text">

            <h3>{{ number_format($jumlahKK ?? 0) }}</h3>

            <span>Kartu Keluarga</span>

            <small>Data Terdaftar</small>

        </div>

    </div>

    <div class="hero-divider"></div>

    {{-- Layanan --}}
    <div class="hero-stat">

        <div class="hero-stat-icon stat-green">
            <i class="bi bi-file-earmark-text-fill"></i>
        </div>

        <div class="hero-stat-content stat-green-text">

            <h3>{{ number_format($jumlahJenisSurat ?? 0) }}</h3>

            <span>Layanan</span>

            <small>Tersedia</small>

        </div>

    </div>

    <div class="hero-divider"></div>

    {{-- Perangkat --}}
    <div class="hero-stat">

        <div class="hero-stat-icon stat-orange">
            <i class="bi bi-person-badge-fill"></i>
        </div>

        <div class="hero-stat-content stat-orange-text">

            <h3>{{ number_format($jumlahPerangkat ?? 0) }}</h3>

            <span>Perangkat</span>

            <small>Kelurahan</small>

        </div>

    </div>

</div>