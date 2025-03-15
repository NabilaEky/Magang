-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 08:04 AM
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
-- Database: `homedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$J6YkDqvsrjWeeHVW.b4DzeI8v3HZfruaTXLCP5thGHPD4Lg5rBw5G', NULL, '2025-03-12 04:11:04', '2025-03-12 04:11:04'),
(2, 'Admin 2', 'admin2@example.com', '$2y$10$sVMT3cBidT4AmmKA9EZF5OH34QSCx1tNRVSpPF1YaHHzYbek9O68m', NULL, '2025-03-12 04:11:04', '2025-03-12 04:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `isi`, `tanggal`, `caption`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Mahasiswa Universitas Semarang Melaksanakan Kegiatan Magang Di Yayasan Nurul Firdaus', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat nam vel tempora inventore aspernatur omnis magnam nemo minima maxime eos eaque libero, molestiae eius, fuga voluptate beatae, magni id? Deleniti!', '2025-03-12', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat nam vel tempora inventore aspernatur omnis magnam nemo minima maxime eos eaque libero, molestiae eius, fuga voluptate beatae, magni id? Deleniti!', 'berita/meKc3hzQnytTvMG8BOxzLe2LBZCsJTh6iEuljZzI.png', '2025-03-12 05:16:58', '2025-03-12 05:16:58'),
(2, 'Yayasan Nurul Firdaus Adakan Kegiatan Bakti Sosial di Desa Manggarmas', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat nam vel tempora inventore aspernatur omnis magnam nemo minima maxime eos eaque libero, molestiae eius, fuga voluptate beatae, magni id? Deleniti!', '2025-03-14', 'Manggarmas - Mahasiswa Universitas Semarang melaksanakan Kegiatan magang di Yayasan Nurul Firdaus, dan meraka sukses menyelesaikan tugasnya dengan membuat sistem website untuk Yayayasan, Mts Dan Ma.', 'berita/VFpHEw2G2t6iJ7vgamuMgyJKa8toCUqodIKWYGww.png', '2025-03-14 00:03:09', '2025-03-14 00:03:09'),
(3, 'Penerimaan Siswa Baru Yayasan Nurul Firdaus Tahun Ajaran 2024/2025 Dibuka!', 'Siswa Yayasan Nurul Firdaus kembali menorehkan prestasi gemilang di ajang Olimpiade Sains Nasional (OSN). Dua siswa kami berhasil meraih medali perak dan perunggu dalam bidang Matematika dan Fisika.\r\n\r\nPrestasi ini merupakan kebanggaan bagi Yayasan Nurul Firdaus dan Kabupaten Grobogan. Kami berharap prestasi ini dapat memotivasi siswa lain untuk terus belajar dan berprestasi.', '2025-03-15', 'Mari bergabung bersama kami untuk meraih masa depan yang cerah!', 'berita/llvcRaXGm4H4IG3NZvbIfw8GhYg1jvK8xGkd9oQp.jpg', '2025-03-14 17:04:26', '2025-03-14 17:04:26'),
(4, 'Yayasan Nurul Firdaus Gelar Seminar Pendidikan dengan Tema \"Membangun Generasi Unggul', 'Yayasan Nurul Firdaus Adakan Kegiatan Bakti Sosial di Desa Manggarmas\r\n\r\nSebagai bentuk kepedulian terhadap masyarakat sekitar, Yayasan Nurul Firdaus mengadakan kegiatan bakti sosial di Desa Manggarmas. Kegiatan ini meliputi pembagian sembako, pemeriksaan kesehatan gratis, dan penyuluhan tentang pentingnya menjaga kebersihan lingkungan.\r\n\r\nKegiatan ini diikuti oleh seluruh siswa, guru, dan staf Yayasan Nurul Firdaus. Kami berharap kegiatan ini dapat memberikan manfaat bagi masyarakat Desa Manggarmas dan mempererat tali silaturahmi antara Yayasan Nurul Firdaus dan masyarakat sekitar.', '2025-03-15', 'Meningkatkan wawasan dan kualitas pendidikan di Yayasan Nurul Firdaus', 'berita/VGqQkjNl2YwZtVwYQqQbfQ8VS3Rla77S78iO7P5b.jpg', '2025-03-14 18:52:42', '2025-03-14 18:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slide_number` tinyint(3) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carousels`
--

INSERT INTO `carousels` (`id`, `slide_number`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'carousel/pNyUVzMYoDlTpVKtVERsXsZPpK8sH8NdKzbpTLO3.jpg', '2025-03-12 04:26:58', '2025-03-12 05:23:23'),
(2, 2, 'carousel/U4cQTT5cy5m5oxUk0dMPxJbnX11sK1sHQgjhGbMO.jpg', '2025-03-12 05:19:46', '2025-03-12 05:23:01'),
(4, 3, 'carousels/V8nxvhVKbxrPoQfgbAVkCeHmvIdmx3T8EjkjZ33o.jpg', '2025-03-12 05:30:48', '2025-03-12 05:30:48');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_12_110110_create_admins_table', 2),
(6, '2025_03_12_110347_create_beritas_table', 3),
(7, '2025_03_12_110532_create_sambutans_table', 4),
(8, '2025_03_12_110727_create_strukturals_table', 5),
(9, '2025_03_12_111157_create_carousels_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sambutans`
--

CREATE TABLE `sambutans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kepala` varchar(255) NOT NULL,
  `sambutan` text NOT NULL,
  `foto_kepala` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sambutans`
--

INSERT INTO `sambutans` (`id`, `nama_kepala`, `sambutan`, `foto_kepala`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Wafda Vivid Izziyana, S.H., M.H.', 'Selamat datang di website resmi Yayasan Nurul Firdaus, yang menaungi MTs Nurul Firdaus dan MA Nurul Firdaus. Website ini kami hadirkan sebagai media informasi resmi untuk seluruh siswa, orang tua, guru, serta masyarakat. Melalui platform ini, kami berharap dapat memberikan kemudahan dalam mengakses berbagai informasi terkait kegiatan, program, serta perkembangan pendidikan di lingkungan Yayasan Nurul Firdaus.', 'sambutan/taoq0CULUHBCvhHBtg8IWRRcRrPLEfg7CpTc4W5I.jpg', '2025-03-14 17:51:47', '2025-03-14 17:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `strukturals`
--

CREATE TABLE `strukturals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strukturals`
--

INSERT INTO `strukturals` (`id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'struktural/dOfSpNbO8gNW1GQY5nl76iHrm9jsnZBwj0sEgF2E.jpg', '2025-03-14 19:46:15', '2025-03-14 20:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carousels_slide_number_unique` (`slide_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sambutans`
--
ALTER TABLE `sambutans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strukturals`
--
ALTER TABLE `strukturals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sambutans`
--
ALTER TABLE `sambutans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `strukturals`
--
ALTER TABLE `strukturals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
