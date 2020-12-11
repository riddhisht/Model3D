-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 09:41 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ar`
--

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `drive` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`, `code`, `image`, `price`, `drive`) VALUES
(1, 'Harry', 'ch1', 'images/Harry.png', 2500.00, 'https://drive.google.com/drive/folders/1_ugnBfopY90XHT7FtiujJlxfUSCQomhd?usp=sharing'),
(2, 'Michael', 'ch2', 'images/Michael.png', 2500.00, 'https://drive.google.com/drive/folders/1ZNfUaXoJejWeP7vCy80tgAaXPtWTCKqY?usp=sharing'),
(3, 'Jim', 'ch3', 'images/Jim.png', 2000.00, 'https://drive.google.com/drive/folders/1ypTMw-6ei5DsgsLN-F9hvmCLeqYG49zw?usp=sharing'),
(4, 'Dwight', 'ch4', 'images/Dwight.png', 2000.00, 'https://drive.google.com/drive/folders/1qKfTK-dLN6QctCUqPhXZUwIt6Htiep-o?usp=sharing'),
(5, 'Logan', 'qr5', 'images/Logan.png', 1500.00, 'https://drive.google.com/drive/folders/1vLvxiisXVBryRSg01F6Jm1hXurPD3Y32?usp=sharing'),
(6, 'Will', 'qr6', 'images/Will.png', 1500.00, 'https://drive.google.com/drive/folders/16R-LpJ49TJk5sk3JQbW1gH3paHU6wLzm?usp=sharing'),
(7, 'Minion', 'qr7', 'images/Minion.png', 2000.00, 'https://drive.google.com/drive/folders/1MU1E4NPEMC1pzlm0cRx8l2woVI9i0rCR?usp=sharing'),
(8, 'Olaf', 'qr8', 'images/Olaf.png', 2000.00, 'https://drive.google.com/drive/folders/1IvZt1__E8APVDMRHucpNjWNAre3GhTLt?usp=sharing'),
(9, 'AmongUs', 'qr9', 'images/AmongUs.png', 1500.00, 'https://drive.google.com/drive/folders/13nalCLRY4uxoSFozkYgxYQNcAJVIg2i3?usp=sharing'),
(10, 'Pikachu', 'qr1', 'images/Pikachu.png', 2000.00, 'https://drive.google.com/drive/folders/1ab_4tyt-aE5nY9G5w1lP5b2wkqs7632N?usp=sharing'),
(11, 'Simpson', 'qr2', 'images/Simpson.png', 2500.00, 'https://drive.google.com/drive/folders/1EaVafh8qm_JIxQuFldxCCvDjm_DJx-s3?usp=sharing'),
(12, 'Baymax', 'aq1', 'images/Baymax.png', 2000.00, 'https://drive.google.com/drive/folders/1Vrwi6RoVFzD8mF5cWvtx8Txc2GB5QN4y?usp=sharing'),
(13, 'Fall Guy', 'aq2', 'images/Fall Guy.png', 1500.00, 'https://drive.google.com/folderview?id=1rZVNGD-UNRvEbjQqN_pPG8priSukh19h'),
(14, 'Make Joke Of', 'aq3', 'images/Make Joke Of.png', 2000.00, ' https://drive.google.com/folderview?id=1orjVTAGYAZTTyWlN2cN5pROuMTvf0GHW'),
(15, 'Android', 'aq4', 'images/Android.png', 1500.00, 'https://drive.google.com/folderview?id=1VnudC-UUKEaYcjywqUdUQeiEGXyk360n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
