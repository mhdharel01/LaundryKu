-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 09:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `alamat`, `no_telp`) VALUES
(1, 'Mas Ronaldo', 'Desa Jongkang Baru, Sleman, D.I.Yogyakarta ', '0874206942069 '),
(2, 'Budiman Supriono ', 'Desa Karangwuni, Sleman, D.I.Yogyakarta ', '123456789'),
(7, 'Bang Kulbet', 'Jakal  13', '+628233234232'),
(9, 'Juan Kulbet', 'Jakal  13', '+628233234232'),
(14, 'tono', 'kamboja', '9987'),
(15, 'harel', 'degolan', '08235478'),
(16, 'kimus', 'dengolan', '234567'),
(17, 'kiki', 'pandanaran', '34400302');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `email`, `password`, `no_telepon`, `role`) VALUES
(1, 'Muhammad Harel', 'harel@gmail.com     ', 'harel123', '08654213876635', 1),
(2, 'Huang Tao', 'TaoH@gmail.com', 'htaoz1', '081231898227', 2),
(5, 'Mbappe ', 'mbappe@gmail.com ', 'mbappe123', '+6282331397559', 1),
(7, 'Ronaldo', 'ronaldo@gmail.com     ', 'ronaldo123', '082333331341', 2),
(9, 'Pickfords ', 'pickford@gmail.com       ', 'pickford123  ', '+628233234233', 2),
(10, 'admin', 'admin@gmail.com', 'admin', '00000000', 1),
(11, 'Jennie Kim', 'jennie@gmail.com     ', 'jennie123', '+628233234233', 1),
(12, 'Pickfords', 'pickfords@gmail.com ', 'pickford123 ', '+628233234233', 2),
(13, 'Varane ', 'varane@gmail.com  ', 'varane123 ', '0000000', 2),
(15, 'karyawan', 'karyawan@gmail.com', 'karyawan', '00000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `paket_laundry`
--

CREATE TABLE `paket_laundry` (
  `kategori` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `id_paket` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_laundry`
--

INSERT INTO `paket_laundry` (`kategori`, `harga`, `id_paket`) VALUES
('Setrika  ', 7000, 2),
('Lengkap  ', 6000, 3),
('baju', 2000, 4),
('sepatu', 8000, 5),
('selimut', 4000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `parfum`
--

CREATE TABLE `parfum` (
  `nama` varchar(100) NOT NULL,
  `id_parfum` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parfum`
--

INSERT INTO `parfum` (`nama`, `id_parfum`) VALUES
('baccarat  ', 1),
('snapy', 2),
('leci', 3),
('koko', 4),
('vanila', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(10) UNSIGNED NOT NULL,
  `nama_pesanan` varchar(100) NOT NULL,
  `tanggal_masuk_pesanan` date NOT NULL,
  `tanggal_keluar_pesanan` date NOT NULL,
  `status_pesanan` int(10) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `berat_pesanan` int(10) NOT NULL,
  `jenis_paket` int(10) NOT NULL,
  `status_pembayaran` int(10) NOT NULL,
  `pewangi` int(10) NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nama_pesanan`, `tanggal_masuk_pesanan`, `tanggal_keluar_pesanan`, `status_pesanan`, `id_customer`, `berat_pesanan`, `jenis_paket`, `status_pembayaran`, `pewangi`, `karyawan_id`) VALUES
(3, 'cuci sepatu', '2023-06-13', '2023-06-15', 1, 15, 3, 3, 1, 4, 1),
(9, 'Laundry Almamater UII', '2022-12-10', '2022-12-30', 1, 1, 4, 3, 2, 2, 2),
(11, 'Cuci Sendal ', '2022-12-08', '2022-12-20', 2, 2, 8, 4, 2, 4, 2),
(17, 'baju kotor', '2023-04-11', '2023-04-12', 1, 9, 5, 2, 1, 1, 5),
(24, 'cuci baju', '2023-04-14', '2023-04-15', 2, 2, 2, 4, 2, 3, 7),
(27, 'cuci baju', '2023-04-16', '2023-04-17', 2, 14, 5, 4, 1, 2, 1),
(28, 'cuci', '2023-06-19', '2023-06-20', 1, 7, 1, 5, 1, 1, 13),
(29, 'kemeja', '2023-06-22', '2023-06-23', 1, 2, 2, 2, 2, 2, 5),
(30, 'celana', '2023-07-04', '2023-06-08', 2, 2, 7, 3, 1, 3, 1),
(32, 'CUCI CELANA', '2023-06-22', '2023-06-24', 1, 2, 5, 3, 1, 2, 5),
(33, 'SELIMUT', '2023-06-18', '2023-06-20', 1, 14, 3, 3, 1, 3, 7),
(34, 'cuci baju', '2023-06-23', '2023-06-30', 1, 15, 2, 3, 1, 3, 1),
(35, 'baju', '2023-06-25', '2023-06-26', 1, 1, 5, 3, 1, 2, 2),
(36, 'SELIMUT', '2023-06-26', '2023-06-29', 1, 14, 8, 4, 1, 2, 7),
(37, 'celana bersih', '2023-07-07', '2023-07-15', 2, 14, 8, 3, 2, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama`) VALUES
(1, 'Admin'),
(2, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `nama_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`id_pembayaran`, `nama_status`) VALUES
(1, 'BELUM BAYAR'),
(2, 'LUNAS');

-- --------------------------------------------------------

--
-- Table structure for table `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `nama` varchar(100) NOT NULL,
  `id_status_pesanan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_pesanan`
--

INSERT INTO `status_pesanan` (`nama`, `id_status_pesanan`) VALUES
('DI PROSES', 1),
('SELESAI', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `paket_laundry`
--
ALTER TABLE `paket_laundry`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `parfum`
--
ALTER TABLE `parfum`
  ADD PRIMARY KEY (`id_parfum`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `jenis_paket` (`jenis_paket`),
  ADD KEY `status_pesanan` (`status_pesanan`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `status_pembayaran` (`status_pembayaran`),
  ADD KEY `pewangi` (`pewangi`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`id_status_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parfum`
--
ALTER TABLE `parfum`
  MODIFY `id_parfum` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  MODIFY `id_status_pesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`jenis_paket`) REFERENCES `paket_laundry` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`status_pesanan`) REFERENCES `status_pesanan` (`id_status_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`status_pembayaran`) REFERENCES `status_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_5` FOREIGN KEY (`pewangi`) REFERENCES `parfum` (`id_parfum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_6` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
