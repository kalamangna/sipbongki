<div align="center">
  <img src="public/images/logo.png" alt="Logo Kelurahan Bongki" width="90" height="auto" style="margin-bottom: 12px;">
  <h1>SIP Bongki</h1>
  <p><strong>Sistem Informasi Pelayanan & Profil Kelurahan Bongki</strong></p>
  <p>Pemerintah Kelurahan Bongki, Kecamatan Sinjai Utara, Kabupaten Sinjai, Sulawesi Selatan</p>

  <p>
    <img src="https://img.shields.io/badge/Laravel-11%20%2F%2012-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel">
    <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js&logoColor=white" alt="Alpine.js">
    <img src="https://img.shields.io/badge/PHP-%3E%3D_8.2-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/Theme-Light_%26_Dark_Mode-059669?style=flat-square" alt="Dark Mode">
    <img src="https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square" alt="License">
  </p>
</div>

---

## 📖 Tentang Aplikasi

**SIP Bongki** adalah platform *e-Government* dan portal digital terpadu yang dirancang untuk memodernisasi tata kelola administrasi kelurahan, mempercepat pengurusan surat keterangan warga, memfasilitasi penanganan aspirasi & pengaduan masyarakat secara transparan, serta menyajikan data statistik dan profil monografi publik secara interaktif.

---

## 🌟 Fitur Unggulan

### 1. 🌓 Full Application-Wide Dark Mode
- Dukungan tema **Terang (Light)** dan **Gelap (Dark)** di seluruh modul publik, otentikasi, dan panel administrasi.
- **Anti-FOUC (*Flash of Unstyled Content*)**: Deteksi tema berbasis *inline script* di `<head>` untuk transisi instan tanpa kedipan layar.
- **Theme Switcher Toggle**: Sakelar tema interaktif pada navigasi desktop & drawer seluler yang tersimpan persisten di `localStorage`.
- Integrasi dinamis pada grafik analitik **ApexCharts** (otomatis menyesuaikan warna sumbu, grid, dan tooltip saat beralih tema).

### 2. 🏛️ Portal Layanan Publik (Warga)
- **Wizard Permohonan Surat Online (Multi-step)**:
  - *Smart NIK Lookup*: Pencarian NIK terintegrasi untuk verifikasi data kependudukan secara otomatis.
  - Alur dinamis (*Smart Step Skipping*): Otomatis menyesuaikan total langkah jika data warga terverifikasi.
  - Subform dinamis khusus jenis surat (Domisili, Usaha, Kematian, Orang Sama, dll).
  - Unggah berkas persyaratan (KTP, KK, Surat Pengantar RT/RW, Foto Usaha) dengan validasi ukuran maks 2MB dan format gambar/PDF.
  - *Real-time Tracking*: Pelacakan status permohonan mandiri menggunakan Nomor Permohonan.
- **Layanan Pengaduan Masyarakat**:
  - Formulir penyampaian aspirasi/keluhan publik dengan kategori isu, titik lokasi, uraian, dan bukti foto.
  - Pencarian tiket pengaduan (`ADU-YYYYMMDD-XXXXX`) dan pemantauan linimasa tindak lanjut aparatur kelurahan.
- **Informasi & CMS Publik**:
  - Publikasi Berita terkini, Pengumuman resmi, Agenda kegiatan, dan Galeri foto dengan *Lightbox Modal*.
  - Monografi & profil kelurahan, bagan struktur organisasi aparatur interaktif, serta peta wilayah kelurahan.
  - Visualisasi grafik demografi kependudukan interaktif (berdasarkan jenis kelamin, kelompok usia, agama, dan lingkungan).

### 3. 🛡️ Keamanan & Privasi Data
- **Penyensoran Data Pribadi (*PII Masking*)**: Direktif `@maskNik`, `@maskPhone`, dan `@maskEmail` untuk melindungi privasi warga pada halaman pelacakan status publik.
- **Rute Dokumen Terproteksi**: Berkas persyaratan yang diunggah warga hanya dapat diakses melalui rute terotentikasi oleh administrator.
- **Proteksi Spam & Bot**: Integrasi kolom jebakan (*Honeypot* `form_hp_check`) serta pembatasan laju permintaan (*Rate Limiting Throttle*) pada endpoint publik.
- **Header Keamanan Standar**: `X-Frame-Options`, `X-Content-Type-Options`, `X-XSS-Protection`, `Referrer-Policy`, dan `Permissions-Policy`.

### 4. 🖨️ Tata Naskah Dinas & Otomatisasi Surat
- Format Kop Surat dan tata letak dokumen mengacu pada standar **Permendagri No. 1 Tahun 2023**.
- Logika penandatanganan dinamis: Otomatis mendeteksi status Lurah Definitif (`LURAH BONGKI,`), Pelaksana Tugas (`Plt. LURAH BONGKI,`), maupun pendelegasian mandat (*Atas Nama* `a.n. LURAH BONGKI` disertai nama jabatan struktural penerima wewenang).
- Tombol cetak & pratinjau dokumen langsung dari halaman panel admin.

### 5. 📊 Panel Administrasi & Manajemen Data
- **Dasbor Analitik**: Statistik cepat, kartu ringkasan kependudukan, serta grafik tren pelayanan.
- **Master Data Kependudukan**: Pengelolaan data Penduduk, Kartu Keluarga (KK), dan Perangkat/Aparatur Kelurahan.
- **Pelayanan Persuratan**: Verifikasi berkas, pembaruan status (`Menunggu`, `Diproses`, `Selesai`, `Ditolak`), input catatan petugas, serta pemilihan pejabat penandatangan.
- **Laporan & Rekapitulasi**: Ekspor laporan kependudukan, kartu keluarga, dan persuratan dengan filter rentang tanggal, lingkungan, serta format naskah dinas cetak.
- **Manajemen Pengguna**: Pengelolaan akun Admin, Operator, dan Pimpinan.

---

## 👥 Matriks Hak Akses Pengguna

| Modul / Fitur | Administrator (`admin`) | Operator (`operator`) | Pimpinan (`pimpinan`) |
|---|:---:|:---:|:---:|
| Dasbor & Statistik | ✅ Penuh | ✅ Penuh | ✅ Lihat Saja |
| Data Kependudukan & KK | ✅ CRUD | ✅ CRUD | 👁️ Lihat Saja |
| Verifikasi & Proses Surat | ✅ Penuh | ✅ Penuh | 👁️ Monitoring |
| Tindak Lanjut Pengaduan | ✅ Penuh | ✅ Penuh | 👁️ Monitoring |
| CMS Website (Berita/Agenda) | ✅ Penuh | ✅ Penuh | ❌ |
| Laporan & Cetak Rekapitulasi | ✅ Cetak & Ekspor | ✅ Cetak & Ekspor | ✅ Cetak & Ekspor |
| Pengaturan Website & User | ✅ Penuh | ❌ | ❌ |

---

## 📜 Jenis Surat yang Didukung

1. **Surat Keterangan Domisili**
2. **Surat Keterangan Usaha (SKU)**
3. **Surat Keterangan Kematian**
4. **Surat Keterangan Belum Memiliki Rumah**
5. **Surat Keterangan Belum Menikah**
6. **Surat Keterangan Tidak Mampu (SKTM)**
7. **Surat Keterangan Pindah**
8. **Surat Keterangan Orang yang Sama**

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

- **Kerangka Kerja Backend**: [Laravel](https://laravel.com/) (PHP 8.2+)
- **Sistem Desain & CSS**: [Tailwind CSS v4](https://tailwindcss.com/) dengan plugin `@tailwindcss/typography`
- **Reaktivitas UI & Interaktivitas**: [Alpine.js](https://alpinejs.dev/) & [ApexCharts](https://apexcharts.com/)
- **Ikonografi**: [Font Awesome 6 (Free Solid, Brands, Regular)](https://fontawesome.com/)
- **Basis Data**: MySQL / MariaDB
- **Tipografi**: Inter (UI/Web) & Times New Roman (Naskah Dinas Cetak)

---

## 🚀 Panduan Instalasi & Menjalankan

### 1. Kloning Repositori
```bash
git clone https://github.com/username/sipbongki.git
cd sipbongki
```

### 2. Pemasangan Dependensi
```bash
# Dependensi Backend (PHP Composer)
composer install

# Dependensi Frontend (Node.js & NPM)
npm install
```

### 3. Konfigurasi Lingkungan (`.env`)
```bash
# Salin berkas konfigurasi template
cp .env.example .env

# Generate encryption key Laravel
php artisan key:generate
```
Sesuaikan konfigurasi koneksi database Anda di dalam berkas `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipbongki
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Basis Data & Seeder
```bash
# Eksekusi migrasi tabel dan data awal sistem
php artisan migrate --seed

# Hubungkan symbolic link penyimpanan file upload
php artisan storage:link
```

### 5. Menjalankan Server Lokal
Jalankan dua terminal secara berdampingan:

```bash
# Terminal 1: Watch & Compile Asset Frontend (Tailwind + Vite)
npm run dev

# Terminal 2: Web Server Lokal Laravel
php artisan serve
```

Aplikasi siap diakses melalui peramban:
- **Portal Publik**: `http://localhost:8000`
- **Panel Admin / Login**: `http://localhost:8000/login`

---

## 📂 Struktur Direktori Utama

```text
sipbongki/
├── app/
│   ├── Helpers/            # Helper keamanan & utilitas (SecurityHelper)
│   ├── Http/
│   │   ├── Controllers/    # Controller modul Publik, Admin, CMS, & Autentikasi
│   │   ├── Middleware/     # SecurityHeaders, AdminMiddleware, RoleMiddleware
│   │   └── Requests/       # Form Request validasi terpusat
│   ├── Models/             # Model Eloquent (Penduduk, PermohonanSurat, dll)
│   └── Services/Surat/     # Service generator template surat & nomor urut
├── database/
│   ├── migrations/         # Skema migrasi basis data
│   └── seeders/            # Seeder data awal kelurahan & akun default
├── resources/
│   ├── css/                # app.css & frontend.css (Tailwind v4 & theme tokens)
│   └── views/
│       ├── admin/          # Tampilan modul panel administrasi & CMS
│       ├── auth/           # Tampilan autentikasi login & reset password
│       ├── components/     # Komponen Blade modular (Navbar, Sidebar, Alert, dll)
│       ├── layouts/        # Master layout (admin, public, auth)
│       ├── public/         # Tampilan portal website publik & permohonan warga
│       └── surat/          # Template naskah dinas & cetak surat
├── routes/
│   ├── auth.php            # Rute autentikasi akun
│   └── web.php             # Rute publik, layanan, dan panel admin
└── CHANGELOG.md            # Catatan riwayat perubahan (Keep a Changelog)
```

---

## 📝 Catatan Perubahan

Riwayat pembaruan, penambahan fitur, dan perbaikan terperinci dapat dilihat pada berkas [CHANGELOG.md](CHANGELOG.md) sesuai standar [Keep a Changelog](https://keepachangelog.com/).

---

## 📄 Lisensi

Hak Cipta &copy; 2026 **Pemerintah Kelurahan Bongki, Kabupaten Sinjai**. Dirilis di bawah lisensi terbuka [MIT License](LICENSE).

