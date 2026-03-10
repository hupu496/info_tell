-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2026 at 11:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_id_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `reciept`
--

CREATE TABLE `reciept` (
  `id` int(11) NOT NULL,
  `project_name` text NOT NULL,
  `quotation_for` text NOT NULL,
  `buyer` text NOT NULL,
  `description` text NOT NULL,
  `totalprice` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reciept`
--

INSERT INTO `reciept` (`id`, `project_name`, `quotation_for`, `buyer`, `description`, `totalprice`, `items`, `added_on`, `due_date`, `status`) VALUES
(1, 'Cloud Mighjhgjhgjhgration', 'Indian Oil', 'Aditya', 'gfhfghgh', '25', '[{\"description\":\"dfgr\",\"quantity\":1,\"unit_price\":25}]', '2026-02-28 13:07:19', '2026-03-30 00:00:00', 1),
(2, 'Cloud Migrfghgfhation', 'Indian Oilfgh', 'gfhgfhg', 'vgghjg', '5', '[{\"itemname\":\"bnm\",\"quantity\":1,\"unit_price\":5}]', '2026-02-28 15:09:13', '2026-03-30 00:00:00', 1),
(3, 'Cloud Migrfghgfhation', 'Indian Oilfgh', 'gfhgfhg', 'vgghjg', '5', '[{\"itemname\":\"bnm\",\"quantity\":1,\"unit_price\":5}]', '2026-02-28 15:21:14', '2026-03-30 00:00:00', 1),
(4, 'Cloud Migration', 'Indian Oilfgh', 'gfhgfhg', 'hjhjj', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-02-28 15:43:56', '2026-03-19 00:00:00', 1),
(5, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjikjk', '18000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000},{\"itemname\":\"dfgr\",\"quantity\":2,\"unit_price\":4000}]', '2026-02-28 16:32:33', '2027-03-28 00:00:00', 1),
(6, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjikjk', '18000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000},{\"itemname\":\"dfgr\",\"quantity\":2,\"unit_price\":4000}]', '2026-02-28 16:33:37', '2027-03-28 00:00:00', 1),
(7, 'Cloud Migration', 'Indian Oil', '', 'ffff', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-02-28 17:00:08', '2026-03-30 00:00:00', 1),
(8, 'Cloud Migration', 'Indian Oil', '', 'ffff', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-02-28 17:01:10', '2026-03-30 00:00:00', 1),
(9, 'Cloud Migration', 'Indian Oil', '', 'ffff', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-02-28 17:01:19', '2026-03-30 00:00:00', 1),
(10, 'Cloud Migration', 'Indian Oilfgh', 'gfhgfhg', 'fghgfh', '15000', '[{\"itemname\":\"dfgr\",\"quantity\":3,\"unit_price\":5000}]', '2026-02-28 17:04:16', '2027-05-30 00:00:00', 1),
(11, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjkjk', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-02 12:08:09', '2026-04-01 00:00:00', 1),
(12, 'Cloud Migration', 'Indian Oil', 'Aditya', 'fgfgh', '50000', '[{\"itemname\":\"bnm\",\"quantity\":1,\"unit_price\":50000}]', '2026-03-02 14:06:49', '2026-04-01 00:00:00', 1),
(13, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjkhkj', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 15:18:40', '2026-04-05 00:00:00', 1),
(14, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjkhkj', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 15:19:17', '2026-04-05 00:00:00', 1),
(15, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hghg', '0', '[{\"itemname\":\"dfgr\",\"quantity\":2,\"unit_price\":0}]', '2026-03-06 15:20:11', '2026-04-05 00:00:00', 1),
(16, 'Cloud Migration', 'Indian Oil', 'Aditya', 'ghghg', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 16:29:40', '2026-04-05 00:00:00', 1),
(17, 'Cloud Migration', 'Indian Oil', 'Aditya', 'ghghg', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 16:42:04', '2026-04-05 00:00:00', 1),
(18, 'Cloud Migration', 'Indian Oil', 'Aditya', 'cfgfh', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 16:45:32', '2026-04-05 00:00:00', 1),
(19, 'Cloud Migration', 'Indian Oil', 'Aditya', 'bjbm', '15666', '[{\"itemname\":\"dfgr\",\"quantity\":3,\"unit_price\":5222}]', '2026-03-06 16:52:29', '2026-04-05 00:00:00', 1),
(20, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjhj', '6000', '[{\"itemname\":\"dfgr\",\"quantity\":3,\"unit_price\":2000}]', '2026-03-06 17:45:08', '2026-04-05 00:00:00', 1),
(21, 'Cloud Migration', 'Indian Oil', 'Aditya', 'ggjhj', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 21:50:20', '2026-04-05 00:00:00', 1),
(22, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hhbbj', '10000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-06 23:53:57', '2026-04-05 00:00:00', 1),
(23, 'Cloud Migration', 'Indian Oil', 'Aditya', 'hjhjhj', '60000', '[{\"itemname\":\"dfgr\",\"quantity\":3,\"unit_price\":20000}]', '2026-03-07 13:53:50', '2026-04-06 00:00:00', 1),
(24, 'Cloud Migration', 'Indian Oil', 'Aditya', 'nmnmn', '10000', '[{\"itemname\":\"dfgr\",\"quantity\":2,\"unit_price\":5000}]', '2026-03-08 13:54:29', '2026-04-07 00:00:00', 1),
(25, 'Cloud Migration', 'Indian Oil', 'Aditya', 'gjhjh', '60000', '[{\"itemname\":\"bnm\",\"quantity\":2,\"unit_price\":30000}]', '2026-03-08 14:38:10', '2026-04-07 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `class`, `section`, `father_name`, `dob`, `blood_group`, `phone`, `photo`, `created_at`) VALUES
(1, '7564545', 'sona', '7', 'A', 'hgfgfg', '2026-01-08', 'B-', '7999669691', 'uploads/photos/7564545.png', '2026-01-13 16:26:41'),
(2, '98787', 'sona', '5', 'c', 'kumar', '2026-01-09', 'AB+', '6205778457', 'uploads/photos/98787.png', '2026-01-17 14:19:33'),
(3, '98787', 'sona', '5', 'B', 'Binay Kumar', '2026-01-15', 'AB+', '8676756565', 'uploads/photos/98787.png', '2026-01-17 14:35:18'),
(4, '6545', 'ghgh', '9', 'd', 'Binay Kumar', '2026-01-14', 'B+', '8676756565', 'uploads/photos/6545.png', '2026-01-17 14:36:19'),
(5, '7564545', 'SONA', '11', 'B', 'kumar', '2026-01-01', 'B+', '6205778457', 'uploads/photos/7564545.png', '2026-01-17 14:41:46'),
(6, '98787', 'sona', '5', 'B', 'kumar', '2026-01-23', 'B+', 'U676756565', 'uploads/photos/98787.png', '2026-01-17 14:42:29'),
(7, '', '', '', '', '', '0000-00-00', '', '', 'uploads/photos/.png', '2026-01-17 14:53:05'),
(8, '', '', '', '', '', '0000-00-00', '', '', 'uploads/photos/.png', '2026-01-17 14:53:23'),
(9, '98', 'sujata', '7', 'c', 'Binay Kumar', '2025-12-30', 'A+', '8676756565', 'uploads/photos/98.png', '2026-01-17 14:53:35'),
(10, '98', 'Sona', '2', 'g', 'Binay Kumar', '2025-12-28', 'A+', '8676767565', 'uploads/photos/98.png', '2026-01-17 14:54:49'),
(11, '90', 'sehggy', '5', 'A', 'hghfgfg', '2025-12-31', 'B+', '6205778457', 'uploads/photos/90.png', '2026-01-17 14:56:14'),
(12, '54', 'hkhk', '8', 'D', 'jhsjhsj', '2025-09-29', 'B-', '8676767565', 'uploads/photos/54.png', '2026-01-17 14:58:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reciept`
--
ALTER TABLE `reciept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reciept`
--
ALTER TABLE `reciept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
