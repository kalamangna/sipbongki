# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed
- **UI/UX**: Mengganti font bawaan dari "Plus Jakarta Sans" menjadi "Inter" untuk seluruh antarmuka (publik & admin).
- **UI/UX**: Menyederhanakan tampilan halaman beranda dengan menghapus teks deskripsi paragraf yang berlebihan di bagian Hero, Alur Pelayanan, dan setiap judul section.
- **Icons**: Migrasi penuh dari Heroicons ke Font Awesome 6 di seluruh aplikasi (Navbar, Sidebar, Public Layout, dll).

### Removed
- **Dependencies**: Menghapus package `blade-ui-kit/blade-heroicons` karena sudah sepenuhnya menggunakan Font Awesome via CDN.

### Fixed
- **Database/Seeder**: Memperbarui ikon default di `JenisSuratSeeder` agar kompatibel dengan Font Awesome (`fa-solid fa-house`, `fa-solid fa-heart`).
- **Layanan**: Memperbaiki render variabel ikon dinamis pada card layanan yang sebelumnya hilang.
