-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2019 at 07:49 AM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kota_tiffin`
--

-- --------------------------------------------------------

--
-- Table structure for table `appusers`
--

CREATE TABLE `appusers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` text COLLATE utf8mb4_unicode_ci,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appusers`
--

INSERT INTO `appusers` (`id`, `name`, `email_id`, `phone_number`, `login_method`, `firebase_token`, `gender`, `state`, `city`, `dob`, `image`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 'khan', 'khan@gmail.com', '867867867', 'facebook', '786tcyu7hbhk76rj765cfn6', 'male', 'Up', 'Gzb', '14/1/1995', 'public/user_images/_user1553334524.png', '1', '2019-03-23 00:00:00', '2019-03-23 00:00:00'),
(2, 'aamir', ' ', '98989898', 'facebook', '786tj876ym,976cfn6', ' ', ' ', ' ', ' ', ' ', '1', '2019-03-23 00:00:00', NULL),
(12, 'Pratham Vision', 'Vikash@prathamvision.com', '9873396412', 'Google', 'e-q5E8tmH1w:APA91bHn0hONQDhlXB7nniYKX1rC0oBaWHS_PhCGxE-SGhTVMs7wQU12p1o6zhuOyMsixOayFbOAY83Sv9kLmwzXGAlaegQ7jBhCgq6Fl0Pij9Dnc2aRjrrSxGNTgcxhYIZE7gh9DvZk', 'Female', 'Uttar Pradesh', 'Ghaziabad', '25/3/2019', 'public/user_images/_user1553599344.png', '1', '2019-03-25 00:00:00', '2019-03-26 00:00:00'),
(13, 'Vikash', 'vekain19@gmail.com', '9568083266', 'OTP', 'csB1W_lGYk0:APA91bEUbnNx3a5ogs_RunlCuRzgh7AOURAc-TkMYN4c9j9rT2TkEIdQBA-WSdjFggGrq9E1ax1WBwjTKzO8ELoVVyYYhd02wqc-K5IYt6AObcXoebFSLs73UCEN2CKqk92E1qXuaWGm', 'Female', 'Uttar Pradesh', 'Ghaziabad', '25/3/2019', 'public/user_images/_user1553673598.png', '1', '2019-03-25 00:00:00', '2019-05-11 00:00:00'),
(14, 'vikash', ' ', '8700853187', 'OTP', 'cKfwKzRYMCk:APA91bFWqPxOskh2VN9YomARbB0QgO0Nl-6e3OSZ-SlU4fjuwt0TC_DSlqfd098bZ4zVAKU0IR_-H-y_XOtjkc32ApbVFJalmx0wNvGhEi_2ZDC_zeOtRq-xc_9TgHxNDg5bgyjYGfMt', ' ', ' ', ' ', ' ', ' ', '1', '2019-05-09 00:00:00', NULL),
(15, 'aamir', 'aamir.khan@gmail.com', '9350682421', 'OTP', 'fS1SaN4_rqQ:APA91bHFJ-AUIvVA0UVVG0-S7Sj1dRl_FsyKlBj8fGMAB5e5XoquueIsqux4vb3KMIQiv4UNaUunjtdlZgzh4qweTdcVw2waIEGie1v_0DEhvk2C7Dtc9mwvMjxCpykJrM0Rl_mT7ieB', 'Male', 'Rajasthan', 'Kota', '1995/5/13', ' ', '1', '2019-05-13 00:00:00', '2019-05-13 00:00:00'),
(16, 'aamir', 'aamir.khan1390@gmail.com', '9990369197', 'OTP', 'd1Arrm4SLq0:APA91bGNJU_J2ZgaZqXCQg1jAzCU3CMp_UboesDMTkYuPKfeMPloP5eHRBLNbzByptdm2A22MX6edo-fu9omxls40ViQ-TBTKqRDrrZDmI6w9CobzVQCSSpxGHKJJpCWAQQ3rj0HQuRj', 'male', 'Rajasthan', 'Kota', '2011/7/2', ' ', '1', '2019-05-13 00:00:00', '2019-05-16 00:00:00'),
(17, 'archit', 'architattrey@gmail.com', '9568083265', 'OTP', 'fhsdeOBca40:APA91bFTwOXfDSVZts1yVHYUEls6EPlL5U1LS5wplFcJuc01PsWCDTVxYbJLkKvCc4SRlkPCglUe0QcAktNGs_0_14s921mQ-kwygG-gX7zzgfCSF5SkL9GrteBjkreODswuFcX7FDYD', 'Male', 'Rajasthan', 'Kota', '2019/5/13', ' ', '1', '2019-05-13 00:00:00', '2019-05-13 00:00:00'),
(18, 'archit', ' ', '9568083266', 'OTP', 'fhsdeOBca40:APA91bFTwOXfDSVZts1yVHYUEls6EPlL5U1LS5wplFcJuc01PsWCDTVxYbJLkKvCc4SRlkPCglUe0QcAktNGs_0_14s921mQ-kwygG-gX7zzgfCSF5SkL9GrteBjkreODswuFcX7FDYD', ' ', ' ', ' ', ' ', ' ', '1', '2019-05-13 00:00:00', NULL),
(19, 'Mukesh Sharma', ' ', '9811587227', 'OTP', 'feiCAalhbcM:APA91bH4kRd2846Eb0XjdcjvGyS0LZGEauHe06ES4yCoHbZ5Q_w8tr3Bx6mkp3L_LTeoTNnqFaKJHUnGnNsPB5t9Do-E6st_UHBthpLoPCA5Fyde-5GDlQfVkbML42JVVbzfYoBjju3-', ' ', ' ', ' ', ' ', ' ', '1', '2019-05-16 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcat_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meal_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `subcat_id`, `user_id`, `meal_type`, `amount`, `created_at`, `updated_at`) VALUES
(48, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(49, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(50, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(51, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(52, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(53, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(54, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(55, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(56, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(57, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(58, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(59, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(60, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(61, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(62, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(63, '3', '16', 'Lunch and Dinner', '1500', '2019-05-16 00:00:00', NULL),
(67, '2', '16', 'Lunch and Dinner', '1290', '2019-05-16 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=yes,1=no',
  `cat_logo` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_org` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_fake` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ratings` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `image`, `delete_status`, `cat_logo`, `price_org`, `price_fake`, `description`, `ratings`, `created_at`, `updated_at`) VALUES
(1, 'veg', 'cat_images/1557476813.jpeg', '1', 'logo/vegetarian-food-symbol.png', '36', '60', 'Of all the traditional feasts in India, a thali makes for the perfect assortment of delicious regional dishes on a single platter', '4.4', '2019-05-10 00:00:00', NULL),
(2, 'Non-veg', 'cat_images/1557428707.jpeg', '1', 'logo/nonveg-food-symbol.png', '50', '65', 'Of all the traditional feasts in India, a thali makes for the perfect assortment of delicious regional dishes on a single platter', '4.9', '2019-05-10 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cities` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `cities`, `created_at`, `updated_at`) VALUES
(1, '1', 'noida', '2019-03-22 00:00:00', NULL),
(2, '1', 'ghaziabad', '2019-03-22 00:00:00', NULL),
(3, '2', 'bhopal', '2019-03-22 00:00:00', NULL),
(4, '2', 'indor', '2019-03-22 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `days`, `created_at`, `updated_at`) VALUES
(3, 'Monday', '2019-05-11 07:00:00', '2019-05-11 07:00:00'),
(4, 'Tuesday', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(5, 'Wednesday', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(6, 'Thursday', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(7, 'Friday', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(8, 'Saturday', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(9, 'sunday', '2019-05-14 00:00:00', NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcat_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=yes,1=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subcat_id`, `days`, `products`, `delete_status`, `created_at`, `updated_at`) VALUES
(7, '1', 'Monday', 'Rice', '1', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(8, '1', 'Monday', 'Daal', '1', '2019-05-11 00:00:00', NULL),
(9, '1', 'Monday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(10, '1', 'Monday', 'Mix veg', '1', '2019-05-11 00:00:00', NULL),
(11, '1', 'Monday', 'Aaloo Subzi', '1', '2019-05-11 00:00:00', NULL),
(12, '1', 'Tuesday', 'Rice', '1', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(13, '1', 'Tuesday', 'Daal', '1', '2019-05-11 00:00:00', NULL),
(14, '1', 'Tuesday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(15, '1', 'Tuesday', 'Mix veg', '1', '2019-05-11 00:00:00', NULL),
(16, '1', 'Tuesday', 'Aaloo Subzi', '1', '2019-05-11 00:00:00', NULL),
(17, '1', 'Wednesday', 'Daal', '1', '2019-05-11 00:00:00', NULL),
(18, '1', 'Wednesday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(19, '1', 'Wednesday', 'Mix veg', '1', '2019-05-11 00:00:00', NULL),
(20, '1', 'Wednesday', 'Aaloo Subzi', '1', '2019-05-11 00:00:00', NULL),
(21, '1', 'Wednesday', 'Rice', '1', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(22, '1', 'Friday', 'Daal', '1', '2019-05-11 00:00:00', NULL),
(23, '1', 'Friday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(24, '1', 'Friday', 'Mix veg', '1', '2019-05-11 00:00:00', NULL),
(25, '1', 'Friday', 'Aaloo Subzi', '1', '2019-05-11 00:00:00', NULL),
(26, '1', 'Friday', 'Rice', '1', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(27, '1', 'Saturday', 'Khichdi', '1', '2019-05-11 00:00:00', NULL),
(28, '1', 'Saturday', 'Papad', '1', '2019-05-11 00:00:00', NULL),
(29, '1', 'Saturday', 'Curd', '1', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(30, '2', 'Monday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(31, '2', 'Monday', 'Raajma', '1', '2019-05-11 00:00:00', NULL),
(32, '2', 'Monday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(33, '2', 'Monday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(34, '2', 'Monday', 'Boondi rayta', '1', '2019-05-11 00:00:00', NULL),
(35, '2', 'Tuesday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(36, '2', 'Tuesday', 'Kadi', '1', '2019-05-11 00:00:00', NULL),
(37, '2', 'Tuesday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(38, '2', 'Tuesday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(39, '2', 'Tuesday', 'Boondi rayta', '1', '2019-05-11 00:00:00', NULL),
(40, '2', 'Wednesday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(41, '2', 'Wednesday', 'Matar paneer', '1', '2019-05-11 00:00:00', NULL),
(42, '2', 'Wednesday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(43, '2', 'Wednesday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(44, '2', 'Wednesday', 'Boondi rayta', '1', '2019-05-11 00:00:00', NULL),
(45, '2', 'Thursday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(46, '2', 'Thursday', 'Shahi Paneer', '1', '2019-05-11 00:00:00', NULL),
(47, '2', 'Thursday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(48, '2', 'Thursday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(49, '2', 'Thursday', 'Boondi rayta', '1', '2019-05-11 00:00:00', NULL),
(50, '2', 'Friday', 'Fried Rice', '1', '2019-05-11 00:00:00', NULL),
(56, '2', 'Friday', 'Manchurian', '1', '2019-05-11 00:00:00', NULL),
(57, '2', 'Friday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(58, '2', 'Friday', 'Achaar', '1', '2019-05-11 00:00:00', NULL),
(59, '2', 'Saturday', 'Moong Daal khichdi', '1', '2019-05-11 00:00:00', NULL),
(60, '2', 'Saturday', 'Paapad', '1', '2019-05-11 00:00:00', NULL),
(61, '2', 'Saturday', 'Curd', '1', '2019-05-11 00:00:00', NULL),
(62, '3', 'Monday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(63, '3', 'Monday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(64, '3', 'Monday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(65, '3', 'Monday', 'Eggs curi', '1', '2019-05-11 00:00:00', NULL),
(66, '3', 'Tuesday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(67, '3', 'Tuesday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(68, '3', 'Tuesday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(69, '3', 'Tuesday', 'Eggs curi', '1', '2019-05-11 00:00:00', NULL),
(70, '3', 'Wednesday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(71, '3', 'Wednesday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(72, '3', 'Wednesday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(73, '3', 'Wednesday', 'Fish curi', '1', '2019-05-11 00:00:00', NULL),
(74, '3', 'Thursday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(75, '3', 'Thursday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(76, '3', 'Thursday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(77, '3', 'Thursday', 'Fish curi', '1', '2019-05-11 00:00:00', NULL),
(78, '3', 'Friday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(79, '3', 'Friday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(80, '3', 'Friday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(81, '3', 'Friday', 'Egg curi', '1', '2019-05-11 00:00:00', NULL),
(82, '3', 'Saturday', 'Double egg amulet', '1', '2019-05-11 00:00:00', NULL),
(83, '3', 'Saturday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(84, '3', 'Saturday', 'green sauce', '1', '2019-05-11 00:00:00', NULL),
(86, '4', 'Wednesday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(87, '4', 'Wednesday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(88, '4', 'Wednesday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(89, '4', 'Wednesday', 'chicken', '1', '2019-05-11 00:00:00', NULL),
(90, '4', 'Wednesday', 'Boondi Rayta', '1', '2019-05-11 00:00:00', NULL),
(91, '4', 'Thursday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(92, '4', 'Thursday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(93, '4', 'Thursday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(94, '4', 'Thursday', 'chicken', '1', '2019-05-11 00:00:00', NULL),
(95, '4', 'Thursday', 'Boondi Rayta', '1', '2019-05-11 00:00:00', NULL),
(96, '4', 'Friday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(97, '4', 'Friday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(98, '4', 'Friday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(99, '4', 'Friday', 'Egg curry', '1', '2019-05-11 00:00:00', NULL),
(100, '4', 'Friday', 'Boondi Rayta', '1', '2019-05-11 00:00:00', NULL),
(101, '4', 'Saturday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(102, '4', 'Saturday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(103, '4', 'Saturday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(104, '4', 'Saturday', 'Fish curry', '1', '2019-05-11 00:00:00', NULL),
(105, '4', 'Saturday', 'Boondi Rayta', '1', '2019-05-11 00:00:00', NULL),
(106, '1', 'Thursday', '4 chapati', '1', '2019-05-11 00:00:00', NULL),
(107, '1', 'Thursday', 'Mix veg', '1', '2019-05-11 00:00:00', NULL),
(108, '1', 'Thursday', 'Aaloo Subzi', '1', '2019-05-11 00:00:00', NULL),
(109, '1', 'Thursday', 'Rice', '1', '2019-05-11 00:00:00', '2019-05-11 00:00:00'),
(110, '1', 'Thursday', 'Daal', '1', '2019-05-11 00:00:00', NULL),
(111, '4', 'Monday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(112, '4', 'Monday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(113, '4', 'Monday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(114, '4', 'Monday', 'Egg curry', '1', '2019-05-11 00:00:00', NULL),
(115, '4', 'Monday', 'Boondi Rayta', '1', '2019-05-11 00:00:00', NULL),
(116, '4', 'Tuesday', 'Rice', '1', '2019-05-11 00:00:00', NULL),
(117, '4', 'Tuesday', 'Salad', '1', '2019-05-11 00:00:00', NULL),
(118, '4', 'Tuesday', '2 chapati', '1', '2019-05-11 00:00:00', NULL),
(119, '4', 'Tuesday', 'Fish curry', '1', '2019-05-11 00:00:00', NULL),
(120, '4', 'Tuesday', 'Boondi Rayta', '1', '2019-05-11 00:00:00', NULL),
(121, '6', 'sunday', 'student', '1', '2019-05-14 00:00:00', '2019-05-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promocode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desciption` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_in` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=rs,2=%',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `promocode`, `desciption`, `image`, `discount_amount`, `discount_in`, `created_at`, `updated_at`) VALUES
(1, 'user20', 'sdasaasdas', 'promocode_images/1557581990.png', '20rs', '1', NULL, '2019-05-11 00:00:00'),
(3, '122323', 'hiii', 'promocode_images/1557831221.png', '70', '2', '2019-05-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `referal_codes`
--

CREATE TABLE `referal_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redmeed_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=yes, 1=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referal_codes`
--

INSERT INTO `referal_codes` (`id`, `user_id`, `referal_code`, `redmeed_id`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, '13', 'FOODEE-ID13-10248', NULL, '1', '2019-05-11 00:00:00', NULL),
(2, '16', 'FOODEE-ID16-14809', NULL, '1', '2019-05-13 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `states` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `states`, `created_at`, `updated_at`) VALUES
(1, 'Uttar Pradesh', '2019-03-22 00:00:00', NULL),
(2, 'Madhya Pradesh', '2019-03-21 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_cat_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foodee_price` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=yes,1=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `cat_id`, `sub_cat_name`, `image`, `mrp`, `foodee_price`, `description`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Veg Normal', 'subcat_images/1557474219.jpeg', '60', '36', 'Vegetarian cuisine is based on food that meets vegetarian standards by not including meat and animal tissue products (such as gelatin or animal-derived rennet). ... Traditional foods that have always been vegetarian include cereals, grains, fruits, vegetables, legumes and nuts.', '1', '2019-05-09 07:00:00', '2019-05-10 00:00:00'),
(2, '1', 'Veg Exclusive', 'subcat_images/1557474232.jpeg', '70', '43', 'A dish for special occasions, Malai kofta is the delicious vegetarian alternative to meatballs (in Indian cuisine, koftas are meatballs). Although this recipe may take a bit of time to make, the flavorful and creamy results are worth it—and will please any vegetarian looking for a hearty dish.', '1', '2019-05-09 07:00:00', '2019-05-10 00:00:00'),
(3, '2', 'Non veg Normal', 'subcat_images/1557474244.jpeg', '80', '50', 'The Non-Vegetarian side of Indian cuisine comprises of many juicy, tender delicacies made with eggs, mutton, chicken, fish etc. There is a great variety of meat, poultry and fish dishes in Indian Cuisine, here we have made an effort to present most of the non-vegetarian dishes served as snacks, accompaniments and main dishes like tandoori tikkas, kababs, roshan goshts, butter chicken, biryani and much more.', '1', '2019-05-09 07:00:00', '2019-05-10 00:00:00'),
(4, '2', 'Non-veg Exclusive', 'subcat_images/1557591083.jpeg', '80', '55', 'Biryani is the easiest to prapare as chicken meat is quite easy to handle. Biryani is a word that describes opulence and deliciousness!', '1', '2019-05-09 07:00:00', '2019-05-11 00:00:00'),
(5, '1', 'j', 'subcat_images/1557474308.png', NULL, NULL, NULL, '0', '2019-05-10 00:00:00', '2019-05-10 00:00:00'),
(6, '6', 'noida', 'subcat_images/1557816742.jpeg', '9000', '6000', 'hiiii', '1', '2019-05-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=admin,2=appuser',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kota Tiffin Service', 'kota@gmail.com', '1', NULL, '$2y$10$bIf3ihBNw4OJ4PVlD3R2zuFAKAAamJYrbhdOtWhS/nPYcgOk20D4K', NULL, '2019-04-26 17:23:35', '2019-04-26 17:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `users_delivery_addresses`
--

CREATE TABLE `users_delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dlvry_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_delivery_addresses`
--

INSERT INTO `users_delivery_addresses` (`id`, `user_id`, `dlvry_address`, `created_at`, `updated_at`) VALUES
(3, '13', 'C-260, C Block, Sector 63, Noida, Uttar Pradesh 201307, India', '2019-05-12 00:00:00', NULL),
(4, '13', 'Saharanpur, Uttar Pradesh, India', '2019-05-12 00:00:00', NULL),
(5, '15', 'Vaishali, Ghaziabad, Uttar Pradesh, India', '2019-05-13 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_feedbacks`
--

CREATE TABLE `users_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedbacks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_feedbacks`
--

INSERT INTO `users_feedbacks` (`id`, `user_id`, `product_id`, `feedbacks`, `created_at`, `updated_at`) VALUES
(1, '13', '1', 'Sometimes a situation arises where we want to exit from a loop immediately without waiting to get back to the conditional statement.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dlvry_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dlvry_status` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=order_received,1=out_for_dlvry,2=delivered',
  `dlvry_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=day,2=night,3=daynight',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `order_id`, `user_id`, `product_id`, `invoice_id`, `amount`, `status`, `promo_code`, `dlvry_address`, `dlvry_status`, `dlvry_type`, `created_at`, `updated_at`) VALUES
(2, '1233434', '13', '[\"1\",\"2\",\"3\"]', NULL, '5670', '', '', '', '0', '1', '2019-04-01 07:00:00', NULL),
(3, 'FD137615', '13', '[\"2\",\"3\",\"4\"]', 563, '5624', 'Success', 'NA', 'Near shuka aata chakki\nSaharanpur, Uttar Pradesh, India', '0', '3', '2019-05-12 00:00:00', NULL),
(4, '1233434', '13', '[\"1\",\"2\",\"3\"]', 888, '5670', NULL, 'ta', 'ta', ' ', '3', '2019-05-12 00:00:00', NULL),
(5, 'FD134838', '13', '[\"2\",\"3\",\"4\"]', 287, '5624', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', ' ', '3', '2019-05-12 00:00:00', NULL),
(6, 'FD132499', '13', '[\"2\",\"3\",\"4\"]', 282, '5624', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', ' ', '3', '2019-05-12 00:00:00', NULL),
(7, 'FD131011', '13', '[\"2\",\"3\",\"4\"]', 47, '5624', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', ' ', '3', '2019-05-12 00:00:00', NULL),
(8, 'FD131593', '13', '[\"2\",\"3\",\"4\"]', 784, '5624', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', '0', '3', '2019-05-12 00:00:00', NULL),
(9, 'FD137299', '13', '[\"2\",\"3\",\"4\"]', 356, '5624', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', '0', '3', '2019-05-12 00:00:00', NULL),
(10, 'FD131553', '13', '[\"2\",\"3\",\"4\"]', 256, '5624', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', '0', '3', '2019-05-12 00:00:00', NULL),
(11, 'FD136734', '13', '[\"3\",\"4\"]', 518, '3990', NULL, 'NA', 'Near shuka aata chakki\nRati Ram Marg, Sector 51, Faridabad, Haryana 121001, India', '0', '3', '2019-05-12 00:00:00', NULL),
(12, 'FD158084', '15', '[\"1\"]', 345, '1296', NULL, 'NA', 'Near shuka aata chakki\nVaishali, Ghaziabad, Uttar Pradesh, India', '0', '3', '2019-05-13 00:00:00', NULL),
(13, '1233434', '13', '[\"1\",\"2\",\"3\"]', 684, '5670', 'Cash On Delivery', 'ta', 'ta', '0', '3', '2019-05-14 00:00:00', NULL),
(14, '1233434', '13', '[\"1\",\"2\",\"3\"]', 406, '5670', 'Fail', 'ta', 'ta', ' ', '3', '2019-05-14 00:00:00', NULL),
(15, '1233434', '13', '[\"1\",\"2\",\"3\"]', 671, '5670', 'Cash On Delivery', 'ta', 'ta', '0', '3', '2019-05-14 00:00:00', NULL),
(16, '1233434', '13', '[\"1\",\"2\",\"3\"]', 653, '5670', 'Success', 'ta', 'ta', '0', '3', '2019-05-14 00:00:00', NULL),
(17, '1233434', '13', '[\"1\",\"2\",\"3\"]', 974, '5670', 'Success', 'ta', 'ta', '0', '3', '2019-05-14 00:00:00', NULL),
(18, '1233434', '13', '[\"1\",\"2\",\"3\"]', 284, '5670', 'Success', 'ta', 'ta', '0', '3', '2019-05-14 00:00:00', NULL),
(19, '1233434', '13', '[\"1\",\"2\",\"3\"]', 287, '5670', 'Cash On Delivery', 'ta', 'ta', '0', '3', '2019-05-14 00:00:00', NULL),
(20, '1233434', '13', '[\"1\",\"2\",\"3\"]', 784, '5670', 'Fail', 'ta', 'ta', ' ', '3', '2019-05-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redmeed_id` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` enum('credit','debit') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'credit, debit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appusers`
--
ALTER TABLE `appusers`
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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referal_codes`
--
ALTER TABLE `referal_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_delivery_addresses`
--
ALTER TABLE `users_delivery_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_feedbacks`
--
ALTER TABLE `users_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appusers`
--
ALTER TABLE `appusers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referal_codes`
--
ALTER TABLE `referal_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_delivery_addresses`
--
ALTER TABLE `users_delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_feedbacks`
--
ALTER TABLE `users_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
