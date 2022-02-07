-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 07, 2022 at 09:49 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orphans`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_04_000353_create_orphans_table', 2),
(6, '2022_02_04_000931_create_sponsor_orphans_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orphans`
--

DROP TABLE IF EXISTS `orphans`;
CREATE TABLE IF NOT EXISTS `orphans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `birth_certificate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dead` enum('father','mother','both') COLLATE utf8mb4_unicode_ci NOT NULL,
  `death_certificate_father` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `death_certificate_mother` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('waiting_approval','approval','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orphans`
--

INSERT INTO `orphans` (`id`, `user_id`, `birth_certificate`, `dead`, `death_certificate_father`, `death_certificate_mother`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '', 'father', '', '', 'waiting_approval', '2022-02-05 13:21:06', '2022-02-05 13:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_orphans`
--

DROP TABLE IF EXISTS `sponsor_orphans`;
CREATE TABLE IF NOT EXISTS `sponsor_orphans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sponsor_id` bigint(20) UNSIGNED NOT NULL,
  `orphan_id` bigint(20) UNSIGNED NOT NULL,
  `start_warranty_date` date NOT NULL,
  `warranty_period` int(11) NOT NULL COMMENT 'month',
  `warranty_value` double NOT NULL COMMENT '$',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sponsor_orphans_orphan_id_sponsor_id_start_warranty_date_unique` (`orphan_id`,`sponsor_id`,`start_warranty_date`),
  KEY `sponsor_orphans_sponsor_id_foreign` (`sponsor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` bigint(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `id_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('orphan','sponsor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet` double NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_number`, `image`, `date_birth`, `id_image`, `type`, `wallet`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rawan', 'seaheart_rnd@hotmail.com', NULL, '$2y$10$.6xRqeMxKss8zLyEX8G79e2zD6GbePo1j1rMLNRFvgi0/MnDEr3TO', 55787575757575, '', '2022-02-11', '', 'orphan', 100, NULL, '2022-02-04 23:18:25', '2022-02-05 15:11:40'),
(2, 'abderhman abu daya', 'lel23443217399@gmail.com', NULL, '$2y$10$T6vgeY0aNkwD8iybInrXCuFd9ePJ9.3V47vQrlTia980aU4hjFKIq', 123456789, '', '2022-02-09', '', 'sponsor', 50, NULL, '2022-02-04 23:29:33', '2022-02-05 15:11:40'),
(3, 'ادوات منزلية', 'dsadasd@cscsdcsd.com', NULL, '$2y$10$H0oQ6JYwqjp5Pkz/U66qIOD4bYWxVYJeJ3J00TB3/afI2gAiiNyI6', 5646465, '', '5454-04-05', '', 'sponsor', 0, NULL, '2022-02-06 11:21:48', '2022-02-06 11:21:48'),
(4, 'ادوات منزلية', 'dsadasd@cscsdcsd.comf', NULL, '$2y$10$8aLvgdRZIVTfTcYRHMVqoelf9ZsV.p3F8BJj/sl7lRX1yxG9kYAHW', 5646465, '', '5454-04-05', '', 'sponsor', 0, NULL, '2022-02-06 11:23:02', '2022-02-06 11:23:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
