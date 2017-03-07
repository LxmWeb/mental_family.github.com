-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 08:38 PM
-- Server version: 5.7.13-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mental_family`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` varchar(11) NOT NULL,
  `doctor_name` varchar(16) NOT NULL,
  `sex` char(2) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `identity` varchar(18) NOT NULL,
  `education` varchar(30) DEFAULT NULL,
  `working_place` int(11) NOT NULL,
  `department` varchar(20) DEFAULT NULL,
  `treatment` varchar(24) NOT NULL,
  `positional_title` varchar(20) DEFAULT NULL,
  `head_image` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_name`, `sex`, `birthday`, `identity`, `education`, `working_place`, `department`, `treatment`, `positional_title`, `head_image`, `email`) VALUES
('17816869761', '医生姓名', '男', '1978-09-09', '331111197809090000', '', 1, '', '忧郁症', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  `brief_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `hospital_name`, `address`, `phone_number`, `brief_info`) VALUES
(1, '杭州医院', '杭州西溪路123号', '124322321', '一个很好的医院');

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `patient_id` varchar(5) NOT NULL,
  `test_time` date NOT NULL,
  `test_title` varchar(50) NOT NULL,
  `test_score` int(11) DEFAULT NULL,
  `test_result` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` varchar(11) NOT NULL,
  `patient_name` varchar(16) NOT NULL,
  `sex` char(2) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `identity` varchar(18) NOT NULL,
  `main_suit` varchar(100) DEFAULT NULL,
  `head_image` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `sex`, `birthday`, `identity`, `main_suit`, `head_image`, `email`) VALUES
('17816869781', '病人姓名', '男', '1978-09-09', '331111197809090000', '心情低落，感觉被世界抛弃', 'img01.png', '12323423@qq.com');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `patient_id` varchar(5) NOT NULL,
  `doctor_id` varchar(5) NOT NULL,
  `build_time` date NOT NULL,
  `is_valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(11) NOT NULL,
  `user_password` varchar(16) NOT NULL,
  `user_name` varchar(7) NOT NULL,
  `user_status` int(11) NOT NULL,
  `uniqid` varchar(40) DEFAULT NULL,
  `register_time` date DEFAULT NULL,
  `last_login_time` date DEFAULT NULL,
  `last_login_ip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_password`, `user_name`, `user_status`, `uniqid`, `register_time`, `last_login_time`, `last_login_ip`) VALUES
('17816869761', '123456', '医生', 2, '', '2017-03-06', '2017-03-06', '127.0.0.1'),
('17816869781', '123456', '病人', 1, '', '2017-03-06', '2017-03-06', '127.0.0.1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `working_place` (`working_place`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`working_place`) REFERENCES `hospital` (`hospital_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
