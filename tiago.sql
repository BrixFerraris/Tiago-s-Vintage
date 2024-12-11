-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 03:39 PM
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
(28, '6745706bdc49b7.18157170.jpg', '11', 1676, '1732603954_11', '2024-11-26 14:53:31'),
(29, '674646be84b155.42184705.png', '11', 765, '1732658870_11', '2024-11-27 06:07:58'),
(30, '67464a30a42818.24728447.jpg', '11', 1350, '1732659485_11', '2024-11-27 06:22:40'),
(31, '67464ded6b9ee9.88600381.png', '11', 121, '1732660708_11', '2024-11-27 06:38:37'),
(32, '6759962c5272e2.51053140.png', '11', 600, '1733841362_11', '2024-12-11 21:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `unit_price` decimal(65,0) NOT NULL,
  `retail_price` decimal(65,0) NOT NULL,
  `category` varchar(100) NOT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `videoInput` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock_alert` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `unit_price`, `retail_price`, `category`, `img1`, `img2`, `img3`, `videoInput`, `description`, `date_added`, `stock_alert`) VALUES
(23, 'Product title', 20, 200, 'T-Shirts', '1733838513_675846b14aaf47.55116172.png', '1733838513_675846b14affb6.11422803.png', '1733838513_675846b14b2448.25271017.png', '1733838513_675846b14b58d6.50061726.mkv', 'description', '2024-12-10 13:48:33', 5);

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
  `rate` decimal(10,3) NOT NULL,
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
(2, '1732052340', 'Drew Billiard', 'White', 'wqeqeqeqeq', 2.000, 'amiel', '673d10b0bc09c6.35493435.jpg', NULL, NULL, 'true', '2024-11-20'),
(3, '1732467393', 'Aby Fishing Vest', '5', 'hqhqhqzkxjcbnzkjx anu ba \'to gumana ka na pls', 2.000, 'amiellapid06@gmail.com', '67463725b32475.73777052.png', '67463725b365f8.73376371.png', '67463725b38c22.01034517.png', 'true', '2024-11-27'),
(4, '1732467393', 'Aby Fishing Vest', '5', 'weqeqeq', 5.000, 'amiellapid06@gmail.com', '67463758e86b69.32172813.png', '67463758e8b1f1.50462292.png', '67463758e8d930.64699296.png', 'false', '2024-11-27'),
(5, '1732467393', 'Aby Fishing Vest', '5', 'wewewewew', 4.000, 'amiellapid06@gmail.com', '674638589688d8.31705485.png', '6746385896b8c9.55398308.png', NULL, 'false', '2024-11-27'),
(6, '1732467393', 'Aby Fishing Vest', '5', 'weqeqeq', 4.500, 'amiellapid06@gmail.com', '674638a2790770.46645346.png', NULL, NULL, 'true', '2024-11-27'),
(7, '1732467393', 'Aby Fishing Vest', '5', 'awdawd', 4.500, 'amiellapid06@gmail.com', '674638ec575cf6.36853553.png', NULL, NULL, 'true', '2024-11-27'),
(8, '1732467393', 'Aby Fishing Vest', '5', '', 1.000, 'amiellapid06@gmail.com', '67463b506cf086.27900839.jpg', NULL, NULL, 'true', '2024-11-27'),
(9, '1732467393', 'Aby Fishing Vest', '5', 'awdqwqeq', 1.000, 'amiellapid06@gmail.com', '67463bb2c36227.22344951.jpg', NULL, NULL, 'true', '2024-11-27'),
(10, '1732586346', 'Aby Fishing Vest', 'Brown', 'wqeqeqe', 5.000, 'amiellapid06@gmail.com', '67463d31a4b373.24918568.png', NULL, NULL, 'false', '2024-11-27');

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
(1, 'Tiago\'s Vintage Botique', '6745719a203149.86962530-1732604314.png', '672a317ea782d4.64406569-1730818430.jpg', 'Vintage Finds, Modern Vibes - Only at Tiago\'s', 'qweqweqe', 'Welcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is plWelcome to Tiago\'s Vintage Boutique Ordering System. By placing an order through our system, you agree to the following terms and conditions:\r\n\r\n1. Payment\r\nWe only accept payments via Gcash. No other payment methods will be accepted.\r\nOnce an order is pl', 'https://www.facebook.com/profile.php?id=100063803240125', 'https://www.instagram.com/tiagos_vintage_/', 'vinceasdfghj@gmail.com', '0995 795 6315', 'Southboys Garage Bayan Luma 5 Imus Cavite ', '67451f63d4f539.72112300.jpg', 'ehehehe', '6745a577681e37.31688169.png', '6745a577684ce4.98842817.png', '6745a577686bc6.32607911.jpg', '6745a5776884d3.46611149.png');

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
  `reason` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `shipping` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `seen` varchar(255) NOT NULL DEFAULT 'false',
  `reviewed` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `user_id`, `date`, `total`, `grand_total`, `status`, `reason`, `discount`, `shipping`, `address`, `seen`, `reviewed`) VALUES
(109, '1733841362_11', '23', '22', 3, '11', '2024-12-11 14:02:19', 600, 600, 'Cancelled', 'ghehehehe bibiboboob', '', 'pickup', '', 'false', 'false'),
(110, '1733926020_11', '23', '22', 3, '11', '2024-12-11 14:07:15', 600, 600, 'Cancelled', '', '', 'pickup', '', 'false', 'false');

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
(11, 'amiellapid06@gmail.com', '$2y$10$pFr2eqlh/eTH98bAYFGopeApS7HG5LP5L9WmdheEcNwQdjmNAySt6', 'Amiel Carhyl', 'Lapid', '09940576891', 'Customer', 1),
(15, 'adriel.cyril.lapid@gmail.com', '$2y$10$n05Vpnvh7EyyggvKZap2Me/rS8fR63CZaiisedKjkw4viDmDiX2hq', 'Adriel', 'Cyril', '09057687231', 'Customer', 0);

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
  `vid_variation` varchar(255) NOT NULL,
  `seen` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_variations`
--

INSERT INTO `tbl_variations` (`id`, `product_id`, `variationName`, `width`, `length`, `quantity`, `vid_variation`, `seen`) VALUES
(22, 23, 'sample po', 21, 23, 3, '1733838541_675846cda73dc9.51218269.mkv', 'false');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_variations`
--
ALTER TABLE `tbl_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
