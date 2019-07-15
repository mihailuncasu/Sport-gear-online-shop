-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 06:37 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `decarton`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(45) NOT NULL,
  `brand` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `price` float NOT NULL,
  `gender` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `brand`, `color`, `price`, `gender`, `stock`, `promo`) VALUES
(1, 't-shirt', 'domoyos', 'blue', 10.2, 'men', 87, 0),
(2, 't-shirt', 'sportee', 'white', 19.9, 'women', 10, 15),
(3, 't-shirt', 'quechua', 'blue', 5.89, 'men', 15, 20),
(4, 't-shirt', 'kalenji', 'yellow', 23, 'women', 22, 17),
(5, 't-shirt', 'inesis', 'red', 30, 'women', 100, 30),
(6, 't-shirt', 'domoyos', 'black', 20, 'men', 116, 29),
(7, 't-shirt', 'domoyos', 'gray', 25.5, 'men', 19, 40),
(9, 'short', 'tarmak', 'black', 20, 'women', 90, 15),
(10, 'short', 'solognac', 'green', 19, 'women', 29, 10),
(11, 'short', 'oloian', 'blue', 12, 'men', 21, 0),
(12, 'short', 'kipsta', 'blue', 30.2, 'men', 90, 12),
(13, 'short', 'hendaia', 'blue', 29, 'women', 90, 0),
(14, 'short', 'forclaz', 'brown', 29, 'men', 92, 19),
(15, 'short', 'domoyos', 'black', 30, 'men', 18, 65),
(16, 'shirt', 'forclaz', 'brown', 24, 'men', 29, 0),
(17, 'shirt', 'domoyos', 'blue', 43, 'men', 100, 17),
(18, 'poncho', 'quechua', 'gray', 29, 'men', 30, 15),
(19, 'poncho', 'quechua', 'blue', 29, 'women', 40, 15),
(20, 'pants', 'solognac', 'green', 30, 'men', 89, 0),
(21, 'pants', 'solognac', 'brown', 32, 'men', 19, 57),
(22, 'pants', 'quechua', 'blue', 25.4, 'men', 89, 19),
(23, 'pants', 'quechua', 'black', 23.6, 'women', 90, 19),
(24, 'pants', 'inesis', 'blue', 24.5, 'men', 19, 20),
(25, 'pants', 'inesis', 'blue', 14.9, 'women', 12, 17),
(26, 'pants', 'forclaz', 'brown', 30, 'women', 100, 30),
(27, 'pants', 'domoyos', 'blue', 10.5, 'men', 116, 29),
(28, 'pants', 'domoyos', 'black', 25.5, 'men', 14, 40),
(29, 'jacket', 'quechua', 'brown', 19, 'women', 60, 19),
(30, 'jacket', 'quechua', 'blue', 25, 'men', 90, 15),
(32, 'shoes', 'hendaia', 'black', 29, 'women', 90, 45),
(33, 'shoes', 'inesis', 'gray', 29, 'women', 90, 10),
(35, 'shoes', 'quechua', 'gray', 40, 'men', 90, 15),
(36, 'shoes', 'quechua', 'brown', 34.4, 'women', 90, 0),
(37, 'shoes', 'quechua', 'blue', 40, 'women', 97, 12),
(38, 'shoes', 'kipsta', 'red', 34.4, 'women', 92, 10),
(39, 'shoes', 'kipsta', 'black', 40, 'men', 90, 15),
(40, 'shoes', 'domoyos', 'black', 34.4, 'women', 90, 0),
(41, 'shoes', 'kalenji', 'gray', 40, 'men', 90, 6),
(42, 'shoes', 'kalenji', 'green', 34.4, 'women', 78, 9),
(43, 'shoes', 'domoyos', 'gray', 30, 'men', 90, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'inactive',
  `role` varchar(45) NOT NULL DEFAULT 'power_user',
  `token` varchar(100) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
