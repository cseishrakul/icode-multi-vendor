-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 12:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-com-multi-laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `image`, `confirm`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', '0', '+8801740308899', 'admin@admin.com', '$2y$10$hX704u1OjatSEEpDfvi2fOYwCAHPdvLk4oSscT5/ipT3KDCz.R20e', '97589.png', 'No', 1, NULL, '2023-06-13 01:47:09'),
(18, 'Md. Ishrakul Islam Efaz', 'vendor', '1', '01740308899', 'ishrakul236@gmail.com', '$2y$10$8mDAAQcHuEPKjtWbx1EiB.jSXLBQmA8ZMOvskFtot.8g2Uh03BMPe', '66763.jpg', 'Yes', 1, '2023-10-18 09:15:58', '2024-02-05 03:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `apps_countries`
--

CREATE TABLE `apps_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `link`, `title`, `alt`, `status`, `created_at`, `updated_at`) VALUES
(5, '95162.png', 'Slider', 'spring-collection', 'Spring Collection', 'Spring Collection', 1, '2023-07-06 03:24:15', '2023-07-06 13:02:20'),
(6, '71798.png', 'Slider', 'new-tops', 'Tops', 'Tops', 1, '2023-07-06 03:26:39', '2023-07-06 13:02:32'),
(7, '41583.png', 'Fix', 'fix-banner', 'Fix banner', 'Fix banner', 1, '2023-07-06 13:21:33', '2023-07-06 13:34:43'),
(8, '28152.png', 'Fix', 'fix-banner-two', 'Fix Banner Two', 'Fix Banner Two', 1, '2023-07-06 13:41:34', '2023-07-06 13:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Gap', 1, NULL, NULL),
(3, 'Lee', 1, NULL, NULL),
(4, 'Samsung', 1, NULL, NULL),
(5, 'Arrow', 1, '2023-06-15 13:27:05', '2023-06-15 13:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(3, '4944e0360240462b5ce0cddaf85a659f', 0, 6, 'M', 4, '2023-12-11 03:07:33', '2023-12-11 03:16:08'),
(5, '162354ef3ddc0fa7e951f2b242980c8f', 0, 9, 'P-S', 1, '2023-12-18 00:48:40', '2023-12-18 03:41:10'),
(7, 'a4bf71be11a65c9998287419965c6482', 6, 6, 'L', 3, '2023-12-27 12:36:04', '2023-12-27 12:44:57'),
(14, '59f1587902ce16b9c85f7e31241c975a', 0, 9, 'P-S', 5, '2024-01-03 03:35:53', '2024-01-03 03:40:31'),
(21, 'c2df264dc2899dc2c5be2c994c3a144c', 0, 10, 'vp-small', 3, '2024-01-20 10:47:48', '2024-01-20 10:47:48'),
(38, '482e12c27b9af93a78df2a3bd92bbbac', 1, 6, 'L', 1, '2024-03-11 12:40:49', '2024-03-11 12:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_discount` double(8,2) NOT NULL DEFAULT 0.00,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Men', '', 0.00, NULL, 'men', 'men', 'men', 'men', 1, '2023-08-06 08:01:50', '2023-10-02 05:53:12'),
(2, 0, 1, 'Women', '', 0.00, NULL, 'women', 'women', 'women', 'women', 1, '2023-08-06 08:03:00', '2023-08-06 08:03:00'),
(3, 1, 1, 't-shirt', '', 10.00, NULL, 't-shirt', NULL, NULL, NULL, 1, '2023-10-02 06:13:32', '2023-10-04 10:14:58'),
(4, 1, 1, 'Shirt', '', 0.00, 'Men\'s Brand New Shirts Here', 'shirt', 'shirt', 'shirt', 'shirt', 1, '2023-10-04 12:17:34', '2023-10-04 12:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `title`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'About Us Content is Coming Soon', 'about-us', 'About Us', 'Desc', 'about us', 1, NULL, NULL),
(2, 'Privacy Policy', 'Privacy Policy Content is Coming Soon', 'privacy-policy', 'Privacy Policy', 'Desc', 'privacy policy', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(2, 'AL', 'Albania', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(3, 'DZ', 'Algeria', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(4, 'AS', 'American Samoa', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(5, 'AD', 'Andorra', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(6, 'AO', 'Angola', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(7, 'AI', 'Anguilla', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(8, 'AQ', 'Antarctica', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(9, 'AG', 'Antigua and Barbuda', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(10, 'AR', 'Argentina', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(11, 'AM', 'Armenia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(12, 'AW', 'Aruba', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(13, 'AU', 'Australia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(14, 'AT', 'Austria', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(15, 'AZ', 'Azerbaijan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(16, 'BS', 'Bahamas', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(17, 'BH', 'Bahrain', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(18, 'BD', 'Bangladesh', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(19, 'BB', 'Barbados', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(20, 'BY', 'Belarus', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(21, 'BE', 'Belgium', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(22, 'BZ', 'Belize', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(23, 'BJ', 'Benin', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(24, 'BM', 'Bermuda', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(25, 'BT', 'Bhutan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(26, 'BO', 'Bolivia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(27, 'BA', 'Bosnia and Herzegovina', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(28, 'BW', 'Botswana', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(29, 'BV', 'Bouvet Island', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(30, 'BR', 'Brazil', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(31, 'IO', 'British Indian Ocean Territory', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(32, 'BN', 'Brunei Darussalam', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(33, 'BG', 'Bulgaria', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(34, 'BF', 'Burkina Faso', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(35, 'BI', 'Burundi', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(36, 'KH', 'Cambodia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(37, 'CM', 'Cameroon', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(38, 'CA', 'Canada', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(39, 'CV', 'Cape Verde', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(40, 'KY', 'Cayman Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(41, 'CF', 'Central African Republic', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(42, 'TD', 'Chad', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(43, 'CL', 'Chile', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(44, 'CN', 'China', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(45, 'CX', 'Christmas Island', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(47, 'CO', 'Colombia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(48, 'KM', 'Comoros', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(49, 'CD', 'Democratic Republic of the Congo', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(50, 'CG', 'Republic of Congo', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(51, 'CK', 'Cook Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(52, 'CR', 'Costa Rica', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(53, 'HR', 'Croatia (Hrvatska)', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(54, 'CU', 'Cuba', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(55, 'CY', 'Cyprus', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(56, 'CZ', 'Czech Republic', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(57, 'DK', 'Denmark', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(58, 'DJ', 'Djibouti', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(59, 'DM', 'Dominica', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(60, 'DO', 'Dominican Republic', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(61, 'TL', 'East Timor', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(62, 'EC', 'Ecuador', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(63, 'EG', 'Egypt', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(64, 'SV', 'El Salvador', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(65, 'GQ', 'Equatorial Guinea', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(66, 'ER', 'Eritrea', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(67, 'EE', 'Estonia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(68, 'ET', 'Ethiopia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(69, 'FK', 'Falkland Islands (Malvinas)', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(70, 'FO', 'Faroe Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(71, 'FJ', 'Fiji', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(72, 'FI', 'Finland', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(73, 'FR', 'France', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(74, 'FX', 'France, Metropolitan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(75, 'GF', 'French Guiana', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(76, 'PF', 'French Polynesia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(77, 'TF', 'French Southern Territories', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(78, 'GA', 'Gabon', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(79, 'GM', 'Gambia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(80, 'GE', 'Georgia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(81, 'DE', 'Germany', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(82, 'GH', 'Ghana', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(83, 'GI', 'Gibraltar', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(84, 'GG', 'Guernsey', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(85, 'GR', 'Greece', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(86, 'GL', 'Greenland', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(87, 'GD', 'Grenada', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(88, 'GP', 'Guadeloupe', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(89, 'GU', 'Guam', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(90, 'GT', 'Guatemala', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(91, 'GN', 'Guinea', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(92, 'GW', 'Guinea-Bissau', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(93, 'GY', 'Guyana', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(94, 'HT', 'Haiti', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(95, 'HM', 'Heard and Mc Donald Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(96, 'HN', 'Honduras', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(97, 'HK', 'Hong Kong', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(98, 'HU', 'Hungary', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(99, 'IS', 'Iceland', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(100, 'IN', 'India', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(101, 'IM', 'Isle of Man', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(102, 'ID', 'Indonesia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(103, 'IR', 'Iran (Islamic Republic of)', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(104, 'IQ', 'Iraq', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(105, 'IE', 'Ireland', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(106, 'IL', 'Israel', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(107, 'IT', 'Italy', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(108, 'CI', 'Ivory Coast', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(109, 'JE', 'Jersey', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(110, 'JM', 'Jamaica', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(111, 'JP', 'Japan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(112, 'JO', 'Jordan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(113, 'KZ', 'Kazakhstan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(114, 'KE', 'Kenya', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(115, 'KI', 'Kiribati', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(117, 'KR', 'Korea, Republic of', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(118, 'XK', 'Kosovo', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(119, 'KW', 'Kuwait', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(120, 'KG', 'Kyrgyzstan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(121, 'LA', 'Lao People\'s Democratic Republic', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(122, 'LV', 'Latvia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(123, 'LB', 'Lebanon', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(124, 'LS', 'Lesotho', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(125, 'LR', 'Liberia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(126, 'LY', 'Libyan Arab Jamahiriya', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(127, 'LI', 'Liechtenstein', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(128, 'LT', 'Lithuania', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(129, 'LU', 'Luxembourg', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(130, 'MO', 'Macau', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(131, 'MK', 'North Macedonia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(132, 'MG', 'Madagascar', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(133, 'MW', 'Malawi', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(134, 'MY', 'Malaysia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(135, 'MV', 'Maldives', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(136, 'ML', 'Mali', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(137, 'MT', 'Malta', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(138, 'MH', 'Marshall Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(139, 'MQ', 'Martinique', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(140, 'MR', 'Mauritania', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(141, 'MU', 'Mauritius', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(142, 'YT', 'Mayotte', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(143, 'MX', 'Mexico', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(144, 'FM', 'Micronesia, Federated States of', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(145, 'MD', 'Moldova, Republic of', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(146, 'MC', 'Monaco', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(147, 'MN', 'Mongolia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(148, 'ME', 'Montenegro', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(149, 'MS', 'Montserrat', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(150, 'MA', 'Morocco', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(151, 'MZ', 'Mozambique', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(152, 'MM', 'Myanmar', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(153, 'NA', 'Namibia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(154, 'NR', 'Nauru', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(155, 'NP', 'Nepal', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(156, 'NL', 'Netherlands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(157, 'AN', 'Netherlands Antilles', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(158, 'NC', 'New Caledonia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(159, 'NZ', 'New Zealand', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(160, 'NI', 'Nicaragua', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(161, 'NE', 'Niger', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(162, 'NG', 'Nigeria', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(163, 'NU', 'Niue', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(164, 'NF', 'Norfolk Island', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(165, 'MP', 'Northern Mariana Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(166, 'NO', 'Norway', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(167, 'OM', 'Oman', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(168, 'PK', 'Pakistan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(169, 'PW', 'Palau', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(170, 'PS', 'Palestine', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(171, 'PA', 'Panama', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(172, 'PG', 'Papua New Guinea', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(173, 'PY', 'Paraguay', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(174, 'PE', 'Peru', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(175, 'PH', 'Philippines', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(176, 'PN', 'Pitcairn', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(177, 'PL', 'Poland', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(178, 'PT', 'Portugal', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(179, 'PR', 'Puerto Rico', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(180, 'QA', 'Qatar', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(181, 'RE', 'Reunion', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(182, 'RO', 'Romania', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(183, 'RU', 'Russian Federation', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(184, 'RW', 'Rwanda', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(185, 'KN', 'Saint Kitts and Nevis', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(186, 'LC', 'Saint Lucia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(187, 'VC', 'Saint Vincent and the Grenadines', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(188, 'WS', 'Samoa', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(189, 'SM', 'San Marino', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(190, 'ST', 'Sao Tome and Principe', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(191, 'SA', 'Saudi Arabia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(192, 'SN', 'Senegal', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(193, 'RS', 'Serbia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(194, 'SC', 'Seychelles', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(195, 'SL', 'Sierra Leone', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(196, 'SG', 'Singapore', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(197, 'SK', 'Slovakia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(198, 'SI', 'Slovenia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(199, 'SB', 'Solomon Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(200, 'SO', 'Somalia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(201, 'ZA', 'South Africa', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(202, 'GS', 'South Georgia South Sandwich Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(203, 'SS', 'South Sudan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(204, 'ES', 'Spain', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(205, 'LK', 'Sri Lanka', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(206, 'SH', 'St. Helena', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(207, 'PM', 'St. Pierre and Miquelon', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(208, 'SD', 'Sudan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(209, 'SR', 'Suriname', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(211, 'SZ', 'Eswatini', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(212, 'SE', 'Sweden', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(213, 'CH', 'Switzerland', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(214, 'SY', 'Syrian Arab Republic', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(215, 'TW', 'Taiwan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(216, 'TJ', 'Tajikistan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(217, 'TZ', 'Tanzania, United Republic of', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(218, 'TH', 'Thailand', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(219, 'TG', 'Togo', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(220, 'TK', 'Tokelau', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(221, 'TO', 'Tonga', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(222, 'TT', 'Trinidad and Tobago', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(223, 'TN', 'Tunisia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(224, 'TR', 'Turkey', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(225, 'TM', 'Turkmenistan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(226, 'TC', 'Turks and Caicos Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(227, 'TV', 'Tuvalu', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(228, 'UG', 'Uganda', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(229, 'UA', 'Ukraine', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(230, 'AE', 'United Arab Emirates', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(231, 'GB', 'United Kingdom', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(232, 'US', 'United States', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(233, 'UM', 'United States minor outlying islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(234, 'UY', 'Uruguay', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(235, 'UZ', 'Uzbekistan', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(236, 'VU', 'Vanuatu', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(237, 'VA', 'Vatican City State', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(238, 'VE', 'Venezuela', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(239, 'VN', 'Vietnam', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(240, 'VG', 'Virgin Islands (British)', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(241, 'VI', 'Virgin Islands (U.S.)', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(242, 'WF', 'Wallis and Futuna Islands', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(243, 'EH', 'Western Sahara', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(244, 'YE', 'Yemen', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(245, 'ZM', 'Zambia', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15'),
(246, 'ZW', 'Zimbabwe', 1, '0000-00-00 00:00:00', '2023-06-11 10:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `coupon_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brands` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `vendor_id`, `coupon_option`, `coupon_code`, `categories`, `brands`, `users`, `coupon_type`, `amount_type`, `amount`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(4, 0, 'Automatic', 'RLOt5sWo', '1,3,4,2', '2', 'ahmud236@gmail.com,ishrakul26@gmail.com', 'Single Time', 'Fixed', 200.00, '2024-06-24', 1, '2024-01-06 06:33:23', '2024-03-11 04:06:00'),
(5, 1, 'Automatic', 'JLNdoCSa', '1,3,4', '2,3,4,5', '', 'Multiple Times', 'Fixed', 45.00, '2024-01-08', 1, '2024-01-07 01:57:14', '2024-01-07 03:29:48'),
(6, 0, 'Automatic', 'goz8CwQ8', '1,3,4', '2,3,4', '', 'Single Time', 'Fixed', 600.00, '2024-03-30', 1, '2024-03-11 03:50:56', '2024-03-11 03:50:56'),
(7, 0, 'Automatic', 'bLMvtzio', '1,3,4', '2,3,4', 'ahmud236@gmail.com,ishrakul26@gmail.com', 'Single Time', 'Percentage', 100.00, '2024-03-28', 1, '2024-03-11 04:15:23', '2024-03-11 04:15:23'),
(8, 0, 'Automatic', '399EM0Vj', '1,3,4,2', '2,3,4,5', 'ahmud236@gmail.com,ishrakul26@gmail.com', 'Single Time', 'Fixed', 100.00, '2024-03-28', 1, '2024-03-11 04:16:19', '2024-03-11 04:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 1, '2024-01-14 04:44:03', '2024-01-14 04:44:03'),
(9, 3, 'Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 1, '2024-03-11 02:54:30', '2024-03-11 02:56:14');

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
(5, '2023_06_05_052847_create_vendors_table', 2),
(6, '2023_06_05_053328_create_admins_table', 3),
(7, '2023_06_07_115702_create_vendors_business_details_table', 4),
(8, '2023_06_07_120411_create_vendors_bank_details', 5),
(9, '2023_06_11_114000_create_sections_table', 6),
(10, '2023_06_12_072752_create_cms_pages_table', 7),
(11, '2023_06_14_061329_create_categories_table', 8),
(12, '2023_06_15_174322_create_brands_table', 9),
(13, '2023_06_18_063939_create_products_table', 10),
(14, '2023_06_20_081548_create_products_attributes_table', 11),
(15, '2023_06_24_080456_create_products_images_table', 12),
(16, '2023_06_27_091315_create_banners_table', 13),
(17, '2023_07_06_184915_update_banners_table', 14),
(18, '2023_07_13_072951_update_products_table', 15),
(19, '2023_07_22_072904_create_products_filters_table', 16),
(20, '2023_07_22_073424_create_products_filters_values_table', 17),
(21, '2023_10_17_181643_create_recently_viewed_products_table', 18),
(22, '2023_10_18_062522_create_carts_table', 19),
(23, '2024_01_03_100852_create_coupons_table', 20),
(24, '2024_01_08_072326_create_delivery_addresses_table', 21),
(25, '2024_01_15_060722_create_orders_table', 22),
(26, '2024_01_15_062143_create_orders_products_table', 23),
(27, '2024_02_14_090610_create_order_statuses_table', 24),
(28, '2024_02_17_080737_create_orders_logs_table', 25),
(29, '2024_02_17_092637_update_orders_table', 26),
(30, '2024_03_11_194709_create_payments_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` double(8,2) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `shipping_charges`, `coupon_code`, `coupon_amount`, `order_status`, `payment_method`, `payment_gateway`, `grand_total`, `courier_name`, `tracking_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'Partially Delivered', 'COD', 'COD', 630.00, '', '', '2024-01-21 01:56:09', '2024-02-14 04:42:33'),
(2, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'Delivered', 'COD', 'COD', 217.80, '', '', '2024-01-27 04:42:49', '2024-03-02 02:24:56'),
(3, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 1890.00, '', '', '2024-02-14 06:08:17', '2024-02-14 06:08:17'),
(4, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 108.90, '', '', '2024-02-14 06:11:34', '2024-02-14 06:11:34'),
(5, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 960.00, '', '', '2024-02-14 06:16:39', '2024-02-14 06:16:39'),
(6, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'Delivered', 'COD', 'COD', 630.00, 'Sundorban', 'Sn-232112017', '2024-02-14 06:18:01', '2024-03-02 02:42:13'),
(7, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'Shipped', 'COD', 'COD', 960.00, 'Sundorban', 'Sn-232112017', '2024-02-14 06:23:25', '2024-02-17 06:50:17'),
(8, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 1338.00, NULL, NULL, '2024-03-02 04:39:41', '2024-03-02 04:39:41'),
(9, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 252.90, NULL, NULL, '2024-03-02 04:56:46', '2024-03-02 04:56:46'),
(10, 3, 'EFaz', 'Sylhet', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740308899', 'ishrakul26@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 360.90, NULL, NULL, '2024-03-02 05:11:59', '2024-03-02 05:11:59'),
(11, 3, 'Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ishrakul26@gmail.com', 0.00, 'goz8CwQ8', 756.00, 'New', 'COD', 'COD', -630.00, NULL, NULL, '2024-03-11 04:02:51', '2024-03-11 04:02:51'),
(12, 3, 'Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ishrakul26@gmail.com', 0.00, '399EM0Vj', 100.00, 'New', 'COD', 'COD', 860.00, NULL, NULL, '2024-03-11 04:22:45', '2024-03-11 04:22:45'),
(13, 1, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740309988', 'ahmud236@gmail.com', 0.00, NULL, NULL, 'Pending', 'Prepaid', 'Paypal', 144.00, NULL, NULL, '2024-03-11 12:41:08', '2024-03-11 12:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `orders_logs`
--

CREATE TABLE `orders_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_logs`
--

INSERT INTO `orders_logs` (`id`, `order_id`, `order_item_id`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 7, 15, 'Shipped', '2024-02-17 05:54:46', '2024-02-17 05:54:46'),
(2, 7, NULL, 'Shipped', '2024-02-17 06:50:17', '2024-02-17 06:50:17'),
(3, 7, 6, 'Shipped', '2024-02-17 07:12:50', '2024-02-17 07:12:50'),
(4, 2, NULL, 'Delivered', '2024-03-02 02:24:56', '2024-03-02 02:24:56'),
(5, 2, 1, 'In Process', '2024-03-02 02:25:18', '2024-03-02 02:25:18'),
(6, 2, 10, 'Pending', '2024-03-02 02:25:32', '2024-03-02 02:25:32'),
(7, 1, 9, 'Pending', '2024-03-02 02:37:19', '2024-03-02 02:37:19'),
(8, 6, NULL, 'Shipped', '2024-03-02 02:41:18', '2024-03-02 02:41:18'),
(9, 6, 5, 'In Process', '2024-03-02 02:41:36', '2024-03-02 02:41:36'),
(10, 6, 14, 'In Process', '2024-03-02 02:41:56', '2024-03-02 02:41:56'),
(11, 6, NULL, 'Delivered', '2024-03-02 02:42:13', '2024-03-02 02:42:13'),
(12, 2, 1, 'Shipped', '2024-03-02 03:12:22', '2024-03-02 03:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `item_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `user_id`, `vendor_id`, `admin_id`, `product_id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_price`, `product_qty`, `item_status`, `courier_name`, `tracking_number`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, 'Shipped', 'SA paribahan', 'TrxID2323112017', '2024-01-15 10:06:06', '2024-03-02 03:12:22'),
(2, 3, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, NULL, NULL, NULL, '2024-01-15 10:19:15', '2024-01-15 10:19:15'),
(3, 4, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, NULL, NULL, NULL, '2024-01-15 11:21:25', '2024-01-15 11:21:25'),
(4, 5, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, NULL, NULL, NULL, '2024-01-15 11:22:08', '2024-01-15 11:22:08'),
(5, 6, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, 'In Process', 'SA paribahan', 'TrxID2323112017', '2024-01-15 11:22:40', '2024-03-02 02:41:36'),
(6, 7, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, 'Shipped', 'DLI', 'TrxID2323112017', '2024-01-15 11:27:51', '2024-02-17 07:12:50'),
(7, 8, 1, 1, 18, 10, 'vp-34', 'vendorPro', 'Black', 'vp-small', 630.00, 1, NULL, NULL, NULL, '2024-01-15 11:28:46', '2024-01-15 11:28:46'),
(9, 1, 1, 1, 18, 10, 'vp-34', 'vendorPro', 'Black', 'vp-small', 630.00, 1, 'Pending', NULL, NULL, '2024-01-21 01:56:09', '2024-03-02 02:37:19'),
(10, 2, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 2, 'Pending', NULL, NULL, '2024-01-27 04:42:49', '2024-03-02 02:25:31'),
(11, 3, 1, 1, 18, 10, 'vp-34', 'vendorPro', 'Black', 'vp-small', 630.00, 3, NULL, NULL, NULL, '2024-02-14 06:08:17', '2024-02-14 06:08:17'),
(12, 4, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 1, NULL, NULL, NULL, '2024-02-14 06:11:34', '2024-02-14 06:11:34'),
(13, 5, 1, 0, 1, 8, 'CS-21', 'Casual Shirt', 'Black', 'Cm-21', 960.00, 1, NULL, NULL, NULL, '2024-02-14 06:16:39', '2024-02-14 06:16:39'),
(14, 6, 1, 1, 18, 10, 'vp-34', 'vendorPro', 'Black', 'vp-small', 630.00, 1, 'In Process', 'SA paribahan', 'TrxID2323112017', '2024-02-14 06:18:02', '2024-03-02 02:41:56'),
(15, 7, 1, 0, 1, 8, 'CS-21', 'Casual Shirt', 'Black', 'Cm-21', 960.00, 1, 'Shipped', 'SA paribahan', 'TrxID2323112017', '2024-02-14 06:23:25', '2024-02-17 05:54:46'),
(16, 8, 1, 0, 1, 6, 'SS-67', 'Stripe Shirt', 'red', 'M', 126.00, 3, NULL, NULL, NULL, '2024-03-02 04:39:41', '2024-03-02 04:39:41'),
(17, 8, 1, 0, 1, 8, 'CS-21', 'Casual Shirt', 'Black', 'Cm-21', 960.00, 1, NULL, NULL, NULL, '2024-03-02 04:39:41', '2024-03-02 04:39:41'),
(18, 9, 1, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 1, NULL, NULL, NULL, '2024-03-02 04:56:46', '2024-03-02 04:56:46'),
(19, 9, 1, 0, 1, 6, 'SS-67', 'Stripe Shirt', 'red', 'L', 144.00, 1, NULL, NULL, NULL, '2024-03-02 04:56:46', '2024-03-02 04:56:46'),
(20, 10, 3, 0, 1, 6, 'SS-67', 'Stripe Shirt', 'red', 'M', 126.00, 2, NULL, NULL, NULL, '2024-03-02 05:11:59', '2024-03-02 05:11:59'),
(21, 10, 3, 14, 14, 9, 'P-220', 'Polo', 'Black', 'P-S', 108.90, 1, NULL, NULL, NULL, '2024-03-02 05:11:59', '2024-03-02 05:11:59'),
(22, 11, 3, 0, 1, 6, 'SS-67', 'Stripe Shirt', 'red', 'M', 126.00, 1, NULL, NULL, NULL, '2024-03-11 04:02:52', '2024-03-11 04:02:52'),
(23, 12, 3, 0, 1, 8, 'CS-21', 'Casual Shirt', 'Black', 'Cm-21', 960.00, 1, NULL, NULL, NULL, '2024-03-11 04:22:45', '2024-03-11 04:22:45'),
(24, 13, 1, 0, 1, 6, 'SS-67', 'Stripe Shirt', 'red', 'L', 144.00, 1, NULL, NULL, NULL, '2024-03-11 12:41:08', '2024-03-11 12:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_item_statuses`
--

CREATE TABLE `order_item_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item_statuses`
--

INSERT INTO `order_item_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, NULL, NULL),
(2, 'In Process', 1, NULL, NULL),
(3, 'Shipped', 1, NULL, NULL),
(4, 'Delivered', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', 1, NULL, NULL),
(2, 'Pending', 1, NULL, NULL),
(3, 'Cancelled', 1, NULL, NULL),
(4, 'In Process', 1, NULL, NULL),
(5, 'Shipped', 1, NULL, NULL),
(6, 'Partially Shipped', 1, NULL, NULL),
(7, 'Delivered', 1, NULL, NULL),
(8, 'Partially Delivered', 1, NULL, NULL),
(9, 'Paid', 1, NULL, NULL);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` float NOT NULL,
  `product_discount` float NOT NULL,
  `product_weight` int(11) NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occasion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bestseller` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `brand_id`, `vendor_id`, `admin_id`, `admin_type`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_image`, `product_video`, `group_code`, `description`, `stripe`, `fabric`, `occasion`, `fit`, `sleeve`, `ram`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `is_bestseller`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 5, 0, 1, 'superadmin', 'GT', 'SS-67', 'Red', 7500, 0, 20, NULL, NULL, '100', 'dfdf', NULL, 'Cotten', NULL, NULL, NULL, NULL, 'gt', 'gt', 'gt', 'Yes', 'Yes', 1, '2023-08-08 12:34:02', '2023-10-17 14:09:23'),
(5, 1, 3, 4, 0, 1, 'superadmin', 'CHR New', 'ch', 'white', 222222000, 0, 5000, '69145.PNG', NULL, '', 'fgfgfgfgfg', NULL, NULL, NULL, NULL, NULL, NULL, 'ch', 'ch', 'ch', 'Yes', 'Yes', 1, '2023-10-02 05:40:38', '2023-10-02 06:13:46'),
(6, 1, 3, 2, 0, 1, 'superadmin', 'Stripe Shirt', 'SS-67', 'red', 160, 0, 20, '77801.jpeg', '69473.mp4', '', 'ewrewrewrewrewr', NULL, 'Cotten', NULL, NULL, NULL, NULL, 't-shirts', 't-shirts', 't-shirts', 'Yes', 'Yes', 1, '2023-10-02 10:20:46', '2023-10-04 11:59:26'),
(7, 1, 4, 2, 0, 1, 'superadmin', 'Men\'s T-shirt', 'MTS-25', 'Black', 220, 0, 0, '74862.jpg', NULL, '100', 'Men\'s New T-Shirt for summer', 'stripe', 'Cotten', NULL, NULL, NULL, NULL, 'MTS-25', 'MTS-25', 'MTS-25', 'Yes', 'Yes', 1, '2023-10-04 12:09:32', '2023-10-17 14:11:32'),
(8, 1, 4, 5, 0, 1, 'superadmin', 'Casual Shirt', 'CS-21', 'Black', 1200, 20, 1, '21540.jpg', NULL, '100', 'New Casual Shirt', 'stripe', NULL, NULL, NULL, NULL, NULL, 'CS-21', 'CS-21', 'CS-21', 'Yes', 'Yes', 1, '2023-10-05 01:47:35', '2023-10-24 02:56:35'),
(9, 1, 3, 3, 14, 14, 'vendor', 'Polo', 'P-220', 'Black', 120, 1, 1, '82084.jpg', NULL, 'P-220', 'Nice', 'stripe', NULL, NULL, NULL, NULL, NULL, 'P-220', 'P-220', 'P-220', 'Yes', 'Yes', 1, '2023-10-17 15:10:29', '2023-10-17 15:11:42'),
(10, 1, 3, 2, 1, 18, 'vendor', 'vendorPro', 'vp-34', 'Black', 750, 0, 0, '11300.png', NULL, 'vp-34', 'New Product', 'stripe', NULL, NULL, NULL, NULL, NULL, 'vendor-pro', 'vendor-pro', 'vp-34', 'Yes', 'Yes', 1, '2024-01-07 02:25:24', '2024-01-07 02:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 100.00, 10, 'p13-S', 0, '2023-06-20 04:45:41', '2023-06-21 07:17:31'),
(2, 1, 'Medium', 250.00, 10, 'p13-M', 1, '2023-06-20 04:45:42', '2023-06-21 07:17:31'),
(3, 1, 'Large', 350.00, 5, 'p13-L', 1, '2023-06-20 04:45:42', '2023-06-21 07:17:31'),
(5, 6, 'M', 140.00, 10, 'ss', 1, '2023-10-03 13:17:18', '2023-10-04 10:18:29'),
(6, 6, 'L', 160.00, 10, 'st', 1, '2023-10-03 13:28:11', '2023-10-04 10:18:29'),
(7, 7, 'Med', 220.00, 10, 'MTSM-25', 0, '2023-10-04 12:11:23', '2023-10-04 12:11:23'),
(8, 8, 'Cs', 1000.00, 5, 'CS-21', 0, '2023-10-05 01:48:55', '2023-10-05 01:49:33'),
(9, 8, 'Cm-21', 1200.00, 5, 'CM-21', 1, '2023-10-05 01:49:28', '2023-10-05 01:49:33'),
(10, 9, 'P-S', 110.00, 10, 'P-220', 1, '2023-10-18 00:51:16', '2023-10-18 00:51:16'),
(11, 10, 'vp-small', 700.00, 10, 'vp-34', 1, '2024-01-07 02:29:13', '2024-01-07 02:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters`
--

CREATE TABLE `products_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_column` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters`
--

INSERT INTO `products_filters` (`id`, `cat_ids`, `filter_name`, `filter_column`, `status`, `created_at`, `updated_at`) VALUES
(1, '1,2', 'Fabric', 'fabric', 1, '2023-08-06 08:05:05', '2023-08-06 08:05:05'),
(2, '2', 'RAM', 'ram', 1, '2023-08-06 08:06:01', '2023-08-06 08:06:01'),
(3, '1,2', 'Sleeve', 'sleeve', 1, '2023-08-06 08:06:10', '2023-08-06 08:06:10'),
(4, '1,2', 'Fit', 'fit', 1, '2023-08-06 08:06:19', '2023-08-06 08:06:19'),
(5, '1,2', 'Occasion', 'occasion', 1, '2023-08-06 08:06:27', '2023-08-06 08:06:27'),
(6, '1,3,4,2', 'Stripe', 'stripe', 1, '2023-10-04 12:26:45', '2023-10-04 12:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters_values`
--

CREATE TABLE `products_filters_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` int(11) NOT NULL,
  `filter_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters_values`
--

INSERT INTO `products_filters_values` (`id`, `filter_id`, `filter_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cotten', 1, '2023-08-06 08:23:17', '2023-08-06 08:23:17'),
(2, 1, 'Polyester', 1, '2023-08-06 08:25:17', '2023-08-06 08:25:17'),
(3, 1, 'Wool', 1, '2023-08-06 08:25:27', '2023-08-06 08:25:27'),
(4, 3, 'Full Sleeve', 1, '2023-08-26 02:56:52', '2023-08-26 02:56:52'),
(5, 6, 'stripe', 1, '2023-10-04 12:27:47', '2023-10-04 12:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'screencapture-services-nidw-gov-bd-nid-pub-citizen-home-profile-2023-09-30-00_13_25.png20110.png', 1, '2023-10-02 05:41:25', '2023-10-02 05:41:25'),
(2, 5, 'p.PNG21304.PNG', 1, '2023-10-02 05:41:25', '2023-10-02 05:41:25'),
(3, 8, 'head1.jpg48141.jpg', 1, '2023-10-05 01:49:50', '2023-10-05 01:49:50'),
(4, 8, 'head2.jpg26480.jpg', 1, '2023-10-05 01:49:50', '2023-10-05 01:49:50'),
(5, 8, 'key3.jpg81006.jpg', 1, '2023-10-05 01:49:50', '2023-10-05 01:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed_products`
--

CREATE TABLE `recently_viewed_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recently_viewed_products`
--

INSERT INTO `recently_viewed_products` (`id`, `product_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 8, '8', NULL, NULL),
(2, 7, '7', NULL, NULL),
(3, 7, '293b9204d4a3642978919daa32894f81', NULL, NULL),
(4, 7, 'ed0f098ab0429231affce039eefacb36', NULL, NULL),
(5, 7, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(6, 8, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(7, 4, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(8, 2, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(9, 6, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(10, 5, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(11, 9, '28462a32cdff298d9fbc27787c5ab0a6', NULL, NULL),
(12, 9, '261e84dfb175d0152c21ac73f9b9adab', NULL, NULL),
(13, 8, '261e84dfb175d0152c21ac73f9b9adab', NULL, NULL),
(14, 8, '82368dfc57726826e173b85ac677b457', NULL, NULL),
(15, 8, '6cbab41e7753d002ae10c00c6a1f1d1f', NULL, NULL),
(16, 7, '5c4e2c65714b27f2bc9f87975ebfb894', NULL, NULL),
(17, 8, '5c4e2c65714b27f2bc9f87975ebfb894', NULL, NULL),
(18, 5, '4944e0360240462b5ce0cddaf85a659f', NULL, NULL),
(19, 6, '4944e0360240462b5ce0cddaf85a659f', NULL, NULL),
(20, 8, '162354ef3ddc0fa7e951f2b242980c8f', NULL, NULL),
(21, 9, '162354ef3ddc0fa7e951f2b242980c8f', NULL, NULL),
(22, 6, '162354ef3ddc0fa7e951f2b242980c8f', NULL, NULL),
(23, 6, 'a4bf71be11a65c9998287419965c6482', NULL, NULL),
(24, 9, '83100aab5cd9751715519d5c9a279ba1', NULL, NULL),
(25, 5, '666628bd2946809ddd0fd3bff6ec8378', NULL, NULL),
(26, 9, '666628bd2946809ddd0fd3bff6ec8378', NULL, NULL),
(27, 8, '59f1587902ce16b9c85f7e31241c975a', NULL, NULL),
(28, 9, '59f1587902ce16b9c85f7e31241c975a', NULL, NULL),
(29, 5, '59f1587902ce16b9c85f7e31241c975a', NULL, NULL),
(30, 7, '59f1587902ce16b9c85f7e31241c975a', NULL, NULL),
(31, 6, '59f1587902ce16b9c85f7e31241c975a', NULL, NULL),
(32, 7, '29f9182b968f147ffd5fb40520a42c4d', NULL, NULL),
(33, 8, '29f9182b968f147ffd5fb40520a42c4d', NULL, NULL),
(34, 10, '29f9182b968f147ffd5fb40520a42c4d', NULL, NULL),
(35, 9, '29f9182b968f147ffd5fb40520a42c4d', NULL, NULL),
(36, 2, '29f9182b968f147ffd5fb40520a42c4d', NULL, NULL),
(37, 10, '476d1a8df38661e5e754114e1e0007f9', NULL, NULL),
(38, 9, '364cf89b421f750537d395b4e2691c6b', NULL, NULL),
(39, 10, '85c75eabb7af49ea3740a8f055d19cf4', NULL, NULL),
(40, 10, 'c2df264dc2899dc2c5be2c994c3a144c', NULL, NULL),
(41, 8, 'c2df264dc2899dc2c5be2c994c3a144c', NULL, NULL),
(42, 10, '3de83281e661ed1887a7232396e58469', NULL, NULL),
(43, 9, 'f33dffb9797fec48bfa15cfb3f343ca4', NULL, NULL),
(44, 10, 'f33dffb9797fec48bfa15cfb3f343ca4', NULL, NULL),
(45, 10, 'c897b02c64fb4349af7dff88bc5395fd', NULL, NULL),
(46, 9, 'c897b02c64fb4349af7dff88bc5395fd', NULL, NULL),
(47, 9, 'c27563951d8314b9cd570c4044e08a75', NULL, NULL),
(48, 8, 'c27563951d8314b9cd570c4044e08a75', NULL, NULL),
(49, 10, 'c27563951d8314b9cd570c4044e08a75', NULL, NULL),
(50, 8, '3a00fc4fe506231f44d451519be30250', NULL, NULL),
(51, 6, '3a00fc4fe506231f44d451519be30250', NULL, NULL),
(52, 5, '3a00fc4fe506231f44d451519be30250', NULL, NULL),
(53, 9, '3a00fc4fe506231f44d451519be30250', NULL, NULL),
(54, 6, '4720ef0a5c8fb72c171b1e72e268a0e5', NULL, NULL),
(55, 10, '4720ef0a5c8fb72c171b1e72e268a0e5', NULL, NULL),
(56, 8, '4720ef0a5c8fb72c171b1e72e268a0e5', NULL, NULL),
(57, 6, '482e12c27b9af93a78df2a3bd92bbbac', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', 1, '2023-06-15 03:51:16', '2023-06-26 04:07:56'),
(2, 'Electronics', 1, '2023-06-15 03:51:29', '2023-06-15 03:51:29'),
(3, 'Appliances', 1, '2023-06-15 03:51:45', '2023-06-15 03:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Ishrakul Islam', 'Road-10, Boroikhandi', 'Sylhet', 'South Zone', 'Bangladesh', '3100', '01609535420', 'ahmud236@gmail.com', NULL, '$2y$10$ZaxNU0Bp9f1B2X3EIhA6M.k8wFE.RZ.HNrroCLeNkNziR2Gzwm2aW', 1, NULL, '2023-12-28 05:07:04', '2023-12-28 13:49:10'),
(2, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'ishra236@gmail.com', NULL, '$2y$10$f5Zqi2ONpBhTcQOjlRMR1.aShoLo.iMTp2kPERn8IV5AejBkp.Wne', 0, NULL, '2023-12-28 08:45:40', '2024-01-07 06:00:13'),
(3, 'Md. Ishrakul Islam Efaz', 'Road-10, Boroikhandi', 'Sylhet', 'South-zone', 'Bangladesh', '3100', '01740308899', 'ishrakul26@gmail.com', NULL, '$2y$10$ZRbs5Luu1LlpqTgeB3Ksoez7w9Ps7tWonRBNGoO3DbQc9NZk7/uDG', 1, NULL, '2023-12-28 08:48:20', '2024-03-02 05:07:07'),
(4, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'akul236@gmail.com', NULL, '$2y$10$20kDU4dfaFJU2O5CommaCeS.52psfrADEllTibjIkTP3.xI9Oa0re', 0, NULL, '2023-12-28 08:53:23', '2023-12-28 08:53:23'),
(5, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'ishrakul23@gmail.com', NULL, '$2y$10$IRnjK2V7oGy3IU30sBgCRu73/y0piBJNr2G9EmHNBjm/D4GXACA.m', 0, NULL, '2023-12-28 08:59:01', '2023-12-28 08:59:01'),
(6, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'ishra@gmail.com', NULL, '$2y$10$HVO.Sr9nwQqVf3p.VRcrZuk1mJdNq5K5En.gwiPaUeIz1E0a6543m', 0, NULL, '2023-12-28 09:00:55', '2023-12-28 09:00:55'),
(7, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'kul236@gmail.com', NULL, '$2y$10$0yBs0hk52TBEs.lc6K9XhOhP4lR6CETYkZRS4MnhTlxLTBINlfnaG', 0, NULL, '2023-12-28 09:01:47', '2023-12-28 09:01:47'),
(8, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'ishrakul2@gmail.com', NULL, '$2y$10$TUVyWzct3lqwRqyU0mO6XeVDwPsoSpoeVt5sI9uvMPu4so.0k5hLG', 0, NULL, '2023-12-28 09:04:56', '2023-12-28 09:04:56'),
(9, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'ishrakul3@gmail.com', NULL, '$2y$10$gkyXp24lvJvmGKMlQA2VbuTsSDHOB4m9y8qmZiRrCjaXmzDEONCtC', 0, NULL, '2023-12-28 09:06:28', '2023-12-28 09:06:28'),
(10, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'ishrakul6@gmail.com', NULL, '$2y$10$mgzOE7VlXU7X638nSTpE9u5uAGh6ljsVqHtQl9F33PNDnjFN6Ccjq', 0, NULL, '2023-12-28 09:07:03', '2023-12-28 09:07:03'),
(11, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'e@gmail.com', NULL, '$2y$10$lhyd137mYrrY/0vJIoEfdezP5CQATYEJtCc3YBkWFAmwjzAY6Sgru', 0, NULL, '2023-12-28 09:07:27', '2023-12-28 09:07:27'),
(12, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'a@gmail.com', NULL, '$2y$10$Z1PMEG2gnrAS4Yfmu8C1N.HCPS4sWKDn.aqCd/F5JK4IPHZle87wO', 0, NULL, '2023-12-28 09:08:19', '2023-12-28 09:08:19'),
(13, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'z@gmail.com', NULL, '$2y$10$ALWZVuJZmPTf2.0o62LScuqvDLsyCPHs0X3UafZfyFKEtO0mUbyzm', 0, NULL, '2023-12-28 09:09:01', '2023-12-28 09:09:01'),
(14, 'Md. Ishrakul Islam Efaz', NULL, NULL, NULL, NULL, NULL, '01740308899', 'i236@gmail.com', NULL, '$2y$10$tcFhJpS/fynXb/69nkcHtOSZD0YKTEwbcAUZH2YhCicO4St4MehHq', 0, NULL, '2023-12-28 09:10:42', '2023-12-28 09:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `confirm`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Md. Ishrakul Islam Efaz', 'Sylhet', 'Sylhet', 'Sylhet', 'Bangladesh', '3100', '01740308899', 'ishrakul236@gmail.com', 'Yes', 1, '2023-10-18 09:15:58', '2024-02-05 03:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_bank_details`
--

CREATE TABLE `vendors_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_bank_details`
--

INSERT INTO `vendors_bank_details` (`id`, `vendor_id`, `account_holder_name`, `bank_name`, `account_number`, `bank_ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Efaz', 'IFIC', '123232434343', '1211', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_business_details`
--

CREATE TABLE `vendors_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_proof_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_business_details`
--

INSERT INTO `vendors_business_details` (`id`, `vendor_id`, `shop_name`, `shop_address`, `shop_city`, `shop_state`, `shop_country`, `shop_pincode`, `shop_mobile`, `shop_website`, `shop_email`, `address_proof`, `address_proof_image`, `business_license_number`, `gst_number`, `pan_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Efaz Shop', 'Sylhet', 'Sylhet', 'Sylhet', 'Bangladesh', '31222', '01749399900', 'www.google.com', NULL, 'Driving License', '16875.PNG', '121212121', '121212121', '12121212', NULL, NULL);

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
-- Indexes for table `apps_countries`
--
ALTER TABLE `apps_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item_statuses`
--
ALTER TABLE `order_item_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters`
--
ALTER TABLE `products_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apps_countries`
--
ALTER TABLE `apps_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_item_statuses`
--
ALTER TABLE `order_item_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products_filters`
--
ALTER TABLE `products_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
