# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- **Modul Pengumuman**: Model `Pengumuman`, controller admin (`PengumumanController`), migrasi tabel, CRUD view admin (`index`, `show`), dan halaman publik `pengumuman-detail`.
- **Modul Pengaduan Masyarakat**: Model `Pengaduan`, controller admin (`PengaduanController`) + controller publik (`PublicPengaduanController`), migrasi tabel, CRUD view admin (`index`, `show`, `create`, `edit`), dan halaman publik `pengaduan`.
- Halaman detail berita untuk publik (`berita-detail.blade.php`).
- Route baru: `/berita/{berita}`, `/pengumuman/{slug}`, `/pengaduan` (GET + POST) di sisi publik.
- Route resource baru untuk admin: `pengaduan` dan `website.pengumuman`.
- Aset gambar baru: `kantorsatu.png` dan folder `ilustrations/` di `public/images/`.
- Sidebar & navbar admin diperbarui dengan link ke menu Pengaduan dan Pengumuman.
- Navbar & footer publik diperbarui.
- Section-section halaman publik diperbarui (hero, profil, berita, agenda, galeri, pengumuman, workflow, services, statistics, struktur, location).

### Changed
- Update `DatabaseSeeder` dan `JenisSuratSeeder`.
- Update migrasi `add_data_kematian_to_permohonan_surats_table` dan `add_jabatan_struktur_id_to_perangkats_table`.
- Update CSS: `app.css`, `admin.css`, `public.css`, `struktur.css`.
- Update layout `admin.blade.php` dan `public.blade.php`.
- Update view index pada admin website (Berita, Agenda, Galeri, Halaman).

## [0.1.0] — 2026-07-26

### Added
- Inisialisasi Git repository lokal dan persiapan deployment ke cPanel.
- Fitur Kependudukan & Kartu Keluarga (KK).
- Fitur Pelayanan & Permohonan Surat (PDF).
- Fitur CMS Website (Berita, Agenda, Galeri, Halaman, Pengaturan Website).
- `InitialDataSeeder` untuk menyelaraskan data awal dari `sipbongki.sql`.

### Fixed
- Penyelarasan kolom skema migrasi Laravel (`dapat_menandatangani`, `template_view`, `kode_surat`, `kode_nomor`) agar aman saat di-migrate pada server cPanel.
