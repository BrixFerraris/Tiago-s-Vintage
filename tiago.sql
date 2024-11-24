-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 01:27 PM
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
(44, 'Jersey', '672f516b252822.74521629.jpg'),
(45, 'Shorts', '673d9e261aac00.13379115.jpg');

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
(14, '673c7aa86ebec5.46479131.png', '1', 1500, '1732016663_1', '2024-11-19 19:46:48'),
(15, '673cd1da566510.54578379.png', '1', 54000, '1732039077_1', '2024-11-20 01:58:50'),
(16, '673cd3729557b1.76326949.png', '1', 9400, '1732039526_1', '2024-11-20 02:05:38'),
(17, '673cecce7aca95.35549545.png', '1', 16470, '1732045620_1', '2024-11-20 03:53:50'),
(18, '673d05b4eba0b5.70430195.jpg', '1', 6210, '1732052340_1', '2024-11-20 05:40:04'),
(19, '673d8969c1a246.97129350.png', '11', 3000, '1732086069_11', '2024-11-20 15:02:01'),
(20, '673d8bd3ba5f10.25247211.png', '4', 121, '1732081165_4', '2024-11-20 15:12:19'),
(21, '673d969d12db05.04850081.png', '1', 4860, '1732089428_1', '2024-11-20 15:58:21'),
(22, '673daba80ea203.46375106.png', '13', 2300, '1732094816_13', '2024-11-20 17:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `category` varchar(100) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `price`, `category`, `img1`, `img2`, `img3`, `img4`, `description`, `date_added`) VALUES
(20, 'Nascar Cap', 1500, 'Caps', '673d9ac58501f5.21868387.png', '673d9ac5850478.53480780.png', '673d9ac58504a5.65107031.png', '673d9ac58504f7.60787084.png', 'No issue\r\nGreat Condition', '2024-11-20 08:16:05'),
(21, 'Black Rebel Cap', 850, 'Caps', '673d9b11870a58.46770916.png', '673d9b11870c48.03405080.png', '673d9b11870c85.54942044.png', '673d9b11870ca4.83458524.png', 'Minimal Issue: \r\nFade Color\r\n\r\n\r\nGood Condition', '2024-11-20 08:17:21'),
(22, 'Keen', 800, 'Shoes', '673d9b6a1bcac8.07838442.png', '673d9b6a1bcc45.28188069.png', '673d9b6a1bcc62.58723889.png', '673d9b6a1bcca5.89928917.png', 'Minimal Issue\r\n\r\nGood condition', '2024-11-20 08:18:50'),
(23, 'Muay-Thai Shorts', 250, 'Jersey', '673d9bd06209f4.18635243.png', '673d9bd0620bd3.04232871.png', '673d9bd0620bf2.15746179.png', '673d9bd0620c29.76374750.png', 'No Issue\r\n\r\nGreat Condition', '2024-11-20 08:20:32'),
(24, 'Nike Football Jersey', 700, 'Jersey', '673d9c1a097447.36409286.png', '673d9c1a0975f3.24953718.png', '673d9c1a097629.03347912.png', '673d9c1a097653.50577689.png', 'Minimal Issue:\r\nMinimal Cracked prints\r\n\r\nGood condition', '2024-11-20 08:21:46'),
(25, 'Nike X Supreme Shoes', 800, 'Shoes', '673d9c79ab8dc5.03101111.png', '673d9c79ab8f55.26493156.png', '673d9c79ab8f78.77183760.png', '673d9c79ab8fa5.74081828.png', 'Issue:\r\nCracked Prints\r\n\r\nGood Condition', '2024-11-20 08:23:21'),
(26, 'Thrasher Jacket', 2500, 'Jackets', '673d9cb0b825d5.05118697.png', '673d9cb0b826e1.58781400.png', '673d9cb0b82714.92796911.png', '673d9cb0b82745.05844985.png', 'No Issue\r\n\r\nGreat Condition', '2024-11-20 08:24:16'),
(27, 'Ihihi Jorts', 800, 'Shorts', '673da0b21c7142.84702195.png', '673da0b21c72a1.35946202.png', '673da0b21c72e3.44965016.png', '673da0b21c7312.89006743.png', 'No Issue\r\n\r\nGreat Condition', '2024-11-20 08:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(255) NOT NULL,
  `transactionID` varchar(255) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `variation_name` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rate` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `visible` varchar(255) NOT NULL DEFAULT 'true',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `transactionID`, `product_title`, `variation_name`, `review`, `rate`, `username`, `img1`, `img2`, `img3`, `visible`, `date`) VALUES
(2, '1732052340', 'Drew Billiard', 'White', 'wqeqeqeqeq', 5, 'amiel', '673d10b0bc09c6.35493435.jpg', NULL, NULL, 'true', '2024-11-20'),
(3, '1732089428', 'Aby Fishing Vest', '5', 'maangas', 0, 'amiel', '673d98d0a2d3a3.82974681.png', NULL, NULL, 'true', '2024-11-20');

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
(1, 'Tiago\'s Vintage', '673d737fd766a0.75094605-1732080511.png', '672a317ea782d4.64406569-1730818430.jpg', 'VinTage', 'opo hahawhz', 'Welcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is pl', 'https://www.facebook.com/profile.php?id=100063803240125', 'https://www.instagram.com/tiagos_vintage_/', 'vinceasdfghj@gmail.com', '0995 795 6315', 'Southboys Garage Bayan Luma 5 Imus Cavite ', '672a517c192e67.14199284.jpg');

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
  `seen` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `user_id`, `date`, `total`, `grand_total`, `status`, `discount`, `shipping`, `address`, `seen`) VALUES
(79, '1732052340_1', '18', '13', 2, '1', '2024-11-20 01:25:57', 2400, 6210, 'Pending', 'discount', 'pickup', 'wqeqzxczxczxc', 'true'),
(80, '1732052340_1', '17', '17', 3, '1', '2024-11-20 01:25:57', 4500, 6210, 'Pending', 'discount', 'pickup', 'wqeqzxczxczxc', 'true'),
(81, '1732089428_1', '18', '13', 2, '1', '2024-11-20 08:06:55', 2400, 4860, 'Completed', 'discount', 'pickup', 'Kila Clarence', 'false'),
(82, '1732081165_4', '13', '18', 1, '4', '2024-11-20 07:12:17', 121, 0, 'Check Payment', '', 'pickup', 'dito lang', 'true'),
(83, '1732086069_11', '17', '17', 1, '11', '2024-11-20 07:02:00', 1500, 0, 'Check Payment', '', 'pickup', 'dito lang', 'false'),
(84, '1732086069_11', '17', '17', 1, '11', '2024-11-20 07:02:00', 1500, 0, 'Check Payment', '', 'pickup', 'dito lang', 'false'),
(85, '1732086266_11', '17', '16', 2, '11', '2024-11-20 07:11:23', 3000, 0, 'Pending', '', 'delivery', '', 'true'),
(86, '1732086702_4', '13', '18', 1, '4', '2024-11-20 07:12:04', 121, 0, 'Pending', '', 'delivery', 'dito lang', 'true'),
(87, '1732089428_1', '17', '17', 2, '1', '2024-11-20 08:06:55', 3000, 4860, 'Completed', 'discount', 'pickup', 'Kila Clarence', 'false'),
(88, '1732094816_13', '20', '21', 1, '13', '2024-11-20 09:31:35', 1500, 0, 'Completed', '', 'pickup', 'dito lang', 'true'),
(89, '1732094816_13', '25', '26', 1, '13', '2024-11-20 09:31:35', 800, 0, 'Completed', '', 'pickup', 'dito lang', 'true'),
(90, '1732094976_13', '20', '28', 2, '13', '2024-11-20 09:29:36', 3000, 0, 'Pending', '', 'delivery', 'Kila Clarence', 'false'),
(91, '', '21', '22', 1, '13', '2024-11-20 09:38:47', 850, 0, 'Cart', '', '', '', 'false');

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
(1, 'amiel', '$2y$10$YU7ylFrp9LNQwZxLYG6GE.SrdKsxDlpKRwLSVIC3Hq5N1SUF8DQym', 'Amiel Carhyl', 'Lapid', '09940576891', 'Customer', 9),
(2, 'heart', '$2y$10$0JtU36KlvBlUhldp1BjZ3ulKa.sRWWRZFTPdaeCsknLefVKVbxBmC', 'Nicole Heart', 'Mendoza', '123123123', 'Customer', 0),
(3, 'asczxc', '$2y$10$tShTNevKd4P/v.Pe2N48leBNGmdgRxoLY3OSyLGIHbxIfNepI6s2a', 'awdz', 'qweqwe', '3232323', 'Customer', 0),
(4, 'daduk', '$2y$10$cV2r.OZ888dIYWxacJedwePKnilihnKm./7CNax1AhMpVd7GjHMgm', 'Darius', 'Gavino', '099940576891', 'Customer', 1),
(5, 'amiel06', '$2y$10$4SFlJ4HEb5hC6aVzFXVWjerAnQKnvrMTSNOoqDi2xSh3JvdXareZi', 'Amiel Carhyl', 'Lapid', 'None', 'Super Admin', 0),
(9, 'brix', '$2y$10$YsZlW0jjCQU7eUHxACvSxuo4oXDCvnLE9FWNmFo89BA9ndh1Gh6sa', 'Brix', 'Ferraris', 'None', 'Super Admin', 21),
(10, 'clar123', '$2y$10$BdL6rnKfHdaIsPJs5yOxLuahrv6fEdK0fPZx0K9ZpxY1DESEwIt0W', 'clar', 'darius', '0954321311', 'Customer', 0),
(11, 'clar321', '$2y$10$ght6i9GHZBUGeGxS6X6Fa.3OmJEN8DdeUd7aBYSCp6dhPBKXyanES', 'clar', 'clar', '0318023018038102381083028038108', 'Customer', 0),
(12, 'alex', '$2y$10$U9PXbmAZT1ITljneWktUeeE0uWL8FQlMzUUxoKvBqyVckZmJ2UJhu', 'alex', 'alex', '12345678901', 'Customer', 0),
(13, 'dar', '$2y$10$gYDcFkWNp0a9tEVEphlvJe8FgLHNCahvjxMw6mRChmMU56Fc9s6xa', 'alex', 'dar', '09516651062', 'Customer', 4);

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
  `imgVar` varchar(255) NOT NULL,
  `seen` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_variations`
--

INSERT INTO `tbl_variations` (`id`, `product_id`, `variationName`, `width`, `length`, `quantity`, `imgVar`, `seen`) VALUES
(11, 11, 'hehe', 23, 21, 8, '', 'false'),
(12, 11, 'sample po', 21, 32, 3, '6706fc6b341d33.46212256.png', 'false'),
(13, 18, 'White', 25, 26, 10, '672f2e5957e2b8.08065199.png', 'false'),
(14, 11, 'White', 20, 20, 12, '672f3284d6fdc2.21053179.png', 'false'),
(15, 12, 'White', 12, 32, 12, '673041f114e835.95422197.png', 'false'),
(16, 17, 'Brown', 25, 24, 1, '6738a6f15ae1a2.90674490.jpg', 'true'),
(17, 17, '5', 27, 27, 10, '6738a752dd4d99.37358780.webp', 'true'),
(18, 13, 'Blue', 123, 12, 10, '6738a7e46919f0.14264527.webp', 'false'),
(19, 19, 'Brown', 31, 30, 8, '6738a8112e1719.22493591.png', 'false'),
(20, 11, 'Blue Jorts', 123, 32, 12, '6738a83aafff29.12445481.jpg', 'false'),
(21, 20, 'Black Nascar Cap', 10, 10, 0, '673d9e6454ab26.79953935.png', 'false'),
(22, 21, 'Black ', 10, 10, 1, '673d9e860f5752.69717094.png', 'false'),
(23, 22, 'White Keen ', 3, 4, 1, '673d9efd848c33.98809017.png', 'false'),
(24, 23, 'Muay-Thai Blue', 25, 21, 1, '673d9f31e0e3f4.36022975.png', 'false'),
(25, 24, 'DHL red', 28, 30, 1, '673d9f6be06234.25810455.png', 'false'),
(26, 25, 'Supreme Shoes', 8, 8, 0, '673d9f8cd42e71.96579863.png', 'false'),
(27, 26, 'Thrasher Jacket Black', 34, 32, 1, '673d9fb3927ae9.04223812.png', 'false'),
(28, 20, 'Blue Nascar Cap', 10, 10, 3, '673da01158b113.53087390.png', 'false'),
(29, 23, 'Muay-Thai Shorts Red', 25, 30, 5, '673da0558e3e53.93013391.png', 'false'),
(30, 27, 'Ihihi Jorts Beige', 32, 35, 5, '673da0e8c32ad2.93166519.png', 'false');

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
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
