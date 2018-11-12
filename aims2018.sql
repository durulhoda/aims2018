-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 05:45 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aims2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courseoffer`
--

CREATE TABLE `courseoffer` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `subjectcodeid` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisionid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employeeid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employeetypeid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employeetypes`
--

CREATE TABLE `employeetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_designation`
--

CREATE TABLE `emp_designation` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programLevelid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institutetypeid` int(11) NOT NULL,
  `institutecategoryid` int(11) NOT NULL,
  `institutesubcategoryid` int(11) NOT NULL,
  `divisionid` int(11) NOT NULL,
  `districtid` int(11) NOT NULL,
  `thanaid` int(11) NOT NULL,
  `postofficeid` int(11) NOT NULL,
  `localgovid` int(11) NOT NULL,
  `wordno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cluster` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ein` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutecategory`
--

CREATE TABLE `institutecategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutesubcategory`
--

CREATE TABLE `institutesubcategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutetype`
--

CREATE TABLE `institutetype` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localgovs`
--

CREATE TABLE `localgovs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanaid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mediums`
--

CREATE TABLE `mediums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parentid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Menu Setting', '#', 0, 0, '2018-11-11 19:27:03', '2018-11-11 19:27:03'),
(2, 'Role-Menu', 'rolemenu', 1, 0, '2018-11-11 19:27:49', '2018-11-11 19:27:49'),
(3, 'Institute Settings', '#', 0, 0, '2018-11-11 20:34:34', '2018-11-11 20:34:34'),
(4, 'Division', 'division', 3, 0, '2018-11-11 20:35:28', '2018-11-11 20:35:28'),
(5, 'District', 'district', 3, 0, '2018-11-11 20:37:11', '2018-11-11 20:37:11'),
(6, 'Thana', 'thana', 3, 0, '2018-11-11 20:37:36', '2018-11-11 20:37:36'),
(7, 'Union', 'localgov', 3, 0, '2018-11-11 20:38:35', '2018-11-11 20:38:35'),
(8, 'Post Office', 'postoffice', 3, 0, '2018-11-11 20:39:04', '2018-11-11 20:39:04'),
(9, 'Institute Type', 'institutetype', 3, 0, '2018-11-11 20:39:42', '2018-11-11 20:39:42'),
(10, 'Institute Category', 'institutecategory', 3, 0, '2018-11-11 20:40:19', '2018-11-11 20:40:19'),
(11, 'Institute Sub Category', 'institutesubcategory', 3, 0, '2018-11-11 20:41:24', '2018-11-11 20:41:24'),
(12, 'Institute', 'institute', 3, 0, '2018-11-11 20:42:03', '2018-11-11 20:42:03'),
(13, 'Unit', 'unit', 3, 0, '2018-11-11 20:42:26', '2018-11-11 20:42:26'),
(14, 'Menu', 'menu', 1, 0, '2018-11-11 20:53:15', '2018-11-11 20:53:15'),
(15, 'General Settings', '#', 0, 0, '2018-11-11 20:55:01', '2018-11-11 20:55:01'),
(16, 'Session', 'session', 15, 0, '2018-11-11 20:56:26', '2018-11-11 20:56:26'),
(17, 'Program Level', 'programLevel', 15, 0, '2018-11-11 20:57:10', '2018-11-11 20:57:10'),
(18, 'Group', 'group', 15, 0, '2018-11-11 20:59:03', '2018-11-11 20:59:03'),
(19, 'Program', 'program', 15, 0, '2018-11-11 20:59:37', '2018-11-11 20:59:37'),
(20, 'Medium', 'medium', 15, 0, '2018-11-11 21:00:10', '2018-11-11 21:00:10'),
(21, 'Shift', 'shift', 15, 0, '2018-11-11 21:00:38', '2018-11-11 21:00:38'),
(22, 'Program Offer', 'programoffer', 15, 0, '2018-11-11 21:01:14', '2018-11-11 21:01:14'),
(23, 'Course', 'course', 15, 0, '2018-11-11 21:01:44', '2018-11-11 21:01:44'),
(24, 'Section', 'section', 15, 0, '2018-11-11 21:02:21', '2018-11-11 21:02:21'),
(25, 'Subject Code', 'subjectcode', 15, 0, '2018-11-11 21:02:59', '2018-11-11 21:02:59'),
(26, 'Course Offer', 'courseoffer', 15, 0, '2018-11-11 21:03:34', '2018-11-11 21:03:34'),
(27, 'Employee Settings', '#', 0, 0, '2018-11-11 21:04:03', '2018-11-11 21:04:03'),
(28, 'Employee Type', 'employeeType', 27, 0, '2018-11-11 21:04:32', '2018-11-11 21:04:32'),
(29, 'Designation', 'employeedesignation', 27, 0, '2018-11-11 21:05:00', '2018-11-11 21:05:00'),
(30, 'Department', 'department', 27, 0, '2018-11-11 21:05:23', '2018-11-11 21:05:23'),
(31, 'Employee', 'employee', 27, 0, '2018-11-11 21:05:50', '2018-11-11 21:05:50'),
(32, 'Student Setting', '#', 0, 0, '2018-11-11 21:06:54', '2018-11-11 21:06:54'),
(33, 'Applicant', 'applicant', 32, 0, '2018-11-11 21:07:23', '2018-11-11 21:07:23'),
(34, 'Student', 'student', 32, 0, '2018-11-11 21:07:47', '2018-11-11 21:07:47'),
(35, 'Role', 'role', 1, 0, '2018-11-11 21:17:41', '2018-11-11 21:18:50');

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
(3, '2018_10_16_044922_create_sessions_table', 1),
(4, '2018_10_16_065445_create_courses_table', 1),
(5, '2018_10_16_094330_create_programlevels_table', 1),
(6, '2018_10_17_042437_create_programs_table', 1),
(7, '2018_10_17_074602_create_mediums_table', 1),
(8, '2018_10_17_090328_create_groups_table', 1),
(9, '2018_10_17_103023_create_sections_table', 1),
(10, '2018_10_17_120643_create_shifts_table', 1),
(11, '2018_10_18_074310_create_programoffer_table', 1),
(12, '2018_10_20_092319_create_employees_create', 1),
(13, '2018_10_20_100252_create_employeetypes_table', 1),
(14, '2018_10_20_105650_create_emp_designation_table', 1),
(15, '2018_10_20_112543_create_department_table', 1),
(16, '2018_10_21_051933_create_applicants_table', 1),
(17, '2018_10_21_114645_create_courseoffer_table', 1),
(18, '2018_10_23_100908_create_subjectcodes_table', 1),
(19, '2018_10_24_043251_create_sectionoffer_table', 1),
(20, '2018_10_27_074343_create_divisions_table', 1),
(21, '2018_10_27_074537_create_districts_table', 1),
(22, '2018_10_27_074637_create_thanas_table', 1),
(23, '2018_10_27_074719_create_postoffices_table', 1),
(24, '2018_10_27_074812_create_localgovs_table', 1),
(25, '2018_10_27_083642_create_institutetype_table', 1),
(26, '2018_10_27_083756_create_institutecategory_table', 1),
(27, '2018_10_27_083939_create_institutesubcategory_table', 1),
(28, '2018_10_27_084337_create_institute_table', 1),
(30, '2018_11_06_032421_create_roles_table', 1),
(31, '2018_11_06_043612_create_students_table', 1),
(32, '2018_11_06_053612_create_menus_table', 1),
(33, '2018_11_08_060054_create_user_role_pivot_table', 1),
(34, '2018_11_10_075810_create_role_menu_create', 1),
(35, '2018_11_01_103526_create_units_create', 2);

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
-- Table structure for table `postoffices`
--

CREATE TABLE `postoffices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanaid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programlevels`
--

CREATE TABLE `programlevels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programoffer`
--

CREATE TABLE `programoffer` (
  `id` int(10) UNSIGNED NOT NULL,
  `sessionid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `mediumid` int(11) NOT NULL,
  `shiftid` int(11) NOT NULL,
  `applicantSeat` int(11) NOT NULL,
  `quota` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesspower` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `accesspower`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 63, 0, '2018-11-20 18:00:00', '2018-11-19 18:00:00'),
(2, 'Student', 53, 0, '2018-11-11 21:20:23', '2018-11-11 21:20:23'),
(3, 'Employee', 7, 0, '2018-11-11 21:20:52', '2018-11-11 21:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-11-11 19:28:23', '2018-11-11 19:28:23'),
(2, 1, 2, '2018-11-11 19:28:38', '2018-11-11 19:28:38'),
(3, 1, 3, '2018-11-11 20:43:23', '2018-11-11 20:43:23'),
(4, 1, 4, '2018-11-11 20:43:35', '2018-11-11 20:43:35'),
(5, 1, 5, '2018-11-11 20:43:45', '2018-11-11 20:43:45'),
(6, 1, 6, '2018-11-11 20:50:49', '2018-11-11 20:50:49'),
(7, 1, 7, '2018-11-11 20:51:01', '2018-11-11 20:51:01'),
(8, 1, 8, '2018-11-11 20:51:11', '2018-11-11 20:51:11'),
(9, 1, 9, '2018-11-11 20:51:22', '2018-11-11 20:51:22'),
(10, 1, 10, '2018-11-11 20:51:37', '2018-11-11 20:51:37'),
(11, 1, 11, '2018-11-11 20:51:48', '2018-11-11 20:52:01'),
(12, 1, 12, '2018-11-11 20:52:13', '2018-11-11 20:52:13'),
(13, 1, 13, '2018-11-11 20:52:23', '2018-11-11 20:52:23'),
(14, 1, 14, '2018-11-11 20:53:46', '2018-11-11 20:53:46'),
(15, 1, 15, '2018-11-11 20:55:25', '2018-11-11 20:55:25'),
(16, 1, 16, '2018-11-11 20:57:54', '2018-11-11 20:57:54'),
(17, 1, 17, '2018-11-11 20:58:11', '2018-11-11 20:58:11'),
(18, 1, 18, '2018-11-11 21:08:49', '2018-11-11 21:09:18'),
(19, 1, 19, '2018-11-11 21:09:45', '2018-11-11 21:09:45'),
(20, 1, 20, '2018-11-11 21:09:58', '2018-11-11 21:09:58'),
(21, 1, 21, '2018-11-11 21:10:25', '2018-11-11 21:10:25'),
(22, 1, 22, '2018-11-11 21:10:46', '2018-11-11 21:10:46'),
(23, 1, 23, '2018-11-11 21:11:08', '2018-11-11 21:11:08'),
(24, 1, 24, '2018-11-11 21:11:31', '2018-11-11 21:11:31'),
(25, 1, 25, '2018-11-11 21:12:02', '2018-11-11 21:12:02'),
(26, 1, 26, '2018-11-11 21:12:31', '2018-11-11 21:12:31'),
(27, 1, 27, '2018-11-11 21:12:49', '2018-11-11 21:12:49'),
(28, 1, 28, '2018-11-11 21:13:11', '2018-11-11 21:13:11'),
(29, 1, 29, '2018-11-11 21:13:23', '2018-11-11 21:13:23'),
(30, 1, 30, '2018-11-11 21:13:45', '2018-11-11 21:13:45'),
(31, 1, 31, '2018-11-11 21:13:58', '2018-11-11 21:13:58'),
(32, 1, 32, '2018-11-11 21:14:15', '2018-11-11 21:14:15'),
(33, 1, 33, '2018-11-11 21:14:36', '2018-11-11 21:14:36'),
(34, 1, 34, '2018-11-11 21:14:50', '2018-11-11 21:14:50'),
(35, 1, 35, '2018-11-11 21:19:15', '2018-11-11 21:19:15'),
(36, 2, 32, '2018-11-11 21:24:55', '2018-11-11 21:26:45'),
(37, 2, 33, '2018-11-11 21:28:36', '2018-11-11 21:28:36'),
(38, 2, 34, '2018-11-11 21:28:50', '2018-11-11 21:28:50'),
(39, 3, 27, '2018-11-11 21:29:49', '2018-11-11 21:29:49'),
(40, 3, 28, '2018-11-11 21:30:11', '2018-11-11 21:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `sectionoffer`
--

CREATE TABLE `sectionoffer` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrationid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `registrationid`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Lima', 'lima', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjectcodes`
--

CREATE TABLE `subjectcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `districtid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instituteid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$JDgz0PxIi7uYdcM/03bCWeYRa22rFLy5hYDHAeuBahOYIZv0QzmaK', 'LcSbsaxBR5gRVaTwjZKniK5R9Fiuk65L0RXYiY3bDdHXswP06IPMc9UlgJRo', '2018-11-11 19:22:17', '2018-11-11 19:22:17'),
(2, 'Lima', 'lima@gmail.com', NULL, '$2y$10$GLamMg6gks.72Rb48DO2.Odc5tiduG9j4.g2vy0SNV2MQRFFFGl0C', 'LUOhmEvCahClWt8ZuVGdUTuhkbfTS8Jqt0s1EVOQmB45jPfj44rOpQlLclmX', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-11-14 18:00:00', '2018-11-19 18:00:00'),
(2, 2, 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseoffer`
--
ALTER TABLE `courseoffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeetypes`
--
ALTER TABLE `employeetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutecategory`
--
ALTER TABLE `institutecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutesubcategory`
--
ALTER TABLE `institutesubcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutetype`
--
ALTER TABLE `institutetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localgovs`
--
ALTER TABLE `localgovs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mediums`
--
ALTER TABLE `mediums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `postoffices`
--
ALTER TABLE `postoffices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programlevels`
--
ALTER TABLE `programlevels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programoffer`
--
ALTER TABLE `programoffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sectionoffer`
--
ALTER TABLE `sectionoffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectcodes`
--
ALTER TABLE `subjectcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courseoffer`
--
ALTER TABLE `courseoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeetypes`
--
ALTER TABLE `employeetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutecategory`
--
ALTER TABLE `institutecategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutesubcategory`
--
ALTER TABLE `institutesubcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutetype`
--
ALTER TABLE `institutetype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localgovs`
--
ALTER TABLE `localgovs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mediums`
--
ALTER TABLE `mediums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `postoffices`
--
ALTER TABLE `postoffices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programlevels`
--
ALTER TABLE `programlevels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programoffer`
--
ALTER TABLE `programoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sectionoffer`
--
ALTER TABLE `sectionoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjectcodes`
--
ALTER TABLE `subjectcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
