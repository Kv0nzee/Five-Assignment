-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 09:04 AM
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
-- Database: `zyl`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catID` int(11) NOT NULL,
  `productCat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `productCat`) VALUES
(1, 'Appliances'),
(2, 'Electronics'),
(3, 'Kitchen'),
(4, 'Electronics'),
(5, 'Appliances'),
(6, 'Clothing'),
(7, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentType` varchar(300) NOT NULL DEFAULT 'kpay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `paymentType`) VALUES
(1, 1, '2024-01-10 02:52:07', 'kpay'),
(2, 1, '2024-01-10 02:52:11', 'kpay'),
(3, 1, '2024-01-10 02:52:14', 'kpay'),
(4, 2, '2024-01-10 08:19:59', 'kpay'),
(5, 2, '2024-01-12 10:12:06', 'ayapay');

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
(1, 1, 2, 21),
(2, 1, 4, 2),
(3, 4, 4, 4),
(4, 4, 1, 1),
(5, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `catId` int(11) DEFAULT NULL,
  `productDescription` text DEFAULT NULL,
  `productPrice` float DEFAULT NULL,
  `productStock` int(11) DEFAULT NULL,
  `productImg` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `catId`, `productDescription`, `productPrice`, `productStock`, `productImg`) VALUES
(1, 'Smartphone', 1, 'High-end smartphone with advanced features.', 699.99, 50, 'images/smartphone.jpg'),
(2, 'Refrigerator', 2, 'Energy-efficient refrigerator with ample storage.', 899.99, 30, 'images/refrigerator.png'),
(4, 'Sofa', 4, 'Luxurious sofa for your living room.', 1299.99, 10, 'images/couch.png'),
(8, 'Sofa test', 7, 'Luxurious sofa for your living room.', 1299.99, 10, 'images/product-3.png'),
(9, 'Smartphone', 1, 'High-end smartphone with advanced features.', 699.99, 50, ''),
(10, 'Refrigerator', 2, 'Energy-efficient refrigerator with ample storage.', 899.99, 30, ''),
(12, 'Sofa', 4, 'Luxurious sofa for your living room.', 1299.99, 10, ''),
(14, 'Refrigerator', 2, 'Energy-efficient refrigerator with ample storage.', 899.99, 30, ''),
(16, 'Sofa', 4, 'Luxurious sofa for your living room.', 1299.99, 10, ''),
(17, 'Smartphone', 1, 'High-end smartphone with advanced features.', 699.99, 50, ''),
(18, 'Refrigerator', 2, 'Energy-efficient refrigerator with ample storage.', 899.99, 30, ''),
(20, 'Sofa', 4, 'Luxurious sofa for your living room.', 1299.99, 10, ''),
(23, 'test', 3, 'fdsaf asdfsad fsadf sadf asdfasdfasdfas', 222, 13, 'images/product-2.png'),
(24, 'Smartphone', 1, 'High-end smartphone with advanced features.', 699.99, 50, 'images/smartphone.jpg'),
(25, 'Refrigerator', 2, 'Energy-efficient refrigerator with ample storage.', 899.99, 30, 'images/refrigerator.png'),
(26, 'T-shirt', 3, 'Comfortable cotton T-shirt for everyday wear.', 19.99, 100, 'images/couch.png'),
(27, 'Sofa', 4, 'Luxurious sofa for your living room.', 1299.99, 10, 'images/product-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPass` varchar(250) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userAddress` varchar(150) DEFAULT NULL,
  `userPhone` varchar(25) NOT NULL,
  `userType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPass`, `userEmail`, `userAddress`, `userPhone`, `userType`) VALUES
(1, 'user', '$2y$10$yakGjjmFosd0JSAoGZDtXODaSPlwOIIN6q1e3d2yy.TJCQHifWnlm', 'user@gmail.com', '1963', '1963', 'user'),
(2, 'admin', '$2y$10$ppnDhA.GPmR1bnoCF8aKkuLnKoxuwU72lxbSCMxp5ZMAC/4uPVEoK', 'admin@gmail.com', '2131', '1231', 'admin'),
(3, 'kzh', '$2y$10$LgpbIcc.0rgl3jfB1FXoFuI1UBnWkMiOdGAPWJFEVSf.NJaDH4C5y', 'zyl@gmail.com', '123', '113', 'admin'),
(4, 'dasf', '$2y$10$LJNkcHOz8TuHMecRX9pure3pnO/vQJHbqmDijdqGX87A1Qp9gO87K', 'fds@gmail.com', '123', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`);

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
  ADD PRIMARY KEY (`productID`),
  ADD KEY `catId` (`catId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`productID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `category` (`catID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
