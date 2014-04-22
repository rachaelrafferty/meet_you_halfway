-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2014 at 05:10 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `halfway`
--

-- --------------------------------------------------------

--
-- Table structure for table `Coords`
--

CREATE TABLE `Coords` (
  `Coords_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Longitude` float NOT NULL,
  `Latitude` float NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Coords_Id`),
  KEY `User_Id` (`User_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `Coords`
--

INSERT INTO `Coords` (`Coords_Id`, `Longitude`, `Latitude`, `User_Id`) VALUES
(1, -5.91787, 54.5757, 56291304),
(3, -5.93249, 54.5898, 75436744),
(4, -5.91786, 54.5756, 75436249),
(5, -5.91785, 54.5756, 75436955),
(11, -4.45891, 59.7878, NULL),
(12, -4.45891, 59.7878, NULL),
(13, -4.45891, 59.7878, NULL),
(14, -4.45893, 59.7878, NULL),
(15, -4.45893, 59.7878, NULL),
(16, -4.45892, 59.7878, NULL),
(17, -4.45893, 59.7878, NULL),
(18, -4.45891, 59.7878, NULL),
(19, -4.45893, 59.7878, NULL),
(20, -4.45895, 59.7878, NULL),
(21, -4.45892, 59.7878, NULL),
(22, -5.91785, 54.5756, 75437036),
(23, -5.91785, 54.5756, NULL),
(24, -5.93244, 54.5898, 326838),
(25, -5.923, 54.5814, NULL),
(26, -5.92518, 54.5827, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Match`
--

CREATE TABLE `Match` (
  `Match_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Request_Id` int(11) NOT NULL,
  `Halfway_Coords` int(11) NOT NULL,
  PRIMARY KEY (`Match_Id`),
  KEY `Request_Id` (`Request_Id`),
  KEY `Halfway_Coords` (`Halfway_Coords`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Match`
--

INSERT INTO `Match` (`Match_Id`, `Request_Id`, `Halfway_Coords`) VALUES
(4, 157, 21),
(5, 158, 23),
(6, 161, 25),
(7, 154, 26);

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `Request_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_A_Id` int(11) NOT NULL,
  `User_B_Id` int(11) NOT NULL,
  `User_A_Coords` int(11) NOT NULL,
  `User_B_Coords` int(11) DEFAULT NULL,
  PRIMARY KEY (`Request_Id`),
  KEY `User_A_Id` (`User_A_Id`),
  KEY `User_B_Id` (`User_B_Id`),
  KEY `User_A_Coords` (`User_A_Coords`),
  KEY `User_B_Coords` (`User_B_Coords`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `Requests`
--

INSERT INTO `Requests` (`Request_Id`, `User_A_Id`, `User_B_Id`, `User_A_Coords`, `User_B_Coords`) VALUES
(154, 56291304, 75436744, 1, 3),
(157, 75436249, 75436955, 4, 5),
(158, 75437036, 75436955, 22, 5),
(159, 75437036, 75436955, 22, NULL),
(161, 326838, 56291304, 24, 1),
(162, 326838, 56291304, 24, NULL),
(163, 75436249, 75437036, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_Id` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_Id`, `Email`, `Name`, `Surname`) VALUES
(326838, 'ciarabryans@gmail.com', 'Ciara', 'Bryans'),
(56291304, 'rachaelrafferty@yahoo.co.uk', 'Rachael', 'Rafferty'),
(75436249, 'rachael+wolverine@airpos.co.uk', 'Hugh', 'Jackman'),
(75436744, 'rachael+rogue@airpos.co.uk', 'Rogue', 'X-man'),
(75436955, 'rachael+gambit@airpos.co.uk', 'Gambit', 'LeBeau'),
(75437036, 'rachael+jeangrey@airpos.co.uk', 'Jean', 'Grey');

-- --------------------------------------------------------

--
-- Table structure for table `Venue_Choice`
--

CREATE TABLE `Venue_Choice` (
  `Venue_Id` int(11) NOT NULL,
  `Venue_Coords` int(11) NOT NULL COMMENT 'This will be ll from api',
  `Match_Id` int(11) NOT NULL,
  PRIMARY KEY (`Venue_Id`),
  KEY `Match_Id` (`Match_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Coords`
--
ALTER TABLE `Coords`
  ADD CONSTRAINT `coords_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`);

--
-- Constraints for table `Match`
--
ALTER TABLE `Match`
  ADD CONSTRAINT `match_ibfk_1` FOREIGN KEY (`Request_Id`) REFERENCES `Requests` (`Request_Id`),
  ADD CONSTRAINT `match_ibfk_2` FOREIGN KEY (`Halfway_Coords`) REFERENCES `Coords` (`Coords_ID`);

--
-- Constraints for table `Requests`
--
ALTER TABLE `Requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`User_A_Id`) REFERENCES `User` (`User_Id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`User_B_Id`) REFERENCES `User` (`User_Id`),
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`User_A_Coords`) REFERENCES `Coords` (`Coords_ID`),
  ADD CONSTRAINT `requests_ibfk_4` FOREIGN KEY (`User_B_Coords`) REFERENCES `Coords` (`Coords_ID`);

--
-- Constraints for table `Venue_Choice`
--
ALTER TABLE `Venue_Choice`
  ADD CONSTRAINT `venue_choice_ibfk_1` FOREIGN KEY (`Match_Id`) REFERENCES `Match` (`Match_Id`);
