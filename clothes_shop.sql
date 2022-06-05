-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 04:31 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothes_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount_products_shown`
--

CREATE TABLE `amount_products_shown` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `default_field` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amount_products_shown`
--

INSERT INTO `amount_products_shown` (`id`, `amount`, `default_field`, `created_at`, `updated_at`) VALUES
(1, 12, 1, '2022-03-02 10:38:43', '2022-03-02 12:57:41'),
(2, 20, 0, '2022-03-02 10:38:43', '2022-03-02 10:38:43'),
(3, 36, 0, '2022-03-02 10:38:43', '2022-03-02 10:38:43'),
(4, 6, 0, '2022-03-02 12:19:52', '2022-03-02 12:19:52'),
(5, 16, 0, '2022-03-02 12:20:12', '2022-03-02 12:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'adidas', '2022-03-01 13:19:03', '2022-03-28 12:03:36'),
(2, 'nike', '2022-03-01 13:19:03', '2022-03-28 12:03:43'),
(3, 'puma', '2022-03-01 13:19:03', '2022-03-28 12:03:46'),
(4, 'rebook', '2022-03-01 13:19:03', '2022-03-28 12:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sneakers', '2022-03-27 10:37:44', '2022-03-27 10:37:44'),
(3, 'sweatshirts', '2022-03-27 16:03:03', '2022-03-28 11:48:33'),
(4, 'sweatpants', '2022-03-27 16:42:03', '2022-03-27 16:42:03'),
(5, 'accessories', '2022-03-27 18:37:30', '2022-03-27 18:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s', '2022-03-27 10:07:23', '2022-03-27 10:07:23'),
(2, 'Women\'s', '2022-03-27 10:07:23', '2022-03-27 10:07:23'),
(3, 'Kids\'', '2022-03-27 10:07:23', '2022-03-27 10:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `experience_review`
--

CREATE TABLE `experience_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(40) NOT NULL,
  `title` varchar(150) NOT NULL,
  `review` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experience_review`
--

INSERT INTO `experience_review` (`id`, `user_id`, `nickname`, `title`, `review`, `created_at`, `updated_at`) VALUES
(5, 5, 'Marc', 'Wonderful service', 'I am very satisfied with service and would choose this company again.', '2022-03-31 18:52:45', '2022-03-31 18:54:24'),
(6, 5, 'Mary', 'Quick and easy to deal with', 'I would recommend this shop for everyone who is looking to buy sports clothes.', '2022-03-31 18:52:45', '2022-04-01 09:23:16'),
(7, 5, 'Roger', 'Great customer experience and quality products', 'Reasonably priced and fast delivery service.', '2022-03-31 18:52:45', '2022-03-31 18:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `image_type_id`, `created_at`, `updated_at`) VALUES
(8, 'revolution_5_1.jpg', NULL, '2022-03-26 20:04:57', '2022-05-28 09:05:22'),
(9, 'revolution_5_2.jpg', NULL, '2022-03-26 20:04:57', '2022-05-28 09:05:22'),
(10, 'revolution_5_3.jpg', NULL, '2022-03-26 20:04:57', '2022-05-28 09:05:22'),
(11, 'AIR_MAX_EXCEE_1.jpg', NULL, '2022-03-26 20:11:35', '2022-05-28 09:05:22'),
(12, 'AIR_MAX_EXCEE_2.jpg', NULL, '2022-03-26 20:11:35', '2022-05-28 09:05:22'),
(13, 'VENTURE_RUNNER_1.jpg', NULL, '2022-03-27 10:48:22', '2022-05-28 09:05:22'),
(14, 'VENTURE_RUNNER_2.jpg', NULL, '2022-03-27 10:48:22', '2022-05-28 09:05:22'),
(15, 'VENTURE_RUNNER_3.jpg', NULL, '2022-03-27 10:48:22', '2022-05-28 09:05:22'),
(16, 'DEFYALLDAY_1.jpg', NULL, '2022-03-27 10:52:13', '2022-05-28 09:05:22'),
(17, 'DEFYALLDAY_2.jpg', NULL, '2022-03-27 10:52:13', '2022-05-28 09:05:22'),
(18, 'DEFYALLDAY_3.jpg', NULL, '2022-03-27 11:04:33', '2022-05-28 09:05:22'),
(19, 'RUN_SWIFT_2_1.jpg', NULL, '2022-03-27 11:07:47', '2022-05-28 09:05:22'),
(20, 'RUN_SWIFT_2_2.jpg', NULL, '2022-03-27 11:07:47', '2022-05-28 09:05:22'),
(21, 'AIR_MAX_AP_1.jpg', NULL, '2022-03-27 11:11:33', '2022-05-28 09:05:22'),
(22, 'AIR_MAX_AP_2.jpg', NULL, '2022-03-27 11:11:33', '2022-05-28 09:05:22'),
(23, 'AIR_MAX_AP_3.jpg', NULL, '2022-03-27 11:11:33', '2022-05-28 09:05:22'),
(24, 'EQ21_RUN_1.jpg', NULL, '2022-03-27 11:14:27', '2022-05-28 09:05:22'),
(25, 'EQ21_RUN_2.jpg', NULL, '2022-03-27 11:14:27', '2022-05-28 09:05:22'),
(26, 'RUNFALCON_2.0_TR_1.jpg', NULL, '2022-03-27 11:16:59', '2022-05-28 09:05:22'),
(27, 'RUNFALCON_2.0_TR_2.jpg', NULL, '2022-03-27 11:16:59', '2022-05-28 09:05:22'),
(28, 'RUNFALCON_2.0_TR_3.jpg', NULL, '2022-03-27 11:16:59', '2022-05-28 09:05:22'),
(29, 'RUNFALCON_2.0_TR_4.jpg', NULL, '2022-03-27 11:16:59', '2022-05-28 09:05:22'),
(30, 'MUNDIAL_TEAM_1.jpg', NULL, '2022-03-27 11:19:56', '2022-05-28 09:05:22'),
(31, 'MUNDIAL_TEAM_2.jpg', NULL, '2022-03-27 11:19:56', '2022-05-28 09:05:22'),
(32, 'STABIL_NEXT_GEN_PRIMEBLUE_M_1.jpg', NULL, '2022-03-27 11:22:07', '2022-05-28 09:05:22'),
(33, 'STABIL_NEXT_GEN_PRIMEBLUE_M_2.jpg', NULL, '2022-03-27 11:22:07', '2022-05-28 09:05:22'),
(34, 'STABIL_NEXT_GEN_PRIMEBLUE_M_3.jpg', NULL, '2022-03-27 11:22:07', '2022-05-28 09:05:22'),
(35, 'VS_PACE_1.jpg', NULL, '2022-03-27 11:24:39', '2022-05-28 09:05:22'),
(36, 'VS_PACE_2.jpg', NULL, '2022-03-27 11:24:39', '2022-05-28 09:05:22'),
(37, 'PUMA_LEADER_VT_SL_1.jpg', NULL, '2022-03-27 11:27:31', '2022-05-28 09:05:22'),
(38, 'PUMA_LEADER_VT_SL_2.jpg', NULL, '2022-03-27 11:27:31', '2022-05-28 09:05:22'),
(39, 'PUMA_LEADER_VT_SL_3.jpg', NULL, '2022-03-27 11:27:31', '2022-05-28 09:05:22'),
(40, 'PUMA_LEADER_VT_SL_4.jpg', NULL, '2022-03-27 11:27:31', '2022-05-28 09:05:22'),
(41, 'ANZARUN_LITE_1.jpg', NULL, '2022-03-27 11:34:14', '2022-05-28 09:05:22'),
(42, 'ANZARUN_LITE_2.jpg', NULL, '2022-03-27 11:34:14', '2022-05-28 09:05:22'),
(43, 'ANZARUN_LITE_3.jpg', NULL, '2022-03-27 11:34:14', '2022-05-28 09:05:22'),
(44, 'ANZARUN_LITE_4.jpg', NULL, '2022-03-27 11:34:14', '2022-05-28 09:05:22'),
(45, 'ANZARUN_LITE_5.jpg', NULL, '2022-03-27 11:34:14', '2022-05-28 09:05:22'),
(46, 'PUMA_TARRENZ_1.jpg', NULL, '2022-03-27 11:36:19', '2022-05-28 09:05:22'),
(47, 'PUMA_TARRENZ_2.jpg', NULL, '2022-03-27 11:36:19', '2022-05-28 09:05:22'),
(48, 'ASTRORIDE_TRAIL_2.0_1.jpg', NULL, '2022-03-27 11:39:55', '2022-05-28 09:05:22'),
(49, 'ASTRORIDE_TRAIL_2.0_2.jpg', NULL, '2022-03-27 11:39:55', '2022-05-28 09:05:22'),
(50, 'ASTRORIDE_TRAIL_2.0_3.jpg', NULL, '2022-03-27 11:39:55', '2022-05-28 09:05:22'),
(51, 'REEBOK_RUNNER_4.0_1.jpg', NULL, '2022-03-27 11:43:10', '2022-05-28 09:05:22'),
(52, 'REEBOK_RUNNER_4.0_2.jpg', NULL, '2022-03-27 11:43:10', '2022-05-28 09:05:22'),
(53, 'REEBOK_RUNNER_4.0_3.jpg', NULL, '2022-03-27 11:43:10', '2022-05-28 09:05:22'),
(54, 'REEBOK_RUNNER_4.0_4.jpg', NULL, '2022-03-27 11:43:10', '2022-05-28 09:05:22'),
(55, 'REEBOK_RUNNER_4.0_5.jpg', NULL, '2022-03-27 11:43:10', '2022-05-28 09:05:22'),
(56, 'ENERGYLUX_2.0_1.jpg', NULL, '2022-03-27 11:47:02', '2022-05-28 09:05:22'),
(57, 'ENERGYLUX_2.0_2.jpg', NULL, '2022-03-27 11:47:02', '2022-05-28 09:05:22'),
(58, 'ENERGYLUX_2.0_3.jpg', NULL, '2022-03-27 11:47:02', '2022-05-28 09:05:22'),
(59, 'ENERGYLUX_2.0_4.jpg', NULL, '2022-03-27 11:47:02', '2022-05-28 09:05:22'),
(60, 'FLEXAGON_FORCE_3.0_1.jpg', NULL, '2022-03-27 11:49:13', '2022-05-28 09:05:22'),
(61, 'FLEXAGON_FORCE_3.0_2.jpg', NULL, '2022-03-27 11:49:13', '2022-05-28 09:05:22'),
(62, 'FLEXAGON_FORCE_3.0_3.jpg', NULL, '2022-03-27 11:49:13', '2022-05-28 09:05:22'),
(63, 'REVOLUTION_6_NN_PRM_1.jpg', NULL, '2022-03-27 11:53:01', '2022-05-28 09:05:22'),
(64, 'REVOLUTION_6_NN_PRM_2.jpg', NULL, '2022-03-27 11:53:01', '2022-05-28 09:05:22'),
(65, 'REVOLUTION_6_NN_PRM_3.jpg', NULL, '2022-03-27 11:53:01', '2022-05-28 09:05:22'),
(66, 'REVOLUTION_6_NN_PRM_4.jpg', NULL, '2022-03-27 11:53:01', '2022-05-28 09:05:22'),
(67, 'AIR_MAX_VG-R_1.jpg', NULL, '2022-03-27 11:55:43', '2022-05-28 09:05:22'),
(68, 'AIR_MAX_VG-R_2.jpg', NULL, '2022-03-27 11:55:43', '2022-05-28 09:05:22'),
(69, 'AIR_MAX_VG-R_3.jpg', NULL, '2022-03-27 11:55:43', '2022-05-28 09:05:22'),
(70, 'AIR_MAX_VG-R_4.jpg', NULL, '2022-03-27 11:55:43', '2022-05-28 09:05:22'),
(71, 'MAX_VOLLEY_1.jpg', NULL, '2022-03-27 11:58:43', '2022-05-28 09:05:22'),
(72, 'MAX_VOLLEY_2.jpg', NULL, '2022-03-27 11:58:43', '2022-05-28 09:05:22'),
(73, 'GRAND_COURT_BASE_1.jpg', NULL, '2022-03-27 12:04:13', '2022-05-28 09:05:22'),
(74, 'GRAND_COURT_BASE_2.jpg', NULL, '2022-03-27 12:04:13', '2022-05-28 09:05:22'),
(75, 'GRAND_COURT_BASE_3.jpg', NULL, '2022-03-27 12:04:13', '2022-05-28 09:05:22'),
(76, 'LFS_ADVANTAGE_1.jpg', NULL, '2022-03-27 15:05:41', '2022-05-28 09:05:22'),
(77, 'LFS_ADVANTAGE_2.jpg', NULL, '2022-03-27 15:05:41', '2022-05-28 09:05:22'),
(78, 'LFS_ADVANTAGE_3.jpg', NULL, '2022-03-27 15:05:41', '2022-05-28 09:05:22'),
(79, 'PUREMOTION_ADAPT_1.jpg', NULL, '2022-03-27 15:08:08', '2022-05-28 09:05:22'),
(80, 'PUREMOTION_ADAPT_2.jpg', NULL, '2022-03-27 15:08:08', '2022-05-28 09:05:22'),
(81, 'PUREMOTION_ADAPT_3.jpg', NULL, '2022-03-27 15:08:08', '2022-05-28 09:05:22'),
(82, 'VIKKY_STACKED_L_1.jpg', NULL, '2022-03-27 15:11:48', '2022-05-28 09:05:22'),
(83, 'VIKKY_STACKED_L_2.jpg', NULL, '2022-03-27 15:11:48', '2022-05-28 09:05:22'),
(84, 'VIKKY_STACKED_L_3.jpg', NULL, '2022-03-27 15:11:48', '2022-05-28 09:05:22'),
(85, 'VIKKY_STACKED_L_4.jpg', NULL, '2022-03-27 15:11:48', '2022-05-28 09:05:22'),
(86, 'VIKKY_PLATFORM_EP_1.jpg', NULL, '2022-03-27 15:13:56', '2022-05-28 09:05:22'),
(87, 'VIKKY_PLATFORM_EP_2.jpg', NULL, '2022-03-27 15:13:56', '2022-05-28 09:05:22'),
(88, 'CARINA_MID_1.jpg', NULL, '2022-03-27 15:15:53', '2022-05-28 09:05:22'),
(89, 'CARINA_MID_2.jpg', NULL, '2022-03-27 15:15:53', '2022-05-28 09:05:22'),
(90, 'CARINA_MID_3.jpg', NULL, '2022-03-27 15:15:53', '2022-05-28 09:05:22'),
(91, 'WORK_N_CUSHION_4.0_1.jpg', NULL, '2022-03-27 15:19:41', '2022-05-28 09:05:22'),
(92, 'WORK_N_CUSHION_4.0_2.jpg', NULL, '2022-03-27 15:19:41', '2022-05-28 09:05:22'),
(93, 'WORK_N_CUSHION_4.0_3.jpg', NULL, '2022-03-27 15:19:41', '2022-05-28 09:05:22'),
(94, 'WORK_N_CUSHION_4.0_4.jpg', NULL, '2022-03-27 15:19:41', '2022-05-28 09:05:22'),
(95, 'ROYAL_GLIDE_RPLDBL_1.jpg', NULL, '2022-03-27 15:22:00', '2022-05-28 09:05:22'),
(96, 'ROYAL_GLIDE_RPLDBL_2.jpg', NULL, '2022-03-27 15:22:00', '2022-05-28 09:05:22'),
(97, 'ROYAL_GLIDE_RPLDBL_3.jpg', NULL, '2022-03-27 15:22:00', '2022-05-28 09:05:22'),
(98, 'LITE_2.0_1.jpg', NULL, '2022-03-27 15:24:24', '2022-05-28 09:05:22'),
(99, 'LITE_2.0_2.jpg', NULL, '2022-03-27 15:24:24', '2022-05-28 09:05:22'),
(100, 'LITE_2.0_3.jpg', NULL, '2022-03-27 15:24:24', '2022-05-28 09:05:22'),
(101, 'LITE_PLUS_2.0_1.jpg', NULL, '2022-03-27 15:26:33', '2022-05-28 09:05:22'),
(102, 'LITE_PLUS_2.0_2.jpg', NULL, '2022-03-27 15:26:33', '2022-05-28 09:05:22'),
(103, 'AIR_MAX_COMMAND_FLEX_1.jpg', NULL, '2022-03-27 15:28:56', '2022-05-28 09:05:22'),
(104, 'AIR_MAX_COMMAND_FLEX_2.jpg', NULL, '2022-03-27 15:28:56', '2022-05-28 09:05:22'),
(105, 'AIR_MAX_COMMAND_FLEX_3.jpg', NULL, '2022-03-27 15:28:56', '2022-05-28 09:05:22'),
(106, 'AIR_MAX_COMMAND_FLEX_4.jpg', NULL, '2022-03-27 15:28:56', '2022-05-28 09:05:22'),
(107, 'AIR_MAX_COMMAND_FLEX_5.jpg', NULL, '2022-03-27 15:28:56', '2022-05-28 09:05:22'),
(108, 'MD_VALIANT_BTV_1.jpg', NULL, '2022-03-27 15:32:24', '2022-05-28 09:05:22'),
(109, 'MD_VALIANT_BTV_2.jpg', NULL, '2022-03-27 15:32:24', '2022-05-28 09:05:22'),
(110, 'MD_VALIANT_BTV_3.jpg', NULL, '2022-03-27 15:32:24', '2022-05-28 09:05:22'),
(111, 'VECTOR_I_1.jpg', NULL, '2022-03-27 15:36:48', '2022-05-28 09:05:22'),
(112, 'VECTOR_I_2.jpg', NULL, '2022-03-27 15:36:48', '2022-05-28 09:05:22'),
(113, 'VECTOR_I_3.jpg', NULL, '2022-03-27 15:36:48', '2022-05-28 09:05:22'),
(114, 'VECTOR_I_4.jpg', NULL, '2022-03-27 15:36:48', '2022-05-28 09:05:22'),
(115, 'DURAMO_SL_I_1.jpg', NULL, '2022-03-27 15:40:02', '2022-05-28 09:05:22'),
(116, 'DURAMO_SL_I_2.jpg', NULL, '2022-03-27 15:40:02', '2022-05-28 09:05:22'),
(117, 'DURAMO_SL_I_3.jpg', NULL, '2022-03-27 15:40:02', '2022-05-28 09:05:22'),
(118, 'DURAMO_SL_I_4.jpg', NULL, '2022-03-27 15:40:02', '2022-05-28 09:05:22'),
(119, 'X-RAY_2_SQUARE_JR_1.jpg', NULL, '2022-03-27 15:51:41', '2022-05-28 09:05:22'),
(120, 'X-RAY_2_SQUARE_JR_2.jpg', NULL, '2022-03-27 15:51:41', '2022-05-28 09:05:22'),
(121, 'X-RAY_2_SQUARE_JR_3.jpg', NULL, '2022-03-27 15:51:41', '2022-05-28 09:05:22'),
(122, 'ROYAL_CLJOG_2_KC_1.jpg', NULL, '2022-03-27 15:54:39', '2022-05-28 09:05:22'),
(123, 'ROYAL_CLJOG_2_KC_2.jpg', NULL, '2022-03-27 15:54:39', '2022-05-28 09:05:22'),
(124, 'ROYAL_CLJOG_2_KC_3.jpg', NULL, '2022-03-27 15:54:39', '2022-05-28 09:05:22'),
(125, 'ROYAL_CLJOG_2_2V_1.jpg', NULL, '2022-03-27 15:58:39', '2022-05-28 09:05:22'),
(126, 'ROYAL_CLJOG_2_2V_2.jpg', NULL, '2022-03-27 15:58:39', '2022-05-28 09:05:22'),
(127, 'ROYAL_CLJOG_2_2V_3.jpg', NULL, '2022-03-27 15:58:39', '2022-05-28 09:05:22'),
(128, 'ROYAL_CLJOG_2_2V_4.jpg', NULL, '2022-03-27 15:58:39', '2022-05-28 09:05:22'),
(129, 'ROYAL_CLJOG_2_2V_5.jpg', NULL, '2022-03-27 15:58:39', '2022-05-28 09:05:22'),
(130, 'MEL_FZ_HD_1.jpg', NULL, '2022-03-27 16:04:16', '2022-05-28 09:05:22'),
(131, 'CAMO_HD_1.jpg', NULL, '2022-03-27 16:06:57', '2022-05-28 09:05:22'),
(132, 'NSW_MODERN_CRW_FLC_HBR_1.jpg', NULL, '2022-03-27 16:08:36', '2022-05-28 09:05:22'),
(133, 'NSW_CLUB_HOODIE_PO_BB_GX_1.jpg', NULL, '2022-03-27 16:09:52', '2022-05-28 09:05:22'),
(134, 'MODERN_SPORTS_FZ_HOODIE_1.jpg', NULL, '2022-03-27 16:11:55', '2022-05-28 09:05:22'),
(135, 'EVOSTRIPE_FZ_HOODIE_1.jpg', NULL, '2022-03-27 16:13:30', '2022-05-28 09:05:22'),
(136, 'EVOSTRIPE_FZ_HOODIE_2.jpg', NULL, '2022-03-27 16:13:30', '2022-05-28 09:05:22'),
(137, 'EVOSTRIPE_HOODIE_1.jpg', NULL, '2022-03-27 16:15:33', '2022-05-28 09:05:22'),
(138, 'EVOSTRIPE_HOODIE_2.jpg', NULL, '2022-03-27 16:15:33', '2022-05-28 09:05:22'),
(139, 'LIN_FT_FZ_HD_1.jpg', NULL, '2022-03-27 16:23:40', '2022-05-28 09:05:22'),
(140, 'FL_HD_OFWHME-AMBLUS_1.jpg', NULL, '2022-03-27 16:25:32', '2022-05-28 09:05:22'),
(141, 'ESSNTL_HOODIE_FZ_FLC_1.jpg', NULL, '2022-03-27 16:27:21', '2022-05-28 09:05:22'),
(142, 'AMPLIFIED_FZ_HOODIE_TR_1.jpg', NULL, '2022-03-27 16:30:00', '2022-05-28 09:05:22'),
(143, 'EVOSTRIPE_FULL-ZIP_HOODIE_1.jpg', NULL, '2022-03-27 16:31:38', '2022-05-28 09:05:22'),
(144, 'EVOSTRIPE_FULL-ZIP_HOODIE_2.jpg', NULL, '2022-03-27 16:31:38', '2022-05-28 09:05:22'),
(145, 'B_CB_FL_C_PT_1.jpg', NULL, '2022-03-27 16:35:24', '2022-05-28 09:05:22'),
(146, 'THRILL_ZIP_PKT_CREW_1.jpg', NULL, '2022-03-27 16:37:21', '2022-05-28 09:05:22'),
(147, 'NSW_ELEVATED_TRIMS_FZ_1.jpg', NULL, '2022-03-27 16:38:42', '2022-05-28 09:05:22'),
(148, 'EVOSTRIPE_FULL-ZIP_HOODIE_B_1.jpg', NULL, '2022-03-27 16:40:39', '2022-05-28 09:05:22'),
(149, 'EVOSTRIPE_FULL-ZIP_HOODIE_B_2.jpg', NULL, '2022-03-27 16:40:39', '2022-05-28 09:05:22'),
(150, 'M_MEL_PT_1.jpg', NULL, '2022-03-27 16:43:32', '2022-05-28 09:05:22'),
(151, 'CORE18_PRE_PNT_1.jpg', NULL, '2022-03-27 16:45:06', '2022-05-28 09:05:22'),
(152, 'NSW_CLUB_JGGR_BB_1.jpg', NULL, '2022-03-27 16:46:43', '2022-05-28 09:05:22'),
(153, 'PNT_KP_FP_JB_1.jpg', NULL, '2022-03-27 16:49:33', '2022-05-28 09:05:22'),
(154, 'CLASSICS_SWEATPANTS_CUFF_TR_1.jpg', NULL, '2022-03-27 16:51:00', '2022-05-28 09:05:22'),
(155, 'MODERN_SPORTS_PANTS_1.jpg', NULL, '2022-03-27 16:52:09', '2022-05-28 09:05:22'),
(156, '3S_FT_C_PT_1.jpg', NULL, '2022-03-27 16:54:21', '2022-05-28 09:05:22'),
(157, '3S_FT_C_PT_2.jpg', NULL, '2022-03-27 16:54:21', '2022-05-28 09:05:22'),
(158, 'W_LIN_FT_C_PT_1.jpg', NULL, '2022-03-27 16:55:59', '2022-05-28 09:05:22'),
(159, 'W_LIN_FT_C_PT_2.jpg', NULL, '2022-03-27 16:55:59', '2022-05-28 09:05:22'),
(160, 'ESSNTL_PANT_REG_FLC_1.jpg', NULL, '2022-03-27 16:57:26', '2022-05-28 09:05:22'),
(161, 'ESSNTL_FLC_MR_JGGR_1.jpg', NULL, '2022-03-27 16:59:10', '2022-05-28 09:05:22'),
(162, 'EVOSTRIPE_PANTS_1.jpg', NULL, '2022-03-27 18:24:20', '2022-05-28 09:05:22'),
(163, 'EVOSTRIPE_PANTS_2.jpg', NULL, '2022-03-27 18:24:20', '2022-05-28 09:05:22'),
(164, 'SWEATPANTS_TR_CL_1.jpg', NULL, '2022-03-27 18:26:37', '2022-05-28 09:05:22'),
(165, 'HBR_FRENCH_TERRY_PANT_1.jpg', NULL, '2022-03-27 18:30:17', '2022-05-28 09:05:22'),
(166, 'HBR_FRENCH_TERRY_PANT_2.jpg', NULL, '2022-03-27 18:30:17', '2022-05-28 09:05:22'),
(167, 'ESS_LOGO_PANTS_TR_CL_B_1.jpg', NULL, '2022-03-27 18:32:57', '2022-05-28 09:05:22'),
(168, 'RUN_BELT_PLUS_1.jpg', NULL, '2022-03-27 18:39:07', '2022-05-28 09:05:22'),
(170, 'NK_BRSLA_M_DUFF_1.jpg', NULL, '2022-03-27 18:46:55', '2022-05-28 09:05:22'),
(171, 'NK_BRSLA_M_DUFF_2.jpg', NULL, '2022-03-27 18:46:55', '2022-05-28 09:05:22'),
(172, 'TECH_SMALL_ITEMS_U_1.jpg', NULL, '2022-03-27 18:52:16', '2022-05-28 09:05:22'),
(173, 'TECH_SMALL_ITEMS_U_2.jpg', NULL, '2022-03-27 18:52:16', '2022-05-28 09:05:22'),
(174, 'PL_NK_STRK_1.jpg', NULL, '2022-03-27 18:56:07', '2022-05-28 09:05:22'),
(175, 'FERRARI_SPTWR_BB_1.jpg', NULL, '2022-03-27 19:00:48', '2022-05-28 09:05:22'),
(176, 'FERRARI_SPTWR_BB_2.jpg', NULL, '2022-03-27 19:00:48', '2022-05-28 09:05:22'),
(177, 'ESS_CLASSIC_CUFFLESS_BEANIE_U_1.jpg', NULL, '2022-03-27 19:02:41', '2022-05-28 09:05:22'),
(178, 'ESS_CLASSIC_CUFFLESS_BEANIE_U_2.jpg', NULL, '2022-03-27 19:02:41', '2022-05-28 09:05:22'),
(179, 'STARLANCER_CLB_1.jpg', NULL, '2022-03-27 19:05:27', '2022-05-28 09:05:22'),
(180, 'React_Miler_1.jpg', NULL, '2022-03-29 12:02:39', '2022-05-28 09:05:22'),
(181, 'React_Miler_2.jpg', NULL, '2022-03-29 12:02:39', '2022-05-28 09:05:22'),
(182, 'React_Miler_3.jpg', NULL, '2022-03-29 12:02:39', '2022-05-28 09:05:22'),
(183, 'React_Miler_4.jpg', NULL, '2022-03-29 12:02:39', '2022-05-28 09:05:22'),
(184, 'React_Miler_5.jpg', NULL, '2022-03-29 12:02:39', '2022-05-28 09:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `image_types`
--

CREATE TABLE `image_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_types`
--

INSERT INTO `image_types` (`id`, `name`) VALUES
(1, 'original'),
(2, 'thumbnail');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `street_adress` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` int(5) NOT NULL,
  `delivery_comment` varchar(200) DEFAULT NULL,
  `payment_method` varchar(20) NOT NULL,
  `order_comment` varchar(200) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `first_name`, `last_name`, `email`, `company`, `phone`, `street_adress`, `city`, `zip`, `delivery_comment`, `payment_method`, `order_comment`, `price`, `status`, `created_at`, `updated_at`) VALUES
(36, 5, 'Mika', 'Mikics', 'mika5@gmail.com', '', '55555555', 'Ulica 2B', 'Beograd', 22222, '', 'credit', '', 670, 3, '2022-04-01 10:25:54', '2022-04-01 10:33:30'),
(42, 5, 'Mika', 'Mikics', 'mika5@gmail.com', '', '55555555', 'Ulica 2B', 'Beograd', 88888, '', 'credit', '', 335, 3, '2022-05-30 09:55:16', '2022-05-31 14:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_product`
--

CREATE TABLE `invoice_product` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_product`
--

INSERT INTO `invoice_product` (`id`, `invoice_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(67, 36, 77, 1, '2022-04-01 10:25:54', '2022-04-01 10:25:54'),
(68, 36, 5, 4, '2022-04-01 10:25:54', '2022-04-01 10:25:54'),
(69, 36, 65, 3, '2022-04-01 10:25:54', '2022-04-01 10:25:54'),
(75, 42, 20, 1, '2022-05-30 09:55:16', '2022-05-30 09:55:16'),
(76, 42, 48, 1, '2022-05-30 09:55:16', '2022-05-30 09:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_status`
--

CREATE TABLE `invoice_status` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `color` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_status`
--

INSERT INTO `invoice_status` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
(1, 'processed', '#000000', '2022-03-19 18:53:28', '2022-03-21 14:43:00'),
(2, 'delivered', '#00be00', '2022-03-19 18:53:28', '2022-03-21 14:42:55'),
(3, 'canceled', '#d22b2b', '2022-03-19 18:53:28', '2022-03-19 18:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-02-08 14:12:07', '2022-02-08 14:12:46'),
(2, 'customer', '2022-02-08 14:12:07', '2022-02-08 14:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `units_sold` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `collection_id`, `brand_id`, `units_sold`, `created_at`, `updated_at`) VALUES
(1, 'REVOLUTION 5', 1, 1, 2, 190, '2022-03-01 13:47:04', '2022-03-31 18:19:03'),
(5, 'AIR MAX EXCEE', 1, 1, 2, 256, '2022-03-01 13:47:04', '2022-04-01 10:25:54'),
(17, 'VENTURE RUNNER', 1, 1, 2, 76, '2022-03-27 10:46:48', '2022-03-31 17:57:16'),
(18, 'DEFYALLDAY', 1, 1, 2, 130, '2022-03-27 10:50:25', '2022-03-31 17:45:17'),
(19, 'RUN SWIFT 2', 1, 1, 2, 168, '2022-03-27 11:06:05', '2022-03-31 17:57:16'),
(20, 'AIR MAX AP', 1, 1, 2, 121, '2022-03-27 11:09:51', '2022-05-30 09:55:16'),
(21, 'EQ21 RUN', 1, 1, 1, 121, '2022-03-27 11:13:51', '2022-03-31 17:45:17'),
(22, 'RUNFALCON 2.0 TR', 1, 1, 1, 75, '2022-03-27 11:16:04', '2022-03-31 17:57:16'),
(23, 'MUNDIAL TEAM', 1, 1, 1, 31, '2022-03-27 11:18:57', '2022-03-31 17:50:56'),
(24, 'STABIL NEXT GEN PRIMEBLUE M', 1, 1, 1, 86, '2022-03-27 11:21:18', '2022-03-31 17:57:16'),
(25, 'VS PACE', 1, 1, 1, 85, '2022-03-27 11:24:13', '2022-03-31 17:57:57'),
(26, 'PUMA LEADER VT SL', 1, 1, 3, 63, '2022-03-27 11:26:31', '2022-03-31 17:54:15'),
(27, 'ANZARUN LITE', 1, 1, 3, 190, '2022-03-27 11:32:00', '2022-03-31 17:42:46'),
(28, 'PUMA TARRENZ', 1, 1, 3, 141, '2022-03-27 11:35:44', '2022-03-31 17:54:15'),
(29, 'ASTRORIDE TRAIL 2.0', 1, 1, 4, 43, '2022-03-27 11:39:09', '2022-03-31 17:42:46'),
(30, 'REEBOK RUNNER 4.0', 1, 1, 4, 143, '2022-03-27 11:41:33', '2022-03-31 17:54:15'),
(31, 'ENERGYLUX 2.0', 1, 1, 4, 96, '2022-03-27 11:46:10', '2022-03-31 17:45:17'),
(32, 'FLEXAGON FORCE 3.0', 1, 1, 4, 80, '2022-03-27 11:48:07', '2022-03-31 17:48:18'),
(33, 'REVOLUTION 6 NN PRM', 1, 2, 2, 151, '2022-03-27 11:52:07', '2022-03-31 17:54:15'),
(34, 'AIR MAX VG-R', 1, 2, 2, 140, '2022-03-27 11:54:49', '2022-03-31 17:42:46'),
(35, 'MAX VOLLEY', 1, 2, 2, 121, '2022-03-27 11:58:07', '2022-03-31 17:50:56'),
(36, 'GRAND COURT BASE', 1, 2, 1, 197, '2022-03-27 12:03:38', '2022-03-31 17:48:18'),
(37, 'LFS ADVANTAGE', 1, 2, 1, 164, '2022-03-27 15:04:46', '2022-03-31 17:48:18'),
(38, 'PUREMOTION ADAPT', 1, 2, 1, 97, '2022-03-27 15:06:55', '2022-03-31 17:54:15'),
(40, 'VIKKY STACKED L', 1, 2, 3, 102, '2022-03-27 15:10:32', '2022-03-31 17:57:16'),
(41, 'VIKKY PLATFORM EP', 1, 2, 3, 120, '2022-03-27 15:13:12', '2022-03-31 17:57:16'),
(42, 'CARINA MID', 1, 2, 3, 210, '2022-03-27 15:15:08', '2022-03-31 17:42:46'),
(44, 'WORK N CUSHION 4.0', 1, 2, 4, 67, '2022-03-27 15:18:31', '2022-03-31 17:57:57'),
(45, 'ROYAL GLIDE RPLDBL', 1, 2, 4, 53, '2022-03-27 15:21:14', '2022-03-31 17:54:15'),
(46, 'LITE 2.0', 1, 2, 4, 102, '2022-03-27 15:23:39', '2022-03-31 17:48:18'),
(47, 'LITE PLUS 2.0', 1, 2, 4, 87, '2022-03-27 15:25:59', '2022-03-31 17:50:56'),
(48, 'AIR MAX COMMAND FLEX', 1, 3, 2, 66, '2022-03-27 15:27:55', '2022-05-30 09:55:16'),
(49, 'MD VALIANT BTV', 1, 3, 2, 65, '2022-03-27 15:31:30', '2022-03-31 17:50:56'),
(50, 'VECTOR I', 1, 3, 1, 61, '2022-03-27 15:35:54', '2022-03-31 17:57:16'),
(51, 'DURAMO SL I', 1, 3, 1, 65, '2022-03-27 15:39:00', '2022-03-31 17:45:17'),
(52, 'X-RAY 2 SQUARE JR', 1, 3, 3, 97, '2022-03-27 15:50:33', '2022-03-31 17:57:57'),
(53, 'ROYAL CLJOG 2 KC', 1, 3, 4, 98, '2022-03-27 15:53:28', '2022-03-31 17:54:15'),
(54, 'ROYAL CLJOG 2 2V', 1, 3, 4, 115, '2022-03-27 15:57:11', '2022-03-31 17:54:15'),
(55, 'MEL FZ HD', 3, 1, 1, 160, '2022-03-27 16:03:54', '2022-03-31 17:50:56'),
(56, 'CAMO HD', 3, 1, 1, 130, '2022-03-27 16:06:40', '2022-03-31 17:42:46'),
(57, 'NSW MODERN CRW FLC HBR', 3, 1, 2, 116, '2022-03-27 16:08:12', '2022-03-31 17:50:56'),
(58, 'NSW CLUB HOODIE PO BB GX', 3, 1, 2, 149, '2022-03-27 16:09:28', '2022-03-31 17:50:56'),
(59, 'MODERN SPORTS FZ HOODIE', 3, 1, 3, 63, '2022-03-27 16:11:35', '2022-03-31 17:50:56'),
(60, 'EVOSTRIPE FZ HOODIE', 3, 1, 3, 76, '2022-03-27 16:12:58', '2022-03-31 17:48:18'),
(61, 'EVOSTRIPE HOODIE', 3, 1, 3, 150, '2022-03-27 16:14:49', '2022-03-31 17:48:18'),
(62, 'LIN FT FZ HD', 3, 2, 1, 141, '2022-03-27 16:23:16', '2022-03-31 17:48:18'),
(63, 'FL HD OFWHME/AMBLUS', 3, 2, 1, 132, '2022-03-27 16:25:03', '2022-03-31 17:48:18'),
(64, 'ESSNTL HOODIE FZ FLC', 3, 2, 2, 182, '2022-03-27 16:27:02', '2022-03-31 17:45:17'),
(65, 'AMPLIFIED FZ HOODIE TR', 3, 2, 3, 78, '2022-03-27 16:29:35', '2022-04-01 10:25:54'),
(66, 'EVOSTRIPE FULL-ZIP HOODIE', 3, 2, 3, 220, '2022-03-27 16:30:56', '2022-03-31 17:45:17'),
(67, 'B CB FL C PT', 4, 3, 1, 40, '2022-03-27 16:34:47', '2022-03-31 17:42:46'),
(68, 'THRILL ZIP PKT CREW', 3, 3, 2, 42, '2022-03-27 16:37:04', '2022-03-31 17:57:16'),
(69, 'NSW ELEVATED TRIMS FZ', 3, 3, 2, 67, '2022-03-27 16:38:19', '2022-03-31 17:50:56'),
(70, 'EVOSTRIPE FULL-ZIP HOODIE B', 3, 3, 3, 160, '2022-03-27 16:39:59', '2022-03-31 17:48:18'),
(71, 'M MEL PT', 4, 1, 1, 78, '2022-03-27 16:43:12', '2022-03-31 17:50:56'),
(72, 'CORE18 PRE PNT', 4, 1, 1, 165, '2022-03-27 16:44:40', '2022-03-31 17:45:17'),
(73, 'NSW CLUB JGGR BB', 4, 1, 2, 152, '2022-03-27 16:46:24', '2022-03-31 17:50:56'),
(74, 'PNT KP FP JB', 4, 1, 2, 65, '2022-03-27 16:49:14', '2022-03-31 17:54:15'),
(75, 'CLASSICS SWEATPANTS CUFF TR', 4, 1, 3, 110, '2022-03-27 16:50:40', '2022-03-31 17:45:17'),
(76, 'MODERN SPORTS PANTS', 4, 1, 3, 157, '2022-03-27 16:51:49', '2022-03-31 17:50:56'),
(77, '3S FT C PT', 4, 2, 1, 43, '2022-03-27 16:53:40', '2022-04-01 10:25:54'),
(78, 'W LIN FT C PT', 4, 2, 1, 115, '2022-03-27 16:55:20', '2022-03-31 17:57:57'),
(79, 'ESSNTL PANT REG FLC', 4, 2, 2, 153, '2022-03-27 16:57:42', '2022-03-31 17:45:17'),
(80, 'ESSNTL FLC MR JGGR', 4, 2, 2, 78, '2022-03-27 16:58:50', '2022-03-31 17:45:17'),
(81, 'EVOSTRIPE PANTS', 4, 2, 3, 187, '2022-03-27 18:23:42', '2022-03-31 17:48:18'),
(82, 'SWEATPANTS TR CL', 4, 2, 3, 120, '2022-03-27 18:26:10', '2022-03-31 17:57:16'),
(83, 'HBR FRENCH TERRY PANT', 4, 3, 2, 121, '2022-03-27 18:29:40', '2022-03-31 17:48:18'),
(84, 'ESS LOGO PANTS TR CL B', 4, 3, 3, 100, '2022-03-27 18:32:14', '2022-03-31 17:45:17'),
(86, 'RUN BELT PLUS', 5, NULL, 1, 78, '2022-03-27 18:38:42', '2022-03-31 17:57:16'),
(87, 'STARLANCER CLB', 5, NULL, 1, 48, '2022-03-27 18:41:18', '2022-03-31 17:57:16'),
(88, 'BRSLA M DUFF', 5, NULL, 2, 57, '2022-03-27 18:47:01', '2022-03-31 17:42:46'),
(89, 'TECH SMALL ITEMS U', 5, NULL, 2, 31, '2022-03-27 18:51:33', '2022-03-31 17:57:16'),
(90, 'PL NK STRK', 5, NULL, 2, 43, '2022-03-27 18:56:01', '2022-03-31 17:54:15'),
(91, 'FERRARI SPTWR BB', 5, NULL, 3, 33, '2022-03-27 19:00:44', '2022-03-31 17:48:18'),
(92, 'ESS CLASSIC CUFFLESS BEANIE U', 5, NULL, 3, 64, '2022-03-27 19:02:29', '2022-03-31 17:45:17'),
(93, 'React Miler', 1, 1, 2, 221, '2022-03-29 12:01:14', '2022-03-31 17:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_featured`
--

CREATE TABLE `product_featured` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_featured`
--

INSERT INTO `product_featured` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 93, 'React_Miler_1_transparent.png', '2022-03-29 10:01:25', '2022-03-29 12:13:44'),
(2, 27, 'ANZARUN_LITE_1_transparent.png', '2022-03-29 10:01:25', '2022-03-29 10:40:27'),
(3, 1, 'revolution_5_1_transparent.png', '2022-03-29 10:01:25', '2022-03-29 10:45:33'),
(5, 29, NULL, '2022-03-30 16:51:51', '2022-03-30 16:51:51'),
(6, 23, NULL, '2022-03-30 16:54:18', '2022-03-30 16:54:18'),
(7, 34, NULL, '2022-03-30 16:54:18', '2022-03-30 16:54:18'),
(9, 37, NULL, '2022-03-30 16:54:18', '2022-03-30 16:54:18'),
(10, 46, NULL, '2022-03-30 16:54:18', '2022-03-30 16:54:18'),
(11, 38, NULL, '2022-03-30 16:54:18', '2022-03-30 16:54:18'),
(12, 48, NULL, '2022-03-30 16:56:25', '2022-03-30 16:56:25'),
(13, 68, NULL, '2022-03-30 16:56:25', '2022-03-30 16:56:25'),
(14, 54, NULL, '2022-03-30 16:56:25', '2022-03-30 16:56:25'),
(15, 52, NULL, '2022-03-30 16:56:25', '2022-03-30 16:56:25'),
(16, 67, NULL, '2022-03-30 16:56:25', '2022-03-30 16:56:25'),
(18, 63, NULL, '2022-03-30 19:08:00', '2022-03-30 19:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `main` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_id`, `main`, `created_at`, `updated_at`) VALUES
(21, 1, 8, 1, '2022-03-26 20:06:02', '2022-03-26 20:06:02'),
(22, 1, 9, 0, '2022-03-26 20:06:02', '2022-03-26 20:06:02'),
(23, 1, 10, 0, '2022-03-26 20:06:02', '2022-03-26 20:06:02'),
(24, 5, 11, 1, '2022-03-26 20:12:03', '2022-03-26 20:12:03'),
(25, 5, 12, 0, '2022-03-26 20:12:03', '2022-03-26 20:12:03'),
(26, 17, 13, 1, '2022-03-27 10:49:15', '2022-03-27 10:49:32'),
(27, 17, 14, 0, '2022-03-27 10:49:15', '2022-03-27 10:49:15'),
(28, 17, 15, 0, '2022-03-27 10:49:15', '2022-03-27 10:49:15'),
(29, 18, 16, 1, '2022-03-27 10:52:33', '2022-03-27 10:52:33'),
(30, 18, 17, 0, '2022-03-27 10:52:33', '2022-03-27 10:52:33'),
(31, 18, 18, 0, '2022-03-27 11:04:43', '2022-03-27 11:04:43'),
(32, 19, 19, 1, '2022-03-27 11:08:03', '2022-03-27 11:08:03'),
(33, 19, 20, 0, '2022-03-27 11:08:03', '2022-03-27 11:08:03'),
(34, 20, 21, 1, '2022-03-27 11:11:58', '2022-03-27 11:11:58'),
(35, 20, 22, 0, '2022-03-27 11:11:58', '2022-03-27 11:11:58'),
(36, 20, 23, 0, '2022-03-27 11:11:58', '2022-03-27 11:11:58'),
(37, 21, 24, 1, '2022-03-27 11:14:49', '2022-03-27 11:14:49'),
(38, 21, 25, 0, '2022-03-27 11:14:49', '2022-03-27 11:14:49'),
(39, 22, 26, 1, '2022-03-27 11:17:38', '2022-03-27 11:17:38'),
(40, 22, 27, 0, '2022-03-27 11:17:38', '2022-03-27 11:17:38'),
(41, 22, 28, 0, '2022-03-27 11:17:38', '2022-03-27 11:17:38'),
(42, 22, 29, 0, '2022-03-27 11:17:38', '2022-03-27 11:17:38'),
(43, 23, 30, 1, '2022-03-27 11:20:12', '2022-03-27 11:20:12'),
(44, 23, 31, 0, '2022-03-27 11:20:12', '2022-03-27 11:20:12'),
(45, 24, 32, 1, '2022-03-27 11:22:31', '2022-03-27 11:22:31'),
(46, 24, 33, 0, '2022-03-27 11:22:31', '2022-03-27 11:22:31'),
(47, 24, 34, 0, '2022-03-27 11:22:31', '2022-03-27 11:22:31'),
(48, 25, 35, 1, '2022-03-27 11:24:56', '2022-03-27 11:24:56'),
(49, 25, 36, 0, '2022-03-27 11:24:56', '2022-03-27 11:24:56'),
(50, 26, 37, 1, '2022-03-27 11:28:03', '2022-03-27 11:28:03'),
(51, 26, 38, 0, '2022-03-27 11:28:03', '2022-03-27 11:28:03'),
(52, 26, 39, 0, '2022-03-27 11:28:03', '2022-03-27 11:28:03'),
(53, 26, 40, 0, '2022-03-27 11:28:03', '2022-03-27 11:28:03'),
(54, 27, 41, 1, '2022-03-27 11:34:53', '2022-03-27 11:34:53'),
(55, 27, 42, 0, '2022-03-27 11:34:53', '2022-03-27 11:34:53'),
(56, 27, 43, 0, '2022-03-27 11:34:53', '2022-03-27 11:34:53'),
(57, 27, 44, 0, '2022-03-27 11:34:53', '2022-03-27 11:34:53'),
(58, 27, 45, 0, '2022-03-27 11:34:53', '2022-03-27 11:34:53'),
(59, 28, 46, 1, '2022-03-27 11:36:37', '2022-03-27 11:36:37'),
(60, 28, 47, 0, '2022-03-27 11:36:37', '2022-03-27 11:36:37'),
(61, 29, 48, 1, '2022-03-27 11:40:15', '2022-03-27 11:40:15'),
(62, 29, 49, 0, '2022-03-27 11:40:15', '2022-03-27 11:40:15'),
(63, 29, 50, 0, '2022-03-27 11:40:15', '2022-03-27 11:40:15'),
(64, 30, 51, 1, '2022-03-27 11:44:00', '2022-03-27 11:44:00'),
(65, 30, 52, 0, '2022-03-27 11:44:00', '2022-03-27 11:44:00'),
(66, 30, 53, 0, '2022-03-27 11:44:00', '2022-03-27 11:44:00'),
(67, 30, 54, 0, '2022-03-27 11:44:00', '2022-03-27 11:44:00'),
(68, 30, 55, 0, '2022-03-27 11:44:00', '2022-03-27 11:44:00'),
(69, 31, 56, 1, '2022-03-27 11:47:35', '2022-03-27 11:47:35'),
(70, 31, 57, 0, '2022-03-27 11:47:35', '2022-03-27 11:47:35'),
(71, 31, 58, 0, '2022-03-27 11:47:35', '2022-03-27 11:47:35'),
(72, 31, 59, 0, '2022-03-27 11:47:35', '2022-03-27 11:47:35'),
(73, 32, 60, 1, '2022-03-27 11:49:35', '2022-03-27 11:49:35'),
(74, 32, 61, 0, '2022-03-27 11:49:35', '2022-03-27 11:49:35'),
(75, 32, 62, 0, '2022-03-27 11:49:35', '2022-03-27 11:49:35'),
(76, 33, 63, 1, '2022-03-27 11:53:32', '2022-03-27 11:53:32'),
(77, 33, 64, 0, '2022-03-27 11:53:32', '2022-03-27 11:53:32'),
(78, 33, 65, 0, '2022-03-27 11:53:32', '2022-03-27 11:53:32'),
(79, 33, 66, 0, '2022-03-27 11:53:32', '2022-03-27 11:53:32'),
(80, 34, 67, 1, '2022-03-27 11:57:15', '2022-03-27 11:57:15'),
(81, 34, 68, 0, '2022-03-27 11:57:15', '2022-03-27 11:57:15'),
(82, 34, 69, 0, '2022-03-27 11:57:15', '2022-03-27 11:57:15'),
(83, 34, 70, 0, '2022-03-27 11:57:15', '2022-03-27 11:57:15'),
(85, 35, 72, 0, '2022-03-27 11:58:59', '2022-03-27 11:58:59'),
(86, 35, 71, 1, '2022-03-27 12:00:34', '2022-03-27 12:00:34'),
(87, 36, 73, 1, '2022-03-27 12:04:44', '2022-03-27 12:04:44'),
(88, 36, 74, 0, '2022-03-27 12:04:44', '2022-03-27 12:04:44'),
(89, 36, 75, 0, '2022-03-27 12:04:44', '2022-03-27 12:04:44'),
(90, 37, 76, 1, '2022-03-27 15:06:09', '2022-03-27 15:06:09'),
(91, 37, 77, 0, '2022-03-27 15:06:09', '2022-03-27 15:06:09'),
(92, 37, 78, 0, '2022-03-27 15:06:09', '2022-03-27 15:06:09'),
(93, 38, 79, 1, '2022-03-27 15:08:48', '2022-03-27 15:08:48'),
(94, 38, 80, 0, '2022-03-27 15:08:48', '2022-03-27 15:08:48'),
(95, 38, 81, 0, '2022-03-27 15:08:48', '2022-03-27 15:08:48'),
(96, 40, 82, 1, '2022-03-27 15:12:23', '2022-03-27 15:12:23'),
(97, 40, 83, 0, '2022-03-27 15:12:23', '2022-03-27 15:12:23'),
(98, 40, 84, 0, '2022-03-27 15:12:23', '2022-03-27 15:12:23'),
(99, 40, 85, 0, '2022-03-27 15:12:23', '2022-03-27 15:12:23'),
(100, 41, 86, 1, '2022-03-27 15:14:26', '2022-03-27 15:14:26'),
(101, 41, 87, 0, '2022-03-27 15:14:26', '2022-03-27 15:14:26'),
(102, 42, 88, 1, '2022-03-27 15:16:15', '2022-03-27 15:16:15'),
(103, 42, 89, 0, '2022-03-27 15:16:15', '2022-03-27 15:16:15'),
(104, 42, 90, 0, '2022-03-27 15:16:15', '2022-03-27 15:16:15'),
(105, 44, 91, 1, '2022-03-27 15:20:20', '2022-03-27 15:20:20'),
(106, 44, 92, 0, '2022-03-27 15:20:20', '2022-03-27 15:20:20'),
(107, 44, 93, 0, '2022-03-27 15:20:20', '2022-03-27 15:20:20'),
(108, 44, 94, 0, '2022-03-27 15:20:20', '2022-03-27 15:20:20'),
(109, 45, 95, 1, '2022-03-27 15:22:23', '2022-03-27 15:22:23'),
(110, 45, 96, 0, '2022-03-27 15:22:23', '2022-03-27 15:22:23'),
(111, 45, 97, 0, '2022-03-27 15:22:23', '2022-03-27 15:22:23'),
(112, 46, 98, 1, '2022-03-27 15:25:14', '2022-03-27 15:25:14'),
(113, 46, 99, 0, '2022-03-27 15:25:14', '2022-03-27 15:25:14'),
(114, 46, 100, 0, '2022-03-27 15:25:14', '2022-03-27 15:25:14'),
(115, 47, 101, 1, '2022-03-27 15:26:47', '2022-03-27 15:26:47'),
(116, 47, 102, 0, '2022-03-27 15:26:47', '2022-03-27 15:26:47'),
(117, 48, 103, 1, '2022-03-27 15:30:05', '2022-03-27 15:30:05'),
(118, 48, 104, 0, '2022-03-27 15:30:05', '2022-03-27 15:30:05'),
(119, 48, 105, 0, '2022-03-27 15:30:05', '2022-03-27 15:30:05'),
(120, 48, 106, 0, '2022-03-27 15:30:05', '2022-03-27 15:30:05'),
(121, 48, 107, 0, '2022-03-27 15:30:05', '2022-03-27 15:30:05'),
(122, 49, 108, 1, '2022-03-27 15:33:33', '2022-03-27 15:33:33'),
(123, 49, 109, 0, '2022-03-27 15:33:33', '2022-03-27 15:33:33'),
(124, 49, 110, 0, '2022-03-27 15:33:33', '2022-03-27 15:33:33'),
(125, 50, 111, 1, '2022-03-27 15:37:43', '2022-03-27 15:37:43'),
(126, 50, 112, 0, '2022-03-27 15:37:43', '2022-03-27 15:37:43'),
(127, 50, 113, 0, '2022-03-27 15:37:43', '2022-03-27 15:37:43'),
(128, 49, 114, 0, '2022-03-27 15:37:43', '2022-03-27 15:37:43'),
(129, 51, 115, 1, '2022-03-27 15:40:40', '2022-03-27 15:40:40'),
(130, 51, 116, 0, '2022-03-27 15:40:40', '2022-03-27 15:40:40'),
(131, 51, 117, 0, '2022-03-27 15:40:40', '2022-03-27 15:40:40'),
(132, 51, 118, 0, '2022-03-27 15:40:40', '2022-03-27 15:40:40'),
(133, 52, 119, 1, '2022-03-27 15:52:18', '2022-03-27 15:52:18'),
(134, 52, 120, 0, '2022-03-27 15:52:18', '2022-03-27 15:52:18'),
(135, 52, 121, 0, '2022-03-27 15:52:18', '2022-03-27 15:52:18'),
(136, 53, 122, 1, '2022-03-27 15:55:21', '2022-03-27 15:55:21'),
(137, 53, 123, 0, '2022-03-27 15:55:21', '2022-03-27 15:55:21'),
(138, 53, 124, 0, '2022-03-27 15:55:21', '2022-03-27 15:55:21'),
(139, 54, 125, 1, '2022-03-27 15:59:42', '2022-03-27 15:59:42'),
(140, 54, 126, 0, '2022-03-27 15:59:42', '2022-03-27 15:59:42'),
(141, 54, 127, 0, '2022-03-27 15:59:42', '2022-03-27 15:59:42'),
(142, 54, 128, 0, '2022-03-27 15:59:42', '2022-03-27 15:59:42'),
(143, 54, 129, 0, '2022-03-27 15:59:42', '2022-03-27 15:59:42'),
(149, 55, 130, 1, '2022-03-27 16:04:28', '2022-03-27 16:04:28'),
(150, 56, 131, 1, '2022-03-27 16:07:09', '2022-03-27 16:07:09'),
(151, 57, 132, 1, '2022-03-27 16:08:51', '2022-03-27 16:08:51'),
(152, 58, 133, 1, '2022-03-27 16:10:06', '2022-03-27 16:10:06'),
(153, 59, 134, 1, '2022-03-27 16:12:10', '2022-03-27 16:12:10'),
(154, 60, 135, 1, '2022-03-27 16:13:55', '2022-03-27 16:13:55'),
(155, 60, 136, 0, '2022-03-27 16:13:55', '2022-03-27 16:13:55'),
(156, 61, 137, 1, '2022-03-27 16:15:58', '2022-03-27 16:15:58'),
(157, 61, 138, 0, '2022-03-27 16:15:58', '2022-03-27 16:15:58'),
(158, 62, 139, 1, '2022-03-27 16:23:51', '2022-03-27 16:23:51'),
(159, 63, 140, 1, '2022-03-27 16:25:49', '2022-03-27 16:25:49'),
(160, 64, 141, 1, '2022-03-27 16:27:32', '2022-03-27 16:27:32'),
(161, 65, 142, 1, '2022-03-27 16:30:12', '2022-03-27 16:30:12'),
(162, 66, 143, 1, '2022-03-27 16:32:13', '2022-03-27 16:32:13'),
(163, 66, 144, 0, '2022-03-27 16:32:13', '2022-03-27 16:32:13'),
(164, 67, 145, 1, '2022-03-27 16:35:38', '2022-03-27 16:35:38'),
(165, 68, 146, 1, '2022-03-27 16:37:32', '2022-03-27 16:37:32'),
(166, 69, 147, 1, '2022-03-27 16:38:51', '2022-03-27 16:38:51'),
(167, 70, 148, 1, '2022-03-27 16:40:58', '2022-03-27 16:40:58'),
(168, 70, 149, 0, '2022-03-27 16:40:58', '2022-03-27 16:40:58'),
(169, 71, 150, 1, '2022-03-27 16:43:43', '2022-03-27 16:43:43'),
(170, 72, 151, 1, '2022-03-27 16:45:17', '2022-03-27 16:45:17'),
(171, 73, 152, 1, '2022-03-27 16:46:52', '2022-03-27 16:46:52'),
(172, 74, 153, 1, '2022-03-27 16:49:45', '2022-03-27 16:49:45'),
(173, 75, 154, 1, '2022-03-27 16:51:10', '2022-03-27 16:51:10'),
(174, 76, 155, 1, '2022-03-27 16:52:19', '2022-03-27 16:52:19'),
(175, 77, 156, 1, '2022-03-27 16:54:49', '2022-03-27 16:54:49'),
(176, 77, 157, 0, '2022-03-27 16:54:49', '2022-03-27 16:54:49'),
(177, 78, 158, 1, '2022-03-27 16:56:18', '2022-03-27 16:56:18'),
(178, 78, 159, 0, '2022-03-27 16:56:18', '2022-03-27 16:56:18'),
(179, 79, 160, 1, '2022-03-27 16:57:56', '2022-03-27 16:57:56'),
(180, 80, 161, 1, '2022-03-27 16:59:20', '2022-03-27 16:59:20'),
(182, 81, 162, 1, '2022-03-27 18:24:44', '2022-03-27 18:24:44'),
(183, 81, 163, 0, '2022-03-27 18:24:44', '2022-03-27 18:24:44'),
(184, 82, 164, 1, '2022-03-27 18:26:48', '2022-03-27 18:26:48'),
(185, 83, 165, 1, '2022-03-27 18:30:38', '2022-03-27 18:30:38'),
(186, 83, 166, 0, '2022-03-27 18:30:38', '2022-03-27 18:30:38'),
(187, 84, 167, 1, '2022-03-27 18:33:08', '2022-03-27 18:33:08'),
(188, 86, 168, 1, '2022-03-27 18:39:17', '2022-03-27 18:39:17'),
(190, 88, 170, 1, '2022-03-27 18:47:21', '2022-03-27 18:48:50'),
(191, 88, 171, 0, '2022-03-27 18:47:21', '2022-03-27 18:47:21'),
(192, 89, 172, 1, '2022-03-27 18:52:40', '2022-03-27 18:52:40'),
(193, 89, 173, 0, '2022-03-27 18:52:40', '2022-03-27 18:52:40'),
(194, 90, 174, 1, '2022-03-27 18:56:19', '2022-03-27 18:56:19'),
(195, 91, 175, 1, '2022-03-27 19:01:15', '2022-03-27 19:01:15'),
(196, 91, 176, 0, '2022-03-27 19:01:15', '2022-03-27 19:01:15'),
(197, 92, 177, 1, '2022-03-27 19:03:05', '2022-03-27 19:03:05'),
(198, 92, 178, 0, '2022-03-27 19:03:05', '2022-03-27 19:03:05'),
(199, 87, 179, 1, '2022-03-27 19:05:43', '2022-03-27 19:05:43'),
(200, 93, 180, 1, '2022-03-29 12:03:33', '2022-03-29 12:03:33'),
(201, 93, 181, 0, '2022-03-29 12:03:33', '2022-03-29 12:03:33'),
(202, 93, 182, 0, '2022-03-29 12:03:33', '2022-03-29 12:03:33'),
(203, 93, 183, 0, '2022-03-29 12:03:33', '2022-03-29 12:03:33'),
(204, 93, 184, 0, '2022-03-29 12:03:33', '2022-03-29 12:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `current_price` int(11) NOT NULL,
  `old_price` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `current_price`, `old_price`, `created_at`, `updated_at`) VALUES
(33, 1, 50, 70, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(34, 5, 120, 150, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(35, 17, 30, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(36, 18, 60, 65, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(37, 19, 180, 220, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(38, 20, 300, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(39, 21, 135, 150, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(40, 22, 180, 210, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(41, 23, 120, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(42, 24, 60, 70, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(43, 25, 40, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(44, 26, 150, 160, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(45, 27, 120, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(46, 28, 120, 140, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(47, 29, 220, 250, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(48, 30, 30, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(49, 31, 60, 75, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(50, 32, 300, 350, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(51, 33, 50, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(52, 34, 180, 200, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(53, 35, 100, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(54, 36, 50, 55, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(55, 37, 40, 45, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(56, 38, 90, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(57, 40, 45, 60, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(58, 41, 75, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(59, 42, 45, 80, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(60, 44, 135, 170, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(61, 45, 50, 90, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(62, 46, 240, 270, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(63, 47, 140, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(64, 48, 30, 50, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(65, 49, 10, 25, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(66, 50, 30, 35, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(67, 51, 15, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(68, 52, 50, 55, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(69, 53, 20, NULL, '2022-03-28 16:28:18', '2022-03-28 16:28:18'),
(71, 54, 30, 33, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(72, 55, 60, 70, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(73, 56, 50, 53, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(74, 57, 80, 84, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(75, 58, 40, 42, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(76, 59, 80, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(77, 60, 110, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(78, 61, 90, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(79, 62, 54, 65, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(80, 63, 43, 55, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(81, 64, 57, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(82, 65, 25, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(83, 66, 43, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(84, 67, 31, 40, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(85, 68, 15, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(86, 69, 35, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(87, 70, 70, 80, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(88, 71, 30, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(89, 72, 65, NULL, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(90, 73, 49, 55, '2022-03-28 16:37:32', '2022-03-28 16:37:32'),
(91, 74, 45, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(92, 75, 30, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(93, 76, 33, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(94, 77, 110, 125, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(95, 78, 70, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(96, 79, 80, 93, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(97, 80, 30, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(98, 81, 67, 80, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(99, 82, 55, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(100, 83, 68, 81, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(101, 84, 15, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(102, 86, 80, 85, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(103, 87, 135, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(104, 88, 43, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(105, 89, 20, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(106, 90, 38, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(107, 91, 12, NULL, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(108, 92, 21, 28, '2022-03-28 16:41:18', '2022-03-28 16:41:18'),
(109, 93, 260, 310, '2022-03-29 12:03:51', '2022-03-29 12:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nickname` varchar(80) NOT NULL,
  `summary` varchar(100) NOT NULL,
  `review` varchar(200) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `user_id`, `nickname`, `summary`, `review`, `rating`, `product_id`, `created_at`, `updated_at`) VALUES
(7, 5, 'Mika', 'Very good product', 'I am very happy with this product', 4, 93, '2022-04-01 10:03:00', '2022-04-01 10:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `sort_options`
--

CREATE TABLE `sort_options` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `database_alias` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sort_options`
--

INSERT INTO `sort_options` (`id`, `name`, `database_alias`, `created_at`, `updated_at`) VALUES
(1, 'Name', 'productName', '2022-03-09 16:15:39', '2022-03-09 16:15:39'),
(2, 'Price', 'productPrice', '2022-03-09 16:15:39', '2022-03-09 16:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `street_adress` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `privilege` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `city`, `street_adress`, `phone`, `email`, `password`, `privilege`, `created_at`, `updated_at`) VALUES
(5, 'Mika', 'Mikics', 'Beograd', 'Ulica 2B', '55555555', 'mika5@gmail.com', 'f1dc735ee3581693489eaf286088b916', 2, '2022-02-27 17:32:43', '2022-05-31 14:06:31'),
(8, 'Pera', 'Peric', 'Beograd', 'Zdravka Celara 16', '55555555', 'pera@gmail.com', 'f1dc735ee3581693489eaf286088b916', 1, '2022-05-31 15:46:36', '2022-05-31 15:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_page`
--

CREATE TABLE `user_page` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_page`
--

INSERT INTO `user_page` (`id`, `name`, `link`, `icon`, `privilege_id`, `created_at`, `updated_at`) VALUES
(1, 'account', 'user-profile', 'far fa-user-circle', 2, '2022-04-01 13:34:30', '2022-04-01 13:47:33'),
(2, 'orders', 'user-orders', 'far fa-money-bill-alt', 2, '2022-04-01 13:34:30', '2022-04-01 13:47:39'),
(3, 'wish list', 'user-wishlist', 'far fa-heart', 2, '2022-04-01 13:34:30', '2022-04-01 13:47:44'),
(4, 'past reviews', 'user-reviews', 'far fa-comments', 2, '2022-04-01 13:34:30', '2022-04-01 13:57:04'),
(5, 'rate service', 'user-rate-service', 'fas fa-bullhorn', 2, '2022-04-01 13:34:30', '2022-04-01 13:47:55'),
(6, 'main', 'panel-main', 'fa-solid fa-terminal', 1, '2022-05-29 17:45:26', '2022-05-29 17:45:53'),
(7, 'page stats', 'panel-stats', 'fa-solid fa-ranking-star', 1, '2022-05-29 17:45:26', '2022-05-29 17:45:58'),
(8, 'products', 'panel-products', 'fa-solid fa-box', 1, '2022-05-29 17:45:26', '2022-05-29 17:46:16'),
(9, 'insert product', 'panel-add', 'fa-solid fa-plus', 1, '2022-05-29 17:45:26', '2022-05-29 17:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount_products_shown`
--
ALTER TABLE `amount_products_shown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `cart_ibfk_2` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_review`
--
ALTER TABLE `experience_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_type_id` (`image_type_id`);

--
-- Indexes for table `image_types`
--
ALTER TABLE `image_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `invoice_product`
--
ALTER TABLE `invoice_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`,`product_id`),
  ADD KEY `invoice_product_ibfk_2` (`product_id`);

--
-- Indexes for table `invoice_status`
--
ALTER TABLE `invoice_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `collection_id` (`collection_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_featured`
--
ALTER TABLE `product_featured`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sort_options`
--
ALTER TABLE `sort_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privilege` (`privilege`);

--
-- Indexes for table `user_page`
--
ALTER TABLE `user_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amount_products_shown`
--
ALTER TABLE `amount_products_shown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `experience_review`
--
ALTER TABLE `experience_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `image_types`
--
ALTER TABLE `image_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `invoice_product`
--
ALTER TABLE `invoice_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `invoice_status`
--
ALTER TABLE `invoice_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `product_featured`
--
ALTER TABLE `product_featured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sort_options`
--
ALTER TABLE `sort_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_page`
--
ALTER TABLE `user_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`image_type_id`) REFERENCES `image_types` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`status`) REFERENCES `invoice_status` (`id`);

--
-- Constraints for table `invoice_product`
--
ALTER TABLE `invoice_product`
  ADD CONSTRAINT `invoice_product_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `invoice_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`);

--
-- Constraints for table `product_featured`
--
ALTER TABLE `product_featured`
  ADD CONSTRAINT `product_featured_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `product_image_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_price`
--
ALTER TABLE `product_price`
  ADD CONSTRAINT `product_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`privilege`) REFERENCES `privilege` (`id`);

--
-- Constraints for table `user_page`
--
ALTER TABLE `user_page`
  ADD CONSTRAINT `user_page_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
