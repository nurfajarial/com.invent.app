--
-- Database: `simstok_tes3`
--
DROP DATABASE IF EXISTS `simstok_tes3`;
CREATE DATABASE IF NOT EXISTS `simstok_tes3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `simstok_tes3`;

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
CREATE TABLE IF NOT EXISTS `audit_log` (
  `id_log` int(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `aksi` varchar(20) NOT NULL,
  `data_lama` varchar(30) NOT NULL,
  `data_baru` varchar(30) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `tabel` varchar(30) NOT NULL,
  `alat` varchar(30) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time(5) NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id_log`, `user`, `aksi`, `data_lama`, `data_baru`, `jumlah`, `tabel`, `alat`, `IP`, `tanggal`, `jam`) VALUES
(1, 'Gudang1', 'login', '', '', '', 'karyawan', '', '', '2021-11-30', '08:27:00.00000'),
(2, 'Gudang1', 'logout', '', '', '', 'karyawan', '', '', '2021-11-30', '08:29:00.00000'),
(3, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-11-30', '15:00:00.00000'),
(4, 'admin', 'INSERT', '', '0000U43J20', '', 'barang', '', '', '2021-11-30', '09:09:00.00000'),
(5, 'admin', 'UPDATE', '0000U43J20', '0000U43J20', '', 'barang', '', '', '2021-11-30', '15:55:00.00000'),
(6, 'admin', 'DELETE', '0000U43J20', '', '', 'barang', '', '', '2021-11-30', '16:59:00.00000'),
(7, 'admin', 'UPDATE', '0000U41J20', '0000U41J20', '', 'barang', '', '', '2021-11-30', '17:37:00.00000'),
(8, 'admin', 'UPDATE', '0000U41J20', '0000U41J20', '', 'barang', '', '', '2021-11-30', '17:38:00.00000'),
(9, 'admin', 'UPDATE', '0000U41J20', '0000U41J20', '', 'barang', '', '', '2021-11-30', '17:39:00.00000'),
(10, 'admin', 'UPDATE', '0000U41J20', '', '', 'barang', '', '', '2021-11-30', '17:52:00.00000'),
(11, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-11-30', '17:53:00.00000'),
(12, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-03', '22:52:00.00000'),
(13, 'admin', 'INSERT', '', '0000U39J20', '', 'stok', '', '', '2021-12-01', '15:40:00.00000'),
(14, 'admin', 'INSERT', '', '3 Lubang', '', 'ukuran_barang', '', '', '2021-12-01', '16:21:00.00000'),
(15, 'admin', 'INSERT', '', '4 Lubang', '', 'ukuran_barang', '', '', '2021-12-01', '16:22:00.00000'),
(16, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'barang', '', '', '2021-12-01', '16:23:00.00000'),
(17, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'barang', '', '', '2021-12-01', '16:29:00.00000'),
(18, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-01', '16:31:00.00000'),
(19, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-01', '22:51:00.00000'),
(20, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-04', '08:41:00.00000'),
(21, 'admin', 'INSERT', '', '100', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '02:42:00.00000'),
(22, 'admin', 'INSERT', '', '100', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '03:27:00.00000'),
(23, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-04', '09:40:00.00000'),
(24, 'Gudang1', 'login', '', '', '', 'karyawan', '', '', '2021-12-04', '09:40:00.00000'),
(25, 'Gudang1', 'logout', '', '', '', 'karyawan', '', '', '2021-12-04', '09:42:00.00000'),
(26, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-04', '09:43:00.00000'),
(27, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-04', '04:08:00.00000'),
(28, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-04', '04:09:00.00000'),
(29, 'admin', 'INSERT', '', '100', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '04:13:00.00000'),
(30, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '05:56:00.00000'),
(31, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '05:56:00.00000'),
(32, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '05:59:00.00000'),
(33, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '05:59:00.00000'),
(34, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '06:17:00.00000'),
(35, 'admin', 'INSERT', '', '', '100', 'mutasi_masuk', '', '', '2021-12-04', '13:48:00.00000'),
(36, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '13:48:00.00000'),
(37, 'admin', 'INSERT', '', '', '100', 'mutasi_masuk', '', '', '2021-12-04', '13:49:00.00000'),
(38, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '13:49:00.00000'),
(39, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-04', '14:03:00.00000'),
(40, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '14:03:00.00000'),
(41, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '14:03:00.00000'),
(42, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-04', '08:03:00.00000'),
(43, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-04', '08:04:00.00000'),
(44, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '08:04:00.00000'),
(45, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-04', '14:24:00.00000'),
(46, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '14:24:00.00000'),
(47, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '14:24:00.00000'),
(48, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '08:26:00.00000'),
(49, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-04', '14:26:00.00000'),
(50, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-04', '17:50:00.00000'),
(51, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-04', '17:55:00.00000'),
(52, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '17:55:00.00000'),
(53, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '17:55:00.00000'),
(54, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '11:57:00.00000'),
(55, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-04', '17:59:00.00000'),
(56, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-04', '18:01:00.00000'),
(57, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '18:01:00.00000'),
(58, 'admin', 'INSERT', '', '', '50', 'temp_mutasi_masuk', '', '', '2021-12-04', '12:04:00.00000'),
(59, 'admin', 'INSERT', '', '', '20', 'temp_mutasi_masuk', '', '', '2021-12-04', '12:05:00.00000'),
(60, 'admin', 'INSERT', '', '', '10', 'temp_mutasi_masuk', '', '', '2021-12-04', '12:10:00.00000'),
(61, 'admin', 'INSERT', '', '', '5', 'temp_mutasi_keluar', '', '', '2021-12-04', '12:44:00.00000'),
(62, 'admin', 'INSERT', '', '', '2', 'temp_mutasi_keluar', '', '', '2021-12-04', '12:54:00.00000'),
(63, 'admin', 'INSERT', '', 'M1211T530U110J17', '10', 'mutasi_masuk', '', '', '2021-12-04', '19:00:00.00000'),
(64, 'admin', 'UPDATE', '100', '110', '10', 'stok', '', '', '2021-12-04', '19:00:00.00000'),
(65, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '19:00:00.00000'),
(66, 'admin', 'INSERT', '', '', '', 'mutasi_keluar', '', '', '2021-12-04', '19:01:00.00000'),
(67, 'admin', 'UPDATE', '', '0', '', 'stok', '', '', '2021-12-04', '19:01:00.00000'),
(68, 'admin', 'DELETE', '', '', '', 'temp_mutasi_keluar', '', '', '2021-12-04', '19:01:00.00000'),
(69, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-04', '13:06:00.00000'),
(70, 'admin', 'INSERT', '', 'M1211T530U110J17', '', 'stok', '', '', '2021-12-04', '13:07:00.00000'),
(71, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-04', '13:08:00.00000'),
(72, 'admin', 'INSERT', '', '', '50', 'temp_mutasi_masuk', '', '', '2021-12-04', '13:08:00.00000'),
(73, 'admin', 'INSERT', '', '', '50', 'temp_mutasi_masuk', '', '', '2021-12-04', '13:09:00.00000'),
(74, 'admin', 'INSERT', '', 'M1211T530U110J17', '50', 'mutasi_masuk', '', '', '2021-12-04', '19:09:00.00000'),
(75, 'admin', 'UPDATE', '0', '50', '50', 'stok', '', '', '2021-12-04', '19:09:00.00000'),
(76, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-04', '19:09:00.00000'),
(77, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-04', '19:09:00.00000'),
(78, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-05', '09:23:00.00000'),
(79, 'admin', 'INSERT', '', '', '100', 'temp_mutasi_masuk', '', '', '2021-12-05', '04:35:00.00000'),
(80, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-05', '10:36:00.00000'),
(81, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-05', '10:36:00.00000'),
(82, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-05', '10:36:00.00000'),
(83, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-05', '10:41:00.00000'),
(84, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-05', '10:41:00.00000'),
(85, 'admin', 'DELETE', '', '', '', 'temp_mutasi_masuk', '', '', '2021-12-05', '10:41:00.00000'),
(86, 'admin', 'INSERT', '', 'M1211T530U110J17', '100', 'mutasi_masuk', '', '', '2021-12-05', '10:43:00.00000'),
(87, 'admin', 'UPDATE', '0', '100', '100', 'stok', '', '', '2021-12-05', '10:43:00.00000'),
(88, 'admin', 'DELETE', 'M1211T530U110J17', '', '', 'temp_mutasi_masuk', '', '', '2021-12-05', '10:43:00.00000'),
(89, 'admin', 'INSERT', '', '', '50', 'temp_mutasi_masuk', '', '', '2021-12-05', '04:44:00.00000'),
(90, 'admin', 'INSERT', '', '', '25', 'temp_mutasi_masuk', '', '', '2021-12-05', '04:44:00.00000'),
(91, 'admin', 'INSERT', '', '', '50', 'temp_mutasi_masuk', '', '', '2021-12-05', '04:47:00.00000'),
(92, 'admin', 'INSERT', '', '', '25', 'temp_mutasi_masuk', '', '', '2021-12-05', '04:47:00.00000'),
(93, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-05', '11:26:00.00000'),
(94, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-10', '13:31:00.00000'),
(95, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-10', '13:47:00.00000'),
(96, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-10', '13:47:00.00000'),
(97, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-11', '19:21:00.00000'),
(98, 'admin', 'DELETE', '0000U41J20', '', '', 'barang', '', '', '2021-12-11', '19:23:00.00000'),
(99, 'admin', 'DELETE', '0000U39J20', '', '', 'barang', '', '', '2021-12-11', '19:23:00.00000'),
(100, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '', '2021-12-11', '13:24:00.00000'),
(101, 'admin', 'DELETE', 'M1211000J17', '', '', 'barang', '', '', '2021-12-11', '19:26:00.00000'),
(102, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '', '2021-12-11', '13:30:00.00000'),
(103, 'admin', 'INSERT', '', '0000U39J20', '', 'barang', '', '', '2021-12-11', '13:31:00.00000'),
(104, 'admin', 'INSERT', '', '0000U47J20', '', 'barang', '', '', '2021-12-11', '13:31:00.00000'),
(105, 'admin', 'UPDATE', 'M1211000J17', '', '', 'barang', '', '', '2021-12-11', '19:40:00.00000'),
(106, 'admin', 'UPDATE', 'M1211000J17', '', '', 'barang', '', '', '2021-12-11', '20:00:00.00000'),
(107, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-11', '21:41:00.00000'),
(108, 'admin', 'login', '', '', '', 'karyawan', '', '', '2021-12-12', '14:36:00.00000'),
(109, 'admin', 'logout', '', '', '', 'karyawan', '', '', '2021-12-12', '15:50:00.00000'),
(110, 'admin', 'logout', '', '', '', '', '', '::1', '2021-12-13', '21:31:00.00000'),
(111, 'admin', 'logout', '', '', '', '', '', '::1', '2021-12-13', '21:46:00.00000'),
(112, 'admin', 'logout', '', '', '', '', '', '::1', '2021-12-13', '22:09:00.00000'),
(113, 'admin', 'login', '', '', '', '', '', '::1', '2021-12-13', '16:11:00.00000'),
(114, 'admin', 'login', '', '', '', '', 'mobile', '::1', '2021-12-19', '00:03:00.00000'),
(115, 'admin', 'logout', '', '', '', '', 'mobile', '::1', '2021-12-19', '00:39:00.00000'),
(116, 'admin', 'login', '', '', '', '', 'mobile', '::1', '2021-12-19', '00:39:00.00000'),
(117, 'admin', 'logout', '', '', '', '', 'mobile', '::1', '2021-12-19', '00:40:00.00000'),
(118, 'admin', 'login', '', '', '', '', 'computer', '::1', '2021-12-19', '00:41:00.00000'),
(119, 'admin', 'UPDATE', '0000U47J20', '', '', 'barang', '', '::1', '2021-12-19', '01:08:00.00000'),
(120, 'admin', 'UPDATE', '0000U47J20', '', '', 'barang', '', '::1', '2021-12-19', '01:09:00.00000'),
(121, 'admin', 'UPDATE', '0000U47J20', '', '', 'barang', '', '::1', '2021-12-19', '01:09:00.00000'),
(122, 'admin', 'UPDATE', '0000U47J20', '', '', 'barang', '', '::1', '2021-12-19', '01:17:00.00000'),
(123, 'admin', 'UPDATE', '0000U47J20', '', '', 'barang', '', '::1', '2021-12-19', '01:23:00.00000'),
(124, 'admin', 'logout', '', '', '', '', 'computer', '::1', '2021-12-19', '01:26:00.00000'),
(125, 'admin', 'login', '', '', '', '', 'computer', '::1', '2021-12-19', '10:36:00.00000'),
(126, 'admin', 'DELETE', '0000U47J20', '', '', 'barang', '', '::1', '2021-12-19', '10:37:00.00000'),
(127, 'admin', 'DELETE', '0000U47J20', '', '', 'stok', '', '::1', '2021-12-19', '10:37:00.00000'),
(128, 'admin', 'DELETE', '0000U39J20', '', '', 'barang', 'computer', '::1', '2021-12-19', '10:45:00.00000'),
(129, 'admin', 'DELETE', '0000U39J20', '', '', 'stok', '', '::1', '2021-12-19', '10:45:00.00000'),
(130, 'admin', 'DELETE', 'M1211000J17', '', '', 'barang', 'computer', '::1', '2021-12-19', '10:45:00.00000'),
(131, 'admin', 'DELETE', 'M1211000J17', '', '', 'stok', '', '::1', '2021-12-19', '10:45:00.00000'),
(132, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '::1', '2021-12-19', '04:49:00.00000'),
(133, 'admin', 'DELETE', 'M1211000J17', '', '', 'barang', 'computer', '::1', '2021-12-19', '11:00:00.00000'),
(134, 'admin', 'DELETE', 'M1211000J17', '', '', 'stok', 'computer', '::1', '2021-12-19', '11:00:00.00000'),
(135, 'admin', 'INSERT', '', 'M12110000', '', 'barang', '', '::1', '2021-12-19', '05:02:00.00000'),
(136, 'admin', 'DELETE', 'M12110000', '', '', 'barang', 'computer', '::1', '2021-12-19', '11:02:00.00000'),
(137, 'admin', 'DELETE', 'M12110000', '', '', 'stok', 'computer', '::1', '2021-12-19', '11:02:00.00000'),
(138, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '::1', '2021-12-19', '05:08:00.00000'),
(139, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '::1', '2021-12-19', '05:10:00.00000'),
(140, 'admin', 'DELETE', 'M1211000J17', '', '', 'barang', 'computer', '::1', '2021-12-19', '11:11:00.00000'),
(141, 'admin', 'DELETE', 'M1211000J17', '', '', 'stok', 'computer', '::1', '2021-12-19', '11:11:00.00000'),
(142, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '::1', '2021-12-19', '05:12:00.00000'),
(143, 'admin', 'DELETE', 'M1211000J17', '', '', 'barang', 'computer', '::1', '2021-12-19', '11:13:00.00000'),
(144, 'admin', 'DELETE', 'M1211000J17', '', '', 'stok', 'computer', '::1', '2021-12-19', '11:13:00.00000'),
(145, 'admin', 'INSERT', '', 'M1211000J17', '', 'barang', '', '::1', '2021-12-19', '05:48:00.00000'),
(146, 'admin', 'INSERT', '', 'M1212000J17', '', 'barang', '', '::1', '2021-12-19', '05:49:00.00000'),
(147, 'admin', 'INSERT', '', '0000U39J20', '', 'barang', '', '::1', '2021-12-19', '05:52:00.00000'),
(148, 'admin', 'INSERT', '', '0000U40J20', '', 'barang', '', '::1', '2021-12-19', '05:52:00.00000'),
(0, 'admin', 'login', '', '', '', '', 'mobile', '127.0.0.1', '2022-02-21', '07:33:00.00000');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `idbarang` int(5) NOT NULL,
  `kode_merk` varchar(20) DEFAULT NULL,
  `kode_model` varchar(20) DEFAULT NULL,
  `kode_tipe` varchar(20) DEFAULT NULL,
  `kode_seri` varchar(20) DEFAULT NULL,
  `kode_ukuran` varchar(20) DEFAULT NULL,
  `kode_warna` varchar(20) DEFAULT NULL,
  `kode_jenis` varchar(20) DEFAULT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `kode_serial` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `idgambar` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`idbarang`),
  KEY `kode_merk` (`kode_merk`),
  KEY `kode_model` (`kode_model`),
  KEY `kode_tipe` (`kode_tipe`),
  KEY `kode_seri` (`kode_seri`),
  KEY `kode_ukuran` (`kode_ukuran`),
  KEY `kode_warna` (`kode_warna`),
  KEY `kode_jenis` (`kode_jenis`),
  KEY `kode_barang` (`kode_barang`),
  KEY `kode_serial` (`kode_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `do_detail`
--

DROP TABLE IF EXISTS `do_detail`;
CREATE TABLE IF NOT EXISTS `do_detail` (
  `kode_do` varchar(15) NOT NULL,
  `sesi` int(5) NOT NULL,
  `tanggal_do` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_jual` int(5) NOT NULL,
  `harga` int(5) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `do_detail_temp`
--

DROP TABLE IF EXISTS `do_detail_temp`;
CREATE TABLE IF NOT EXISTS `do_detail_temp` (
  `kode_do` varchar(15) NOT NULL,
  `sesi` int(5) NOT NULL,
  `tanggal_do` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_jual` int(5) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

DROP TABLE IF EXISTS `jenis_barang`;
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `idjenis` int(255) NOT NULL,
  `kode_jenis` varchar(20) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`idjenis`, `kode_jenis`, `nama_jenis`, `keterangan`) VALUES
(1, '0', '0', '-'),
(2, 'J1', 'Adaptor', '-'),
(3, 'J2', 'Bor', '-'),
(4, 'J3', 'Dispenser', '-'),
(5, 'J4', 'Fischer', '-'),
(6, 'J5', 'Kabel', '-'),
(7, 'J6', 'Kap Lampu', '-'),
(8, 'J7', 'Kipas Angin', '-'),
(9, 'J8', 'Klem', '-'),
(10, 'J9', 'Lampu', '-'),
(11, 'J10', 'Obeng', '-'),
(12, 'J11', 'Paku', '-'),
(13, 'J12', 'Paku Klem', '-'),
(14, 'J13', 'Panel', '-'),
(15, 'J14', 'Pipa / Selang AC', '-'),
(16, 'J15', 'Pompa Air', '-'),
(17, 'J16', 'Radar Torrent', '-'),
(18, 'J17', 'Saklar', '-'),
(19, 'J18', 'Stop Kontak', '-'),
(20, 'J19', 'Tang', '-'),
(21, 'J20', 'Fleksibel', '');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `kode_user` int(3) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `temp_pass` varchar(50) NOT NULL,
  `kode_level` int(2) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(6) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(12) NOT NULL,
  `no_hp1` varchar(15) NOT NULL,
  `no_hp2` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`kode_user`, `user`, `password`, `temp_pass`, `kode_level`, `nama_karyawan`, `tanggal_lahir`, `jenis_kelamin`, `nik`, `alamat`, `status`, `no_hp1`, `no_hp2`) VALUES
(1, 'admin', '86630c8cb0a331f1735f3176dd1e8988', 'R4h4si4', 1, 'admin', '1980-01-14', 'Pria', '-', '-', 'Belum Kawin', '-', '-'),
(19, 'wawan_26', 'b59d25f1878f147f1257785073c57eeb', '26082000', 3, 'wawan', '2000-08-26', 'Pria', '-', '', 'Belum Kawin', '081460939025', 'hp2'),
(20, 'rahul_12', '1e37cc79838252c46c2a7fc86cb6068b', '151477', 3, 'rahul gunawan andriansah', '2000-05-10', 'Pria', '-', '', 'Belum Kawin', '088298521992', 'hp2'),
(22, 'yeni_85', '15718b22f492bc09d08dc62fae93b261', '070385', 2, 'yeni', '2021-02-07', 'Wanita', '-', '', 'Kawin', '083871300625', 'hp2'),
(24, 'Gudang1', '303ad311f70e9fb8954877cb370fbb63', 'gudang1', 3, 'Bagian gudang', '2021-03-13', 'Pria', '-', '', 'Kawin', '-', 'hp2'),
(25, 'rivany', '8edadf4bbd8528ab71ed3ecbd02e553d', '190303', 3, 'vany', '2003-03-19', 'Wanita', '-', '', 'Belum Kawin', '089538530009', 'hp2'),
(26, 'heri', 'b8b9c74ac526fffbeb2d39ab038d1cd7', '2904', 3, 'heriwanto', '1989-04-29', 'Pria', '-', '', 'Kawin', '081575598178', 'hp2'),
(27, 'maisaroh', 'b6c3598bf05bce0c015d8069fa3611f0', 'may121212', 2, 'Maisaroh', '1995-01-12', 'Wanita', '-', '', 'Belum Kawin', '088809832933', 'hp2');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `kode_level` int(2) NOT NULL,
  `jenis_level` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`kode_level`, `jenis_level`, `keterangan`) VALUES
(1, 'Admin', '-'),
(2, 'Manager', '-'),
(3, 'Gudang', '-');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE IF NOT EXISTS `lokasi` (
  `kode_lokasi` int(5) NOT NULL,
  `nama_lokasi` varchar(15) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`kode_lokasi`, `nama_lokasi`, `keterangan`) VALUES
(1, 'Gudang', '-'),
(2, 'Toko', '-');

-- --------------------------------------------------------

--
-- Table structure for table `merk_barang`
--

DROP TABLE IF EXISTS `merk_barang`;
CREATE TABLE IF NOT EXISTS `merk_barang` (
  `idmerk` int(255) NOT NULL,
  `kode_merk` varchar(20) NOT NULL,
  `nama_merk` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merk_barang`
--

INSERT INTO `merk_barang` (`idmerk`, `kode_merk`, `nama_merk`, `keterangan`) VALUES
(1, '0', '0', '-'),
(2, 'M1', 'Agota', '-'),
(3, 'M2', 'Allison', '-'),
(4, 'M3', 'Allumia', '-'),
(5, 'M4', 'ATN', '-'),
(6, 'M5', 'Beetster', '-'),
(7, 'M6', 'Belden', '-'),
(8, 'M7', 'Benelock', '-'),
(9, 'M8', 'Bite', '-'),
(10, 'M9', 'Boss', '-'),
(11, 'M10', 'Bossecom', '-'),
(12, 'M11', 'Bright-G', '-'),
(13, 'M12', 'Broco', '-'),
(14, 'M13', 'Buana', '-'),
(15, 'M14', 'Camel', '-'),
(16, 'M15', 'Cisal', '-'),
(17, 'M16', 'COM', '-'),
(18, 'M17', 'Comscope', '-'),
(19, 'M18', 'Cosmos', '-'),
(20, 'M19', 'Cyber', '-'),
(21, 'M20', 'Destec Com', '-'),
(22, 'M21', 'Dexton', '-'),
(23, 'M22', 'DLX', '-'),
(24, 'M23', 'Dutron', '-'),
(25, 'M24', 'Eclat', '-'),
(26, 'M25', 'Ecolink', '-'),
(27, 'M26', 'Ecova', '-'),
(28, 'M27', 'E-Lite', '-'),
(29, 'M28', 'Eterna', '-'),
(30, 'M29', 'Fantas', '-'),
(31, 'M30', 'Fatro', '-'),
(32, 'M31', 'Fujika', '-'),
(33, 'M32', 'Goal', '-'),
(34, 'M33', 'Goodchip', '-'),
(35, 'M34', 'Hager', '-'),
(36, 'M35', 'Hanlite', '-'),
(37, 'M36', 'Hannochs', '-'),
(38, 'M37', 'Harson', '-'),
(39, 'M38', 'Heraton', '-'),
(40, 'M39', 'Hi-cook', '-'),
(41, 'M40', 'Hiled', '-'),
(42, 'M41', 'Hippo', '-'),
(43, 'M42', 'Hoda', '-'),
(44, 'M43', 'Holic', '-'),
(45, 'M44', 'Holylux', '-'),
(46, 'M45', 'Hoover', '-'),
(47, 'M46', 'Hot Melt', '-'),
(48, 'M47', 'Hyundai', '-'),
(49, 'M48', 'Imac', '-'),
(50, 'M49', 'In-Lite', '-'),
(51, 'M50', 'Intech', '-'),
(52, 'M51', 'Intra', '-'),
(53, 'M52', 'Intracom', '-'),
(54, 'M53', 'Jembo', '-'),
(55, 'M54', 'Kadeka', '-'),
(56, 'M55', 'Kido', '-'),
(57, 'M56', 'Kim', '-'),
(58, 'M57', 'Kingtas', '-'),
(59, 'M58', 'Kiss', '-'),
(60, 'M59', 'Kitani', '-'),
(61, 'M60', 'Kyuzuku', '-'),
(62, 'M61', 'Liper', '-'),
(63, 'M62', 'Lotus', '-'),
(64, 'M63', 'Lumment', '-'),
(65, 'M64', 'Mammoth', '-'),
(66, 'M65', 'Masko', '-'),
(67, 'M66', 'Maspion', '-'),
(68, 'M67', 'Meval', '-'),
(69, 'M68', 'Mikawa', '-'),
(70, 'M69', 'Mikiyo', '-'),
(71, 'M70', 'Minato', '-'),
(72, 'M71', 'Mitsubishi', '-'),
(73, 'M72', 'Miyako', '-'),
(74, 'M73', 'Morenno', '-'),
(75, 'M74', 'Muraled', '-'),
(76, 'M75', 'Nagako', '-'),
(77, 'M76', 'Nichi', '-'),
(78, 'M77', 'Nicos', '-'),
(79, 'M78', 'Nikel', '-'),
(80, 'M79', 'Nomia', '-'),
(81, 'M80', 'Orion', '-'),
(82, 'M81', 'Ossio', '-'),
(83, 'M82', 'Pesona', '-'),
(84, 'M83', 'Pesonacom', '-'),
(85, 'M84', 'PF Antena', '-'),
(86, 'M85', 'Presto', '-'),
(87, 'M86', 'Prima', '-'),
(88, 'M87', 'Primax', '-'),
(89, 'M88', 'Push On', '-'),
(90, 'M89', 'Ryu', '-'),
(91, 'M90', 'Schneider', '-'),
(92, 'M91', 'Semny', '-'),
(93, 'M92', 'Shukaku', '-'),
(94, 'M93', 'Silvergas', '-'),
(95, 'M94', 'Simas', '-'),
(96, 'M95', 'Simura', '-'),
(97, 'M96', 'Star Cam', '-'),
(98, 'M97', 'Super gas', '-'),
(99, 'M98', 'Supreme', '-'),
(100, 'M99', 'SZMR', '-'),
(101, 'M100', 'Takeda', '-'),
(102, 'M101', 'Tekiro', '-'),
(103, 'M102', 'TKD', '-'),
(104, 'M103', 'TKE', '-'),
(105, 'M104', 'Toyosaki', '-'),
(106, 'M105', 'Tukuiki', '-'),
(107, 'M106', 'United', '-'),
(108, 'M107', 'Uticon', '-'),
(109, 'M108', 'Valescom', '-'),
(110, 'M109', 'VDR', '-'),
(111, 'M110', 'Venus', '-'),
(112, 'M111', 'Vikon Led', '-'),
(113, 'M112', 'Visalux', '-'),
(114, 'M113', 'Warlock', '-'),
(115, 'M114', 'WB', '-'),
(116, 'M115', 'Wigo', '-'),
(117, 'M116', 'Winglock', '-'),
(118, 'M117', 'Winngas', '-'),
(119, 'M118', 'Xtrana', '-'),
(120, 'M119', 'Yamasaki', '-'),
(121, 'M120', 'Yasuka', '-'),
(122, 'M121', 'Yimai', '-'),
(123, 'M122', 'Yunior', '-'),
(124, 'M123', 'Zetalux', '-'),
(125, 'M124', 'Zodiac', '-');

-- --------------------------------------------------------

--
-- Table structure for table `modal`
--

DROP TABLE IF EXISTS `modal`;
CREATE TABLE IF NOT EXISTS `modal` (
  `kode_modal` int(5) NOT NULL,
  `kode_beli` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `harga_beli` int(10) NOT NULL,
  `tanggal_jual1` date DEFAULT NULL,
  `harga_jual1` int(10) NOT NULL,
  `tanggal_jual2` date DEFAULT NULL,
  `harga_jual2` int(10) NOT NULL,
  `tanggal_jual3` date DEFAULT NULL,
  `harga_jual3` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `model_barang`
--

DROP TABLE IF EXISTS `model_barang`;
CREATE TABLE IF NOT EXISTS `model_barang` (
  `idmodel` int(255) NOT NULL,
  `kode_model` varchar(20) NOT NULL,
  `nama_model` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model_barang`
--

INSERT INTO `model_barang` (`idmodel`, `kode_model`, `nama_model`, `keterangan`) VALUES
(1, '0', '0', '-'),
(2, '1', '2 tungku', '-'),
(3, '2', 'Auto Fan', '-'),
(4, '3', 'Ceiling Fan', '-'),
(5, '4', 'Ceiling Fan FC-30', '-'),
(6, '5', 'Ceiling Fan F-EY1511', '-'),
(7, '6', 'Ceiling Fan YF 5601', '-'),
(8, '7', 'Desk / Wall Fan', '-'),
(9, '8', 'Desk Fan', '-'),
(10, '9', 'Duct / Dak Fan', '-'),
(11, '10', 'Exhaust Fan', '-'),
(12, '11', 'Galeo', ''),
(13, '12', 'Grand', ''),
(14, '13', 'Grand LED T5 Batten', '-'),
(15, '14', 'HD-2330', '-'),
(16, '15', 'HD-2430', '-'),
(17, '16', 'JFC09-495', '-'),
(18, '17', 'KH215303', '-'),
(19, '18', 'Led Lampu TL T5', '-'),
(20, '19', 'LED T5', '-'),
(21, '20', 'LED TL T8', '-'),
(22, '21', 'Mounted Ventilating', '-'),
(23, '22', 'Multi Bracket', '-'),
(24, '23', 'Newgee', ''),
(25, '24', 'NYA 09', '-'),
(26, '25', 'Orbit Fan / Gantung', '-'),
(27, '26', 'Orbit Fan 1 Set', '-'),
(28, '27', 'Oscilating Fan / Duduk', '-'),
(29, '28', 'Partition Fan', '-'),
(30, '29', 'PT-190 BIT', '-'),
(31, '30', 'PVC NYMHY', '-'),
(32, '31', 'Stand Fan', '-'),
(33, '32', 'SW-Panel 5620', '-'),
(34, '33', 'TC-2330', '-'),
(35, '34', 'TL T5', '-'),
(36, '35', 'Ventilating Fan', '-'),
(37, '36', 'Wall Fan', '-'),
(38, '37', 'WD-189 H', '-'),
(39, '38', 'WD-190 PH', '-'),
(40, '39', 'WD-289 HC', '-');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_keluar`
--

DROP TABLE IF EXISTS `mutasi_keluar`;
CREATE TABLE IF NOT EXISTS `mutasi_keluar` (
  `kode_mutasi_keluar` varchar(20) NOT NULL,
  `tanggal_mutasi_keluar` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_keluar` int(5) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `status_keluar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_masuk`
--

DROP TABLE IF EXISTS `mutasi_masuk`;
CREATE TABLE IF NOT EXISTS `mutasi_masuk` (
  `kode_mutasi_masuk` varchar(20) NOT NULL,
  `tanggal_mutasi_masuk` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_masuk` int(5) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `status_masuk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `omset`
--

DROP TABLE IF EXISTS `omset`;
CREATE TABLE IF NOT EXISTS `omset` (
  `kode_omset` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` date NOT NULL,
  `tahun` date NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kode_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `alamat_penagihan` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `hp1` varchar(15) NOT NULL,
  `hp2` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `npwp`, `alamat_pelanggan`, `alamat_pengiriman`, `alamat_penagihan`, `telp`, `hp1`, `hp2`, `fax`, `email`) VALUES
('CUST-002', 'PT. Tribina Panutan', '', '', '', '', '', '', '', '', ''),
('CUST-003', 'CV. Sinar Hidayah', '', '', '', '', '', '', '', '', ''),
('CUST-004', 'PT. Sefas Pelindotama', '', '', '', '', '', '', '', '', ''),
('CUST-005', 'PT. Sefas Keliantama', '', '', '', '', '', '', '', '', ''),
('CUST-006', 'PT. Sefas Energitama', '', '', '', '', '', '', '', '', ''),
('CUST1-006000001', 'PT. Wijaya Kusuma', '', '-', 'Komp. Pergudangan CIkupa Blok A No 27A', '-', '021-8883', '088219720939', '', '021-8883', 'wijayakusuma@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

DROP TABLE IF EXISTS `pemasok`;
CREATE TABLE IF NOT EXISTS `pemasok` (
  `kode_pemasok` varchar(20) NOT NULL,
  `nama_pemasok` varchar(30) NOT NULL,
  `npwp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pemasok` text NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `hp1` varchar(15) NOT NULL,
  `hp2` varchar(15) NOT NULL,
  `rek1` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rek2` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rek3` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`kode_pemasok`, `nama_pemasok`, `npwp`, `alamat_pemasok`, `kontak`, `email`, `telp`, `hp1`, `hp2`, `rek1`, `rek2`, `rek3`) VALUES
('3DMN-01-TGL', 'PT. 3D MEDIA NUSANTARA', '', 'Jakarta', '.', '.', '.', '', '', '.', '.', ''),
('AGN-01-TGL', 'PT. AUSTRALINDO GRAHA NUSA', '', 'JAKARTA', '-', '-', '-', '', '', '.', '.', '.'),
('AL-01-TGL', 'PT. ANEKA LISTRIK', '', 'JKT', 'LIPING&AHUN', '-', '-', '', '', '-', '', ''),
('BL-01-TGL', 'PT. BONA LED', '', 'JKT', 'IPUL', '-', '02164714600', '', '', '.', '.', '.'),
('CSI-01-TGL', 'PT. CATUR SUKSES INTERMASIONAL', '', 'HARCO MANGGA 2 BLOK P 28-29 MANGGA 2 SELATAN SAWAH BESAR JAKARTA PUSAT DKI JAKARTA 10730', '-', '-', '-', '', '', '06059101220', '1190067878999', '-'),
('DGE-01-TGL', 'PT. DWIMUKTI GRAHA ELEKTRINDO', '', 'JL. PANGLIMA POLIM RAYA NO.28 JAKARTA SELATAN', 'SUWI', '-', '08176062913', '', '', '-', '-', '-'),
('FL-01-TGL', 'PT. FORTUNA LISTRIK', '', 'JAKARTA', 'CI ANA', '.', '02168209686', '', '', '.', '.', '.'),
('FSM-01-TGL', 'PT. FORTINDO SUKSES MAKMUR', '', 'KOMPLEK PERGUDANGAN PRIMA CENTER BLOK F NO12 RT000 RW002 KEDAUNG KALI ANGKE CENGKARENG JAKBAR', '021-225200661-85', '-', '-', '', '', '3500850000', '-', '-'),
('HES-01-TGL', 'PT. HESINDO RAYA', '', 'JKT', 'MARNO', '-', '02155761417', '', '', '.', '.', '.'),
('JTK-01-TGL', 'PT. JATIM WATKORAYA', '', 'JAKARTA', '-', '-', '-', '', '', '-', '.', '.'),
('MG-01-TGL', 'PT. MAHKOTA GLOBALINDO', '', 'JAKARTA', '02155751240', '-', '02155751240', '', '', '-', '-', '-'),
('PSA-01-02', 'PT. PUTRA SUMBER ABADI', '', 'JL-KENARI-11-NO-5', '0213153232', '-', '0213153232', '', '', '-', '-', '-'),
('SAS-01-TGL', 'PT. SAHABAT ABADI SEJAHTERA', '', 'JKT', 'ROBY', '-', '-', '', '', '-', '-', '-'),
('SB-O1-TGL', 'PT. SURYA BLESS', '', 'JKT', 'KIKI', '-', '081297422886', '', '', '-', '-', '-'),
('SJA-00100000001', 'PT. SEKAR JAYA ABADI', '', 'Jl. Narogong Raya No. 15', 'Udin', 'sekarjayaabadi@gmail.com', '-', '', '', '.', '.', '.'),
('SK-01-TGL', 'PT. SAMUDRA KARYA', '', 'JKT', 'NANANG NUSANTORO', '-', '08176062913', '', '', '-', '-', '-'),
('SLD-01-TGL', 'PT. SURYAMAS LUMISINDO DWIDAYA', '', 'JL LET JEND SUPRAPTO GEDUNG INDRA SENTRAL BLOK AE-AG NO 60 CEMPAKA PUTIH JAKARTA PUSAT ', 'HARRYANTO', '-', '-', '', '', '.', '.', '.'),
('SP-01-01', 'PT. Sefas Pelindotama', '', '-', '-', '-', '-', '', '', '', '', ''),
('TCS-01-TGL', 'PT. TELESINDO CITRA SEJAHTERA', '', 'JKT', '-', '-', '-', '', '', '-', '-', '-'),
('TP-001000000001', 'PT. Tribina Panutan', '', 'Jl. Cilegon Raya No. 20', 'Djumadi', '-', '-', '', '', '', '', ''),
('TWS-01-TGL', 'PT. TUNAS WIJAYA SAKTI', '', 'JAKARTA', 'TIO SANTO', '-', '-', '', '', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `kode_bayar` int(2) NOT NULL,
  `hari` int(5) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`kode_bayar`, `hari`, `keterangan`) VALUES
(1, 0, 'Cash'),
(2, 7, '1 Minggu'),
(3, 30, '1 Bulan'),
(4, 60, '2 Bulan'),
(5, 90, '3 Bulan'),
(6, 120, '4 Bulan'),
(7, 150, '5 Bulan'),
(8, 180, '6 Bulan');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `kode_beli` varchar(20) NOT NULL,
  `kode_faktur` varchar(20) NOT NULL,
  `kode_do` varchar(20) NOT NULL,
  `kode_pemasok` varchar(20) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `kode_po` varchar(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `diskon` int(5) NOT NULL,
  `total` int(20) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `kode_bayar` int(2) NOT NULL,
  `tanggal_tempo` date NOT NULL,
  `no_plat` varchar(15) NOT NULL,
  `nama_supir` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penawaran`
--

DROP TABLE IF EXISTS `penawaran`;
CREATE TABLE IF NOT EXISTS `penawaran` (
  `kode_penawaran` varchar(20) CHARACTER SET latin1 NOT NULL,
  `kode_barang` varchar(20) CHARACTER SET latin1 NOT NULL,
  `kode_pelanggan` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tanggal` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `kode_jual` varchar(20) NOT NULL,
  `kode_faktur` varchar(15) NOT NULL,
  `kode_do` varchar(20) NOT NULL,
  `kode_pelanggan` varchar(20) NOT NULL,
  `tanggal_jual` date NOT NULL,
  `kode_po` varchar(15) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `kode_bayar` int(2) NOT NULL,
  `tanggal_tempo` date NOT NULL,
  `no_plat` varchar(15) NOT NULL,
  `nama_supir` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_detail`
--

DROP TABLE IF EXISTS `po_detail`;
CREATE TABLE IF NOT EXISTS `po_detail` (
  `kode_po` varchar(15) NOT NULL,
  `sesi` int(5) NOT NULL,
  `tanggal_po` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_beli` int(5) NOT NULL,
  `harga` int(5) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_detail_temp`
--

DROP TABLE IF EXISTS `po_detail_temp`;
CREATE TABLE IF NOT EXISTS `po_detail_temp` (
  `kode_po` varchar(15) NOT NULL,
  `sesi` int(5) NOT NULL,
  `tanggal_po` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_beli` int(5) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

DROP TABLE IF EXISTS `retur`;
CREATE TABLE IF NOT EXISTS `retur` (
  `kode_retur` varchar(15) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `kode_faktur` varchar(15) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `kode_pelanggan` varchar(20) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `status` varchar(15) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`kode_retur`, `tanggal_retur`, `kode_faktur`, `kode_barang`, `kode_pelanggan`, `kode_user`, `jumlah`, `status`, `keterangan`) VALUES
('RTR-2911-1711', '2021-11-29', '', 'M12110S1U2J18', 'CUST-003', 19, 1, 'Retur', 'Tukar');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

DROP TABLE IF EXISTS `satuan`;
CREATE TABLE IF NOT EXISTS `satuan` (
  `kode_satuan` int(5) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`kode_satuan`, `nama_satuan`, `keterangan`) VALUES
(1, 'rol', '1rol 50m'),
(5, 'koli 250', '250pcs'),
(6, 'Koli 300', 'Isi 300pcs'),
(7, 'pcs', 'satu buah');

-- --------------------------------------------------------

--
-- Table structure for table `seri_barang`
--

DROP TABLE IF EXISTS `seri_barang`;
CREATE TABLE IF NOT EXISTS `seri_barang` (
  `idseri` int(255) NOT NULL,
  `kode_seri` varchar(20) NOT NULL,
  `nama_seri` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seri_barang`
--

INSERT INTO `seri_barang` (`idseri`, `kode_seri`, `nama_seri`, `keterangan`) VALUES
(1, '0', '0', '-'),
(2, 'S1', 'MVF 893', '-'),
(3, 'S2', '20TGQ2', '-'),
(4, 'S3', 'CRL1101', '-'),
(5, 'S4', 'WZ56P', '-'),
(6, 'S5', 'FV-25TGU5', '-'),
(7, 'S6', 'RI-522C', '-'),
(8, 'S7', '7608', '-'),
(9, 'S8', 'MV-200 NEX', '-'),
(10, 'S9', 'PS-135 E', '-'),
(11, 'S10', '16-SDB', '-'),
(12, 'S11', '16-XDC', '-'),
(13, 'S12', 'TP-1', '-'),
(14, 'S13', 'MWF-41K', '-'),
(15, 'S14', 'EX-174S', '-'),
(16, 'S15', 'MWF-31K', '-'),
(17, 'S16', '12-BFE', '-'),
(18, 'S17', '16-COCN', '-'),
(19, 'S18', 'PW-456W', '-'),
(20, 'S19', 'PW-455W', '-'),
(21, 'S20', '16-SN', '-'),
(22, 'S21', 'HFN 1210', '-'),
(23, 'S22', 'CL120-W1V12', '-'),
(24, 'S23', 'IST 1851', '-'),
(25, 'S24', 'NCE-4501R', '-'),
(26, 'S25', 'F-WN40B-W', '-');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

DROP TABLE IF EXISTS `stok`;
CREATE TABLE IF NOT EXISTS `stok` (
  `idstok` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `kode_lokasi` int(5) NOT NULL,
  `stok_awal` int(10) NOT NULL,
  `min_stok` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `kode_satuan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE IF NOT EXISTS `tagihan` (
  `kode_tagihan` varchar(20) NOT NULL,
  `kode_pelanggan` varchar(20) NOT NULL,
  `kode_bayar` int(2) NOT NULL,
  `tanggal_tagihan` date NOT NULL DEFAULT '0000-00-00',
  `tanggal_tempo` date NOT NULL DEFAULT '0000-00-00',
  `jumlah` int(20) NOT NULL,
  `tanggal1` date DEFAULT '0000-00-00',
  `angsuran1` int(20) DEFAULT NULL,
  `tanggal2` date DEFAULT '0000-00-00',
  `angsuran2` int(20) DEFAULT NULL,
  `tanggal3` date DEFAULT '0000-00-00',
  `angsuran3` int(20) DEFAULT NULL,
  `tanggal4` date DEFAULT '0000-00-00',
  `angsuran4` int(20) DEFAULT NULL,
  `tanggal5` date DEFAULT '0000-00-00',
  `angsuran5` int(20) DEFAULT NULL,
  `tanggal6` date DEFAULT '0000-00-00',
  `angsuran6` int(20) DEFAULT NULL,
  `sisa` int(20) DEFAULT NULL,
  `status` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_mutasi_keluar`
--

DROP TABLE IF EXISTS `temp_mutasi_keluar`;
CREATE TABLE IF NOT EXISTS `temp_mutasi_keluar` (
  `kode_mutasi_keluar` varchar(20) NOT NULL,
  `tanggal_mutasi_keluar` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_keluar` int(5) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `status_keluar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_mutasi_masuk`
--

DROP TABLE IF EXISTS `temp_mutasi_masuk`;
CREATE TABLE IF NOT EXISTS `temp_mutasi_masuk` (
  `kode_mutasi_masuk` varchar(20) NOT NULL,
  `tanggal_mutasi_masuk` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_masuk` int(5) NOT NULL,
  `kode_user` int(3) NOT NULL,
  `status_masuk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_barang`
--

DROP TABLE IF EXISTS `tipe_barang`;
CREATE TABLE IF NOT EXISTS `tipe_barang` (
  `idtipe` int(255) NOT NULL,
  `kode_tipe` varchar(20) NOT NULL,
  `nama_tipe` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_barang`
--

INSERT INTO `tipe_barang` (`idtipe`, `kode_tipe`, `nama_tipe`, `keterangan`) VALUES
(1, '0', '0', '-'),
(2, 'T1', 'MOF-401P', '-'),
(3, 'T2', 'Deluxe 20\"', '-'),
(4, 'T3', 'WB40L', '-'),
(5, 'T4', 'WB40X', '-'),
(6, 'T5', 'WN40B', '-'),
(7, 'T6', 'MOF-401P', '-'),
(8, 'T7', '16-WFO', '-'),
(9, 'T8', 'KAW-1662', '-'),
(10, 'T9', 'CFR 5889', '-'),
(11, 'T10', '16-WFO', '-'),
(12, 'T11', 'TW16', '-'),
(13, 'T12', 'TW14', '-'),
(14, 'T13', 'Deluxe 18\"', '-'),
(15, 'T14', 'Deluxe 16\"', '-'),
(16, 'T15', 'TW20', '-'),
(17, 'T16', 'KAS-1607', '-'),
(18, 'T17', 'TJR-101', '-'),
(19, 'T18', 'KAS-1627KB', '-'),
(20, 'T19', 'RI-522E', '-'),
(21, 'T20', 'KLB-18', '-'),
(22, 'T21', 'KDB-18', '-'),
(23, 'T22', 'F-EU409', '-'),
(24, 'T23', 'F-EQ405', '-'),
(25, 'T24', 'F-EP405', '-'),
(26, 'T25', 'Ass', '-'),
(27, 'T26', 'Ass', '-'),
(28, 'T27', 'Als', '-'),
(29, 'T28', 'MV-300 NEX', '-'),
(30, 'T29', 'JIS H3300 C122OT', '-'),
(31, 'T30', 'JIS-H3300 C122OT', '-'),
(32, 'T31', 'JIS H3300 C122OT', '-'),
(33, 'T32', 'PVF 17', '-'),
(34, 'T33', '24CDQNA', '-'),
(35, 'T34', 'FV-30RUN5', '-'),
(36, 'T35', 'WH-1261', '-'),
(37, 'T36', 'FV-25RUN5', '-'),
(38, 'T37', 'WH-1661', '-'),
(39, 'T38', 'WH-1663E', '-'),
(40, 'T39', 'WH-1681', '-'),
(41, 'T40', '30RQN5', '-'),
(42, 'T41', 'CEF 1295', '-'),
(43, 'T42', 'WEF 1290', '-'),
(44, 'T43', 'HFN1655PO', '-'),
(45, 'T44', 'FV-24CDUN2', '-'),
(46, 'T45', 'KAD-927B PL', '-'),
(47, 'T46', 'FW1280N', '-'),
(48, 'T47', '25TGQ2', '-'),
(49, 'T48', 'FW16??', '-'),
(50, 'T49', 'FD 1087', '-'),
(51, 'T50', 'KAD-927B PL', '-'),
(52, 'T51', 'COF1861', '-'),
(53, 'T52', 'CEF-20', '-'),
(54, 'T53', 'MVF 1091', '-'),
(55, 'T54', 'HFN1655PO', '-'),
(56, 'T55', 'KAP106B', '-'),
(57, 'T56', 'CC-WL-1005', '-'),
(58, 'T57', 'MG-GT5A09', '-'),
(59, 'T58', 'HP', '-'),
(60, 'T59', 'KAP 105', '-');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_barang`
--

DROP TABLE IF EXISTS `ukuran_barang`;
CREATE TABLE IF NOT EXISTS `ukuran_barang` (
  `idukuran` int(255) NOT NULL,
  `kode_ukuran` varchar(20) NOT NULL,
  `nama_ukuran` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran_barang`
--

INSERT INTO `ukuran_barang` (`idukuran`, `kode_ukuran`, `nama_ukuran`, `keterangan`) VALUES
(1, '0', '0', '-'),
(2, 'U1', '3W', '-'),
(3, 'U2', '5W', '-'),
(4, 'U3', '7W', '-'),
(5, 'U4', '8W', '-'),
(6, 'U5', '9W', '-'),
(7, 'U6', '10W', '-'),
(8, 'U7', '15W', '-'),
(9, 'U8', '16W', '-'),
(10, 'U9', '17W', '-'),
(11, 'U10', '18W', '-'),
(12, 'U11', '20W', '-'),
(13, 'U12', '21W', '-'),
(14, 'U13', '26W', '-'),
(15, 'U14', '30W', '-'),
(16, 'U15', '36W', '-'),
(17, 'U16', '37W', '-'),
(18, 'U17', '38W', '-'),
(19, 'U18', '40W', '-'),
(20, 'U19', '45W', '-'),
(21, 'U20', '46W', '-'),
(22, 'U21', '50W', '-'),
(23, 'U22', '55W', '-'),
(24, 'U23', '60W', '-'),
(25, 'U24', '65W', '-'),
(26, 'U25', '85W', '-'),
(27, 'U26', '90W', '-'),
(28, 'U27', '110W', '-'),
(29, 'U28', '250W', '-'),
(30, 'U29', '350W', '-'),
(31, 'U30', '9\"', '-'),
(32, 'U31', '10\"', '-'),
(33, 'U32', '12\"', '-'),
(34, 'U33', '14\"', '-'),
(35, 'U34', '16\"', '-'),
(36, 'U35', '18\"', '-'),
(37, 'U36', '20\"', '-'),
(38, 'U37', '1 x 0.75', '-'),
(39, 'U38', '1 x 1', '-'),
(40, 'U39', '1 x 1.5', '-'),
(41, 'U40', '1 x 2', '-'),
(42, 'U41', '1 x 2.5', '-'),
(43, 'U42', '1 x 3', '-'),
(44, 'U43', '1 x 3.5', '-'),
(45, 'U44', '1 x 4', '-'),
(46, 'U45', '2 x 0.75', '-'),
(47, 'U46', '2 x 1', '-'),
(48, 'U47', '2 x 1.5', '-'),
(49, 'U48', '2 x 2', '-'),
(50, 'U49', '2 x 2.5', '-'),
(51, 'U50', '2 x 3', '-'),
(52, 'U51', '2 x 3.5', '-'),
(53, 'U52', '2 x 4', '-'),
(54, 'U53', '3 x 0.75', '-'),
(55, 'U54', '3 x 1', '-'),
(56, 'U55', '3 x 1.5', '-'),
(57, 'U56', '3 x 2', '-'),
(58, 'U57', '3 x 2.5', '-'),
(59, 'U58', '3 x 3', '-'),
(60, 'U59', '3 x 3.5', '-'),
(61, 'U60', '3 x 4', '-'),
(62, 'U61', '0.5A', '-'),
(63, 'U62', '1A', '-'),
(64, 'U63', '1.5A', '-'),
(65, 'U64', '2A', '-'),
(66, 'U65', '2.5A', '-'),
(67, 'U66', '3A', '-'),
(68, 'U67', '3.5A', '-'),
(69, 'U68', '4A', '-'),
(70, 'U69', '4.5A', '-'),
(71, 'U70', '5A', '-'),
(72, 'U71', '5.5A', '-'),
(73, 'U72', '6A', '-'),
(74, 'U73', '6.5A', '-'),
(75, 'U74', '7A', '-'),
(76, 'U75', '7.5A', '-'),
(77, 'U76', '8A', '-'),
(78, 'U77', '8.5A', '-'),
(79, 'U78', '9A', '-'),
(80, 'U79', '9.5A', '-'),
(81, 'U80', '10A', '-'),
(82, 'U81', '10.5A', '-'),
(83, 'U82', '11A', '-'),
(84, 'U83', '11.5A', '-'),
(85, 'U84', '12A', '-'),
(86, 'U85', '12.5A', '-'),
(87, 'U86', '13A', '-'),
(88, 'U87', '13.5A', '-'),
(89, 'U88', '14A', '-'),
(90, 'U89', '14.5A', '-'),
(91, 'U90', '15A', '-'),
(92, 'U91', '15.5A', '-'),
(93, 'U92', '16A', '-'),
(94, 'U93', '16.5A', '-'),
(95, 'U94', '17A', '-'),
(96, 'U95', '17.5A', '-'),
(97, 'U96', '18A', '-'),
(98, 'U97', '18.5A', '-'),
(99, 'U98', '19A', '-'),
(100, 'U99', '19.5A', '-'),
(101, 'U100', '20A', '-'),
(102, 'U101', '1/4 (6.35) x 3/8 (9.52) x 30 M', '-'),
(103, 'U102', '6.35 x 12.7 x 30 M', '-'),
(104, 'U103', '6.35 x 9.52 x 30 M', '-'),
(105, 'U104', '1L', '-'),
(106, 'U105', '1.5L', '-'),
(107, 'U106', '2L', '-'),
(108, 'U107', '2.5L', '-'),
(109, 'U108', '3L', '-'),
(110, 'U109', '3.5L', '-');

-- --------------------------------------------------------

--
-- Table structure for table `utang`
--

DROP TABLE IF EXISTS `utang`;
CREATE TABLE IF NOT EXISTS `utang` (
  `kode_utang` varchar(20) NOT NULL,
  `kode_pemasok` varchar(20) NOT NULL,
  `kode_bayar` int(2) NOT NULL,
  `tanggal_hutang` date NOT NULL DEFAULT '0000-00-00',
  `tanggal_tempo` date NOT NULL DEFAULT '0000-00-00',
  `jumlah` int(20) NOT NULL,
  `tanggal1` date DEFAULT '0000-00-00',
  `angsuran1` int(20) DEFAULT NULL,
  `tanggal2` date DEFAULT '0000-00-00',
  `angsuran2` int(20) DEFAULT NULL,
  `tanggal3` date DEFAULT '0000-00-00',
  `angsuran3` int(20) DEFAULT NULL,
  `tanggal4` date DEFAULT '0000-00-00',
  `angsuran4` int(20) DEFAULT NULL,
  `tanggal5` date DEFAULT '0000-00-00',
  `angsuran5` int(20) DEFAULT NULL,
  `tanggal6` date DEFAULT '0000-00-00',
  `angsuran6` int(20) DEFAULT NULL,
  `sisa` int(20) DEFAULT NULL,
  `status` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `warna_barang`
--

DROP TABLE IF EXISTS `warna_barang`;
CREATE TABLE IF NOT EXISTS `warna_barang` (
  `idwarna` int(255) NOT NULL,
  `kode_warna` varchar(20) NOT NULL,
  `nama_warna` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
