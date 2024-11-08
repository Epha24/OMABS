-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2021 at 02:45 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `messege` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`fname`, `lname`, `email`, `phone`, `messege`) VALUES
('Ephrem', 'Ayde', 'ephaaman@gmail.com', '0964074945', 'Nice System');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `img` varchar(300) NOT NULL,
  `speciality` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `fname`, `mname`, `lname`, `address`, `phone`, `email`, `position`, `img`, `speciality`) VALUES
('e001', 'Ephrem', 'Amanuel', 'Asha', 'Arba Minch', '0964074946', 'ephaaman@gmail.com', 'staff', '', ''),
('e005', 'Kinde', 'Belachew', 'Adugna', 'Hawassa', '0911223456', 'kinde@gmail.com', 'doctor', 'WIN_20210214_10_19_55_Pro.jpg', 'Dentist'),
('e002', 'Mintesinot', 'Mokonnen', 'Bekele', 'Arba Minch', '0964074948', 'minte2@gmail.com', 'admin', '', ''),
('e004', 'Roman', 'Amanuel', 'Ayde', 'Hawassa', '0910223456', 'romi@gmail.com', 'doctor', 'WIN_20210214_10_19_55_Pro.jpg', 'Brain Surgeon '),
('e003', 'Teshome', 'Toga', 'Tale', 'Addis Ababa', '0987654321', 'teshe@gmail.com', 'doctor', '', 'Skin');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `chat_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `file` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `message` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `mname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `age` int(20) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `mstatus` varchar(13) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `fname`, `mname`, `lname`, `age`, `gender`, `mstatus`, `phone`, `email`, `address`) VALUES
(3, 'Ephrem', 'Amanuel', 'Ayde', 25, 'male', 'single', '0964074988', 'bati@gmail.com', 'Arba Minch'),
(4, 'MIntsinot', 'Mekonnen', 'Kaleb', 27, 'male', 'single', '0939808482', 'dotnetminte@gmail.com', 'Arba Minch'),
(5, 'Tejitu', 'Lema', 'Koira', 26, 'male', 'single', '0987654300', 'tejitu@gmail.com', 'Arba Minch');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`, `status`) VALUES
('bati@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'patient', 'Inactive'),
('dotnetminte@gmail.com', 'd92f144b1e788c196ac80428cd153c6a', 'patient', 'Active'),
('ephaaman@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'staff', 'Active'),
('meski@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'patient', 'Active'),
('minte2@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'admin', 'Active'),
('romi@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'doctor', 'Active'),
('tejitu@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'patient', 'Active'),
('teshe@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'doctor', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
