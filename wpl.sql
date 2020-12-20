-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2020 at 01:04 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sid` int(11) NOT NULL,
  `sname` varchar(120) DEFAULT NULL,
  `cgpa` float DEFAULT NULL,
  `skills` varchar(1000) DEFAULT NULL,
  `phonenum` varchar(11) DEFAULT NULL,
  `syear` int(11) DEFAULT NULL,
  `sbranch` varchar(100) DEFAULT NULL,
  `semail` varchar(100) DEFAULT NULL,
  `spwd` varchar(50) DEFAULT NULL,
  `sinfo` varchar(300) DEFAULT NULL,
  `s10` int(3) DEFAULT NULL,
  `s12` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `sname`, `cgpa`, `skills`, `phonenum`, `syear`, `sbranch`, `semail`, `spwd`, `sinfo`, `s10`, `s12`) VALUES
(1, 'Mister Crowley', 7.8, 'ozzy osbourne, pizza hut, sleeping genius', '1234567890', 3, 'Information Technology', 'a@spit.ac.in', '123', 'dumb', 89, 92),
(2, 'Mohammad Anas Mudassir', 9.8, 'android, css, java, html, c, python', '9876543210', 3, 'Information Technology', 'mohammadanas.mudassir@spit.ac.in', '12345678', 'Sleepy guy who struggles to sleep', 95, 90),
(3, 'Ramesh Kumar', 8.2, 'java, mysql, android, python', '1234567890', 3, 'Computer Science', 'ramesh@spit.ac.in', '00000000', 'dumb', 85, 82),
(4, 'Write The Name', 8, 'android, java, python, ruby, c, mysql', '2147483647', 1, 'EXTC', 'somename@spit.ac.in', '12345678', 'description', 80, 80),
(5, 'Xcghj', 7, 'c, java, html', '1234567890', 4, 'EXTC', 'hey@spit.ac.in', '12345678', 'sdfghj', 87, 87),
(6, NULL, NULL, NULL, NULL, NULL, NULL, 'anas@spit.ac.in', '12345678', NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, 'helloeveryone@spit.ac.in', 'abcdefgh', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
