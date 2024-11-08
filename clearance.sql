-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 12:10 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `clearance_id` int(11) NOT NULL,
  `req_user` varchar(100) NOT NULL,
  `re_date` varchar(100) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `dean_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `dean_not` int(11) NOT NULL DEFAULT 1,
  `exam_assessor_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `exam_assessor_not` int(11) NOT NULL DEFAULT 1,
  `finance_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `finance_not` int(11) NOT NULL DEFAULT 1,
  `librarian_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `librarian_not` int(11) NOT NULL DEFAULT 1,
  `registrar_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `registrar_not` int(11) NOT NULL DEFAULT 1,
  `rcs_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `rcs_not` int(11) NOT NULL DEFAULT 1,
  `vice_dean_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `vice_dean_not` int(11) NOT NULL DEFAULT 1,
  `dep_head_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `dep_head_not` int(11) NOT NULL DEFAULT 1,
  `student_dean_app` varchar(30) NOT NULL DEFAULT 'Pending...',
  `student_dean_not` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`clearance_id`, `req_user`, `re_date`, `reason`, `dean_app`, `dean_not`, `exam_assessor_app`, `exam_assessor_not`, `finance_app`, `finance_not`, `librarian_app`, `librarian_not`, `registrar_app`, `registrar_not`, `rcs_app`, `rcs_not`, `vice_dean_app`, `vice_dean_not`, `dep_head_app`, `dep_head_not`, `student_dean_app`, `student_dean_not`) VALUES
(2, 'C1/003/08', '2023-05-23', 'Graduation', 'Rejected', 0, 'Approved', 0, 'Approved', 0, 'Approved', 0, 'Approved', 0, 'Pending...', 0, 'Approved', 0, 'Approved', 0, 'Approved', 0),
(3, 'C1/003/08', '2023-05-23', 'Graduation', 'Pending...', 0, 'Approved', 0, 'Approved', 0, 'Approved', 0, 'Approved', 0, 'Pending...', 0, 'Approved', 0, 'Approved', 0, 'Approved', 0),
(5, 'C1/003/08', '2023-06-23', 'Graduation', 'Pending...', 1, 'Pending...', 1, 'Pending...', 1, 'Pending...', 1, 'Pending...', 1, 'Pending...', 1, 'Pending...', 1, 'Approved', 0, 'Approved', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `username`, `comment`) VALUES
(1, 'patient', 'Nice System'),
(2, 'patient', 'I think you have got nice system.'),
(3, 'hiwot', 'nice system'),
(4, 'patient', 'I think you have done well.'),
(5, 'rediet', 'It seems good');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `fname`, `lname`, `email`, `phone`, `message`) VALUES
(1, 'Ephrem', 'Amanuel', 'ephaaman123@gmail.com', '0978654511', 'Nice System'),
(2, 'Aschenaki', 'Abebe', 'asch@gmail.com', '0987654323', 'Hi'),
(3, 'Aschenaki', 'Abebe', 'berhanutigabu2@gmail.com', '0922904587', 'fhgjhkl;');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL,
  `department` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `department`) VALUES
(1, 'Computer Science'),
(2, 'Information Technology'),
(3, 'Management'),
(4, 'Accounting and Finance'),
(5, 'Masters of Accounting and Finance'),
(6, 'Masers of Business Administration  '),
(7, 'Masters of Project Management'),
(8, 'Masters of Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `position` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`fname`, `mname`, `lname`, `address`, `phone`, `email`, `position`) VALUES
('Ephrem', 'Amanuel', 'Ayde', 'Mirab Abaya', '0964074945', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `modality`
--

CREATE TABLE `modality` (
  `modality_id` int(11) NOT NULL,
  `modality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modality`
--

INSERT INTO `modality` (`modality_id`, `modality`) VALUES
(1, 'Extesion'),
(2, 'Regular'),
(3, 'Weekend');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program`) VALUES
(1, 'Undergraduate'),
(2, 'Postgraduate '),
(3, 'Level');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `modality` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `entry` varchar(20) NOT NULL,
  `program` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `fname`, `mname`, `lname`, `sex`, `age`, `modality`, `department`, `entry`, `program`, `user_name`, `status`) VALUES
('C1/003/08', 'Sisay', 'Seifu', 'Ade', 'Male', 28, 2, 1, '2011', 1, 'C1/003/08', 'Active'),
('FHA-C1/002/08', 'Habtamu', 'Endrias', 'Kurfe', 'Male', 30, 2, 1, '2014', 1, 'FHA-C1/002/08', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(40) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Active',
  `edited` varchar(5) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`, `status`, `edited`) VALUES
('alex', 'dc06698f0e2e75751545455899adccc3', 'dean', 'Active', 'NO'),
('asfe', 'dc06698f0e2e75751545455899adccc3', 'research and community', 'Active', 'NO'),
('C1/003/08', '84fb3cfd2b84344b7be3a5ad53de9a84', 'student', 'Active', 'NO'),
('chaltu', 'dc06698f0e2e75751545455899adccc3', 'finance', 'Active', 'NO'),
('fasil', 'dc06698f0e2e75751545455899adccc3', 'student dean', 'Active', 'NO'),
('FHA-C1/002/08', 'dc06698f0e2e75751545455899adccc3', 'student', 'Active', 'NO'),
('habte', '2ff62b3c11a14bf5ec0790b82c11de8d', 'department head', 'Active', 'NO'),
('kama', 'dc06698f0e2e75751545455899adccc3', 'librarian', 'Active', 'NO'),
('meron', 'dc06698f0e2e75751545455899adccc3', 'registrar', 'Active', 'NO'),
('mesfin', 'dc06698f0e2e75751545455899adccc3', 'exam assessor', 'Active', 'NO'),
('tile', 'dc06698f0e2e75751545455899adccc3', 'academic vice dean', 'Active', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(30) NOT NULL,
  `department` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fname`, `mname`, `lname`, `age`, `sex`, `address`, `phone`, `role`, `department`, `status`) VALUES
('alex', 'dc06698f0e2e75751545455899adccc3', 'Alemayehu', 'Kassa', 'Kate', 34, 'Male', 'Arba Minch', '0911654512', 'dean', 0, 'Active'),
('asfe', 'dc06698f0e2e75751545455899adccc3', 'Asferachew', 'Kasahun', 'Kassa', 32, 'Male', 'Arba Minch', '0978654533', 'research and community', 0, 'Active'),
('chaltu', 'dc06698f0e2e75751545455899adccc3', 'Chaltu', 'Chala', 'Kebede', 27, 'Female', 'Arba Minch', '0999654512', 'finance', 0, 'Active'),
('fasil', 'dc06698f0e2e75751545455899adccc3', 'Fasil', 'Ketema', 'Kanko', 32, 'Male', 'Arba Minch', '0911994477', 'student dean', 0, 'Active'),
('habte', 'dc06698f0e2e75751545455899adccc3', 'Habtamu', 'Daniel', 'Dacha', 29, 'Male', 'Arba Minch', '0945904587', 'department head', 1, 'Active'),
('kama', 'dc06698f0e2e75751545455899adccc3', 'Kama', 'Kalo', 'Ketema', 34, 'Male', 'Arba Minch', '0978654528', 'librarian', 0, 'Active'),
('meron', 'dc06698f0e2e75751545455899adccc3', 'Meron', 'Nekere', 'Mengesha', 27, 'Female', 'Arba Minch', '0978054510', 'registrar', 0, 'Active'),
('mesfin', 'dc06698f0e2e75751545455899adccc3', 'Mesfin', 'Gute', 'Goche', 28, 'Male', 'Arba Minch', '0966654520', 'exam assessor', 0, 'Active'),
('tile', 'dc06698f0e2e75751545455899adccc3', 'Tilahun', 'Kebede', 'Teshome', 36, 'Male', 'Arba Minch', '0978654566', 'academic vice dean', 0, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`clearance_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `modality`
--
ALTER TABLE `modality`
  ADD PRIMARY KEY (`modality_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `clearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modality`
--
ALTER TABLE `modality`
  MODIFY `modality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
