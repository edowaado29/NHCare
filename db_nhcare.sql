-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 03:43 AM
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
-- Database: `db_nhcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_acara`
--

CREATE TABLE `tb_acara` (
  `id_acara` int(11) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_acara` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_acara`
--

INSERT INTO `tb_acara` (`id_acara`, `judul`, `deskripsi`, `tanggal_acara`, `id_user`) VALUES
(1, 'Acara 1', '', '2023-11-14 02:58:22', 1),
(2, 'Acara 2', '', '2023-11-14 02:58:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_anakasuh`
--

CREATE TABLE `tb_anakasuh` (
  `id_anakasuh` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `keterangan` varchar(64) NOT NULL,
  `asrama` varchar(64) NOT NULL,
  `no_akta` varchar(32) NOT NULL,
  `img_akta` blob NOT NULL,
  `no_kk` char(16) NOT NULL,
  `img_kk` blob NOT NULL,
  `no_skko` varchar(32) NOT NULL,
  `img_skko` blob NOT NULL,
  `status` varchar(16) NOT NULL,
  `img_anak` blob NOT NULL,
  `nama_sekolah` varchar(32) NOT NULL,
  `tingkat` varchar(32) NOT NULL,
  `kelas` varchar(32) NOT NULL,
  `cabang` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_anakasuh`
--

INSERT INTO `tb_anakasuh` (`id_anakasuh`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `keterangan`, `asrama`, `no_akta`, `img_akta`, `no_kk`, `img_kk`, `no_skko`, `img_skko`, `status`, `img_anak`, `nama_sekolah`, `tingkat`, `kelas`, `cabang`) VALUES
(1, '', 'Anak 1', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, '', 'Anak 2', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_donasi`
--

CREATE TABLE `tb_donasi` (
  `id_donasi` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_donasi` datetime NOT NULL,
  `id_donatur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_donasi`
--

INSERT INTO `tb_donasi` (`id_donasi`, `nominal`, `tgl_donasi`, `id_donatur`) VALUES
(1, 1000000, '2023-11-14 03:29:29', 1),
(2, 2000000, '2023-11-14 03:29:29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_donatur`
--

CREATE TABLE `tb_donatur` (
  `id_donatur` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `img_profil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_donatur`
--

INSERT INTO `tb_donatur` (`id_donatur`, `nama`, `email`, `password`, `no_hp`, `alamat`, `jenis_kelamin`, `img_profil`) VALUES
(1, 'Donatur 1', 'd1@gmail.com', '', '', '', '', ''),
(2, 'Donatur 2', 'd2@gmail.com', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faq`
--

CREATE TABLE `tb_faq` (
  `id_faq` int(11) NOT NULL,
  `pertanyaan` varchar(64) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_faq`
--

INSERT INTO `tb_faq` (`id_faq`, `pertanyaan`, `jawaban`) VALUES
(1, 'Apa itu NHCare?', 'NHCare...'),
(2, 'Apa saja metode pembayaran di NHCare?', 'Metode pembayaran NHCare...');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan_pegawai`
--

CREATE TABLE `tb_jabatan_pegawai` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jabatan_pegawai`
--

INSERT INTO `tb_jabatan_pegawai` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Admin'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan_terakhir` varchar(8) NOT NULL,
  `status_kepegawaian` varchar(32) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(64) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` varchar(16) NOT NULL,
  `img_pegawai` blob NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `pendidikan_terakhir`, `status_kepegawaian`, `alamat`, `no_hp`, `email`, `tanggal_masuk`, `status`, `img_pegawai`, `id_jabatan`) VALUES
(1, 'Pegawai 1', '', '', '0000-00-00', '', '', '', '', 'p1@gmail.com', '0000-00-00', '', '', 1),
(2, 'Pegawai 2', '', '', '0000-00-00', '', '', '', '', 'p2@gmail.com', '0000-00-00', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `nama_pengeluaran` varchar(64) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_pengeluaran` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `nama_pengeluaran`, `nominal`, `tgl_pengeluaran`, `id_user`) VALUES
(1, 'Pengeluaran 1', 1000000, '2023-11-14 03:37:45', 1),
(2, 'Pengeluaran 2', 2000000, '2023-11-14 03:37:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id_program` int(11) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `deskripsi` text NOT NULL,
  `img_program` blob NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id_program`, `judul`, `deskripsi`, `img_program`, `id_user`) VALUES
(1, 'Program 1', '', '', 1),
(2, 'Program 2', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `password`, `no_hp`) VALUES
(1, 'Edowaado!', 'chrltt@hldrive.com', '$2y$10$PbMW50oM18.yURjPhjgRPOKalNJ8Z3vq2mVOXEOwKKbGsZwCHYjeu', '082234514937');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wali`
--

CREATE TABLE `tb_wali` (
  `id_wali` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `hubungan` varchar(16) NOT NULL,
  `id_anakasuh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_wali`
--

INSERT INTO `tb_wali` (`id_wali`, `nik`, `nama`, `no_hp`, `hubungan`, `id_anakasuh`) VALUES
(1, '', 'Wali 1', '', '', 1),
(2, '', 'Wali 2', '', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_acara`
--
ALTER TABLE `tb_acara`
  ADD PRIMARY KEY (`id_acara`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_anakasuh`
--
ALTER TABLE `tb_anakasuh`
  ADD PRIMARY KEY (`id_anakasuh`);

--
-- Indexes for table `tb_donasi`
--
ALTER TABLE `tb_donasi`
  ADD PRIMARY KEY (`id_donasi`),
  ADD KEY `id_donatur` (`id_donatur`);

--
-- Indexes for table `tb_donatur`
--
ALTER TABLE `tb_donatur`
  ADD PRIMARY KEY (`id_donatur`);

--
-- Indexes for table `tb_faq`
--
ALTER TABLE `tb_faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indexes for table `tb_jabatan_pegawai`
--
ALTER TABLE `tb_jabatan_pegawai`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id_program`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_wali`
--
ALTER TABLE `tb_wali`
  ADD PRIMARY KEY (`id_wali`),
  ADD KEY `id_anakasuh` (`id_anakasuh`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_acara`
--
ALTER TABLE `tb_acara`
  ADD CONSTRAINT `user_acara_c1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_donasi`
--
ALTER TABLE `tb_donasi`
  ADD CONSTRAINT `donatur_donasi_c1` FOREIGN KEY (`id_donatur`) REFERENCES `tb_donatur` (`id_donatur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `pegawai_jabatan_c1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan_pegawai` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD CONSTRAINT `user_pengeluaran_c1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `user_program_c1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_wali`
--
ALTER TABLE `tb_wali`
  ADD CONSTRAINT `anakasuh_wali_c1` FOREIGN KEY (`id_anakasuh`) REFERENCES `tb_anakasuh` (`id_anakasuh`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
