-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2018 at 12:03 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cruddashboard`
--
CREATE DATABASE IF NOT EXISTS `cruddashboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cruddashboard`;

-- --------------------------------------------------------

--
-- Table structure for table `orang`
--

DROP TABLE IF EXISTS `orang`;
CREATE TABLE `orang` (
  `id` int(4) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orang`
--

INSERT INTO `orang` (`id`, `nama`, `kelas`, `alamat`) VALUES
(11, 'Muhammad Yusup', 'X-RPL', 'Jl. Komp. Zeni TNI AD, Rt.02/007, Kel. Tengah, Kramat Jati, Jakarta Timur. Kode pos : 13540'),
(12, 'Dede Rohimah', '?', 'Kel. Pabuaran, Bojong Gede, Bogor, Jawa Barat.'),
(13, 'Wawan Darmawan', '?', 'Kel. Pabuaran, Bojong Gede, Bogor, Jawa Barat.'),
(14, 'Ahmad Sidiq', '?', 'Djakarta'),
(15, 'Tita Aulia Khofifah', '?', 'Kel. Pabuaran, Bojong Gede, Bogor, Jawa Barat.'),
(17, 'imadGG bersabda', 'x-rpl', 'Djonggol'),
(18, 'Muhammad Alif Zhorif Arachdin', 'X-RPL', 'Foremost Jl Komp polri RT09/08 No.2'),
(19, 'silun', '?', '?'),
(20, 'Lexi 125', 'X-RPL', 'Djakarta'),
(21, 'repcata', '.tk', 'entah'),
(22, 'kesegaran alam', '?', '?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orang`
--
ALTER TABLE `orang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orang`
--
ALTER TABLE `orang`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
