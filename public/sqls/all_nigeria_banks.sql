-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2022 at 10:52 AM
-- Server version: 8.0.26
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `city-fare`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Access Bank', '044', NULL, NULL),
(2, 'Citibank', '023', NULL, NULL),
(3, 'Diamond Bank', '063', NULL, NULL),
(4, 'Dynamic Standard Bank', ' ', NULL, NULL),
(5, 'Ecobank Nigeria', '050', NULL, NULL),
(6, 'Fidelity Bank Nigeria', '070', NULL, NULL),
(7, 'First Bank of Nigeria', '011', NULL, NULL),
(8, 'First City Monument Bank', '214', NULL, NULL),
(9, 'Guaranty Trust Bank', '058', NULL, NULL),
(10, 'Heritage Bank Plc', '030', NULL, NULL),
(11, 'Jaiz Bank', '301', NULL, NULL),
(12, 'Keystone Bank Limited', '082', NULL, NULL),
(13, 'Providus Bank Plc', '101', NULL, NULL),
(14, 'Polaris Bank', '076', NULL, NULL),
(15, 'Stanbic IBTC Bank Nigeria Limited', '221', NULL, NULL),
(16, 'Standard Chartered Bank', '068', NULL, NULL),
(17, 'Sterling Bank', '232', NULL, NULL),
(18, 'Suntrust Bank Nigeria Limited', '100', NULL, NULL),
(19, 'Union Bank of Nigeria', '032', NULL, NULL),
(20, 'United Bank for Africa', '033', NULL, NULL),
(21, 'Unity Bank Plc', '215', NULL, NULL),
(22, 'Wema Bank', '035', NULL, NULL),
(23, 'Zenith Bank', '057', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
