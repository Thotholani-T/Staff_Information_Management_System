-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 12:45 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `street_address` varchar(50) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `street_address`, `postal_code`, `city`) VALUES
(1111, 'Unza', 10101, 'Lusaka');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` varchar(50) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
('CMP', 'Computer Science'),
('HMR', 'Human Resource');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone` varchar(50) NOT NULL,
  `home_address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT 'password',
  `join_date` date NOT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `dept_id` varchar(50) NOT NULL,
  `project_no` int(11) DEFAULT NULL,
  `leave_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `first_name`, `last_name`, `date_of_birth`, `phone`, `home_address`, `email`, `password`, `join_date`, `gender`, `job_id`, `branch_id`, `dept_id`, `project_no`, `leave_id`) VALUES
(2000, 'Thotholani', 'Tembo', '2011-01-01', '0976350781', 'Home', 'thotholani.tembo@cs.unza.zm', 'password', '2021-10-01', 'M', 'ADMIN', 1111, 'CMP', 101210, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(50) NOT NULL,
  `job_description` varchar(50) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_description`, `salary`, `bonus`) VALUES
('ADMIN', 'Administrator', '1000.00', '0.00'),
('PROGM', 'Programmer', '750.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_tb`
--

CREATE TABLE `leave_tb` (
  `leave_id` int(11) NOT NULL,
  `leave_description` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('available','away') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_no` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_budget` decimal(10,2) NOT NULL,
  `date_comissioned` date NOT NULL,
  `expected_completion_date` date NOT NULL,
  `dept_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_no`, `project_name`, `project_budget`, `date_comissioned`, `expected_completion_date`, `dept_id`) VALUES
(101210, 'Databases Group Project', '1000.00', '2021-06-01', '2021-12-01', 'CMP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `project_no` (`project_no`),
  ADD KEY `leave_id` (`leave_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `leave_tb`
--
ALTER TABLE `leave_tb`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_no`),
  ADD KEY `dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2001;

--
-- AUTO_INCREMENT for table `leave_tb`
--
ALTER TABLE `leave_tb`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101211;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`project_no`) REFERENCES `project` (`project_no`),
  ADD CONSTRAINT `employee_ibfk_5` FOREIGN KEY (`leave_id`) REFERENCES `leave_tb` (`leave_id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;