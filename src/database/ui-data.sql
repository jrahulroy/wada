-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2013 at 09:58 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ui-data`
--

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE IF NOT EXISTS `queries` (
  `queryid` int(11) NOT NULL AUTO_INCREMENT,
  `query_string` varchar(1000) NOT NULL,
  `databaseName` varchar(100) NOT NULL,
  PRIMARY KEY (`queryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`queryid`, `query_string`, `databaseName`) VALUES
(1, '[[" orderdetails","orderNumber"],[" orderdetails","quantityOrdered"],[" productlines","textDescription"],[" productlines","htmlDescription"]]', ''),
(2, '[[" orderdetails","orderNumber"],[" orderdetails","quantityOrdered"],[" productlines","textDescription"],[" productlines","htmlDescription"]]', ''),
(3, '[[" orderdetails","orderNumber"],[" orderdetails","quantityOrdered"],[" productlines","textDescription"],[" productlines","htmlDescription"]]', ''),
(4, '[]', ''),
(5, '[[" customers","contactLastName"],[" customers","addressLine1"],[" customers","city"],[" employees","firstName"],[" employees","email"]]', ''),
(6, '[[" customers","customerNumber"]]', ''),
(7, '[[" customers","customerNumber"],[" employees","employeeNumber"],[" employees","lastName"],[" employees","firstName"],[" offices","city"],[" offices","addressLine1"]]', ''),
(8, '[[" customers","customerNumber"],[" customers","customerName"]]', ''),
(9, '[[" customers","customerNumber"],[" customers","customerName"],[" customers","contactLastName"],[" customers","contactFirstName"],[" customers","phone"],[" customers","addressLine1"],[" customers","addressLine2"]]', ''),
(10, '[[" customers","customerNumber"],[" customers","customerName"],[" customers","contactLastName"],[" customers","contactFirstName"],[" customers","phone"],[" customers","addressLine1"],[" customers","addressLine2"],[" employees","employeeNumber"],[" employees","lastName"],[" employees","firstName"]]', ''),
(11, '[[" customers","customerNumber"],[" customers","customerName"],[" customers","contactLastName"],[" customers","contactFirstName"],[" customers","phone"],[" customers","addressLine1"],[" customers","addressLine2"],[" employees","employeeNumber"],[" employees","lastName"],[" employees","firstName"]]', ''),
(12, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","customerNumber"],[" payments","checkNumber"]]', ''),
(13, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","customerNumber"],[" payments","checkNumber"]]', ''),
(14, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","checkNumber"],[" payments","checkNumber"]]', ''),
(15, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","checkNumber"],[" payments","checkNumber"]]', ''),
(16, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","customerNumber"],[" payments","checkNumber"]]', ''),
(17, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","checkNumber"],[" payments","checkNumber"]]', ''),
(18, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","checkNumber"],[" payments","checkNumber"]]', ''),
(19, '[[" customers","customerNumber"],[" customers","customerName"],[" payments","checkNumber"],[" payments","checkNumber"]]', ''),
(20, '[[" customers","customerNumber"],[" customers","customerName"],[" customers","contactLastName"]]', ''),
(21, '[[" address","city_id"]]', ''),
(22, '[[" address","address_id"],[" address","address"]]', ''),
(23, '[[" country","country_id"],[" country","country"],[" country","last_update"]]', ''),
(24, '[["address","address_id"],["city","city_id"],["city","country_id"]]', ''),
(25, '[["address","address_id"],["address","address"],["address","address2"],["address","city_id"]]', ''),
(26, '[["address","address_id"],["address","city_id"]]', ''),
(27, '[["address","address_id"],["address","address"],["address","city_id"],["city","city_id"],["city","city"]]', ''),
(28, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', ''),
(29, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', ''),
(30, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', ''),
(31, '[["address","address_id"],["address","address"],["address","city_id"],["city","city_id"],["city","city"]]', ''),
(32, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', ''),
(33, '[["address","address_id"],["address","address"],["address","city_id"],["city","city_id"],["city","city"]]', ''),
(34, '[["address","address_id"],["address","address"],["address","city_id"],["city","city_id"],["city","city"]]', ''),
(35, '[["city","city_id"],["city","city"],["city","country_id"],["country","country_id"]]', ''),
(36, '[["city","city_id"],["city","city"],["city","country_id"],["country","country_id"],["country","country"]]', ''),
(37, '[["address","address_id"],["address","address"],["address","city_id"],["city","city_id"],["city","city"],["city","country_id"],["country","country_id"],["country","country"]]', ''),
(38, 'sakila', '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]'),
(39, 'sakila', '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]'),
(40, 'sakila', '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]'),
(41, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', 'sakila'),
(42, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', 'sakila'),
(43, '[["actor","actor_id"],["actor","first_name"],["actor","last_update"]]', 'sakila'),
(44, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', 'sakila'),
(45, '[["inventory","inventory_id"],["inventory","film_id"],["inventory","store_id"],["inventory","last_update"]]', 'sakila'),
(46, '[["actor","actor_id"],["actor","first_name"],["actor","last_name"],["actor","last_update"]]', 'sakila');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
