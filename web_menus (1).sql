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
-- Table structure for table `web_menus`
--

CREATE TABLE `web_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `depth` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `title_bangla` varchar(255) DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_menus`
--

INSERT INTO `web_menus` (`id`, `school_id`, `parent_id`, `depth`, `title`, `title_bangla`, `uri`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 0, 'Home', 'হোম', '/', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(2, 3, NULL, 0, 'About Us', 'আমাদের সম্পর্কে', 'about', 2, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(3, 3, 2, 1, 'History', 'প্রতিষ্ঠানের ইতিহাস', 'history', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(4, 3, 2, 1, 'Mission & Vision', 'লক্ষ্য ও উদ্দেশ্য', 'mission-vision', 2, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(5, 3, 2, 1, 'Principal Message', 'অধ্যক্ষের বাণী', 'principal-message', 3, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(6, 3, NULL, 0, 'Academic', 'একাডেমিক', 'academic', 3, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(7, 3, 7, 1, 'Departments', 'বিভাগসমূহ', 'departments', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(8, 3, 7, 1, 'Class Information', 'শ্রেণি তথ্য', 'classes', 2, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(9, 3, 7, 1, 'Academic Calendar', 'একাডেমিক ক্যালেন্ডার', 'academic-calendar', 3, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(10, 3, NULL, 0, 'Admission', 'ভর্তি', 'admission', 4, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(11, 3, 11, 1, 'Admission Notice', 'ভর্তি বিজ্ঞপ্তি', 'admission-notice', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(12, 3, 11, 1, 'Admission Process', 'ভর্তি প্রক্রিয়া', 'admission-process', 2, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(13, 3, 11, 1, 'Online Admission', 'অনলাইন ভর্তি', 'online-admission', 3, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(14, 3, NULL, 0, 'Students', 'শিক্ষার্থী', 'students', 5, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(15, 3, 15, 1, 'Student Result', 'ফলাফল', 'result', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(16, 3, 15, 1, 'Student Attendance', 'শিক্ষার্থী উপস্থিতি', 'attendance', 2, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(17, 3, NULL, 0, 'Teachers', 'শিক্ষক', 'teachers', 6, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(18, 3, 18, 1, 'Teacher List', 'শিক্ষক তালিকা', 'faculty', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(19, 3, NULL, 0, 'Notice', 'নোটিশ', 'notice', 7, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(20, 3, NULL, 0, 'Gallery', 'গ্যালারি', 'gallery', 8, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(21, 3, 21, 1, 'Photo Gallery', 'ছবি গ্যালারি', 'photo-gallery', 1, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(22, 3, 21, 1, 'Video Gallery', 'ভিডিও গ্যালারি', 'video-gallery', 2, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50'),
(23, 3, NULL, 0, 'Contact Us', 'যোগাযোগ', 'contact', 9, 1, '2026-07-21 04:10:50', '2026-07-21 04:10:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_menus`
--
ALTER TABLE `web_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `school_id_2` (`school_id`,`parent_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_menus`
--
ALTER TABLE `web_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `web_menus`
--
ALTER TABLE `web_menus`
  ADD CONSTRAINT `web_menus_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `web_menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
