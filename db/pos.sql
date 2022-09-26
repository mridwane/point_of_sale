-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2021 at 03:02 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `kd_role` varchar(1) NOT NULL,
  `nama_akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`kd_role`, `nama_akses`) VALUES
('1', 'Admin'),
('2', 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(100) NOT NULL,
  `kd_kategori` varchar(100) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `stok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `kd_kategori`, `nama_barang`, `harga_jual`, `harga_beli`, `stok`) VALUES
('111', 'K-CRD8', 'Rexus A1', 320000, 280000, '5'),
('123', 'K-X15H', 'Monitor AOC 24', 2200000, 1900000, '5'),
('222', 'K-CRD8', 'Logitech K1', 490000, 450000, '19'),
('234', 'K-X15H', 'LG Monitor IPS 27', 3200000, 3000000, '11'),
('333', 'K-MCB6', 'Asus ROG KYTR 32', 16500000, 16000000, '18'),
('345', 'K-MNJB', 'Sandisk 64GB', 150000, 120000, '12'),
('444', 'K-MNJB', 'Sandisk 128GB', 320000, 300000, '15'),
('456', 'K-40JQ', 'Toshiba 500GB', 750000, 700000, '23'),
('555', 'K-R61D', 'Armagedon Nuke 11', 920000, 890000, '23'),
('567', 'K-MCB6', 'Lenovo IdeaPad 330', 4900000, 4500000, '10'),
('666', 'K-MCB6', 'Lenovo Legion ', 14000000, 13000000, '30'),
('678', 'K-40JQ', 'Samsung 1TB', 1500000, 1300000, '16');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kd_barang` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `update_stok` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`kd_barang`, `username`, `tanggal`, `update_stok`, `status`) VALUES
('111', 'mridwane', '2021-03-06', 20, 'Barang Baru'),
('123', 'mridwane', '2021-03-06', 10, 'Barang Baru'),
('222', 'mridwane', '2021-03-06', 30, 'Barang Baru'),
('234', 'mridwane', '2021-03-06', 20, 'Barang Baru'),
('333', 'mridwane', '2021-03-06', 20, 'Barang Baru'),
('345', 'mridwane', '2021-03-06', 20, 'Barang Baru'),
('444', 'mridwane', '2021-03-06', 20, 'Barang Baru'),
('333', 'mridwane', '2021-03-06', 20, 'Ditambahkan'),
('456', 'mridwane', '2021-03-06', 30, 'Barang Baru'),
('555', 'mridwane', '2021-03-06', 30, 'Barang Baru'),
('567', 'mridwane', '2021-03-06', 15, 'Barang Baru'),
('666', 'mridwane', '2021-03-06', 30, 'Barang Baru'),
('678', 'mridwane', '2021-03-06', 20, 'Barang Baru'),
('123', 'mridwane', '2021-03-06', 5, 'Ditambahkan');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `TG_STOKTAMBAH_BARANG` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
 UPDATE barang SET stok=stok+NEW.update_stok 
 WHERE kd_barang=NEW.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `kd_transaksi` varchar(100) NOT NULL,
  `kd_barang` varchar(100) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `sub_harga_jual` int(20) NOT NULL,
  `sub_harga_beli` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`kd_transaksi`, `kd_barang`, `jumlah`, `sub_harga_jual`, `sub_harga_beli`) VALUES
('7JP/MRE/110321185810', '222', 2, 980000, 900000),
('7JP/MRE/110321185810', '111', 1, 320000, 280000),
('7JP/MRE/110321185810', '333', 3, 49500000, 48000000),
('4HO/MRE/110321185927', '333', 1, 16500000, 16000000),
('4HO/MRE/110321185927', '111', 1, 320000, 280000),
('4HO/MRE/110321185927', '222', 1, 490000, 450000),
('4HO/MRE/110321185927', '567', 1, 4900000, 4500000),
('KNY/MRE/110321191909', '456', 2, 1500000, 1400000),
('KNY/MRE/110321191909', '678', 2, 3000000, 2600000),
('KNY/MRE/110321191909', '567', 1, 4900000, 4500000),
('SMG/MRE/110321191946', '234', 1, 3200000, 3000000),
('0GY/MRE/110321192029', '123', 1, 2200000, 1900000),
('0GY/MRE/110321192029', '234', 2, 6400000, 6000000),
('0GY/MRE/110321192029', '345', 2, 300000, 240000),
('43A/MRE/150321113110', '111', 1, 320000, 280000),
('W6L/MRE/150321113143', '111', 1, 320000, 280000),
('W6L/MRE/150321113143', '345', 1, 150000, 120000),
('W6L/MRE/150321113143', '555', 1, 920000, 890000),
('W6L/MRE/150321113143', '456', 1, 750000, 700000);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `Insert_Sub_Harga_Beli` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
 UPDATE barang SET stok=stok-NEW.jumlah 
 WHERE kd_barang=NEW.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_STOKUPDATE_BARANG` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
 UPDATE barang SET stok=stok-NEW.jumlah 
 WHERE kd_barang=NEW.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nama_kategori`) VALUES
('K-40JQ', 'Hardisk'),
('K-CRD8', 'Mouse'),
('K-MCB6', 'Laptop'),
('K-MNJB', 'Flasdisk'),
('K-R61D', 'Headset'),
('K-UB9S', 'Mouse Pad'),
('K-WM9F', 'Keyboard'),
('K-X15H', 'Monitor');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kd_transaksi` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `waktu_transaksi` varchar(24) NOT NULL,
  `subtotal` int(24) NOT NULL,
  `diskon` int(24) NOT NULL,
  `total` int(30) NOT NULL,
  `tunai` int(24) NOT NULL,
  `kembali` int(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kd_transaksi`, `username`, `tanggal_transaksi`, `waktu_transaksi`, `subtotal`, `diskon`, `total`, `tunai`, `kembali`) VALUES
('0GY/MRE/110321192029', 'mridwane', '2021-03-11', '19:20:29', 8900000, 0, 8900000, 8900000, 0),
('43A/MRE/150321113110', 'mridwane', '2021-03-15', '11:31:10', 320000, 0, 320000, 320000, 0),
('4HO/MRE/110321185927', 'mridwane', '2021-03-11', '18:59:27', 22210000, 50000, 22160000, 22200000, 40000),
('7JP/MRE/110321185810', 'mridwane', '2021-03-11', '18:58:10', 50800000, 100000, 50700000, 51000000, 300000),
('KNY/MRE/110321191909', 'mridwane', '2021-03-11', '19:19:09', 9400000, 100000, 9300000, 9300000, 0),
('SMG/MRE/110321191946', 'mridwane', '2021-03-11', '19:19:46', 3200000, 0, 3200000, 3200000, 0),
('W6L/MRE/150321113143', 'mridwane', '2021-03-15', '11:31:43', 2140000, 100000, 2040000, 2100000, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `kd_user` varchar(100) NOT NULL,
  `kd_role` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `waktu_reg` varchar(10) NOT NULL,
  `waktu_log` datetime NOT NULL,
  `foto` varchar(100) NOT NULL,
  `req` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`kd_user`, `kd_role`, `username`, `nama_user`, `password`, `waktu_reg`, `waktu_log`, `foto`, `req`, `status`) VALUES
('7VDBW0FTA129012021040221DIWNQ', 1, 'mridwane', 'Muhammad Ridwan Eryansah', '$2y$10$QJgmaBQDLO07.OXFxzSjP.5T0DJswNkgMriGMJSpeOwNP5SIM7xdS', '2021-01-29', '0000-00-00 00:00:00', 'Default.png', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`kd_role`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `id_kategori` (`kd_kategori`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `kd_transaksi` (`kd_transaksi`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kd_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `kd_role` (`kd_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
