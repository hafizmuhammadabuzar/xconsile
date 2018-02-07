-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2018 at 08:54 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xconsile_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `date` char(10) NOT NULL,
  `location` varchar(255) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `title`, `code`, `date`, `location`, `amount`, `image`, `user_id`, `created_at`) VALUES
(1, 'Jade cafe tea s', '38392', '13/4/2017', 'Lahore fsd', '100', '5a604ec9b83c9.jpg', 1, '2018-01-26 09:55:52'),
(2, 'coffee', '2728G', '11/12/2014', 'lahore', '100', '5a604ec9b83c9.jpg', 1, '2018-01-30 11:07:43'),
(3, 'zhdjjs', 'dhhs8', '14/10/2017', 'Lahore ', '500', '5a604ec9b83c9.jpg', 1, '2018-01-30 14:05:24'),
(4, 'test', '578u999', '13/10/2017', 'rahim yar khan', '50', '5a604ec9b83c9.jpg', 1, '2018-01-30 15:13:34'),
(5, 'new', '58874', '10/10/2017', 'tesyh huhgt yuhvf ykjv ', '500', '5a604ec9b83c9.jpg', 1, '2018-01-30 15:14:46'),
(7, 'dhdjej', 'dhdieh', '14/9/2017', 'shsiow', '100', '5a604ec9b83c9.jpg', 1, '2018-01-30 16:16:32'),
(10, 'dheoev diev 3', 'du3hd88', '13/10/2017', 'xhehec7s die diEbdie s', '650', '5a604ec9b83c9.jpg', 1, '2018-01-30 16:22:25'),
(11, 'updated', '6282828', '14/3/2014', 'lagsue die. disiskso ', '100', '5a604ec9b83c9.jpg', 1, '2018-01-31 10:11:25'),
(13, 'newwwww', '3838383', '14/8/2017', 'xhdidiie', '800', '5a604ec9b83c9.jpg', 1, '2018-01-31 12:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` char(7) NOT NULL,
  `dob` char(10) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `dob`, `remember_token`, `status`, `created_at`) VALUES
(1, 'hma', 'hma@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '1995-03-02', 'cb7ca56ab211d647a2b976b2c480f09b', 1, '2018-02-06 06:58:30'),
(2, 'test2', 'test@mail.com', '00fd4b4549a1094aae926ef62e9dbd3cdcc2e456', 'Male', '1990-12-10', 'effeef7fd50ab7c01b355dd09acaf762', 1, '2018-02-06 12:37:53'),
(6, 'qwe', 'root@amsd', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', '1', '2018-02-02', '1ad42fa50e74c645e913e241b87de5b8', 0, '2018-02-06 06:49:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
