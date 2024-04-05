-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2024 at 05:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penentuan-ukt-lama`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','verifikator') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint UNSIGNED DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `role`, `jurusan_id`, `password`, `created_at`, `updated_at`) VALUES
(11, 'tika', 'nuratika0552@gmail.com', 'superadmin', NULL, '$2y$10$Z9N.ecX5A3K3HYImn/GZAO9Ak28lK.A1RBIOm92Gjlk2bLEgIlKOm', '2023-11-29 01:06:26', '2023-12-29 02:56:44'),
(22, 'rizkypratama', 'ku@gmail.com', 'verifikator', 3, '$2y$10$3xQlkpWqyO/pDlon.OoxO.1rZ9KZJcNDVWVXL7FBR8xU35lhebu8u', '2023-12-29 01:39:07', '2024-03-31 17:41:19'),
(30, 'tika', 'tikaa@gmail.com', 'verifikator', 1, '$2y$10$YVWSnzDGj3E1FQ7OMU8/ee4v4ASX4vg.Vj5cxzToiAQTOyiXETwu2', '2023-12-29 21:33:37', '2024-03-09 20:12:57'),
(33, 'Rizky', 'rizkyganteng@gmail.com', 'verifikator', 2, '$2y$10$tr2QM96JsYKlMwhoB0BQreYjBc4R43Uno.foz37DlQl6HAKhoVJBy', '2024-01-02 03:59:51', '2024-01-02 04:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `arsips`
--

CREATE TABLE `arsips` (
  `id` bigint UNSIGNED NOT NULL,
  `id_folder` bigint NOT NULL,
  `no_pendaftaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_mahasiswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_prodi` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenjang` enum('D3','D4','S1 Terapan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_jurusan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_golongan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  `foto_slip_gaji` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_tempat_tinggal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_kendaraan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_daya_listrik` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_angkatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsips`
--

INSERT INTO `arsips` (`id`, `id_folder`, `no_pendaftaran`, `nama_mahasiswa`, `no_telepon`, `alamat`, `jenis_kelamin`, `nama_prodi`, `jenjang`, `nama_jurusan`, `nama_golongan`, `nominal`, `foto_slip_gaji`, `foto_tempat_tinggal`, `foto_kendaraan`, `foto_daya_listrik`, `tahun_angkatan`, `created_at`, `updated_at`) VALUES
(14, 8, '34', 'nu', '085823593942', 'gtong royong', 'Perempuan', 'Teknologi Rekayasa Perangkat Lunak', 'S1 Terapan', 'Rekayasa dan Komputer', 'K3', 1000000, '20240401014340_foto tempat tinggal rizky.jpeg', '20240401014340_foto tempat tinggal tika.jpeg', '20240401014340_erd.png', '20240401014340_foto tempat tinggal.jpeg', '0000', '2024-03-31 17:48:58', '2024-03-31 17:48:58'),
(18, 3, '190014567', 'Soleha Purnamasari', '085823593921', 'gotong royong', 'Perempuan', 'Teknologi Rekayasa Pangan', 'S1 Terapan', 'Pertanian', 'K5', 1500000, '20240401023318_foto tempat tinggal rizky.jpeg', '20240401023318_foto tempat tinggal rizky.jpeg', '20240401023318_foto tempat tinggal rizky.jpeg', '20240401023318_foto tempat tinggal rizky.jpeg', '2024', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(19, 3, '321', 'nur', '085823593942', 'gtong royong', 'Perempuan', 'Teknologi Rekayasa Perangkat Lunak', 'S1 Terapan', 'Rekayasa dan Komputer', 'K3', 1000000, '20240401112111_foto tempat tinggal tika.jpeg', '20240401112111_foto tempat tinggal tika.jpeg', '20240401112111_foto tempat tinggal.jpeg', '20240401112111_foto tempat tinggal.jpeg', '34', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(20, 8, '3211', 'nur', '085823593942', 'gtong royong', 'Perempuan', 'Teknologi Rekayasa Perangkat Lunak', 'S1 Terapan', 'Rekayasa dan Komputer', 'K2', 750000, '20240401122433_foto tempat tinggal.jpeg', '20240401122433_foto tempat tinggal tika.jpeg', NULL, '20240401122433_foto tempat tinggal rizky.jpeg', '3', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(21, 8, '00000', 'nur', '085823593942', 'gtong royong', 'Perempuan', 'Teknologi Rekayasa Perangkat Lunak', 'S1 Terapan', 'Rekayasa dan Komputer', 'K3', 1000000, '20240401123414_foto tempat tinggal rizky.jpeg', '20240401123414_foto tempat tinggal.jpeg', '20240401123414_daya listrik.jpg', '20240401123414_erd.png', '4', '2024-04-01 04:35:42', '2024-04-01 04:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_slip_gaji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_tempat_tinggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kendaraan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_daya_listrik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Belum Lengkap','Menunggu Verifikasi','Lulus Verifikasi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `golongan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(3, '2024 january', '2024-03-21 04:33:39', '2024-03-31 18:37:25'),
(8, 'SNBT 2024', '2024-03-28 22:18:39', '2024-03-28 22:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `golongans`
--

CREATE TABLE `golongans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` enum('D3','D4/S1 Terapan','S1 Terapan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_minimal` bigint DEFAULT NULL,
  `nilai_maksimal` bigint DEFAULT NULL,
  `nominal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongans`
--

INSERT INTO `golongans` (`id`, `nama`, `jenjang`, `nilai_minimal`, `nilai_maksimal`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 'K1', 'D3', 8, 12, '0', '2023-01-12 00:43:01', '2023-12-07 01:48:20'),
(2, 'K2', 'D3', 12, 17, '500000', '2023-01-12 00:43:01', '2023-12-07 01:48:42'),
(3, 'K3', 'D3', 17, 21, '750000', '2023-01-12 00:43:01', '2023-12-07 01:49:05'),
(4, 'K4', 'D3', 20, 20, '1000000', '2023-01-12 00:43:01', '2023-12-07 01:49:18'),
(5, 'K5', 'D3', 21, 24, '1250000', '2023-01-12 00:43:01', '2023-12-07 01:49:37'),
(6, 'K6', 'D3', 25, 25, '1500000', '2023-01-12 00:43:01', '2023-12-07 01:50:16'),
(7, 'K7', 'D3', 25, 30, '2400000', '2023-01-12 00:43:01', '2023-12-07 01:50:47'),
(8, 'K1', 'D4/S1 Terapan', 8, 12, '500000', '2023-01-12 00:43:01', '2023-12-07 01:55:36'),
(9, 'K2', 'D4/S1 Terapan', 12, 17, '750000', '2023-01-12 00:43:01', '2023-12-07 01:55:47'),
(10, 'K3', 'D4/S1 Terapan', 17, 21, '1000000', '2023-01-12 00:43:01', '2023-12-07 01:56:00'),
(11, 'K4', 'D4/S1 Terapan', 20, 20, '1250000', '2023-01-12 00:43:01', '2023-12-07 01:56:17'),
(13, 'K5', 'D4/S1 Terapan', 21, 24, '1500000', '2023-01-12 00:43:01', '2023-12-07 01:57:13'),
(14, 'K6', 'D4/S1 Terapan', 25, 25, '2400000', '2023-01-12 00:43:01', '2023-12-07 01:57:35'),
(15, 'K7', 'D4/S1 Terapan', 25, 30, '3500000', NULL, '2023-12-07 01:57:59'),
(16, 'K1', 'S1 Terapan', 8, 12, '500000', NULL, '2023-12-07 01:58:34'),
(17, 'K2', 'S1 Terapan', 12, 17, '1000000', '2023-12-01 01:16:22', '2023-12-07 01:58:50'),
(18, 'K3', 'S1 Terapan', 17, 21, '2500000', '2023-12-01 01:16:49', '2023-12-07 01:59:02'),
(19, 'K4', 'S1 Terapan', 20, 20, '3000000', '2023-12-01 01:17:11', '2023-12-07 01:59:15'),
(20, 'K5', 'S1 Terapan', 21, 24, '3500000', '2023-12-01 01:17:50', '2023-12-07 01:59:29'),
(21, 'K6', 'S1 Terapan', 25, 25, '4000000', '2023-12-01 01:18:19', '2023-12-07 01:59:48'),
(23, 'K7', 'S1 Terapan', 25, 30, '4500000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Pertanian', '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(2, 'Lingkungan dan Kehutanan', '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(3, 'Rekayasa dan Komputer', '2023-01-12 00:43:01', '2023-01-12 00:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Penghasilan Orang Tua', '2023-01-12 01:50:29', '2023-01-12 01:55:52'),
(2, 'Status Tempat Tinggal', '2023-01-12 01:51:21', '2023-01-12 01:51:21'),
(3, 'Kendaraan', '2023-01-12 01:51:57', '2023-01-12 01:51:57'),
(4, 'Fasilitas Rumah', '2023-01-12 01:53:22', '2023-01-12 01:53:22'),
(5, 'Penggunaan Daya Listrik', '2023-01-12 01:54:43', '2023-01-12 01:54:43'),
(6, 'Fasilitas Lain', '2023-01-12 01:55:39', '2023-01-12 01:55:39'),
(7, 'Jumlah Tanggungan Keluarga', '2023-01-12 01:57:02', '2023-01-12 01:57:02'),
(9, 'Penerimaan Bantuan dari Pemerintah', '2023-01-12 01:58:37', '2023-01-12 02:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nama`, `jenis_kelamin`, `no_telepon`, `alamat`, `prodi_id`, `password`, `created_at`, `updated_at`) VALUES
('00000', 'nur', 'Perempuan', '085823593942', 'gtong royong', 10, '$2y$10$6KOgSVH9Wtf89HH5vsOVjuyum96GVD01zjonzmrGdhsczWZmkBVOe', '2024-03-31 17:40:35', '2024-04-01 04:33:19'),
('nuratika0552@gmail.com', 'tika', 'Perempuan', '085823593942', 'gtong royong', 11, '$2y$10$8EeS5ZwGASRQrKistW5mduApAp0BTCEZ8bAW2YS.kBmdgd3lZ1.eq', '2024-03-31 04:55:12', '2024-03-31 04:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_temps`
--

CREATE TABLE `mahasiswa_temps` (
  `code_temps` bigint UNSIGNED NOT NULL,
  `id_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin_temps` enum('Perempuan','Laki-laki') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telepon_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_temps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prodi_id_temps` bigint UNSIGNED NOT NULL,
  `password_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_upload` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `check` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eror_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `upload_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '2018_10_25_184027_create_jurusans_table', 1),
(2, '2019_10_25_184437_create_prodis_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_10_25_184439_create_mahasiswas_table', 1),
(5, '2022_10_25_184438_create_golongans_table', 1),
(6, '2022_12_03_084854_create_admins_table', 1),
(7, '2022_12_03_084855_create_kriterias_table', 1),
(8, '2022_12_15_142708_create_subkriterias_table', 1),
(9, '2022_12_16_020322_create_penilaians_table', 1),
(10, '2022_12_17_013841_create_berkas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `subkriteria_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `mahasiswa_id`, `kriteria_id`, `subkriteria_id`, `created_at`, `updated_at`) VALUES
(1063, '00000', 1, 7, NULL, NULL),
(1064, '00000', 2, 16, NULL, NULL),
(1065, '00000', 3, 19, NULL, NULL),
(1066, '00000', 4, 24, NULL, NULL),
(1067, '00000', 5, 32, NULL, NULL),
(1068, '00000', 6, 65, NULL, NULL),
(1069, '00000', 7, 68, NULL, NULL),
(1070, '00000', 9, 70, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_arsips`
--

CREATE TABLE `penilaian_arsips` (
  `id` bigint NOT NULL,
  `no_pendaftaran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kriteria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subkriteria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian_arsips`
--

INSERT INTO `penilaian_arsips` (`id`, `no_pendaftaran`, `kriteria`, `subkriteria`, `created_at`, `updated_at`) VALUES
(1, '34', 'Penghasilan Orang Tua', 'Rp. 1.000.000 s.d Rp. 1.500.000', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(2, '34', 'Status Tempat Tinggal', 'Milik Sendiri', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(3, '34', 'Kendaraan', 'Motor', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(4, '34', 'Fasilitas Rumah', 'TV/Kulkas/Mesin Cuci', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(5, '34', 'Penggunaan Daya Listrik', '1300Kwh', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(6, '34', 'Fasilitas Lain', 'HP', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(7, '34', 'Jumlah Tanggungan Keluarga', '4-6', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(8, '34', 'Penerimaan Bantuan dari Pemerintah', 'Tidak Terima', '2024-03-31 17:58:42', '2024-03-31 17:58:42'),
(9, '190014567', 'Penghasilan Orang Tua', 'Rp. 4.000.000', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(10, '190014567', 'Status Tempat Tinggal', 'Milik Sendiri', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(11, '190014567', 'Kendaraan', 'Motor', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(12, '190014567', 'Fasilitas Rumah', 'TV/Kulkas/Mesin Cuci', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(13, '190014567', 'Penggunaan Daya Listrik', '1300Kwh', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(14, '190014567', 'Fasilitas Lain', 'HP/Gadget', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(15, '190014567', 'Jumlah Tanggungan Keluarga', '4-6', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(16, '190014567', 'Penerimaan Bantuan dari Pemerintah', 'Tidak Terima', '2024-03-31 18:37:50', '2024-03-31 18:37:50'),
(17, '321', 'Penghasilan Orang Tua', 'Rp. 1.000.000 s.d Rp. 1.500.000', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(18, '321', 'Status Tempat Tinggal', 'Milik Sendiri', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(19, '321', 'Kendaraan', 'Motor Lebih dari satu', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(20, '321', 'Fasilitas Rumah', 'TV/Kulkas', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(21, '321', 'Penggunaan Daya Listrik', '1300Kwh', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(22, '321', 'Fasilitas Lain', 'HP/Gadget', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(23, '321', 'Jumlah Tanggungan Keluarga', '4-6', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(24, '321', 'Penerimaan Bantuan dari Pemerintah', 'Tidak Terima', '2024-04-01 03:56:40', '2024-04-01 03:56:40'),
(25, '3211', 'Penghasilan Orang Tua', 'Rp. 1.500.000 s.d Rp. 2.000.000', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(26, '3211', 'Status Tempat Tinggal', 'Sewa', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(27, '3211', 'Kendaraan', 'tidak ada', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(28, '3211', 'Fasilitas Rumah', 'TV/Kulkas', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(29, '3211', 'Penggunaan Daya Listrik', '900Kwh', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(30, '3211', 'Fasilitas Lain', 'HP', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(31, '3211', 'Jumlah Tanggungan Keluarga', '4-6', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(32, '3211', 'Penerimaan Bantuan dari Pemerintah', 'Tidak Terima', '2024-04-01 04:26:23', '2024-04-01 04:26:23'),
(33, '00000', 'Penghasilan Orang Tua', 'Rp. 2.000.000', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(34, '00000', 'Status Tempat Tinggal', 'Milik Sendiri', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(35, '00000', 'Kendaraan', 'Motor', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(36, '00000', 'Fasilitas Rumah', 'Tidak ada', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(37, '00000', 'Penggunaan Daya Listrik', '900Kwh', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(38, '00000', 'Fasilitas Lain', 'HP/Gadget', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(39, '00000', 'Jumlah Tanggungan Keluarga', '4-6', '2024-04-01 04:35:42', '2024-04-01 04:35:42'),
(40, '00000', 'Penerimaan Bantuan dari Pemerintah', 'Terima', '2024-04-01 04:35:42', '2024-04-01 04:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` enum('D3','D4','S1 Terapan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama`, `jenjang`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(2, 'Budidaya Tanaman Perkebunan', 'D3', 1, '2023-01-12 00:43:01', '2023-12-31 01:57:17'),
(3, 'Teknologi Hasil Perkebunan', 'D3', 1, '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(4, 'Teknologi Produksi Tanaman Pangan', 'S1 Terapan', 1, '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(5, 'Teknologi Rekayasa Pangan', 'S1 Terapan', 1, '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(6, 'Pengelolaan Hutan', 'D3', 2, '2023-01-12 00:43:01', '2023-03-27 21:34:31'),
(7, 'Pengelolaan Hasil Hutan', 'D3', 2, '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(8, 'Pengelolaan Lingkungan', 'D3', 2, '2023-01-12 00:43:01', '2023-01-12 00:43:01'),
(9, 'Rekayasa Kayu', 'S1 Terapan', 2, '2023-01-12 00:43:01', '2023-12-11 19:52:19'),
(10, 'Teknologi Rekayasa Perangkat Lunak', 'S1 Terapan', 3, NULL, NULL),
(11, 'Teknologi Geomatika', 'D3', 3, NULL, '2023-12-11 19:51:58'),
(12, 'Teknologi Rekayasa Geomatika dan Survey', 'S1 Terapan', 3, NULL, NULL),
(13, 'Sistem Informasi Akuntansi', 'D3', 3, NULL, NULL),
(18, 'Pengelolaan Perkebunan', 'D4', 1, '2024-01-17 07:34:56', '2024-01-17 07:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `subkriterias`
--

CREATE TABLE `subkriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `nilai` enum('1','2','3','4','5','6','7') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subkriterias`
--

INSERT INTO `subkriterias` (`id`, `nama`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES
(2, 'Rp. 500.000', 1, '1', '2023-01-12 02:01:34', '2023-05-11 22:05:41'),
(3, 'Rp. 500.000 s.d Rp. 1.000.000', 1, '2', '2023-01-12 02:02:34', '2023-05-11 22:05:50'),
(4, 'Rp. 1.000.000 s.d Rp. 1.500.000', 1, '3', '2023-01-12 02:03:47', '2023-05-11 22:06:00'),
(5, 'Rp. 1.500.000 s.d Rp. 2.000.000', 1, '4', '2023-01-12 02:05:02', '2023-05-11 22:07:36'),
(7, 'Rp. 2.000.000', 1, '5', '2023-01-12 02:06:17', '2023-05-11 22:07:45'),
(8, 'Rp. 2.000.000 s.d Rp. 4.000.000', 1, '6', '2023-01-12 02:07:37', '2023-05-11 22:07:57'),
(9, 'Rp. 4.000.000', 1, '7', '2023-01-12 02:08:11', '2023-05-11 22:09:11'),
(11, 'Sewa', 2, '1', '2023-01-12 02:10:39', '2023-05-11 22:09:22'),
(16, 'Milik Sendiri', 2, '2', '2023-01-12 02:17:06', '2023-05-11 22:09:31'),
(17, 'tidak ada', 3, '1', '2023-01-12 02:17:59', '2023-05-11 22:10:22'),
(19, 'Motor', 3, '2', '2023-01-12 02:19:31', '2023-05-11 22:10:38'),
(23, 'Motor Lebih dari satu', 3, '3', '2023-01-12 02:22:34', '2023-05-11 22:10:49'),
(24, 'Tidak ada', 4, '1', '2023-01-12 02:23:20', '2023-05-11 22:11:15'),
(25, 'TV/Kulkas', 4, '2', '2023-01-12 02:24:14', '2023-05-11 22:11:26'),
(30, 'TV/Kulkas/Mesin Cuci', 4, '3', '2023-01-12 02:25:26', '2023-05-11 22:11:39'),
(31, '450Kwh', 5, '1', '2023-01-12 02:26:08', '2023-05-11 22:12:15'),
(32, '900Kwh', 5, '2', '2023-01-12 02:26:48', '2023-05-11 22:12:01'),
(33, '1300Kwh', 5, '3', '2023-01-12 02:27:16', '2023-05-11 22:13:45'),
(35, '1300Kwh Keatas', 5, '4', '2023-01-12 02:28:06', '2023-05-11 22:14:18'),
(63, 'tidak ada', 6, '1', '2023-05-11 22:24:54', '2023-05-11 22:27:55'),
(64, 'HP', 6, '2', '2023-05-11 22:26:26', '2023-05-11 22:28:13'),
(65, 'HP/Gadget', 6, '3', '2023-05-11 22:27:15', '2023-05-11 22:28:59'),
(66, 'HP/Gadget/Smartphone', 6, '4', '2023-05-11 22:29:29', '2023-05-11 22:29:29'),
(67, '1-3', 7, '3', '2023-05-11 22:32:43', '2023-05-11 22:32:43'),
(68, '4-6', 7, '2', '2023-05-11 22:33:22', '2023-05-11 22:33:22'),
(69, '7-10', 7, '1', '2023-05-11 22:33:47', '2023-05-11 22:34:01'),
(70, 'Terima', 9, '1', '2023-05-11 22:34:29', '2023-05-11 22:34:29'),
(71, 'Tidak Terima', 9, '2', '2023-05-11 22:34:54', '2023-05-11 22:34:54'),
(75, 'Menumpang', 2, '1', NULL, NULL),
(76, 'TV', 4, '2', NULL, NULL),
(77, 'Kulkas', 4, '2', NULL, NULL),
(78, 'Mesin Cuci', 4, '3', NULL, NULL),
(81, 'Radio', 4, '1', '2024-01-17 07:24:19', '2024-01-17 07:24:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `FK_admins_jurusans` (`jurusan_id`);

--
-- Indexes for table `arsips`
--
ALTER TABLE `arsips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_arsips_folders` (`id_folder`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_admin_id_foreign` (`admin_id`),
  ADD KEY `berkas_golongan_id_foreign` (`golongan_id`),
  ADD KEY `FK_berkas_mahasiswas` (`mahasiswa_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `golongans`
--
ALTER TABLE `golongans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_mahasiswas_prodis` (`prodi_id`);

--
-- Indexes for table `mahasiswa_temps`
--
ALTER TABLE `mahasiswa_temps`
  ADD PRIMARY KEY (`code_temps`),
  ADD KEY `FK_mahasiswa_temps_prodis` (`prodi_id_temps`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaians_kriteria_id_foreign` (`kriteria_id`),
  ADD KEY `penilaians_subkriteria_id_foreign` (`subkriteria_id`),
  ADD KEY `FK_penilaians_mahasiswas` (`mahasiswa_id`);

--
-- Indexes for table `penilaian_arsips`
--
ALTER TABLE `penilaian_arsips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodis_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `subkriterias`
--
ALTER TABLE `subkriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subkriterias_kriteria_id_foreign` (`kriteria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `arsips`
--
ALTER TABLE `arsips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mahasiswa_temps`
--
ALTER TABLE `mahasiswa_temps`
  MODIFY `code_temps` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1071;

--
-- AUTO_INCREMENT for table `penilaian_arsips`
--
ALTER TABLE `penilaian_arsips`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subkriterias`
--
ALTER TABLE `subkriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `FK_admins_jurusans` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`);

--
-- Constraints for table `arsips`
--
ALTER TABLE `arsips`
  ADD CONSTRAINT `FK_arsips_folders` FOREIGN KEY (`id_folder`) REFERENCES `folders` (`id`);

--
-- Constraints for table `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `berkas_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `berkas_golongan_id_foreign` FOREIGN KEY (`golongan_id`) REFERENCES `golongans` (`id`),
  ADD CONSTRAINT `FK_berkas_mahasiswas` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`);

--
-- Constraints for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD CONSTRAINT `FK_mahasiswas_prodis` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`);

--
-- Constraints for table `mahasiswa_temps`
--
ALTER TABLE `mahasiswa_temps`
  ADD CONSTRAINT `FK_mahasiswa_temps_prodis` FOREIGN KEY (`prodi_id_temps`) REFERENCES `prodis` (`id`);

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `FK_penilaians_kriterias` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`),
  ADD CONSTRAINT `FK_penilaians_mahasiswas` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`),
  ADD CONSTRAINT `FK_penilaians_subkriterias` FOREIGN KEY (`subkriteria_id`) REFERENCES `subkriterias` (`id`);

--
-- Constraints for table `prodis`
--
ALTER TABLE `prodis`
  ADD CONSTRAINT `prodis_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`);

--
-- Constraints for table `subkriterias`
--
ALTER TABLE `subkriterias`
  ADD CONSTRAINT `FK_subkriterias_kriterias` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
