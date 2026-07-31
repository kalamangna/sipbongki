<section id="profil" class="profil-section py-5 fade-up">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-badge">
                Profil Kelurahan
            </span>

            <p class="section-description">
            Sejarah, visi misi, monografi, dan informasi umum Kelurahan Bongki sebagai pusat pelayanan pemerintahan dan pemberdayaan masyarakat.
        </p>

        </div>

        <div class="row g-5 align-items-start">

            {{-- PROFIL --}}
            <div class="col-lg-6">

                <div class="profile-card">

                    @if(isset($halamanProfil['profil-kelurahan']) && $halamanProfil['profil-kelurahan']->gambar)

                        <img
                            src="{{ asset('storage/'.$halamanProfil['profil-kelurahan']->gambar) }}"
                            class="profile-image"
                            alt="{{ $halamanProfil['profil-kelurahan']->judul }}">

                    @endif

                    <div class="p-4">

                        <h3>

                            {{ $halamanProfil['profil-kelurahan']->judul ?? 'Profil Kelurahan Bongki' }}

                        </h3>

                        <div class="profile-content">

                            {!! $halamanProfil['profil-kelurahan']->isi ?? '<p>Kelurahan Bongki merupakan salah satu kelurahan yang berada di Kecamatan Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan. Kelurahan ini memiliki peran penting sebagai wilayah pelayanan pemerintahan, pembangunan, dan pemberdayaan masyarakat.

Dengan luas wilayah sekitar 4,81 km², Kelurahan Bongki terdiri atas empat lingkungan, yaitu Paruntu, Popanda, Benteng, dan Samaenre. Pemerintah Kelurahan Bongki berkomitmen memberikan pelayanan publik yang cepat, transparan, dan akuntabel melalui inovasi pelayanan berbasis digital, termasuk SIPBongki (Sistem Informasi dan Pelayanan Masyarakat Kelurahan Bongki).

Berbagai program pembangunan, pelayanan administrasi kependudukan, pemberdayaan masyarakat, serta pembinaan ketentraman dan ketertiban terus dilaksanakan demi mewujudkan masyarakat yang maju, mandiri, dan sejahtera.</p>' !!}

                        </div>

                    </div>

                </div>

            </div>

            {{-- ACCORDION --}}
            <div class="col-lg-6">

                <div class="accordion accordion-flush profile-accordion" id="profilAccordion">

                    {{-- SEJARAH --}}
                    <div class="accordion-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button"
                                data-bs-toggle="collapse"
                                data-bs-target="#sejarah">

                                Sejarah Kelurahan

                            </button>

                        </h2>

                        <div
                            id="sejarah"
                            class="accordion-collapse collapse show"
                            data-bs-parent="#profilAccordion">

                            <div class="accordion-body">

                                {!! $halamanProfil['sejarah']->isi ?? 'Kelurahan Bongki merupakan salah satu kelurahan yang berada di wilayah Kecamatan Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan. Seiring dengan perkembangan wilayah dan pertumbuhan penduduk, Kelurahan Bongki terus mengalami perubahan baik dari aspek pemerintahan maupun pelayanan kepada masyarakat.

Pada awalnya Kelurahan Bongki terdiri atas dua lingkungan, yaitu Lingkungan Paruntu dan Lingkungan Benteng. Seiring meningkatnya jumlah penduduk dan kebutuhan pelayanan pemerintahan, pada tahun 2002 dilakukan pemekaran wilayah berdasarkan Surat Keputusan Camat Sinjai Utara Nomor 01/I/2002/SUT tanggal 7 Januari 2002 sehingga terbentuk empat lingkungan, yaitu:

Lingkungan Paruntu
Lingkungan Popanda
Lingkungan Benteng
Lingkungan Samaenre

Pemekaran tersebut bertujuan meningkatkan efektivitas penyelenggaraan pemerintahan, pelayanan publik, dan pembangunan di tingkat kelurahan. Hingga saat ini Kelurahan Bongki terus berkembang sebagai salah satu pusat aktivitas pemerintahan, perdagangan, pendidikan, dan pelayanan masyarakat di Kecamatan Sinjai Utara.' !!}

                            </div>

                        </div>

                    </div>

                    {{-- VISI MISI --}}
                    <div class="accordion-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#visi">

                                Visi & Misi

                            </button>

                        </h2>

                        <div
                            id="visi"
                            class="accordion-collapse collapse"
                            data-bs-parent="#profilAccordion">

                            <div class="accordion-body">

                                {!! $halamanProfil['visi-misi']->isi ?? 'Visi :

"Terwujudnya Kelurahan Bongki yang Maju, Mandiri, Sejahtera, Religius, dan Berbasis Pelayanan Publik Digital."

<p> Misi :<p>
1. Meningkatkan kualitas pelayanan publik yang cepat, mudah, dan transparan.<p>
2. Mewujudkan tata kelola pemerintahan yang profesional dan akuntabel.<p>
3. Mendorong partisipasi masyarakat dalam pembangunan.<p>
4. Mengembangkan potensi ekonomi masyarakat berbasis sumber daya lokal.<p>
5. Meningkatkan kualitas lingkungan yang bersih, sehat, dan nyaman.<p>
6. Memanfaatkan teknologi informasi dalam pelayanan pemerintahan.' !!}

                            </div>

                        </div>

                    </div>

                    {{-- MONOGRAFI --}}
                    <div class="accordion-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#monografi">

                                Monografi

                            </button>

                        </h2>

                        <div
                            id="monografi"
                            class="accordion-collapse collapse"
                            data-bs-parent="#profilAccordion">

                            <div class="accordion-body">

                                {!! $halamanProfil['monografi']->isi ?? '📊 Gambaran Umum :<p>

Kelurahan Bongki merupakan salah satu kelurahan di Kecamatan Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan. Sebagai wilayah pemerintahan yang berada di kawasan perkotaan, Kelurahan Bongki berkomitmen memberikan pelayanan publik yang cepat, transparan, dan profesional serta mendukung pembangunan yang berkelanjutan demi meningkatkan kesejahteraan masyarakat.<p>

🌍 Kondisi Geografis :<p>

Kelurahan Bongki berada di wilayah Kecamatan Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan. Wilayah ini memiliki letak yang strategis dengan akses yang mudah menuju pusat pemerintahan, pendidikan, kesehatan, perdagangan, dan berbagai fasilitas pelayanan masyarakat.<p>

🏞️ Topografi :<p>

Secara umum, Kelurahan Bongki memiliki kondisi topografi berupa dataran rendah dengan permukaan tanah yang relatif landai. Kondisi tersebut mendukung perkembangan kawasan permukiman, kegiatan ekonomi, serta penyelenggaraan pelayanan publik dan pembangunan wilayah.<p>

👨‍👩‍👧‍👦 Kependudukan :<p>

Kelurahan Bongki dihuni oleh masyarakat yang beragam dan hidup dalam suasana yang rukun serta menjunjung tinggi nilai gotong royong. Data kependudukan meliputi jumlah penduduk, kepala keluarga, jenis kelamin, dan kelompok umur yang diperbarui secara berkala sebagai dasar penyelenggaraan pelayanan administrasi kependudukan.<p>

🏫 Sarana dan Prasarana :<p>

Kelurahan Bongki didukung oleh berbagai sarana dan prasarana yang menunjang aktivitas masyarakat, seperti kantor kelurahan, fasilitas pendidikan, tempat ibadah, fasilitas kesehatan, jaringan jalan, serta fasilitas umum lainnya yang mendukung pelayanan dan pembangunan wilayah.<p>

🌱 Potensi Wilayah :<p>

Kelurahan Bongki memiliki potensi di berbagai bidang, antara lain perdagangan, usaha mikro, kecil, dan menengah (UMKM), jasa, serta sumber daya manusia yang aktif dalam kegiatan sosial dan pembangunan. Potensi tersebut menjadi modal penting dalam mendukung pertumbuhan ekonomi dan peningkatan kesejahteraan masyarakat.' !!}

                            </div>

                        </div>

                    </div>

                    {{-- BATAS WILAYAH --}}
                    <div class="accordion-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#batas">

                                Batas Wilayah

                            </button>

                        </h2>

                        <div
                            id="batas"
                            class="accordion-collapse collapse"
                            data-bs-parent="#profilAccordion">

                            <div class="accordion-body">

                                {!! $halamanProfil['batas-wilayah']->isi ?? 'Kelurahan Bongki memiliki batas wilayah sebagai berikut :<p>
<p>Sebelah Utara : Kabupaten Bone<p>
Sebelah Selatan	: Kelurahan Biringere<p>
Sebelah Timur	: Kelurahan Balangnipa<p>
Sebelah Barat	:Kelurahan Lamatti Rilau' !!}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>