-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 08:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `tahun_terbit` char(4) DEFAULT NULL,
  `penulis` varchar(128) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `id_penerbit`, `tahun_terbit`, `penulis`, `isbn`, `id_kategori`) VALUES
(1, 'Detektif Conan', 1, '2020', 'Aoyama Gosho', '9786230015731', 1),
(2, 'Koleksi Program Web PHP', 1, '2020', 'YUNIAR SUPARDI &amp; IRWAN KURNIAWAN, S.KOM.', '9786230014994', 5),
(3, 'Si Kancil &amp; Teman-Temannya', 2, '2019', 'Mulasih &amp; Nafika', ' 9786237046271', 3),
(4, 'Dibalik DPR dan MPR', 3, '2014', 'Aladin Isyawan', '9786230014000X', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(64) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `keterangan`) VALUES
(1, 'Novel', 'Novel adalah sebuah karya fiksi prosa yang tertulis dan naratif; biasanya dalam bentuk cerita.'),
(2, 'Kamus', 'Kamus adalah buku acuan yg memuat kata dan ungkapan'),
(3, 'Dongeng', 'Dongeng, merupakan suatu kisah yang di angkat dari pemikiran fiktif dan kisah nyata'),
(4, 'Biografi', 'Biografi adalah kisah atau keterangan tentang kehidupan seseorang.'),
(5, 'Komputer', 'Buku yang berhubungan dengan komputer'),
(6, 'Politik', 'Buku tentang politik');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` int(11) NOT NULL,
  `nama_penerbit` varchar(128) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama_penerbit`, `alamat`, `no_telp`) VALUES
(1, 'Elek Media Komputindo', 'Gedung Kompas-Gramedia Lantai 2, Jl. Palmerah Barat No. 29 – 32', '02153650110'),
(2, 'Andi Publisher', 'Jl. Raya Ceger No. 42', '02184590064'),
(3, 'Gagas Media', 'Jln. H. Montong No. 57, Ciganjur', '02178883030'),
(4, 'Gramedia Widiasarana Indonesia', 'Gd. Kompas Gramedia Unit I, Lt. 3 Jalan Palmerah Barat 33-37', '02153650110'),
(5, 'Erlangga', 'Jl. H. Baping Raya No. 100 Ciracas', '0218717006');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penerbit` (`id_penerbit`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
