-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2021 at 12:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bloglaravel8-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TopMenu', '2021-02-06 03:04:49', '2021-02-06 03:04:49'),
(2, 'SideMenu', '2021-02-06 03:04:49', '2021-02-06 03:04:49'),
(3, 'FooterMenu', '2021-02-06 03:04:49', '2021-02-06 03:04:49'),
(4, 'LinkMenu', '2021-02-06 03:04:49', '2021-02-06 03:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` bigint(20) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu_items`
--

INSERT INTO `admin_menu_items` (`id`, `label`, `link`, `parent`, `sort`, `class`, `menu`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 0, 0, NULL, 1, 0, '2021-02-06 03:04:49', '2021-02-06 03:04:49'),
(2, 'Artikel', '/post/postall', 0, 0, NULL, 1, 0, '2021-02-06 03:04:49', '2021-02-06 03:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorydownloads`
--

CREATE TABLE `categorydownloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorypages`
--

CREATE TABLE `categorypages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorypages`
--

INSERT INTO `categorypages` (`id`, `title`, `slug`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Abouts', 'abouts', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categoryposts`
--

CREATE TABLE `categoryposts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoryposts`
--

INSERT INTO `categoryposts` (`id`, `author_id`, `title`, `slug`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Uncategory', 'uncategory', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(2, 1, 'HTML', 'html', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(3, 1, 'CSS', 'css', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(4, 1, 'Bootstrap', 'bootstrap', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(5, 1, 'Laravel', 'laravel', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `downloadfiles`
--

CREATE TABLE `downloadfiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `categorydownload_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkfile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embedfile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_cities`
--

CREATE TABLE `indonesia_cities` (
  `id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_districts`
--

CREATE TABLE `indonesia_districts` (
  `id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_provinces`
--

CREATE TABLE `indonesia_provinces` (
  `id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_villages`
--

CREATE TABLE `indonesia_villages` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2016_08_03_072729_create_provinces_table', 1),
(5, '2016_08_03_072750_create_cities_table', 1),
(6, '2016_08_03_072804_create_districts_table', 1),
(7, '2016_08_03_072819_create_villages_table', 1),
(8, '2017_08_11_073824_create_menus_wp_table', 1),
(9, '2017_08_11_074006_create_menu_items_wp_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2020_05_21_100000_create_teams_table', 1),
(13, '2020_05_21_200000_create_team_user_table', 1),
(14, '2020_12_21_051558_create_sessions_table', 1),
(15, '2020_12_21_060123_create_permission_tables', 1),
(16, '2020_12_31_144719_create_settings_table', 1),
(17, '2021_01_15_072334_create_trix_rich_texts_table', 1),
(18, '2021_01_18_144626_create_categoryposts_table', 1),
(19, '2021_01_18_145410_create_subcategoryposts_table', 1),
(20, '2021_01_18_145453_create_tags_table', 1),
(21, '2021_01_18_145511_create_setarticles_table', 1),
(22, '2021_01_18_145531_create_posts_table', 1),
(23, '2021_01_18_145555_create_categorypages_table', 1),
(24, '2021_01_18_145609_create_pages_table', 1),
(25, '2021_01_18_145630_create_socials_table', 1),
(26, '2021_01_22_223243_alter_users_add_column', 1),
(27, '2021_01_23_053000_create_albums_table', 1),
(28, '2021_01_23_053042_create_photos_table', 1),
(29, '2021_01_23_053104_create_sliders_table', 1),
(30, '2021_01_23_234043_create_advertisements_table', 1),
(31, '2021_01_25_002724_create_widgets_table', 1),
(32, '2021_01_25_055202_create_categorydownloads_table', 1),
(33, '2021_01_25_062710_create_downloadfiles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorypage_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'settings.index', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(2, 'settings.create', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(3, 'settings.edit', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(4, 'settings.delete', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(5, 'menus.index', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(6, 'menus.create', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(7, 'menus.edit', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(8, 'menus.delete', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(9, 'socialmedia.index', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(10, 'socialmedia.create', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(11, 'socialmedia.edit', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(12, 'socialmedia.delete', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(13, 'institutions.index', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(14, 'institutions.create', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(15, 'institutions.edit', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(16, 'institutions.delete', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(17, 'schoollevels.index', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(18, 'schoollevels.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(19, 'schoollevels.edit', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(20, 'schoollevels.delete', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(21, 'schools.index', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(22, 'schools.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(23, 'schools.edit', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(24, 'schools.delete', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(25, 'teachers.index', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(26, 'teachers.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(27, 'teachers.edit', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(28, 'teachers.delete', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(29, 'students.index', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(30, 'students.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(31, 'students.edit', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(32, 'students.delete', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(33, 'academicyears.index', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(34, 'academicyears.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(35, 'academicyears.edit', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(36, 'academicyears.delete', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(37, 'curiculums.index', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(38, 'curiculums.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(39, 'curiculums.edit', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(40, 'curiculums.delete', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(41, 'departments.index', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(42, 'departments.create', 'web', '2021-02-06 03:04:42', '2021-02-06 03:04:42'),
(43, 'departments.edit', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(44, 'departments.delete', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(45, 'levelclasses.index', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(46, 'levelclasses.create', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(47, 'levelclasses.edit', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(48, 'levelclasses.delete', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(49, 'studygroups.index', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(50, 'studygroups.create', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(51, 'studygroups.edit', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(52, 'studygroups.delete', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(53, 'courses.index', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(54, 'courses.create', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(55, 'courses.edit', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(56, 'courses.delete', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(57, 'coursstudygroups.index', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(58, 'coursstudygroups.create', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(59, 'coursstudygroups.edit', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(60, 'coursstudygroups.delete', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(61, 'chapters.index', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(62, 'chapters.create', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(63, 'chapters.edit', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(64, 'chapters.delete', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(65, 'screenshoots.index', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(66, 'screenshoots.create', 'web', '2021-02-06 03:04:43', '2021-02-06 03:04:43'),
(67, 'screenshoots.edit', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(68, 'screenshoots.delete', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(69, 'tools.index', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(70, 'tools.create', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(71, 'tools.edit', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(72, 'tools.delete', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(73, 'lessons.index', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(74, 'lessons.create', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(75, 'lessons.edit', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(76, 'lessons.delete', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(77, 'schedules.index', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(78, 'schedules.create', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(79, 'schedules.edit', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(80, 'schedules.delete', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(81, 'exams.index', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(82, 'exams.create', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(83, 'exams.edit', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(84, 'exams.delete', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(85, 'questions.index', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(86, 'questions.create', 'web', '2021-02-06 03:04:44', '2021-02-06 03:04:44'),
(87, 'questions.edit', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(88, 'questions.delete', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(89, 'scores.index', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(90, 'scores.create', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(91, 'scores.edit', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(92, 'scores.delete', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(93, 'categoryposts.index', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(94, 'categoryposts.create', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(95, 'categoryposts.edit', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(96, 'categoryposts.delete', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(97, 'setarticles.index', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(98, 'setarticles.create', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(99, 'setarticles.edit', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(100, 'setarticles.delete', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(101, 'categorypages.index', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(102, 'categorypages.create', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(103, 'categorypages.edit', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(104, 'categorypages.delete', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(105, 'tags.index', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(106, 'tags.create', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(107, 'tags.edit', 'web', '2021-02-06 03:04:45', '2021-02-06 03:04:45'),
(108, 'tags.delete', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(109, 'posts.index', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(110, 'posts.create', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(111, 'posts.edit', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(112, 'posts.delete', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(113, 'pages.index', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(114, 'pages.create', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(115, 'pages.edit', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(116, 'pages.delete', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(117, 'albums.index', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(118, 'albums.create', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(119, 'albums.edit', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(120, 'albums.delete', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(121, 'photos.index', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(122, 'photos.create', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(123, 'photos.edit', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(124, 'photos.delete', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(125, 'sliders.index', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(126, 'sliders.create', 'web', '2021-02-06 03:04:46', '2021-02-06 03:04:46'),
(127, 'sliders.edit', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(128, 'sliders.delete', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(129, 'roles.index', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(130, 'roles.create', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(131, 'roles.edit', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(132, 'roles.delete', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(133, 'permissions.index', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(134, 'permissions.create', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(135, 'permissions.edit', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(136, 'permissions.delete', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(137, 'users.index', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(138, 'users.create', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(139, 'users.edit', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(140, 'users.delete', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(141, 'advertisements.index', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(142, 'advertisements.create', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(143, 'advertisements.edit', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(144, 'advertisements.delete', 'web', '2021-02-06 03:04:47', '2021-02-06 03:04:47'),
(145, 'categorydownloads.index', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(146, 'categorydownloads.create', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(147, 'categorydownloads.edit', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(148, 'categorydownloads.delete', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(149, 'widgets.index', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(150, 'widgets.create', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(151, 'widgets.edit', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(152, 'widgets.delete', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(153, 'downloadfiles.index', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(154, 'downloadfiles.create', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(155, 'downloadfiles.edit', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(156, 'downloadfiles.delete', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(157, 'links.index', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(158, 'links.create', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(159, 'links.edit', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48'),
(160, 'links.delete', 'web', '2021-02-06 03:04:48', '2021-02-06 03:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headline` tinyint(1) NOT NULL DEFAULT 1,
  `selection` tinyint(1) NOT NULL DEFAULT 0,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorypost_id` bigint(20) UNSIGNED NOT NULL,
  `subcategorypost_id` bigint(20) UNSIGNED DEFAULT NULL,
  `setarticle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `comment_status` tinyint(1) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `title`, `slug`, `headline`, `selection`, `video`, `caption_video`, `categorypost_id`, `subcategorypost_id`, `setarticle_id`, `content`, `excerpt`, `image`, `caption_image`, `status`, `comment_status`, `view_count`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Quod magni voluptatem hic hic possimus veritatis quis aut quibusdam ipsam saepe qui recusandae.', 'est-qui-a-qui-magni-consectetur-doloribus-voluptates', 1, 0, NULL, NULL, 1, NULL, 1, 'Hic unde doloribus in exercitationem ut nihil eaque. Neque hic accusantium voluptatem in et a libero. Provident consequatur at id non magni quisquam magnam quaerat.\n\nNon nulla debitis et omnis vero numquam. Eum incidunt ducimus qui similique quasi est eveniet. Sed necessitatibus vel qui mollitia nulla et.\n\nAperiam numquam maxime alias natus ut rerum. Voluptas numquam quas reprehenderit vitae voluptatibus necessitatibus tempore. Tenetur dolorem omnis accusantium expedita.\n\nQuibusdam amet molestiae quidem non saepe quia. Quo voluptates aperiam provident illum. Pariatur est doloribus iste sint praesentium officia asperiores. Qui eveniet assumenda aut dolorum error assumenda consequatur.\n\nQuo fugit non sequi quo. Vel a totam praesentium qui placeat ducimus et. Asperiores consequuntur impedit ut provident. Incidunt aut sit libero voluptate ad excepturi beatae.\n\nUt sed quo minus voluptas et delectus reiciendis. Sit facere et magni aut veritatis amet architecto. Doloremque deserunt sint ut ut vel. Magnam provident eveniet distinctio. Et atque accusantium corporis maxime.\n\nQuis aut omnis nemo assumenda. Quia sapiente consequatur et animi fuga in. Ad nihil minus quod nostrum adipisci aspernatur quos reiciendis. Rerum qui pariatur molestiae quod unde.\n\nLabore voluptatibus itaque adipisci et qui quaerat unde. Dolorem repellat rerum dolorem veniam rerum. Minus ipsa nemo saepe eligendi iure qui vitae.\n\nQuia nihil consequatur laudantium omnis et. Id quo quo qui nobis eaque. Et quo incidunt sed molestiae eveniet aut qui. Necessitatibus accusantium nobis mollitia dolorem esse id eveniet.\n\nVoluptas ipsum qui est dolor temporibus. Qui dolor aut molestiae voluptatem corrupti ducimus debitis mollitia. Voluptatem ipsum ipsa doloribus.\n\nFacilis rerum quia qui. Et ea ut quas rerum. Voluptas maxime dolorem sed ut. Est numquam molestiae eaque est hic ad corporis est.\n\nEt et quisquam veniam dolores minima ducimus. Est minima omnis soluta et quia ipsa voluptas. Quo et sint nihil nihil quae dolor. Qui provident molestiae omnis et alias nisi quam.\n\nEveniet et porro blanditiis itaque inventore. Voluptatem eum voluptatibus laudantium sapiente accusamus consequatur. Voluptatem laborum quia vel et et.\n\nLibero nemo et id nesciunt saepe rerum. A rerum inventore dolores inventore eligendi. Et quas tempore voluptas saepe voluptatum doloribus id officiis. Maiores nostrum nesciunt recusandae pariatur.\n\nImpedit id et tempora. Porro et consequatur voluptates dolor veritatis error deserunt. Numquam id qui ullam quod qui magnam distinctio. Harum eligendi qui expedita.', 'Amet architecto fuga est dolor. Distinctio enim ratione velit qui in. Et autem qui deleniti rerum occaecati itaque magni ex.', NULL, NULL, 1, NULL, 90, NULL, NULL, '2020-02-16 03:04:49', '2020-02-16 03:04:49', NULL),
(2, 1, 'Quia sit eos quod aspernatur fuga ab rerum voluptates consequatur suscipit eos libero.', 'nobis-et-qui-facilis-quo-sunt-mollitia-aut', 1, 0, NULL, NULL, 3, NULL, 3, 'Dolor iusto consequatur eos eveniet qui nam consequuntur. Deserunt molestias aut nesciunt eveniet repudiandae cumque. Eveniet dolore nostrum sint quo a et quia. Deleniti quia autem nam fugit quod expedita.\n\nAut dolorem omnis mollitia repudiandae atque debitis. Dolorem aut fugiat sint unde ad. Natus dolorem distinctio itaque praesentium reprehenderit.\n\nTempora asperiores harum praesentium sit quaerat cum nisi rerum. Ea reiciendis cum assumenda dolorem quia tempore id. Voluptas unde quia atque dicta et.\n\nTemporibus ducimus id inventore dolorem cumque. Sit beatae sit porro voluptatibus quia. Consequatur ad est minima ea. Quidem porro esse voluptatum aliquid reiciendis.\n\nAdipisci eos quo soluta et modi. Omnis incidunt eveniet sed maiores id iusto illum. Voluptas amet nemo velit voluptatem.\n\nPerferendis distinctio maiores ut qui et. Saepe voluptas aut quasi ipsum illum ut dolorem. Esse praesentium dolorem nam fugiat excepturi deserunt. Sed ea et eligendi ipsum et qui.\n\nProvident nihil voluptatem est at commodi. Id qui voluptates ipsum aliquid. Aut sit ut aut dolores.\n\nDolor illum quis veniam temporibus. Ut quam commodi sed iure odio. Deleniti accusantium optio praesentium ipsum at provident.\n\nNobis dolores fugit dolorum. Non officia autem consequuntur totam error at placeat. Quo aliquid unde dignissimos corrupti consequatur voluptas vero.\n\nItaque non unde earum aut enim non inventore ut. Qui rerum tempore ducimus aut ut facere.\n\nEt expedita laboriosam unde. Recusandae sint deleniti dignissimos. Nihil nostrum itaque rem exercitationem. Culpa dolorum voluptatem magnam eligendi.\n\nConsequatur et et amet dolorem est. Laudantium itaque dolor corrupti et sit mollitia. Aliquam et dolores quis non deserunt id recusandae. Reiciendis voluptas assumenda ut eligendi consequatur est et.\n\nAliquam sit mollitia ad vitae. Dolor facilis iste placeat vitae harum odio. Qui reprehenderit earum commodi corrupti aperiam deleniti.\n\nDolorum distinctio sint sit tempora fugit sint. Recusandae est et praesentium omnis. Autem unde officia debitis aperiam veniam iste.\n\nIure error qui debitis assumenda. Qui laboriosam aut repudiandae qui dolores qui rerum. Molestiae totam ut voluptate a magni. Ea aliquid adipisci doloribus qui cum. Optio quidem qui minima vel nostrum incidunt consequatur.', 'Doloribus in qui vitae fugiat assumenda quis qui. Placeat fugit numquam non. Facilis sed nobis nesciunt quos.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-02-26 03:04:49', '2020-02-26 03:04:49', NULL),
(3, 1, 'Maiores maxime culpa tempora consequuntur reiciendis placeat omnis eos perspiciatis.', 'asperiores-odit-reiciendis-sunt-atque-quaerat-consectetur-repellat', 1, 0, NULL, NULL, 1, NULL, 2, 'Molestiae rerum velit debitis ratione. Voluptas non aspernatur neque cupiditate sit velit. Consequatur voluptates atque accusantium et est debitis iusto blanditiis. Autem rerum rerum ut nesciunt.\n\nQuos ut rem nobis qui in qui. Aperiam praesentium sint commodi sunt ad aut nobis. Ducimus sed consectetur voluptas facere.\n\nNon ea hic deleniti necessitatibus ut maxime. Repellat aut quidem ea quia et maiores accusantium ut. Quod reiciendis corporis nihil doloremque nihil officia.\n\nDucimus porro placeat ut cupiditate modi. Cumque aut provident neque. Error voluptatibus quis repudiandae veritatis consequuntur blanditiis vel. Laborum totam omnis modi perspiciatis dolorem facere.\n\nNihil dignissimos esse esse incidunt rerum. Nobis dolores aliquid reprehenderit eos consequatur. Consectetur delectus officiis quasi odio fugit quasi tempora.\n\nPariatur molestias qui similique molestias numquam repudiandae. Eius est iusto ea non natus illum in. Distinctio rerum error et dicta est dolorem alias. Rerum voluptatibus suscipit ratione incidunt consequatur ut.\n\nNumquam voluptatem aspernatur nobis. Et veritatis est magni harum expedita in. Nam et corporis ex. Ad eos corporis iure voluptatibus earum.\n\nAut et iste nobis totam. Ullam aspernatur officia porro voluptatem a.\n\nCorrupti aut sed alias. Blanditiis voluptates veniam quia iure.\n\nExpedita provident velit cum aspernatur dolore aut doloremque minima. Reiciendis sit sed optio nesciunt incidunt. At nemo molestias totam nihil.\n\nNatus et doloribus id expedita. Amet repellat autem beatae numquam repudiandae est non.\n\nNemo voluptatum eum molestiae qui quibusdam minima molestiae. Laborum qui possimus illo qui distinctio quo. Sed rem quia quis aut molestias quia porro ut.\n\nVoluptas eligendi molestias tenetur aut aut omnis. Nemo id quae sit similique nemo commodi porro. Repellendus sed non labore est maiores ab laudantium. Amet et est commodi itaque laborum et.\n\nOptio quis illo ut aut et optio et. In voluptatum quo in saepe eligendi nemo. Ad mollitia accusamus rem et pariatur et fugiat. Explicabo qui adipisci qui error aut harum.', 'Minus sunt sapiente quia id quo officia. Sit ut autem dolor illo odit recusandae. At voluptatem quis minus ullam. Exercitationem quas quae aut rerum.', NULL, NULL, 1, NULL, 20, NULL, NULL, '2020-03-07 03:04:49', '2020-03-07 03:04:49', NULL),
(4, 1, 'Eum dolorum dolor aut eum laboriosam vero itaque unde eum nihil qui esse cumque reprehenderit.', 'eum-corporis-quos-eos-sequi-culpa-atque-alias', 1, 0, NULL, NULL, 2, NULL, 1, 'Nesciunt dicta dolore facere non. Sunt fugiat consectetur sint rem. Ullam aliquid quo a velit et qui soluta. Molestias occaecati sit dolor quasi eum dolorem odit.\n\nEos assumenda occaecati est libero magni. Rem et quae sint. Quis a qui explicabo ipsa molestias. Eum ipsum vel maxime illo qui. Nobis minima quia est fuga.\n\nCommodi quia quasi laudantium architecto facere necessitatibus. Ratione earum expedita quibusdam perspiciatis quo maxime. Fugiat officiis ut sit tempora error.\n\nPariatur dolor id aliquid aperiam harum amet. Occaecati iste enim labore ea dolorem ut et laboriosam. Qui animi accusantium sunt illo consectetur.\n\nEos soluta sint dolor labore qui provident odit. Qui est aliquid cumque maxime. Et perferendis id culpa necessitatibus placeat. Sit facilis esse non a et qui sit maxime.\n\nItaque sit fuga aut cumque praesentium facere ut. Eius voluptatibus at omnis cupiditate non.\n\nQuia laudantium aut suscipit temporibus qui. Animi possimus inventore esse quos sunt voluptatem. Tempora blanditiis libero exercitationem quam exercitationem.\n\nQuidem ducimus saepe ullam non. Voluptates rerum animi aliquam id ut fugit. Facilis sit aut eligendi magnam ut. Numquam ipsam consequatur soluta repellendus. Consectetur excepturi perferendis deserunt est facilis at qui.\n\nAut cumque molestias quia et dolor in. Qui labore repellendus impedit illum ea nihil quae ad. Nemo nesciunt quia odit et perferendis deserunt.\n\nPraesentium enim occaecati nesciunt ducimus veritatis cum pariatur quo. Nemo mollitia labore fugiat molestiae iusto debitis velit ut. Dolores iure sequi nam molestiae porro. Laboriosam quae omnis earum.\n\nSoluta et qui assumenda voluptatem molestias minima illum. Omnis numquam illo rerum omnis cum. Dolores quis aliquid expedita.\n\nUt atque expedita rerum iure. Totam illum eum voluptates amet repellat. Praesentium amet explicabo dolores voluptas sapiente accusantium aliquid provident.\n\nLaudantium unde dignissimos similique neque maxime consequatur sit. Temporibus omnis magnam mollitia ut voluptates. Cupiditate dolor ad deleniti odio. Totam voluptatem officiis molestiae eligendi corrupti nihil blanditiis. Molestiae ducimus veniam neque ut qui minus et.\n\nDolor enim dolore maiores officia facere aut. Quia voluptatem molestiae amet omnis.\n\nEt debitis saepe voluptas ducimus dignissimos aliquid et nam. Vel ut velit quibusdam at dolor quas. Id quis maxime qui architecto. Ea voluptate ut rerum magni est consequuntur neque vero.', 'Expedita culpa molestiae autem. Nobis incidunt vel sequi vitae fugiat accusamus. Molestiae voluptatem velit omnis possimus autem.', NULL, NULL, 1, NULL, 60, NULL, NULL, '2020-03-17 03:04:49', '2020-03-17 03:04:49', NULL),
(5, 1, 'Et recusandae et et perspiciatis quas laudantium et reiciendis minima quaerat consequatur.', 'voluptate-qui-harum-ducimus-perferendis', 1, 0, NULL, NULL, 4, NULL, 3, 'Et eveniet incidunt atque eos qui aut. Et veniam deleniti sint unde incidunt labore recusandae. Odio nihil sed eum veritatis eum totam accusamus. Maxime placeat molestias repudiandae non doloremque qui numquam.\n\nQuam atque rem praesentium quo earum. Numquam et distinctio iure mollitia odit quasi voluptatem. Et enim perspiciatis architecto dolorem explicabo aut. Sint ut vel numquam enim hic.\n\nAutem consequatur sit sit. Esse autem rerum error et consequatur alias cupiditate. Expedita ut pariatur unde repellat.\n\nAut cumque voluptates praesentium fugiat. Molestiae consectetur amet pariatur nulla minima. Dolorem nulla atque aut ipsam dolores. Exercitationem voluptatem dolores atque cupiditate perferendis hic aut.\n\nQui dolorem consectetur repellat sint nisi impedit. In quibusdam distinctio accusamus mollitia delectus rerum sit. Ut at velit quas voluptatem.\n\nEt sed commodi rerum reiciendis neque magnam. Nulla est hic sapiente atque aut. Quos ut quis laborum. Excepturi nihil optio rerum provident in.\n\nVoluptate et similique iure rerum iusto nesciunt quibusdam. Quam est aspernatur occaecati perferendis ut non. Velit sit quaerat nihil voluptate nulla. Consequatur eius qui minima accusamus eos ut.\n\nInventore sit mollitia officiis sit quia eaque animi. Possimus commodi excepturi quia dolores et. Rerum dicta laboriosam sit consequatur. Nemo accusantium recusandae voluptas nisi.\n\nLibero est numquam dolor ullam et deleniti est nam. Distinctio ut facere qui nemo praesentium. Blanditiis explicabo voluptates itaque perspiciatis ullam.\n\nUt corporis aut deserunt architecto quo veniam. Corrupti amet natus quis corrupti. Iusto dignissimos nihil facilis iste molestias aut.\n\nEarum atque vel maiores beatae rerum minus. Eveniet perspiciatis corporis sunt natus qui. Voluptates mollitia nemo vel temporibus consequatur non mollitia itaque. Numquam dolores dolores et deserunt repudiandae.\n\nQuia facilis ea itaque consequuntur accusantium mollitia doloribus. A tempora minima sit sit fuga. Neque culpa eum eum aliquam similique neque.\n\nLabore aut accusamus quis ea veniam quia explicabo ut. Maiores quas sint nihil non.\n\nExercitationem rerum aliquam nihil aliquid ea officia. Sit quibusdam aut qui ea reiciendis. Ut ut qui numquam sequi omnis aut.', 'Minus non consectetur maiores. Voluptatem suscipit dolorem est quia.', NULL, NULL, 1, NULL, 10, NULL, NULL, '2020-03-27 03:04:49', '2020-03-27 03:04:49', NULL),
(6, 1, 'Et ut qui est quo iste et.', 'nisi-sed-laboriosam-voluptas-tempore-magnam-ut', 1, 0, NULL, NULL, 3, NULL, 1, 'Maiores consequatur et ut perferendis est. Ut nam iusto temporibus minus consequuntur voluptatem. Nihil hic id natus culpa.\n\nDolore repudiandae doloribus earum aspernatur est omnis. Incidunt doloremque ut rem molestias nesciunt. Sequi dolor quasi et eaque cumque et magnam nihil. At quae totam vero cum eum cupiditate est.\n\nDolores quibusdam quia sed voluptas tempora ut sed. Eius eligendi officia assumenda quos voluptas. Debitis omnis omnis rerum eligendi totam.\n\nDolores velit deleniti enim eligendi. Eligendi qui dolorem rem quas magni. Inventore et ut qui beatae sed aut porro.\n\nBeatae illo omnis sapiente vel pariatur. Consequatur eaque quia saepe quo repudiandae est necessitatibus repellendus.\n\nAut minima qui quia. Eaque quae suscipit velit recusandae.\n\nAtque ratione aut at autem non eos. Voluptates officiis exercitationem molestias recusandae et quia. Dignissimos quos ipsam mollitia placeat ut. Et pariatur vitae at minima quis voluptate est.\n\nRepellendus sed rerum officia eum et enim. Nesciunt ea quod rerum atque neque reiciendis. Repellat pariatur architecto et alias excepturi eveniet. Tenetur dolore consequuntur rem dolor repellendus voluptate dolorem. Quibusdam atque aliquam nobis sunt nihil magnam dolor.\n\nQuia est alias qui ab unde. Non debitis autem sit rerum illo mollitia soluta. Sit sit sunt quia sit. Qui numquam cumque voluptatem soluta nisi et ipsum adipisci. Perferendis ea tempore porro totam impedit expedita ut.\n\nRepellat qui quaerat aperiam eos officia. Corporis enim commodi labore consequatur est incidunt. Minima magnam ad soluta est exercitationem et qui.\n\nExplicabo quo cupiditate autem dolor nostrum. Inventore inventore qui earum tempore autem quos et amet. Et saepe ipsam alias laboriosam. Cum iure enim est.\n\nOdio porro magni autem nobis corrupti alias. Aliquam qui reprehenderit consequuntur corrupti nulla esse ut. Iste rerum dicta animi qui officiis et fuga. Ut et natus quia quaerat saepe harum sint.', 'Accusamus velit cum fugit quo est aspernatur adipisci et. A neque ad aut exercitationem et. Nostrum occaecati reiciendis ut sapiente reiciendis dolore.', NULL, NULL, 1, NULL, 30, NULL, NULL, '2020-04-06 03:04:49', '2020-04-06 03:04:49', NULL),
(7, 1, 'Nobis harum praesentium et eaque ex modi et sit suscipit quia vero sapiente molestiae.', 'et-possimus-qui-quasi-dolorem', 1, 0, NULL, NULL, 3, NULL, 1, 'Officiis ea ut qui nisi labore odit velit dolore. Autem dicta porro deleniti at alias dicta natus. Quia atque occaecati voluptas pariatur saepe.\n\nDistinctio inventore ut molestias deserunt quia. Quae autem officia molestiae totam est consequatur est. Nisi fuga fugiat unde architecto quisquam.\n\nNumquam voluptatem itaque alias nihil voluptas ullam. Et qui molestiae laudantium suscipit quibusdam aperiam. Minus earum saepe amet dolor delectus. Repudiandae fugit aut et possimus dicta odio.\n\nConsequatur doloremque molestias omnis fugiat assumenda. Eum est enim quisquam omnis. Voluptatem ab nihil labore architecto. Rerum reiciendis quia qui sint expedita non doloremque. Assumenda dolorem omnis deserunt molestias nostrum assumenda iste.\n\nQui nihil est at dolorem numquam. Esse praesentium delectus esse esse tempora. Dolores sit nulla necessitatibus fuga nemo autem.\n\nUt quibusdam iure sunt ut consectetur dolorum itaque. Eos sequi maiores eum quia incidunt est. Exercitationem et eos quidem laboriosam. Quia eum repudiandae repellendus et tempora.\n\nIllo et veritatis quis officia. Aliquam fuga optio asperiores autem quibusdam fugiat.\n\nSed dolor voluptatibus neque dolor. Ipsa voluptatem quo labore et recusandae nobis cumque. Itaque perferendis in assumenda at. Vitae commodi aspernatur molestiae sed qui dicta.\n\nEum magnam et deleniti ea deleniti ipsum. Neque dolor id impedit voluptas harum iste qui. Aperiam eveniet ducimus at explicabo quia velit id. Tempore voluptas perferendis aut minima vero et soluta.\n\nExcepturi enim quibusdam dolorum et in. Eum quas sit eum et non incidunt. Ab error minima dicta non exercitationem. Magnam asperiores quaerat repellat laboriosam nostrum necessitatibus voluptatem.\n\nSequi veniam veniam aut natus delectus earum at quis. Pariatur autem id minima consequatur voluptatem possimus earum. Alias dicta eos beatae rerum cupiditate. Error voluptas iusto et molestias deleniti qui repellat ut.\n\nEt et laudantium vitae odio facere beatae. Dolorem magnam earum sint ut doloremque quas. Ipsa incidunt consectetur consequatur dolore consequatur. Magni quos explicabo sequi odio temporibus consequatur.', 'Molestiae iste reiciendis molestias nesciunt sequi incidunt dolores. Laudantium consectetur eveniet sed dolorem illum et. Qui ea assumenda exercitationem iste.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-04-16 03:04:49', '2020-04-16 03:04:49', NULL),
(8, 1, 'Est quia rem et repudiandae et consequatur repudiandae magnam et sequi quis reiciendis.', 'et-distinctio-quasi-molestiae-magni-nihil-inventore', 1, 0, NULL, NULL, 2, NULL, 1, 'Perspiciatis autem consequuntur occaecati similique quibusdam. Veritatis consequuntur laboriosam aperiam aut. Voluptas magni provident sit.\n\nCum et omnis omnis ex. Aut qui molestiae id itaque corporis aspernatur ut.\n\nEt omnis saepe voluptates laboriosam quas. Totam nisi non tenetur. Quis corporis quos enim aliquid. Rerum voluptas odio sapiente omnis voluptas nisi facere.\n\nQui consequatur qui unde sed facilis incidunt. Unde repellat quibusdam cumque voluptas. Cumque blanditiis eligendi assumenda porro voluptas voluptatem. Consequatur doloremque ut est repellat ea natus.\n\nEt et quis est quod qui. Itaque id est beatae velit natus. Laborum nulla odit officiis aliquam.\n\nMinima accusamus magnam voluptas aut eius vero id omnis. Quod facere magnam dolorem omnis consequatur sit. Aut mollitia possimus odit repellat quia. Possimus cupiditate enim quo cupiditate at libero.\n\nEt quos ut temporibus recusandae voluptas saepe ut. Quibusdam enim pariatur quidem sed. Esse debitis ipsum quisquam aut qui ad quia. Non sed commodi perspiciatis vero fugit qui molestiae.\n\nConsequatur et voluptatum ipsam voluptatum cumque qui omnis quo. Similique et nulla dolor ipsum ea facilis vero quam. Expedita eum omnis ea molestiae dolores ut. Quam adipisci tenetur velit quia.\n\nCupiditate totam aut voluptatem quas exercitationem. Dolore quaerat et in. Ad quo ab quia doloribus iure nam. Quo facere quis delectus voluptatem ducimus.\n\nDolore illum dignissimos dicta qui. Qui velit ea recusandae quae et nesciunt. Sunt sunt deleniti perspiciatis id ut ex minima et. Pariatur consequatur earum repellat minima.\n\nOmnis qui eos occaecati sint est quo quia. Cum enim eum quam aut doloribus. Velit eaque asperiores cumque dignissimos voluptatem non aut.\n\nEarum ut quis rerum consequatur. Ab quia autem quis ut. Nisi autem perspiciatis minus qui voluptas necessitatibus alias. Incidunt dolorem consequuntur ipsum exercitationem.\n\nVoluptatem laborum aut quo qui omnis impedit. Maiores minus ea consequatur consequuntur facilis minus. Omnis dolores debitis quas autem.', 'Unde amet debitis nostrum ab. Est nihil sit qui qui occaecati repellendus.', NULL, NULL, 1, NULL, 50, NULL, NULL, '2020-04-26 03:04:49', '2020-04-26 03:04:49', NULL),
(9, 1, 'Tenetur et exercitationem ab doloribus reprehenderit labore quis quidem quo sit.', 'necessitatibus-aut-ipsum-numquam-qui', 1, 0, NULL, NULL, 3, NULL, 1, 'Corrupti corporis velit expedita necessitatibus delectus deleniti ut. Fuga architecto veritatis excepturi sit. Voluptas reprehenderit debitis suscipit sed dicta eveniet itaque nobis.\n\nAnimi ut cum dolorem facere ut reiciendis excepturi. Pariatur ut provident officiis assumenda. Et consequatur asperiores cum quam quisquam tenetur ut. Ea id et deleniti id.\n\nEa tenetur corporis maiores officia voluptatibus temporibus rerum. Voluptatum quidem doloremque expedita nostrum voluptatem qui. Consequatur reiciendis facere illum dignissimos odit vel.\n\nQuod et nisi cupiditate iste veritatis. Et expedita voluptatem dolor. Quis voluptas laboriosam tenetur officiis vel accusamus.\n\nDicta sapiente rerum consequuntur culpa assumenda non. Necessitatibus dolor soluta voluptas tempore.\n\nVoluptas qui quisquam voluptatem quia similique reiciendis. Quisquam id ea reiciendis harum. Qui ad quia ad quasi aut optio.\n\nUt consequatur quia illo tempora aut. Possimus expedita consectetur amet rerum. Qui nisi accusantium numquam illum aut quis.\n\nMolestias in laborum est soluta alias. Doloremque eveniet magni repudiandae labore voluptatem veniam. Est totam consequuntur beatae pariatur ipsam repellendus animi.\n\nFugit officia iusto eveniet alias aliquid. Voluptates aut tenetur aut voluptatem mollitia ut vitae. Est aut quod rerum nostrum.\n\nVoluptate culpa et blanditiis quia numquam adipisci possimus. Dolor architecto amet sed qui dolor natus. Atque natus nemo hic porro tempore eveniet laboriosam velit. Quod voluptas facere ex fugiat quo temporibus ducimus vel.\n\nPerferendis ratione voluptas temporibus ut expedita architecto vitae similique. Dolores quos ut aperiam ut. Non aut nihil non veritatis aut animi. Consequatur velit eos deserunt quas minus autem. Suscipit temporibus temporibus reprehenderit deleniti.\n\nMaxime quos alias fuga. Non consectetur laboriosam quibusdam consequatur aperiam dicta similique. Aut hic occaecati nulla quo odio quae. Vel rerum in qui autem aliquid laboriosam.\n\nPorro rerum consectetur est laboriosam eum. Modi nulla et quo ullam ipsum enim omnis. Saepe architecto quas est quae qui dolor nihil. Accusamus qui sunt optio sed soluta qui similique. Laudantium distinctio provident et consequatur magni.\n\nUt similique sint est nihil porro voluptatem qui doloribus. Laboriosam et ea temporibus velit enim harum voluptatem. Est totam consequatur voluptatem quia vero magnam. Nisi odio accusantium perspiciatis.', 'Qui occaecati vel in nulla dolorum. Error velit nostrum delectus vel. Quas dolorum in animi saepe. Distinctio cumque illo saepe voluptas officia esse.', NULL, NULL, 1, NULL, 100, NULL, NULL, '2020-05-06 03:04:49', '2020-05-06 03:04:49', NULL),
(10, 1, 'Qui tempora excepturi voluptas delectus aspernatur quia doloribus est voluptatem.', 'ducimus-tempore-sunt-quas-rerum-atque-ducimus-praesentium-occaecati', 1, 0, NULL, NULL, 3, NULL, 3, 'Et deserunt aut tempore perspiciatis doloremque tempora. Modi deleniti commodi voluptas molestiae consequuntur. Dignissimos harum adipisci possimus recusandae minima. Unde voluptas tempora eligendi.\n\nOmnis et maiores recusandae sit est tenetur esse. Velit minima voluptates in esse quia quidem. Consequatur nam rerum libero rem. Rerum voluptatem nesciunt ea optio ea qui blanditiis.\n\nAnimi doloribus fuga tempora dolores. Eaque inventore voluptas quia voluptatem.\n\nSit esse tenetur tempore impedit. Odit reiciendis sit unde. Maxime quis fugit et pariatur ut quas. Quas iusto asperiores ratione tenetur adipisci. Ut quia perspiciatis in architecto facilis voluptatem quis.\n\nOdio aut est assumenda cum quia et cupiditate. Blanditiis velit tenetur perspiciatis nobis nesciunt adipisci sequi. Eveniet cum hic aliquam aperiam sed debitis.\n\nAut quia suscipit in. Quos soluta voluptate reprehenderit necessitatibus inventore et. Voluptas ea necessitatibus tempora ipsum. Architecto culpa rerum dolores illo accusamus fugiat. Impedit ut eveniet fugit.\n\nNecessitatibus ut eaque quisquam vitae labore dolorem reiciendis vel. Rerum modi reiciendis tempora velit quaerat ex. Est nobis corrupti quisquam ipsum nihil. Sit veritatis a illo accusamus voluptate ea sint deleniti.\n\nCorrupti labore aut reprehenderit sed mollitia omnis. Nulla qui aspernatur voluptates fugit voluptatem. Maiores et corporis voluptatem libero. Ratione iure accusantium excepturi quis sint corporis debitis ea.\n\nQuis aut sit voluptatem eum asperiores eos id. Blanditiis consequatur quis expedita aliquam ea. Laboriosam error cum iste non eos. Non voluptas explicabo et dignissimos est voluptates qui.\n\nEaque vel voluptate voluptas eligendi. Beatae dolores ea quia et necessitatibus laudantium. Possimus aliquid hic sint.\n\nRerum est quia voluptatem culpa blanditiis voluptas. Neque nam ab distinctio. Maiores non cupiditate dolores aut pariatur occaecati est.\n\nNecessitatibus quo molestiae distinctio in. Est cupiditate quas occaecati quis modi aut. Dicta saepe vitae suscipit nam eaque laborum accusantium. Nobis excepturi nihil deleniti. Reprehenderit quia quia corporis incidunt.', 'Ut asperiores provident ipsum optio voluptate qui. Quod quaerat sint ut. Dolor nam officiis rem.', NULL, NULL, 1, NULL, 80, NULL, NULL, '2020-05-16 03:04:49', '2020-05-16 03:04:49', NULL),
(11, 1, 'Facere itaque eaque amet nostrum fugiat ipsum nobis ut.', 'tempora-voluptatibus-cumque-eum', 1, 0, NULL, NULL, 2, NULL, 3, 'Consequuntur quia velit possimus quisquam eos. Ad veritatis sit quibusdam. Sunt magnam sapiente et dolorem. Ducimus perferendis sed fugit.\n\nTemporibus unde fugit quae quam alias totam. Laboriosam placeat aut aperiam aut dignissimos maxime et. Quia libero voluptate culpa natus non.\n\nOdit dolorem ipsa officiis quasi impedit minus omnis ut. Eaque non sapiente repellat dolorum. Culpa est qui ut modi.\n\nNostrum dolor ratione laudantium sed odio. Dolor dolorum maiores possimus soluta. Aperiam esse laborum necessitatibus voluptates. Ea ducimus architecto rem culpa est ea. Maxime cumque ad sunt quia dignissimos.\n\nEaque cumque modi animi minima. Mollitia impedit adipisci recusandae ea qui non animi quas. Quia laborum neque sed.\n\nEveniet sit velit adipisci est accusamus ad voluptatum. Fugiat delectus eos molestiae omnis. Commodi illo ea tempore.\n\nProvident ut inventore delectus dolore consequatur. Sunt consequatur aut aliquid et consectetur dignissimos. Sed dolor voluptatem voluptas doloribus repellat. Aliquid in in est ipsum consequuntur earum et exercitationem.\n\nBlanditiis aut qui sint natus iusto. Et voluptates maiores dolores ducimus velit atque.\n\nLaboriosam quasi quia molestiae voluptatem. Delectus ab velit expedita deleniti aut. Mollitia sequi a magnam.\n\nUt tempore repudiandae porro suscipit aspernatur quis id. Eum vitae voluptatem quo nam amet placeat. Accusamus eum molestiae omnis quod velit ut. Incidunt ut molestias ut.\n\nNon ut eos quisquam fugiat praesentium. Totam occaecati corrupti harum autem recusandae iusto dolorum facilis. Sit necessitatibus quidem doloribus perspiciatis autem maiores. Labore beatae voluptas minus officia itaque in sint.\n\nSed molestiae suscipit nam officiis nam. Saepe sint dolor tempore corrupti quo qui voluptatum. Perspiciatis saepe minima vitae voluptatem. In architecto voluptatem dolore atque et quo voluptas facilis.', 'Consequatur et et fugit ea ab eum. Sequi et omnis ut et inventore doloremque aspernatur. Quam ex amet nobis quod officia.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-05-26 03:04:49', '2020-05-26 03:04:49', NULL),
(12, 1, 'Vel totam blanditiis aut necessitatibus odio suscipit fuga tempora animi esse.', 'dolor-saepe-aut-quis-illo-sed-esse-dolorum', 1, 0, NULL, NULL, 4, NULL, 3, 'Vel non et consectetur consequatur aut modi. Ratione unde exercitationem dolorum ab culpa et est. Possimus quia temporibus consequuntur est nobis odit. Sit non ea harum quis velit.\n\nUt consectetur ut deserunt sit labore laudantium. Sint et nihil culpa rem laboriosam eum earum eos. Voluptatibus quia rem cum aspernatur reiciendis. Nihil iusto quisquam officiis impedit cum. Voluptatem ut est recusandae non est itaque.\n\nDicta et unde fuga sed minus repellat. Magnam eos maiores velit asperiores sunt. Veniam atque sit placeat est nisi molestiae est. Et nam unde accusantium odit.\n\nIllo hic ab aut eius facilis soluta quam. Sapiente labore suscipit facere qui. Beatae beatae voluptatem eveniet nemo beatae ut tempore. Voluptatem quod dolorem quia eum commodi. Alias rerum nobis voluptatem.\n\nAut temporibus quasi perferendis alias laboriosam est vero. Dicta facilis enim quia earum asperiores. Sed maxime ea commodi dicta optio.\n\nSunt laudantium voluptates tempore voluptate id. Et in dolorem aut velit. Quia voluptatibus est est temporibus fugit et.\n\nVoluptatem necessitatibus ea et quis. Culpa tempora sunt architecto. Sed similique quis magni.\n\nSed et ducimus quam a et odio. Vitae placeat rerum sit laborum. Quibusdam modi ut tempora aut qui dignissimos deserunt. Fugiat provident et officia et quae et at saepe.\n\nQuia in reprehenderit nam id voluptatem dolorum. Sed est quod doloremque qui possimus impedit quia. Occaecati ea magni et praesentium qui laborum architecto. Vel consequatur commodi omnis voluptates ut cum.\n\nConsequatur aut omnis quia eum repellat nulla et. Sapiente non accusamus esse quas tempore. Similique accusamus repellat iure recusandae.\n\nAccusamus dolorem et delectus dolor. Et placeat odio quo voluptatem. Eum repellendus quibusdam voluptatum beatae sint. Est animi ut sapiente explicabo error eaque magni quo.\n\nRatione eveniet fuga quibusdam architecto sint sint et. Est eum quia ipsa in mollitia. Aspernatur placeat neque quis possimus harum. At reiciendis exercitationem vel magni soluta dolorem explicabo natus.\n\nDeleniti placeat maiores qui sed sequi molestias et. Consequuntur et sed fugiat iure. Temporibus illo fuga quia.\n\nSuscipit omnis voluptas nobis odit. Perspiciatis delectus aut magni tenetur suscipit odit qui. Rerum eos inventore facilis a vel soluta. Porro nam et hic.', 'Sint labore ea quia numquam qui. Maiores quas asperiores similique assumenda reiciendis deserunt quia. Omnis facere ut harum et corrupti qui et.', NULL, NULL, 1, NULL, 20, NULL, NULL, '2020-06-05 03:04:49', '2020-06-05 03:04:49', NULL),
(13, 1, 'Minima atque aut distinctio voluptates aut impedit unde voluptas labore eum suscipit ducimus hic repellendus.', 'incidunt-sed-iure-libero-est-qui', 1, 0, NULL, NULL, 5, NULL, 2, 'Qui et rem voluptas ad voluptatem. Modi expedita consequatur ut et. Id cupiditate ipsum ut a.\n\nQuisquam sed numquam animi ullam dolorem. Quo rerum nisi vel dolores. Et hic atque veniam est aspernatur et sint omnis.\n\nNon reprehenderit totam quae autem expedita iusto nihil. Ullam ab suscipit et ipsam hic hic.\n\nAtque sed omnis assumenda. Qui impedit qui voluptatibus cupiditate esse. Nisi nam in sequi est asperiores fuga corrupti. Amet nulla nisi quia iste.\n\nVero unde maxime aut id. Veritatis sunt voluptas sint. Ipsum quis fugit quia et rerum ipsam.\n\nQuos molestiae animi suscipit. Dolorem ad praesentium natus blanditiis commodi assumenda. Veniam quod delectus suscipit aperiam rerum.\n\nDolore vero voluptas sit velit et dignissimos. Sunt quia sunt officiis aspernatur. Praesentium qui voluptatibus nihil.\n\nAliquid consequatur voluptatem voluptas voluptatem consequuntur. Aut atque ad blanditiis aut amet et. Sint voluptatum cupiditate et tempora. Deserunt error consequatur ut itaque.\n\nNostrum nisi natus quidem nihil id iure. Laudantium cumque et quisquam a. Unde sequi mollitia et optio. Possimus ut non excepturi nesciunt.\n\nIncidunt dolorum ut sapiente corrupti sed voluptas velit. Sapiente voluptas qui inventore consequuntur ipsa. Quam assumenda at dolorum dolorem nihil asperiores.\n\nMaxime sed natus illo perspiciatis necessitatibus sint. Voluptatem ex enim laborum rerum est consequatur. Debitis aut qui ad sapiente consequatur.\n\nEst aliquam exercitationem ut dolor velit ipsum. Illum est magni doloribus totam tempore cumque. Incidunt dolor est quia quia beatae. Quia rerum id velit sapiente. Est laboriosam nostrum deserunt aliquid sit qui.\n\nUt impedit alias officiis distinctio eaque officia recusandae. Quia neque impedit quos illum vero explicabo saepe. Molestiae debitis sit et enim temporibus maxime harum. Aliquam non cumque odit rerum ut incidunt.\n\nPerspiciatis inventore totam assumenda aut distinctio. Rerum et voluptatem in doloribus. Ut et sequi repellendus doloribus officia qui.\n\nIusto dolor aut ut odio sed blanditiis nemo vitae. Illo non totam qui optio ea est possimus sed. Modi veniam et in consequatur qui. Incidunt culpa in incidunt ad exercitationem.', 'Officia et maiores eos est voluptas quia. Sed quia enim perspiciatis in.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-06-15 03:04:49', '2020-06-15 03:04:49', NULL),
(14, 1, 'Facilis maiores nam perspiciatis voluptates quis qui porro molestiae atque quia voluptatem in vero.', 'voluptatibus-est-et-voluptatem-vel', 1, 0, NULL, NULL, 4, NULL, 3, 'Id distinctio quia quae expedita provident. Sint cumque ratione exercitationem consequatur excepturi eum. Et rerum aut enim voluptatum tenetur. Ea sunt laudantium consequatur adipisci.\n\nDolor voluptatem dolor repudiandae ea eius maxime ea. Iusto natus omnis ut nulla eligendi accusantium voluptatem. Quasi beatae ut consequatur. Laudantium praesentium rem voluptatem itaque autem.\n\nProvident ad totam corporis aut deserunt. Consequatur eos voluptatem culpa impedit libero nulla.\n\nPraesentium eligendi est sit aliquid cumque accusamus labore. Aut ullam repellat atque cum incidunt illo. Architecto officia eos ducimus. Sapiente a vel dignissimos quam est.\n\nRatione porro iure soluta ullam aliquam natus. Sapiente quo corporis labore placeat. Tempore soluta sed accusantium odio.\n\nQuam distinctio accusamus exercitationem aut. Quaerat aut ut et sed repudiandae omnis. Ipsam atque ut molestiae nemo ab unde dolor necessitatibus.\n\nCorporis magni error enim exercitationem adipisci aspernatur. Recusandae quia id vel alias dignissimos eius quis aut. Aut nam est et itaque quod nihil ipsa in. Rem repellat sed dolorum occaecati.\n\nVoluptas suscipit voluptate sit possimus recusandae laudantium facilis delectus. Aut ipsum necessitatibus magni sed. Est at delectus saepe rerum non dolor perferendis. Qui nam sed et vero.\n\nAsperiores animi quibusdam amet non et nulla nesciunt. Et optio sed perferendis voluptas dolorum iusto labore. Nihil cum est ad aliquam quis qui.\n\nUt et ex laboriosam sed ut perspiciatis. Quae voluptas natus nemo commodi ipsum magni impedit soluta. Unde amet ut quos dicta dignissimos maiores.\n\nAut neque accusamus asperiores officia ex quia. Animi animi nihil nesciunt molestiae. Non assumenda soluta voluptate aperiam. Ullam expedita non ea eaque.\n\nNam ea aliquam repellendus asperiores quo sit pariatur. Ipsam facilis tempora ad a aut totam. Doloremque alias iste vitae deserunt.\n\nEos provident inventore maiores neque. Sed ea sit et asperiores et autem. Tempora ducimus sit sequi expedita aut sit. In dolor qui qui unde velit.\n\nRepellendus maiores qui laudantium et. Maxime iusto doloremque cum eligendi culpa. Laudantium dolorem illo et temporibus. Officia laudantium quod enim reiciendis quae.\n\nEveniet tenetur explicabo commodi corporis illo ut. Culpa officia ut fugiat mollitia non. Optio omnis ut a debitis illum aut dolores. Sequi quis sunt ipsa soluta corrupti tempore non ut.', 'Quasi laudantium soluta velit expedita ex voluptatem. Iste ut totam consequuntur hic rerum eius dolore rerum. Tempore facilis ut a nihil vel.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-06-25 03:04:49', '2020-06-25 03:04:49', NULL),
(15, 1, 'Qui soluta aut possimus quibusdam harum et commodi dolorem tenetur quam facere.', 'explicabo-doloremque-est-incidunt-est-blanditiis', 1, 0, NULL, NULL, 5, NULL, 2, 'Et libero dolores aliquid quibusdam nihil est natus. Veritatis non tenetur aut aut. Fuga ad deserunt sit minus et sapiente voluptatum.\n\nConsequatur dolor voluptatibus unde accusantium velit sit. Quidem culpa blanditiis et porro. Modi omnis quia ut voluptatum dolores sequi dolor. Et minima aspernatur voluptatem sed voluptatum accusamus eius.\n\nIpsam id et velit quasi. Suscipit repudiandae omnis sunt dolorum aut. Veritatis at voluptatem pariatur magni velit. Consectetur eum earum quibusdam iusto.\n\nVoluptas ullam ad recusandae similique aut. Aut maxime id laboriosam sapiente et autem. Voluptates laudantium maiores maxime et non ipsam ut.\n\nOmnis qui fuga velit laudantium. Aperiam sit aspernatur qui dicta eum rerum id. Consequuntur natus laboriosam sit rerum dolorem voluptas veritatis. Blanditiis blanditiis dignissimos et quisquam.\n\nEt aspernatur qui nihil aspernatur. Vitae id repellat adipisci ratione fugiat ab occaecati. Harum iusto omnis rerum rerum consequatur. Provident eius aliquam aut consequatur blanditiis cum.\n\nEst consequatur reiciendis voluptatem accusamus omnis. Reprehenderit accusamus assumenda occaecati voluptas incidunt libero. Nihil blanditiis ut dolor minus quia saepe debitis occaecati.\n\nUllam temporibus adipisci ut reiciendis amet. Molestias alias aliquid tenetur ut. Rerum at fugit quibusdam aut est consequuntur accusamus. Soluta eum aperiam quia laboriosam.\n\nDolorem et aliquid ut sint eos. Ipsa consequatur ea voluptates et. Praesentium minima sint explicabo.\n\nAccusamus magnam voluptas ut. Commodi vel velit quas aut exercitationem aliquid. Sint illum vero dicta totam totam debitis harum. Deleniti rerum modi impedit natus quasi ea et.\n\nA ipsam et unde minus accusamus culpa illo occaecati. Ipsum optio nisi quia sed. Atque occaecati vel incidunt ab quam non.\n\nOmnis maxime repellendus qui omnis sed. Quia cum cumque architecto. Dolor natus sed provident aut.', 'Nostrum enim et enim ea. Magnam blanditiis placeat laborum voluptates eos quasi dolore. At et sunt cumque accusantium.', NULL, NULL, 1, NULL, 100, NULL, NULL, '2020-07-05 03:04:49', '2020-07-05 03:04:49', NULL),
(16, 1, 'Fugit asperiores dolore placeat iste ipsa et placeat odit recusandae et.', 'enim-eos-dolore-ut-nostrum-unde-vitae', 1, 0, NULL, NULL, 5, NULL, 3, 'Id corrupti autem nostrum dicta. Perferendis nemo quas possimus ea eos. Similique officiis ut quas. Voluptatem voluptate saepe totam omnis quia numquam rerum omnis. Quia omnis iste voluptas velit ex sint repellendus.\n\nAt quia quis mollitia distinctio dolores officiis. Unde qui nam temporibus qui non laborum sunt.\n\nAliquam similique qui fugiat sint quia enim. Itaque et optio corrupti animi sit qui ut. Qui esse perferendis provident laudantium accusamus neque. Qui quam dolores commodi repellendus quia ex exercitationem.\n\nVoluptatem eum officiis praesentium dolores ut. Ex dolorum eum numquam excepturi sapiente. Sunt repellat beatae laborum voluptas et. Rerum fugiat similique hic placeat.\n\nVeniam non similique perferendis ducimus rerum ab suscipit est. Voluptas hic animi soluta totam. Autem et provident labore similique et quisquam tempore et. Cupiditate ut ex vero neque non totam est quia.\n\nEt sit voluptates beatae quam qui consequatur. Voluptate enim ipsum laudantium occaecati ad velit hic voluptas. Omnis eos eum velit itaque quo et atque.\n\nAperiam id et praesentium commodi molestiae sequi. Aliquam voluptatum exercitationem eos et fugiat facere non. Reiciendis minima voluptate libero ea.\n\nModi iure error corporis dignissimos et nisi qui. Dolores ut aliquam harum. Id et ducimus aliquid eos corporis.\n\nQuos minus ut sint repellendus. Quisquam natus dolorem aut provident dignissimos quos. Laboriosam nemo tempore expedita error. Numquam alias optio quos vero blanditiis.\n\nAsperiores vitae modi sint delectus. Qui corrupti est ducimus esse ratione et quo. Repellendus reiciendis voluptatem est vitae. Aliquam excepturi ipsa ullam quibusdam et animi quia.\n\nCulpa repellendus commodi sit. Eum hic ipsa officia repellat fugit dolor id debitis. Voluptatibus illum et est nobis accusamus nisi vitae.', 'Id dicta mollitia ullam quia odit qui. Qui consectetur impedit sit voluptatem. Mollitia cupiditate aspernatur et ipsa. Ab esse quod explicabo id.', NULL, NULL, 1, NULL, 50, NULL, NULL, '2020-07-15 03:04:49', '2020-07-15 03:04:49', NULL),
(17, 1, 'Nihil aut officia dolores pariatur deserunt excepturi maxime excepturi in.', 'cumque-explicabo-dolor-vel-soluta-explicabo-voluptas-recusandae', 1, 0, NULL, NULL, 1, NULL, 3, 'Impedit sed alias est sapiente. Sed animi consequatur et nemo et recusandae. Minima ut itaque eveniet aut architecto.\n\nAut voluptatum sed quidem ducimus distinctio dicta. Debitis consequatur quis earum eos possimus labore. Quia dicta animi id eos molestiae est hic. Nam molestiae est quos ut eius sit sunt.\n\nEaque facere ullam fuga labore non facere. Sit adipisci ea minima molestiae inventore at porro dolore. Soluta temporibus consectetur labore vel dolor qui ad sint. Aspernatur error odio vel magni odit similique dolorum quam.\n\nNam ipsum commodi maxime rem autem. Laudantium tempora sit aliquam non tempora. Illum et excepturi omnis accusantium voluptatem reiciendis.\n\nVelit quisquam odio doloremque assumenda ipsam. Optio rem eius sint facere ut. Quasi itaque placeat quia.\n\nAssumenda velit sit est dolores. Quia molestias eum voluptate sint quia distinctio incidunt tenetur. Et necessitatibus sit nam porro voluptatem ipsam debitis. Et quod vel est. Aperiam est voluptas aut eveniet.\n\nSapiente voluptate provident quos facere rerum nam consectetur. Rerum laudantium ut aut itaque ut voluptatum veritatis suscipit. Laborum quae sit eius.\n\nRem neque vel labore fuga. Eum et velit voluptas sunt ut iusto. Et placeat quae iusto placeat ut et sunt. Consequatur nobis unde dolores placeat ducimus unde qui.\n\nQuasi occaecati quis nihil blanditiis. Et animi atque odio veniam sint reprehenderit reiciendis laboriosam. Quibusdam consequatur eveniet officiis.\n\nPossimus nihil doloremque qui tempora. Non sapiente ea modi dignissimos saepe harum. Nisi ut magnam et provident necessitatibus debitis exercitationem quaerat.\n\nDolore voluptatibus totam pariatur magnam commodi. Sed voluptatum quia dolore natus incidunt. Cupiditate dignissimos omnis recusandae magni quis corporis possimus qui. Qui et ut at ab omnis molestias.', 'Voluptates eveniet omnis officiis sit architecto aut quod. Commodi consequuntur id quos eum dolores nulla dolores. Suscipit facilis et nam veritatis vero distinctio.', NULL, NULL, 1, NULL, 90, NULL, NULL, '2020-07-25 03:04:49', '2020-07-25 03:04:49', NULL),
(18, 1, 'Possimus non culpa qui modi numquam dolor aut eveniet illo dignissimos dolores id.', 'sed-ducimus-aliquid-recusandae-unde-est-quod-itaque', 1, 0, NULL, NULL, 4, NULL, 1, 'Eos tempora alias aliquid delectus. Illo dolorum aut nisi sint veniam aperiam quam. Doloribus laudantium hic ut ex magnam.\n\nDolorem ut odio cupiditate ullam cumque vel. Dicta architecto eum fuga neque fuga et. Quasi quis consequatur laborum suscipit rerum in.\n\nOmnis asperiores tempore et reprehenderit omnis ducimus. Ipsam maiores deserunt distinctio dolorum omnis et vero. Non facilis suscipit libero alias necessitatibus veritatis doloremque aut.\n\nCum dolores impedit repellendus rerum qui. Labore quas deleniti illo sapiente. Voluptas quo delectus aut enim unde.\n\nQui ullam nobis ea et qui. Et voluptatem tempore nobis animi. Culpa quas aut placeat aut nemo.\n\nFugit omnis consequuntur assumenda illo praesentium. Molestias at aut aut sit quas incidunt. Aspernatur est officia modi provident et quas recusandae eum. Magnam ut vel impedit quam est minus.\n\nAut sint ea blanditiis inventore magni. Qui soluta optio in. Voluptatum libero labore atque sed repellendus provident et.\n\nDolorum quia adipisci autem eaque quia eos similique. Perferendis aperiam nihil similique incidunt. Molestiae debitis delectus laudantium rerum voluptas. Et mollitia nihil non reiciendis qui excepturi vel.\n\nEt aperiam quaerat quis quae dolorem iusto. Quos eligendi quod numquam quia velit. Libero in aut quaerat porro molestiae.\n\nVitae atque est asperiores excepturi aliquid sit rerum non. Voluptates quam quo dolorem dolorem similique in. Id doloremque et magni eaque facere sint quos.\n\nNecessitatibus quisquam quae ea repellat tempore consequatur optio. Omnis eos praesentium iste excepturi. Aperiam ut sint molestiae rem.\n\nAut in et optio minus maxime officia tenetur. Nulla officiis voluptatem enim et eos. Illum officiis consequatur et eius.', 'Et id qui iste sint laudantium omnis quod. Quidem eligendi id modi at molestiae. Illum unde earum quibusdam molestias expedita aut.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-08-04 03:04:49', '2020-08-04 03:04:49', NULL),
(19, 1, 'Et praesentium et nihil dignissimos iure et ut a.', 'consequatur-et-ut-quos', 1, 0, NULL, NULL, 2, NULL, 1, 'Vel cumque consequatur pariatur iusto est. Totam vero nemo ea ipsum accusamus a. Quasi vel fugiat sapiente at nobis consectetur error veritatis. Est dolor ut quam nostrum quibusdam dolorem. Aspernatur fugit est voluptatum aut enim illum.\n\nVitae voluptas dolorem adipisci fuga quo sit sint cum. Earum qui doloribus corrupti unde.\n\nVoluptatem nisi odit maiores quasi. Architecto incidunt ut minus velit laudantium iusto asperiores. Inventore velit deserunt ipsa exercitationem. Voluptatem quae et molestiae aut quam officiis possimus aliquam. Reiciendis id distinctio a nobis architecto libero pariatur.\n\nMaxime labore corporis explicabo nemo asperiores. Illo repellat architecto molestias quia rerum officia rerum maxime. Fugiat quis magni accusamus exercitationem qui. Aut voluptatibus sed totam dolor laboriosam.\n\nSint saepe nisi et et dolorem soluta. Consequatur repellendus blanditiis rerum et ea et ratione. Libero ratione fugit nesciunt est odio modi.\n\nEt eos sit voluptatem quis libero magnam nobis. Officia ipsam eveniet quia. Similique aperiam maxime dolor iste ea maiores.\n\nVoluptatibus sint totam corporis aliquam pariatur consequatur praesentium repudiandae. Laborum error labore necessitatibus mollitia. Repellendus et quisquam animi eos impedit sint.\n\nFacere nam et officiis rem et doloremque velit. Eveniet quam molestiae natus minima hic iusto ipsam velit. Dolores laudantium adipisci omnis iusto omnis odio voluptatem. Et quam et ratione assumenda. Vitae eum qui libero dolores officiis et eius maiores.\n\nAspernatur numquam dicta aut aperiam laboriosam vero hic. Consequuntur aut molestiae temporibus mollitia repellat. Maxime vel sint fuga est libero.\n\nVel sint blanditiis voluptas repudiandae nulla odit eligendi. Architecto quam et laboriosam ducimus et. Placeat blanditiis aut fugit debitis praesentium eos.\n\nIncidunt neque officia nam temporibus modi aliquam. Voluptatem tenetur corrupti minus modi incidunt aspernatur. At perferendis architecto pariatur dolores pariatur id omnis provident. Voluptates eum quod iure in.\n\nA distinctio et facere nemo aut consequatur. Aut numquam pariatur dolores fugiat aut inventore expedita.\n\nAlias nihil ad asperiores. Ea vitae et enim fugit.\n\nNostrum ut rerum architecto nisi corporis sed corporis officia. Maxime magni tempora explicabo minus unde voluptatem labore. Enim libero quia et. Quaerat eos impedit consequuntur non est deserunt deserunt.', 'Necessitatibus soluta numquam itaque id consequatur delectus non laboriosam. Error quia minima labore asperiores qui.', NULL, NULL, 1, NULL, 100, NULL, NULL, '2020-08-14 03:04:49', '2020-08-14 03:04:49', NULL);
INSERT INTO `posts` (`id`, `author_id`, `title`, `slug`, `headline`, `selection`, `video`, `caption_video`, `categorypost_id`, `subcategorypost_id`, `setarticle_id`, `content`, `excerpt`, `image`, `caption_image`, `status`, `comment_status`, `view_count`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 1, 'Deserunt est dolores ab qui labore quasi dicta ea ipsam quia tenetur et et eos ad.', 'est-nemo-id-praesentium-voluptatem-sit-deserunt', 1, 0, NULL, NULL, 2, NULL, 3, 'Itaque ut omnis aperiam repellendus nihil ipsa. Soluta non delectus tempora. Voluptas atque voluptatibus rem dolor at vel officia. Ex quis omnis porro vel distinctio.\n\nQuo qui impedit quo aut. Ut laudantium adipisci et in aut. Quisquam corporis fugiat sed laboriosam reprehenderit molestiae mollitia. Commodi iure porro voluptate.\n\nPraesentium repudiandae quia illum quia amet dolorem vitae. Qui id sint excepturi. Suscipit sed exercitationem iure accusamus sint nihil.\n\nRem impedit perferendis quis nobis dolores. Corporis laboriosam voluptate animi odit ab quam. Voluptas et rerum aut possimus perspiciatis molestiae. Dolore consectetur debitis impedit ducimus nesciunt corporis ad.\n\nAsperiores sed qui molestias quas ad reprehenderit. In deleniti odio et non sed provident. Temporibus voluptatem et laboriosam beatae quia perferendis.\n\nNemo voluptas deleniti atque. Animi voluptatem quasi odit aut libero iusto et. Doloremque alias ducimus consequatur ut.\n\nDolores est officiis molestias sit velit qui labore. Corrupti temporibus suscipit distinctio aliquam illo accusantium. Porro vel non dolor quo laborum et. Totam voluptatum ducimus qui et vitae nisi.\n\nLaboriosam qui nisi repellendus saepe qui consequatur aperiam occaecati. Omnis libero quis architecto quasi. Quo ab mollitia mollitia quibusdam delectus libero. Tenetur sequi rerum perferendis.\n\nPerferendis quibusdam veniam aut fugit dolor. Odio et autem eius occaecati. Facilis repellendus repellendus quo porro tempore.\n\nEius reiciendis molestiae quo magnam. Id qui sed fugit debitis. Aut non error qui. Aut non voluptatem sint quia cumque voluptatem labore quo.', 'Quos repudiandae vel quos exercitationem molestiae laudantium sequi. Modi vel consequatur fuga ab sed et.', NULL, NULL, 1, NULL, 60, NULL, NULL, '2020-08-24 03:04:49', '2020-08-24 03:04:49', NULL),
(21, 1, 'Quidem aperiam deserunt ipsam eos eum rem deserunt voluptatem.', 'ex-nemo-perspiciatis-sit-impedit', 1, 0, NULL, NULL, 5, NULL, 2, 'In repudiandae aut sequi quidem ratione. Modi nisi et soluta aut earum culpa. Accusantium labore modi iste.\n\nSed et totam et occaecati assumenda iusto optio. Quas exercitationem qui aliquam ut ad. Et culpa ipsam ad enim. Autem rerum exercitationem similique sed alias ad.\n\nOptio et quas sed ut consequatur facere. Quibusdam est voluptatem totam totam. Maiores et sint atque id.\n\nFuga est blanditiis incidunt repudiandae aut est qui. Nobis suscipit sint corrupti minus voluptas. Sequi magni consectetur dolor.\n\nNulla non fugiat qui ea cum culpa eius. Cupiditate consectetur doloribus commodi et molestiae et qui. Aperiam officia fugit distinctio.\n\nQuae sapiente beatae facere aut voluptatem libero. Fuga sit pariatur fuga ipsa. Rerum harum placeat incidunt consequuntur. Excepturi ratione rerum sint ut enim distinctio.\n\nQuasi eos sit quis et. Occaecati qui qui adipisci nihil. Dignissimos deleniti et incidunt et ratione. Reiciendis quaerat nulla voluptates hic.\n\nQui accusamus aut voluptatem accusamus. Omnis laudantium minus voluptatem earum et error. Deserunt similique sunt nisi fugiat iste dolores. Ipsum a unde similique sapiente libero ab dolorem.\n\nMagni officiis quas quas qui. Sint temporibus necessitatibus voluptas voluptas quo ea est. Sunt corrupti enim nostrum laborum labore. Id quidem quod doloremque ea.\n\nBeatae voluptates sunt voluptatibus aut. Velit aut eius consectetur praesentium sunt cum. Ipsam laborum aut quos minus itaque. Sit adipisci quia commodi rerum sunt aut.\n\nAutem porro consequatur laborum quo similique. Quia culpa ea autem voluptatem numquam earum. Sapiente voluptates dignissimos maiores suscipit qui.\n\nAut eos quaerat quia sunt fugit animi. Ad sed sunt dolorum magni in debitis sequi. Sequi est assumenda incidunt ipsum sit ea. Quis qui asperiores et omnis ex. Esse in iusto sit.', 'Consequatur consequatur porro et tempora tempore cupiditate ipsam. Quos et enim consequatur ipsam qui sit et et.', NULL, NULL, 1, NULL, 10, NULL, NULL, '2020-09-03 03:04:49', '2020-09-03 03:04:49', NULL),
(22, 1, 'Quia excepturi soluta sed qui dolorem earum recusandae a eos itaque voluptatem nisi ipsam odio.', 'aut-delectus-dolore-aut-voluptate-sed', 1, 0, NULL, NULL, 1, NULL, 2, 'Dolor minus similique omnis cumque iusto sed non. Error tempora excepturi velit. Reiciendis similique amet iusto praesentium odit. Sunt in id officia voluptas alias officiis omnis.\n\nLabore sit esse velit dolorem sint. Vero ut sint distinctio eum. Est placeat autem rerum dolorem pariatur. Vero eligendi dolorem unde pariatur deleniti.\n\nPraesentium rerum sit aut corrupti quo. Eius voluptas et sit omnis. Deleniti laudantium quia harum in sit odio. Et dolorum earum voluptatem qui voluptatem reprehenderit at. Et aut eaque perspiciatis ut molestias dicta qui.\n\nItaque nulla ut a modi sunt recusandae. Eius occaecati exercitationem commodi. Impedit id quasi animi aspernatur earum voluptas odit.\n\nSint aut et expedita alias voluptatem eum est. Corrupti maiores et sint ipsum cum. Perferendis repellat laudantium omnis velit deserunt non. Illo corporis architecto sed exercitationem officia.\n\nEt aut quasi vel. Nobis illo qui ut eaque deleniti. Ea nostrum repellat nesciunt iure aut nisi distinctio. Laboriosam similique eum aspernatur quisquam voluptas. Animi veniam minima eos dolorem ratione sunt libero.\n\nNon voluptatum repellendus pariatur et. Sint aut unde explicabo ipsum non necessitatibus. Ea quis et adipisci. Eveniet fuga velit animi illum qui adipisci.\n\nAutem quis suscipit sed officiis ab facilis sunt voluptate. Voluptatum atque sit a reprehenderit voluptates. Quia veniam dolor et quo quasi aut.\n\nQuis quia labore provident numquam necessitatibus laboriosam nesciunt rerum. In deserunt cumque aut quia ipsa ipsa velit. Vel aliquam eum voluptatum deserunt quasi aliquam placeat. Voluptate consequatur porro est harum et consequatur.\n\nSint autem minus reprehenderit repellat. Optio explicabo reprehenderit cupiditate asperiores. Nulla non doloribus explicabo qui. Distinctio sunt rerum labore.\n\nNumquam ratione ratione dignissimos veritatis in. Repellat ducimus inventore itaque fugit consequatur. Corporis minima dolor aut id ut cum.\n\nMaxime eligendi velit nemo labore nam. Sed repellendus dolor qui et rem alias quasi. Eos ut cupiditate eum omnis repellendus enim. Cupiditate possimus soluta sed quo debitis quae aut cum.\n\nQui dolorum commodi omnis nesciunt veniam quo. Sint nemo quo quia atque laboriosam sequi placeat. Ducimus culpa ut aperiam non excepturi. Architecto repellat accusamus natus sed et.', 'Dolore numquam quasi incidunt sint quibusdam tempora. Sint aut velit voluptate et modi. Nesciunt maxime porro expedita aut sed. Sint hic et qui dolor veniam numquam id.', NULL, NULL, 1, NULL, 30, NULL, NULL, '2020-09-13 03:04:49', '2020-09-13 03:04:49', NULL),
(23, 1, 'Dolor occaecati et eos voluptates sit corporis et quia deleniti sed dicta nesciunt aut suscipit.', 'dolores-et-quaerat-explicabo-voluptatibus-pariatur', 1, 0, NULL, NULL, 5, NULL, 3, 'Aut eum et magnam pariatur qui. Maxime tenetur repellendus ipsam minima. Rerum deserunt provident perspiciatis aut alias natus. Quibusdam consequatur dolor beatae et et culpa reprehenderit. Provident quis aut officia impedit ad minus alias.\n\nAd minima nulla qui optio consequatur. Et voluptatem quam quis atque. Doloribus minima suscipit adipisci eum. Delectus facilis eos accusantium amet modi quibusdam vero.\n\nEveniet qui et eaque labore ad. Est iste et velit expedita qui dolores corporis. Impedit rerum esse totam rerum magnam ipsam rerum aut. Provident sapiente tempora et sed.\n\nEst dolores ipsam consequatur. Distinctio repudiandae ex omnis quis omnis beatae. Sed quis quo harum non sed quo et dolore. Sint vel quidem aut quos dignissimos. Ut minima et rerum unde accusantium doloribus vel.\n\nUllam delectus dolores similique vero fuga laboriosam. Dolores possimus incidunt eos quaerat cum quis dolorem quasi. Ea qui harum non dolorum consequuntur delectus autem.\n\nVoluptatem accusantium quisquam libero hic aut ullam fugit. Architecto eius adipisci dolorum enim. Saepe aut quae non sit et labore. Dignissimos totam odio maxime molestias.\n\nLaboriosam perspiciatis molestiae eum molestiae accusantium. Sint illum vel occaecati rerum sunt a. Sit rerum omnis tempore quibusdam sit ut dignissimos. Delectus explicabo in et asperiores vel ullam perspiciatis velit.\n\nRatione neque quis autem fuga. Dolore mollitia sapiente optio voluptatum dolorum eum. Modi ea perspiciatis fugiat. Error quis iure cumque odit quis qui aperiam.\n\nEt earum impedit quod in omnis et. Perspiciatis at soluta modi praesentium et. Odit omnis corporis deserunt quidem eligendi.\n\nVel quibusdam aliquid aperiam modi hic illo alias. Eligendi facilis voluptas dicta quo voluptates fuga cum. Sint temporibus sunt voluptate.\n\nEum ea mollitia impedit ab dolor. Non asperiores atque in itaque ea recusandae. Maiores autem doloremque est corporis blanditiis animi hic reiciendis.\n\nIpsam aut ipsam blanditiis aut dolorum. Nobis rerum ipsa dolores quis doloremque. Provident incidunt debitis et explicabo qui. Voluptatem fugit sint a debitis.\n\nAnimi quo aut praesentium necessitatibus. Earum omnis aut totam itaque. Provident labore at eum exercitationem quidem provident molestiae tempora. Asperiores facilis ex sit laborum doloremque dignissimos expedita molestiae.', 'Odio fugiat expedita deleniti non corrupti. Delectus consequatur veniam optio neque iste eveniet amet.', NULL, NULL, 1, NULL, 50, NULL, NULL, '2020-09-23 03:04:49', '2020-09-23 03:04:49', NULL),
(24, 1, 'Dolore dolorem in veniam quas et temporibus ut earum.', 'reiciendis-accusantium-provident-sint-et-nihil', 1, 0, NULL, NULL, 5, NULL, 1, 'Quia rerum saepe eius velit omnis cumque non. Et laudantium esse et necessitatibus maxime harum sed. Rerum sit a cumque voluptate asperiores voluptatem. Numquam officiis molestiae saepe enim repellat vero.\n\nDolor officiis harum libero molestiae et quia fugit quam. In et eius optio maiores minima incidunt. Molestias suscipit facere fugit consequatur temporibus ut quibusdam.\n\nEos sunt praesentium voluptatum et nam et. Provident ex distinctio iste quo quam incidunt. Rerum aliquam qui laboriosam non et provident voluptas.\n\nHarum modi consequatur qui veniam. Accusantium perferendis sequi ipsum doloremque ipsum.\n\nConsequatur ut quo ea vero consequatur neque. Repellendus sint omnis quia corrupti. Qui quasi distinctio quas in quod consectetur. Molestias fuga quasi praesentium perspiciatis sint.\n\nBeatae enim nobis sit ipsum quo. Molestiae consequatur provident non. Et rerum minus nihil molestias quos sed quis. Ea dolores consequatur blanditiis alias sed doloribus. Qui veritatis vitae placeat dolores.\n\nEnim placeat et laboriosam quia eius autem. Placeat adipisci cum voluptas. Qui rerum alias architecto nemo rerum dolores aut.\n\nConsequatur ea aut reprehenderit eos quis. Nihil dolor omnis veritatis exercitationem quae. Animi consequatur reprehenderit animi dolores earum.\n\nCum optio quas natus et qui magni. Consequatur dolore eum vel sunt voluptatum. Nisi ea eum tempora occaecati.\n\nNatus unde facilis odit. Modi cum magni perferendis. Ut officiis quas officiis id illo dolore.\n\nDicta dolore nam blanditiis amet quia vel. Cumque distinctio explicabo assumenda ea deleniti. In qui ut ut sequi eos quo.\n\nSimilique magni dolores omnis enim officia. Aut ea qui dolorem dolores fugit quae amet. Iusto quae incidunt autem ut repellendus quidem minima. Iusto rerum autem quia in.\n\nMolestiae alias ut nesciunt qui illo voluptatem. Quia non laboriosam aut officiis nam voluptatem. Fuga sunt nihil eos cumque fuga.\n\nEst debitis non similique repellat quis laboriosam molestias. Ipsa qui eius aliquid nostrum. Consectetur sit quis quo nobis.\n\nNihil eligendi dolorem magni reprehenderit esse voluptatem. Ut tenetur voluptatem suscipit quidem et voluptatibus reprehenderit.', 'Voluptatem aperiam voluptates alias expedita laudantium velit impedit rem. Rerum minus ut saepe quo. Amet et blanditiis quam in sed in porro molestias.', NULL, NULL, 1, NULL, 80, NULL, NULL, '2020-10-03 03:04:49', '2020-10-03 03:04:49', NULL),
(25, 1, 'Autem dolores porro nemo repellendus aut quasi.', 'tenetur-sunt-occaecati-velit-ut-occaecati-voluptatibus', 1, 0, NULL, NULL, 2, NULL, 2, 'Ut rerum eos est quod dolor quis id nam. Voluptates officiis earum qui dolorem ut perferendis sunt. Repudiandae a facere nihil ipsa dolore sunt. Non et consequatur cupiditate ut assumenda natus. Culpa dolor aperiam iure sint repellendus molestias fugiat a.\n\nQuis aspernatur dicta numquam id ullam odio temporibus. Adipisci dolor repellat sed deleniti sapiente. Corrupti et nihil aliquam et culpa. Recusandae dolorem est qui.\n\nEt doloribus neque et quia tenetur molestias earum. Magni eligendi voluptatem eveniet qui a.\n\nConsequuntur quos quibusdam qui et. Est qui doloremque consequatur quis impedit maiores voluptas. Molestiae dolores amet nostrum dolorem. Deleniti beatae non delectus. Provident dolor voluptatem dicta distinctio culpa qui.\n\nEst quis illo enim ab vitae. Et quam quaerat facilis. Quis omnis quo magnam dolores iste veritatis excepturi. Voluptas iste nihil harum velit magni qui.\n\nAutem temporibus dolorem nesciunt dolores et. Labore exercitationem non commodi ea architecto voluptate. Et blanditiis quos dolores et quas provident et.\n\nAut voluptate maiores consequatur et libero fugit tempore. Ratione eum sint magnam beatae. Qui officiis voluptatum dolor voluptas laboriosam. Fugit quod neque ipsa est esse.\n\nVoluptatem sit quo quis deleniti quaerat ratione. Voluptatem et doloremque reprehenderit autem ut architecto. Saepe sit ex qui. Expedita sint iusto in dolores nobis corporis iusto.\n\nEt et aut quia ut ut quam velit perspiciatis. Ut nam culpa iusto incidunt sapiente. Blanditiis aliquid sint modi. Sit qui quos eos eveniet.\n\nVoluptatibus et sequi dolor quaerat mollitia. Ex ipsa exercitationem veritatis odit non sunt et omnis.\n\nIncidunt ducimus doloremque inventore enim enim aspernatur. Nam et tempora vero et sit quaerat id. Distinctio saepe assumenda at ad sunt. Enim animi adipisci consequatur eaque.\n\nRerum ipsam quo eligendi aperiam magni alias officiis. Qui voluptas possimus ut cum adipisci blanditiis voluptas nihil. Expedita ullam quo est fugit accusamus est.\n\nEt dolor consequatur doloremque eaque ea. Distinctio sit quas deleniti placeat deserunt qui nisi eum. Reprehenderit dolorum voluptatem similique. Iusto possimus expedita consectetur aliquid.\n\nAut dolorem aliquid maiores nisi ad autem voluptatibus. Neque iusto ducimus vel aut beatae. Ut rerum necessitatibus fugiat neque praesentium voluptatibus. Autem nulla id ut perferendis rerum.\n\nDignissimos libero et atque repudiandae. Dolores sit eius error tempora tempore minima quod sit. Non odit deserunt officia deleniti accusantium. Aliquid quibusdam et consequuntur earum sit quo.', 'Dolore voluptas doloribus qui quam. Voluptatem velit quae cumque saepe velit. Qui omnis hic aut ea.', NULL, NULL, 1, NULL, 80, NULL, NULL, '2020-10-13 03:04:49', '2020-10-13 03:04:49', NULL),
(26, 1, 'Et ut ut aliquam fuga sint et quam.', 'repellat-eaque-consequuntur-officiis-nostrum-ut-eos', 1, 0, NULL, NULL, 1, NULL, 3, 'Sapiente atque voluptates ea repudiandae veniam aut. Inventore necessitatibus ea voluptate id reprehenderit. Id ut eos blanditiis iusto officia ut corporis illo.\n\nAssumenda quae laudantium aut soluta deserunt quam non. Ipsam sint voluptatem animi dicta ea consequuntur. Blanditiis quis inventore impedit deleniti.\n\nDelectus laudantium harum qui vel molestias deleniti labore. Hic non quis facere sed. Tempora minima ut aut ea ullam recusandae velit est. Et totam delectus reiciendis reprehenderit omnis et ut. Quidem nihil officia impedit numquam.\n\nEt et quam cupiditate pariatur a. Nemo expedita nihil vero dolorem.\n\nPerspiciatis fugit rerum nisi et aut. Voluptates tempore ea natus molestiae nisi iste. Quod harum adipisci repellendus suscipit error porro.\n\nQuis sit molestiae error pariatur molestiae cum. Et cum totam cum autem itaque saepe. Accusamus nobis sapiente qui aspernatur enim saepe.\n\nConsequatur occaecati explicabo ad eaque rerum veniam. Qui consequatur officiis fuga unde sequi voluptate veniam. Animi maxime impedit aspernatur qui esse non et. Ut voluptatibus dolorem et quia et ratione soluta.\n\nLabore cupiditate incidunt quia est quidem debitis voluptatem et. Quia ab dolor qui veritatis voluptas facere eligendi. Pariatur modi culpa nostrum reprehenderit vel rerum.\n\nVitae aperiam aut enim fugit doloremque et et ipsa. Perspiciatis quae officia aperiam ut tempora ad cumque. Debitis nam animi aut et. Natus ad beatae ab suscipit ut perspiciatis.\n\nEt ut occaecati ut commodi sit unde eligendi. Non voluptate voluptatem harum pariatur sint nisi quis. Dolorem ea cum est quis vero consequatur voluptatem eum. Magni nihil autem odio atque possimus nihil aut.\n\nMinus iusto et quidem quam est rem. Aliquam autem dolor perferendis quis. Recusandae impedit saepe eligendi magni necessitatibus.\n\nSed quod delectus qui. Aut saepe nesciunt labore aspernatur ea sed cum. In quia qui asperiores magni fugiat necessitatibus laudantium. Cumque est qui itaque animi.\n\nOdit reiciendis possimus et rerum sint vel iste. Aut quo mollitia enim esse cupiditate. Expedita excepturi et vitae quam sed quidem quia qui.\n\nAsperiores ipsa aspernatur dolore dolores. Quia dolore eligendi ratione sit molestias. Quis voluptatem ipsam rerum aut omnis eaque sed. Id dolorem sed doloribus at.', 'Enim perferendis magnam et sint et sit. Esse laudantium ab voluptate. Suscipit est possimus aut voluptatem quis. Tempore et perferendis qui esse.', NULL, NULL, 1, NULL, 40, NULL, NULL, '2020-10-23 03:04:49', '2020-10-23 03:04:49', NULL),
(27, 1, 'Deleniti molestias nemo et nisi earum.', 'debitis-in-aperiam-vel', 1, 0, NULL, NULL, 3, NULL, 1, 'Sequi voluptas quidem repudiandae et error. Voluptatibus et sed quasi voluptas facilis debitis. Corporis consequatur ratione unde sit.\n\nLaudantium et fugiat qui qui nobis et et accusamus. Quo est sed et qui voluptatem nihil. Odit illum dolorem aut velit vitae iste. Aut non dolore temporibus ea iure eum.\n\nQuidem a voluptas ipsa eos. Corporis eum velit perferendis quis repellat. Corporis soluta sit et modi vitae sed dolor. Vel consequuntur sint vel et sed consequatur aut. Excepturi et nisi sit sit dicta.\n\nRepellendus iure quis illum. Omnis ipsam quia accusantium libero aut autem. Doloremque et vel cupiditate ipsa earum. Assumenda corporis expedita voluptatem fuga.\n\nOptio consequatur quis omnis sunt. Distinctio porro iure in dolores possimus corporis consequatur eos. Debitis ut odit exercitationem omnis. Quo eos architecto aliquam laboriosam nihil quod.\n\nRepudiandae ea quos provident in rerum laboriosam. Quisquam dolorem natus quo perferendis. Qui velit eum aut ut nemo impedit. Et ab sequi beatae tenetur nihil in non.\n\nQuam delectus iste harum omnis soluta. Consectetur ea est in incidunt maiores. Error occaecati ipsa minus voluptatum a. Aperiam et aperiam laborum omnis totam laborum fugit culpa.\n\nEt consequatur expedita quos. Eligendi eum quaerat unde qui. Ea autem voluptatem debitis beatae quia. Asperiores blanditiis et voluptatem est laudantium sapiente nihil.\n\nVoluptas quas quidem occaecati dolores reiciendis distinctio. Culpa dicta reiciendis quos enim voluptatem temporibus nihil. Esse consectetur id explicabo sit quod ullam. Amet omnis qui at ad quia sed. Quos delectus iure amet accusantium modi.\n\nUt autem molestias placeat quidem nihil consequuntur quod. Rerum consequatur ratione rerum pariatur et magni. Dolorem blanditiis enim dolorem aspernatur.', 'Assumenda ea repudiandae beatae dolorem fugit fuga ducimus. Illum tempora rerum ex modi.', NULL, NULL, 1, NULL, 50, NULL, NULL, '2020-11-02 03:04:49', '2020-11-02 03:04:49', NULL),
(28, 1, 'Ducimus consequuntur ut qui iusto iste rerum quia.', 'minima-quisquam-necessitatibus-id-rem-velit', 1, 0, NULL, NULL, 5, NULL, 2, 'Magnam enim nemo magni mollitia. Nostrum ut quos et. Quidem quo saepe fuga.\n\nAdipisci aut dolorem ab ullam enim. Dolor eos quam doloremque dolor quis qui totam. Eum dignissimos et sit in. Odio totam ut sed reprehenderit maxime odio. Eaque voluptatum porro rerum sed animi temporibus.\n\nDeserunt itaque corporis aspernatur nostrum. Cupiditate ut facere maxime nulla dolores. Libero sit sed ut.\n\nLaborum laudantium quae quis aspernatur rem unde. Aut vitae est facilis itaque autem rem repudiandae. Quis nostrum vel nesciunt nam similique sed quasi. Et cupiditate in repudiandae nemo aut sint.\n\nMollitia saepe est nisi hic numquam rerum. Dolor excepturi voluptatum maxime occaecati et non. Excepturi quidem quis rerum laudantium ut veniam perferendis natus.\n\nOccaecati et explicabo et necessitatibus. Qui et sint quia et natus est.\n\nUt fugit quia in error consectetur modi id architecto. Maxime id voluptatibus nesciunt quo consequuntur ut mollitia. Voluptas quo ut labore soluta rerum fugit illum. Possimus placeat aut voluptatem sint.\n\nEsse ullam quod a accusantium architecto fugiat non. Sint et magni qui. Quis veniam distinctio tempore harum qui quod enim.\n\nVoluptatibus voluptatem illo aut eum. Illum corrupti aspernatur nam. Deserunt nam maiores debitis voluptatem et. Omnis in eveniet autem vero. Deleniti temporibus quis sit amet.\n\nFuga eligendi dolorem atque et voluptatem. Et laborum maxime in hic voluptatibus in autem. Facere qui similique officia exercitationem quis blanditiis. Ut sint voluptate voluptates.', 'Quo occaecati qui odio fugit. Amet aut temporibus tempora. Ut non quam hic veritatis. Doloremque voluptates laborum aut temporibus dolorem facere reprehenderit.', NULL, NULL, 1, NULL, 100, NULL, NULL, '2020-11-12 03:04:49', '2020-11-12 03:04:49', NULL),
(29, 1, 'Enim et delectus eum sed qui aut.', 'natus-delectus-nostrum-ipsa-facilis-odio-maiores-vero', 1, 0, NULL, NULL, 5, NULL, 3, 'Doloremque ratione expedita perspiciatis iure totam consectetur dolores. Fugit iusto ipsa qui eius. Aut voluptas nam ut earum qui quae corrupti. Enim dolor sint quisquam iste quis.\n\nEst velit dolore non placeat cum. Voluptate maiores provident unde qui doloribus. Mollitia ipsa saepe velit rerum quas in ut.\n\nVeniam necessitatibus laudantium temporibus. Rerum quis necessitatibus sit minus similique omnis perferendis voluptas. Sed dicta est odio quo officiis aperiam consequatur. Illum cum ut similique sed.\n\nAutem nemo sint pariatur similique voluptate. Repellat velit consequatur saepe et velit.\n\nOfficiis modi perferendis aut quo rerum aperiam labore. Sequi modi voluptatem perspiciatis perspiciatis quisquam. Explicabo laudantium architecto error amet in omnis nihil.\n\nFuga sequi blanditiis velit et nostrum rerum. Et sit a cumque sit. Quia ratione qui esse facere.\n\nArchitecto eveniet inventore veritatis assumenda exercitationem rem. Nobis quod voluptas explicabo consequatur veniam consequuntur molestias. Quas porro error veniam. Molestiae sunt et est.\n\nEt est qui tempora id voluptas error totam. Quia dicta vero eum quas provident ullam animi. Vel hic ipsa facere labore vel.\n\nArchitecto dignissimos nisi voluptatem nesciunt aut. Sed iste nemo exercitationem distinctio ut.\n\nReprehenderit magnam rem voluptate suscipit deleniti ut quo. Ex cum est eligendi molestiae et quas. Eveniet culpa et fugiat molestias error hic.\n\nVoluptatibus vero veniam tenetur. Et est ipsa doloremque sit aut. Eum laudantium a dolorum soluta eos rerum recusandae a.\n\nAssumenda et nulla optio nisi eaque libero iure. Magnam nesciunt aut adipisci sit mollitia commodi. Asperiores quia rerum aut est delectus.', 'Dignissimos voluptatem repudiandae enim tenetur. Eum quis eos saepe magni officia.', NULL, NULL, 1, NULL, 60, NULL, NULL, '2020-11-22 03:04:49', '2020-11-22 03:04:49', NULL),
(30, 1, 'Tempore itaque ratione fuga quas enim aut optio mollitia et.', 'et-reiciendis-quod-perferendis-dolorem', 1, 0, NULL, NULL, 4, NULL, 2, 'Laboriosam ab autem explicabo laudantium impedit enim consectetur. Hic dicta dolore consequuntur accusantium rerum ipsam. Enim commodi error velit sit est.\n\nEos aut ex exercitationem dolor aut et eos libero. Et voluptatibus aut nostrum sed. Rem ipsam velit aspernatur quaerat quidem aspernatur soluta.\n\nQuia rerum necessitatibus atque vero et. Et provident cumque eos dolorem vel. Laudantium officia sunt odit earum in cum. Expedita error odit cupiditate autem molestias harum sit.\n\nEarum alias necessitatibus velit ex. Eveniet doloremque voluptas natus pariatur neque. Aspernatur recusandae quod est unde at voluptates voluptas. Hic odio sit odit et velit. Consequatur dolorum illum vero eius nihil dolore ad.\n\nEst deserunt aut itaque eius sequi. Blanditiis atque sit nam repellendus dolorem debitis quisquam. Ea ipsum architecto nostrum quis ab dolor rerum.\n\nAut perspiciatis voluptas voluptas quia omnis nisi vel. Voluptates deserunt aspernatur qui eum labore. Et quam officiis adipisci maxime. Omnis est omnis nihil possimus pariatur qui ut.\n\nAsperiores sint repellat dolor quia libero qui molestiae officiis. Consequuntur laudantium sit laboriosam dolorem sapiente nihil nam. Omnis sequi dolor accusantium sed. Ducimus at odio officia quaerat.\n\nMollitia et similique magni praesentium repellat adipisci voluptates. Ducimus repellat aut et. Laudantium et vel qui quibusdam. Eveniet aut non voluptates labore ut sed voluptate. Velit est eveniet voluptatem nihil et quia pariatur inventore.\n\nMagni non ut aliquam et ut repellat fugit. Tempora et dolor a eius nam debitis illum. Necessitatibus et aut et temporibus illo cum aut. Provident dolorem praesentium ipsa vero est nemo ipsa.\n\nCum eos alias distinctio laboriosam. Qui nesciunt consectetur id distinctio. Incidunt illo aperiam similique ut. Omnis quasi architecto dolores voluptates saepe sint dolorem qui.\n\nOmnis nihil deleniti repellat sit quam in. Nisi et est sapiente magnam in fugiat alias. Laborum aspernatur fuga sunt asperiores.\n\nIste praesentium illum et mollitia. Numquam blanditiis architecto alias quos unde. Odit beatae omnis quaerat fugiat a illum. Earum ipsam est non incidunt.\n\nExpedita labore quis rerum ad labore. Sapiente velit esse quibusdam est ipsum impedit dicta. Natus est et pariatur voluptatum debitis. Tempore eligendi quod facere recusandae quae dolore.\n\nQui vel voluptatem quia magnam omnis possimus. Omnis id magni beatae ut. Ullam et ea et dignissimos perferendis accusantium. Impedit quibusdam labore vel.\n\nVoluptatem dignissimos ut autem saepe asperiores eos asperiores. Deserunt molestias et deserunt aliquam quasi dignissimos sed mollitia. Omnis repellendus optio et qui impedit vel sit. Earum voluptas quas nostrum vel doloribus.', 'Velit vero non harum omnis nesciunt. Culpa earum numquam blanditiis. Magni laudantium dolores tempore eius impedit qui doloribus.', NULL, NULL, 1, NULL, 40, NULL, NULL, '2020-12-02 03:04:49', '2020-12-02 03:04:49', NULL),
(31, 1, 'In reprehenderit vero modi culpa sunt non et.', 'ad-ex-reprehenderit-ut-architecto-minus-magnam-non-dicta', 1, 0, NULL, NULL, 4, NULL, 2, 'Quia perferendis qui sunt tempore nemo eius. Minima dignissimos quia sit omnis. Qui aut cum ducimus eos cumque. Fugiat qui molestias voluptates et omnis quo. Quia explicabo corrupti voluptatem quis.\n\nEt odit qui aliquid quia dolor consectetur ut. Natus sequi necessitatibus minus dolorem vero. Fuga odit magni quam esse. Ut veritatis est praesentium id vero sit.\n\nEa quo consequatur ut natus ut illo. Sequi ea magni ipsa velit autem quisquam aut. A nostrum repellat et omnis repudiandae.\n\nDistinctio excepturi sint aut dolorum. Quod blanditiis hic laborum quisquam laboriosam. Et vitae quia sapiente placeat.\n\nDignissimos aspernatur inventore eaque fugiat consequatur. Voluptas ut autem deserunt qui. Eius voluptate cum odit quas expedita itaque. Consequatur voluptatem quos magnam rerum voluptatem. Facere voluptatem et minima amet hic accusamus est.\n\nQui doloremque ea reiciendis quaerat sunt dignissimos dolores debitis. Quae cumque voluptatem perspiciatis quos. Expedita sapiente est recusandae error accusamus molestiae.\n\nVoluptas est accusamus ratione maiores quaerat recusandae a. Dolor sunt velit quos. Blanditiis omnis odio quo. Porro blanditiis mollitia doloremque.\n\nAut quos reiciendis rerum omnis laboriosam asperiores perspiciatis. Odit occaecati ut sit quos quia. Quo similique tempore beatae ut aliquam quam qui sed.\n\nNon molestias quibusdam dicta voluptatum officia sapiente. Debitis consequatur dolores qui dolor perferendis omnis. Nihil qui et dolorem voluptate quibusdam. Et in ut nihil recusandae non.\n\nDeleniti consequatur molestias id maxime pariatur. Nobis aspernatur non consequuntur enim vel. Omnis et ea esse numquam cupiditate placeat. Totam rem nesciunt aut saepe nostrum et iusto.\n\nPerferendis mollitia harum omnis qui aperiam optio sed. Ea mollitia cumque beatae aut natus ea facere. Voluptatem earum repudiandae dolor id labore voluptatibus aut odit. Natus consequatur earum et cumque nostrum nihil vel quia. Qui iusto deserunt quae.\n\nCupiditate praesentium non enim ipsa. Alias cupiditate voluptate temporibus ad. Laudantium rerum aut est quam assumenda. Rerum totam hic quo temporibus enim tempora.\n\nNon ea optio dolore eligendi nam. Facere fugit quod velit soluta. Dolorum velit accusantium voluptatibus exercitationem. Dicta expedita est quae aut distinctio commodi.\n\nSimilique laborum sit occaecati aut error. Et cupiditate minima possimus et. Qui unde itaque nulla laudantium.\n\nPerferendis odio fugit nobis id omnis et est possimus. Iure minus autem fugiat saepe et non labore eius. Quis expedita velit aut sunt aut consequuntur. Tempore nesciunt modi fugiat.', 'Ipsam voluptatem rerum aut qui illo et. Ipsa non ut alias. Omnis eos nam iste nemo. Quia ex quae exercitationem ut voluptas accusantium.', NULL, NULL, 1, NULL, 70, NULL, NULL, '2020-12-12 03:04:49', '2020-12-12 03:04:49', NULL),
(32, 1, 'Suscipit aspernatur amet quis qui doloribus possimus et rerum.', 'corrupti-dolores-laboriosam-laboriosam-deleniti-amet-alias-provident', 1, 0, NULL, NULL, 2, NULL, 3, 'Error ipsa in aut voluptas sit. Aspernatur sed voluptatem fugiat ut est autem inventore. Recusandae at molestias atque. Temporibus ea qui voluptates fuga odit ea. Aut similique cupiditate nesciunt quisquam amet at eius.\n\nEa quam saepe sed non rerum dolorem. Architecto praesentium est assumenda et. Iusto provident dicta recusandae quia qui. Praesentium deleniti voluptatem totam quis quasi iusto animi.\n\nEt ut incidunt qui optio. Dolor voluptate aliquid fugit nihil quidem et. Unde aliquam accusamus molestias veritatis sint maxime. Assumenda et sit sit qui quisquam distinctio a corporis. Quia neque ab quia minima quaerat nulla.\n\nPerspiciatis adipisci quisquam rerum quae eveniet. Ad aspernatur ut aliquam officia quibusdam neque repellat. Iste velit cum illum possimus ad facere magnam.\n\nOmnis delectus sequi quidem consequatur. Sed quam magni id in. Accusamus accusantium voluptate fugit vitae sint. Quasi vel eum animi quidem rem.\n\nTempore sint nesciunt fuga excepturi. Delectus iusto exercitationem velit enim libero. Reiciendis minus fugit dolores ab impedit et perspiciatis et. Nihil sit quod omnis dolores voluptas explicabo.\n\nMagni animi deleniti voluptas quia. Qui et a id ex veniam. Sed voluptatum omnis beatae quaerat nihil vitae.\n\nQuisquam non itaque rerum voluptas quibusdam possimus. Officiis fuga alias nostrum et et. Autem cum rem ut in tenetur nesciunt veritatis quo. Dolorem at aut velit nemo doloremque.\n\nQuis asperiores ab accusantium ipsa corporis voluptate quam iure. Qui exercitationem non et quaerat dolor cumque sed. Qui quia incidunt aut. Nesciunt aperiam officia qui aspernatur eius non quia. Nostrum molestiae voluptas natus rem voluptatum quisquam.\n\nMolestiae consequatur cumque perferendis dignissimos totam. Ea dolore libero ex ullam illum quisquam et. Mollitia mollitia tempora placeat quidem nisi quia. Ullam nihil autem saepe et dicta.\n\nSoluta est et non voluptates eius sint. Quibusdam occaecati et pariatur ab blanditiis. Officiis nesciunt molestiae saepe saepe quos ut necessitatibus et.', 'Porro odit consectetur voluptatibus aut. Commodi repellendus et aliquam earum repellendus fugiat. Neque dolorem sit cum error inventore nihil et.', NULL, NULL, 1, NULL, 100, NULL, NULL, '2020-12-22 03:04:49', '2020-12-22 03:04:49', NULL),
(33, 1, 'Vel dolorem eius et voluptas eos laborum nam praesentium dolore a ut est consectetur sunt possimus.', 'nisi-aut-et-cupiditate-corrupti-quis-doloribus', 1, 0, NULL, NULL, 1, NULL, 2, 'Unde a nulla voluptas suscipit adipisci dolor. Nemo fugit quisquam incidunt. Laudantium nesciunt suscipit quaerat recusandae illum. Ducimus quibusdam et doloremque iusto.\n\nUt inventore illum rerum est velit. Omnis inventore vel nihil ipsa molestiae quo. Illo non quis occaecati numquam dolores. Harum ad autem ut rerum voluptas corporis.\n\nRepudiandae et voluptatibus corporis. Quia sunt vel quia cumque. Sit sed est ab provident. Velit rerum inventore soluta cum maiores at ut natus.\n\nOdit voluptatem animi sunt deserunt esse. Itaque sapiente dolores quibusdam eos. Veritatis aut voluptatum temporibus neque. Tempore soluta qui possimus voluptatum voluptatem id. Ad laudantium eum ut ipsum.\n\nEt sit labore hic magnam atque totam enim. Consequatur eum officiis nobis ut dolorem omnis. Error sapiente repudiandae labore nam consectetur ipsum sed. Possimus in pariatur nihil saepe non.\n\nAut sunt et ipsa sit nisi ad molestiae. Cum sint libero voluptates libero et commodi atque. Hic ratione recusandae qui.\n\nAut consequuntur debitis earum dolorem qui ab ut cum. Exercitationem non aperiam qui ut nihil incidunt est. Ad voluptates quis pariatur enim ipsam. Soluta aut nam facilis error voluptatem nobis facilis. Omnis repellat maxime quia aut repudiandae officia.\n\nNihil sit vitae eveniet non nobis. Perspiciatis et minus quo rem. Numquam in quo incidunt.\n\nCorrupti provident itaque necessitatibus recusandae ut. Qui eos possimus dolor maiores voluptatem rerum eos. Dolorem ut incidunt vitae pariatur ut enim culpa enim. Corrupti in tenetur incidunt repellendus.\n\nSint sit eos alias consequatur maxime similique doloremque molestiae. Id molestiae dolores odit. Est sit non qui et. Vel ad excepturi saepe.\n\nNihil sapiente quis qui ipsa. Amet rerum consequatur magni sapiente qui et culpa. Molestiae dolorum architecto quod alias reiciendis non commodi repellendus. Illo repellat sit et laudantium.\n\nItaque nihil quidem et cupiditate expedita. Aut enim minima id fugit ipsum. Minus tempore alias in nam tempora maiores. Ea voluptas dolore eum ipsam.\n\nNeque est unde voluptatem. Quo ratione reprehenderit sed quo molestias. Qui consequatur officiis in. Ut iste omnis voluptas nam.', 'Accusantium assumenda corporis delectus sed. Quod quia quisquam ipsum culpa dolorem reiciendis amet. Deserunt nemo qui qui non ullam facilis.', NULL, NULL, 1, NULL, 40, NULL, NULL, '2021-01-01 03:04:49', '2021-01-01 03:04:49', NULL),
(34, 1, 'Doloremque et harum beatae perspiciatis itaque non.', 'est-aut-nisi-dolore-sed-voluptas', 1, 0, NULL, NULL, 4, NULL, 2, 'Perspiciatis fugit aut totam id quia excepturi. Atque corrupti dolorem explicabo maxime magnam qui in. Et molestiae veniam odit quidem. Atque voluptatem veritatis commodi facilis iusto.\n\nUt molestiae possimus explicabo iure officiis beatae reiciendis enim. Molestiae incidunt tempora rem ea. Mollitia porro dolores voluptas odit sapiente rerum.\n\nEt corrupti ut vitae quam neque ut et. Neque doloremque et veniam laborum. Quas itaque hic minus.\n\nAperiam dolor sit ullam ullam enim. Est omnis rerum et commodi. Perferendis velit quo assumenda quas atque sed. Alias ullam sunt adipisci et odio ut.\n\nQuos veniam culpa tenetur aliquam esse neque rerum perspiciatis. Necessitatibus eum laudantium vel omnis at quidem quisquam rerum. Alias in soluta accusamus.\n\nSed cum minus praesentium voluptatem quia voluptatem explicabo. Id ducimus nesciunt et. At quo qui excepturi non in.\n\nQuibusdam eos saepe nihil et numquam tempora repudiandae. Voluptatibus autem voluptatem voluptatem quod quam debitis ut. Corporis consequatur qui alias omnis.\n\nSint at cumque ipsam reiciendis consequuntur et est. Voluptates voluptatem at tempore deserunt tenetur. Dolore magnam dolor et error velit aut.\n\nEt rerum praesentium et. Ea error ea distinctio quidem provident. Reprehenderit amet quia molestiae ut nemo. Quod et et et omnis.\n\nVoluptatem aut quia quam enim assumenda. Distinctio molestias blanditiis nihil quos dignissimos qui cupiditate.', 'Aut sed cupiditate quo itaque. Recusandae occaecati ab aut natus aut. Quod vitae omnis recusandae pariatur.', NULL, NULL, 1, NULL, 30, NULL, NULL, '2021-01-11 03:04:49', '2021-01-11 03:04:49', NULL),
(35, 1, 'Dolorem sed saepe ipsum amet asperiores corrupti et qui sit.', 'vitae-omnis-ducimus-dolorem-rerum', 1, 0, NULL, NULL, 2, NULL, 1, 'Ad qui qui deleniti et excepturi saepe. Aspernatur voluptas ratione saepe enim ipsam. Autem aut facere illo alias quia. Quis sed officiis iure.\n\nBeatae architecto quia voluptatem mollitia necessitatibus aut eum. Consectetur eveniet libero laudantium tempore vero est recusandae. Odio omnis enim molestiae illum qui.\n\nLabore aut sapiente eum autem in dicta. Deserunt ullam alias ab dolores reiciendis. Earum sed iusto tenetur et hic necessitatibus. Quisquam voluptates id non quae molestiae qui.\n\nPraesentium praesentium autem eos tempora animi eligendi porro. Sunt sapiente quasi et et. Praesentium unde aut impedit omnis eveniet et ullam. Eum quae facere quibusdam non. Eligendi ut voluptates accusantium beatae fugiat.\n\nVoluptatem soluta nam ab fugiat ut quae ab. Eos error repellat voluptas et nulla. Ex rerum animi accusamus nobis repellat.\n\nVel voluptate rerum eveniet aut. Pariatur et et quae quis mollitia et voluptatibus doloribus. Voluptatem unde iure nostrum aut. Sit deserunt ex inventore numquam nihil.\n\nRerum tempore magnam omnis nesciunt. Vitae qui quia iure voluptas alias. Cumque quos consequuntur ut similique aut est. Consequatur voluptas quam magnam et atque doloremque earum.\n\nNobis consequatur tenetur iure eos deleniti velit. Ipsam sit at debitis quae. Ut quas non eum. Sed voluptatem voluptatem ut voluptas eveniet ipsa. Vel dolorem est nihil voluptatem.\n\nQuidem sit sit qui et. Omnis sit eaque quidem nemo voluptatem necessitatibus nesciunt voluptatem. Aut est id reiciendis neque molestiae dicta ipsam eum. Provident nobis omnis nemo hic.\n\nConsequatur necessitatibus sunt laudantium ipsum. Sit facere sit quos rem. Qui voluptatum culpa dolorum corrupti et. Quos facilis eius sed ipsum quia nihil.\n\nEt autem non earum omnis eum et facilis. Fugit aut modi ex ex culpa eaque omnis dolorum. Aspernatur enim ducimus sint magnam natus. Quod et asperiores dolorum ipsa placeat ipsa.\n\nAlias qui quis aut quisquam. Reiciendis corrupti qui aut sit voluptas sed fugit. Enim quasi aut consequatur laborum provident et.', 'Molestiae dignissimos ipsam vel. Quia iure illo et quia minima ut. Aut neque expedita praesentium ut illo.', NULL, NULL, 1, NULL, 81, NULL, NULL, '2021-01-21 03:04:49', '2021-02-06 03:08:22', NULL),
(36, 1, 'Quasi at asperiores soluta nulla saepe quis autem similique possimus recusandae dolores.', 'quasi-at-asperiores-soluta-nulla-saepe-quis-autem-similique-possimus-recusandae-dolores', 1, 0, NULL, NULL, 2, NULL, 3, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Impedit dolorum ut ut cum architecto. Doloremque dicta sint omnis ab. Ut itaque eum odio cumque fuga dolor fugit. Cum vero et explicabo. Aliquid eos iure vitae temporibus ea ut id. Iure sed inventore quis molestiae rerum eos. Voluptatem rerum quae sapiente voluptatem sed quaerat. Dolorum modi fugit ab neque. Placeat neque aut optio est. Velit facere sed impedit expedita exercitationem fuga ea. Inventore doloremque nesciunt laborum ducimus dolore esse totam. Fugit aperiam perspiciatis magnam adipisci dolor sunt itaque. Occaecati quis quis qui tempora et earum. Debitis quod dolore consequatur optio. Quia id eius delectus. Et laborum similique voluptas qui qui. Natus voluptatibus dolores vitae. Facilis sunt dignissimos nulla repellendus neque explicabo libero. Adipisci qui sit repudiandae nihil libero. Qui voluptas aut tenetur qui aliquid et. Laboriosam amet voluptatem vel aut aut et nemo. Doloremque minima repellendus rerum sed est et. Placeat dolores ipsam quos itaque odit facere. Modi vel dolore doloremque voluptatem qui. Distinctio mollitia temporibus ea facilis possimus nisi perspiciatis possimus. Quisquam ab at dolores dolores voluptas. Aut illo laboriosam aperiam explicabo. Delectus id ea quod neque eius facilis voluptate. Voluptatem qui nostrum aut. Qui deleniti veniam sint dolor. Nam reprehenderit sunt dignissimos sint dolores. Ab amet unde ut est. Qui voluptatem quos quaerat dolores dicta voluptates velit quos. Nesciunt dicta magnam autem sit rerum qui iusto. Porro unde suscipit omnis corporis.</p>\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Impedit dolorum ut ut cum architecto. Doloremqu...', '1612615792isometric-hosting-concept_23-2147967976.jpg', 'Quasi at asperiores soluta nulla saepe quis autem', 1, NULL, 82, NULL, NULL, '2021-01-31 03:04:49', '2021-02-06 04:51:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
('36', '2'),
('36', '1'),
('36', '6');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(2, 'administitution', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(3, 'adminschool', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(4, 'operatorinstitution', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(5, 'operatorschool', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(6, 'userinstitution', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(7, 'userschool', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(8, 'author', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(9, 'editor', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(10, 'subscribe', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41'),
(11, 'general', 'web', '2021-02-06 03:04:41', '2021-02-06 03:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vOaaiN5oy1Nu4U2VI9idB9XibpJaFMtvVhQcaiCc', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.146 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMGJyNGZBN01iVmxlV2phTVhONXRkUkl4ZDdmSUxRaERpamxMRkUwayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9ibG9nLWxhcmF2ZWw4LTIudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRFb1pHQXlLS24xV3V5anhWWS96M0cuVEE0VlNhMnV6VXVGNlpMNjRhUGh3bDk0M0xRZHNKdSI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkRW9aR0F5S0tuMVd1eWp4VlkvejNHLlRBNFZTYTJ1elV1RjZaTDY0YVBod2w5NDNMUWRzSnUiO30=', 1612616125);

-- --------------------------------------------------------

--
-- Table structure for table `setarticles`
--

CREATE TABLE `setarticles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setarticles`
--

INSERT INTO `setarticles` (`id`, `title`, `slug`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Belajar HTML', 'belajar-html', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(2, 'Design Frontend ', 'design-frontend', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(3, 'CMS Blog', 'cms-blog', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(4, 'Bootstrap', 'bootstrap', NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `tagline`, `website`, `email`, `description`, `image`, `logo`, `favicon`, `meta_description`, `meta_key`, `created_at`, `updated_at`) VALUES
(1, 'Laman Kreasi', 'Belajar menulis dan berkreasi', 'www.lamankreasi.com', 'laman.kreasi@gmail.com', 'Melalui website ini semoga dapat menjadi sarana upaya peningkatan kompetensi', NULL, NULL, NULL, NULL, NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_attribute` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_embed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_embed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_embed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_embed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatapps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest_embed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `facebook`, `facebook_embed`, `instagram`, `instagram_embed`, `youtube`, `youtube_embed`, `twitter`, `twitter_embed`, `whatapps`, `telegram`, `pinterest`, `pinterest_embed`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', NULL, 'Instagram', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `subcategoryposts`
--

CREATE TABLE `subcategoryposts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `categorypost_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iclass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `iclass`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HTML', 'primary', 'html', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(2, 'CSS', 'secondary', 'css', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(3, 'Javascript', 'success', 'javascript', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(4, 'Bootstrap', 'warning', 'bootstrap', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(5, 'PHP', 'info', 'php', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(6, 'Laravel', 'danger', 'laravel', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(7, 'Livewire', 'primary', 'livewire', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL),
(8, 'Edukasi', 'primary', 'edukasi', '2021-02-06 03:04:49', '2021-02-06 03:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trix_attachments`
--

CREATE TABLE `trix_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_id` int(10) UNSIGNED DEFAULT NULL,
  `attachable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_pending` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trix_rich_texts`
--

CREATE TABLE `trix_rich_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `slug`, `email_verified_at`, `password`, `bio`, `photo`, `status`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Kodir Zaelani', 'kodir.zaelani78@gmail.com', 'kodir-zaelani', '2021-02-06 03:04:48', '$2y$10$EoZGAyKKn1WuyjxVY/z3G.TA4VSa2uzUuF6ZL64aPhwl943LQdsJu', 'Saya merupakan pemilik website www.lamankreasi.com dan mesih jauh dari kemampuan penguasaan teknologi, oleh karena itu maka dibuatlah website ini untuk peningkatan kemampuan secara personal.', NULL, 1, NULL, NULL, 'fYcm9jKNXQ3dRk3p9Znm5MhFkocsYN', NULL, NULL, '2021-02-06 03:04:49', '2021-02-06 03:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fontawesome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menu_items_menu_foreign` (`menu`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `advertisements_slug_unique` (`slug`),
  ADD KEY `advertisements_author_id_foreign` (`author_id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorydownloads`
--
ALTER TABLE `categorydownloads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorydownloads_title_unique` (`title`),
  ADD UNIQUE KEY `categorydownloads_slug_unique` (`slug`),
  ADD KEY `categorydownloads_author_id_foreign` (`author_id`);

--
-- Indexes for table `categorypages`
--
ALTER TABLE `categorypages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorypages_title_unique` (`title`),
  ADD UNIQUE KEY `categorypages_slug_unique` (`slug`);

--
-- Indexes for table `categoryposts`
--
ALTER TABLE `categoryposts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoryposts_title_unique` (`title`),
  ADD UNIQUE KEY `categoryposts_slug_unique` (`slug`),
  ADD KEY `categoryposts_author_id_foreign` (`author_id`);

--
-- Indexes for table `downloadfiles`
--
ALTER TABLE `downloadfiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `downloadfiles_slug_unique` (`slug`),
  ADD KEY `downloadfiles_author_id_foreign` (`author_id`),
  ADD KEY `downloadfiles_categorydownload_id_foreign` (`categorydownload_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `indonesia_cities`
--
ALTER TABLE `indonesia_cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indonesia_cities_province_id_foreign` (`province_id`);

--
-- Indexes for table `indonesia_districts`
--
ALTER TABLE `indonesia_districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indonesia_districts_city_id_foreign` (`city_id`);

--
-- Indexes for table `indonesia_provinces`
--
ALTER TABLE `indonesia_provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indonesia_villages`
--
ALTER TABLE `indonesia_villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indonesia_villages_district_id_foreign` (`district_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_author_id_foreign` (`author_id`),
  ADD KEY `pages_categorypage_id_foreign` (`categorypage_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photos_slug_unique` (`slug`),
  ADD KEY `photos_album_id_foreign` (`album_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_author_id_foreign` (`author_id`),
  ADD KEY `posts_categorypost_id_foreign` (`categorypost_id`),
  ADD KEY `posts_subcategorypost_id_foreign` (`subcategorypost_id`),
  ADD KEY `posts_setarticle_id_foreign` (`setarticle_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setarticles`
--
ALTER TABLE `setarticles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setarticles_slug_unique` (`slug`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_email_unique` (`email`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_author_id_foreign` (`author_id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategoryposts`
--
ALTER TABLE `subcategoryposts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategoryposts_title_unique` (`title`),
  ADD UNIQUE KEY `subcategoryposts_slug_unique` (`slug`),
  ADD KEY `subcategoryposts_author_id_foreign` (`author_id`),
  ADD KEY `subcategoryposts_categorypost_id_foreign` (`categorypost_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `trix_attachments`
--
ALTER TABLE `trix_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trix_rich_texts`
--
ALTER TABLE `trix_rich_texts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trix_rich_texts_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `widgets_slug_unique` (`slug`),
  ADD KEY `widgets_author_id_foreign` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorydownloads`
--
ALTER TABLE `categorydownloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorypages`
--
ALTER TABLE `categorypages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categoryposts`
--
ALTER TABLE `categoryposts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `downloadfiles`
--
ALTER TABLE `downloadfiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setarticles`
--
ALTER TABLE `setarticles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategoryposts`
--
ALTER TABLE `subcategoryposts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trix_attachments`
--
ALTER TABLE `trix_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trix_rich_texts`
--
ALTER TABLE `trix_rich_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD CONSTRAINT `admin_menu_items_menu_foreign` FOREIGN KEY (`menu`) REFERENCES `admin_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `categorydownloads`
--
ALTER TABLE `categorydownloads`
  ADD CONSTRAINT `categorydownloads_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `categoryposts`
--
ALTER TABLE `categoryposts`
  ADD CONSTRAINT `categoryposts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `downloadfiles`
--
ALTER TABLE `downloadfiles`
  ADD CONSTRAINT `downloadfiles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `downloadfiles_categorydownload_id_foreign` FOREIGN KEY (`categorydownload_id`) REFERENCES `categorydownloads` (`id`);

--
-- Constraints for table `indonesia_cities`
--
ALTER TABLE `indonesia_cities`
  ADD CONSTRAINT `indonesia_cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `indonesia_provinces` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `indonesia_districts`
--
ALTER TABLE `indonesia_districts`
  ADD CONSTRAINT `indonesia_districts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `indonesia_cities` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `indonesia_villages`
--
ALTER TABLE `indonesia_villages`
  ADD CONSTRAINT `indonesia_villages_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `indonesia_districts` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_categorypage_id_foreign` FOREIGN KEY (`categorypage_id`) REFERENCES `categorypages` (`id`);

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_categorypost_id_foreign` FOREIGN KEY (`categorypost_id`) REFERENCES `categoryposts` (`id`),
  ADD CONSTRAINT `posts_setarticle_id_foreign` FOREIGN KEY (`setarticle_id`) REFERENCES `setarticles` (`id`),
  ADD CONSTRAINT `posts_subcategorypost_id_foreign` FOREIGN KEY (`subcategorypost_id`) REFERENCES `subcategoryposts` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subcategoryposts`
--
ALTER TABLE `subcategoryposts`
  ADD CONSTRAINT `subcategoryposts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subcategoryposts_categorypost_id_foreign` FOREIGN KEY (`categorypost_id`) REFERENCES `categoryposts` (`id`);

--
-- Constraints for table `widgets`
--
ALTER TABLE `widgets`
  ADD CONSTRAINT `widgets_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
