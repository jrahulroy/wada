-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2013 at 11:39 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

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
  `query_string` varchar(500) NOT NULL,
  PRIMARY KEY (`queryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`queryid`, `query_string`) VALUES
(1, '[[" film_category","film_id"],[" film_category","category_id"],[" film_category","last_update"]]'),
(2, '[[" actor","<span class=\\"key pri\\"></span>actor_id"],[" actor","<span class=\\"key \\"></span>first_name"],[" actor","<span class=\\"key \\"></span>last_name"],[" actor","<span class=\\"key \\"></span>last_update"]]'),
(3, '[[" actor","<span class=\\"key pri\\"></span>actor_id"],[" actor","<span class=\\"key \\"></span>first_name"],[" actor","<span class=\\"key \\"></span>last_name"],[" actor","<span class=\\"key \\"></span>last_update"]]'),
(4, '[[" actor","<span class=\\"key pri\\"></span>actor_id"]]'),
(5, '[[" actor","<span class=\\"key pri\\"></span>actor_id"]]'),
(6, '[[" actor","actor_id"]]'),
(7, '[[" actor","actor_id"],[" actor","first_name"],[" actor","last_name"],[" actor","last_update"]]'),
(8, '[[" actor","actor_id"],[" actor","first_name"],[" actor","last_name"],[" actor","last_update"]]'),
(9, '[[" address","address_id"],[" address","address"],[" address","address2"],[" address","district"],[" address","city_id"],[" city","city_id"],[" city","city"]]'),
(10, '[[" address","address_id"],[" address","address"],[" address","address2"],[" address","district"],[" address","city_id"],[" city","city"],[" city","city"]]'),
(11, '[[" address","address_id"],[" address","address"],[" address","address2"],[" address","district"],[" address","city_id"],[" city","city"]]'),
(12, '[[" address","address_id"],[" address","address"],[" address","address2"],[" address","district"],[" category","category_id"],[" category","name"]]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
