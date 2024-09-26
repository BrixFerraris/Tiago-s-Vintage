-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 06:51 AM
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
-- Database: `tiago`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(255) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `child` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `parent`, `child`) VALUES
(2, 'Tops', 'T-Shirt yata haha'),
(3, 'Tops', 'Hoodies bwahha'),
(14, 'Bottoms', 'Bottomsawdqw'),
(15, 'Tops', 'hehe'),
(16, 'Bottoms', 'jk lang po hehe'),
(17, 'Shoes', 'qweqwewq'),
(18, 'Shoes', 'wqwqe'),
(19, 'Tops', 'Tops ito');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `discount` decimal(65,0) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sub_category` varchar(255) NOT NULL,
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

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `price`, `discount`, `category`, `sub_category`, `color`, `size`, `length`, `width`, `qty`, `img1`, `img2`, `img3`, `img4`, `description`) VALUES
(11, 'sample1', 211, 0, 'Bottoms', '', '', '', 0, 0, 0, '66f1a1b8d8b787.16174887.png', '66f1a1b8d8b857.13120490.png', '66f1a1b8d8b879.53036138.png', '66f1a1b8d8b894.25958641.png', 'waqe'),
(12, 'awdq', 1123, 0, 'Shoes', '', '', '', 0, 0, 0, '66f1a1cc6c9455.35440060.png', '66f1a1cc6c9581.71558382.png', '66f1a1cc6c95a1.01039445.png', '66f1a1cc6c95c5.76015324.png', '12qwsdas'),
(13, 'Shoes', 121, 0, 'Shoes', 'wqwqe', '', '', 0, 0, 0, '66f478594a7301.68824789.png', '66f478594a73d2.50142593.png', '66f478594a73f6.26140937.png', '66f478594a7410.80062691.png', 'Testing'),
(14, 'Cute', 213, 0, 'Tops', 'T-Shirt yata haha', '', '', 0, 0, 0, '66f47d8b4b4a01.77189895.png', '66f47d8b4b4ab9.70586041.png', '66f47d8b4b4ae1.17209330.png', '66f47d8b4b4b08.86837119.png', 'Maangas ito super');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `id` int(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` int(255) NOT NULL,
  `grand_total` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Cart',
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `transaction_id`, `product_id`, `quantity`, `user_id`, `date`, `total`, `grand_total`, `status`, `address`) VALUES
(12, '1727312557_1', '11', 2, '1', '2024-09-26 01:02:37', 422, 0, 'Pending', 'Imus, 80bucksw13asczzxcaw'),
(13, '1727312528_1', '12', 3, '1', '2024-09-26 01:02:08', 3369, 0, 'Pending', 'Imus, 80bucksw13asc');

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
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
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
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
