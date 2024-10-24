-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2024 at 06:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `prn` varchar(20) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `period` int(11) NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `is_theory` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `prn`, `subject_code`, `date`, `period`, `status`, `is_theory`, `created_at`) VALUES
(1, '1032232197', 'FDS', '2024-04-13', 6, 'present', 1, '2024-10-24 02:08:41'),
(2, '1032232197', 'FDS', '2024-04-13', 7, 'present', 0, '2024-10-24 02:08:41'),
(3, '1032232197', 'FDS', '2024-04-15', 3, 'present', 1, '2024-10-24 02:08:41'),
(4, '1032232197', 'FDS', '2024-04-18', 4, 'absent', 1, '2024-10-24 02:08:41'),
(5, '1032232197', 'FDS', '2024-04-21', 2, 'present', 0, '2024-10-24 02:08:41'),
(6, '1032232197', 'DBMS', '2024-04-13', 1, 'present', 1, '2024-10-24 02:08:41'),
(7, '1032232197', 'DBMS', '2024-04-14', 2, 'present', 1, '2024-10-24 02:08:41'),
(8, '1032232197', 'DBMS', '2024-04-15', 3, 'present', 0, '2024-10-24 02:08:41'),
(9, '1032232197', 'DBMS', '2024-04-16', 4, 'present', 1, '2024-10-24 02:08:41'),
(10, '1032232197', 'DBMS', '2024-04-17', 5, 'absent', 1, '2024-10-24 02:08:41'),
(11, '1032232197', 'DBMS', '2024-04-18', 6, 'present', 0, '2024-10-24 02:08:41'),
(12, '1032232197', 'DBMS', '2024-04-19', 7, 'absent', 1, '2024-10-24 02:08:41'),
(13, '1032232197', 'DBMS', '2024-04-20', 8, 'absent', 1, '2024-10-24 02:08:41'),
(14, '1032232197', 'PBL', '2024-04-13', 1, 'present', 0, '2024-10-24 02:08:41'),
(15, '1032232197', 'PBL', '2024-04-14', 2, 'present', 0, '2024-10-24 02:08:41'),
(16, '1032232197', 'PBL', '2024-04-15', 3, 'present', 0, '2024-10-24 02:08:41'),
(17, '1032232197', 'PBL', '2024-04-16', 4, 'present', 0, '2024-10-24 02:08:41'),
(18, '1032232197', 'PBL', '2024-04-17', 5, 'present', 0, '2024-10-24 02:08:41'),
(19, '1032232197', 'PBL', '2024-04-18', 6, 'present', 0, '2024-10-24 02:08:41'),
(20, '1032232229', 'FDS', '2024-04-13', 6, 'present', 1, '2024-10-24 04:11:21'),
(21, '1032232229', 'FDS', '2024-04-13', 7, 'present', 0, '2024-10-24 04:11:21'),
(22, '1032232229', 'FDS', '2024-04-15', 3, 'present', 1, '2024-10-24 04:11:21'),
(23, '1032232229', 'FDS', '2024-04-18', 4, 'absent', 1, '2024-10-24 04:11:21'),
(24, '1032232229', 'FDS', '2024-04-21', 2, 'absent', 0, '2024-10-24 04:11:21'),
(25, '1032232229', 'DBMS', '2024-04-13', 1, 'present', 1, '2024-10-24 04:11:21'),
(26, '1032232229', 'DBMS', '2024-04-14', 2, 'present', 1, '2024-10-24 04:11:21'),
(27, '1032232229', 'DBMS', '2024-04-15', 3, 'present', 0, '2024-10-24 04:11:21'),
(28, '1032232229', 'DBMS', '2024-04-16', 4, 'present', 1, '2024-10-24 04:11:21'),
(29, '1032232229', 'DBMS', '2024-04-17', 5, 'present', 1, '2024-10-24 04:11:21'),
(30, '1032232229', 'DBMS', '2024-04-18', 6, 'present', 0, '2024-10-24 04:11:21'),
(31, '1032232229', 'DBMS', '2024-04-19', 7, 'present', 1, '2024-10-24 04:11:21'),
(32, '1032232229', 'DBMS', '2024-04-20', 8, 'absent', 1, '2024-10-24 04:11:21'),
(33, '1032232229', 'PBL', '2024-04-13', 1, 'present', 0, '2024-10-24 04:11:21'),
(34, '1032232229', 'PBL', '2024-04-14', 2, 'present', 0, '2024-10-24 04:11:21'),
(35, '1032232229', 'PBL', '2024-04-15', 3, 'present', 0, '2024-10-24 04:11:21'),
(36, '1032232229', 'PBL', '2024-04-16', 4, 'present', 0, '2024-10-24 04:11:21'),
(37, '1032232229', 'PBL', '2024-04-17', 5, 'present', 0, '2024-10-24 04:11:21'),
(38, '1032232229', 'PBL', '2024-04-18', 6, 'present', 0, '2024-10-24 04:11:21'),
(39, '1032232229', 'FDS', '2024-10-21', 1, 'present', 1, '2024-10-24 04:48:17'),
(40, '1032232229', 'DBMS', '2024-10-21', 2, 'present', 1, '2024-10-24 04:48:17'),
(41, '1032232229', 'PBL', '2024-10-21', 3, 'present', 0, '2024-10-24 04:48:17'),
(42, '1032232229', 'FDS', '2024-10-22', 1, 'present', 0, '2024-10-24 04:48:18'),
(43, '1032232229', 'DBMS', '2024-10-22', 2, 'absent', 1, '2024-10-24 04:48:18'),
(44, '1032232229', 'PBL', '2024-10-22', 3, 'present', 0, '2024-10-24 04:48:18'),
(45, '1032232229', 'FDS', '2024-10-23', 1, 'present', 1, '2024-10-24 04:48:18'),
(46, '1032232229', 'DBMS', '2024-10-23', 2, 'present', 0, '2024-10-24 04:48:18'),
(47, '1032232229', 'PBL', '2024-10-23', 3, 'absent', 0, '2024-10-24 04:48:18'),
(48, '1032232229', 'FDS', '2024-10-24', 1, 'present', 1, '2024-10-24 04:48:18'),
(49, '1032232229', 'DBMS', '2024-10-24', 2, 'present', 1, '2024-10-24 04:48:18'),
(50, '1032232229', 'PBL', '2024-10-24', 3, 'present', 0, '2024-10-24 04:48:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_attendance` (`prn`,`subject_code`,`date`,`period`),
  ADD KEY `subject_code` (`subject_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`prn`) REFERENCES `students` (`prn`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
