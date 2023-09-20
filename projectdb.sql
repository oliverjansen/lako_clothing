-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 09:47 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date_ordered` datetime NOT NULL,
  `date_cancelled` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `user_id`, `total`, `date_ordered`, `date_cancelled`) VALUES
(1, 1, 5000.00, '2019-10-07 13:31:46', '2019-10-07 13:41:46'),
(2, 3, 67125.00, '2019-10-07 13:37:48', '2019-10-07 15:38:25'),
(3, 3, 424.00, '2019-10-07 13:40:31', '2019-10-07 15:38:28'),
(4, 1, 1000.00, '2019-10-07 13:41:21', '2019-10-07 15:37:22'),
(5, 2, 1234.00, '2019-10-07 15:30:54', NULL),
(6, 2, 699.00, '2019-10-07 15:33:46', NULL),
(7, 3, 349.00, '2019-10-07 15:38:12', '2019-10-07 15:38:35'),
(8, 3, 250.00, '2019-10-07 15:38:52', NULL),
(9, 3, 1234.00, '2019-10-07 15:42:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`, `total`) VALUES
(1, 7, 30, 349.00, 1, 349.00),
(2, 8, 29, 250.00, 1, 250.00),
(3, 9, 28, 1234.00, 1, 1234.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `category` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `category`, `name`, `image`, `price`) VALUES
(26, 'MEN', 'Chemistry Shirt', 'received_507001576698510.jpeg', 150.00),
(28, 'WOMEN', '1234', 'received_664278233978893.jpeg', 1234.00),
(17, 'MEN', 'Brown Hippie Shirt', 'received_921247748229400.jpeg', 500.00),
(20, 'MEN', 'Oxford Dress Shirt', 'received_500044424161976.jpeg', 950.00),
(29, 'WOMEN', 'Mark 11:24 Shirt', 'received_509052196553719.jpeg', 250.00),
(15, 'MEN', 'Soft Fitted Long Sleeves', 'received_500024654172938.jpeg', 1500.00),
(16, 'MEN', 'Floral Polo Shirt', 'received_770559680066938.jpeg', 600.00),
(18, 'MEN', 'Striped Notched Colorblock Shirt', 'received_546908666078678.jpeg', 850.00),
(19, 'MEN', 'Cavalli Floral Shirt', 'received_524309755011268.jpeg', 780.00),
(21, 'MEN', 'Plain Heather Grey T Shirt', 'received_462243871078144.jpeg', 350.00),
(22, 'MEN', 'Lurking Class Polo', 'received_407717036557553.jpeg', 450.00),
(23, 'MEN', 'Ahegao Shirt', 'received_386321812318518.jpeg', 200.00),
(24, 'MEN', 'Striped Notched Colorblock Polo', 'received_2684849748273307.jpeg', 699.00),
(30, 'WOMEN', 'Penrose Triangle Shirt', 'received_705107486637996.jpeg', 349.00),
(31, 'WOMEN', 'White Shirt \"Adventure\"', 'received_699755437194230.jpeg', 300.00),
(32, 'WOMEN', 'Plain Authenthic Chanel', 'received_2462312337320882.jpeg', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `user_first` varchar(100) NOT NULL,
  `user_last` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_uid` varchar(100) NOT NULL,
  `user_pwd` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_address`) VALUES
(1, 'adw', 'daw', 'jemarmalupangue@gmail.com', 'admins', '$2y$10$epqFsh2e3lm4dyI4UcG.B.RuBo.vqW1UQ0aupAJaEFnKLTFbSCBdW', 'awdawdaw'),
(2, 'test', 'test', 'test@y.com', 'test', '$2y$10$epqFsh2e3lm4dyI4UcG.B.RuBo.vqW1UQ0aupAJaEFnKLTFbSCBdW', 'test'),
(3, 'oli', 'jja', 'gg@gmail.com', 'oliver', '$2y$10$kMW15PepU0MKxDq.znORNePLYDKeRKloNZMUwSPqS5RR4fTaBP8Ju', 'wjdkjwkhfwjhf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
