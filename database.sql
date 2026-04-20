-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2026 at 03:43 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_pra_ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_alat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_alat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `kondisi` enum('baik','rusak ringan','rusak berat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `deskripsi_kondisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lokasi_penyimpanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_alat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama_alat`, `kode_alat`, `stok`, `kondisi`, `deskripsi_kondisi`, `lokasi_penyimpanan`, `foto_alat`, `deskripsi`, `kategori_id`, `created_at`, `updated_at`) VALUES
(6, 'kanebo', '5', 8, 'baik', NULL, 'Ruang Kebersihan', 'alat/f0GlxozCPhBZudJB0MuwloSIc60QsjiYfv2EMNXO.jpg', 'kanebo kering', 1, '2026-02-10 07:16:53', '2026-04-19 14:02:11'),
(7, 'Ember', '3', 5, 'baik', NULL, 'Ruang Kebersihan', 'alat/AdSqulZSBoCL2lt3EBGqYLqgrgaTimYqfhOSMH1q.jpg', 'warna hijau dan putih', 1, '2026-02-11 10:17:52', '2026-04-18 03:50:58'),
(8, 'Sapu', '6', 7, 'baik', NULL, 'Ruang Kebersihan', 'alat/LLhFLrrMDVomcgXa3xpBqPB1LsTMl2FHRhkZHAbk.jpg', 'dsdsd', 1, '2026-02-11 10:20:53', '2026-04-13 03:53:21'),
(13, 'vakum', '18', 10, 'baik', NULL, 'Ruang Kebersihan', 'alat/HOrXcugFZmI5YgHIDX5pI6NXPtcdzHQLiUtvHBWN.jpg', 'baguss sekali alatnya', 2, '2026-04-01 18:36:35', '2026-04-09 07:31:55'),
(14, 'Tangga', '20', 14, 'baik', NULL, 'Ruang Kebersihan', 'alat/9WVavPmZLzbLDaLAb0Ojd4kuULxAcgozfO3iYwBv.jpg', 'tangga yang bagus', 1, '2026-04-01 23:50:35', '2026-04-18 02:19:20'),
(16, 'lampu', '111', 6, 'baik', NULL, 'Ruang Kebersihan', 'alat/V3PeFdWtFnVgw1JqyjAxL4MOnO28m7x62dQhMKdF.jpg', 'bagusss sekali', 2, '2026-04-02 02:33:39', '2026-04-08 03:55:00'),
(17, 'Sikat Wc', '112', 15, 'baik', NULL, 'Ruang Kebersihan', 'alat/m08HAQBWiNF4B3T7MiFwOyGbeeEgjs3vKBN84r34.jpg', 'sangat cocok untuk menyikat lantai wc dan closet', 1, '2026-04-06 04:52:09', '2026-04-19 14:02:59'),
(18, 'sapu lidi', '23', 6, 'baik', NULL, 'Ruang Kebersihan', 'alat/zMJbN6i3DknzyS8a6Wd0fZersOdN25AW13JtUr4a.jpg', 'sapu untuk di luar sekolah', 1, '2026-04-09 06:04:27', '2026-04-09 06:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `alat_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `jumlah_kembali` int DEFAULT NULL,
  `kondisi_awal` enum('baik','rusak ringan','rusak berat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `kondisi_kembali` enum('baik','rusak ringan','rusak berat','hilang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_kondisi_kembali` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `peminjaman_id`, `alat_id`, `jumlah`, `jumlah_kembali`, `kondisi_awal`, `kondisi_kembali`, `deskripsi_kondisi_kembali`, `created_at`, `updated_at`) VALUES
(6, 6, 6, 2, NULL, 'baik', NULL, NULL, '2026-02-10 20:09:16', '2026-02-10 20:09:16'),
(7, 7, 6, 2, 2, 'baik', 'baik', NULL, '2026-02-11 01:10:23', '2026-02-11 01:11:25'),
(9, 9, 6, 2, 2, 'baik', 'baik', NULL, '2026-02-11 08:21:40', '2026-02-11 08:28:29'),
(12, 12, 6, 2, 2, 'baik', 'baik', NULL, '2026-02-11 10:06:29', '2026-02-11 11:39:36'),
(15, 15, 8, 3, 3, 'baik', 'baik', NULL, '2026-03-17 06:59:47', '2026-03-17 07:06:35'),
(16, 16, 8, 3, 3, 'baik', 'baik', NULL, '2026-03-17 07:29:11', '2026-03-17 07:32:27'),
(17, 17, 7, 2, 2, 'baik', 'baik', NULL, '2026-03-17 08:28:36', '2026-03-17 09:01:10'),
(18, 18, 6, 2, 2, 'baik', 'baik', NULL, '2026-03-17 09:00:31', '2026-03-17 09:05:00'),
(19, 19, 6, 4, 4, 'baik', 'baik', NULL, '2026-04-01 14:24:06', '2026-04-01 14:26:56'),
(20, 20, 7, 2, 2, 'baik', 'rusak ringan', NULL, '2026-04-01 14:24:20', '2026-04-01 17:55:43'),
(21, 21, 8, 3, 3, 'baik', 'rusak ringan', 'patah', '2026-04-01 14:25:04', '2026-04-01 18:39:25'),
(23, 23, 6, 3, 3, 'baik', 'baik', NULL, '2026-04-01 17:57:58', '2026-04-01 23:54:31'),
(24, 24, 6, 2, NULL, 'baik', NULL, NULL, '2026-04-01 18:38:10', '2026-04-01 18:38:10'),
(25, 25, 14, 1, 1, 'baik', 'rusak ringan', 'patah', '2026-04-01 23:53:06', '2026-04-02 01:59:08'),
(26, 26, 7, 2, 2, 'baik', 'rusak ringan', 'belah', '2026-04-01 23:53:32', '2026-04-01 23:56:27'),
(27, 27, 6, 1, 1, 'baik', 'rusak berat', 'patah', '2026-04-02 02:00:32', '2026-04-02 02:01:31'),
(28, 28, 6, 2, 2, 'baik', 'rusak ringan', 'llecet', '2026-04-02 02:06:46', '2026-04-02 02:07:34'),
(29, 29, 6, 1, 1, 'baik', 'baik', 'tidak ada yang lecet baik, cuman terlambat mengembalikannya', '2026-04-02 02:09:14', '2026-04-06 04:56:33'),
(30, 30, 6, 2, 2, 'baik', 'rusak berat', 'sobek', '2026-04-02 02:17:07', '2026-04-02 02:18:09'),
(31, 31, 7, 3, 3, 'baik', 'rusak ringan', 'belah', '2026-04-02 02:26:37', '2026-04-02 02:27:39'),
(32, 32, 17, 4, 4, 'baik', 'rusak ringan', 'patah satu', '2026-04-06 04:54:37', '2026-04-06 04:57:18'),
(33, 33, 16, 4, 4, 'baik', 'rusak ringan', 'pecah satu', '2026-04-08 03:53:21', '2026-04-08 03:55:00'),
(34, 34, 6, 2, 2, 'baik', 'baik', 'baik', '2026-04-08 04:39:21', '2026-04-08 04:39:49'),
(35, 35, 6, 3, 3, 'baik', 'hilang', NULL, '2026-04-08 04:59:39', '2026-04-08 05:01:00'),
(36, 36, 7, 4, 4, 'baik', 'baik', NULL, '2026-04-08 05:39:20', '2026-04-08 05:40:40'),
(37, 37, 6, 1, 1, 'baik', 'baik', 'baik tapi dalam mengembalikan terlambat', '2026-04-08 05:46:53', '2026-04-10 05:21:36'),
(38, 38, 18, 4, 4, 'baik', 'baik', NULL, '2026-04-09 06:08:46', '2026-04-09 06:09:18'),
(39, 39, 13, 5, 5, 'baik', 'baik', NULL, '2026-04-09 07:30:59', '2026-04-09 07:31:55'),
(40, 40, 7, 4, 4, 'baik', 'rusak ringan', 'satu pecah', '2026-04-09 07:31:17', '2026-04-09 07:32:16'),
(41, 41, 17, 10, 10, 'baik', 'rusak ringan', 'patah', '2026-04-10 05:22:32', '2026-04-10 05:24:30'),
(42, 42, 7, 4, 4, 'baik', 'baik', 'baik sekali', '2026-04-12 07:24:05', '2026-04-13 02:36:43'),
(43, 43, 8, 6, 6, 'baik', 'baik', NULL, '2026-04-12 07:43:44', '2026-04-13 03:53:21'),
(44, 44, 7, 4, 4, 'baik', 'baik', NULL, '2026-04-13 03:09:20', '2026-04-13 03:52:56'),
(45, 45, 8, 3, NULL, 'baik', NULL, NULL, '2026-04-13 03:09:36', '2026-04-13 03:09:36'),
(46, 46, 14, 5, 5, 'baik', 'baik', NULL, '2026-04-13 03:09:50', '2026-04-13 03:52:34'),
(47, 47, 14, 4, 4, 'baik', 'baik', NULL, '2026-04-13 03:48:18', '2026-04-13 03:52:45'),
(48, 48, 6, 7, 7, 'baik', 'baik', NULL, '2026-04-17 00:55:55', '2026-04-17 03:38:04'),
(51, 51, 14, 12, 12, 'baik', 'rusak ringan', 'penyok tangganya', '2026-04-18 02:18:11', '2026-04-18 02:19:20'),
(52, 52, 6, 12, 12, 'baik', 'rusak ringan', 'robek kanebonya', '2026-04-18 02:23:22', '2026-04-18 02:23:59'),
(53, 53, 6, 9, 9, 'baik', 'baik', NULL, '2026-04-18 02:56:19', '2026-04-18 02:58:02'),
(54, 54, 6, 12, 12, 'baik', 'baik', NULL, '2026-04-18 03:09:30', '2026-04-18 03:10:01'),
(55, 55, 6, 12, 12, 'baik', 'rusak ringan', NULL, '2026-04-18 03:27:03', '2026-04-18 03:27:48'),
(56, 56, 7, 2, 2, 'baik', 'rusak ringan', 'pecah embernya', '2026-04-18 03:27:14', '2026-04-18 03:50:58'),
(57, 57, 6, 12, 12, 'baik', 'baik', NULL, '2026-04-18 03:50:08', '2026-04-18 03:55:46'),
(58, 58, 6, 12, 12, 'baik', 'rusak ringan', 'sobek', '2026-04-18 04:42:14', '2026-04-18 04:44:10'),
(59, 59, 17, 12, 12, 'baik', 'rusak ringan', 'copot gagang nya', '2026-04-18 05:44:13', '2026-04-19 14:02:59'),
(60, 60, 6, 12, NULL, 'baik', NULL, NULL, '2026-04-19 14:01:58', '2026-04-19 14:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Alat Kebersihan Manual', 'sapu, pel, pengki, sikat, ember, kain lap', '2026-02-09 02:26:20', '2026-02-09 02:26:20'),
(2, 'Alat Kebersihan Elektrik/Mesin', 'vacuum cleaner, mesin poles lantai, mesin semprot air, blower', '2026-02-09 02:26:39', '2026-02-09 02:26:39'),
(3, 'Bahan Pembersih (Habis Pakai)', 'sabun lantai, disinfektan, cairan pembersih kaca, tisu, pewangi', '2026-02-09 02:27:01', '2026-02-09 02:27:01'),
(4, 'Perlengkapan Pendukung', 'tempat sampah, troli kebersihan, tangga lipat, ember cadangan', '2026-02-09 02:27:18', '2026-02-09 02:27:18'),
(5, 'Alat Keselamatan Kerja', 'sarung tangan, masker, sepatu boots, apron, helm pelindung', '2026-02-09 02:27:36', '2026-02-09 02:27:36'),
(6, 'Alat Perawatan/Servis', 'toolkit, selang, suku cadang mesin', '2026-02-09 02:27:58', '2026-02-09 02:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `aksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_teks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `aksi`, `modul`, `detail_teks`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: Gergaji', '2026-04-01 17:47:15', '2026-04-01 17:47:15'),
(2, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 20). Denda: 0. Petugas: Petugas Lab', '2026-04-01 17:55:43', '2026-04-01 17:55:43'),
(3, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-01 17:57:58', '2026-04-01 17:57:58'),
(4, 1, 'Hapus Alat', 'Alat', 'Menghapus alat: vakum', '2026-04-01 18:36:03', '2026-04-01 18:36:03'),
(5, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: vakum', '2026-04-01 18:36:35', '2026-04-01 18:36:35'),
(6, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-01 18:38:10', '2026-04-01 18:38:10'),
(7, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 21) dengan status: disetujui', '2026-04-01 18:38:33', '2026-04-01 18:38:33'),
(8, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 23) dengan status: disetujui', '2026-04-01 18:38:37', '2026-04-01 18:38:37'),
(9, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 21). Denda: 0. Petugas: Petugas Lab', '2026-04-01 18:39:25', '2026-04-01 18:39:25'),
(10, 1, 'Hapus User', 'User', 'Menghapus user: gibran', '2026-04-01 23:41:22', '2026-04-01 23:41:22'),
(11, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: Tangga', '2026-04-01 23:50:35', '2026-04-01 23:50:35'),
(12, 1, 'Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: mini mals', '2026-04-01 23:50:58', '2026-04-01 23:50:58'),
(13, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Tangga', '2026-04-01 23:53:06', '2026-04-01 23:53:06'),
(14, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-01 23:53:32', '2026-04-01 23:53:32'),
(15, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 26) dengan status: disetujui', '2026-04-01 23:53:45', '2026-04-01 23:53:45'),
(16, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 24) dengan status: ditolak', '2026-04-01 23:54:05', '2026-04-01 23:54:05'),
(17, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 23). Denda: 0. Petugas: Petugas Lab', '2026-04-01 23:54:31', '2026-04-01 23:54:31'),
(18, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 25) dengan status: disetujui', '2026-04-01 23:55:49', '2026-04-01 23:55:49'),
(19, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 26). Denda: 0. Petugas: Petugas Lab', '2026-04-01 23:56:27', '2026-04-01 23:56:27'),
(20, 1, 'Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: ulang tahun', '2026-04-02 00:37:59', '2026-04-02 00:37:59'),
(21, 1, 'Hapus Kategori', 'Kategori', 'Menghapus kategori: ulang tahun', '2026-04-02 00:38:08', '2026-04-02 00:38:08'),
(22, 1, 'Hapus Kategori', 'Kategori', 'Menghapus kategori: mini mals', '2026-04-02 00:38:13', '2026-04-02 00:38:13'),
(23, 1, 'Tambah User', 'User', 'Menambahkan user baru: samsul', '2026-04-02 01:53:42', '2026-04-02 01:53:42'),
(24, 1, 'Tambah User', 'User', 'Menambahkan user baru: dokter', '2026-04-02 01:54:49', '2026-04-02 01:54:49'),
(25, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: lampu', '2026-04-02 01:58:22', '2026-04-02 01:58:22'),
(26, 1, 'Hapus Alat', 'Alat', 'Menghapus alat: lampu', '2026-04-02 01:58:32', '2026-04-02 01:58:32'),
(27, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 25). Denda: 0. Petugas: Petugas Lab', '2026-04-02 01:59:08', '2026-04-02 01:59:08'),
(28, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-02 02:00:32', '2026-04-02 02:00:32'),
(29, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 27) dengan status: disetujui', '2026-04-02 02:01:00', '2026-04-02 02:01:00'),
(30, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 27). Denda: 0. Petugas: Petugas Lab', '2026-04-02 02:01:31', '2026-04-02 02:01:31'),
(31, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-02 02:06:46', '2026-04-02 02:06:46'),
(32, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 28) dengan status: disetujui', '2026-04-02 02:06:53', '2026-04-02 02:06:53'),
(33, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 28). Denda: 0. Petugas: Petugas Lab', '2026-04-02 02:07:34', '2026-04-02 02:07:34'),
(34, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-02 02:09:14', '2026-04-02 02:09:14'),
(35, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 29) dengan status: disetujui', '2026-04-02 02:09:19', '2026-04-02 02:09:19'),
(36, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-02 02:17:07', '2026-04-02 02:17:07'),
(37, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 30) dengan status: disetujui', '2026-04-02 02:17:17', '2026-04-02 02:17:17'),
(38, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 30). Denda: Rp 10,000. Tipe: manual. Petugas: Petugas Lab', '2026-04-02 02:18:09', '2026-04-02 02:18:09'),
(39, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-02 02:26:37', '2026-04-02 02:26:37'),
(40, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 31) dengan status: disetujui', '2026-04-02 02:26:50', '2026-04-02 02:26:50'),
(41, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 31). Denda: Rp 40,000. Tipe: manual. Petugas: Petugas Lab', '2026-04-02 02:27:39', '2026-04-02 02:27:39'),
(42, 1, 'Hapus User', 'User', 'Menghapus user: dokter', '2026-04-02 02:29:55', '2026-04-02 02:29:55'),
(43, 1, 'Tambah User', 'User', 'Menambahkan user baru: dokter', '2026-04-02 02:30:20', '2026-04-02 02:30:20'),
(44, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: lampu', '2026-04-02 02:33:39', '2026-04-02 02:33:39'),
(45, 1, 'Hapus User', 'User', 'Menghapus user: dokter', '2026-04-06 04:46:37', '2026-04-06 04:46:37'),
(46, 1, 'Hapus User', 'User', 'Menghapus user: samsul', '2026-04-06 04:46:42', '2026-04-06 04:46:42'),
(47, 1, 'Tambah User', 'User', 'Menambahkan user baru: samsul', '2026-04-06 04:49:43', '2026-04-06 04:49:43'),
(48, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: Sikat Wc', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(49, 1, 'Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: ulang tahun', '2026-04-06 04:52:24', '2026-04-06 04:52:24'),
(50, 1, 'Hapus Kategori', 'Kategori', 'Menghapus kategori: ulang tahun', '2026-04-06 04:52:29', '2026-04-06 04:52:29'),
(51, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Sikat Wc', '2026-04-06 04:54:37', '2026-04-06 04:54:37'),
(52, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 32) dengan status: disetujui', '2026-04-06 04:55:02', '2026-04-06 04:55:02'),
(53, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 29). Denda: Rp -3,000. Tipe: auto. Petugas: Petugas Lab', '2026-04-06 04:56:33', '2026-04-06 04:56:33'),
(54, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 32). Denda: Rp 10,000. Tipe: manual. Petugas: Petugas Lab', '2026-04-06 04:57:18', '2026-04-06 04:57:18'),
(55, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: lampu', '2026-04-08 03:53:21', '2026-04-08 03:53:21'),
(56, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 33) dengan status: disetujui', '2026-04-08 03:53:56', '2026-04-08 03:53:56'),
(57, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 33). Denda: Rp 20,000. Tipe: manual. Petugas: Petugas Lab', '2026-04-08 03:55:00', '2026-04-08 03:55:00'),
(58, 12, 'Register', 'Auth', 'User naifa berhasil mendaftar.', '2026-04-08 04:39:03', '2026-04-08 04:39:03'),
(59, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-08 04:39:21', '2026-04-08 04:39:21'),
(60, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 34) dengan status: disetujui', '2026-04-08 04:39:33', '2026-04-08 04:39:33'),
(61, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 34). Denda: Rp 0. Tipe: auto. Petugas: Petugas Lab', '2026-04-08 04:39:49', '2026-04-08 04:39:49'),
(62, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-08 04:59:39', '2026-04-08 04:59:39'),
(63, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 35) dengan status: disetujui', '2026-04-08 05:00:07', '2026-04-08 05:00:07'),
(64, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 35). Denda: Rp 20,000. Tipe: manual. Petugas: Petugas Lab', '2026-04-08 05:01:00', '2026-04-08 05:01:00'),
(65, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-08 05:39:21', '2026-04-08 05:39:21'),
(66, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 36) dengan status: disetujui', '2026-04-08 05:39:48', '2026-04-08 05:39:48'),
(67, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 36). Denda: Rp 0. Tipe: auto. Petugas: Petugas Lab', '2026-04-08 05:40:40', '2026-04-08 05:40:40'),
(68, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-08 05:46:53', '2026-04-08 05:46:53'),
(69, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 37) dengan status: disetujui', '2026-04-08 05:47:21', '2026-04-08 05:47:21'),
(70, NULL, 'Register', 'Auth', 'User fadya berhasil mendaftar.', '2026-04-08 06:26:16', '2026-04-08 06:26:16'),
(71, 1, 'Hapus User', 'User', 'Menghapus user: fadya', '2026-04-09 06:01:50', '2026-04-09 06:01:50'),
(72, 1, 'Hapus User', 'User', 'Menghapus user: samsul', '2026-04-09 06:02:04', '2026-04-09 06:02:04'),
(73, 1, 'Tambah User', 'User', 'Menambahkan user baru: samsul', '2026-04-09 06:02:27', '2026-04-09 06:02:27'),
(74, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: sapu lidi', '2026-04-09 06:04:27', '2026-04-09 06:04:27'),
(75, 1, 'Edit Alat', 'Alat', 'Mengedit alat: sapu lidi', '2026-04-09 06:04:41', '2026-04-09 06:04:41'),
(76, 1, 'Hapus Alat', 'Alat', 'Menghapus alat: Gergaji', '2026-04-09 06:04:48', '2026-04-09 06:04:48'),
(77, 1, 'Edit Kategori', 'Kategori', 'Mengedit kategori: Alat Kebersihan Manual', '2026-04-09 06:05:23', '2026-04-09 06:05:23'),
(78, 1, 'Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: hhhhh', '2026-04-09 06:05:39', '2026-04-09 06:05:39'),
(79, 1, 'Hapus Kategori', 'Kategori', 'Menghapus kategori: hhhhh', '2026-04-09 06:05:45', '2026-04-09 06:05:45'),
(80, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: sapu lidi', '2026-04-09 06:08:46', '2026-04-09 06:08:46'),
(81, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 38) dengan status: disetujui', '2026-04-09 06:08:55', '2026-04-09 06:08:55'),
(82, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 38). Denda: Rp 0. Tipe: auto. Petugas: Petugas Lab', '2026-04-09 06:09:18', '2026-04-09 06:09:18'),
(83, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: vakum', '2026-04-09 07:30:59', '2026-04-09 07:30:59'),
(84, 3, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-09 07:31:17', '2026-04-09 07:31:17'),
(85, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 39) dengan status: disetujui', '2026-04-09 07:31:30', '2026-04-09 07:31:30'),
(86, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 40) dengan status: disetujui', '2026-04-09 07:31:33', '2026-04-09 07:31:33'),
(87, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 39). Denda: Rp 0. Tipe: auto. Petugas: Petugas Lab', '2026-04-09 07:31:55', '2026-04-09 07:31:55'),
(88, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 40). Denda: Rp 15,000. Tipe: manual. Petugas: Petugas Lab', '2026-04-09 07:32:16', '2026-04-09 07:32:16'),
(89, 1, 'Hapus Alat', 'Alat', 'Menghapus alat: Ember', '2026-04-09 07:34:28', '2026-04-09 07:34:28'),
(90, 1, 'Hapus User', 'User', 'Menghapus user: mimin', '2026-04-10 03:43:51', '2026-04-10 03:43:51'),
(91, 1, 'Edit User', 'User', 'Mengedit user: naifa', '2026-04-10 03:44:31', '2026-04-10 03:44:31'),
(92, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 37). Denda: Rp 20,000. Tipe: terlambat. Petugas: Petugas Lab', '2026-04-10 05:21:37', '2026-04-10 05:21:37'),
(93, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Sikat Wc', '2026-04-10 05:22:32', '2026-04-10 05:22:32'),
(94, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 41) dengan status: disetujui', '2026-04-10 05:24:05', '2026-04-10 05:24:05'),
(95, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 41). Denda: Rp 10,000. Tipe: kerusakan_lainnya. Petugas: Petugas Lab', '2026-04-10 05:24:30', '2026-04-10 05:24:30'),
(96, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-12 07:24:06', '2026-04-12 07:24:06'),
(97, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 42) dengan status: disetujui', '2026-04-12 07:24:18', '2026-04-12 07:24:18'),
(98, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Sapu', '2026-04-12 07:43:44', '2026-04-12 07:43:44'),
(99, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 42). Denda: Rp 0. Tipe: kerusakan_lainnya. Petugas: Petugas Lab', '2026-04-13 02:36:43', '2026-04-13 02:36:43'),
(100, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-13 03:09:20', '2026-04-13 03:09:20'),
(101, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Sapu', '2026-04-13 03:09:36', '2026-04-13 03:09:36'),
(102, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Tangga', '2026-04-13 03:09:50', '2026-04-13 03:09:50'),
(103, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 43) dengan status: disetujui', '2026-04-13 03:10:05', '2026-04-13 03:10:05'),
(104, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 44) dengan status: disetujui', '2026-04-13 03:10:09', '2026-04-13 03:10:09'),
(105, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 46) dengan status: disetujui', '2026-04-13 03:10:35', '2026-04-13 03:10:35'),
(106, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Tangga', '2026-04-13 03:48:18', '2026-04-13 03:48:18'),
(107, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 45) dengan status: ditolak', '2026-04-13 03:51:57', '2026-04-13 03:51:57'),
(108, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 47) dengan status: disetujui', '2026-04-13 03:52:17', '2026-04-13 03:52:17'),
(109, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 46). Denda: Rp 0. Tipe: kerusakan_lainnya. Petugas: Petugas Lab', '2026-04-13 03:52:34', '2026-04-13 03:52:34'),
(110, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 47). Denda: Rp 0. Tipe: kerusakan_lainnya. Petugas: Petugas Lab', '2026-04-13 03:52:45', '2026-04-13 03:52:45'),
(111, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 44). Denda: Rp 0. Tipe: kerusakan_lainnya. Petugas: Petugas Lab', '2026-04-13 03:52:56', '2026-04-13 03:52:56'),
(112, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 43). Denda: Rp 0. Tipe: kerusakan_lainnya. Petugas: Petugas Lab', '2026-04-13 03:53:21', '2026-04-13 03:53:21'),
(113, 1, 'Tambah User', 'User', 'Menambahkan user baru: azaria', '2026-04-17 00:35:08', '2026-04-17 00:35:08'),
(114, 1, 'Hapus User', 'User', 'Menghapus user: samsul', '2026-04-17 00:35:15', '2026-04-17 00:35:15'),
(115, 1, 'Edit Alat', 'Alat', 'Mengedit alat: kanebo', '2026-04-17 00:55:39', '2026-04-17 00:55:39'),
(116, 12, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-17 00:55:55', '2026-04-17 00:55:55'),
(117, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 48) dengan status: disetujui', '2026-04-17 00:56:09', '2026-04-17 00:56:09'),
(118, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 48). Denda: Rp 0. Tipe: kerusakan_lainnya. Metode pembayaran: tunai. Petugas: Petugas Lab', '2026-04-17 03:38:04', '2026-04-17 03:38:04'),
(119, NULL, 'Register', 'Auth', 'User yaya berhasil mendaftar.', '2026-04-17 04:11:06', '2026-04-17 04:11:06'),
(120, NULL, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-17 04:11:23', '2026-04-17 04:11:23'),
(121, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 49) dengan status: disetujui', '2026-04-17 04:11:58', '2026-04-17 04:11:58'),
(122, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 49). Denda: Rp 2,000. Tipe: terlambat. Metode pembayaran: qris. Petugas: Petugas Lab', '2026-04-17 04:12:23', '2026-04-17 04:12:23'),
(123, 2, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 49) ke yaya@gmail.com', '2026-04-17 04:16:01', '2026-04-17 04:16:01'),
(124, 2, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 49) ke stfadyasari@gmail.com', '2026-04-17 04:19:01', '2026-04-17 04:19:01'),
(125, 17, 'Register', 'Auth', 'User naifatricandra berhasil mendaftar.', '2026-04-17 04:32:29', '2026-04-17 04:32:29'),
(126, 1, 'Edit User', 'User', 'Mengedit user: naifatricandra', '2026-04-17 04:34:11', '2026-04-17 04:34:11'),
(127, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 49) ke stfadyasari@gmail.com', '2026-04-17 04:58:49', '2026-04-17 04:58:49'),
(128, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 49) sebesar Rp 2.000 dengan metode qris.', '2026-04-17 05:19:05', '2026-04-17 05:19:05'),
(129, NULL, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-17 05:23:25', '2026-04-17 05:23:25'),
(130, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 50) dengan status: disetujui', '2026-04-17 05:23:45', '2026-04-17 05:23:45'),
(131, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 50). Denda: Rp 10,000. Tipe: kerusakan_lainnya. Metode pembayaran: belum ditentukan. Petugas: Naifa Tri Candra', '2026-04-17 05:24:15', '2026-04-17 05:24:15'),
(132, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 50) sebesar Rp 10.000 dengan metode qris.', '2026-04-17 05:24:34', '2026-04-17 05:24:34'),
(133, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 50) ke stfadyasari@gmail.com', '2026-04-17 05:24:50', '2026-04-17 05:24:50'),
(134, 1, 'Hapus User', 'User', 'Menghapus user: azaria', '2026-04-18 02:13:06', '2026-04-18 02:13:06'),
(135, 1, 'Hapus User', 'User', 'Menghapus user: nanay', '2026-04-18 02:13:16', '2026-04-18 02:13:16'),
(136, 18, 'Register', 'Auth', 'User aza berhasil mendaftar.', '2026-04-18 02:17:47', '2026-04-18 02:17:47'),
(137, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Tangga', '2026-04-18 02:18:11', '2026-04-18 02:18:11'),
(138, 2, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 51) dengan status: disetujui', '2026-04-18 02:18:31', '2026-04-18 02:18:31'),
(139, 2, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 51). Denda: Rp 20,000. Tipe: kerusakan_lainnya. Metode pembayaran: belum ditentukan. Petugas: Petugas Lab', '2026-04-18 02:19:20', '2026-04-18 02:19:20'),
(140, 1, 'Edit User', 'User', 'Mengedit user: naifatricandra', '2026-04-18 02:20:56', '2026-04-18 02:20:56'),
(141, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 51) ke naifatricandra27@gmail.com', '2026-04-18 02:22:05', '2026-04-18 02:22:05'),
(142, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 51) sebesar Rp 20.000 dengan metode qris.', '2026-04-18 02:22:51', '2026-04-18 02:22:51'),
(143, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-18 02:23:22', '2026-04-18 02:23:22'),
(144, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 52) dengan status: disetujui', '2026-04-18 02:23:32', '2026-04-18 02:23:32'),
(145, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 52). Denda: Rp 5,000. Tipe: kerusakan_lainnya. Metode pembayaran: belum ditentukan. Petugas: Naifa Tri Candra', '2026-04-18 02:23:59', '2026-04-18 02:23:59'),
(146, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 52) ke naifatricandra27@gmail.com', '2026-04-18 02:24:30', '2026-04-18 02:24:30'),
(147, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 52) ke naifacandra27@gmail.com', '2026-04-18 02:25:20', '2026-04-18 02:25:20'),
(148, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 52) sebesar Rp 5.000 dengan metode qris.', '2026-04-18 02:25:58', '2026-04-18 02:25:58'),
(149, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 52) ke naifacandra27@gmail.com', '2026-04-18 02:26:17', '2026-04-18 02:26:17'),
(150, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-18 02:56:19', '2026-04-18 02:56:19'),
(151, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 53) dengan status: disetujui', '2026-04-18 02:56:25', '2026-04-18 02:56:25'),
(152, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 53). Denda: Rp 0. Tipe: kerusakan_lainnya. Metode pembayaran: tunai. Petugas: Naifa Tri Candra', '2026-04-18 02:58:02', '2026-04-18 02:58:02'),
(153, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-18 03:09:30', '2026-04-18 03:09:30'),
(154, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 54) dengan status: disetujui', '2026-04-18 03:09:44', '2026-04-18 03:09:44'),
(155, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 54). Denda: Rp 0. Tipe: kerusakan_lainnya. Metode pembayaran: qris. Petugas: Naifa Tri Candra', '2026-04-18 03:10:01', '2026-04-18 03:10:01'),
(156, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-18 03:27:03', '2026-04-18 03:27:03'),
(157, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Ember', '2026-04-18 03:27:14', '2026-04-18 03:27:14'),
(158, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 55) dengan status: disetujui', '2026-04-18 03:27:25', '2026-04-18 03:27:25'),
(159, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 55). Denda: Rp 20,000. Tipe: kerusakan_lainnya. Metode pembayaran: qris. Petugas: Naifa Tri Candra', '2026-04-18 03:27:48', '2026-04-18 03:27:48'),
(160, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Memproses notifikasi WhatsApp pengembalian untuk peminjaman (ID: 55) ke 6285187807857', '2026-04-18 03:33:57', '2026-04-18 03:33:57'),
(161, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 54) ke naifacandra27@gmail.com', '2026-04-18 03:37:15', '2026-04-18 03:37:15'),
(162, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 55) sebesar Rp 20.000 dengan metode qris.', '2026-04-18 03:45:19', '2026-04-18 03:45:19'),
(163, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-18 03:50:08', '2026-04-18 03:50:08'),
(164, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 57) dengan status: disetujui', '2026-04-18 03:50:16', '2026-04-18 03:50:16'),
(165, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 56) dengan status: disetujui', '2026-04-18 03:50:20', '2026-04-18 03:50:20'),
(166, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 56). Denda: Rp 10,000. Tipe: kerusakan_lainnya. Metode pembayaran: belum ditentukan. Petugas: Naifa Tri Candra', '2026-04-18 03:50:58', '2026-04-18 03:50:58'),
(167, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 56) sebesar Rp 10.000 dengan metode tunai.', '2026-04-18 03:51:39', '2026-04-18 03:51:39'),
(168, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 56) ke naifacandra27@gmail.com', '2026-04-18 03:51:57', '2026-04-18 03:51:57'),
(169, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 57). Denda: Rp 0. Tipe: kerusakan_lainnya. Metode pembayaran: tunai. Petugas: Naifa Tri Candra', '2026-04-18 03:55:46', '2026-04-18 03:55:46'),
(170, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 57) ke naifacandra27@gmail.com', '2026-04-18 03:56:01', '2026-04-18 03:56:01'),
(171, 1, 'Tambah User', 'User', 'Menambahkan user baru: samsul', '2026-04-18 04:15:20', '2026-04-18 04:15:20'),
(172, 1, 'Hapus User', 'User', 'Menghapus user: samsul', '2026-04-18 04:15:54', '2026-04-18 04:15:54'),
(173, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: mouse', '2026-04-18 04:40:50', '2026-04-18 04:40:50'),
(174, 1, 'Hapus Alat', 'Alat', 'Menghapus alat: mouse', '2026-04-18 04:40:58', '2026-04-18 04:40:58'),
(175, 1, 'Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: Alat Kebersihan Manual', '2026-04-18 04:41:29', '2026-04-18 04:41:29'),
(176, 1, 'Hapus Kategori', 'Kategori', 'Menghapus kategori: Alat Kebersihan Manual', '2026-04-18 04:41:37', '2026-04-18 04:41:37'),
(177, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-18 04:42:14', '2026-04-18 04:42:14'),
(178, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 58) dengan status: disetujui', '2026-04-18 04:42:29', '2026-04-18 04:42:29'),
(179, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 58). Denda: Rp 5,000. Tipe: kerusakan_lainnya. Metode pembayaran: belum ditentukan. Petugas: Naifa Tri Candra', '2026-04-18 04:44:10', '2026-04-18 04:44:10'),
(180, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 58) sebesar Rp 5.000 dengan metode tunai.', '2026-04-18 04:44:30', '2026-04-18 04:44:30'),
(181, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 58) ke naifacandra27@gmail.com', '2026-04-18 04:44:47', '2026-04-18 04:44:47'),
(182, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: Sikat Wc', '2026-04-18 05:44:13', '2026-04-18 05:44:13'),
(183, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 59) dengan status: disetujui', '2026-04-18 05:44:25', '2026-04-18 05:44:25'),
(184, 1, 'Hapus User', 'User', 'Menghapus user: yaya', '2026-04-19 13:56:12', '2026-04-19 13:56:12'),
(185, 1, 'Tambah User', 'User', 'Menambahkan user baru: samsul', '2026-04-19 13:56:44', '2026-04-19 13:56:44'),
(186, 1, 'Hapus User', 'User', 'Menghapus user: samsul', '2026-04-19 13:56:50', '2026-04-19 13:56:50'),
(187, 1, 'Tambah Alat', 'Alat', 'Menambahkan alat baru: mouse', '2026-04-19 13:57:28', '2026-04-19 13:57:28'),
(188, 1, 'Hapus Alat', 'Alat', 'Menghapus alat: mouse', '2026-04-19 13:57:34', '2026-04-19 13:57:34'),
(189, 1, 'Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: ulang tahun', '2026-04-19 13:57:50', '2026-04-19 13:57:50'),
(190, 1, 'Edit Kategori', 'Kategori', 'Mengedit kategori: ulang tahun', '2026-04-19 13:58:04', '2026-04-19 13:58:04'),
(191, 1, 'Hapus Kategori', 'Kategori', 'Menghapus kategori: ulang tahun', '2026-04-19 13:58:09', '2026-04-19 13:58:09'),
(192, 1, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Memproses notifikasi WhatsApp pengembalian untuk peminjaman (ID: 52) ke 6285187807857', '2026-04-19 13:58:24', '2026-04-19 13:58:24'),
(193, 18, 'Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: kanebo', '2026-04-19 14:01:58', '2026-04-19 14:01:58'),
(194, 17, 'Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: 60) dengan status: disetujui', '2026-04-19 14:02:11', '2026-04-19 14:02:11'),
(195, 17, 'Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: 59). Denda: Rp 10,000. Tipe: kerusakan_lainnya. Metode pembayaran: belum ditentukan. Petugas: Naifa Tri Candra', '2026-04-19 14:02:59', '2026-04-19 14:02:59'),
(196, 17, 'Pelunasan Denda', 'Peminjaman', 'Melunasi denda peminjaman (ID: 59) sebesar Rp 10.000 dengan metode qris.', '2026-04-19 14:03:13', '2026-04-19 14:03:13'),
(197, 17, 'Kirim Notifikasi Pengembalian', 'Peminjaman', 'Mengirim notifikasi email pengembalian untuk peminjaman (ID: 59) ke naifacandra27@gmail.com', '2026-04-19 14:03:30', '2026-04-19 14:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(11, '0001_01_01_000001_create_cache_table', 2),
(12, '0001_01_01_000002_create_jobs_table', 2),
(13, '2026_02_07_030453_create_kategoris_table', 3),
(14, '2026_02_07_030502_create_alats_table', 4),
(15, '2026_02_07_030510_create_peminjamen_table', 4),
(16, '2026_02_07_030516_create_detail_peminjamen_table', 4),
(17, '2026_02_07_030524_create_log_aktivitas_table', 4),
(18, '2026_02_10_131738_add_foto_to_users_table', 4),
(19, '2026_04_01_000001_update_alat_kondisi_fields', 5),
(20, '2026_04_01_000002_update_detail_peminjaman_kondisi_fields', 5),
(21, '2026_04_13_000001_create_notifications_table', 6),
(22, '2026_04_17_000001_add_metode_pembayaran_to_peminjaman_table', 7),
(23, '2026_04_17_000002_add_contact_fields_to_users_table', 8),
(24, '2026_04_17_000003_add_alamat_to_users_table', 9),
(25, '2026_04_17_000004_add_status_pembayaran_denda_to_peminjaman_table', 10),
(26, '2026_04_18_000020_add_notifikasi_pengembalian_kanal_to_peminjaman_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0d3684e5-7660-4182-9686-452a5a616b15', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":52,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 02:23:22', '2026-04-18 02:23:22'),
('0f8b83e1-1308-46ae-81d6-fdd5771d9709', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 13 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":50,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-17 05:23:26', '2026-04-17 05:23:26'),
('118eb1a8-73b9-4d26-a74f-85195564daaa', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"sitifadya sari mengajukan peminjaman 13 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":50,\"status_pinjam\":\"menunggu\",\"actor_name\":\"sitifadya sari\"}', NULL, '2026-04-17 05:23:26', '2026-04-17 05:23:26'),
('1df85750-8ccd-48d2-8c94-312341c99d5a', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":52,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:23:22', '2026-04-18 02:23:22'),
('20ab064e-2916-42cb-8fc0-7c813f306f45', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":51,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:18:14', '2026-04-18 02:18:14'),
('229c0881-67d1-4cef-bf8a-9332c4047a60', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 9 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":53,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:56:19', '2026-04-18 02:56:19'),
('23fa4674-3357-4a92-a85b-3e9ddaa2739e', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":57,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:50:08', '2026-04-18 03:50:08'),
('24947a21-608e-4687-bc11-c84bba23b061', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":54,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:09:30', '2026-04-18 03:09:30'),
('325a4afe-1716-4fd8-b716-56d94c3a4e42', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":52,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:23:22', '2026-04-18 02:23:22'),
('38b6d825-91b5-447e-846b-a54727069a8f', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 9 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":53,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 02:56:19', '2026-04-18 02:56:19'),
('396a7a39-480d-49b0-8b9e-a81220b6a1c0', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"sitifadya sari mengajukan peminjaman 13 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":50,\"status_pinjam\":\"menunggu\",\"actor_name\":\"sitifadya sari\"}', NULL, '2026-04-17 05:23:26', '2026-04-17 05:23:26'),
('435414fd-6386-44eb-bad9-00106da3542d', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":58,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 04:42:14', '2026-04-18 04:42:14'),
('457bdaf5-8ba3-41eb-929d-23dbaf7ba52a', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":59,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 05:44:13', '2026-04-18 05:44:13'),
('482d8d05-fa2f-417d-85a7-db2f33f2dcb5', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"sitifadya sari mengajukan peminjaman 13 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":50,\"status_pinjam\":\"menunggu\",\"actor_name\":\"sitifadya sari\"}', NULL, '2026-04-17 05:23:26', '2026-04-17 05:23:26'),
('48b534b6-b6f5-4a56-a6e3-4e6cbce7d20c', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 12, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 7 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":48,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-17 00:55:58', '2026-04-17 00:55:58'),
('4d97fd7f-83ac-446c-99b1-c1f50e5c6309', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":49,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-17 04:11:25', '2026-04-17 04:11:25'),
('4edb1979-f80b-49dc-b1c2-ca5c4258d58d', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":54,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:09:30', '2026-04-18 03:09:30'),
('513576cd-d306-4a5d-b377-7f8cf2c13c47', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 9 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":53,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:56:19', '2026-04-18 02:56:19'),
('520a6175-91c3-4954-a1d3-f5f4f54c3405', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":58,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 04:42:14', '2026-04-18 04:42:14'),
('53f98cde-4d11-4edc-b9cd-838370ed8dd5', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 2 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":56,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 03:27:14', '2026-04-18 03:27:14'),
('55967bd3-036a-4153-a130-fa2b3e0dd985', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":52,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:23:22', '2026-04-18 02:23:22'),
('57833e1f-6f63-4019-b4f6-a2dc6060f8e9', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":54,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:09:30', '2026-04-18 03:09:30'),
('5b28b4ed-08a1-4f41-9f21-dabd5db90b0d', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":57,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:50:08', '2026-04-18 03:50:08'),
('5c1ac8e5-a811-4fae-befe-f7bde338975c', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 12, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 4 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":47,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-13 03:48:22', '2026-04-13 03:48:22'),
('5ed8701e-8e8e-4ded-bd67-521eb03f6fb1', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"naifatric mengajukan peminjaman 4 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":47,\"status_pinjam\":\"menunggu\",\"actor_name\":\"naifatric\"}', NULL, '2026-04-13 03:48:22', '2026-04-13 03:48:22'),
('635d7e9a-e745-483c-b2ca-32411dc7954e', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":59,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 05:44:13', '2026-04-18 05:44:13'),
('699e0847-08d8-4f12-99b8-155b5e4e8bc2', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":60,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-19 14:02:01', '2026-04-19 14:02:01'),
('6aa7ce5f-a1d4-41ba-82af-aa207668c393', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":54,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 03:09:30', '2026-04-18 03:09:30'),
('6b8e885c-8db9-4f7e-935b-c35e81d27699', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"sitifadya sari mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":49,\"status_pinjam\":\"menunggu\",\"actor_name\":\"sitifadya sari\"}', NULL, '2026-04-17 04:11:25', '2026-04-17 04:11:25'),
('718d61a3-e437-494c-8de2-249401f524d7', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":60,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-19 14:02:01', '2026-04-19 14:02:01'),
('71e3dc02-e7bf-46f0-a9d1-2f52582b9384', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":57,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:50:08', '2026-04-18 03:50:08'),
('72835855-f0f5-4c5c-a36c-8429cc18377d', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":58,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 04:42:14', '2026-04-18 04:42:14'),
('75155b08-1f27-43ab-b7d3-396fc17b0104', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":51,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:18:14', '2026-04-18 02:18:14'),
('7e80b170-8420-43f0-9a4b-23c474b3a9ba', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"naifatric mengajukan peminjaman 7 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":48,\"status_pinjam\":\"menunggu\",\"actor_name\":\"naifatric\"}', NULL, '2026-04-17 00:55:58', '2026-04-17 00:55:58'),
('8097cce8-5c47-47f9-a069-363bc87ef92c', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":51,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:18:14', '2026-04-18 02:18:14'),
('83dedb1c-504d-445c-8d70-8d32b6c3ba86', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 2 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":56,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:27:15', '2026-04-18 03:27:15'),
('84372ac8-f943-4dc9-ad88-3887d1e05a98', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 2 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":56,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:27:15', '2026-04-18 03:27:15'),
('86051feb-55ce-4e5b-8ca8-6d7c60310210', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":59,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 05:44:13', '2026-04-18 05:44:13'),
('8cea34d6-f4b3-4c4f-8caf-266dd3964b55', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":58,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 04:42:14', '2026-04-18 04:42:14'),
('9100983b-d8a8-4012-bd87-167021392a34', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":51,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 02:18:14', '2026-04-18 02:18:14'),
('9d4cd78f-4cff-45a1-8cf1-3deaeebfdba9', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":55,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:27:04', '2026-04-18 03:27:04'),
('a924cd6c-6c85-453f-8dfa-db3c303639e6', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 9 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":53,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 02:56:19', '2026-04-18 02:56:19'),
('b5db6717-0bfb-4be5-a6a7-bed81e61147b', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"naifatric mengajukan peminjaman 7 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":48,\"status_pinjam\":\"menunggu\",\"actor_name\":\"naifatric\"}', NULL, '2026-04-17 00:55:58', '2026-04-17 00:55:58'),
('bc7b4b3a-efc4-4f13-a744-a74d2bae11c9', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"naifatric mengajukan peminjaman 4 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":47,\"status_pinjam\":\"menunggu\",\"actor_name\":\"naifatric\"}', '2026-04-13 03:51:50', '2026-04-13 03:48:22', '2026-04-13 03:51:50'),
('bd40feb2-142c-4f7f-a675-b8f5d95b8b28', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":55,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:27:04', '2026-04-18 03:27:04'),
('be0ad6bb-73b2-4b9c-acd8-31cbc8aa3f57', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"sitifadya sari mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":49,\"status_pinjam\":\"menunggu\",\"actor_name\":\"sitifadya sari\"}', NULL, '2026-04-17 04:11:25', '2026-04-17 04:11:25'),
('c0f9f86f-f22e-49ac-9de1-71fe52f79ff2', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 2 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":56,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:27:14', '2026-04-18 03:27:14'),
('c21661ee-bac9-4e97-a66e-4c1f4e2de2f0', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":55,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 03:27:04', '2026-04-18 03:27:04'),
('d4ed99d3-9bf0-4463-8b1d-ec854ce706ed', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 17, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":60,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-19 14:02:01', '2026-04-19 14:02:01'),
('dd79efae-a0a4-4ccf-8b9e-0f1ec42b61d9', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":55,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 03:27:04', '2026-04-18 03:27:04'),
('dfec77a6-b5ff-4970-98cc-a103d65299cc', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 2, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":59,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-18 05:44:13', '2026-04-18 05:44:13'),
('e9c9e46d-ccd6-420c-b280-d723cddc67c5', 'App\\Notifications\\PengajuanPeminjamanTerkirimNotification', 'App\\Models\\User', 18, '{\"title\":\"Pengajuan berhasil dikirim\",\"message\":\"Pengajuan peminjaman 12 item berhasil dikirim dan sedang menunggu verifikasi petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/peminjam\\/pinjaman\",\"peminjaman_id\":57,\"status_pinjam\":\"menunggu\"}', NULL, '2026-04-18 03:50:08', '2026-04-18 03:50:08'),
('f388aa47-792a-4ed0-90e7-2b200228a821', 'App\\Notifications\\PeminjamanBaruNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan peminjaman baru\",\"message\":\"azariaastarlizac mengajukan peminjaman 12 item dan menunggu verifikasi.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/petugas\\/permintaan\",\"peminjaman_id\":60,\"status_pinjam\":\"menunggu\",\"actor_name\":\"azariaastarlizac\"}', NULL, '2026-04-19 14:02:01', '2026-04-19 14:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_harus_kembali` date NOT NULL,
  `tgl_kembali_real` date DEFAULT NULL,
  `status_pinjam` enum('menunggu','disetujui','ditolak','kembali','telat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `user_id` bigint UNSIGNED NOT NULL,
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `denda` decimal(10,2) NOT NULL DEFAULT '0.00',
  `keterangan_denda` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `metode_pembayaran` enum('tunai','qris','belum ditentukan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum ditentukan',
  `status_pembayaran_denda` enum('belum dibayar','lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lunas',
  `tgl_pelunasan_denda` timestamp NULL DEFAULT NULL,
  `notifikasi_pengembalian_kanal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tgl_pinjam`, `tgl_harus_kembali`, `tgl_kembali_real`, `status_pinjam`, `user_id`, `petugas_id`, `denda`, `keterangan_denda`, `metode_pembayaran`, `status_pembayaran_denda`, `tgl_pelunasan_denda`, `notifikasi_pengembalian_kanal`, `created_at`, `updated_at`) VALUES
(1, '2026-02-09', '2026-02-11', '2026-02-09', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-09 02:30:00', '2026-02-09 10:39:45'),
(2, '2026-02-10', '2026-02-12', '2026-02-10', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-09 22:10:10', '2026-02-09 22:10:51'),
(3, '2026-02-10', '2026-02-11', '2026-02-10', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-10 03:10:14', '2026-02-10 03:48:30'),
(4, '2026-02-10', '2026-02-11', '2026-02-10', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-10 03:54:22', '2026-02-10 03:55:20'),
(5, '2026-02-11', '2026-02-12', '2026-02-11', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-10 06:09:11', '2026-02-11 01:04:26'),
(6, '2026-02-11', '2026-02-12', NULL, 'ditolak', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-10 20:09:16', '2026-02-10 20:11:47'),
(7, '2026-02-11', '2026-02-12', '2026-02-11', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-11 01:10:23', '2026-02-11 01:11:25'),
(8, '2026-02-11', '2026-02-12', '2026-02-11', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-11 01:10:47', '2026-02-11 08:12:43'),
(9, '2026-02-11', '2026-02-12', '2026-02-11', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-11 08:21:40', '2026-02-11 08:28:29'),
(10, '2026-02-11', '2026-02-12', '2026-02-11', 'kembali', 3, 2, 40000.00, 'Denda manual petugas', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-02-11 08:21:54', '2026-02-11 08:38:19'),
(11, '2026-02-12', '2026-02-13', '2026-02-11', 'kembali', 3, 2, 400000.00, 'Denda manual petugas', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-02-11 08:30:15', '2026-02-11 09:03:51'),
(12, '2026-02-11', '2026-02-12', '2026-02-11', 'kembali', 3, 2, 40000.00, 'Denda manual petugas', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-02-11 10:06:29', '2026-02-11 11:39:36'),
(13, '2026-02-11', '2026-02-12', '2026-03-17', 'kembali', 3, 2, 40000.00, 'Denda manual petugas', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-02-11 10:06:43', '2026-03-17 07:34:44'),
(14, '2026-02-11', '2026-02-13', '2026-02-11', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-02-11 11:41:43', '2026-02-11 11:42:53'),
(15, '2026-03-17', '2026-03-18', '2026-03-17', 'kembali', 3, 2, 0.00, 'terimakasih sudah meminjamkan barang', 'belum ditentukan', 'lunas', NULL, NULL, '2026-03-17 06:59:47', '2026-03-17 07:06:35'),
(16, '2026-03-17', '2026-03-18', '2026-03-17', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-03-17 07:29:11', '2026-03-17 07:32:27'),
(17, '2026-03-17', '2026-03-18', '2026-03-17', 'kembali', 3, 2, 45000.00, 'Denda manual petugas', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-03-17 08:28:36', '2026-03-17 09:01:10'),
(18, '2026-03-17', '2026-03-18', '2026-03-17', 'kembali', 3, 2, 20000.00, 'Denda manual petugas', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-03-17 09:00:31', '2026-03-17 09:05:00'),
(19, '2026-04-01', '2026-04-02', '2026-04-01', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 14:24:06', '2026-04-01 14:26:56'),
(20, '2026-04-01', '2026-04-02', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 14:24:20', '2026-04-01 17:55:43'),
(21, '2026-04-01', '2026-04-02', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 14:25:04', '2026-04-01 18:39:25'),
(23, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 17:57:58', '2026-04-01 23:54:31'),
(24, '2026-04-02', '2026-04-03', NULL, 'ditolak', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 18:38:10', '2026-04-01 23:54:05'),
(25, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 23:53:06', '2026-04-02 01:59:08'),
(26, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-01 23:53:32', '2026-04-01 23:56:27'),
(27, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-02 02:00:32', '2026-04-02 02:01:31'),
(28, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-02 02:06:46', '2026-04-02 02:07:34'),
(29, '2026-04-02', '2026-04-03', '2026-04-06', 'kembali', 3, 2, -3000.00, 'Terlambat -3 hari @ Rp 1.000/hari', 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-02 02:09:14', '2026-04-06 04:56:33'),
(30, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 10000.00, 'Denda manual (kerusakan/penggantian barang)', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-02 02:17:07', '2026-04-02 02:18:09'),
(31, '2026-04-02', '2026-04-03', '2026-04-02', 'kembali', 3, 2, 40000.00, 'Denda manual (kerusakan/penggantian barang)', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-02 02:26:37', '2026-04-02 02:27:39'),
(32, '2026-04-06', '2026-04-07', '2026-04-06', 'kembali', 3, 2, 10000.00, 'Denda manual (kerusakan/penggantian barang)', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-06 04:54:37', '2026-04-06 04:57:18'),
(33, '2026-04-08', '2026-04-09', '2026-04-08', 'kembali', 3, 2, 20000.00, 'Denda manual (kerusakan/penggantian barang)', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-08 03:53:21', '2026-04-08 03:55:00'),
(34, '2026-04-08', '2026-04-09', '2026-04-08', 'kembali', 12, 2, 0.00, 'Tepat waktu, tanpa denda', 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-08 04:39:21', '2026-04-08 04:39:49'),
(35, '2026-04-08', '2026-04-09', '2026-04-08', 'kembali', 3, 2, 20000.00, 'Denda manual (kerusakan/penggantian barang)', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-08 04:59:39', '2026-04-08 05:01:00'),
(36, '2026-04-08', '2026-04-09', '2026-04-08', 'kembali', 3, 2, 0.00, 'Tepat waktu, tanpa denda', 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-08 05:39:20', '2026-04-08 05:40:40'),
(37, '2026-04-08', '2026-04-09', '2026-04-10', 'kembali', 3, 2, 20000.00, 'Denda terlambat', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-08 05:46:53', '2026-04-10 05:21:36'),
(38, '2026-04-09', '2026-04-10', '2026-04-09', 'kembali', 3, 2, 0.00, 'Tepat waktu, tanpa denda', 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-09 06:08:46', '2026-04-09 06:09:18'),
(39, '2026-04-09', '2026-04-10', '2026-04-09', 'kembali', 3, 2, 0.00, 'Tepat waktu, tanpa denda', 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-09 07:30:59', '2026-04-09 07:31:55'),
(40, '2026-04-09', '2026-04-10', '2026-04-09', 'kembali', 3, 2, 15000.00, 'Denda manual (kerusakan/penggantian barang)', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-09 07:31:17', '2026-04-09 07:32:16'),
(41, '2026-04-10', '2026-04-11', '2026-04-10', 'kembali', 12, 2, 10000.00, 'Denda kerusakan/lainnya', 'belum ditentukan', 'belum dibayar', NULL, NULL, '2026-04-10 05:22:32', '2026-04-10 05:24:30'),
(42, '2026-04-12', '2026-04-13', '2026-04-13', 'kembali', 12, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-12 07:24:05', '2026-04-13 02:36:43'),
(43, '2026-04-12', '2026-04-13', '2026-04-13', 'kembali', 12, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-12 07:43:44', '2026-04-13 03:53:21'),
(44, '2026-04-13', '2026-04-14', '2026-04-13', 'kembali', 12, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-13 03:09:20', '2026-04-13 03:52:56'),
(45, '2026-04-15', '2026-04-16', NULL, 'ditolak', 12, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-13 03:09:36', '2026-04-13 03:51:57'),
(46, '2026-04-16', '2026-04-17', '2026-04-13', 'kembali', 12, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-13 03:09:50', '2026-04-13 03:52:34'),
(47, '2026-04-13', '2026-04-14', '2026-04-13', 'kembali', 12, 2, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-13 03:48:18', '2026-04-13 03:52:45'),
(48, '2026-04-17', '2026-04-18', '2026-04-17', 'kembali', 12, 2, 0.00, NULL, 'tunai', 'lunas', NULL, NULL, '2026-04-17 00:55:55', '2026-04-17 03:38:04'),
(51, '2026-04-18', '2026-04-19', '2026-04-18', 'kembali', 18, 2, 20000.00, 'Denda kerusakan/lainnya', 'qris', 'lunas', '2026-04-18 02:22:51', NULL, '2026-04-18 02:18:11', '2026-04-18 02:22:51'),
(52, '2026-04-18', '2026-04-19', '2026-04-18', 'kembali', 18, 17, 5000.00, 'Denda kerusakan/lainnya', 'qris', 'lunas', '2026-04-18 02:25:58', 'wa', '2026-04-18 02:23:22', '2026-04-19 13:58:23'),
(53, '2026-04-18', '2026-04-20', '2026-04-18', 'kembali', 18, 17, 0.00, NULL, 'tunai', 'lunas', '2026-04-18 02:58:02', NULL, '2026-04-18 02:56:19', '2026-04-18 02:58:02'),
(54, '2026-04-18', '2026-04-19', '2026-04-18', 'kembali', 18, 17, 0.00, NULL, 'qris', 'lunas', '2026-04-18 03:10:01', 'email', '2026-04-18 03:09:30', '2026-04-18 03:37:15'),
(55, '2026-04-18', '2026-04-19', '2026-04-18', 'kembali', 18, 17, 20000.00, 'Denda kerusakan/lainnya', 'qris', 'lunas', '2026-04-18 03:45:19', 'wa', '2026-04-18 03:27:03', '2026-04-18 03:45:19'),
(56, '2026-04-18', '2026-04-20', '2026-04-18', 'kembali', 18, 17, 10000.00, 'Denda kerusakan/lainnya', 'tunai', 'lunas', '2026-04-18 03:51:39', 'email', '2026-04-18 03:27:14', '2026-04-18 03:51:57'),
(57, '2026-04-18', '2026-04-19', '2026-04-18', 'kembali', 18, 17, 0.00, NULL, 'tunai', 'lunas', '2026-04-18 03:55:46', 'email', '2026-04-18 03:50:08', '2026-04-18 03:56:01'),
(58, '2026-04-18', '2026-04-19', '2026-04-18', 'kembali', 18, 17, 5000.00, 'Denda kerusakan/lainnya', 'tunai', 'lunas', '2026-04-18 04:44:30', 'email', '2026-04-18 04:42:14', '2026-04-18 04:44:47'),
(59, '2026-04-18', '2026-04-19', '2026-04-19', 'kembali', 18, 17, 10000.00, 'Denda kerusakan/lainnya', 'qris', 'lunas', '2026-04-19 14:03:13', 'email', '2026-04-18 05:44:13', '2026-04-19 14:03:30'),
(60, '2026-04-19', '2026-04-20', NULL, 'disetujui', 18, 17, 0.00, NULL, 'belum ditentukan', 'lunas', NULL, NULL, '2026-04-19 14:01:58', '2026-04-19 14:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2026-02-09 01:05:30', '2026-02-09 01:05:30'),
(2, 'petugas', '2026-02-09 01:05:30', '2026-02-09 01:05:30'),
(3, 'peminjam', '2026-02-09 01:05:30', '2026-02-09 01:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EzftSITHjH0HhYllGT6SzsuyHX36J1IUCYtUtexk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWNnR1IxTXBITjBDRk0wWjJpUFFPVHVaMU91RzRPTkh6NXdPaUw0NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1776606855),
('gBcg5mNxYinf53Wn5YYhwwPVEeIwjO6rIhIl32OA', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVWd6SHUzdk5kY3c4YVllVDg2MVMxM3IwM056dVhTN28waGdqWHo4ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL2F1ZGl0LXJpd2F5YXQ/cHJpbnQ9dHJ1ZSI7czo1OiJyb3V0ZSI7czoyNzoicGV0dWdhcy5hdWRpdC1yaXdheWF0LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTc7fQ==', 1776607510),
('KI48ixiPVYIwhR51xsEPchtfNa4OvgrrMwlsKKw9', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibTRKWnhBS0JHd2ZEUlFGTG83dTVXZjVrZDc1MllxMHBxN0dWNzNlTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1pbmphbS9hbGF0IjtzOjU6InJvdXRlIjtzOjEzOiJwZW1pbmphbS5hbGF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTg7fQ==', 1776607337),
('lybKjuaXBIfk54BYzHLSVh6wozF10P253FhklM9I', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXdtOWFaWURUd0VXT2hDSjFXcXVwazl5WlZzMlhkWlk5QmVicnBjeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdWRpdC1yaXdheWF0IjtzOjU6InJvdXRlIjtzOjE5OiJhdWRpdC1yaXdheWF0LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1776607294);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_akun` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nomor_whatsapp`, `alamat`, `nama_lengkap`, `kelas`, `jurusan`, `foto`, `status_akun`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$4zBSOffrFehl4Nx/nYlrueZG2HBoBPJ3QO.huXxgDVuKUKHctN8cC', NULL, NULL, NULL, 'Administrator', '-', '-', 'profile_photos/2vysyse8J3kBdpGoPefKerggcA70IUFrex1w2wCu.jpg', 'aktif', 1, '2026-02-09 01:05:30', '2026-04-18 05:34:08'),
(2, 'petugas', '$2y$12$I8BRS77rE/ZYv5xI7xBLPucd5RTweGCjzf6cg0lOAOC5h6nEyp3ym', NULL, NULL, NULL, 'Petugas Lab', '-', '-', NULL, 'aktif', 2, '2026-02-09 01:05:31', '2026-02-09 01:05:31'),
(3, 'siswa', '$2y$12$1AJqg6276Tqi4dv2aYTXYOIEKCEe.ZR7hZgD6mswDTjjjEKZZhXua', NULL, NULL, NULL, 'Siswa Peminjam', 'XII RPL 1', 'RPL', NULL, 'aktif', 3, '2026-02-09 01:05:31', '2026-02-09 01:05:31'),
(12, 'naifa', '$2y$12$rYuWH4ZJa9RPrZotPW1IPeQvuppbmT0ixjiqtVx28NgbWMQPSMBnC', NULL, NULL, NULL, 'naifatric', 'X PPLG II', 'PPLG', NULL, 'aktif', 3, '2026-04-08 04:39:03', '2026-04-10 03:44:31'),
(17, 'naifatricandra', '$2y$12$J/hXvWq8kcibU/vY6dl8C.VC3wqb6WTmdXEedRRfZtPEe1YUDSa1m', 'petugassiput@gmail.com', '088213525676', 'jln.bukit asam ujung', 'Naifa Tri Candra', 'XII PPLG II', 'PPLG', 'profile_photos/z2a6XQ6DyCHk28N6KSzqiResbCzTf2gES9bUuXpG.jpg', 'aktif', 2, '2026-04-17 04:32:29', '2026-04-18 05:41:51'),
(18, 'aza', '$2y$12$SV1qq9s1PxC3nvCWsjzMVOd25a9Q29KwLSCIBAccZrp18BqdAZwqK', 'naifacandra27@gmail.com', '085187807857', 'jln bukit asam', 'azariaastarlizac', 'XII PPLG II', 'pplg 2', 'profile_photos/43wRXvDK8E6XXWg1GtonvKomEhYM6xvQdpq1dfuP.jpg', 'aktif', 3, '2026-04-18 02:17:46', '2026-04-18 05:47:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alat_kode_alat_unique` (`kode_alat`),
  ADD KEY `alat_kategori_id_foreign` (`kategori_id`);

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
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_peminjaman_peminjaman_id_foreign` (`peminjaman_id`),
  ADD KEY `detail_peminjaman_alat_id_foreign` (`alat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_aktivitas_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
