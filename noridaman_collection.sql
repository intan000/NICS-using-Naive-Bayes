-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2023 at 07:54 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noridaman_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_password`) VALUES
(1, 'Hanis', 'hanis@gmail.com', '6955ad5072fd9410227b10eb5bbb55e4'),
(2, 'Intan Syafiqah', 'intan@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(3, 'Alia', 'alia@gmail.com', '6ad0550bd56af2cb30934c5239cdb38f'),
(4, 'Aila Mimi', 'aila@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(5, 'Ainul', 'Ainul@gmail.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`, `product_color`) VALUES
(8, 'Delune in Black', 'kedah', 'Available size : S, M, L, XL', 'Delune in Black1.jpeg', '150.00', 'Black'),
(9, 'Deluna in Peach', 'modern', 'Available size : S, M, L, XL', 'Deluna in Peach1.jpeg', '150.00', 'Peach'),
(10, 'Deluna in Maroon ', 'modern', 'Available size : S, M, L, XL', 'Deluna in Maroon 1.jpeg', '150.00', 'Maroon'),
(11, 'Qaseh in Brown', 'kedah', 'Available size : S, M, L', 'Qaseh Baju Kurung Kedah in Brown1.jpeg', '150.00', 'Brown'),
(12, 'Qaseh in Maroon', 'kedah', 'Available size : S, M, L', 'Qaseh Baju Kurung Kedah in Maroon1.jpeg', '150.00', 'Maroon'),
(13, 'Qaseh in White', 'kedah', 'Available size : S, M, L', 'Qaseh in White1.jpeg', '150.00', 'White'),
(14, 'Embun Kebaya in Nude', 'kebaya', 'Available size : S, M, L', 'Embun Kebaya in Nude1.jpeg', '160.00', 'Nude'),
(15, 'Embun Kebaya in Soft Purple', 'kebaya', 'Available size : S, M, L', 'Embun Kebaya in Soft Purple1.jpeg', '160.00', 'Soft Purple'),
(16, 'Embun Kebaya in White', 'kebaya', 'Available size : S, M, L', 'Embun Kebaya in White1.jpeg', '160.00', 'White'),
(17, 'Manis Kurung Riau in Nude', 'riau', 'Available size : S, M, L, XL', 'Manis Kurung Riau in Nude1.jpeg', '150.00', 'Nude'),
(18, 'Baju Kurung Moden 2022', 'riau', 'Available size : S, M, L, XL', 'Baju Kurung Moden 20221.jpeg', '160.00', 'red'),
(19, 'Baju Kurung Riau Yellow', 'riau', 'Available size : S, M, L, XL', 'Baju Kurung Riau Yellow1.jpeg', '160.00', 'Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_cost` decimal(6,2) NOT NULL,
  `purchase_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `cust_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `payment_receipt` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_cost`, `purchase_status`, `cust_id`, `user_name`, `user_phone`, `user_city`, `user_address`, `payment_receipt`, `purchase_date`) VALUES
(70, '300.00', 'Not paid', 2, 'Intan ', 192410868, 'Kulim', 'kedah', '3001.jpeg', '2023-02-18'),
(71, '450.00', 'Not paid', 2, 'Ainul', 858, 'Kulai', 'Johor', '4501.jpeg', '2023-02-18'),
(72, '450.00', 'Not paid', 2, 'Hanis', 192410868, 'Kulim', 'Melaka', '4501.jpeg', '2023-02-18'),
(73, '450.00', 'Not paid', 2, 'Customer', 192410868, 'Sik ', 'Kedah', '4501.jpeg', '2023-02-18'),
(78, '150.00', 'Not paid', 2, 'Intan Syafiqah', 192410868, 'Kulim', 'kedah', '1501.jpeg', '2023-02-20'),
(80, '150.00', 'Not paid', 2, 'Intan Syafiqah', 858, 'Kulim', 'Johor', '1501.jpeg', '2023-02-20'),
(81, '300.00', 'paid', 5, 'Ainul', 858, 'Kulim', 'Kedah', '3001.jpeg', '2023-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `item_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_size` varchar(11) NOT NULL,
  `purchase_quantity` int(100) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`item_id`, `purchase_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_size`, `purchase_quantity`, `cust_id`, `purchase_date`) VALUES
(42, 50, '15', 'Embun Kebaya in Soft Purple', 'Embun Kebaya in Soft Purple1.jpeg', '160.00', '', 1, 2, '2023-02-17'),
(43, 50, '8', 'Delune in Black', 'Delune in Black1.jpeg', '150.00', '', 1, 2, '2023-02-17'),
(44, 51, '15', 'Embun Kebaya in Soft Purple', 'Embun Kebaya in Soft Purple1.jpeg', '160.00', '', 1, 2, '2023-02-17'),
(45, 52, '15', 'Embun Kebaya in Soft Purple', 'Embun Kebaya in Soft Purple1.jpeg', '160.00', '', 1, 2, '2023-02-17'),
(46, 53, '13', 'Qaseh in White', 'Qaseh in White1.jpeg', '150.00', '', 1, 2, '2023-02-17'),
(47, 54, '13', 'Qaseh in White', 'Qaseh in White1.jpeg', '150.00', '', 1, 2, '2023-02-17'),
(48, 68, '9', 'Deluna in Peach', 'Deluna in Peach1.jpeg', '150.00', '', 1, 2, '2023-02-17'),
(49, 69, '8', 'Delune in Black', 'Delune in Black1.jpeg', '150.00', '', 1, 2, '2023-02-17'),
(50, 69, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-17'),
(51, 70, '8', 'Delune in Black', 'Delune in Black1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(52, 70, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(53, 71, '8', 'Delune in Black', 'Delune in Black1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(54, 71, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(55, 71, '11', 'Qaseh in Brown', 'Qaseh Baju Kurung Kedah in Brown1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(56, 72, '8', 'Delune in Black', 'Delune in Black1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(57, 72, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(58, 72, '11', 'Qaseh in Brown', 'Qaseh Baju Kurung Kedah in Brown1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(59, 73, '8', 'Delune in Black', 'Delune in Black1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(60, 73, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(61, 73, '11', 'Qaseh in Brown', 'Qaseh Baju Kurung Kedah in Brown1.jpeg', '150.00', '', 1, 2, '2023-02-18'),
(62, 74, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(63, 75, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(64, 76, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(65, 77, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(66, 78, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(67, 79, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(68, 80, '10', 'Deluna in Maroon ', 'Deluna in Maroon 1.jpeg', '150.00', '', 1, 2, '2023-02-20'),
(69, 81, '9', 'Deluna in Peach', 'Deluna in Peach1.jpeg', '150.00', '', 2, 5, '2023-02-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `UX_Constraint` (`cust_email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_name` (`product_name`,`product_price`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_name` (`product_name`),
  ADD KEY `product_image` (`product_image`,`product_price`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
