-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 01:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `category_name` varchar(45) NOT NULL,
  `category_public` tinyint(4) NOT NULL,
  `category_position` varchar(45) DEFAULT NULL,
  `cat_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_public`, `category_position`, `cat_image`) VALUES
(135, 'PICAS', 1, 'PICAS', 'uploads/pizza.jpg'),
(136, 'BURGERI', 1, 'BURGERI', 'uploads/burger.jpg'),
(137, 'ZUPAS', 1, 'ZUPAS', 'uploads/pumkin soup.jpeg'),
(138, 'SALATI', 1, 'SALATI', ''),
(143, 'PICAS', 1, '2', 'uploads/pizza.jpg'),
(144, 'BROKASTIS', 1, '1', 'uploads/burger.jpg'),
(145, '', 1, '', '');

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
(151, 135),
(152, 135);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `food_name` varchar(45) NOT NULL,
  `food_public` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cooktime` varchar(45) NOT NULL,
  `food_position` varchar(45) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `activestart` time(6) NOT NULL,
  `activeend` time(6) DEFAULT NULL,
  `food_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `food_public`, `description`, `cooktime`, `food_position`, `price`, `activestart`, `activeend`, `food_image`) VALUES
(151, 'SIERA BURGERS', 1, 'Sēklu maize, kausēts siers, sīpoli, marinets gurķis, liellopa gaļa, kūpināts bekonsSēklu maize, kausēts siers, sīpoli, marinets gurķis, liellopa gaļa, kūpināts bekons', '15 MIN', '1', 12.32, '12:32:00.000000', '04:34:00.000000', 'uploads/burger.jpg'),
(152, 'SIERA PICA', 1, 'Pasta staple, vistas fileja, burkāni, baltās pupiņas, paprika, kaltēti tomāti, zilais siers, saldais krējums, sīpoli', '30 MIN', '2', 22.00, '23:33:00.000000', '04:44:00.000000', 'uploads/pizza.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(45) NOT NULL,
  `public` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `public`, `user_id`) VALUES
(101, 'BRIVDIENU PIEDAVAJUMS', 1, 3),
(105, 'FGHDGFDDFG', 0, 3),
(106, '', 1, 9);

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
(101, 135),
(101, 136),
(101, 137),
(101, 138),
(105, 143),
(105, 144),
(106, 145);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `businessname` varchar(255) DEFAULT NULL,
  `regnum` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `swift` varchar(255) DEFAULT NULL,
  `bankaccnum` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `post_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `businessname`, `regnum`, `address`, `bank`, `swift`, `bankaccnum`, `created_at`, `user_id`, `post_image`) VALUES
(20, 'SIA PICA', 'LV123456789', 'Rigas iela 55', 'SWED BANK', 'LV HABA 12345', 'LV11HABA4332423432', '2024-05-27 11:06:50', 3, 'uploads/logo.png'),
(22, 'SIA STROPS', 'SIA STROPS', 'SIA STROPS', 'SIA STROPS', 'SIA STROPS', 'SIA STROPS', '2024-06-05 06:47:20', 9, '');

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
(3, 'user', '$2y$10$eWiVwpAZH08qbaHMVjDuJuXauNQGcVoWeEGt5ytT9O9JvelU6JXPS'),
(9, 'john', '$2y$10$sUzQjbh3FLBVf2IIpWbRTuacPAm/hWhEbVCzTNMPqxX6.Jzy.gx2K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `fk_posts_users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
