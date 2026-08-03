# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed
- **Model JenisSurat**: Menambahkan mutator `setTemplateAttribute` pada model `JenisSurat` untuk mencegah error perkuerian kolom `template` yang telah dihapus di basis data saat mengeksekusi `updateOrCreate` / `create`.
- **Autoloader Composer**: Menggenerasi dan meregenerasi autoloader `vendor/composer` lengkap agar server cPanel yang mengandalkan folder `vendor` dari repositori Git dapat menjalankan Artisan tanpa error classmap.
- **FontAwesome CDN**: Mengonversi pustaka FontAwesome ke CDN untuk menghindari error 404 font `.woff2` pada penempatan subfolder server cPanel.
- **Pelacakan Git Aset Build**: Menghapus `/public/build` dari `.gitignore` agar folder `public/build` beserta isinya ikut ter-commit & ter-push ke GitHub untuk kemudahan deployment cPanel.

### Added
- **Fitur Otentikasi Login Username / Email**: Mendukung login dengan username (`bongki`) atau email.
- **Favicon & Logo Resmi**: Integrasi `images/sinjai.png` sebagai logo & favicon di seluruh halaman public, login, dan admin.
- **Seeder Data Riil**: Integrasi 13 data Penduduk, Kartu Keluarga, Pejabat Kelurahan, dan CMS dari `sipbongki.sql` ke `InitialDataSeeder.php`.

### Changed
- **Pembersihan CSS Kustom Admin & Auth**: Menghapus `admin.css` & `auth.css` lama dan mengonversi 100% tampilan admin, login, navbar, dan sidebar menggunakan **murni kelas Bootstrap 5.3**.
- **Perapihan Dashboard Admin**: Redesain Hero card, Stat card, Quick Access card, dan tabel statistik lingkungan.
- **Standarisasi Singkatan Sistem**: Menyelaraskan seluruh teks publik dan admin menjadi **SIP = Sistem Informasi dan Pelayanan Kelurahan Bongki**.

## [0.1.0] — 2026-07-26

### Added
- Inisialisasi Git repository lokal dan persiapan deployment ke cPanel.
- Fitur Kependudukan & Kartu Keluarga (KK).
- Fitur Pelayanan & Permohonan Surat (PDF).
- Fitur CMS Website (Berita, Agenda, Galeri, Halaman, Pengaturan Website).
- `InitialDataSeeder` untuk menyelaraskan data awal dari `sipbongki.sql`.

### Fixed
- Penyelarasan kolom skema migrasi Laravel (`dapat_menandatangani`, `template_view`, `kode_surat`, `kode_nomor`) agar aman saat di-migrate pada server cPanel.
