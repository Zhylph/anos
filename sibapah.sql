-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2022 at 11:36 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibapah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(10) NOT NULL,
  `id_jenis_barang` int(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `id_jenis_barang`, `nama_barang`, `stok`, `satuan`) VALUES
(4, 2, 'Kertas A4', '6', 'rim'),
(5, 2, 'Kertas F4', '10', 'rim'),
(6, 3, 'Herbisida', '10', 'liter'),
(8, 4, 'Bensin Pertalite', '12', 'liter');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_barang`
--

CREATE TABLE `tbl_jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL,
  `jenis_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_barang`
--

INSERT INTO `tbl_jenis_barang` (`id_jenis_barang`, `jenis_barang`) VALUES
(2, 'ATK'),
(3, 'Kimia'),
(4, 'Bahan Bakar Minyak'),
(8, 'Kebersihan'),
(10, 'Elektronik / Kelistrikan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerimaan`
--

CREATE TABLE `tbl_penerimaan` (
  `id_penerimaan` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `tanggal_penerimaan` date NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `jumlah_penerimaan` int(10) NOT NULL,
  `harga_penerimaan` varchar(50) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `alamat_toko` varchar(500) DEFAULT NULL,
  `bukti_penerimaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penerimaan`
--

INSERT INTO `tbl_penerimaan` (`id_penerimaan`, `id_barang`, `tanggal_penerimaan`, `tanggal_pembelian`, `jumlah_penerimaan`, `harga_penerimaan`, `nama_toko`, `alamat_toko`, `bukti_penerimaan`) VALUES
(10, 4, '2022-08-01', '2022-08-01', 21, '1000', 'Toko', 'Jl. Jendral Sudirman No. 10', 'Identitas_Pasien.pdf'),
(11, 4, '2022-08-15', '2022-08-15', 5, '50000', 'lnang', 'Barambai', '24872.pdf'),
(25, 4, '2022-08-01', '2022-08-01', 2, '100000', 'Toko', 'Jl. Jendral Sudirman No. 10', 'Surat_BALASAN_BUPATI.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permintaan`
--

CREATE TABLE `tbl_permintaan` (
  `id_permintaan` int(10) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `jumlah_permintaan` int(10) DEFAULT NULL,
  `tanggal_permintaan` date DEFAULT NULL,
  `tanggal_dibutuhkan` date DEFAULT NULL,
  `status_persetujuan` varchar(50) DEFAULT NULL,
  `jumlah_disetujui` int(10) DEFAULT NULL,
  `tanggal_persetujuan` date DEFAULT NULL,
  `catatan` varchar(500) DEFAULT NULL,
  `status_penyerahan` varchar(50) DEFAULT NULL,
  `tanggal_penyerahan` date DEFAULT NULL,
  `bukti` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permintaan`
--

INSERT INTO `tbl_permintaan` (`id_permintaan`, `id_user`, `id_barang`, `jumlah_permintaan`, `tanggal_permintaan`, `tanggal_dibutuhkan`, `status_persetujuan`, `jumlah_disetujui`, `tanggal_persetujuan`, `catatan`, `status_penyerahan`, `tanggal_penyerahan`, `bukti`) VALUES
(2, 5, 4, 5, '2022-08-14', '2022-08-21', 'disetujui', 1, NULL, '123', 'diserahkan', '2022-08-16', NULL),
(5, 5, 6, 1, '2022-08-15', '2022-08-15', 'ditolak', 0, '2022-08-16', '123', 'belum diserahkan', '2022-08-15', NULL),
(9, 5, 5, 1, '2022-08-16', '2022-08-17', 'disetujui', 1, '2022-08-16', 'bagus', 'diserahkan', '2022-08-16', NULL),
(10, 5, 4, 1, '2022-08-01', '2022-08-03', 'disetujui', 1, '2022-08-17', 'Coba', 'diserahkan', '2022-08-17', NULL),
(11, 5, 4, 1, '2022-08-01', '2022-08-01', 'disetujui', 1, '2022-08-17', 'z', 'diserahkan', '2022-08-17', NULL),
(12, 5, 4, 1, '2022-08-01', '2022-08-26', 'disetujui', 1, '2022-08-17', 'Oke', 'diserahkan', '2022-08-17', NULL),
(13, 16630216, 4, 1, '2022-08-01', '2022-08-02', 'disetujui', 1, '2022-08-17', 'Ok sip', 'belum diserahkan', '2022-08-17', 'Surat_BALASAN_BUPATI.png'),
(15, 16630216, 4, 1, '2022-08-19', '2022-08-20', 'ditolak', 0, '2022-08-17', 'bujuri lagi', 'belum diserahkan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `bidang`, `username`, `password`, `id_role`) VALUES
(5, 'Admin', 'Admin', 'admin', '$2y$10$tFP0S/7ome7bfDGoXFgQO.zaZpAijmJfmraybJs5mzuau8Jb4Pm0S', 0),
(16630213, 'H. SUWARTONO SUSANTO, SP,. MS', 'Kepala Dinas', 'kadisbunnak', '$2y$10$tFP0S/7ome7bfDGoXFgQO.zaZpAijmJfmraybJs5mzuau8Jb4Pm0S', 1),
(16630214, 'DIAH EMA LISTIANI, A.Md.', 'Pengurus Barang', 'pbarang', '$2y$10$tFP0S/7ome7bfDGoXFgQO.zaZpAijmJfmraybJs5mzuau8Jb4Pm0S', 2),
(16630215, 'EKO HARIYANTO, S.Pt', 'Produksi Peternakan', 'bidpronak', '$2y$10$PKv1tAcwNWuLvDj9UFvX6Oll6P2.Qvha5VcxjjToshK0hpGIhyV36', 3),
(16630216, 'AMINA OKTAVIANY, S.Hut', 'Perkebunan', 'bidbun', '$2y$10$tFP0S/7ome7bfDGoXFgQO.zaZpAijmJfmraybJs5mzuau8Jb4Pm0S', 3),
(16630217, 'AULIA RAHMAN, S.Pt', 'Sekretariat', 'sekre02', '$2y$10$0XXxGwGpsLlB4R3X/jSbge0nWjm3hQ1Kj3ViallNLmlkgA/aG6FjK', 3),
(16630218, 'JUHAIRIAH, S.E', 'Sekretariat', 'sekre03', '$2y$10$LQZfVlswrQxey/5q8cYpO.UD.ftSCYBl4bPKgBClxTIfgmzDjd1um', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `id_role`, `menu_id`) VALUES
(1, 0, 1),
(9, 0, 2),
(10, 0, 3),
(11, 0, 4),
(12, 1, 2),
(13, 1, 1),
(17, 3, 5),
(21, 2, 33),
(30, 2, 6),
(32, 2, 4),
(33, 2, 7),
(34, 0, 7),
(35, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Barang'),
(3, 'Menu'),
(5, 'User'),
(6, 'Pengurus'),
(7, 'Riwayat');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(0, 'Administrator'),
(1, 'Kepala Dinas'),
(2, 'Pengurus Barang'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 0),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 0),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 0),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 0),
(12, 1, 'Data User', 'admin/user', 'fas fa-fw fa-user-tie', 1),
(14, 2, 'Klasifikasi Barang', 'admin/jenisbarang', 'fas fa-fw fa-folder-open', 1),
(15, 2, 'Daftar Barang', 'admin/barang', 'fas fa-fw fa-folder-open', 1),
(17, 2, 'Permintaan Barang', 'admin/permintaan', 'fas fa-fw fa-folder-open', 1),
(18, 7, 'Riwayat Barang Masuk', 'admin/riwayatmasuk', 'fas fa-fw fa-clock', 1),
(19, 7, 'Riwayat Barang Keluar', 'admin/riwayatkeluar', 'fas fa-fw fa-clock', 1),
(20, 2, 'Barang Masuk', 'admin/penerimaan', 'fas fa-fw fa-folder-open', 1),
(21, 5, 'Permintaan Barang', 'user', 'fas fa-fw fa-folder-open', 1),
(22, 5, 'Daftar Barang', 'user/barang', 'fas fa-fw fa-folder-open', 1),
(23, 6, 'Dashboard', 'pengurus', 'fas fa-fw fa-user-tie', 1),
(24, 6, 'Klasifikasi Barang', 'pengurus/jenisbarang', 'fas fa-fw fa-folder-open', 1),
(25, 6, 'Daftar Barang', 'pengurus/barang', 'fas fa-fw fa-folder-open', 1),
(26, 6, 'Permintaan Barang', 'pengurus/permintaan', 'fas fa-fw fa-folder-open', 1),
(27, 6, 'Barang Masuk', 'pengurus/penerimaan', 'fas fa-fw fa-folder-open', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `tbl_penerimaan`
--
ALTER TABLE `tbl_penerimaan`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indexes for table `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_penerimaan`
--
ALTER TABLE `tbl_penerimaan`
  MODIFY `id_penerimaan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  MODIFY `id_permintaan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16630219;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
