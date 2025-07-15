-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 04:36 AM
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
-- Database: `pine_expert_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `lingkar_batang` float DEFAULT NULL,
  `tinggi` float DEFAULT NULL,
  `jenis_prediksi` varchar(50) DEFAULT NULL,
  `nilai_cf` float DEFAULT NULL,
  `nilai_knn` varchar(255) DEFAULT NULL,
  `vision_result` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `tanggal`, `lingkar_batang`, `tinggi`, `jenis_prediksi`, `nilai_cf`, `nilai_knn`, `vision_result`) VALUES
(1, '2025-07-13 22:56:30', 0.3, 10.2, 'Douglas Fir', 1, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(2, '2025-07-13 22:59:47', 0.3, 10.2, 'Douglas Fir', 1, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(3, '2025-07-13 23:31:45', 0.3, 10.2, 'Douglas Fir', 0, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(4, '2025-07-13 23:41:50', 0.3, 10.2, 'Douglas Fir', 0.878333, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(5, '2025-07-13 23:46:16', 0.3, 10.2, 'Douglas Fir', 0.9856, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(6, '2025-07-13 23:46:34', 0.3, 10.2, 'Douglas Fir', 0.9856, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(7, '2025-07-13 23:58:41', 0.3, 10.2, 'Douglas Fir', 0.9856, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(8, '2025-07-14 00:19:02', 0.3, 0.5, 'White Pine', 1, 'White Pine, White Pine, White Pine', NULL),
(9, '2025-07-14 00:21:36', 0.7, 15.5, 'Douglas Fir', 1, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(10, '2025-07-14 00:29:13', 0.45, 10.5, 'Douglas Fir', 1, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(11, '2025-07-14 00:29:41', 0.3, 10.2, 'Douglas Fir', 0.878333, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL),
(12, '2025-07-14 10:55:37', 0.3, 10.2, 'Douglas Fir', 0.878333, 'Douglas Fir, Douglas Fir, Douglas Fir', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_data`
--

CREATE TABLE `training_data` (
  `id` int(11) NOT NULL,
  `lingkar_batang` float DEFAULT NULL,
  `tinggi` float DEFAULT NULL,
  `jenis_pinus` varchar(50) DEFAULT NULL,
  `cf_lingkar` decimal(5,2) DEFAULT NULL,
  `cf_tinggi` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_data`
--

INSERT INTO `training_data` (`id`, `lingkar_batang`, `tinggi`, `jenis_pinus`, `cf_lingkar`, `cf_tinggi`) VALUES
(22, 0.3, 10.2, 'Douglas Fir', 0.85, 0.90),
(23, 0.28, 9.8, 'Douglas Fir', 0.83, 0.88),
(24, 0.32, 10.5, 'Douglas Fir', 0.87, 0.91),
(25, 0.34, 11, 'Douglas Fir', 0.89, 0.92),
(26, 0.33, 10.7, 'Douglas Fir', 0.86, 0.90),
(27, 0.29, 9.5, 'Douglas Fir', 0.82, 0.87),
(28, 0.31, 10.3, 'Douglas Fir', 0.85, 0.89),
(29, 0.35, 11.2, 'Douglas Fir', 0.90, 0.93),
(30, 0.36, 11.4, 'Douglas Fir', 0.91, 0.94),
(31, 0.27, 9.2, 'Douglas Fir', 0.81, 0.86),
(32, 0.24, 8.7, 'White Pine', 0.79, 0.85),
(33, 0.26, 9, 'White Pine', 0.81, 0.87),
(34, 0.25, 8.8, 'White Pine', 0.80, 0.86),
(35, 0.27, 9.3, 'White Pine', 0.82, 0.88),
(36, 0.23, 8.5, 'White Pine', 0.78, 0.84),
(37, 0.22, 8.3, 'White Pine', 0.77, 0.83),
(38, 0.21, 8.1, 'White Pine', 0.76, 0.82),
(39, 0.2, 8, 'White Pine', 0.75, 0.81),
(40, 0.19, 7.8, 'White Pine', 0.74, 0.80),
(41, 0.18, 7.5, 'White Pine', 0.73, 0.79),
(42, 0.17, 7.3, 'White Pine', 0.72, 0.78);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_data`
--
ALTER TABLE `training_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `training_data`
--
ALTER TABLE `training_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
