-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 09:06 PM
-- Server version: 8.0.25
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `sno` int NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`sno`, `title`, `description`, `date_time`) VALUES
(1, 'Read java', 'Please read java it is very imp to us.', '2021-07-18 22:41:52'),
(2, 'Read c++', 'Please read c++ it is very imp to us.', '2021-07-18 23:30:32'),
(3, 'Big Boss', 'Big Boss', '2021-07-18 23:47:05'),
(4, 'Introduction to dynamics', 'test dynamic', '2021-07-18 23:51:19'),
(5, 'Ninja', 'Ninja in hyd\r\n', '2021-07-18 23:51:58'),
(6, 'Brilliant grammar', 'Brilliant grammar', '2021-07-18 23:52:13'),
(7, 'fake', 'dfak\r\n', '2021-07-18 23:52:19'),
(8, 'Ola booking', 'need to book', '2021-07-18 23:52:46'),
(9, 'Zomato', 'Buy Pizza in Zomato', '2021-07-18 23:53:06'),
(10, 'Look Cycle', 'Look for a cheap and good cycle', '2021-07-18 23:53:28'),
(11, 'amazon', 'apply to amazon', '2021-07-18 23:53:44'),
(12, 'Time Sheet', 'Fill the OpsArc', '2021-07-18 23:54:00'),
(13, 'hammer', 'need to buy hammer', '2021-07-18 23:54:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `sno` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
