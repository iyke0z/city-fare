-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2022 at 01:07 PM
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
-- Database: `gabtaxi-gateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` mediumint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numeric_code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso2` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonecode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capital` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tld` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subregion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `emoji` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emojiU` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso3`, `numeric_code`, `iso2`, `phonecode`, `capital`, `currency`, `currency_name`, `currency_symbol`, `tld`, `native`, `region`, `subregion`, `latitude`, `longitude`, `emoji`, `emojiU`, `created_at`, `updated_at`, `flag`) VALUES
(1, 'Afghanistan', 'AFG', '004', 'AF', '93', 'Kabul', 'AFN', 'Afghan afghani', '؋', '.af', 'افغانستان', 'Asia', 'Southern Asia', '33.00000000', '65.00000000', '🇦🇫', 'U+1F1E6 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 12:49:42', 1),
(2, 'Aland Islands', 'ALA', '248', 'AX', '+358-18', 'Mariehamn', 'EUR', 'Euro', '€', '.ax', 'Åland', 'Europe', 'Northern Europe', '60.11666700', '19.90000000', '🇦🇽', 'U+1F1E6 U+1F1FD', '2018-07-20 20:11:03', '2021-12-11 12:56:03', 1),
(3, 'Albania', 'ALB', '008', 'AL', '355', 'Tirana', 'ALL', 'Albanian lek', 'Lek', '.al', 'Shqipëria', 'Europe', 'Southern Europe', '41.00000000', '20.00000000', '🇦🇱', 'U+1F1E6 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 12:50:01', 1),
(4, 'Algeria', 'DZA', '012', 'DZ', '213', 'Algiers', 'DZD', 'Algerian dinar', 'دج', '.dz', 'الجزائر', 'Africa', 'Northern Africa', '28.00000000', '3.00000000', '🇩🇿', 'U+1F1E9 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 12:50:10', 1),
(5, 'American Samoa', 'ASM', '016', 'AS', '+1-684', 'Pago Pago', 'USD', 'US Dollar', '$', '.as', 'American Samoa', 'Oceania', 'Polynesia', '-14.33333333', '-170.00000000', '🇦🇸', 'U+1F1E6 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 12:55:50', 1),
(6, 'Andorra', 'AND', '020', 'AD', '376', 'Andorra la Vella', 'EUR', 'Euro', '€', '.ad', 'Andorra', 'Europe', 'Southern Europe', '42.50000000', '1.50000000', '🇦🇩', 'U+1F1E6 U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 12:50:22', 1),
(7, 'Angola', 'AGO', '024', 'AO', '244', 'Luanda', 'AOA', 'Angolan kwanza', 'Kz', '.ao', 'Angola', 'Africa', 'Middle Africa', '-12.50000000', '18.50000000', '🇦🇴', 'U+1F1E6 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 12:50:31', 1),
(8, 'Anguilla', 'AIA', '660', 'AI', '+1-264', 'The Valley', 'XCD', 'East Caribbean dollar', '$', '.ai', 'Anguilla', 'Americas', 'Caribbean', '18.25000000', '-63.16666666', '🇦🇮', 'U+1F1E6 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 12:50:46', 1),
(9, 'Antarctica', 'ATA', '010', 'AQ', '672', '', 'AAD', 'Antarctican dollar', '$', '.aq', 'Antarctica', 'Polar', '', '-74.65000000', '4.48000000', '🇦🇶', 'U+1F1E6 U+1F1F6', '2018-07-20 20:11:03', '2021-12-11 13:49:17', 1),
(10, 'Antigua And Barbuda', 'ATG', '028', 'AG', '+1-268', 'St. John\'s', 'XCD', 'Eastern Caribbean dollar', '$', '.ag', 'Antigua and Barbuda', 'Americas', 'Caribbean', '17.05000000', '-61.80000000', '🇦🇬', 'U+1F1E6 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 12:56:34', 1),
(11, 'Argentina', 'ARG', '032', 'AR', '54', 'Buenos Aires', 'ARS', 'Argentine peso', '$', '.ar', 'Argentina', 'Americas', 'South America', '-34.00000000', '-64.00000000', '🇦🇷', 'U+1F1E6 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 12:51:01', 1),
(12, 'Armenia', 'ARM', '051', 'AM', '374', 'Yerevan', 'AMD', 'Armenian dram', '֏', '.am', 'Հայաստան', 'Asia', 'Western Asia', '40.00000000', '45.00000000', '🇦🇲', 'U+1F1E6 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 12:51:06', 1),
(13, 'Aruba', 'ABW', '533', 'AW', '297', 'Oranjestad', 'AWG', 'Aruban florin', 'ƒ', '.aw', 'Aruba', 'Americas', 'Caribbean', '12.50000000', '-69.96666666', '🇦🇼', 'U+1F1E6 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 12:56:47', 1),
(14, 'Australia', 'AUS', '036', 'AU', '61', 'Canberra', 'AUD', 'Australian dollar', '$', '.au', 'Australia', 'Oceania', 'Australia and New Zealand', '-27.00000000', '133.00000000', '🇦🇺', 'U+1F1E6 U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 12:51:23', 1),
(15, 'Austria', 'AUT', '040', 'AT', '43', 'Vienna', 'EUR', 'Euro', '€', '.at', 'Österreich', 'Europe', 'Western Europe', '47.33333333', '13.33333333', '🇦🇹', 'U+1F1E6 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 12:51:35', 1),
(16, 'Azerbaijan', 'AZE', '031', 'AZ', '994', 'Baku', 'AZN', 'Azerbaijani manat', 'm', '.az', 'Azərbaycan', 'Asia', 'Western Asia', '40.50000000', '47.50000000', '🇦🇿', 'U+1F1E6 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 12:51:43', 1),
(17, 'Bahamas The', 'BHS', '044', 'BS', '+1-242', 'Nassau', 'BSD', 'Bahamian dollar', 'B$', '.bs', 'Bahamas', 'Americas', 'Caribbean', '24.25000000', '-76.00000000', '🇧🇸', 'U+1F1E7 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 12:51:50', 1),
(18, 'Bahrain', 'BHR', '048', 'BH', '973', 'Manama', 'BHD', 'Bahraini dinar', '.د.ب', '.bh', '‏البحرين', 'Asia', 'Western Asia', '26.00000000', '50.55000000', '🇧🇭', 'U+1F1E7 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 12:51:58', 1),
(19, 'Bangladesh', 'BGD', '050', 'BD', '880', 'Dhaka', 'BDT', 'Bangladeshi taka', '৳', '.bd', 'Bangladesh', 'Asia', 'Southern Asia', '24.00000000', '90.00000000', '🇧🇩', 'U+1F1E7 U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 12:52:04', 1),
(20, 'Barbados', 'BRB', '052', 'BB', '+1-246', 'Bridgetown', 'BBD', 'Barbadian dollar', 'Bds$', '.bb', 'Barbados', 'Americas', 'Caribbean', '13.16666666', '-59.53333333', '🇧🇧', 'U+1F1E7 U+1F1E7', '2018-07-20 20:11:03', '2021-12-11 12:57:03', 1),
(21, 'Belarus', 'BLR', '112', 'BY', '375', 'Minsk', 'BYN', 'Belarusian ruble', 'Br', '.by', 'Белару́сь', 'Europe', 'Eastern Europe', '53.00000000', '28.00000000', '🇧🇾', 'U+1F1E7 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 12:57:09', 1),
(22, 'Belgium', 'BEL', '056', 'BE', '32', 'Brussels', 'EUR', 'Euro', '€', '.be', 'België', 'Europe', 'Western Europe', '50.83333333', '4.00000000', '🇧🇪', 'U+1F1E7 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 12:57:15', 1),
(23, 'Belize', 'BLZ', '084', 'BZ', '501', 'Belmopan', 'BZD', 'Belize dollar', '$', '.bz', 'Belize', 'Americas', 'Central America', '17.25000000', '-88.75000000', '🇧🇿', 'U+1F1E7 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 12:57:21', 1),
(24, 'Benin', 'BEN', '204', 'BJ', '229', 'Porto-Novo', 'XOF', 'West African CFA franc', 'CFA', '.bj', 'Bénin', 'Africa', 'Western Africa', '9.50000000', '2.25000000', '🇧🇯', 'U+1F1E7 U+1F1EF', '2018-07-20 20:11:03', '2021-12-11 12:57:27', 1),
(25, 'Bermuda', 'BMU', '060', 'BM', '+1-441', 'Hamilton', 'BMD', 'Bermudian dollar', '$', '.bm', 'Bermuda', 'Americas', 'Northern America', '32.33333333', '-64.75000000', '🇧🇲', 'U+1F1E7 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 12:57:32', 1),
(26, 'Bhutan', 'BTN', '064', 'BT', '975', 'Thimphu', 'BTN', 'Bhutanese ngultrum', 'Nu.', '.bt', 'ʼbrug-yul', 'Asia', 'Southern Asia', '27.50000000', '90.50000000', '🇧🇹', 'U+1F1E7 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 12:57:38', 1),
(27, 'Bolivia', 'BOL', '068', 'BO', '591', 'Sucre', 'BOB', 'Bolivian boliviano', 'Bs.', '.bo', 'Bolivia', 'Americas', 'South America', '-17.00000000', '-65.00000000', '🇧🇴', 'U+1F1E7 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 12:57:50', 1),
(28, 'Bosnia and Herzegovina', 'BIH', '070', 'BA', '387', 'Sarajevo', 'BAM', 'Bosnia and Herzegovina convertible mark', 'KM', '.ba', 'Bosna i Hercegovina', 'Europe', 'Southern Europe', '44.00000000', '18.00000000', '🇧🇦', 'U+1F1E7 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 12:58:10', 1),
(29, 'Botswana', 'BWA', '072', 'BW', '267', 'Gaborone', 'BWP', 'Botswana pula', 'P', '.bw', 'Botswana', 'Africa', 'Southern Africa', '-22.00000000', '24.00000000', '🇧🇼', 'U+1F1E7 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 12:58:22', 1),
(30, 'Bouvet Island', 'BVT', '074', 'BV', '0055', '', 'NOK', 'Norwegian Krone', 'kr', '.bv', 'Bouvetøya', '', '', '-54.43333333', '3.40000000', '🇧🇻', 'U+1F1E7 U+1F1FB', '2018-07-20 20:11:03', '2021-12-11 13:47:50', 1),
(31, 'Brazil', 'BRA', '076', 'BR', '55', 'Brasilia', 'BRL', 'Brazilian real', 'R$', '.br', 'Brasil', 'Americas', 'South America', '-10.00000000', '-55.00000000', '🇧🇷', 'U+1F1E7 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 12:58:56', 1),
(32, 'British Indian Ocean Territory', 'IOT', '086', 'IO', '246', 'Diego Garcia', 'USD', 'United States dollar', '$', '.io', 'British Indian Ocean Territory', 'Africa', 'Eastern Africa', '-6.00000000', '71.50000000', '🇮🇴', 'U+1F1EE U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 12:59:10', 1),
(33, 'Brunei', 'BRN', '096', 'BN', '673', 'Bandar Seri Begawan', 'BND', 'Brunei dollar', 'B$', '.bn', 'Negara Brunei Darussalam', 'Asia', 'South-Eastern Asia', '4.50000000', '114.66666666', '🇧🇳', 'U+1F1E7 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 12:59:19', 1),
(34, 'Bulgaria', 'BGR', '100', 'BG', '359', 'Sofia', 'BGN', 'Bulgarian lev', 'Лв.', '.bg', 'България', 'Europe', 'Eastern Europe', '43.00000000', '25.00000000', '🇧🇬', 'U+1F1E7 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 12:59:26', 1),
(35, 'Burkina Faso', 'BFA', '854', 'BF', '226', 'Ouagadougou', 'XOF', 'West African CFA franc', 'CFA', '.bf', 'Burkina Faso', 'Africa', 'Western Africa', '13.00000000', '-2.00000000', '🇧🇫', 'U+1F1E7 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 12:59:35', 1),
(36, 'Burundi', 'BDI', '108', 'BI', '257', 'Bujumbura', 'BIF', 'Burundian franc', 'FBu', '.bi', 'Burundi', 'Africa', 'Eastern Africa', '-3.50000000', '30.00000000', '🇧🇮', 'U+1F1E7 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 12:59:42', 1),
(37, 'Cambodia', 'KHM', '116', 'KH', '855', 'Phnom Penh', 'KHR', 'Cambodian riel', 'KHR', '.kh', 'Kâmpŭchéa', 'Asia', 'South-Eastern Asia', '13.00000000', '105.00000000', '🇰🇭', 'U+1F1F0 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 12:59:47', 1),
(38, 'Cameroon', 'CMR', '120', 'CM', '237', 'Yaounde', 'XAF', 'Central African CFA franc', 'FCFA', '.cm', 'Cameroon', 'Africa', 'Middle Africa', '6.00000000', '12.00000000', '🇨🇲', 'U+1F1E8 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 12:59:54', 1),
(39, 'Canada', 'CAN', '124', 'CA', '1', 'Ottawa', 'CAD', 'Canadian dollar', '$', '.ca', 'Canada', 'Americas', 'Northern America', '60.00000000', '-95.00000000', '🇨🇦', 'U+1F1E8 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 12:59:58', 1),
(40, 'Cape Verde', 'CPV', '132', 'CV', '238', 'Praia', 'CVE', 'Cape Verdean escudo', '$', '.cv', 'Cabo Verde', 'Africa', 'Western Africa', '16.00000000', '-24.00000000', '🇨🇻', 'U+1F1E8 U+1F1FB', '2018-07-20 20:11:03', '2021-12-11 13:00:03', 1),
(41, 'Cayman Islands', 'CYM', '136', 'KY', '+1-345', 'George Town', 'KYD', 'Cayman Islands dollar', '$', '.ky', 'Cayman Islands', 'Americas', 'Caribbean', '19.50000000', '-80.50000000', '🇰🇾', 'U+1F1F0 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:00:09', 1),
(42, 'Central African Republic', 'CAF', '140', 'CF', '236', 'Bangui', 'XAF', 'Central African CFA franc', 'FCFA', '.cf', 'Ködörösêse tî Bêafrîka', 'Africa', 'Middle Africa', '7.00000000', '21.00000000', '🇨🇫', 'U+1F1E8 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:00:14', 1),
(43, 'Chad', 'TCD', '148', 'TD', '235', 'N\'Djamena', 'XAF', 'Central African CFA franc', 'FCFA', '.td', 'Tchad', 'Africa', 'Middle Africa', '15.00000000', '19.00000000', '🇹🇩', 'U+1F1F9 U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 13:00:21', 1),
(44, 'Chile', 'CHL', '152', 'CL', '56', 'Santiago', 'CLP', 'Chilean peso', '$', '.cl', 'Chile', 'Americas', 'South America', '-30.00000000', '-71.00000000', '🇨🇱', 'U+1F1E8 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:00:28', 1),
(45, 'China', 'CHN', '156', 'CN', '86', 'Beijing', 'CNY', 'Chinese yuan', '¥', '.cn', '中国', 'Asia', 'Eastern Asia', '35.00000000', '105.00000000', '🇨🇳', 'U+1F1E8 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:00:33', 1),
(46, 'Christmas Island', 'CXR', '162', 'CX', '61', 'Flying Fish Cove', 'AUD', 'Australian dollar', '$', '.cx', 'Christmas Island', 'Oceania', 'Australia and New Zealand', '-10.50000000', '105.66666666', '🇨🇽', 'U+1F1E8 U+1F1FD', '2018-07-20 20:11:03', '2021-12-11 13:48:01', 1),
(47, 'Cocos (Keeling) Islands', 'CCK', '166', 'CC', '61', 'West Island', 'AUD', 'Australian dollar', '$', '.cc', 'Cocos (Keeling) Islands', 'Oceania', 'Australia and New Zealand', '-12.50000000', '96.83333333', '🇨🇨', 'U+1F1E8 U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:48:14', 1),
(48, 'Colombia', 'COL', '170', 'CO', '57', 'Bogota', 'COP', 'Colombian peso', '$', '.co', 'Colombia', 'Americas', 'South America', '4.00000000', '-72.00000000', '🇨🇴', 'U+1F1E8 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:01:00', 1),
(49, 'Comoros', 'COM', '174', 'KM', '269', 'Moroni', 'KMF', 'Comorian franc', 'CF', '.km', 'Komori', 'Africa', 'Eastern Africa', '-12.16666666', '44.25000000', '🇰🇲', 'U+1F1F0 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:00:50', 1),
(50, 'Congo', 'COG', '178', 'CG', '242', 'Brazzaville', 'XAF', 'Central African CFA franc', 'FC', '.cg', 'République du Congo', 'Africa', 'Middle Africa', '-1.00000000', '15.00000000', '🇨🇬', 'U+1F1E8 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:01:09', 1),
(51, 'Democratic Republic of the Congo', 'COD', '180', 'CD', '243', 'Kinshasa', 'CDF', 'Congolese Franc', 'FC', '.cd', 'République démocratique du Congo', 'Africa', 'Middle Africa', '0.00000000', '25.00000000', '🇨🇩', 'U+1F1E8 U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 13:48:42', 1),
(52, 'Cook Islands', 'COK', '184', 'CK', '682', 'Avarua', 'NZD', 'Cook Islands dollar', '$', '.ck', 'Cook Islands', 'Oceania', 'Polynesia', '-21.23333333', '-159.76666666', '🇨🇰', 'U+1F1E8 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:01:15', 1),
(53, 'Costa Rica', 'CRI', '188', 'CR', '506', 'San Jose', 'CRC', 'Costa Rican colón', '₡', '.cr', 'Costa Rica', 'Americas', 'Central America', '10.00000000', '-84.00000000', '🇨🇷', 'U+1F1E8 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:01:20', 1),
(54, 'Cote D\'Ivoire (Ivory Coast)', 'CIV', '384', 'CI', '225', 'Yamoussoukro', 'XOF', 'West African CFA franc', 'CFA', '.ci', NULL, 'Africa', 'Western Africa', '8.00000000', '-5.00000000', '🇨🇮', 'U+1F1E8 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:01:26', 1),
(55, 'Croatia', 'HRV', '191', 'HR', '385', 'Zagreb', 'HRK', 'Croatian kuna', 'kn', '.hr', 'Hrvatska', 'Europe', 'Southern Europe', '45.16666666', '15.50000000', '🇭🇷', 'U+1F1ED U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:01:33', 1),
(56, 'Cuba', 'CUB', '192', 'CU', '53', 'Havana', 'CUP', 'Cuban peso', '$', '.cu', 'Cuba', 'Americas', 'Caribbean', '21.50000000', '-80.00000000', '🇨🇺', 'U+1F1E8 U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:01:39', 1),
(57, 'Cyprus', 'CYP', '196', 'CY', '357', 'Nicosia', 'EUR', 'Euro', '€', '.cy', 'Κύπρος', 'Europe', 'Southern Europe', '35.00000000', '33.00000000', '🇨🇾', 'U+1F1E8 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:01:50', 1),
(58, 'Czech Republic', 'CZE', '203', 'CZ', '420', 'Prague', 'CZK', 'Czech koruna', 'Kč', '.cz', 'Česká republika', 'Europe', 'Eastern Europe', '49.75000000', '15.50000000', '🇨🇿', 'U+1F1E8 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:01:57', 1),
(59, 'Denmark', 'DNK', '208', 'DK', '45', 'Copenhagen', 'DKK', 'Danish krone', 'Kr.', '.dk', 'Danmark', 'Europe', 'Northern Europe', '56.00000000', '10.00000000', '🇩🇰', 'U+1F1E9 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:02:05', 1),
(60, 'Djibouti', 'DJI', '262', 'DJ', '253', 'Djibouti', 'DJF', 'Djiboutian franc', 'Fdj', '.dj', 'Djibouti', 'Africa', 'Eastern Africa', '11.50000000', '43.00000000', '🇩🇯', 'U+1F1E9 U+1F1EF', '2018-07-20 20:11:03', '2021-12-11 13:02:11', 1),
(61, 'Dominica', 'DMA', '212', 'DM', '+1-767', 'Roseau', 'XCD', 'Eastern Caribbean dollar', '$', '.dm', 'Dominica', 'Americas', 'Caribbean', '15.41666666', '-61.33333333', '🇩🇲', 'U+1F1E9 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:02:16', 1),
(62, 'Dominican Republic', 'DOM', '214', 'DO', '+1-809 and 1-829', 'Santo Domingo', 'DOP', 'Dominican peso', '$', '.do', 'República Dominicana', 'Americas', 'Caribbean', '19.00000000', '-70.66666666', '🇩🇴', 'U+1F1E9 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:02:22', 1),
(63, 'East Timor', 'TLS', '626', 'TL', '670', 'Dili', 'USD', 'United States dollar', '$', '.tl', 'Timor-Leste', 'Asia', 'South-Eastern Asia', '-8.83333333', '125.91666666', '🇹🇱', 'U+1F1F9 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:02:27', 1),
(64, 'Ecuador', 'ECU', '218', 'EC', '593', 'Quito', 'USD', 'United States dollar', '$', '.ec', 'Ecuador', 'Americas', 'South America', '-2.00000000', '-77.50000000', '🇪🇨', 'U+1F1EA U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:02:33', 1),
(65, 'Egypt', 'EGY', '818', 'EG', '20', 'Cairo', 'EGP', 'Egyptian pound', 'ج.م', '.eg', 'مصر‎', 'Africa', 'Northern Africa', '27.00000000', '30.00000000', '🇪🇬', 'U+1F1EA U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:02:38', 1),
(66, 'El Salvador', 'SLV', '222', 'SV', '503', 'San Salvador', 'USD', 'United States dollar', '$', '.sv', 'El Salvador', 'Americas', 'Central America', '13.83333333', '-88.91666666', '🇸🇻', 'U+1F1F8 U+1F1FB', '2018-07-20 20:11:03', '2021-12-11 13:02:45', 1),
(67, 'Equatorial Guinea', 'GNQ', '226', 'GQ', '240', 'Malabo', 'XAF', 'Central African CFA franc', 'FCFA', '.gq', 'Guinea Ecuatorial', 'Africa', 'Middle Africa', '2.00000000', '10.00000000', '🇬🇶', 'U+1F1EC U+1F1F6', '2018-07-20 20:11:03', '2021-12-11 13:02:52', 1),
(68, 'Eritrea', 'ERI', '232', 'ER', '291', 'Asmara', 'ERN', 'Eritrean nakfa', 'Nfk', '.er', 'ኤርትራ', 'Africa', 'Eastern Africa', '15.00000000', '39.00000000', '🇪🇷', 'U+1F1EA U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:02:58', 1),
(69, 'Estonia', 'EST', '233', 'EE', '372', 'Tallinn', 'EUR', 'Euro', '€', '.ee', 'Eesti', 'Europe', 'Northern Europe', '59.00000000', '26.00000000', '🇪🇪', 'U+1F1EA U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:03:03', 1),
(70, 'Ethiopia', 'ETH', '231', 'ET', '251', 'Addis Ababa', 'ETB', 'Ethiopian birr', 'Nkf', '.et', 'ኢትዮጵያ', 'Africa', 'Eastern Africa', '8.00000000', '38.00000000', '🇪🇹', 'U+1F1EA U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:16:58', 1),
(71, 'Falkland Islands', 'FLK', '238', 'FK', '500', 'Stanley', 'FKP', 'Falkland Islands pound', '£', '.fk', 'Falkland Islands', 'Americas', 'South America', '-51.75000000', '-59.00000000', '🇫🇰', 'U+1F1EB U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:17:05', 1),
(72, 'Faroe Islands', 'FRO', '234', 'FO', '298', 'Torshavn', 'DKK', 'Danish krone', 'Kr.', '.fo', 'Føroyar', 'Europe', 'Northern Europe', '62.00000000', '-7.00000000', '🇫🇴', 'U+1F1EB U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:17:11', 1),
(73, 'Fiji Islands', 'FJI', '242', 'FJ', '679', 'Suva', 'FJD', 'Fijian dollar', 'FJ$', '.fj', 'Fiji', 'Oceania', 'Melanesia', '-18.00000000', '175.00000000', '🇫🇯', 'U+1F1EB U+1F1EF', '2018-07-20 20:11:03', '2021-12-11 13:17:17', 1),
(74, 'Finland', 'FIN', '246', 'FI', '358', 'Helsinki', 'EUR', 'Euro', '€', '.fi', 'Suomi', 'Europe', 'Northern Europe', '64.00000000', '26.00000000', '🇫🇮', 'U+1F1EB U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:17:24', 1),
(75, 'France', 'FRA', '250', 'FR', '33', 'Paris', 'EUR', 'Euro', '€', '.fr', 'France', 'Europe', 'Western Europe', '46.00000000', '2.00000000', '🇫🇷', 'U+1F1EB U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:17:33', 1),
(76, 'French Guiana', 'GUF', '254', 'GF', '594', 'Cayenne', 'EUR', 'Euro', '€', '.gf', 'Guyane française', 'Americas', 'South America', '4.00000000', '-53.00000000', '🇬🇫', 'U+1F1EC U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:18:11', 1),
(77, 'French Polynesia', 'PYF', '258', 'PF', '689', 'Papeete', 'XPF', 'CFP franc', '₣', '.pf', 'Polynésie française', 'Oceania', 'Polynesia', '-15.00000000', '-140.00000000', '🇵🇫', 'U+1F1F5 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:17:54', 1),
(78, 'French Southern Territories', 'ATF', '260', 'TF', '262', 'Port-aux-Francais', 'EUR', 'Euro', '€', '.tf', 'Territoire des Terres australes et antarctiques fr', 'Africa', 'Southern Africa', '-49.25000000', '69.16700000', '🇹🇫', 'U+1F1F9 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:18:34', 1),
(79, 'Gabon', 'GAB', '266', 'GA', '241', 'Libreville', 'XAF', 'Central African CFA franc', 'FCFA', '.ga', 'Gabon', 'Africa', 'Middle Africa', '-1.00000000', '11.75000000', '🇬🇦', 'U+1F1EC U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:18:46', 1),
(80, 'Gambia The', 'GMB', '270', 'GM', '220', 'Banjul', 'GMD', 'Gambian dalasi', 'D', '.gm', 'Gambia', 'Africa', 'Western Africa', '13.46666666', '-16.56666666', '🇬🇲', 'U+1F1EC U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:18:53', 1),
(81, 'Georgia', 'GEO', '268', 'GE', '995', 'Tbilisi', 'GEL', 'Georgian lari', 'ლ', '.ge', 'საქართველო', 'Asia', 'Western Asia', '42.00000000', '43.50000000', '🇬🇪', 'U+1F1EC U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:18:59', 1),
(82, 'Germany', 'DEU', '276', 'DE', '49', 'Berlin', 'EUR', 'Euro', '€', '.de', 'Deutschland', 'Europe', 'Western Europe', '51.00000000', '9.00000000', '🇩🇪', 'U+1F1E9 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:19:06', 1),
(83, 'Ghana', 'GHA', '288', 'GH', '233', 'Accra', 'GHS', 'Ghanaian cedi', 'GH₵', '.gh', 'Ghana', 'Africa', 'Western Africa', '8.00000000', '-2.00000000', '🇬🇭', 'U+1F1EC U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:19:14', 1),
(84, 'Gibraltar', 'GIB', '292', 'GI', '350', 'Gibraltar', 'GIP', 'Gibraltar pound', '£', '.gi', 'Gibraltar', 'Europe', 'Southern Europe', '36.13333333', '-5.35000000', '🇬🇮', 'U+1F1EC U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:19:19', 1),
(85, 'Greece', 'GRC', '300', 'GR', '30', 'Athens', 'EUR', 'Euro', '€', '.gr', 'Ελλάδα', 'Europe', 'Southern Europe', '39.00000000', '22.00000000', '🇬🇷', 'U+1F1EC U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:19:24', 1),
(86, 'Greenland', 'GRL', '304', 'GL', '299', 'Nuuk', 'DKK', 'Danish krone', 'Kr.', '.gl', 'Kalaallit Nunaat', 'Americas', 'Northern America', '72.00000000', '-40.00000000', '🇬🇱', 'U+1F1EC U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:19:31', 1),
(87, 'Grenada', 'GRD', '308', 'GD', '+1-473', 'St. George\'s', 'XCD', 'Eastern Caribbean dollar', '$', '.gd', 'Grenada', 'Americas', 'Caribbean', '12.11666666', '-61.66666666', '🇬🇩', 'U+1F1EC U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 13:19:40', 1),
(88, 'Guadeloupe', 'GLP', '312', 'GP', '590', 'Basse-Terre', 'EUR', 'Euro', '€', '.gp', 'Guadeloupe', 'Americas', 'Caribbean', '16.25000000', '-61.58333300', '🇬🇵', 'U+1F1EC U+1F1F5', '2018-07-20 20:11:03', '2021-12-11 13:21:29', 1),
(89, 'Guam', 'GUM', '316', 'GU', '+1-671', 'Hagatna', 'USD', 'US Dollar', '$', '.gu', 'Guam', 'Oceania', 'Micronesia', '13.46666666', '144.78333333', '🇬🇺', 'U+1F1EC U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:20:50', 1),
(90, 'Guatemala', 'GTM', '320', 'GT', '502', 'Guatemala City', 'GTQ', 'Guatemalan quetzal', 'Q', '.gt', 'Guatemala', 'Americas', 'Central America', '15.50000000', '-90.25000000', '🇬🇹', 'U+1F1EC U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:21:50', 1),
(91, 'Guernsey and Alderney', 'GGY', '831', 'GG', '+44-1481', 'St Peter Port', 'GBP', 'British pound', '£', '.gg', 'Guernsey', 'Europe', 'Northern Europe', '49.46666666', '-2.58333333', '🇬🇬', 'U+1F1EC U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:23:37', 1),
(92, 'Guinea', 'GIN', '324', 'GN', '224', 'Conakry', 'GNF', 'Guinean franc', 'FG', '.gn', 'Guinée', 'Africa', 'Western Africa', '11.00000000', '-10.00000000', '🇬🇳', 'U+1F1EC U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:23:45', 1),
(93, 'Guinea-Bissau', 'GNB', '624', 'GW', '245', 'Bissau', 'XOF', 'West African CFA franc', 'CFA', '.gw', 'Guiné-Bissau', 'Africa', 'Western Africa', '12.00000000', '-15.00000000', '🇬🇼', 'U+1F1EC U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:23:54', 1),
(94, 'Guyana', 'GUY', '328', 'GY', '592', 'Georgetown', 'GYD', 'Guyanese dollar', '$', '.gy', 'Guyana', 'Americas', 'South America', '5.00000000', '-59.00000000', '🇬🇾', 'U+1F1EC U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:24:01', 1),
(95, 'Haiti', 'HTI', '332', 'HT', '509', 'Port-au-Prince', 'HTG', 'Haitian gourde', 'G', '.ht', 'Haïti', 'Americas', 'Caribbean', '19.00000000', '-72.41666666', '🇭🇹', 'U+1F1ED U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:24:06', 1),
(96, 'Heard Island and McDonald Islands', 'HMD', '334', 'HM', '672', '', 'AUD', 'Australian dollar', '$', '.hm', 'Heard Island and McDonald Islands', '', '', '-53.10000000', '72.51666666', '🇭🇲', 'U+1F1ED U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:48:51', 1),
(97, 'Honduras', 'HND', '340', 'HN', '504', 'Tegucigalpa', 'HNL', 'Honduran lempira', 'L', '.hn', 'Honduras', 'Americas', 'Central America', '15.00000000', '-86.50000000', '🇭🇳', 'U+1F1ED U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:24:16', 1),
(98, 'Hong Kong S.A.R.', 'HKG', '344', 'HK', '852', 'Hong Kong', 'HKD', 'Hong Kong dollar', '$', '.hk', '香港', 'Asia', 'Eastern Asia', '22.25000000', '114.16666666', '🇭🇰', 'U+1F1ED U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:24:22', 1),
(99, 'Hungary', 'HUN', '348', 'HU', '36', 'Budapest', 'HUF', 'Hungarian forint', 'Ft', '.hu', 'Magyarország', 'Europe', 'Eastern Europe', '47.00000000', '20.00000000', '🇭🇺', 'U+1F1ED U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:24:30', 1),
(100, 'Iceland', 'ISL', '352', 'IS', '354', 'Reykjavik', 'ISK', 'Icelandic króna', 'kr', '.is', 'Ísland', 'Europe', 'Northern Europe', '65.00000000', '-18.00000000', '🇮🇸', 'U+1F1EE U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:24:35', 1),
(101, 'India', 'IND', '356', 'IN', '91', 'New Delhi', 'INR', 'Indian rupee', '₹', '.in', 'भारत', 'Asia', 'Southern Asia', '20.00000000', '77.00000000', '🇮🇳', 'U+1F1EE U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:24:41', 1),
(102, 'Indonesia', 'IDN', '360', 'ID', '62', 'Jakarta', 'IDR', 'Indonesian rupiah', 'Rp', '.id', 'Indonesia', 'Asia', 'South-Eastern Asia', '-5.00000000', '120.00000000', '🇮🇩', 'U+1F1EE U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 13:24:49', 1),
(103, 'Iran', 'IRN', '364', 'IR', '98', 'Tehran', 'IRR', 'Iranian rial', '﷼', '.ir', 'ایران', 'Asia', 'Southern Asia', '32.00000000', '53.00000000', '🇮🇷', 'U+1F1EE U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:24:54', 1),
(104, 'Iraq', 'IRQ', '368', 'IQ', '964', 'Baghdad', 'IQD', 'Iraqi dinar', 'د.ع', '.iq', 'العراق', 'Asia', 'Western Asia', '33.00000000', '44.00000000', '🇮🇶', 'U+1F1EE U+1F1F6', '2018-07-20 20:11:03', '2021-12-11 13:25:01', 1),
(105, 'Ireland', 'IRL', '372', 'IE', '353', 'Dublin', 'EUR', 'Euro', '€', '.ie', 'Éire', 'Europe', 'Northern Europe', '53.00000000', '-8.00000000', '🇮🇪', 'U+1F1EE U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:25:07', 1),
(106, 'Israel', 'ISR', '376', 'IL', '972', 'Jerusalem', 'ILS', 'Israeli new shekel', '₪', '.il', 'יִשְׂרָאֵל', 'Asia', 'Western Asia', '31.50000000', '34.75000000', '🇮🇱', 'U+1F1EE U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:25:27', 1),
(107, 'Italy', 'ITA', '380', 'IT', '39', 'Rome', 'EUR', 'Euro', '€', '.it', 'Italia', 'Europe', 'Southern Europe', '42.83333333', '12.83333333', '🇮🇹', 'U+1F1EE U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:25:33', 1),
(108, 'Jamaica', 'JAM', '388', 'JM', '+1-876', 'Kingston', 'JMD', 'Jamaican dollar', 'J$', '.jm', 'Jamaica', 'Americas', 'Caribbean', '18.25000000', '-77.50000000', '🇯🇲', 'U+1F1EF U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:25:41', 1),
(109, 'Japan', 'JPN', '392', 'JP', '81', 'Tokyo', 'JPY', 'Japanese yen', '¥', '.jp', '日本', 'Asia', 'Eastern Asia', '36.00000000', '138.00000000', '🇯🇵', 'U+1F1EF U+1F1F5', '2018-07-20 20:11:03', '2021-12-11 13:25:46', 1),
(110, 'Jersey', 'JEY', '832', 'JE', '+44-1534', 'Saint Helier', 'GBP', 'British pound', '£', '.je', 'Jersey', 'Europe', 'Northern Europe', '49.25000000', '-2.16666666', '🇯🇪', 'U+1F1EF U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:25:59', 1),
(111, 'Jordan', 'JOR', '400', 'JO', '962', 'Amman', 'JOD', 'Jordanian dinar', 'ا.د', '.jo', 'الأردن', 'Asia', 'Western Asia', '31.00000000', '36.00000000', '🇯🇴', 'U+1F1EF U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:26:07', 1),
(112, 'Kazakhstan', 'KAZ', '398', 'KZ', '7', 'Astana', 'KZT', 'Kazakhstani tenge', 'лв', '.kz', 'Қазақстан', 'Asia', 'Central Asia', '48.00000000', '68.00000000', '🇰🇿', 'U+1F1F0 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:26:18', 1),
(113, 'Kenya', 'KEN', '404', 'KE', '254', 'Nairobi', 'KES', 'Kenyan shilling', 'KSh', '.ke', 'Kenya', 'Africa', 'Eastern Africa', '1.00000000', '38.00000000', '🇰🇪', 'U+1F1F0 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:26:23', 1),
(114, 'Kiribati', 'KIR', '296', 'KI', '686', 'Tarawa', 'AUD', 'Australian dollar', '$', '.ki', 'Kiribati', 'Oceania', 'Micronesia', '1.41666666', '173.00000000', '🇰🇮', 'U+1F1F0 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:26:30', 1),
(115, 'North Korea', 'PRK', '408', 'KP', '850', 'Pyongyang', 'KPW', 'North Korean Won', '₩', '.kp', '북한', 'Asia', 'Eastern Asia', '40.00000000', '127.00000000', '🇰🇵', 'U+1F1F0 U+1F1F5', '2018-07-20 20:11:03', '2021-12-11 13:35:28', 1),
(116, 'South Korea', 'KOR', '410', 'KR', '82', 'Seoul', 'KRW', 'Won', '₩', '.kr', '대한민국', 'Asia', 'Eastern Asia', '37.00000000', '127.50000000', '🇰🇷', 'U+1F1F0 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:42:11', 1),
(117, 'Kuwait', 'KWT', '414', 'KW', '965', 'Kuwait City', 'KWD', 'Kuwaiti dinar', 'ك.د', '.kw', 'الكويت', 'Asia', 'Western Asia', '29.50000000', '45.75000000', '🇰🇼', 'U+1F1F0 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:26:44', 1),
(118, 'Kyrgyzstan', 'KGZ', '417', 'KG', '996', 'Bishkek', 'KGS', 'Kyrgyzstani som', 'лв', '.kg', 'Кыргызстан', 'Asia', 'Central Asia', '41.00000000', '75.00000000', '🇰🇬', 'U+1F1F0 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:26:49', 1),
(119, 'Laos', 'LAO', '418', 'LA', '856', 'Vientiane', 'LAK', 'Lao kip', '₭', '.la', 'ສປປລາວ', 'Asia', 'South-Eastern Asia', '18.00000000', '105.00000000', '🇱🇦', 'U+1F1F1 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:26:58', 1),
(120, 'Latvia', 'LVA', '428', 'LV', '371', 'Riga', 'EUR', 'Euro', '€', '.lv', 'Latvija', 'Europe', 'Northern Europe', '57.00000000', '25.00000000', '🇱🇻', 'U+1F1F1 U+1F1FB', '2018-07-20 20:11:03', '2021-12-11 13:27:04', 1),
(121, 'Lebanon', 'LBN', '422', 'LB', '961', 'Beirut', 'LBP', 'Lebanese pound', '£', '.lb', 'لبنان', 'Asia', 'Western Asia', '33.83333333', '35.83333333', '🇱🇧', 'U+1F1F1 U+1F1E7', '2018-07-20 20:11:03', '2021-12-11 13:27:10', 1),
(122, 'Lesotho', 'LSO', '426', 'LS', '266', 'Maseru', 'LSL', 'Lesotho loti', 'L', '.ls', 'Lesotho', 'Africa', 'Southern Africa', '-29.50000000', '28.50000000', '🇱🇸', 'U+1F1F1 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:27:27', 1),
(123, 'Liberia', 'LBR', '430', 'LR', '231', 'Monrovia', 'LRD', 'Liberian dollar', '$', '.lr', 'Liberia', 'Africa', 'Western Africa', '6.50000000', '-9.50000000', '🇱🇷', 'U+1F1F1 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:27:33', 1),
(124, 'Libya', 'LBY', '434', 'LY', '218', 'Tripolis', 'LYD', 'Libyan dinar', 'د.ل', '.ly', '‏ليبيا', 'Africa', 'Northern Africa', '25.00000000', '17.00000000', '🇱🇾', 'U+1F1F1 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:27:38', 1),
(125, 'Liechtenstein', 'LIE', '438', 'LI', '423', 'Vaduz', 'CHF', 'Swiss franc', 'CHf', '.li', 'Liechtenstein', 'Europe', 'Western Europe', '47.26666666', '9.53333333', '🇱🇮', 'U+1F1F1 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:27:47', 1),
(126, 'Lithuania', 'LTU', '440', 'LT', '370', 'Vilnius', 'EUR', 'Euro', '€', '.lt', 'Lietuva', 'Europe', 'Northern Europe', '56.00000000', '24.00000000', '🇱🇹', 'U+1F1F1 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:28:00', 1),
(127, 'Luxembourg', 'LUX', '442', 'LU', '352', 'Luxembourg', 'EUR', 'Euro', '€', '.lu', 'Luxembourg', 'Europe', 'Western Europe', '49.75000000', '6.16666666', '🇱🇺', 'U+1F1F1 U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:28:06', 1),
(128, 'Macau S.A.R.', 'MAC', '446', 'MO', '853', 'Macao', 'MOP', 'Macanese pataca', '$', '.mo', '澳門', 'Asia', 'Eastern Asia', '22.16666666', '113.55000000', '🇲🇴', 'U+1F1F2 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:28:15', 1),
(129, 'Macedonia', 'MKD', '807', 'MK', '389', 'Skopje', 'MKD', 'Denar', 'ден', '.mk', 'Северна Македонија', 'Europe', 'Southern Europe', '41.83333333', '22.00000000', '🇲🇰', 'U+1F1F2 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:28:42', 1),
(130, 'Madagascar', 'MDG', '450', 'MG', '261', 'Antananarivo', 'MGA', 'Malagasy ariary', 'Ar', '.mg', 'Madagasikara', 'Africa', 'Eastern Africa', '-20.00000000', '47.00000000', '🇲🇬', 'U+1F1F2 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:28:52', 1),
(131, 'Malawi', 'MWI', '454', 'MW', '265', 'Lilongwe', 'MWK', 'Malawian kwacha', 'MK', '.mw', 'Malawi', 'Africa', 'Eastern Africa', '-13.50000000', '34.00000000', '🇲🇼', 'U+1F1F2 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:29:01', 1),
(132, 'Malaysia', 'MYS', '458', 'MY', '60', 'Kuala Lumpur', 'MYR', 'Malaysian ringgit', 'RM', '.my', 'Malaysia', 'Asia', 'South-Eastern Asia', '2.50000000', '112.50000000', '🇲🇾', 'U+1F1F2 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:29:08', 1),
(133, 'Maldives', 'MDV', '462', 'MV', '960', 'Male', 'MVR', 'Maldivian rufiyaa', 'Rf', '.mv', 'Maldives', 'Asia', 'Southern Asia', '3.25000000', '73.00000000', '🇲🇻', 'U+1F1F2 U+1F1FB', '2018-07-20 20:11:03', '2021-12-11 13:29:15', 1),
(134, 'Mali', 'MLI', '466', 'ML', '223', 'Bamako', 'XOF', 'West African CFA franc', 'CFA', '.ml', 'Mali', 'Africa', 'Western Africa', '17.00000000', '-4.00000000', '🇲🇱', 'U+1F1F2 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:29:20', 1),
(135, 'Malta', 'MLT', '470', 'MT', '356', 'Valletta', 'EUR', 'Euro', '€', '.mt', 'Malta', 'Europe', 'Southern Europe', '35.83333333', '14.58333333', '🇲🇹', 'U+1F1F2 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:29:26', 1),
(136, 'Man (Isle of)', 'IMN', '833', 'IM', '+44-1624', 'Douglas, Isle of Man', 'GBP', 'British pound', '£', '.im', 'Isle of Man', 'Europe', 'Northern Europe', '54.25000000', '-4.50000000', '🇮🇲', 'U+1F1EE U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:29:43', 1),
(137, 'Marshall Islands', 'MHL', '584', 'MH', '692', 'Majuro', 'USD', 'United States dollar', '$', '.mh', 'M̧ajeļ', 'Oceania', 'Micronesia', '9.00000000', '168.00000000', '🇲🇭', 'U+1F1F2 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:30:32', 1),
(138, 'Martinique', 'MTQ', '474', 'MQ', '596', 'Fort-de-France', 'EUR', 'Euro', '€', '.mq', 'Martinique', 'Americas', 'Caribbean', '14.66666700', '-61.00000000', '🇲🇶', 'U+1F1F2 U+1F1F6', '2018-07-20 20:11:03', '2021-12-11 13:30:44', 1),
(139, 'Mauritania', 'MRT', '478', 'MR', '222', 'Nouakchott', 'MRO', 'Mauritanian ouguiya', 'MRU', '.mr', 'موريتانيا', 'Africa', 'Western Africa', '20.00000000', '-12.00000000', '🇲🇷', 'U+1F1F2 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:31:03', 1),
(140, 'Mauritius', 'MUS', '480', 'MU', '230', 'Port Louis', 'MUR', 'Mauritian rupee', '₨', '.mu', 'Maurice', 'Africa', 'Eastern Africa', '-20.28333333', '57.55000000', '🇲🇺', 'U+1F1F2 U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:31:10', 1),
(141, 'Mayotte', 'MYT', '175', 'YT', '262', 'Mamoudzou', 'EUR', 'Euro', '€', '.yt', 'Mayotte', 'Africa', 'Eastern Africa', '-12.83333333', '45.16666666', '🇾🇹', 'U+1F1FE U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:31:15', 1),
(142, 'Mexico', 'MEX', '484', 'MX', '52', 'Mexico City', 'MXN', 'Mexican peso', '$', '.mx', 'México', 'Americas', 'Central America', '23.00000000', '-102.00000000', '🇲🇽', 'U+1F1F2 U+1F1FD', '2018-07-20 20:11:03', '2021-12-11 13:31:23', 1),
(143, 'Micronesia', 'FSM', '583', 'FM', '691', 'Palikir', 'USD', 'United States dollar', '$', '.fm', 'Micronesia', 'Oceania', 'Micronesia', '6.91666666', '158.25000000', '🇫🇲', 'U+1F1EB U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:31:30', 1),
(144, 'Moldova', 'MDA', '498', 'MD', '373', 'Chisinau', 'MDL', 'Moldovan leu', 'L', '.md', 'Moldova', 'Europe', 'Eastern Europe', '47.00000000', '29.00000000', '🇲🇩', 'U+1F1F2 U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 13:31:39', 1),
(145, 'Monaco', 'MCO', '492', 'MC', '377', 'Monaco', 'EUR', 'Euro', '€', '.mc', 'Monaco', 'Europe', 'Western Europe', '43.73333333', '7.40000000', '🇲🇨', 'U+1F1F2 U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:31:44', 1),
(146, 'Mongolia', 'MNG', '496', 'MN', '976', 'Ulan Bator', 'MNT', 'Mongolian tögrög', '₮', '.mn', 'Монгол улс', 'Asia', 'Eastern Asia', '46.00000000', '105.00000000', '🇲🇳', 'U+1F1F2 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:32:45', 1),
(147, 'Montenegro', 'MNE', '499', 'ME', '382', 'Podgorica', 'EUR', 'Euro', '€', '.me', 'Црна Гора', 'Europe', 'Southern Europe', '42.50000000', '19.30000000', '🇲🇪', 'U+1F1F2 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:31:46', 1),
(148, 'Montserrat', 'MSR', '500', 'MS', '+1-664', 'Plymouth', 'XCD', 'Eastern Caribbean dollar', '$', '.ms', 'Montserrat', 'Americas', 'Caribbean', '16.75000000', '-62.20000000', '🇲🇸', 'U+1F1F2 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:32:56', 1),
(149, 'Morocco', 'MAR', '504', 'MA', '212', 'Rabat', 'MAD', 'Moroccan dirham', 'DH', '.ma', 'المغرب', 'Africa', 'Northern Africa', '32.00000000', '-5.00000000', '🇲🇦', 'U+1F1F2 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:33:08', 1),
(150, 'Mozambique', 'MOZ', '508', 'MZ', '258', 'Maputo', 'MZN', 'Mozambican metical', 'MT', '.mz', 'Moçambique', 'Africa', 'Eastern Africa', '-18.25000000', '35.00000000', '🇲🇿', 'U+1F1F2 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:33:19', 1),
(151, 'Myanmar', 'MMR', '104', 'MM', '95', 'Nay Pyi Taw', 'MMK', 'Burmese kyat', 'K', '.mm', 'မြန်မာ', 'Asia', 'South-Eastern Asia', '22.00000000', '98.00000000', '🇲🇲', 'U+1F1F2 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:33:25', 1),
(152, 'Namibia', 'NAM', '516', 'NA', '264', 'Windhoek', 'NAD', 'Namibian dollar', '$', '.na', 'Namibia', 'Africa', 'Southern Africa', '-22.00000000', '17.00000000', '🇳🇦', 'U+1F1F3 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:33:32', 1),
(153, 'Nauru', 'NRU', '520', 'NR', '674', 'Yaren', 'AUD', 'Australian dollar', '$', '.nr', 'Nauru', 'Oceania', 'Micronesia', '-0.53333333', '166.91666666', '🇳🇷', 'U+1F1F3 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:33:37', 1),
(154, 'Nepal', 'NPL', '524', 'NP', '977', 'Kathmandu', 'NPR', 'Nepalese rupee', '₨', '.np', 'नपल', 'Asia', 'Southern Asia', '28.00000000', '84.00000000', '🇳🇵', 'U+1F1F3 U+1F1F5', '2018-07-20 20:11:03', '2021-12-11 13:33:41', 1),
(155, 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'BQ', '599', 'Kralendijk', 'USD', 'United States dollar', '$', '.an', 'Caribisch Nederland', 'Americas', 'Caribbean', '12.15000000', '-68.26666700', '🇧🇶', 'U+1F1E7 U+1F1F6', '2018-07-20 20:11:03', '2021-12-11 12:58:02', 1),
(156, 'Netherlands', 'NLD', '528', 'NL', '31', 'Amsterdam', 'EUR', 'Euro', '€', '.nl', 'Nederland', 'Europe', 'Western Europe', '52.50000000', '5.75000000', '🇳🇱', 'U+1F1F3 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:31:52', 1),
(157, 'New Caledonia', 'NCL', '540', 'NC', '687', 'Noumea', 'XPF', 'CFP franc', '₣', '.nc', 'Nouvelle-Calédonie', 'Oceania', 'Melanesia', '-21.50000000', '165.50000000', '🇳🇨', 'U+1F1F3 U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:34:11', 1),
(158, 'New Zealand', 'NZL', '554', 'NZ', '64', 'Wellington', 'NZD', 'New Zealand dollar', '$', '.nz', 'New Zealand', 'Oceania', 'Australia and New Zealand', '-41.00000000', '174.00000000', '🇳🇿', 'U+1F1F3 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:34:18', 1),
(159, 'Nicaragua', 'NIC', '558', 'NI', '505', 'Managua', 'NIO', 'Nicaraguan córdoba', 'C$', '.ni', 'Nicaragua', 'Americas', 'Central America', '13.00000000', '-85.00000000', '🇳🇮', 'U+1F1F3 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:34:25', 1),
(160, 'Niger', 'NER', '562', 'NE', '227', 'Niamey', 'XOF', 'West African CFA franc', 'CFA', '.ne', 'Niger', 'Africa', 'Western Africa', '16.00000000', '8.00000000', '🇳🇪', 'U+1F1F3 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:34:32', 1),
(161, 'Nigeria', 'NGA', '566', 'NG', '234', 'Abuja', 'NGN', 'Nigerian naira', '₦', '.ng', 'Nigeria', 'Africa', 'Western Africa', '10.00000000', '8.00000000', '🇳🇬', 'U+1F1F3 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:34:37', 1),
(162, 'Niue', 'NIU', '570', 'NU', '683', 'Alofi', 'NZD', 'New Zealand dollar', '$', '.nu', 'Niuē', 'Oceania', 'Polynesia', '-19.03333333', '-169.86666666', '🇳🇺', 'U+1F1F3 U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:34:42', 1),
(163, 'Norfolk Island', 'NFK', '574', 'NF', '672', 'Kingston', 'AUD', 'Australian dollar', '$', '.nf', 'Norfolk Island', 'Oceania', 'Australia and New Zealand', '-29.03333333', '167.95000000', '🇳🇫', 'U+1F1F3 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:35:39', 1),
(164, 'Northern Mariana Islands', 'MNP', '580', 'MP', '+1-670', 'Saipan', 'USD', 'United States dollar', '$', '.mp', 'Northern Mariana Islands', 'Oceania', 'Micronesia', '15.20000000', '145.75000000', '🇲🇵', 'U+1F1F2 U+1F1F5', '2018-07-20 20:11:03', '2021-12-11 13:35:55', 1),
(165, 'Norway', 'NOR', '578', 'NO', '47', 'Oslo', 'NOK', 'Norwegian krone', 'kr', '.no', 'Norge', 'Europe', 'Northern Europe', '62.00000000', '10.00000000', '🇳🇴', 'U+1F1F3 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:37:57', 1),
(166, 'Oman', 'OMN', '512', 'OM', '968', 'Muscat', 'OMR', 'Omani rial', '.ع.ر', '.om', 'عمان', 'Asia', 'Western Asia', '21.00000000', '57.00000000', '🇴🇲', 'U+1F1F4 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:38:03', 1),
(167, 'Pakistan', 'PAK', '586', 'PK', '92', 'Islamabad', 'PKR', 'Pakistani rupee', '₨', '.pk', 'Pakistan', 'Asia', 'Southern Asia', '30.00000000', '70.00000000', '🇵🇰', 'U+1F1F5 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:38:09', 1),
(168, 'Palau', 'PLW', '585', 'PW', '680', 'Melekeok', 'USD', 'United States dollar', '$', '.pw', 'Palau', 'Oceania', 'Micronesia', '7.50000000', '134.50000000', '🇵🇼', 'U+1F1F5 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:35:58', 1),
(169, 'Palestinian Territory Occupied', 'PSE', '275', 'PS', '970', 'East Jerusalem', 'ILS', 'Israeli new shekel', '₪', '.ps', 'فلسطين', 'Asia', 'Western Asia', '31.90000000', '35.20000000', '🇵🇸', 'U+1F1F5 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:38:16', 1),
(170, 'Panama', 'PAN', '591', 'PA', '507', 'Panama City', 'PAB', 'Panamanian balboa', 'B/.', '.pa', 'Panamá', 'Americas', 'Central America', '9.00000000', '-80.00000000', '🇵🇦', 'U+1F1F5 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:38:22', 1),
(171, 'Papua new Guinea', 'PNG', '598', 'PG', '675', 'Port Moresby', 'PGK', 'Papua New Guinean kina', 'K', '.pg', 'Papua Niugini', 'Oceania', 'Melanesia', '-6.00000000', '147.00000000', '🇵🇬', 'U+1F1F5 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:38:31', 1),
(172, 'Paraguay', 'PRY', '600', 'PY', '595', 'Asuncion', 'PYG', 'Paraguayan guarani', '₲', '.py', 'Paraguay', 'Americas', 'South America', '-23.00000000', '-58.00000000', '🇵🇾', 'U+1F1F5 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:38:49', 1),
(173, 'Peru', 'PER', '604', 'PE', '51', 'Lima', 'PEN', 'Peruvian sol', 'S/.', '.pe', 'Perú', 'Americas', 'South America', '-10.00000000', '-76.00000000', '🇵🇪', 'U+1F1F5 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:38:59', 1),
(174, 'Philippines', 'PHL', '608', 'PH', '63', 'Manila', 'PHP', 'Philippine peso', '₱', '.ph', 'Pilipinas', 'Asia', 'South-Eastern Asia', '13.00000000', '122.00000000', '🇵🇭', 'U+1F1F5 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:39:03', 1),
(175, 'Pitcairn Island', 'PCN', '612', 'PN', '870', 'Adamstown', 'NZD', 'New Zealand dollar', '$', '.pn', 'Pitcairn Islands', 'Oceania', 'Polynesia', '-25.06666666', '-130.10000000', '🇵🇳', 'U+1F1F5 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:39:08', 1),
(176, 'Poland', 'POL', '616', 'PL', '48', 'Warsaw', 'PLN', 'Polish złoty', 'zł', '.pl', 'Polska', 'Europe', 'Eastern Europe', '52.00000000', '20.00000000', '🇵🇱', 'U+1F1F5 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:39:19', 1),
(177, 'Portugal', 'PRT', '620', 'PT', '351', 'Lisbon', 'EUR', 'Euro', '€', '.pt', 'Portugal', 'Europe', 'Southern Europe', '39.50000000', '-8.00000000', '🇵🇹', 'U+1F1F5 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:32:09', 1),
(178, 'Puerto Rico', 'PRI', '630', 'PR', '+1-787 and 1-939', 'San Juan', 'USD', 'United States dollar', '$', '.pr', 'Puerto Rico', 'Americas', 'Caribbean', '18.25000000', '-66.50000000', '🇵🇷', 'U+1F1F5 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:36:02', 1),
(179, 'Qatar', 'QAT', '634', 'QA', '974', 'Doha', 'QAR', 'Qatari riyal', 'ق.ر', '.qa', 'قطر', 'Asia', 'Western Asia', '25.50000000', '51.25000000', '🇶🇦', 'U+1F1F6 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:39:24', 1),
(180, 'Reunion', 'REU', '638', 'RE', '262', 'Saint-Denis', 'EUR', 'Euro', '€', '.re', 'La Réunion', 'Africa', 'Eastern Africa', '-21.15000000', '55.50000000', '🇷🇪', 'U+1F1F7 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:31:59', 1),
(181, 'Romania', 'ROU', '642', 'RO', '40', 'Bucharest', 'RON', 'Romanian leu', 'lei', '.ro', 'România', 'Europe', 'Eastern Europe', '46.00000000', '25.00000000', '🇷🇴', 'U+1F1F7 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:39:31', 1),
(182, 'Russia', 'RUS', '643', 'RU', '7', 'Moscow', 'RUB', 'Russian ruble', '₽', '.ru', 'Россия', 'Europe', 'Eastern Europe', '60.00000000', '100.00000000', '🇷🇺', 'U+1F1F7 U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:39:37', 1),
(183, 'Rwanda', 'RWA', '646', 'RW', '250', 'Kigali', 'RWF', 'Rwandan franc', 'FRw', '.rw', 'Rwanda', 'Africa', 'Eastern Africa', '-2.00000000', '30.00000000', '🇷🇼', 'U+1F1F7 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:39:42', 1),
(184, 'Saint Helena', 'SHN', '654', 'SH', '290', 'Jamestown', 'SHP', 'Saint Helena pound', '£', '.sh', 'Saint Helena', 'Africa', 'Western Africa', '-15.95000000', '-5.70000000', '🇸🇭', 'U+1F1F8 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:39:50', 1),
(185, 'Saint Kitts And Nevis', 'KNA', '659', 'KN', '+1-869', 'Basseterre', 'XCD', 'Eastern Caribbean dollar', '$', '.kn', 'Saint Kitts and Nevis', 'Americas', 'Caribbean', '17.33333333', '-62.75000000', '🇰🇳', 'U+1F1F0 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:39:56', 1),
(186, 'Saint Lucia', 'LCA', '662', 'LC', '+1-758', 'Castries', 'XCD', 'Eastern Caribbean dollar', '$', '.lc', 'Saint Lucia', 'Americas', 'Caribbean', '13.88333333', '-60.96666666', '🇱🇨', 'U+1F1F1 U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:39:58', 1),
(187, 'Saint Pierre and Miquelon', 'SPM', '666', 'PM', '508', 'Saint-Pierre', 'EUR', 'Euro', '€', '.pm', 'Saint-Pierre-et-Miquelon', 'Americas', 'Northern America', '46.83333333', '-56.33333333', '🇵🇲', 'U+1F1F5 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:32:00', 1),
(188, 'Saint Vincent And The Grenadines', 'VCT', '670', 'VC', '+1-784', 'Kingstown', 'XCD', 'Eastern Caribbean dollar', '$', '.vc', 'Saint Vincent and the Grenadines', 'Americas', 'Caribbean', '13.25000000', '-61.20000000', '🇻🇨', 'U+1F1FB U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:39:59', 1),
(189, 'Saint-Barthelemy', 'BLM', '652', 'BL', '590', 'Gustavia', 'EUR', 'Euro', '€', '.bl', 'Saint-Barthélemy', 'Americas', 'Caribbean', '18.50000000', '-63.41666666', '🇧🇱', 'U+1F1E7 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:36:08', 1),
(190, 'Saint-Martin (French part)', 'MAF', '663', 'MF', '590', 'Marigot', 'EUR', 'Euro', '€', '.mf', 'Saint-Martin', 'Americas', 'Caribbean', '18.08333333', '-63.95000000', '🇲🇫', 'U+1F1F2 U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:36:10', 1),
(191, 'Samoa', 'WSM', '882', 'WS', '685', 'Apia', 'WST', 'Samoan tālā', 'SAT', '.ws', 'Samoa', 'Oceania', 'Polynesia', '-13.58333333', '-172.33333333', '🇼🇸', 'U+1F1FC U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:40:07', 1),
(192, 'San Marino', 'SMR', '674', 'SM', '378', 'San Marino', 'EUR', 'Euro', '€', '.sm', 'San Marino', 'Europe', 'Southern Europe', '43.76666666', '12.41666666', '🇸🇲', 'U+1F1F8 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:32:15', 1),
(193, 'Sao Tome and Principe', 'STP', '678', 'ST', '239', 'Sao Tome', 'STD', 'Dobra', 'Db', '.st', 'São Tomé e Príncipe', 'Africa', 'Middle Africa', '1.00000000', '7.00000000', '🇸🇹', 'U+1F1F8 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:40:28', 1),
(194, 'Saudi Arabia', 'SAU', '682', 'SA', '966', 'Riyadh', 'SAR', 'Saudi riyal', '﷼', '.sa', 'المملكة العربية السعودية', 'Asia', 'Western Asia', '25.00000000', '45.00000000', '🇸🇦', 'U+1F1F8 U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:40:44', 1),
(195, 'Senegal', 'SEN', '686', 'SN', '221', 'Dakar', 'XOF', 'West African CFA franc', 'CFA', '.sn', 'Sénégal', 'Africa', 'Western Africa', '14.00000000', '-14.00000000', '🇸🇳', 'U+1F1F8 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:40:50', 1),
(196, 'Serbia', 'SRB', '688', 'RS', '381', 'Belgrade', 'RSD', 'Serbian dinar', 'din', '.rs', 'Србија', 'Europe', 'Southern Europe', '44.00000000', '21.00000000', '🇷🇸', 'U+1F1F7 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:40:55', 1),
(197, 'Seychelles', 'SYC', '690', 'SC', '248', 'Victoria', 'SCR', 'Seychellois rupee', 'SRe', '.sc', 'Seychelles', 'Africa', 'Eastern Africa', '-4.58333333', '55.66666666', '🇸🇨', 'U+1F1F8 U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:41:01', 1),
(198, 'Sierra Leone', 'SLE', '694', 'SL', '232', 'Freetown', 'SLL', 'Sierra Leonean leone', 'Le', '.sl', 'Sierra Leone', 'Africa', 'Western Africa', '8.50000000', '-11.50000000', '🇸🇱', 'U+1F1F8 U+1F1F1', '2018-07-20 20:11:03', '2021-12-11 13:41:06', 1),
(199, 'Singapore', 'SGP', '702', 'SG', '65', 'Singapur', 'SGD', 'Singapore dollar', '$', '.sg', 'Singapore', 'Asia', 'South-Eastern Asia', '1.36666666', '103.80000000', '🇸🇬', 'U+1F1F8 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:41:12', 1),
(200, 'Slovakia', 'SVK', '703', 'SK', '421', 'Bratislava', 'EUR', 'Euro', '€', '.sk', 'Slovensko', 'Europe', 'Eastern Europe', '48.66666666', '19.50000000', '🇸🇰', 'U+1F1F8 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:37:01', 1),
(201, 'Slovenia', 'SVN', '705', 'SI', '386', 'Ljubljana', 'EUR', 'Euro', '€', '.si', 'Slovenija', 'Europe', 'Southern Europe', '46.11666666', '14.81666666', '🇸🇮', 'U+1F1F8 U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:37:05', 1),
(202, 'Solomon Islands', 'SLB', '090', 'SB', '677', 'Honiara', 'SBD', 'Solomon Islands dollar', 'Si$', '.sb', 'Solomon Islands', 'Oceania', 'Melanesia', '-8.00000000', '159.00000000', '🇸🇧', 'U+1F1F8 U+1F1E7', '2018-07-20 20:11:03', '2021-12-11 13:41:36', 1),
(203, 'Somalia', 'SOM', '706', 'SO', '252', 'Mogadishu', 'SOS', 'Somali shilling', 'Sh.so.', '.so', 'Soomaaliya', 'Africa', 'Eastern Africa', '10.00000000', '49.00000000', '🇸🇴', 'U+1F1F8 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:41:41', 1),
(204, 'South Africa', 'ZAF', '710', 'ZA', '27', 'Pretoria', 'ZAR', 'South African rand', 'R', '.za', 'South Africa', 'Africa', 'Southern Africa', '-29.00000000', '24.00000000', '🇿🇦', 'U+1F1FF U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:41:49', 1),
(205, 'South Georgia', 'SGS', '239', 'GS', '500', 'Grytviken', 'GBP', 'British pound', '£', '.gs', 'South Georgia', 'Americas', 'South America', '-54.50000000', '-37.00000000', '🇬🇸', 'U+1F1EC U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:36:45', 1),
(206, 'South Sudan', 'SSD', '728', 'SS', '211', 'Juba', 'SSP', 'South Sudanese pound', '£', '.ss', 'South Sudan', 'Africa', 'Middle Africa', '7.00000000', '30.00000000', '🇸🇸', 'U+1F1F8 U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:42:25', 1);
INSERT INTO `countries` (`id`, `name`, `iso3`, `numeric_code`, `iso2`, `phonecode`, `capital`, `currency`, `currency_name`, `currency_symbol`, `tld`, `native`, `region`, `subregion`, `latitude`, `longitude`, `emoji`, `emojiU`, `created_at`, `updated_at`, `flag`) VALUES
(207, 'Spain', 'ESP', '724', 'ES', '34', 'Madrid', 'EUR', 'Euro', '€', '.es', 'España', 'Europe', 'Southern Europe', '40.00000000', '-4.00000000', '🇪🇸', 'U+1F1EA U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:32:30', 1),
(208, 'Sri Lanka', 'LKA', '144', 'LK', '94', 'Colombo', 'LKR', 'Sri Lankan rupee', 'Rs', '.lk', 'śrī laṃkāva', 'Asia', 'Southern Asia', '7.00000000', '81.00000000', '🇱🇰', 'U+1F1F1 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:42:30', 1),
(209, 'Sudan', 'SDN', '729', 'SD', '249', 'Khartoum', 'SDG', 'Sudanese pound', '.س.ج', '.sd', 'السودان', 'Africa', 'Northern Africa', '15.00000000', '30.00000000', '🇸🇩', 'U+1F1F8 U+1F1E9', '2018-07-20 20:11:03', '2021-12-11 13:42:35', 1),
(210, 'Suriname', 'SUR', '740', 'SR', '597', 'Paramaribo', 'SRD', 'Surinamese dollar', '$', '.sr', 'Suriname', 'Americas', 'South America', '4.00000000', '-56.00000000', '🇸🇷', 'U+1F1F8 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:42:40', 1),
(211, 'Svalbard And Jan Mayen Islands', 'SJM', '744', 'SJ', '47', 'Longyearbyen', 'NOK', 'Norwegian Krone', 'kr', '.sj', 'Svalbard og Jan Mayen', 'Europe', 'Northern Europe', '78.00000000', '20.00000000', '🇸🇯', 'U+1F1F8 U+1F1EF', '2018-07-20 20:11:03', '2021-12-11 13:42:54', 1),
(212, 'Swaziland', 'SWZ', '748', 'SZ', '268', 'Mbabane', 'SZL', 'Lilangeni', 'E', '.sz', 'Swaziland', 'Africa', 'Southern Africa', '-26.50000000', '31.50000000', '🇸🇿', 'U+1F1F8 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:43:12', 1),
(213, 'Sweden', 'SWE', '752', 'SE', '46', 'Stockholm', 'SEK', 'Swedish krona', 'kr', '.se', 'Sverige', 'Europe', 'Northern Europe', '62.00000000', '15.00000000', '🇸🇪', 'U+1F1F8 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:43:24', 1),
(214, 'Switzerland', 'CHE', '756', 'CH', '41', 'Bern', 'CHF', 'Swiss franc', 'CHf', '.ch', 'Schweiz', 'Europe', 'Western Europe', '47.00000000', '8.00000000', '🇨🇭', 'U+1F1E8 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:43:31', 1),
(215, 'Syria', 'SYR', '760', 'SY', '963', 'Damascus', 'SYP', 'Syrian pound', 'LS', '.sy', 'سوريا', 'Asia', 'Western Asia', '35.00000000', '38.00000000', '🇸🇾', 'U+1F1F8 U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:43:36', 1),
(216, 'Taiwan', 'TWN', '158', 'TW', '886', 'Taipei', 'TWD', 'New Taiwan dollar', '$', '.tw', '臺灣', 'Asia', 'Eastern Asia', '23.50000000', '121.00000000', '🇹🇼', 'U+1F1F9 U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:43:41', 1),
(217, 'Tajikistan', 'TJK', '762', 'TJ', '992', 'Dushanbe', 'TJS', 'Tajikistani somoni', 'SM', '.tj', 'Тоҷикистон', 'Asia', 'Central Asia', '39.00000000', '71.00000000', '🇹🇯', 'U+1F1F9 U+1F1EF', '2018-07-20 20:11:03', '2021-12-11 13:43:46', 1),
(218, 'Tanzania', 'TZA', '834', 'TZ', '255', 'Dodoma', 'TZS', 'Tanzanian shilling', 'TSh', '.tz', 'Tanzania', 'Africa', 'Eastern Africa', '-6.00000000', '35.00000000', '🇹🇿', 'U+1F1F9 U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:43:57', 1),
(219, 'Thailand', 'THA', '764', 'TH', '66', 'Bangkok', 'THB', 'Thai baht', '฿', '.th', 'ประเทศไทย', 'Asia', 'South-Eastern Asia', '15.00000000', '100.00000000', '🇹🇭', 'U+1F1F9 U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:44:06', 1),
(220, 'Togo', 'TGO', '768', 'TG', '228', 'Lome', 'XOF', 'West African CFA franc', 'CFA', '.tg', 'Togo', 'Africa', 'Western Africa', '8.00000000', '1.16666666', '🇹🇬', 'U+1F1F9 U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:44:14', 1),
(221, 'Tokelau', 'TKL', '772', 'TK', '690', '', 'NZD', 'New Zealand dollar', '$', '.tk', 'Tokelau', 'Oceania', 'Polynesia', '-9.00000000', '-172.00000000', '🇹🇰', 'U+1F1F9 U+1F1F0', '2018-07-20 20:11:03', '2021-12-11 13:44:33', 1),
(222, 'Tonga', 'TON', '776', 'TO', '676', 'Nuku\'alofa', 'TOP', 'Tongan paʻanga', '$', '.to', 'Tonga', 'Oceania', 'Polynesia', '-20.00000000', '-175.00000000', '🇹🇴', 'U+1F1F9 U+1F1F4', '2018-07-20 20:11:03', '2021-12-11 13:44:44', 1),
(223, 'Trinidad And Tobago', 'TTO', '780', 'TT', '+1-868', 'Port of Spain', 'TTD', 'Trinidad and Tobago dollar', '$', '.tt', 'Trinidad and Tobago', 'Americas', 'Caribbean', '11.00000000', '-61.00000000', '🇹🇹', 'U+1F1F9 U+1F1F9', '2018-07-20 20:11:03', '2021-12-11 13:44:51', 1),
(224, 'Tunisia', 'TUN', '788', 'TN', '216', 'Tunis', 'TND', 'Tunisian dinar', 'ت.د', '.tn', 'تونس', 'Africa', 'Northern Africa', '34.00000000', '9.00000000', '🇹🇳', 'U+1F1F9 U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:45:00', 1),
(225, 'Turkey', 'TUR', '792', 'TR', '90', 'Ankara', 'TRY', 'Turkish lira', '₺', '.tr', 'Türkiye', 'Asia', 'Western Asia', '39.00000000', '35.00000000', '🇹🇷', 'U+1F1F9 U+1F1F7', '2018-07-20 20:11:03', '2021-12-11 13:45:05', 1),
(226, 'Turkmenistan', 'TKM', '795', 'TM', '993', 'Ashgabat', 'TMT', 'Turkmenistan manat', 'T', '.tm', 'Türkmenistan', 'Asia', 'Central Asia', '40.00000000', '60.00000000', '🇹🇲', 'U+1F1F9 U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:45:10', 1),
(227, 'Turks And Caicos Islands', 'TCA', '796', 'TC', '+1-649', 'Cockburn Town', 'USD', 'United States dollar', '$', '.tc', 'Turks and Caicos Islands', 'Americas', 'Caribbean', '21.75000000', '-71.58333333', '🇹🇨', 'U+1F1F9 U+1F1E8', '2018-07-20 20:11:03', '2021-12-11 13:36:26', 1),
(228, 'Tuvalu', 'TUV', '798', 'TV', '688', 'Funafuti', 'AUD', 'Australian dollar', '$', '.tv', 'Tuvalu', 'Oceania', 'Polynesia', '-8.00000000', '178.00000000', '🇹🇻', 'U+1F1F9 U+1F1FB', '2018-07-20 20:11:03', '2021-12-11 13:37:37', 1),
(229, 'Uganda', 'UGA', '800', 'UG', '256', 'Kampala', 'UGX', 'Ugandan shilling', 'USh', '.ug', 'Uganda', 'Africa', 'Eastern Africa', '1.00000000', '32.00000000', '🇺🇬', 'U+1F1FA U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:45:17', 1),
(230, 'Ukraine', 'UKR', '804', 'UA', '380', 'Kiev', 'UAH', 'Ukrainian hryvnia', '₴', '.ua', 'Україна', 'Europe', 'Eastern Europe', '49.00000000', '32.00000000', '🇺🇦', 'U+1F1FA U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:45:22', 1),
(231, 'United Arab Emirates', 'ARE', '784', 'AE', '971', 'Abu Dhabi', 'AED', 'United Arab Emirates dirham', 'إ.د', '.ae', 'دولة الإمارات العربية المتحدة', 'Asia', 'Western Asia', '24.00000000', '54.00000000', '🇦🇪', 'U+1F1E6 U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:45:29', 1),
(232, 'United Kingdom', 'GBR', '826', 'GB', '44', 'London', 'GBP', 'British pound', '£', '.uk', 'United Kingdom', 'Europe', 'Northern Europe', '54.00000000', '-2.00000000', '🇬🇧', 'U+1F1EC U+1F1E7', '2018-07-20 20:11:03', '2021-12-11 13:37:13', 1),
(233, 'United States', 'USA', '840', 'US', '1', 'Washington', 'USD', 'United States dollar', '$', '.us', 'United States', 'Americas', 'Northern America', '38.00000000', '-97.00000000', '🇺🇸', 'U+1F1FA U+1F1F8', '2018-07-20 20:11:03', '2021-12-11 13:36:28', 1),
(234, 'United States Minor Outlying Islands', 'UMI', '581', 'UM', '1', '', 'USD', 'United States dollar', '$', '.us', 'United States Minor Outlying Islands', 'Americas', 'Northern America', '0.00000000', '0.00000000', '🇺🇲', 'U+1F1FA U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:36:30', 1),
(235, 'Uruguay', 'URY', '858', 'UY', '598', 'Montevideo', 'UYU', 'Uruguayan peso', '$', '.uy', 'Uruguay', 'Americas', 'South America', '-33.00000000', '-56.00000000', '🇺🇾', 'U+1F1FA U+1F1FE', '2018-07-20 20:11:03', '2021-12-11 13:45:36', 1),
(236, 'Uzbekistan', 'UZB', '860', 'UZ', '998', 'Tashkent', 'UZS', 'Uzbekistani soʻm', 'лв', '.uz', 'O‘zbekiston', 'Asia', 'Central Asia', '41.00000000', '64.00000000', '🇺🇿', 'U+1F1FA U+1F1FF', '2018-07-20 20:11:03', '2021-12-11 13:45:40', 1),
(237, 'Vanuatu', 'VUT', '548', 'VU', '678', 'Port Vila', 'VUV', 'Vanuatu vatu', 'VT', '.vu', 'Vanuatu', 'Oceania', 'Melanesia', '-16.00000000', '167.00000000', '🇻🇺', 'U+1F1FB U+1F1FA', '2018-07-20 20:11:03', '2021-12-11 13:45:47', 1),
(238, 'Vatican City State (Holy See)', 'VAT', '336', 'VA', '379', 'Vatican City', 'EUR', 'Euro', '€', '.va', 'Vaticano', 'Europe', 'Southern Europe', '41.90000000', '12.45000000', '🇻🇦', 'U+1F1FB U+1F1E6', '2018-07-20 20:11:03', '2021-12-11 13:32:24', 1),
(239, 'Venezuela', 'VEN', '862', 'VE', '58', 'Caracas', 'VEF', 'Bolívar', 'Bs', '.ve', 'Venezuela', 'Americas', 'South America', '8.00000000', '-66.00000000', '🇻🇪', 'U+1F1FB U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:46:04', 1),
(240, 'Vietnam', 'VNM', '704', 'VN', '84', 'Hanoi', 'VND', 'Vietnamese đồng', '₫', '.vn', 'Việt Nam', 'Asia', 'South-Eastern Asia', '16.16666666', '107.83333333', '🇻🇳', 'U+1F1FB U+1F1F3', '2018-07-20 20:11:03', '2021-12-11 13:46:14', 1),
(241, 'Virgin Islands (British)', 'VGB', '092', 'VG', '+1-284', 'Road Town', 'USD', 'United States dollar', '$', '.vg', 'British Virgin Islands', 'Americas', 'Caribbean', '18.43138300', '-64.62305000', '🇻🇬', 'U+1F1FB U+1F1EC', '2018-07-20 20:11:03', '2021-12-11 13:36:33', 1),
(242, 'Virgin Islands (US)', 'VIR', '850', 'VI', '+1-340', 'Charlotte Amalie', 'USD', 'United States dollar', '$', '.vi', 'United States Virgin Islands', 'Americas', 'Caribbean', '18.34000000', '-64.93000000', '🇻🇮', 'U+1F1FB U+1F1EE', '2018-07-20 20:11:03', '2021-12-11 13:46:20', 1),
(243, 'Wallis And Futuna Islands', 'WLF', '876', 'WF', '681', 'Mata Utu', 'XPF', 'CFP franc', '₣', '.wf', 'Wallis et Futuna', 'Oceania', 'Polynesia', '-13.30000000', '-176.20000000', '🇼🇫', 'U+1F1FC U+1F1EB', '2018-07-20 20:11:03', '2021-12-11 13:46:25', 1),
(244, 'Western Sahara', 'ESH', '732', 'EH', '212', 'El-Aaiun', 'MAD', 'Moroccan Dirham', 'MAD', '.eh', 'الصحراء الغربية', 'Africa', 'Northern Africa', '24.50000000', '-13.00000000', '🇪🇭', 'U+1F1EA U+1F1ED', '2018-07-20 20:11:03', '2021-12-11 13:46:40', 1),
(245, 'Yemen', 'YEM', '887', 'YE', '967', 'Sanaa', 'YER', 'Yemeni rial', '﷼', '.ye', 'اليَمَن', 'Asia', 'Western Asia', '15.00000000', '48.00000000', '🇾🇪', 'U+1F1FE U+1F1EA', '2018-07-20 20:11:03', '2021-12-11 13:46:48', 1),
(246, 'Zambia', 'ZMB', '894', 'ZM', '260', 'Lusaka', 'ZMW', 'Zambian kwacha', 'ZK', '.zm', 'Zambia', 'Africa', 'Eastern Africa', '-15.00000000', '30.00000000', '🇿🇲', 'U+1F1FF U+1F1F2', '2018-07-20 20:11:03', '2021-12-11 13:46:53', 1),
(247, 'Zimbabwe', 'ZWE', '716', 'ZW', '263', 'Harare', 'ZWL', 'Zimbabwe Dollar', '$', '.zw', 'Zimbabwe', 'Africa', 'Eastern Africa', '-20.00000000', '30.00000000', '🇿🇼', 'U+1F1FF U+1F1FC', '2018-07-20 20:11:03', '2021-12-11 13:47:10', 1),
(248, 'Kosovo', 'XKX', '926', 'XK', '383', 'Pristina', 'EUR', 'Euro', '€', '.xk', 'Republika e Kosovës', 'Europe', 'Eastern Europe', '42.56129090', '20.34030350', '🇽🇰', 'U+1F1FD U+1F1F0', '2020-08-15 15:33:50', '2021-12-11 13:26:38', 1),
(249, 'Curaçao', 'CUW', '531', 'CW', '599', 'Willemstad', 'ANG', 'Netherlands Antillean guilder', 'ƒ', '.cw', 'Curaçao', 'Americas', 'Caribbean', '12.11666700', '-68.93333300', '🇨🇼', 'U+1F1E8 U+1F1FC', '2020-10-25 14:54:20', '2021-12-11 13:01:45', 1),
(250, 'Sint Maarten (Dutch part)', 'SXM', '534', 'SX', '1721', 'Philipsburg', 'ANG', 'Netherlands Antillean guilder', 'ƒ', '.sx', 'Sint Maarten', 'Americas', 'Caribbean', '18.03333300', '-63.05000000', '🇸🇽', 'U+1F1F8 U+1F1FD', '2020-12-05 13:03:39', '2021-12-11 13:41:24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
