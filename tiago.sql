-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2024 at 07:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiago`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `discount` decimal(65,0) NOT NULL,
  `cat1` varchar(100) NOT NULL,
  `cat2` varchar(100) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `length` decimal(65,0) NOT NULL,
  `width` decimal(65,0) NOT NULL,
  `qty` int(255) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `firstName`, `lastName`, `contact`, `role`) VALUES
(1, 'amiel', '$2y$10$cG4nZjbbyJRC2iLt8SDNYefmKf9BSG2kZC20oydBv.qzjDv1ItSgi', 'Amiel Carhyl', 'Lapid', '12312312312', 'Customer'),
(2, 'heart', '$2y$10$0JtU36KlvBlUhldp1BjZ3ulKa.sRWWRZFTPdaeCsknLefVKVbxBmC', 'Nicole Heart', 'Mendoza', '123123123', 'Customer'),
(3, 'asczxc', '$2y$10$tShTNevKd4P/v.Pe2N48leBNGmdgRxoLY3OSyLGIHbxIfNepI6s2a', 'awdz', 'qweqwe', '3232323', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
