-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2024 at 07:22 AM
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
-- Database: `library_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `token_expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `fullname`, `gmail`, `password`, `status`, `type`, `number`, `address`, `profile_picture`, `reset_token`, `token_expiry`) VALUES
(13, 'Ejie Florida', 'ejieflorida128@gmail.com', '12345', 'Confirmed', 'User', '096482736419', 'Pinaskohan, Maasin City, Southern Leyte', '../profile_pictures/2024-10-28 12_27_24-.png', '3ddd4ff1736414788ce37f6c7f13dc3c2e6a63f5f23527977681008e786a46e678d955c8b5700328ae35467325c0ce20d30a', '2024-11-01 07:01:56'),
(15, 'Angelica Trigo', 'Angelica123@gmail.com', '123', 'Confirmed', 'User', '', '', '../profile_pictures/default.avif', '', '0000-00-00 00:00:00'),
(16, 'Staff Number 2', 'admin2@gmail.com', '123', 'Confirmed', 'Admin', '09172467367', 'Pinaskohan, Maasin City , Southern Leyte', '../profile_pictures/default.avif', '', '0000-00-00 00:00:00'),
(17, 'Staff Number 1', 'admin1@gmail.com', '123', 'Confirmed', 'Admin', '09347564831', 'Pinaskohan, Maasin City, Southern Leyte', '../profile_pictures/IMG20230327180230.jpg', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `story_pdf` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `remain` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `download` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `admin_id`, `story_pdf`, `stock`, `remain`, `book_title`, `uploaded_by`, `download`) VALUES
(1, 16, '../storage/HIDE-AND-SEEK.pdf', 23, 23, 'Hide and Seek', 16, 1),
(2, 16, '../storage/ABE-THE-SERVICE-DOG.pdf', 24, 24, 'Abe the Service Dog', 16, 0),
(3, 16, '../storage/GINGER-THE-GIRAFFE.pdf', 31, 30, 'Ginger the Giraffe', 16, 0),
(4, 16, '../storage/006-TOOTH-FAIRY-Free-Childrens-Book-By-Monkey-Pen.pdf', 0, 0, 'Tooth Fairy', 16, 0),
(5, 17, '../storage/005-SUNNY-MEADOWS-WOODLAND-SCHOOL-Free-Childrens-Book-By-Monkey-Pen (1).pdf', 24, 23, 'Sunny Meadow', 17, 0),
(6, 17, '../storage/003-DOING_MY_CHORES-Free-Childrens-Book-By-Monkey-Pen.pdf', 34, 34, 'Doing my Chores', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lend_books`
--

CREATE TABLE `lend_books` (
  `lend_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `story_pdf` varchar(255) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lend_books`
--

INSERT INTO `lend_books` (`lend_id`, `book_id`, `user_id`, `admin_id`, `story_pdf`, `book_title`, `uploaded_by`, `date`) VALUES
(3, 3, 13, 16, '../storage/GINGER-THE-GIRAFFE.pdf', 'Ginger the Giraffe', 16, '2024-11-01 03:34:23'),
(4, 5, 15, 17, '../storage/005-SUNNY-MEADOWS-WOODLAND-SCHOOL-Free-Childrens-Book-By-Monkey-Pen (1).pdf', 'Sunny Meadow', 17, '2024-11-01 03:34:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lend_books`
--
ALTER TABLE `lend_books`
  ADD PRIMARY KEY (`lend_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lend_books`
--
ALTER TABLE `lend_books`
  MODIFY `lend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
