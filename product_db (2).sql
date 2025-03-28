-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 12:30 PM
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
-- Database: `product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Electronics', 'electronics'),
(2, 'Fashion', 'fashion'),
(3, 'Home Appliances', 'home-appliances'),
(4, 'Furniture', 'furniture'),
(5, 'Games', 'games'),
(6, 'Toys', 'toys');

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` int(11) NOT NULL,
  `subcategory_slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_categories`
--

INSERT INTO `child_categories` (`id`, `subcategory_slug`, `name`, `slug`, `subcategory_id`) VALUES
(1, 'mobile-phones', 'Smartphones', 'smartphones', 1),
(2, 'mobile-phones', 'Feature Phones', 'feature-phones', 1),
(3, 'laptops', 'Gaming Laptops', 'gaming-laptops', 2),
(4, 'laptops', 'Ultrabooks', 'ultrabooks', 2),
(5, 'men-clothing', 'Shirts', 'shirts', 3),
(6, 'men-clothing', 'Jeans', 'jeans', 3),
(7, 'women-clothing', 'Dresses', 'dresses', 4),
(8, 'women-clothing', 'Tops', 'tops', 4),
(19, 'laptops', 'Zephyrus Gaming ', 'zephyrus-gaming-', 2),
(20, 'ps-4', '2025 Edition', '2025-edition', 19),
(21, 'kids-toy', 'Small Cars', 'small-cars', 23);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `child_category_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `subcategory_id`, `child_category_id`, `slug`) VALUES
(3, 'iPhone 14', 'Latest Apple iPhone 14 with A15 Bionic chip.', 799.99, 'Iphone14_.jpg', 1, 1, 1, 'iphone-14'),
(4, 'Samsung Galaxy S23', 'Samsung flagship with Snapdragon 8 Gen 2.', 899.99, 'samsung-galaxys25.jpg', 1, 1, 1, 'samsung-galaxy-s23'),
(5, 'Nokia 3310', 'Classic Nokia phone with long battery life.', 49.99, 'nokia3310.jpg', 1, 1, 2, 'nokia-3310'),
(7, 'ASUS ROG Strix', 'High-performance gaming laptop with RTX 3070.', 1599.99, 'Asus-ROG-Strix.jpg', 1, 2, 3, 'asus-rog-strix'),
(8, 'MSI Stealth 15M', 'Ultra-thin gaming laptop with powerful specs.', 200000.15, 'MSI15M.jpg', 1, 2, 3, 'msi-stealth-15m'),
(9, 'MacBook Air M2', 'Lightweight ultrabook with M2 chip.', 1199.99, 'MacBook-airM2.jpg', 1, 2, 4, 'macbook-air-m2'),
(10, 'Dell XPS 13', 'Premium ultrabook with InfinityEdge display.', 300000.00, 'Dell XPS 13.jpg', 1, 2, 4, 'dell-xps-13'),
(12, 'Allen Solly Formal Shirt', 'Perfect formal shirt for office wear.', 3015.99, 'Allen Solly Formal Shirt.jpg', 2, 3, 5, 'allen-solly-formal-shirt'),
(13, 'Wrangler Slim Fit Jeans', 'Trendy slim fit jeans for men.', 1149.99, 'Wrangler Slim Fit Jeans.jpg', 2, 3, 6, 'wrangler-slim-fit-jeans'),
(14, 'Pepe Jeans Blue', 'Stylish blue jeans for casual wear.', 1144.99, 'Pepe Jeans Blue.jpg', 2, 3, 6, 'pepe-jeans-blue'),
(15, 'Zara Summer Dress', 'Elegant summer dress for women.', 1559.99, 'Zara Summer Dress.jpg', 2, 4, 7, 'zara-summer-dress'),
(16, 'H&M Party Dress', 'Perfect party wear dress for women.', 79.99, 'H&M Party Dress.jpg', 2, 4, 7, 'h&m-party-dress'),
(17, 'Forever 21 Crop Top', 'Trendy crop top for young women.', 1124.99, 'Forever 21 Crop Top.jpg', 2, 4, 8, 'forever-21-crop-top'),
(18, 'ONLY Casual Top', 'Casual top perfect for daily wear.', 1529.99, 'ONLY Casual Top.jpg', 2, 4, 8, 'only-casual-top'),
(20, 'Zephyrud G-14 ', 'Gaming Laptop', 98999.00, 'Zephyrud G-14 .jpg', 1, 2, 19, 'zephyrud-g-14-'),
(21, 'PS-4 2025 Edition', 'Hard Core Gaming device', 154999.00, 'PS-4.jpg', 5, 19, 20, 'ps-4-2025-edition'),
(23, 'Lamborghini remote control car', 'Lamborgini remote control car', 1599.00, 'Lamborghini remote control car.jpg', 6, 23, 21, 'lamborghini-remote-control-car');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `category_slug`, `name`, `slug`) VALUES
(1, 1, 'electronics', 'Mobile Phones', 'mobile-phones'),
(2, 1, 'electronics', 'Laptops', 'laptops'),
(3, 2, 'fashion', 'Men Clothing', 'men-clothing'),
(4, 2, 'fashion', 'Women Clothing', 'women-clothing'),
(5, 3, 'home-appliances', 'Kitchen Appliances', 'kitchen-appliances'),
(8, 4, 'furniture', 'Tables', 'tables'),
(15, 4, '', 'Dining Table', 'dining-table'),
(17, 4, '', 'Sofas', 'sofas'),
(19, 5, '', 'PS-4', 'ps-4'),
(22, 4, '', 'Chairs', 'chairs'),
(23, 6, '', 'Kids Toy', 'kids-toy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_subcategory` (`subcategory_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `child_category_id` (`child_category_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `child_categories`
--
ALTER TABLE `child_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD CONSTRAINT `fk_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`child_category_id`) REFERENCES `child_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
