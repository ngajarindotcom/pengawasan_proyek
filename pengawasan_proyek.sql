-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 12:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengawasan_proyek`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_lapangan`
--

CREATE TABLE `form_lapangan` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `proyek_id` int(11) UNSIGNED NOT NULL,
  `tanggal_pengawasan` date NOT NULL,
  `status_cuaca` enum('Cerah','Hujan','Mendung') NOT NULL,
  `pekerjaan_dilakukan` text NOT NULL,
  `jumlah_pekerja` int(11) NOT NULL,
  `kondisi_material` enum('Cukup','Kurang','Rusak') NOT NULL,
  `ketersediaan_alat` enum('Tersedia','Tidak Tersedia') NOT NULL,
  `penerapan_sop_k3` enum('Diterapkan','Tidak Diterapkan') NOT NULL,
  `foto_toolbox` varchar(255) DEFAULT NULL,
  `foto_checkup` varchar(255) DEFAULT NULL,
  `foto_pelaksanaan` varchar(255) DEFAULT NULL,
  `foto_alat_bahan` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('draft','terkirim') NOT NULL DEFAULT 'draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `form_lapangan`
--

INSERT INTO `form_lapangan` (`id`, `user_id`, `proyek_id`, `tanggal_pengawasan`, `status_cuaca`, `pekerjaan_dilakukan`, `jumlah_pekerja`, `kondisi_material`, `ketersediaan_alat`, `penerapan_sop_k3`, `foto_toolbox`, `foto_checkup`, `foto_pelaksanaan`, `foto_alat_bahan`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-08-05', 'Cerah', 'Demo pekerjaan pengecatan kaki kaki patung', 12, 'Cukup', 'Tersedia', 'Diterapkan', '1754384695_bcf2b529b10f2e39cb76.png', '1754384695_87c610fa38fa7f1398af.jpeg', '1754384696_c9f695ce03bae0ce84a7.jpeg', '1754384697_8421ac813f2346f282ab.jpg', 'demo syaa', 'draft', NULL, NULL),
(2, 2, 1, '2025-08-04', 'Hujan', 'Demo kirim', 5, 'Kurang', 'Tersedia', 'Tidak Diterapkan', '1754385701_1c096214a3ac57347abe.jpeg', '1754385701_f25356716c572a57c036.jpeg', '1754385702_da797036200c9861db4c.jpeg', '1754385703_99a4666f68cbdb86b368.jpg', 'demo kirim', 'terkirim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_material`
--

CREATE TABLE `form_material` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `proyek_id` int(10) UNSIGNED NOT NULL,
  `tanggal_pengawasan` date NOT NULL,
  `material_1` int(11) DEFAULT NULL,
  `material_2` int(11) DEFAULT NULL,
  `material_3` int(11) DEFAULT NULL,
  `material_4` int(11) DEFAULT NULL,
  `material_5` int(11) DEFAULT NULL,
  `material_6` int(11) DEFAULT NULL,
  `material_7` int(11) DEFAULT NULL,
  `material_8` int(11) DEFAULT NULL,
  `material_9` int(11) DEFAULT NULL,
  `material_10` int(11) DEFAULT NULL,
  `foto_material` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('draft','terkirim') NOT NULL DEFAULT 'draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `form_material`
--

INSERT INTO `form_material` (`id`, `user_id`, `proyek_id`, `tanggal_pengawasan`, `material_1`, `material_2`, `material_3`, `material_4`, `material_5`, `material_6`, `material_7`, `material_8`, `material_9`, `material_10`, `foto_material`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2025-08-06', 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, '1754462467_d6d9053fb0b5fb8a399f.png', 'demo material draf', 'draft', NULL, NULL),
(3, 3, 1, '2025-08-06', 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, '1754464086_9d2690ae88dad70af8a1.jpeg', 'demo terkirim', 'terkirim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023_01_01_000000', 'App\\Database\\Migrations\\CreateTables', 'default', 'App', 1754379797, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `nama_pelaksana` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `nama_pelaksana`, `created_at`, `updated_at`) VALUES
(1, 'Patung Dirgantara', 'CV Gatra Wijaya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','pengawas_lapangan','pengawas_material') NOT NULL DEFAULT 'pengawas_lapangan',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', NULL, NULL),
(2, 'syarif', '$2y$10$kmhhT/FhTjY0bbH.eB14Pu1gAPj612Htzo/.kOTQzeTQLe826mjWm', 'ah syarif', 'pengawas_lapangan', NULL, NULL),
(3, 'syarif2', '$2y$10$IsZmKmiRBMcvoEzAW3dRHe0fqAZinUDt9sosKAgccPgxYyrmW8PJu', 'mat syarif', 'pengawas_material', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_lapangan`
--
ALTER TABLE `form_lapangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_lapangan_user_id_foreign` (`user_id`),
  ADD KEY `form_lapangan_proyek_id_foreign` (`proyek_id`);

--
-- Indexes for table `form_material`
--
ALTER TABLE `form_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_material_user_id_foreign` (`user_id`),
  ADD KEY `fk_form_material_proyek` (`proyek_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_lapangan`
--
ALTER TABLE `form_lapangan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form_material`
--
ALTER TABLE `form_material`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_lapangan`
--
ALTER TABLE `form_lapangan`
  ADD CONSTRAINT `form_lapangan_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`),
  ADD CONSTRAINT `form_lapangan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `form_material`
--
ALTER TABLE `form_material`
  ADD CONSTRAINT `fk_form_material_proyek` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `form_material_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
