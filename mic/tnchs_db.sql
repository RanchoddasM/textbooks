-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 02:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tnchs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(6) NOT NULL,
  `name` varchar(191) NOT NULL,
  `pass` varchar(191) NOT NULL,
  `empoyee_num` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `pass`, `empoyee_num`) VALUES
(1, 'mic', 'mic', '0926');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(50) NOT NULL,
  `textB` int(50) NOT NULL,
  `orderby` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `textB` int(11) NOT NULL,
  `quanti` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderby`, `textB`, `quanti`) VALUES
(1, 6, 1, 3),
(2, 6, 2, 12),
(3, 6, 3, 2),
(4, 6, 4, 3),
(5, 6, 5, 1),
(6, 5, 1, 1),
(7, 5, 2, 1),
(8, 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `textb`
--

CREATE TABLE `textb` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `textb`
--

INSERT INTO `textb` (`id`, `title`, `image`, `price`) VALUES
(1, 'English Grammar', 'book1.jpg', 149),
(2, 'The Big Book of SCIENCE FICTION', 'book2.jpg', 139),
(3, 'FILIPINO', 'dog1.png', 139),
(4, 'Badong (test)', 'doge.jpg', 2100000),
(5, 'Physics', 'phy.jpg', 219),
(7, 'testttt', 'background.png', 150);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`) VALUES
(1, 's', '03c7c0ace395d80182db07ae2c30f034', 's'),
(2, 'patsu', 'b30bd351371c686298d32281b337e8e9', 'simon'),
(3, 'try', '080f651e3fcca17df3a47c2cecfcb880', 'try'),
(4, 'ssf', '1c14e22e616216736c55a3a3b9f508c0', 'ssf'),
(5, 'ya', 'd74600e380dbf727f67113fd71669d88', 'ya'),
(6, 'simon', 'b30bd351371c686298d32281b337e8e9', 'simon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `textbook` (`textB`),
  ADD KEY `order` (`orderby`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderer` (`orderby`),
  ADD KEY `textB` (`textB`);

--
-- Indexes for table `textb`
--
ALTER TABLE `textb`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `textb`
--
ALTER TABLE `textb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `order` FOREIGN KEY (`orderby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `textbook` FOREIGN KEY (`textB`) REFERENCES `textb` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orderer` FOREIGN KEY (`orderby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `textB` FOREIGN KEY (`textB`) REFERENCES `textb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
