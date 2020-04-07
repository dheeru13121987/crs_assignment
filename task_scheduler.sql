-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 11:35 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `designation`) VALUES
(1, 'Dheerendra', 'TL'),
(2, 'Ronny', 'Trainee'),
(3, 'Ravi', 'Executive'),
(4, 'Teja', 'Clerk');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `type`, `detail`) VALUES
(1, 'High', 'Done on very urgent basis'),
(2, 'medium', 'Done on urgent basis'),
(3, 'Low', 'Done it');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `deadline` date NOT NULL,
  `priority_id` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `deadline`, `priority_id`, `employee_id`, `create_date`, `update_date`) VALUES
(1, 'Make Sorting Program', 'User want sorting program for its use', '2020-05-31', 1, 2, '2020-04-07 08:27:45', '2020-04-07 11:19:44'),
(2, 'Make Prime Number Program', 'User want prime number program for its use', '2020-05-31', 2, 3, '2020-04-07 08:27:45', '2020-04-07 11:19:38'),
(3, 'Odd Even Program', 'User want to Odd Even Program for its use', '0000-00-00', 3, 4, '2020-04-07 10:38:40', '2020-04-07 11:19:33'),
(4, 'Odd Even Program', 'User want to Odd Even Program for its use', '0000-00-00', 3, 1, '2020-04-07 10:39:37', '2020-04-07 11:19:26'),
(5, 'Odd Even Program', 'User want to Odd Even Program for its use', '0000-00-00', 3, 3, '2020-04-07 10:39:49', '2020-04-07 11:19:04'),
(6, 'Odd Even Program', 'User want to Odd Even Program for its use', '2020-04-07', 3, 4, '2020-04-07 10:43:03', '2020-04-07 11:18:54'),
(7, 'Odd Even Program', 'User want to Odd Even Program for its use', '2020-04-07', 1, 1, '2020-04-07 10:46:31', '2020-04-07 11:18:47'),
(8, 'Odd Even Program', 'User want to Odd Even Program for its use', '2020-04-07', 1, 2, '2020-04-07 10:47:05', '2020-04-07 11:18:35'),
(9, 'Odd Even Program', 'User want to Odd Even Program for its use', '2020-04-07', 2, 2, '2020-04-07 10:50:48', '2020-04-07 11:17:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
