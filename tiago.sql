-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 11:56 AM
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
(19, '67435ad2effa62.22624688.png', '11', 3000, '1732467393_11', '2024-11-25 00:56:50'),
(20, '6745293715a429.48345251.png', '5', 3000, '1732582595_5', '2024-11-26 09:49:43'),
(21, '67452af3db9e43.39566708.png', '5', 2700, '1732586143_5', '2024-11-26 09:57:07'),
(22, '67452ba387a2a8.52601409.png', '11', 3000, '1732586346_11', '2024-11-26 10:00:03'),
(23, '67452bac4f86e9.46901146.jpg', '11', 3000, '1732586363_11', '2024-11-26 10:00:12'),
(24, '674538ee239d77.94569517.png', '11', 2700, '1732589762_11', '2024-11-26 10:56:46'),
(25, '67453b066b3614.15615464.jpg', '11', 2700, '1732586363_11', '2024-11-26 11:05:42'),
(26, '67453dc61ac4f6.37729525.png', '11', 1530, '1732590557_11', '2024-11-26 11:17:26'),
(27, '67453dcd354185.95283404.png', '11', 2400, '1732590607_11', '2024-11-26 11:17:33'),
(28, '6745706bdc49b7.18157170.jpg', '11', 1676, '1732603954_11', '2024-11-26 14:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `category` varchar(100) NOT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `price`, `category`, `img1`, `img2`, `img3`, `img4`, `description`, `date_added`) VALUES
(13, 'Shoes', 121, 'Shoes', '66f478594a7301.68824789.png', '66f478594a73d2.50142593.png', '66f478594a73f6.26140937.png', '66f478594a7410.80062691.png', 'Testing', '2024-11-19 13:56:33'),
(16, 'Black Rebel Trucker Cap', 350, 'Caps', '672a36995f89a2.89254776.png', '672a36995f8a49.56487798.png', '672a36995f8a56.33433437.png', '672a36995f8a74.31191657.png', 'No Issue\r\n\r\nGood Condition', '2024-11-19 13:56:33'),
(17, 'Aby Fishing Vest', 1500, 'T-Shirts', '672a3dcae48df7.95342547.png', '672a3dcae490c2.96939939.png', '672a3dcae490e3.70819402.png', '672a3dcae49102.91925141.png', 'No issue\r\n\r\nGood Condition', '2024-11-19 13:56:33'),
(18, 'Drew Billiard', 1200, 'T-Shirts', '672a404ea06663.74888283.png', '672a404ea06729.83635193.png', '672a404ea06733.37524058.png', '672a404ea06757.43684301.png', 'Issue:\r\nWashable Stain\r\n\r\nGood Condition', '2024-11-19 13:56:33'),
(19, 'Ihihi Jorts', 850, 'Shorts', '672a4189779ee7.36543913.png', '672a4189779f65.21174711.png', '672a4189779f81.20596980.png', '672a4189779fa5.58966959.png', 'No Issue\r\n\r\nGreat Condition', '2024-11-19 13:56:33'),
(21, 'hahaha 3 ', 221, 'T-Shirts', '6743099874aca2.91555287.png', '6743099874dbb0.48881728.png', '6743099874fed2.44347556.png', NULL, 'ajawjdna', '2024-11-24 11:10:16');

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
(2, '1732052340', 'Drew Billiard', 'White', 'wqeqeqeqeq', 5, 'amiel', '673d10b0bc09c6.35493435.jpg', NULL, NULL, 'true', '2024-11-20');

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
  `terms` longtext NOT NULL,
  `fb` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `qr` varchar(255) NOT NULL,
  `footer` longtext NOT NULL,
  `about_img` varchar(255) NOT NULL,
  `about_img2` varchar(255) NOT NULL,
  `about_img3` varchar(255) NOT NULL,
  `about_img4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`cms_id`, `title`, `logo`, `landing_bg`, `landing_text`, `about`, `terms`, `fb`, `ig`, `email`, `number`, `address`, `qr`, `footer`, `about_img`, `about_img2`, `about_img3`, `about_img4`) VALUES
(1, 'Tiago\'s Vintage Boutique', '6745719a203149.86962530-1732604314.png', '672a317ea782d4.64406569-1730818430.jpg', 'Maulan Sale!!', 'qweqweqe', 'Welcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is pl', 'https://www.facebook.com/profile.php?id=100063803240125', 'https://www.instagram.com/tiagos_vintage_/', 'vinceasdfghj@gmail.com', '0995 795 6315', 'Southboys Garage Bayan Luma 5 Imus Cavite ', '67451f63d4f539.72112300.jpg', 'qwewee', '6745a577681e37.31688169.png', '6745a577684ce4.98842817.png', '6745a577686bc6.32607911.jpg', '6745a5776884d3.46611149.png');

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
(81, '', '18', '13', 2, '1', '2024-11-20 00:33:10', 2400, 0, 'Cart', '', '', '', 'false'),
(82, '1732467393_11', '17', '17', 2, '11', '2024-11-26 03:13:31', 3000, 0, 'Completed', '', 'pickup', 'Imus, 80bucksqweq', 'true'),
(84, '1732582595_5', '17', '16', 12, '5', '2024-11-26 01:49:41', 3000, 0, 'Check Payment', '', 'pickup', 'Imus, 80bucks', 'false'),
(85, '1732586143_5', '18', '13', 1, '5', '2024-11-26 01:57:16', 1200, 0, 'Out For Delivery', '', 'delivery', 'hahanxcvxzcvzx', 'false'),
(86, '1732586143_5', '17', '16', 1, '5', '2024-11-26 01:57:16', 1500, 0, 'Out For Delivery', '', 'delivery', 'hahanxcvxzcvzx', 'false'),
(87, '1732586346_11', '17', '16', 2, '11', '2024-11-26 03:11:04', 3000, 0, 'Completed', '', 'pickup', 'nsnsns', 'true'),
(88, '1732586363_11', '17', '16', 2, '11', '2024-11-26 03:20:54', 3000, 0, 'Completed', 'discount', 'delivery', 'bbbbb', 'true'),
(89, '1732589762_11', '17', '16', 2, '11', '2024-11-26 04:56:55', 3000, 2700, 'Out For Delivery', 'discount', 'pickup', 'oikjnbaww', 'false'),
(90, '1732590557_11', '19', '19', 2, '11', '2024-11-26 03:47:00', 1700, 1530, 'Completed', 'discount', 'pickup', 'zxczxc', 'false'),
(91, '1732590607_11', '18', '13', 2, '11', '2024-11-26 03:45:56', 2400, 2400, 'Completed', '', 'pickup', 'asdaww', 'false'),
(92, '1732603954_11', '13', '18', 4, '11', '2024-11-26 06:53:45', 363, 1676, 'Out For Delivery', 'discount', 'delivery', 'gawdaxz', 'false'),
(93, '1732603954_11', '17', '16', 1, '11', '2024-11-26 06:53:45', 1500, 1676, 'Out For Delivery', 'discount', 'delivery', 'gawdaxz', 'false');

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
  `points` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `firstName`, `lastName`, `contact`, `role`, `points`) VALUES
(1, 'amiel', '$2y$10$YU7ylFrp9LNQwZxLYG6GE.SrdKsxDlpKRwLSVIC3Hq5N1SUF8DQym', 'Amiel Carhyl', 'Lapid', '09940576891', 'Customer', 15),
(2, 'heart', '$2y$10$0JtU36KlvBlUhldp1BjZ3ulKa.sRWWRZFTPdaeCsknLefVKVbxBmC', 'Nicole Heart', 'Mendoza', '123123123', 'Customer', 0),
(3, 'asczxc', '$2y$10$tShTNevKd4P/v.Pe2N48leBNGmdgRxoLY3OSyLGIHbxIfNepI6s2a', 'awdz', 'qweqwe', '3232323', 'Customer', 0),
(4, 'daduk', '$2y$10$cV2r.OZ888dIYWxacJedwePKnilihnKm./7CNax1AhMpVd7GjHMgm', 'Darius', 'Gavino', '099940576891', 'Customer', 1),
(5, 'amiel06', '$2y$10$4SFlJ4HEb5hC6aVzFXVWjerAnQKnvrMTSNOoqDi2xSh3JvdXareZi', 'Amiel Carhyl', 'Lapid', 'None', 'Super Admin', 0),
(9, 'brix', '$2y$10$YsZlW0jjCQU7eUHxACvSxuo4oXDCvnLE9FWNmFo89BA9ndh1Gh6sa', 'Brix', 'Ferraris', 'None', 'Super Admin', 21),
(10, 'clar123', '$2y$10$BdL6rnKfHdaIsPJs5yOxLuahrv6fEdK0fPZx0K9ZpxY1DESEwIt0W', 'clar', 'darius', '0954321311', 'Customer', 0),
(11, 'amiellapid06@gmail.com', '$2y$10$pFr2eqlh/eTH98bAYFGopeApS7HG5LP5L9WmdheEcNwQdjmNAySt6', 'Amiel Carhyl', 'Lapid', '09940576891', 'Customer', 18);

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
(12, 11, 'sample po', 21, 32, 18, '6706fc6b341d33.46212256.png', 'false'),
(13, 18, 'White', 25, 26, 9, '672f2e5957e2b8.08065199.png', 'false'),
(14, 11, 'White', 20, 20, 12, '672f3284d6fdc2.21053179.png', 'false'),
(15, 12, 'White', 12, 32, 12, '673041f114e835.95422197.png', 'false'),
(16, 17, 'Brown', 25, 24, 10, '6738a6f15ae1a2.90674490.jpg', 'true'),
(17, 17, '5', 27, 27, 0, '6738a752dd4d99.37358780.webp', 'true'),
(18, 13, 'Blue', 123, 12, 8, '6738a7e46919f0.14264527.webp', 'false'),
(19, 19, 'Brown', 31, 30, 6, '6738a8112e1719.22493591.png', 'false'),
(20, 11, 'Blue Jorts', 123, 32, 12, '6738a83aafff29.12445481.jpg', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
