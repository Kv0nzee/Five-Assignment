-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 09:02 AM
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
-- Database: `rangoonsuper`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`) VALUES
(1, 10, '2024-01-06 00:04:41'),
(2, 10, '2024-01-07 20:29:29'),
(3, 10, '2024-01-07 20:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 5, 80),
(2, 1, 4, 120),
(3, 1, 3, 50),
(4, 1, NULL, 50),
(5, 2, 5, 80),
(6, 2, 4, 120),
(7, 2, 6, 60),
(8, 3, 4, 120),
(9, 3, 5, 80),
(10, 3, 6, 60),
(11, 3, 3, 50),
(12, 3, 7, 90);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stockQuantity` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stockQuantity`, `category`, `img`) VALUES
(3, 'Product C', 'test1', 39.99, 50, 'Electronics', 'img/facebook.jpg'),
(4, 'Product D', 'Description for Product D', 49.99, 120, 'Electronics', ''),
(5, 'Product E', 'Description for Product E', 59.99, 80, 'Books', ''),
(6, 'Product F', 'Description for Product F', 69.99, 60, 'Clothing', ''),
(7, 'Product G', 'Description for Product G', 79.99, 90, 'Electronics', ''),
(8, 'Product H', 'Description for Product H', 89.99, 110, 'Home and Garden', ''),
(9, 'Product I', 'Description for Product I', 99.99, 30, 'Books', ''),
(10, 'Product J', 'Description for Product J', 109.99, 45, 'Clothing', ''),
(12, 'Product L', 'Description for Product L', 129.99, 85, 'Home and Garden', ''),
(13, 'Product M', 'Description for Product M', 139.99, 95, 'Books', ''),
(14, 'Product N', 'Description for Product N', 149.99, 100, 'Clothing', ''),
(15, 'Product O', 'Description for Product O', 159.99, 110, 'Electronics', ''),
(16, 'Product P', 'Description for Product P', 169.99, 120, 'Home and Garden', ''),
(17, 'Product Q', 'Description for Product Q', 179.99, 130, 'Books', ''),
(18, 'Product R', 'Description for Product R', 189.99, 140, 'Clothing', ''),
(19, 'Product S', 'Description for Product S', 199.99, 150, 'Electronics', ''),
(20, 'Product T', 'Description for Product T', 209.99, 160, 'Home and Garden', ''),
(21, 'Product U', 'Description for Product U', 219.99, 170, 'Books', ''),
(22, 'Product V', 'Description for Product V', 229.99, 180, 'Clothing', ''),
(23, 'Product W', 'Description for Product W', 239.99, 190, 'Electronics', ''),
(24, 'Product X', 'Description for Product X', 249.99, 200, 'Home and Garden', ''),
(25, 'Product Y', 'Description for Product Y', 259.99, 210, 'Books', ''),
(26, 'Product Z', 'Description for Product Z', 269.99, 220, 'Clothing', ''),
(27, 'Product AA', 'Description for Product AA', 279.99, 230, 'Electronics', ''),
(28, 'Product BB', 'Description for Product BB', 289.99, 240, 'Home and Garden', ''),
(29, 'fdsaf', 'sfda', 123.00, 312, 'Foods', ''),
(30, 'fdsaf', 'sfda', 123.00, 312, 'Foods', ''),
(32, 'test', 'dsfasdf', 133.00, 21, 'Cloths', 'img/apple.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`) VALUES
(1, 'kzh', 'kzh@gmail.com', '$2y$10$tu33x.Rbe4xjrbdeHBJCeeM7dTvVHG68vzBgCY4oESD', 'admin'),
(3, 'Alice Johnson', 'alice@example.com', '$2y$10$o7.Yvo4z5tfQedgXj2XRw.5lriGyPf5eonrtJ.aIt8M', 'admin'),
(4, 'Bob Wilson', 'bob@example.com', 'password4', ''),
(5, 'Eva Davis', 'eva@example.com', 'password5', ''),
(6, 'Charlie Brown', 'charlie@example.com', 'password6', ''),
(7, 'Diana Miller', 'diana@example.com', 'password7', ''),
(9, 'kaung', 'kaung@gmail.com', '$2y$10$33FTh8t2sNMM1ja2gEk46OlBSepeQ/kgQQQb07v0vL6dcTseSIs2y', 'user'),
(10, 'admin', 'admin@gmail.com', '$2y$10$dYpON5BpdtWsDxPR9FRxwu6jRMwJO4bIpX4PN9X.5Jju1Bhw45UjW', 'admin'),
(11, 'test', 'test@gmail.com', '$2y$10$kDAfwUtF0svkVJRH3hoOlOsoVQOjC241xHI.D3/7aE.dHp5pmOYam', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
