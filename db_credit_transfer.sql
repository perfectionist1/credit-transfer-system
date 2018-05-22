-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 08:29 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_credit_transfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit`
--

CREATE TABLE `tbl_credit` (
  `id` int(10) NOT NULL,
  `user_id` int(255) NOT NULL,
  `total_credit` int(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_credit`
--

INSERT INTO `tbl_credit` (`id`, `user_id`, `total_credit`) VALUES
(1, 3, 1000),
(2, 5, 1700),
(5, 9, 0),
(6, 10, 1310),
(7, 11, 39157);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_request`
--

CREATE TABLE `tbl_credit_request` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `amount` int(255) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_credit_request`
--

INSERT INTO `tbl_credit_request` (`id`, `user_id`, `amount`, `date`, `request_status`) VALUES
(1, 11, 20, '02:22:50 PM, 10-04-2018', 0),
(2, 11, 50, '02:23:35 PM, 10-04-2018', 2),
(3, 11, 1000, '02:23:41 PM, 10-04-2018', 0),
(4, 11, 40, '02:27:32 PM, 10-04-2018', 0),
(5, 11, 10, '02:41:24 PM, 10-04-2018', 1),
(6, 11, 1, '02:48:18 PM, 10-04-2018', 0),
(7, 11, 44, '02:48:22 PM, 10-04-2018', 0),
(8, 11, 50, '02:48:26 PM, 10-04-2018', 0),
(9, 11, 70, '02:48:30 PM, 10-04-2018', 0),
(10, 11, 40, '02:48:35 PM, 10-04-2018', 2),
(11, 11, 12, '02:48:42 PM, 10-04-2018', 2),
(12, 11, 13, '02:48:46 PM, 10-04-2018', 2),
(13, 11, 42, '02:49:22 PM, 10-04-2018', 2),
(14, 11, 50, '02:49:25 PM, 10-04-2018', 2),
(15, 3, 400, '04:50:57 PM, 10-04-2018', 2),
(16, 11, 100, '06:00:10 PM, 11-04-2018', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer`
--

CREATE TABLE `tbl_transfer` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `transferred_to_user_id` int(10) NOT NULL,
  `transferred_amount` int(255) NOT NULL,
  `transferred_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_transfer`
--

INSERT INTO `tbl_transfer` (`id`, `user_id`, `transferred_to_user_id`, `transferred_amount`, `transferred_date`) VALUES
(1, 3, 5, 100, '01:46:26 PM, 03-04-2018'),
(2, 3, 5, 50, '05:49:57 PM, 03-04-2018'),
(3, 3, 5, 40, '09:21:04 AM, 04-04-2018'),
(4, 3, 5, 12, '01:24:42 PM, 04-04-2018'),
(5, 5, 3, 2, '01:29:27 PM, 04-04-2018'),
(6, 3, 5, 30, '02:18:22 PM, 04-04-2018'),
(7, 5, 3, 55, '02:32:40 PM, 04-04-2018'),
(8, 3, 5, 25, '02:33:32 PM, 04-04-2018'),
(9, 5, 3, 200, '02:37:41 PM, 04-04-2018'),
(10, 5, 10, 20, '02:44:32 PM, 04-04-2018'),
(11, 11, 3, 45, '02:47:45 PM, 04-04-2018'),
(12, 11, 5, 25, '02:47:50 PM, 04-04-2018'),
(13, 11, 10, 57, '02:47:54 PM, 04-04-2018'),
(14, 9, 10, 200, '02:56:03 PM, 04-04-2018'),
(15, 9, 3, 55, '02:58:29 PM, 04-04-2018'),
(16, 9, 5, 95, '02:58:38 PM, 04-04-2018'),
(17, 9, 10, 33, '02:58:44 PM, 04-04-2018'),
(18, 9, 11, 27, '03:04:36 PM, 04-04-2018'),
(19, 11, 5, 1000, '01:19:22 PM, 10-04-2018'),
(20, 9, 11, 13, '04:07:09 PM, 10-04-2018'),
(21, 9, 11, 12, '04:12:15 PM, 10-04-2018'),
(22, 9, 11, 40, '04:14:30 PM, 10-04-2018'),
(23, 9, 3, 400, '04:51:51 PM, 10-04-2018'),
(24, 9, 11, 50, '05:59:11 PM, 11-04-2018');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `account_status` tinyint(1) NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `first_name`, `last_name`, `username`, `password`, `email_address`, `address`, `account_status`, `created_at`) VALUES
(3, 'Raihan', 'Ahmed', 'raihangfn', '827ccb0eea8a706c4c34a16891f84e7b', 'raihangfn@gmail.com', 'Mymensingh', 1, '30-03-2018'),
(5, 'Shibbir', 'Ahmed', 'shibbirgfn', '827ccb0eea8a706c4c34a16891f84e7b', 'shibbirgfn@gmail.com', '12345', 1, '30-03-2018'),
(9, 'Shibbir', 'Ahmed Rizwan', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'shibbirweb@gmail.com', 'Gafargoan, Mymensingh', 2, '31-03-2018'),
(10, 'Amit kumar ', 'Sutradhar', 'amit', '0cb1eb413b8f7cee17701a37a1d74dc3', 'amitshuvo39@gmail.com\r\n', 'Mym', 0, '01-04-2018'),
(11, 'Delwar Hussan', 'Pappu', 'Delwar', '176cec28dfd8a169a6bf5bf062e4a9ce', 'delwerpappu5@gmail.com\r\n', 'Gafargoan', 1, '04-04-2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_credit`
--
ALTER TABLE `tbl_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_credit_request`
--
ALTER TABLE `tbl_credit_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_credit`
--
ALTER TABLE `tbl_credit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_credit_request`
--
ALTER TABLE `tbl_credit_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
