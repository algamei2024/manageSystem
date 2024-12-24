-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24 ديسمبر 2024 الساعة 21:28
-- إصدار الخادم: 10.4.24-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangesystem`
--

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `use_id` int(11) NOT NULL,
  `use_name` text NOT NULL,
  `use_email` text NOT NULL,
  `use_password` text NOT NULL,
  `use_created_at` datetime NOT NULL,
  `use_updated_at` datetime NOT NULL,
  `use_admin` tinyint(1) DEFAULT 0,
  `use_token` longtext DEFAULT NULL,
  `use_verified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`use_id`, `use_name`, `use_email`, `use_password`, `use_created_at`, `use_updated_at`, `use_admin`, `use_token`, `use_verified`) VALUES
(53, 'mohammed', 'm.jl89768ll@gmail.com', 'jjjjjjjj', '2024-12-24 23:28:08', '2024-12-24 23:28:08', 0, '9fded726368743b54921ebaf12c9d0ea', '2024-12-24 23:28:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
