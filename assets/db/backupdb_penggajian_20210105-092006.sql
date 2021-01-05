#
# TABLE STRUCTURE FOR: absensi
#

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `periode_tanggal` char(7) DEFAULT NULL,
  `jam_hadir` time NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `tidak_hadir` int(11) NOT NULL,
  `terlambat` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `potongan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `absensi` (`id_absen`, `id_karyawan`, `periode_tanggal`, `jam_hadir`, `sakit`, `izin`, `tidak_hadir`, `terlambat`, `total`, `potongan`) VALUES (2, 5, '2020-07', '07:07:00', 40, 2, 0, '0', '-16', '1300000');
INSERT INTO `absensi` (`id_absen`, `id_karyawan`, `periode_tanggal`, `jam_hadir`, `sakit`, `izin`, `tidak_hadir`, `terlambat`, `total`, `potongan`) VALUES (3, 5, '2020-09', '00:00:00', 2, 2, 0, '6', '22', '172000');
INSERT INTO `absensi` (`id_absen`, `id_karyawan`, `periode_tanggal`, `jam_hadir`, `sakit`, `izin`, `tidak_hadir`, `terlambat`, `total`, `potongan`) VALUES (4, 5, '2020-09', '00:00:00', 1, 2, 3, '20', '20', '470000');
INSERT INTO `absensi` (`id_absen`, `id_karyawan`, `periode_tanggal`, `jam_hadir`, `sakit`, `izin`, `tidak_hadir`, `terlambat`, `total`, `potongan`) VALUES (5, 5, '2020-10', '00:00:00', 3, 2, 1, '20', '20', '330000');
INSERT INTO `absensi` (`id_absen`, `id_karyawan`, `periode_tanggal`, `jam_hadir`, `sakit`, `izin`, `tidak_hadir`, `terlambat`, `total`, `potongan`) VALUES (6, 6, '2020-11', '00:00:00', 2, 3, 1, '30', '20', '470000');


#
# TABLE STRUCTURE FOR: auth
#

DROP TABLE IF EXISTS `auth`;

CREATE TABLE `auth` (
  `id_auth` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `users_group` enum('manager','admin','staff') NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id_auth`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `auth` (`id_auth`, `name`, `email`, `password`, `img`, `role`, `users_group`) VALUES (1, 'Ryan Manager', 'Ryan@admin.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default.png', 1, 'manager');
INSERT INTO `auth` (`id_auth`, `name`, `email`, `password`, `img`, `role`, `users_group`) VALUES (2, 'Admin', 'admin@admin.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default.png', 1, 'admin');
INSERT INTO `auth` (`id_auth`, `name`, `email`, `password`, `img`, `role`, `users_group`) VALUES (3, 'Staff', 'staff@admin.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default.png', 1, 'staff');


#
# TABLE STRUCTURE FOR: bagian
#

DROP TABLE IF EXISTS `bagian`;

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bagian` varchar(35) NOT NULL,
  PRIMARY KEY (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `bagian` (`id_bagian`, `nama_bagian`) VALUES (1, 'Teknisi');
INSERT INTO `bagian` (`id_bagian`, `nama_bagian`) VALUES (4, 'Aaa');
INSERT INTO `bagian` (`id_bagian`, `nama_bagian`) VALUES (5, 'Staff Operational ');


#
# TABLE STRUCTURE FOR: bpjs_kesehatan
#

DROP TABLE IF EXISTS `bpjs_kesehatan`;

CREATE TABLE `bpjs_kesehatan` (
  `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `perhitungan_dasar` varchar(20) NOT NULL,
  `bpjs_perusahaan` int(20) NOT NULL,
  `bpjs_karyawan` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  PRIMARY KEY (`id_kesehatan`),
  KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `bpjs_kesehatan` (`id_kesehatan`, `id_karyawan`, `perhitungan_dasar`, `bpjs_perusahaan`, `bpjs_karyawan`, `total`) VALUES (5, 5, '100000', 10000, 6000, 16000);
INSERT INTO `bpjs_kesehatan` (`id_kesehatan`, `id_karyawan`, `perhitungan_dasar`, `bpjs_perusahaan`, `bpjs_karyawan`, `total`) VALUES (6, 6, '0', 0, 0, 0);
INSERT INTO `bpjs_kesehatan` (`id_kesehatan`, `id_karyawan`, `perhitungan_dasar`, `bpjs_perusahaan`, `bpjs_karyawan`, `total`) VALUES (7, 7, '100000', 10000, 2000, 12000);


#
# TABLE STRUCTURE FOR: bpjs_ketenagakerjaan
#

DROP TABLE IF EXISTS `bpjs_ketenagakerjaan`;

CREATE TABLE `bpjs_ketenagakerjaan` (
  `id_bpjs` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `perhitungan_dasar` varchar(20) NOT NULL,
  `jht_perusahaan` varchar(20) NOT NULL,
  `jht_karyawan` varchar(20) NOT NULL,
  `jenis_jkk` varchar(20) NOT NULL,
  `jkk` varchar(20) NOT NULL,
  `jkm` varchar(20) NOT NULL,
  `jp_perusahaan` varchar(20) NOT NULL,
  `jp_karyawan` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  PRIMARY KEY (`id_bpjs`),
  KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

INSERT INTO `bpjs_ketenagakerjaan` (`id_bpjs`, `id_karyawan`, `perhitungan_dasar`, `jht_perusahaan`, `jht_karyawan`, `jenis_jkk`, `jkk`, `jkm`, `jp_perusahaan`, `jp_karyawan`, `total`) VALUES (5, 6, '0', '0', '0', 'JKK 2', '0', '0', '0', '0', '0');
INSERT INTO `bpjs_ketenagakerjaan` (`id_bpjs`, `id_karyawan`, `perhitungan_dasar`, `jht_perusahaan`, `jht_karyawan`, `jenis_jkk`, `jkk`, `jkm`, `jp_perusahaan`, `jp_karyawan`, `total`) VALUES (30, 6, '0', '0', '0', 'JKK 2', '0', '0', '0', '0', '0');
INSERT INTO `bpjs_ketenagakerjaan` (`id_bpjs`, `id_karyawan`, `perhitungan_dasar`, `jht_perusahaan`, `jht_karyawan`, `jenis_jkk`, `jkk`, `jkm`, `jp_perusahaan`, `jp_karyawan`, `total`) VALUES (31, 5, '100000', '3700', '2000', 'JKK 2', '550', '300', '2000', '1000', '11550');


#
# TABLE STRUCTURE FOR: jabatan
#

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(35) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  `insentif_penjualan` int(11) NOT NULL,
  `insentif_pengiriman` int(11) NOT NULL,
  `thr` int(11) NOT NULL,
  `lain_lain` int(11) NOT NULL,
  `gaji_kotor` int(11) NOT NULL,
  PRIMARY KEY (`id_jabatan`),
  KEY `id_bagian` (`id_bagian`),
  CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `id_bagian`, `gaji_pokok`, `uang_makan`, `insentif_penjualan`, `insentif_pengiriman`, `thr`, `lain_lain`, `gaji_kotor`) VALUES (3, 'Programmer', 1, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `id_bagian`, `gaji_pokok`, `uang_makan`, `insentif_penjualan`, `insentif_pengiriman`, `thr`, `lain_lain`, `gaji_kotor`) VALUES (4, 'A', 4, 3500000, 50000, 100000, 1000000, 1800000, 0, 6450000);
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `id_bagian`, `gaji_pokok`, `uang_makan`, `insentif_penjualan`, `insentif_pengiriman`, `thr`, `lain_lain`, `gaji_kotor`) VALUES (5, 'Data Entry', 5, 100000, 0, 0, 0, 0, 0, 100000);


#
# TABLE STRUCTURE FOR: karyawan
#

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `no_rekening` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_karyawan` (`id_karyawan`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_bagian` (`id_bagian`),
  CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `id_jabatan`, `id_bagian`, `alamat`, `tanggal_lahir`, `status`, `jumlah_keluarga`, `telp`, `status_kerja`, `tanggal_masuk`, `email`, `bank`, `no_rekening`) VALUES (5, 1234567887, 'Ryan', 5, 5, 'Majalengka', '2019-09-03', '0', 3, '0893456789', '1', '2020-06-19', 'ias@gmail.com', 'BCA', '9002312345');
INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `id_jabatan`, `id_bagian`, `alamat`, `tanggal_lahir`, `status`, `jumlah_keluarga`, `telp`, `status_kerja`, `tanggal_masuk`, `email`, `bank`, `no_rekening`) VALUES (6, 43679581, 'edi', 3, 1, 'tess', '2020-09-25', '0', 1, '172361236188', '1', '2020-09-25', 'edis@gas.com', 'BCA', '9002312345');
INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `id_jabatan`, `id_bagian`, `alamat`, `tanggal_lahir`, `status`, `jumlah_keluarga`, `telp`, `status_kerja`, `tanggal_masuk`, `email`, `bank`, `no_rekening`) VALUES (7, 19573862, 'Soleh', 5, 5, 'tess', '2020-11-20', '0', 1, '172361236188', '0', '2020-11-20', 'edis@gas.com', 'BCA', '9002312345');


#
# TABLE STRUCTURE FOR: peminjaman
#

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `besar_pinjaman` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_lunas` date NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `peminjaman` (`id_peminjaman`, `id_karyawan`, `besar_pinjaman`, `keterangan`, `tanggal_pinjam`, `tanggal_lunas`, `status`) VALUES (2, 5, '8000000', '', '2020-06-01', '2020-10-05', '0');
INSERT INTO `peminjaman` (`id_peminjaman`, `id_karyawan`, `besar_pinjaman`, `keterangan`, `tanggal_pinjam`, `tanggal_lunas`, `status`) VALUES (3, 5, '240000', '', '2020-10-04', '2020-10-21', '1');


#
# TABLE STRUCTURE FOR: penggajian
#

DROP TABLE IF EXISTS `penggajian`;

CREATE TABLE `penggajian` (
  `id_penggajian` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `periode_bulan` char(7) NOT NULL,
  `gaji_kotor` int(11) NOT NULL,
  `potongan_absen` int(11) NOT NULL,
  `pinjaman` int(11) NOT NULL,
  `bpjs1` int(11) NOT NULL,
  `bpjs2` int(11) NOT NULL,
  `gaji_bersih` int(11) NOT NULL,
  PRIMARY KEY (`id_penggajian`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `penggajian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `penggajian` (`id_penggajian`, `id_karyawan`, `periode_bulan`, `gaji_kotor`, `potongan_absen`, `pinjaman`, `bpjs1`, `bpjs2`, `gaji_bersih`) VALUES (3, 5, '2020-06', 17959000, 190000, 200000, 2018592, 1077540, 14472868);
INSERT INTO `penggajian` (`id_penggajian`, `id_karyawan`, `periode_bulan`, `gaji_kotor`, `potongan_absen`, `pinjaman`, `bpjs1`, `bpjs2`, `gaji_bersih`) VALUES (4, 5, '2020-07', 21958997, 1300000, 0, 9324591, 1077540, 10256866);
INSERT INTO `penggajian` (`id_penggajian`, `id_karyawan`, `periode_bulan`, `gaji_kotor`, `potongan_absen`, `pinjaman`, `bpjs1`, `bpjs2`, `gaji_bersih`) VALUES (6, 5, '2020-10', 21958997, 330000, 240000, 0, 1317540, 20071457);
INSERT INTO `penggajian` (`id_penggajian`, `id_karyawan`, `periode_bulan`, `gaji_kotor`, `potongan_absen`, `pinjaman`, `bpjs1`, `bpjs2`, `gaji_bersih`) VALUES (7, 6, '2020-11', 0, 470000, 0, 0, 0, -470000);


#
# TABLE STRUCTURE FOR: setting_absensi
#

DROP TABLE IF EXISTS `setting_absensi`;

CREATE TABLE `setting_absensi` (
  `id_setting_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `jam_masuk` time NOT NULL,
  `hari_kerja` int(2) NOT NULL,
  `potongan_telat` varchar(10) NOT NULL,
  `jam_kerja` varchar(5) NOT NULL,
  `tidak_hadir` varchar(20) NOT NULL,
  `izin` varchar(20) NOT NULL,
  `sakit` varchar(20) NOT NULL,
  PRIMARY KEY (`id_setting_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting_absensi` (`id_setting_absensi`, `jam_masuk`, `hari_kerja`, `potongan_telat`, `jam_kerja`, `tidak_hadir`, `izin`, `sakit`) VALUES (1, '00:00:00', 26, '2000', '480', '200000', '50000', '30000');


#
# TABLE STRUCTURE FOR: setting_jenis_jkk
#

DROP TABLE IF EXISTS `setting_jenis_jkk`;

CREATE TABLE `setting_jenis_jkk` (
  `id_jkk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jkk` varchar(50) NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`id_jkk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting_jenis_jkk` (`id_jkk`, `nama_jkk`, `rate`) VALUES (1, 'JKK 1', '0.25');
INSERT INTO `setting_jenis_jkk` (`id_jkk`, `nama_jkk`, `rate`) VALUES (2, 'JKK 2', '0.55');
INSERT INTO `setting_jenis_jkk` (`id_jkk`, `nama_jkk`, `rate`) VALUES (3, 'JKK 3', '0.89');
INSERT INTO `setting_jenis_jkk` (`id_jkk`, `nama_jkk`, `rate`) VALUES (4, 'JKK 4', '1.27');
INSERT INTO `setting_jenis_jkk` (`id_jkk`, `nama_jkk`, `rate`) VALUES (5, 'JKK 5', '1.74');


#
# TABLE STRUCTURE FOR: setting_kesehatan
#

DROP TABLE IF EXISTS `setting_kesehatan`;

CREATE TABLE `setting_kesehatan` (
  `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT,
  `bpjs_perusahaan` double NOT NULL,
  `bpjs_karyawan` double NOT NULL,
  PRIMARY KEY (`id_kesehatan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting_kesehatan` (`id_kesehatan`, `bpjs_perusahaan`, `bpjs_karyawan`) VALUES (1, '10', '2');


#
# TABLE STRUCTURE FOR: setting_ketenagakerjaan
#

DROP TABLE IF EXISTS `setting_ketenagakerjaan`;

CREATE TABLE `setting_ketenagakerjaan` (
  `id_ketenagakerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `jht_perusahaan` double NOT NULL,
  `jht_karyawan` double NOT NULL,
  `jkm` double NOT NULL,
  `jp_perusahaan` double NOT NULL,
  `jp_karyawan` double NOT NULL,
  PRIMARY KEY (`id_ketenagakerjaan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting_ketenagakerjaan` (`id_ketenagakerjaan`, `jht_perusahaan`, `jht_karyawan`, `jkm`, `jp_perusahaan`, `jp_karyawan`) VALUES (1, '3.7', '2', '0.3', '2', '1');


