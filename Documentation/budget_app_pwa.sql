-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 28, 2022 at 04:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget_app_pwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: InActive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `name`, `email`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(3, 3, 'test', 'test2@gmail.com', 'Only providers who do whatever it takes to help you win earn the RamseyTrusted shield. And when it comes to life insurance, this is a company that’s been serving our fans faithfully for over two decades. Seriously—we’d send our moms to them (and most of us have). \nOnly providers who do whatever it takes to help you win earn the RamseyTrusted shield. And when it comes to life insurance, this is a company that’s been serving our fans faithfully for over two decades. Seriously—we’d send our moms to them (and most of us have).\nOnly providers who do whatever it takes to help you win earn the RamseyTrusted shield. And when it comes to life insurance, this is a company that’s been serving our fans faithfully for over two decades. Seriously—we’d send our moms to them (and most of us have).', 0, '2022-01-26 05:33:49', '2022-01-26 05:33:49'),
(4, 3, 'test', 'test2@gmail.com', 'providers who do whatever it takes to help you win earn the RamseyTrusted shield. And when it comes to life insurance, this is a company that’s been serving our fans faithfully for over two decades. Seriously—we’d send our moms to them (and most of us have). \nOnly providers who do whatever it takes to help you win earn the RamseyTrusted shield. And when it comes to life insurance, this is a company that’s been serving our fans faithfully for over two decades. Seriously—we’d send our moms to them (and most of us have).\nOnly providers who do whatever it takes to help you win earn the RamseyTrusted shield. And when it comes to life insurance, this is a company that’s been serving our fans faithfully for over two decades. Seriously—we’d send our moms to them (and most of us have).', 0, '2022-01-26 06:03:02', '2022-01-26 06:03:02');

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
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_10_28_054010_create_mst_parameter_type_table', 1),
(10, '2021_10_28_054914_create_mst_parameter_value_table', 1),
(11, '2021_12_06_044738_create_mst_user_notification_table', 1),
(12, '2021_12_06_045645_create_trn_expense_table', 1),
(13, '2021_12_06_045701_create_trn_income_table', 1),
(14, '2021_12_06_045713_create_mst_group_table', 1),
(15, '2021_12_06_045731_create_trn_revenue_table', 1),
(16, '2021_12_06_045742_create_trn_expense_transaction_table', 1),
(17, '2021_12_06_045754_create_trn_income_transaction_table', 1),
(18, '2021_12_06_045806_create_mst_plan_table', 1),
(19, '2021_12_06_045816_create_mst_plan_features_table', 1),
(20, '2021_12_10_043829_create_mst_plan_features_permission_table', 1),
(21, '2021_12_10_083044_create_mst_learn_table', 1),
(22, '2021_12_11_063913_create_mst_sub_category_table', 1),
(23, '2021_12_14_045152_create_mst_learn_library_table', 1),
(24, '2021_12_30_061217_create_trn_expense_sub_table', 1),
(25, '2021_12_30_061538_create_trn_transaction_log_table', 1),
(28, '2022_01_26_091905_create_contact_us_table', 2),
(29, '2022_01_27_045948_create_content_tags_table', 3),
(30, '2022_01_27_053938_create_page_names_table', 3),
(31, '2022_01_27_054004_create_contents_table', 3),
(32, '2022_01_27_055030_create_pg_content_tags_table', 4),
(33, '2022_01_27_055042_create_pg_page_names_table', 4),
(34, '2022_01_27_055106_create_pg_contents_table', 4),
(35, '2022_01_27_055524_create_pg_content_pages_table', 5),
(36, '2022_01_27_055746_create_pg_contents_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mst_group`
--

CREATE TABLE `mst_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_learn`
--

CREATE TABLE `mst_learn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `learn_library_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_no` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_learn`
--

INSERT INTO `mst_learn` (`id`, `learn_library_id`, `plan_id`, `title`, `description`, `sequence_no`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Start App', 'how to start app', 3, 1, '2022-01-25 00:31:17', '2022-01-25 00:31:17', NULL),
(2, 3, 2, 'second session', 'Second session', 2, 1, '2022-01-25 00:33:58', '2022-01-25 00:33:58', NULL),
(3, 1, 1, 'Staring Session', 'Session start in first app.', 1, 1, '2022-01-25 00:34:45', '2022-01-25 00:34:45', NULL),
(5, 1, 1, 'test', 'working or not', 5, 1, '2022-01-26 03:54:55', '2022-01-26 03:54:55', NULL),
(6, 2, 1, 'check', 'hello its working', 7, 1, '2022-01-26 04:05:09', '2022-01-26 04:05:09', NULL),
(7, 2, 1, 'vishal', 'vishal dubey', 8, 1, '2022-01-26 04:06:08', '2022-01-26 04:06:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_learn_library`
--

CREATE TABLE `mst_learn_library` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_learn_library`
--

INSERT INTO `mst_learn_library` (`id`, `url`, `file_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1643089674_cute_wild_marmots_playing_in_nature_6892278.mp4', 'cute_wild_marmots_playing_in_nature_6892278.mp4', '2022-01-25 00:17:54', NULL, NULL),
(2, '1643089680_videoplayback.mp4', 'videoplayback.mp4', '2022-01-25 00:18:00', NULL, NULL),
(3, '1643089747_videoplayback(1).mp4', 'videoplayback (1).mp4', '2022-01-25 00:19:07', NULL, NULL),
(4, '1643274368_file_example_MP4_480_1_5MG.mp4', 'file_example_MP4_480_1_5MG.mp4', '2022-01-27 03:36:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_parameter_type`
--

CREATE TABLE `mst_parameter_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: InActive',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_parameter_type`
--

INSERT INTO `mst_parameter_type` (`id`, `parameter_type_name`, `is_active`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Expense Category', 1, 'Expense Category', NULL, NULL, NULL),
(2, 'Income Category', 1, 'Expense Category', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_parameter_value`
--

CREATE TABLE `mst_parameter_value` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter_type_id` bigint(20) UNSIGNED NOT NULL,
  `parameter_value_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accepted_values` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_no` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: InActive',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_parameter_value`
--

INSERT INTO `mst_parameter_value` (`id`, `parameter_type_id`, `parameter_value_code`, `parameter_value`, `accepted_values`, `image_link`, `sequence_no`, `is_active`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Giving', 'Giving', 'Giving', NULL, 1, 1, 'Giving', '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(2, 1, 'Savings', 'Savings', 'Savings', NULL, 2, 1, 'Savings', '2021-12-05 18:30:04', '2021-12-05 18:30:04', NULL),
(3, 1, 'Housing', 'Housing', 'Housing', NULL, 3, 1, 'Housing', '2021-12-05 18:30:20', '2021-12-05 18:30:20', NULL),
(4, 1, 'Transportation', 'Transportation', 'Transportation', NULL, 4, 1, 'Transportation', '2021-12-05 18:30:34', '2021-12-05 18:30:34', NULL),
(5, 1, 'Food', 'Food', 'Food', NULL, 5, 1, 'Food', '2021-12-05 18:30:48', '2021-12-05 18:30:48', NULL),
(6, 1, 'Personal', 'Personal', 'Personal', NULL, 6, 1, 'Personal', '2021-12-05 18:31:15', '2021-12-05 18:31:15', NULL),
(7, 1, 'Lifestyle', 'Lifestyle', 'Lifestyle', NULL, 7, 1, 'Lifestyle', '2021-12-05 18:31:30', '2021-12-05 18:31:30', NULL),
(8, 1, 'Health', 'Health', 'Health', NULL, 8, 1, 'Health', '2021-12-05 18:39:32', '2021-12-05 18:46:08', NULL),
(9, 1, 'Insurance', 'Insurance', 'Insurance', NULL, 9, 1, 'Insurance', '2021-12-05 18:39:32', '2021-12-05 18:46:08', NULL),
(10, 1, 'Debt', 'Debt', 'Debt', NULL, 10, 1, 'Debt', '2021-12-05 18:39:32', '2021-12-05 18:46:08', NULL),
(11, 2, 'Paycheck 1', 'Paycheck 1', 'Paycheck 1', NULL, 11, 1, 'Paycheck 1', '2021-12-05 18:39:32', '2021-12-05 18:46:08', NULL),
(12, 2, 'Paycheck 2', 'Paycheck 2', 'Paycheck 2', NULL, 12, 1, 'Paycheck 2', '2021-12-05 18:39:32', '2021-12-05 18:46:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_plan`
--

CREATE TABLE `mst_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` tinyint(4) NOT NULL COMMENT 'Plan in month',
  `amount` double(10,2) NOT NULL,
  `plan_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Free, 2: Paid',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_plan`
--

INSERT INTO `mst_plan` (`id`, `plan_name`, `title`, `description`, `month`, `amount`, `plan_type`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Free Test', 'First Time', 'first user only use', 0, 0.00, 1, 1, '2022-01-25 00:20:34', '2022-01-25 00:20:34', NULL),
(2, 'Paid Plan', 'Existing Plan', 'Existing user can apply', 1, 10.00, 2, 1, '2022-01-25 00:21:41', '2022-01-25 00:21:41', NULL),
(3, 'check', 'test', 'test working or not', 0, 0.00, 1, 1, '2022-01-26 03:53:20', '2022-01-26 03:53:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_plan_features`
--

CREATE TABLE `mst_plan_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `features` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_plan_features_permission`
--

CREATE TABLE `mst_plan_features_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `plan_features_id` bigint(20) UNSIGNED NOT NULL,
  `is_accessible` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_sub_category`
--

CREATE TABLE `mst_sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_sub_category`
--

INSERT INTO `mst_sub_category` (`id`, `category_id`, `sub_category`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Church', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(2, 1, 'Charity', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(3, 2, 'Emergency Fund', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(4, 3, 'Mortgage/Rent', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(5, 3, 'Water', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(6, 3, 'Natural Gas', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(7, 3, 'Electricity', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(8, 3, 'Cable', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(9, 3, 'Trash', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(10, 4, 'Gas', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(11, 4, 'Maintenance', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(12, 5, 'Groceries', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(13, 5, 'Restaurants', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(14, 6, 'Clothing', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(15, 6, 'Phone', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(16, 6, 'Fun Money', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(17, 6, 'Hair/Cosmetics', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(18, 6, 'Subscriptions', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(19, 7, 'Pet Care', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(20, 7, 'Child Care', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(21, 7, 'Entertainment', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(22, 7, 'Miscellaneous', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(23, 8, 'Gym', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(24, 8, 'Medicine/Vitamins', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(25, 8, 'Doctor Visits', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(26, 9, 'Health Insurance', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(27, 9, 'Life Insurance', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(28, 9, 'Auto Insurance', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(29, 9, 'Homeowner/Renter', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(30, 9, 'Identity Theft', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(31, 10, 'Credit Card', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(32, 10, 'Car Payment', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(33, 10, 'Student Loan', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(34, 10, 'Medical Bill', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL),
(35, 10, 'Personal Loan', 1, '2021-12-05 18:29:29', '2021-12-05 18:29:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_notification`
--

CREATE TABLE `mst_user_notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notification_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: Read, 0: Unread',
  `screen_no` int(11) DEFAULT NULL,
  `is_redirect` int(11) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_user_notification`
--

INSERT INTO `mst_user_notification` (`id`, `user_id`, `notification_icon`, `title`, `description`, `is_read`, `screen_no`, `is_redirect`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, NULL, 'New user has been registered.', 'MAIL TEST has just created an account on Laravel.', 0, 1, NULL, 2, '2022-01-25 00:01:01', NULL, NULL),
(2, 3, NULL, 'New user has been registered.', 'User Two has just created an account on Laravel.', 0, 1, NULL, 3, '2022-01-25 00:48:49', NULL, NULL),
(3, 3, NULL, 'User touch us', 'TESTse TETETE Sended a message to Laravel.', 0, 1, NULL, 3, '2022-01-26 06:02:43', NULL, NULL),
(4, 3, NULL, 'User touch us', 'TESTse TETETE Sended a message to Laravel.', 0, 1, NULL, 3, '2022-01-26 06:03:02', NULL, NULL),
(5, 4, NULL, 'New user has been registered.', 'test est has just created an account on Laravel.', 0, 1, NULL, 4, '2022-01-27 00:47:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0381acd5821a195d978dbd0ceee46bdc98c03d70a6a66265218f0ddad0477c511597a79c0a094431', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:58:19', '2022-01-27 02:58:19', '2023-01-27 08:28:19'),
('088dc9c02a0232b34aa69f1a3befa5db30c2453021627dd0addbce4aa1bc1d409a9168e028b0fef6', 1, 1, 'APIToken', '[]', 0, '2022-01-25 03:18:31', '2022-01-25 03:18:31', '2023-01-25 08:48:31'),
('0eaad23a9ce944ec90acb75bcbeb320256ccb0dadd476e4c79b7500783114e198c9ba776edd0132c', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:04:40', '2022-01-27 03:04:40', '2023-01-27 08:34:40'),
('0ef0bf57a63e56f2c7b6d5081037ad092df7c1866b45194cbf6533e4fd48580e20f7e0c8adcfe991', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:11:14', '2022-01-26 05:11:14', '2023-01-26 10:41:14'),
('129e11c8d47c8376c049dab4c175e01f598e84625ab78db0a252590da2925811b8d316be52a13724', 3, 1, 'APIToken', '[]', 0, '2022-01-27 06:17:50', '2022-01-27 06:17:50', '2023-01-27 11:47:50'),
('1370304b3692aabb3fff8610ee935bea8c73de75f29e90b7f6fee07646aca113c57d70cca3a367a6', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:20:19', '2022-01-27 01:20:19', '2023-01-27 06:50:19'),
('1405d84fcbe1a9eaae84f9262bf76a7a2dee38c137c4d506f7043f38cde68f002d6651215a89508d', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:48:38', '2022-01-27 02:48:38', '2023-01-27 08:18:38'),
('141a7c5f418d1452bd26ad47aac95dcc1fa7f0d1d0016f1ac09932329eaaad9763d846c2cf7acfe0', 2, 1, 'APIToken', '[]', 0, '2022-01-25 01:10:09', '2022-01-25 01:10:09', '2023-01-25 06:40:09'),
('149990a7252e5860b6a051f1884a2a35cf32c52400ec6d068eaef73f7f2cfbe3d3862c9f8cffeaf6', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:01:49', '2022-01-26 05:01:49', '2023-01-26 10:31:49'),
('166b7e333a6b756622df18dfcb06bfd8eee180e92b7a304a3bb82dd2526e18203799d29760593ad5', 3, 1, 'APIToken', '[]', 0, '2022-01-27 00:26:43', '2022-01-27 00:26:43', '2023-01-27 05:56:43'),
('1ab1b180ba20bccc5d351e6f84d79bf39140a6f83bf13ffc3465e332bf3b455824d08573d82f2296', 2, 1, 'APIToken', '[]', 0, '2022-01-25 01:09:49', '2022-01-25 01:09:49', '2023-01-25 06:39:49'),
('22449280eb8c86b92dbfacc70164de95c3bae6b5cdac93f24e1fbaaac9a1bc6647ec9490de5e4b4f', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:15:06', '2022-01-27 01:15:06', '2023-01-27 06:45:06'),
('224a0b7f8be4aa63b4dc2d3c8c617694e245378ac9bf54a3a82434309a620b885932956fbd494d53', 1, 1, 'APIToken', '[]', 0, '2022-01-27 06:28:02', '2022-01-27 06:28:02', '2023-01-27 11:58:02'),
('22e4305884f8961e4f7b723d1fb1634c39201657d2df362034095b48e78422be894c71cfcc309ad9', 3, 1, 'APIToken', '[]', 0, '2022-01-26 00:21:27', '2022-01-26 00:21:27', '2023-01-26 05:51:27'),
('26a00b30ded4d7cabfad90c8de77008e0794324f684e4260d983865bcef1b8cf731134f8f6ebb28a', 3, 1, 'APIToken', '[]', 0, '2022-01-27 00:46:34', '2022-01-27 00:46:34', '2023-01-27 06:16:34'),
('2a8225c41338211044e3da17317509bac00d63515d6ffa647b913e03ad9ece862976b0c671f4043f', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:32:25', '2022-01-27 03:32:25', '2023-01-27 09:02:25'),
('2b17df09f2331dc89175bbedd3a174123f981836399e115933da92daa2b0e71f126289ba67d7d1c1', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:12:52', '2022-01-26 05:12:52', '2023-01-26 10:42:52'),
('2c882965465671108d52a8e7636c8d9f429525fcb813831ceaae84f20e4daa68aeb540b3b4f19e4a', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:12:22', '2022-01-26 05:12:22', '2023-01-26 10:42:22'),
('2ede0eaa2e1632b6192c645b89119c4554ab42954d49c54cbf1008fa95faa521a31245b1063a417b', 3, 1, 'APIToken', '[]', 0, '2022-01-27 06:27:13', '2022-01-27 06:27:13', '2023-01-27 11:57:13'),
('30ae42a8017dd769dedec0c2d4f3667620043f30a6bd47283d4913483d5b1c70ab013d72fcdcf0d3', 1, 1, 'APIToken', '[]', 0, '2022-01-27 02:38:39', '2022-01-27 02:38:39', '2023-01-27 08:08:39'),
('310adcb2b75de0e758093e8745475775fa70e7a5e5c81cfc1c037a9bb1e5f1ff6e23c5ab1e4a0fe8', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:31:15', '2022-01-27 03:31:15', '2023-01-27 09:01:15'),
('360f2d003636dd9990b5f44814098d17bc63112c3516d601b7668720d417a663e9983187ecefba2b', 2, 1, 'APIToken', '[]', 0, '2022-01-25 01:13:07', '2022-01-25 01:13:07', '2023-01-25 06:43:07'),
('36ed1865b74feaa6f9a6a8c99b5e78f337984aff8aeb043eedbc6780dd1b0621feb7e35fadd78cfd', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:48:45', '2022-01-27 02:48:45', '2023-01-27 08:18:45'),
('37c7279200a1080ee2a0e6a8e69215b4eb42ca292c277b28a4a1984058e9dc962d9c27fa49a3d150', 3, 1, 'APIToken', '[]', 0, '2022-01-27 04:15:08', '2022-01-27 04:15:08', '2023-01-27 09:45:08'),
('381cedafe1a1a0c60ec06c99a868b69d892646f49ca46e7f886924d8c540a80b8a03f0de0203c8a9', 1, 1, 'APIToken', '[]', 0, '2022-01-27 06:12:46', '2022-01-27 06:12:46', '2023-01-27 11:42:46'),
('38e07f5e0d80ffe9dd9eee472dcd07f3fe086ef7c277bcc28f0223b0f40dd39ed366fef6c1ab1ac8', 3, 1, 'APIToken', '[]', 1, '2022-01-25 06:43:45', '2022-01-25 06:43:45', '2023-01-25 12:13:45'),
('3b790d2e05cbd888d367123b86e0b08f36cf5288a915f479c565c8f01d722b7a132593995ed48b0d', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:55:03', '2022-01-27 02:55:03', '2023-01-27 08:25:03'),
('3cef907b2d7922a71f1287c724f331aa850d5782d30586d22e7c0d87f1eec38eba60aff65c4d2753', 1, 1, 'APIToken', '[]', 0, '2022-01-27 06:26:10', '2022-01-27 06:26:10', '2023-01-27 11:56:10'),
('3d173865ded0cfbc7eb7926309894f92107ab52c84fc529f12f2ad5cec7950a89bd614f6d340dc1c', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:41:01', '2022-01-27 02:41:01', '2023-01-27 08:11:01'),
('3de372947930c6c41eea3971a7bf5ef7975605d3ef061b5800b879a7eb59f6deadc3bc933d69140d', 1, 1, 'APIToken', '[]', 0, '2022-01-25 05:49:40', '2022-01-25 05:49:40', '2023-01-25 11:19:40'),
('4414e9f085785c35e69c85e51e04524e57f5cde2d47311931c1ea7141c0117cd64ceba08bf443451', 3, 1, 'APIToken', '[]', 0, '2022-01-26 00:02:05', '2022-01-26 00:02:05', '2023-01-26 05:32:05'),
('45d513d8a813ea9b4dd742cf0e789811422c95f1326b1e88cec5ad2306bf58a55d0a84d153300886', 1, 1, 'APIToken', '[]', 0, '2022-01-25 06:16:00', '2022-01-25 06:16:00', '2023-01-25 11:46:00'),
('46e47fef2b1c3a3db184071802b7fedb55f045790b67e3f91ab8604dd886c5e8b9b129e21bef8757', 3, 1, 'APIToken', '[]', 1, '2022-01-25 06:42:48', '2022-01-25 06:42:48', '2023-01-25 12:12:48'),
('4b850d468ff127005c81ae6fc9612fbbe3346e5e4cd4d6af81f7b93d5d93e0c69f5100ef92c5ce67', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:43:55', '2022-01-27 02:43:55', '2023-01-27 08:13:55'),
('4c277e451aba90962e70d6d32554d7d9b2f783caaa2e1a5e557422fc0667e6c5b31df8d0d88e04c0', 3, 1, 'APIToken', '[]', 0, '2022-01-27 00:25:14', '2022-01-27 00:25:14', '2023-01-27 05:55:14'),
('4f0190af28a1e1ec05c95de6d1c0bf36d39fb6be939bdb95c4eae5b7501987c772beeb24f74f475e', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:59:16', '2022-01-27 01:59:16', '2023-01-27 07:29:16'),
('50be517306c720b8ce0b66ac0f1b264266d7bb8d50cbfc39ed2beef5495e130bce225873f723b713', 1, 1, 'APIToken', '[]', 0, '2022-01-27 00:32:01', '2022-01-27 00:32:01', '2023-01-27 06:02:01'),
('5101514a594e4653717adf2015d71f7a81ef8ab779db50233af763711a76dc7c677a13a207e660b5', 1, 1, 'APIToken', '[]', 0, '2022-01-26 22:56:10', '2022-01-26 22:56:10', '2023-01-27 04:26:10'),
('544a8df0a98f47913f6602797aaff499b083a101ab485fd882997d795d4c65cf4fa977e62e831fbe', 3, 1, 'APIToken', '[]', 0, '2022-01-26 02:40:12', '2022-01-26 02:40:12', '2023-01-26 08:10:12'),
('566c1ebd6648fc0c6749c3ca9e31d9f13ee9e1418e0e57fc007b8f2b29da1070bb0758b6e10e77c4', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:48:43', '2022-01-27 02:48:43', '2023-01-27 08:18:43'),
('5b25ce59c09f41f3eab1171f66743d5708c0fed2c5d8bf5ed28a5412856d250d930747af5639a9b7', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:44:51', '2022-01-27 02:44:51', '2023-01-27 08:14:51'),
('6075adf176a94877a7329b098285a4486067dd1cf56349aa0840d69fd1301404a0f948d213758ca3', 3, 1, 'APIToken', '[]', 0, '2022-01-25 00:55:06', '2022-01-25 00:55:06', '2023-01-25 06:25:06'),
('610ab552e62f043cf35d76f11190b7c657f4b8a3799b4dd381d13baa8df19d5aa817ed494134c134', 3, 1, 'APIToken', '[]', 0, '2022-01-26 07:14:38', '2022-01-26 07:14:38', '2023-01-26 12:44:38'),
('62111dafd6617e5382d52a2ebda910ee15e4579f22d1ac2ce133cf04b62729ee4ad0687a1f809c9a', 1, 1, 'APIToken', '[]', 0, '2022-01-26 22:23:06', '2022-01-26 22:23:06', '2023-01-27 03:53:06'),
('647977dd781e502e02df00da96ca30fc5dfbbd9de4199d4337b65074506a99d23f52758ef1713ab7', 3, 1, 'APIToken', '[]', 0, '2022-01-26 04:15:21', '2022-01-26 04:15:21', '2023-01-26 09:45:21'),
('6b09870cdf185c750c5d6393b84800dd80f897659bcceb97aceb0b6b7e33b5ee6d16bafead75ea65', 3, 1, 'APIToken', '[]', 0, '2022-01-27 00:25:45', '2022-01-27 00:25:45', '2023-01-27 05:55:45'),
('75c40a53039624143b1e4b4ef526591a1101e58af1f15b41217df18c7be9cae5d4f1d76a2aae0192', 1, 1, 'APIToken', '[]', 0, '2022-01-27 03:22:04', '2022-01-27 03:22:04', '2023-01-27 08:52:04'),
('790e29037ec1f507a1002f8f6d011b635a982d7a454b4c4f67b72f2fbee6ee2942361a47439de3a1', 1, 1, 'APIToken', '[]', 0, '2022-01-27 06:23:12', '2022-01-27 06:23:12', '2023-01-27 11:53:12'),
('797915d9eef8b3b6cda68bc4f714acf7853f93f6cf83e530600f16da16ade5a35af025d9cf0df2d5', 2, 1, 'APIToken', '[]', 0, '2022-01-25 00:29:55', '2022-01-25 00:29:55', '2023-01-25 05:59:55'),
('7c0259b5bf308c465d5962bd78cd7f311a5f1c1f3cd98f7560a120bccbbdbfdbc346641b6b69adcf', 3, 1, 'APIToken', '[]', 0, '2022-01-26 22:24:47', '2022-01-26 22:24:47', '2023-01-27 03:54:47'),
('7de3a56ba75369572a568851d731efb62a54b9b5d1faa3dc70cdda10abe3836e03baf0208d99d967', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:17:40', '2022-01-27 01:17:40', '2023-01-27 06:47:40'),
('8167d59b80f0f6955a452955a39e583c5947660861fe63ecd5cfb267fcf3e7ac08a91c120e604850', 1, 1, 'APIToken', '[]', 0, '2022-01-25 00:25:39', '2022-01-25 00:25:39', '2023-01-25 05:55:39'),
('8995fe0b7fa3554d4edae97c3d5cd9525c6b9b66ecf41a62bb416c9253dca38db182b69f408ddc8e', 3, 1, 'APIToken', '[]', 0, '2022-01-26 07:15:39', '2022-01-26 07:15:39', '2023-01-26 12:45:39'),
('8a9bab26e95ad814de94d92459de36016cd158bf3ac3a37e864c5d00aa8149efd98bb78e76e899e7', 1, 1, 'APIToken', '[]', 0, '2022-01-24 23:58:27', '2022-01-24 23:58:27', '2023-01-25 05:28:27'),
('8c8725ae2ae4bd2e8e7a2bad4b2f33702779daf538aff796bd31a422b18d12498088ed2fb46d7543', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:19:44', '2022-01-27 03:19:44', '2023-01-27 08:49:44'),
('8c8cd57128075f6828169bd76b09e916645d2a0ea3eb043b92e7ca00e3592ec074e3ddb75cb5bb96', 1, 1, 'APIToken', '[]', 0, '2022-01-26 00:19:07', '2022-01-26 00:19:07', '2023-01-26 05:49:07'),
('8cee9bee52da168e82bb7aa052b73602b5f3366736309f602466fa80141ccc00d583390af6f30a9c', 3, 1, 'APIToken', '[]', 0, '2022-01-26 22:24:24', '2022-01-26 22:24:24', '2023-01-27 03:54:24'),
('92fdbdc4939314a788e1ed4827b338bebc93dd45f60cc01090a7d3239bb33e5198dc47c99eb4bd30', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:14:08', '2022-01-26 05:14:08', '2023-01-26 10:44:08'),
('94a4606577f274d2c3d53016577507d94ae086b403f7c0462f496a4dfe6e604151f6e56c2624d7c4', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:32:55', '2022-01-27 03:32:55', '2023-01-27 09:02:55'),
('9a6dc21322b0305009fda8d9445ca12872a36a02f18448bc56985f0c83148ea7b36707220676d740', 3, 1, 'APIToken', '[]', 0, '2022-01-25 00:56:21', '2022-01-25 00:56:21', '2023-01-25 06:26:21'),
('9b969080f6bf7abb0d561397f0861e35f2ad5aa004389ae08def1cbb1903c0f9e790e3a138cbc58c', 1, 1, 'APIToken', '[]', 0, '2022-01-26 02:34:18', '2022-01-26 02:34:18', '2023-01-26 08:04:18'),
('9d70fe01985bca01e9fb62ef8f9318ed46c78b9f7e066512ac4d177a45a5efeb61267dd6a126953c', 2, 1, 'APIToken', '[]', 0, '2022-01-25 00:15:28', '2022-01-25 00:15:28', '2023-01-25 05:45:28'),
('9dc60e2d6d81a9aaa25d3dface9e29d3490618407561a54f6c6ddc066a6294e563edc0163bb971d2', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:55:37', '2022-01-27 02:55:37', '2023-01-27 08:25:37'),
('a0b59febce3096147cf9d317982815d76cc40f053d4c73bc52664bb0206d341ca26fff5072d3dade', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:20:10', '2022-01-27 03:20:10', '2023-01-27 08:50:10'),
('a1adabd0fb34ffa4ba70a7fa21390df0a56d952699f4b8db2cec1f5022529a9d108f24dcbac8a1ab', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:21:27', '2022-01-27 03:21:27', '2023-01-27 08:51:27'),
('a6288377aef39b44458df4606a8c755c3265f11fb7a9c80a7f6a99e1b1f9488f81fe990892b4b825', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:35:22', '2022-01-27 02:35:22', '2023-01-27 08:05:22'),
('a7224682faf37098c7e03788d3fef345dacf57ea4f905aa362f5b28b7161de68a5437d8d835553b8', 3, 1, 'APIToken', '[]', 0, '2022-01-25 05:10:00', '2022-01-25 05:10:00', '2023-01-25 10:40:00'),
('a8fe9444fee698aba1c0355a155d64d2c29155cbb0aa9bbcdacd76065e44384f2c56d4c6f8994da9', 3, 1, 'APIToken', '[]', 1, '2022-01-25 06:44:44', '2022-01-25 06:44:44', '2023-01-25 12:14:44'),
('a939b0c92330ce72cbaa1093c4dde30d1dca8ef8c764cd1f1270627fceaf19dcda541e9fcdab0d62', 1, 1, 'APIToken', '[]', 0, '2022-01-27 04:52:13', '2022-01-27 04:52:13', '2023-01-27 10:22:13'),
('aa4cc0548f719ef09e9620cd7c0249eff59c2f7a06354b1f947dcf7b30a5ec1652d4e4856395a874', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:29:58', '2022-01-26 05:29:58', '2023-01-26 10:59:58'),
('ab6758187485a5812e1af6b137a30e1f93298f66468c40a3ffee238b12815acd1ebd3474f2da83ea', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:49:53', '2022-01-27 02:49:53', '2023-01-27 08:19:53'),
('ae9362d8c2080df29d33a98dd44ec3fd0d4cf2deeb8716c2d9366f66c80676b13b98963bcf85692e', 3, 1, 'APIToken', '[]', 0, '2022-01-26 04:32:20', '2022-01-26 04:32:20', '2023-01-26 10:02:20'),
('b1f79664548d06d145d365a25561c313c53c33e508c825b1f6767936acc45b20736501adc31b8539', 1, 1, 'APIToken', '[]', 0, '2022-01-27 01:25:19', '2022-01-27 01:25:19', '2023-01-27 06:55:19'),
('b39e8919053fdf5dbc4abd254b0946f125078789816a6107c93f83fbf0fc58fe1ff5e52bcaca12d9', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:16:43', '2022-01-27 01:16:43', '2023-01-27 06:46:43'),
('b65bd1a06ad2f1cc0f06c1f8fed99c237d96ad172ce3ee1a02065964d8f0553da3d009d34441cbf4', 3, 1, 'APIToken', '[]', 0, '2022-01-26 06:14:05', '2022-01-26 06:14:05', '2023-01-26 11:44:05'),
('bc6ac7a59dbed45b7e200e12784b830d5e33f5f0426596ad219b3bad779f2b6df566a285c441925c', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:48:50', '2022-01-27 02:48:50', '2023-01-27 08:18:50'),
('bfd1c7135e95bca7d38e0e83391b016778aa7cc65b64657673bcc4a87c0084da63bedcb171db4be3', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:48:44', '2022-01-27 02:48:44', '2023-01-27 08:18:44'),
('c23cfe48764c85c1323345943dc096f286bfd4c2985177dce1506358bc76c47d8f58aff1b73fc311', 3, 1, 'APIToken', '[]', 0, '2022-01-27 00:27:50', '2022-01-27 00:27:50', '2023-01-27 05:57:50'),
('ccd17e92b6468326f333083e406148ffc54efedbca30e124693b750ce83347a96faa6b2a67a06574', 1, 1, 'APIToken', '[]', 0, '2022-01-27 02:42:47', '2022-01-27 02:42:47', '2023-01-27 08:12:47'),
('d0b3381aaf96105820c0ed74578ef625eae0436ac9c18f483d77b64ed005e54b28aaa4027ae86d7b', 1, 1, 'APIToken', '[]', 0, '2022-01-26 04:22:07', '2022-01-26 04:22:07', '2023-01-26 09:52:07'),
('d17986abb2152c8e34e0ea1f9fcba705de39422f588fc856d9919701a062092d8ee12b32fefc7ca1', 3, 1, 'APIToken', '[]', 0, '2022-01-26 02:55:42', '2022-01-26 02:55:42', '2023-01-26 08:25:42'),
('d263409ba3ab6515ad8dbaaf692a5ef20387e8fc01a56217946805cf0607eeeb87d4339a778a4dc9', 3, 1, 'APIToken', '[]', 0, '2022-01-25 03:18:57', '2022-01-25 03:18:57', '2023-01-25 08:48:57'),
('d3415592f6590450115a427311a3360914b0aa77ce8a978b74842c41662ec7906ad8b8fd9d220ab7', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:12:54', '2022-01-27 03:12:54', '2023-01-27 08:42:54'),
('d3eee1c8816e787828fecf16e9476c6efc32dddaeb563acff88bd4b673a342548de420d4f151ab4e', 1, 1, 'APIToken', '[]', 0, '2022-01-27 03:02:26', '2022-01-27 03:02:26', '2023-01-27 08:32:26'),
('d5aa2796714f56c0c2d453840eec816564f099b204681be9a8f3530e5da2a2ee148f77c24a6d54d0', 3, 1, 'APIToken', '[]', 0, '2022-01-27 04:00:06', '2022-01-27 04:00:06', '2023-01-27 09:30:06'),
('d805238982fbaeca4a05b1a14ca321d844f38cc3744039c915b9f52a4acdaece4ebfdb19c78ac3e3', 3, 1, 'APIToken', '[]', 0, '2022-01-27 04:15:47', '2022-01-27 04:15:47', '2023-01-27 09:45:47'),
('d956239c44a0f99a0941873eba385b43cafb25dd59ede52b3dce5ff95cb4ebaac740ebabbac2af50', 1, 1, 'APIToken', '[]', 0, '2022-01-25 23:39:22', '2022-01-25 23:39:22', '2023-01-26 05:09:22'),
('da3326f1bd856b258cebc30384c28134c1bfe0b1ec24076c05b46b63a269747bbc09d9ec905d32c6', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:28:46', '2022-01-27 03:28:46', '2023-01-27 08:58:46'),
('da84c94cac3c3a95f57a5cccbad711cf33ef72a3daf4bf057add9d1d00d577f256660f1a8ef0fb1f', 1, 1, 'APIToken', '[]', 0, '2022-01-26 04:38:37', '2022-01-26 04:38:37', '2023-01-26 10:08:37'),
('db6e51c0e1d7f6aad63323770b8dab383b3279524aa383148b97156d79a4af4519d704aa34a65acd', 1, 1, 'APIToken', '[]', 0, '2022-01-27 03:33:17', '2022-01-27 03:33:17', '2023-01-27 09:03:17'),
('df117b934437f604ec053cbcf859397c5e2fc7e37349dc572ebbfae8108ce68662e41ee9c99d29fe', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:13:41', '2022-01-27 01:13:41', '2023-01-27 06:43:41'),
('e1d58f58c2566c0f301d5f0dd5948f6095fb4b293187671387f18f14acd6c0598e5c4c4fd401f769', 3, 1, 'APIToken', '[]', 0, '2022-01-25 23:59:27', '2022-01-25 23:59:27', '2023-01-26 05:29:27'),
('e358fa04f8e53a7089887b75fab5863b4b6df857cb2b9e54398b8888746740cb9531a5327a7f127b', 3, 1, 'APIToken', '[]', 0, '2022-01-26 04:31:08', '2022-01-26 04:31:08', '2023-01-26 10:01:08'),
('e6aa7bf33818d361a8ba7881876a3bd97a64f4bd583b442639aa54821535f5710ed98edf03c25d28', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:19:37', '2022-01-27 01:19:37', '2023-01-27 06:49:37'),
('e7b0b3d7506f82c2799ac52a45afeed6f26eb9fc063246054427538426f89dc321cba53db9477a78', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:51:08', '2022-01-27 02:51:08', '2023-01-27 08:21:08'),
('ee43122dcf75e4b05e5c4ae5f65d239565bd13f3e658f52a3ae981e0bbd42ab86641b2d23741fe7b', 3, 1, 'APIToken', '[]', 0, '2022-01-26 06:54:59', '2022-01-26 06:54:59', '2023-01-26 12:24:59'),
('ee5abed7386349f29954b8993416e76510a89d6757b7af0c3547ba98c958ddd9b4bd2f7c5d124c7f', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:06:46', '2022-01-27 03:06:46', '2023-01-27 08:36:46'),
('ef240a0c332952302aa5bf4e2919c348c9097f1904d6cff281064b143975b243598c2a7ede8c84c2', 1, 1, 'APIToken', '[]', 0, '2022-01-27 01:58:23', '2022-01-27 01:58:23', '2023-01-27 07:28:23'),
('f500ab4a653891f287237f5ee28a982e18092dcc6f52950182231228346ef4f15a8530201e26749e', 3, 1, 'APIToken', '[]', 1, '2022-01-25 01:15:18', '2022-01-25 01:15:18', '2023-01-25 06:45:18'),
('f82872ae4ab550225683d3c7f65d18e44b4890838588605576b74b79eda32b0a40f0591be0509de9', 3, 1, 'APIToken', '[]', 0, '2022-01-27 03:20:55', '2022-01-27 03:20:55', '2023-01-27 08:50:55'),
('f8a82337cd920127ade1abda7a8b77bcb0e700b342152781d5e34449fe7a008a7dd645408e8b0b2b', 3, 1, 'APIToken', '[]', 0, '2022-01-26 06:51:12', '2022-01-26 06:51:12', '2023-01-26 12:21:12'),
('fc16a11c818989afe0117cc2a9fd61a881b8347e5a87275292607cf990d715b124e0bb9c1f48f4cb', 3, 1, 'APIToken', '[]', 0, '2022-01-26 05:24:59', '2022-01-26 05:24:59', '2023-01-26 10:54:59'),
('fc39ffedaae69a7a663872c1c55d3ac0db53b41bc08845c15f0a7b5b6f3ac7fbffce7c555baae783', 3, 1, 'APIToken', '[]', 0, '2022-01-27 01:12:13', '2022-01-27 01:12:13', '2023-01-27 06:42:13'),
('fecd17c1dbfa63f8598e9f27e103ecb0f35d9c4de733dd94b79c4e11a316eb8c2517db2278d859d0', 3, 1, 'APIToken', '[]', 0, '2022-01-27 02:51:56', '2022-01-27 02:51:56', '2023-01-27 08:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'ABmC2y4uFw459QHINxxNVhJstSp4ctqHpQ0I7SBz', NULL, 'http://localhost', 1, 0, 0, '2022-01-24 23:55:25', '2022-01-24 23:55:25'),
(2, NULL, 'Laravel Password Grant Client', '9q0HqKifwjrfnVvOROTjk5dUf78kUUvxncAwZKEQ', 'users', 'http://localhost', 0, 1, 0, '2022-01-24 23:55:25', '2022-01-24 23:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-01-24 23:55:25', '2022-01-24 23:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `pg_contents`
--

CREATE TABLE `pg_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sequence_no` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other' COMMENT 'image: image, content: content, other:other',
  `tag_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pg_contents`
--

INSERT INTO `pg_contents` (`id`, `is_active`, `sequence_no`, `type`, `tag_name`, `page_name`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'test', 'test', 'test', 'test', '2022-01-27 07:38:46', '2022-01-27 07:38:46'),
(3, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:38:56', '2022-01-27 07:38:56'),
(4, 1, 2, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:39:00', '2022-01-27 07:39:00'),
(5, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:39:04', '2022-01-27 07:39:04'),
(6, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:39:34', '2022-01-27 07:39:34'),
(7, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:42:50', '2022-01-27 07:42:50'),
(8, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:43:18', '2022-01-27 07:43:18'),
(9, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:43:21', '2022-01-27 07:43:21'),
(10, 1, 1, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:43:21', '2022-01-27 07:43:21'),
(11, 1, 3, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:44:18', '2022-01-27 07:44:18'),
(12, 1, 4, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:45:21', '2022-01-27 07:45:21'),
(13, 1, 6, 'test', 'test', 'test', 'testdsds', '2022-01-27 07:46:35', '2022-01-27 07:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `pg_content_pages`
--

CREATE TABLE `pg_content_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pg_content_pages`
--

INSERT INTO `pg_content_pages` (`id`, `is_active`, `page_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'about', '2021-12-05 18:29:29', '2021-12-05 18:29:29'),
(2, 1, 'contact_us', '2021-12-05 18:29:29', '2021-12-05 18:29:29'),
(3, 1, 'test', '2022-01-27 07:26:46', '2022-01-27 07:26:46'),
(4, 1, 'test', '2022-01-27 07:33:11', '2022-01-27 07:33:11'),
(5, 1, 'test', '2022-01-27 07:33:18', '2022-01-27 07:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `pg_content_tags`
--

CREATE TABLE `pg_content_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `tag_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pg_content_tags`
--

INSERT INTO `pg_content_tags` (`id`, `is_active`, `tag_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'about', '2021-12-05 18:29:29', '2021-12-05 18:29:29'),
(2, 1, 'contact_us', '2021-12-05 18:29:29', '2021-12-05 18:29:29'),
(10, 1, 'Menu', '2022-01-27 06:41:28', '2022-01-27 07:19:24'),
(11, 1, 'test1254', '2022-01-27 06:42:49', '2022-01-27 06:42:49'),
(12, 1, 'best', '2022-01-27 06:47:19', '2022-01-27 06:47:19'),
(13, 1, 'test1', '2022-01-27 07:06:15', '2022-01-27 07:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `trn_expense`
--

CREATE TABLE `trn_expense` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Expense, 2: Group',
  `expense_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trn_expense`
--

INSERT INTO `trn_expense` (`id`, `user_id`, `type`, `expense_name`, `sequence_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Giving', 0, '2022-01-25 00:01:00', NULL, NULL),
(2, 2, 1, 'Savings', 1, '2022-01-25 00:01:00', NULL, NULL),
(3, 2, 1, 'Housing', 2, '2022-01-25 00:01:00', NULL, NULL),
(4, 2, 1, 'Transportation', 3, '2022-01-25 00:01:00', NULL, NULL),
(5, 2, 1, 'Food', 4, '2022-01-25 00:01:00', NULL, NULL),
(6, 2, 1, 'Personal', 5, '2022-01-25 00:01:00', NULL, NULL),
(7, 2, 1, 'Lifestyle', 6, '2022-01-25 00:01:00', NULL, NULL),
(8, 2, 1, 'Health', 7, '2022-01-25 00:01:00', NULL, NULL),
(9, 2, 1, 'Insurance', 8, '2022-01-25 00:01:01', NULL, NULL),
(10, 2, 1, 'Debt', 9, '2022-01-25 00:01:01', NULL, NULL),
(11, 3, 1, 'Giving', 0, '2022-01-25 00:48:49', NULL, NULL),
(12, 3, 1, 'Savings', 1, '2022-01-25 00:48:49', NULL, NULL),
(13, 3, 1, 'Housing', 2, '2022-01-25 00:48:49', NULL, NULL),
(14, 3, 1, 'Transportation', 3, '2022-01-25 00:48:49', NULL, NULL),
(15, 3, 1, 'Food', 4, '2022-01-25 00:48:49', NULL, NULL),
(16, 3, 1, 'Personal', 5, '2022-01-25 00:48:49', NULL, NULL),
(17, 3, 1, 'Lifestyle', 6, '2022-01-25 00:48:49', NULL, NULL),
(18, 3, 1, 'Health', 7, '2022-01-25 00:48:49', NULL, NULL),
(19, 3, 1, 'Insurance', 8, '2022-01-25 00:48:49', NULL, NULL),
(20, 3, 1, 'Debt', 9, '2022-01-25 00:48:49', NULL, NULL),
(21, 4, 1, 'Giving', 0, '2022-01-27 00:47:19', NULL, NULL),
(22, 4, 1, 'Savings', 1, '2022-01-27 00:47:19', NULL, NULL),
(23, 4, 1, 'Housing', 2, '2022-01-27 00:47:19', NULL, NULL),
(24, 4, 1, 'Transportation', 3, '2022-01-27 00:47:19', NULL, NULL),
(25, 4, 1, 'Food', 4, '2022-01-27 00:47:19', NULL, NULL),
(26, 4, 1, 'Personal', 5, '2022-01-27 00:47:19', NULL, NULL),
(27, 4, 1, 'Lifestyle', 6, '2022-01-27 00:47:19', NULL, NULL),
(28, 4, 1, 'Health', 7, '2022-01-27 00:47:19', NULL, NULL),
(29, 4, 1, 'Insurance', 8, '2022-01-27 00:47:19', NULL, NULL),
(30, 4, 1, 'Debt', 9, '2022-01-27 00:47:19', NULL, NULL),
(31, 3, 2, 'Untitled', 10, '2022-01-27 04:39:37', NULL, NULL),
(32, 3, 2, 'Untitled', 11, '2022-01-27 04:39:39', NULL, NULL),
(33, 3, 2, 'Untitled', 12, '2022-01-27 04:39:41', NULL, NULL),
(34, 3, 2, 'Untitled', 13, '2022-01-27 04:39:42', NULL, NULL),
(35, 3, 2, 'Untitled', 14, '2022-01-27 04:39:53', NULL, NULL),
(36, 3, 2, 'Untitled', 15, '2022-01-27 04:39:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trn_expense_sub`
--

CREATE TABLE `trn_expense_sub` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expense_id` bigint(20) UNSIGNED NOT NULL,
  `sub_expense_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planned_amount` double(10,2) NOT NULL,
  `is_favorite` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: Favorite, 0: Not Favorite',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trn_expense_sub`
--

INSERT INTO `trn_expense_sub` (`id`, `user_id`, `expense_id`, `sub_expense_name`, `planned_amount`, `is_favorite`, `note`, `sequence_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Church', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(2, 2, 1, 'Charity', 0.00, 0, NULL, 1, '2022-01-25 00:01:00', NULL, NULL),
(3, 2, 2, 'Emergency Fund', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(4, 2, 3, 'Mortgage/Rent', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(5, 2, 3, 'Water', 0.00, 0, NULL, 1, '2022-01-25 00:01:00', NULL, NULL),
(6, 2, 3, 'Natural Gas', 0.00, 0, NULL, 2, '2022-01-25 00:01:00', NULL, NULL),
(7, 2, 3, 'Electricity', 0.00, 0, NULL, 3, '2022-01-25 00:01:00', NULL, NULL),
(8, 2, 3, 'Cable', 0.00, 0, NULL, 4, '2022-01-25 00:01:00', NULL, NULL),
(9, 2, 3, 'Trash', 0.00, 0, NULL, 5, '2022-01-25 00:01:00', NULL, NULL),
(10, 2, 4, 'Gas', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(11, 2, 4, 'Maintenance', 0.00, 0, NULL, 1, '2022-01-25 00:01:00', NULL, NULL),
(12, 2, 5, 'Groceries', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(13, 2, 5, 'Restaurants', 0.00, 0, NULL, 1, '2022-01-25 00:01:00', NULL, NULL),
(14, 2, 6, 'Clothing', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(15, 2, 6, 'Phone', 0.00, 0, NULL, 1, '2022-01-25 00:01:00', NULL, NULL),
(16, 2, 6, 'Fun Money', 0.00, 0, NULL, 2, '2022-01-25 00:01:00', NULL, NULL),
(17, 2, 6, 'Hair/Cosmetics', 0.00, 0, NULL, 3, '2022-01-25 00:01:00', NULL, NULL),
(18, 2, 6, 'Subscriptions', 0.00, 0, NULL, 4, '2022-01-25 00:01:00', NULL, NULL),
(19, 2, 7, 'Pet Care', 0.00, 0, NULL, 0, '2022-01-25 00:01:00', NULL, NULL),
(20, 2, 7, 'Child Care', 0.00, 0, NULL, 1, '2022-01-25 00:01:00', NULL, NULL),
(21, 2, 7, 'Entertainment', 0.00, 0, NULL, 2, '2022-01-25 00:01:00', NULL, NULL),
(22, 2, 7, 'Miscellaneous', 0.00, 0, NULL, 3, '2022-01-25 00:01:00', NULL, NULL),
(23, 2, 8, 'Gym', 0.00, 0, NULL, 0, '2022-01-25 00:01:01', NULL, NULL),
(24, 2, 8, 'Medicine/Vitamins', 0.00, 0, NULL, 1, '2022-01-25 00:01:01', NULL, NULL),
(25, 2, 8, 'Doctor Visits', 0.00, 0, NULL, 2, '2022-01-25 00:01:01', NULL, NULL),
(26, 2, 9, 'Health Insurance', 0.00, 0, NULL, 0, '2022-01-25 00:01:01', NULL, NULL),
(27, 2, 9, 'Life Insurance', 0.00, 0, NULL, 1, '2022-01-25 00:01:01', NULL, NULL),
(28, 2, 9, 'Auto Insurance', 0.00, 0, NULL, 2, '2022-01-25 00:01:01', NULL, NULL),
(29, 2, 9, 'Homeowner/Renter', 0.00, 0, NULL, 3, '2022-01-25 00:01:01', NULL, NULL),
(30, 2, 9, 'Identity Theft', 0.00, 0, NULL, 4, '2022-01-25 00:01:01', NULL, NULL),
(31, 2, 10, 'Credit Card', 0.00, 0, NULL, 0, '2022-01-25 00:01:01', NULL, NULL),
(32, 2, 10, 'Car Payment', 0.00, 0, NULL, 1, '2022-01-25 00:01:01', NULL, NULL),
(33, 2, 10, 'Student Loan', 0.00, 0, NULL, 2, '2022-01-25 00:01:01', NULL, NULL),
(34, 2, 10, 'Medical Bill', 0.00, 0, NULL, 3, '2022-01-25 00:01:01', NULL, NULL),
(35, 2, 10, 'Personal Loan', 0.00, 0, NULL, 4, '2022-01-25 00:01:01', NULL, NULL),
(36, 3, 11, 'Church', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(37, 3, 11, 'Charity', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(38, 3, 12, 'Emergency Fund', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(39, 3, 13, 'Mortgage/Rent', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(40, 3, 13, 'Water', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(41, 3, 13, 'Natural Gas', 0.00, 0, NULL, 2, '2022-01-25 00:48:49', NULL, NULL),
(42, 3, 13, 'Electricity', 0.00, 0, NULL, 3, '2022-01-25 00:48:49', NULL, NULL),
(43, 3, 13, 'Cable', 0.00, 0, NULL, 4, '2022-01-25 00:48:49', NULL, NULL),
(44, 3, 13, 'Trash', 0.00, 0, NULL, 5, '2022-01-25 00:48:49', NULL, NULL),
(45, 3, 14, 'Gas', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(46, 3, 14, 'Maintenance', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(47, 3, 15, 'Groceries', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(48, 3, 15, 'Restaurants', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(49, 3, 16, 'Clothing', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(50, 3, 16, 'Phone', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(51, 3, 16, 'Fun Money', 0.00, 0, NULL, 2, '2022-01-25 00:48:49', NULL, NULL),
(52, 3, 16, 'Hair/Cosmetics', 0.00, 0, NULL, 3, '2022-01-25 00:48:49', NULL, NULL),
(53, 3, 16, 'Subscriptions', 0.00, 0, NULL, 4, '2022-01-25 00:48:49', NULL, NULL),
(54, 3, 17, 'Pet Care', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(55, 3, 17, 'Child Care', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(56, 3, 17, 'Entertainment', 0.00, 0, NULL, 2, '2022-01-25 00:48:49', NULL, NULL),
(57, 3, 17, 'Miscellaneous', 0.00, 0, NULL, 3, '2022-01-25 00:48:49', NULL, NULL),
(58, 3, 18, 'Gym', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(59, 3, 18, 'Medicine/Vitamins', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(60, 3, 18, 'Doctor Visits', 0.00, 0, NULL, 2, '2022-01-25 00:48:49', NULL, NULL),
(61, 3, 19, 'Health Insurance', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(62, 3, 19, 'Life Insurance', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(63, 3, 19, 'Auto Insurance', 0.00, 0, NULL, 2, '2022-01-25 00:48:49', NULL, NULL),
(64, 3, 19, 'Homeowner/Renter', 0.00, 0, NULL, 3, '2022-01-25 00:48:49', NULL, NULL),
(65, 3, 19, 'Identity Theft', 0.00, 0, NULL, 4, '2022-01-25 00:48:49', NULL, NULL),
(66, 3, 20, 'Credit Card', 0.00, 0, NULL, 0, '2022-01-25 00:48:49', NULL, NULL),
(67, 3, 20, 'Car Payment', 0.00, 0, NULL, 1, '2022-01-25 00:48:49', NULL, NULL),
(68, 3, 20, 'Student Loan', 0.00, 0, NULL, 2, '2022-01-25 00:48:49', NULL, NULL),
(69, 3, 20, 'Medical Bill', 0.00, 0, NULL, 3, '2022-01-25 00:48:49', NULL, NULL),
(70, 3, 20, 'Personal Loan', 0.00, 0, NULL, 4, '2022-01-25 00:48:49', NULL, NULL),
(71, 4, 21, 'Church', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(72, 4, 21, 'Charity', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(73, 4, 22, 'Emergency Fund', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(74, 4, 23, 'Mortgage/Rent', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(75, 4, 23, 'Water', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(76, 4, 23, 'Natural Gas', 0.00, 0, NULL, 2, '2022-01-27 00:47:19', NULL, NULL),
(77, 4, 23, 'Electricity', 0.00, 0, NULL, 3, '2022-01-27 00:47:19', NULL, NULL),
(78, 4, 23, 'Cable', 0.00, 0, NULL, 4, '2022-01-27 00:47:19', NULL, NULL),
(79, 4, 23, 'Trash', 0.00, 0, NULL, 5, '2022-01-27 00:47:19', NULL, NULL),
(80, 4, 24, 'Gas', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(81, 4, 24, 'Maintenance', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(82, 4, 25, 'Groceries', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(83, 4, 25, 'Restaurants', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(84, 4, 26, 'Clothing', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(85, 4, 26, 'Phone', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(86, 4, 26, 'Fun Money', 0.00, 0, NULL, 2, '2022-01-27 00:47:19', NULL, NULL),
(87, 4, 26, 'Hair/Cosmetics', 0.00, 0, NULL, 3, '2022-01-27 00:47:19', NULL, NULL),
(88, 4, 26, 'Subscriptions', 0.00, 0, NULL, 4, '2022-01-27 00:47:19', NULL, NULL),
(89, 4, 27, 'Pet Care', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(90, 4, 27, 'Child Care', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(91, 4, 27, 'Entertainment', 0.00, 0, NULL, 2, '2022-01-27 00:47:19', NULL, NULL),
(92, 4, 27, 'Miscellaneous', 0.00, 0, NULL, 3, '2022-01-27 00:47:19', NULL, NULL),
(93, 4, 28, 'Gym', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(94, 4, 28, 'Medicine/Vitamins', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(95, 4, 28, 'Doctor Visits', 0.00, 0, NULL, 2, '2022-01-27 00:47:19', NULL, NULL),
(96, 4, 29, 'Health Insurance', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(97, 4, 29, 'Life Insurance', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(98, 4, 29, 'Auto Insurance', 0.00, 0, NULL, 2, '2022-01-27 00:47:19', NULL, NULL),
(99, 4, 29, 'Homeowner/Renter', 0.00, 0, NULL, 3, '2022-01-27 00:47:19', NULL, NULL),
(100, 4, 29, 'Identity Theft', 0.00, 0, NULL, 4, '2022-01-27 00:47:19', NULL, NULL),
(101, 4, 30, 'Credit Card', 0.00, 0, NULL, 0, '2022-01-27 00:47:19', NULL, NULL),
(102, 4, 30, 'Car Payment', 0.00, 0, NULL, 1, '2022-01-27 00:47:19', NULL, NULL),
(103, 4, 30, 'Student Loan', 0.00, 0, NULL, 2, '2022-01-27 00:47:19', NULL, NULL),
(104, 4, 30, 'Medical Bill', 0.00, 0, NULL, 3, '2022-01-27 00:47:19', NULL, NULL),
(105, 4, 30, 'Personal Loan', 0.00, 0, NULL, 4, '2022-01-27 00:47:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trn_expense_transaction`
--

CREATE TABLE `trn_expense_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expense_sub_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(10,2) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_check` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1: New, 2: Tracked',
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1: New, 2: Tracked, 3: Deleted',
  `date_time` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trn_expense_transaction`
--

INSERT INTO `trn_expense_transaction` (`id`, `user_id`, `expense_sub_id`, `amount`, `title`, `transaction_check`, `transaction_note`, `original_status`, `status`, `date_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 0, 11.00, '10', NULL, NULL, 1, 1, '2022-01-25', '2022-01-25 05:54:21', '2022-01-25 05:54:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trn_income`
--

CREATE TABLE `trn_income` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `income_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planned_amount` double(10,2) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trn_income`
--

INSERT INTO `trn_income` (`id`, `user_id`, `income_name`, `planned_amount`, `note`, `sequence_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Paycheck 1', 0.00, NULL, 10, '2022-01-25 00:01:01', NULL, NULL),
(2, 2, 'Paycheck 2', 0.00, NULL, 11, '2022-01-25 00:01:01', NULL, NULL),
(3, 3, 'Paycheck 1', 2000.00, NULL, 10, '2022-01-25 00:48:49', '2022-01-27 00:29:57', NULL),
(4, 3, 'Paycheck 2', 0.00, NULL, 11, '2022-01-25 00:48:49', '2022-01-27 05:06:57', NULL),
(5, 3, 'Paycheck', 0.00, NULL, 12, '2022-01-25 01:01:56', NULL, NULL),
(6, 3, 'Paycheck', 0.00, NULL, 13, '2022-01-25 01:01:58', NULL, NULL),
(7, 4, 'Paycheck 1', 0.00, NULL, 10, '2022-01-27 00:47:19', NULL, NULL),
(8, 4, 'Paycheck 2', 0.00, NULL, 11, '2022-01-27 00:47:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trn_income_transaction`
--

CREATE TABLE `trn_income_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `income_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(10,2) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_check` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1: New, 2: Tracked',
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1: New, 2: Tracked, 3: Deleted',
  `date_time` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_revenue`
--

CREATE TABLE `trn_revenue` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1: Success, 2: Pending,3: Failed',
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_transaction_log`
--

CREATE TABLE `trn_transaction_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: Income, 2: Expense',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: New, 2: Tracked, 3: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Admin, 1: User',
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: InActive, 1: Active',
  `is_verified` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Pending, 1: Verified',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `plan_id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `is_active`, `is_verified`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, NULL, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$9/ebbAYNhEfoc0JFVSyb/efqovPP.aKKOZHxE9DbiQehgTkbMfc0G', 1, 1, NULL, NULL, NULL, NULL),
(2, 1, NULL, 'MAIL TEST', 'MAIL', 'TEST', 'mailtest@mailinator.com', '$2y$10$eP8ObO.r/P8FYDqJ8TYC8eb4CQsrIf4IzmrlmebKrrADl92XrfFV.', 1, 1, 'b2fe0ef8d56913c78afa15f137c76d9355168d81dce057bfdbaddc0d8bb44e2c', '2022-01-25 00:01:00', '2022-01-25 00:01:00', NULL),
(3, 1, 1, 'TESTse TETETE', 'TESTse', 'TETETE', 'user2@mailinator.com', '$2y$10$NGmsGIX/xedhtfQE6LMBKOONwRcRZ2GFcWUkYR2x.T36PMEawj6Bu', 1, 1, '791d94eb4935a6fa009d57929f59c738280c0c3bbfcb88f8d7a92c9e24a7d0c6', '2022-01-25 00:48:49', '2022-01-25 06:43:25', NULL),
(4, 1, NULL, 'test est', 'test', 'est', 'test@gmail.com', '$2y$10$J/p8QQoftaqxSZSpHMqZae417d/MOyEvgtfr7UxgF3L5VeNVxyLT2', 1, 0, '990b0c32edccc7daebd52857e7bb65aaf4e4fcda3ea29e1901abe0061e0137af', '2022-01-27 00:47:19', '2022-01-27 00:47:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mst_group`
--
ALTER TABLE `mst_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_learn`
--
ALTER TABLE `mst_learn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_learn_library`
--
ALTER TABLE `mst_learn_library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_parameter_type`
--
ALTER TABLE `mst_parameter_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_parameter_value`
--
ALTER TABLE `mst_parameter_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_plan`
--
ALTER TABLE `mst_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_plan_features`
--
ALTER TABLE `mst_plan_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_plan_features_permission`
--
ALTER TABLE `mst_plan_features_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_sub_category`
--
ALTER TABLE `mst_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_user_notification`
--
ALTER TABLE `mst_user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pg_contents`
--
ALTER TABLE `pg_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_content_pages`
--
ALTER TABLE `pg_content_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_content_tags`
--
ALTER TABLE `pg_content_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_expense`
--
ALTER TABLE `trn_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_expense_sub`
--
ALTER TABLE `trn_expense_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_expense_transaction`
--
ALTER TABLE `trn_expense_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_income`
--
ALTER TABLE `trn_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_income_transaction`
--
ALTER TABLE `trn_income_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_revenue`
--
ALTER TABLE `trn_revenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_transaction_log`
--
ALTER TABLE `trn_transaction_log`
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
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `mst_group`
--
ALTER TABLE `mst_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_learn`
--
ALTER TABLE `mst_learn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_learn_library`
--
ALTER TABLE `mst_learn_library`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_parameter_type`
--
ALTER TABLE `mst_parameter_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_parameter_value`
--
ALTER TABLE `mst_parameter_value`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mst_plan`
--
ALTER TABLE `mst_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_plan_features`
--
ALTER TABLE `mst_plan_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_plan_features_permission`
--
ALTER TABLE `mst_plan_features_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_sub_category`
--
ALTER TABLE `mst_sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `mst_user_notification`
--
ALTER TABLE `mst_user_notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pg_contents`
--
ALTER TABLE `pg_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pg_content_pages`
--
ALTER TABLE `pg_content_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pg_content_tags`
--
ALTER TABLE `pg_content_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trn_expense`
--
ALTER TABLE `trn_expense`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `trn_expense_sub`
--
ALTER TABLE `trn_expense_sub`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `trn_expense_transaction`
--
ALTER TABLE `trn_expense_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trn_income`
--
ALTER TABLE `trn_income`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trn_income_transaction`
--
ALTER TABLE `trn_income_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trn_revenue`
--
ALTER TABLE `trn_revenue`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trn_transaction_log`
--
ALTER TABLE `trn_transaction_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
