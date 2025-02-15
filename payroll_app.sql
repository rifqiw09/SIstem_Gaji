-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2025 at 12:26 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` bigint UNSIGNED NOT NULL,
  `karyawan_id` bigint UNSIGNED NOT NULL,
  `tanggal_gaji` date NOT NULL,
  `gaji_pokok` decimal(10,2) NOT NULL,
  `tunjangan` decimal(10,2) NOT NULL,
  `potongan` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_gaji` decimal(10,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `karyawan_id`, `tanggal_gaji`, `gaji_pokok`, `tunjangan`, `potongan`, `total_gaji`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-01-01', '3000000.00', '800000.00', '50000.00', '3750000.00', 'Success', '2025-02-15 04:34:24', '2025-02-15 04:48:57'),
(3, 2, '2025-01-01', '3000000.00', '800000.00', '50000.00', '3750000.00', 'Success', '2025-02-15 04:42:15', '2025-02-15 04:50:28'),
(4, 6, '2025-01-01', '10000000.00', '3000000.00', '500000.00', '12500000.00', 'Success', '2025-02-15 04:44:47', '2025-02-15 04:44:47'),
(5, 3, '2025-01-01', '3000000.00', '800000.00', '100000.00', '3700000.00', 'Success', '2025-02-15 04:50:14', '2025-02-15 04:50:14'),
(6, 4, '2025-01-01', '3000000.00', '800000.00', '40000.00', '3760000.00', 'Success', '2025-02-15 04:51:39', '2025-02-15 04:51:39'),
(7, 5, '2025-01-01', '3000000.00', '800000.00', '0.00', '3800000.00', 'Success', '2025-02-15 04:52:09', '2025-02-15 04:52:09'),
(8, 7, '2025-01-01', '25000000.00', '10000000.00', '100000.00', '34900000.00', 'Success', '2025-02-15 04:52:33', '2025-02-15 04:52:33'),
(10, 8, '2025-01-01', '8000000.00', '2000000.00', '100000.00', '9900000.00', 'Success', '2025-02-15 04:54:55', '2025-02-15 04:54:55'),
(11, 9, '2025-01-01', '7000000.00', '1800000.00', '0.00', '8800000.00', 'Success', '2025-02-15 04:55:18', '2025-02-15 04:55:18'),
(12, 10, '2025-01-01', '14000000.00', '4500000.00', '0.00', '18500000.00', 'Success', '2025-02-15 04:55:40', '2025-02-15 04:55:40'),
(13, 11, '2025-01-01', '15000000.00', '5000000.00', '0.00', '20000000.00', 'Success', '2025-02-15 04:56:32', '2025-02-15 04:56:32'),
(14, 12, '2025-01-01', '6500000.00', '1500000.00', '100000.00', '7900000.00', 'Success', '2025-02-15 04:56:49', '2025-02-15 04:56:49'),
(15, 13, '2025-01-01', '9500000.00', '2800000.00', '0.00', '12300000.00', 'Success', '2025-02-15 04:57:10', '2025-02-15 04:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji_pokok` decimal(10,2) NOT NULL,
  `tunjangan` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `gaji_pokok`, `tunjangan`, `created_at`, `updated_at`) VALUES
(1, 'Supervisor Produksi', '10000000.00', '3000000.00', '2025-02-13 05:30:19', '2025-02-15 03:25:31'),
(2, 'Karyawan', '3000000.00', '800000.00', '2025-02-13 05:33:47', '2025-02-15 03:26:05'),
(3, 'Direktur', '25000000.00', '10000000.00', '2025-02-15 03:20:59', '2025-02-15 03:20:59'),
(4, 'Manajer Keuangan', '15000000.00', '5000000.00', '2025-02-15 03:21:38', '2025-02-15 03:21:38'),
(5, 'Manajer SDM', '14000000.00', '4500000.00', '2025-02-15 03:22:06', '2025-02-15 03:22:06'),
(6, 'Supervisor Pemasaran', '9500000.00', '2800000.00', '2025-02-15 03:22:55', '2025-02-15 03:22:55'),
(7, 'Staf Administrasi', '6500000.00', '1500000.00', '2025-02-15 03:24:10', '2025-02-15 03:24:10'),
(8, 'Staf Keuangan', '7000000.00', '1800000.00', '2025-02-15 03:24:40', '2025-02-15 03:24:40'),
(9, 'Staf IT', '8000000.00', '2000000.00', '2025-02-15 03:25:06', '2025-02-15 03:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jabatan_id` bigint UNSIGNED NOT NULL,
  `status` enum('aktif','tidak aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `nip`, `alamat`, `no_telepon`, `tanggal_masuk`, `jabatan_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Asep Nugraha', '00789101', 'Jalan Surabaya no.21', '08985783291', '2020-12-09', 2, 'aktif', '2025-02-13 05:35:41', '2025-02-15 03:40:04'),
(2, 'Indra Gutawa', '00789102', 'Jl. Merdeka 12', '08985787529', '2023-06-08', 2, 'aktif', '2025-02-15 03:17:45', '2025-02-15 03:40:17'),
(3, 'Andi Prasetyo', '00789103', 'Jalan Melati No. 10', '081234567890', '2023-12-14', 2, 'aktif', '2025-02-15 03:39:54', '2025-02-15 03:40:27'),
(4, 'Budi Santoso', '00789104', 'Jalan Mawar No. 12', '082345678901', '2021-05-25', 2, 'aktif', '2025-02-15 03:41:18', '2025-02-15 03:41:18'),
(5, 'Citra Lestari', '00789105', 'Jalan Kenanga No. 15', '083456789012', '2022-07-15', 2, 'aktif', '2025-02-15 03:42:37', '2025-02-15 03:42:37'),
(6, 'Dian Wicaksono', '00456101', 'Jalan Anggrek No. 8', '084567890123', '2023-09-16', 1, 'aktif', '2025-02-15 03:43:49', '2025-02-15 03:43:49'),
(7, 'Gunawan Saputra', '00778101', 'Jalan Teratai No. 25', '087890123456', '2021-01-27', 3, 'aktif', '2025-02-15 03:44:53', '2025-02-15 03:44:53'),
(8, 'Hendra Wijaya', '00432101', 'Jalan Bougenville No. 30', '088901234567', '2022-03-22', 9, 'aktif', '2025-02-15 03:46:02', '2025-02-15 03:46:02'),
(9, 'Indah Permata', '00679101', 'Jalan Flamboyan No. 18', '089012345678', '2023-07-29', 8, 'aktif', '2025-02-15 03:47:37', '2025-02-15 03:47:37'),
(10, 'Joko Prasetya', '00554101', 'Jalan Sukun No. 5', '081112623276', '2021-09-20', 5, 'aktif', '2025-02-15 03:51:20', '2025-02-15 03:51:20'),
(11, 'Eka Wibowo', '00782101', 'Jalan Dahlia No. 20', '085678901234', '2023-08-17', 4, 'aktif', '2025-02-15 03:52:34', '2025-02-15 03:52:34'),
(12, 'Jodi Satrio', '00562101', 'Jalan Bunga No. 99', '0812584768', '2022-01-25', 7, 'aktif', '2025-02-15 03:53:47', '2025-02-15 03:53:47'),
(13, 'Gerry Fadly', '00236101', 'Jalan Siliwangin No. 102', '08165684554', '2022-09-18', 6, 'aktif', '2025-02-15 03:55:09', '2025-02-15 03:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_13_121701_create_jabatan_table', 1),
(6, '2024_02_13_121702_create_karyawan_table', 1),
(7, '2024_02_13_121703_create_gaji_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', NULL, '$2y$12$iTrrYmrNZHcHONDkNobcsO4DPHjmUiegtX1avsHlgCtGU4Fg69TG.', '3lziyum6DUkoAoAOJLIsjpQK60HkUyxNWB0HcSWCZeV0vWWVC8qGD2RLZUz0', '2025-02-13 05:29:15', '2025-02-13 05:29:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_nip_unique` (`nip`),
  ADD KEY `karyawan_jabatan_id_foreign` (`jabatan_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
