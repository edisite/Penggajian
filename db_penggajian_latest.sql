-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2020 at 05:15 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `periode_tanggal` char(7) DEFAULT NULL,
  `jam_hadir` time NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `tidak_hadir` int(11) NOT NULL,
  `terlambat` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `potongan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `id_karyawan`, `periode_tanggal`, `jam_hadir`, `sakit`, `izin`, `tidak_hadir`, `terlambat`, `total`, `potongan`) VALUES
(2, 5, '2020-07', '07:07:00', 40, 2, 0, '0', '-16', '1300000'),
(3, 5, '2020-09', '00:00:00', 2, 2, 0, '6', '22', '172000'),
(4, 5, '2020-09', '00:00:00', 1, 2, 3, '20', '20', '470000'),
(5, 5, '2020-10', '00:00:00', 3, 2, 1, '20', '20', '330000'),
(6, 6, '2020-11', '00:00:00', 2, 3, 1, '30', '20', '470000');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id_auth` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `users_group` enum('manager','admin','staff') NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id_auth`, `name`, `email`, `password`, `img`, `role`, `users_group`) VALUES
(1, 'Ryan Manager', 'Ryan@admin.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default.png', 1, 'manager'),
(2, 'Admin', 'admin@admin.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default.png', 1, 'admin'),
(3, 'Staff', 'staff@admin.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default.png', 1, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

DROP TABLE IF EXISTS `bagian`;
CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_bagian` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `nama_bagian`) VALUES
(1, 'Teknisi'),
(4, 'Aaa'),
(5, 'Staff Operational ');

-- --------------------------------------------------------

--
-- Table structure for table `bpjs_kesehatan`
--

DROP TABLE IF EXISTS `bpjs_kesehatan`;
CREATE TABLE `bpjs_kesehatan` (
  `id_kesehatan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `perhitungan_dasar` varchar(20) NOT NULL,
  `bpjs_perusahaan` int(20) NOT NULL,
  `bpjs_karyawan` int(20) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bpjs_kesehatan`
--

INSERT INTO `bpjs_kesehatan` (`id_kesehatan`, `id_karyawan`, `perhitungan_dasar`, `bpjs_perusahaan`, `bpjs_karyawan`, `total`) VALUES
(5, 5, '100000', 10000, 6000, 16000),
(6, 6, '0', 0, 0, 0),
(7, 7, '100000', 10000, 2000, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `bpjs_ketenagakerjaan`
--

DROP TABLE IF EXISTS `bpjs_ketenagakerjaan`;
CREATE TABLE `bpjs_ketenagakerjaan` (
  `id_bpjs` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `perhitungan_dasar` varchar(20) NOT NULL,
  `jht_perusahaan` varchar(20) NOT NULL,
  `jht_karyawan` varchar(20) NOT NULL,
  `jenis_jkk` varchar(20) NOT NULL,
  `jkk` varchar(20) NOT NULL,
  `jkm` varchar(20) NOT NULL,
  `jp_perusahaan` varchar(20) NOT NULL,
  `jp_karyawan` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bpjs_ketenagakerjaan`
--

INSERT INTO `bpjs_ketenagakerjaan` (`id_bpjs`, `id_karyawan`, `perhitungan_dasar`, `jht_perusahaan`, `jht_karyawan`, `jenis_jkk`, `jkk`, `jkm`, `jp_perusahaan`, `jp_karyawan`, `total`) VALUES
(5, 6, '0', '0', '0', 'JKK 2', '0', '0', '0', '0', '0'),
(30, 6, '0', '0', '0', 'JKK 2', '0', '0', '0', '0', '0'),
(31, 5, '100000', '3700', '2000', 'JKK 2', '550', '300', '2000', '1000', '11550');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(35) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  `insentif_penjualan` int(11) NOT NULL,
  `insentif_pengiriman` int(11) NOT NULL,
  `thr` int(11) NOT NULL,
  `lain_lain` int(11) NOT NULL,
  `gaji_kotor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `id_bagian`, `gaji_pokok`, `uang_makan`, `insentif_penjualan`, `insentif_pengiriman`, `thr`, `lain_lain`, `gaji_kotor`) VALUES
(3, 'Programmer', 1, 0, 0, 0, 0, 0, 0, 0),
(4, 'A', 4, 3500000, 50000, 100000, 1000000, 1800000, 0, 6450000),
(5, 'Data Entry', 5, 100000, 0, 0, 0, 0, 0, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(15) NOT NULL,
  `nama_karyawan` varchar(35) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status` char(1) NOT NULL,
  `jumlah_keluarga` int(2) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `status_kerja` char(1) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `bank` char(20) NOT NULL,
  `no_rekening` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `id_jabatan`, `id_bagian`, `alamat`, `tanggal_lahir`, `status`, `jumlah_keluarga`, `telp`, `status_kerja`, `tanggal_masuk`, `email`, `bank`, `no_rekening`) VALUES
(5, 1234567887, 'Ryan', 5, 5, 'Majalengka', '2019-09-03', '0', 3, '0893456789', '1', '2020-06-19', 'ias@gmail.com', 'BCA', '9002312345'),
(6, 43679581, 'edi', 3, 1, 'tess', '2020-09-25', '0', 1, '172361236188', '1', '2020-09-25', 'edis@gas.com', 'BCA', '9002312345'),
(7, 19573862, 'Soleh', 5, 5, 'tess', '2020-11-20', '0', 1, '172361236188', '0', '2020-11-20', 'edis@gas.com', 'BCA', '9002312345');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `besar_pinjaman` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_lunas` date NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_karyawan`, `besar_pinjaman`, `keterangan`, `tanggal_pinjam`, `tanggal_lunas`, `status`) VALUES
(2, 5, '8000000', '', '2020-06-01', '2020-10-05', '0'),
(3, 5, '240000', '', '2020-10-04', '2020-10-21', '1');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

DROP TABLE IF EXISTS `penggajian`;
CREATE TABLE `penggajian` (
  `id_penggajian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `periode_bulan` char(7) NOT NULL,
  `gaji_kotor` int(11) NOT NULL,
  `potongan_absen` int(11) NOT NULL,
  `pinjaman` int(11) NOT NULL,
  `bpjs1` int(11) NOT NULL,
  `bpjs2` int(11) NOT NULL,
  `gaji_bersih` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id_penggajian`, `id_karyawan`, `periode_bulan`, `gaji_kotor`, `potongan_absen`, `pinjaman`, `bpjs1`, `bpjs2`, `gaji_bersih`) VALUES
(3, 5, '2020-06', 17959000, 190000, 200000, 2018592, 1077540, 14472868),
(4, 5, '2020-07', 21958997, 1300000, 0, 9324591, 1077540, 10256866),
(6, 5, '2020-10', 21958997, 330000, 240000, 0, 1317540, 20071457),
(7, 6, '2020-11', 0, 470000, 0, 0, 0, -470000);

-- --------------------------------------------------------

--
-- Table structure for table `setting_absensi`
--

DROP TABLE IF EXISTS `setting_absensi`;
CREATE TABLE `setting_absensi` (
  `id_setting_absensi` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `hari_kerja` int(2) NOT NULL,
  `potongan_telat` varchar(10) NOT NULL,
  `jam_kerja` varchar(5) NOT NULL,
  `tidak_hadir` varchar(20) NOT NULL,
  `izin` varchar(20) NOT NULL,
  `sakit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_absensi`
--

INSERT INTO `setting_absensi` (`id_setting_absensi`, `jam_masuk`, `hari_kerja`, `potongan_telat`, `jam_kerja`, `tidak_hadir`, `izin`, `sakit`) VALUES
(1, '00:00:00', 26, '2000', '480', '200000', '50000', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `setting_jenis_jkk`
--

DROP TABLE IF EXISTS `setting_jenis_jkk`;
CREATE TABLE `setting_jenis_jkk` (
  `id_jkk` int(11) NOT NULL,
  `nama_jkk` varchar(50) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_jenis_jkk`
--

INSERT INTO `setting_jenis_jkk` (`id_jkk`, `nama_jkk`, `rate`) VALUES
(1, 'JKK 1', 0.25),
(2, 'JKK 2', 0.55),
(3, 'JKK 3', 0.89),
(4, 'JKK 4', 1.27),
(5, 'JKK 5', 1.74);

-- --------------------------------------------------------

--
-- Table structure for table `setting_kesehatan`
--

DROP TABLE IF EXISTS `setting_kesehatan`;
CREATE TABLE `setting_kesehatan` (
  `id_kesehatan` int(11) NOT NULL,
  `bpjs_perusahaan` double NOT NULL,
  `bpjs_karyawan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_kesehatan`
--

INSERT INTO `setting_kesehatan` (`id_kesehatan`, `bpjs_perusahaan`, `bpjs_karyawan`) VALUES
(1, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `setting_ketenagakerjaan`
--

DROP TABLE IF EXISTS `setting_ketenagakerjaan`;
CREATE TABLE `setting_ketenagakerjaan` (
  `id_ketenagakerjaan` int(11) NOT NULL,
  `jht_perusahaan` double NOT NULL,
  `jht_karyawan` double NOT NULL,
  `jkm` double NOT NULL,
  `jp_perusahaan` double NOT NULL,
  `jp_karyawan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_ketenagakerjaan`
--

INSERT INTO `setting_ketenagakerjaan` (`id_ketenagakerjaan`, `jht_perusahaan`, `jht_karyawan`, `jkm`, `jp_perusahaan`, `jp_karyawan`) VALUES
(1, 3.7, 2, 0.3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id_auth`);

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `bpjs_kesehatan`
--
ALTER TABLE `bpjs_kesehatan`
  ADD PRIMARY KEY (`id_kesehatan`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `bpjs_ketenagakerjaan`
--
ALTER TABLE `bpjs_ketenagakerjaan`
  ADD PRIMARY KEY (`id_bpjs`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id_penggajian`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `setting_absensi`
--
ALTER TABLE `setting_absensi`
  ADD PRIMARY KEY (`id_setting_absensi`);

--
-- Indexes for table `setting_jenis_jkk`
--
ALTER TABLE `setting_jenis_jkk`
  ADD PRIMARY KEY (`id_jkk`);

--
-- Indexes for table `setting_kesehatan`
--
ALTER TABLE `setting_kesehatan`
  ADD PRIMARY KEY (`id_kesehatan`);

--
-- Indexes for table `setting_ketenagakerjaan`
--
ALTER TABLE `setting_ketenagakerjaan`
  ADD PRIMARY KEY (`id_ketenagakerjaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id_auth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bpjs_kesehatan`
--
ALTER TABLE `bpjs_kesehatan`
  MODIFY `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bpjs_ketenagakerjaan`
--
ALTER TABLE `bpjs_ketenagakerjaan`
  MODIFY `id_bpjs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting_absensi`
--
ALTER TABLE `setting_absensi`
  MODIFY `id_setting_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_jenis_jkk`
--
ALTER TABLE `setting_jenis_jkk`
  MODIFY `id_jkk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting_kesehatan`
--
ALTER TABLE `setting_kesehatan`
  MODIFY `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_ketenagakerjaan`
--
ALTER TABLE `setting_ketenagakerjaan`
  MODIFY `id_ketenagakerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`);

--
-- Constraints for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `penggajian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
