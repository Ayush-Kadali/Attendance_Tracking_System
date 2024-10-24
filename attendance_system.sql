-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2024 at 07:31 AM
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
  `is_theory` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `prn`, `subject_code`, `date`, `period`, `status`, `is_theory`) VALUES
(1, '1032232197', 'FDS', '2024-04-13', 6, 'present', 1),
(2, '1032232197', 'FDS', '2024-04-13', 7, 'present', 0),
(3, '1032232197', 'FDS', '2024-04-15', 3, 'present', 1),
(4, '1032232197', 'FDS', '2024-04-18', 4, 'absent', 1),
(5, '1032232197', 'FDS', '2024-04-21', 2, 'present', 0),
(6, '1032232197', 'DBMS', '2024-04-13', 1, 'present', 1),
(7, '1032232197', 'DBMS', '2024-04-14', 2, 'present', 1),
(8, '1032232197', 'DBMS', '2024-04-15', 3, 'present', 0),
(9, '1032232197', 'DBMS', '2024-04-16', 4, 'present', 1),
(10, '1032232197', 'DBMS', '2024-04-17', 5, 'absent', 1),
(11, '1032232197', 'DBMS', '2024-04-18', 6, 'present', 0),
(12, '1032232197', 'DBMS', '2024-04-19', 7, 'absent', 1),
(13, '1032232197', 'DBMS', '2024-04-20', 8, 'absent', 1),
(14, '1032232197', 'PBL', '2024-04-13', 1, 'present', 0),
(15, '1032232197', 'PBL', '2024-04-14', 2, 'present', 0),
(16, '1032232197', 'PBL', '2024-04-15', 3, 'present', 0),
(17, '1032232197', 'PBL', '2024-04-16', 4, 'present', 0),
(18, '1032232197', 'PBL', '2024-04-17', 5, 'present', 0),
(19, '1032232197', 'PBL', '2024-04-18', 6, 'present', 0),
(20, '1032232229', 'FDS', '2024-04-13', 6, 'present', 1),
(21, '1032232229', 'FDS', '2024-04-13', 7, 'present', 0),
(22, '1032232229', 'FDS', '2024-04-15', 3, 'present', 1),
(23, '1032232229', 'FDS', '2024-04-18', 4, 'absent', 1),
(24, '1032232229', 'FDS', '2024-04-21', 2, 'absent', 0),
(25, '1032232229', 'DBMS', '2024-04-13', 1, 'present', 1),
(26, '1032232229', 'DBMS', '2024-04-14', 2, 'present', 1),
(27, '1032232229', 'DBMS', '2024-04-15', 3, 'present', 0),
(28, '1032232229', 'DBMS', '2024-04-16', 4, 'present', 1),
(29, '1032232229', 'DBMS', '2024-04-17', 5, 'present', 1),
(30, '1032232229', 'DBMS', '2024-04-18', 6, 'present', 0),
(31, '1032232229', 'DBMS', '2024-04-19', 7, 'present', 1),
(32, '1032232229', 'DBMS', '2024-04-20', 8, 'absent', 1),
(33, '1032232229', 'PBL', '2024-04-13', 1, 'present', 0),
(34, '1032232229', 'PBL', '2024-04-14', 2, 'present', 0),
(35, '1032232229', 'PBL', '2024-04-15', 3, 'present', 0),
(36, '1032232229', 'PBL', '2024-04-16', 4, 'present', 0),
(37, '1032232229', 'PBL', '2024-04-17', 5, 'present', 0),
(38, '1032232229', 'PBL', '2024-04-18', 6, 'present', 0),
(39, '1032232229', 'FDS', '2024-10-21', 1, 'present', 1),
(40, '1032232229', 'DBMS', '2024-10-21', 2, 'present', 1),
(41, '1032232229', 'PBL', '2024-10-21', 3, 'present', 0),
(42, '1032232229', 'FDS', '2024-10-22', 1, 'present', 0),
(43, '1032232229', 'DBMS', '2024-10-22', 2, 'absent', 1),
(44, '1032232229', 'PBL', '2024-10-22', 3, 'present', 0),
(45, '1032232229', 'FDS', '2024-10-23', 1, 'present', 1),
(46, '1032232229', 'DBMS', '2024-10-23', 2, 'present', 0),
(47, '1032232229', 'PBL', '2024-10-23', 3, 'absent', 0),
(48, '1032232229', 'FDS', '2024-10-24', 1, 'present', 1),
(49, '1032232229', 'DBMS', '2024-10-24', 2, 'present', 1),
(50, '1032232229', 'PBL', '2024-10-24', 3, 'present', 0),
(115, '1032232197', 'DBMS', '2024-10-21', 1, 'absent', 1),
(116, '1032232197', 'FDS', '2024-10-21', 2, 'present', 1),
(117, '1032232197', 'PBL', '2024-10-21', 3, 'present', 1),
(118, '1032232197', 'DBMS', '2024-10-21', 4, 'present', 1),
(119, '1032232197', 'PBL', '2024-10-22', 1, 'present', 1),
(120, '1032232197', 'DBMS', '2024-10-22', 2, 'present', 1),
(121, '1032232197', 'FDS', '2024-10-22', 3, 'absent', 1),
(122, '1032232197', 'PBL', '2024-10-22', 4, 'present', 1),
(123, '1032232197', 'FDS', '2024-10-23', 1, 'present', 1),
(124, '1032232197', 'PBL', '2024-10-23', 2, 'present', 1),
(125, '1032232197', 'DBMS', '2024-10-23', 3, 'present', 1),
(126, '1032232197', 'FDS', '2024-10-23', 4, 'absent', 1),
(127, '1032232197', 'DBMS', '2024-10-24', 1, 'present', 1),
(128, '1032232197', 'PBL', '2024-10-24', 2, 'present', 1),
(129, '1032232197', 'FDS', '2024-10-24', 3, 'present', 1),
(130, '1032232197', 'DBMS', '2024-10-24', 4, 'present', 1),
(195, '1032232200', 'FDS', '2024-10-21', 1, 'present', 1),
(196, '1032232200', 'DBMS', '2024-10-21', 2, 'present', 1),
(197, '1032232200', 'PBL', '2024-10-21', 3, 'present', 1),
(198, '1032232200', 'FDS', '2024-10-21', 4, 'absent', 1),
(199, '1032232200', 'DBMS', '2024-10-22', 1, 'present', 1),
(200, '1032232200', 'PBL', '2024-10-22', 2, 'absent', 1),
(201, '1032232200', 'FDS', '2024-10-22', 3, 'present', 1),
(202, '1032232200', 'DBMS', '2024-10-22', 4, 'present', 1),
(203, '1032232200', 'PBL', '2024-10-23', 1, 'present', 1),
(204, '1032232200', 'FDS', '2024-10-23', 2, 'present', 1),
(205, '1032232200', 'DBMS', '2024-10-23', 3, 'present', 1),
(206, '1032232200', 'PBL', '2024-10-23', 4, 'present', 1),
(207, '1032232200', 'DBMS', '2024-10-24', 1, 'absent', 1),
(208, '1032232200', 'FDS', '2024-10-24', 2, 'present', 1),
(209, '1032232200', 'PBL', '2024-10-24', 3, 'present', 1),
(210, '1032232200', 'DBMS', '2024-10-24', 4, 'present', 1),
(211, '1032232198', 'PBL', '2024-10-21', 1, 'present', 1),
(212, '1032232198', 'FDS', '2024-10-21', 2, 'present', 1),
(213, '1032232198', 'DBMS', '2024-10-21', 3, 'absent', 1),
(214, '1032232198', 'PBL', '2024-10-21', 4, 'present', 1),
(215, '1032232198', 'FDS', '2024-10-22', 1, 'present', 1),
(216, '1032232198', 'DBMS', '2024-10-22', 2, 'present', 1),
(217, '1032232198', 'PBL', '2024-10-22', 3, 'present', 1),
(218, '1032232198', 'FDS', '2024-10-22', 4, 'present', 1),
(219, '1032232198', 'DBMS', '2024-10-23', 1, 'absent', 1),
(220, '1032232198', 'PBL', '2024-10-23', 2, 'present', 1),
(221, '1032232198', 'FDS', '2024-10-23', 3, 'present', 1),
(222, '1032232198', 'DBMS', '2024-10-23', 4, 'absent', 1),
(223, '1032232198', 'PBL', '2024-10-24', 1, 'present', 1),
(224, '1032232198', 'FDS', '2024-10-24', 2, 'present', 1),
(225, '1032232198', 'DBMS', '2024-10-24', 3, 'present', 1),
(226, '1032232198', 'PBL', '2024-10-24', 4, 'present', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `prn` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`prn`, `name`, `roll_no`, `year`, `course`, `password`) VALUES
('1032232197', 'Krishna Khandelwal', '42', 2, 'B.Tech. CSE', 'whoamI@42'),
('1032232198', 'Dvit Gohil', '55', 2, 'B.Tech. CSE', 'pass123'),
('1032232200', 'Parth Tupe', '32', 2, 'B.Tech. CSE', 'pass789'),
('1032232229', 'Ayush Kadali', '54', 2, 'B.Tech. CSE', 'test123');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_code` varchar(10) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `has_theory` tinyint(1) DEFAULT 1,
  `has_practical` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `subject_name`, `year`, `course`, `has_theory`, `has_practical`) VALUES
('DBMS', 'Database Management Systems', 2, 'B.Tech. CSE', 1, 1),
('FDS', 'Fundamentals of Data Structure', 2, 'B.Tech. CSE', 1, 1),
('PBL', 'Project Based Learning', 2, 'B.Tech. CSE', 0, 1);

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`prn`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

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
