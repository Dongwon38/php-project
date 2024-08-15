-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2013 at 07:43 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bcit`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `primary_key` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  PRIMARY KEY (`primary_key`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`primary_key`, `id`, `firstname`, `lastname`) VALUES
(1, 'A00123456', 'Jane', 'Sane'),
(2, 'A00123457', 'Joe', 'Schmoe'),
(3, 'A00888886', 'Shania', 'Dylan'),
(4, 'A00654321', 'Sally', 'Xu'),
(5, 'A00876543', 'Emily', 'Bronte'),
(6, 'A00898989', 'Sonny', 'Rollins'),
(7, 'A00565656', 'Billie', 'Holiday'),
(8, 'A00111222', 'Anne', 'Droid'),
(9, 'A00757575', 'SALLY', 'Frith'),
(10, 'A00787878', 'sally', 'Smith'),
(11, 'A00797979', 'Jane', 'Burns'),
(12, 'A00123455', 'Sally', 'Smith'),
(13, 'A00111111', 'Abed', 'Alland'),
(14, 'A00222222', 'Shan', 'Yan'),
(15, 'A00333333', 'James', 'Bound'),
(16, 'A00555555', 'jane', 'jims'),
(17, 'A00777777', 'Janet', 'Planet'),
(18, 'A00888888', 'Gordon', 'Heavyfoot'),
(19, 'A00999999', 'Beverly', 'Beam'),
(20, 'A00121212', 'JANE', 'SANE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;