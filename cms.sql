-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 07:19 PM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_public` tinyint(1) NOT NULL,
  `category_position` int(45) NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_public`, `category_position`, `cat_image`) VALUES
(1, 'BURGERI', 1, 1, 'uploads/burger.jpg'),
(2, 'PICAS', 1, 2, 'uploads/pizza.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category_foods`
--

CREATE TABLE `category_foods` (
  `food_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category_foods`
--

INSERT INTO `category_foods` (`food_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_public` tinyint(1) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cooktime` varchar(45) NOT NULL,
  `food_position` int(45) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `food_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `food_public`, `description`, `cooktime`, `food_position`, `price`, `food_image`) VALUES
(1, 'DUBULTAIS SIERA BURGERS', 1, 'Pasta staple, vistas fileja, burkāni, baltās pupiņas, paprika, kaltēti tomāti, zilais siers, saldais krējums, sīpoli', '15 MIN', 1, 12.43, 'uploads/burger1.jpg'),
(2, 'SIERA BURGERS', 1, 'Pasta staple, vistas fileja, burkāni, baltās pupiņas, paprika, kaltēti tomāti, zilais siers, saldais krējums, sīpoli', '10 MIN', 2, 12.99, 'uploads/burger2.jpg'),
(3, 'SIERA PICA', 1, 'Pasta staple, vistas fileja, burkāni, baltās pupiņas, paprika, kaltēti tomāti, zilais siers, saldais krējums, sīpoli', '30 MIN', 1, 10.00, 'uploads/pizza2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `public`, `user_id`) VALUES
(1, 'BRIVDIENU PIEDAVAJUMS', 1, 1),
(2, 'DARBADIENU PIEDAVAJUMS', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`menu_id`, `category_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `regnum` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `swift` varchar(255) NOT NULL,
  `bankaccnum` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `businessname`, `regnum`, `address`, `bank`, `swift`, `bankaccnum`, `user_id`, `post_image`) VALUES
(1, 'SIA PICA', 'LV123456789', 'Rigas iela 55', 'SWED BANK', 'LV HABA 12345', 'LV11HABA4332423432', 1, 'uploads/logo.png'),
(2, 'SIA BURGER', 'LV123456789', 'Valmiermuizas iela', 'citadele', 'LV HABA 12345', 'LV11HABA634633', 2, 'uploads/logo2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user', '$2y$10$4UvGDb.NiheHMg0KvG7GveKI180ztVghahS7H1v9g/UEnsXcklznW'),
(2, 'user2', '$2y$10$zQkmwUSxpKdc9tEnx1YHWe3xD6fAD4ZMmjx6cDv7x4fC/fo/7m67m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `category_foods`
--
ALTER TABLE `category_foods`
  ADD PRIMARY KEY (`food_id`,`category_id`),
  ADD KEY `fk_foods_has_categories_categories1_idx` (`category_id`),
  ADD KEY `fk_foods_has_categories_foods1_idx` (`food_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_menu_users1_idx` (`user_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`menu_id`,`category_id`),
  ADD KEY `fk_menu_has_categories_categories1_idx` (`category_id`),
  ADD KEY `fk_menu_has_categories_menu1_idx` (`menu_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_posts_users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_foods`
--
ALTER TABLE `category_foods`
  ADD CONSTRAINT `fk_foods_has_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_foods_has_categories_foods1` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD CONSTRAINT `fk_menu_has_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_menu_has_categories_menu1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
