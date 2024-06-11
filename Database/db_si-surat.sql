-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 06:28 PM
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
-- Database: `db_si-surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `ID_AKUN` char(5) NOT NULL,
  `ID_PRODI` char(5) DEFAULT NULL,
  `ID_DEPARTEMEN` char(5) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `IMAGE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`ID_AKUN`, `ID_PRODI`, `ID_DEPARTEMEN`, `USERNAME`, `PASSWORD`, `EMAIL`, `IMAGE`) VALUES
('00001', 'P0002', 'D0001', 'Admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'admin1@gmail.com', NULL),
('00002', 'P0001', 'D0002', 'Ketua Jurusan TI', '149f070a8320cd179496cb0dbef0df98', 'ketuajurusanti@gmail.com', NULL),
('00003', 'P0001', 'D0004', 'Dosen1', 'f499263a253447dd5cb68dafb9f13235', 'dosen1@gmail.com', NULL),
('00004', 'P0002', 'D0001', 'Admin2', 'c84258e9c39059a89ab77d846ddab909', 'admin2@gmail.com', ''),
('00005', 'P0002', 'D0003', 'Rahimi Fitri, S.Kom., M.Kom.', '64edf5279ea238816d1373c6e3e212f9', 'rahimi@gmail.com', ''),
('00006', 'P0002', 'D0004', 'Ahmad Yusuf, S.Kom., M.Kom.', 'add3deb05fc6625aae939041e4131624', 'yusuf@gmail.com', ''),
('00007', 'P0002', 'D0002', 'Dr. Reza Fauzan, S.Kom., M.Kom.', '3ed6e995474bc6dddef7a6fc9b97c965', 'reza@gmail.com', ''),
('00008', 'P0001', 'D0003', 'Ir. H. Saifulah, M.T. ', 'b4831613bbdf7d2fbb021e4f21275872', 'saifullah@gmail.com', ''),
('00009', 'P0001', 'D0004', 'Zainal Abidin, SS.T, M.T', '7282d6fdf08ca7baac3dfd7c69f82abb', 'zainal@gmail.com', ''),
('00010', 'P0003', 'D0003', 'Khairunnisa, S.T., M.T.', 'ff6d11fad3287047fcafb104c276e63a', 'nisa@gmail.com', ''),
('00011', 'P0003', 'D0004', 'H. Sarifudin, ST, M.T.', '8a7b2f0267e8b9238bee8650c4d58446', 'sarifudin@gmail.com', ''),
('00012', 'P0004', 'D0003', 'Ir. Puhrani Burhan, M.T. ', 'c1a5c76d5d692a72c570ac3dcf1eaf5a', 'burhan@gmail.com', ''),
('00013', 'P0004', 'D0004', 'Ir. Eddy Robinson.S. MT', 'd7d70e72a02499f1637dbd8862f3e4b4', 'eddy@gmail.com', ''),
('00014', 'P0005', 'D0003', 'Subandi, S.T., M.Kom. ', '963bd33538e40d8d9d84fe36d90e18cb', 'subandi@gmail.com', ''),
('00015', 'P0005', 'D0004', 'Aulia Akhrian Syahidi, M. Kom.', 'b057fafb2bf9393ca615894e0426ff68', 'syahidi@gmail.com', ''),
('00016', 'P0001', 'D0002', 'H. Syamsudin Noor, S.T., M.T.', '697d0f4d891393c4e16798fc5396c617', 'syamsudin@gmail.com', ''),
('00017', 'P0001', 'D0004', 'Zainal Abidin, SS.T, M.T', '7282d6fdf08ca7baac3dfd7c69f82abb', 'zainal@gmail.com', ''),
('00018', 'P0003', 'D0004', 'Ir. H. Imansyah Noor, M.T', 'beeccdb438355c029a66dbec333fa1c8', 'imam@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `ID_DEPARTEMEN` char(5) NOT NULL,
  `NAMA_DEPARTEMEN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`ID_DEPARTEMEN`, `NAMA_DEPARTEMEN`) VALUES
('D0001', 'Admin'),
('D0002', 'Ketua Jurusan'),
('D0003', 'Ketua Program Studi'),
('D0004', 'Dosen');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `ID_JENIS` char(5) NOT NULL,
  `NAMA_JENIS` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`ID_JENIS`, `NAMA_JENIS`) VALUES
('J0001', 'Surat Masuk'),
('J0002', 'Surat Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `ID_PRODI` char(5) NOT NULL,
  `NAMA_PRODI` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`ID_PRODI`, `NAMA_PRODI`) VALUES
('P0001', 'D3 Teknik Listrik'),
('P0002', 'D3 Teknik Informatika'),
('P0003', 'D3 Teknik Elektronika'),
('P0004', 'D4 Teknologi Rekaya Pembangkit Listrik'),
('P0005', 'D4 Sistem Informasi Kota Cerdas'),
('P0006', 'D2 Pemngenbangan Aplikasi Bergerak');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `ID_SURAT` char(5) NOT NULL,
  `ID_AKUN` char(5) DEFAULT NULL,
  `ID_JENIS` char(5) DEFAULT NULL,
  `NO_SURAT` varchar(25) DEFAULT NULL,
  `PENGIRIM` varchar(50) DEFAULT NULL,
  `PENERIMA` varchar(50) DEFAULT NULL,
  `TGL_SURAT` date DEFAULT NULL,
  `TGL_TERIMA` date DEFAULT NULL,
  `PERIHAL` mediumtext DEFAULT NULL,
  `FILE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`ID_SURAT`, `ID_AKUN`, `ID_JENIS`, `NO_SURAT`, `PENGIRIM`, `PENERIMA`, `TGL_SURAT`, `TGL_TERIMA`, `PERIHAL`, `FILE`) VALUES
('00001', '00001', 'J0001', '000/002/22', 'rezal', 'Dosen1', '2023-06-22', '2023-06-22', 'download\r\n', 'Modul Pelatihan JWD Pertemuan 1 Online VSGA DTS 2023.pdf'),
('00002', '00001', 'J0001', '000/002/22', 'rezal', 'Dosen1', '2023-06-22', '2023-06-22', 'download 2', 'Tugas 1 - Muhammad Rezal Apriani.pdf'),
('00003', '00001', 'J0001', '000/000/201', 'admin1@gmail.com', 'Rahimi Fitri, S.Kom., M.Kom.', '2023-07-18', '2023-07-18', 'Tanggal Merah', 'surat edaran pengumuman libur.pdf'),
('00004', '00001', 'J0002', '000/000/202', 'admin1@gmail.com', 'Rahimi Fitri, S.Kom., M.Kom.', '2023-07-18', '2023-07-18', 'UAS Semester Genap 2022-2023', 'Jadwal Per Ruang.pdf'),
('00005', '00001', 'J0001', '000/000/203', 'admin1@gmail.com', 'Rahimi Fitri, S.Kom., M.Kom.', '2023-07-18', '2023-07-18', 'Jadwal', 'Jadwal Kelas Semester Genap 2021-2022.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`ID_AKUN`),
  ADD UNIQUE KEY `AKUN_PK` (`ID_AKUN`),
  ADD KEY `PRODI_FK` (`ID_PRODI`),
  ADD KEY `DEPARTEMEN_FK` (`ID_DEPARTEMEN`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`ID_DEPARTEMEN`),
  ADD UNIQUE KEY `DEPARTEMEN_PK` (`ID_DEPARTEMEN`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`ID_JENIS`),
  ADD UNIQUE KEY `JENISSURAT_PK` (`ID_JENIS`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`ID_PRODI`),
  ADD UNIQUE KEY `PROGRAMSTUDI_PK` (`ID_PRODI`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`ID_SURAT`),
  ADD UNIQUE KEY `SURAT_PK` (`ID_SURAT`),
  ADD KEY `MENGAKSES_FK` (`ID_AKUN`),
  ADD KEY `JENIS_FK` (`ID_JENIS`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `FK_AKUN_DEPARTEME_DEPARTEM` FOREIGN KEY (`ID_DEPARTEMEN`) REFERENCES `departemen` (`ID_DEPARTEMEN`),
  ADD CONSTRAINT `FK_AKUN_PRODI_PRODI` FOREIGN KEY (`ID_PRODI`) REFERENCES `prodi` (`ID_PRODI`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `FK_SURAT_JENIS_JENIS_SU` FOREIGN KEY (`ID_JENIS`) REFERENCES `jenis_surat` (`ID_JENIS`),
  ADD CONSTRAINT `FK_SURAT_MENGAKSES_AKUN` FOREIGN KEY (`ID_AKUN`) REFERENCES `akun` (`ID_AKUN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
