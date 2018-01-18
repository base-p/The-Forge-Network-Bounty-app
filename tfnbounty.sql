-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2018 at 09:57 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfnbounty`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `share_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_on` datetime NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_post_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `earned` float NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `share_id`, `posted_on`, `message`, `user_post_id`, `earned`, `created`, `modified`) VALUES
(9, 1, '1707024525987532', '2018-01-18 20:51:56', 'Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum Lorem emposeum', '1694882967201688_1707024529320865', 26.24, '2018-01-18 21:52:00', '2018-01-18 21:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_share` datetime DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype_id`, `name`, `email`, `username`, `password`, `last_share`, `address`, `created`, `modified`) VALUES
(1, 2, 'Obumneke Princewill Okorie', NULL, '1694882967201688', '$2a$10$t7FP5vcXoHey9zBBosVXQ.8ybcPaEJfw7TGtCiz/40DqhuisLBDM.', '2018-01-18 21:52:00', '0x343756a75f2bd17339bac6abdf4ac05f9e5c86c0', '2018-01-14 22:29:45', '2018-01-14 22:29:45'),
(2, 1, 'Forgenet Admin', 'forgenet@tutamail.com', 'forgenet', '$2a$10$qYNYI6a.FEkmFm8YkFh3EeOYIS072rp12DPtwkSKbap7FvebQnNmK', NULL, NULL, '2018-01-16 08:27:42', '2018-01-16 08:27:42'),
(3, 2, 'Okorie Okechukwu Pascal', NULL, '1503633193069346', '$2a$10$PyMadPRcsJN8nBBl5807L.E.yN.Fw.wDBYCiaoLwGK4Qc1/xLS37S', NULL, NULL, '2018-01-16 10:52:12', '2018-01-16 10:52:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
