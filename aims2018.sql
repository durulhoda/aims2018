-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2018 at 12:54 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

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
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instituteid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `code`, `instituteid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'School', '23452', 1, 0, '2018-11-01 05:04:10', '2018-11-01 05:28:37'),
(2, 'College', '4567', 1, 0, '2018-11-01 05:04:27', '2018-11-01 05:27:40'),
(3, 'School', '5675', 2, 0, '2018-11-01 05:04:43', '2018-11-01 05:28:21'),
(4, 'School', '6754', 3, 0, '2018-11-01 05:04:58', '2018-11-01 05:28:28'),
(5, 'School', '9689', 4, 0, '2018-11-01 05:05:37', '2018-11-01 05:28:03'),
(6, 'College', '124134', 4, 0, '2018-11-01 05:05:49', '2018-11-01 05:27:27'),
(7, 'College', '1131421', 5, 0, '2018-11-01 05:32:15', '2018-11-01 05:32:42');

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

--
-- Dumping data for table `courseoffer`
--

INSERT INTO `courseoffer` (`id`, `programofferid`, `subjectcodeid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100.00, 0, '2018-10-29 23:40:36', '2018-10-29 23:40:36'),
(2, 1, 5, 200.00, 0, '2018-10-29 23:40:36', '2018-10-29 23:40:36'),
(3, 4, 5, 200.00, 0, '2018-10-30 01:38:06', '2018-10-30 01:38:06'),
(4, 4, 8, 150.00, 0, '2018-10-30 01:57:01', '2018-10-30 01:57:01');

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

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2018-10-28 04:15:26', '2018-10-28 04:15:26'),
(2, 'English', 0, '2018-10-28 04:15:31', '2018-10-28 04:15:31'),
(3, 'Bangla 1st Paper', 0, '2018-10-28 04:15:37', '2018-10-28 04:15:37'),
(4, 'English 1st Paper', 0, '2018-10-28 04:15:44', '2018-10-28 04:15:44'),
(5, 'English 2nd Paper', 0, '2018-10-28 16:21:33', '2018-10-28 16:21:33'),
(6, 'Bangla 2nd Paper', 0, '2018-10-28 16:21:50', '2018-10-28 16:21:50'),
(7, 'Math', 0, '2018-10-28 16:22:00', '2018-10-28 16:22:00'),
(8, 'Islam', 0, '2018-10-28 16:22:08', '2018-10-28 16:22:08'),
(9, 'General Science', 0, '2018-10-28 16:56:26', '2018-10-28 16:56:26'),
(10, 'Computer Studies', 0, '2018-10-28 16:56:48', '2018-10-28 16:56:48'),
(11, 'Chemistry', 0, '2018-10-28 16:57:05', '2018-10-28 16:57:05'),
(12, 'Biology', 0, '2018-10-28 16:57:18', '2018-10-28 16:57:18'),
(13, 'Accounting', 0, '2018-10-28 16:57:35', '2018-10-28 16:57:35'),
(14, 'ICT', 0, '2018-10-28 16:57:54', '2018-10-28 16:57:54'),
(15, 'Economics', 0, '2018-10-28 16:58:26', '2018-10-28 16:58:26'),
(16, 'Hindu & Moral Education', 0, '2018-10-28 16:59:06', '2018-10-28 16:59:06'),
(17, 'Buddhist & Moral Education', 0, '2018-10-28 16:59:20', '2018-10-28 16:59:20'),
(18, 'Christian & Moral Education', 0, '2018-10-28 16:59:35', '2018-10-28 16:59:35'),
(19, 'Higher Math', 0, '2018-10-28 16:59:55', '2018-10-28 16:59:55'),
(20, 'Arbi', 0, '2018-10-28 17:00:11', '2018-10-28 17:00:11'),
(21, 'Physics', 0, '2018-10-28 17:00:56', '2018-10-28 17:00:56'),
(22, 'Career Education', 0, '2018-10-28 17:01:31', '2018-10-28 17:01:31'),
(23, 'Islam & Moral Education', 0, '2018-10-28 17:15:07', '2018-10-28 17:15:07');

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

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2018-11-02 23:36:25', '2018-11-02 23:36:25'),
(2, 'Einglish', 0, '2018-11-02 23:36:41', '2018-11-02 23:36:41'),
(3, 'Managing Commitee', 0, '2018-11-02 23:38:23', '2018-11-02 23:38:23'),
(4, 'Math', 0, '2018-11-02 23:38:40', '2018-11-02 23:38:40'),
(5, 'Religion Studies', 0, '2018-11-02 23:38:58', '2018-11-02 23:38:58'),
(6, 'Business Studies', 0, '2018-11-02 23:39:22', '2018-11-02 23:39:22'),
(7, 'Accountant', 0, '2018-11-02 23:39:40', '2018-11-02 23:39:40'),
(8, 'Librarian', 0, '2018-11-02 23:40:10', '2018-11-02 23:40:10'),
(9, 'Security', 0, '2018-11-02 23:40:22', '2018-11-02 23:40:22');

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

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `divisionid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bogura', 1, 0, '2018-10-30 02:06:38', '2018-10-30 02:06:38'),
(2, 'Chapainawabganj', 1, 0, '2018-10-30 02:06:50', '2018-10-30 02:06:50'),
(3, 'Joypurhat', 1, 0, '2018-10-30 02:07:01', '2018-10-30 02:07:01'),
(4, 'Naogaon', 1, 0, '2018-10-30 02:07:13', '2018-10-30 02:07:13'),
(5, 'Natore', 1, 0, '2018-10-30 02:07:23', '2018-10-30 02:07:23'),
(6, 'Pabna', 1, 0, '2018-10-30 02:07:34', '2018-10-30 02:07:34'),
(7, 'Rajshahi', 1, 0, '2018-10-30 02:07:45', '2018-10-30 02:07:45'),
(8, 'Sirajganj', 1, 0, '2018-10-30 02:07:56', '2018-10-30 02:07:56'),
(9, 'Bagerhat', 2, 0, '2018-10-30 02:13:35', '2018-10-30 02:13:35'),
(10, 'Bagmara', 1, 0, '2018-10-30 02:13:58', '2018-10-30 03:11:34'),
(11, 'Jessore', 2, 0, '2018-10-30 02:14:20', '2018-10-30 02:14:20'),
(12, 'Jhenaidah', 2, 0, '2018-10-30 02:14:33', '2018-10-30 02:14:33'),
(13, 'Khulna', 2, 0, '2018-10-30 02:14:48', '2018-10-30 02:14:48'),
(14, 'Kushtia', 2, 0, '2018-10-30 02:15:01', '2018-10-30 02:15:01'),
(15, 'Magura', 2, 0, '2018-10-30 02:15:20', '2018-10-30 02:15:20'),
(16, 'Meherpur', 2, 0, '2018-10-30 02:15:36', '2018-10-30 02:15:36'),
(17, 'Narail', 2, 0, '2018-10-30 02:15:50', '2018-10-30 02:15:50'),
(18, 'Satkhira', 2, 0, '2018-10-30 02:16:13', '2018-10-30 02:16:13'),
(19, 'Jamalpur', 6, 0, '2018-10-30 02:16:28', '2018-10-30 02:16:28'),
(20, 'Mymensingh', 6, 0, '2018-10-30 02:16:45', '2018-10-30 02:16:45'),
(21, 'Netrokona', 6, 0, '2018-10-30 02:17:02', '2018-10-30 02:17:02'),
(22, 'Sherpur', 6, 0, '2018-10-30 02:17:27', '2018-10-30 02:17:27'),
(23, 'Habiganj', 8, 0, '2018-10-30 02:17:45', '2018-10-30 02:17:45'),
(24, 'Moulvibazar', 8, 0, '2018-10-30 02:17:58', '2018-10-30 02:17:58'),
(25, 'Sunamganj', 8, 0, '2018-10-30 02:18:11', '2018-10-30 02:18:11'),
(26, 'Sylhet', 8, 0, '2018-10-30 02:18:25', '2018-10-30 02:18:25'),
(27, 'Dhaka', 5, 0, '2018-10-30 02:18:53', '2018-10-30 02:18:53'),
(28, 'Faridpur', 5, 0, '2018-10-30 02:19:07', '2018-10-30 02:19:07'),
(29, 'Gazipur', 5, 0, '2018-10-30 02:19:23', '2018-10-30 02:19:23'),
(30, 'Gopalganj', 5, 0, '2018-10-30 02:19:37', '2018-10-30 02:19:37'),
(31, 'Kishoreganj', 5, 0, '2018-10-30 02:19:51', '2018-10-30 02:19:51'),
(32, 'Madaripur', 4, 0, '2018-10-30 02:20:03', '2018-10-30 02:20:03'),
(33, 'Manikganj', 5, 0, '2018-10-30 02:20:21', '2018-10-30 02:20:21'),
(34, 'Munshiganj', 5, 0, '2018-10-30 02:20:34', '2018-10-30 02:20:34'),
(35, 'Narayanganj', 5, 0, '2018-10-30 02:20:47', '2018-10-30 02:20:47'),
(36, 'Narsingdi', 5, 0, '2018-10-30 02:21:01', '2018-10-30 02:21:01'),
(37, 'Rajbari', 5, 0, '2018-10-30 02:21:15', '2018-10-30 02:21:15'),
(38, 'Shariatpur', 5, 0, '2018-10-30 02:21:29', '2018-10-30 02:21:29'),
(39, 'Tangail', 5, 0, '2018-10-30 02:21:42', '2018-10-30 02:21:42'),
(40, 'Barguna', 4, 0, '2018-10-30 02:22:13', '2018-10-30 02:22:13'),
(41, 'Barisal', 4, 0, '2018-10-30 02:22:27', '2018-10-30 02:22:27'),
(42, 'Bhola', 4, 0, '2018-10-30 02:22:41', '2018-10-30 02:22:41'),
(43, 'Jhalokati', 4, 0, '2018-10-30 02:23:03', '2018-10-30 02:23:03'),
(44, 'Patuakhali', 4, 0, '2018-10-30 02:23:22', '2018-10-30 02:23:22'),
(45, 'Pirojpur', 4, 0, '2018-10-30 02:23:36', '2018-10-30 02:23:36'),
(46, 'Bandarban', 3, 0, '2018-10-30 02:23:50', '2018-10-30 02:23:50'),
(47, 'Brahmanbaria', 3, 0, '2018-10-30 02:24:05', '2018-10-30 02:24:05'),
(48, 'Chandpur', 3, 0, '2018-10-30 02:24:18', '2018-10-30 02:24:18'),
(49, 'Chittagong', 3, 0, '2018-10-30 02:24:42', '2018-10-30 02:24:42'),
(50, 'Comilla', 3, 0, '2018-10-30 02:24:52', '2018-10-30 02:24:52'),
(51, 'Cox\'s Bazar', 3, 0, '2018-10-30 02:25:03', '2018-10-30 02:25:03'),
(52, 'Feni', 3, 0, '2018-10-30 02:25:13', '2018-10-30 02:25:13'),
(53, 'Khagrachhari', 2, 0, '2018-10-30 02:25:29', '2018-10-30 02:25:29'),
(54, 'Lakshmipur', 3, 0, '2018-10-30 02:25:40', '2018-10-30 02:25:40'),
(55, 'Noakhali', 3, 0, '2018-10-30 02:25:53', '2018-10-30 02:25:53'),
(56, 'Rangamati', 3, 0, '2018-10-30 02:26:13', '2018-10-30 02:26:13'),
(57, 'Dinajpur', 7, 0, '2018-10-30 02:27:00', '2018-10-30 02:27:00'),
(58, 'Gaibandha', 7, 0, '2018-10-30 02:27:12', '2018-10-30 02:27:12'),
(59, 'Kurigram', 7, 0, '2018-10-30 02:27:24', '2018-10-30 02:27:24'),
(60, 'Lalmonirhat', 7, 0, '2018-10-30 02:27:37', '2018-10-30 02:27:37'),
(61, 'Nilphamari', 7, 0, '2018-10-30 02:27:49', '2018-10-30 02:27:49'),
(62, 'Panchagarh', 7, 0, '2018-10-30 02:28:02', '2018-10-30 02:28:02'),
(63, 'Rangpur', 7, 0, '2018-10-30 02:28:22', '2018-10-30 02:28:22'),
(64, 'Thakurgaon', 7, 0, '2018-10-30 02:28:40', '2018-10-30 02:28:40');

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

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rajshahi', 0, '2018-10-30 02:01:15', '2018-10-30 02:01:15'),
(2, 'Khulna', 0, '2018-10-30 02:01:29', '2018-10-30 02:01:29'),
(3, 'Chittagong', 0, '2018-10-30 02:03:19', '2018-10-30 02:03:19'),
(4, 'Barishal', 0, '2018-10-30 02:03:31', '2018-10-30 02:03:31'),
(5, 'Dhaka', 0, '2018-10-30 02:03:47', '2018-10-30 02:03:47'),
(6, 'Mymensingh', 0, '2018-10-30 02:03:58', '2018-10-30 02:03:58'),
(7, 'Rangpur', 0, '2018-10-30 02:04:14', '2018-10-30 02:04:14'),
(8, 'Sylhet', 0, '2018-10-30 02:04:25', '2018-10-30 02:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employeeid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeetypeid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `employeeid`, `employeetypeid`, `created_at`, `updated_at`) VALUES
(1, 'Arshed1', '12341234', 1, '2018-11-05 22:52:06', '2018-11-06 02:31:21'),
(2, 'Arshad2', '34563345', 1, '2018-11-05 23:01:25', '2018-11-06 02:31:30');

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

--
-- Dumping data for table `employeetypes`
--

INSERT INTO `employeetypes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Teacher', 0, '2018-11-02 22:11:30', '2018-11-02 22:11:30'),
(2, 'Administrative', 0, '2018-11-02 22:11:42', '2018-11-02 22:11:42');

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

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `programLevelid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General', 1, 0, '2018-10-28 01:33:02', '2018-10-28 01:33:02'),
(2, 'General', 2, 0, '2018-10-28 01:33:46', '2018-10-28 01:33:46'),
(3, 'General', 3, 0, '2018-10-28 01:33:53', '2018-10-28 01:33:53'),
(4, 'Science', 4, 0, '2018-10-28 01:34:02', '2018-10-28 01:34:02'),
(5, 'Buiesness Studies', 4, 0, '2018-10-28 01:34:28', '2018-10-28 01:34:28'),
(6, 'Humanitis', 4, 0, '2018-10-28 01:34:48', '2018-10-28 01:34:48'),
(7, 'Science', 5, 0, '2018-10-28 01:34:57', '2018-10-28 01:34:57'),
(8, 'Humanitis', 5, 0, '2018-10-28 01:35:14', '2018-10-28 01:35:14'),
(9, 'Buiesness Studies', 5, 0, '2018-10-28 01:35:24', '2018-10-28 01:35:24'),
(10, 'Science', 6, 0, '2018-10-28 01:35:51', '2018-10-28 01:35:51'),
(11, 'Buiesness Studies', 6, 0, '2018-10-28 01:36:03', '2018-10-28 01:36:03'),
(12, 'Humanitis', 6, 0, '2018-10-28 01:36:36', '2018-10-28 01:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institutetypeid` int(11) NOT NULL,
  `institutecategoryid` int(11) NOT NULL,
  `institutesubcategoryid` int(11) DEFAULT NULL,
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

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `name`, `institutetypeid`, `institutecategoryid`, `institutesubcategoryid`, `thanaid`, `postofficeid`, `localgovid`, `wordno`, `cluster`, `ein`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mohammadpur Ramendra Model High School', 1, 2, 1, 2, 1, 1, 'wordno1', 'Claster1', 1234132414, 0, '2018-11-01 02:11:37', '2018-11-01 02:11:37'),
(2, 'Horinagor high school', 3, 1, 4, 2, 1, 1, 'wordno2', 'Claster2', 123413242234, 0, '2018-11-01 02:14:31', '2018-11-01 02:14:31'),
(3, 'Ranihati high school', 2, 1, 4, 2, 1, 2, 'wordno3', 'Claster3', 123413241421, 0, '2018-11-01 04:22:57', '2018-11-01 04:30:31'),
(4, 'Gorapahkia Hogh School', 1, 1, 4, 2, 1, 1, 'wordno4', 'Claster4', 123413241424, 0, '2018-11-01 04:26:33', '2018-11-01 04:30:21'),
(5, 'Shibgonj Govt High School And College', 1, 1, 4, 2, 1, 1, 'wordno5', 'Claster5', 12341324142345, 0, '2018-11-01 05:30:59', '2018-11-01 05:30:59');

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

--
-- Dumping data for table `institutecategory`
--

INSERT INTO `institutecategory` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General', 0, '2018-10-30 05:16:31', '2018-10-30 05:16:31'),
(2, 'Madrasa', 0, '2018-10-30 05:16:59', '2018-10-30 05:16:59'),
(3, 'Vocational', 0, '2018-10-30 05:17:13', '2018-10-30 05:17:13'),
(4, 'Polytechnic', 0, '2018-10-30 05:18:41', '2018-10-30 05:18:41'),
(5, 'Open University', 0, '2018-10-30 06:09:45', '2018-11-01 04:09:12');

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

--
-- Dumping data for table `institutesubcategory`
--

INSERT INTO `institutesubcategory` (`id`, `name`, `categoryid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kowami  Madrasa', 2, 0, '2018-10-30 06:13:14', '2018-10-30 06:21:20'),
(2, 'Alia Madrasa', 2, 0, '2018-10-30 06:14:21', '2018-10-30 06:14:21'),
(3, 'Hafiza Madrasa', 2, 0, '2018-10-30 06:14:38', '2018-10-30 06:14:38'),
(4, 'no', 1, 0, '2018-11-01 02:13:20', '2018-11-02 22:41:04');

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

--
-- Dumping data for table `institutetype`
--

INSERT INTO `institutetype` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Governmental', 0, '2018-10-30 05:03:51', '2018-10-30 05:03:51'),
(2, 'Semi Governmental', 0, '2018-10-30 05:04:15', '2018-11-01 03:59:35'),
(3, 'Non Governmental', 0, '2018-10-30 05:06:27', '2018-11-01 04:00:12'),
(4, 'Private', 0, '2018-10-30 05:07:15', '2018-11-01 04:00:19');

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

--
-- Dumping data for table `localgovs`
--

INSERT INTO `localgovs` (`id`, `name`, `thanaid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ranihati', 2, 0, '2018-10-30 03:12:27', '2018-10-30 03:12:27'),
(2, 'Nawalavanga', 2, 0, '2018-10-30 03:56:31', '2018-10-30 03:59:31');

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

--
-- Dumping data for table `mediums`
--

INSERT INTO `mediums` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2018-10-28 00:46:52', '2018-10-28 00:46:52'),
(2, 'English', 0, '2018-10-28 00:47:03', '2018-10-28 00:47:03');

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
(1, 'Institute Settings', '#', 0, 0, '2018-11-06 00:13:07', '2018-11-06 00:13:07'),
(2, 'Division SetUp', 'division', 1, 0, '2018-11-06 00:13:41', '2018-11-06 00:13:41'),
(3, 'District SetUp', 'district', 1, 0, '2018-11-06 00:21:11', '2018-11-06 00:21:11'),
(4, 'Thana SetUp', 'thana', 1, 0, '2018-11-06 00:21:55', '2018-11-06 00:21:55'),
(5, 'Union SetUp', 'localgov', 1, 0, '2018-11-06 00:22:22', '2018-11-06 00:22:22'),
(6, 'Post Office SetUp', 'postoffice', 1, 0, '2018-11-06 00:22:56', '2018-11-06 00:22:56'),
(7, 'Institute Type SetUp', 'institutetype', 1, 0, '2018-11-06 00:23:25', '2018-11-06 00:23:25'),
(8, 'Institute Category SetUp', 'institutecategory', 1, 0, '2018-11-06 00:23:52', '2018-11-06 00:23:52'),
(9, 'Sub Cat SetUp', 'institutesubcategory', 1, 0, '2018-11-06 00:24:19', '2018-11-06 00:24:19'),
(10, 'Institute SetUp', 'institute', 1, 0, '2018-11-06 00:24:42', '2018-11-06 00:24:42'),
(11, 'Code SetUp', 'unit', 1, 0, '2018-11-06 00:25:36', '2018-11-06 00:25:36'),
(12, 'Basic Settings', '#', 0, 0, '2018-11-06 00:26:17', '2018-11-06 00:26:17'),
(13, 'Session setup', 'session', 12, 0, '2018-11-06 00:26:51', '2018-11-06 00:26:51'),
(14, 'Program Level', 'programLevel', 12, 0, '2018-11-06 00:27:34', '2018-11-06 00:27:34'),
(15, 'Group setup', 'group', 12, 0, '2018-11-06 00:28:13', '2018-11-06 00:28:13'),
(16, 'Class setup', 'program', 12, 0, '2018-11-06 00:28:45', '2018-11-06 00:28:45'),
(17, 'Medium setup', 'medium', 12, 0, '2018-11-06 00:29:10', '2018-11-06 00:29:10'),
(18, 'Shift setup', 'shift', 12, 0, '2018-11-06 00:29:32', '2018-11-06 00:29:32'),
(19, 'Program Offer setup', 'programoffer', 12, 0, '2018-11-06 00:29:59', '2018-11-06 00:29:59'),
(20, 'Subject Info', 'course', 12, 0, '2018-11-06 00:30:32', '2018-11-06 00:30:32'),
(21, 'Subject Code', 'subjectcode', 12, 0, '2018-11-06 00:31:00', '2018-11-06 00:31:00'),
(22, 'Course Offer setup', 'courseoffer', 12, 0, '2018-11-06 00:31:25', '2018-11-06 00:31:25'),
(23, 'Employee Settings', '#', 0, 0, '2018-11-06 00:31:51', '2018-11-06 00:33:51'),
(24, 'Employee Designation', 'employeedesignation', 23, 0, '2018-11-06 00:32:22', '2018-11-06 00:32:22'),
(25, 'Department', 'department', 23, 0, '2018-11-06 00:32:51', '2018-11-06 00:32:51'),
(26, 'Employee', 'employee', 23, 0, '2018-11-06 00:34:47', '2018-11-06 00:34:47'),
(27, 'Student Settings', '#', 0, 0, '2018-11-06 00:35:18', '2018-11-06 00:35:18'),
(28, 'Student', 'student', 27, 0, '2018-11-06 00:35:46', '2018-11-06 00:35:46'),
(29, 'User Settings', '#', 0, 0, '2018-11-06 00:36:08', '2018-11-06 00:36:08'),
(30, 'Role', 'role', 29, 0, '2018-11-06 00:37:15', '2018-11-06 00:37:15'),
(31, 'User', 'user', 29, 0, '2018-11-06 00:37:36', '2018-11-06 00:37:36'),
(32, 'Menu Settings', '#', 0, 0, '2018-11-06 00:38:01', '2018-11-06 00:38:01'),
(33, 'Menu', 'menu', 32, 0, '2018-11-06 00:39:06', '2018-11-06 00:39:06');

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
(7, '2018_10_17_074602_create_mediums_table', 1),
(9, '2018_10_17_103023_create_sections_table', 1),
(10, '2018_10_17_120643_create_shifts_table', 1),
(11, '2018_10_18_074310_create_programoffer_table', 1),
(13, '2018_10_20_100252_create_employeetypes_table', 1),
(14, '2018_10_20_105650_create_emp_designation_table', 1),
(15, '2018_10_20_112543_create_department_table', 1),
(16, '2018_10_21_051933_create_applicants_table', 1),
(17, '2018_10_21_114645_create_courseoffer_table', 1),
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
(31, '2018_10_16_094330_create_programlevels_table', 4),
(32, '2018_10_17_090328_create_groups_table', 4),
(33, '2018_10_17_042437_create_programs_table', 5),
(34, '2018_10_16_094330_create_program_levels_table', 6),
(36, '2018_10_23_100908_create_subjectcodes_table', 6),
(38, '2018_11_01_103526_create_branches_create', 7),
(39, '2018_11_06_032421_create_roles_table', 8),
(40, '2018_10_20_092319_create_employees_create', 9),
(41, '2018_11_06_043612_create_students_table', 9),
(42, '2018_11_06_053612_create_menus_table', 10),
(44, '2018_11_06_083215_create_userroles_table', 11),
(45, '2018_11_08_060054_create_user_role_pivot_table', 12);

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

--
-- Dumping data for table `postoffices`
--

INSERT INTO `postoffices` (`id`, `name`, `thanaid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ranihati Postoffice', 2, 0, '2018-10-30 04:45:07', '2018-10-30 04:48:53');

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

--
-- Dumping data for table `programlevels`
--

INSERT INTO `programlevels` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pre-Primary', 0, '2018-10-28 01:30:04', '2018-10-28 01:30:24'),
(2, 'primary', 0, '2018-10-28 01:30:33', '2018-10-28 01:30:33'),
(3, 'Junior Secondary', 0, '2018-10-28 01:30:47', '2018-10-28 01:30:47'),
(4, 'Secondary', 0, '2018-10-28 01:30:53', '2018-10-28 01:30:53'),
(5, 'Higher Secondary', 0, '2018-10-28 01:31:08', '2018-10-28 01:31:08'),
(6, 'Graduation', 0, '2018-10-28 01:31:18', '2018-10-28 01:31:18'),
(7, 'Post Graduation', 0, '2018-10-28 01:31:29', '2018-10-28 01:31:29');

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

--
-- Dumping data for table `programoffer`
--

INSERT INTO `programoffer` (`id`, `sessionid`, `programid`, `mediumid`, `shiftid`, `applicantSeat`, `quota`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 1, 1, 200, 4, 0, '2018-10-28 16:47:22', '2018-10-28 16:47:22'),
(2, 2, 11, 1, 1, 200, 4, 0, '2018-10-28 16:48:21', '2018-10-28 16:48:21'),
(3, 2, 13, 1, 1, 200, 4, 0, '2018-10-28 16:48:48', '2018-10-28 16:48:48'),
(4, 2, 6, 1, 2, 200, 4, 0, '2018-10-28 16:50:06', '2018-10-28 16:50:06'),
(5, 2, 11, 1, 2, 200, 5, 0, '2018-10-28 16:50:48', '2018-10-28 16:50:48'),
(6, 2, 13, 1, 2, 200, 5, 0, '2018-10-28 16:51:22', '2018-10-28 16:51:22'),
(7, 2, 6, 2, 1, 200, 10, 0, '2018-10-28 16:52:12', '2018-10-28 16:52:12'),
(8, 2, 11, 2, 1, 200, 10, 0, '2018-10-28 16:52:53', '2018-10-28 16:52:53'),
(9, 2, 13, 2, 1, 200, 10, 0, '2018-10-28 16:53:25', '2018-10-28 16:53:25'),
(10, 2, 6, 2, 2, 200, 5, 0, '2018-10-28 16:54:04', '2018-10-28 16:54:04'),
(11, 2, 11, 2, 2, 200, 5, 0, '2018-10-28 16:54:35', '2018-10-28 16:54:35'),
(12, 2, 13, 2, 2, 200, 8, 0, '2018-10-28 16:55:00', '2018-10-28 16:55:00');

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

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `groupid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Class I', 2, 0, '2018-10-28 02:09:49', '2018-10-28 09:48:09'),
(2, 'Class II', 2, 0, '2018-10-28 02:20:13', '2018-10-28 09:48:24'),
(3, 'Class III', 2, 0, '2018-10-28 02:20:33', '2018-10-28 09:48:36'),
(4, 'Class IV', 2, 0, '2018-10-28 02:21:13', '2018-10-28 09:48:49'),
(5, 'Class V', 2, 0, '2018-10-28 02:21:56', '2018-10-28 09:49:00'),
(6, 'IX', 4, 0, '2018-10-28 02:37:23', '2018-10-28 02:37:23'),
(7, 'Class VI', 3, 0, '2018-10-28 05:45:50', '2018-10-28 05:45:50'),
(8, 'Class VII', 3, 0, '2018-10-28 05:46:12', '2018-10-28 05:46:12'),
(9, 'Class VIII', 3, 0, '2018-10-28 05:46:24', '2018-10-28 05:47:30'),
(10, 'X', 4, 0, '2018-10-28 10:22:20', '2018-10-28 10:22:20'),
(11, 'IX', 5, 0, '2018-10-28 10:22:41', '2018-10-28 10:22:41'),
(12, 'X', 5, 0, '2018-10-28 10:22:57', '2018-10-28 10:22:57'),
(13, 'IX', 6, 0, '2018-10-28 10:23:16', '2018-10-28 10:23:16'),
(14, 'X', 6, 0, '2018-10-28 10:23:30', '2018-10-28 10:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `program_levels`
--

CREATE TABLE `program_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `accesspower` int(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `accesspower`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 63, 0, '2018-11-07 05:54:42', '2018-11-08 04:12:14'),
(2, 'Teacher', 55, 0, '2018-11-07 05:56:01', '2018-11-08 04:17:35'),
(3, 'Student', 61, 0, '2018-11-07 06:00:14', '2018-11-08 05:04:02'),
(4, 'Staff', 63, 0, '2018-11-07 06:08:44', '2018-11-08 05:04:14'),
(5, 'Office Aisstant', 3, 0, '2018-11-07 23:00:16', '2018-11-08 04:13:02');

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

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ka', 0, '2018-10-28 14:11:16', '2018-10-28 14:11:16'),
(2, 'kha', 0, '2018-10-28 14:11:22', '2018-10-28 14:11:22'),
(3, 'Ga', 0, '2018-10-28 17:24:26', '2018-10-28 17:24:26'),
(4, 'Gha', 0, '2018-10-28 17:24:34', '2018-10-28 17:24:34');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2017', 0, '2018-10-27 23:01:36', '2018-10-27 23:01:36'),
(2, '2018', 0, '2018-10-27 23:01:43', '2018-10-27 23:01:43');

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

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `startTime`, `endTime`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Day', '08:00:00', '16:15:00', 0, '2018-10-28 00:48:10', '2018-10-28 00:48:10'),
(2, 'Night', '16:00:00', '22:00:00', 0, '2018-10-28 00:48:40', '2018-10-28 00:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `studentid`, `created_at`, `updated_at`) VALUES
(1, 'Kalam', '12345', '2018-11-05 22:43:17', '2018-11-06 02:25:28'),
(2, 'Jamal', '23452435', '2018-11-05 22:43:26', '2018-11-06 02:25:35'),
(3, 'Rohim', '2354234', '2018-11-05 22:43:36', '2018-11-06 02:25:41'),
(4, 'duruliu72', '112341', '2018-11-13 18:00:00', NULL),
(5, 'fjhgfh', '64654', NULL, NULL);

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

--
-- Dumping data for table `subjectcodes`
--

INSERT INTO `subjectcodes` (`id`, `name`, `courseid`, `programid`, `status`, `created_at`, `updated_at`) VALUES
(1, '101', 3, 6, 0, '2018-10-28 13:11:54', '2018-10-28 17:02:55'),
(2, '102', 6, 6, 0, '2018-10-28 13:15:29', '2018-10-28 17:13:49'),
(3, '107', 4, 6, 0, '2018-10-28 14:03:10', '2018-10-28 17:04:07'),
(4, '108', 5, 6, 0, '2018-10-28 15:31:55', '2018-10-28 17:04:32'),
(5, '109', 7, 6, 0, '2018-10-28 17:05:16', '2018-10-28 17:05:16'),
(6, '137', 11, 6, 0, '2018-10-28 17:06:07', '2018-10-28 17:06:07'),
(7, '136', 21, 6, 0, '2018-10-28 17:07:24', '2018-10-28 17:07:24'),
(8, '138', 12, 6, 0, '2018-10-28 17:11:14', '2018-10-28 17:11:14'),
(9, '126', 19, 6, 0, '2018-10-28 17:12:03', '2018-10-28 17:12:03'),
(10, '111', 23, 6, 0, '2018-10-28 17:16:07', '2018-10-28 17:16:07'),
(11, '131', 10, 6, 0, '2018-10-28 17:16:54', '2018-10-28 17:16:54'),
(12, '154', 14, 6, 0, '2018-10-28 17:22:14', '2018-10-28 17:22:14');

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

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `name`, `districtid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nawabganj Sadar', 2, 0, '2018-10-30 02:33:26', '2018-10-30 02:33:26'),
(2, 'Shibganj', 2, 0, '2018-10-30 02:33:45', '2018-10-30 02:33:45'),
(3, 'Gomastapur', 2, 0, '2018-10-30 02:34:07', '2018-10-30 02:34:07'),
(4, 'Bholahat', 2, 0, '2018-10-30 02:34:21', '2018-10-30 02:34:21'),
(5, 'Nachole', 2, 0, '2018-10-30 02:34:40', '2018-10-30 02:34:40'),
(6, 'Bagha', 7, 0, '2018-10-30 02:35:20', '2018-10-30 02:35:20'),
(7, 'Bagmara', 7, 0, '2018-10-30 02:35:39', '2018-10-30 02:35:39'),
(8, 'Birampur', 57, 0, '2018-10-30 02:36:29', '2018-10-30 02:36:29'),
(9, 'Birganj', 57, 0, '2018-10-30 02:36:57', '2018-10-30 02:36:57'),
(10, 'Ranihati', 2, 0, '2018-10-30 03:10:33', '2018-10-30 03:10:33');

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
(1, 'Rinku', 'rinku@gmail.com', NULL, '$2y$10$aoIgz2t6tzR4aBO2EPzfROLL45DnOLPCS.yFHf37MGnxWXi612OSm', 'DqibxPSfl0A8WR2ITu9U0E7PvClmnkFCYZRQRuENp1WkFq2eklUwx4cSy6W6', '2018-11-06 05:34:12', '2018-11-06 05:34:12'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$O76.ADcENaN6SBnHXkPj5O/OQR3mQd77zzQGkRuiCuwHTmbb4BXqC', 'Jpx8I1BUMup9ZOAa70daDAF6FT3O2LFza5ab85EHh3qApvie52idhmaaAI6R', '2018-11-06 21:36:51', '2018-11-06 21:36:51'),
(3, 'Teacher', 'teacher@gmail.com', NULL, '$2y$10$pDiyK6p9lBZFk5XKDI5OnOG3lVrBudxCP68p2YY6fHirrBnJ05bq2', 'syIxXFuVtZswOBZ1nwrleTwGXHInYw08UBaRgkNkgkHHVYTlNTEEcSpr5swz', '2018-11-06 21:37:36', '2018-11-06 21:37:36'),
(4, 'Office Assistant', 'assistant@gmail.com', NULL, '$2y$10$zluatAlikAQAxm5RconKFOHzc2eCTIdooO.kHGNiWhro49WUXfEYi', '0QieBqKQfvUF2hqBve3LgmbeBKPA6CvVuBz5QAtnKpyKqwupIPzxyw2CZzgq', '2018-11-06 21:41:42', '2018-11-06 21:41:42'),
(5, 'cordinator', 'cordinator@gmail.com', NULL, '$2y$10$aojL6UzXscfDd6/slyeCJOYJrEamXKbPM7nvA1jspH3GqK8oB6/Ua', 'FnlNUddCZONNySRmu7CNYNigH7Pnc2eE2FttxsOLOZwvjKeXul9EwyHXXDkV', '2018-11-06 21:42:49', '2018-11-06 21:42:49'),
(6, 'student', 'student@gmail.com', NULL, '$2y$10$4eKZy0zQbsdaLShw0ppG9uCW0Sw5/E7oOxeTyGxME/or9mzeESktW', 'rg6IWrGaZfpCwZ6It2bbPuYw89G5ee9oezOcYbpgHZAqXyebLjLeurRUy4wn', '2018-11-06 21:45:06', '2018-11-06 21:45:06');

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
(1, 1, 2, NULL, NULL),
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
-- Indexes for table `branches`
--
ALTER TABLE `branches`
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
-- Indexes for table `program_levels`
--
ALTER TABLE `program_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courseoffer`
--
ALTER TABLE `courseoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employeetypes`
--
ALTER TABLE `employeetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `institutecategory`
--
ALTER TABLE `institutecategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `institutesubcategory`
--
ALTER TABLE `institutesubcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `institutetype`
--
ALTER TABLE `institutetype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `localgovs`
--
ALTER TABLE `localgovs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mediums`
--
ALTER TABLE `mediums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `postoffices`
--
ALTER TABLE `postoffices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programlevels`
--
ALTER TABLE `programlevels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `programoffer`
--
ALTER TABLE `programoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `program_levels`
--
ALTER TABLE `program_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sectionoffer`
--
ALTER TABLE `sectionoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjectcodes`
--
ALTER TABLE `subjectcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
