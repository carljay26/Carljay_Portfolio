-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2026 at 06:40 PM
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
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `avatar_path`, `password`, `remember_token`, `is_super_admin`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'Carl Jay Cocamas', 'carljaycocamas26@gmail.com', 'images/admins/admin_avatar_1.jpeg', '$2y$12$NsE43cSawoxCAfqIrqfVSOSJmjHKyN3fQLPilCB48NHRG7SvbEJj2', NULL, 1, NULL, '2026-03-15 10:28:11', '2026-03-15 14:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(191) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `reply_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `ip_address`, `is_read`, `read_at`, `replied_at`, `reply_text`, `created_at`, `updated_at`) VALUES
(1, 'Sample Recruiter', 'recruiter@example.com', 'Project Inquiry', 'Hi Carl, I came across your portfolio and I am impressed with your work. I would love to discuss a potential collaboration.', NULL, 1, '2026-03-15 12:06:13', NULL, NULL, '2026-03-15 10:28:11', '2026-03-15 12:06:13'),
(2, 'carl', 'carljaycocamas26@gmail.com', 'Test', 'Testing', '127.0.0.1', 1, '2026-03-15 12:12:20', '2026-03-15 12:14:30', 'hi', '2026-03-15 12:11:53', '2026-03-15 12:14:30'),
(3, 'carl', 'jerbamancer123@gmail.com', 'Test', 'test', '127.0.0.1', 0, NULL, NULL, NULL, '2026-03-15 12:41:56', '2026-03-15 12:41:56'),
(4, 'carl', 'jerbamancer123@gmail.com', 'Test', 'test', '127.0.0.1', 0, NULL, NULL, NULL, '2026-03-15 12:43:21', '2026-03-15 12:43:21'),
(5, 'carl', 'jerbamancer123@gmail.com', 'Test', 'testtest', '127.0.0.1', 1, '2026-03-15 12:44:47', '2026-03-15 12:44:47', 'sadasdazw', '2026-03-15 12:43:47', '2026-03-15 12:44:47'),
(6, 'carl', 'carljaycocamas26@gmail.com', 'Test', 'testtest', '127.0.0.1', 1, '2026-03-16 19:55:56', '2026-03-16 19:55:56', 'bakla', '2026-03-16 19:52:56', '2026-03-16 19:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `type`, `school_name`, `year`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'primary', 'AFPLC Elementary School', '2015-2016', NULL, 1, '2026-03-17 08:55:31', '2026-03-17 08:55:31'),
(2, 'secondary', 'Dr. Santiago Dakudao Sr. National High School', '2016-2022', NULL, 2, '2026-03-17 08:55:56', '2026-03-17 08:55:56'),
(3, 'college', 'Assumption College of Davao', '2022-2026', 'Bachelor of Science in Information Technology', 3, '2026-03-17 08:57:06', '2026-03-17 08:57:06');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `disk` varchar(50) NOT NULL DEFAULT 'public',
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `size_bytes` bigint(20) UNSIGNED NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_16_100001_create_admins_table', 1),
(5, '2026_03_16_100002_create_profile_table', 1),
(6, '2026_03_16_100003_create_stats_table', 1),
(7, '2026_03_16_100004_create_social_links_table', 1),
(8, '2026_03_16_100005_create_skill_categories_table', 1),
(9, '2026_03_16_100006_create_skills_table', 1),
(10, '2026_03_16_100007_create_projects_table', 1),
(11, '2026_03_16_100008_create_project_images_table', 1),
(12, '2026_03_16_100009_create_project_skills_table', 1),
(13, '2026_03_16_100010_create_media_table', 1),
(14, '2026_03_16_100011_create_contact_messages_table', 1),
(15, '2026_03_16_200001_add_soft_deletes_to_projects_table', 2),
(16, '2026_03_16_200002_add_reply_text_to_contact_messages_table', 2),
(17, '2026_03_16_200003_create_page_views_table', 2),
(18, '2026_03_16_120000_add_avatar_path_to_admins_table', 3),
(19, '2026_03_18_000001_create_educations_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(100) NOT NULL DEFAULT '/',
  `ip_address` varchar(45) DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `page`, `ip_address`, `viewed_at`) VALUES
(1, '/', '127.0.0.1', '2026-03-15 19:55:41'),
(2, '/about', '127.0.0.1', '2026-03-15 19:55:59'),
(3, '/', '127.0.0.1', '2026-03-15 19:56:23'),
(4, '/contact', '127.0.0.1', '2026-03-15 19:56:33'),
(5, '/', '127.0.0.1', '2026-03-15 19:56:42'),
(6, '/projects', '127.0.0.1', '2026-03-15 19:56:51'),
(7, '/', '127.0.0.1', '2026-03-15 19:57:10'),
(8, '/contact', '127.0.0.1', '2026-03-15 19:57:20'),
(9, '/', '127.0.0.1', '2026-03-15 19:57:29'),
(10, '/contact', '127.0.0.1', '2026-03-15 19:57:41'),
(11, '/', '127.0.0.1', '2026-03-15 19:57:46'),
(12, '/', '127.0.0.1', '2026-03-15 19:58:01'),
(13, '/', '127.0.0.1', '2026-03-15 19:59:40'),
(14, '/contact', '127.0.0.1', '2026-03-15 20:01:13'),
(15, '/', '127.0.0.1', '2026-03-15 20:03:04'),
(16, '/about', '127.0.0.1', '2026-03-15 20:05:31'),
(17, '/', '127.0.0.1', '2026-03-15 20:10:24'),
(18, '/about', '127.0.0.1', '2026-03-15 20:10:43'),
(19, '/', '127.0.0.1', '2026-03-15 20:11:00'),
(20, '/projects', '127.0.0.1', '2026-03-15 20:11:04'),
(21, '/contact', '127.0.0.1', '2026-03-15 20:11:09'),
(22, '/contact', '127.0.0.1', '2026-03-15 20:11:22'),
(23, '/contact', '127.0.0.1', '2026-03-15 20:11:55'),
(24, '/contact', '127.0.0.1', '2026-03-15 20:13:07'),
(25, '/projects', '127.0.0.1', '2026-03-15 20:13:13'),
(26, '/', '127.0.0.1', '2026-03-15 20:13:23'),
(27, '/', '127.0.0.1', '2026-03-15 20:17:48'),
(28, '/contact', '127.0.0.1', '2026-03-15 20:19:06'),
(29, '/', '127.0.0.1', '2026-03-15 20:20:06'),
(30, '/contact', '127.0.0.1', '2026-03-15 20:20:16'),
(31, '/', '127.0.0.1', '2026-03-15 20:20:18'),
(32, '/', '127.0.0.1', '2026-03-15 20:20:22'),
(33, '/', '127.0.0.1', '2026-03-15 20:21:20'),
(34, '/contact', '127.0.0.1', '2026-03-15 20:21:35'),
(35, '/about', '127.0.0.1', '2026-03-15 20:21:48'),
(36, '/projects', '127.0.0.1', '2026-03-15 20:22:02'),
(37, '/contact', '127.0.0.1', '2026-03-15 20:22:14'),
(38, '/', '127.0.0.1', '2026-03-15 20:22:19'),
(39, '/', '127.0.0.1', '2026-03-15 20:23:13'),
(40, '/contact', '127.0.0.1', '2026-03-15 20:23:21'),
(41, '/about', '127.0.0.1', '2026-03-15 20:23:38'),
(42, '/about', '127.0.0.1', '2026-03-15 20:27:29'),
(43, '/contact', '127.0.0.1', '2026-03-15 20:27:37'),
(44, '/', '127.0.0.1', '2026-03-15 20:27:50'),
(45, '/', '127.0.0.1', '2026-03-15 20:30:04'),
(46, '/', '127.0.0.1', '2026-03-15 20:30:24'),
(47, '/contact', '127.0.0.1', '2026-03-15 20:30:29'),
(48, '/', '127.0.0.1', '2026-03-15 20:31:35'),
(49, '/', '127.0.0.1', '2026-03-15 20:32:03'),
(50, '/', '127.0.0.1', '2026-03-15 20:34:57'),
(51, '/contact', '127.0.0.1', '2026-03-15 20:34:59'),
(52, '/contact', '127.0.0.1', '2026-03-15 20:35:25'),
(53, '/', '127.0.0.1', '2026-03-15 20:35:30'),
(54, '/', '127.0.0.1', '2026-03-15 20:36:19'),
(55, '/', '127.0.0.1', '2026-03-15 20:39:04'),
(56, '/contact', '127.0.0.1', '2026-03-15 20:39:07'),
(57, '/contact', '127.0.0.1', '2026-03-15 20:39:57'),
(58, '/', '127.0.0.1', '2026-03-15 20:39:59'),
(59, '/contact', '127.0.0.1', '2026-03-15 20:41:09'),
(60, '/', '127.0.0.1', '2026-03-15 20:41:15'),
(61, '/contact', '127.0.0.1', '2026-03-15 20:41:33'),
(62, '/contact', '127.0.0.1', '2026-03-15 20:43:15'),
(63, '/contact', '127.0.0.1', '2026-03-15 20:43:24'),
(64, '/contact', '127.0.0.1', '2026-03-15 20:43:50'),
(65, '/', '127.0.0.1', '2026-03-15 20:48:18'),
(66, '/contact', '127.0.0.1', '2026-03-15 20:48:27'),
(67, '/', '127.0.0.1', '2026-03-15 20:48:31'),
(68, '/', '127.0.0.1', '2026-03-15 20:49:50'),
(69, '/', '127.0.0.1', '2026-03-15 20:50:00'),
(70, '/', '127.0.0.1', '2026-03-15 20:53:00'),
(71, '/', '127.0.0.1', '2026-03-15 20:55:22'),
(72, '/about', '127.0.0.1', '2026-03-15 20:55:26'),
(73, '/about', '127.0.0.1', '2026-03-15 20:59:07'),
(74, '/about', '127.0.0.1', '2026-03-15 21:02:17'),
(75, '/about', '127.0.0.1', '2026-03-15 21:08:25'),
(76, '/about', '127.0.0.1', '2026-03-15 21:16:32'),
(77, '/about', '127.0.0.1', '2026-03-15 21:17:34'),
(78, '/about', '127.0.0.1', '2026-03-15 21:17:39'),
(79, '/about', '127.0.0.1', '2026-03-15 21:17:43'),
(80, '/about', '127.0.0.1', '2026-03-15 21:17:49'),
(81, '/about', '127.0.0.1', '2026-03-15 21:17:54'),
(82, '/about', '127.0.0.1', '2026-03-15 21:18:00'),
(83, '/about', '127.0.0.1', '2026-03-15 21:18:05'),
(84, '/about', '127.0.0.1', '2026-03-15 21:18:09'),
(85, '/about', '127.0.0.1', '2026-03-15 21:18:14'),
(86, '/about', '127.0.0.1', '2026-03-15 21:21:48'),
(87, '/', '127.0.0.1', '2026-03-15 21:23:16'),
(88, '/about', '127.0.0.1', '2026-03-15 21:24:46'),
(89, '/projects', '127.0.0.1', '2026-03-15 21:25:12'),
(90, '/about', '127.0.0.1', '2026-03-15 21:27:04'),
(91, '/', '127.0.0.1', '2026-03-15 21:33:01'),
(92, '/about', '127.0.0.1', '2026-03-15 21:33:32'),
(93, '/about', '127.0.0.1', '2026-03-15 21:36:44'),
(94, '/', '127.0.0.1', '2026-03-15 21:44:01'),
(95, '/', '127.0.0.1', '2026-03-15 21:50:11'),
(96, '/', '127.0.0.1', '2026-03-15 21:50:35'),
(97, '/', '127.0.0.1', '2026-03-15 21:51:56'),
(98, '/', '127.0.0.1', '2026-03-15 21:54:15'),
(99, '/', '127.0.0.1', '2026-03-15 21:55:45'),
(100, '/', '127.0.0.1', '2026-03-15 22:00:22'),
(101, '/', '127.0.0.1', '2026-03-15 22:03:12'),
(102, '/', '127.0.0.1', '2026-03-15 22:06:19'),
(103, '/', '127.0.0.1', '2026-03-15 22:07:21'),
(104, '/', '127.0.0.1', '2026-03-15 22:08:26'),
(105, '/', '127.0.0.1', '2026-03-15 22:09:26'),
(106, '/', '127.0.0.1', '2026-03-15 22:10:02'),
(107, '/contact', '127.0.0.1', '2026-03-15 22:11:38'),
(108, '/contact', '127.0.0.1', '2026-03-15 22:13:08'),
(109, '/contact', '127.0.0.1', '2026-03-15 22:13:12'),
(110, '/contact', '127.0.0.1', '2026-03-15 22:13:51'),
(111, '/contact', '127.0.0.1', '2026-03-15 22:16:27'),
(112, '/contact', '127.0.0.1', '2026-03-15 22:17:07'),
(113, '/contact', '127.0.0.1', '2026-03-15 22:20:03'),
(114, '/contact', '127.0.0.1', '2026-03-15 22:20:30'),
(115, '/contact', '127.0.0.1', '2026-03-15 22:21:35'),
(116, '/about', '127.0.0.1', '2026-03-15 22:24:09'),
(117, '/', '127.0.0.1', '2026-03-15 22:24:35'),
(118, '/about', '127.0.0.1', '2026-03-15 22:24:46'),
(119, '/projects', '127.0.0.1', '2026-03-15 22:24:51'),
(120, '/', '127.0.0.1', '2026-03-15 22:27:02'),
(121, '/about', '127.0.0.1', '2026-03-15 22:35:36'),
(122, '/', '127.0.0.1', '2026-03-15 22:36:14'),
(123, '/about', '127.0.0.1', '2026-03-15 22:37:00'),
(124, '/contact', '127.0.0.1', '2026-03-15 22:37:12'),
(125, '/projects', '127.0.0.1', '2026-03-15 22:37:48'),
(126, '/projects', '127.0.0.1', '2026-03-15 22:38:54'),
(127, '/projects', '127.0.0.1', '2026-03-15 22:39:23'),
(128, '/projects', '127.0.0.1', '2026-03-15 22:39:26'),
(129, '/projects', '127.0.0.1', '2026-03-15 22:39:33'),
(130, '/projects', '127.0.0.1', '2026-03-15 22:39:45'),
(131, '/projects', '127.0.0.1', '2026-03-15 22:39:54'),
(132, '/', '127.0.0.1', '2026-03-15 22:40:02'),
(133, '/projects', '127.0.0.1', '2026-03-15 22:40:06'),
(134, '/projects', '127.0.0.1', '2026-03-15 22:40:10'),
(135, '/projects', '127.0.0.1', '2026-03-15 22:40:13'),
(136, '/projects', '127.0.0.1', '2026-03-15 22:40:31'),
(137, '/projects', '127.0.0.1', '2026-03-15 22:43:11'),
(138, '/projects', '127.0.0.1', '2026-03-15 22:44:49'),
(139, '/projects', '127.0.0.1', '2026-03-15 22:45:54'),
(140, '/', '127.0.0.1', '2026-03-16 07:37:05'),
(141, '/', '127.0.0.1', '2026-03-16 07:37:14'),
(142, '/', '127.0.0.1', '2026-03-16 07:42:18'),
(143, '/about', '127.0.0.1', '2026-03-16 07:42:25'),
(144, '/contact', '127.0.0.1', '2026-03-16 07:42:36'),
(145, '/', '127.0.0.1', '2026-03-16 08:01:35'),
(146, '/', '127.0.0.1', '2026-03-17 03:51:34'),
(147, '/about', '127.0.0.1', '2026-03-17 03:52:02'),
(148, '/', '127.0.0.1', '2026-03-17 03:52:11'),
(149, '/projects', '127.0.0.1', '2026-03-17 03:52:28'),
(150, '/contact', '127.0.0.1', '2026-03-17 03:52:40'),
(151, '/contact', '127.0.0.1', '2026-03-17 03:53:01'),
(152, '/', '127.0.0.1', '2026-03-17 03:55:23'),
(153, '/', '127.0.0.1', '2026-03-17 03:55:27'),
(154, '/', '127.0.0.1', '2026-03-17 03:56:23'),
(155, '/about', '127.0.0.1', '2026-03-17 03:57:39'),
(156, '/', '127.0.0.1', '2026-03-17 03:57:59'),
(157, '/', '127.0.0.1', '2026-03-17 16:26:41'),
(158, '/', '127.0.0.1', '2026-03-17 16:27:27'),
(159, '/', '127.0.0.1', '2026-03-17 16:32:39'),
(160, '/', '127.0.0.1', '2026-03-17 16:33:56'),
(161, '/', '127.0.0.1', '2026-03-17 16:34:01'),
(162, '/', '127.0.0.1', '2026-03-17 16:35:45'),
(163, '/', '127.0.0.1', '2026-03-17 16:36:09'),
(164, '/', '127.0.0.1', '2026-03-17 16:36:17'),
(165, '/', '127.0.0.1', '2026-03-17 16:36:21'),
(166, '/projects', '127.0.0.1', '2026-03-17 16:36:26'),
(167, '/', '127.0.0.1', '2026-03-17 16:36:27'),
(168, '/about', '127.0.0.1', '2026-03-17 16:36:33'),
(169, '/', '127.0.0.1', '2026-03-17 16:36:40'),
(170, '/', '127.0.0.1', '2026-03-17 16:37:09'),
(171, '/', '127.0.0.1', '2026-03-17 16:40:25'),
(172, '/', '127.0.0.1', '2026-03-17 16:45:08'),
(173, '/', '127.0.0.1', '2026-03-17 16:46:34'),
(174, '/about', '127.0.0.1', '2026-03-17 16:54:10'),
(175, '/', '127.0.0.1', '2026-03-17 17:07:44'),
(176, '/projects', '127.0.0.1', '2026-03-17 17:21:33'),
(177, '/about', '127.0.0.1', '2026-03-17 17:28:06'),
(178, '/projects', '127.0.0.1', '2026-03-17 17:28:31'),
(179, '/', '127.0.0.1', '2026-03-17 17:28:38'),
(180, '/', '127.0.0.1', '2026-03-17 17:35:18'),
(181, '/', '127.0.0.1', '2026-03-17 17:38:52'),
(182, '/', '127.0.0.1', '2026-03-17 17:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `tagline` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `availability` varchar(80) NOT NULL DEFAULT 'Available for work',
  `avatar_path` varchar(255) DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `hire_me_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `full_name`, `title`, `tagline`, `bio`, `availability`, `avatar_path`, `resume_path`, `email`, `phone`, `location`, `hire_me_url`, `created_at`, `updated_at`) VALUES
(1, 'Carl Jay', 'Full Stack Developer / UI Designer', 'Building scalable web applications from front-end to back-end.', 'To work in your company with values of continuous learning, innovation, and a collaborative IT environment. I aim to apply the best of my technical knowledge and skills in software development, UI/UX design, and system creation. I am keen to details, prioritize accuracy, and deliver quality work. Dedicated, hardworking, and very willing to learn, I strive to grow professionally while contributing to the success of the organization.', 'Available for work', 'images/profiles/profile_avatar.png', NULL, 'carljaycocamas26@gmail.com', '09700914375', 'Prk 36. Blk 1 Sea Breeze, Ilang, Davao City, Davao Del Sur, Philippines', NULL, '2026-03-15 10:28:11', '2026-03-17 09:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `short_desc` varchar(300) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `demo_url` varchar(500) DEFAULT NULL,
  `repo_url` varchar(500) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `completed_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `category`, `short_desc`, `description`, `thumbnail_path`, `demo_url`, `repo_url`, `is_featured`, `is_visible`, `sort_order`, `completed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Think\'C', 'thinkc', 'Game Application', '2D Gamified Learning Application for Elementary Students from Grade 4–6.', 'Think\'C is an interactive 2D gamified learning application designed to make mathematics and science engaging for elementary students (Grades 4–6). It features mini-games, progress tracking, and a teacher dashboard. Built with Unity and a Laravel REST API backend.', 'storage/projects/DrJa35POv1axaBvLQxHbUbqWPD57P3s4b4AajFlV.jpg', NULL, NULL, 1, 1, 1, '2025-11-15', '2026-03-15 10:28:11', '2026-03-17 09:23:01', NULL),
(2, 'ManPro', 'manpro', 'Web Application', 'An AI-driven HR Management System that promotes human-centered decision-making for better manpower management', 'ManPro’s HR management system helps businesses centralize employee data, streamline HR processes, and ensure compliance while reducing risk through paperless operations.', 'storage/projects/dmeWWx8lEKXwSH3uFgG7KSEzG97S82W6X6t6QZXC.jpg', 'https://manpro.ph/', NULL, 1, 1, 2, '2024-12-01', '2026-03-15 10:28:11', '2026-03-17 09:20:36', NULL),
(3, 'Portfolio Website', 'portfolio-website', 'Web Application', 'Personal portfolio website showcasing projects, skills, and professional experience.', 'A fully responsive, dark-mode supported personal portfolio built with Laravel and Tailwind CSS. Features an admin panel for dynamic content management, project showcasing, and a contact form.', 'images/projects/portfolio-thumbnail.png', NULL, NULL, 0, 1, 3, '2025-03-01', '2026-03-15 10:28:11', '2026-03-15 10:28:11', NULL),
(4, 'Car Rental System', 'car-rental-system-CQ2sL', 'Web Application', NULL, 'Car rental and payment system\r\nwith database integration and admin\r\nrecords.', NULL, NULL, NULL, 0, 1, 0, '2025-02-10', '2026-03-17 09:15:23', '2026-03-17 09:15:55', NULL),
(5, 'Hotel Booking System', 'hotel-booking-system-AHIkC', 'Web Application', NULL, 'Web-based hotel\r\nreservation system with room selection,\r\nbooking forms, and database\r\nconnectivity.', NULL, NULL, NULL, 0, 1, 0, '2024-07-21', '2026-03-17 09:17:35', '2026-03-17 09:17:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `caption` varchar(200) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_skills`
--

CREATE TABLE `project_skills` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_skills`
--

INSERT INTO `project_skills` (`project_id`, `skill_id`) VALUES
(1, 1),
(1, 7),
(1, 8),
(1, 12),
(1, 16),
(2, 5),
(2, 7),
(2, 8),
(2, 12),
(2, 16),
(3, 5),
(3, 7),
(3, 8),
(3, 12),
(3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vSCYW5qYtW5rApWISjOF4oE1a1K5HLTKMXOpBmNi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYzE3VTdMQ01EblN6YjBTZlZYQ1BkUENBT2ZXcHNCM1pZWmhmSnp4UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1773769175);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skill_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `proficiency` tinyint(3) UNSIGNED NOT NULL DEFAULT 80,
  `icon_url` varchar(255) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `proficiency`, `icon_url`, `sort_order`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 1, 'HTML5 / CSS3', 95, NULL, 1, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(5, 1, 'Tailwind CSS', 90, NULL, 5, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(6, 1, 'Bootstrap', 88, NULL, 6, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(7, 2, 'PHP', 95, NULL, 1, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(8, 2, 'Laravel', 92, NULL, 2, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(12, 3, 'MySQL', 90, NULL, 1, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(13, 3, 'SQLite', 80, NULL, 2, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(16, 4, 'Git / GitHub', 92, NULL, 1, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(19, 4, 'Vite', 85, NULL, 4, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(20, 4, 'Figma', 75, NULL, 5, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(25, 5, 'Flutter', 90, NULL, 1, 1, '2026-03-17 09:06:40', '2026-03-17 09:06:40'),
(26, 2, 'Dart', 80, NULL, 3, 1, '2026-03-17 09:09:50', '2026-03-17 09:09:50'),
(27, 2, 'Node.js', 60, NULL, 4, 1, '2026-03-17 09:10:56', '2026-03-17 09:10:56'),
(28, 5, 'Unity 3D', 70, NULL, 2, 1, '2026-03-17 09:25:50', '2026-03-17 09:25:50'),
(29, 1, 'C#', 90, NULL, 7, 1, '2026-03-17 09:26:48', '2026-03-17 09:26:48'),
(30, 2, 'C++', 50, NULL, 5, 1, '2026-03-17 09:27:30', '2026-03-17 09:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `skill_categories`
--

CREATE TABLE `skill_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill_categories`
--

INSERT INTO `skill_categories` (`id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Frontend', 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(2, 'Backend', 2, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(3, 'Database', 3, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(4, 'DevOps & Tools', 4, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(5, 'Mobile', 5, '2026-03-15 10:28:11', '2026-03-15 10:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(80) NOT NULL,
  `url` varchar(500) NOT NULL,
  `icon` varchar(80) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `sort_order`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 'Email', 'https://mail.google.com/mail/u/0/#inbox?compose=DmwnWtMjJBVXDcMgbGGBGVRMbfjCxJNNRqvqTcwkXqqldcnvtNTgjHlXlhgwrGjjdrjNcWWVsHMv', 'alternate_email', 1, 1, '2026-03-15 10:28:11', '2026-03-15 14:19:53'),
(2, 'LinkedIn', 'https://linkedin.com/in/carljaycocamas', 'groups', 2, 1, '2026-03-15 10:28:11', '2026-03-15 10:28:11'),
(3, 'GitHub', 'https://github.com/carljay26', 'code', 3, 1, '2026-03-15 10:28:11', '2026-03-17 09:08:35'),
(4, 'Facebook', 'https://www.facebook.com/carljay.cocamas26', 'share', 5, 1, '2026-03-15 12:25:49', '2026-03-15 12:25:49'),
(5, 'Discord', 'https://discord.gg/Xj9YApWm', 'chat_bubble', 4, 1, '2026-03-17 09:08:36', '2026-03-17 09:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(80) NOT NULL,
  `value` varchar(80) NOT NULL,
  `icon` varchar(80) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `label`, `value`, `icon`, `sort_order`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 'Experience', 'OJT - ManPro', 'schedule', 1, 1, '2026-03-15 10:28:11', '2026-03-17 09:11:48'),
(2, 'Projects', '5', 'rocket_launch', 2, 1, '2026-03-15 10:28:11', '2026-03-17 09:36:59'),
(3, 'Clients', '0', 'groups', 3, 1, '2026-03-15 10:28:11', '2026-03-15 12:36:11'),
(4, 'Satisfaction', '50%', 'thumb_up', 4, 1, '2026-03-15 10:28:11', '2026-03-17 09:08:35');

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
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_views_viewed_at_index` (`viewed_at`),
  ADD KEY `page_views_page_index` (`page`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_images_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_skills`
--
ALTER TABLE `project_skills`
  ADD PRIMARY KEY (`project_id`,`skill_id`),
  ADD KEY `project_skills_skill_id_foreign` (`skill_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_skill_category_id_foreign` (`skill_category_id`);

--
-- Indexes for table `skill_categories`
--
ALTER TABLE `skill_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `skill_categories`
--
ALTER TABLE `skill_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_skills`
--
ALTER TABLE `project_skills`
  ADD CONSTRAINT `project_skills_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_skills_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_skill_category_id_foreign` FOREIGN KEY (`skill_category_id`) REFERENCES `skill_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
