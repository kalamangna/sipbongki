-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2026 at 05:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipbongki`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `judul`, `deskripsi`, `tanggal`, `waktu`, `lokasi`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Kegiatan Sosialisasi terkait Prilaku Hidup Bersih dan Sehat', 'Kegiatan sosialisasi mengenai pentingnya Perilaku Hidup Bersih dan Sehat (PHBS) sebagai upaya menciptakan lingkungan yang sehat, bersih, dan nyaman bagi masyarakat Kelurahan Bongki', '2026-07-29', NULL, 'Aula Kantor  Kelurahan Bongki', 'aktif', '2026-07-27 06:15:11', '2026-07-27 06:15:11'),
(5, 'Posyandu', NULL, '2026-08-06', '08:00', 'Posyandu Kartini', 'aktif', '2026-07-27 06:33:16', '2026-07-27 06:34:03'),
(6, 'Posyandu', NULL, '2026-08-07', '08:00', 'Posyandu Asoka', 'aktif', '2026-07-27 06:33:47', '2026-07-27 06:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('draft','publish') NOT NULL DEFAULT 'draft',
  `tanggal_publish` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `slug`, `isi`, `gambar`, `status`, `tanggal_publish`, `created_at`, `updated_at`) VALUES
(1, 'Berita terbaru', 'berita-terbaru', 'Terkait pengerjaanwebsite', NULL, 'publish', '2026-07-19', '2026-07-18 23:46:06', '2026-07-18 23:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `judul`, `deskripsi`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(2, 'contoh 2', NULL, 'galeri/CfoGMXilfwRREQORXxKbf2vd01vtsn3IlXdkvWgV.jpg', 'aktif', '2026-07-19 01:40:45', '2026-07-19 01:40:45'),
(3, 'contoh 3', NULL, 'galeri/8kchDpCRzAOa40MJSg56YEX2KFoqTfw3WU4dV6t6.jpg', 'aktif', '2026-07-19 01:41:12', '2026-07-19 01:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `halamans`
--

CREATE TABLE `halamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('aktif','draft') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `urutan` tinyint(3) UNSIGNED NOT NULL DEFAULT 99,
  `is_penandatangan` tinyint(1) NOT NULL DEFAULT 0,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `is_struktur` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `parent_id`, `nama`, `slug`, `urutan`, `is_penandatangan`, `aktif`, `is_struktur`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Sekretaris Lurah', NULL, 2, 1, 1, 0, '2026-07-11 00:29:57', '2026-07-18 03:19:54'),
(3, 11, 'Kasi Pemerintahan', 'kasi-pemerintahan', 3, 0, 1, 1, '2026-07-11 00:29:57', '2026-07-26 02:31:37'),
(4, NULL, 'Kasi Pembangunan & Pemberdayaan Masyarakat', NULL, 5, 1, 1, 0, '2026-07-11 00:29:57', '2026-07-25 22:23:39'),
(5, NULL, 'Kasi Pelayanan Umum', NULL, 4, 1, 1, 0, '2026-07-11 00:29:57', '2026-07-25 22:23:38'),
(9, NULL, 'Plt. Lurah Bongki', NULL, 1, 1, 1, 0, '2026-07-16 20:17:44', '2026-07-16 21:08:44'),
(10, NULL, 'Plt. Lurah', 'lurah', 1, 1, 1, 1, '2026-07-25 23:45:43', '2026-07-27 06:54:04'),
(11, 10, 'Sekretaris Lurah', 'sekretaris-lurah', 2, 0, 1, 1, '2026-07-25 23:45:43', '2026-07-27 07:13:19'),
(13, 11, 'Kasi Pelayanan Umum', 'kasi-pelayanan-umum', 4, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-27 07:13:29'),
(14, 11, 'Kasi PMD', 'kasi-ppm', 5, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-27 06:54:05'),
(15, 10, 'Kepala Lingkungan Paruntu', 'kepala-lingkungan-paruntu', 10, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-25 23:47:02'),
(16, 10, 'Kepala Lingkungan Benteng', 'kepala-lingkungan-benteng', 11, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-25 23:47:02'),
(17, 10, 'Kepala Lingkungan Popanda', 'kepala-lingkungan-popanda', 12, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-25 23:47:02'),
(18, 10, 'Kepala Lingkungan Samaenre', 'kepala-lingkungan-samaenre', 13, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-25 23:47:02'),
(19, 3, 'Staf Seksi Pemerintahan', 'staf-pemerintahan', 20, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-27 06:54:05'),
(20, 13, 'Staf Seksi Pelayanan Umum', 'staf-pelayanan', 21, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-27 06:54:05'),
(21, 14, 'Staf Seksi PMD', 'staf-ppm', 22, 0, 1, 1, '2026-07-25 23:47:02', '2026-07-27 06:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surats`
--

CREATE TABLE `jenis_surats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_surat` varchar(20) DEFAULT NULL,
  `kode_nomor` varchar(20) DEFAULT NULL,
  `template_view` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `nomor_urut` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `icon` varchar(255) DEFAULT NULL,
  `persyaratan` text DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_surats`
--

INSERT INTO `jenis_surats` (`id`, `kode`, `nama`, `kode_surat`, `kode_nomor`, `template_view`, `deskripsi`, `nomor_urut`, `icon`, `persyaratan`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 'KEMATIAN', 'Surat Keterangan Kematian', NULL, NULL, NULL, 'Persyaratan : KTP pelapor, KK almarhum, dan surat keterangan kematian dari rumah sakit atau pihak berwenang', 0, NULL, NULL, 1, '2026-07-11 04:11:15', '2026-07-27 04:32:03'),
(3, 'DOMISILI', 'Surat Keterangan Domisili', NULL, NULL, 'surat.templates.keterangan-domisili', 'Persyaratan : KTP, KK, dan surat pengantar RT/RW/Kepling', 10, 'bi-house', 'Fotokopi KTP\nFotokopi KK', 1, '2026-07-11 04:59:29', '2026-07-27 04:30:39'),
(5, 'SKTM', 'Surat Keterangan Tidak Mampu', NULL, NULL, 'surat.templates.surat-keterangan-tidak-mampu', 'Persyaratan : KTP, KK, dan surat pengantar RT/RW/Kepling atau dokumen pendukung sesuai keperluan', 0, NULL, NULL, 1, '2026-07-20 07:53:04', '2026-07-27 04:31:28'),
(6, 'SKBM', 'Surat Keterangan Belum Menikah', NULL, NULL, 'surat.templates.surat-keterangan-belum-menikah', 'Persyaratan : KTP, KK, dan surat pengantar RT/RW/Kepling', 0, NULL, NULL, 1, '2026-07-20 08:18:21', '2026-07-27 04:29:04'),
(7, 'USAHA', 'Keterangan Usaha', NULL, NULL, NULL, 'Persyaratan : KTP, KK, dan surat pengantar RT/RW /Kepling', 0, NULL, NULL, 1, '2026-07-21 04:00:28', '2026-07-27 04:28:11'),
(8, 'ORANG-SAMA', 'Surat Keterangan Orang Yang Sama', NULL, '145', 'surat.templates.orang-sama', 'Surat keterangan orang yang sama.', 6, 'bi-person-check', NULL, 1, '2026-07-29 06:25:06', '2026-07-29 06:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_keluargas`
--

CREATE TABLE `kartu_keluargas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `kepala_keluarga_id` bigint(20) UNSIGNED DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `lingkungan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_keluargas`
--

INSERT INTO `kartu_keluargas` (`id`, `no_kk`, `kepala_keluarga_id`, `alamat`, `rt`, `rw`, `lingkungan_id`, `aktif`, `created_at`, `updated_at`) VALUES
(5, '7307050112080001', 2, 'Jl. Gunung Latimojong', NULL, '001', 1, 1, '2026-07-13 23:41:00', '2026-07-13 23:41:00'),
(6, '7307050505250003', 7, 'Btn. Tangka Mas Blok E No.39', '001', '001', 1, 1, '2026-07-18 04:47:52', '2026-07-18 04:47:52'),
(7, '7307052901053400', 11, 'Jl. Bulu Bicara', '004', '002', 1, 1, '2026-07-21 17:47:35', '2026-07-21 17:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `lingkungans`
--

CREATE TABLE `lingkungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ketua_lingkungan` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lingkungans`
--

INSERT INTO `lingkungans` (`id`, `kode`, `nama`, `ketua_lingkungan`, `telepon`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'L01', 'Lingkungan Paruntu', NULL, NULL, 'Lingkungan Paruntu Kelurahan Bongki', 1, '2026-07-11 04:59:29', '2026-07-11 04:59:29'),
(2, 'L02', 'Lingkungan Popanda', NULL, NULL, 'Lingkungan Popanda Kelurahan Bongki', 1, '2026-07-11 04:59:29', '2026-07-11 04:59:29'),
(3, 'L03', 'Lingkungan Benteng', NULL, NULL, 'Lingkungan Benteng Kelurahan Bongki', 1, '2026-07-11 04:59:29', '2026-07-11 04:59:29'),
(4, 'L04', 'Lingkungan Samaenre', NULL, NULL, 'Lingkungan Samaenre Kelurahan Bongki', 1, '2026-07-11 04:59:29', '2026-07-11 04:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_10_030205_create_lingkungans_table', 1),
(5, '2026_07_10_073605_create_jabatans_table', 1),
(6, '2026_07_10_083658_create_jenis_surats_table', 1),
(7, '2026_07_10_090607_add_fields_to_jenis_surats_table', 1),
(8, '2026_07_11_004404_create_penduduks_table', 1),
(9, '2026_07_11_012944_add_rt_rw_to_penduduks_table', 1),
(10, '2026_07_11_020412_create_kartu_keluargas_table', 1),
(11, '2026_07_11_020545_add_kartu_keluarga_id_to_penduduks_table', 1),
(12, '2026_07_11_023128_add_hubungan_keluarga_to_penduduks_table', 1),
(13, '2026_07_11_043027_create_perangkats_table', 1),
(14, '2026_07_11_075039_add_foto_to_perangkat_table', 1),
(15, '2026_07_11_111742_create_permohonan_surats_table', 2),
(16, '2026_07_12_003726_create_permohonan_surat_histories_table', 3),
(17, '2026_07_12_013556_add_nomor_surat_to_permohonan_surats_table', 4),
(18, '2026_07_12_023505_drop_template_column_from_jenis_surats_table', 5),
(19, '2026_07_12_055623_add_dapat_menandatangani_to_perangkats_table', 6),
(20, '2026_07_12_055957_add_penandatangan_foreign_key_to_permohonan_surats_table', 6),
(21, '2026_07_12_060422_add_is_penandatangan_to_jabatans_table', 7),
(22, '2026_07_19_071540_create_beritas_table', 8),
(23, '2026_07_19_075713_create_agendas_table', 9),
(24, '2026_07_19_083658_create_galeris_table', 10),
(25, '2026_07_19_085035_create_website_settings_table', 11),
(26, '2026_07_19_094433_create_halamans_table', 12),
(27, '2026_07_19_124008_add_level_to_perangkats_table', 13),
(28, '2026_07_20_101055_add_data_surat_to_permohonan_surats_table', 14),
(29, '2026_07_21_155925_add_data_kematian_to_permohonan_surats_table', 15),
(30, '2026_07_22_171206_add_role_to_users_table', 16),
(31, '2026_07_25_052048_add_website_content_fields_to_website_settings_table', 17),
(32, '2026_07_26_072709_add_hierarchy_to_jabatans_table', 18),
(33, '2026_07_26_085045_add_is_struktur_to_jabatans_table', 19),
(34, '2026_07_26_093525_add_jabatan_struktur_id_to_perangkats_table', 20),
(35, '2026_07_27_151147_change_unique_jabatan_to_include_is_struktur', 21),
(36, '2026_07_29_091521_add_pelapor_id_to_permohonan_surats_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penduduks`
--

CREATE TABLE `penduduks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `status_perkawinan` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `status_validasi_alamat` varchar(255) NOT NULL DEFAULT 'Perlu Verifikasi',
  `lingkungan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kartu_keluarga_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hubungan_keluarga` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduks`
--

INSERT INTO `penduduks` (`id`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `status_perkawinan`, `pendidikan`, `pekerjaan`, `alamat`, `rt`, `rw`, `status_validasi_alamat`, `lingkungan_id`, `kartu_keluarga_id`, `hubungan_keluarga`, `telepon`, `email`, `foto`, `aktif`, `created_at`, `updated_at`) VALUES
(2, '7307050112750007', 'Pahri', 'L', 'Matumpu', '1975-12-01', 'Islam', 'Kawin', 'SMP/Sederajat', 'Wiraswasta', 'Jl. Gunung Latimojong', '004', '001', 'Valid', 1, NULL, NULL, '085242212456', NULL, NULL, 1, '2026-07-13 23:39:04', '2026-07-13 23:39:04'),
(3, '7307057112830006', 'Saleha', 'P', 'Bone', '1983-02-09', 'Islam', 'Kawin', 'SMA/Sederajat', 'Mengurus Rumah Tangga', 'Jl. Gunung Latimojong', '004', '001', 'Valid', 1, 5, 'Istri', NULL, NULL, NULL, 1, '2026-07-13 23:42:34', '2026-07-17 03:48:24'),
(4, '7307055101050001', 'Sahra', 'P', 'Sinjai', '2005-01-11', 'Islam', 'Belum Kawin', 'SD/Sederajat', 'Pelajar/Mahasiswa', 'Jl. Gunung Latimojong', '004', '001', 'Valid', 1, NULL, NULL, NULL, NULL, NULL, 1, '2026-07-13 23:45:04', '2026-07-13 23:45:04'),
(5, '7307055909180001', 'Rezki Mutahharah', 'P', 'Sinjai', '2022-06-07', 'Islam', 'Belum Kawin', 'Tidak/Belum Sekolah', 'Belum/Tidak Bekerja', 'Jl. Gunung Latimojong', '004', '001', 'Valid', 1, 5, 'Anak', NULL, NULL, NULL, 1, '2026-07-13 23:46:25', '2026-07-17 03:47:23'),
(6, '7307054708200001', 'Fara Syakira Alifia', 'P', 'Sinjai', '2020-06-09', 'Islam', 'Belum Kawin', 'Tidak/Belum Sekolah', 'Belum/Tidak Bekerja', 'Jl. Gunung Latimojong', '004', '001', 'Valid', 1, 5, NULL, 's00790f', NULL, NULL, 1, '2026-07-13 23:50:07', '2026-07-24 17:22:30'),
(7, '7401185911740001', 'Rosdiana', 'P', 'Sinjai', '1974-11-19', 'Islam', 'Cerai Hidup', 'SMA/Sederajat', 'Belum/Tidak Bekerja', 'Btn, Tangka Mas Blok E No. 39', '001', '001', 'Valid', 1, NULL, NULL, NULL, 'adad@gmail.com', NULL, 1, '2026-07-18 04:46:53', '2026-07-18 04:46:53'),
(8, '7401181701120001', 'Hasram Saputra', 'L', 'Lalonggolosua', '2012-01-17', 'Islam', 'Belum Kawin', 'SMA/Sederajat', 'Belum/Tidak Bekerja', 'Btn. Tangka Mas Blok E No.39', '001', '001', 'Valid', 1, 6, 'Anak', NULL, NULL, NULL, 1, '2026-07-18 04:51:06', '2026-07-18 04:52:49'),
(9, '7401184702030002', 'Ita Yusnita', 'P', 'Oko-Oko', '2003-02-07', 'Islam', 'Belum Kawin', 'SD/Sederajat', 'Belum/Tidak Bekerja', 'Btn. Tangka Mas Blok E No.39', '001', '001', 'Valid', 1, 6, 'Anak', NULL, NULL, NULL, 1, '2026-07-18 05:02:41', '2026-07-18 05:03:40'),
(10, '7401184103020002', 'Nirmayanti', 'P', 'Putemata', '2002-03-01', 'Islam', 'Belum Kawin', 'Tidak/Belum Sekolah', 'Belum/Tidak Bekerja', 'Btn. Tangka Mas Blok E No.39', '001', '001', 'Valid', 1, 6, 'Anak', NULL, NULL, NULL, 1, '2026-07-18 05:07:30', '2026-07-18 05:08:30'),
(11, '7307053112700053', 'Shabaruddin', 'L', 'Sinjai', '1970-12-31', 'Islam', 'Kawin', 'SMA/Sederajat', 'Perdagangan', 'Jl. Bulu Bicara', '004', '002', 'Valid', 1, NULL, 'Kepala Keluarga', NULL, NULL, NULL, 1, '2026-07-21 17:46:15', '2026-07-21 17:51:54'),
(12, '7307050109030001', 'Muhammad Fahri', 'L', 'Sinjai', '2003-09-01', 'Islam', 'Belum Kawin', 'SMA/Sederajat', 'Belum/Tidak Bekerja', 'Bumi Benteng Mas (Jl. Petta Ponggawae)', '002', '002', 'Valid', 3, NULL, 'Anak', '089 532 149  3193', NULL, NULL, 1, '2026-07-21 19:04:02', '2026-07-21 19:07:24'),
(13, '7307055211810001', 'Nurlita', 'P', 'Sinjai', '1981-11-12', 'Islam', 'Cerai Hidup', 'SMA/Sederajat', 'Mengurus Rumah Tangga', 'Jl. Petta Ponggawae', '001', '002', 'Valid', 4, NULL, NULL, '085 754 378 256', NULL, NULL, 1, '2026-07-22 17:21:55', '2026-07-22 17:21:55'),
(14, '7307054906080002', 'Musyarrifa. F', 'P', 'Sinjai', '2013-06-02', 'Islam', 'Belum Kawin', 'SMA/Sederajat', 'Pelajar/Mahasiswa', 'JL. Bulu Saraung', '001', '002', 'Valid', 1, NULL, NULL, NULL, NULL, NULL, 1, '2026-07-22 22:24:49', '2026-07-24 17:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `perangkats`
--

CREATE TABLE `perangkats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan_struktur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 99,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_mulai_jabatan` date DEFAULT NULL,
  `tanggal_selesai_jabatan` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `dapat_menandatangani` tinyint(1) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perangkats`
--

INSERT INTO `perangkats` (`id`, `nama_lengkap`, `nip`, `jabatan_id`, `jabatan_struktur_id`, `level`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `telepon`, `email`, `alamat`, `tanggal_mulai_jabatan`, `tanggal_selesai_jabatan`, `foto`, `aktif`, `dapat_menandatangani`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'ASHARI, S.Sos.,MM.', '19760822 200804 1 001', 9, 10, 1, 'L', NULL, '1976-08-22', 'Magister (S2)', '082 299 362 534', NULL, NULL, '2026-07-01', NULL, 'perangkat/N4YRNSc25k1mGz5KRvFdnmtt9ytjv8h0nvFhN0nS.jpg', 1, 1, NULL, '2026-07-16 20:23:04', '2026-07-26 23:42:46'),
(4, 'SANRAWATI, S.E', '19780403 201101 2 005', 2, 11, 3, 'P', NULL, NULL, 'Sarjana (S1)', '085 342 773 562', NULL, NULL, NULL, NULL, 'perangkat/813ki41roX3N3v1uyWMJPWBZyqYEmjEG4KU0r18c.png', 1, 0, NULL, '2026-07-18 02:24:48', '2026-07-26 08:44:18'),
(5, 'MUHAMMAD RUSMIN, S.IP', '19790506 200801 1 023', 5, 13, 3, 'L', NULL, NULL, 'Sarjana (S1)', '085  126 765 730', NULL, NULL, NULL, NULL, 'perangkat/qyQE6kbRUTWnlsl6KeuPko9RFGGtOD52oPlJinZX.png', 1, 0, NULL, '2026-07-18 02:26:11', '2026-07-26 08:46:24'),
(6, 'FIRMAN, S.E', '19800313 200901 1 007', 3, 3, 3, 'L', NULL, NULL, 'Sarjana (S1)', '089 988 555 25', NULL, NULL, NULL, NULL, 'perangkat/TAebTld5QW3nKhiNPB8tE6kAZK8QKOBZmWdfoFXL.jpg', 1, 0, NULL, '2026-07-18 02:27:06', '2026-07-27 04:41:01'),
(7, 'PARTINI H, S.E.,M.Ak', '19970127 202203 2 013', 4, 14, 3, 'P', NULL, NULL, 'Magister (S2)', '085 342 558 363', NULL, NULL, NULL, NULL, 'perangkat/UsUgE2jH8WcoyKOvCifl3vm3YGmzo6f0JsIJKHui.jpg', 1, 0, NULL, '2026-07-18 02:28:22', '2026-07-26 16:07:19'),
(9, 'NUR RAHMAT, A.Md.', '199012032019031010', 21, 21, 5, 'L', 'Watampone', '1990-12-03', 'Diploma III (D3)', '082 215 766 363', 'noenoenur@gmail.com', 'Jl. A.P Pettarani', NULL, NULL, 'perangkat/pAiTpVbTBtjrrnYDxoHoPLaoViMGm98zInQJOQby.jpg', 1, 0, NULL, '2026-07-26 02:39:34', '2026-07-26 02:44:36'),
(10, 'ERNI RAHMAN', '19820618 202521 2 076', 21, 21, 5, 'P', 'Sinjai', NULL, 'SMA / SMK / MA', '085 242 324 040', NULL, 'Belum valid', NULL, NULL, 'perangkat/gH11fMORBQJsRtkaWQv1tGB6ferK11QKYYoDds8K.jpg', 1, 0, NULL, '2026-07-26 03:00:31', '2026-07-26 16:17:35'),
(11, 'MUSTIYANTI, S.IP', '19800310 202521 2 050', 21, 21, 5, 'P', 'Sinjai', NULL, 'Sarjana (S1)', '085 299 923 599', NULL, 'Belum Valid', NULL, NULL, 'perangkat/kTsEasMy2ggJpPRBsRqPlsynZubTLajxCOxe5t9E.jpg', 1, 0, NULL, '2026-07-26 03:03:29', '2026-07-26 16:34:00'),
(12, 'ANDI REZA ZULFIAN, S.Sos', '19930827 202521 1 086', 20, 20, 5, 'L', 'Sinjai', '1993-08-27', 'Sarjana (S1)', '082 299 741 384', NULL, 'Belum Valid', NULL, NULL, 'perangkat/gD0nxo4jh3MmHVbHrrJF9ZiimLumBNwegU1AWAhN.jpg', 1, 0, NULL, '2026-07-26 03:08:37', '2026-07-26 16:11:35'),
(13, 'ANDI WARNIDAH, S.IP', '19871128 202521 2 077', 20, 20, 5, 'P', 'Sinjai', '1987-11-28', 'Sarjana (S1)', '082 196 600 993', NULL, 'Jl. Bulu Pattuku', NULL, NULL, 'perangkat/tQ1S48HkxBdzBH64NqfPMjmGGNr4pwb2LzbIR7k3.jpg', 1, 0, NULL, '2026-07-26 03:11:22', '2026-07-26 16:19:55'),
(14, 'MA\'RIFA GS', '19860929 202521 2 105', 20, 20, 5, 'P', 'Sinjai', '1986-09-29', 'SMA / SMK / MA', '085 341 879 186', NULL, 'Belum Valid', NULL, NULL, 'perangkat/qbpucGINRlDbEnZCIrdOeg3tIZ65RhwouiNN6sQT.jpg', 1, 0, NULL, '2026-07-26 03:12:51', '2026-07-26 16:18:30'),
(15, 'NURFAIKA, S.IP', '19830802 202521 2 051', 19, 19, 5, 'P', 'Sinjai', '1983-08-02', 'Sarjana (S1)', '085 242', NULL, NULL, NULL, NULL, 'perangkat/mren7uAwLk79Xuz3QS4XiT0prqgeY9dkOj9hDH58.jpg', 1, 0, NULL, '2026-07-26 03:20:56', '2026-07-26 16:19:37'),
(16, 'NUR FAUZIAH', '19860511 202521 2 056', 19, 19, 5, 'P', 'Sinjai', NULL, 'SMA / SMK / MA', NULL, NULL, 'Belum Valid', NULL, NULL, 'perangkat/uUJkQz5uGT9p9KGhU2dw7EgMoGAoV9FWLeoCm8cr.jpg', 1, 0, NULL, '2026-07-26 03:23:02', '2026-07-26 16:18:04'),
(17, 'ANSAR', NULL, 15, 15, 4, 'L', NULL, NULL, 'SMA / SMK / MA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2026-07-26 03:49:47', '2026-07-26 03:49:47'),
(18, 'MUHAMMAD ANWARDIN, S.Pd', NULL, 16, 16, 4, 'L', NULL, NULL, 'Sarjana (S1)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2026-07-26 03:50:23', '2026-07-26 03:50:23'),
(19, 'H. ANSAR, S.Pd', NULL, 18, 18, 4, 'L', NULL, NULL, 'Sarjana (S1)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2026-07-26 03:50:55', '2026-07-26 03:50:55'),
(20, 'BAHARUDDIN A.', NULL, 17, 17, 4, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2026-07-26 03:51:22', '2026-07-26 03:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_surats`
--

CREATE TABLE `permohonan_surats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_permohonan` varchar(255) NOT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `tanggal_permohonan` date NOT NULL,
  `penduduk_id` bigint(20) UNSIGNED NOT NULL,
  `pelapor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_surat_id` bigint(20) UNSIGNED NOT NULL,
  `penandatangan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keperluan` text NOT NULL,
  `data_surat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_surat`)),
  `status` enum('Menunggu','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `operator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hari_meninggal` varchar(255) DEFAULT NULL,
  `tanggal_meninggal` date DEFAULT NULL,
  `tempat_meninggal` varchar(255) DEFAULT NULL,
  `sebab_meninggal` varchar(255) DEFAULT NULL,
  `nama_pelapor` varchar(255) DEFAULT NULL,
  `nik_pelapor` varchar(255) DEFAULT NULL,
  `umur_pelapor` varchar(255) DEFAULT NULL,
  `pekerjaan_pelapor` varchar(255) DEFAULT NULL,
  `alamat_pelapor` text DEFAULT NULL,
  `hubungan_pelapor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonan_surats`
--

INSERT INTO `permohonan_surats` (`id`, `nomor_permohonan`, `nomor_surat`, `tanggal_permohonan`, `penduduk_id`, `pelapor_id`, `jenis_surat_id`, `penandatangan_id`, `keperluan`, `data_surat`, `status`, `operator_id`, `tanggal_selesai`, `catatan`, `created_at`, `updated_at`, `hari_meninggal`, `tanggal_meninggal`, `tempat_meninggal`, `sebab_meninggal`, `nama_pelapor`, `nik_pelapor`, `umur_pelapor`, `pekerjaan_pelapor`, `alamat_pelapor`, `hubungan_pelapor`) VALUES
(68, 'PMH-20260730051855', '145/001/Bk-Sut', '2026-07-30', 6, NULL, 3, 5, 'pengurusan kredit  kendaraan bermotor', '[]', 'Selesai', NULL, '2026-07-30', NULL, '2026-07-29 21:18:55', '2026-07-29 21:19:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'PMH-20260730052544', '145/002/Bk-Sut', '2026-07-30', 8, NULL, 6, 6, 'untuk pengurusan kelengkapan berkas pendukung kredit perumahan', '[]', 'Selesai', NULL, '2026-07-30', NULL, '2026-07-29 21:25:44', '2026-07-29 21:25:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'PMH-20260730052732', '581/001/Bk-Sut', '2026-07-30', 13, NULL, 7, 7, 'pengajuan kredit tambahan usaha', '{\"nama_usaha\":\"Lita elektronik\",\"jenis_usaha\":\"Elektronik\",\"alamat_usaha\":\"Jl. Petta Ponggawae\",\"lama_usaha\":\"2 Tahun\"}', 'Selesai', NULL, '2026-07-30', NULL, '2026-07-29 21:27:32', '2026-07-29 21:27:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'PMH-20260730052815', '451.6/001/Bk-Sut', '2026-07-30', 5, NULL, 5, 3, 'pengurusan beasiswa pendidikan', '[]', 'Selesai', NULL, '2026-07-30', NULL, '2026-07-29 21:28:15', '2026-07-29 21:28:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'PMH-20260730052913', '474.3/001/Bk-Sut', '2026-07-30', 13, 2, 1, 5, 'pengurusan akta kematian', '{\"hari_meninggal\":\"Selasa\",\"tanggal_meninggal\":\"2026-07-14\",\"jam_meninggal\":\"10:10\",\"tempat_meninggal\":\"Rumah Sakit\",\"penyebab_kematian\":\"Sakit\",\"hubungan_pelapor\":\"Keluarga\"}', 'Selesai', NULL, '2026-07-30', NULL, '2026-07-29 21:29:13', '2026-07-29 21:29:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'PMH-20260730060528', '145/003/Bk-Sut', '2026-07-30', 10, NULL, 8, 3, 'pengurusan di pertanahan', '{\"nama_lain\":\"Nirmayati\",\"jenis_dokumen\":\"Sertifikat Hak Milik\",\"nomor_dokumen\":\"SHM No. 123\",\"keterangan_perbedaan\":\"Perbedaan penulisan nama\"}', 'Selesai', NULL, '2026-07-30', NULL, '2026-07-29 22:05:28', '2026-07-29 22:05:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'PMH-20260731013005', '145/004/Bk-Sut', '2026-07-31', 2, NULL, 3, 7, 'erth5trfre', '[]', 'Selesai', NULL, '2026-07-31', NULL, '2026-07-30 17:30:05', '2026-07-30 17:30:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'PMH-20260731031330', NULL, '2026-07-31', 9, NULL, 3, 4, 'gfretear', '[]', 'Menunggu', NULL, NULL, NULL, '2026-07-30 19:13:30', '2026-07-30 19:13:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_surat_histories`
--

CREATE TABLE `permohonan_surat_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permohonan_surat_id` bigint(20) UNSIGNED NOT NULL,
  `status_lama` varchar(255) DEFAULT NULL,
  `status_baru` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonan_surat_histories`
--

INSERT INTO `permohonan_surat_histories` (`id`, `permohonan_surat_id`, `status_lama`, `status_baru`, `catatan`, `user_id`, `created_at`, `updated_at`) VALUES
(181, 68, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-29 21:18:55', '2026-07-29 21:18:55'),
(182, 68, 'Menunggu', 'Diproses', NULL, 1, '2026-07-29 21:19:05', '2026-07-29 21:19:05'),
(183, 68, 'Diproses', 'Selesai', NULL, 1, '2026-07-29 21:19:10', '2026-07-29 21:19:10'),
(184, 69, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-29 21:25:44', '2026-07-29 21:25:44'),
(185, 69, 'Menunggu', 'Diproses', NULL, 1, '2026-07-29 21:25:50', '2026-07-29 21:25:50'),
(186, 69, 'Diproses', 'Selesai', NULL, 1, '2026-07-29 21:25:57', '2026-07-29 21:25:57'),
(187, 70, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-29 21:27:32', '2026-07-29 21:27:32'),
(188, 70, 'Menunggu', 'Diproses', NULL, 1, '2026-07-29 21:27:38', '2026-07-29 21:27:38'),
(189, 70, 'Diproses', 'Selesai', NULL, 1, '2026-07-29 21:27:42', '2026-07-29 21:27:42'),
(190, 71, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-29 21:28:15', '2026-07-29 21:28:15'),
(191, 71, 'Menunggu', 'Diproses', NULL, 1, '2026-07-29 21:28:21', '2026-07-29 21:28:21'),
(192, 71, 'Diproses', 'Selesai', NULL, 1, '2026-07-29 21:28:25', '2026-07-29 21:28:25'),
(193, 72, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-29 21:29:13', '2026-07-29 21:29:13'),
(194, 72, 'Menunggu', 'Diproses', NULL, 1, '2026-07-29 21:29:18', '2026-07-29 21:29:18'),
(195, 72, 'Diproses', 'Selesai', NULL, 1, '2026-07-29 21:29:23', '2026-07-29 21:29:23'),
(199, 74, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-29 22:05:28', '2026-07-29 22:05:28'),
(200, 74, 'Menunggu', 'Diproses', NULL, 1, '2026-07-29 22:05:35', '2026-07-29 22:05:35'),
(201, 74, 'Diproses', 'Selesai', NULL, 1, '2026-07-29 22:05:39', '2026-07-29 22:05:39'),
(202, 75, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-30 17:30:06', '2026-07-30 17:30:06'),
(203, 75, 'Menunggu', 'Diproses', NULL, 1, '2026-07-30 17:30:26', '2026-07-30 17:30:26'),
(204, 75, 'Diproses', 'Selesai', NULL, 1, '2026-07-30 17:30:43', '2026-07-30 17:30:43'),
(205, 76, NULL, 'Menunggu', 'Permohonan dibuat.', 1, '2026-07-30 19:13:30', '2026-07-30 19:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GKRxDK1ls26uZbJhdbSjL5z9IWc4YW22TlrM9Dfv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:153.0) Gecko/20100101 Firefox/153.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEs0WVNXa01VS2FmdjZ1ODVsYUFjT0RBRzNoQ3ZGYkVDU0t4YjJnUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1785467998);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','operator') NOT NULL DEFAULT 'operator',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@sipbongki.go.id', 'admin', NULL, '$2y$12$QjdaXKs7O86vYC1B2ou8sO2JQ9ZoNZfa5FAbzwADKjgxHOKC.bx2K', NULL, '2026-07-10 22:14:55', '2026-07-22 09:15:11'),
(2, 'Administrator', 'test@example.com', 'operator', NULL, '$2y$12$ar9WlcLXh8SL..YJ3eZ4kOJ9xXy/squF6xtlmtvCMlrK2BkQf82ZO', NULL, '2026-07-11 04:59:29', '2026-07-22 10:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_website` varchar(255) NOT NULL DEFAULT 'SiPBongki',
  `nama_kelurahan` varchar(255) NOT NULL DEFAULT 'Kelurahan Bongki',
  `logo` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `judul_hero` varchar(255) DEFAULT NULL,
  `subjudul_hero` varchar(255) DEFAULT NULL,
  `deskripsi_hero` text DEFAULT NULL,
  `gambar_hero` varchar(255) DEFAULT NULL,
  `hero_button_1_text` varchar(255) DEFAULT NULL,
  `hero_button_1_link` varchar(255) DEFAULT NULL,
  `hero_button_2_text` varchar(255) DEFAULT NULL,
  `hero_button_2_link` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `google_maps` text DEFAULT NULL,
  `jam_pelayanan` varchar(255) DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `nama_website`, `nama_kelurahan`, `logo`, `alamat`, `telepon`, `email`, `facebook`, `instagram`, `youtube`, `deskripsi`, `badge`, `created_at`, `updated_at`, `judul_hero`, `subjudul_hero`, `deskripsi_hero`, `gambar_hero`, `hero_button_1_text`, `hero_button_1_link`, `hero_button_2_text`, `hero_button_2_link`, `whatsapp`, `google_maps`, `jam_pelayanan`, `footer_text`, `copyright`, `favicon`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 'SIP Bongki', 'Kelurahan Bongki', 'website/FvuS04GzF2FpnYkOmR4DHJWhob0k6RWkWGPncoAZ.png', 'Jl. Bulu Patukku No.5, Kelurahan Bongki', '(0482) xxxx', 'kelurahanbongki.90@gmail.com', NULL, NULL, NULL, NULL, NULL, '2026-07-19 01:09:24', '2026-07-27 01:44:03', NULL, NULL, NULL, 'website/ia9Q2Pr16IVv5GM5By1RwKSuMWjbOieBxq0FUzab.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beritas_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halamans`
--
ALTER TABLE `halamans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `halamans_slug_unique` (`slug`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatans_nama_is_struktur_unique` (`nama`,`is_struktur`),
  ADD KEY `jabatans_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `jenis_surats`
--
ALTER TABLE `jenis_surats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_surats_kode_unique` (`kode`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kartu_keluargas`
--
ALTER TABLE `kartu_keluargas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kartu_keluargas_no_kk_unique` (`no_kk`),
  ADD KEY `kartu_keluargas_kepala_keluarga_id_foreign` (`kepala_keluarga_id`),
  ADD KEY `kartu_keluargas_lingkungan_id_foreign` (`lingkungan_id`);

--
-- Indexes for table `lingkungans`
--
ALTER TABLE `lingkungans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lingkungans_kode_unique` (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penduduks`
--
ALTER TABLE `penduduks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penduduks_nik_unique` (`nik`),
  ADD KEY `penduduks_lingkungan_id_foreign` (`lingkungan_id`),
  ADD KEY `penduduks_kartu_keluarga_id_foreign` (`kartu_keluarga_id`);

--
-- Indexes for table `perangkats`
--
ALTER TABLE `perangkats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perangkats_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `perangkats_jabatan_struktur_id_foreign` (`jabatan_struktur_id`);

--
-- Indexes for table `permohonan_surats`
--
ALTER TABLE `permohonan_surats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permohonan_surats_nomor_permohonan_unique` (`nomor_permohonan`),
  ADD UNIQUE KEY `permohonan_surats_nomor_surat_unique` (`nomor_surat`),
  ADD KEY `permohonan_surats_penduduk_id_foreign` (`penduduk_id`),
  ADD KEY `permohonan_surats_jenis_surat_id_foreign` (`jenis_surat_id`),
  ADD KEY `permohonan_surats_operator_id_foreign` (`operator_id`),
  ADD KEY `permohonan_surats_penandatangan_id_foreign` (`penandatangan_id`),
  ADD KEY `permohonan_surats_pelapor_id_foreign` (`pelapor_id`);

--
-- Indexes for table `permohonan_surat_histories`
--
ALTER TABLE `permohonan_surat_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permohonan_surat_histories_permohonan_surat_id_foreign` (`permohonan_surat_id`),
  ADD KEY `permohonan_surat_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `halamans`
--
ALTER TABLE `halamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jenis_surats`
--
ALTER TABLE `jenis_surats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_keluargas`
--
ALTER TABLE `kartu_keluargas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lingkungans`
--
ALTER TABLE `lingkungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `penduduks`
--
ALTER TABLE `penduduks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `perangkats`
--
ALTER TABLE `perangkats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permohonan_surats`
--
ALTER TABLE `permohonan_surats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `permohonan_surat_histories`
--
ALTER TABLE `permohonan_surat_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD CONSTRAINT `jabatans_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_keluargas`
--
ALTER TABLE `kartu_keluargas`
  ADD CONSTRAINT `kartu_keluargas_kepala_keluarga_id_foreign` FOREIGN KEY (`kepala_keluarga_id`) REFERENCES `penduduks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_keluargas_lingkungan_id_foreign` FOREIGN KEY (`lingkungan_id`) REFERENCES `lingkungans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `penduduks`
--
ALTER TABLE `penduduks`
  ADD CONSTRAINT `penduduks_kartu_keluarga_id_foreign` FOREIGN KEY (`kartu_keluarga_id`) REFERENCES `kartu_keluargas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `penduduks_lingkungan_id_foreign` FOREIGN KEY (`lingkungan_id`) REFERENCES `lingkungans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `perangkats`
--
ALTER TABLE `perangkats`
  ADD CONSTRAINT `perangkats_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `perangkats_jabatan_struktur_id_foreign` FOREIGN KEY (`jabatan_struktur_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permohonan_surats`
--
ALTER TABLE `permohonan_surats`
  ADD CONSTRAINT `permohonan_surats_jenis_surat_id_foreign` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permohonan_surats_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_surats_pelapor_id_foreign` FOREIGN KEY (`pelapor_id`) REFERENCES `penduduks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_surats_penandatangan_id_foreign` FOREIGN KEY (`penandatangan_id`) REFERENCES `perangkats` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_surats_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permohonan_surat_histories`
--
ALTER TABLE `permohonan_surat_histories`
  ADD CONSTRAINT `permohonan_surat_histories_permohonan_surat_id_foreign` FOREIGN KEY (`permohonan_surat_id`) REFERENCES `permohonan_surats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permohonan_surat_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
