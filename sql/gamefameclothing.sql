-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sep 25, 2019 at 11:17 AM
-- Server version: 8.0.12
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamefameclothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `size` varchar(4) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `prize` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `size`, `brand`, `prize`, `quantity`, `gender`, `category`, `Description`) VALUES
(1, '45', 'Nike', 200, 10, 'Men', 'Shoes', 'Fancy Shoes'),
(2, '44', 'Puma', 100, 5, 'Women', 'Shoes', 'Sports Shoes'),
(3, '42', 'Adidas', 150, 20, 'Women', 'Shoes', 'Runner Shoes'),
(4, '44', 'Gucci', 350, 4, 'Men', 'Shoes', 'Fashion Shoes'),
(5, 'L', 'Bape', 150, 10, 'Men', 'Shirt', 'Very expensive'),
(6, 'XL', 'Supreme', 200, 30, 'Men', 'Shirt', 'Fancy shirt'),
(7, 'm', 'Adidas', 50, 100, 'Women', 'Shirt', 'Sporttshirt'),
(8, 'S', 'Nike', 30, 25, 'Kids', 'Shirt', 'Cheap kids shirt'),
(9, 'L', 'Bape', 350, 7, 'Women', 'Sweatshirts', 'Very expensive'),
(10, 'L', 'Supreme', 200, 17, 'Kids', 'Sweatshirts', 'Rare sweatshirt'),
(11, 'XL', 'Adidas', 100, 15, 'Men', 'Sweatshirts', 'Sport swearshirt'),
(12, 'L', 'Nike', 90, 45, 'Women', 'Sweatshirts', 'Cheap sweatshirt'),
(13, '44', 'Nike', 15, 30, 'Men', 'Socks', 'For runners'),
(14, '35', 'Nike', 15, 20, 'Women', 'Socks', 'For runners'),
(15, 'One', 'Supreme', 100, 10, 'Kids', 'Caps', 'Rare and expensive'),
(16, 'One', 'NFL', 40, 10, 'Men', 'Caps', 'Football Cap'),
(17, 'One', 'NBA', 45, 20, 'Women', 'Caps', 'Basketball Cap'),
(18, 'One', 'MLB', 50, 30, 'Kids', 'Caps', 'Baseball Cap'),
(19, '35', 'Adidas', 10, 50, 'Women', 'Socks', 'Runner Socks'),
(20, '44', 'Adidas', 10, 50, 'Men', 'Socks', 'Runner Socks');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `prename` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `prename`, `name`, `email`, `password`) VALUES
(1, 'Tim', 'tom', 'abc@abc.ch', '123123'),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
