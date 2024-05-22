-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2024 at 10:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

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
(22, 'Rekayasa dan Komputer\r\n', 'rekayasadankomputer@gmail.com', 'verifikator', 3, '$2y$10$sbPxpG86UQYDzoN2sHoZxeymoh5jqIUSXOTy52DtLypHz9FWvAuUW', '2023-12-29 01:39:07', '2024-04-30 18:50:14'),
(30, 'Pertanian', 'pertanian@gmail.com', 'verifikator', 1, '$2y$10$F8Azvb47kQSIA/rO3RCDi.5Spcdg6c9EnA9T/aEQQ..SAKQt/IpUi', '2023-12-29 21:33:37', '2024-05-14 02:10:03'),
(33, 'Lingkungan dan Kehutanan', 'lingkungandankehutanan@gmail.com', 'verifikator', 2, '$2y$10$091vuiAqnrB0GcRtgRSehOzyhAHl6dPiYf9qIUKuDlxo9fQtfl7Ky', '2024-01-02 03:59:51', '2024-04-30 05:07:00'),
(34, 'Super Admin', 'admin@gmail.com', 'superadmin', NULL, '$2y$10$JohywLr.gB3sxAq.n/jJrO1xCqdhMNLRsmx7moUvbFunfWf11DlnG', '2024-04-30 05:04:11', '2024-04-30 05:04:11'),
(35, 'Nuratika', 'nuratika0552@gmail.com', 'verifikator', 1, '$2y$10$okTdVo.SXCH7MJvLgKxBj.Yq7MB/NbJblVpcH6TH3vyR23QxOy/hC', '2024-05-16 00:20:15', '2024-05-16 00:20:15');

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
  `jalur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_slip_gaji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_tempat_tinggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_kendaraan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_daya_listrik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_beasiswa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_angkatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `foto_beasiswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Belum Lengkap','Menunggu Verifikasi','Lulus Verifikasi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `golongan_id` bigint UNSIGNED DEFAULT NULL,
  `nominal_ukt` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `mahasiswa_id`, `foto_slip_gaji`, `foto_tempat_tinggal`, `foto_kendaraan`, `foto_daya_listrik`, `foto_beasiswa`, `status`, `keterangan`, `admin_id`, `golongan_id`, `nominal_ukt`, `created_at`, `updated_at`) VALUES
(172, 'gh12345678', '20240520055727_slipgaji.jpg', '20240520055727_foto tempat tinggal tika.jpeg', '20240520055727_motor.jpeg', '20240520055727_daya listrik.jpg', NULL, 'Lulus Verifikasi', NULL, 30, 28, 3500000, '2024-05-19 21:57:27', '2024-05-19 22:07:14'),
(173, 'h112333ijkl', '20240520072854_slipgajji.png', '20240520072854_foto tempat tinggal.jpeg', '20240520072854_motor.jpeg', '20240520072854_daya listrik.jpg', NULL, 'Lulus Verifikasi', NULL, 35, 26, 2500000, '2024-05-19 23:28:54', '2024-05-20 16:38:53'),
(174, 'h', '20240521004809_slipgajji.png', '20240521004809_foto tempat tinggal.jpeg', '20240521004809_motor.jpeg', '20240521004809_daya listrik.jpg', '20240521004809_erd.png', 'Menunggu Verifikasi', 'gggg', 22, 25, 1000000, '2024-05-20 16:48:09', '2024-05-22 02:13:34'),
(175, '12345ujk12345', '20240522090437_slipgajji.png', '20240522090437_foto tempat tinggal rizky.jpeg', '20240522090437_motor.jpeg', '20240522090437_daya listrik.jpg', NULL, 'Lulus Verifikasi', NULL, 22, 26, 1250000, '2024-05-22 01:04:37', '2024-05-22 01:18:52');

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
(14, 'SNBT', '2024-05-14 02:12:04', '2024-05-14 02:12:04'),
(15, 'Mandiri', '2024-05-16 02:47:14', '2024-05-16 02:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `golongans`
--

CREATE TABLE `golongans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` enum('Kategori I','Kategori II','Kategori III','Kategori IV','Kategori V','Kategori VI','Kategori VII') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_minimal` bigint DEFAULT NULL,
  `nilai_maksimal` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongans`
--

INSERT INTO `golongans` (`id`, `nama`, `nilai_minimal`, `nilai_maksimal`, `created_at`, `updated_at`) VALUES
(24, 'Kategori I', 1, 12, '2024-04-05 05:28:00', '2024-04-05 06:39:29'),
(25, 'Kategori II', 12, 17, '2024-04-05 05:55:19', '2024-04-05 06:37:10'),
(26, 'Kategori III', 17, 19, '2024-04-05 05:55:30', '2024-04-05 06:38:04'),
(27, 'Kategori IV', 20, 20, '2024-04-05 05:55:40', '2024-04-05 06:37:45'),
(28, 'Kategori V', 21, 24, '2024-04-05 05:55:49', '2024-04-05 06:38:19'),
(29, 'Kategori VI', 25, 25, '2024-04-05 05:56:01', '2024-04-05 06:38:37'),
(30, 'Kategori VII', 26, 50, '2024-04-05 05:56:10', '2024-04-05 06:39:18');

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
-- Table structure for table `kelompokukts`
--

CREATE TABLE `kelompokukts` (
  `id` bigint NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `kategori1` int DEFAULT NULL,
  `kategori2` int DEFAULT NULL,
  `kategori3` int DEFAULT NULL,
  `kategori4` int DEFAULT NULL,
  `kategori5` int DEFAULT NULL,
  `kategori6` int DEFAULT NULL,
  `kategori7` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompokukts`
--

INSERT INTO `kelompokukts` (`id`, `prodi_id`, `kategori1`, `kategori2`, `kategori3`, `kategori4`, `kategori5`, `kategori6`, `kategori7`, `created_at`, `updated_at`) VALUES
(6, 6, 500000, 1000000, 1250000, 1500000, 1750000, 2000000, 2500000, '2024-04-04 23:08:49', '2024-04-05 03:55:59'),
(7, 7, 500000, 1000000, 1250000, 1500000, 1750000, 2000000, 2500000, '2024-04-05 04:00:37', '2024-04-05 04:00:37'),
(8, 8, 500000, 1000000, 1250000, 1500000, 1750000, 2000000, 2500000, '2024-04-05 04:01:00', '2024-04-05 04:01:00'),
(9, 9, 500000, 1000000, 1250000, 1500000, 2000000, 2500000, 3500000, '2024-04-05 04:01:59', '2024-04-05 04:01:59'),
(10, 19, 500000, 1000000, 2500000, 3000000, 3500000, 4000000, 4500000, '2024-04-05 04:13:21', '2024-04-05 04:13:21'),
(11, 2, 500000, 1000000, 1250000, 1500000, 1750000, 2000000, 2400000, '2024-04-05 04:14:25', '2024-04-05 04:14:25'),
(12, 3, 500000, 1000000, 1250000, 1500000, 1750000, 2000000, 2400000, '2024-04-05 04:14:45', '2024-04-05 04:14:45'),
(13, 18, 500000, 1000000, 1250000, 1500000, 2000000, 2500000, 3500000, '2024-04-05 04:15:53', '2024-04-05 04:15:53'),
(14, 4, 500000, 1000000, 2500000, 3000000, 3500000, 4000000, 4500000, '2024-04-05 04:16:51', '2024-04-05 04:16:51'),
(15, 5, 500000, 1000000, 2500000, 3000000, 3500000, 4000000, 4500000, '2024-04-05 04:17:14', '2024-04-05 04:17:14'),
(16, 11, 500000, 1000000, 1250000, 1500000, 1750000, 2000000, 2500000, '2024-04-05 04:18:12', '2024-04-05 04:18:12'),
(17, 13, 500000, 1000000, 1500000, 2000000, 2500000, 3000000, 3500000, '2024-04-05 04:18:58', '2024-04-05 04:24:48'),
(18, 10, 500000, 1000000, 1250000, 1500000, 2000000, 2500000, 3500000, '2024-04-05 04:19:56', '2024-04-05 04:19:56'),
(19, 12, 500000, 1000000, 2500000, 3000000, 3500000, 4000000, 4500000, '2024-04-05 04:20:37', '2024-04-05 04:20:37');

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
  `jalur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nama`, `jenis_kelamin`, `no_telepon`, `alamat`, `prodi_id`, `jalur`, `password`, `created_at`, `updated_at`) VALUES
('12345ujk12345', 'Nuratika', 'Perempuan', '085823593942', 'Jl. Manunggal II, Gg. Parikesit, Harapan Baru', 10, 'SNBT', '$2y$10$.3Ia2i8OpYYSEZbPAvStsO3vWkbJgvsUypYBWC5YudO1djW7E5yT6', '2024-05-22 00:54:09', '2024-05-22 00:54:09'),
('gh12345678', 'Sai Akuto', 'Laki-laki', '1234', 'Slamed Riyadi', 5, 'Mandiri', '$2y$10$yacylN6IJ6h07aszQfubbOcQ.WwdrsXWS3YBWaE5ndJPvzCUI8/Ae', '2024-05-17 02:25:16', '2024-05-19 21:48:08'),
('h', 'Kurohiko', 'Laki-laki', '12345', 'P.Antasari', 13, 'Mandiri', '$2y$10$qdB7OunSkdOwGaG.yJFUnOmCZBWsFCkvTsecyqEAYkY1eYyGjZP6W', '2024-05-17 02:25:16', '2024-05-19 04:58:18'),
('h112333ijkl', 'Kurohiko', 'Laki-laki', '12345', 'P.Antasari', 4, 'Mandiri', '$2y$10$leGUrNKAQ3bdHMeAW2aYd.c6nN0eNpUiHMh7E0fky92Msq35cGAza', '2024-05-18 07:10:40', '2024-05-19 21:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_temps`
--

CREATE TABLE `mahasiswa_temps` (
  `code_temps` bigint UNSIGNED NOT NULL,
  `id_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telepon_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_temps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `prodi_id_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jalur_temps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_temps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_upload` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `check` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eror_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `upload_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa_temps`
--

INSERT INTO `mahasiswa_temps` (`code_temps`, `id_temps`, `nama_temps`, `jenis_kelamin_temps`, `no_telepon_temps`, `alamat_temps`, `prodi_id_temps`, `jalur_temps`, `password_temps`, `status_upload`, `check`, `eror_location`, `upload_code`, `created_at`, `updated_at`) VALUES
(1, 'f111', 'Annabulla', 'Perempuan', '88888', 'P.Suryanata', 'Teknologi Hasil Perkebunan', 'Mandiri', '12121212', 'Draft', 'Valid', '[]', '664998188c8da', '2024-05-18 22:11:36', '2024-05-18 22:11:36'),
(2, 'g1', 'Sai Akuto', 'Laki-laki', '1234', 'Slamed Riyadi', 'Teknologi Hasil Perkebunan', 'Mandiri', '12121212', 'Draft', 'Tidak Valid', '[\"(NO PENDAFTARAN SUDAH DIGUNAKAN)\"]', '664998188c8da', '2024-05-18 22:11:36', '2024-05-18 22:11:37'),
(3, 'h111', 'Kurohiko', 'Laki-laki', '12345', 'P.Antasari', 'Teknologi Hasil Perkebunan', 'Mandiri', '12121212', 'Draft', 'Valid', '[]', '664998188c8da', '2024-05-18 22:11:36', '2024-05-18 22:11:37'),
(4, 'j1111', NULL, 'Laki-lak', '1234aa', NULL, 'Teknologi Hasil Perkebunann T', NULL, '12', 'Draft', 'Tidak Valid', '[\"(NAMA TIDAK BOLEH KOSONG)\",\"(JENIS KELAMIN TIDAK VALID)\",\"(NO TELEPON HARUS ANGKA)\",\"(ALAMAT TIDAK BOLEH KOSONG)\",\"(PRODI TIDAK VALID)\",\"(JALUR TIDAK BOLEH KOSONG)\",\"(PASSWORD HARUS 8 ANGKA)\"]', '664998188c8da', '2024-05-18 22:11:36', '2024-05-18 22:11:37'),
(5, 'j1', 'Masamune Dante Roiso Roiso', 'Laki-laki', '123456', 'Slamed Riyadi', 'Teknologi Hasil Perkebunan', 'Mandiri', '12121212', 'Draft', 'Valid', '[]', '664998188c8da', '2024-05-18 22:11:36', '2024-05-18 22:11:37');

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
(1807, 'gh12345678', 1, 7, NULL, NULL),
(1808, 'gh12345678', 2, 16, NULL, NULL),
(1809, 'gh12345678', 3, 19, NULL, NULL),
(1810, 'gh12345678', 4, 77, NULL, NULL),
(1811, 'gh12345678', 5, 35, NULL, NULL),
(1812, 'gh12345678', 6, 64, NULL, NULL),
(1813, 'gh12345678', 7, 68, NULL, NULL),
(1814, 'gh12345678', 9, 71, NULL, NULL),
(1815, 'h112333ijkl', 1, 5, NULL, NULL),
(1816, 'h112333ijkl', 2, 16, NULL, NULL),
(1817, 'h112333ijkl', 3, 23, NULL, NULL),
(1818, 'h112333ijkl', 4, 76, NULL, NULL),
(1819, 'h112333ijkl', 5, 33, NULL, NULL),
(1820, 'h112333ijkl', 6, 64, NULL, NULL),
(1821, 'h112333ijkl', 7, 69, NULL, NULL),
(1822, 'h112333ijkl', 9, 71, NULL, NULL),
(1823, 'h', 1, 4, NULL, '2024-05-20 20:25:13'),
(1824, 'h', 2, 16, NULL, NULL),
(1825, 'h', 3, 19, NULL, NULL),
(1826, 'h', 4, 25, NULL, NULL),
(1827, 'h', 5, 33, NULL, NULL),
(1828, 'h', 6, 64, NULL, NULL),
(1829, 'h', 7, 69, NULL, NULL),
(1830, 'h', 9, 70, NULL, NULL),
(1831, '12345ujk12345', 1, 3, NULL, NULL),
(1832, '12345ujk12345', 2, 75, NULL, NULL),
(1833, '12345ujk12345', 3, 19, NULL, NULL),
(1834, '12345ujk12345', 4, 30, NULL, NULL),
(1835, '12345ujk12345', 5, 33, NULL, NULL),
(1836, '12345ujk12345', 6, 66, NULL, NULL),
(1837, '12345ujk12345', 7, 68, NULL, NULL),
(1838, '12345ujk12345', 9, 71, NULL, NULL);

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
  `jenjang` enum('D3','S1 Terapan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(18, 'Pengelolaan Perkebunan', 'S1 Terapan', 1, '2024-01-17 07:34:56', '2024-01-17 07:34:56'),
(19, 'Teknologi Rekayasa Pengendalian Pencemaran Lingkungan', 'S1 Terapan', 2, NULL, NULL);

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
(2, '> Rp. 500.000', 1, '1', '2023-01-12 02:01:34', '2024-05-22 00:47:22'),
(3, 'Rp. 500.000 s.d Rp. 1.000.000', 1, '2', '2023-01-12 02:02:34', '2023-05-11 22:05:50'),
(4, 'Rp. 1.000.000 s.d Rp. 1.500.000', 1, '3', '2023-01-12 02:03:47', '2023-05-11 22:06:00'),
(5, 'Rp. 1.500.000 s.d Rp. 2.000.000', 1, '4', '2023-01-12 02:05:02', '2023-05-11 22:07:36'),
(7, 'Rp. 2.000.000', 1, '5', '2023-01-12 02:06:17', '2024-05-22 00:50:17'),
(8, 'Rp. 2.000.000 s.d Rp. 4.000.000', 1, '6', '2023-01-12 02:07:37', '2023-05-11 22:07:57'),
(9, '< Rp. 4.000.000', 1, '7', '2023-01-12 02:08:11', '2024-05-22 00:48:30'),
(11, 'Sewa', 2, '1', '2023-01-12 02:10:39', '2023-05-11 22:09:22'),
(16, 'Milik Sendiri', 2, '2', '2023-01-12 02:17:06', '2023-05-11 22:09:31'),
(17, 'tidak ada kendaraan', 3, '1', '2023-01-12 02:17:59', '2023-05-11 22:10:22'),
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
-- Indexes for table `kelompokukts`
--
ALTER TABLE `kelompokukts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kelompokukts_prodis` (`prodi_id`);

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
  ADD PRIMARY KEY (`code_temps`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `arsips`
--
ALTER TABLE `arsips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelompokukts`
--
ALTER TABLE `kelompokukts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mahasiswa_temps`
--
ALTER TABLE `mahasiswa_temps`
  MODIFY `code_temps` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1839;

--
-- AUTO_INCREMENT for table `penilaian_arsips`
--
ALTER TABLE `penilaian_arsips`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Constraints for table `kelompokukts`
--
ALTER TABLE `kelompokukts`
  ADD CONSTRAINT `FK_kelompokukts_prodis` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`);

--
-- Constraints for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD CONSTRAINT `FK_mahasiswas_prodis` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`);

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
