-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 02:17 PM
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
-- Database: `inoutkvp`
--

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `tarikh_keluar` date NOT NULL,
  `waktu_keluar` varchar(200) NOT NULL,
  `tujuan` varchar(225) NOT NULL,
  `tt1` varchar(200) NOT NULL,
  `tarikh_masuk` date NOT NULL,
  `waktu_masuk` varchar(200) NOT NULL,
  `tt2` varchar(200) NOT NULL,
  `catatan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`tarikh_keluar`, `waktu_keluar`, `tujuan`, `tt1`, `tarikh_masuk`, `waktu_masuk`, `tt2`, `catatan`) VALUES
('2026-05-22', '12.33 tgh', 'Pulang ke Kampung', '', '2026-06-07', '4.00 ptg', '', ''),
('2026-05-26', '17:14', 'Sakit', '', '2026-05-31', '16:14', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pwd`) VALUES
('user_92b6a060', 'Faris', '$2y$10$GA6bLw1p6fBNodWBLMg5SOKe/UkTSaz71WJpBF8pY7AikH8nJ3TQe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
