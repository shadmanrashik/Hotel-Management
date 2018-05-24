-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2016 at 07:47 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel_management`
--
CREATE DATABASE IF NOT EXISTS `hotel_management` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotel_management`;

-- --------------------------------------------------------

--
-- Table structure for table `book_room`
--

CREATE TABLE IF NOT EXISTS `book_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_number`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `book_room`
--

INSERT INTO `book_room` (`id`, `room_number`, `client_id`, `check_in_date`, `check_out_date`) VALUES
(1, 101, 1, '2016-07-13', '2016-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(16) NOT NULL,
  `room_rent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `type`, `room_rent`) VALUES
(5, 'Single', 100),
(6, 'Double Twin', 150),
(10, 'Double', 200),
(11, 'Executive Suite', 300),
(12, 'Double Ac', 400);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `address`, `phone_number`) VALUES
(1, 'Mr. Hasan Chowdhury', '20 Station road, Dhaka', '01710565543'),
(2, 'Mr. Saikat Ahmed', '10 Mirpur, Dhaka', '01619000424');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `description` varchar(64) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `type`, `number`, `description`, `image`) VALUES
(1, '', 5, 101, '1 bed', NULL),
(3, '', 6, 102, '2 beds', NULL),
(4, '', 10, 103, '1 bed, 1 bath', NULL),
(5, '', 11, 104, '1 bed(large), 1 bath', NULL),
(6, '', 5, 201, '1 bed', NULL),
(7, '', 6, 202, '2 beds', NULL),
(8, '', 10, 203, '1 bed, 1 bath', NULL),
(9, '', 11, 204, '1 bed(large), 1 bath', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `security_question_answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `security_question_answer`) VALUES
(2, 'admin', '32250170a0dca92d53ec9624f336ca24', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_room`
--
ALTER TABLE `book_room`
  ADD CONSTRAINT `book_room_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book_room_ibfk_3` FOREIGN KEY (`room_number`) REFERENCES `room` (`number`) ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`type`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
