<footer id="kontak" class="footer-section">
    <div class="container">

        <div class="row gy-5">

            {{-- Logo & Deskripsi --}}
            <div class="col-lg-4">

                <div class="d-flex align-items-center mb-3">

                    <img
                        src="{{ $website?->logo
                            ? asset('storage/'.$website->logo)
                            : asset('images/logo/logo.png') }}"
                        class="footer-logo"
                        alt="Logo">

                    <div class="ms-3">

                        <h4 class="mb-1">
                            {{ $website?->nama_website ?? 'SIP Bongki' }}
                        </h4>

                        <span class="footer-subtitle">
                            Pemerintah Kelurahan Bongki
                        </span>

                    </div>

                </div>

                <p class="footer-description">
                    {{ $website?->footer_text ?? 'Sistem Informasi dan Pelayanan Kelurahan Bongki yang memberikan pelayanan publik secara cepat, transparan dan profesional.' }}
                </p>

            </div>

            {{-- Menu --}}
            <div class="col-lg-2">

                <h5>Menu</h5>

                <ul class="footer-menu">

                    <li><a href="#">Beranda</a></li>
                    <li><a href="#profil">Profil</a></li>
                    <li>
    <a href="{{ route('home') }}#layanan">
        Layanan
    </a>
</li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#galeri">Galeri</a></li>
                    <li><a href="#kontak">Kontak</a></li>

                </ul>

            </div>

            {{-- Layanan --}}
            <div class="col-lg-3">

                <h5>Layanan</h5>

                <ul class="footer-menu">

                    <li>Surat Ket. Usaha</li>
                    <li>Surat Ket. Belum Menikah</li>
                    <li>Surat Ket. Domisili</li>
                    <li>Surat Ket. Kematian</li>
                    <li>Surat Ket. Orang Yang Sama</li>
                    <li>Surat Ket. Kurang Mampu</li>

                </ul>

            </div>

            {{-- Kontak --}}
            <div class="col-lg-3">

                <h5>Kontak</h5>

                <div class="footer-contact">

                    <p>
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ $website?->alamat }}
                    </p>

                    <p>
                        <i class="bi bi-telephone-fill"></i>
                        {{ $website?->telepon }}
                    </p>

                    <p>
                        <i class="bi bi-envelope-fill"></i>
                        {{ $website?->email }}
                    </p>

                </div>

            </div>

        </div>

        <div class="footer-bottom">

    <p class="mb-0">

        Sistem Informasi &amp; Pelayanan Kelurahan Bongki (SIPBongki)
        &nbsp;|&nbsp;
        {{ $website?->copyright ?? '© '.date('Y').' Kelurahan Bongki' }}

    </p>

</div>

    </div>

</footer>