-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 04:50 AM
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
-- Database: `clgevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(19, 'Ananya', 'chuni', '827ccb0eea8a706c4c34a16891f84e7b'),
(23, 'Ashis', 'asis', '9e1e06ec8e02f0a0074f2fcc6b26303b'),
(26, 'Roya', 'riya', '81dc9bdb52d04dc20036dbd8313ed055'),
(29, 'wert', 'ananya', '81dc9bdb52d04dc20036dbd8313ed055'),
(30, 'sur', 'ananya', '09e5cb531a1f732e541bb04f9b680249');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(23, 'Coding Club', 'Event_Club_817.jpg', 'Yes', 'Yes'),
(24, 'Nature Club', 'Event_Club_27.jpg', 'Yes', 'Yes'),
(25, 'Dance Club', 'Event_Club_83.jpg', 'Yes', 'Yes'),
(26, ' Fitness Club', 'Event_Club_969.jpg', 'Yes', 'Yes'),
(27, 'Literature club', 'Event_Club_818.jpg', 'Yes', 'Yes'),
(28, 'Art Club', 'Event_Club_854.jpg', 'Yes', 'Yes'),
(29, 'Photography Club', 'Event_Club_42.jpg', 'Yes', 'Yes'),
(30, 'Music Club', 'Event_Club_81.jpg', 'Yes', 'Yes'),
(32, 'Robotics Club', 'Event_Club_637.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `club` varchar(100) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `location`, `date`, `time`, `image_name`, `category_id`, `club`, `featured`, `active`) VALUES
(37, 'Code War ', 'Coding challenges and problem-solving workshop.', 20.00, '303 A lab', '2024-09-07', '10:30:00', 'Event_Name_732.jpg', 23, 'Coding Club', 'Yes', 'Yes'),
(38, 'Rangoli Competition', 'Colorful rangoli design competition.', 10.00, '303E room', '2024-11-29', '02:30:00', 'Event_Name_890.jpg', 28, 'Art Club', 'Yes', 'Yes'),
(39, 'Melody Showcase', 'Exciting music talent competition.', 50.00, 'Seminar hall', '2024-09-01', '07:30:00', 'Event_Name_552.jpg', 30, 'Music Club', 'Yes', 'Yes'),
(40, 'Robotics Workshop', 'Hands on robotics building workshop', 60.00, '507 roomno', '2024-09-27', '02:30:00', 'Event_Name_739.jpg', 32, 'Robotics Club', 'Yes', 'Yes'),
(41, 'Rhythm Revelations', 'Vibrant dance talent competition', 20.00, '507 roomno', '2024-09-13', '07:30:00', 'Event_Name_563.jpg', 25, 'Dance Club', 'Yes', 'Yes'),
(42, 'Harmony Nights', 'Dynamic musical talent showcase.', 10.00, 'Seminal hall', '2024-08-31', '10:30:00', 'Event_Name_799.jpg', 30, 'Music Club', 'Yes', 'Yes'),
(43, 'crypto Hunt', 'It is a coding challenge for you.', 30.00, '507 roomno', '2024-09-13', '00:00:12', 'Event_Name_271.png', 23, 'Coding Club', 'Yes', 'Yes'),
(44, 'Yoga Workshop', 'It is beneficial for your health.', 10.00, '402 roomno', '2024-08-22', '07:30:00', 'Event_Name_992.jpg', 26, 'Fitness Club', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `club` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `sem` int(11) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `stu_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `club`, `order_date`, `customer_name`, `stream`, `sem`, `customer_contact`, `customer_email`, `stu_code`) VALUES
(16, 'Code War ', 'Coding Club', '2024-07-25 05:06:12', 'Ram', 'EE', 6, '9331515415', 'acd.cal.in@gmail.com', 'NIT/2021/7895'),
(17, 'Rangoli Competition', 'Art Club', '2024-07-25 05:47:15', 'Manami Samanta', 'AIML', 4, '5673219087', 'sec.cal.in@gmail.com', 'NIT/2021/0316'),
(18, 'Melody Showcase', 'Music Club', '2024-07-25 05:48:15', 'Sanat Samanta', 'IT', 5, '4563219087', 'sanat.hiy.in@gmail.com', 'NIT/2021/0987'),
(19, 'Rhythm Revelations', 'Dance Club', '2024-07-25 05:50:53', 'Kalpana Maity', 'CSE', 7, '9785643216', 'kalpana.in@gmail.com', 'NIT/2021/0318'),
(20, 'Robotics Workshop', 'Robotics Club', '2024-07-25 05:51:51', 'Rupantara Sarkar', 'AIML', 5, '5673421907', 'abc.cal.in@gmail.com', 'NIT/2021/7895'),
(21, 'Code War ', 'Coding Club', '2024-07-25 06:52:27', 'Ahana Dutta', 'CSE', 6, '9876543210', 'ahana.in@gmail.com', 'NIT/2021/0987'),
(22, 'Code War ', 'Coding Club', '2024-07-25 06:56:07', 'Diya Roy', 'IT', 5, '6743210987', 'diya.cal.in@gmail.com', 'NIT/2021/0987');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
