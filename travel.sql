-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2020 at 01:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodation_services`
--

CREATE TABLE `accommodation_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accommodation_services`
--

INSERT INTO `accommodation_services` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'play', '2020-09-21 06:12:47', '2020-09-21 06:12:47'),
(2, 'wifi', '2020-09-21 08:23:01', '2020-09-21 08:23:01'),
(9, 'Steam', '2020-09-21 17:49:47', '2020-09-21 17:49:47'),
(10, 'Air', '2020-09-21 17:58:48', '2020-09-21 17:58:48'),
(11, 'First', '2020-09-21 20:10:40', '2020-09-21 20:10:40'),
(12, 'Second', '2020-09-21 20:10:40', '2020-09-21 20:10:40'),
(13, 'Third', '2020-09-21 20:10:40', '2020-09-21 20:10:40'),
(20, 'Swimming', '2020-09-21 20:53:41', '2020-09-21 20:53:41'),
(21, 'Fifth', '2020-09-21 22:15:36', '2020-09-21 22:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `phone`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administration', 'test@test.com', '$2y$10$jLBcrG3Con73l5tmme5.k.AdMZ8P/5teo2qMgYHGwxmb.pyYmAis6', '0987654321', 'admins/20092113150131481.jpg', 'ZUPRRYr5X4CMKKghm44zIKdAcqqq6oY2EtQ9QhfUJC9ckWBl4d7PEhU1M7OL', '2020-09-19 01:37:56', '2020-09-20 23:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `slug`, `image`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 'cairo', 'cities/egypt/20092162708667600.jpg', 1, '2020-09-21 02:19:38', '2020-09-21 04:27:08'),
(2, 'G-Melano', 'g-melano', 'cities/germany/20092162810389162.jpg', 2, '2020-09-21 02:24:27', '2020-09-22 10:02:20'),
(7, 'Giza', 'giza', 'cities/egypt/20092162732115973.jpg', 1, '2020-09-21 02:33:55', '2020-09-21 04:27:32'),
(13, 'Alex', 'alex', 'cities/egypt/200922120508218182.jpg', 1, '2020-09-21 22:05:09', '2020-09-21 22:05:09'),
(14, 'Zamalik', 'zamalik', 'cities/italy/200922121932866259.jpg', 3, '2020-09-21 22:19:33', '2020-09-21 22:19:33'),
(15, 'G-Broken', 'g-broken', 'cities/germany/200922120203512879.jpg', 2, '2020-09-22 10:02:04', '2020-09-22 10:02:29'),
(16, 'G-Loka', 'g-loka', 'cities/germany/200922120308999866.jpg', 2, '2020-09-22 10:03:09', '2020-09-22 10:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', 'egypt', '2020-09-21 00:51:43', '2020-09-21 01:39:05'),
(2, 'Germany', 'germany', '2020-09-21 00:51:50', '2020-09-21 01:39:48'),
(3, 'Italy', 'italy', '2020-09-21 00:51:56', '2020-09-21 01:42:51'),
(5, 'Canadan', 'canadan', '2020-09-21 00:52:07', '2020-09-21 01:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`services`)),
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `title`, `slug`, `image`, `services`, `city_id`, `hide`, `created_at`, `updated_at`) VALUES
(1, 'G-Hilton', 'g-hilton', 'hotels/cairo/20092184844224864.jpg', '[\"play\",\"wifi\",\"Steam\",\"Air\",\"Fifth\"]', 2, 0, '2020-09-21 17:58:49', '2020-09-22 11:23:26'),
(3, 'Halawa Hotel', 'halawa-hotel', 'hotels/giza/200921111759502121.jpg', '[\"wifi\",\"Steam\",\"Air\",\"First\"]', 1, 0, '2020-09-21 21:18:00', '2020-09-21 22:18:56'),
(4, 'G-Zamalik Helton', 'g-zamalik-helton', 'hotels/zamalik/200922122016906941.jpg', '[\"wifi\",\"Air\"]', 2, 0, '2020-09-21 22:20:17', '2020-09-22 11:23:07'),
(5, 'G-MM Hotel', 'g-mm-hotel', 'hotels/melano/200922120043356019.jpg', '[\"Steam\",\"Air\",\"First\"]', 2, 0, '2020-09-22 10:00:45', '2020-09-22 11:23:38'),
(6, 'G-First-Hotel-Broken', 'g-first-hotel-broken', 'hotels/g-broken/200922120815392539.jpg', '[\"wifi\",\"Steam\",\"First\"]', 15, 0, '2020-09-22 10:08:16', '2020-09-22 10:08:41'),
(7, 'G-Second-Hotel-Brok', 'g-second-hotel-brok', 'hotels/g-broken/200922120940428677.jpg', '[\"Steam\",\"First\",\"Fifth\"]', 15, 0, '2020-09-22 10:09:41', '2020-09-22 10:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_19_031320_create_admins_table', 1),
(5, '2020_09_19_041320_create_settings_table', 1),
(16, '2020_09_19_042320_create_countries_table', 2),
(17, '2020_09_19_043320_create_cities_table', 2),
(18, '2020_09_19_065821_create_hotels_table', 2),
(19, '2020_09_19_070105_create_offers_table', 2),
(20, '2020_09_19_071844_create_accommodation_services_table', 2),
(21, '2020_09_19_072017_create_offers_cities_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult_price` decimal(8,2) NOT NULL COMMENT 'price for person',
  `child_price` decimal(8,2) NOT NULL COMMENT 'price for person',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `duration` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `slug`, `adult_price`, `child_price`, `date_from`, `date_to`, `duration`, `image`, `gallery`, `country_id`, `user_id`, `hide`, `created_at`, `updated_at`) VALUES
(1, 'First Offer', 'first-offer', '100.00', '50.00', '2020-09-24', '2020-09-30', 6, 'offers/20092251017508168.jpg', '[\"offers\\/gallery\\/20092290356168299.jpeg\",\"offers\\/gallery\\/20092290356244628.jpg\",\"offers\\/gallery\\/20092290356703703.jpeg\"]', 1, NULL, 0, '2020-09-22 03:10:18', '2020-09-22 07:03:56'),
(3, 'Second Offer', 'second-offer', '50.00', '20.00', '2020-10-01', '2020-10-20', 19, 'offers/20092261528415459.jpg', '[\"offers\\/gallery\\/20092290420345606.jpg\",\"offers\\/gallery\\/20092290420886685.jpg\"]', 2, NULL, 0, '2020-09-22 04:15:28', '2020-09-22 07:04:30'),
(4, 'Test', 'test', '20.00', '5.00', '2020-09-22', '2020-09-23', 1, 'offers/20092274900145742.jpg', '[]', 3, NULL, 0, '2020-09-22 05:49:00', '2020-09-22 05:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `offers_cities`
--

CREATE TABLE `offers_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `duration` int(11) NOT NULL,
  `room_type` enum('single','double') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers_cities`
--

INSERT INTO `offers_cities` (`id`, `date_from`, `date_to`, `duration`, `room_type`, `hotel_id`, `city_id`, `offer_id`, `created_at`, `updated_at`) VALUES
(6, '2020-10-01', '2020-10-05', 4, 'single', 1, 2, 3, '2020-09-22 11:46:05', '2020-09-22 11:46:05'),
(7, '2020-10-05', '2020-10-20', 15, 'double', 6, 15, 3, '2020-09-22 11:56:27', '2020-09-22 11:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sm_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_white` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_white` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `sm_description`, `phone_1`, `phone_2`, `email_1`, `email_2`, `logo`, `logo_white`, `favicon_white`, `favicon`, `address`, `facebook`, `twitter`, `instagram`, `linkedin`, `keywords`, `description`, `created_at`, `updated_at`) VALUES
(1, 'TravelGo', 'TravelGo is an app for tourism.', '+20101010101000', NULL, 'info@travelgo.com', NULL, 'setting/200921124204589962.png', 'setting/200921124340223330.png', 'setting/200921124536473551.png', 'setting/20092112450738576.png', NULL, NULL, NULL, NULL, 'https://www.linkedin.com/in/hozaifa-ramadan/', NULL, NULL, '2020-09-19 01:37:56', '2020-09-20 23:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodation_services`
--
ALTER TABLE `accommodation_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accommodation_services_title_unique` (`title`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_country_id_title_unique` (`country_id`,`title`),
  ADD KEY `cities_country_id_index` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_title_unique` (`title`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hotels_city_id_title_unique` (`city_id`,`title`),
  ADD KEY `hotels_city_id_index` (`city_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offers_country_id_title_unique` (`country_id`,`title`),
  ADD KEY `offers_country_id_index` (`country_id`),
  ADD KEY `offers_user_id_index` (`user_id`);

--
-- Indexes for table `offers_cities`
--
ALTER TABLE `offers_cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offers_cities_offer_id_city_id_unique` (`offer_id`,`city_id`),
  ADD UNIQUE KEY `offers_cities_offer_id_hotel_id_unique` (`offer_id`,`hotel_id`),
  ADD KEY `offers_cities_hotel_id_index` (`hotel_id`),
  ADD KEY `offers_cities_city_id_index` (`city_id`),
  ADD KEY `offers_cities_offer_id_index` (`offer_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodation_services`
--
ALTER TABLE `accommodation_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offers_cities`
--
ALTER TABLE `offers_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `COUNTRY_CITY_ID_FK` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `CITY_HOTEL_ID_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `COUNTRY_OFFER_ID_FK` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_OFFER_ID_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `offers_cities`
--
ALTER TABLE `offers_cities`
  ADD CONSTRAINT `CITY_OFFERS_CITIES_ID_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `HOTEL_OFFERS_CITIES_ID_FK` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `OFFER_CITY_OFFERS_ID_FK` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
