-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2020 at 10:35 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `publication` int(11) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `owner`, `publication`, `body`, `date`) VALUES
(11, 6, 9, 'Hello there', '2020-11-20 07:34:45'),
(12, 1, 9, 'i want to comment in my friends publication, is this possible?', '2020-11-20 07:39:26'),
(13, 1, 10, 'testing', '2020-11-20 07:42:01'),
(14, 1, 10, 'i want to add a second comment', '2020-11-20 07:42:50'),
(15, 1, 11, 'pls admin, go a comment here!', '2020-11-20 07:43:28'),
(16, 6, 11, 'i dont know', '2020-11-20 09:13:07'),
(17, 6, 12, 'i want to write a comment here!', '2020-11-20 09:15:53'),
(18, 7, 12, 'this is my latest comment, with this, i finish this project', '2020-11-20 09:19:42'),
(19, 7, 11, 'yes, i think puppies are great too!', '2020-11-20 09:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `userOne` int(11) NOT NULL,
  `userTwo` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `userOne`, `userTwo`, `status`) VALUES
(1, 6, 1, 1),
(2, 1, 6, 1),
(3, 8, 6, 1),
(4, 6, 8, 1),
(6, 6, 7, 1),
(7, 7, 6, 1),
(8, 7, 1, 1),
(9, 1, 7, 1),
(10, 7, 8, 1),
(11, 8, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `owner`, `title`, `body`, `date`) VALUES
(9, 6, 'This is my first publication, haha', 'i want to teach you something', '2020-11-20 07:34:38'),
(10, 6, 'This is a Second publication', 'Lets see how it goes', '2020-11-20 07:35:07'),
(11, 1, 'i want to make a publication about puppies', 'yes, puppies are great!', '2020-11-20 07:43:15'),
(12, 7, 'this is my first publication', 'yes, hello everyone!', '2020-11-20 07:45:35'),
(13, 7, 'This is my latest publication', 'yes, it is', '2020-11-20 09:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', 'test'),
(6, 'admin', '123', 'admin', 'admin', 'Test@mail.com', '555'),
(7, 'user3', '123', 'Patracio', 'Maquiavelo', 'pm@mail.com', '8095556565'),
(8, 'papotico', 'papotico', 'Papolo', 'Comercial', 'test@w.com', '809-555-6565');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentOwner` (`owner`),
  ADD KEY `publication` (`publication`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userOne` (`userOne`),
  ADD KEY `userTwo` (`userTwo`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `commentOwner` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publication` FOREIGN KEY (`publication`) REFERENCES `publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `userOne` FOREIGN KEY (`userOne`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `userTwo` FOREIGN KEY (`userTwo`) REFERENCES `user` (`id`);

--
-- Constraints for table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `owner` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
