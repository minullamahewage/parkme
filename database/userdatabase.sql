-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 02:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `carparks`
--

CREATE TABLE `carparks` (
  `cpid` int(11) NOT NULL,
  `cpname` text NOT NULL,
  `cplat` float NOT NULL,
  `cplng` float NOT NULL,
  `cpavailable` int(11) NOT NULL,
  `cptotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carparks`
--

INSERT INTO `carparks` (`cpid`, `cpname`, `cplat`, `cplng`, `cpavailable`, `cptotal`) VALUES
(1, 'Car Park 1', 6.91175, 79.8514, 1, 1),
(2, 'Car Park 2(Mt. Lavinia)', 6.83284, 79.8673, 2, 2),
(3, 'Car Park 3(Boralesgamuwa)', 6.84131, 79.8932, 3, 3),
(4, 'Car Park 4(K zone)', 6.79585, 79.8883, 4, 4),
(5, 'Car Park 5', 6.91175, 79.8514, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contactform`
--

CREATE TABLE `contactform` (
  `eid` int(11) NOT NULL,
  `ename` text NOT NULL,
  `eemail` text NOT NULL,
  `ephone` text NOT NULL,
  `emessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `contactform`
--

INSERT INTO `contactform` (`eid`, `ename`, `eemail`, `ephone`, `emessage`) VALUES
(1, 'admin', 'admin@parkme.lk', '011111111', 'Test'),
(2, 'admin', 'admin@parkme.lk', '011111111', 'Test'),
(3, 'admin', 'admin@parkme.lk', '00000', 'Test'),
(4, 'admin', 'admin@parkme.lk', '000000', 'test'),
(5, 'admin', 'admin@parkme.lk', '000000', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `ufname` varchar(30) DEFAULT NULL,
  `uemail` varchar(30) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `udob` varchar(20) DEFAULT NULL,
  `ugender` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `ufname`, `uemail`, `upass`, `udob`, `ugender`) VALUES
(2, 'admin', 'admin@parkme.lk', '21232f297a57a5a743894a0e4a801fc3', '', NULL),
(3, 'testuser1', 'test1@parkme.lk', '5a105e8b9d40e1329780d62ea2265d8a', '', NULL),
(4, 'testuser2', 'test2@parkme.lk', 'ad0234829205b9033196ba818f7a872b', '2019-03-06', NULL),
(5, 'Minul Lamahewage', 'minullamahewage@gmail.com', 'b22ec88fa92868795323880625f9afa5', '19/10/2019', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carparks`
--
ALTER TABLE `carparks`
  ADD PRIMARY KEY (`cpid`);

--
-- Indexes for table `contactform`
--
ALTER TABLE `contactform`
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `ufname` (`ufname`),
  ADD UNIQUE KEY `uemail` (`uemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carparks`
--
ALTER TABLE `carparks`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
