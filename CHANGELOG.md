# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- **Tata Naskah Dinas (Kop Surat & Tipografi)**: Menyempurnakan Kop Surat Kelurahan Bongki sesuai standar Tata Naskah Dinas Permendagri No. 1 Tahun 2023 menggunakan layout 3 kolom (*balanced centering*), memperbesar ukuran logo instansi, serta menambahkan spasi (*margin-top*) proporsional di atas nama jenis surat.
- **Tata Naskah Dinas (Logika Penandatangan)**: Mengimplementasikan deteksi otomatis penandatanganan surat sesuai kaidah hukum administrasi dan tata naskah dinas untuk status Lurah Definitif (`LURAH BONGKI,`), Plt./Plh. Lurah (`Plt. LURAH BONGKI,`), serta pendelegasian Atas Nama (`a.n. LURAH BONGKI` disertai baris nama jabatan struktural penerima mandat seperti Sekretaris Lurah / Kasi).
- **Template Persuratan**: Menambahkan kalimat pengantar resmi *"Menerangkan dengan sesungguhnya bahwa :"* pada template Surat Keterangan Domisili dan melengkapi berkas template standar Surat Keterangan Belum Memiliki Rumah (`belum-punya-rumah.blade.php`).
- **SEO & Search Engine Indexing**: Menambahkan rute dan template XML Sitemap dinamis (`/sitemap.xml`) untuk mengindeks halaman beranda, layanan, pengaduan, berita, dan pengumuman secara real-time serta mendaftarkannya pada `public/robots.txt`.
- **SEO (Structured Data / JSON-LD)**: Menyematkan rich snippet Schema.org `NewsArticle` pada Detail Berita dan `Article` pada Detail Pengumuman lengkap dengan tanggal publikasi, gambar cover, dan identitas penerbit (*publisher*).
- **Fitur (Pelayanan Publik - Auto-Fill Dinamis)**: Mengembangkan fungsionalitas tombol Auto-Fill developer agar bekerja per-langkah (*step-by-step*) sesuai konteks jenis surat (Domisili, Usaha, Kematian, Orang Sama) dan menyematkan dummy upload berkas otomatis menggunakan file gambar `meta.png` via API `DataTransfer`.
- **Fitur (Pelayanan Publik - Pelacakan Status)**: Memindahkan tombol "Cek Status Permohonan" ke posisi utama di Hero Section dengan modal input nomor permohonan yang interaktif, validasi wajib, dan feedback visual yang jelas.
- **Arsitektur (Template Cetak Surat)**: Mengimplementasikan resolusi otomatis template view cetak surat berdasarkan kode surat (`TemplateSuratService`), menghilangkan keharusan konfigurasi manual `template_view` di database.
- **Fitur (Admin - Detail Permohonan)**: Menambahkan badge pembeda kategori pemohon yang konsisten ("Penduduk Bongki" vs "Penduduk Luar Bongki") dan menyembunyikan baris isian kosong bertanda strip (-) agar tampilan rincian penduduk luar daerah menjadi ringkas dan bersih.
- **Perbaikan (Admin - Detail Permohonan)**: Menyelaraskan tampilan jenis huruf pada kolom NIK dan Nomor KK agar konsisten menggunakan format *monospace*.
- **Perbaikan (Admin - Detail Permohonan)**: Memperbaiki tata letak pemilihan Pejabat Penandatangan dengan menghilangkan keterangan jabatan yang terlalu panjang dari dalam *dropdown* (untuk menghindari terpotong) dan menampilkannya sebagai kotak informasi khusus di bawah *dropdown*.
- **Perbaikan (Admin - Dasbor)**: Menyelaraskan warna *badge* status permohonan dengan skema warna utama aplikasi dan memastikan kompatibilitas pemuatan nama Pemohon Luar Bongki (manual) pada tabel Permohonan Terbaru.
- **Perbaikan (Admin - Dasbor)**: Menambahkan konfigurasi *distributed colors* pada *ApexCharts* (Grafik Statistik Pelayanan) agar tiap-tiap status (Menunggu, Diproses, dll) memiliki warna representatifnya sendiri alih-alih warna tunggal seragam.
- **Fitur (Admin - Permohonan Surat)**: Menambahkan filter *dropdown* Kategori Pemohon ("Penduduk Bongki" / "Penduduk Luar") pada halaman daftar riwayat persuratan.
- **Fitur (Admin - Penandatangan)**: Menambahkan fitur pemilihan langsung Pejabat Penandatangan melalui *dropdown* interaktif (menyimpan data otomatis) pada *card* "Aksi & Status" di halaman Detail Permohonan, memangkas keharusan membuka menu Edit keseluruhan.
- **Keamanan (Proteksi Spam)**: Menambahkan implementasi *Rate Limiting* (throttle middleware) pada formulir publik (Permohonan Surat dan Pengaduan) serta fitur *lookup* untuk memblokir eksploitasi dan serangan otomatis (*bot spam/brute force*).
- **Fitur (Pelayanan)**: Menambahkan dukungan pengisian formulir layanan secara manual bagi pemohon yang belum terdaftar di database kependudukan, dengan field `manual_` pada `data_surat` dan metode akses dinamis `pemohon`.

### Changed
- **Formulir Layanan Publik (Email)**: Mengubah input email pada formulir layanan permohonan publik menjadi opsional (*optional*) serta menyelaraskan validasi frontend JavaScript step validation dan backend Laravel validation.
- **Template Surat (Tata Letak & Tipografi)**: Memperbaiki aturan CSS perataan vertikal baris tabel surat (`table td` dan `.no-border td` `vertical-align: top`) agar alamat yang memanjang menjadi 2 baris atau lebih tidak mengalami perataan tengah secara vertikal (*center vertical*).
- **Template Surat (Format Data)**: Menstandarisasi penulisan nama usaha menjadi huruf kapital (**UPPERCASE**) pada template Surat Keterangan Usaha dan merapikan struktur indentasi seluruh berkas template surat.
- **Template Surat (Perbaikan Sintaks)**: Memperbaiki referensi layout `@extends('surat.layouts.surat')` dan membersihkan duplikasi kop surat pada template Surat Keterangan Pindah (`pindah.blade.php`).
- **Keamanan & Stabilitas (Rate Limiting & Lookup NIK)**: Menyesuaikan batas *rate limiting* pencarian NIK publik menjadi 30 request/menit serta pengiriman form menjadi 10 request/menit untuk mencegah pemblokiran HTTP 429 yang prematur saat pengujian/pengisian formulir.
- **UI/UX (Layanan Publik - Error Handling Lookup)**: Menyempurnakan mekanisme *fetch* lookup NIK dengan header `Accept: application/json`, token CSRF dinamis, serta pesan penanganan kesalahan yang presisi dan ramah pengguna untuk status HTTP 429 (Too Many Requests) dan 419 (Page Expired).
- **SEO & Metadata**: Mengoptimalkan komponen `<x-seo-meta />` agar secara otomatis menyusun meta title, description, dan Open Graph langsung dari data identitas `WebsiteSetting` secara dinamis.
- **UI/UX (Admin - Pengaturan Website)**: Merapikan form Pengaturan Website menjadi khusus "Visibilitas Section Publik" dan menghapus input SEO manual yang redundan.
- **Kebersihan Kode (Routes & Robots)**: Menghapus impor controller `Operator` yang tidak terpakai dari `routes/web.php` dan membersihkan direktif `Disallow: /operator/` pada `public/robots.txt`.
- **UI/UX (Pelayanan Publik - Penduduk Luar Bongki)**: Menyembunyikan field `agama`, `rt`, dan `rw` pada formulir Langkah 2 untuk pemohon luar daerah serta menyesuaikan validasi backend menjadi `nullable` pada permohonan Domisili dan Usaha.
- **UI/UX (Admin - Detail Permohonan)**: Memindahkan informasi **Jenis Surat** ke baris paling atas rincian permohonan surat bersanding dengan **Tanggal Permohonan**.
- **UI/UX & Formulir**: Menstandarisasi seluruh format penulisan *placeholder* panduan (`placeholder="Contoh: ..."`) pada seluruh modul form admin dan referensi.
- **Arsitektur (Tailwind CSS v4)**: Menghapus berkas usang `tailwind.config.js` dan memusatkan seluruh konfigurasi token `@theme`, `@source`, dan `@plugin` ke dalam berkas CSS aktif.

### Removed
- **Aset (Legacy/Typo)**: Menghapus berkas typo kosong `resources/views/surat/layouts/sur at.blade.php`.
- **Aset (Legacy CSS)**: Menghapus 4 berkas CSS lama yang tidak terpakai (`resources/css/admin.css`, `resources/css/public.css`, `resources/css/struktur.css`, `resources/css/surat.css`) sehingga direktori `resources/css/` hanya memuat 2 berkas aktif (`app.css` dan `frontend.css`).
- **Formulir (Referensi Jenis Surat & Pengaturan)**: Menghapus input `template_view` pada jenis surat serta input SEO manual pada pengaturan website.
- **UI/UX (Form Layanan Publik)**: Merombak alur pengisian pada Langkah 1 dengan memisahkan tombol "Cari NIK" secara eksplisit. Hasil pencarian NIK (baik ditemukan maupun tidak terdaftar) kini tampil langsung sebagai kotak informasi ramah di bawah isian form tanpa menggunakan standar pesan error validasi input merah (sehingga terasa lebih komunikatif dan ramah).
- **UI/UX (Form Layanan Publik)**: Menciptakan fungsionalitas *smart step skipping* (Lompatan Langkah Cerdas). Apabila NIK pemohon ditemukan (yang berarti Langkah 2 verifikasi manual tidak diperlukan), sistem akan langsung melompati Langkah 2. Menariknya, sistem secara cerdas akan mengkalkulasi ulang *progress bar*, nomor langkah, dan teks tombol secara *real-time* sehingga warga tidak pernah merasa "kehilangan langkah" (total langkah dinamis berubah dari 5 menjadi 4).
- **UI/UX (Form Layanan Publik)**: Menonaktifkan fungsionalitas tombol *Enter* di *keyboard* saat berada di dalam formulir agar warga tidak secara tidak sengaja melompati atau men-submit formulir secara prematur.
- **UI/UX (Form Layanan Publik)**: Membuat form Isian Data Manual (Langkah 2) jauh lebih cerdas. Apabila pendaftar memilih opsi "Penduduk Luar Bongki", sistem akan secara otomatis menyembunyikan dan membebaskan kewajiban mengisi (*unrequire*) kolom `Lingkungan`, `Status Perkawinan`, dan `Pendidikan`, serta memperjelas label kotak isian `Alamat` menjadi "Alamat Lengkap (Sertakan Desa/Kel, Kec, Kab)". Hal ini mencegah kebingungan warga luar yang dipaksa memilih wilayah Lingkungan internal desa.
- **UI/UX (Pengaduan & Pelayanan)**: Menyeragamkan gaya pesan *error* validasi Langkah 1 formulir (termasuk fitur *autofocus*) agar selaras secara absolut dengan Langkah 2, serta membersihkan masalah "garis tepi berbayang ganda" yang ditimbulkan oleh sisa *class* CSS bawaan Tailwind.
- **UI/UX (Pelayanan)**: Menyulap teks judul "Langkah 3" dan "Langkah 4" pada formulir permohonan publik menjadi dinamis dan cerdas sesuai jenis surat yang dipilih pendaftar (tidak lagi statis terpaku pada 'Surat Keterangan Domisili'). Selain itu, sistem kini secara pintar akan menyembunyikan kotak isian spesifik (seperti 'Status Tempat Tinggal') jika surat yang diajukan bukan surat berjenis domisili.
- **UI/UX (Public)**: Merestrukturisasi antarmuka seksi Hero pada beranda publik agar patuh sepenuhnya pada `DESIGN.md` (menghilangkan elemen dekoratif tanpa makna, menyisipkan deskripsi yang terlewat, dan menyempurnakan indikator *focus* untuk aksesibilitas *keyboard*).
- **Fitur (Pelayanan)**: Mengubah logika publik pembuatan permohonan surat sehingga data `Penduduk` (warga) baru dengan status "belum terverifikasi" hanya dibuat secara otomatis jika pendaftar secara eksplisit memilih opsi identitas warga lokal (Bongki).
- **Surat (Template)**: Memperbarui seluruh templat cetak surat (Domisili, Usaha, Kematian, Belum Menikah, Tidak Mampu, Pindah, dll.) agar menggunakan objek data `pemohon` (menggabungkan data penduduk terdaftar atau data manual) daripada langsung mengakses relasi `penduduk`.
- **UI/UX (Admin)**: Mengoptimalkan dan menambah ragam opsi filter (pencarian) pada halaman indeks daftar Penduduk (Status Aktif), Pengaduan (Kategori dan Status), dan Permohonan Surat (Jenis Surat dan Status).
- **UI/UX (Public)**: Memperbaiki konflik *class* responsif pada section Hero dan menyelaraskan ukuran tombol utamanya.
- **UI/UX (Public)**: Merapikan padding dan perataan ikon pada tombol menu "Masuk/Dashboard" di versi layar kecil (Mobile Navbar).
- **UI/UX (Public)**: Merombak total tata letak halaman Detail Berita dan Detail Pengumuman menjadi *grid* 2 kolom dengan *sticky sidebar* daftar artikel terbaru, penyesuaian rasio gambar *aspect-video*, dan menyematkan integrasi tombol bagikan (*share*).
- **UI/UX (Admin)**: Merapikan tag `<title>` dan *header* halaman (`<h2>`/`<h3>`) pada seluruh modul (Kependudukan, Pelayanan, Pengaturan, Website) agar selaras secara absolut dengan penamaan menu *sidebar*.
- **UI/UX (Admin)**: Melakukan audit menyeluruh dan menambahkan atribut *placeholder* pada setiap isian form (seperti di modul Referensi, Laporan, dan Pengaduan) yang belum memilikinya.
- **UI/UX (Pelayanan)**: Mengubah desain halaman indeks dan formulir (Create/Edit) `Permohonan Surat` serta `Riwayat Pelayanan` agar mengikuti standar gaya komponen Tailwind yang bersih dan responsif, tanpa ketergantungan pada *class* Bootstrap.
- **UI/UX (Pelayanan)**: Merestrukturisasi tampilan Detail Permohonan Surat (`show` dan semua *partial* di dalamnya) agar memiliki struktur layout (Grid, Icon Header, Label/Data) yang presisi dan konsisten dengan halaman Detail Penduduk.
- **Fitur (Pelayanan)**: Menambahkan fungsionalitas di mana pada pembuatan permohonan surat baru (tanpa *pejabat penandatangan* yang terisi sebelumnya), pilihan *default dropdown* akan secara otomatis mengarah pada perangkat kelurahan yang menjabat sebagai "Lurah".
- **UI/UX (Manajemen Data)**: Menyembunyikan/menghilangkan tombol "Edit" dan "Hapus" dari tampilan tabel indeks utama (Data Penduduk, Kartu Keluarga, Perangkat Kelurahan, Permohonan Surat), membatasi akses pada tombol "Lihat" saja, dengan aksi edit/hapus tetap dapat dilakukan di dalam halaman detail.
- **UI/UX (Pengaturan)**: Menyelaraskan *style* tabel dan *filter* pencarian pada manajemen Pengguna agar identik dan konsisten dengan modul Kependudukan.
- **UI/UX (Pengaturan)**: Merombak tata letak form Tambah & Edit Pengguna menjadi lebih bersih, melengkapi label *placeholder*, dan merapikan teks menu peran (role).
- **UI/UX (Dasbor Admin)**: Menyeragamkan seluruh tombol "Reset Filter" di seluruh halaman dasbor menggunakan satu ikon rotasi tanpa teks yang redundan.
- **Arsitektur (Akses Dasbor)**: Mengkonsolidasikan seluruh dasbor ke satu *route* (`admin.dashboard`) untuk semua tingkat akses, dan menampilkan/menyembunyikan menu pintasan (*quick links*) secara dinamis berdasarkan otorisasi peran pengguna.
- **Database (Role Akses)**: Menghapus peran `warga` dan memformalkan peran `pimpinan` pada struktur tipe data ENUM kolom `role` di tabel `users`.
- **UI/UX (General)**: Menambahkan logo aplikasi sebagai `favicon` global dan menyederhanakan *page title* di *tab browser* agar tidak redundan.
- **UI/UX (Admin Dashboard)**: Merombak tata letak Dasbor Admin menjadi gaya premium Tailwind v4 dengan bayangan halus, panel melengkung besar, dan jarak putih (whitespace) yang lebih bersih.
- **UI/UX (Navbar)**: Menyederhanakan teks Navbar admin agar tidak terlalu ramai dan terlihat lebih profesional.
- **UI/UX (Paginasi)**: Merombak komponen paginasi bawaan Tailwind Laravel (`vendor/pagination`) agar selaras dengan tema UI baru serta menerjemahkan label bahasa Inggris ("Previous/Next") ke dalam bahasa Indonesia ("Sebelumnya/Selanjutnya").
- **UI/UX (Kependudukan)**: Merombak total seluruh antarmuka (Index, Create, Edit, Show) pada modul **Penduduk**, **Kartu Keluarga**, dan **Perangkat Kelurahan** menjadi form bertata letak Grid responsif yang bersih, tombol aksi sejajar di kanan, dan elemen visual modern.
- **UI/UX**: Menambahkan teks bayangan panduan (*placeholder*) yang informatif pada setiap kotak isian di form Penduduk, KK, dan Perangkat.
- **UI/UX**: Mengganti font bawaan dari "Plus Jakarta Sans" menjadi "Inter" untuk seluruh antarmuka (publik & admin).
- **UI/UX**: Menyederhanakan tampilan halaman beranda dengan menghapus teks deskripsi paragraf yang berlebihan di bagian Hero, Alur Pelayanan, dan setiap judul section.
- **Icons**: Migrasi penuh dari Heroicons ke Font Awesome 6 di seluruh aplikasi (Navbar, Sidebar, Public Layout, dll).

### Removed
- **Fitur (Website)**: Menghapus modul Halaman secara keseluruhan (tabel, *model*, *route*, *controller*, *views*) serta referensinya di *sidebar* untuk menyederhanakan fitur.
- **Dependencies**: Menghapus package `blade-ui-kit/blade-heroicons` karena sudah sepenuhnya menggunakan Font Awesome via CDN.

### Fixed
- **Bugfix (Admin - Detail Permohonan)**: Menambal celah kesalahan sistem dalam menarik data *Nomor Kartu Keluarga* pada halaman riwayat/detail, khusus untuk pemohon tipe "Penduduk Eksisting" (kini sukses ditarik melalui relasi yang tepat menggunakan pembantu `data_get`).
- **Bugfix (Backend - Permohonan)**: Memperbaiki kesalahan fatal pada alur pengajuan *Surat Keterangan Umum/Lainnya* di dalam kontroler, di mana sistem sebelumnya benar-benar melompati (melewatkan) blok kode yang bertugas menyimpan dokumen unggahan pendukung (KTP/KK) ke dalam *database* dan *storage*.
- **Keamanan (Backend - Permohonan)**: Menyuntikkan aturan validasi unggahan yang ketat (format file dan limit maksimal 2MB) pada seluruh form permohonan. Ini mencegah formulir lolos secara diam-diam (*silent fail*)—yang berujung pada dokumen "kosong" di halaman admin—ketika batas `upload_max_filesize` server PHP terlampaui.
- **Database/Seeder**: Memperbarui ikon default di `JenisSuratSeeder` agar kompatibel dengan Font Awesome (`fa-solid fa-house`, `fa-solid fa-heart`).
- **Layanan**: Memperbaiki render variabel ikon dinamis pada card layanan yang sebelumnya hilang.
- **Bugfix (Pelayanan Publik - Pencarian NIK)**: Memperbaiki kesalahan fatal *JSON parsing* di *browser* (pesan: "Terjadi kesalahan format respon server") saat sesi token kedaluwarsa atau *rate-limit* terlampaui. Penyelesaiannya meliputi penambahan *header* `X-Requested-With: XMLHttpRequest` (memaksa server mengembalikan JSON yang benar) serta validasi sisi-klien untuk mencegat NIK dicari sebelum kolom Jenis Surat terisi.
