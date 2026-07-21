-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2026 at 06:46 AM
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
-- Database: `eduibd`
--

-- --------------------------------------------------------

--
-- Table structure for table `web_banners`
--

CREATE TABLE `web_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `meta_details` text DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_banners`
--

INSERT INTO `web_banners` (`id`, `school_id`, `url`, `name`, `image`, `meta_details`, `keywords`, `sequence`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, '20879834781784602199_image.jpg', NULL, NULL, 0, 1, '2026-07-20 20:49:59', '2026-07-20 20:49:59'),
(2, 3, NULL, NULL, '12639523061784606179_image.jpg', NULL, NULL, 0, 1, '2026-07-20 21:56:19', '2026-07-20 21:56:19'),
(3, 3, NULL, NULL, '16101294141784608323_image.jpg', NULL, NULL, 0, 1, '2026-07-20 22:32:03', '2026-07-20 22:32:03'),
(4, 3, NULL, NULL, '9470250801784608329_image.jpg', NULL, NULL, 0, 1, '2026-07-20 22:32:09', '2026-07-20 22:32:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_banners`
--
ALTER TABLE `web_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_banners`
--
ALTER TABLE `web_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
