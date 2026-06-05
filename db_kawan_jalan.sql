-- phpMyAdmin SQL Dump
-- Revisi oleh ChatGPT: primary key tabel bisnis diubah dari `id` menjadi nama tabel + `_id`.
-- Foreign key tetap menggunakan nama aplikasi Laravel yang sudah ada: user_id, city_id, destination_id.
-- Tabel sistem Laravel seperti sessions, cache, cache_locks, password_reset_tokens, dan migrations dibiarkan sesuai standar framework.

-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2026 at 08:31 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kawan_jalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cities_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--


INSERT INTO `cities` (`cities_id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Bogor', 'bogor', 'assets/kawan/cities/bogor.jpg', '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(2, 'Bandung', 'bandung', 'assets/kawan/cities/bandung.jpg', '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(3, 'Garut', 'garut', 'assets/kawan/cities/garut.jpg', '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(4, 'Sukabumi', 'sukabumi', 'assets/kawan/cities/sukabumi.webp', '2026-05-15 01:04:33', '2026-05-15 01:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destinations_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ticket_price` int NOT NULL DEFAULT '0',
  `open_hour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `is_recommended` tinyint(1) NOT NULL DEFAULT '0',
  `activity_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--


INSERT INTO `destinations` (`destinations_id`, `city_id`, `name`, `slug`, `image`, `description`, `ticket_price`, `open_hour`, `location`, `is_popular`, `is_recommended`, `activity_count`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dairyland Riverside', 'dairyland-riverside', 'assets/kawan/destinations/cimoryriverside.jpg', 'Destinasi wisata keluarga bertema edukasi, kuliner, dan aktivitas rekreasi di kawasan Bogor.', 25000, '08.00-16.00 WIB', 'Bogor', 1, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(2, 1, 'Museum Zoologi', 'museum-zoologi', 'assets/kawan/destinations/museum-zoologi-profile1695489301.jpeg', 'Museum edukasi dengan koleksi satwa dan pengetahuan zoologi untuk wisata keluarga.', 20000, '07.00-18.00 WIB', 'Bogor', 1, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(3, 1, 'Museum Etnobotani', 'museum-etnobotani', 'assets/kawan/destinations/museum-etnobotani.jpg', 'Museum edukasi dengan koleksi budaya dan tanaman Indonesia.', 15000, '08.00-16.00 WIB', 'Bogor', 1, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(4, 1, 'Kebun Raya Bogor', 'kebun-raya-bogor', 'assets/kawan/destinations/kebun-raya-bogor.jpg', 'Destinasi hijau ikonik di pusat kota Bogor.', 16000, '08.00-16.00 WIB', 'Bogor', 1, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(5, 1, 'JungleLand Adventure', 'jungleland-adventure', 'assets/kawan/destinations/jungleland-adventure.webp', 'Tempat rekreasi keluarga dan wahana permainan.', 155000, '10.00-17.00 WIB', 'Sentul, Bogor', 1, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(6, 1, 'Taman Safari Bogor', 'taman-safari-bogor', 'assets/kawan/destinations/taman-safari-bogor.webp', 'Wisata satwa favorit untuk keluarga dan rombongan.', 450000, '08.30-17.00 WIB', 'Cisarua, Bogor', 1, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(7, 2, 'Gedung Sate', 'gedung-sate', 'assets/kawan/destinations/gedung-sate.jpg', 'Ikon Kota Bandung dan wisata sejarah arsitektur.', 35000, '08.00-16.00 WIB', 'Bandung', 0, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(8, 2, 'The Great Asia Afrika', 'the-great-asia-afrika', 'assets/kawan/destinations/the-great-asia-afrika.webp', 'Taman miniatur budaya negara Asia Afrika dengan spot foto menarik.', 50000, '09.00-18.00 WIB', 'Bandung', 0, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(9, 3, 'Situ Bagendit', 'situ-bagendit', 'assets/kawan/destinations/situ-bagendit.webp', 'Wisata danau populer di Garut untuk keluarga.', 30000, '08.00-17.00 WIB', 'Garut', 0, 1, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33');


-- --------------------------------------------------------

--
-- Table structure for table `destination_reviews`
--

CREATE TABLE `destination_reviews` (
  `destination_reviews_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destination_reviews`
--

INSERT INTO `destination_reviews` (`destination_reviews_id`, `user_id`, `destination_id`, `order_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 5, 'Tempatnya cocok untuk liburan keluarga, area wisatanya rapi, dan pemandunya membantu selama perjalanan.', '2026-05-15 01:10:00', '2026-05-15 01:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorites_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorites_id`, `user_id`, `destination_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(2, 2, 5, '2026-05-15 01:28:51', '2026-05-15 01:28:51');

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
(1, '2026_05_15_000001_create_kawan_jalan_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications_app`
--

CREATE TABLE `notifications_app` (
  `notifications_app_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications_app`
--

INSERT INTO `notifications_app` (`notifications_app_id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 2, 'Booking Berhasil!', 'Booking Anda untuk Dairyland Riverside telah dikonfirmasi. Guide akan menghubungi Anda segera.', 'success', 0, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(2, 2, 'Promo Spesial', 'Dapatkan diskon 20% untuk booking wisata Tangkuban Perahu minggu ini!', 'info', 0, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(3, 2, 'Perubahan Jadwal', 'Jadwal kunjungan Anda ke Taman Safari diundur 1 jam karena cuaca.', 'warning', 0, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(4, 2, 'Review Wisata', 'Bagaimana pengalaman Anda di Kebun Raya Bogor? Berikan rating!', 'info', 0, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(5, 3, 'Booking Berhasil!', 'Booking Anda untuk Taman Safari Bogor telah dikonfirmasi.', 'success', 0, '2026-05-15 01:25:13', '2026-05-15 01:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `guide_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guide_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_price` int NOT NULL DEFAULT '0',
  `guide_fee` int NOT NULL DEFAULT '0',
  `admin_fee` int NOT NULL DEFAULT '0',
  `ticket_quantity` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `include_guide` tinyint(1) NOT NULL DEFAULT '1',
  `total` int NOT NULL DEFAULT '0',
  `status` enum('pending','paid','completed','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'QRIS',
  `payment_deadline` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `ticket_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `user_id`, `destination_id`, `guide_name`, `guide_phone`, `ticket_price`, `guide_fee`, `admin_fee`, `ticket_quantity`, `include_guide`, `total`, `status`, `payment_method`, `payment_deadline`, `paid_at`, `ticket_code`, `group_barcode`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Pemandu Kawan Jalan', '0812-3456-7890', 25000, 250000, 10000, 1, 1, 285000, 'completed', 'QRIS', '2026-05-15 01:19:33', '2026-05-15 01:04:33', 'TM3288422', 'GRP-TM3288422', '2026-05-15 01:04:33', '2026-05-15 01:04:33');

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
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `reports_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `guide_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guide_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','reviewed','resolved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reports_id`, `user_id`, `guide_name`, `guide_phone`, `group_link`, `destination_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Doni Ramdhani', '081234567890', 'https://chat.whatsapp.com/H1s4PbpZNWhCubKPZyW6GR', 'Kawah Putih', 'Guide tidak datang tepat waktu dan tidak memberikan informasi yang jelas.', 'pending', '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(2, 2, 'Siti Nurhaliza', '081234567891', 'https://chat.whatsapp.com/H1s4PbpZNWhCubKPZyW6GR', 'Kebun Raya Bogor', 'Pemandu sulit dihubungi ketika jadwal mulai.', 'reviewed', '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(3, 2, 'Ahmad Yani', '081234567892', 'https://chat.whatsapp.com/H1s4PbpZNWhCubKPZyW6GR', 'Tangkuban Perahu', 'Guide membatalkan tur mendadak tanpa pemberitahuan sebelumnya.', 'resolved', '2026-05-15 01:04:33', '2026-05-15 01:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('13D8lIu2qm87MjFFUWYedse1F9xAL1NsBLVr5t6X', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.120.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWpldWFxdFRNMkxCaEF2UThuYTdsdzJtZWhkOUJ1Y2ZQUG1WZ011RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778833246),
('iR1X7sTw6Buy55YGD9YZjBGcFSKmX0zQ0x1PAwcI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEQ1Y3VGdVpsWTB6ZTcwS3dqWFk5aDhHbGxub2tKbTM5c3FNeFBrSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1778833829);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','banned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `status`, `country`, `city`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Kawan Jalan', 'admin@kawanjalan.com', '0811111111', NULL, '$2y$12$WA7.W5rnUO.NjnmXnCtlYO3FZHT5gV3CqULDVWDEcEp.7nSDQr6bq', 'admin', 'active', NULL, NULL, NULL, NULL, '2026-05-15 01:04:32', '2026-05-15 01:04:32'),
(2, 'User Wisatawan', 'user@gmail.com', '081234567890', NULL, '$2y$12$o08I/15bF00aD9qrzDe1/.aogl/Ppab2jp15berafa9e850DAiIDu', 'user', 'active', 'Indonesia', 'Bogor', 'Jl. Kawan Jalan No. 6', NULL, '2026-05-15 01:04:33', '2026-05-15 01:04:33'),
(3, 'CREATE 1', 'CREAT1@HOGH.COM', NULL, NULL, '$2y$12$H/og0CyhPmyLqZj7jxJtiuNTsmAPKUYATFp2TaSuMtQX7PCS1e0kK', 'user', 'banned', NULL, NULL, NULL, NULL, '2026-05-15 01:24:14', '2026-05-15 01:28:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cities_id`),
  ADD UNIQUE KEY `cities_slug_unique` (`slug`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destinations_id`),
  ADD UNIQUE KEY `destinations_slug_unique` (`slug`),
  ADD KEY `destinations_city_id_foreign` (`city_id`);


--
-- Indexes for table `destination_reviews`
--
ALTER TABLE `destination_reviews`
  ADD PRIMARY KEY (`destination_reviews_id`),
  ADD UNIQUE KEY `destination_reviews_user_id_destination_id_unique` (`user_id`,`destination_id`),
  ADD KEY `destination_reviews_destination_id_foreign` (`destination_id`),
  ADD KEY `destination_reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorites_id`),
  ADD UNIQUE KEY `favorites_user_id_destination_id_unique` (`user_id`,`destination_id`),
  ADD KEY `favorites_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_app`
--
ALTER TABLE `notifications_app`
  ADD PRIMARY KEY (`notifications_app_id`),
  ADD KEY `notifications_app_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reports_id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

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
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cities_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destinations_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


--
-- AUTO_INCREMENT for table `destination_reviews`
--
ALTER TABLE `destination_reviews`
  MODIFY `destination_reviews_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorites_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications_app`
--
ALTER TABLE `notifications_app`
  MODIFY `notifications_app_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `reports_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`cities_id`) ON DELETE CASCADE;


--
-- Constraints for table `destination_reviews`
--
ALTER TABLE `destination_reviews`
  ADD CONSTRAINT `destination_reviews_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destinations_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `destination_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`orders_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `destination_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destinations_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications_app`
--
ALTER TABLE `notifications_app`
  ADD CONSTRAINT `notifications_app_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destinations_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
