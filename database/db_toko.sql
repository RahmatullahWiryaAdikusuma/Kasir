-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 07:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `tgl_update` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `id_kategori`, `nama_barang`, `harga_jual`, `tgl_input`, `tgl_update`) VALUES
(1, 'BR001', 1, 'Pensil', '3000', '6 October 2020, 0:41', NULL),
(2, 'BR002', 5, 'Sabun', '3000', '6 October 2020, 0:41', '6 October 2020, 0:54'),
(4, 'BR004', 7, 'mouse', '7000', '11 June 2023, 11:06', '11 June 2023, 11:10'),
(5, 'BR005', 5, 'nasi campur', '12000', '13 June 2023, 14:48', '13 June 2023, 14:49'),
(6, 'BR006', 5, 'amaryan', '90000', '13 June 2023, 15:42', NULL),
(7, 'BR007', 7, 'ryan', '50000', '13 June 2023, 15:42', NULL),
(8, 'BR008', 7, 'jeruk nipis', '5000', '13 June 2023, 15:51', '13 June 2023, 18:42'),
(9, 'BR009', 1, 'ppppp', '45000', '13 June 2023, 18:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--db_toko

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`) VALUES
(1, 'ATK', '7 May 2017, 10:23'),
(5, 'Sabun', '7 May 2017, 10:28'),
(7, 'Minuman', '6 October 2020, 0:20'),
(8, 'makanan', '13 June 2023, 18:42');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `id_member`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(12, 'tes', '202cb962ac59075b964b07152d234b70', 2),
(13, 'abi', '202cb962ac59075b964b07152d234b70', 8),
(14, 'rendy', '202cb962ac59075b964b07152d234b70', 9),
(15, 'amar', '202cb962ac59075b964b07152d234b70', 10);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text DEFAULT NULL,
  `NIK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
(1, 'Amaryan Kautsar', 'Rembang', '0812345', 'amaryan@mail.com', 'monkey-d-luffy-one-piece.jpg', '09876543'),
(2, 'tes', 'jauh numpak mobil 1', '08123456', 'tes1234@gmail.comm', 'p', '099078764353878'),
(8, 'Abbiyu', 'Krian', '08716742', 'Abi@email.com', NULL, '098765'),
(9, 'Rendy', 'Siwalankerto', '0987654', 'rendy@email.com', NULL, '0987654'),
(10, 'amaryan', 'Pandean', '089765', 'amaryan@email.com', NULL, '3245678');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `periode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `periode`) VALUES
(65, 'BR001', 1, '5', '15000', '11 June 2023, 11:47', '05-2023'),
(66, 'BR002', 1, '7', '21000', '11 May 2023, 12:04', '06-2023'),
(67, 'BR001', 1, '10', '30000', '11 June 2023, 12:18', '06-2023'),
(68, 'BR003', 1, '15', '30000', '11 June 2023, 12:18', '06-2023'),
(69, 'BR004', 1, '8', '56000', '11 June 2023, 12:26', '06-2023'),
(70, 'BR003', 1, '3', '6000', '12 June 2023, 12:18', '06-2023'),
(71, 'BR004', 1, '5', '35000', '12 June 2023, 12:18', '06-2023'),
(72, 'BR002', 2, '3', '9000', '13 June 2023, 10:00', '06-2023'),
(73, 'BR002', 2, '3', '9000', '13 June 2023, 10:00', '06-2023'),
(74, 'BR004', 2, '6', '42000', '13 June 2023, 10:04', '06-2023'),
(75, 'BR002', 2, '3', '9000', '13 June 2023, 10:04', '06-2023'),
(76, 'BR004', 2, '3', '21000', '13 June 2023, 13:59', '06-2023'),
(77, 'BR002', 2, '2', '6000', '13 June 2023, 13:59', '06-2023'),
(78, 'BR005', 2, '3', '36000', '13 June 2023, 18:39', '06-2023'),
(79, 'BR009', 8, '1', '45000', '15 June 2023, 0:19', '06-2023'),
(80, 'BR006', 8, '2', '180000', '15 June 2023, 0:19', '06-2023'),
(81, 'BR004', 10, '1', '7000', '15 June 2023, 0:20', '06-2023'),
(82, 'BR008', 10, '5', '25000', '15 June 2023, 0:20', '06-2023'),
(83, 'BR005', 10, '2', '24000', '15 June 2023, 0:20', '06-2023'),
(84, 'BR007', 9, '1', '50000', '15 June 2023, 0:21', '06-2023'),
(85, 'BR002', 9, '1', '3000', '15 June 2023, 0:21', '06-2023'),
(86, 'BR009', 9, '1', '45000', '15 June 2023, 0:21', '06-2023'),
(87, 'BR004', 9, '1', '7000', '15 June 2023, 0:21', '06-2023');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`) VALUES
(48, 'BR007', 9, '1', '50000', '15 June 2023, 0:21'),
(49, 'BR002', 9, '1', '3000', '15 June 2023, 0:21'),
(50, 'BR009', 9, '1', '45000', '15 June 2023, 0:21'),
(51, 'BR004', 9, '1', '7000', '15 June 2023, 0:21');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`) VALUES
(1, 'Warung Q', 'Rembang', '08123456879', 'Amaryan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
