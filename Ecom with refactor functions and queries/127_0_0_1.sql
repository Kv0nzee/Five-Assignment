-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 03:26 AM
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
-- Database: `assignment_new`
--
CREATE DATABASE IF NOT EXISTS `assignment_new` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `assignment_new`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'AC'),
(2, 'Refrigerator'),
(3, 'Microwave'),
(4, 'Washing Machine'),
(5, 'Dishwasher'),
(6, 'Oven'),
(7, 'Blender'),
(8, 'Coffee Maker'),
(9, 'Toaster'),
(10, 'Vacuum Cleaner');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `userID`, `orderDate`, `address`, `totalPrice`) VALUES
(1, 2, '2024-01-11', 'Yangoon', 1583.00),
(2, 2, '2024-01-12', 'Yangoon', 114.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderID`, `productID`, `quantity`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `productPrice` float DEFAULT NULL,
  `productStock` int(11) DEFAULT NULL,
  `imagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `categoryID`, `productPrice`, `productStock`, `imagePath`) VALUES
(1, 'Smartphone', 1, 499, 50, 'image/20200831_223946.jpg'),
(2, 'T-shirt', 2, 19, 100, 'image/apple.jpg'),
(3, 'AC Unit', 3, 799.99, 20, 'image.png'),
(4, 'Refrigerator', 4, 1299.99, 15, 'image.png'),
(5, 'Microwave Oven', 5, 99.99, 30, 'image.png'),
(6, 'Washing Machine', 6, 599.99, 25, 'image.png'),
(7, 'Dishwasher', 7, 449.99, 15, 'image.png'),
(8, 'Oven', 8, 349.99, 10, 'image.png'),
(9, 'Blender', 9, 39.99, 50, 'image.png'),
(11, 'eg', 1, 112, 11, 'image/apple.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPass` varchar(50) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userAddress` varchar(150) DEFAULT NULL,
  `userPhone` varchar(25) DEFAULT NULL,
  `userType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPass`, `userEmail`, `userAddress`, `userPhone`, `userType`) VALUES
(1, 'admin', '123', 'admin@example.com', NULL, NULL, 'admin'),
(2, 'user', '11', 'user@example.com', NULL, NULL, 'user'),
(4, 'kzh', '11', 'zyl@gmail.com', '111', '11', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);
--
-- Database: `ecommerce_81`
--
CREATE DATABASE IF NOT EXISTS `ecommerce_81` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce_81`;

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
(1, 18, '2024-01-05 03:55:36'),
(2, 18, '2024-01-05 03:56:09'),
(3, 18, '2024-01-05 03:57:27'),
(4, 18, '2024-01-08 09:23:49'),
(5, 19, '2024-01-14 21:25:30'),
(6, 19, '2024-01-14 21:25:37');

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
(1, 3, 4, 7),
(2, 3, 5, 1),
(3, 3, 6, 1),
(4, 3, 8, 1),
(5, 4, 6, 1),
(6, 4, 5, 1),
(7, 4, 4, 1),
(8, 5, 5, 1),
(9, 6, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productCat` varchar(50) NOT NULL,
  `productPrice` float NOT NULL,
  `productStock` int(11) DEFAULT NULL,
  `productimg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productCat`, `productPrice`, `productStock`, `productimg`) VALUES
(4, 'phone', 'electronic', 100, 12, 'img/phone.jpg'),
(5, 'light bulb', 'Electronics', 19.99, 100, ''),
(6, 'red light bulb', 'Electronics', 9.99, 100, ''),
(7, 'grenn light bulb', 'Electronics', 29.99, 100, ''),
(8, 'blue bulb', 'Electronics', 39.99, 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPass` varchar(300) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userAddress` varchar(150) NOT NULL,
  `userphone` varchar(25) NOT NULL,
  `userType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPass`, `userEmail`, `userAddress`, `userphone`, `userType`) VALUES
(18, 'kzh', '$2y$10$M1tUH.kFWPA.JWbh0hMWI.SIAn3iaG90tWjb6r8/TTXNRuMlXodw.', 'kzh@gmail.com', '1231', '132123', 'admin'),
(19, 'user', '$2y$10$WdssW.1trZaPkx2sm2LfyumA/4lGLIPp4HxI9gNUHb1YMBX80Zdyu', 'user@gmail.com', '41343', '123', 'user');

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
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"assignment_new\",\"table\":\"products\"},{\"db\":\"assignment_new\",\"table\":\"users\"},{\"db\":\"assignment_new\",\"table\":\"orders\"},{\"db\":\"assignment_new\",\"table\":\"order_items\"},{\"db\":\"assignment_new\",\"table\":\"categories\"},{\"db\":\"zyl\",\"table\":\"products\"},{\"db\":\"zyl\",\"table\":\"users\"},{\"db\":\"rangoonsupercenter\",\"table\":\"products\"},{\"db\":\"zyl\",\"table\":\"category\"},{\"db\":\"zyl\",\"table\":\"orders\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'assignment_new', 'products', '{\"sorted_col\":\"`products`.`productID` ASC\"}', '2024-01-11 14:23:19'),
('root', 'assignment_new', 'users', '{\"sorted_col\":\"`users`.`userEmail` ASC\"}', '2024-01-11 15:05:52'),
('root', 'zyl', 'category', '{\"sorted_col\":\"`category`.`catID` ASC\"}', '2024-01-10 14:45:03'),
('root', 'zyl', 'order_items', '{\"sorted_col\":\"`order_items`.`product_id` ASC\"}', '2024-01-10 14:05:13'),
('root', 'zyl', 'products', '{\"sorted_col\":\"`products`.`catId` ASC\"}', '2024-01-10 15:07:42'),
('root', 'zyl', 'users', '{\"sorted_col\":\"`users`.`userName` ASC\"}', '2024-01-10 13:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-01-11 18:10:43', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `rangoonsuper`
--
CREATE DATABASE IF NOT EXISTS `rangoonsuper` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rangoonsuper`;

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
--
-- Database: `rangoonsupercenter`
--
CREATE DATABASE IF NOT EXISTS `rangoonsupercenter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rangoonsupercenter`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Refrigerators'),
(2, 'TVs'),
(3, 'Washing Machines'),
(4, 'Vacuum Cleaners'),
(5, 'Home Automation');

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
(7, 1, '2024-01-07 14:57:35'),
(8, 1, '2024-01-07 17:04:35'),
(10, 1, '2024-01-08 16:30:18');

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
(6, 7, 1, 1),
(7, 7, 2, 1),
(8, 7, 3, 5),
(9, 8, 10, 1),
(10, 8, 11, 1),
(11, 8, 16, 1),
(12, 8, 18, 1),
(13, 8, 25, 1),
(14, 8, 14, 4),
(16, 10, 2, 4),
(17, 10, 3, 4),
(18, 10, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `productImg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `productImg`) VALUES
(1, 'Compact Refrigerator', 'Energy-efficient compact refrigerator with freezer compartment', 249.99, 15, 1, 'core/img/compact_fridge.jpg'),
(2, 'French Door Fridge', 'Stainless steel French door refrigerator with ice and water dispenser', 999.99, 10, 1, 'core/img/french_door_fridge.jpg'),
(3, 'Top Freezer Fridge', 'Top freezer refrigerator with adjustable shelves', 449.99, 20, 1, 'core/img/top_freezer_fridge.jpg'),
(4, 'Counter-Depth Fridge', 'Counter-depth refrigerator for a built-in look', 1299.99, 8, 1, 'core/img/counter_depth_fridge.jpg'),
(5, 'Side-by-Side Fridge', 'Side-by-side refrigerator with advanced cooling technology', 799.99, 12, 1, 'core/img/side_by_side_fridge.jpg'),
(6, 'Smart LED TV', 'Smart LED TV with Full HD resolution', 549.99, 18, 2, 'core/img/smart_led_tv.jpg'),
(7, '4K UHD TV', 'Ultra HD 4K TV with HDR support', 799.99, 12, 2, 'core/img/4k_uhd_tv.jpg'),
(8, 'Curved QLED TV', 'Curved QLED TV with Quantum Dot technology', 1299.99, 10, 2, 'core/img/curved_qled_tv.jpg'),
(9, 'OLED TV', 'OLED TV for vibrant colors and deep blacks', 1699.99, 8, 2, 'core/img/oled_tv.jpg'),
(10, 'Outdoor TV', 'Weatherproof outdoor TV for entertainment in any environment', 1999.99, 5, 2, 'core/img/outdoor_tv.jpg'),
(11, 'Front Load Washer', 'Front-loading washing machine with steam cleaning', 699.99, 15, 3, 'core/img/front_load_washer.jpg'),
(12, 'Top Load Washer', 'Top-loading washing machine with high efficiency', 499.99, 20, 3, 'core/img/top_load_washer.jpg'),
(13, 'Washer Dryer Combo', 'Compact washer dryer combo for space-saving laundry', 899.99, 10, 3, 'core/img/washer_dryer_combo.jpg'),
(14, 'Portable Washer', 'Portable washing machine with wheels for flexible use', 349.99, 12, 3, 'core/img/portable_washer.jpg'),
(15, 'Smart Washer', 'Smart washing machine with Wi-Fi connectivity', 1199.99, 8, 3, 'core/img/smart_washer.jpg'),
(16, 'Robot Vacuum', 'Smart robotic vacuum cleaner with mapping technology', 349.99, 25, 4, 'core/img/robot_vacuum.jpg'),
(17, 'Upright Vacuum', 'Powerful upright vacuum with HEPA filtration', 249.99, 20, 4, 'core/img/upright_vacuum.jpg'),
(18, 'Stick Vacuum', 'Cordless stick vacuum for quick and easy cleaning', 179.99, 30, 4, 'core/img/stick_vacuum.jpg'),
(19, 'Canister Vacuum', 'Compact canister vacuum with various attachments', 199.99, 15, 4, 'core/img/canister_vacuum.jpg'),
(20, 'Handheld Vacuum', 'Handheld vacuum for convenient spot cleaning', 99.99, 18, 4, 'core/img/handheld_vacuum.jpg'),
(21, 'Smart Home Hub', 'Centralized smart home hub for home automation', 149.99, 10, 5, 'core/img/smart_home_hub.jpg'),
(22, 'Wireless Security Camera', 'HD wireless security camera with night vision', 89.99, 15, 5, 'core/img/security_camera.jpg'),
(23, 'Smart Thermostat', 'Wi-Fi-enabled smart thermostat for energy efficiency', 129.99, 12, 5, 'core/img/smart_thermostat.jpg'),
(24, 'Voice Assistant Speaker', 'Voice-activated assistant speaker with smart home integration', 79.99, 20, 5, 'core/img/voice_assistant_speaker.jpg'),
(25, 'Smart Doorbell', 'Video doorbell with motion detection and two-way communication', 199.99, 8, 5, 'core/img/smart_doorbell.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `type`) VALUES
(1, 'admin1', 'admin@gmail.com', '$2y$10$AgLsDECyBm0CLii2VwS6Jes.4g7bbOEsuGbrQfL1GmRcYqwvYT2vO', '2023-12-30 08:58:18', 'admin'),
(8, 'admin', 'admin@gmail.com', '123', '2024-01-17 02:26:16', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `zyl`
--
CREATE DATABASE IF NOT EXISTS `zyl` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zyl`;

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
