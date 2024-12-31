-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2021 at 07:48 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jasa_cuci`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_layanan`
--

CREATE TABLE `tbl_layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(30) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_layanan`
--

INSERT INTO `tbl_layanan` (`id_layanan`, `nama_layanan`, `biaya`) VALUES
(1, 'Cuci Motor', 25000),
(2, 'Cuci Mobil', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `plat_nomor_kendaraan` varchar(15) NOT NULL,
  `layanan` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tanggal`, `nama_pelanggan`, `plat_nomor_kendaraan`, `layanan`, `total_biaya`) VALUES
('TR-00001', '2021-08-01', 'Danang', 'BE 4442 YY', 1, 25000),
('TR-00002', '2021-08-01', 'Anindira', 'BE 1122 AA', 2, 50000),
('TR-00003', '2021-08-02', 'Dina', 'BE 3344 AB', 2, 50000),
('TR-00004', '2021-08-03', 'Hana', 'BE 2233 BC', 1, 25000),
('TR-00005', '2021-08-04', 'Indra', 'BE 4455 YY', 2, 50000),
('TR-00006', '2021-08-04', 'Agung', 'BE 4242 AA', 1, 25000),
('TR-00007', '2021-08-05', 'Adreena', 'BE 7788 AY', 1, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `hak_akses`) VALUES
(1, 'Indra Styawantoro', 'admin', '$2y$12$yZIQYIdRIvuE.nYxk4NiEusbisucKFVVxcEqj3NyZwtn/cfZbVrYK', 'Admin'),
(2, 'Danang Kesuma', 'user', '$2y$12$ijSZtM72yER7tUMWFLCgQuDb7.kI6wGQwf.i5npIwWMvVgfqYLFhC', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
