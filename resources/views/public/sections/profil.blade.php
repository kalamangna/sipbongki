<section id="profil" class="profil-section home-zone zone-primary">

    <div class="container">

        {{-- =========================
            HEADER
        ========================== --}}
        <div class="profile-header text-center mb-5">

            <span class="section-badge">
                Profil Kelurahan
            </span>

            
            <p class="section-description mx-auto">
                Sejarah, visi dan misi, monografi, serta berbagai informasi
                mengenai Kelurahan Bongki sebagai pusat pelayanan pemerintahan,
                pembangunan, dan pemberdayaan masyarakat.
            </p>

        </div>

        {{-- =========================
            HERO
        ========================== --}}
        <div class="profile-hero mb-5">

            <div class="row align-items-center g-4">

                <div class="col-lg-7">

                    <span class="profile-hero-badge">

                        <i class="bi bi-building-fill"></i>

                        Pemerintah Kelurahan Bongki

                    </span>

                    <h1 class="profile-hero-title">

                        Pemerintah Kelurahan Bongki berkomitmen menghadirkan pelayanan publik yang mudah, cepat, transparan, dan profesional untuk meningkatkan kualitas pelayanan kepada masyarakat


                    </h1>

                    <p class="profile-hero-description">

                        Kelurahan Bongki merupakan salah satu kelurahan di
                        Kecamatan Sinjai Utara yang berkomitmen memberikan
                        pelayanan publik terbaik melalui tata kelola pemerintahan
                        yang modern, transparan, dan berbasis digital melalui
                        Sistem Informasi Pelayanan Kelurahan (SIPBongki).

                    </p>

                </div>

                <div class="col-lg-5">

        <div class="profile-hero-image-wrapper">

    <img
        src="{{ asset('images/kantorsatu.png') }}"
        class="profile-hero-image"
        alt="Kantor Kelurahan Bongki">

</div>        

                </div>

            </div>

        </div>
        
         {{-- =========================
                    STATISTIK
                ========================== --}}
                <div class="profile-statistics mb-5">

                    <div class="row g-3">

                        {{-- Penduduk --}}
                        <div class="col-6 col-md-3">

                           <div class="stat-card">

                        <div class="stat-icon green">
                        <i class="bi bi-people-fill"></i>
                        </div>

                        <h4>{{ number_format($jumlahPenduduk ?? 0) }}</h4>

                        <span>Penduduk</span>

                    </div>

                </div>

                  {{-- Kepala Keluarga --}}
                   <div class="col-6 col-md-3">
                    
                    <div class="stat-card">
                   
                        <div class="stat-icon blue">
                             <i class="bi bi-house-door-fill"></i>
                        </div>

                          <h4>
                              {{ number_format($jumlahKK ?? 0) }}
                           </h4>

                                <span>Kepala Keluarga</span>

                            </div>

                        </div>

                         {{-- Lingkungan --}}
                        <div class="col-6 col-md-3">

                            <div class="stat-card">

                              <div class="stat-icon yellow">
                                <i class="bi bi-pin-map-fill"></i>
                            </div>

                                <h4>4</h4>

                                <span>Lingkungan</span>

                            </div>

                        </div>

                         {{-- Luas Wilayah --}}
                        <div class="col-6 col-md-3">

                            <div class="stat-card">
                          
                                <div class="stat-icon cyan">
                                    <i class="bi bi-globe2"></i>
                                </div>

                                <h4>4,81</h4>

                                <span>Km²</span>

                            </div>

                        </div>

                    </div>

                </div>

        {{-- =========================
            CONTENT
        ========================== --}}
        <div class="row g-5 align-items-start">

            {{-- =========================
                PROFIL
            ========================== --}}
            <div class="col-lg-6 col-xl-5">

                <div class="profile-card">

                    <div class="profile-card-body p-5">

                        <span class="profile-label">

                            <i class="bi bi-info-circle-fill"></i>

                            Informasi Umum

                        </span>

                        <h3 class="profile-title">

                            {{ $halamanProfil['profil-kelurahan']->judul ?? 'Profil Kelurahan Bongki' }}

                        </h3>

                        <div class="profile-divider"></div>

                        <div class="profile-content">

                            {!! $halamanProfil['profil-kelurahan']->isi ??

                            '
                            <p class="profile-subtitle">

    Informasi umum mengenai kondisi wilayah,
    pemerintahan, dan pelayanan masyarakat

</p>
                            
                            <p>
                            Kelurahan Bongki merupakan salah satu kelurahan di Kecamatan
                            Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan yang
                            memiliki peran penting sebagai pusat pelayanan pemerintahan,
                            pembangunan, dan pemberdayaan masyarakat.
                            </p>

                            <p>
                            Dengan luas wilayah sekitar <strong>4,81 Km²</strong>,
                            Kelurahan Bongki terdiri atas empat lingkungan,
                            yaitu Paruntu, Popanda, Benteng, dan Samaenre.
                            Pemerintah Kelurahan terus berkomitmen meningkatkan
                            kualitas pelayanan publik yang cepat, transparan,
                            dan akuntabel.
                            </p>

                            <p>
                            Melalui inovasi pelayanan digital
                            <strong>SIPBongki</strong>,
                            masyarakat dapat memperoleh berbagai informasi,
                            pelayanan administrasi, serta akses terhadap
                            program pembangunan secara lebih mudah,
                            efektif, dan efisien.
                            </p>

                            '

                            !!}
                </div> {{-- profile-content --}}

            </div> {{-- profile-card-body --}}

        </div> {{-- profile-card --}}

    </div> {{-- col kiri --}}

               
                            
           {{-- ACCORDION --}}
<div class="col-lg-6 col-xl-7">

    <div class="accordion profile-accordion" id="profilAccordion">

        {{-- =========================
            SEJARAH
        ========================== --}}
        <div class="accordion-item">

            <h2 class="accordion-header">

                <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#sejarah"
                    aria-expanded="true">

                    <span class="accordion-icon history">
    <i class="bi bi-clock-history"></i>
</span>

<span>Sejarah Kelurahan</span>

                </button>

            </h2>

            <div
                id="sejarah"
                class="accordion-collapse collapse show"
                data-bs-parent="#profilAccordion">

                <div class="accordion-body">

                   <div class="sejarah-content">

    <p>
        Kelurahan Bongki merupakan salah satu kelurahan yang berada di wilayah
        Kecamatan Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan.
    </p>


    <p>
        Seiring dengan perkembangan wilayah dan pertumbuhan penduduk,
        Kelurahan Bongki terus mengalami perubahan baik dari aspek pemerintahan
        maupun pelayanan kepada masyarakat.
    </p>


    <p>
        Pada awalnya Kelurahan Bongki terdiri atas dua lingkungan, yaitu
        Lingkungan Paruntu dan Lingkungan Benteng.
    </p>


    <div class="sejarah-tahun">

        <h5>
            Pemekaran Wilayah Tahun 2002
        </h5>


        <p>
            Pada tahun 2002 dilakukan pemekaran wilayah berdasarkan
            Surat Keputusan Camat Sinjai Utara Nomor 01/I/2002/SUT
            tanggal 7 Januari 2002 sehingga terbentuk empat lingkungan:
        </p>


        <ul class="profile-list">

            <li>Lingkungan Paruntu</li>

            <li>Lingkungan Popanda</li>

            <li>Lingkungan Benteng</li>

            <li>Lingkungan Samaenre</li>

        </ul>

    </div>


    <p>
        Pemekaran tersebut bertujuan meningkatkan efektivitas penyelenggaraan
        pemerintahan, pelayanan publik, dan pembangunan sehingga Kelurahan Bongki
        terus berkembang menjadi salah satu pusat pelayanan masyarakat di
        Kecamatan Sinjai Utara.
    </p>


</div>

                </div>

            </div>

        </div>

        {{-- =========================
            VISI MISI
        ========================== --}}
        <div class="accordion-item">

            <h2 class="accordion-header">

                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#visi">

                    <span class="accordion-icon vision">
    <i class="bi bi-bullseye"></i>
</span>

<span>Visi &amp; Misi</span>
                </button>

            </h2>

            <div
                id="visi"
                class="accordion-collapse collapse"
                data-bs-parent="#profilAccordion">

                <div class="accordion-body">

                  <div class="visi-misi-wrapper">

    <div class="visi-box">

        <h5>Visi</h5>

        <p>
            "Terwujudnya Kelurahan Bongki yang Maju, Mandiri, Sejahtera,
            Religius, dan Berbasis Pelayanan Publik Digital."
        </p>

    </div>


    <div class="misi-box">

        <h5>Misi</h5>

        <ol class="misi-list">

            <li>
                Meningkatkan kualitas pelayanan publik yang cepat, mudah, dan transparan.
            </li>

            <li>
                Mewujudkan tata kelola pemerintahan yang profesional dan akuntabel.
            </li>

            <li>
                Mendorong partisipasi masyarakat dalam pembangunan.
            </li>

            <li>
                Mengembangkan potensi ekonomi masyarakat berbasis sumber daya lokal.
            </li>

            <li>
                Meningkatkan kualitas lingkungan yang bersih, sehat, dan nyaman.
            </li>

            <li>
                Memanfaatkan teknologi informasi dalam pelayanan pemerintahan.
            </li>

        </ol>

    </div>

</div>

                </div>

            </div>

        </div>

        {{-- =========================
            MONOGRAFI
        ========================== --}}
        <div class="accordion-item">

            <h2 class="accordion-header">

                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#monografi">

                    <span class="accordion-icon mono">
    <i class="bi bi-bar-chart-line"></i>
</span>

<span>Monografi Kelurahan</span>
                </button>

            </h2>

            <div
                id="monografi"
                class="accordion-collapse collapse"
                data-bs-parent="#profilAccordion">

                <div class="accordion-body">

                    <div class="monografi-wrapper">

    <div class="monografi-item">
        <h5>Gambaran Umum</h5>
        <p>
            Kelurahan Bongki merupakan salah satu kelurahan di Kecamatan Sinjai Utara
            yang berkomitmen memberikan pelayanan publik yang profesional dan
            berorientasi pada kepuasan masyarakat.
        </p>
    </div>


    <div class="monografi-item">
        <h5>Kondisi Geografis</h5>
        <p>
            Memiliki lokasi strategis yang mudah dijangkau dari pusat pemerintahan,
            pendidikan, kesehatan, dan perdagangan.
        </p>
    </div>


    <div class="monografi-item">
        <h5>Topografi</h5>
        <p>
            Wilayah didominasi dataran rendah yang mendukung perkembangan kawasan
            permukiman dan aktivitas ekonomi masyarakat.
        </p>
    </div>


    <div class="monografi-item">
        <h5>Kependudukan</h5>
        <p>
            Data kependudukan terus diperbarui sebagai dasar pelayanan administrasi
            dan pembangunan.
        </p>
    </div>


    <div class="monografi-item">
        <h5>Sarana dan Prasarana</h5>
        <p>
            Tersedia kantor kelurahan, fasilitas pendidikan, kesehatan, tempat ibadah,
            jaringan jalan serta fasilitas umum lainnya.
        </p>
    </div>


    <div class="monografi-item">
        <h5>Potensi Wilayah</h5>
        <p>
            Memiliki potensi pada sektor perdagangan, jasa, UMKM, dan sumber daya
            manusia yang aktif dalam pembangunan.
        </p>
    </div>

</div>
          </div> {{-- accordion-body --}}

        </div> {{-- accordion-collapse monografi --}}

    </div> {{-- accordion-item monografi --}}



        {{-- =========================
            BATAS WILAYAH
        ========================== --}}
        <div class="accordion-item">

            <h2 class="accordion-header">

                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#batas">

                    <span class="accordion-icon border">
    <i class="bi bi-geo-alt"></i>
</span>

<span>Batas Wilayah</span>

                </button>

            </h2>

            <div
                id="batas"
                class="accordion-collapse collapse"
                data-bs-parent="#profilAccordion">

                <div class="accordion-body">

                    {!! $halamanProfil['batas-wilayah']->isi ??
                    '
                    <div class="profile-boundary">

                       <div class="batas-wilayah">

    <div class="wilayah-row">
        <span class="wilayah-label">Utara</span>
        <span class="wilayah-colon">:</span>
        <span>Kabupaten Bone</span>
    </div>

    <div class="wilayah-row">
        <span class="wilayah-label">Selatan</span>
        <span class="wilayah-colon">:</span>
        <span>Kelurahan Biringere</span>
    </div>

    <div class="wilayah-row">
        <span class="wilayah-label">Timur</span>
        <span class="wilayah-colon">:</span>
        <span>Kelurahan Balangnipa</span>
    </div>

    <div class="wilayah-row">
        <span class="wilayah-label">Barat</span>
        <span class="wilayah-colon">:</span>
        <span>Kelurahan Lamatti Rilau</span>
    </div>

</div>
                    '
                    !!}

                </div>

            </div>

        </div>

    </div>

</div>


        </div>

        

</section>