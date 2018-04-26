-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2018 at 05:30 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TicketGeek`
--

-- --------------------------------------------------------

--
-- Table structure for table `Tickets`
--

CREATE TABLE `Tickets` (
  `TicketID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(10) NOT NULL,
  `PostalCode` int(15) NOT NULL,
  `RecoveryToken` varchar(200) NOT NULL,
  `SessionToken` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;