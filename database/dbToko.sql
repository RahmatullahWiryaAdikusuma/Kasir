-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_toko
CREATE DATABASE IF NOT EXISTS `db_toko` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_toko`;

-- Dumping structure for table db_toko.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `kode_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tipe` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `harga_jual` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stok` int DEFAULT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  UNIQUE KEY `UK` (`kode_barang`),
  KEY `FK_barang_produk` (`id_produk`),
  CONSTRAINT `FK_barang_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_toko.barang: ~159 rows (approximately)
REPLACE INTO `barang` (`id_barang`, `id_kategori`, `id_produk`, `kode_produk`, `kode_barang`, `nama_barang`, `tipe`, `harga_jual`, `stok`, `tgl_input`, `tgl_update`) VALUES
	(1, 2, 1, '\r\nSM01', 'SM0101', 'Tawon', '3 Kg', '27000', 0, '2024-10-18 18:28:33', '2024-11-14 14:12:15'),
	(3, 4, 5, '\r\nAT01', '\r\nAT0101', 'Faber Castell 2B', 'satuan', '5000', 0, '2024-10-16 08:03:21', '2024-10-16 08:03:21'),
	(4, 3, 7, '\r\nRK02', 'RK0201', 'Surya', '12', '26000', 2, '2024-10-16 08:22:30', '2024-12-27 14:07:12'),
	(5, 2, 1, '\r\nSM01', 'SM0102', 'Raja Lele', '1 Kg', '15000', 1, '2024-10-18 18:08:47', '2024-11-15 10:29:27'),
	(10, 2, 3, 'SM03', 'SM0301', 'Sania', '2 Kg', '46500', 12, '2024-11-01 11:47:47', '2024-12-23 14:06:45'),
	(11, 2, 8, 'SM04', 'SM0401', 'Ayam', '1/4 kg', '8000', 18, '2024-11-14 14:10:37', '2024-11-14 14:10:37'),
	(12, 2, 2, 'SM02', 'SM0201', 'Gulaku', '1 Kg', '16000', 8, '2024-11-15 10:41:35', '2024-12-23 14:09:29'),
	(13, 4, 10, 'AT02', 'AT0201', 'Standart Hitam', 'satuan', '2996', 5, '2024-11-22 08:26:42', '2024-12-27 14:32:00'),
	(14, 2, 3, 'SM03', 'SM0302', 'Tropical', '2 Kg', '49500', 4, '2024-12-23 14:06:06', '2024-12-23 14:06:06'),
	(15, 2, 3, 'SM03', 'SM0303', 'Filma', '2 Kg', '51500', 2, '2024-12-23 14:07:09', '2024-12-23 14:07:09'),
	(16, 2, 3, 'SM03', 'SM0304', 'Bimoli', '2 Kg', '45500', -2, '2024-12-23 14:07:46', '2024-12-23 14:07:46'),
	(17, 2, 2, 'SM02', 'SM0202', 'Rosebrand ', '1 Kg', '24000', -4, '2024-12-23 14:10:38', '2024-12-23 14:10:38'),
	(18, 3, 7, 'RK02', 'RK0202', 'Surya International', '12', '26000', 2, '2024-12-27 14:06:25', '2024-12-27 14:06:25'),
	(19, 3, 7, 'RK02', 'RK0203', 'Surya', '16', '37000', 12, '2024-12-27 14:07:54', '2024-12-27 14:07:54'),
	(20, 3, 7, 'RK02', 'RK0204', 'Signature Hitam', '12', '26000', 12, '2024-12-27 14:08:18', '2024-12-27 14:08:18'),
	(21, 3, 7, 'RK02', 'RK0205', 'Halim', '12', '25000', 12, '2024-12-27 14:08:42', '2024-12-27 14:28:35'),
	(22, 3, 7, 'RK02', 'RK0206', 'Djaya', '12', '15000', 12, '2024-12-27 14:09:18', '2024-12-27 14:09:18'),
	(23, 3, 7, 'RK02', 'RK0207', 'GG Mild', '12', '33000', 12, '2024-12-27 14:09:38', '2024-12-27 14:09:38'),
	(24, 3, 7, 'RK02', 'RK0208', 'Surya Pro Mild', '12', '33000', 12, '2024-12-27 14:10:03', '2024-12-27 14:10:03'),
	(25, 3, 7, 'RK02', 'RK0209', 'Djarum Super', '12', '25000', 12, '2024-12-27 14:10:30', '2024-12-27 14:10:30'),
	(26, 3, 7, 'RK02', 'RK0210', 'Djarum 76', '12', '16000', 12, '2024-12-27 14:11:22', '2024-12-27 14:11:22'),
	(27, 3, 7, 'RK02', 'RK0211', 'LA Lights', '12', '33000', 12, '2024-12-27 14:11:42', '2024-12-27 14:11:42'),
	(28, 3, 7, 'RK02', 'RK0212', 'A Mild ', '16', '35000', 12, '2024-12-27 14:12:08', '2024-12-27 14:12:08'),
	(29, 3, 7, 'RK02', 'RK0213', 'A Mild ', '12', '25000', 12, '2024-12-27 14:12:26', '2024-12-27 14:12:26'),
	(31, 16, 65, 'BM05', 'BM0501', 'Saori', 'Sachet', '3000', 20, '2024-12-27 14:15:40', '2024-12-27 14:15:40'),
	(32, 16, 18, 'BM01', 'BM0101', 'Masako Sapi', 'Sachet', '1000', -12, '2024-12-27 14:17:49', '2024-12-27 14:17:49'),
	(33, 16, 18, 'BM01', 'BM0102', 'Masako Ayam', 'Sachet', '1000', -10, '2024-12-27 14:18:16', '2024-12-27 14:18:16'),
	(34, 16, 18, 'BM01', 'BM0103', 'Royco Ayam', 'Sachet', '1000', 20, '2024-12-27 14:18:39', '2024-12-27 14:18:39'),
	(35, 16, 18, 'BM01', 'BM0104', 'Royco Sapi', 'Sachet', '1000', 20, '2024-12-27 14:19:14', '2024-12-27 14:19:14'),
	(36, 4, 10, 'AT02', 'AT0202', 'Pilot', 'Satuan', '2000', 10, '2024-12-27 14:29:25', '2024-12-27 14:29:25'),
	(37, 4, 10, 'AT02', 'AT0203', 'Joyko', 'Satuan', '2500', 10, '2024-12-27 14:30:36', '2024-12-27 14:32:49'),
	(38, 4, 10, 'AT02', 'AT0204', 'Standart Merah', 'Satuan', '3000', 10, '2024-12-27 14:31:45', '2024-12-27 14:31:45'),
	(39, 4, 10, 'AT02', 'AT0205', 'Standart Biru', 'Satuan', '3000', 10, '2024-12-27 14:32:22', '2024-12-27 14:32:22'),
	(40, 4, 5, 'AT01', 'AT0102', 'Joyko 2B', 'Satuan', '1500', 20, '2024-12-27 14:33:27', '2024-12-27 14:33:50'),
	(41, 4, 13, 'AT03', 'AT0301', 'Joyko', 'Satuan', '1000', 10, '2024-12-27 14:34:31', '2024-12-27 14:34:31'),
	(42, 4, 13, 'AT03', 'AT0302', 'Faber Castell', 'Satuan', '2500', 10, '2024-12-27 14:34:54', '2024-12-27 14:34:54'),
	(43, 4, 14, 'AT04', 'AT0401', 'Butterfly', 'Satuan', '2000', 10, '2024-12-27 14:36:39', '2024-12-27 14:36:39'),
	(45, 4, 56, 'AT05', 'AT0501', 'Snowman  Hitam', 'Satuan', '10000', 10, '2024-12-27 14:40:53', '2024-12-27 14:40:53'),
	(46, 4, 56, 'AT05', 'AT0502', 'Snowman Biru', 'Satuan', '10000', 10, '2024-12-27 14:41:13', '2024-12-27 14:41:13'),
	(47, 4, 56, 'AT05', 'AT0503', 'Snowman Merah', 'Satuan', '10000', 10, '2024-12-27 14:41:36', '2024-12-27 14:41:36'),
	(48, 4, 57, 'AT06', 'AT0601', 'Vision Kotak', 'Satuan ', '4000', 10, '2024-12-27 14:44:03', '2024-12-27 14:44:03'),
	(49, 4, 57, 'AT06', 'AT0602', 'Vision ', 'Satuan', '4000', 10, '2024-12-27 14:44:26', '2024-12-27 14:44:26'),
	(50, 4, 57, 'AT06', 'AT0603', 'Sinar Dunia', 'Satuan', '4500', 10, '2024-12-27 14:46:02', '2024-12-27 14:46:02'),
	(51, 4, 58, 'AT07', 'AT0701', 'Sinar Dunia A4', 'Satuan', '7500', 10, '2024-12-27 14:47:06', '2024-12-27 14:47:06'),
	(52, 4, 58, 'AT07', 'AT0702', 'Ajaib A4', 'Satuan', '6000', 10, '2024-12-27 14:48:54', '2024-12-27 14:48:54'),
	(53, 4, 59, 'AT08', 'AT0801', 'Kenko', 'Satuan', '5000', 10, '2024-12-27 14:50:23', '2024-12-27 14:50:23'),
	(54, 4, 59, 'AT08', 'AT0802', 'Joyko Kertas', 'Satuan', '7500', 10, '2024-12-27 14:51:22', '2024-12-27 14:51:22'),
	(55, 4, 59, 'AT08', 'AT0803', 'Kenko Kertas', 'Satuan', '6500', 10, '2024-12-27 14:51:51', '2024-12-27 14:51:51'),
	(56, 4, 60, 'AT09', 'AT0901', 'Paperline', 'Satuan', '300', 20, '2024-12-27 14:54:33', '2024-12-27 14:54:33'),
	(57, 4, 60, 'AT09', 'AT0902', 'Merpati', 'Satuan', '250', 20, '2024-12-27 14:55:15', '2024-12-27 14:55:15'),
	(58, 4, 61, 'AT10', 'AT1001', 'Ekonomis', 'Satuan', '2500', 10, '2024-12-27 14:57:55', '2024-12-27 14:57:55'),
	(59, 2, 16, 'SM05', 'SM0501', 'Dancow', 'Sachet', '2500', 30, '2024-12-30 11:24:23', '2024-12-30 11:24:23'),
	(60, 2, 16, 'SM05', 'SM0502', 'Milo', 'Sachet', '2000', 30, '2024-12-30 11:25:03', '2024-12-30 11:25:03'),
	(61, 2, 16, 'SM05', 'SM0503', 'Frisian Flag SKM', 'Sachet', '30', 2500, '2024-12-30 11:26:07', '2024-12-30 11:26:07'),
	(62, 2, 16, 'SM05', 'SM0504', 'Indomilk SKM', 'Sachet', '2500', 30, '2024-12-30 11:26:34', '2024-12-30 11:26:34'),
	(63, 2, 17, 'SM06', 'SM0601', 'Segitiga Biru', '250 Gr', '4000', 40, '2024-12-30 11:29:19', '2024-12-30 11:29:19'),
	(64, 17, 48, 'OA01', 'OA0101', 'Paracetamol', 'Strip', '10000', 6, '2024-12-30 11:32:02', '2024-12-30 11:32:02'),
	(65, 17, 48, 'OA01', 'OA0102', 'Oskadon', 'Strip', '3000', 10, '2024-12-30 11:32:41', '2024-12-30 11:32:41'),
	(66, 17, 48, 'OA01', 'OA0103', 'Paramex', 'Strip', '4000', 10, '2024-12-30 11:33:15', '2024-12-30 11:33:15'),
	(67, 17, 48, 'OA01', 'OA0104', 'Panadol', 'Strip', '13000', 12, '2024-12-30 11:33:42', '2024-12-30 11:33:42'),
	(68, 17, 49, 'OA02', 'OA0201', 'Mixagrip', 'Strip', '3500', 12, '2024-12-30 11:34:51', '2024-12-30 11:34:51'),
	(69, 17, 50, 'OA03', 'OA0301', 'Promag', 'Strip', '12000', 10, '2024-12-30 11:36:44', '2024-12-30 11:36:44'),
	(70, 17, 50, 'OA03', 'OA0302', 'Mylanta', 'Strip', '10000', 12, '2024-12-30 11:37:18', '2024-12-30 11:37:18'),
	(71, 17, 51, 'OA04', 'OA0401', 'Betadine 15ml', 'Botol', '5000', 20, '2024-12-30 11:39:25', '2024-12-30 11:39:25'),
	(72, 17, 51, 'OA04', 'OA0402', 'Hansaplast', 'Satuan', '1000', 50, '2024-12-30 11:40:19', '2024-12-30 11:40:19'),
	(73, 17, 52, 'OA05', 'OA0501', 'Salep 88', 'Satuan', '15000', 20, '2024-12-30 11:42:34', '2024-12-30 11:42:34'),
	(74, 17, 52, 'OA05', 'OA0502', 'CTM', 'Strip', '3000', 15, '2024-12-30 11:43:47', '2024-12-30 11:43:47'),
	(76, 17, 53, 'OA06', 'OA0601', 'Salonpas', 'Lembar', '7000', 10, '2024-12-30 11:47:52', '2024-12-30 11:47:52'),
	(77, 17, 53, 'OA06', 'OA0602', 'Balsem Geliga', 'Botol', '7000', 10, '2024-12-30 11:49:09', '2024-12-30 11:49:09'),
	(78, 17, 54, 'OA07', 'OA0701', 'Insto', 'Botol', '17000', 10, '2024-12-30 11:50:44', '2024-12-30 11:50:44'),
	(79, 17, 55, 'OA08', 'OA0801', 'Tolak Angin', 'Sachet', '5000', 20, '2024-12-30 11:52:04', '2024-12-30 11:52:04'),
	(80, 17, 55, 'OA08', 'OA0802', 'Antangin', 'Sachet', '5000', 20, '2024-12-30 11:52:35', '2024-12-30 11:52:35'),
	(81, 17, 55, 'OA08', 'OA0803', 'Minyak Kayu Putih', 'Botol', '8000', 10, '2024-12-30 11:53:51', '2024-12-30 11:53:51'),
	(82, 17, 55, 'OA08', 'OA0804', 'Diapet', 'Strip', '7000', 10, '2024-12-30 11:54:27', '2024-12-30 11:54:27'),
	(83, 17, 55, 'OA08', 'OA0805', 'Kiranti', 'Botol', '8000', 10, '2024-12-30 11:55:02', '2024-12-30 11:55:02'),
	(84, 20, 37, 'PK01', 'PK0101', 'Lifebuoy ', 'Batang', '4000', 10, '2024-12-30 11:56:21', '2024-12-30 11:56:21'),
	(85, 20, 37, 'PK01', 'PK0102', 'Lifebuoy Refill', '250ml', '15000', 10, '2024-12-30 11:58:42', '2024-12-30 12:00:26'),
	(86, 20, 37, 'PK01', 'PK0103', 'Nuvo', 'Batang', '3000', 10, '2024-12-30 11:59:17', '2024-12-30 11:59:17'),
	(87, 20, 37, 'PK01', 'PK0104', 'Nuvo Refill', '250ml', '15000', 10, '2024-12-30 12:00:12', '2024-12-30 12:00:12'),
	(88, 20, 38, 'PK02', 'PK0201', 'Lifebuoy ', 'Botol', '20000', 10, '2024-12-30 12:01:27', '2024-12-30 12:01:27'),
	(89, 20, 38, 'PK02', 'PK0202', 'Lifebuoy ', 'Sachet', '1500', 20, '2024-12-30 12:02:07', '2024-12-30 12:02:07'),
	(90, 20, 38, 'PK02', 'PK0203', 'Dove', 'Botol', '20000', 10, '2024-12-30 12:02:51', '2024-12-30 12:02:51'),
	(91, 20, 38, 'PK02', 'PK0204', 'Dove', 'Sachet', '1000', 20, '2024-12-30 12:03:24', '2024-12-30 12:03:24'),
	(92, 20, 39, 'PK03', 'PK0301', 'Rexona', 'Roll On', '17000', 10, '2024-12-30 12:05:03', '2024-12-30 12:05:03'),
	(93, 20, 39, 'PK03', 'PK0302', 'Rexona', 'Sachet', '2000', 20, '2024-12-30 12:05:40', '2024-12-30 12:05:40'),
	(94, 20, 40, 'PK04', 'PK0401', 'Laurier ', 'Pack', '12000', 10, '2024-12-30 12:09:10', '2024-12-30 12:09:10'),
	(95, 20, 40, 'PK04', 'PK0402', 'Protex', 'Pack', '11000', 10, '2024-12-30 12:09:40', '2024-12-30 12:09:40'),
	(96, 20, 40, 'PK04', 'PK0403', 'MamyPoko', 'Sachet', '2500', 20, '2024-12-30 12:10:33', '2024-12-30 12:10:33'),
	(97, 19, 30, 'PR01', 'PR0101', 'Sunlight', '650ml', '13000', 10, '2024-12-30 12:12:03', '2024-12-30 12:12:03'),
	(98, 19, 30, 'PR01', 'PR0102', 'Sunlight', '90ml', '2000', 10, '2024-12-30 12:12:27', '2024-12-30 12:12:27'),
	(99, 19, 30, 'PR01', 'PR0103', 'Sunlight', '210ml', '5000', 10, '2024-12-30 12:12:54', '2024-12-30 12:12:54'),
	(100, 19, 30, 'PR01', 'PR0104', 'Ekonomi', '210ml', '5000', 10, '2024-12-30 12:13:41', '2024-12-30 12:13:41'),
	(101, 19, 31, 'PR02', 'PR0201', 'Rinso', '400gr', '10000', 10, '2024-12-30 12:15:03', '2024-12-30 12:15:03'),
	(102, 19, 31, 'PR02', 'PR0202', 'Rinso', '38gr', '1000', 10, '2024-12-30 12:16:03', '2024-12-30 12:16:03'),
	(103, 19, 32, 'PR03', 'PR0301', 'Molto ', 'Sachet', '500', 30, '2024-12-30 12:17:33', '2024-12-30 12:17:33'),
	(104, 19, 33, 'PR04', 'PR0401', 'S.O.S', '750ml', '12000', 10, '2024-12-30 12:19:01', '2024-12-30 12:19:01'),
	(105, 19, 34, 'PR05', 'PR0501', 'Formula', 'Satuan', '3500', 10, '2024-12-30 12:20:15', '2024-12-30 12:20:15'),
	(106, 19, 35, 'PR06', 'PR0601', 'Pepsodent', 'Satuan', '17000', 12, '2024-12-30 12:21:07', '2024-12-30 12:21:07'),
	(107, 19, 35, 'PR06', 'PR0602', 'Close Up', 'Satuan', '20000', 12, '2024-12-30 12:21:40', '2024-12-30 12:21:40'),
	(108, 19, 36, 'PR07', 'PR0701', 'Nice', 'Pack', '6500', 10, '2024-12-30 12:22:34', '2024-12-30 12:22:34'),
	(109, 19, 36, 'PR07', 'PR0702', 'Paseo Pocket', 'Pack ', '3000', 10, '2024-12-30 12:23:38', '2024-12-30 12:24:05'),
	(110, 16, 18, 'BM01', 'BM0105', 'Indofood Racik', 'Sachet ', '2000', 10, '2024-12-30 12:26:58', '2024-12-30 12:26:58'),
	(111, 16, 18, 'BM01', 'BM0106', 'Ladaku', 'Sachet ', '1000', 10, '2024-12-30 12:27:18', '2024-12-30 12:27:18'),
	(112, 16, 18, 'BM01', 'BM0107', 'Sasa', 'Sachet', '2500', 10, '2024-12-30 12:27:50', '2024-12-30 12:27:50'),
	(113, 16, 62, 'BM02', 'BM0201', 'ABC', 'Botol', '13000', 5, '2024-12-30 12:28:26', '2024-12-30 12:28:26'),
	(114, 16, 62, 'BM02', 'BM0202', 'ABC', 'Sachet', '500', 20, '2024-12-30 12:28:55', '2024-12-30 12:28:55'),
	(115, 16, 63, 'BM03', 'BM0301', 'ABC', 'Botol', '13000', 10, '2024-12-30 12:29:30', '2024-12-30 12:29:30'),
	(116, 16, 63, 'BM03', 'BM0302', 'ABC', 'Sachet', '500', 20, '2024-12-30 12:29:51', '2024-12-30 12:29:51'),
	(117, 16, 64, 'BM04', 'BM0401', 'ABC', 'Sachet', '2000', 10, '2024-12-30 12:30:38', '2024-12-30 12:30:38'),
	(118, 16, 64, 'BM04', 'BM0402', 'Bango', 'Sachet', '3000', 20, '2024-12-30 12:31:15', '2024-12-30 12:31:15'),
	(119, 16, 64, 'BM04', 'BM0403', 'Sedaap', 'Sachet ', '2000', 15, '2024-12-30 12:31:32', '2024-12-30 12:31:32'),
	(120, 16, 65, 'BM05', 'BM0502', 'Ajinomoto', '250gr', '12000', 10, '2024-12-30 12:33:37', '2024-12-30 12:33:37'),
	(121, 16, 65, 'BM05', 'BM0503', 'Miwon', '50gr', '4000', 10, '2024-12-30 12:34:08', '2024-12-30 12:34:08'),
	(122, 16, 66, 'BM06', 'BM0601', 'Blueband', '200gr', '12000', 10, '2024-12-30 12:35:13', '2024-12-30 12:35:13'),
	(123, 16, 66, 'BM06', 'BM0602', 'For Vita', '200gr', '5000', 10, '2024-12-30 12:35:37', '2024-12-30 12:35:37'),
	(124, 1, 4, 'MM01', 'MM0101', 'Biskuat', 'Sachet', '1000', 10, '2024-12-30 12:37:08', '2024-12-30 12:37:08'),
	(125, 1, 4, 'MM01', 'MM0102', 'Hatari ', 'Pack', '10000', 10, '2024-12-30 12:37:44', '2024-12-30 12:37:44'),
	(126, 1, 4, 'MM01', 'MM0103', 'Roma Kelapa', 'Pack', '17000', 8, '2024-12-30 12:38:42', '2024-12-30 12:38:42'),
	(127, 1, 4, 'MM01', 'MM0104', 'Malkist', 'Sachet', '1000', 10, '2024-12-30 12:39:03', '2024-12-30 12:39:03'),
	(128, 1, 4, 'MM01', 'MM0105', 'Oreo', 'Sachet', '2500', 10, '2024-12-30 12:39:33', '2024-12-30 12:39:33'),
	(129, 1, 4, 'MM01', 'MM0106', 'Crispy Crackers', 'Pack', '14000', 10, '2024-12-30 12:40:12', '2024-12-30 12:40:22'),
	(130, 1, 15, 'MM02', 'MM0201', 'Indomie Goreng', 'Satuan', '3000', 40, '2024-12-30 12:41:35', '2024-12-30 12:41:35'),
	(131, 1, 15, 'MM02', 'MM0202', 'Indomie Soto', 'Satuan', '3000', 40, '2024-12-30 12:41:52', '2024-12-30 12:41:52'),
	(132, 1, 15, 'MM02', 'MM0203', 'Indomie Kari', 'Satuan ', '3000', 40, '2024-12-30 12:42:09', '2024-12-30 12:42:09'),
	(133, 1, 15, 'MM02', 'MM0204', 'Sedap Goreng', 'Satuan', '2500', 40, '2024-12-30 12:42:42', '2024-12-30 12:42:42'),
	(134, 1, 15, 'MM02', 'MM0205', 'Sedap Soto', 'Satuan', '2500', 40, '2024-12-30 12:43:02', '2024-12-30 12:43:02'),
	(135, 1, 19, 'MM03', 'MM0301', 'Aqua', '1500ml', '7000', 12, '2024-12-30 12:44:05', '2024-12-30 12:44:05'),
	(136, 1, 19, 'MM03', 'MM0302', 'Aqua', '600ml', '3500', 24, '2024-12-30 12:44:39', '2024-12-30 12:44:47'),
	(137, 1, 19, 'MM03', 'MM0303', 'Aqua', '220ml', '500', 96, '2024-12-30 12:46:08', '2024-12-30 12:46:08'),
	(138, 1, 19, 'MM03', 'MM0304', 'Aqua 220ml', 'Box', '42000', 10, '2024-12-30 12:47:12', '2024-12-30 12:47:12'),
	(139, 1, 20, 'MM04', 'MM0401', 'Fruit Tea', 'Botol', '5000', 10, '2024-12-30 12:47:50', '2024-12-30 12:47:50'),
	(140, 1, 20, 'MM04', 'MM0402', 'Sosro', 'Botol', '4000', 10, '2024-12-30 12:48:13', '2024-12-30 12:48:13'),
	(141, 1, 20, 'MM04', 'MM0403', 'Javana', 'Botol', '3500', 10, '2024-12-30 12:48:48', '2024-12-30 12:48:48'),
	(142, 1, 20, 'MM04', 'MM0404', 'Teh Pucuk', 'Botol ', '3500', 10, '2024-12-30 12:49:08', '2024-12-30 12:49:08'),
	(143, 1, 21, 'MM05', 'MM0501', 'Golda', 'Botol', '3000', 10, '2024-12-30 12:49:44', '2024-12-30 12:49:44'),
	(144, 1, 21, 'MM05', 'MM0502', 'Good Day', 'Botol', '6500', 10, '2024-12-30 12:50:15', '2024-12-30 12:50:15'),
	(145, 1, 21, 'MM05', 'MM0503', 'Kopiko', 'Botol', '4000', 10, '2024-12-30 12:52:47', '2024-12-30 12:52:47'),
	(146, 1, 42, 'MM06', 'MM0601', 'Potabee', 'Sachet', '2000', 10, '2024-12-30 12:54:28', '2024-12-30 12:54:28'),
	(147, 1, 42, 'MM06', 'MM0602', 'Lays', 'Sachet', '2000', 10, '2024-12-30 12:57:02', '2024-12-30 12:57:02'),
	(148, 1, 43, 'MM07', 'MM0701', 'Chitato', 'Sachet', '2000', 10, '2024-12-30 13:01:22', '2024-12-30 13:01:22'),
	(149, 1, 42, 'MM06', 'MM0603', 'French Fries', 'Sachet', '1000', 10, '2024-12-30 13:01:43', '2024-12-30 13:01:43'),
	(150, 1, 43, 'MM07', 'MM0702', 'Tango Coklat', '33gr', '500', 12, '2024-12-30 13:09:09', '2024-12-30 13:13:38'),
	(151, 1, 43, 'MM07', 'MM0703', 'Nabati Keju', '33gr', '500', 12, '2024-12-30 13:10:13', '2024-12-30 13:13:02'),
	(152, 1, 43, 'MM07', 'MM0704', 'Nabati Keju', '75gr', '2000', 10, '2024-12-30 13:10:53', '2024-12-30 13:10:53'),
	(153, 1, 43, 'MM07', 'MM0705', 'Tango Vanila', '33gr', '500', 10, '2024-12-30 13:14:01', '2024-12-30 13:14:01'),
	(154, 1, 43, 'MM07', 'MM0706', 'Nabati Coklat', '33gr', '500', 10, '2024-12-30 13:14:22', '2024-12-30 13:14:22'),
	(155, 1, 43, 'MM07', 'MM0707', 'Nabati Coklat', '75gr', '2000', 10, '2024-12-30 13:15:40', '2024-12-30 13:15:40'),
	(156, 1, 44, 'MM08', 'MM0801', 'Aoka', 'Sachet', '2500', 18, '2024-12-30 13:20:16', '2024-12-30 13:20:16'),
	(157, 1, 44, 'MM08', 'MM0802', 'Nextar', 'Sachet', '2000', 20, '2024-12-30 13:20:47', '2024-12-30 13:20:47'),
	(158, 1, 46, 'MM09', 'MM0901', 'Kapal Api', '6gr', '500', 12, '2024-12-30 13:22:44', '2024-12-30 13:22:44'),
	(159, 1, 46, 'MM09', 'MM0902', 'Kapal Api', '21gr', '7500', 12, '2024-12-30 13:26:50', '2024-12-30 13:26:50'),
	(160, 1, 46, 'MM09', 'MM0903', 'Luwak White', '7gr', '1500', 20, '2024-12-30 13:27:39', '2024-12-30 13:27:39'),
	(161, 1, 46, 'MM09', 'MM0904', 'Teh Sosro Celup', 'Box', '7500', 10, '2024-12-30 13:28:36', '2024-12-30 13:28:36'),
	(162, 1, 67, 'MM10', 'MM1001', 'Relaxa', 'Pack', '7000', 5, '2024-12-30 13:29:26', '2024-12-30 13:29:26'),
	(163, 1, 67, 'MM10', 'MM1002', 'Kopiko', 'Pack', '8000', 10, '2024-12-30 13:29:41', '2024-12-30 13:29:41'),
	(164, 1, 67, 'MM10', 'MM1003', 'Milkita', 'Satuan', '500', 20, '2024-12-30 13:30:07', '2024-12-30 13:30:07'),
	(165, 1, 67, 'MM10', 'MM1004', 'Blaster Pop', 'Satuan', '500', 20, '2024-12-30 13:30:50', '2024-12-30 13:30:50'),
	(166, 1, 67, 'MM10', 'MM1005', 'Yupi', 'Pack', '10000', 10, '2024-12-30 13:31:21', '2024-12-30 13:31:21'),
	(167, 1, 67, 'MM10', 'MM1006', 'Fox', 'Pack', '9000', 8, '2024-12-30 13:31:40', '2024-12-30 13:31:40');

-- Dumping structure for table db_toko.deleted_products
CREATE TABLE IF NOT EXISTS `deleted_products` (
  `id_barang` int DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_toko.deleted_products: ~0 rows (approximately)
REPLACE INTO `deleted_products` (`id_barang`, `kode_barang`, `nama_barang`, `id_produk`, `nama_produk`, `tipe`, `deleted_at`) VALUES
	(174, 'BM0108', 'ytta', 18, 'Bumbu Instan', '123', '2025-01-20 11:06:05'),
	(175, 'PK0105', 'tes1', 37, 'Sabun Mandi', '123', '2025-01-21 02:26:12');

-- Dumping structure for table db_toko.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `kode_kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toko.kategori: ~8 rows (approximately)
REPLACE INTO `kategori` (`id_kategori`, `nama_kategori`, `kode_kategori`, `tgl_input`) VALUES
	(1, 'Makanan &amp; Minuman Ringan', 'MM', '6 October 2020, 0:20'),
	(2, 'Sembako', 'SM', '13 June 2023, 18:42'),
	(3, 'Rokok dan Aksesoris', 'RK', '23 July 2024, 11:15'),
	(4, 'Alat Tulis Kantor', 'AT', '24 July 2024, 12:14'),
	(16, 'Bahan Makanan', 'BM', '30 October 2024, 13:23'),
	(17, 'Obat & Alat kesehatan', 'OA', '14 November 2024, 14:06'),
	(19, 'Peralatan Kebersihan dan Rumah Tangga', 'PR', '17 December 2024, 11:30'),
	(20, 'Peralatan dan Keperluan Pribadi', 'PK', '17 December 2024, 11:31');

-- Dumping structure for table db_toko.nota
CREATE TABLE IF NOT EXISTS `nota` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `id_user` int NOT NULL,
  `id_produk` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `kode_nota` varchar(20) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toko.nota: ~84 rows (approximately)
REPLACE INTO `nota` (`id_nota`, `id_barang`, `kode_barang`, `nama_barang`, `nama_produk`, `id_user`, `id_produk`, `jumlah`, `total`, `tanggal_input`, `kode_nota`, `periode`, `tipe`) VALUES
	(1, '2', NULL, NULL, NULL, 16, '1', '100', '3000000', '2024-10-01 8:20:20', NULL, '10-2024', NULL),
	(17, '4', NULL, NULL, NULL, 16, '7', '9', '243000', '2024-01-01 8:20:20', NULL, '01-2024', NULL),
	(18, '5', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-04 17:55:52', NULL, '11-2024', NULL),
	(19, '5', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-04 17:55:52', NULL, '11-2024', NULL),
	(20, '5', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-04 17:55:52', NULL, '11-2024', NULL),
	(21, '5', NULL, NULL, NULL, 16, '1', '3', '81000', '2024-11-04 18:36:28', NULL, '11-2024', NULL),
	(22, '5', NULL, NULL, NULL, 16, '1', '3', '81000', '2024-11-04 18:37:03', NULL, '11-2024', NULL),
	(23, '5', NULL, NULL, NULL, 16, '1', '3', '81000', '2024-11-04 18:37:03', NULL, '11-2024', NULL),
	(24, '5', NULL, NULL, NULL, 16, '1', '3', '81000', '2024-11-04 18:37:49', NULL, '11-2024', NULL),
	(25, '3', NULL, NULL, NULL, 16, '5', '1', '5000', '2024-11-04 18:39:01', NULL, '11-2024', NULL),
	(26, '3', NULL, NULL, NULL, 16, '5', '1', '5000', '2024-11-04 18:40:03', NULL, '11-2024', NULL),
	(27, '4', NULL, NULL, NULL, 16, '7', '3', '60000', '2024-11-08 08:43:05', NULL, '11-2024', NULL),
	(28, '5', NULL, NULL, NULL, 16, '1', '3', '81000', '2024-11-08 08:43:46', NULL, '11-2024', NULL),
	(29, '4', NULL, NULL, NULL, 16, '7', '2', '40000', '2024-11-14 11:02:45', NULL, '11-2024', NULL),
	(30, '4', NULL, NULL, NULL, 11, '7', '3', '60000', '2024-11-14 13:34:56', NULL, '11-2024', NULL),
	(31, '10', NULL, NULL, NULL, 11, '3', '2', '40000', '2024-11-14 13:37:26', NULL, '11-2024', NULL),
	(32, '5', NULL, NULL, NULL, 11, '1', '1', '27000', '2024-11-14 13:37:19', NULL, '11-2024', NULL),
	(33, '4', NULL, NULL, NULL, 11, '7', '1', '20000', '2024-11-14 13:36:30', NULL, '11-2024', NULL),
	(34, '1', NULL, NULL, NULL, 16, '1', '2', '54000', '2024-11-18 13:04:43', NULL, '11-2024', NULL),
	(35, '1', NULL, NULL, NULL, 16, '1', '2', '54000', '2024-11-18 13:05:45', NULL, '11-2024', NULL),
	(36, '4', NULL, NULL, NULL, 16, '7', '1', '25000', '2024-11-18 13:07:41', NULL, '11-2024', NULL),
	(37, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 13:07:34', NULL, '11-2024', NULL),
	(38, '4', NULL, NULL, NULL, 16, '7', '1', '25000', '2024-11-18 13:07:41', NULL, '11-2024', NULL),
	(39, '4', NULL, NULL, NULL, 16, '7', '1', '25000', '2024-11-18 13:07:41', NULL, '11-2024', NULL),
	(40, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 13:07:34', NULL, '11-2024', NULL),
	(41, '4', NULL, NULL, NULL, 16, '7', '1', '25000', '2024-11-18 13:07:41', NULL, '11-2024', NULL),
	(42, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 13:07:34', NULL, '11-2024', NULL),
	(43, '1', NULL, NULL, NULL, 16, '1', '2', '54000', '2024-11-18 18:34:25', NULL, '11-2024', NULL),
	(44, '1', NULL, NULL, NULL, 16, '1', '2', '54000', '2024-11-18 18:35:46', NULL, '11-2024', NULL),
	(45, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:41:47', NULL, '11-2024', NULL),
	(46, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:42:44', NULL, '11-2024', NULL),
	(47, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:43:10', NULL, '11-2024', NULL),
	(48, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:43:08', NULL, '11-2024', NULL),
	(49, '11', NULL, NULL, NULL, 16, '8', '1', '8000', '2024-11-18 18:50:41', NULL, '11-2024', NULL),
	(50, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:53:28', NULL, '11-2024', NULL),
	(51, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:53:28', NULL, '11-2024', NULL),
	(52, '1', NULL, NULL, NULL, 16, '1', '1', '27000', '2024-11-18 18:53:28', NULL, '11-2024', NULL),
	(53, '4', NULL, NULL, NULL, 16, '7', '1', '25000', '2024-11-18 18:57:43', NULL, '11-2024', NULL),
	(54, '4', NULL, NULL, NULL, 16, '7', '1', '26000', '2024-12-30 11:20:59', NULL, '12-2024', NULL),
	(55, '4', NULL, NULL, NULL, 16, '7', '1', '26000', '2024-12-30 11:21:28', NULL, '12-2024', NULL),
	(56, '156', NULL, NULL, NULL, 16, '44', '2', '5000', '2025-01-03 11:21:53', NULL, '01-2025', NULL),
	(57, '11', NULL, NULL, NULL, 16, '8', '4', '32000', '2025-01-03 11:21:39', NULL, '01-2025', NULL),
	(58, '156', NULL, NULL, NULL, 16, '44', '2', '5000', '2025-01-03 11:21:53', NULL, '01-2025', NULL),
	(59, '11', NULL, NULL, NULL, 16, '8', '4', '32000', '2025-01-03 11:21:39', NULL, '01-2025', NULL),
	(60, '4', NULL, NULL, NULL, 16, '7', '1', '26000', '2025-01-05 18:27:29', NULL, '01-2025', NULL),
	(61, '5', NULL, NULL, NULL, 16, '1', '2', '30000', '2025-01-05 18:27:25', NULL, '01-2025', NULL),
	(62, '4', NULL, NULL, NULL, 16, '7', '1', '26000', '2025-01-05 18:27:29', NULL, '01-2025', NULL),
	(63, '5', NULL, NULL, NULL, 16, '1', '2', '30000', '2025-01-05 18:27:25', NULL, '01-2025', NULL),
	(64, '11', NULL, NULL, NULL, 16, '8', '1', '8000', '2025-01-05 18:47:05', NULL, '01-2025', NULL),
	(65, '4', NULL, NULL, NULL, 16, '7', '1', '26000', '2025-01-05 18:46:54', NULL, '01-2025', NULL),
	(66, '16', NULL, NULL, NULL, 1, '3', '1', '45500', '2025-01-14 17:32:11', NULL, '01-2025', NULL),
	(67, '3', NULL, NULL, NULL, 3, '5', '1', '5000', '2025-01-16 13:28:37', NULL, '01-2025', NULL),
	(68, '11', NULL, NULL, NULL, 3, '8', '3', '24000', '2025-01-16 13:27:45', NULL, '01-2025', NULL),
	(69, '5', NULL, NULL, NULL, 3, '1', '2', '30000', '2025-01-16 13:27:19', NULL, '01-2025', NULL),
	(70, '4', NULL, NULL, NULL, 3, '7', '2', '52000', '2025-01-17 16:17:35', NULL, '01-2025', NULL),
	(71, '171', NULL, NULL, NULL, 3, '39', '10', '210', '2025-01-17 16:18:55', NULL, '01-2025', NULL),
	(72, '12', NULL, NULL, NULL, 3, '2', '2', '32000', '2025-01-20 16:46:30', NULL, '01-2025', NULL),
	(73, '173', NULL, NULL, NULL, 3, '37', '5', '61500', '2025-01-20 18:01:36', NULL, '01-2025', NULL),
	(74, '174', NULL, NULL, NULL, 3, '18', '6', '12054', '2025-01-20 18:05:37', NULL, '01-2025', NULL),
	(75, '175', NULL, NULL, NULL, 3, '37', '2', '24000', '2025-01-21 09:24:46', NULL, '01-2025', NULL),
	(76, '14', NULL, NULL, NULL, 3, '3', '1', '49500', '2025-01-21 10:48:54', NULL, '01-2025', NULL),
	(77, '18', NULL, NULL, NULL, 3, '7', '1', '26000', '2025-01-21 10:48:47', NULL, '01-2025', NULL),
	(78, '4', NULL, NULL, NULL, 3, '7', '1', '26000', '2025-01-21 10:48:33', NULL, '01-2025', NULL),
	(79, '4', NULL, NULL, NULL, 3, '7', '1', '26000', '2025-01-21 11:01:33', NULL, '01-2025', NULL),
	(80, '15', NULL, NULL, NULL, 3, '3', '2', '103000', '2025-01-21 11:01:25', NULL, '01-2025', NULL),
	(81, '5', NULL, NULL, NULL, 3, '1', '2', '30000', '2025-01-21 11:10:59', NULL, '01-2025', NULL),
	(82, '4', NULL, NULL, NULL, 3, '7', '2', '52000', '2025-01-21 11:10:51', NULL, '01-2025', NULL),
	(83, '11', NULL, NULL, NULL, 3, '8', '4', '32000', '2025-01-21 11:16:19', '', '01-2025', NULL),
	(84, '14', NULL, NULL, NULL, 3, '3', '1', '49500', '2025-01-21 11:16:24', '', '01-2025', NULL),
	(85, '14', NULL, NULL, NULL, 3, '3', '1', '49500', '2025-01-21 11:16:24', NULL, '01-2025', NULL),
	(86, '11', NULL, NULL, NULL, 3, '8', '4', '32000', '2025-01-21 11:16:19', NULL, '01-2025', NULL),
	(87, '16', NULL, NULL, NULL, 3, '3', '2', '91000', '2025-01-21 11:20:44', '', '01-2025', NULL),
	(88, '32', NULL, NULL, NULL, 3, '18', '4', '4000', '2025-01-21 11:21:01', '', '01-2025', NULL),
	(89, '32', NULL, NULL, NULL, 3, '18', '4', '4000', '2025-01-21 11:21:01', NULL, '01-2025', NULL),
	(90, '16', NULL, NULL, NULL, 3, '3', '2', '91000', '2025-01-21 11:20:44', NULL, '01-2025', NULL),
	(91, '33', NULL, NULL, NULL, 3, '18', '10', '10000', '2025-01-21 11:22:41', '', '01-2025', NULL),
	(92, '32', NULL, NULL, NULL, 3, '18', '4', '4000', '2025-01-21 11:22:50', '', '01-2025', NULL),
	(93, '32', NULL, NULL, NULL, 3, '18', '4', '4000', '2025-01-21 11:22:50', NULL, '01-2025', NULL),
	(94, '33', NULL, NULL, NULL, 3, '18', '10', '10000', '2025-01-21 11:22:41', NULL, '01-2025', NULL),
	(95, '17', NULL, NULL, NULL, 3, '2', '2', '48000', '2025-01-21 11:30:16', '', '01-2025', NULL),
	(96, '15', NULL, NULL, NULL, 3, '3', '1', '51500', '2025-01-21 11:30:19', '', '01-2025', NULL),
	(97, '17', NULL, NULL, NULL, 3, '2', '2', '48000', '2025-01-21 11:30:39', '', '01-2025', NULL),
	(98, '13', NULL, NULL, NULL, 3, '10', '5', '14980', '2025-01-21 11:30:49', '', '01-2025', NULL),
	(99, '13', NULL, NULL, NULL, 3, '10', '5', '14980', '2025-01-21 11:30:49', NULL, '01-2025', NULL),
	(100, '17', NULL, NULL, NULL, 3, '2', '2', '48000', '2025-01-21 11:30:39', NULL, '01-2025', NULL),
	(101, '18', NULL, NULL, NULL, 3, '7', '2', '52000', '2025-01-21 11:41:17', 'TR0001', '01-2025', NULL),
	(102, '3', NULL, NULL, NULL, 3, '5', '1', '5000', '2025-01-21 11:41:22', 'TR0001', '01-2025', NULL),
	(103, '5', NULL, NULL, NULL, 3, '1', '2', '30000', '2025-01-21 11:45:13', 'TR0002', '01-2025', NULL),
	(104, '18', NULL, NULL, NULL, 3, '7', '2', '52000', '2025-01-21 11:45:08', 'TR0002', '01-2025', NULL);

-- Dumping structure for table db_toko.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_produk` varchar(255) NOT NULL,
  `id_user` int NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `kode_nota` varchar(20) DEFAULT NULL,
  `stok_awal` int DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toko.penjualan: ~0 rows (approximately)

-- Dumping structure for table db_toko.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int NOT NULL,
  `kode_kategori` varchar(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `FK_produk1_kategori` (`id_kategori`),
  CONSTRAINT `FK_produk1_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_toko.produk: ~48 rows (approximately)
REPLACE INTO `produk` (`id_produk`, `id_kategori`, `kode_kategori`, `kode_produk`, `nama_produk`) VALUES
	(1, 2, 'SM', 'SM01', 'Beras'),
	(2, 2, 'SM', 'SM02', 'Gula'),
	(3, 2, 'SM', 'SM03', 'Minyak Goreng'),
	(4, 1, 'MM', 'MM01', 'Biskuit'),
	(5, 4, 'AT', 'AT01', 'Pensil'),
	(6, 3, 'RK', 'RK01', 'Korek'),
	(7, 3, 'RK', 'RK02', 'Rokok'),
	(8, 2, 'SM', 'SM04', 'Telur'),
	(10, 4, 'AT', 'AT02', 'Bulpen'),
	(13, 4, 'AT', 'AT03', 'Penghapus'),
	(14, 4, 'AT', 'AT04', 'Penggaris'),
	(15, 1, 'MM', 'MM02', 'Mie Instan'),
	(16, 2, 'SM', 'SM05', 'Susu'),
	(17, 2, 'SM', 'SM06', 'Tepung Terigu'),
	(18, 16, 'BM', 'BM01', 'Bumbu Instan'),
	(19, 1, 'MM', 'MM03', 'Air Mineral'),
	(20, 1, 'MM', 'MM04', 'Teh Botol'),
	(21, 1, 'MM', 'MM05', 'Kopi Botol'),
	(30, 19, 'PR', 'PR01', 'Sabun Cuci Piring'),
	(31, 19, 'PR', 'PR02', 'Detergen'),
	(32, 19, 'PR', 'PR03', 'Pewangi Pakaian'),
	(33, 19, 'PR', 'PR04', 'Pembersih Lantai'),
	(34, 19, 'PR', 'PR05', 'Sikat Gigi'),
	(35, 19, 'PR', 'PR06', 'Pasta Gigi'),
	(36, 19, 'PR', 'PR07', 'Tisu'),
	(37, 20, 'PK', 'PK01', 'Sabun Mandi'),
	(38, 20, 'PK', 'PK02', 'Shampo'),
	(39, 20, 'PK', 'PK03', 'Deodoran'),
	(40, 20, 'PK', 'PK04', 'Pembalut Wanita'),
	(41, 20, 'PK', 'PK05', 'Popok Bayi'),
	(42, 1, 'MM', 'MM06', 'Keripik'),
	(43, 1, 'MM', 'MM07', 'Wafer'),
	(44, 1, 'MM', 'MM08', 'Roti'),
	(46, 1, 'MM', 'MM09', 'Minuman Sachet'),
	(48, 17, 'OA', 'OA01', 'Obat Pereda Nyeri'),
	(49, 17, 'OA', 'OA02', 'Obat Batuk & PIlek'),
	(50, 17, 'OA', 'OA03', 'Obat Sakit Perut'),
	(51, 17, 'OA', 'OA04', 'Obat Luka'),
	(52, 17, 'OA', 'OA05', 'Obat Gatal '),
	(53, 17, 'OA', 'OA06', 'Obat Otot & Sendi'),
	(54, 17, 'OA', 'OA07', 'Obat Mata'),
	(55, 17, 'OA', 'OA08', 'Obat Herbal'),
	(56, 4, 'AT', 'AT05', 'Spidol'),
	(57, 4, 'AT', 'AT06', 'Buku Tulis'),
	(58, 4, 'AT', 'AT07', 'Buku Gambar'),
	(59, 4, 'AT', 'AT08', 'Tipe-X'),
	(60, 4, 'AT', 'AT09', 'Amplop'),
	(61, 4, 'AT', 'AT10', 'Tali Rafiah'),
	(62, 16, 'BM', 'BM02', 'Saus Tomat'),
	(63, 16, 'BM', 'BM03', 'Saus Sambal'),
	(64, 16, 'BM', 'BM04', 'Kecap'),
	(65, 16, 'BM', 'BM05', 'Penyedap Rasa'),
	(66, 16, 'BM', 'BM06', 'Margarin'),
	(67, 1, 'MM', 'MM10', 'Permen');

-- Dumping structure for table db_toko.satuan
CREATE TABLE IF NOT EXISTS `satuan` (
  `id_satuan` int NOT NULL AUTO_INCREMENT,
  `satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_toko.satuan: ~0 rows (approximately)

-- Dumping structure for table db_toko.toko
CREATE TABLE IF NOT EXISTS `toko` (
  `id_toko` int NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toko.toko: ~0 rows (approximately)
REPLACE INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`) VALUES
	(1, 'TOKO SRC BU HERLIN', 'SIDOARJO', '08123456879', 'Bu Herlin');

-- Dumping structure for table db_toko.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('Superuser','Admin','Member') DEFAULT 'Member',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_toko.user: ~4 rows (approximately)
REPLACE INTO `user` (`id_user`, `nama`, `alamat`, `email`, `no_telp`, `gambar`, `role`, `username`, `password`) VALUES
	(1, 'wahyu', 'Jombang', 'wahyu@gmail.com', NULL, NULL, 'Superuser', 'wahyu', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 'herlina', 'Sidoarjo', 'herlina@gmail.com', '08532121', NULL, 'Admin', 'herlina', '21232f297a57a5a743894a0e4a801fc3'),
	(3, 'RizkyNur', 'Sidoarjo', 'rizkynura@gmail.com', '085423523', NULL, 'Member', 'RizkyNur', '202cb962ac59075b964b07152d234b70'),
	(6, 'Zidny', 'Sidoarjo', 'zidny@gmail.com', '085623212', NULL, 'Member', 'zidny', '81dc9bdb52d04dc20036dbd8313ed055'),
	(7, 'adi', 'sda', 'aditio@gmail.com', '085335638080', NULL, 'Member', 'adi', '202cb962ac59075b964b07152d234b70');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
