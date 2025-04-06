-- --------------------------------------------------------
-- Modified for XAMPP compatibility (MySQL 5.7/MariaDB)
-- Original from Laragon (MySQL 8.0)
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping database structure for food_delivery
CREATE DATABASE IF NOT EXISTS `food_delivery` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `food_delivery`;

-- Dumping structure for table food_delivery.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food_delivery.admins: ~1 rows (approximately)
INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `created_at`, `last_login`) VALUES
	(1, 'Admin', 'admin@gmail.com', 'foodexpressadmin@gmail.com', '$2y$10$mu5yqsETXj/RQxzqtd7jn.Ernbk7d5FY6bgAeetVmtlB2y/ZFxzk.', '2025-04-03 16:16:32', NULL);

-- Dumping structure for table food_delivery.restaurants
CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `telephone_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food_delivery.restaurants: ~9 rows (approximately)
INSERT INTO `restaurants` (`id`, `name`, `image`, `address`, `city`, `telephone_no`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'Tuan\'s Food Bowl', 'tuans.jpeg', '142 BB, Senakudiruppu, Anuradhapura Road', 'Puttalam', '+94 32 2 266775', 'tuansfoodbowl@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:30:02'),
	(2, 'Yumize', 'yummize.png', 'Mannar Road ', 'Puttalam', '+94 785632125', 'yumize@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:30:27'),
	(3, 'Kandiah Restaurant', 'kandiah-THUMBNAIL.jpg', 'Colombo Road', 'Puttalam', '+94 752365698', 'kandiah@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:30:49'),
	(4, 'ICE Talk', 'ice-talk.png', 'Poles Road', 'Puttalam', '+94 71253696', 'icetalk@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:31:29'),
	(5, 'Jollybee', 'jollybee.png', 'Good Shed Road', 'Puttalam', '+94 7036524', 'jollybee@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:31:40'),
	(6, 'KFC', 'kfc-new-logo-design-2018-1024x683.webp', '15, Kacheri road ', 'Puttalam', '+94 785691230', 'kfc@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:32:18'),
	(7, 'Pizza Hut', 'Pizza-Hut-Logo.webp', '85, colombo road ', 'Puttalam', '+94 723657458', 'pizzahut@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:33:03'),
	(8, 'Dynamic', 'dynamic.avif', 'Kalpitya road', 'Nuraicholai', '+94 752148560', 'dynamic@gmail.com', '2025-04-02 09:55:30', '2025-04-04 05:48:35'),
	(9, 'Mum\'s Food', 'MUMS-FOOD.jpg', 'Mannar Road ', 'Puttalam', '+9478563215', 'mums@gmail.com', '2025-04-02 09:55:30', '2025-04-03 06:34:04');

-- Dumping structure for table food_delivery.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food_delivery.menu_items: ~27 rows (approximately)
INSERT INTO `menu_items` (`id`, `restaurant_id`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Chicken Curry', 5.99, 'chicken-curry.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(2, 1, 'Fried Rice', 6.99, 'fried-rice.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(3, 1, 'Grilled Fish', 8.49, 'grilled-fish.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(4, 2, 'Cheese Burgers', 3.99, 'cheese-burger.jpg', '2025-04-02 09:55:37', '2025-04-03 12:05:44'),
	(5, 2, 'French Fries', 2.49, 'fries.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(6, 2, 'Milkshake', 4.99, 'milkshake.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(7, 3, 'Mutton Curry', 7.99, 'mutton-curry.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(8, 3, 'Egg Roti', 2.99, 'egg-roti.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(9, 3, 'String Hoppers', 3.49, 'string-hoppers.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(10, 4, 'Ice Cream Sundae', 5.49, 'sundae.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(11, 4, 'Fruit Juice', 3.99, 'fruit-juice.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(12, 4, 'Waffle', 6.49, 'waffle.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(13, 5, 'Spicy Chicken', 6.99, 'spicy-chicken.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(14, 5, 'Rice Bowl', 5.49, 'rice-bowl.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(15, 5, 'Peach Tea', 2.99, 'peach-tea.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(16, 6, 'Zinger Burger', 5.99, 'zinger-burger.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(17, 6, 'Popcorn Chicken', 4.49, 'popcorn-chicken.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(18, 6, 'Mashed Potato', 3.99, 'mashed-potato.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(19, 7, 'Pepperoni Pizza', 8.99, 'pepperoni-pizza.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(20, 7, 'Veggie Pizza', 7.99, 'veggie-pizza.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(21, 7, 'Garlic Bread', 4.49, 'garlic-bread.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(22, 8, 'Chicken Wrap', 6.99, 'chicken-wrap.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(23, 8, 'Cold Coffee', 3.49, 'cold-coffee.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(24, 8, 'Caesar Salads', 6.00, 'caesar-salad.jpg', '2025-04-02 09:55:37', '2025-04-04 05:49:00'),
	(25, 9, 'Home Cooked Rice & Curry', 5.99, 'rice-curry.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(26, 9, 'Lentil Soup', 3.99, 'lentil-soup.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37'),
	(27, 9, 'Fish Fry', 6.49, 'fish-fry.jpg', '2025-04-02 09:55:37', '2025-04-02 09:55:37');

-- Dumping structure for table food_delivery.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `payment_method` enum('COD','card') NOT NULL,
  `card_details` text,
  `additional_info` text,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `restaurant_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food_delivery.orders: ~0 rows (approximately)
INSERT INTO `orders` (`id`, `order_number`, `first_name`, `last_name`, `email`, `phone`, `address`, `payment_method`, `card_details`, `additional_info`, `subtotal`, `delivery_fee`, `total`, `status`, `created_at`, `restaurant_id`, `updated_at`) VALUES
	(1, 'ORD-67EE260763E42', 'User', 'test', 'amrishanab@gmail.com', '+1783099340', '88/20 Marikkar Street Puttalam', 'COD', NULL, 'When you reach here call me', 2.49, 2.99, 5.48, 'pending', '2025-04-03 06:09:11', 2, '2025-04-03 11:43:36'),
	(2, 'ORD-67EE2960970E1', 'Amri', 'Shanab', 'amrishanab@gmail.com', '+10783099340', '88/20 Marikkar Street Puttalam', 'COD', NULL, 'ska', 17.97, 2.99, 20.96, 'pending', '2025-04-03 06:23:28', 1, '2025-04-03 11:43:36'),
	(3, 'ORD-67EE3BC0D93FD', 'test', 'user', 'amrishanab@gmail.com', '+10783099340', '88/20 Marikkar Street Puttalam', 'COD', NULL, '', 8.99, 2.99, 11.98, 'pending', '2025-04-03 07:41:52', 7, '2025-04-03 11:43:36'),
	(4, 'ORD-67EE60C1CBEE7', 'Amri', 'Shanab', 'amrishanab@gmail.com', '+1783099340', '88/20 Marikkar Street Puttalam', 'COD', NULL, 'call me when you reach the place', 18.46, 2.99, 21.45, 'completed', '2025-04-03 10:19:45', 6, '2025-04-03 11:43:52');

-- Dumping structure for table food_delivery.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food_delivery.order_items: ~0 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `menu_item_id`, `item_name`, `quantity`, `price`, `size`) VALUES
	(1, 1, 5, 'French Fries', 1, 2.49, 'S'),
	(2, 2, 1, 'Chicken Curry', 3, 5.99, 'S'),
	(3, 3, 19, 'Pepperoni Pizza', 1, 8.99, 'S'),
	(4, 4, 17, 'Popcorn Chicken', 2, 4.49, 'M'),
	(5, 4, 18, 'Mashed Potato', 1, 3.99, 'S'),
	(6, 4, 10, 'Ice Cream Sundae', 1, 5.49, 'S');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;