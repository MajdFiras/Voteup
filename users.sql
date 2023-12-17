-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 09:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `poll_id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `s_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`poll_id`, `creator_id`, `question`, `options`, `end_date`, `s_date`, `status`) VALUES
(51, 33, 'male or female', 'male, female', '2023-12-26 20:06:00', '2023-12-17 17:07:40', 1),
(52, 33, 'orange or apple or banana?', 'orange, apple, banana', '2023-12-28 20:09:00', '2023-12-17 20:19:37', 1),
(53, 33, 'ahmed or khalid ?', 'ahmed, khalid', '2023-12-28 20:13:00', '2023-12-17 20:19:38', 1),
(54, 33, 'math or physics', 'math, physics', '2023-12-26 22:59:00', '2023-12-17 20:19:38', 1),
(55, 33, 'school or university', 'school, university', '2024-01-04 22:59:00', '2023-12-17 20:19:39', 1),
(56, 33, 'yussif or khalid', 'yussif, khalid', '2023-12-27 23:00:00', '2023-12-17 20:19:39', 1),
(57, 33, 'whatsapp or twitter', 'whatsupp, twitter', '2024-01-04 23:00:00', '2023-12-17 20:19:40', 1),
(58, 33, 'Computer Science or Computer Eng', 'CS, CE', '2024-01-04 23:01:00', '2023-12-17 20:19:40', 1),
(59, 33, 'instagram or telegram?', 'Instagram, telegram', '2023-12-20 23:02:00', '2023-12-17 20:19:40', 1),
(60, 33, 'phone or computer', 'phone, computer', '2023-12-26 23:03:00', '2023-12-17 20:19:41', 1),
(61, 33, 'pc or playstation?', 'pc, ps', '2024-01-04 23:04:00', '2023-12-17 20:19:41', 1),
(62, 33, 'which type of food do you like ? ', 'sea food, fast food', '2024-01-05 23:04:00', '2023-12-17 20:19:44', 1),
(63, 33, 'cat or dogs ?', 'cats , dogs', '2023-12-29 23:06:00', '2023-12-17 20:19:45', 1),
(64, 33, 'winter or summer?', 'winter , summer', '2023-12-26 23:07:00', '2023-12-17 20:33:52', 1),
(65, 33, 'Barcelona or Real Madrid ? ', 'Barcelona , Real Madrid', '2023-12-27 23:10:00', '2023-12-17 20:33:53', 1),
(66, 33, 'Coffee or Tea?', 'coffee , tea ', '2023-12-21 23:15:00', '2023-12-17 20:33:55', 1),
(67, 33, 'Pizza or Burgers?', 'Pizza , Burgers', '2023-12-27 23:15:00', '2023-12-17 20:33:56', 1),
(68, 33, 'Books or Movies?', 'Books , Movies', '2023-12-29 23:16:00', '2023-12-17 20:33:57', 1),
(69, 33, 'Android or iOS?', 'Android, iOS', '2023-12-20 23:16:00', '2023-12-17 20:33:57', 1),
(70, 33, 'Beach vacation or Mountain retreat?', 'Beach vacation , Mountain retreat', '2023-12-27 23:17:00', '2023-12-17 20:33:58', 1),
(71, 33, 'Netflix or Hulu?', 'Netflix , Hulu', '2024-02-27 23:17:00', '2023-12-17 20:33:58', 1),
(72, 33, 'Morning person or Night owl?', 'Morning person , Night owl', '2024-07-11 23:18:00', '2023-12-17 20:33:59', 1),
(73, 33, 'Sweet or Savory snacks?', 'Sweet snacks, Savory snacks', '2024-04-25 23:19:00', '2023-12-17 20:34:00', 1),
(74, 33, 'City life or Countryside living?', 'City life, Countryside living', '2024-05-30 23:20:00', '2023-12-17 20:21:01', 0),
(75, 33, 'Adventure travel or Relaxing spa retreat?', 'Adventure travel ,  Relaxing spa retreat?', '2024-01-05 23:21:00', '2023-12-17 20:21:17', 0),
(76, 33, 'Guitar or Piano?', 'Guitar, Piano', '2024-03-20 23:21:00', '2023-12-17 20:21:52', 0),
(77, 33, 'Marvel or DC?', 'Marvel , DC', '2024-03-06 23:23:00', '2023-12-17 20:23:18', 0),
(78, 33, 'Ebook or Paperback?', 'Ebook , Paperback', '2024-03-13 23:23:00', '2023-12-17 20:23:34', 0),
(79, 33, 'Sushi or Tacos?', 'Sushi , Tacos', '2024-05-02 23:23:00', '2023-12-17 20:24:02', 0),
(80, 33, 'Football or Soccer?', 'Football , Soccer', '2024-04-18 23:24:00', '2023-12-17 20:24:38', 0),
(81, 33, 'Sunrise or Sunset?', 'Sunrise , Sunset', '2024-04-24 23:24:00', '2023-12-17 20:24:55', 0),
(82, 33, 'Classical art or Modern art?', 'Classical , Modern art', '2024-04-18 23:25:00', '2023-12-17 20:25:22', 0),
(83, 33, 'Twitter or Instagram?', 'Twitter , Instagram', '2024-04-17 23:25:00', '2023-12-17 20:25:38', 0),
(84, 33, 'Morning run or Evening workout?', 'Morning run, Evening workout', '2024-02-28 23:25:00', '2023-12-17 20:26:02', 0),
(85, 33, 'Fiction or Non-fiction?', 'Fiction , Non-fiction', '2024-01-04 23:26:00', '2023-12-17 20:26:15', 0),
(86, 33, 'Museum visit or Concert attendance?', 'Museum visit, Concert attendance', '2024-03-14 23:26:00', '2023-12-17 20:26:39', 0),
(87, 33, 'Road trip or Flight for travel?', 'Road trip , Flight for travel', '2024-02-28 23:27:00', '2023-12-17 20:27:06', 0),
(88, 33, 'Black and white or Color photography?', 'Black and white, Color photography', '2023-12-28 23:27:00', '2023-12-17 20:27:31', 0),
(89, 33, 'Spicy or Mild food?', 'Spicy , Mild food', '2024-03-20 23:27:00', '2023-12-17 20:27:47', 0),
(90, 33, 'Car or Motorcycle?', 'Car , Motorcycle', '2024-03-07 23:28:00', '2023-12-17 20:28:04', 0),
(91, 33, 'Online shopping or In-store shopping?', 'Online shopping , In-store shopping', '2024-02-29 23:28:00', '2023-12-17 20:28:27', 0),
(92, 33, 'Desktop or Laptop?', 'Desktop, Laptop', '2024-01-24 23:28:00', '2023-12-17 20:28:39', 0),
(93, 33, 'Comedy or Drama movies?', 'Comedy , Drama movies', '2024-04-18 23:29:00', '2023-12-17 20:29:11', 0),
(94, 33, 'Star Wars or Star Trek?', 'Star Wars, Star Trek', '2024-03-07 23:29:00', '2023-12-17 20:29:39', 0),
(95, 33, 'Winter sports or Summer sports?', 'Winter sports , Summer sports', '2024-03-14 23:29:00', '2023-12-17 20:29:56', 0),
(96, 33, 'Camping or Glamping?', 'Camping , Glamping', '2024-02-28 23:31:00', '2023-12-17 20:31:28', 0),
(97, 33, 'Marvelous Marvel or Daring DC superheroes?', 'Marvelous Marvel , Daring DC superheroes', '2024-03-13 23:31:00', '2023-12-17 20:31:47', 0),
(98, 33, 'Sunset picnic or Candlelit dinner?', 'Sunset picnic , Candlelit dinner', '2024-04-05 23:32:00', '2023-12-17 20:32:07', 0),
(99, 33, 'Apple or Android for smartphones?', 'Apple , Android ', '2024-04-11 23:32:00', '2023-12-17 20:32:30', 0),
(100, 33, 'Country music or Hip-hop?', 'Country music , Hip-hop', '2024-01-18 23:32:00', '2023-12-17 20:32:49', 0),
(101, 33, 'Spontaneous adventure or Well-planned itinerary?', 'Spontaneous adventure , Well-planned itinerary', '2024-03-06 23:33:00', '2023-12-17 20:33:06', 0),
(102, 33, 'Video games or Board games?', 'Video games, Board games', '2024-02-16 23:33:00', '2023-12-17 20:33:22', 0),
(103, 33, 'Cooking at home or Dining out?', 'home , Dining out', '2024-01-31 23:33:00', '2023-12-17 20:33:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `fname`, `lname`, `email`, `password`) VALUES
(32, 'majd', 'firas', 'm@gmail.com', '$2y$10$/3l13Z.ZY3iUELxXbXMm0.Gi4B1VlrkF5TLzOq5ucM7X0FMDuGzRa'),
(33, 'kalid', 'firas', 'majd@a.com', '$2y$10$W6ulHm9j315YmFRbaMHUruAi/GgkELY6KypT1ZdhhuLhn0FY0qfQG');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `choice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `poll_id`, `u_id`, `choice`) VALUES
(48, 51, 33, 'male'),
(49, 52, 33, ' banana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `poll_id` (`poll_id`,`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
