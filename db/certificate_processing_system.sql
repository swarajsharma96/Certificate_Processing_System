-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 04:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certificate_processing_system`
--
CREATE DATABASE IF NOT EXISTS `certificate_processing_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `certificate_processing_system`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `apply_id` int(20) NOT NULL,
  `discount` text COLLATE utf8_unicode_ci,
  `clearance` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `apply_id` int(20) NOT NULL,
  `register_status` int(2) NOT NULL DEFAULT '0',
  `ec_status` int(2) NOT NULL DEFAULT '-1',
  `dept_status` int(2) NOT NULL DEFAULT '-1',
  `account_status` int(2) NOT NULL DEFAULT '-1',
  `lib_status` int(2) NOT NULL DEFAULT '-1',
  `ged_status` int(2) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `student_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `apply_date` date NOT NULL,
  `apply_id` int(20) NOT NULL,
  `progress` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(12) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_credit` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_details`
--

CREATE TABLE `credit_details` (
  `apply_id` int(20) NOT NULL,
  `total_credit` text COLLATE utf8_unicode_ci NOT NULL,
  `earned_credit` text COLLATE utf8_unicode_ci NOT NULL,
  `credit_waiver` text COLLATE utf8_unicode_ci,
  `result` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `student_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `ssc_certificate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hsc_certificate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `honours_certificate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certificate_fee` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nid` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ssc_transcript` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hsc_transcript` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bsc_transcript` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ged`
--

CREATE TABLE `ged` (
  `apply_id` int(20) NOT NULL,
  `ged_clearance` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `apply_id` int(20) NOT NULL,
  `clearance` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_thesis`
--

CREATE TABLE `project_thesis` (
  `student_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `project_thesis_name` text COLLATE utf8_unicode_ci NOT NULL,
  `supervisor_name` text COLLATE utf8_unicode_ci NOT NULL,
  `designation` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `apply_id` int(20) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `dept` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `student_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(12) NOT NULL,
  `year_start` date NOT NULL,
  `year_end` date NOT NULL,
  `profile_picture` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(12) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login_as` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `apply_id` (`apply_id`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD UNIQUE KEY `apply_id` (`apply_id`);

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`apply_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `credit_details`
--
ALTER TABLE `credit_details`
  ADD UNIQUE KEY `apply_id` (`apply_id`),
  ADD KEY `apply_id_2` (`apply_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `ged`
--
ALTER TABLE `ged`
  ADD UNIQUE KEY `apply_id` (`apply_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD UNIQUE KEY `apply_id` (`apply_id`);

--
-- Indexes for table `project_thesis`
--
ALTER TABLE `project_thesis`
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD UNIQUE KEY `apply_id` (`apply_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `apply_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`apply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`apply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_details`
--
ALTER TABLE `credit_details`
  ADD CONSTRAINT `credit_details_ibfk_1` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`apply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ged`
--
ALTER TABLE `ged`
  ADD CONSTRAINT `ged_ibfk_1` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`apply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `library`
--
ALTER TABLE `library`
  ADD CONSTRAINT `library_ibfk_1` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`apply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_thesis`
--
ALTER TABLE `project_thesis`
  ADD CONSTRAINT `project_thesis_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remarks`
--
ALTER TABLE `remarks`
  ADD CONSTRAINT `remarks_ibfk_1` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`apply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
