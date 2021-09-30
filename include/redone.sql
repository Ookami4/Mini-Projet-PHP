-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 05 juil. 2020 à 03:57
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `redone`
--
CREATE DATABASE IF NOT EXISTS `redone` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `redone`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(6) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`, `admin_email`) VALUES(1, 'Redouan El khanoussi', 'redouan1234', 'redouan@gmail.com');
INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`, `admin_email`) VALUES(2, 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(6) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES(1, 'electronic');
INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES(2, 'Book');
INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES(3, 'Clothes');

-- --------------------------------------------------------

--
-- Structure de la table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `quantity` int(11) NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `pro_id` int(11) NOT NULL,
  KEY `pro_id` (`pro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orderdetails`
--

INSERT INTO `orderdetails` (`quantity`, `order_id`, `pro_id`) VALUES(2, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_total` float NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `order_total`, `user_id`) VALUES(1, 34.7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pro_id` int(6) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(150) NOT NULL,
  `pro_brand` varchar(50) NOT NULL,
  `cat_id` int(6) NOT NULL,
  `pro_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pro_quantity` smallint(6) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_picture` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `fk_cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_brand`, `cat_id`, `pro_description`, `pro_quantity`, `pro_price`, `pro_picture`) VALUES(1, 'Phone Huawei P30 Pro', 'Huawei', 1, 'Width 73.4mm Height 158.0mm Depth 8.41mm Weight Approx. 192 g (including the battery) \r\n*Product size, product weight, and related specifications are theoretical values only. Actual measurements between individual products may vary. All specifications are subject to the actual product.\r\nSize:\r\n6.47 inches\r\nNote: With a rounded corners design on the dewdrop display, the diagonal length of the screen is 6.47 inches when measured according to the standard rectangle (the actual viewable area is slightly smaller).\r\nColour:\r\n16.7 million colours\r\nColour Gamut:\r\nWide Color Gamut(DCI-P3)\r\nType:\r\nOLED\r\nResolution:\r\nFHD+ 2340*1080\r\n(Note: The resolution measured as a standard rectangle, with a rounded corners design on the dewdrop display,the effective pixels are slightly less.)', 12, 499.99, 'p30.jpg');
INSERT INTO `products` (`pro_id`, `pro_name`, `pro_brand`, `cat_id`, `pro_description`, `pro_quantity`, `pro_price`, `pro_picture`) VALUES(2, 'Beard straightener', 'unknown', 1, 'MULTI-FUNCTIONAL BEARD STRAIGHTENER BRUSH WITH LONG LASTING EFFECT: DOLIROX beard straightener was designed specially for men to achieve the best result for different styles of all beards and hair, straighten, volumize or simple brushing. Advanced MCH technology offers a fast, even heat distribution. It heats up to 392℉ within 1 minute. Negative ionic technology provides the better results.', 20, 11.99, 'Beard straightener.jpg');
INSERT INTO `products` (`pro_id`, `pro_name`, `pro_brand`, `cat_id`, `pro_description`, `pro_quantity`, `pro_price`, `pro_picture`) VALUES(3, 'mask', 'Zara', 3, 'Fashion Design-Unisex black, stylish design. It protects you while making you look very stylish and beautiful.\r\nCotton material-cotton, can provide a comfortable protective layer.\r\nWide Application: Ideal for both women and men, suitable for cycling, camping, running, travel, climbing and daily use. Protect you from fog, vehicle exhaust etc.\r\nSuitable for cycling, camping, running, travel, climbing and daily use.', 50, 16.99, 'mask1.jpg');
INSERT INTO `products` (`pro_id`, `pro_name`, `pro_brand`, `cat_id`, `pro_description`, `pro_quantity`, `pro_price`, `pro_picture`) VALUES(4, 'who says you cant', 'Alrian Denault', 2, 'Have you ever wondered why there are few people living their dream, yet others seem to be slipping further away from theirs with every day that passes? Daniel Chidiac\'s writing has touched millions of people worldwide and helps to transform thousands of lives daily. By opening Who Says You Can\'t? YOU DO, we embark on a psychological and emotional journey that is certain to unlock our truest potential. This challenging yet extraordinarily rewarding book is the ultimate guide to discover the fulfilment we have been searching for our whole life.', 132, 17.35, 'book1.jpg');
INSERT INTO `products` (`pro_id`, `pro_name`, `pro_brand`, `cat_id`, `pro_description`, `pro_quantity`, `pro_price`, `pro_picture`) VALUES(5, 'Mediocracy', 'Daniel Chidiac', 2, 'There was no Reichstag fire. No storming of the Bastille. No mutiny on the Aurora. Instead, the mediocre have seized power without firing a single shot. They rose to power on the tide of an economy where workers produce assembly-line meals without knowing how to cook at home, give customers instructions over the phone that they themselves don’t understand, or sell books and newspapers that they never read.\r\nCanadian intellectual juggernaut Alain Deneault has taken on all kinds of evildoers: mining companies, tax-dodgers, and corporate criminals. Now he takes on the most menacing threat of all: the mediocre.', 12, 9.06, 'book2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_pass` varchar(150) NOT NULL,
  `user_adress` varchar(150) NOT NULL,
  `user_zip` int(6) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_adress`, `user_zip`) VALUES(1, 'Achref Barada', 'achref@gmail.com', 'achref1234', 'Quartier Al Boustane Taouima Nador', 62000);
INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_adress`, `user_zip`) VALUES(3, 'Anass Ahardouch', 'anass@gmail.com', '1234anass', 'Quartier Taouima Nador', 62000);
INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_adress`, `user_zip`) VALUES(4, 'Sami Mahmoud', 'sami@gmail.com', 'sami1234', 'Quartier Al Matar Nador Jadid', 62000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
