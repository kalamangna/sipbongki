# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Inisialisasi Git repository lokal dan persiapan deployment ke cPanel.
- Fitur Kependudukan & Kartu Keluarga (KK).
- Fitur Pelayanan & Permohonan Surat (PDF).
- Fitur CMS Website (Berita, Agenda, Galeri, Halaman, Pengaturan Website).
- `InitialDataSeeder` untuk menyelaraskan data awal dari `sipbongki.sql`.

### Fixed
- Penyelarasan kolom skema migrasi Laravel (`dapat_menandatangani`, `template_view`, `kode_surat`, `kode_nomor`) agar aman saat di-migrate pada server cPanel.
