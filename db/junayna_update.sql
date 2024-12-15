-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 11:00 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `junayna_update`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Product Purchase', 'product-purchase', 1, '2022-06-22 03:49:01', '2022-06-22 03:49:01'),
(2, 'Product Sell', 'product-sell', 1, '2020-07-28 13:09:05', '2020-07-28 13:09:05'),
(3, 'Product Return', 'product-return', 1, '2021-09-14 05:59:26', '2021-09-14 05:59:26'),
(4, 'Cash Fund', 'cash-fund', 1, '2021-08-26 17:18:26', '2021-08-26 17:18:26'),
(6, 'Transport Cost', 'transport-cost', 1, '2020-09-04 11:51:38', '2020-09-04 11:51:38'),
(7, 'House rent', 'house-rent', 1, '2021-07-02 21:26:46', '2021-07-02 21:26:46'),
(8, 'Electricity Bill', 'electricity-bill', 1, '2021-07-04 23:54:29', '2021-07-04 23:54:29'),
(9, 'Courier Charge', 'courier-charge', 1, '2021-07-04 23:55:15', '2021-07-04 23:55:15'),
(10, 'Refreshment', 'refreshment', 1, '2021-07-04 23:55:34', '2021-07-04 23:55:34'),
(11, 'Market Bill', 'market-bill', 1, '2021-07-04 23:55:44', '2021-07-04 23:55:44'),
(12, 'Purchase Materials', 'purchase-materials', 1, '2021-07-04 23:56:08', '2021-07-04 23:56:08'),
(13, 'Packaging Cost', 'packaging-cost', 1, '2021-07-11 06:08:00', '2021-07-11 06:08:00'),
(14, 'Repair Materials', 'repair-materials', 1, '2021-07-11 06:08:55', '2021-07-11 06:08:55'),
(15, 'Damage/Loss', 'damage/loss', 1, '2021-07-19 08:34:00', '2022-10-16 01:45:54'),
(16, 'Web maintenance', 'web-maintenance', 1, '2021-07-19 08:34:34', '2021-07-19 08:34:34'),
(17, 'Others', 'others', 1, '2021-08-26 17:18:26', '2021-08-26 17:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `account_ledgers`
--

CREATE TABLE `account_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_head_id` bigint(20) UNSIGNED NOT NULL,
  `particulars` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` double NOT NULL DEFAULT 0,
  `credit` double NOT NULL DEFAULT 0,
  `balance` double NOT NULL DEFAULT 0,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Debit, 2=>Credit',
  `order_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_ledgers`
--

INSERT INTO `account_ledgers` (`id`, `account_head_id`, `particulars`, `debit`, `credit`, `balance`, `type`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Product ID: 1', 390, 0, -390, 1, 0, 1, '2024-12-05 08:54:59', '2024-12-05 08:54:59'),
(2, 1, 'Product ID: 2', 500, 0, -890, 1, 0, 2, '2024-12-05 08:57:51', '2024-12-05 08:57:51'),
(3, 1, 'Product ID: 3', 200, 0, -1090, 1, 0, 3, '2024-12-05 08:59:47', '2024-12-05 08:59:47'),
(4, 1, 'Product ID: 4', 120, 0, -1210, 1, 0, 4, '2024-12-05 09:02:11', '2024-12-05 09:02:11'),
(5, 1, 'Product ID: 5', 150, 0, -1360, 1, 0, 5, '2024-12-05 10:27:43', '2024-12-05 10:27:43'),
(6, 1, 'Product ID: 6', 220, 0, -1580, 1, 0, 6, '2024-12-05 10:31:33', '2024-12-05 10:31:33'),
(7, 1, 'Product ID: 7', 220, 0, -1800, 1, 0, 7, '2024-12-05 10:34:39', '2024-12-05 10:34:39'),
(8, 1, 'Product ID: 8', 430, 0, -2230, 1, 0, 8, '2024-12-05 10:36:35', '2024-12-05 10:36:35'),
(9, 1, 'Product ID: 9', 390, 0, -2620, 1, 0, 9, '2024-12-05 10:40:17', '2024-12-05 10:40:17'),
(10, 1, 'Product ID: 10', 450, 0, -3070, 1, 0, 10, '2024-12-05 10:43:16', '2024-12-05 10:43:16'),
(11, 2, 'Order ID: 1', 0, 660, 660, 2, 1, 0, '2024-12-05 11:16:47', '2024-12-05 11:16:47'),
(12, 2, 'Order ID: 2', 0, 360, 360, 2, 2, 0, '2024-12-05 12:02:27', '2024-12-05 12:02:27'),
(13, 2, 'Order ID: 3', 0, 740, 740, 2, 3, 0, '2024-12-09 05:15:45', '2024-12-09 05:15:45'),
(14, 2, 'Order ID: 4', 0, 240, 240, 2, 4, 0, '2024-12-09 05:17:03', '2024-12-09 05:17:03'),
(15, 2, 'Order ID: 5', 0, 240, 240, 2, 5, 0, '2024-12-09 05:18:10', '2024-12-09 05:18:10'),
(16, 2, 'Order ID: 6', 0, 540, 540, 2, 6, 0, '2024-12-09 05:19:44', '2024-12-09 05:19:44'),
(17, 2, 'Order ID: 7', 0, 500, 500, 2, 7, 0, '2024-12-09 05:21:24', '2024-12-09 05:21:24'),
(18, 2, 'Order ID: 8', 0, 580, 580, 2, 8, 0, '2024-12-09 05:22:50', '2024-12-09 05:22:50'),
(19, 2, 'Order ID: 9', 0, 1830, 1830, 2, 9, 0, '2024-12-14 09:56:28', '2024-12-14 09:56:28'),
(20, 2, 'Invoice No: 0000013', 0, 1590, 1590, 2, 13, 0, '2024-12-15 05:26:48', '2024-12-15 05:26:48'),
(21, 2, 'Order ID: 1', 0, 3330, 3330, 2, 1, 0, '2024-12-15 05:35:20', '2024-12-15 05:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upazilla_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `upazilla_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Default, 0=>Not Default',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 'Color', 1, 4, '2022-08-27 00:14:35', '2022-08-27 00:14:35'),
(5, 'Size', 1, 4, '2022-08-27 00:16:20', '2022-08-27 00:16:20'),
(6, 'Extra', 1, 4, '2022-08-27 00:17:09', '2022-08-27 00:17:09'),
(12, 'One Size', 1, 4, '2024-01-13 06:23:41', '2024-01-13 06:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

CREATE TABLE `attribute_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(28, 4, 'Red', 1, 4, '2022-08-27 00:15:32', '2022-08-27 00:15:32'),
(29, 4, 'White', 1, 4, '2022-08-27 00:15:36', '2022-08-27 00:15:36'),
(30, 4, 'Green', 1, 4, '2022-08-27 00:15:48', '2022-08-27 00:15:48'),
(31, 4, 'Yellow', 1, 4, '2022-08-27 00:16:00', '2022-08-27 00:16:00'),
(32, 5, 'S', 1, 4, '2022-08-27 00:16:27', '2022-08-27 00:16:27'),
(33, 5, 'M', 1, 4, '2022-08-27 00:16:30', '2022-08-27 00:16:30'),
(34, 5, 'L', 1, 4, '2022-08-27 00:16:32', '2022-08-27 00:16:32'),
(35, 5, 'XL', 1, 4, '2022-08-27 00:16:35', '2022-08-27 00:16:35'),
(36, 5, 'XXl', 1, 4, '2022-08-27 00:16:44', '2022-08-27 00:16:44'),
(37, 6, '62', 1, 4, '2022-08-27 00:17:30', '2022-08-27 00:17:30'),
(38, 6, '30', 1, 4, '2022-08-27 00:17:38', '2022-08-27 00:17:38'),
(39, 6, '32', 1, 4, '2022-08-27 00:17:48', '2022-08-27 00:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value_product_price`
--

CREATE TABLE `attribute_value_product_price` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_price_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=>Home Banner, 0=>Footer Banner',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title_en`, `title_bn`, `tags`, `description`, `slug`, `blog_img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh Seafood Industry – Sea Food Expo Bangladesh', 'Bangladesh Seafood Industry – Sea Food Expo Bangladesh', 'Bangladesh Seafood Industry – Sea Food Expo Bangladesh', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'bangladesh-seafood-industry--sea-food-expo-bangladesh', 'upload/blog/17341523532.jpg', 1, '2024-12-14 04:59:13', '2024-12-14 04:59:13'),
(2, 'Fisheries Industry In Bangladesh', 'Fisheries Industry In Bangladesh', 'Fisheries Industry In Bangladesh', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'fisheries-industry-in-bangladesh', 'upload/blog/1734152311Fisheries-Industries-In-Bangladesh.jpg', 1, '2024-12-14 04:58:31', '2024-12-14 04:58:31'),
(3, 'Seafood Blog: Fish & Seafood Recipes and More - Crave Fishbar', 'Seafood Blog: Fish & Seafood Recipes and More - Crave Fishbar', 'Seafood Blog: Fish & Seafood Recipes and More - Crave Fishbar', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'seafood-blog-fish--seafood-recipes-and-more---crave-fishbar', 'upload/blog/1734151652Health-Benefits-of-Seafood-Featured.jpg', 1, '2024-12-14 04:47:32', '2024-12-14 04:47:32'),
(4, 'Best Seafood Restaurants in The World', 'Best Seafood Restaurants in The World', 'Best Seafood Restaurants in The World', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'best-seafood-restaurants-in-the-world', 'upload/blog/1734151583pg-seafood-restaurants-1632836463.jpg', 1, '2024-12-14 04:46:23', '2024-12-14 04:46:23'),
(5, 'Delights of Korean Seafood', 'Delights of Korean Seafood', 'Delights of Korean Seafood', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'delights-of-korean-seafood', 'upload/blog/1734151252post-10.jpg', 1, '2024-12-14 04:40:52', '2024-12-14 04:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `brand_image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(6, 'Seafood Source Bangladesh', 'Seafood Source Bangladesh', 'seafood-source-bangladesh', 'Seafood Source Bangladesh', 'Seafood Source Bangladesh', 'upload/brand/1734152515download.png', 1, 4, '2024-12-05 08:48:12', '2024-12-14 05:01:55'),
(7, 'Others', 'Others', 'others', 'Others', 'Others', 'upload/brand/1734152578174406.jpg', 1, 4, '2024-12-05 08:54:04', '2024-12-14 05:02:58'),
(8, 'BD Seafood Limited', 'BD Seafood Limited', 'bd-seafood-limited', 'BD Seafood Limited', 'BD Seafood Limited', 'upload/brand/1818390744204606.jpg', 1, 4, '2024-12-14 05:02:30', '2024-12-14 05:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `campaings`
--

CREATE TABLE `campaings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campaing_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flash_start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flash_end` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured	',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaing_products`
--

CREATE TABLE `campaing_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaing_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` double NOT NULL DEFAULT 0,
  `discount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Flat, 2=>Percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Category, 2=>SubCategory, 3=> SubSubCategory',
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `image`, `parent_id`, `type`, `is_featured`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Tuna', 'Tuna', 'Tuna-Vwc68', 'Tuna', 'Tuna', 'upload/category/1734150575Products_2-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:25:14', '2024-12-14 04:29:36'),
(2, 'Snapper', 'Snapper', 'Snapper-eo53e', 'Snapper', 'Snapper', 'upload/category/1734150616Products_3-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:28:32', '2024-12-14 04:30:16'),
(3, 'Shrimp', 'Shrimp', 'Shrimp-RJvH3', 'Shrimp', 'Shrimp', 'upload/category/1734150722Products_7-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:30:04', '2024-12-14 04:32:02'),
(4, 'Scallops', 'Scallops', 'Scallops-dzU4q', 'Scallops', 'Scallops', 'upload/category/1734150751Products_4-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:32:33', '2024-12-14 04:32:31'),
(5, 'Salmon', 'Salmon', 'Salmon-uug9G', 'Salmon', 'Salmon', 'upload/category/1734150781Products_1-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:33:50', '2024-12-14 04:33:01'),
(6, 'Mussels', 'Mussels', 'Mussels-maDgo', 'Mussels', 'Mussels', 'upload/category/1734150830Products_8-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:35:19', '2024-12-14 04:33:50'),
(7, 'Masago', 'Masago', 'Masago-dxt6a', 'Masago', 'Masago', 'upload/category/1734150860Products_10-540x496.jpg', 0, 1, 1, 1, 4, '2024-12-05 08:37:11', '2024-12-14 04:34:21'),
(9, 'Lobster', 'Lobster', 'Lobster-pg1vC', 'Lobster', 'Lobster', 'upload/category/1818388997062828.jpg', 0, 1, 1, 1, 4, '2024-12-14 04:34:43', '2024-12-14 04:34:43'),
(10, 'Crab', 'Crab', 'Crab-7VeeK', 'Crab', 'Crab', 'upload/category/1818389029357196.jpg', 0, 1, 1, 1, 4, '2024-12-14 04:35:14', '2024-12-14 04:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Fixed Amount, 0=>Percent',
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `limit_per_user` double(20,2) NOT NULL DEFAULT 0.00,
  `total_use_limit` double(20,2) NOT NULL DEFAULT 0.00,
  `expire_date` date DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>All Customers, 0=>Specific Customer',
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `division_name_bn` varchar(150) NOT NULL,
  `district_name_bn` varchar(130) NOT NULL,
  `district_name_en` text NOT NULL,
  `division_name_en` text NOT NULL,
  `division_id` varchar(210) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:Blocked, 1:Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_name_bn`, `district_name_bn`, `district_name_en`, `division_name_en`, `division_id`, `status`) VALUES
(1, 'চট্টগ্রাম', 'কুমিল্লা', 'cumilla', 'chattogram', '2', 1),
(2, 'চট্টগ্রাম', 'ফেনী', 'feni', 'chattogram', '2', 1),
(3, 'চট্টগ্রাম', 'ব্রাহ্মণবাড়িয়া', 'brahmanbaria', 'chattogram', '2', 1),
(4, 'চট্টগ্রাম', 'রাঙ্গামাটি', 'rangamati', 'chattogram', '2', 1),
(5, 'চট্টগ্রাম', 'নোয়াখালী', 'noakhali', 'chattogram', '2', 1),
(6, 'চট্টগ্রাম', 'চাঁদপুর', 'chandpur', 'chattogram', '2', 1),
(7, 'চট্টগ্রাম', 'লক্ষ্মীপুর', 'lakshmipur', 'chattogram', '2', 1),
(8, 'চট্টগ্রাম', 'চট্টগ্রাম', 'chattogram', 'chattogram', '2', 1),
(9, 'চট্টগ্রাম', 'কক্সবাজার', 'coxsbazar', 'chattogram', '2', 1),
(10, 'চট্টগ্রাম', 'খাগড়াছড়ি', 'khagrachari', 'chattogram', '2', 1),
(11, 'চট্টগ্রাম', 'বান্দরবান', 'bandarban', 'chattogram', '2', 1),
(12, 'রাজশাহী', 'সিরাজগঞ্জ', 'sirajganj', 'rajshahi', '3', 1),
(13, 'রাজশাহী', 'পাবনা', 'pabna', 'rajshahi', '3', 1),
(14, 'রাজশাহী', 'বগুড়া', 'bogura', 'rajshahi', '3', 1),
(15, 'রাজশাহী', 'রাজশাহী', 'rajshahi', 'rajshahi', '3', 1),
(16, 'রাজশাহী', 'নাটোর', 'natore', 'rajshahi', '3', 1),
(17, 'রাজশাহী', 'জয়পুরহাট', 'jaipurhat', 'rajshahi', '3', 1),
(18, 'রাজশাহী', 'চাঁপাইনবাবগঞ্জ', 'nawabganj', 'rajshahi', '3', 1),
(19, 'রাজশাহী', 'নওগাঁ', 'naogaon', 'rajshahi', '3', 1),
(20, 'খুলনা', 'যশোর', 'jashore', 'khulna', '4', 1),
(21, 'খুলনা', 'সাতক্ষীরা', 'satkhira', 'khulna', '4', 1),
(22, 'খুলনা', 'মেহেরপুর', 'meherpur', 'khulna', '4', 1),
(23, 'খুলনা', 'নড়াইল', 'narail', 'khulna', '4', 1),
(24, 'খুলনা', 'চুয়াডাঙ্গা', 'chuadanga', 'khulna', '4', 1),
(25, 'খুলনা', 'কুষ্টিয়া', 'kushtia', 'khulna', '4', 1),
(26, 'খুলনা', 'মাগুরা', 'magura', 'khulna', '4', 1),
(27, 'খুলনা', 'খুলনা', 'khulna', 'khulna', '4', 1),
(28, 'খুলনা', 'বাগেরহাট', 'bagerhat', 'khulna', '4', 1),
(29, 'খুলনা', 'ঝিনাইদহ', 'jhenaidah', 'khulna', '4', 1),
(30, 'বরিশাল', 'বরিশাল', 'barishal', 'barishal', '5', 1),
(31, 'বরিশাল', 'ঝালকাঠি', 'jhalokati', 'barishal', '5', 1),
(32, 'বরিশাল', 'পটুয়াখালী', 'patuakhali', 'barishal', '5', 1),
(33, 'বরিশাল', 'পিরোজপুর', 'pirojpur', 'barishal', '5', 1),
(34, 'বরিশাল', 'ভোলা', 'bhola', 'barishal', '5', 1),
(35, 'বরিশাল', 'বরগুনা', 'barguna', 'barishal', '5', 1),
(36, 'সিলেট', 'সিলেট', 'sylhet', 'sylhet', '6', 1),
(37, 'সিলেট', 'মৌলভীবাজার', 'moulvibazar', 'sylhet', '6', 1),
(38, 'সিলেট', 'হবিগঞ্জ', 'habiganj', 'sylhet', '6', 1),
(39, 'সিলেট', 'সুনামগঞ্জ', 'sunamganj', 'sylhet', '6', 1),
(40, 'রংপুর', 'রংপুর', 'rangpur', 'rangpur', '7', 1),
(41, 'রংপুর', 'পঞ্চগড়', 'panchagarh', 'rangpur', '7', 1),
(42, 'রংপুর', 'দিনাজপুর', 'dinajpur', 'rangpur', '7', 1),
(43, 'রংপুর', 'লালমনিরহাট', 'lalmonirhat', 'rangpur', '7', 1),
(44, 'রংপুর', 'নীলফামারী', 'nilphamari', 'rangpur', '7', 1),
(45, 'রংপুর', 'ঠাকুরগাঁও', 'thakurgaon', 'rangpur', '7', 1),
(46, 'রংপুর', 'গাইবান্ধা', 'gaibandha', 'rangpur', '7', 1),
(47, 'রংপুর', 'কুড়িগ্রাম', 'kurigram', 'rangpur', '7', 1),
(48, 'ময়মনসিংহ', 'ময়মনসিংহ', 'mymensingh', 'mymensingh', '8', 1),
(49, 'ময়মনসিংহ', 'জামালপুর', 'jamalpur', 'mymensingh', '8', 1),
(50, 'ময়মনসিংহ', 'নেত্রকোণা', 'netrokona', 'mymensingh', '8', 1),
(51, 'ময়মনসিংহ', 'শেরপুর', 'sherpur', 'mymensingh', '8', 1),
(52, 'ঢাকা', 'ঢাকা', 'dhaka', 'dhaka', '1', 1),
(53, 'ঢাকা', 'নরসিংদী', 'narsingdi', 'dhaka', '1', 1),
(54, 'ঢাকা', 'গাজীপুর', 'gazipur', 'dhaka', '1', 1),
(55, 'ঢাকা', 'শরীয়তপুর', 'shariatpur', 'dhaka', '1', 1),
(56, 'ঢাকা', 'নারায়ণগঞ্জ', 'narayanganj', 'dhaka', '1', 1),
(57, 'ঢাকা', 'টাঙ্গাইল', 'tangail', 'dhaka', '1', 1),
(58, 'ঢাকা', 'কিশোরগঞ্জ', 'kishoreganj', 'dhaka', '1', 1),
(59, 'ঢাকা', 'মানিকগঞ্জ', 'manikganj', 'dhaka', '1', 1),
(60, 'ঢাকা', 'মুন্সিগঞ্জ', 'munshiganj', 'dhaka', '1', 1),
(61, 'ঢাকা', 'রাজবাড়ী', 'rajbari', 'dhaka', '1', 1),
(62, 'ঢাকা', 'মাদারীপুর', 'madaripur', 'dhaka', '1', 1),
(63, 'ঢাকা', 'ফরিদপুর', 'faridpur', 'dhaka', '1', 1),
(64, 'ঢাকা', 'গোপালগঞ্জ', 'gopalganj', 'dhaka', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `division_id` varchar(30) NOT NULL,
  `division_name_bn` varchar(30) NOT NULL,
  `division_name_en` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:Blocked, 1:Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division_id`, `division_name_bn`, `division_name_en`, `country_id`, `status`) VALUES
(1, '1', 'ঢাকা', 'dhaka', 22, 1),
(2, '2', 'চট্টগ্রাম', 'chattogram', 22, 1),
(3, '3', 'রাজশাহী', 'rajshahi', 22, 1),
(4, '4', 'খুলনা', 'khulna', 22, 1),
(5, '5', 'বরিশাল', 'barishal', 22, 1),
(6, '6', 'সিলেট', 'sylhet', 22, 1),
(7, '7', 'রংপুর', 'rangpur', 22, 1),
(8, '8', 'ময়মনসিংহ', 'mymensingh', 22, 1);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2022_07_24_074842_create_multi_imgs_table', 1),
(27, '2022_02_04_061801_create_product_prices_table', 6),
(28, '2022_02_04_065518_create_attribute_product_table', 6),
(29, '2022_05_20_152549_create_attribute_value_product_price_table', 6),
(47, '2022_07_23_114405_create_sliders_table', 7),
(51, '2022_07_28_064437_create_campaings_table', 7),
(53, '2022_07_31_095124_create_blogs_table', 7),
(54, '2022_08_01_045408_create_pages_table', 7),
(56, '2022_08_10_105324_create_addresses_table', 7),
(57, '2022_08_14_045916_create_settings_table', 7),
(60, '2022_08_19_201539_create_product_stocks_table', 8),
(61, '2022_09_03_062044_create_shippings_table', 9),
(62, '2022_08_14_105209_create_order_details_table', 10),
(63, '2022_09_03_055707_create_coupons_table', 11),
(65, '2022_07_30_093841_create_banners_table', 12),
(67, '2022_09_17_111303_create_campaing_products_table', 13),
(68, '2022_09_27_050816_create_subscribers_table', 14),
(69, '2022_09_28_103615_create_roles_table', 15),
(71, '2022_09_28_110124_create_staff_table', 16),
(72, '2022_07_24_111956_create_vendors_table', 17),
(73, '2022_07_19_132400_create_brands_table', 18),
(74, '2022_07_20_105632_create_categories_table', 18),
(75, '2022_07_21_140629_create_suppliers_table', 18),
(76, '2022_07_24_063334_create_products_table', 18),
(77, '2022_08_04_073752_create_attributes_table', 18),
(78, '2022_08_06_053505_create_attribute_values_table', 18),
(79, '2022_08_14_105132_create_orders_table', 18),
(80, '2022_10_16_060400_create_account_heads_table', 19),
(82, '2022_10_16_082419_create_account_ledgers_table', 20),
(84, '2022_12_31_055130_create_units_table', 21),
(85, '2023_04_02_063808_create_order_statuses_table', 22),
(86, '2023_09_20_100354_create_reviews_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `multi_imgs`
--

CREATE TABLE `multi_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_imgs`
--

INSERT INTO `multi_imgs` (`id`, `product_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(13, 10, 'upload/products/multi-image/1818391171901613.jpg', '2024-12-14 05:09:17', NULL),
(14, 9, 'upload/products/multi-image/1818391237525892.webp', '2024-12-14 05:10:20', NULL),
(15, 8, 'upload/products/multi-image/1818391323642863.webp', '2024-12-14 05:11:42', NULL),
(16, 7, 'upload/products/multi-image/1818391486668937.webp', '2024-12-14 05:14:18', NULL),
(17, 6, 'upload/products/multi-image/1818391598631602.jpg', '2024-12-14 05:16:04', NULL),
(18, 5, 'upload/products/multi-image/1818391753343005.jpeg', '2024-12-14 05:18:32', NULL),
(19, 4, 'upload/products/multi-image/1818391864623284.webp', '2024-12-14 05:20:18', NULL),
(20, 3, 'upload/products/multi-image/1818392028245028.jpeg', '2024-12-14 05:22:54', NULL),
(21, 2, 'upload/products/multi-image/1818392156616964.jpg', '2024-12-14 05:24:57', NULL),
(22, 1, 'upload/products/multi-image/1818392282458342.png', '2024-12-14 05:26:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordernotes`
--

CREATE TABLE `ordernotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordernotes`
--

INSERT INTO `ordernotes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Response', 1, '2024-12-09 06:48:31', '2024-12-09 06:57:02'),
(3, 'Not Response', 1, '2024-12-09 06:57:14', '2024-12-09 06:57:14'),
(4, 'Not Pickup call', 1, '2024-12-09 06:57:25', '2024-12-09 07:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `upazilla_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT 0.00,
  `pur_sub_total` decimal(10,2) DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` tinyint(4) DEFAULT NULL,
  `staff_commission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delivery_viewed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `payment_status_viewed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `commission_calculated` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `tracking_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picked_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipped_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Not guest order, 2=>Guest Order',
  `sale_type` int(10) DEFAULT 1 COMMENT '1=>Manual Sale, 2=>Online Order',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_varient` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Varient Product, 0=>Normal Product',
  `variation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(20,2) NOT NULL DEFAULT 0.00,
  `tax` double(20,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` double(20,2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `shipping_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_point_id` int(11) DEFAULT NULL,
  `product_referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nav',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name_en`, `name_bn`, `title`, `slug`, `description_en`, `description_bn`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'About Us', 'About Us', 'about-us', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Bottom', 1, '2024-12-05 11:02:52', '2024-12-05 11:02:52'),
(2, 'Return Policy', 'Return Policy', 'Return Policy', 'return-policy', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Bottom', 1, '2024-12-05 11:03:35', '2024-12-05 11:03:35'),
(3, 'Support & Policy', 'Support & Policy', 'Support & Policy', 'support--policy', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Bottom', 1, '2024-12-05 11:04:05', '2024-12-05 11:04:05'),
(4, 'Contact Us', 'Contact Us', 'Contact Us', 'contact-us', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Bottom', 1, '2024-12-05 11:04:37', '2024-12-05 11:04:37'),
(5, 'Fish Store', 'Fish Store', 'Fish Store', 'fish-store', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Bottom', 1, '2024-12-14 04:36:19', '2024-12-14 04:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sumaiyazaman1411@gmail.com', '$2y$10$T.GexeLJZ.u9k.ZYBH18g.bAXMBx5NpBU8jPxY3KbiooIbMs7V4nS', '2023-12-30 22:12:48'),
('fatemafiha016@gmail.com', '$2y$10$e2ByLLpTg8s88bpsq2AIE.cVJf8Ny1kPsRaGjgtgZSPIZOW8P3gk2', '2024-01-21 12:51:17'),
('tabassum.navana1@gmail.com', '$2y$10$OfcjFr6YSG7ljYHNQYL5r.sPHr5bKx3qTVYXjbocl0WDsoVbTOWym', '2024-02-27 07:40:21'),
('afrinakowshersujana@gmail.com', '$2y$10$EsBdjrud6KmsPhgyt/FOLO1MaR2Z7q5pDpXwKXurwWiegLPXLQiYy', '2024-03-31 11:52:36'),
('mrinmoyeemeghameem@gmail.com', '$2y$10$ZNA7zemcCZm/WFmVN1tMt.HRNVl2P4rqU.sMJie2uE4fVELUo/NcC', '2024-04-04 19:27:18'),
('sultanatanin39@gmail.com', '$2y$10$SY18pV4VzWjUasDLk8O4yO4JApdqHtUXXw6g/U6mzAeC9XU4uBilC', '2024-05-13 04:17:04'),
('quayum1997@gmail.com', '$2y$10$gojzKztYQMeCVLduO1CkBOpGBh.XCVrPTbF.5vvBDYZjM6rehUrRe', '2024-07-31 06:21:42'),
('maishaaa111@gmail.com', '$2y$10$lvXjkBHbzNgfKAPxN9YGoeHM6.udwuxbRNElIxbqj/9DTUxRLKMum', '2024-09-21 16:49:33'),
('runaway9968@gmail.com', '$2y$10$PUyrZzj5Szff/qeNYiQqE.WkDt/jEbNp8SPlerY0EMETS5qzqs2wa', '2024-10-02 19:57:58'),
('gomeseuphrasie@gmail.com', '$2y$10$.MgOfwQ3P2Mgaz1zgSOv7eKStWF.xnH1KUUL6bYxW80H6Ayum2ZnK', '2024-10-13 02:34:43'),
('sumaiyahasan926@gmail.com', '$2y$10$E.DjL0b4ycjCwX/yJ4X1yOyTKHQVH0Jyd.Jri6NT65rr3GzGATWFq', '2024-10-24 13:18:24');

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
-- Table structure for table `pos_carts`
--

CREATE TABLE `pos_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `sub_sub_category_id` int(11) DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `campaing_id` int(11) DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` double NOT NULL DEFAULT 0,
  `is_wholesell` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '1=>Wholesell, 0=>Not Wholesell',
  `wholesell_price` double DEFAULT NULL,
  `wholesell_minimum_qty` int(11) DEFAULT NULL,
  `regular_price` double NOT NULL DEFAULT 0,
  `discount_price` double DEFAULT NULL,
  `discount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Flat, 2=>Percentage',
  `minimum_buy_qty` int(11) DEFAULT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `product_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attributes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_varient` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Varient, 0=>Not Varient',
  `attribute_values` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured',
  `is_deals` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Deals, 0=>Not Deals',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `is_approved` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Approved, 0=>Not Approved',
  `is_digital` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Digital, 0=>Not Digital',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `tags`, `vendor_id`, `supplier_id`, `unit_id`, `campaing_id`, `name_en`, `name_bn`, `slug`, `product_code`, `unit_weight`, `purchase_price`, `is_wholesell`, `wholesell_price`, `wholesell_minimum_qty`, `regular_price`, `discount_price`, `discount_type`, `minimum_buy_qty`, `stock_qty`, `product_thumbnail`, `short_description_en`, `short_description_bn`, `description_en`, `description_bn`, `attributes`, `is_varient`, `attribute_values`, `variations`, `is_featured`, `is_deals`, `status`, `is_approved`, `is_digital`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 7, 5, NULL, NULL, '', 0, 5, 0, NULL, 'Salmon Fresh - Huon Tasmania', 'Salmon Fresh - Huon Tasmania', 'Salmon-Fresh---Huon-Tasmania-frO0q', '86527', NULL, 2390, 0, 0, 0, 4500, 0, 1, 1, 100, 'upload/products/thumbnails/1818392282345716.webp', '<p>Salmon Fresh - Huon Tasmania</p>', '<p>Salmon Fresh - Huon Tasmania</p>', '<p>Salmon Fresh - Huon Tasmania</p>', '<p>Salmon Fresh - Huon Tasmania</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 08:54:59', '2024-12-14 05:26:56'),
(2, 7, 5, NULL, NULL, '', 0, 5, 0, NULL, 'Whole Fresh Var Salmon', 'Whole Fresh Var Salmon', 'Whole-Fresh-Var-Salmon-S0uWF', '87840', NULL, 2500, 0, 0, 0, 3760, 0, 1, 1, 100, 'upload/products/thumbnails/1818392156525772.webp', '<p>Whole Fresh Var Salmon</p>', '<p>Whole Fresh Var Salmon</p>', '<p>Whole Fresh Var Salmon</p>', '<p>Whole Fresh Var Salmon</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 08:57:51', '2024-12-14 05:24:56'),
(3, 8, 5, NULL, NULL, '', 0, 5, 0, NULL, 'European / Norwegian Salmon', 'European / Norwegian Salmon', 'European--Norwegian-Salmon-8Kkhh', '91936', NULL, 2200, 0, 0, 0, 3300, 0, 1, 1, 15, 'upload/products/thumbnails/1818392028051720.webp', '<p>European / Norwegian Salmon</p>', '<p>European / Norwegian Salmon</p>', '<p>European / Norwegian Salmon</p>', '<p>European / Norwegian Salmon</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 08:59:47', '2024-12-14 05:22:54'),
(4, 6, 5, NULL, NULL, '', 0, 5, 0, NULL, 'FRESH ATLANTIC SALMON', 'FRESH ATLANTIC SALMON', 'FRESH-ATLANTIC-SALMON-QkqI8', '64720', NULL, 2120, 0, 0, 0, 3180, 0, 1, 1, 46, 'upload/products/thumbnails/1818391864566965.jpg', '<p>FRESH ATLANTIC SALMON</p>', '<p>FRESH ATLANTIC SALMON</p>', '<p>FRESH ATLANTIC SALMON</p>', '<p>FRESH ATLANTIC SALMON</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 09:02:10', '2024-12-15 05:45:47'),
(5, 6, 5, NULL, NULL, '', 0, 0, 0, NULL, 'Fresh Whole Indian Salmon', 'Fresh Whole Indian Salmon', 'Fresh-Whole-Indian-Salmon-90qYP', '25907', NULL, 2150, 0, 0, 0, 3220, 0, 1, 1, 50, 'upload/products/thumbnails/1818391753170620.webp', '<p>Fresh Whole Indian Salmon</p>', '<p>Fresh Whole Indian Salmon</p>', '<p>Fresh Whole Indian Salmon</p>', '<p>Fresh Whole Indian Salmon</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 10:27:43', '2024-12-14 05:18:32'),
(6, 7, 3, NULL, NULL, '', 0, 0, 0, NULL, 'Golda Shrimp', 'Golda Shrimp', 'Golda-Shrimp-zEMlj', '76226', NULL, 1220, 0, 0, 0, 1350, 0, 1, 1, 46, 'upload/products/thumbnails/1818391598553779.jpg', '<p>Golda Shrimp</p>', '<p>Golda Shrimp</p>', '<p>Golda Shrimp</p>', '<p>Golda Shrimp</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 10:31:33', '2024-12-15 05:42:12'),
(7, 7, 3, NULL, NULL, '', 0, 0, 0, NULL, 'Red Sea Prawns', 'Red Sea Prawns', 'Red-Sea-Prawns-YweiE', '24136', NULL, 1220, 0, 0, 0, 1590, 0, 1, 1, 37, 'upload/products/thumbnails/1818391486500456.webp', '<p>Red Sea Prawns</p>', '<p>Red Sea Prawns</p>', '<p>Red Sea Prawns</p>', '<p>Red Sea Prawns</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 10:34:39', '2024-12-15 05:45:47'),
(8, 7, 3, NULL, NULL, '', 0, 0, 0, NULL, 'Black Tiger Shrimp', 'Black Tiger Shrimp', 'Black-Tiger-Shrimp-04YgQ', '56719', NULL, 1430, 0, 0, 0, 1600, 0, 1, 1, 99, 'upload/products/thumbnails/1818391323571333.jpg', 'Black Tiger Shrimp', '<p>Black Tiger Shrimp</p>', '<p>Black Tiger Shrimp</p>', '<p>Black Tiger Shrimp</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 10:36:35', '2024-12-15 05:42:12'),
(9, 8, 3, NULL, NULL, '', 0, 0, 0, NULL, 'Frozen Scambi Head On Shell', 'Frozen Scambi Head On Shell', 'Frozen-Scambi-Head-On-Shell-0uH5N', '51213', NULL, 1390, 0, 0, 0, 1520, 0, 1, 1, 98, 'upload/products/thumbnails/1818391225935676.jpg', '<font face=\"Arial, sans-serif\">Frozen Scambi Head On Shell</font>', '<p>Frozen Scambi Head On Shell</p>', '<p>Frozen Scambi Head On Shell</p>', '<p>Frozen Scambi Head On Shell</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 10:40:17', '2024-12-15 05:42:12'),
(10, 8, 3, NULL, NULL, '', 0, 0, 0, NULL, 'BD Shrimp Trading', 'BD Shrimp Trading', 'BD-Shrimp-Trading-sgTea', '86673', NULL, 1450, 0, 0, 0, 1680, 0, 1, 1, 48, 'upload/products/thumbnails/1818391171711769.png', '<p>BD Shrimp Trading</p>', '<p>BD Shrimp Trading</p>', '<p>BD Shrimp Trading</p>', '<p>BD Shrimp Trading</p>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 4, '2024-12-05 10:43:15', '2024-12-14 09:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `varient` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(20,2) NOT NULL DEFAULT 0.00,
  `qty` mediumint(9) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Manager', '[\"1\",\"2\",\"3\",\"5\",\"6\",\"8\",\"9\",\"10\",\"17\",\"18\",\"19\"]', '2022-09-28 05:05:01', '2024-01-14 05:10:42'),
(2, 'Accountant', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"13\",\"14\",\"15\",\"16\",\"17\",\"41\",\"42\",\"43\",\"44\"]', '2022-09-28 05:06:43', '2022-09-28 05:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'SEA FOOD', '2022-08-22 02:57:04', '2024-12-14 05:35:22'),
(2, 'site_logo', 'upload/setting/logo/1734154298360_F_284988042_S1tff5ED13vn8N9ZyBli30ZNZnhytyxC__1_-removebg-preview.png', '2022-08-03 12:46:20', '2024-12-14 05:31:38'),
(3, 'site_favicon', 'upload/setting/favicon/1734154298360_F_284988042_S1tff5ED13vn8N9ZyBli30ZNZnhytyxC__1_-removebg-preview.png', '2022-08-04 12:46:20', '2024-12-14 05:31:38'),
(4, 'site_footer_logo', 'upload/setting/logo/1734154298360_F_284988042_S1tff5ED13vn8N9ZyBli30ZNZnhytyxC__1_-removebg-preview.png', '2022-08-03 12:46:20', '2024-12-14 05:31:38'),
(5, 'phone', '+8801700000000', '2022-08-04 12:47:27', '2024-12-14 05:35:22'),
(6, 'email', 'info@seafood.com', '2022-08-12 12:47:52', '2024-12-14 05:35:22'),
(7, 'business_name', 'SEA FOOD', '2022-08-08 12:48:27', '2024-12-14 05:35:22'),
(8, 'business_address', 'Uttara, Dhaka', '2022-08-04 12:48:53', '2024-12-14 05:35:22'),
(9, 'business_hours', '10:00 - 8:00, Sa - Thu', '2022-08-01 12:49:29', NULL),
(10, 'copy_right', 'Copy Right SEA FOOD 2024', '2022-08-05 12:49:58', '2024-12-14 05:35:22'),
(11, 'developed_by', 'Classic IT & Sky Mart Ltd.', '2022-08-14 12:50:24', NULL),
(12, 'developer_link', 'https://www.classicit.com.bd/', '2022-08-13 12:50:56', NULL),
(13, 'facebook_url', 'https://www.facebook.com/', '2022-08-18 12:51:19', '2022-09-06 22:56:57'),
(14, 'twitter_url', 'https://www.twitter.com/', '2022-08-17 12:51:45', NULL),
(15, 'linkedin_url', 'https://www.linkedin.com/', '2022-08-12 12:52:12', NULL),
(16, 'youtube_url', 'https://www.youtube.com/', '2022-08-04 12:52:42', NULL),
(17, 'instagram_url', 'https://www.instagram.com/', '2022-08-11 12:53:11', NULL),
(18, 'pinterest_url', 'https://www.pinterest.com/', '2022-08-05 12:53:45', NULL),
(19, 'guest_checkout', '1', '2022-09-21 05:45:31', '2022-09-21 05:45:31'),
(20, 'otp_system', '0', '2022-09-21 05:45:31', '2022-10-24 03:27:39'),
(21, 'multi_vendor', '1', '2022-10-08 04:08:02', '2022-10-24 03:28:25'),
(22, 'messenger_page_id', '100461018808781', '2023-03-04 06:20:19', NULL),
(23, 'messenger_version', 'v13.0', '2023-03-04 06:20:20', NULL),
(24, 'messenger_status', '1', '2023-03-04 06:26:27', '2023-03-04 03:42:15'),
(25, 'pixel_id', '719731932533250', '2023-03-04 06:34:25', NULL),
(26, 'pixel_version', '2.0', '2023-03-04 06:34:25', '2023-03-04 00:42:49'),
(27, 'pixel_status', '1', '2023-03-04 06:34:25', '2023-03-04 03:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Inside Dhaka, 2=>Outside Dhaka',
  `shipping_charge` double(20,2) NOT NULL DEFAULT 0.00,
  `time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `name`, `type`, `shipping_charge`, `time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Redex', 1, 60.00, '1 day', 1, '2022-09-03 03:40:16', '2023-11-07 04:03:59'),
(2, 'Sundarban Courier', 2, 150.00, '1 day', 1, '2022-09-03 03:39:25', '2022-09-03 03:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_img`, `title_en`, `title_bn`, `slider_url`, `description_bn`, `description_en`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'upload/slider/1734150419gift-packages-banner_1.jpg', 'Slider-1', 'Slider-1', '#', 'Slider-1', 'Slider-1', 'slider-1', 1, '2024-12-14 04:26:59', '2024-12-14 04:26:59'),
(2, 'upload/slider/1734150344seafood-display.jpg', 'Slider-2', 'Slider-2', '#', 'Slider-2', 'Slider-2', 'slider-2', 1, '2024-12-14 04:25:44', '2024-12-14 04:25:44'),
(3, 'upload/slider/1734150334Seafood-banner.webp', 'Slider-3', 'Slider-3', '#', 'Slider-3', 'Slider-3', 'slider-3', 1, '2024-12-14 04:25:35', '2024-12-14 04:25:35'),
(4, 'upload/slider/1734150431bg_counters.jpg', 'Slider-4', 'Slider-4', '#', 'Slider-4', 'Slider-4', 'slider-4', 1, '2024-12-14 04:27:11', '2024-12-14 04:27:11'),
(6, 'upload/slider/1818388577671956.jpg', 'Slider-5', 'Slider-5', '#', 'Slider-5', 'Slider-5', 'slider-5', 1, '2024-12-14 04:28:04', '2024-12-14 04:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `sms_providers`
--

CREATE TABLE `sms_providers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>Active, 0=>Inactive',
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_providers`
--

INSERT INTO `sms_providers` (`id`, `name`, `status`, `url`, `api_key`, `sender_id`, `created_at`, `updated_at`) VALUES
(1, 'Classic IT', 1, 'http://sms.classicit.com.bd/smsapi', 'R6001640623a9516bf1f71.13295352', 'Classic IT', '2022-04-25 21:27:37', '2022-05-24 11:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE `sms_templates` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_templates`
--

INSERT INTO `sms_templates` (`id`, `name`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'registration_verification', '[[site_name]] রেজিস্ট্রেশন ভেরিফিকেশন কোডঃ [[code]]', 1, '2022-04-25 22:02:02', '2023-04-06 10:37:11'),
(2, 'login_verification', '[[site_name]] লগিন ভেরিফিকেশন কোডঃ [[code]]', 1, '2022-04-25 22:02:46', '2022-04-25 22:07:36'),
(3, 'order_message', 'আপনার অর্ডার সম্পন্ন হয়েছে। অর্ডার  আইডিঃ [[order_code]], মূল্যঃ [[order_amount]] টাকা। - [[site_name]]', 1, '2022-04-25 22:03:12', '2022-05-24 11:38:23'),
(5, 'password_reset', 'আপনার নতুন পাসওয়ার্ডঃ [[code]]', 1, '2022-06-22 06:42:46', '2022-06-22 06:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `name_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subsubcategory_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_feature` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Active, 0=>Inactive',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `address`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'Eric Spears', '0178869873', 'volipi@mailinator.com', 'Vel unde sint velit', 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_slug_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_slug_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Slices (Slice)', 1, 4, '2022-12-31 00:27:02', '2023-02-09 02:25:35'),
(3, 'pcs', 1, 4, '2023-09-21 22:22:02', '2023-10-06 03:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `upazillas`
--

CREATE TABLE `upazillas` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name_en` varchar(25) NOT NULL,
  `name_bn` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazillas`
--

INSERT INTO `upazillas` (`id`, `district_id`, `name_en`, `name_bn`, `url`) VALUES
(1, 1, 'Debidwar', 'দেবিদ্বার', 'debidwar.comilla.gov.bd'),
(2, 1, 'Barura', 'বরুড়া', 'barura.comilla.gov.bd'),
(3, 1, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 'brahmanpara.comilla.gov.bd'),
(4, 1, 'Chandina', 'চান্দিনা', 'chandina.comilla.gov.bd'),
(5, 1, 'Chauddagram', 'চৌদ্দগ্রাম', 'chauddagram.comilla.gov.bd'),
(6, 1, 'Daudkandi', 'দাউদকান্দি', 'daudkandi.comilla.gov.bd'),
(7, 1, 'Homna', 'হোমনা', 'homna.comilla.gov.bd'),
(8, 1, 'Laksam', 'লাকসাম', 'laksam.comilla.gov.bd'),
(9, 1, 'Muradnagar', 'মুরাদনগর', 'muradnagar.comilla.gov.bd'),
(10, 1, 'Nangalkot', 'নাঙ্গলকোট', 'nangalkot.comilla.gov.bd'),
(11, 1, 'Comilla Sadar', 'কুমিল্লা সদর', 'comillasadar.comilla.gov.bd'),
(12, 1, 'Meghna', 'মেঘনা', 'meghna.comilla.gov.bd'),
(13, 1, 'Monohargonj', 'মনোহরগঞ্জ', 'monohargonj.comilla.gov.bd'),
(14, 1, 'Sadarsouth', 'সদর দক্ষিণ', 'sadarsouth.comilla.gov.bd'),
(15, 1, 'Titas', 'তিতাস', 'titas.comilla.gov.bd'),
(16, 1, 'Burichang', 'বুড়িচং', 'burichang.comilla.gov.bd'),
(17, 1, 'Lalmai', 'লালমাই', 'lalmai.comilla.gov.bd'),
(18, 2, 'Chhagalnaiya', 'ছাগলনাইয়া', 'chhagalnaiya.feni.gov.bd'),
(19, 2, 'Feni Sadar', 'ফেনী সদর', 'sadar.feni.gov.bd'),
(20, 2, 'Sonagazi', 'সোনাগাজী', 'sonagazi.feni.gov.bd'),
(21, 2, 'Fulgazi', 'ফুলগাজী', 'fulgazi.feni.gov.bd'),
(22, 2, 'Parshuram', 'পরশুরাম', 'parshuram.feni.gov.bd'),
(23, 2, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyan.feni.gov.bd'),
(24, 3, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 'sadar.brahmanbaria.gov.bd'),
(25, 3, 'Kasba', 'কসবা', 'kasba.brahmanbaria.gov.bd'),
(26, 3, 'Nasirnagar', 'নাসিরনগর', 'nasirnagar.brahmanbaria.gov.bd'),
(27, 3, 'Sarail', 'সরাইল', 'sarail.brahmanbaria.gov.bd'),
(28, 3, 'Ashuganj', 'আশুগঞ্জ', 'ashuganj.brahmanbaria.gov.bd'),
(29, 3, 'Akhaura', 'আখাউড়া', 'akhaura.brahmanbaria.gov.bd'),
(30, 3, 'Nabinagar', 'নবীনগর', 'nabinagar.brahmanbaria.gov.bd'),
(31, 3, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampur.brahmanbaria.gov.bd'),
(32, 3, 'Bijoynagar', 'বিজয়নগর', 'bijoynagar.brahmanbaria.gov.bd    '),
(33, 4, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 'sadar.rangamati.gov.bd'),
(34, 4, 'Kaptai', 'কাপ্তাই', 'kaptai.rangamati.gov.bd'),
(35, 4, 'Kawkhali', 'কাউখালী', 'kawkhali.rangamati.gov.bd'),
(36, 4, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichari.rangamati.gov.bd'),
(37, 4, 'Barkal', 'বরকল', 'barkal.rangamati.gov.bd'),
(38, 4, 'Langadu', 'লংগদু', 'langadu.rangamati.gov.bd'),
(39, 4, 'Rajasthali', 'রাজস্থলী', 'rajasthali.rangamati.gov.bd'),
(40, 4, 'Belaichari', 'বিলাইছড়ি', 'belaichari.rangamati.gov.bd'),
(41, 4, 'Juraichari', 'জুরাছড়ি', 'juraichari.rangamati.gov.bd'),
(42, 4, 'Naniarchar', 'নানিয়ারচর', 'naniarchar.rangamati.gov.bd'),
(43, 5, 'Noakhali Sadar', 'নোয়াখালী সদর', 'sadar.noakhali.gov.bd'),
(44, 5, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.noakhali.gov.bd'),
(45, 5, 'Begumganj', 'বেগমগঞ্জ', 'begumganj.noakhali.gov.bd'),
(46, 5, 'Hatia', 'হাতিয়া', 'hatia.noakhali.gov.bd'),
(47, 5, 'Subarnachar', 'সুবর্ণচর', 'subarnachar.noakhali.gov.bd'),
(48, 5, 'Kabirhat', 'কবিরহাট', 'kabirhat.noakhali.gov.bd'),
(49, 5, 'Senbug', 'সেনবাগ', 'senbug.noakhali.gov.bd'),
(50, 5, 'Chatkhil', 'চাটখিল', 'chatkhil.noakhali.gov.bd'),
(51, 5, 'Sonaimori', 'সোনাইমুড়ী', 'sonaimori.noakhali.gov.bd'),
(52, 6, 'Haimchar', 'হাইমচর', 'haimchar.chandpur.gov.bd'),
(53, 6, 'Kachua', 'কচুয়া', 'kachua.chandpur.gov.bd'),
(54, 6, 'Shahrasti', 'শাহরাস্তি	', 'shahrasti.chandpur.gov.bd'),
(55, 6, 'Chandpur Sadar', 'চাঁদপুর সদর', 'sadar.chandpur.gov.bd'),
(56, 6, 'Matlab South', 'মতলব দক্ষিণ', 'matlabsouth.chandpur.gov.bd'),
(57, 6, 'Hajiganj', 'হাজীগঞ্জ', 'hajiganj.chandpur.gov.bd'),
(58, 6, 'Matlab North', 'মতলব উত্তর', 'matlabnorth.chandpur.gov.bd'),
(59, 6, 'Faridgonj', 'ফরিদগঞ্জ', 'faridgonj.chandpur.gov.bd'),
(60, 7, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 'sadar.lakshmipur.gov.bd'),
(61, 7, 'Kamalnagar', 'কমলনগর', 'kamalnagar.lakshmipur.gov.bd'),
(62, 7, 'Raipur', 'রায়পুর', 'raipur.lakshmipur.gov.bd'),
(63, 7, 'Ramgati', 'রামগতি', 'ramgati.lakshmipur.gov.bd'),
(64, 7, 'Ramganj', 'রামগঞ্জ', 'ramganj.lakshmipur.gov.bd'),
(65, 8, 'Rangunia', 'রাঙ্গুনিয়া', 'rangunia.chittagong.gov.bd'),
(66, 8, 'Sitakunda', 'সীতাকুন্ড', 'sitakunda.chittagong.gov.bd'),
(67, 8, 'Mirsharai', 'মীরসরাই', 'mirsharai.chittagong.gov.bd'),
(68, 8, 'Patiya', 'পটিয়া', 'patiya.chittagong.gov.bd'),
(69, 8, 'Sandwip', 'সন্দ্বীপ', 'sandwip.chittagong.gov.bd'),
(70, 8, 'Banshkhali', 'বাঁশখালী', 'banshkhali.chittagong.gov.bd'),
(71, 8, 'Boalkhali', 'বোয়ালখালী', 'boalkhali.chittagong.gov.bd'),
(72, 8, 'Anwara', 'আনোয়ারা', 'anwara.chittagong.gov.bd'),
(73, 8, 'Chandanaish', 'চন্দনাইশ', 'chandanaish.chittagong.gov.bd'),
(74, 8, 'Satkania', 'সাতকানিয়া', 'satkania.chittagong.gov.bd'),
(75, 8, 'Lohagara', 'লোহাগাড়া', 'lohagara.chittagong.gov.bd'),
(76, 8, 'Hathazari', 'হাটহাজারী', 'hathazari.chittagong.gov.bd'),
(77, 8, 'Fatikchhari', 'ফটিকছড়ি', 'fatikchhari.chittagong.gov.bd'),
(78, 8, 'Raozan', 'রাউজান', 'raozan.chittagong.gov.bd'),
(79, 8, 'Karnafuli', 'কর্ণফুলী', 'karnafuli.chittagong.gov.bd'),
(80, 9, 'Coxsbazar Sadar', 'কক্সবাজার সদর', 'sadar.coxsbazar.gov.bd'),
(81, 9, 'Chakaria', 'চকরিয়া', 'chakaria.coxsbazar.gov.bd'),
(82, 9, 'Kutubdia', 'কুতুবদিয়া', 'kutubdia.coxsbazar.gov.bd'),
(83, 9, 'Ukhiya', 'উখিয়া', 'ukhiya.coxsbazar.gov.bd'),
(84, 9, 'Moheshkhali', 'মহেশখালী', 'moheshkhali.coxsbazar.gov.bd'),
(85, 9, 'Pekua', 'পেকুয়া', 'pekua.coxsbazar.gov.bd'),
(86, 9, 'Ramu', 'রামু', 'ramu.coxsbazar.gov.bd'),
(87, 9, 'Teknaf', 'টেকনাফ', 'teknaf.coxsbazar.gov.bd'),
(88, 10, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর', 'sadar.khagrachhari.gov.bd'),
(89, 10, 'Dighinala', 'দিঘীনালা', 'dighinala.khagrachhari.gov.bd'),
(90, 10, 'Panchari', 'পানছড়ি', 'panchari.khagrachhari.gov.bd'),
(91, 10, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhari.khagrachhari.gov.bd'),
(92, 10, 'Mohalchari', 'মহালছড়ি', 'mohalchari.khagrachhari.gov.bd'),
(93, 10, 'Manikchari', 'মানিকছড়ি', 'manikchari.khagrachhari.gov.bd'),
(94, 10, 'Ramgarh', 'রামগড়', 'ramgarh.khagrachhari.gov.bd'),
(95, 10, 'Matiranga', 'মাটিরাঙ্গা', 'matiranga.khagrachhari.gov.bd'),
(96, 10, 'Guimara', 'গুইমারা', 'guimara.khagrachhari.gov.bd'),
(97, 11, 'Bandarban Sadar', 'বান্দরবান সদর', 'sadar.bandarban.gov.bd'),
(98, 11, 'Alikadam', 'আলীকদম', 'alikadam.bandarban.gov.bd'),
(99, 11, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 'naikhongchhari.bandarban.gov.bd'),
(100, 11, 'Rowangchhari', 'রোয়াংছড়ি', 'rowangchhari.bandarban.gov.bd'),
(101, 11, 'Lama', 'লামা', 'lama.bandarban.gov.bd'),
(102, 11, 'Ruma', 'রুমা', 'ruma.bandarban.gov.bd'),
(103, 11, 'Thanchi', 'থানচি', 'thanchi.bandarban.gov.bd'),
(104, 12, 'Belkuchi', 'বেলকুচি', 'belkuchi.sirajganj.gov.bd'),
(105, 12, 'Chauhali', 'চৌহালি', 'chauhali.sirajganj.gov.bd'),
(106, 12, 'Kamarkhand', 'কামারখন্দ', 'kamarkhand.sirajganj.gov.bd'),
(107, 12, 'Kazipur', 'কাজীপুর', 'kazipur.sirajganj.gov.bd'),
(108, 12, 'Raigonj', 'রায়গঞ্জ', 'raigonj.sirajganj.gov.bd'),
(109, 12, 'Shahjadpur', 'শাহজাদপুর', 'shahjadpur.sirajganj.gov.bd'),
(110, 12, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 'sirajganjsadar.sirajganj.gov.bd'),
(111, 12, 'Tarash', 'তাড়াশ', 'tarash.sirajganj.gov.bd'),
(112, 12, 'Ullapara', 'উল্লাপাড়া', 'ullapara.sirajganj.gov.bd'),
(113, 13, 'Sujanagar', 'সুজানগর', 'sujanagar.pabna.gov.bd'),
(114, 13, 'Ishurdi', 'ঈশ্বরদী', 'ishurdi.pabna.gov.bd'),
(115, 13, 'Bhangura', 'ভাঙ্গুড়া', 'bhangura.pabna.gov.bd'),
(116, 13, 'Pabna Sadar', 'পাবনা সদর', 'pabnasadar.pabna.gov.bd'),
(117, 13, 'Bera', 'বেড়া', 'bera.pabna.gov.bd'),
(118, 13, 'Atghoria', 'আটঘরিয়া', 'atghoria.pabna.gov.bd'),
(119, 13, 'Chatmohar', 'চাটমোহর', 'chatmohar.pabna.gov.bd'),
(120, 13, 'Santhia', 'সাঁথিয়া', 'santhia.pabna.gov.bd'),
(121, 13, 'Faridpur', 'ফরিদপুর', 'faridpur.pabna.gov.bd'),
(122, 14, 'Kahaloo', 'কাহালু', 'kahaloo.bogra.gov.bd'),
(123, 14, 'Bogra Sadar', 'বগুড়া সদর', 'sadar.bogra.gov.bd'),
(124, 14, 'Shariakandi', 'সারিয়াকান্দি', 'shariakandi.bogra.gov.bd'),
(125, 14, 'Shajahanpur', 'শাজাহানপুর', 'shajahanpur.bogra.gov.bd'),
(126, 14, 'Dupchanchia', 'দুপচাচিঁয়া', 'dupchanchia.bogra.gov.bd'),
(127, 14, 'Adamdighi', 'আদমদিঘি', 'adamdighi.bogra.gov.bd'),
(128, 14, 'Nondigram', 'নন্দিগ্রাম', 'nondigram.bogra.gov.bd'),
(129, 14, 'Sonatala', 'সোনাতলা', 'sonatala.bogra.gov.bd'),
(130, 14, 'Dhunot', 'ধুনট', 'dhunot.bogra.gov.bd'),
(131, 14, 'Gabtali', 'গাবতলী', 'gabtali.bogra.gov.bd'),
(132, 14, 'Sherpur', 'শেরপুর', 'sherpur.bogra.gov.bd'),
(133, 14, 'Shibganj', 'শিবগঞ্জ', 'shibganj.bogra.gov.bd'),
(134, 15, 'Paba', 'পবা', 'paba.rajshahi.gov.bd'),
(135, 15, 'Durgapur', 'দুর্গাপুর', 'durgapur.rajshahi.gov.bd'),
(136, 15, 'Mohonpur', 'মোহনপুর', 'mohonpur.rajshahi.gov.bd'),
(137, 15, 'Charghat', 'চারঘাট', 'charghat.rajshahi.gov.bd'),
(138, 15, 'Puthia', 'পুঠিয়া', 'puthia.rajshahi.gov.bd'),
(139, 15, 'Bagha', 'বাঘা', 'bagha.rajshahi.gov.bd'),
(140, 15, 'Godagari', 'গোদাগাড়ী', 'godagari.rajshahi.gov.bd'),
(141, 15, 'Tanore', 'তানোর', 'tanore.rajshahi.gov.bd'),
(142, 15, 'Bagmara', 'বাগমারা', 'bagmara.rajshahi.gov.bd'),
(143, 16, 'Natore Sadar', 'নাটোর সদর', 'natoresadar.natore.gov.bd'),
(144, 16, 'Singra', 'সিংড়া', 'singra.natore.gov.bd'),
(145, 16, 'Baraigram', 'বড়াইগ্রাম', 'baraigram.natore.gov.bd'),
(146, 16, 'Bagatipara', 'বাগাতিপাড়া', 'bagatipara.natore.gov.bd'),
(147, 16, 'Lalpur', 'লালপুর', 'lalpur.natore.gov.bd'),
(148, 16, 'Gurudaspur', 'গুরুদাসপুর', 'gurudaspur.natore.gov.bd'),
(149, 16, 'Naldanga', 'নলডাঙ্গা', 'naldanga.natore.gov.bd'),
(150, 17, 'Akkelpur', 'আক্কেলপুর', 'akkelpur.joypurhat.gov.bd'),
(151, 17, 'Kalai', 'কালাই', 'kalai.joypurhat.gov.bd'),
(152, 17, 'Khetlal', 'ক্ষেতলাল', 'khetlal.joypurhat.gov.bd'),
(153, 17, 'Panchbibi', 'পাঁচবিবি', 'panchbibi.joypurhat.gov.bd'),
(154, 17, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 'joypurhatsadar.joypurhat.gov.bd'),
(155, 18, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর', 'chapainawabganjsadar.chapainawabganj.gov.bd'),
(156, 18, 'Gomostapur', 'গোমস্তাপুর', 'gomostapur.chapainawabganj.gov.bd'),
(157, 18, 'Nachol', 'নাচোল', 'nachol.chapainawabganj.gov.bd'),
(158, 18, 'Bholahat', 'ভোলাহাট', 'bholahat.chapainawabganj.gov.bd'),
(159, 18, 'Shibganj', 'শিবগঞ্জ', 'shibganj.chapainawabganj.gov.bd'),
(160, 19, 'Mohadevpur', 'মহাদেবপুর', 'mohadevpur.naogaon.gov.bd'),
(161, 19, 'Badalgachi', 'বদলগাছী', 'badalgachi.naogaon.gov.bd'),
(162, 19, 'Patnitala', 'পত্নিতলা', 'patnitala.naogaon.gov.bd'),
(163, 19, 'Dhamoirhat', 'ধামইরহাট', 'dhamoirhat.naogaon.gov.bd'),
(164, 19, 'Niamatpur', 'নিয়ামতপুর', 'niamatpur.naogaon.gov.bd'),
(165, 19, 'Manda', 'মান্দা', 'manda.naogaon.gov.bd'),
(166, 19, 'Atrai', 'আত্রাই', 'atrai.naogaon.gov.bd'),
(167, 19, 'Raninagar', 'রাণীনগর', 'raninagar.naogaon.gov.bd'),
(168, 19, 'Naogaon Sadar', 'নওগাঁ সদর', 'naogaonsadar.naogaon.gov.bd'),
(169, 19, 'Porsha', 'পোরশা', 'porsha.naogaon.gov.bd'),
(170, 19, 'Sapahar', 'সাপাহার', 'sapahar.naogaon.gov.bd'),
(171, 20, 'Manirampur', 'মণিরামপুর', 'manirampur.jessore.gov.bd'),
(172, 20, 'Abhaynagar', 'অভয়নগর', 'abhaynagar.jessore.gov.bd'),
(173, 20, 'Bagherpara', 'বাঘারপাড়া', 'bagherpara.jessore.gov.bd'),
(174, 20, 'Chougachha', 'চৌগাছা', 'chougachha.jessore.gov.bd'),
(175, 20, 'Jhikargacha', 'ঝিকরগাছা', 'jhikargacha.jessore.gov.bd'),
(176, 20, 'Keshabpur', 'কেশবপুর', 'keshabpur.jessore.gov.bd'),
(177, 20, 'Jessore Sadar', 'যশোর সদর', 'sadar.jessore.gov.bd'),
(178, 20, 'Sharsha', 'শার্শা', 'sharsha.jessore.gov.bd'),
(179, 21, 'Assasuni', 'আশাশুনি', 'assasuni.satkhira.gov.bd'),
(180, 21, 'Debhata', 'দেবহাটা', 'debhata.satkhira.gov.bd'),
(181, 21, 'Kalaroa', 'কলারোয়া', 'kalaroa.satkhira.gov.bd'),
(182, 21, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 'satkhirasadar.satkhira.gov.bd'),
(183, 21, 'Shyamnagar', 'শ্যামনগর', 'shyamnagar.satkhira.gov.bd'),
(184, 21, 'Tala', 'তালা', 'tala.satkhira.gov.bd'),
(185, 21, 'Kaliganj', 'কালিগঞ্জ', 'kaliganj.satkhira.gov.bd'),
(186, 22, 'Mujibnagar', 'মুজিবনগর', 'mujibnagar.meherpur.gov.bd'),
(187, 22, 'Meherpur Sadar', 'মেহেরপুর সদর', 'meherpursadar.meherpur.gov.bd'),
(188, 22, 'Gangni', 'গাংনী', 'gangni.meherpur.gov.bd'),
(189, 23, 'Narail Sadar', 'নড়াইল সদর', 'narailsadar.narail.gov.bd'),
(190, 23, 'Lohagara', 'লোহাগড়া', 'lohagara.narail.gov.bd'),
(191, 23, 'Kalia', 'কালিয়া', 'kalia.narail.gov.bd'),
(192, 24, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর', 'chuadangasadar.chuadanga.gov.bd'),
(193, 24, 'Alamdanga', 'আলমডাঙ্গা', 'alamdanga.chuadanga.gov.bd'),
(194, 24, 'Damurhuda', 'দামুড়হুদা', 'damurhuda.chuadanga.gov.bd'),
(195, 24, 'Jibannagar', 'জীবননগর', 'jibannagar.chuadanga.gov.bd'),
(196, 25, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 'kushtiasadar.kushtia.gov.bd'),
(197, 25, 'Kumarkhali', 'কুমারখালী', 'kumarkhali.kushtia.gov.bd'),
(198, 25, 'Khoksa', 'খোকসা', 'khoksa.kushtia.gov.bd'),
(199, 25, 'Mirpur', 'মিরপুর', 'mirpurkushtia.kushtia.gov.bd'),
(200, 25, 'Daulatpur', 'দৌলতপুর', 'daulatpur.kushtia.gov.bd'),
(201, 25, 'Bheramara', 'ভেড়ামারা', 'bheramara.kushtia.gov.bd'),
(202, 26, 'Shalikha', 'শালিখা', 'shalikha.magura.gov.bd'),
(203, 26, 'Sreepur', 'শ্রীপুর', 'sreepur.magura.gov.bd'),
(204, 26, 'Magura Sadar', 'মাগুরা সদর', 'magurasadar.magura.gov.bd'),
(205, 26, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpur.magura.gov.bd'),
(206, 27, 'Paikgasa', 'পাইকগাছা', 'paikgasa.khulna.gov.bd'),
(207, 27, 'Fultola', 'ফুলতলা', 'fultola.khulna.gov.bd'),
(208, 27, 'Digholia', 'দিঘলিয়া', 'digholia.khulna.gov.bd'),
(209, 27, 'Rupsha', 'রূপসা', 'rupsha.khulna.gov.bd'),
(210, 27, 'Terokhada', 'তেরখাদা', 'terokhada.khulna.gov.bd'),
(211, 27, 'Dumuria', 'ডুমুরিয়া', 'dumuria.khulna.gov.bd'),
(212, 27, 'Botiaghata', 'বটিয়াঘাটা', 'botiaghata.khulna.gov.bd'),
(213, 27, 'Dakop', 'দাকোপ', 'dakop.khulna.gov.bd'),
(214, 27, 'Koyra', 'কয়রা', 'koyra.khulna.gov.bd'),
(215, 28, 'Fakirhat', 'ফকিরহাট', 'fakirhat.bagerhat.gov.bd'),
(216, 28, 'Bagerhat Sadar', 'বাগেরহাট সদর', 'sadar.bagerhat.gov.bd'),
(217, 28, 'Mollahat', 'মোল্লাহাট', 'mollahat.bagerhat.gov.bd'),
(218, 28, 'Sarankhola', 'শরণখোলা', 'sarankhola.bagerhat.gov.bd'),
(219, 28, 'Rampal', 'রামপাল', 'rampal.bagerhat.gov.bd'),
(220, 28, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganj.bagerhat.gov.bd'),
(221, 28, 'Kachua', 'কচুয়া', 'kachua.bagerhat.gov.bd'),
(222, 28, 'Mongla', 'মোংলা', 'mongla.bagerhat.gov.bd'),
(223, 28, 'Chitalmari', 'চিতলমারী', 'chitalmari.bagerhat.gov.bd'),
(224, 29, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 'sadar.jhenaidah.gov.bd'),
(225, 29, 'Shailkupa', 'শৈলকুপা', 'shailkupa.jhenaidah.gov.bd'),
(226, 29, 'Harinakundu', 'হরিণাকুন্ডু', 'harinakundu.jhenaidah.gov.bd'),
(227, 29, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.jhenaidah.gov.bd'),
(228, 29, 'Kotchandpur', 'কোটচাঁদপুর', 'kotchandpur.jhenaidah.gov.bd'),
(229, 29, 'Moheshpur', 'মহেশপুর', 'moheshpur.jhenaidah.gov.bd'),
(230, 30, 'Jhalakathi Sadar', 'ঝালকাঠি সদর', 'sadar.jhalakathi.gov.bd'),
(231, 30, 'Kathalia', 'কাঠালিয়া', 'kathalia.jhalakathi.gov.bd'),
(232, 30, 'Nalchity', 'নলছিটি', 'nalchity.jhalakathi.gov.bd'),
(233, 30, 'Rajapur', 'রাজাপুর', 'rajapur.jhalakathi.gov.bd'),
(234, 31, 'Bauphal', 'বাউফল', 'bauphal.patuakhali.gov.bd'),
(235, 31, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 'sadar.patuakhali.gov.bd'),
(236, 31, 'Dumki', 'দুমকি', 'dumki.patuakhali.gov.bd'),
(237, 31, 'Dashmina', 'দশমিনা', 'dashmina.patuakhali.gov.bd'),
(238, 31, 'Kalapara', 'কলাপাড়া', 'kalapara.patuakhali.gov.bd'),
(239, 31, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganj.patuakhali.gov.bd'),
(240, 31, 'Galachipa', 'গলাচিপা', 'galachipa.patuakhali.gov.bd'),
(241, 31, 'Rangabali', 'রাঙ্গাবালী', 'rangabali.patuakhali.gov.bd'),
(242, 32, 'Pirojpur Sadar', 'পিরোজপুর সদর', 'sadar.pirojpur.gov.bd'),
(243, 32, 'Nazirpur', 'নাজিরপুর', 'nazirpur.pirojpur.gov.bd'),
(244, 32, 'Kawkhali', 'কাউখালী', 'kawkhali.pirojpur.gov.bd'),
(245, 32, 'Zianagar', 'জিয়ানগর', 'zianagar.pirojpur.gov.bd'),
(246, 32, 'Bhandaria', 'ভান্ডারিয়া', 'bhandaria.pirojpur.gov.bd'),
(247, 32, 'Mathbaria', 'মঠবাড়ীয়া', 'mathbaria.pirojpur.gov.bd'),
(248, 32, 'Nesarabad', 'নেছারাবাদ', 'nesarabad.pirojpur.gov.bd'),
(249, 33, 'Barisal Sadar', 'বরিশাল সদর', 'barisalsadar.barisal.gov.bd'),
(250, 33, 'Bakerganj', 'বাকেরগঞ্জ', 'bakerganj.barisal.gov.bd'),
(251, 33, 'Babuganj', 'বাবুগঞ্জ', 'babuganj.barisal.gov.bd'),
(252, 33, 'Wazirpur', 'উজিরপুর', 'wazirpur.barisal.gov.bd'),
(253, 33, 'Banaripara', 'বানারীপাড়া', 'banaripara.barisal.gov.bd'),
(254, 33, 'Gournadi', 'গৌরনদী', 'gournadi.barisal.gov.bd'),
(255, 33, 'Agailjhara', 'আগৈলঝাড়া', 'agailjhara.barisal.gov.bd'),
(256, 33, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 'mehendiganj.barisal.gov.bd'),
(257, 33, 'Muladi', 'মুলাদী', 'muladi.barisal.gov.bd'),
(258, 33, 'Hizla', 'হিজলা', 'hizla.barisal.gov.bd'),
(259, 34, 'Bhola Sadar', 'ভোলা সদর', 'sadar.bhola.gov.bd'),
(260, 34, 'Borhan Sddin', 'বোরহান উদ্দিন', 'borhanuddin.bhola.gov.bd'),
(261, 34, 'Charfesson', 'চরফ্যাশন', 'charfesson.bhola.gov.bd'),
(262, 34, 'Doulatkhan', 'দৌলতখান', 'doulatkhan.bhola.gov.bd'),
(263, 34, 'Monpura', 'মনপুরা', 'monpura.bhola.gov.bd'),
(264, 34, 'Tazumuddin', 'তজুমদ্দিন', 'tazumuddin.bhola.gov.bd'),
(265, 34, 'Lalmohan', 'লালমোহন', 'lalmohan.bhola.gov.bd'),
(266, 35, 'Amtali', 'আমতলী', 'amtali.barguna.gov.bd'),
(267, 35, 'Barguna Sadar', 'বরগুনা সদর', 'sadar.barguna.gov.bd'),
(268, 35, 'Betagi', 'বেতাগী', 'betagi.barguna.gov.bd'),
(269, 35, 'Bamna', 'বামনা', 'bamna.barguna.gov.bd'),
(270, 35, 'Pathorghata', 'পাথরঘাটা', 'pathorghata.barguna.gov.bd'),
(271, 35, 'Taltali', 'তালতলি', 'taltali.barguna.gov.bd'),
(272, 36, 'Balaganj', 'বালাগঞ্জ', 'balaganj.sylhet.gov.bd'),
(273, 36, 'Beanibazar', 'বিয়ানীবাজার', 'beanibazar.sylhet.gov.bd'),
(274, 36, 'Bishwanath', 'বিশ্বনাথ', 'bishwanath.sylhet.gov.bd'),
(275, 36, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.sylhet.gov.bd'),
(276, 36, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 'fenchuganj.sylhet.gov.bd'),
(277, 36, 'Golapganj', 'গোলাপগঞ্জ', 'golapganj.sylhet.gov.bd'),
(278, 36, 'Gowainghat', 'গোয়াইনঘাট', 'gowainghat.sylhet.gov.bd'),
(279, 36, 'Jaintiapur', 'জৈন্তাপুর', 'jaintiapur.sylhet.gov.bd'),
(280, 36, 'Kanaighat', 'কানাইঘাট', 'kanaighat.sylhet.gov.bd'),
(281, 36, 'Sylhet Sadar', 'সিলেট সদর', 'sylhetsadar.sylhet.gov.bd'),
(282, 36, 'Zakiganj', 'জকিগঞ্জ', 'zakiganj.sylhet.gov.bd'),
(283, 36, 'Dakshinsurma', 'দক্ষিণ সুরমা', 'dakshinsurma.sylhet.gov.bd'),
(284, 36, 'Osmaninagar', 'ওসমানী নগর', 'osmaninagar.sylhet.gov.bd'),
(285, 37, 'Barlekha', 'বড়লেখা', 'barlekha.moulvibazar.gov.bd'),
(286, 37, 'Kamolganj', 'কমলগঞ্জ', 'kamolganj.moulvibazar.gov.bd'),
(287, 37, 'Kulaura', 'কুলাউড়া', 'kulaura.moulvibazar.gov.bd'),
(288, 37, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর', 'moulvibazarsadar.moulvibazar.gov.bd'),
(289, 37, 'Rajnagar', 'রাজনগর', 'rajnagar.moulvibazar.gov.bd'),
(290, 37, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangal.moulvibazar.gov.bd'),
(291, 37, 'Juri', 'জুড়ী', 'juri.moulvibazar.gov.bd'),
(292, 38, 'Nabiganj', 'নবীগঞ্জ', 'nabiganj.habiganj.gov.bd'),
(293, 38, 'Bahubal', 'বাহুবল', 'bahubal.habiganj.gov.bd'),
(294, 38, 'Ajmiriganj', 'আজমিরীগঞ্জ', 'ajmiriganj.habiganj.gov.bd'),
(295, 38, 'Baniachong', 'বানিয়াচং', 'baniachong.habiganj.gov.bd'),
(296, 38, 'Lakhai', 'লাখাই', 'lakhai.habiganj.gov.bd'),
(297, 38, 'Chunarughat', 'চুনারুঘাট', 'chunarughat.habiganj.gov.bd'),
(298, 38, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 'habiganjsadar.habiganj.gov.bd'),
(299, 38, 'Madhabpur', 'মাধবপুর', 'madhabpur.habiganj.gov.bd'),
(300, 39, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 'sadar.sunamganj.gov.bd'),
(301, 39, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ', 'southsunamganj.sunamganj.gov.bd'),
(302, 39, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 'bishwambarpur.sunamganj.gov.bd'),
(303, 39, 'Chhatak', 'ছাতক', 'chhatak.sunamganj.gov.bd'),
(304, 39, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpur.sunamganj.gov.bd'),
(305, 39, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazar.sunamganj.gov.bd'),
(306, 39, 'Tahirpur', 'তাহিরপুর', 'tahirpur.sunamganj.gov.bd'),
(307, 39, 'Dharmapasha', 'ধর্মপাশা', 'dharmapasha.sunamganj.gov.bd'),
(308, 39, 'Jamalganj', 'জামালগঞ্জ', 'jamalganj.sunamganj.gov.bd'),
(309, 39, 'Shalla', 'শাল্লা', 'shalla.sunamganj.gov.bd'),
(310, 39, 'Derai', 'দিরাই', 'derai.sunamganj.gov.bd'),
(311, 53, 'Belabo', 'বেলাবো', 'belabo.narsingdi.gov.bd'),
(312, 53, 'Monohardi', 'মনোহরদী', 'monohardi.narsingdi.gov.bd'),
(313, 53, 'Narsingdi Sadar', 'নরসিংদী সদর', 'narsingdisadar.narsingdi.gov.bd'),
(314, 53, 'Palash', 'পলাশ', 'palash.narsingdi.gov.bd'),
(315, 53, 'Raipura', 'রায়পুরা', 'raipura.narsingdi.gov.bd'),
(316, 53, 'Shibpur', 'শিবপুর', 'shibpur.narsingdi.gov.bd'),
(317, 54, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.gazipur.gov.bd'),
(318, 54, 'Kaliakair', 'কালিয়াকৈর', 'kaliakair.gazipur.gov.bd'),
(319, 54, 'Kapasia', 'কাপাসিয়া', 'kapasia.gazipur.gov.bd'),
(320, 54, 'Gazipur Sadar', 'গাজীপুর সদর', 'sadar.gazipur.gov.bd'),
(321, 54, 'Sreepur', 'শ্রীপুর', 'sreepur.gazipur.gov.bd'),
(322, 55, 'Shariatpur Sadar', 'শরিয়তপুর সদর', 'sadar.shariatpur.gov.bd'),
(323, 55, 'Naria', 'নড়িয়া', 'naria.shariatpur.gov.bd'),
(324, 55, 'Zajira', 'জাজিরা', 'zajira.shariatpur.gov.bd'),
(325, 55, 'Gosairhat', 'গোসাইরহাট', 'gosairhat.shariatpur.gov.bd'),
(326, 55, 'Bhedarganj', 'ভেদরগঞ্জ', 'bhedarganj.shariatpur.gov.bd'),
(327, 55, 'Damudya', 'ডামুড্যা', 'damudya.shariatpur.gov.bd'),
(328, 56, 'Araihazar', 'আড়াইহাজার', 'araihazar.narayanganj.gov.bd'),
(329, 56, 'Bandar', 'বন্দর', 'bandar.narayanganj.gov.bd'),
(330, 56, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 'narayanganjsadar.narayanganj.gov.bd'),
(331, 56, 'Rupganj', 'রূপগঞ্জ', 'rupganj.narayanganj.gov.bd'),
(332, 56, 'Sonargaon', 'সোনারগাঁ', 'sonargaon.narayanganj.gov.bd'),
(333, 57, 'Basail', 'বাসাইল', 'basail.tangail.gov.bd'),
(334, 57, 'Bhuapur', 'ভুয়াপুর', 'bhuapur.tangail.gov.bd'),
(335, 57, 'Delduar', 'দেলদুয়ার', 'delduar.tangail.gov.bd'),
(336, 57, 'Ghatail', 'ঘাটাইল', 'ghatail.tangail.gov.bd'),
(337, 57, 'Gopalpur', 'গোপালপুর', 'gopalpur.tangail.gov.bd'),
(338, 57, 'Madhupur', 'মধুপুর', 'madhupur.tangail.gov.bd'),
(339, 57, 'Mirzapur', 'মির্জাপুর', 'mirzapur.tangail.gov.bd'),
(340, 57, 'Nagarpur', 'নাগরপুর', 'nagarpur.tangail.gov.bd'),
(341, 57, 'Sakhipur', 'সখিপুর', 'sakhipur.tangail.gov.bd'),
(342, 57, 'Tangail Sadar', 'টাঙ্গাইল সদর', 'tangailsadar.tangail.gov.bd'),
(343, 57, 'Kalihati', 'কালিহাতী', 'kalihati.tangail.gov.bd'),
(344, 57, 'Dhanbari', 'ধনবাড়ী', 'dhanbari.tangail.gov.bd'),
(345, 58, 'Itna', 'ইটনা', 'itna.kishoreganj.gov.bd'),
(346, 58, 'Katiadi', 'কটিয়াদী', 'katiadi.kishoreganj.gov.bd'),
(347, 58, 'Bhairab', 'ভৈরব', 'bhairab.kishoreganj.gov.bd'),
(348, 58, 'Tarail', 'তাড়াইল', 'tarail.kishoreganj.gov.bd'),
(349, 58, 'Hossainpur', 'হোসেনপুর', 'hossainpur.kishoreganj.gov.bd'),
(350, 58, 'Pakundia', 'পাকুন্দিয়া', 'pakundia.kishoreganj.gov.bd'),
(351, 58, 'Kuliarchar', 'কুলিয়ারচর', 'kuliarchar.kishoreganj.gov.bd'),
(352, 58, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 'kishoreganjsadar.kishoreganj.gov.bd'),
(353, 58, 'Karimgonj', 'করিমগঞ্জ', 'karimgonj.kishoreganj.gov.bd'),
(354, 58, 'Bajitpur', 'বাজিতপুর', 'bajitpur.kishoreganj.gov.bd'),
(355, 58, 'Austagram', 'অষ্টগ্রাম', 'austagram.kishoreganj.gov.bd'),
(356, 58, 'Mithamoin', 'মিঠামইন', 'mithamoin.kishoreganj.gov.bd'),
(357, 58, 'Nikli', 'নিকলী', 'nikli.kishoreganj.gov.bd'),
(358, 59, 'Harirampur', 'হরিরামপুর', 'harirampur.manikganj.gov.bd'),
(359, 59, 'Saturia', 'সাটুরিয়া', 'saturia.manikganj.gov.bd'),
(360, 59, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 'sadar.manikganj.gov.bd'),
(361, 59, 'Gior', 'ঘিওর', 'gior.manikganj.gov.bd'),
(362, 59, 'Shibaloy', 'শিবালয়', 'shibaloy.manikganj.gov.bd'),
(363, 59, 'Doulatpur', 'দৌলতপুর', 'doulatpur.manikganj.gov.bd'),
(364, 59, 'Singiar', 'সিংগাইর', 'singiar.manikganj.gov.bd'),
(365, 52, 'Savar', 'সাভার', 'savar.dhaka.gov.bd'),
(366, 52, 'Dhamrai', 'ধামরাই', 'dhamrai.dhaka.gov.bd'),
(367, 52, 'Keraniganj', 'কেরাণীগঞ্জ', 'keraniganj.dhaka.gov.bd'),
(368, 52, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dhaka.gov.bd'),
(369, 52, 'Dohar', 'দোহার', 'dohar.dhaka.gov.bd'),
(370, 60, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 'sadar.munshiganj.gov.bd'),
(371, 60, 'Sreenagar', 'শ্রীনগর', 'sreenagar.munshiganj.gov.bd'),
(372, 60, 'Sirajdikhan', 'সিরাজদিখান', 'sirajdikhan.munshiganj.gov.bd'),
(373, 60, 'Louhajanj', 'লৌহজং', 'louhajanj.munshiganj.gov.bd'),
(374, 60, 'Gajaria', 'গজারিয়া', 'gajaria.munshiganj.gov.bd'),
(375, 60, 'Tongibari', 'টংগীবাড়ি', 'tongibari.munshiganj.gov.bd'),
(376, 61, 'Rajbari Sadar', 'রাজবাড়ী সদর', 'sadar.rajbari.gov.bd'),
(377, 61, 'Goalanda', 'গোয়ালন্দ', 'goalanda.rajbari.gov.bd'),
(378, 61, 'Pangsa', 'পাংশা', 'pangsa.rajbari.gov.bd'),
(379, 61, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandi.rajbari.gov.bd'),
(380, 61, 'Kalukhali', 'কালুখালী', 'kalukhali.rajbari.gov.bd'),
(381, 62, 'Madaripur Sadar', 'মাদারীপুর সদর', 'sadar.madaripur.gov.bd'),
(382, 62, 'Shibchar', 'শিবচর', 'shibchar.madaripur.gov.bd'),
(383, 62, 'Kalkini', 'কালকিনি', 'kalkini.madaripur.gov.bd'),
(384, 62, 'Rajoir', 'রাজৈর', 'rajoir.madaripur.gov.bd'),
(385, 64, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 'sadar.gopalganj.gov.bd'),
(386, 64, 'Kashiani', 'কাশিয়ানী', 'kashiani.gopalganj.gov.bd'),
(387, 64, 'Tungipara', 'টুংগীপাড়া', 'tungipara.gopalganj.gov.bd'),
(388, 64, 'Kotalipara', 'কোটালীপাড়া', 'kotalipara.gopalganj.gov.bd'),
(389, 64, 'Muksudpur', 'মুকসুদপুর', 'muksudpur.gopalganj.gov.bd'),
(390, 63, 'Faridpur Sadar', 'ফরিদপুর সদর', 'sadar.faridpur.gov.bd'),
(391, 63, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadanga.faridpur.gov.bd'),
(392, 63, 'Boalmari', 'বোয়ালমারী', 'boalmari.faridpur.gov.bd'),
(393, 63, 'Sadarpur', 'সদরপুর', 'sadarpur.faridpur.gov.bd'),
(394, 63, 'Nagarkanda', 'নগরকান্দা', 'nagarkanda.faridpur.gov.bd'),
(395, 63, 'Bhanga', 'ভাঙ্গা', 'bhanga.faridpur.gov.bd'),
(396, 63, 'Charbhadrasan', 'চরভদ্রাসন', 'charbhadrasan.faridpur.gov.bd'),
(397, 63, 'Madhukhali', 'মধুখালী', 'madhukhali.faridpur.gov.bd'),
(398, 63, 'Saltha', 'সালথা', 'saltha.faridpur.gov.bd'),
(399, 40, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadar.panchagarh.gov.bd'),
(400, 40, 'Debiganj', 'দেবীগঞ্জ', 'debiganj.panchagarh.gov.bd'),
(401, 40, 'Boda', 'বোদা', 'boda.panchagarh.gov.bd'),
(402, 40, 'Atwari', 'আটোয়ারী', 'atwari.panchagarh.gov.bd'),
(403, 40, 'Tetulia', 'তেতুলিয়া', 'tetulia.panchagarh.gov.bd'),
(404, 41, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dinajpur.gov.bd'),
(405, 41, 'Birganj', 'বীরগঞ্জ', 'birganj.dinajpur.gov.bd'),
(406, 41, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghat.dinajpur.gov.bd'),
(407, 41, 'Birampur', 'বিরামপুর', 'birampur.dinajpur.gov.bd'),
(408, 41, 'Parbatipur', 'পার্বতীপুর', 'parbatipur.dinajpur.gov.bd'),
(409, 41, 'Bochaganj', 'বোচাগঞ্জ', 'bochaganj.dinajpur.gov.bd'),
(410, 41, 'Kaharol', 'কাহারোল', 'kaharol.dinajpur.gov.bd'),
(411, 41, 'Fulbari', 'ফুলবাড়ী', 'fulbari.dinajpur.gov.bd'),
(412, 41, 'Dinajpur Sadar', 'দিনাজপুর সদর', 'dinajpursadar.dinajpur.gov.bd'),
(413, 41, 'Hakimpur', 'হাকিমপুর', 'hakimpur.dinajpur.gov.bd'),
(414, 41, 'Khansama', 'খানসামা', 'khansama.dinajpur.gov.bd'),
(415, 41, 'Birol', 'বিরল', 'birol.dinajpur.gov.bd'),
(416, 41, 'Chirirbandar', 'চিরিরবন্দর', 'chirirbandar.dinajpur.gov.bd'),
(417, 42, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 'sadar.lalmonirhat.gov.bd'),
(418, 42, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.lalmonirhat.gov.bd'),
(419, 42, 'Hatibandha', 'হাতীবান্ধা', 'hatibandha.lalmonirhat.gov.bd'),
(420, 42, 'Patgram', 'পাটগ্রাম', 'patgram.lalmonirhat.gov.bd'),
(421, 42, 'Aditmari', 'আদিতমারী', 'aditmari.lalmonirhat.gov.bd'),
(422, 43, 'Syedpur', 'সৈয়দপুর', 'syedpur.nilphamari.gov.bd'),
(423, 43, 'Domar', 'ডোমার', 'domar.nilphamari.gov.bd'),
(424, 43, 'Dimla', 'ডিমলা', 'dimla.nilphamari.gov.bd'),
(425, 43, 'Jaldhaka', 'জলঢাকা', 'jaldhaka.nilphamari.gov.bd'),
(426, 43, 'Kishorganj', 'কিশোরগঞ্জ', 'kishorganj.nilphamari.gov.bd'),
(427, 43, 'Nilphamari Sadar', 'নীলফামারী সদর', 'nilphamarisadar.nilphamari.gov.bd'),
(428, 44, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapur.gaibandha.gov.bd'),
(429, 44, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 'gaibandhasadar.gaibandha.gov.bd'),
(430, 44, 'Palashbari', 'পলাশবাড়ী', 'palashbari.gaibandha.gov.bd'),
(431, 44, 'Saghata', 'সাঘাটা', 'saghata.gaibandha.gov.bd'),
(432, 44, 'Gobindaganj', 'গোবিন্দগঞ্জ', 'gobindaganj.gaibandha.gov.bd'),
(433, 44, 'Sundarganj', 'সুন্দরগঞ্জ', 'sundarganj.gaibandha.gov.bd'),
(434, 44, 'Phulchari', 'ফুলছড়ি', 'phulchari.gaibandha.gov.bd'),
(435, 45, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 'thakurgaonsadar.thakurgaon.gov.bd'),
(436, 45, 'Pirganj', 'পীরগঞ্জ', 'pirganj.thakurgaon.gov.bd'),
(437, 45, 'Ranisankail', 'রাণীশংকৈল', 'ranisankail.thakurgaon.gov.bd'),
(438, 45, 'Haripur', 'হরিপুর', 'haripur.thakurgaon.gov.bd'),
(439, 45, 'Baliadangi', 'বালিয়াডাঙ্গী', 'baliadangi.thakurgaon.gov.bd'),
(440, 46, 'Rangpur Sadar', 'রংপুর সদর', 'rangpursadar.rangpur.gov.bd'),
(441, 46, 'Gangachara', 'গংগাচড়া', 'gangachara.rangpur.gov.bd'),
(442, 46, 'Taragonj', 'তারাগঞ্জ', 'taragonj.rangpur.gov.bd'),
(443, 46, 'Badargonj', 'বদরগঞ্জ', 'badargonj.rangpur.gov.bd'),
(444, 46, 'Mithapukur', 'মিঠাপুকুর', 'mithapukur.rangpur.gov.bd'),
(445, 46, 'Pirgonj', 'পীরগঞ্জ', 'pirgonj.rangpur.gov.bd'),
(446, 46, 'Kaunia', 'কাউনিয়া', 'kaunia.rangpur.gov.bd'),
(447, 46, 'Pirgacha', 'পীরগাছা', 'pirgacha.rangpur.gov.bd'),
(448, 47, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 'kurigramsadar.kurigram.gov.bd'),
(449, 47, 'Nageshwari', 'নাগেশ্বরী', 'nageshwari.kurigram.gov.bd'),
(450, 47, 'Bhurungamari', 'ভুরুঙ্গামারী', 'bhurungamari.kurigram.gov.bd'),
(451, 47, 'Phulbari', 'ফুলবাড়ী', 'phulbari.kurigram.gov.bd'),
(452, 47, 'Rajarhat', 'রাজারহাট', 'rajarhat.kurigram.gov.bd'),
(453, 47, 'Ulipur', 'উলিপুর', 'ulipur.kurigram.gov.bd'),
(454, 47, 'Chilmari', 'চিলমারী', 'chilmari.kurigram.gov.bd'),
(455, 47, 'Rowmari', 'রৌমারী', 'rowmari.kurigram.gov.bd'),
(456, 47, 'Charrajibpur', 'চর রাজিবপুর', 'charrajibpur.kurigram.gov.bd'),
(457, 49, 'Sherpur Sadar', 'শেরপুর সদর', 'sherpursadar.sherpur.gov.bd'),
(458, 49, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabari.sherpur.gov.bd'),
(459, 49, 'Sreebordi', 'শ্রীবরদী', 'sreebordi.sherpur.gov.bd'),
(460, 49, 'Nokla', 'নকলা', 'nokla.sherpur.gov.bd'),
(461, 49, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigati.sherpur.gov.bd'),
(462, 50, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbaria.mymensingh.gov.bd'),
(463, 50, 'Trishal', 'ত্রিশাল', 'trishal.mymensingh.gov.bd'),
(464, 50, 'Bhaluka', 'ভালুকা', 'bhaluka.mymensingh.gov.bd'),
(465, 50, 'Muktagacha', 'মুক্তাগাছা', 'muktagacha.mymensingh.gov.bd'),
(466, 50, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 'mymensinghsadar.mymensingh.gov.bd'),
(467, 50, 'Dhobaura', 'ধোবাউড়া', 'dhobaura.mymensingh.gov.bd'),
(468, 50, 'Phulpur', 'ফুলপুর', 'phulpur.mymensingh.gov.bd'),
(469, 50, 'Haluaghat', 'হালুয়াঘাট', 'haluaghat.mymensingh.gov.bd'),
(470, 50, 'Gouripur', 'গৌরীপুর', 'gouripur.mymensingh.gov.bd'),
(471, 50, 'Gafargaon', 'গফরগাঁও', 'gafargaon.mymensingh.gov.bd'),
(472, 50, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganj.mymensingh.gov.bd'),
(473, 50, 'Nandail', 'নান্দাইল', 'nandail.mymensingh.gov.bd'),
(474, 50, 'Tarakanda', 'তারাকান্দা', 'tarakanda.mymensingh.gov.bd'),
(475, 47, 'Jamalpur Sadar', 'জামালপুর সদর', 'jamalpursadar.jamalpur.gov.bd'),
(476, 47, 'Melandah', 'মেলান্দহ', 'melandah.jamalpur.gov.bd'),
(477, 47, 'Islampur', 'ইসলামপুর', 'islampur.jamalpur.gov.bd'),
(478, 47, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonj.jamalpur.gov.bd'),
(479, 47, 'Sarishabari', 'সরিষাবাড়ী', 'sarishabari.jamalpur.gov.bd'),
(480, 47, 'Madarganj', 'মাদারগঞ্জ', 'madarganj.jamalpur.gov.bd'),
(481, 47, 'Bokshiganj', 'বকশীগঞ্জ', 'bokshiganj.jamalpur.gov.bd'),
(482, 0, 'Barhatta', 'বারহাট্টা', 'barhatta.netrokona.gov.bd'),
(483, 0, 'Durgapur', 'দুর্গাপুর', 'durgapur.netrokona.gov.bd'),
(484, 51, 'Kendua', 'কেন্দুয়া', 'kendua.netrokona.gov.bd'),
(485, 51, 'Atpara', 'আটপাড়া', 'atpara.netrokona.gov.bd'),
(486, 51, 'Madan', 'মদন', 'madan.netrokona.gov.bd'),
(487, 51, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuri.netrokona.gov.bd'),
(488, 51, 'Kalmakanda', 'কলমাকান্দা', 'kalmakanda.netrokona.gov.bd'),
(489, 51, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonj.netrokona.gov.bd'),
(490, 51, 'Purbadhala', 'পূর্বধলা', 'purbadhala.netrokona.gov.bd'),
(491, 51, 'Netrokona Sadar', 'নেত্রকোণা সদর', 'netrokonasadar.netrokona.gov.bd'),
(492, 52, 'Ramna', 'রমনা', ''),
(493, 52, 'Motijheel', 'মতিঝিল', ''),
(494, 52, 'Kotwali', 'কোতোয়ালী', ''),
(495, 52, 'Dhanmondi', 'ধানমন্ডি', ''),
(496, 52, 'Mohammadpur', 'মোহাম্মদপুর', ''),
(497, 52, 'Sutrapur', 'সুত্রাপুর', ''),
(498, 52, 'Tejgaon', 'তেজগাঁও', ''),
(499, 52, 'Gulshan', 'গুলশান', ''),
(500, 52, 'Lalbagh', 'লালবাগ', ''),
(501, 52, 'Mirpur', 'মিরপুর ', ''),
(502, 52, 'Pallabi', 'পল্লবী', ''),
(503, 52, 'Sabujbag', 'সবুজবাগ', ''),
(504, 52, 'Cantonment', 'ক্যান্টনমেন্ট', ''),
(505, 52, 'Demra', 'ডেমরা', ''),
(506, 52, 'Hazaribagh', 'হাজারীবাগ', ''),
(507, 52, 'Shyampur', 'শ্যামপুর', ''),
(508, 52, 'Badda', 'বাড্ডা', ''),
(509, 52, 'Kafrul', 'কাফরুল', ''),
(510, 52, 'Khilgaon', 'খিলগাঁও', ''),
(511, 52, 'Uttara', 'উত্তরা', ''),
(512, 52, 'Shah Ali', 'শাহ আলী', ''),
(513, 52, 'Biman Bandar', 'বিমান বন্দর', ''),
(514, 52, 'Paltan', 'পল্টন', ''),
(515, 52, 'Adabar', 'আদাবর', ''),
(516, 52, 'Darus Salam', 'দারুস সালাম', ''),
(517, 52, 'Uttarkhan', 'উত্তরখান', ''),
(518, 52, 'Kamrangirchar', 'কামরাঙ্গীরচর', ''),
(519, 52, 'Kadamtoli', 'কদমতলী', ''),
(520, 52, 'Gendaria', 'গেন্ডারিয়া', ''),
(521, 52, 'Chalkbazar', 'চকবাজার', ''),
(522, 52, 'Tejgaon Industrial', 'তেজগাঁও শিল্পাঞ্চল', ''),
(523, 52, 'Turag', 'তুরাগ', ''),
(524, 52, 'Dakhinkhan', 'দক্ষিণখান', ''),
(525, 52, 'Bangshal', 'বংশাল', ''),
(526, 52, 'Bhashantek', 'ভাষানটেক', ''),
(527, 52, 'Bhatara', 'ভাটারা', ''),
(528, 52, 'Jatrabari', 'যাত্রাবাড়ী', ''),
(529, 52, 'Rampura', 'রামপুরা', ''),
(530, 52, 'Rupnagar', 'রূপনগর', ''),
(531, 52, 'Sherebangla Nagar', 'শেরেবাংলা নগর', ''),
(532, 52, 'Shahjahanpur', 'শাহজাহানপুর', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL DEFAULT 3 COMMENT '1=>Admin, 2=>Vendor,3=>User,4=>Guest User',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `upazilla_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `phone`, `email`, `division_id`, `district_id`, `upazilla_id`, `address`, `profile_image`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 4, 'Walking Customer', 'guest-user', '01627490402', 'guestuser@gmail.com', NULL, NULL, NULL, 'Dhaka', 'upload/user/1663045118avatar5.png', NULL, '$2y$10$iy93F5hZNH/zmluBuHBm5.1.hUsNJVR5PauM4Nu4Dg0rt5dBhoODK', 1, NULL, '2022-07-30 03:25:27', '2023-01-05 01:18:49'),
(4, 1, 'Admin', 'admin', '01914424525', 'admin@gmail.com', NULL, NULL, NULL, 'Mirpur, Dhaka', '202312200922junayna logo design png-01.png', NULL, '$2y$10$AqTBF47mQF/pi9eLT1EACOK/Lo9Devx8LXorHmCELRlJJ9g4y5puK', 1, NULL, '2022-08-12 23:46:40', '2024-01-04 11:54:19'),
(23, 2, 'Imogene Carr', 'Imogene-Carr-nlIIl', '01958106312', 'jazataqig@mailinator.com', NULL, NULL, NULL, 'Eum exercitation ea', NULL, NULL, '$2y$10$idvPLWfdLMIiUEfOH96QFeSTgcDBGhza3j2pK8L1oACN3/xf9NeMS', 1, NULL, '2023-01-31 02:06:35', '2023-01-31 02:09:07'),
(249, 3, 'Soudia Mannan', 'Mumu', '01796325894', 'soudia@gmail.com', 8, 567, 9397, 'Sekhkuni Bazar', 'upload/admin_images/1818420572298459.jpg', NULL, '$2y$10$mYVqoIT8I6woMeIOOE3zY.nq/2YGDeRxebbZMHwZskNfZDpP0p8EO', 1, NULL, '2024-12-14 12:56:36', '2024-12-15 05:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_ledgers`
--
ALTER TABLE `account_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_ledgers_account_head_id_foreign` (`account_head_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_product_product_id_foreign` (`product_id`),
  ADD KEY `attribute_product_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `attribute_value_product_price`
--
ALTER TABLE `attribute_value_product_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_value_product_price_product_price_id_foreign` (`product_price_id`),
  ADD KEY `attribute_value_product_price_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaings`
--
ALTER TABLE `campaings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaing_products`
--
ALTER TABLE `campaing_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaing_products_campaing_id_foreign` (`campaing_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
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
-- Indexes for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordernotes`
--
ALTER TABLE `ordernotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pos_carts`
--
ALTER TABLE `pos_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `value` (`value`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_user_id_foreign` (`user_id`),
  ADD KEY `staff_role_id_foreign` (`role_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_phone_unique` (`phone`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazillas`
--
ALTER TABLE `upazillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `account_ledgers`
--
ALTER TABLE `account_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attribute_product`
--
ALTER TABLE `attribute_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `attribute_value_product_price`
--
ALTER TABLE `attribute_value_product_price`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `campaings`
--
ALTER TABLE `campaings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaing_products`
--
ALTER TABLE `campaing_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ordernotes`
--
ALTER TABLE `ordernotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_carts`
--
ALTER TABLE `pos_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upazillas`
--
ALTER TABLE `upazillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_ledgers`
--
ALTER TABLE `account_ledgers`
  ADD CONSTRAINT `account_ledgers_account_head_id_foreign` FOREIGN KEY (`account_head_id`) REFERENCES `account_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD CONSTRAINT `attribute_product_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_value_product_price`
--
ALTER TABLE `attribute_value_product_price`
  ADD CONSTRAINT `attribute_value_product_price_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_value_product_price_product_price_id_foreign` FOREIGN KEY (`product_price_id`) REFERENCES `product_prices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaing_products`
--
ALTER TABLE `campaing_products`
  ADD CONSTRAINT `campaing_products_campaing_id_foreign` FOREIGN KEY (`campaing_id`) REFERENCES `campaings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
