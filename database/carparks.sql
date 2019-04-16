-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2019 at 12:06 PM
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
  `cptotal` int(11) NOT NULL,
  `cpbooked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carparks`
--

INSERT INTO `carparks` (`cpid`, `cpname`, `cplat`, `cplng`, `cpavailable`, `cptotal`, `cpbooked`) VALUES
(1, 'Car Park 1', 6.91175, 79.8514, 1, 1, 0),
(2, 'Car Park 2(Mt. Lavinia)', 6.83284, 79.8673, 2, 2, 0),
(3, 'Car Park 3(Boralesgamuwa)', 6.84131, 79.8932, 0, 3, 0),
(4, 'Car Park 4(K zone)', 6.79585, 79.8883, 4, 4, 0),
(5, 'Car Park 5', 6.91175, 79.8514, 5, 5, 0),
(6, 'Cark Park 6(Diyawanna Oya Park)', 6.89066, 79.9066, 6, 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carparks`
--
ALTER TABLE `carparks`
  ADD PRIMARY KEY (`cpid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carparks`
--
ALTER TABLE `carparks`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
