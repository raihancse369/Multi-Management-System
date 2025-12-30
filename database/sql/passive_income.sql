-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 30, 2025 at 08:42 AM
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
-- Database: `passive_income`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `slug`, `description`, `image`, `created_at`, `updated_at`) VALUES
(4, 'We are Professional Teams to Growth your Business', 'we-are-professional-teams-to-growth-your-business', '<p style=\"line-height: 1.5;\">The system includes advanced modules for eCommerce, HRM, CMS, and Corporate Management, all integrated into a single platform.This shows <strong data-start=\"1298\" data-end=\"1320\">full-stack mastery</strong>. This system is not a single script.It is a Full Enterprize Grade Solution.People buy&nbsp;HRM System,Accounting System,Ecommerce System,CRM System,Project Management System,Multi-Vendor Script and&nbsp;Inventory System.I&nbsp;already have <strong data-start=\"2109\" data-end=\"2131\">combination of ALL</strong> </p><p>→ This is rare and very valuable.</p><p>Unknown has 9+ years of experience and a strong global reputation, which\r\n makes us the best software development company in Bangladesh and \r\nglobally as well. We have more than 45 ready-made software solutions for\r\n business automation. We are available for the best custom software \r\ndevelopment services to accelerate your business growth.</p>', 'we-are-professional-teams-to-growth-your-business_1760956113.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `att_date` varchar(255) NOT NULL,
  `att_month` varchar(255) NOT NULL,
  `att_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `att_date`, `att_month`, `att_year`, `status`, `created_at`, `updated_at`) VALUES
(21, 8, '2025-10-15', 'October', '2025', 'Present', NULL, '2025-10-15 10:42:35'),
(22, 9, '2025-10-15', 'October', '2025', 'Present', NULL, '2025-10-15 10:42:35'),
(23, 14, '2025-10-15', 'October', '2025', 'Present', NULL, '2025-10-15 10:42:35'),
(24, 15, '2025-10-15', 'October', '2025', 'Absence', NULL, '2025-10-15 10:42:35'),
(25, 16, '2025-10-15', 'October', '2025', 'Absence', NULL, '2025-10-15 10:42:35'),
(26, 8, '2025-10-16', 'October', '2025', 'Present', NULL, NULL),
(27, 9, '2025-10-16', 'October', '2025', 'Present', NULL, NULL),
(28, 14, '2025-10-16', 'October', '2025', 'Absence', NULL, NULL),
(29, 15, '2025-10-16', 'October', '2025', 'Present', NULL, NULL),
(30, 16, '2025-10-16', 'October', '2025', 'Present', NULL, NULL),
(31, 8, '2025-10-19', 'October', '2025', 'Present', NULL, NULL),
(32, 9, '2025-10-19', 'October', '2025', 'Present', NULL, NULL),
(33, 14, '2025-10-19', 'October', '2025', 'Present', NULL, NULL),
(34, 15, '2025-10-19', 'October', '2025', 'Present', NULL, NULL),
(35, 16, '2025-10-19', 'October', '2025', 'Present', NULL, NULL),
(36, 8, '2025-10-20', 'October', '2025', 'Present', NULL, NULL),
(37, 9, '2025-10-20', 'October', '2025', 'Present', NULL, NULL),
(38, 14, '2025-10-20', 'October', '2025', 'Present', NULL, NULL),
(39, 15, '2025-10-20', 'October', '2025', 'Present', NULL, NULL),
(40, 16, '2025-10-20', 'October', '2025', 'Present', NULL, NULL),
(41, 8, '2025-10-21', 'October', '2025', 'Present', NULL, '2025-11-02 20:29:37'),
(42, 9, '2025-10-21', 'October', '2025', 'Present', NULL, '2025-11-02 20:29:37'),
(43, 14, '2025-10-21', 'October', '2025', 'Present', NULL, '2025-11-02 20:29:37'),
(44, 15, '2025-10-21', 'October', '2025', 'Present', NULL, '2025-11-02 20:29:37'),
(45, 16, '2025-10-21', 'October', '2025', 'Absence', NULL, '2025-11-02 20:29:37'),
(46, 8, '2025-10-22', 'October', '2025', 'Present', NULL, NULL),
(47, 9, '2025-10-22', 'October', '2025', 'Present', NULL, NULL),
(48, 14, '2025-10-22', 'October', '2025', 'Present', NULL, NULL),
(49, 15, '2025-10-22', 'October', '2025', 'Absence', NULL, NULL),
(50, 16, '2025-10-22', 'October', '2025', 'Present', NULL, NULL),
(51, 8, '2025-10-23', 'October', '2025', 'Present', NULL, NULL),
(52, 9, '2025-10-23', 'October', '2025', 'Present', NULL, NULL),
(53, 14, '2025-10-23', 'October', '2025', 'Present', NULL, NULL),
(54, 15, '2025-10-23', 'October', '2025', 'Present', NULL, NULL),
(55, 16, '2025-10-23', 'October', '2025', 'Present', NULL, NULL),
(56, 8, '2025-10-26', 'October', '2025', 'Present', NULL, NULL),
(57, 9, '2025-10-26', 'October', '2025', 'Present', NULL, NULL),
(58, 14, '2025-10-26', 'October', '2025', 'Present', NULL, NULL),
(59, 15, '2025-10-26', 'October', '2025', 'Present', NULL, NULL),
(60, 16, '2025-10-26', 'October', '2025', 'Present', NULL, NULL),
(61, 8, '2025-10-27', 'October', '2025', 'Present', NULL, NULL),
(62, 9, '2025-10-27', 'October', '2025', 'Present', NULL, NULL),
(63, 14, '2025-10-27', 'October', '2025', 'Present', NULL, NULL),
(64, 15, '2025-10-27', 'October', '2025', 'Present', NULL, NULL),
(65, 16, '2025-10-27', 'October', '2025', 'Present', NULL, NULL),
(66, 8, '2025-10-28', 'October', '2025', 'Present', NULL, NULL),
(67, 9, '2025-10-28', 'October', '2025', 'Present', NULL, NULL),
(68, 14, '2025-10-28', 'October', '2025', 'Present', NULL, NULL),
(69, 15, '2025-10-28', 'October', '2025', 'Present', NULL, NULL),
(70, 16, '2025-10-28', 'October', '2025', 'Present', NULL, NULL),
(71, 8, '2025-10-29', 'October', '2025', 'Present', NULL, NULL),
(72, 9, '2025-10-29', 'October', '2025', 'Absence', NULL, NULL),
(73, 14, '2025-10-29', 'October', '2025', 'Absence', NULL, NULL),
(74, 15, '2025-10-29', 'October', '2025', 'Present', NULL, NULL),
(75, 16, '2025-10-29', 'October', '2025', 'Present', NULL, NULL),
(76, 8, '2025-10-30', 'October', '2025', 'Present', NULL, NULL),
(77, 9, '2025-10-30', 'October', '2025', 'Present', NULL, NULL),
(78, 14, '2025-10-30', 'October', '2025', 'Present', NULL, NULL),
(79, 15, '2025-10-30', 'October', '2025', 'Present', NULL, NULL),
(80, 16, '2025-10-30', 'October', '2025', 'Present', NULL, NULL),
(81, 8, '2025-11-01', 'November', '2025', 'Present', NULL, NULL),
(82, 9, '2025-11-01', 'November', '2025', 'Present', NULL, NULL),
(83, 14, '2025-11-01', 'November', '2025', 'Present', NULL, NULL),
(84, 15, '2025-11-01', 'November', '2025', 'Present', NULL, NULL),
(85, 16, '2025-11-01', 'November', '2025', 'Absence', NULL, NULL),
(86, 8, '2025-11-02', 'November', '2025', 'Present', NULL, NULL),
(87, 9, '2025-11-02', 'November', '2025', 'Present', NULL, NULL),
(88, 14, '2025-11-02', 'November', '2025', 'Present', NULL, NULL),
(89, 15, '2025-11-02', 'November', '2025', 'Present', NULL, NULL),
(90, 16, '2025-11-02', 'November', '2025', 'Present', NULL, NULL),
(91, 8, '2025-11-04', 'November', '2025', 'Present', NULL, NULL),
(92, 9, '2025-11-04', 'November', '2025', 'Present', NULL, NULL),
(93, 14, '2025-11-04', 'November', '2025', 'Present', NULL, NULL),
(94, 15, '2025-11-04', 'November', '2025', 'Present', NULL, NULL),
(95, 16, '2025-11-04', 'November', '2025', 'Present', NULL, NULL),
(96, 8, '2025-11-05', 'November', '2025', 'Present', NULL, NULL),
(97, 9, '2025-11-05', 'November', '2025', 'Present', NULL, NULL),
(98, 14, '2025-11-05', 'November', '2025', 'Present', NULL, NULL),
(99, 15, '2025-11-05', 'November', '2025', 'Present', NULL, NULL),
(100, 16, '2025-11-05', 'November', '2025', 'Absence', NULL, NULL),
(101, 8, '2025-11-06', 'November', '2025', 'Present', NULL, NULL),
(102, 9, '2025-11-06', 'November', '2025', 'Present', NULL, NULL),
(103, 14, '2025-11-06', 'November', '2025', 'Present', NULL, NULL),
(104, 15, '2025-11-06', 'November', '2025', 'Present', NULL, NULL),
(105, 16, '2025-11-06', 'November', '2025', 'Present', NULL, NULL),
(106, 8, '2025-11-07', 'November', '2025', 'Present', NULL, NULL),
(107, 9, '2025-11-07', 'November', '2025', 'Present', NULL, NULL),
(108, 14, '2025-11-07', 'November', '2025', 'Present', NULL, NULL),
(109, 15, '2025-11-07', 'November', '2025', 'Present', NULL, NULL),
(110, 16, '2025-11-07', 'November', '2025', 'Present', NULL, NULL),
(111, 8, '2025-11-08', 'November', '2025', 'Present', NULL, NULL),
(112, 9, '2025-11-08', 'November', '2025', 'Present', NULL, NULL),
(113, 14, '2025-11-08', 'November', '2025', 'Present', NULL, NULL),
(114, 15, '2025-11-08', 'November', '2025', 'Present', NULL, NULL),
(115, 8, '2025-11-10', 'November', '2025', 'Present', NULL, NULL),
(116, 9, '2025-11-10', 'November', '2025', 'Present', NULL, NULL),
(117, 14, '2025-11-10', 'November', '2025', 'Present', NULL, NULL),
(118, 8, '2025-11-14', 'November', '2025', 'Present', NULL, NULL),
(119, 9, '2025-11-14', 'November', '2025', 'Present', NULL, NULL),
(120, 14, '2025-11-14', 'November', '2025', 'Present', NULL, NULL),
(121, 8, '2025-11-15', 'November', '2025', 'Present', NULL, NULL),
(122, 9, '2025-11-15', 'November', '2025', 'Present', NULL, NULL),
(123, 14, '2025-11-15', 'November', '2025', 'Present', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `award_name` varchar(255) DEFAULT NULL,
  `award_prize` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `employee_id`, `award_name`, `award_prize`, `date`, `month`, `year`, `details`, `created_at`, `updated_at`) VALUES
(4, 9, 'Best employee of the month', 'Iphone 12', '05-10-2025', 'October', '2025', 'Best employee got this reward', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogcategories`
--

CREATE TABLE `blogcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogcategories`
--

INSERT INTO `blogcategories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(8, 'Python', 'python', NULL, NULL),
(9, 'Java', 'java', NULL, NULL),
(10, 'PHP', 'php', NULL, NULL),
(12, 'Laravel Web Development', 'laravel-web-development', NULL, NULL),
(14, 'Data Science', 'data-science', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(17, 'Stripe', 'stripe', 'stripe_1761024637.png', 'Yes', NULL, NULL),
(18, 'Airbnb', 'airbnb', 'airbnb_1761024480.png', 'Yes', NULL, NULL),
(19, 'Nike', 'nike', 'nike_1762232187.jpg', 'Yes', NULL, NULL),
(22, 'Samsung', 'samsung', 'samsung_1762232221.png', 'Yes', NULL, NULL),
(25, 'Nikon', 'nikon', 'nikon_1762232359.jpg', 'Yes', NULL, NULL),
(27, 'Huawei', 'huawei', 'huawei.png', 'Yes', NULL, NULL),
(28, 'Puma', 'puma', 'puma.jpg', 'Yes', NULL, NULL),
(29, 'Otobi', 'otobi', 'otobi.jpg', 'Yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `slug`, `start_date`, `end_date`, `image`, `status`, `discount`, `month`, `year`, `created_at`, `updated_at`) VALUES
(7, 'Limited Time Offer', 'limited-time-offer', '2025-12-26', '2026-12-29', 'hurry-upbuy-fast.jpg', '1', '10', 'December', '2025', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campaign_product`
--

CREATE TABLE `campaign_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_product`
--

INSERT INTO `campaign_product` (`id`, `campaign_id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(26, 7, '82', '1080', NULL, NULL),
(27, 7, '81', '1080', NULL, NULL),
(29, 7, '80', '5400', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(14, 'Computer', 'computer', NULL, '2025-12-19 07:57:20'),
(15, 'Laptop', 'laptop', NULL, '2025-11-07 08:27:01'),
(27, 'Camera', 'camera', NULL, NULL),
(28, 'Smartphone', 'smartphone', NULL, NULL),
(31, 'Speckers', 'speckers', NULL, '2025-11-07 08:00:33'),
(34, 'Monitor', 'monitor', '2025-11-07 08:27:17', '2025-11-08 06:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `user_id`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(9, 'Redwan Roni', 9, 'redwan@live.com', 'Share resolution timeline', 'The team let me know they’re working to resolve this. I should have a resolution for you by time.', NULL, NULL),
(10, 'Normal User', 7, 'user@live.com', 'Feedback', 'Thanks for sharing your experience with us ! We love that you had such a positive experience. Please let me know if there’s anything else we can help with.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `valid_date` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `coupon_amount` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `valid_date`, `type`, `coupon_amount`, `status`, `created_at`, `updated_at`) VALUES
(6, 'DiscountMe', '2025-10-30', 'Fixed', 300, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'Software Developer', NULL, NULL),
(2, 'Database Administrator', NULL, NULL),
(4, 'AI Engineer', NULL, NULL),
(5, 'Data Engineer', NULL, NULL),
(6, 'SQL Engineer', NULL, NULL),
(7, 'Cheif Executive Officer', NULL, NULL),
(8, 'Project Manager', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 'Full Stack Developer', NULL, NULL),
(2, 'Mechine Learning Engineer', NULL, NULL),
(3, 'Data Engineer', NULL, NULL),
(5, 'Project Manager', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `joining_date` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `designation_id`, `employee_id`, `name`, `slug`, `nid`, `joining_date`, `salary`, `email`, `phone`, `address`, `image`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 'XSE3301', 'Redwan Roni', 'redwan-roni', '19944817928000402', '2025-10-01', '10000', 'redwan@live.com', '01832343496', 'Gulshan Link Road Dhaka', 'redwan-roni_68fefbba1110a.jpg', NULL, NULL),
(9, 4, 2, 'CSE3309', 'Sabrina Nipa', 'sabrina-nipa', '15883245', '2025-10-01', '30000', 'pythondeveloper@live.com', '01301959439', 'Tongi Station Road Dhaka', 'delwar-jahan-imran_68fefbcdb7a4f.jpg', NULL, NULL),
(14, 2, 3, 'RSA33031', 'Rumana Rume', 'rumana-rume', NULL, NULL, '10000', 'phpdeveloper@live.com', '01675371770', 'Gandareya DIT Road Dhaka', 'rumana-rume_68fefc0837a7b.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `details` text NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `type_id`, `details`, `amount`, `date`, `month`, `created_at`, `updated_at`) VALUES
(38, 6, 'Two packet taharee with cold drinks', '200', '2025-01-01', 'January', NULL, NULL),
(39, 7, 'Photocopy bills', '200', '2025-01-10', 'January', NULL, NULL),
(43, 7, 'Internet bill', '500', '2025-02-12', 'February', NULL, NULL),
(44, 7, 'Photocopy for official files', '100', '2025-04-15', 'April', NULL, NULL),
(45, 5, 'Kachhi&nbsp; 1 plate with cokes', '100', '2025-10-22', 'October', NULL, NULL),
(46, 6, '<p>Tea and lunch bill for client</p><p><br></p>', '500', '2025-11-03', 'November', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expensetypes`
--

CREATE TABLE `expensetypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensetypes`
--

INSERT INTO `expensetypes` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(5, 'Lunch Bill', NULL, NULL),
(6, 'Travel Bill', NULL, NULL),
(7, 'Other Costs', NULL, NULL);

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
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `footer_title` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `address_two` longtext DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `disclaimer` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `footer_title`, `address`, `address_two`, `email`, `phone`, `copyright_text`, `disclaimer`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Best Software Development Company To develop any kind of software solution to automate your business operations according to your requirements.', 'Street Address building etc', '301 The Greenhouse, Custard Factory, London, E2 8DY.', 'raihancse369@gmail.com', '01301959439', 'All Rights Reserved.', 'Here all software, apps, themes, plugins, are our own property. Therefore copying or reselling is strictly prohibited.', '1847114634625467.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `num_of_days` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `type`, `name`, `from`, `to`, `num_of_days`, `month`, `year`, `created_at`, `updated_at`) VALUES
(5, 'Offday', 'Office Off', '2025-10-17', '2025-10-18', '2', 'October', '2025', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `leave_day` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `type_id`, `start_date`, `end_date`, `leave_day`, `date`, `month`, `year`, `status`, `created_at`, `updated_at`) VALUES
(2, 9, 2, '2025-10-04', '2025-10-06', '3', '04-10-2025', 'October', '2025', 1, NULL, NULL),
(3, 8, 1, '2025-10-04', '2025-10-08', '5', '04-10-2025', 'October', '2025', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leavetypes`
--

CREATE TABLE `leavetypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `leave_day` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leavetypes`
--

INSERT INTO `leavetypes` (`id`, `type_name`, `leave_day`, `created_at`, `updated_at`) VALUES
(1, 'Personal Leave', '3', NULL, NULL),
(2, 'Casual Leave', '6', NULL, NULL),
(6, 'Medical Leave', '9', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_01_31_090117_create_categories_table', 2),
(7, '2025_01_31_111241_create_subcategories_table', 3),
(8, '2025_02_01_144526_create_sites_table', 4),
(9, '2025_02_07_142233_create_sliders_table', 5),
(10, '2025_02_15_084743_create_expensetypes_table', 6),
(11, '2025_02_15_113454_create_expenses_table', 7),
(12, '2025_02_15_133007_create_departments_table', 8),
(13, '2025_02_15_135537_create_designations_table', 9),
(15, '2025_02_18_133557_create_employees_table', 10),
(16, '2025_04_10_180746_create_abouts_table', 11),
(17, '2025_05_11_154935_create_blogcategories_table', 12),
(18, '2025_05_13_153726_create_brands_table', 13),
(19, '2025_05_14_104148_create_pages_table', 14),
(20, '2025_05_15_064030_create_seos_table', 15),
(21, '2025_05_15_133108_create_smtps_table', 16),
(22, '2025_05_17_101408_create_tickets_table', 17),
(23, '2025_05_17_135934_create_replies_table', 18),
(24, '2025_09_04_051852_create_posts_table', 19),
(25, '2025_09_07_045846_create_products_table', 20),
(26, '2025_09_08_150451_create_reviews_table', 21),
(27, '2025_09_08_153825_create_wbreviews', 22),
(28, '2025_09_08_163840_create_orders_table', 23),
(29, '2025_09_08_165741_create_order_details_table', 24),
(30, '2025_09_09_011256_create_campaigns_table', 25),
(31, '2025_09_09_011500_create_campaign_product_table', 26),
(32, '2025_09_09_011851_create_coupons_table', 27),
(33, '2025_09_13_103849_create_wishlists_table', 28),
(34, '2025_09_19_133711_create_shippings_table', 29),
(35, '2025_10_03_152150_create_holidays_table', 30),
(36, '2025_10_04_091047_create_leavetypes_table', 31),
(37, '2025_10_04_100354_create_leaves_table', 32),
(38, '2025_10_05_052544_create_awards_table', 33),
(39, '2025_10_12_164230_create_attendances_table', 34),
(40, '2025_10_12_170954_create_attendances_table', 35),
(41, '2025_10_16_071205_create_services_table', 36),
(42, '2025_10_17_181258_create_projects_table', 37),
(43, '2025_10_22_061824_create_serves_table', 38),
(44, '2025_10_26_144001_create_footers_table', 39),
(45, '2025_10_28_143942_create_contacts_table', 40),
(46, '2025_11_02_174453_create_payrolls_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_phone` varchar(255) DEFAULT NULL,
  `c_email` varchar(255) DEFAULT NULL,
  `c_country` varchar(255) DEFAULT NULL,
  `c_zipcode` varchar(255) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `c_extra_phone` varchar(255) DEFAULT NULL,
  `c_city` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_discount` varchar(255) DEFAULT NULL,
  `after_discount` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `shipping_charge` varchar(5) DEFAULT NULL,
  `order_id` varchar(25) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `date` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `c_name`, `c_phone`, `c_email`, `c_country`, `c_zipcode`, `c_address`, `c_extra_phone`, `c_city`, `subtotal`, `total`, `coupon_code`, `coupon_discount`, `after_discount`, `payment_type`, `tax`, `shipping_charge`, `order_id`, `status`, `date`, `month`, `year`, `created_at`, `updated_at`) VALUES
(15, 1, 'Normal User', '01312195701', 'redwan@live.com', 'Bangladesh', '2326', NULL, '01312195701', 'Dhaka', '600.00', '690.00', NULL, NULL, NULL, 'Hand Cash', '0', '0', '150460', 1, '29-10-2025', 'October', '2025', NULL, NULL),
(16, 1, 'Normal User', '01312195701', 'redwan@live.com', 'Bangladesh', '2326', NULL, '01312195701', 'Dhaka', '600.00', '690.00', 'DiscountMe', '300', '300', 'Hand Cash', '0', '0', '126984', 1, '29-10-2025', 'October', '2025', NULL, NULL),
(17, 1, 'Normal User', '01312195701', 'redwan@live.com', 'Bangladesh', '2326', NULL, '01312195701', 'Dhaka', '900.00', '1035.00', 'DiscountMe', '300', '600', 'Hand Cash', '0', '0', '309699', 1, '29-10-2025', 'October', '2025', NULL, NULL),
(18, 1, 'Normal User', '01312195701', 'redwan@live.com', 'Bangladesh', '2326', NULL, '01312195701', 'Dhaka', '1200.00', '1380.00', NULL, NULL, NULL, 'Hand Cash', '0', '0', '560857', 1, '29-10-2025', 'October', '2025', NULL, NULL),
(19, 4, 'Jahangir Alam', '013xxxxxxxx', 'jahangirdep@gmail.com', 'Bangladesh', '2326', NULL, '013xxxxxxxx', 'Dhaka', '600.00', '690.00', NULL, NULL, NULL, 'Hand Cash', '0', '0', '432659', 1, '02-11-2025', 'November', '2025', NULL, NULL),
(20, 4, 'Jahangir Alam', '013xxxxxxxx', 'jahangirdep@gmail.com', 'Bangladesh', '2326', NULL, '013xxxxxxxx', 'Dhaka', '900.00', '1035.00', NULL, NULL, NULL, 'Hand Cash', '0', '0', '864952', 1, '02-11-2025', 'November', '2025', NULL, NULL),
(21, 7, 'Normal User', '013xxxxxxxx', 'jahangirdep@gmail.com', 'Bangladesh', '2326', NULL, '013xxxxxxxx', 'Dhaka', '1800.00', '2070.00', NULL, NULL, NULL, 'Hand Cash', '0', '0', '73451', 1, '14-11-2025', 'November', '2025', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `single_price` varchar(255) DEFAULT NULL,
  `subtotal_price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `color`, `size`, `quantity`, `single_price`, `subtotal_price`, `created_at`, `updated_at`) VALUES
(16, 15, 75, 'HighTech Speaker', 'Black', 'Shape', '1', '600', '600', NULL, NULL),
(17, 16, 74, 'Deko Speaker', 'Silver', 'Shape', '1', '600', '600', NULL, NULL),
(18, 17, 72, 'Wireless Airpod', 'Black', 'Square', '1', '900', '900', NULL, NULL),
(19, 18, 79, 'GTX5503', 'Black', 'Shape', '1', '1200', '1200', NULL, NULL),
(20, 19, 75, 'HighTech Speaker', 'Black', 'Shape', '1', '600', '600', NULL, NULL),
(21, 20, 72, 'Wireless Airpod', 'Black', 'Shape', '1', '900', '900', NULL, NULL),
(22, 21, 75, 'HighTech Speaker', 'Silver', 'Shape', '3', '600', '1800', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_position` int(11) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_position`, `page_name`, `page_slug`, `page_title`, `page_description`, `created_at`, `updated_at`) VALUES
(8, 1, 'General', 'general', 'What is Demo ?', 'Demo is a group of companies that provide offshore software development \r\n( IoT &amp; Big Data, AI &amp; Deep Learning, Fintech &amp; Block Chain, \r\nCloud &amp; Enterprise Solution and Smartphone &amp; Embedded \r\nApplication ), Application Management as a Service and Software Testing \r\n&amp; Automation services.', NULL, NULL),
(9, 1, 'FAQ', 'faq', 'How long has Demo been in business ?', 'Demo started its journey \r\non 30th July, 2001 in Dhaka, Bangladesh. Later&nbsp;Demo&nbsp;Inc was founded in \r\nJapan as a group company of&nbsp;Demo&nbsp;Group. Now&nbsp;Demo&nbsp;is working in more than\r\n 8 countries.Why choose Demo over other software companies ?\r\n      \r\n      \r\n        \r\n          \r\n            \r\n              \r\n                Keeping top priority on client\'s requirements,&nbsp;Demo&nbsp;also possesses - \r\nImpeccable quality - Global experience - Reduced price - Global setup. \r\n              \r\n            \r\n          \r\n        \r\n      \r\n    ', NULL, NULL),
(10, 2, 'Why choose us', 'why-choose-us', 'Why choose Demo over other software companies ?', 'Keeping top priority on client\'s requirements,&nbsp;Demo&nbsp;also possesses - \r\nImpeccable quality - Global experience - Reduced price - Global setup.Demo started its journey \r\non 30th July, 2001 in Dhaka, Bangladesh. Later&nbsp;Demo&nbsp;Inc was founded in \r\nJapan as a group company of&nbsp;Demo&nbsp;Group.&nbsp;', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deductions` decimal(10,2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee_id`, `month`, `year`, `basic_salary`, `bonus`, `deductions`, `net_salary`, `created_at`, `updated_at`) VALUES
(2, 8, 'October', '2025', 20000.00, 0.00, 0.00, 20000.00, '2025-11-02 12:22:16', '2025-11-07 02:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` longtext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `details`, `user_id`, `image`, `slug`, `tags`, `date`, `created_at`, `updated_at`) VALUES
(37, 8, 'First Python Program', 'Computers and programs are everywhere in today\'s world. Programs affect many aspects of daily life and society as a whole. People depend on programs for communication, shopping, entertainment, health care, and countless other needs. Learning how to program computers opens the door to many careers and opportunities for building a better world.Programs consist of statements to be run one after the other. A statement describes some action to be carried out. The statement print(\"Good morning\") instructs Python to output the message \"Good morning\" to the user. The statement count = 0 instructs Python to assign the integer 0 to the variable count. This chapter introduces statements for input and output, assigning variables, and basic arithmetic. Making mistakes is a normal part of programming, and the chapter includes advice on understanding error messages. The chapter ends with a short history of Python and discusses why Python has become so popular today.', 2, 'pythonsyntex_1759864162.jpeg', 'first-python-program', 'Python,syntex', '2025-10-07', NULL, NULL),
(38, 8, 'Variable, Data Type and Data Input', '<span data-huuid=\"9642003261638235943\"><span>Python variables are used to store data, and they do not require explicit type declaration.</span><span> </span></span><span data-huuid=\"9642003261638238180\"><span>Python automatically infers the data type based on the value assigned.</span><span> </span></span><span data-huuid=\"9642003261638236321\"><span>Common built-in data types include</span><span class=\"pjBG2e\" data-cid=\"f315ef50-8baf-42ee-8a44-11b66ada8274\"><span class=\"UV3uM\">&nbsp;</span></span></span>', 2, 'pythonvariablesdata-types_1760718035.jpg', 'variable-data-type-and-data-input', 'Python,variables,data types', '2025-10-17', NULL, NULL),
(39, 8, 'Operator #', 'Operators are special symbols that perform operations on <a href=\"https://www.programiz.com/python-programming/variables-constants-literals\">variables </a> and values. For example,', 2, 'operators_1760718078.jpg', 'operator', 'operators', '2025-10-17', NULL, NULL),
(43, 8, 'কমেন্ট #', '<blockquote class=\"book-hint info\"><p>কোডের সাথে অসংগতিপূর্ণ কমেন্ট, কোনো কমেন্ট না করার চেয়েও বাজে ব্যাপার।</p></blockquote><p>এ\r\n বিষয়টি একেবারেই ছোট। খুব অল্পতেই এর আলোচনা শেষ হয়ে যাবে। কিন্তু এর \r\nপ্রভাব খুব দীর্ঘমেয়াদি। আমরা শুধু এ বিষয়ের মধ্যেই একে সীমাবদ্ধ রাখব না; \r\nবরং বিভিন্ন ক্ষেত্রে কমেন্টের ব্যবহার আমাদের শিখতে হবে।\r\nপ্রথমেই আমরা জানব যে কমেন্ট আসলে কী জিনিস। ইতিমধ্যে আমরা ছোট-ছোট কয়েকটা \r\nপ্রোগ্রাম লিখেছি। সেখানে ভেরিয়েবল ছিল অল্প। পাইথনের বড় কোনো বাস্তবায়ন \r\nকিন্তু সেখানে নেই। যখন কোনো বড় প্রজেক্টে আমরা হাত দেব, তখন বিভিন্ন জিনিস\r\n আমাদের কমেন্ট করে রাখা উচিত। কোন ভেরিয়েবল কী জন্য ডিক্লেয়ার করেছি, কোন \r\nফাংশনের কী কাজ, কোন ক্লাস কী জন্য দরকার পড়েছে ইত্যাদি জিনিস কমেন্ট করে \r\nলিখে রাখা উচিত। এর ফলে অনেক দিন বাদে আমরা যখন পুরোনো প্রোগ্রাম নিয়ে কাজ \r\nকরতে যাব, তখন বুঝতে সুবিধা হবে। শুধু তা-ই নয়, অন্যরাও আমাদের প্রোগ্রাম \r\nপড়ে সহজে বুঝতে পারবে। কমেন্ট কখনো এক্সিকিউট হয় না। আসলে কমেন্ট হলো এমন \r\nকিছু স্টেটমেন্ট, যা ইন্টারপ্রিটার কস্মিনকালেও ইন্টারপ্রিট করবে না।\r\nকমেন্ট পূর্ণাঙ্গ বাক্যের মতো হওয়া উচিত, তবে চাইলে বাক্যাংশ (phrase) \r\nব্যবহার করা যায়। যা-ই হোক, কমেন্ট সব সময় বড় হাতের অক্ষর দিয়ে শুরু করা \r\nউচিত, যদি না শুরুতে কোনো আইডেন্টিফায়ার থাকে। কমেন্ট ছোট হলে শেষে \r\nযতিচিহ্ন না দিলেও চলে।\r\nতবে ব্লক কমেন্টে যেহেতু পূর্ণাঙ্গ বাক্য থাকে তাই তার শেষে যতিচিহ্ন দেওয়া\r\n বাঞ্ছনীয়।\r\nএ ছাড়া পাইথনের কোনো লাইনে, কোনো স্টেটমেন্টের আগে <code>#</code> চিহ্ন দিলে তা আর এক্সিকিউট হয় না। যেমন :</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#ae81ff\">23</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#75715e\"># a is an int variable</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">...</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span></span></span></code></pre></div><h2 id=\"ইনলইন-কমনট\">ইনলাইন কমেন্ট<a class=\"anchor\" href=\"https://python.maateen.me/docs/comment/#%e0%a6%87%e0%a6%a8%e0%a6%b2%e0%a6%87%e0%a6%a8-%e0%a6%95%e0%a6%ae%e0%a6%a8%e0%a6%9f\">#</a></h2><p>স্টেটমেন্টের\r\n সাথে একই লাইনে থাকা কমেন্টকে ইনলাইন কমেন্ট বলে। কমপক্ষে দুটি স্পেস দিয়ে\r\n ইনলাইন কমেন্টকে স্টেটমেন্ট থেকে আলাদা করতে হয়।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#ae81ff\">15</span>  <span style=\"color:#75715e\"># a is a dividend</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> <span style=\"color:#ae81ff\">3</span>  <span style=\"color:#75715e\"># b is a divisor</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">/</span>b\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">5.0</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span></span></span></code></pre></div><p>প্রতি লাইনের যে অংশে <code>#</code> পাবে তারপর থেকে সেই লাইন আর এক্সিকিউট হবে না। তাহলে নিচের লাইনের আউটপুট কি হবে?</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\"I like the # symbole.\"</span>)</span></span></code></pre></div><h2 id=\"বলক-কমনট\">ব্লক কমেন্ট<a class=\"anchor\" href=\"https://python.maateen.me/docs/comment/#%e0%a6%ac%e0%a6%b2%e0%a6%95-%e0%a6%95%e0%a6%ae%e0%a6%a8%e0%a6%9f\">#</a></h2><p>ব্লক কমেন্ট বলতে মাল্টি-লাইন কমেন্টকেই বুঝায়। তবে পাইথনে মাল্টি-লাইন কমেন্ট করার জন্য আলাদা কোনকিছু নাই। <code>#</code> দিয়ে লাইন-বাই-লাইন কমেন্ট করতে হয়। ব্লকের প্রতিটা লাইন <code>#</code> চিহ্ন ও এর পরে একটা স্পেস দিয়ে শুরু হয়। যেমন:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#75715e\"># a is an int variable</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">...</span> <span style=\"color:#75715e\"># This is another comment.</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">...</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span></span></span></code></pre></div><h2 id=\"ডকমনট-সটর-ব-ডকসটর\">ডকুমেন্ট স্ট্রিং বা ডকস্ট্রিং<a class=\"anchor\" href=\"https://python.maateen.me/docs/comment/#%e0%a6%a1%e0%a6%95%e0%a6%ae%e0%a6%a8%e0%a6%9f-%e0%a6%b8%e0%a6%9f%e0%a6%b0-%e0%a6%ac-%e0%a6%a1%e0%a6%95%e0%a6%b8%e0%a6%9f%e0%a6%b0\">#</a></h2><p>কখনো কখনো একসাথে কয়েক লাইন কমেন্ট লেখার দরকার হয়ে পড়ে। তখন এ ধরনের কমেন্ট ফরম্যাট ব্যবহার করা হয়। <code>\"\"\"...\"\"\"</code>\r\n (শুরুতে ডবল কোটেশন মার্ক ৩টি এবং শেষেও ডবল কোটেশন মার্ক তিনটি) এর ভেতরে\r\n যা লেখা থাকবে তা-ই ডকস্ট্রিং হিসেবে বিবেচিত হবে। আর বোমা ফাটানোর মতো \r\nকথা হলো, ট্রিপল কোটের ভেতরের এসবও স্ট্রিং। আমরা চাইলে এভাবেও স্ট্রিং \r\nডিক্লেয়ার করতে পারি। যেমন :</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\"\"\"\r\n</span></span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">... a is an int variable.\r\n</span></span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">... This is another comment.\r\n</span></span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">... \"\"\"</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'</span><span style=\"color:#ae81ff\">\\n</span><span style=\"color:#e6db74\">a is an int variable.</span><span style=\"color:#ae81ff\">\\n</span><span style=\"color:#e6db74\">This is another comment.</span><span style=\"color:#ae81ff\">\\n</span><span style=\"color:#e6db74\">\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span></span></span></code></pre></div><p>স্টাইল\r\n গাইড চ্যাপ্টারে ডকস্ট্রিং সম্পর্কে বিস্তারিত আলোচনা করা হবে। আপাতত যা \r\nজানলাম তা হল জানার জন্য জানা, শুধুমাত্র মাথায় রাখার জন্য।</p><p>এই হল \r\nপাইথনে কমেন্টের ব্যাপার-স্যাপার। বাকিটা ধাপে ধাপে শিখে যাব আমরা, বিশেষ \r\nকরে কোথায় কোথায় কমেন্ট ব্যবহার করা বাঞ্ছনীয় সেটা। কিভাবে কমেন্ট ব্যবহার \r\nকরব সেটাও কিন্তু একটা ব্যাপার বটে!</p>', 2, 'comments_1760718231.jpg', 'comments', 'comments', '2025-10-17', NULL, NULL);
INSERT INTO `posts` (`id`, `category_id`, `title`, `details`, `user_id`, `image`, `slug`, `tags`, `date`, `created_at`, `updated_at`) VALUES
(44, 8, 'স্ট্রিং ম্যানিপুলেশন #', '<p>আগেই আমরা জেনেছি: সিঙ্গেল কোট বা ডাবল কোটের ভিতরে যাই থাকে তাকেই \r\nস্ট্রিং বলে। স্ট্রিং হল টেক্সট বা কোন লেখা। (ডকস্ট্রিংকে হিসাবের বাইরে \r\nরাখলে) পাইথনে স্ট্রিং দুইভাবে ডিক্লেয়ার করা যায়। সিঙ্গেল কোট দিয়ে অথবা \r\nডাবল কোট দিয়ে। দুইটারই সুবিধা-অসুবিধা রয়েছে।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"desh\"</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> type(a)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&lt;</span><span style=\"color:#66d9ef\">class</span> <span style=\"color:#960050;background-color:#1e0010\">\'</span><span style=\"color:#a6e22e\">str</span><span style=\"color:#e6db74\">\'&gt;</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> type(b)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&lt;</span><span style=\"color:#66d9ef\">class</span> <span style=\"color:#960050;background-color:#1e0010\">\'</span><span style=\"color:#a6e22e\">str</span><span style=\"color:#e6db74\">\'&gt;</span></span></span></code></pre></div><p>এই\r\n উদাহরণে আমরা সিঙ্গেল কোট আর ডাবল কোট উভয়েরই ব্যবহার দেখলাম। সিঙ্গেল \r\nকোটের কিছু অসুবিধা আছে। আমরা যদি স্ট্রিংয়ের ভিতরে কোন শব্দে বা বাক্যের \r\nকোন অংশে কোট চিহ্ন দিতে চাই তাহলে কি হয় দেখা যাক:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'Bangladesh is my \'</span>motherland<span style=\"color:#e6db74\">\', I love her very much.\'</span>\r\n</span></span><span style=\"display:flex\"><span>  File <span style=\"color:#e6db74\">\"&lt;python-input-30&gt;\"</span>, line <span style=\"color:#ae81ff\">1</span>\r\n</span></span><span style=\"display:flex\"><span>    c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'Bangladesh is my \'</span>motherland<span style=\"color:#e6db74\">\', I love her very much.\'</span>\r\n</span></span><span style=\"display:flex\"><span>                           <span style=\"color:#f92672\">^^^^^^^^^^</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#a6e22e\">SyntaxError</span>: invalid syntax</span></span></code></pre></div><p>এই সমস্যা হবার মূল কারণ হল, পাইথন যখন কোন স্ট্রিংয়ে প্রথম <code>\'</code> চিহ্নটা পায় তখন সে পরবর্তী <code>\'</code> চিহ্নের জন্য অপেক্ষা করে। পেয়ে গেলেই স্ট্রিং শেষ বলে মনে করে। অথচ আসলে স্ট্রিং সেখানে শেষ হয় না, পাইথন আরো পরে গিয়ে কোন <code>\'</code> চিহ্নটা আবার পেলে সিনট্যাক্সে ভুল আছে বলে মনে করে আর <code>SyntaxError</code> থ্রো করে। এ থেকে বাঁচার জন্য আমরা ডাবল কোট অনায়াসে ব্যবহার করতে পারি।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"Bangladesh is my \'motherland\', I love her very much.\"</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\"Bangladesh is my \'motherland\', I love her very much.\"</span></span></span></code></pre></div><p>আচ্ছা, ডাবল কোটের ভিতর যদি ডাবল কোট ব্যবহার করি কোন কারণে, তখন কি হবে? দেখা যাক:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"Bangladesh is my \"</span>motherland<span style=\"color:#e6db74\">\", I love her very much.\"</span>\r\n</span></span><span style=\"display:flex\"><span>  File <span style=\"color:#e6db74\">\"&lt;python-input-33&gt;\"</span>, line <span style=\"color:#ae81ff\">1</span>\r\n</span></span><span style=\"display:flex\"><span>    c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"Bangladesh is my \"</span>motherland<span style=\"color:#e6db74\">\", I love her very much.\"</span>\r\n</span></span><span style=\"display:flex\"><span>                           <span style=\"color:#f92672\">^^^^^^^^^^</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#a6e22e\">SyntaxError</span>: invalid syntax</span></span></code></pre></div><p>আবার সেই সিনট্যাক্স এরর। সুতরাং বিষয়টা একটু ভজকটে, বোঝাই যাচ্ছে। তাহলে আমাদের একটা ভালো সমাধান খুঁজে পাওয়া দরকার। আর সেটা হচ্ছে <code>\\</code> (ব্যাকস্লাশ) চিহ্ন ব্যবহার করা। ব্যাকস্লাশ তার ঠিক পরের সিঙ্গেল কোট বা ডাবল কোট ক্যারেক্টারটা এড়িয়ে যায়।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"Bangladesh is my </span><span style=\"color:#ae81ff\">\\\"</span><span style=\"color:#e6db74\">motherland</span><span style=\"color:#ae81ff\">\\\"</span><span style=\"color:#e6db74\">, I love her very much.\"</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'Bangladesh is my \"motherland\", I love her very much.\'</span></span></span></code></pre></div><p>একটু আগে সিঙ্গেল কোটের ক্ষেত্রে যে প্রব্লেমটা সলভ করলাম আমরা সেটাও কিন্তু একই উপায়ে সলভ করা যায়:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'Bangladesh is my </span><span style=\"color:#ae81ff\">\\\'</span><span style=\"color:#e6db74\">motherland</span><span style=\"color:#ae81ff\">\\\'</span><span style=\"color:#e6db74\">, I love her very much.\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> c\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\"Bangladesh is my \'motherland\', I love her very much.\"</span></span></span></code></pre></div><p>একটা\r\n ব্যাকস্লাশ প্রিন্ট করতে গেলে একটু কারিশমার দরকার পড়ে। কারিশমাটা হল, \r\nদুইটা ব্যাকস্লাশ দিলে একটা ব্যাকস্লাশ প্রিন্ট হয়। তাছাড়া পাইথনে <code>\\n</code> দিয়ে নিউ লাইন আর <code>\\t</code> দিয়ে ট্যাব প্রিন্ট করা হয়।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#ae81ff\">\\\'</span><span style=\"color:#e6db74\">)</span>\r\n</span></span><span style=\"display:flex\"><span>  File <span style=\"color:#e6db74\">\"&lt;python-input-37&gt;\"</span>, line <span style=\"color:#ae81ff\">1</span>\r\n</span></span><span style=\"display:flex\"><span>    print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#ae81ff\">\\\'</span><span style=\"color:#e6db74\">)</span>\r\n</span></span><span style=\"display:flex\"><span>          <span style=\"color:#f92672\">^</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#a6e22e\">SyntaxError</span>: unterminated string literal (detected at line <span style=\"color:#ae81ff\">1</span>); perhaps you escaped the end quote<span style=\"color:#960050;background-color:#1e0010\">?</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#ae81ff\">\\\\</span><span style=\"color:#e6db74\">\'</span>)\r\n</span></span><span style=\"display:flex\"><span>\\\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#ae81ff\">\\n</span><span style=\"color:#e6db74\">\'</span>)\r\n</span></span><span style=\"display:flex\"><span>\r\n</span></span><span style=\"display:flex\"><span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#ae81ff\">\\t</span><span style=\"color:#e6db74\">\'</span>)\r\n</span></span><span style=\"display:flex\"><span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span></span></span></code></pre></div><h2 id=\"সটরয়-ভযল-অযকসস\">স্ট্রিংয়ে ভ্যালু অ্যাক্সেস<a class=\"anchor\" href=\"https://python.maateen.me/docs/string-manipulation/#%e0%a6%b8%e0%a6%9f%e0%a6%b0%e0%a7%9f-%e0%a6%ad%e0%a6%af%e0%a6%b2-%e0%a6%85%e0%a6%af%e0%a6%95%e0%a6%b8%e0%a6%b8\">#</a></h2><p>আমাদের\r\n প্রথম উদাহরণটায় ফিরে আসি। এখানে a ও b এর যে ভ্যালু আমরা অ্যাসাইন করেছি \r\nতা আমরা কিভাবে অ্যাক্সেস করতে পারি? খুব সহজ ভাবে করতে গেলে নিচের মত করে:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"desh\"</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'desh\'</span></span></span></code></pre></div><p>স্বাভাবিক\r\n আমরা এভাবেই ভ্যালু অ্যাক্সেস করতে পারি। আচ্ছা, আমাদের মনে কি কখনো \r\nপ্রশ্ন জেগেছে যে স্টিং ভ্যারিয়েবলে কিভাবে থাকে? এই যে আমরা a ভ্যারিয়েবলে\r\n ৬ ক্যারেক্টারের bangla কে অ্যাসাইন করলাম এর প্রতিটা ক্যারেক্টার a এর \r\nবিভিন্ন ইনডেক্সের ভিতর থাকে। ইনডেক্স অনেকটা বহুতল ভবনের মত। জায়গা একটাই \r\nকিন্তু প্রতি তালায় ভিন্ন ভিন্ন বাসায় লোক থাকতে পারে। বিল্ডিংয়ে আমরা \r\nনিচের তলাকে গ্রাউন্ড ফ্লোর বলি আর 0 দিয়ে প্রকাশ করতে পারি। তারপর প্রথম \r\nতলাটাকে 1 দিয়ে, ২য় তলাটাকে 2 দিয়ে। এভাবে।ইনডেক্সের আইডিয়াও সেরকম। \r\nস্ট্রিংয়ের ইনডেক্স সবসময় 0 দিয়েই শুরু হবে। তাহলে bangla এই ছয়টা \r\nক্যারেক্টারের জন্য ইনডেক্সিংটা কিরকম হবে? হুম, 0, 1, 2, 3, 4, 5 এরকম। 5 এ\r\n গিয়ে শেষ হবে। 6 কিন্তু হবে না, কারণ আমরা 0 দিয়ে শুরু করেছি। এবার কিভাবে\r\n স্ট্রিংয়ে ভ্যালু অ্যাক্সেস করব তার একটা উদাহরণ দেখি:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">0</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'b\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">1</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'a\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">2</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'n\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">3</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'g\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">4</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'l\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">5</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'a\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">6</span>]\r\n</span></span><span style=\"display:flex\"><span>Traceback (most recent call last):\r\n</span></span><span style=\"display:flex\"><span>  File <span style=\"color:#e6db74\">\"&lt;python-input-42&gt;\"</span>, line <span style=\"color:#ae81ff\">1</span>, <span style=\"color:#f92672\">in</span> <span style=\"color:#f92672\">&lt;</span>module<span style=\"color:#f92672\">&gt;</span>\r\n</span></span><span style=\"display:flex\"><span>    a[<span style=\"color:#ae81ff\">6</span>]\r\n</span></span><span style=\"display:flex\"><span>    <span style=\"color:#f92672\">~^^^</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#a6e22e\">IndexError</span>: string index out of range</span></span></code></pre></div><p>আমরা অনেকেই হয়ত বুঝে ফেলেছি যে ভ্যারিয়েবলের পরে <code>[]</code>\r\n চিহ্নের ভিতরে ইনডেক্স নম্বর দিয়ে ভ্যালু অ্যাক্সেস করতে পারা যায়। শেষে \r\nএকটা এরর থ্রো করেছে পাইথন, খেয়াল করেছেন? কারণ কি? আমরা আগেই জেনেছি যে \r\nযেহেতু ক্যারেক্টার ছয়টা তাই ইনডেক্স নম্বর 0 থেকে 5 অবধি হবে। 6 এ তো কোন \r\nকিছু নাই, তাই <code>IndexError</code> থ্রো করেছে পাইথন।</p><p>আমরা কিন্তু চাইলে একটা নির্দিষ্ট সীমার ইনডেক্সের ভ্যালু অ্যাক্সেস করতে পারি। যেমন:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">1</span>:<span style=\"color:#ae81ff\">4</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'ang\'</span></span></span></code></pre></div><p>আমরা\r\n শুধু ইনডেক্স 1 থেকে 4 পর্যন্ত ভ্যালুগুলো অ্যাক্সেস করেছি এখানে। 4 \r\nপর্যন্ত বলতে বুঝায় 1, 2, 3 নম্বর ইনডেক্স, 4 নয় কিন্তু। আমরা চাইলে প্রথম \r\nতিনটা বা শেষ ২ টা ভ্যালুকে আরো সহজে অ্যাক্সেস করতে পারি।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[:<span style=\"color:#ae81ff\">1</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'b\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[:<span style=\"color:#ae81ff\">2</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'ba\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[:<span style=\"color:#ae81ff\">3</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'ban\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">2</span>:]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'ngla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#ae81ff\">4</span>:]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'la\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#f92672\">-</span><span style=\"color:#ae81ff\">1</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'a\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a[<span style=\"color:#f92672\">-</span><span style=\"color:#ae81ff\">2</span>]\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'l\'</span></span></span></code></pre></div><p><code>a[:2]</code> দিয়ে প্রথম দুইটা ভ্যালু অ্যাক্সেস করা যায়। অন্যদিকে <code>a[2:]</code> দিয়ে বুঝায় প্রথম দুইটা ভ্যালু বাদ দিয়ে দেখাও। মানে প্রথম দুইটা ভ্যালু বাদ দিয়ে বাকিগুলো দেখাবে পাইথন। এইজন্যই <code>a[4:]</code> দিয়ে আমরা প্রথম চারটা ক্যারেক্টার বাদ দিয়ে শেষের দুইটা ক্যারেক্টার পেয়েছি। আর <code>a[-1]</code> দিয়ে বুঝায় শেষ দিক থেকে প্রথম ভ্যালুটা দেখাও। তেমনকি করে <code>a[-2]</code> দিয়ে বুঝায় শেষ দিক থেকে দ্বিতীয় ভ্যালুটা দেখাও। কি মজা!</p><p>তাই\r\n না? স্ট্রিংয়ের ইনডেক্স তো দেখলাম আমরা। একটা জিনিস ভেবে দেখেছি কি যে এই \r\nইনডেক্সের ভ্যালুগুলো আপডেট করা যায় কিনা? আপনি চেষ্টা করুন, বাকি আমরা \r\nএকটু জিরিয়ে নেই।</p><h2 id=\"সটর-ফরমযট\">স্ট্রিং ফরম্যাটিং<a class=\"anchor\" href=\"https://python.maateen.me/docs/string-manipulation/#%e0%a6%b8%e0%a6%9f%e0%a6%b0-%e0%a6%ab%e0%a6%b0%e0%a6%ae%e0%a6%af%e0%a6%9f\">#</a></h2><p>আমাদের বইয়ের একেবারে শুরুর দিকে আমরা <code>print()</code> ফাংশনের ব্যবহার শিখেছি। এটা দিয়ে আমরা যেকোন কিছু স্ক্রীনে প্রিন্ট করে দেখতে পারি।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(a)\r\n</span></span><span style=\"display:flex\"><span>bangla</span></span></code></pre></div><p>আমরা a ভ্যারিয়েবলে ‘bangla’ স্ট্রিং অ্যাসাইন করেছি। পরে a এর ভ্যালু প্রিন্ট করে দেখেছি। এবার জিনিসটাকে আরেকটু মশলাদার করা যাক:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(a)\r\n</span></span><span style=\"display:flex\"><span>bangla\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'My favorite language is:\'</span>, a)\r\n</span></span><span style=\"display:flex\"><span>My favorite language <span style=\"color:#f92672\">is</span>: bangla</span></span></code></pre></div><p>আমরা\r\n এখানে উপরের উদাহরণের তুলনায় মাত্র একটা স্টেটমেন্ট বেশি লিখেছি। এখানে \r\nআমরা a ভ্যারিয়েবলকে আরেকটু মশলাদার করে প্রিন্ট করেছি মাত্র। কাজটা চাইলে \r\nস্ট্রিং ফরম্যাটিং অপারেটর <code>%</code> দিয়ে করা যায়। আসলে এই ফিচারটা পাইথনের ভিতরে সি এর <code>printf()</code> ফাংশনের ক্ষমতা এনে দিয়েছে। উপরের কাজটাই এবার করা যাক আবার:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'My favorite language is: </span><span style=\"color:#e6db74\">%s</span><span style=\"color:#e6db74\">\'</span> <span style=\"color:#f92672\">%</span>a)\r\n</span></span><span style=\"display:flex\"><span>My favorite language <span style=\"color:#f92672\">is</span>: bangla</span></span></code></pre></div><p>কি চমৎকার কাজ করল! এই যে এখানে আমরা <code>%s</code> সিম্বলটা ব্যবহার করেছি, এটা হল স্ট্রিং ফরম্যাট সিম্বল। ইন্টিজারের জন্য <code>%d</code>, ফ্লোটের জন্য <code>%f</code> এরকম আলাদা আলাদা ফরম্যাট সিম্বল রয়েছে। বিশেষ করে দশমিকের পর কয়ঘর অবধি আমরা ডিজিট দেখাতে চাই তার জন্য <code>%f</code> খুবই কাজের জিনিস।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> number <span style=\"color:#f92672\">=</span> <span style=\"color:#ae81ff\">436.15757823658945</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(number)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">436.1575782365895</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#e6db74\">%.2f</span><span style=\"color:#e6db74\">\'</span> <span style=\"color:#f92672\">%</span> number)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">436.16</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#e6db74\">%.4f</span><span style=\"color:#e6db74\">\'</span> <span style=\"color:#f92672\">%</span> number)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">436.1576</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#e6db74\">%.1f</span><span style=\"color:#e6db74\">\'</span> <span style=\"color:#f92672\">%</span> number)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">436.2</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'</span><span style=\"color:#e6db74\">%.5f</span><span style=\"color:#e6db74\">\'</span> <span style=\"color:#f92672\">%</span> number)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">436.15758</span></span></span></code></pre></div><p><code>%</code> এর পর <code>.</code> দিয়ে যে ইন্টিজারটার দেব আমরা, দশমিকের পর সেই কয়ঘর পর্যন্তই ডিজিট প্রিন্ট হবে। এখন আমরা আরেকটু জটিল একটা কাজ করব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> input()\r\n</span></span><span style=\"display:flex\"><span>Bangla\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> input()\r\n</span></span><span style=\"display:flex\"><span>English\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'My favorite languages are:\'</span>, a, <span style=\"color:#e6db74\">\'and\'</span>, b)\r\n</span></span><span style=\"display:flex\"><span>My favorite languages are: Bangla <span style=\"color:#f92672\">and</span> English</span></span></code></pre></div><p>এখানে\r\n গতানুগতিক ধারায় আমরা কাজটা করেছি। a আর b তে দুইটা ল্যাঙ্গুয়েজের নাম \r\nস্ট্রিং হিসাবে ইনপুট নিয়েছি। তারপর একটা সুন্দর লাইন বানিয়ে প্রিন্ট \r\nদিয়েছি। কাজটা স্ট্রিং ফরম্যাটিং অপারেটর ব্যবহার করেও করতে পারি:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> input()\r\n</span></span><span style=\"display:flex\"><span>Bangla\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> input()\r\n</span></span><span style=\"display:flex\"><span>English\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> print(<span style=\"color:#e6db74\">\'My favorite languages are: </span><span style=\"color:#e6db74\">%s</span><span style=\"color:#e6db74\"> and </span><span style=\"color:#e6db74\">%s</span><span style=\"color:#e6db74\">\'</span> <span style=\"color:#f92672\">%</span>(a, b))\r\n</span></span><span style=\"display:flex\"><span>My favorite languages are: Bangla <span style=\"color:#f92672\">and</span> English</span></span></code></pre></div><p>এখন\r\n মাথায় আসতে পারে এই ফরম্যাটিংয়ের বিষয়টা আমরা শিখলাম কেন? আসলে এটাও \r\nশিখেছি অনলাইন জাজের কথা চিন্তা করে। সামনে যখন আমরা বিভিন্ন অনলাইন জাজের \r\nসমস্যাগুলো সলভ করব তখন আমাদের অনেক ক্ষেত্রেই এরকম এক লাইনে অনেক \r\nভ্যারিয়েবল প্রিন্ট দেয়া লাগতে পারে, স্ট্রিং ফরম্যাট করা লাগতে পারে। তাই \r\nআগেভাগেই আমরা শিখে রাখলাম। কি চমৎকার! তাই না?</p><h2 id=\"সটর-জড়তল\">স্ট্রিং জোড়াতালি<a class=\"anchor\" href=\"https://python.maateen.me/docs/string-manipulation/#%e0%a6%b8%e0%a6%9f%e0%a6%b0-%e0%a6%9c%e0%a7%9c%e0%a6%a4%e0%a6%b2\">#</a></h2><p>এখন আমরা স্ট্রিং নিয়ে খেলব। এরজন্য a ও b দুইটা স্ট্রিং ভ্যারিয়েবল ডিক্লেয়ার করে নেব আমরা।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'desh\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'desh\'</span></span></span></code></pre></div><p>একটা\r\n জিনিস কি খেয়াল করেছি আমরা? a আর b কে একসাথে জোড়া দিতে পারলেই কিন্তু বের\r\n হয়ে আসবে আমাদের প্রিয় মাতৃভূমি বাংলাদেশের নাম। কিন্তু জোড়া দেব কিভাবে? \r\nখুবই সহজ কাজ। <code>+</code> অপারেটর ব্যবহার করে আমরা দুইটা স্ট্রিংকে জোড়া দিতে পারি। ইংরেজিতে একে কংক্যাটেনশন বলে।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'desh\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> b\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'desh\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">+</span>b\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangladesh\'</span></span></span></code></pre></div><p>আচ্ছা\r\n এবার আমরা আলাদা তিনটা ভ্যারিয়েবল নেব x, y, z। এদের ভ্যালু হবে যথাক্রমে \r\n‘dhaka’, ‘barisal’, ‘sylhet’। এবার আমরা এই তিনটা ভ্যারিয়েবলকে জোড়া দেব। \r\nতবে শর্ত হল, জোড়া দেবার জায়গায় <code>-</code> চিহ্নটা থাকতে হবে।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> x <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'dhaka\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> x\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'dhaka\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> y <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'barisal\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> y\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'barisal\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> z <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'sylhet\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> z\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'sylhet\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> x <span style=\"color:#f92672\">+</span> <span style=\"color:#e6db74\">\'-\'</span> <span style=\"color:#f92672\">+</span> y <span style=\"color:#f92672\">+</span> <span style=\"color:#e6db74\">\'-\'</span> <span style=\"color:#f92672\">+</span> z\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'dhaka-barisal-sylhet\'</span></span></span></code></pre></div><p>ঠিক আছে তাই না? আমরা কিন্তু এই কাজটা আরো সহজে করতে পারতাম <code>join()</code> ফাংশন দিয়ে।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> x <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'dhaka\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> x\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'dhaka\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> y <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'barisal\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> y\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'barisal\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> z <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'sylhet\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> z\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'sylhet\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\'-\'</span><span style=\"color:#f92672\">.</span>join((x, y, z))\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'dhaka-barisal-sylhet\'</span></span></span></code></pre></div><p>সহজ হয়ে গেল তাই না? ফাংশনটা দিয়ে কাজ করার ফরম্যাটটা খেয়াল করেছি তো সবাই? হুম, আশা করি খেয়াল করেছি সবাই।</p><h2 id=\"বড়-কর-ছট-কর\">বড় করি, ছোট করি<a class=\"anchor\" href=\"https://python.maateen.me/docs/string-manipulation/#%e0%a6%ac%e0%a7%9c-%e0%a6%95%e0%a6%b0-%e0%a6%9b%e0%a6%9f-%e0%a6%95%e0%a6%b0\">#</a></h2><p>a এর ভ্যালু ‘bangla’, b টা ছোট হাতের। আমরা এটাকে বড় হাতের বানাব। এজন্য আমরা <code>capitalize()</code> ফাংশন ব্যবহার করব। এই ফাংশন কোন স্ট্রিংয়ের প্রথম ক্যারেক্টারটাকে বড় হাতের বানায়।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">.</span>capitalize()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'Bangla\'</span></span></span></code></pre></div><p>যদি সবগুলো ক্যারেক্টারকেই বড় হাতের করতে চাইতাম তবে <code>upper()</code> ফাংশন ব্যবহার করতে হত।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">.</span>upper()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'BANGLA\'</span></span></span></code></pre></div><p>আমরা\r\n একটা বাক্য গঠন করলাম: they’re bill’s friends from the UK. এখন আমরা যদি \r\nএই বাক্যের প্রতিটা শব্দের প্রথম অক্ষরকে বড় হাতের করতে চাই তবে আমাদেরকে <code>title()</code> ফাংশন ব্যবহার করতে হবে।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\"bangladesh is my motherland. i just love her.\"</span><span style=\"color:#f92672\">.</span>title()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'Bangladesh Is My Motherland. I Just Love Her.\'</span></span></span></code></pre></div><p>বড় তো অনেক করলাম, এবার আসুন ছোট করি। একটা স্ট্রিংয়ের সবগুলো ক্যারেক্টারকে ছোট হাতের করার জন্য <code>lower()</code> ফাংশন ব্যবহার করা হয়।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\'BANGLA\'</span><span style=\"color:#f92672\">.</span>lower()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\'Bangla\'</span><span style=\"color:#f92672\">.</span>lower()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span></span></span></code></pre></div><p>এই একই কাজ কিন্তু আমরা <code>casefold()</code> ফাংশন দিয়েও করতে পারি।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\'BANGLA\'</span><span style=\"color:#f92672\">.</span>casefold()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\'Bangla\'</span><span style=\"color:#f92672\">.</span>casefold()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span></span></span></code></pre></div><p>তবে <code>lower()</code> আর <code>casefold()</code> এর ভিতরে ব্যবহারগত পার্থক্য আছে। <code>lower()</code> ব্যবহার করা হয় স্ট্রিং ডিসপ্লে করার কাজে। আর <code>casefold()</code> ব্যবহার করা হয় দুইটা স্ট্রিং কমপেয়ার করার সময় যখন তাদের কেস এক হওয়রা দরকার হয়। ভবিষ্যতে আমরা <code>casefold()</code> এর একটা ব্যবহার দেখব।</p><p>যদি কখনো দরকার হয় যে বড় হাতেরকে ছোট হাতের করতে হবে আর ছোট হাতেরকে বড় হাতের করতে হবে তখন আমরা <code>swapcase()</code> ফাংশন ব্যবহার করব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> <span style=\"color:#e6db74\">\'Bangla\'</span><span style=\"color:#f92672\">.</span>swapcase()\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bANGLA\'</span></span></span></code></pre></div><h2 id=\"সটর-গণন-সটর-খজ\">স্ট্রিং গণনা, স্ট্রিং খোঁজা<a class=\"anchor\" href=\"https://python.maateen.me/docs/string-manipulation/#%e0%a6%b8%e0%a6%9f%e0%a6%b0-%e0%a6%97%e0%a6%a3%e0%a6%a8-%e0%a6%b8%e0%a6%9f%e0%a6%b0-%e0%a6%96%e0%a6%9c\">#</a></h2><p>স্ট্রিং\r\n তো নানারকম ক্যারেক্টারের সমষ্টি, আমরা তো জানি। আমরা ইনডেক্স অনুসারে \r\nস্ট্রিং থেকে বিভিন্ন ক্যারেক্টারকেও অ্যাক্সেস করতে পারি। কিন্তু একটা \r\nস্ট্রিংয়ে কতগুলো ক্যারেক্টার রয়েছে তা কিভাবে জানা সম্ভব? এইজন্য রয়েছে <code>len()</code>\r\n ফাংশন। এই ফাংশনের কাজ হল লেংথ আউটপুট দেয়া বা রিটার্ন করা। এই ফাংশনের \r\nভিতর স্ট্রিং, লিস্ট, টাপল, ডিকশনারি যাই দেব, সে আমাদের সেই জিনিসের লেংথ \r\nবলে দেবে। মজার জিনিস!</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> len(a)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">6</span></span></span></code></pre></div><p>হুম,\r\n আমরা a ভ্যারিয়েবলে ৬ ক্যারেক্টারের একটা স্ট্রিং অ্যাসাইন করেছিলাম। এখন \r\nএকটা জিনিস সবাই একটু খেয়াল করি, ‘bangla’ তে a কিন্তু দুইবার আছে। পাইথন \r\nদিয়ে কিভাবে এটা হিসাব করা যায়? খুবই সহজ। এইজন্য আমরা <code>count()</code> ফাংশন ব্যবহার করব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'bangla\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">.</span>count(<span style=\"color:#e6db74\">\'a\'</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">2</span></span></span></code></pre></div><p>হয়ত ঠিকভাবে বোঝা গেল না। আমরা আরেকটা উদাহরণ দেখব। তার আগে বলে নিই, <code>count()</code> ফাংশনটা ভীষণ স্মার্ট। এটা নিয়ে ফাংশন চাপ্টারে আমরা আরো কিছু বলব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can?\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>count(<span style=\"color:#e6db74\">\'c\'</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">6</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>count(<span style=\"color:#e6db74\">\'c\'</span>, <span style=\"color:#ae81ff\">5</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">5</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>count(<span style=\"color:#e6db74\">\'c\'</span>, <span style=\"color:#ae81ff\">5</span>, <span style=\"color:#ae81ff\">9</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">0</span></span></span></code></pre></div><p>প্রথম\r\n স্টেটমেন্টে আমরা sentence ভ্যারিয়েবলে একটা চমৎকার বাক্য (স্ট্রিং) \r\nঅ্যাসাইন করেছি। এই স্ট্রিংয়ে বেশ কয়েকটা c ক্যারেক্টার আছে। মাঝের \r\nস্টেটমেন্টে আমরা সেটাই হিসেব করেছি। ৩য় স্টেটমেন্টে আমরা দেখেছি যে 5 \r\nনাম্বার ইনডেক্স থেকে শেষ পর্যন্ত হিসাব করলে কয়টা c পাওয়া যায়। আর শেষ \r\nস্টেটমেন্টে আমরা দেখেছি যে 5 নাম্বার ইনডেক্স থেকে শুরু করে 9 নম্বর \r\nইনডেক্স পর্যন্ত কয়টা c আছে। ব্যাপারটা জটিল লাগতে পারে। বেশি প্রেসার \r\nনেয়ার দরকার নাই। কারণ, ফাংশন চাপ্টারে আবার কথা হবে তো এটা নিয়ে। মন খারাপ\r\n করার কি আছে!</p><p>এবার আরেকটা মজার জিনিস দেখি। আমাদের এই বাক্যে কোন কোন ইনডেক্সে c রয়েছে তা কিভাবে খুঁজে বের করব? এইজন্য আমরা <code>find()</code> ফাংশন ব্যবহার করব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can?\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>find(<span style=\"color:#e6db74\">\'c\'</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">4</span></span></span></code></pre></div><p>আমরা\r\n আউটপুট পেলাম 4। কিন্তু আমাদের কিন্তু বেশ কয়েকটা আউটপুট পাবার কথা। তাহলে\r\n ভুলটা কোথায়? আসলে ভুল না। এই ফাংশনের ব্যাপার হল প্রথম যে ইনডেক্সে \r\nকাঙ্ক্ষিত ক্যারেক্টার খুঁজে পাবে সেটাই আউটপুট হিসাবে দেখাবে বা রিটার্ন \r\nকরবে আমাদের কাছে। আচ্ছা, 4 নাম্বার ইনডেক্সে তো একটা c পেলাম। এবার 5 \r\nনাম্বার থেকে আবার খোঁজাখুঁজি শুরু করা যাক।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>find(<span style=\"color:#e6db74\">\'c\'</span>, <span style=\"color:#ae81ff\">5</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#ae81ff\">10</span></span></span></code></pre></div><p>২য় c টা আমরা 10 নাম্বার ইনডেক্সে পেলাম। একই কাজের জন্য আমরা <code>index()</code> ফাংশনটাও ব্যবহার করতে পারি। <code>find()</code> আর <code>index()</code> ফাংশনের ভিতর ব্যবহারগত দিক থেকে তেমন কোন পার্থক্য নেই। পার্থক্য হল স্মার্টনেসে - কাঙ্ক্ষিত স্ট্রিং খুঁজে না পেলে <code>find()</code> ফাংশন -1 রিটার্ন করে আর <code>index()</code> ফাংশন <code>ValueError: substring not found</code> এরর মেসেজ থ্রো করে। একটা উদাহরণ দেখা যাক।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\"Bangladesh is my country\"</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">.</span>find(<span style=\"color:#e6db74\">\"x\"</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">-</span><span style=\"color:#ae81ff\">1</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> a<span style=\"color:#f92672\">.</span>index(<span style=\"color:#e6db74\">\"x\"</span>)\r\n</span></span><span style=\"display:flex\"><span>Traceback (most recent call last):\r\n</span></span><span style=\"display:flex\"><span>  File <span style=\"color:#e6db74\">\"&lt;stdin&gt;\"</span>, line <span style=\"color:#ae81ff\">1</span>, <span style=\"color:#f92672\">in</span> <span style=\"color:#f92672\">&lt;</span>module<span style=\"color:#f92672\">&gt;</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#a6e22e\">ValueError</span>: substring <span style=\"color:#f92672\">not</span> found</span></span></code></pre></div><h2 id=\"কটকট-ফটফট\">কাটাকুটি, ফাটাফাটি<a class=\"anchor\" href=\"https://python.maateen.me/docs/string-manipulation/#%e0%a6%95%e0%a6%9f%e0%a6%95%e0%a6%9f-%e0%a6%ab%e0%a6%9f%e0%a6%ab%e0%a6%9f\">#</a></h2><p>‘How\r\n can a clam cram in a clean cream can?’ এই স্ট্রিংটা আবার বিবেচনা করা \r\nযাক। হঠাৎ মন চাইল যে আমরা এর সবগুলো c কে d দিয়ে পরিবর্তন করে ফেলব, মানে c\r\n এর জায়গায় d বসাব আর কি! কিভাবে করব? হুম কঠিন সমস্যা। তবে এই কঠিন \r\nসমস্যার সমাধানটাও নিতান্তই সহজ। <code>replace()</code> ফাংশন ব্যবহার করে\r\n আমরা সহজেই তা করতে পারি। ফাংশনটার ভিতরে প্রথমে যে ক্যারেক্টারটাকে \r\nরিপ্লেস করব সেটাকে দেব, তারপরে যাকে দিয়ে রিপ্লেস করব তাকে দেব। নিচের \r\nপ্রোগ্রামটা দেখলে সব পরিষ্কার হয়ে যাবে:</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can?\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>replace(<span style=\"color:#e6db74\">\'c\'</span>, <span style=\"color:#e6db74\">\'d\'</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'How dan a dlam dram in a dlean dream dan?\'</span></span></span></code></pre></div><p>আশা করি সবাই বুঝেছি। এবার আমরা ? কে নাই করে দেব। মানে যে জায়গায় ? ক্যারেক্টারটা আছে, সেখান থেকে ভ্যানিশ করে দেব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can?\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>replace(<span style=\"color:#e6db74\">\'?\'</span>, <span style=\"color:#e6db74\">\'\'</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can\'</span></span></span></code></pre></div><p>এ কাজটা আমরা আরও সহজে করতে পারি <code>strip()</code> ফাংশন দিয়ে। <code>strip()</code>\r\n ফাংশনের মধ্যে প্যারামিটার হিসেবে থাকা ক্যারেক্টারগুলো যদি স্ট্রিংয়ের \r\nশুরুর ও শেষের ক্যারেক্টারগুলোর সাথে মিলে যায়, তবে সেগুলো বাদ দিয়ে আগের \r\nস্ট্রিংটার তুলনায় একেবারে নতুন একটা স্ট্রিং রিটার্ন করে।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can?\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>strip(<span style=\"color:#e6db74\">\'?\'</span>)\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can\'</span></span></span></code></pre></div><p>আশা\r\n করি সবাই বুঝতে পেরেছি। এবার আরেকটা জিনিস শিখব। এই যে আমাদের স্ট্রিংটা \r\nআছে, এটার ভিতর অনেকগুলো হোয়াইটস্পেস আছে। আমরা এই হোয়াইটস্পেসগুলোর উপর \r\nভিত্তি করে স্ট্রিংটাকে ভাগ করব।</p><div class=\"highlight\"><pre tabindex=\"0\" style=\"color:#f8f8f2;background-color:#272822;-moz-tab-size:4;-o-tab-size:4;tab-size:4\"><code class=\"language-python\" data-lang=\"python\"><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence <span style=\"color:#f92672\">=</span> <span style=\"color:#e6db74\">\'How can a clam cram in a clean cream can?\'</span>\r\n</span></span><span style=\"display:flex\"><span><span style=\"color:#f92672\">&gt;&gt;&gt;</span> sentence<span style=\"color:#f92672\">.</span>split(<span style=\"color:#e6db74\">\' \'</span>)\r\n</span></span><span style=\"display:flex\"><span>[<span style=\"color:#e6db74\">\'How\'</span>, <span style=\"color:#e6db74\">\'can\'</span>, <span style=\"color:#e6db74\">\'a\'</span>, <span style=\"color:#e6db74\">\'clam\'</span>, <span style=\"color:#e6db74\">\'cram\'</span>, <span style=\"color:#e6db74\">\'in\'</span>, <span style=\"color:#e6db74\">\'a\'</span>, <span style=\"color:#e6db74\">\'clean\'</span>, <span style=\"color:#e6db74\">\'cream\'</span>, <span style=\"color:#e6db74\">\'can?\'</span>]</span></span></code></pre></div><p>আমরা\r\n দেখতে পাচ্ছি স্ট্রিংটা ভেঙে টুকরো টুকরো হয়ে গেছে। এটা আসলে একটা লিস্ট। \r\nলিস্ট চ্যাপ্টারে লিস্ট নিয়ে বিস্তারিতভাবে আলোচনা করা হবে। তখন আমরা এই \r\nলিস্ট থেকে আমাদের সব টুকরো স্ট্রিংকে অ্যাক্সেস করতে পারব। দৌড়াদৌড়ির তো \r\nদরকার নেই, নাকি! ধীরে ধীরে মিলেমিশে শিখব।</p><p>উল্লেখ্য, এই উদাহরণে <code>split()</code> ফাংশনের ব্র্যাকেটের ভেতরে যা দেখতে পাচ্ছি আমরা তা আসলে কোন ডাবল কোট নয়; বরং দুটি সিঙ্গেল কোটের সমন্বয়।</p>', 2, 'string_1760717433.jpg', 'string', 'string', '2025-10-17', NULL, NULL);
INSERT INTO `posts` (`id`, `category_id`, `title`, `details`, `user_id`, `image`, `slug`, `tags`, `date`, `created_at`, `updated_at`) VALUES
(45, 14, 'index.blade.php', '<p>At first you have to create a table for example </p><p>php artisan make:migration create_categories_table&nbsp;</p><p><br></p><p>Then create a assign field into your database according to your demand</p><p>&lt;?php<br><br>use Illuminate\\Database\\Migrations\\Migration;<br>use Illuminate\\Database\\Schema\\Blueprint;<br>use Illuminate\\Support\\Facades\\Schema;<br><br>return new class extends Migration<br>{<br>&nbsp; &nbsp; /**<br>&nbsp; &nbsp; &nbsp;* Run the migrations.<br>&nbsp; &nbsp; &nbsp;*/<br>&nbsp; &nbsp; public function up(): void<br>&nbsp; &nbsp; {<br>&nbsp; &nbsp; &nbsp; &nbsp; Schema::create(\'categories\', function (Blueprint $table) {<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $table-&gt;id();<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $table-&gt;string(\'category_name\')-&gt;nullable();<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $table-&gt;string(\'slug\')-&gt;nullable();<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $table-&gt;timestamps();<br>&nbsp; &nbsp; &nbsp; &nbsp; });<br>&nbsp; &nbsp; }<br><br>&nbsp; &nbsp; /**<br>&nbsp; &nbsp; &nbsp;* Reverse the migrations.<br>&nbsp; &nbsp; &nbsp;*/<br>&nbsp; &nbsp; public function down(): void<br>&nbsp; &nbsp; {<br>&nbsp; &nbsp; &nbsp; &nbsp; Schema::dropIfExists(\'categories\');<br>&nbsp; &nbsp; }<br>};</p>', 2, 'laravel.jpg', 'laravel', 'laravel', '2025-11-04', NULL, NULL),
(46, 8, 'প্রোগ্রামিং শুরু করার জন্য গাইডলাইন', '<p style=\"text-align: justify;\">একদম নতুনদের জন্য পোস্টটি। যারা \r\nপ্রোগ্রামিং শব্দটা নতুন শুনেছেন এবং প্রোগ্রামিং শিখতে আগ্রহী তাদের জন্য।\r\n আপনি কোন বিষয় পড়ছেন বর্তমানে, কোন শ্রেনীতে পড়ছেন, আপনি সাইন্স \r\nব্যকগ্রাউন্ডে না এসব কিছু প্রোগ্রামিং শেখার জন্য বাধা নয়। আগ্রহ থাকলে \r\nআপনি শুরু করুন। নিজে নিজেই অনেক কিছু শিখতে পারবেন। কারো গাইডলাইন লাগবে \r\nনা, একটা ইন্টারনেট কানেকশন থাকলেই হবে সাথে একটু সময়। এ দুইটি জিনিস \r\nআপনার থাকলে আপনার আর কোন বাধা নেই প্রোগ্রামিং শেখার জন্য।</p>\r\n<p style=\"text-align: justify;\">নিজের ভাষা কম্পিউটারকে বুঝানোর জন্যই \r\nপোগ্রামিং ল্যাঙ্গুয়েজ এর উৎপত্তি। এ পর্যন্ত কয়েক হাজার পোগ্রামিং \r\nল্যাঙ্গুয়েজের উৎপত্তি হয়েছে। বিশ্বাস না হলে নিচের লিস্ট গুলো দেখুন। এ \r\nলিস্টের বাহিরে অনেক বেশি পোগ্রামিং ল্যাঙ্গুয়েজ আছে।</p><ul style=\"text-align: justify;\"><p></p><li><strong><a href=\"https://en.wikipedia.org/wiki/List_of_programming_languages\">List of programming languages</a></strong></li><li><strong><a href=\"https://en.wikipedia.org/wiki/Generational_list_of_programming_languages\">Generational list of programming languages</a></strong></li><li><strong><a href=\"https://en.wikipedia.org/wiki/List_of_programming_languages_by_type\">List of programming languages by type</a></strong></li><p></p></ul><p style=\"text-align: justify;\">মনে হয় এবার বিশ্বাস করছেন যে কয়েক হাজার প্রোগ্রামিং ল্যাঙ্গুয়েজ থাকা \r\nসম্ভব। আচ্ছা এত গুলো শেখা কি সম্ভব? একটুও না। তবে প্রায় প্রোগ্রামিং \r\nল্যাঙ্গুয়েজের মূল কাঠামো একই রকম। একটা জানলে আরেকটা সহজেই বুঝা যায়। আর\r\n আপনাকে কাজ করার জন্য সব গুলো প্রোগ্রামিং ল্যাঙ্গুয়েজ ও জানতে হবে না। \r\nএকটা ভালো করে জানলেই হবে। এখন আপনি কোনটা শিখবেন তা আগে ঠিক করুন। ঠিক \r\nকরতে না পারলে এ পোস্টটা দেখুন। একটু আইডিয়া পাবেন কোনটা আপনার শেখা উচিত।</p>', 2, 'programing-suru-krar-jnz-gaidlain_1762274943.jpg', 'programing-suru-krar-jnz-gaidlain', 'java', '2025-11-04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `showpage` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `stock_quantity` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `brand_id`, `name`, `slug`, `code`, `unit`, `tags`, `showpage`, `purchase_price`, `discount_price`, `selling_price`, `stock_quantity`, `color`, `size`, `description`, `thumbnail`, `images`, `admin_id`, `status`, `created_at`, `updated_at`) VALUES
(72, 14, 18, 17, 'Wireless Airpod', 'wireless-airpod', 'SKU: CSB-001', 'Piece', NULL, 'Featured', '600', '900', '1200', '23', 'Black,White,Sliver', 'Square,Shape', 'High quality Wireless Airpod', 'wireless-airpod.png', '[]', 2, 'Active', '2025-10-16 00:20:08', '2025-10-16 00:20:08'),
(74, 14, 20, 17, 'Deko Speaker', 'deko-speaker', 'SKU: CSB-002', 'Piece', 'specker', 'Featured', '300', '600', '900', '35', 'Black,Silver', 'Shape,Circle,Square', 'High Quality wireless speaker with 6 months warranty', 'deko-speaker.jpg', '[]', 2, 'Active', '2025-10-21 01:57:36', '2025-10-21 01:57:36'),
(75, 15, 20, 18, 'HighTech Speaker', 'hightech-speaker', 'SKU: CSB-003', 'Piece', 'speaker', 'Featured', '300', '600', '900', '3', 'Black,Silver', 'Shape,Circle,Square', 'This is a amazing and beautiful high quality wireless speaker.', 'hightech-speaker.png', '[]', 2, 'Active', '2025-10-21 02:00:51', '2025-10-21 02:00:51'),
(76, 15, 20, 22, 'Gamepad T', 'gamepad-t', 'SKU: CSB-004', 'Piece', 'speaker', 'Featured', '300', '900', '1200', '9', 'Black,Silver', 'Shape,Circle,Square', 'High quality game controller with no warranty', 'gamepad-t.jpg', '[]', 2, 'Active', '2025-10-21 02:03:40', '2025-10-21 02:03:40'),
(77, 14, 18, 17, 'Decko Headphone', 'decko-headphone', 'SKU: CSB-005', 'Piece', NULL, 'Today Deal', '600', '900', '1200', '6', 'Black', 'Shape', 'A product description is a form of marketing copy used to describe and explain the benefits of your product. In other words, it provides all the information and details of your product on your eCommerce site.\r\n\r\nThese product details can be one sentence, a short paragraph or bulleted. They can be serious, funny or quirky. They can be located right next to or underneath product titles and product images. \r\n\r\nThey can be scalable selling points or have strong readability.', 'decko-headphone.jpg', '[]', 2, 'Active', '2025-10-26 03:37:27', '2025-10-26 03:37:27'),
(78, 14, 8, 22, 'MaxGreen S19001 Mid-Tower', 'maxgreen-s19001-mid-tower', 'SKU: CSB-006', 'Piece', NULL, 'Today Deal', '600', '900', '1200', '9', NULL, NULL, 'A product description is a form of marketing copy used to describe and explain the benefits of your product. In other words, it provides all the information and details of your product on your ecommerce site.\r\n\r\nThese product details can be one sentence, a short paragraph or bulleted. They can be serious, funny or quirky. They can be located right next to or underneath product titles and product images. They can be scannable selling points or have strong readability.', 'casing.jpg', '[]', 2, 'Active', '2025-10-26 03:40:10', '2025-10-26 03:40:10'),
(79, 14, 9, 17, 'GTX5503', 'gtx5503', 'SKU: CSB-007', 'Piece', NULL, 'Today Deal', '900', '1200', '1500', '7', 'Black,Blue', 'Shape,Round,Square', 'Graphics Coprocessor 	NVIDIA GTX550TI\r\nBrand 	Tangxi\r\nGraphics RAM Size 	2 GB\r\nVideo Output Interface 	DVI, DisplayPort, HDMI\r\nGraphics Processor Manufacturer 	NVIDIA', 'gtx5503.jpg', '[]', 2, 'Active', '2025-10-26 03:44:39', '2025-10-26 03:44:39'),
(80, 14, 8, 19, 'Intel Processor', 'intel-processor', 'SKU: CSB-008', 'Piece', NULL, 'Trendy', '3000', '6000', '9000', '9', 'Black', 'Shape,Round,Square', 'Intel Core Ultra 7 265K Icosa-core (20 Core) 3.90 GHz Processor - OEM Pack - Box - 30 MB L3 Cache - 36 MB L2 Cache - 64-bit Processing - 5.50 GHz Overclocking Speed - Socket LGA-1851', 'intel-processor.jpg', '[]', 2, 'Active', '2025-10-26 03:51:09', '2025-10-26 03:51:09'),
(81, 14, 8, 17, 'Speaker', 'speaker', 'SKU: CSB-009', 'Piece', NULL, 'Trendy', '900', '1200', '1500', '9', 'Black', 'Shape', 'High quality speaker', 'speaker.jpg', '[]', 2, 'Active', '2025-10-26 03:52:13', '2025-10-26 03:52:13'),
(82, 14, 19, 17, 'Coling Fan', 'coling-fan', 'SKU: CSB-010', 'Piece', NULL, 'Trendy', '900', '1200', '1500', '6', 'Black,Green', 'Shape', 'High quality coling fan', 'coling-fan.jpg', '[]', 2, 'Active', '2025-10-26 03:59:53', '2025-10-26 03:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AI Development', 'ai-development', '_1760976924.jpg', 'Yes', NULL, NULL),
(2, 'UI UX Design', 'ui-ux-design', '_1760978067.jpg', 'Yes', NULL, NULL),
(3, 'Product Design', 'product-design', '_1760978472.png', 'Yes', NULL, NULL),
(4, 'Data Verification', 'data-verification', '_1760977740.jpg', 'Yes', NULL, NULL),
(5, 'Web Development', 'web-development', '_1760978687.jpg', 'Yes', NULL, NULL),
(6, 'Graphics Design', 'graphics-design', '_1760978834.png', 'Yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply_date` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `review` longtext DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_date` varchar(255) DEFAULT NULL,
  `review_month` varchar(255) DEFAULT NULL,
  `review_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `review`, `rating`, `review_date`, `review_month`, `review_year`, `created_at`, `updated_at`) VALUES
(10, 7, 75, 'This website is amazing! It has a huge selection of products, is easy to use, and delivers quickly. I\'m always happy with my purchases from here.', 5, '05-11-2025', 'November', 2025, NULL, NULL),
(11, 7, 74, 'The customer service here is outstanding! After-sales service was quick and friendly when I had a problem. I highly recommend this online store.', 5, '05-11-2025', 'November', 2025, NULL, NULL),
(12, 7, 72, 'The quality of the products here is always better than I expected. The descriptions and photos are accurate. I\'ve been a loyal customer for years.', 5, '05-11-2025', 'November', 2025, NULL, NULL),
(13, 9, 75, 'The website is so easy to use, it makes online shopping a joy. The exclusive offers for subscribers are a great perk. I\'m not shopping anywhere else!', 5, '05-11-2025', 'November', 2025, NULL, NULL),
(14, 9, 74, 'Ordering was a breeze. The checkout process is secure and easy. My items arrived well-packaged and in perfect condition.', 5, '05-11-2025', 'November', 2025, NULL, NULL),
(15, 9, 72, '\"Love this! Easy to use and exactly what I needed. Highly recommend.\"', 5, '05-11-2025', 'November', 2025, NULL, NULL),
(16, 9, 79, '\"Five stars! The service was fast, friendly, and exactly what I needed.\"', 5, '05-11-2025', 'November', 2025, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_author` varchar(255) DEFAULT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `google_verification` varchar(255) DEFAULT NULL,
  `google_analytics` varchar(255) DEFAULT NULL,
  `alexa_verification` varchar(255) DEFAULT NULL,
  `google_adsense` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `meta_title`, `meta_author`, `meta_tag`, `meta_description`, `meta_keyword`, `google_verification`, `google_analytics`, `alexa_verification`, `google_adsense`, `created_at`, `updated_at`) VALUES
(1, 'www.raihan.com', 'Unown', 'Laravel, PHP, HRM, CRM, Ecommerce, Admin Panel, Payroll, Attendance, CMS, Ticket System, Bootstrap, Ajax, MySQL', 'Multi-Module Management System (HRM + CRM + Ecommerce) — Laravel 10, AJAX, responsive admin & frontend.', 'online shop,multi management,pos,blog,ecommerce,hr', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serves`
--

CREATE TABLE `serves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serve_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serves`
--

INSERT INTO `serves` (`id`, `serve_name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'FinTech', 'fintech', 'fintech.png', 'Yes', NULL, NULL),
(3, 'Healthcare', 'healthcare', 'healthcare.png', 'Yes', NULL, NULL),
(4, 'E-Commerce', 'e-commerce', 'e-commerce.jpg', 'Yes', NULL, NULL),
(5, 'Automotive', 'automotive', 'automotive.png', 'Yes', NULL, NULL),
(6, 'Education', 'education', 'education.jpg', 'Yes', NULL, NULL),
(7, 'Real-Estate', 'real-estate', 'real-estate.png', 'Yes', NULL, NULL),
(8, 'Hospitality', 'hospitality', 'hospitality.png', 'Yes', NULL, NULL),
(9, 'RMG', 'rmg', 'rmg.jpg', 'Yes', NULL, NULL),
(10, 'Pharmacy', 'pharmacy', 'pharmacy.png', 'Yes', NULL, NULL),
(11, 'Aviation', 'aviation', 'aviation.jpg', 'Yes', NULL, NULL),
(12, 'UI/UX', 'uiux', 'uiux.png', 'Yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Software Development', 'software-development', 'We can develop any kind of software solution to automate your business operations according to your requirements. Our strength is to develop customized software.', 'software-development_1761122249.jpg', 'Yes', NULL, NULL),
(2, 'Website Development', 'website-development', 'A website can represent your business identity we can develop it according to the motive of your business.', 'website-development_1761122460.png', 'Yes', NULL, NULL),
(3, 'Mobile App Development', 'mobile-app-development', 'We develop both Android and iOS application to make your business operation more Convenient and flexible.', 'mobile-app-development_1761123273.png', 'Yes', NULL, NULL),
(4, 'E-Commerce', 'e-commerce', 'We have ready made eCommerce software solutions as well as develop the eCommerce solution based on your demand.', 'e-commerce_1761122865.jpg', 'Yes', NULL, NULL),
(5, 'Blogging Platform', 'blogging-platform', 'We can develop an SEO-friendly content management system to publish blogs,article,online news,and so on.', 'blogging-platform_1761122957.jpg', 'Yes', NULL, NULL),
(6, 'Offshore Software Development', 'offshore-software-development', 'We provide complete end-to-end Offshore Software Development such as design development,support,maintenance,tasting etc. So, Build your quality products at a reasonable price with Offshore Software Development services.', 'offshore-software-development_1761123202.png', 'Yes', NULL, NULL),
(7, 'Custom Software Development', 'custom-software-development', 'We are ready to develop any kind of software solution to automate your business operations according to your requirements.Your trusted partner for custom software development services.', 'custom-software-development_1761142084.png', 'Yes', NULL, NULL),
(8, 'Cyber Security', 'cyber-security', 'Secure your website with our great security service.You can trust us to give expert guidance and deliver guaranteed results.', 'cyber-security_1761142648.jpg', 'Yes', NULL, NULL),
(12, 'Construction Cost Estimating Software', 'construction-cost-estimating-software', 'Assign projects to different persons,calculate ongoing project costs, and save cost overflow.', 'construction-cost-estimating-software.png', 'Yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_zipcode` varchar(255) DEFAULT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `email`, `phone`, `slug`, `image`, `facebook`, `twitter`, `youtube`, `linkedin`, `created_at`, `updated_at`) VALUES
(5, 'unknown@demo.com', '+1234567890', 'unknown-at-democom', 'demo-at-livecom230570027.jpeg', NULL, NULL, 'https://www.youtube.com/', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Transform Your Vision Into Reality', 'transform-your-vision-into-reality', 'A complete, modern and scalable business management', 'were-design-studio-believe-in-ideas_1760939335.jpg', 'Active', NULL, NULL),
(2, 'Easy Way To Build Perfect Website', 'easy-way-to-build-perfect-website', 'To develop any kind of software solution to automate your business', 'driven-by-passionfocus-on-perfection_1760944402.jpg', 'Active', NULL, NULL),
(6, 'Driven by passion,focus on perfection', 'driven-by-passionfocus-on-perfection', 'We combine Design, Thinking, and Technical', 'driven-by-passionfocus-on-perfection_1761027926.jpg', 'Active', NULL, NULL),
(8, 'The only platform that does it all', 'the-only-platform-that-does-it-all', '<span id=\"hs_cos_wrapper_module_1722458936627_\" class=\"hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text\" style=\"\" data-hs-cos-general-type=\"widget\" data-hs-cos-type=\"rich_text\">Our skilled advisory team is available&nbsp;</span><span id=\"hs_cos_wrapper_module_1722458936627_\" class=\"hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text\" style=\"\" data-hs-cos-general-type=\"widget\" data-hs-cos-type=\"rich_text\">to help you build a tailored migration plan including moving assets, refreshing assets, and building new assets</span>', 'new-slider-title_1762139299.jpg', 'Deactive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smtps`
--

CREATE TABLE `smtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailer` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtps`
--

INSERT INTO `smtps` (`id`, `mailer`, `host`, `port`, `user_name`, `password`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `slug`, `created_at`, `updated_at`) VALUES
(8, 14, 'Computer Case', 'computer-case', NULL, NULL),
(9, 14, 'Graphics Card', 'graphics-card', NULL, NULL),
(11, 31, 'Power Supply', 'power-supply', NULL, NULL),
(16, 14, 'Processor', 'processor', NULL, NULL),
(17, 14, 'Hard Disk Drive', 'hard-disk-drive', NULL, NULL),
(18, 15, 'Headphone', 'headphone', NULL, NULL),
(19, 15, 'Casing Fan', 'casing-fan', NULL, NULL),
(20, 27, 'Sound Cards', 'sound-cards', NULL, NULL),
(23, 15, 'Monitor', 'monitor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `photo` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `setting` int(11) DEFAULT 0,
  `page` int(11) DEFAULT 0,
  `category` int(11) DEFAULT 0,
  `product` int(11) DEFAULT 0,
  `offer` int(11) DEFAULT 0,
  `orders` int(11) DEFAULT 0,
  `message` int(11) DEFAULT 0,
  `blog` int(11) DEFAULT 0,
  `hrm` int(11) DEFAULT 0,
  `attendance` int(11) DEFAULT 0,
  `payroll` int(11) DEFAULT 0,
  `expense` int(11) DEFAULT 0,
  `role` int(11) DEFAULT 0,
  `type` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `setting`, `page`, `category`, `product`, `offer`, `orders`, `message`, `blog`, `hrm`, `attendance`, `payroll`, `expense`, `role`, `type`) VALUES
(2, 'Super Admin', 'admin@live.com', NULL, '$2y$12$XOD/dfDPWYrscC1EFCPdOeaoOTX5u8tmhMxffc9ui4v9zW.apmxAy', '1763036519_avatar-6.jpg', 1, NULL, '2025-01-05 13:00:58', '2025-11-13 06:21:59', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(7, 'Normal User', 'user@live.com', NULL, '$2y$12$21Y/.aAWSaVFmuv7sVsgHudihhVYxKQI3IxCksmWkeLLYnh/SOEVO', '1763015490_1548864331.jpg', NULL, NULL, '2025-11-05 13:59:16', '2025-11-13 00:31:30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'Editor', 'editor@live.com', NULL, '$2y$12$uXgy/czlHOe.9RHwRWTHWejQmJphpbdOVg7Wc2t9pd4bC1ItIqZlS', '1763015577_avatar.jpg', NULL, NULL, '2025-11-05 14:05:24', '2025-11-13 00:32:57', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Redwan Roni', 'redwan@live.com', NULL, '$2y$12$tTQHpEB2q2.j/Jy1ZCb1me5YTN1xxhIR4vXvtqcCiNFKa2ewwfkLG', '1762400872_avatar5.png', NULL, NULL, '2025-11-05 14:15:28', '2025-11-05 21:47:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(12, 'John Doe', 'moderator@live.com', NULL, '$2y$12$pYp4aapjyh2vMAASNhY21uSlZaEdpCxjdGjWnXM3lIo1dRG2CzIP2', NULL, 1, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wbreviews`
--

CREATE TABLE `wbreviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `review` text DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `review_date` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `date`, `created_at`, `updated_at`) VALUES
(53, 7, 75, '12 , November 2025', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `awards_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `blogcategories`
--
ALTER TABLE `blogcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_product`
--
ALTER TABLE `campaign_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_product_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_type_id_foreign` (`type_id`);

--
-- Indexes for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_employee_id_foreign` (`employee_id`),
  ADD KEY `leaves_type_id_foreign` (`type_id`);

--
-- Indexes for table `leavetypes`
--
ALTER TABLE `leavetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payrolls_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serves`
--
ALTER TABLE `serves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_user_id_foreign` (`user_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtps`
--
ALTER TABLE `smtps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wbreviews`
--
ALTER TABLE `wbreviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wbreviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogcategories`
--
ALTER TABLE `blogcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `campaign_product`
--
ALTER TABLE `campaign_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `expensetypes`
--
ALTER TABLE `expensetypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leavetypes`
--
ALTER TABLE `leavetypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `serves`
--
ALTER TABLE `serves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `smtps`
--
ALTER TABLE `smtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wbreviews`
--
ALTER TABLE `wbreviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaign_product`
--
ALTER TABLE `campaign_product`
  ADD CONSTRAINT `campaign_product_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `expensetypes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leaves_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `leavetypes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `payrolls_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blogcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wbreviews`
--
ALTER TABLE `wbreviews`
  ADD CONSTRAINT `wbreviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
