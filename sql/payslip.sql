-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2013 at 10:36 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `payslip`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'company unique id',
  `name` varchar(200) NOT NULL COMMENT 'company name',
  `address` varchar(300) NOT NULL COMMENT 'company address',
  `landline` int(11) NOT NULL COMMENT 'company landline number',
  `mobile` int(10) NOT NULL COMMENT 'company mobile number',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'flag for whether the company is deleted or not',
  `created_at` datetime NOT NULL COMMENT 'created time',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'modified time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Company details' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `landline`, `mobile`, `is_deleted`, `created_at`, `modified_at`) VALUES
(1, 'ABC Company', 'Coimbatore', 222456, 1234567890, 0, '2013-03-28 00:00:00', '2013-03-27 18:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `constants`
--

CREATE TABLE IF NOT EXISTS `constants` (
  `constant` varchar(100) NOT NULL COMMENT 'constants',
  `value` int(11) NOT NULL COMMENT 'values for respective constant',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'deleted flag',
  `created_at` datetime NOT NULL COMMENT 'created time',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'modified time'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='constants used in the applications';

--
-- Dumping data for table `constants`
--

INSERT INTO `constants` (`constant`, `value`, `is_deleted`, `created_at`, `modified_at`) VALUES
('DA', 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('PF', 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ESI', 140, 0, '2013-03-30 00:00:00', '2013-03-30 18:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'designation unique id',
  `company_id` int(2) NOT NULL COMMENT 'company unique id',
  `name` varchar(100) NOT NULL COMMENT 'designation name',
  `basic_pay` int(11) NOT NULL COMMENT 'basic pay for respective designation',
  `hra` int(11) NOT NULL COMMENT 'house rent allowance',
  `conveyance` int(11) NOT NULL COMMENT 'conveyance',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'flag for whether designation is deleted or not',
  `created_at` datetime NOT NULL COMMENT 'created time',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'modified time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Designation details' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `company_id`, `name`, `basic_pay`, `hra`, `conveyance`, `is_deleted`, `created_at`, `modified_at`) VALUES
(1, 1, 'Manager', 10000, 2500, 600, 0, '2013-03-28 00:00:00', '2013-03-27 19:00:06'),
(2, 1, 'Employee', 6000, 1500, 300, 0, '2013-03-28 00:00:00', '2013-03-27 19:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `company_id` int(2) NOT NULL COMMENT 'company unique id',
  `first_name` varchar(70) NOT NULL COMMENT 'first name',
  `last_name` varchar(70) NOT NULL COMMENT 'last name',
  `address` varchar(300) NOT NULL COMMENT 'employee''s address',
  `email` varchar(100) NOT NULL COMMENT 'employee''s email id ',
  `password` varchar(200) NOT NULL COMMENT 'login password',
  `designation_id` int(2) NOT NULL COMMENT 'designation id',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'flag for whether employee is deleted or not',
  `created_at` datetime NOT NULL COMMENT 'created date',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'modified date',
  PRIMARY KEY (`id`,`designation_id`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Employee details' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `company_id`, `first_name`, `last_name`, `address`, `email`, `password`, `designation_id`, `is_deleted`, `created_at`, `modified_at`) VALUES
(1, 1, 'employee1', 'employee1', 'coimbatore', 'abc@mail.com', '10adc3949ba59abbe56e057f20f883e', 1, 0, '2013-03-28 00:00:00', '2013-03-27 19:21:31'),
(2, 1, 'Employee2', 'employee2', 'Tiruppur', 'xyz@mail.com', '4a6629303c679cfa6a5a81433743e52c', 2, 0, '2013-03-28 00:00:00', '2013-03-27 19:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'salary unique id',
  `company_id` int(2) NOT NULL COMMENT 'company unique id',
  `employee_id` int(4) NOT NULL COMMENT 'employee unique id',
  `designation_id` int(2) NOT NULL COMMENT 'designation unique id',
  `date` date NOT NULL COMMENT 'date of salary',
  `net` int(11) NOT NULL COMMENT 'net',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'flag for whether employee salary record is deleted or not',
  `create_at` datetime NOT NULL COMMENT 'created time',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'modified time',
  PRIMARY KEY (`id`,`employee_id`,`designation_id`),
  KEY `employee_id` (`employee_id`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Salary details' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `company_id`, `employee_id`, `designation_id`, `date`, `net`, `is_deleted`, `create_at`, `modified_at`) VALUES
(1, 1, 1, 1, '2013-03-31', 8000, 0, '2013-03-28 00:00:00', '2013-03-27 19:26:01'),
(2, 1, 2, 2, '2013-03-31', 6000, 0, '2013-03-28 00:00:00', '2013-03-27 19:27:28');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`id`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `salary_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `employee` (`designation_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
