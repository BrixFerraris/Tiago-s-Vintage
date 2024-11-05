-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 07:01 PM
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
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category`, `image`) VALUES
(29, 'Tshirts', '672a332b30c782.88738433.png'),
(30, 'Vest', '672a30aec4a2a6.95078246.png'),
(31, 'Caps', '672a33ed67d4c4.89827750.png'),
(32, 'Shoes', '672a30c504df43.66699978.png'),
(33, 'Bag', '672a33bb3cf6a9.25406476.png'),
(34, 'Pants', '672a346200e023.52138715.png'),
(35, 'Shorts', '672a4131929334.90375808.png'),
(36, 'Jerseys', '672a427cea29d1.77411643.png');

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
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `price`, `discount`, `category`, `img1`, `img2`, `img3`, `img4`, `description`) VALUES
(11, 'Sample', 123, 0, 'Shoes', '66f1a1b8d8b787.16174887.png', '66f1a1b8d8b857.13120490.png', '66f1a1b8d8b879.53036138.png', '66f1a1b8d8b894.25958641.png', 'waqe'),
(12, 'wqeqzzxc', 1123, 0, 'Tops', '66f1a1cc6c9455.35440060.png', '66f1a1cc6c9581.71558382.png', '66f1a1cc6c95a1.01039445.png', '66f1a1cc6c95c5.76015324.png', '12qwsdas'),
(13, 'Shoes', 121, 0, 'Shoes', '66f478594a7301.68824789.png', '66f478594a73d2.50142593.png', '66f478594a73f6.26140937.png', '66f478594a7410.80062691.png', 'Testing'),
(16, 'Black Rebel Trucker Cap', 350, 0, 'Caps', '672a36995f89a2.89254776.png', '672a36995f8a49.56487798.png', '672a36995f8a56.33433437.png', '672a36995f8a74.31191657.png', 'No Issue\r\n\r\nGood Condition'),
(17, 'Aby Fishing Vest', 1500, 0, 'Vest', '672a3dcae48df7.95342547.png', '672a3dcae490c2.96939939.png', '672a3dcae490e3.70819402.png', '672a3dcae49102.91925141.png', 'No issue\r\n\r\nGood Condition'),
(18, 'Drew Billiard', 1200, 0, 'Tshirts', '672a404ea06663.74888283.png', '672a404ea06729.83635193.png', '672a404ea06733.37524058.png', '672a404ea06757.43684301.png', 'Issue:\r\nWashable Stain\r\n\r\nGood Condition'),
(19, 'Ihihi Jorts', 850, 0, 'Shorts', '672a4189779ee7.36543913.png', '672a4189779f65.21174711.png', '672a4189779f81.20596980.png', '672a4189779fa5.58966959.png', 'No Issue\r\n\r\nGreat Condition');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `cms_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `landing_bg` varchar(255) NOT NULL,
  `landing_text` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `qr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`cms_id`, `title`, `logo`, `landing_bg`, `landing_text`, `about`, `terms`, `fb`, `ig`, `email`, `number`, `address`, `qr`) VALUES
(1, 'Tiago\'s Vintage', '672a3510b51779.97075724-1730819344.png', '672a317ea782d4.64406569-1730818430.jpg', 'Maulan Sale!!', 'opo hahawhz', 'hahaha bwqhe', 'https://www.facebook.com/profile.php?id=100063803240125', 'https://www.instagram.com/tiagos_vintage_/', 'vinceasdfghj@gmail.com', '0995 795 6315', 'Southboys Garage Bayan Luma 5 Imus Cavite ', '672a517c192e67.14199284.jpg');

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
  `address` varchar(255) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `user_id`, `date`, `total`, `grand_total`, `status`, `address`, `payment_id`) VALUES
(42, '1728955818_1', '11', '12', 1, '1', '2024-11-05 18:00:04', 123, 0, 'Check Payment', 'Emoes haha', 0);

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
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`cms_id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
