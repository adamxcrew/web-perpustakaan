-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2020 at 03:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id_kategori` int(11) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `id_penerbit`, `tahun_terbit`, `penulis`, `isbn`, `id_kategori`, `tgl_input`) VALUES
(1, 'Detektif Conan', 1, '2020', 'Aoyama Gosho', '9786230015731', 1, '2020-05-14'),
(2, 'Koleksi Program Web PHP', 1, '2020', 'YUNIAR SUPARDI &amp; IRWAN KURNIAWAN, S.KOM.', '9786230014994', 5, '2020-05-14'),
(3, 'Si Kancil &amp; Teman-Temannya', 2, '2019', 'Mulasih &amp; Nafika', ' 9786237046271', 3, '2020-05-14'),
(7, 'Pintar Microsoft Office', 4, '2020', 'Aladin Isyawan', '9786230014000Y', 5, '2020-05-19'),
(8, 'Jadi Youtuber', 1, '2018', 'Popeye', '9786230014000ZX', 5, '2020-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjaman`
--

CREATE TABLE `detail_pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pinjaman`
--

INSERT INTO `detail_pinjaman` (`id_pinjaman`, `id_buku`) VALUES
(7, 1),
(7, 2),
(8, 1),
(8, 3),
(9, 3),
(10, 2),
(11, 7),
(11, 8),
(12, 3),
(12, 1),
(12, 2),
(13, 1),
(14, 2),
(15, 3),
(16, 8),
(16, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `denda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_member`, `tanggal_pinjam`, `lama_pinjam`, `tanggal_kembali`, `denda`) VALUES
(7, 5, '2020-05-18', 3, '2020-05-19', 0),
(8, 5, '2020-05-19', 3, '2020-05-19', 0),
(9, 5, '2020-05-19', 3, '2020-05-23', 20000),
(10, 5, '2020-05-19', 3, '2020-05-23', 10000),
(11, 5, '2020-05-19', 7, '2020-05-28', 20000),
(12, 5, '2020-05-19', 7, '2020-05-23', 0),
(13, 5, '2020-05-19', 3, NULL, NULL),
(14, 5, '2020-05-19', 3, NULL, NULL),
(15, 5, '2020-05-23', 7, '2020-05-28', 0),
(16, 6, '2020-05-23', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` char(1) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`) VALUES
(4, 'admin', '$2y$10$QSkKJtJCRxCPJlr13od76uSzQwFd3lj/k3DWlV9dg9zkvvv.m9hVW', '1', 'Admin'),
(5, 'andikatedja', '$2y$10$lzy5dqf4pJlglsXnso46u.u9.YsHPbk.tnut7LVEa8HKLL/clJUF.', '2', 'Andika Tedja'),
(6, 'anyageraldine', '$2y$10$r/wS0twqMoAcmMd4iYIeaOYixwGaneXx769.PL2Tj1uJtDH2D3dJq', '2', 'Anya Geraldine');

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
-- Indexes for table `detail_pinjaman`
--
ALTER TABLE `detail_pinjaman`
  ADD KEY `id_pinjaman` (`id_pinjaman`),
  ADD KEY `id_buku` (`id_buku`);

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
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
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

--
-- Constraints for table `detail_pinjaman`
--
ALTER TABLE `detail_pinjaman`
  ADD CONSTRAINT `detail_pinjaman_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `pinjaman` (`id_pinjaman`),
  ADD CONSTRAINT `detail_pinjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
