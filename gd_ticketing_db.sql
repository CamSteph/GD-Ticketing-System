-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2022 at 12:05 PM
-- Server version: 5.7.37-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gd_ticketing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `category` varchar(75) NOT NULL,
  `msg_content` varchar(9000) NOT NULL,
  `unique_user_id` varchar(100) NOT NULL,
  `unique_ticket_id` varchar(250) NOT NULL,
  `last_edit_time` varchar(100) NOT NULL,
  `sender` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `category`, `msg_content`, `unique_user_id`, `unique_ticket_id`, `last_edit_time`, `sender`) VALUES
(107, 'malware', 'My website is redirecting to a pharmacy site. Please help!!\r\n\r\nThank you', '5688792312', '8073269809', '2022-04-24 15:51:46', 'Cameron2735'),
(108, 'reply_msg', 'Hi there,\r\n\r\nI\'ve got your ticket assigned and I am taking a look right now.\r\n\r\nI will keep you posted with any progress that I make.', '8159115853', '8073269809', '2022-04-24 15:51:57', 'Batman2735'),
(109, 'reply_msg', 'Hey there!\r\n\r\nIt looks like the supplied credentials aren\'t working on our end. We\'re currently receiving a \'incorrect username/password\' error.\r\n\r\nDo you mind kindly double-checking that information and getting back to us?\r\n\r\nThanks, talk to you soon! ðŸ˜Š', '8159115853', '8073269809', '2022-04-24 15:52:15', 'Batman2735'),
(110, 'reply_msg', 'My credentials are:\r\n\r\n-----------------------\r\nHost: 123.456.789.01\r\nFTP Username: gd-ticketng\r\nFTP Password: gdticketing123\r\nPort: 21\r\n-----------------------\r\n\r\nHopefully this can be resolved soon :)', '5688792312', '8073269809', '2022-04-24 15:53:33', 'Cameron2735'),
(111, 'reply_msg', 'Hi there,\r\n\r\nI\'ve got your ticket assigned and I am taking a look right now.\r\n\r\nI will keep you posted with any progress that I make.', '8159115853', '8073269809', '2022-04-24 15:53:59', 'Batman2735'),
(112, 'reply_msg', 'Thanks, I\'ll be waiting for your reply!', '5688792312', '8073269809', '2022-04-24 15:54:28', 'Cameron2735'),
(113, 'reply_msg', 'Hey there!\r\n                \r\nGreat news!! We\'ve just completed a malware cleanup on your website. Everything is looking clean now! Please follow these post-cleanup instructions to ensure yuor site is not reinfected: https://docs.sucuri.net/malware-removal/after-clean-up/steps-to-a-safe-and-clean-website/\r\n\r\nIf you have any further questions, please don\'t hesitate to reach back out to us. \r\n\r\nThank you very much!! ðŸ˜Š', '8159115853', '8073269809', '2022-04-24 16:03:03', 'Batman2735'),
(114, 'reply_msg', 'Great!! Thank you very much for your support :)', '5688792312', '8073269809', '2022-04-24 16:03:30', 'Cameron2735');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(30) NOT NULL,
  `unique_id_val` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `unique_id_val`) VALUES
(39, 'Batman2735', '$2y$10$yn424VXpQI.35Rus4Kb0.uS1rnZnDyJ1.4PtRfw0NvnoqFOF1lzTq', 'analyst', '8159115853'),
(47, 'Cameron2735', '$2y$10$bd2YUO3hzXWrxR2XktbG9urW74alyljfSYa25ukgORzt3tBw1Y5SK', 'customer', '5688792312');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
