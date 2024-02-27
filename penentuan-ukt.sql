-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2024 at 03:08 PM
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
(22, 'rizkypratama', 'ku@gmail.com', 'verifikator', 3, '$2y$10$kLSJQ9/PmPiGmginZcHTSugwdOpDPcQowQla5OVtodjbRhNqVZSm.', '2023-12-29 01:39:07', '2024-01-10 17:28:15'),
(30, 'tika', 'tikaa@gmail.com', 'verifikator', 1, '$2y$10$Vzp.GSVPLxeLVMhCgtxzUO8ydSa5sqxs/X5rYymXllQB7DQEIIV6y', '2023-12-29 21:33:37', '2024-01-10 17:29:40'),
(33, 'Rizky', 'rizkyganteng@gmail.com', 'verifikator', 2, '$2y$10$tr2QM96JsYKlMwhoB0BQreYjBc4R43Uno.foz37DlQl6HAKhoVJBy', '2024-01-02 03:59:51', '2024-01-02 04:07:16');

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
  `status` enum('Belum Lengkap','Menunggu Verifikasi','Lengkap') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `golongan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `mahasiswa_id`, `foto_slip_gaji`, `foto_tempat_tinggal`, `foto_kendaraan`, `foto_daya_listrik`, `status`, `keterangan`, `admin_id`, `golongan_id`, `created_at`, `updated_at`) VALUES
(74, '190014567', '20240111020419_slipgajji.png', '20240111020419_foto tempat tinggal tika.jpeg', NULL, '20240111020419_daya listrik.jpg', 'Menunggu Verifikasi', NULL, 30, 9, '2024-01-10 18:04:19', '2024-01-10 18:42:43'),
(75, '1233444555', '20240111074342_slipgajji.png', '20240111074342_foto tempat tinggal tika.jpeg', '20240111074342_motor.jpeg', '20240111074342_daya listrik.jpg', 'Lengkap', NULL, 30, 2, '2024-01-10 18:25:36', '2024-01-10 23:44:30'),
(76, '1314111111', '20240111022745_slipgajji.png', '20240111022745_foto tempat tinggal.jpeg', '20240111022745_kendaraan.jpg', '20240111022745_daya listrik.jpg', 'Belum Lengkap', NULL, NULL, 23, '2024-01-10 18:27:45', '2024-01-10 18:27:45');

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
('1000011111', 'Nuratika', 'Perempuan', '85823593942', 'lekopadis dusun 1', 10, '$2y$10$FEJaNLnLM/W8tclaSUgn8e.8n3z1gyG5HMejDP0nGgodHCBq7oxZ.', '2024-01-10 17:08:00', '2024-01-10 17:23:22'),
('1233444555', 'Mardiana', 'Perempuan', '8582359397', 'Samarinda Seberang', 3, '$2y$10$HoH5oeeqobDJsan6yYlpWOcnBhuqm5N1M615akigRv0jp7sKtxTMy', '2024-01-10 17:08:00', '2024-01-10 17:23:35'),
('1314111111', 'Rizky Pratama', 'Laki-laki', '8582359398', 'Harapan Baru', 5, '$2y$10$isuP1BsS0GARMR/EPhHLuu0UVdmjQ/yrmjAvwh/00sOMDnCTeQqYe', '2024-01-10 17:08:00', '2024-01-10 17:23:46'),
('190014567', 'Soleha Purnamasari', 'Perempuan', '085823593921', 'gotong royong', 5, '$2y$10$sQf3tRDdiyr2HhxY076bm.B6XMROHBJ8xBrNLJkkOmMlcAVCskjbW', '2024-01-10 17:22:50', '2024-01-10 17:23:58');

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
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `subkriteria_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `kriteria_id`, `subkriteria_id`, `mahasiswa_id`, `created_at`, `updated_at`) VALUES
(975, 1, 4, '190014567', NULL, NULL),
(976, 2, 16, '190014567', NULL, NULL),
(977, 3, 17, '190014567', NULL, NULL),
(978, 4, 24, '190014567', NULL, NULL),
(979, 5, 32, '190014567', NULL, NULL),
(980, 6, 64, '190014567', NULL, NULL),
(981, 7, 67, '190014567', NULL, NULL),
(982, 9, 70, '190014567', NULL, NULL),
(983, 1, 3, '1233444555', NULL, NULL),
(984, 2, 16, '1233444555', NULL, NULL),
(985, 3, 19, '1233444555', NULL, NULL),
(986, 4, 30, '1233444555', NULL, NULL),
(987, 5, 32, '1233444555', NULL, NULL),
(988, 6, 64, '1233444555', NULL, NULL),
(989, 7, 68, '1233444555', NULL, NULL),
(990, 9, 71, '1233444555', NULL, NULL),
(991, 1, 9, '1314111111', NULL, NULL),
(992, 2, 16, '1314111111', NULL, NULL),
(993, 3, 23, '1314111111', NULL, NULL),
(994, 4, 30, '1314111111', NULL, NULL),
(995, 5, 35, '1314111111', NULL, NULL),
(996, 6, 66, '1314111111', NULL, NULL),
(997, 7, 67, '1314111111', NULL, NULL),
(998, 9, 71, '1314111111', NULL, NULL);

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
(1, 'Pengelolaan Perkebunan', 'S1 Terapan', 1, '2023-01-12 00:43:01', '2023-12-11 19:52:09'),
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
(13, 'Sistem Informasi Akuntansi', 'D3', 3, NULL, NULL);

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
(79, 'Radio', 4, '1', '2023-12-04 18:41:17', '2023-12-04 18:41:34');

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
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_admin_id_foreign` (`admin_id`),
  ADD KEY `berkas_golongan_id_foreign` (`golongan_id`),
  ADD KEY `FK_berkas_mahasiswas` (`mahasiswa_id`);

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
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=999;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subkriterias`
--
ALTER TABLE `subkriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `FK_admins_jurusans` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`);

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
