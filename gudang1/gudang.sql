-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 04:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `alatbahan`
--

CREATE TABLE `alatbahan` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `spesifikasi` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `kondisi` enum('baik','rusak','butuh perbaikan') DEFAULT 'baik',
  `sumber_dana` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alatbahan`
--

INSERT INTO `alatbahan` (`id_barang`, `nama_barang`, `spesifikasi`, `lokasi`, `kondisi`, `sumber_dana`) VALUES
(1, 'Bor Listrik', '350W, 220V', 'Rak A1', 'baik', 'Dana BOS'),
(2, 'Gergaji Besi', 'Panjang 30 cm', 'Rak B2', 'baik', 'Dana Bantuan'),
(3, 'Obeng Set', '6 in 1, magnetik', 'Rak C3', 'baik', 'Swadaya'),
(4, 'Tang Kombinasi', 'Baja tahan karat', 'Rak D4', 'baik', 'Dana CSR'),
(5, 'Multimeter Digital', '2000 count, auto range', 'Rak E5', 'baik', 'Sumbangan');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jml_keluar` int(11) NOT NULL CHECK (`jml_keluar` > 0),
  `penerima` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `tgl_keluar`, `jml_keluar`, `penerima`) VALUES
(1, 3, '2025-03-01', 3, 'Siti Aisyah');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jml_masuk` int(11) NOT NULL CHECK (`jml_masuk` > 0),
  `id_penyedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `tgl_masuk`, `jml_masuk`, `id_penyedia`) VALUES
(1, 1, '2025-03-08', 5, 1),
(2, 3, '2025-03-15', 10, 3),
(3, 2, '2025-03-01', 8, 2),
(4, 4, '2025-03-15', 8, 4),
(5, 5, '2025-03-29', 10, 4),
(6, 1, '2025-03-01', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(11) NOT NULL,
  `nama_penyedia` varchar(100) DEFAULT NULL,
  `alamat_penyedia` text DEFAULT NULL,
  `telpon_penyedia` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyedia`
--

INSERT INTO `penyedia` (`id_penyedia`, `nama_penyedia`, `alamat_penyedia`, `telpon_penyedia`) VALUES
(1, 'PT. Sumber Jaya', 'Jl. Merdeka No. 45', '081234567890'),
(2, 'CV. Makmur Sejahtera', 'Jl. Mawar No. 10', '081298765432'),
(3, 'Toko Alat Teknik', 'Jl. Kenanga No. 25', '081377788899'),
(4, 'PT. Cahaya Abadi', 'Jl. Melati No. 33', '081322233344'),
(5, 'UD. Sentosa', 'Jl. Anggrek No. 50', '081255566677');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_alat`
--

CREATE TABLE `pinjam_alat` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jml_barang` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `jml_kembali` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjam_alat`
--

INSERT INTO `pinjam_alat` (`id_pinjam`, `id_user`, `tgl_pinjam`, `id_barang`, `jml_barang`, `tgl_kembali`, `jml_kembali`) VALUES
(2, 3, '2025-03-01', 5, 1, '2025-03-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('superadmin','admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin@gmail.com', '123456', 'superadmin'),
(3, 'Siti Aisyah', 'siti@gmail.com', '123456', 'admin'),
(4, 'Rudi Hartono', 'rudi@gmail.com', '123456', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alatbahan`
--
ALTER TABLE `alatbahan`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_penyedia` (`id_penyedia`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indexes for table `pinjam_alat`
--
ALTER TABLE `pinjam_alat`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alatbahan`
--
ALTER TABLE `alatbahan`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penyedia`
--
ALTER TABLE `penyedia`
  MODIFY `id_penyedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pinjam_alat`
--
ALTER TABLE `pinjam_alat`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `alatbahan` (`id_barang`) ON DELETE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `alatbahan` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`) ON DELETE CASCADE;

--
-- Constraints for table `pinjam_alat`
--
ALTER TABLE `pinjam_alat`
  ADD CONSTRAINT `pinjam_alat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `pinjam_alat_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `alatbahan` (`id_barang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
