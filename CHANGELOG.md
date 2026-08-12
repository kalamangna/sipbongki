# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed
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
- **Dependencies**: Menghapus package `blade-ui-kit/blade-heroicons` karena sudah sepenuhnya menggunakan Font Awesome via CDN.

### Fixed
- **Database/Seeder**: Memperbarui ikon default di `JenisSuratSeeder` agar kompatibel dengan Font Awesome (`fa-solid fa-house`, `fa-solid fa-heart`).
- **Layanan**: Memperbaiki render variabel ikon dinamis pada card layanan yang sebelumnya hilang.
