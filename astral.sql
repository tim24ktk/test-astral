-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2022 at 07:09 AM
-- Server version: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astral`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `code`, `description`) VALUES
(1, 'R46.1', 'Причудливый внешний вид'),
(3, 'F32.2', 'Странная прическа'),
(6, 'A12.1', 'Красивые глаза');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_birth` date NOT NULL,
  `date_death` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `patronymic`, `gender`, `date_birth`, `date_death`) VALUES
(1, 'Ivanov', 'Ivan', 'Ivanovich', 'M', '1985-02-05', NULL),
(4, 'Petrov', 'Petr', 'Petrovich', 'M', '1987-04-18', NULL),
(5, 'Lizova', 'Elizaveta', 'Ivanovna', 'Ж', '1985-02-05', NULL),
(6, 'Ffff', 'Ffff', 'Ffff', 'M', '1985-02-05', NULL),
(7, 'Aaaa', 'Aaaa', 'Aaaa', 'F', '2000-01-01', NULL),
(8, 'Sssss', 'Sssss', 'Sssss', 'F', '2000-01-01', NULL),
(9, 'Gggggg', 'Gggggg', 'Ggggg', 'M', '1987-04-18', NULL),
(10, 'Ddddd', 'Ddddd', 'Dddddd', 'F', '2000-01-01', NULL),
(11, 'Qqqqq', 'Qqqqq', 'Qqqqq', 'M', '1987-04-18', NULL),
(12, 'Ggggg', 'Ggggg', 'Ggggg', 'F', '2000-01-01', NULL),
(13, 'Rrrrr', 'Rrrrrr', 'Rrrr', 'M', '1987-04-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_diagnoses`
--

CREATE TABLE `users_diagnoses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_diagnose` int(11) DEFAULT NULL,
  `date_opening` date NOT NULL,
  `date_closing` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_diagnoses`
--

INSERT INTO `users_diagnoses` (`id`, `user_id`, `user_diagnose`, `date_opening`, `date_closing`) VALUES
(3, 4, 3, '2019-01-01', NULL),
(5, 5, 6, '2019-01-01', NULL),
(14, 1, 1, '2019-01-01', '2022-04-12'),
(15, 4, 1, '2019-01-01', '2022-04-12'),
(16, 5, 6, '2019-01-01', NULL),
(17, 7, 1, '2019-01-01', '2022-04-12'),
(18, 8, 6, '2019-01-01', NULL),
(19, 9, 1, '2019-01-01', '2022-04-12'),
(20, 10, 6, '2019-01-01', NULL),
(22, 12, 6, '2019-01-01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_diagnoses`
--
ALTER TABLE `users_diagnoses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users_diagnoses`
--
ALTER TABLE `users_diagnoses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
