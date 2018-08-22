-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2018 at 04:58 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting`
--

CREATE TABLE `accounting` (
  `acctgID` int(11) NOT NULL,
  `leadTimeID` int(11) NOT NULL,
  `dateReceived` date NOT NULL,
  `receivedBy` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `releaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`acctgID`, `leadTimeID`, `dateReceived`, `receivedBy`, `status`, `remarks`, `releaseDate`) VALUES
(19, 3, '0000-00-00', '', '', '', '0000-00-00'),
(20, 3, '2018-08-22', 'Person 2', 'Released', 'Hahahaha', '2018-08-21'),
(21, 3, '0000-00-00', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `banana_calendars`
--

CREATE TABLE `banana_calendars` (
  `calID` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `week_number` int(11) NOT NULL,
  `period_number` int(11) NOT NULL,
  `quarter_number` int(11) NOT NULL,
  `year_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banana_calendars`
--

INSERT INTO `banana_calendars` (`calID`, `date_from`, `date_to`, `week_number`, `period_number`, `quarter_number`, `year_number`) VALUES
(1, '2017-01-02 00:00:00', '2017-01-08 00:00:00', 1, 1, 1, 2017),
(2, '2017-01-09 00:00:00', '2017-01-15 00:00:00', 2, 1, 1, 2017),
(3, '2017-01-16 00:00:00', '2017-01-22 00:00:00', 3, 1, 1, 2017),
(4, '2017-01-23 00:00:00', '2017-01-29 00:00:00', 4, 1, 1, 2017),
(5, '2017-01-30 00:00:00', '2017-02-05 00:00:00', 5, 2, 1, 2017),
(6, '2017-02-06 00:00:00', '2017-02-12 00:00:00', 6, 2, 1, 2017),
(7, '2017-02-13 00:00:00', '2017-02-19 00:00:00', 7, 2, 1, 2017),
(8, '2017-02-20 00:00:00', '2017-02-26 00:00:00', 8, 2, 1, 2017),
(9, '2017-02-27 00:00:00', '2017-03-05 00:00:00', 9, 3, 1, 2017),
(10, '2017-03-06 00:00:00', '2017-03-12 00:00:00', 10, 3, 1, 2017),
(11, '2017-03-13 00:00:00', '2017-03-19 00:00:00', 11, 3, 1, 2017),
(12, '2017-03-20 00:00:00', '2017-03-26 00:00:00', 12, 3, 1, 2017),
(13, '2017-03-27 00:00:00', '2017-04-02 00:00:00', 13, 4, 2, 2017),
(14, '2017-04-03 00:00:00', '2017-04-09 00:00:00', 14, 4, 2, 2017),
(15, '2017-04-10 00:00:00', '2017-04-16 00:00:00', 15, 4, 2, 2017),
(16, '2017-04-17 00:00:00', '2017-04-23 00:00:00', 16, 4, 2, 2017),
(17, '2017-04-24 00:00:00', '2017-04-30 00:00:00', 17, 5, 2, 2017),
(18, '2017-05-01 00:00:00', '2017-05-07 00:00:00', 18, 5, 2, 2017),
(19, '2017-05-08 00:00:00', '2017-05-14 00:00:00', 19, 5, 2, 2017),
(20, '2017-05-15 00:00:00', '2017-05-21 00:00:00', 20, 5, 2, 2017),
(21, '2017-05-22 00:00:00', '2017-05-28 00:00:00', 21, 6, 2, 2017),
(22, '2017-05-29 00:00:00', '2017-06-04 00:00:00', 22, 6, 2, 2017),
(23, '2017-06-05 00:00:00', '2017-06-11 00:00:00', 23, 6, 2, 2017),
(24, '2017-06-12 00:00:00', '2017-06-18 00:00:00', 24, 6, 2, 2017),
(25, '2017-06-19 00:00:00', '2017-06-25 00:00:00', 25, 7, 3, 2017),
(26, '2017-06-26 00:00:00', '2017-07-02 00:00:00', 26, 7, 3, 2017),
(27, '2017-07-03 00:00:00', '2017-07-19 00:00:00', 27, 7, 3, 2017),
(28, '2017-07-10 00:00:00', '2017-07-16 00:00:00', 28, 7, 3, 2017),
(29, '2017-07-17 00:00:00', '2017-07-23 00:00:00', 29, 8, 3, 2017),
(30, '2017-07-24 00:00:00', '2017-07-30 00:00:00', 30, 8, 3, 2017),
(31, '2017-07-31 00:00:00', '2017-08-06 00:00:00', 31, 8, 3, 2017),
(32, '2017-08-07 00:00:00', '2017-08-13 00:00:00', 32, 8, 3, 2017),
(33, '2017-08-14 00:00:00', '2017-08-20 00:00:00', 33, 9, 3, 2017),
(34, '2017-08-21 00:00:00', '2017-08-27 00:00:00', 34, 9, 3, 2017),
(35, '2017-08-28 00:00:00', '2017-09-03 00:00:00', 35, 9, 3, 2017),
(36, '2017-09-04 00:00:00', '2017-09-10 00:00:00', 36, 9, 3, 2017),
(37, '2017-09-11 00:00:00', '2017-09-17 00:00:00', 37, 10, 4, 2017),
(38, '2017-09-18 00:00:00', '2017-09-24 00:00:00', 38, 10, 4, 2017),
(39, '2017-09-25 00:00:00', '2017-10-01 00:00:00', 39, 10, 4, 2017),
(40, '2017-10-02 00:00:00', '2017-10-08 00:00:00', 40, 10, 4, 2017),
(41, '2017-10-09 00:00:00', '2017-10-15 00:00:00', 41, 11, 4, 2017),
(42, '2017-10-16 00:00:00', '2017-10-22 00:00:00', 42, 11, 4, 2017),
(43, '2017-10-23 00:00:00', '2017-10-29 00:00:00', 43, 11, 4, 2017),
(44, '2017-10-30 00:00:00', '2017-11-05 00:00:00', 44, 11, 4, 2017),
(45, '2017-11-06 00:00:00', '2017-11-12 00:00:00', 45, 12, 4, 2017),
(46, '2017-11-13 00:00:00', '2017-11-19 00:00:00', 46, 12, 4, 2017),
(47, '2017-11-20 00:00:00', '2017-11-26 00:00:00', 47, 12, 4, 2017),
(48, '2017-11-27 00:00:00', '2017-12-03 00:00:00', 48, 12, 4, 2017),
(49, '2017-12-04 00:00:00', '2017-12-10 00:00:00', 49, 13, 4, 2017),
(50, '2017-12-11 00:00:00', '2017-12-17 00:00:00', 50, 13, 4, 2017),
(51, '2017-12-18 00:00:00', '2017-12-24 00:00:00', 51, 13, 4, 2017),
(52, '2017-12-25 00:00:00', '2017-12-31 00:00:00', 52, 13, 4, 2017),
(53, '2016-01-04 00:00:00', '2016-01-10 00:00:00', 1, 1, 1, 2016),
(54, '2016-01-11 00:00:00', '2016-01-17 00:00:00', 2, 1, 1, 2016),
(55, '2016-01-18 00:00:00', '2016-01-24 00:00:00', 3, 1, 1, 2016),
(56, '2016-01-25 00:00:00', '2016-01-31 00:00:00', 4, 1, 1, 2016),
(57, '2016-02-01 00:00:00', '2016-02-07 00:00:00', 5, 2, 1, 2016),
(58, '2016-02-08 00:00:00', '2016-02-14 00:00:00', 6, 2, 1, 2016),
(59, '2016-02-15 00:00:00', '2016-02-21 00:00:00', 7, 2, 1, 2016),
(60, '2016-02-22 00:00:00', '2016-02-28 00:00:00', 8, 2, 1, 2016),
(61, '2016-02-29 00:00:00', '2016-03-06 00:00:00', 9, 3, 1, 2016),
(62, '2016-03-07 00:00:00', '2016-03-13 00:00:00', 10, 3, 1, 2016),
(63, '2016-03-14 00:00:00', '2016-03-20 00:00:00', 11, 3, 1, 2016),
(64, '2016-03-21 00:00:00', '2016-03-27 00:00:00', 12, 3, 1, 2016),
(65, '2016-03-28 00:00:00', '2016-04-03 00:00:00', 13, 4, 2, 2016),
(66, '2016-04-04 00:00:00', '2016-04-10 00:00:00', 14, 4, 2, 2016),
(67, '2016-04-11 00:00:00', '2016-04-17 00:00:00', 15, 4, 2, 2016),
(68, '2016-04-18 00:00:00', '2016-04-24 00:00:00', 16, 4, 2, 2016),
(69, '2016-04-25 00:00:00', '2016-05-01 00:00:00', 17, 5, 2, 2016),
(70, '2016-05-02 00:00:00', '2016-05-08 00:00:00', 18, 5, 2, 2016),
(71, '2016-05-09 00:00:00', '2016-05-15 00:00:00', 19, 5, 2, 2016),
(72, '2016-05-16 00:00:00', '2016-05-22 00:00:00', 20, 5, 2, 2016),
(73, '2016-05-23 00:00:00', '2016-05-29 00:00:00', 21, 6, 2, 2016),
(74, '2016-05-30 00:00:00', '2016-06-05 00:00:00', 22, 6, 2, 2016),
(75, '2016-06-06 00:00:00', '2016-06-12 00:00:00', 23, 6, 2, 2016),
(76, '2016-06-13 00:00:00', '2016-06-19 00:00:00', 24, 6, 2, 2016),
(77, '2016-06-20 00:00:00', '2016-06-26 00:00:00', 25, 7, 3, 2016),
(78, '2016-06-27 00:00:00', '2016-07-03 00:00:00', 26, 7, 3, 2016),
(79, '2016-07-04 00:00:00', '2016-07-10 00:00:00', 27, 7, 3, 2016),
(80, '2016-07-11 00:00:00', '2016-07-17 00:00:00', 28, 7, 3, 2016),
(81, '2016-07-18 00:00:00', '2016-07-24 00:00:00', 29, 8, 3, 2016),
(82, '2016-07-25 00:00:00', '2016-07-31 00:00:00', 30, 8, 3, 2016),
(83, '2016-08-01 00:00:00', '2016-08-07 00:00:00', 31, 8, 3, 2016),
(84, '2016-08-08 00:00:00', '2016-08-14 00:00:00', 32, 8, 3, 2016),
(85, '2016-08-15 00:00:00', '2016-08-21 00:00:00', 33, 9, 3, 2016),
(86, '2016-08-22 00:00:00', '2016-08-28 00:00:00', 34, 9, 3, 2016),
(87, '2016-08-29 00:00:00', '2016-09-04 00:00:00', 35, 9, 3, 2016),
(88, '2016-09-05 00:00:00', '2016-09-11 00:00:00', 36, 9, 3, 2016),
(89, '2016-09-12 00:00:00', '2016-09-18 00:00:00', 37, 10, 4, 2016),
(90, '2016-09-19 00:00:00', '2016-09-25 00:00:00', 38, 10, 4, 2016),
(91, '2016-09-26 00:00:00', '2016-10-02 00:00:00', 39, 10, 4, 2016),
(92, '2016-10-03 00:00:00', '2016-10-09 00:00:00', 40, 10, 4, 2016),
(93, '2016-10-10 00:00:00', '2016-10-16 00:00:00', 41, 11, 4, 2016),
(94, '2016-10-17 00:00:00', '2016-10-23 00:00:00', 42, 11, 4, 2016),
(95, '2016-10-24 00:00:00', '2016-10-30 00:00:00', 43, 11, 4, 2016),
(96, '2016-10-31 00:00:00', '2016-11-06 00:00:00', 44, 11, 4, 2016),
(97, '2016-11-07 00:00:00', '2016-11-13 00:00:00', 45, 12, 4, 2016),
(98, '2016-11-14 00:00:00', '2016-11-20 00:00:00', 46, 12, 4, 2016),
(99, '2016-11-21 00:00:00', '2016-11-27 00:00:00', 47, 12, 4, 2016),
(100, '2016-11-28 00:00:00', '2016-12-04 00:00:00', 48, 12, 4, 2016),
(101, '2016-12-05 00:00:00', '2016-12-11 00:00:00', 49, 13, 4, 2016),
(102, '2016-12-12 00:00:00', '2016-12-18 00:00:00', 50, 13, 4, 2016),
(103, '2016-12-19 00:00:00', '2016-12-25 00:00:00', 51, 13, 4, 2016),
(104, '2016-12-26 00:00:00', '2017-01-01 00:00:00', 52, 13, 4, 2016),
(105, '2018-01-01 00:00:00', '2018-01-07 00:00:00', 1, 1, 1, 2018),
(106, '2018-01-08 00:00:00', '2018-01-14 00:00:00', 2, 1, 1, 2018),
(107, '2018-01-15 00:00:00', '2018-01-21 00:00:00', 3, 1, 1, 2018),
(108, '2018-01-22 00:00:00', '2018-01-28 00:00:00', 4, 1, 1, 2018),
(109, '2018-01-29 00:00:00', '2018-02-04 00:00:00', 5, 2, 1, 2018),
(110, '2018-02-05 00:00:00', '2018-02-11 00:00:00', 6, 2, 1, 2018),
(111, '2018-02-12 00:00:00', '2018-02-18 00:00:00', 7, 2, 1, 2018),
(112, '2018-02-19 00:00:00', '2018-02-25 00:00:00', 8, 2, 1, 2018),
(113, '2018-02-26 00:00:00', '2018-03-04 00:00:00', 9, 3, 1, 2018),
(114, '2018-03-05 00:00:00', '2018-03-11 00:00:00', 10, 3, 1, 2018),
(115, '2018-03-12 00:00:00', '2018-03-18 00:00:00', 11, 3, 1, 2018),
(116, '2018-03-19 00:00:00', '2018-03-25 00:00:00', 12, 3, 1, 2018),
(117, '2018-03-26 00:00:00', '2018-04-01 00:00:00', 13, 4, 2, 2018),
(118, '2018-04-02 00:00:00', '2018-04-08 00:00:00', 14, 4, 2, 2018),
(119, '2018-04-09 00:00:00', '2018-04-15 00:00:00', 15, 4, 2, 2018),
(120, '2018-04-16 00:00:00', '2018-04-22 00:00:00', 16, 4, 2, 2018),
(121, '2018-04-23 00:00:00', '2018-04-29 00:00:00', 17, 5, 2, 2018),
(122, '2018-04-30 00:00:00', '2018-05-06 00:00:00', 18, 5, 2, 2018),
(123, '2018-05-07 00:00:00', '2018-05-13 00:00:00', 19, 5, 2, 2018),
(124, '2018-05-14 00:00:00', '2018-05-20 00:00:00', 20, 5, 2, 2018),
(125, '2018-05-21 00:00:00', '2018-05-27 00:00:00', 21, 6, 2, 2018),
(126, '2018-05-28 00:00:00', '2018-06-03 00:00:00', 22, 6, 2, 2018),
(127, '2018-06-04 00:00:00', '2018-06-10 00:00:00', 23, 6, 2, 2018),
(128, '2018-06-11 00:00:00', '2018-06-17 00:00:00', 24, 6, 2, 2018),
(129, '2018-06-18 00:00:00', '2018-06-24 00:00:00', 25, 7, 3, 2018),
(130, '2018-06-25 00:00:00', '2018-07-01 00:00:00', 26, 7, 3, 2018),
(131, '2018-07-02 00:00:00', '2018-07-08 00:00:00', 27, 7, 3, 2018),
(132, '2018-07-09 00:00:00', '2018-07-15 00:00:00', 28, 7, 3, 2018),
(133, '2018-07-16 00:00:00', '2018-07-22 00:00:00', 29, 8, 3, 2018),
(134, '2018-07-23 00:00:00', '2018-07-29 00:00:00', 30, 8, 3, 2018),
(135, '2018-07-30 00:00:00', '2018-08-05 00:00:00', 31, 8, 3, 2018),
(136, '2018-08-06 00:00:00', '2018-08-12 00:00:00', 32, 8, 3, 2018),
(137, '2018-08-13 00:00:00', '2018-08-19 00:00:00', 33, 9, 3, 2018),
(138, '2018-08-20 00:00:00', '2018-08-26 00:00:00', 34, 9, 3, 2018),
(139, '2018-08-27 00:00:00', '2018-09-02 00:00:00', 35, 9, 3, 2018),
(140, '2018-09-03 00:00:00', '2018-09-09 00:00:00', 36, 9, 3, 2018),
(141, '2018-09-10 00:00:00', '2018-09-16 00:00:00', 37, 10, 3, 2018),
(142, '2018-09-17 00:00:00', '2018-09-23 00:00:00', 38, 10, 3, 2018),
(143, '2018-09-24 00:00:00', '2018-09-30 00:00:00', 39, 10, 3, 2018),
(144, '2018-10-01 00:00:00', '2018-10-07 00:00:00', 40, 10, 3, 2018),
(145, '2018-10-08 00:00:00', '2018-10-14 00:00:00', 41, 11, 4, 2018),
(146, '2018-10-15 00:00:00', '2018-10-21 00:00:00', 42, 11, 4, 2018),
(147, '2018-10-22 00:00:00', '2018-10-28 00:00:00', 43, 11, 4, 2018),
(148, '2018-10-29 00:00:00', '2018-11-04 00:00:00', 44, 11, 4, 2018),
(149, '2018-11-05 00:00:00', '2018-11-11 00:00:00', 45, 12, 4, 2018),
(150, '2018-11-12 00:00:00', '2018-11-18 00:00:00', 46, 12, 4, 2018),
(151, '2018-11-19 00:00:00', '2018-11-25 00:00:00', 47, 12, 4, 2018),
(152, '2018-11-26 00:00:00', '2018-12-02 00:00:00', 48, 12, 4, 2018),
(153, '2018-12-03 00:00:00', '2018-12-09 00:00:00', 49, 13, 4, 2018),
(154, '2018-12-10 00:00:00', '2018-12-16 00:00:00', 50, 13, 4, 2018),
(155, '2018-12-17 00:00:00', '2018-12-23 00:00:00', 51, 13, 4, 2018),
(156, '2018-12-24 00:00:00', '2018-12-30 00:00:00', 52, 13, 4, 2018),
(164, '2014-12-29 00:00:00', '2015-04-01 00:00:00', 1, 1, 1, 2015),
(165, '2015-01-05 00:00:00', '2015-01-11 00:00:00', 2, 1, 1, 2015),
(166, '2015-01-12 00:00:00', '2015-01-18 00:00:00', 3, 1, 1, 2015),
(167, '2015-01-19 00:00:00', '2015-01-25 00:00:00', 4, 1, 1, 2015),
(168, '2015-01-26 00:00:00', '2015-02-01 00:00:00', 5, 2, 1, 2015),
(169, '2015-02-02 00:00:00', '2015-02-08 00:00:00', 6, 2, 1, 2015),
(170, '2015-02-09 00:00:00', '2015-02-15 00:00:00', 7, 2, 1, 2015),
(171, '2015-02-16 00:00:00', '2015-02-22 00:00:00', 8, 2, 1, 2015),
(172, '2015-02-23 00:00:00', '2015-03-01 00:00:00', 9, 3, 1, 2015),
(173, '2015-03-02 00:00:00', '2015-03-08 00:00:00', 10, 3, 1, 2015),
(174, '2015-03-09 00:00:00', '2015-03-15 00:00:00', 11, 3, 1, 2015),
(175, '2015-03-16 00:00:00', '2015-03-22 00:00:00', 12, 3, 1, 2015),
(176, '2015-03-23 00:00:00', '2015-03-29 00:00:00', 13, 4, 2, 2015),
(177, '2015-03-30 00:00:00', '2015-04-05 00:00:00', 14, 4, 2, 2015),
(178, '2015-04-06 00:00:00', '2015-04-12 00:00:00', 15, 4, 2, 2015),
(179, '2015-04-13 00:00:00', '2015-04-19 00:00:00', 16, 4, 2, 2015),
(180, '2015-04-20 00:00:00', '2015-04-26 00:00:00', 17, 5, 2, 2015),
(181, '2015-04-27 00:00:00', '2015-05-03 00:00:00', 18, 5, 2, 2015),
(182, '2015-05-04 00:00:00', '2015-05-10 00:00:00', 19, 5, 2, 2015),
(183, '2015-05-11 00:00:00', '2015-05-17 00:00:00', 20, 5, 2, 2015),
(184, '2015-05-18 00:00:00', '2015-05-24 00:00:00', 21, 6, 2, 2015),
(185, '2015-05-25 00:00:00', '2015-05-31 00:00:00', 22, 6, 2, 2015),
(186, '2015-06-01 00:00:00', '2015-06-07 00:00:00', 23, 6, 2, 2015),
(187, '2015-06-08 00:00:00', '2015-06-14 00:00:00', 24, 6, 2, 2015),
(188, '2015-06-15 00:00:00', '2015-06-21 00:00:00', 25, 7, 3, 2015),
(189, '2015-06-22 00:00:00', '2015-06-28 00:00:00', 26, 7, 3, 2015),
(190, '2015-06-29 00:00:00', '2015-07-05 00:00:00', 27, 7, 3, 2015),
(191, '2015-07-06 00:00:00', '2015-07-12 00:00:00', 28, 7, 3, 2015),
(192, '2015-07-13 00:00:00', '2015-07-19 00:00:00', 29, 8, 3, 2015),
(193, '2015-07-20 00:00:00', '2015-07-26 00:00:00', 30, 8, 3, 2015),
(194, '2015-07-27 00:00:00', '2015-08-02 00:00:00', 31, 8, 3, 2015),
(195, '2015-08-03 00:00:00', '2015-08-09 00:00:00', 32, 8, 3, 2015),
(196, '2015-08-10 00:00:00', '2015-08-16 00:00:00', 33, 9, 3, 2015),
(197, '2015-08-17 00:00:00', '2015-08-23 00:00:00', 34, 9, 3, 2015),
(198, '2015-08-24 00:00:00', '2015-08-30 00:00:00', 35, 9, 3, 2015),
(199, '2015-08-31 00:00:00', '2015-09-06 00:00:00', 36, 9, 3, 2015),
(200, '2015-09-07 00:00:00', '2015-09-13 00:00:00', 37, 10, 3, 2015),
(201, '2015-09-14 00:00:00', '2015-09-20 00:00:00', 38, 10, 3, 2015),
(202, '2015-09-21 00:00:00', '2015-09-27 00:00:00', 39, 10, 3, 2015),
(203, '2015-09-28 00:00:00', '2015-10-04 00:00:00', 40, 10, 3, 2015),
(204, '2015-10-05 00:00:00', '2015-10-11 00:00:00', 41, 11, 4, 2015),
(205, '2015-10-12 00:00:00', '2015-10-18 00:00:00', 42, 11, 4, 2015),
(206, '2015-10-19 00:00:00', '2015-10-25 00:00:00', 43, 11, 4, 2015),
(207, '2015-10-26 00:00:00', '2015-11-01 00:00:00', 44, 11, 4, 2015),
(208, '2015-11-02 00:00:00', '2015-11-08 00:00:00', 45, 12, 4, 2015),
(209, '2015-11-09 00:00:00', '2015-11-15 00:00:00', 46, 12, 4, 2015),
(210, '2015-11-16 00:00:00', '2015-11-22 00:00:00', 47, 12, 4, 2015),
(211, '2015-11-23 00:00:00', '2015-11-29 00:00:00', 48, 12, 4, 2015),
(212, '2015-11-30 00:00:00', '2015-12-06 00:00:00', 49, 13, 4, 2015),
(213, '2015-12-07 00:00:00', '2015-12-13 00:00:00', 50, 13, 4, 2015),
(214, '2015-12-14 00:00:00', '2015-12-20 00:00:00', 51, 13, 4, 2015),
(215, '2015-12-21 00:00:00', '2015-12-27 00:00:00', 52, 13, 4, 2015),
(216, '2015-12-28 00:00:00', '2016-01-03 00:00:00', 53, 13, 4, 2015);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budgetID` int(11) NOT NULL,
  `leadTimeID` int(11) NOT NULL,
  `budgeted` varchar(50) NOT NULL,
  `dateReceived` date NOT NULL,
  `receivedBy` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `dateApproved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budgetID`, `leadTimeID`, `budgeted`, `dateReceived`, `receivedBy`, `status`, `remarks`, `dateApproved`) VALUES
(34, 2, '', '0000-00-00', '', '', '', '0000-00-00'),
(35, 2, 'No', '2018-08-15', 'Bantillan, E.', 'Approved', 'Hahahaha', '2018-08-21'),
(36, 2, 'No', '2018-08-21', 'Bantillan, E.', 'Cancelled', 'aw', '2018-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `ca`
--

CREATE TABLE `ca` (
  `caID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `calID` int(11) NOT NULL,
  `managerID` int(11) DEFAULT NULL,
  `budgetID` int(11) DEFAULT NULL,
  `acctgID` int(11) DEFAULT NULL,
  `expenseID` int(11) DEFAULT NULL,
  `sectionID` int(11) DEFAULT NULL,
  `leadTimeID` int(11) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `dateEntered` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `purpose` text NOT NULL,
  `remarks` text NOT NULL,
  `cost` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ca`
--

INSERT INTO `ca` (`caID`, `userID`, `calID`, `managerID`, `budgetID`, `acctgID`, `expenseID`, `sectionID`, `leadTimeID`, `dateCreated`, `dateEntered`, `status`, `requestor`, `purpose`, `remarks`, `cost`) VALUES
(127, 1, 138, 139, 34, 19, 2, 5, 1, '2018-08-22', '2018-08-22 09:36:20', '', 'Abdullah , Omar', 'ASD', 'ASD', '123.00'),
(128, 1, 138, 140, 35, 20, 6, 4, 1, '2018-06-28', '2018-08-22 09:51:34', '(For Accounting) Status: Released', 'Abdullah , Omar', 'sdf', 'sdf', '123.00'),
(129, 1, 138, 141, 36, 21, 1, 7, 1, '2018-08-22', '2018-08-22 10:51:15', '(For Budget) Budgeted: No Status: Cancelled', 'Abdullah , Omar', 'wow', 'wow', '12121.00');

-- --------------------------------------------------------

--
-- Table structure for table `cctl`
--

CREATE TABLE `cctl` (
  `cctlID` int(11) NOT NULL,
  `dateReceived` date NOT NULL,
  `receivedBy` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `dateApproved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `companyName`, `department`) VALUES
(1, 'NEH', 'example'),
(2, 'DANA', 'example');

-- --------------------------------------------------------

--
-- Table structure for table `expense_account`
--

CREATE TABLE `expense_account` (
  `expenseID` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_account`
--

INSERT INTO `expense_account` (`expenseID`, `type`) VALUES
(1, 'Car/MC Insurance'),
(2, 'Car/MC Maintenance'),
(3, 'Car/MC Repair'),
(4, 'Communication Mobile'),
(5, 'Consultancy Fees'),
(6, 'Corporate Development Program'),
(7, 'Corporate Engagement Program'),
(8, 'Domestic Travel'),
(9, 'Fieldwalk'),
(10, 'FOL'),
(11, 'Health Insurance'),
(12, 'International Travel'),
(13, 'Leasehold Improvement'),
(14, 'Medical & Dental'),
(15, 'OSC - Demo Farm Cost'),
(16, 'OSC - Research & Development'),
(17, 'Other Repairs'),
(18, 'Postage'),
(19, 'Representation'),
(20, 'Service Fee'),
(21, 'Stationary & Supplies'),
(22, 'Tools & Equipment'),
(23, 'Water Expense'),
(24, 'Fuel');

-- --------------------------------------------------------

--
-- Table structure for table `jsr`
--

CREATE TABLE `jsr` (
  `jsrID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `managerID` int(11) DEFAULT NULL,
  `cctlID` int(11) DEFAULT NULL,
  `budgetID` int(11) DEFAULT NULL,
  `acctgID` int(11) DEFAULT NULL,
  `calID` int(11) NOT NULL,
  `expenseID` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateEntered` date NOT NULL,
  `weekNo` int(11) NOT NULL,
  `periodNo` int(11) NOT NULL,
  `refNo` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `cost` decimal(18,2) NOT NULL,
  `chargeTo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_time`
--

CREATE TABLE `lead_time` (
  `leadTimeID` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `leadTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_time`
--

INSERT INTO `lead_time` (`leadTimeID`, `type`, `leadTime`) VALUES
(1, 'Cash Advance', 5),
(2, 'Budget', 5),
(3, 'Accounting', 5);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `managerID` int(11) NOT NULL,
  `dateReceived` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `dateApproved` date DEFAULT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`managerID`, `dateReceived`, `status`, `dateApproved`, `remarks`) VALUES
(139, '2018-08-22', 'Approved', '2018-08-22', 'ASD'),
(140, '2018-08-16', 'Approved', '2018-08-16', 'sd'),
(141, '2018-08-22', 'Approved', '2018-08-22', 'yeah');

-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `prID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `managerID` int(11) NOT NULL,
  `cctlID` int(11) NOT NULL,
  `budgetID` int(11) NOT NULL,
  `purchasingID` int(11) NOT NULL,
  `acctgID` int(11) NOT NULL,
  `calID` int(11) NOT NULL,
  `expenseID` int(11) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `dateEntered` date NOT NULL,
  `weekNo` int(11) NOT NULL,
  `periodNo` int(11) NOT NULL,
  `refNo` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `cost` decimal(18,2) NOT NULL,
  `chargeTo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `purchasingID` int(11) NOT NULL,
  `dateReceived` date NOT NULL,
  `receivedBy` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `poNo` int(11) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `releaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rfp`
--

CREATE TABLE `rfp` (
  `rfpID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `managerID` int(11) DEFAULT NULL,
  `cctlID` int(11) DEFAULT NULL,
  `budgetID` int(11) DEFAULT NULL,
  `acctgID` int(11) DEFAULT NULL,
  `calID` int(11) NOT NULL,
  `expenseID` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateEntered` date NOT NULL,
  `weekNo` int(11) NOT NULL,
  `periodNo` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `payee` varchar(50) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `cost` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionID` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionID`, `type`) VALUES
(1, 'Proj. Mgt.'),
(2, 'R&D Farm'),
(3, 'R&D'),
(4, 'LDM'),
(5, 'Golden Block'),
(6, 'PreAg'),
(7, 'Gen. Mgt.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `companyID`, `firstName`, `lastName`, `email`, `username`, `password`, `userType`) VALUES
(1, 1, 'Omar', 'Abdullah', '..', 'admin', '$2y$10$van4YxewjKUqpCIhOgPiJuztl3QNWzHMPXdkJ7p7Bfjn77zJRPikS', 'Admin'),
(10, 1, 'Malkuth', 'Anggadol', '...', 'admin1', '$2y$10$van4YxewjKUqpCIhOgPiJuztl3QNWzHMPXdkJ7p7Bfjn77zJRPikS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`acctgID`);

--
-- Indexes for table `banana_calendars`
--
ALTER TABLE `banana_calendars`
  ADD PRIMARY KEY (`calID`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budgetID`),
  ADD KEY `leadTimeID` (`leadTimeID`);

--
-- Indexes for table `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`caID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `calID` (`calID`),
  ADD KEY `managerID` (`managerID`),
  ADD KEY `budgetID` (`budgetID`),
  ADD KEY `acctgID` (`acctgID`),
  ADD KEY `expenseID` (`expenseID`),
  ADD KEY `sectionID` (`sectionID`),
  ADD KEY `leadTimeID` (`leadTimeID`);

--
-- Indexes for table `cctl`
--
ALTER TABLE `cctl`
  ADD PRIMARY KEY (`cctlID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `expense_account`
--
ALTER TABLE `expense_account`
  ADD PRIMARY KEY (`expenseID`);

--
-- Indexes for table `jsr`
--
ALTER TABLE `jsr`
  ADD PRIMARY KEY (`jsrID`);

--
-- Indexes for table `lead_time`
--
ALTER TABLE `lead_time`
  ADD PRIMARY KEY (`leadTimeID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`managerID`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`prID`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`purchasingID`);

--
-- Indexes for table `rfp`
--
ALTER TABLE `rfp`
  ADD PRIMARY KEY (`rfpID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `companyID` (`companyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting`
--
ALTER TABLE `accounting`
  MODIFY `acctgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `banana_calendars`
--
ALTER TABLE `banana_calendars`
  MODIFY `calID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budgetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ca`
--
ALTER TABLE `ca`
  MODIFY `caID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `cctl`
--
ALTER TABLE `cctl`
  MODIFY `cctlID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_account`
--
ALTER TABLE `expense_account`
  MODIFY `expenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jsr`
--
ALTER TABLE `jsr`
  MODIFY `jsrID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_time`
--
ALTER TABLE `lead_time`
  MODIFY `leadTimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `managerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `pr`
--
ALTER TABLE `pr`
  MODIFY `prID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `purchasingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rfp`
--
ALTER TABLE `rfp`
  MODIFY `rfpID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`leadTimeID`) REFERENCES `lead_time` (`leadTimeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ca`
--
ALTER TABLE `ca`
  ADD CONSTRAINT `ca_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_ibfk_10` FOREIGN KEY (`expenseID`) REFERENCES `expense_account` (`expenseID`),
  ADD CONSTRAINT `ca_ibfk_2` FOREIGN KEY (`calID`) REFERENCES `banana_calendars` (`calID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_ibfk_4` FOREIGN KEY (`budgetID`) REFERENCES `budget` (`budgetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_ibfk_5` FOREIGN KEY (`acctgID`) REFERENCES `accounting` (`acctgID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_ibfk_7` FOREIGN KEY (`leadTimeID`) REFERENCES `lead_time` (`leadTimeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_ibfk_8` FOREIGN KEY (`sectionID`) REFERENCES `section` (`sectionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_ibfk_9` FOREIGN KEY (`managerID`) REFERENCES `manager` (`managerID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
