-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 03:31 AM
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
(19, 'Tops', 'Tops ito'),
(21, 'sample', 'hehehezz'),
(22, 'hello', 'sample pobwhaha');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `id` int(255) NOT NULL,
  `img1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parent`
--

CREATE TABLE `tbl_parent` (
  `id` int(255) NOT NULL,
  `parent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_parent`
--

INSERT INTO `tbl_parent` (`id`, `parent`) VALUES
(1, 'sample'),
(2, 'hello');

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
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `price`, `discount`, `category`, `sub_category`, `img1`, `img2`, `img3`, `img4`, `description`) VALUES
(11, 'Sample', 123, 0, 'Shoes', 'wqwqe', '66f1a1b8d8b787.16174887.png', '66f1a1b8d8b857.13120490.png', '66f1a1b8d8b879.53036138.png', '66f1a1b8d8b894.25958641.png', 'waqe'),
(12, 'wqeqzzxc', 1123, 0, 'Tops', 'T-Shirt yata haha', '66f1a1cc6c9455.35440060.png', '66f1a1cc6c9581.71558382.png', '66f1a1cc6c95a1.01039445.png', '66f1a1cc6c95c5.76015324.png', '12qwsdas'),
(13, 'Shoes', 121, 0, 'Shoes', 'wqwqe', '66f478594a7301.68824789.png', '66f478594a73d2.50142593.png', '66f478594a73f6.26140937.png', '66f478594a7410.80062691.png', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `id` int(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `variation_id` varchar(255) NOT NULL,
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

INSERT INTO `tbl_transactions` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `user_id`, `date`, `total`, `grand_total`, `status`, `address`) VALUES
(42, '1728955818_1', '11', '12', 1, '1', '2024-10-15 01:30:18', 123, 0, 'Pending', 'Emoes haha');

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
(3, 'asczxc', '$2y$10$tShTNevKd4P/v.Pe2N48leBNGmdgRxoLY3OSyLGIHbxIfNepI6s2a', 'awdz', 'qweqwe', '3232323', 'Customer'),
(4, 'daduk', '$2y$10$cV2r.OZ888dIYWxacJedwePKnilihnKm./7CNax1AhMpVd7GjHMgm', 'Darius', 'Gavino', '099940576891', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variations`
--

CREATE TABLE `tbl_variations` (
  `id` int(11) NOT NULL,
  `product_id` int(255) NOT NULL,
  `variationName` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `imgVar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_variations`
--

INSERT INTO `tbl_variations` (`id`, `product_id`, `variationName`, `width`, `length`, `quantity`, `imgVar`) VALUES
(11, 11, 'hehe', 23, 21, 12, ''),
(12, 11, 'sample po', 21, 32, 3, '6706fc6b341d33.46212256.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_parent`
--
ALTER TABLE `tbl_parent`
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
-- Indexes for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_parent`
--
ALTER TABLE `tbl_parent`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
