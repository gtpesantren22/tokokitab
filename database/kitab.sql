-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2023 at 01:52 PM
-- Server version: 10.5.17-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u9048253_kitab`
--

-- --------------------------------------------------------

--
-- Table structure for table `kitab`
--

CREATE TABLE `kitab` (
  `id_kitab` int(11) NOT NULL,
  `kd_kitab` varchar(25) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_kolak` decimal(20,0) NOT NULL,
  `harga_jual` decimal(20,0) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitab`
--

INSERT INTO `kitab` (`id_kitab`, `kd_kitab`, `kategori`, `nama`, `stok`, `harga_kolak`, `harga_jual`, `gambar`) VALUES
(1, 'KTB-892359', 'MDL2826106786', 'Al Arobiyah Jilid 1', 7, '17500', '19000', ''),
(2, 'KTB-147999', 'MDL2826106786', 'AL AROBIYAH JILID 2', 5, '17500', '19000', ''),
(3, 'KTB-729861', 'MDL2826106786', 'Al Arobiyah Jilid 3', 72, '17500', '19000', ''),
(4, 'KTB-431480', 'MDL2826106786', 'Al Arobiyah Jilid 4', 19, '17500', '19000', ''),
(5, 'KTB-157500', 'MDL2826106786', 'Al Arobiyah Jilid 5', 19, '17500', '19000', ''),
(6, 'KTB-804188', 'MDL2826106786', 'Al Arobiyah jilid 6', 1, '17500', '19000', ''),
(8, 'KTB-53532', 'MDL2826106786', 'Qiroatur Rosyidah 2', 0, '6000', '7000', ''),
(10, 'KTB-102383', 'MDL2826106786', 'Nahwul Wadhi jilid 1 MI', 11, '5000', '9000', ''),
(11, 'KTB-555874', 'MDL2826106786', 'Nahwul Wadhih JIlid 2 MI', 20, '7000', '9000', ''),
(12, 'KTB-621200', 'MDL2826106786', 'Nahwul Wadhih Jilid 3 MI', 9, '7000', '9000', ''),
(13, 'KTB-761487', 'MDL2826106786', 'Nahwul Wadhi jilid 1 MTs', 17, '7500', '10000', ''),
(14, 'KTB-869256', 'MDL2826106786', 'Nahwul Wadhih Jilid 2 MTs', 52, '8500', '11000', ''),
(15, 'KTB-650546', 'MDL2826106786', 'Nahwul Wadhi jilid 3MTs', 12, '9000', '11000', ''),
(16, 'KTB-834354', 'MDL2826106786', 'Adabul Alim Wal Mutaalim', 13, '15000', '16000', ''),
(17, 'KTB-655577', 'MDL2826106786', 'takmilah az zubdah ', 29, '14000', '30000', ''),
(18, 'KTB-840907', 'MDL2826106786', 'Husnus Siyaghoh', 6, '25000', '27000', ''),
(19, 'KTB-435875', 'MDL2826106786', 'Fathul Muin', 5, '23000', '27000', ''),
(20, 'KTB-308799', 'MDL2826106786', 'Fathul Qorib', 19, '6500', '8000', ''),
(21, 'KTB-37007', 'MDL2826106786', 'Jurmiyah ', 28, '4000', '6000', ''),
(22, 'KTB-313341', 'MDL2826106786', 'Nadhom Imriti', 25, '2500', '3000', ''),
(23, 'KTB-126948', 'MDL2826106786', 'Nadhom Alfiyah', 15, '3500', '5000', ''),
(24, 'KTB-621814', 'MDL2826106786', 'Kifayatul Awam', 15, '8000', '9000', ''),
(25, 'KTB-882660', 'MDL2826106786', 'Muhawaroh Jus 1', 3, '11500', '13000', ''),
(26, 'KTB-282832', 'MDL2826106786', 'Muhawaroh Jus 2', 10, '17000', '19000', ''),
(27, 'KTB-195023', 'MDL2826106786', 'Faidul Khobir', 10, '17500', '19000', ''),
(28, 'KTB-20524', 'MDL2826106786', 'Kholasoh Jus 2', 14, '8000', '11000', ''),
(29, 'KTB-326776', 'MDL2826106786', 'Mabadiul Fiqhiyah', 121, '3500', '5000', ''),
(30, 'KTB-7690', 'MDL2826106786', 'Aqidatul Awam ', 16, '2500', '5000', ''),
(31, 'KTB-638100', 'MDL2826106786', 'Nubdatul Bayan Jilid 1', 16, '4000', '10000', ''),
(32, 'KTB-53119', 'MDL2826106786', 'Nubdatul Bayan Jilid 2', 166, '4000', '10000', ''),
(33, 'KTB-882000', 'MDL2826106786', 'Nubdatul Bayan Jilid 3', 328, '4000', '10000', ''),
(34, 'KTB-721657', 'MDL2826106786', 'Nubdatul Bayan Jilid 4', 302, '4000', '10000', ''),
(35, 'KTB-799188', 'MDL2826106786', 'Nubdatul Bayan Jilid 5', 236, '4000', '10000', ''),
(36, 'KTB-605792', 'MDL2826106786', 'Nubdatul Bayan Pasca', 256, '4000', '10000', ''),
(37, 'KTB-151072', 'MDL2826106786', 'Bulughul Marom', 25, '22500', '30000', ''),
(38, 'KTB-268553', 'MDL2826106786', 'Amsilatu Tasrif', 12, '5500', '7000', ''),
(39, 'KTB-770804', 'MDL2826106786', 'Kamus Luar Biasa', 111, '4500', '7000', ''),
(40, 'KTB-832311', 'MDL2826106786', 'ibnu Aqil ', 11, '24000', '26000', ''),
(41, 'KTB-718776', 'MDL2826106786', 'Kholasoh Jus 1', 149, '6500', '10000', ''),
(42, 'KTB-800253', 'MDL2826106786', 'Kholasoh Jus 3', 62, '6500', '10000', ''),
(43, 'KTB-916545', 'MDL2826106786', 'Tuhfatul Atfal', 18, '2500', '5000', ''),
(44, 'KTB-757774', 'MDL2826106786', 'Tilawati jilid 1', 20, '7200', '10000', ''),
(45, 'KTB-373899', 'MDL2826106786', 'Tilawati jilid 2', 15, '7200', '10000', ''),
(46, 'KTB-125811', 'MDL2826106786', 'Tilawati jilid 3', 10, '7200', '10000', ''),
(47, 'KTB-100466', 'MDL2826106786', 'Durrotun Nashin', 5, '25000', '27000', ''),
(48, 'KTB-559270', 'MDL2826106786', 'Kawakib ', 8, '29000', '32000', ''),
(49, 'KTB-558172', 'MDL2826106786', 'Mushtolahul Hadist', 27, '27000', '30000', ''),
(50, 'KTB-33058', 'MDL2826106786', 'Mabadiul Awwaliyah', 9, '8000', '10000', ''),
(51, 'KTB-635580', 'MDL2826106786', 'Minhajul Abidin', 18, '8500', '10000', ''),
(52, 'KTB-427174', 'MDL2826106786', 'Jawahirul Kalamiyah', 13, '5500', '6000', ''),
(53, 'KTB-812116', 'MDL2826106786', 'Tanqihul Qoul', 5, '6000', '7000', ''),
(54, 'KTB-911836', 'MDL2826106786', 'Taisurul Kholak', 10, '5500', '7000', ''),
(55, 'KTB-556965', 'MDL2826106786', 'Taklimul mutaalim', 13, '5000', '8000', ''),
(56, 'KTB-266239', 'MDL2826106786', 'Bidayatul hidayah', 12, '9000', '10000', ''),
(57, 'KTB-245947', 'MDL2826106786', 'Hidayatul Miustafid', 9, '5500', '7000', ''),
(58, 'KTB-62294', 'MDL2826106786', 'Al Adkar', 1, '33000', '35000', ''),
(59, 'KTB-122886', 'MDL2826106786', 'Tafsir Jalalain', 13, '37000', '40000', ''),
(60, 'KTB-997117', 'MDL2826106786', 'Kifayatul Akhyar', 9, '36000', '40000', ''),
(61, 'KTB-847827', 'MDL2826106786', 'Muktarul Hadist', 15, '23000', '25000', ''),
(62, 'KTB-309101', 'MDL2826106786', 'Nurud Dholam', 17, '5500', '8000', ''),
(63, 'KTB-262112', 'MDL2826106786', 'Nadom Nubdatul Bayan', 91, '4000', '10000', ''),
(64, 'KTB-577629', 'MDL1462753637', 'Kerudung Khas MTs', 0, '22000', '50000', ''),
(65, 'KTB-954171', 'MDL1462753637', 'Seragam Khas Mts ', 0, '31000', '50000', ''),
(66, 'KTB-26724', 'MDL1462753637', 'Seragam Atas SMP', 0, '31000', '50000', ''),
(67, 'KTB-288261', 'MDL1462753637', 'Badge Kelas MTS 2', 0, '1700', '5000', ''),
(68, 'KTB-461975', 'MDL1462753637', 'Badge Kelas MTS 3', 0, '1700', '5000', ''),
(69, 'KTB-865589', 'MDL1462753637', 'Badge Saku MTs', 0, '2500', '5000', ''),
(70, 'KTB-45955', 'MDL1462753637', 'Badge Kelas MTS 1', 0, '1700', '5000', ''),
(71, 'KTB-743534', 'MDL1462753637', 'Kain Seragam Pesantren pI', 0, '32000', '80000', ''),
(72, 'KTB-327507', 'MDL1462753637', 'Kain Seragam Pesantren pa', 0, '32000', '75000', ''),
(73, 'KTB-346098', 'MDL1462753637', 'Kaos Kaki', 0, '10000', '15000', ''),
(74, 'KTB-271973', 'MDL2826106786', 'Qiroatur Rosyidah 1', 0, '5500', '7000', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kitab`
--
ALTER TABLE `kitab`
  ADD PRIMARY KEY (`id_kitab`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kitab`
--
ALTER TABLE `kitab`
  MODIFY `id_kitab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
