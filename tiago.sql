-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 08:18 AM
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
(20, 'Tops', 'T-Shirt'),
(21, 'Tops', 'Long Sleeves'),
(22, 'Tops', 'Hoodies'),
(23, 'Bottoms', 'Shorts'),
(24, 'Bottoms', 'Pants'),
(25, 'Shoes', 'Sneakers'),
(26, 'Shoes', 'Sandals'),
(27, 'Shoes', 'Casual ');

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
(15, 'Addidas T-Shirt', 450, 0, 'Tops', 'T-Shirt', '', '', 0, 0, 0, '67076612a77367.84348681.png', '67076612a77494.07502610.png', '67076612a774b3.04805800.png', '67076612a774c7.05271610.png', 'Color not faded\r\nCrispy Condition\r\n\r\n'),
(16, 'Ralph Lauren Board Shorts', 350, 0, 'Bottoms', 'Shorts', '', '', 0, 0, 0, '67076b058e63a0.32027391.png', '67076b058e6523.49261947.png', '67076b058e6539.54292170.png', '67076b058e6550.09562143.png', 'Issue: Faded Spots\r\nGood Condition'),
(17, 'Carhartt Double Knee', 3500, 0, 'Bottoms', 'Pants', '', '', 0, 0, 0, '67076bcb89bf51.84651377.png', '67076bcb89c146.42349210.png', '67076bcb89c158.61689485.png', '67076bcb89c171.73134913.png', 'No Issue\r\nExcellent Condition\r\nCrispy Condition'),
(18, 'Nike Small Logo', 1200, 0, 'Tops', 'T-Shirt', '', '', 0, 0, 0, '67076cc519c715.04588971.png', '67076cc519c8b8.84582187.png', '67076cc519c8d1.79595043.png', '67076cc519c8e3.96060849.png', 'No Issue\r\nExcellent Condition\r\n'),
(19, 'Ralph Lauren Maong Shorts', 450, 0, 'Bottoms', 'Shorts', '', '', 0, 0, 0, '67076de4651bb8.34919020.png', '67076de4651d51.76844539.png', '67076de4651d60.56618775.png', '67076de4651d83.86781127.png', 'Issue: Washable Stain\r\nGood Condition'),
(20, 'Doc Martens Loafers', 900, 0, 'Shoes', 'Casual ', '', '', 0, 0, 0, '67076fceb62346.89826181.png', '67076fceb625b6.29013847.png', '67076fceb625f7.37321988.png', '67076fceb62645.12667646.png', 'No Issue\r\nGreat Condition'),
(21, 'Vans Potato', 1200, 0, 'Shoes', 'Casual ', '', '', 0, 0, 0, '670770079329f3.08160960.png', '67077007932ad5.55183482.png', '67077007932af3.53182673.png', '67077007932b01.73398490.png', 'Issue: Washable Stains\r\nGood Condition');

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
(13, '1727312528_1', '12', 3, '1', '2024-09-26 01:02:08', 3369, 0, 'Pending', 'Imus, 80bucksw13asc'),
(14, '1728540952_4', '16', 1, '4', '2024-10-10 06:15:52', 350, 0, 'Pending', 'asdddddd'),
(15, '1728540952_4', '20', 2, '4', '2024-10-10 06:15:52', 1800, 0, 'Pending', 'asdddddd');

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
(4, 'clark', '$2y$10$t7cQPkveWnqAsLIL.R.0P.7p171bJU1uQvQgFI06Kf/awAyQeYk4y', 'clark', 'escoto', '0912393923', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variations`
--

CREATE TABLE `tbl_variations` (
  `id` int(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `variationName` varchar(255) NOT NULL,
  `width` int(255) NOT NULL,
  `length` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `imgVar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_variations`
--

INSERT INTO `tbl_variations` (`id`, `product_id`, `variationName`, `width`, `length`, `quantity`, `imgVar`) VALUES
(3, '15', 'Green', 24, 29, 4, '670769d098c171.38758091.png'),
(4, '15', 'Blue', 23, 28, 3, '670769f4945b85.03698717.png'),
(5, '16', 'Navy Blue', 30, 30, 1, '67076b29cd6398.67518969.png'),
(6, '18', 'White', 30, 25, 2, '67076d05c4ca33.17635038.png'),
(7, '17', 'Black', 40, 34, 1, '67076d21701b83.29811813.png'),
(8, '19', 'White', 30, 25, 1, '6707702cc5cc41.64845783.png'),
(9, '20', 'Black', 41, 8, 1, '670770572fa984.98027728.png'),
(10, '21', 'Black', 41, 8, 1, '67077078739142.38180197.png');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
