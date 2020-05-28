-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 10:14 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trivia`
--
CREATE DATABASE IF NOT EXISTS `trivia`;
USE `trivia`;
--
-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(2) NOT NULL,
  `category` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Advertising'),
(2, 'Animals'),
(3, 'Art'),
(4, 'Business'),
(5, 'Geography'),
(6, 'History'),
(7, 'Literature'),
(8, 'Math'),
(9, 'Movies'),
(10, 'Music'),
(11, 'Politics'),
(12, 'Science'),
(13, 'Sports'),
(14, 'The 90s'),
(15, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `final_answers`
--

CREATE TABLE IF NOT EXISTS `final_answers` (
  `rank` int(1) NOT NULL,
  `description` text,
  `value` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_answers`
--

INSERT INTO `final_answers` (`rank`, `description`, `value`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `halftime_answers`
--

CREATE TABLE IF NOT EXISTS `halftime_answers` (
  `answers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `player_num` int(4) NOT NULL,
  `player_name` varchar(16) NOT NULL,
  `pts` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_num` int(2) NOT NULL,
  `round` int(11) NOT NULL,
  `category` int(2) DEFAULT NULL,
  `question` text,
  `answer` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `player_num` int(4) NOT NULL,
  `question1` int(1) DEFAULT NULL,
  `question2` int(1) DEFAULT NULL,
  `question3` int(1) DEFAULT NULL,
  `question4` int(1) DEFAULT NULL,
  `question5` int(1) DEFAULT NULL,
  `question6` int(1) DEFAULT NULL,
  `question7` int(1) DEFAULT NULL,
  `question8` int(1) DEFAULT NULL,
  `question9` int(1) DEFAULT NULL,
  `question10` int(1) DEFAULT NULL,
  `question11` int(1) DEFAULT NULL,
  `question12` int(1) DEFAULT NULL,
  `question13` int(1) DEFAULT NULL,
  `question14` int(1) DEFAULT NULL,
  `question15` int(1) DEFAULT NULL,
  `question16` int(1) DEFAULT NULL,
  `question17` int(1) DEFAULT NULL,
  `question18` int(1) DEFAULT NULL,
  `halftime` int(2) DEFAULT NULL,
  `final` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wagers`
--

CREATE TABLE IF NOT EXISTS `wagers` (
  `player_num` int(4) NOT NULL,
  `low_wager` int(1) DEFAULT NULL,
  `med_wager` int(1) DEFAULT NULL,
  `high_wager` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `final_answers`
--
ALTER TABLE `final_answers`
  ADD PRIMARY KEY (`rank`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_num`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_num`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`player_num`);

--
-- Indexes for table `wagers`
--
ALTER TABLE `wagers`
  ADD PRIMARY KEY (`player_num`),
  ADD KEY `player_num` (`player_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `final_answers`
--
ALTER TABLE `final_answers`
  MODIFY `rank` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_num` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_num` int(2) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`player_num`) REFERENCES `players` (`player_num`);

--
-- Constraints for table `wagers`
--
ALTER TABLE `wagers`
  ADD CONSTRAINT `wagers_ibfk_1` FOREIGN KEY (`player_num`) REFERENCES `players` (`player_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
