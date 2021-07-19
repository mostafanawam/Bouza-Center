-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 09:24 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hadaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`id`, `username`, `password`) VALUES
(1, 'nawam10', 'nawam10');

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `name`) VALUES
(70, 'Icepop'),
(65, 'Icecream'),
(95, 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `flavor` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `Date`, `name`, `phone`, `email`, `type`, `flavor`, `quantity`, `cost`) VALUES
(64, '2020-09-28 11:20:23', 'dsad', 5454, 'mostaf@djdjd.com', 'Drink', 'softdrink', 23, 0),
(65, '2020-09-28 11:22:04', 'dcfs', 545, 'mostaf@djdjd.com', 'Drink', 'softdrink', 4, 0),
(63, '2020-09-28 11:14:55', 'dss', 5454, 'mostaf@djdjd.com', 'Drink', 'softdrink', 2, 0),
(62, '2020-09-28 11:09:24', 'fdsfsf', 54, 'vcvcx@fdsfs', 'Drink', 'Vanilla', 45, 0),
(61, '2020-09-28 11:09:04', 'fds', 545, 'mostaf@djdjd.com', 'Test', 'Mango', 12, 0),
(60, '2020-09-28 11:08:51', 'dsda', 54, 'mdmd@sakdka', 'Test', 'Vanilla', 54, 0),
(59, '2020-09-28 11:07:54', 'dsada', 544, 'mostaf@djdjd.com', 'Test', 'Vanilla', 54, 0),
(57, '2020-09-23 22:45:33', 'xzzc', 54, 'mostaf@djdjd.com', 'Drink', 'Mocca', 4, 0),
(98, '2020-10-02 21:59:31', 'mostafa', 5565, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 25, 50),
(97, '2020-10-02 21:59:18', 'mostafa', 5565, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 25, 50),
(92, '2020-09-28 14:37:01', 'samir', 123, 'mostaf@djdjd.com', 'Icecream', 'Oreo', 2, 10),
(93, '2020-10-01 00:30:50', 'mostafa', 8160265, 'mostaf@djdjd.com', 'Drink', 'mocca', 2, 8),
(94, '2020-10-02 21:35:04', 'mostafa', 5565, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 25, 50),
(95, '2020-10-02 21:36:45', 'mostafa', 5565, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 25, 50),
(96, '2020-10-02 21:58:53', 'mostafa', 5565, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 25, 50),
(100, '2020-10-06 01:46:53', 'sadda', 32321, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 2, 4),
(99, '2020-10-06 01:46:28', 'sadda', 32321, 'mostaf@djdjd.com', 'Icepop', 'Chocolate', 2, 4),
(91, '2020-09-28 14:29:14', 'samir', 123, 'mostaf@djdjd.com', 'Icecream', 'Oreo', 2, 10),
(90, '2020-09-28 13:05:56', 'ddffs', 45545, 'saarara@dffd', 'Drink', 'Mocca', 4, 16),
(89, '2020-09-28 12:47:26', 'sad', 55, 'dds@sd', 'Drink', 'Chocolate', 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `username`, `password`) VALUES
(1, 'mostafa15', 'mostafa15');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `rank` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `type`, `description`, `rank`, `price`, `photo`) VALUES
(164, 'Icepop', 'Chocolate', 1, 2, 'ice1.jpg'),
(154, 'Icecream', 'Vanilla', 2, 4, 'italian2.jpg'),
(160, 'Icecream', 'Oreo', 2, 5, 'italian1.jpg'),
(161, 'Icecream', 'Mango', 2, 3, 'italian3.jpg'),
(162, 'Icepop', 'Strawberry', 1, 1, 'bg3.jpg'),
(163, 'Icepop', 'Pistachio', 1, 2, 'ice3.jpg'),
(173, 'Drink', 'Hot Chocolate', 0, 3, 'drink2.jpg'),
(172, 'Drink', 'SoftDrinks', 0, 2, 'drink3.jpg'),
(171, 'Drink', 'Mocca', 0, 3, 'drink1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
