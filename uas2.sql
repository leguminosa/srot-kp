-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 04:16 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id_admin` int(10) NOT NULL,
  `Nama_admin` varchar(30) NOT NULL,
  `Jabatan` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id_admin`, `Nama_admin`, `Jabatan`, `Email`, `Password`) VALUES
(82515000, 'Stefanny', 'Admin', 'stefanny@gmail.com', '12345'),
(82515001, 'Yoli', 'Seketaris', 'yola@gmail.com', '12345'),
(82515002, 'Tifanny Ike', 'Seketaris', 'tifannyike96@gmail.com', '12345'),
(825150008, 'Utari', 'Admin', 'utariapril39@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `dana_bipeks`
--

CREATE TABLE `dana_bipeks` (
  `Kd_bipeks` int(10) NOT NULL,
  `Bipeks_total` int(11) NOT NULL,
  `Periode_th_akad` varchar(11) NOT NULL,
  `Kd_ORMA` varchar(10) NOT NULL,
  `bipeks_sisa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dana_bipeks`
--

INSERT INTO `dana_bipeks` (`Kd_bipeks`, `Bipeks_total`, `Periode_th_akad`, `Kd_ORMA`, `bipeks_sisa`) VALUES
(1332, 40000000, '2019/2020', 'BEM FTI', 34500000),
(1333, 20000000, '2018/2019', 'Mapala', 20000000),
(1334, 15000000, '2018/2019', 'TEC', 12000000),
(1335, 17000000, '2017/2018', 'DPM FTI', 12000000);

-- --------------------------------------------------------

--
-- Table structure for table `detaillpj`
--

CREATE TABLE `detaillpj` (
  `Kd_detailLPJ` int(11) NOT NULL,
  `Nama_detailLPJ` varchar(255) DEFAULT NULL,
  `Keterangan_detailLPJ` varchar(255) DEFAULT NULL,
  `Nominal` int(30) NOT NULL,
  `No_LPJ` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detaillpj`
--

INSERT INTO `detaillpj` (`Kd_detailLPJ`, `Nama_detailLPJ`, `Keterangan_detailLPJ`, `Nominal`, `No_LPJ`) VALUES
(4514, 'Uang muka diterima', 'Pemasukan', 2500000, 1324),
(4515, 'Swadaya 3', 'Pengeluaran', 200000, 1324),
(4516, 'Swadaya 5', 'Pemasukan', 1000, 1324),
(4517, 'Swadaya 53', 'Pemasukan', 1000, 1324),
(4522, 'Uang muka diterima', 'Pemasukan', 950084000, 123445566),
(4523, 'Uang muka diterima', 'Pemasukan', 3000000, 45691);

-- --------------------------------------------------------

--
-- Table structure for table `detail_ketuaorma`
--

CREATE TABLE `detail_ketuaorma` (
  `Kd_KetuaORMA` int(11) NOT NULL,
  `Nama_KetuaORMA` varchar(255) NOT NULL,
  `NIM` int(8) NOT NULL,
  `Periode_KetuaORMA` varchar(11) NOT NULL,
  `Kd_ORMA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_ketuaorma`
--

INSERT INTO `detail_ketuaorma` (`Kd_KetuaORMA`, `Nama_KetuaORMA`, `NIM`, `Periode_KetuaORMA`, `Kd_ORMA`) VALUES
(345, 'Hizkia C.', 825150026, '2017/2018', 'DPM FTI DPM Fakultas Teknologi Informasi'),
(5446, 'Irvan', 825140001, '2018/2019', 'BEM FTI BEM Falkutas Teknologi Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `kategorikegiatan`
--

CREATE TABLE `kategorikegiatan` (
  `Kd_kategori` int(5) NOT NULL,
  `Nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorikegiatan`
--

INSERT INTO `kategorikegiatan` (`Kd_kategori`, `Nama_kategori`) VALUES
(238, 'Bakat dan Minat'),
(239, 'Pelatihan Kepemimpinan'),
(241, 'LATIHAN DASAR KEPEMIMPINAN'),
(242, 'Forkam');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `Kd_kegiatan` int(10) NOT NULL,
  `Nama_kegiatan` varchar(255) NOT NULL,
  `Waktu_pelaksanaan` varchar(20) NOT NULL,
  `Ketua_pelaksana` varchar(30) NOT NULL,
  `Bipeks_terprogram` int(11) NOT NULL,
  `Kd_bipeks` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`Kd_kegiatan`, `Nama_kegiatan`, `Waktu_pelaksanaan`, `Ketua_pelaksana`, `Bipeks_terprogram`, `Kd_bipeks`) VALUES
(1221, 'Latihan Kepemimpinan', 'Januari 2019', 'Diana', 2500000, 1329),
(1222, 'Latihan Kepemimpinan', 'Januari 2019', 'Tari', 2500000, 1332),
(1223, 'MENJERIT JERIT', 'FEB 2018', 'YOLCE', 3000000, 1334),
(1224, 'Latihan Kepemimpinan ', 'Maret 2019', 'Hizkia', 2500000, 1335);

-- --------------------------------------------------------

--
-- Table structure for table `lpj`
--

CREATE TABLE `lpj` (
  `No_LPJ` int(10) NOT NULL,
  `Total_Pemasukan` int(11) NOT NULL,
  `Total_Pengeluaran` int(11) NOT NULL,
  `Sisa_selisih` int(11) NOT NULL,
  `Tgl_penerimaanLPJ` date NOT NULL,
  `Keterangan_sisaselisih` varchar(50) NOT NULL,
  `scan` varchar(100) NOT NULL,
  `No_SIK` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lpj`
--

INSERT INTO `lpj` (`No_LPJ`, `Total_Pemasukan`, `Total_Pengeluaran`, `Sisa_selisih`, `Tgl_penerimaanLPJ`, `Keterangan_sisaselisih`, `scan`, `No_SIK`) VALUES
(45691, 3000000, 0, 3000000, '2019-03-21', '200000', '$', '010-DIR.MHSA/101/UNTAR/I/2019'),
(123445566, 1900168000, 202920000, 1697248000, '2018-12-12', 'SU', '', '038-DIR.MHSA/101/UNTAR/I/2017');

-- --------------------------------------------------------

--
-- Table structure for table `orma`
--

CREATE TABLE `orma` (
  `Kd_ORMA` varchar(255) NOT NULL,
  `Nama_ORMA` varchar(35) NOT NULL,
  `Nama_ketua` varchar(30) NOT NULL,
  `NIM_ketua` varchar(9) NOT NULL,
  `Periode_ketua` varchar(11) NOT NULL,
  `Id_unitkerja` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orma`
--

INSERT INTO `orma` (`Kd_ORMA`, `Nama_ORMA`, `Nama_ketua`, `NIM_ketua`, `Periode_ketua`, `Id_unitkerja`) VALUES
('BEM FTI', 'BEM Falkutas Teknologi Informasi', 'Irvan', '535150010', '2018/2019', 1239),
('DPM FTI', 'DPM Fakultas Teknologi Informasi', 'Hizkia C.', '825150026', '2017/2018', 1239),
('Mapala', 'Mahasiswa Pecinta Alam', 'Vebbyana', '825150003', '2018/2019', 1239),
('TEC', 'Tarumanagara English Center', 'Utari', '825150008', '2018/2019', 1242);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `No_proposal` varchar(30) NOT NULL,
  `Nama_kegiatan` varchar(255) NOT NULL,
  `Tgl_masuk_proposal` date NOT NULL,
  `Tgl_pelaksanaan` date NOT NULL,
  `Tempat_pelaksanaan` varchar(255) NOT NULL,
  `Tema_kegiatan` varchar(255) NOT NULL,
  `Total_kegiatan` int(11) NOT NULL,
  `Bipeks_terprogram` int(11) NOT NULL,
  `Kd_kategori` int(5) NOT NULL,
  `Kd_kegiatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`No_proposal`, `Nama_kegiatan`, `Tgl_masuk_proposal`, `Tgl_pelaksanaan`, `Tempat_pelaksanaan`, `Tema_kegiatan`, `Total_kegiatan`, `Bipeks_terprogram`, `Kd_kategori`, `Kd_kegiatan`) VALUES
(' 008-DIR.MHSA/101/UNTAR/I/2019', 'Latihan Kepemimpinan', '2018-11-17', '2018-12-14', 'Jakarta Utara', 'Latihan Kepemimpinan ', 2500000, 3000000, 241, 1222),
('12345', 'Latihan Kepemimpinan ', '2018-12-07', '2019-01-05', 'Jakarta Utara', 'Latihan Kepemimpinan ', 2500000, 2500000, 239, 1224),
('321222', 'MENJERIT JERIT', '2018-11-30', '2018-12-12', 'Cisarua Bogor', 'JIWA JIWA TERSAKITI', 0, 3000000, 239, 1223),
('9812', 'Latihan Kepemimpinan ', '2018-12-14', '2019-01-14', 'Bogor', 'Latihan Kepemimpinan ', 2500000, 2500000, 239, 1224),
('999', 'Latihan Kepemimpinan', '2018-11-02', '2018-11-28', 'Cisarua Bogor', 'memiliki jiwa ksatria dan patriot', 12000000, 2500000, 239, 1222);

-- --------------------------------------------------------

--
-- Table structure for table `sik`
--

CREATE TABLE `sik` (
  `No_SIK` varchar(33) NOT NULL,
  `Tgl_SIK` date NOT NULL,
  `Perihal` varchar(50) NOT NULL,
  `No_proposal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sik`
--

INSERT INTO `sik` (`No_SIK`, `Tgl_SIK`, `Perihal`, `No_proposal`) VALUES
('008-DIR.MHSA/101/UNTAR/I/2018', '2018-12-12', 'Direktur Kemahasiswaan dan Alumni', '999'),
('010-DIR.MHSA/101/UNTAR/I/2019', '2019-01-07', 'Kegiatan', '9812'),
('038-DIR.MHSA/101/UNTAR/I/2017', '2018-11-26', 'Kegiatan', '321222');

-- --------------------------------------------------------

--
-- Table structure for table `sik_tembusan`
--

CREATE TABLE `sik_tembusan` (
  `id` int(11) NOT NULL,
  `No_SIK` varchar(33) NOT NULL,
  `Kd_Tembusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sik_tembusan`
--

INSERT INTO `sik_tembusan` (`id`, `No_SIK`, `Kd_Tembusan`) VALUES
(1, 'qwe123rt', 1),
(2, 'qwe123rt', 2),
(3, 'qwe123rt', 3),
(4, 'qwe123rt', 4),
(6, '008-DIR.MHSA/101/UNTAR/I/2018', 3),
(9, '008-DIR.MHSA/101/UNTAR/I/2018', 7),
(12, '038-DIR.MHSA/101/UNTAR/I/2017', 8),
(13, '010-DIR.MHSA/101/UNTAR/I/2019', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tembusan`
--

CREATE TABLE `tembusan` (
  `Kd_Tembusan` int(11) NOT NULL,
  `Nama_Tembusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tembusan`
--

INSERT INTO `tembusan` (`Kd_Tembusan`, `Nama_Tembusan`) VALUES
(6, 'Rektor'),
(7, 'Manajer Penalaran'),
(8, 'HUMAS'),
(9, 'ADKU'),
(10, 'Kabag');

-- --------------------------------------------------------

--
-- Table structure for table `th_akad`
--

CREATE TABLE `th_akad` (
  `Periode_th_akad` varchar(10) NOT NULL,
  `Keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `th_akad`
--

INSERT INTO `th_akad` (`Periode_th_akad`, `Keterangan`) VALUES
('2012/2013', 'Genap'),
('2014/2015', 'Genap'),
('2017/2018', 'Genap'),
('2018/2019', 'Ganjil'),
('2019/2020', 'genap'),
('2020/2021', 'ganjil'),
('2021/2022', 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `unitkerja`
--

CREATE TABLE `unitkerja` (
  `Id_unitkerja` int(4) NOT NULL,
  `Nama_unitkerja` varchar(30) NOT NULL,
  `Keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unitkerja`
--

INSERT INTO `unitkerja` (`Id_unitkerja`, `Nama_unitkerja`, `Keterangan`) VALUES
(1239, 'Falkutas Teknologi Informasi', 'Gedung R'),
(1241, 'Falkutas Psikologi', 'Gedung L'),
(1242, 'UNTAR', 'Universitas Tarumanagara'),
(1243, 'Falkutas Teknik', 'Gedung L'),
(1244, 'Falkutas Kedokteran', 'gedung L'),
(1246, 'Fakultas Seni Rupa dan Desain', 'Gedung R');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_admin`);

--
-- Indexes for table `dana_bipeks`
--
ALTER TABLE `dana_bipeks`
  ADD PRIMARY KEY (`Kd_bipeks`);

--
-- Indexes for table `detaillpj`
--
ALTER TABLE `detaillpj`
  ADD PRIMARY KEY (`Kd_detailLPJ`);

--
-- Indexes for table `detail_ketuaorma`
--
ALTER TABLE `detail_ketuaorma`
  ADD PRIMARY KEY (`Kd_KetuaORMA`);

--
-- Indexes for table `kategorikegiatan`
--
ALTER TABLE `kategorikegiatan`
  ADD PRIMARY KEY (`Kd_kategori`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`Kd_kegiatan`);

--
-- Indexes for table `lpj`
--
ALTER TABLE `lpj`
  ADD PRIMARY KEY (`No_LPJ`);

--
-- Indexes for table `orma`
--
ALTER TABLE `orma`
  ADD PRIMARY KEY (`Kd_ORMA`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`No_proposal`);

--
-- Indexes for table `sik`
--
ALTER TABLE `sik`
  ADD PRIMARY KEY (`No_SIK`);

--
-- Indexes for table `sik_tembusan`
--
ALTER TABLE `sik_tembusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tembusan`
--
ALTER TABLE `tembusan`
  ADD PRIMARY KEY (`Kd_Tembusan`);

--
-- Indexes for table `th_akad`
--
ALTER TABLE `th_akad`
  ADD PRIMARY KEY (`Periode_th_akad`);

--
-- Indexes for table `unitkerja`
--
ALTER TABLE `unitkerja`
  ADD PRIMARY KEY (`Id_unitkerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=825150009;
--
-- AUTO_INCREMENT for table `dana_bipeks`
--
ALTER TABLE `dana_bipeks`
  MODIFY `Kd_bipeks` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1336;
--
-- AUTO_INCREMENT for table `detaillpj`
--
ALTER TABLE `detaillpj`
  MODIFY `Kd_detailLPJ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4524;
--
-- AUTO_INCREMENT for table `detail_ketuaorma`
--
ALTER TABLE `detail_ketuaorma`
  MODIFY `Kd_KetuaORMA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5447;
--
-- AUTO_INCREMENT for table `kategorikegiatan`
--
ALTER TABLE `kategorikegiatan`
  MODIFY `Kd_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `Kd_kegiatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1225;
--
-- AUTO_INCREMENT for table `lpj`
--
ALTER TABLE `lpj`
  MODIFY `No_LPJ` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123445567;
--
-- AUTO_INCREMENT for table `sik_tembusan`
--
ALTER TABLE `sik_tembusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tembusan`
--
ALTER TABLE `tembusan`
  MODIFY `Kd_Tembusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `unitkerja`
--
ALTER TABLE `unitkerja`
  MODIFY `Id_unitkerja` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1247;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
