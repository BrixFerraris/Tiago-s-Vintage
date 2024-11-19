-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 01:18 PM
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
(37, 'All', '672f5158297034.51934352.png'),
(38, 'T-Shirts', '672f3383e09910.18612100.png'),
(39, 'Jackets', '672f339f95d285.32413164.jpg'),
(40, 'Shoes', '672f35f6da57e9.95872257.jpg'),
(41, 'Caps', '672f36029beef9.30151625.jpg'),
(42, 'Pants', '672f3618d3c460.67483719.png'),
(43, 'Bags', '672f3ae6d36a42.48787600.jpg'),
(44, 'Jersey', '672f516b252822.74521629.jpg');

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
  `transaction_number` varchar(255) NOT NULL,
  `date_purchased` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `receipt`, `u_id`, `amount`, `transaction_number`, `date_purchased`) VALUES
(6, '672ea586315595.05625652.png', '1', 123, '1728955818_1', '2024-11-09 07:57:58'),
(7, '672f2eb89a3474.61006856.png', '9', 1200, '1731145384_9', '2024-11-09 17:43:20'),
(8, '673042388e2096.41974142.png', '9', 1123, '1731215890_9', '2024-11-10 13:18:48'),
(9, '6734576a2c8ce7.85831788.png', '9', 123, '1731483445_9', '2024-11-13 15:38:18'),
(10, '67358f75ef3be1.70562967.png', '10', 492, '1731563337_10', '2024-11-14 13:49:41'),
(11, '6738a8bf842e08.00152477.jpg', '4', 123, '1731415635_4', '2024-11-16 22:14:23'),
(12, '6738a8c6987272.40677569.webp', '4', 1500, '1731766452_4', '2024-11-16 22:14:30'),
(13, '673c534e055d13.62316741.png', '4', 1500, '1732006621_4', '2024-11-19 16:58:54'),
(14, '673c7aa86ebec5.46479131.png', '1', 1500, '1732016663_1', '2024-11-19 19:46:48');

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
(1, 'TIATEEE', '673b11068312e0.30369308-1731924230.webp', '672a317ea782d4.64406569-1730818430.jpg', 'Maulan Sale!!', 'opo hahawhz', 'Welcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is pl', 'https://www.facebook.com/profile.php?id=100063803240125', 'https://www.instagram.com/tiagos_vintage_/', 'vinceasdfghj@gmail.com', '0995 795 6315', 'Southboys Garage Bayan Luma 5 Imus Cavite ', '672a517c192e67.14199284.jpg');

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
  `discount` varchar(255) NOT NULL,
  `shipping` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `user_id`, `date`, `total`, `grand_total`, `status`, `discount`, `shipping`, `address`, `payment_id`) VALUES
(42, '1728955818_1', '11', '12', 1, '1', '2024-11-09 00:04:18', 123, 0, 'Completed', '', '', 'Emoes haha', 0),
(43, '1731145384_9', '18', '13', 1, '9', '2024-11-09 09:47:10', 1200, 0, 'Completed', '', '', 'Dito lang sa bahay', 0),
(44, '1731215890_9', '12', '15', 1, '9', '2024-11-10 05:19:06', 1123, 0, 'Ready For Pickup', '', '', 'Dito lang sa bahay', 0),
(45, '1731415635_4', '11', '11', 1, '4', '2024-11-16 14:15:03', 123, 0, 'Completed', '', '', 'dito lang', 0),
(46, '1731483445_9', '11', '11', 1, '9', '2024-11-13 07:38:33', 123, 0, 'Ready For Pickup', '', '', 'dito lang', 0),
(48, '', '11', '11', 1, '9', '2024-11-13 09:34:48', 123, 0, 'Cart', '', '', '', 0),
(49, '1731563337_10', '11', '11', 2, '10', '2024-11-14 05:50:58', 246, 0, 'Completed', '', '', 'Kila Clarence', 0),
(66, '1731766452_4', '17', '17', 1, '4', '2024-11-16 14:15:06', 1500, 0, 'Completed', '', '', 'dito lang', 0),
(67, '1732006621_4', '17', '16', 1, '4', '2024-11-19 08:59:03', 1500, 0, 'Ready For Pickup', '', '', 'Sa savanna', 0),
(69, '1732016663_1', '17', '17', 1, '1', '2024-11-19 12:17:27', 1500, 0, 'Pending', 'freebie', 'delivery', 'wqqq', 0);

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
  `role` varchar(255) NOT NULL DEFAULT 'Customer',
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `firstName`, `lastName`, `contact`, `role`, `points`) VALUES
(1, 'amiel', '$2y$10$cG4nZjbbyJRC2iLt8SDNYefmKf9BSG2kZC20oydBv.qzjDv1ItSgi', 'Amiel Carhyl', 'Lapid', '12312312312', 'Customer', 63),
(2, 'heart', '$2y$10$0JtU36KlvBlUhldp1BjZ3ulKa.sRWWRZFTPdaeCsknLefVKVbxBmC', 'Nicole Heart', 'Mendoza', '123123123', 'Customer', 0),
(3, 'asczxc', '$2y$10$tShTNevKd4P/v.Pe2N48leBNGmdgRxoLY3OSyLGIHbxIfNepI6s2a', 'awdz', 'qweqwe', '3232323', 'Customer', 0),
(4, 'daduk', '$2y$10$cV2r.OZ888dIYWxacJedwePKnilihnKm./7CNax1AhMpVd7GjHMgm', 'Darius', 'Gavino', '099940576891', 'Customer', 0),
(5, 'amiel06', '$2y$10$4SFlJ4HEb5hC6aVzFXVWjerAnQKnvrMTSNOoqDi2xSh3JvdXareZi', 'Amiel Carhyl', 'Lapid', 'None', 'Super Admin', 0),
(9, 'brix', '$2y$10$YsZlW0jjCQU7eUHxACvSxuo4oXDCvnLE9FWNmFo89BA9ndh1Gh6sa', 'Brix', 'Ferraris', 'None', 'Super Admin', 21),
(10, 'clar123', '$2y$10$BdL6rnKfHdaIsPJs5yOxLuahrv6fEdK0fPZx0K9ZpxY1DESEwIt0W', 'clar', 'darius', '0954321311', 'Customer', 0);

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
(11, 11, 'hehe', 23, 21, 8, ''),
(12, 11, 'sample po', 21, 32, 3, '6706fc6b341d33.46212256.png'),
(13, 18, 'White', 25, 26, 0, '672f2e5957e2b8.08065199.png'),
(14, 11, 'White', 20, 20, 12, '672f3284d6fdc2.21053179.png'),
(15, 12, 'White', 12, 32, 0, '673041f114e835.95422197.png'),
(16, 17, 'Brown', 25, 24, 1, '6738a6f15ae1a2.90674490.jpg'),
(17, 17, '5', 27, 27, 7, '6738a752dd4d99.37358780.webp'),
(18, 13, 'Blue', 123, 12, 1, '6738a7e46919f0.14264527.webp'),
(19, 19, 'Brown', 31, 30, 1, '6738a8112e1719.22493591.png'),
(20, 11, 'Blue Jorts', 123, 32, 1, '6738a83aafff29.12445481.jpg');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
