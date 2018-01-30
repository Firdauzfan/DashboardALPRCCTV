-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 Jan 2018 pada 04.40
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `backup_track_plat`
--

CREATE TABLE `backup_track_plat` (
  `id_track` int(5) NOT NULL,
  `plat_no` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `nama_pengguna` varchar(15) NOT NULL,
  `nip` int(5) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tanda_aktif` enum('1','0','','') NOT NULL,
  `tanda_dihapus` enum('1','0','','') NOT NULL,
  `tanggal_dibuat` datetime NOT NULL,
  `tanggal_dihapus` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `nip`, `unit`, `jenis_kelamin`, `tanda_aktif`, `tanda_dihapus`, `tanggal_dibuat`, `tanggal_dihapus`) VALUES
(1, 'Firdauz Fanani', 12345, 'IT', 'L', '1', '0', '2018-01-15 00:00:00', '0000-00-00 00:00:00'),
(2, 'Chandra', 12345, 'IT', 'L', '1', '0', '2018-01-15 00:00:00', '2018-01-15 00:00:00'),
(3, 'Fanani', 54321, 'IT', 'L', '1', '0', '2018-01-16 00:00:00', '2018-01-16 09:28:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plat_nomor`
--

CREATE TABLE `plat_nomor` (
  `id_plat` int(5) NOT NULL,
  `text_plat` varchar(10) NOT NULL,
  `kepunyaan` int(10) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `plat_nomor`
--

INSERT INTO `plat_nomor` (`id_plat`, `text_plat`, `kepunyaan`, `tanggal_dibuat`) VALUES
(1, 'AB1895KA', 1, '2018-01-15 00:00:00'),
(2, 'D5161JX', 2, '2018-01-15 00:00:00'),
(3, 'B9320VUA', 3, '2018-01-16 09:29:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `track_plat`
--

CREATE TABLE `track_plat` (
  `id_track` int(5) NOT NULL,
  `plat_no` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `track_plat`
--

INSERT INTO `track_plat` (`id_track`, `plat_no`, `waktu`) VALUES
(1, 'AB1895KA', '2018-01-29 14:02:03'),
(3, 'D5161JX', '2018-01-29 14:02:12'),
(5, 'B9320VUA', '2018-01-29 14:02:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `plat_nomor`
--
ALTER TABLE `plat_nomor`
  ADD PRIMARY KEY (`id_plat`);

--
-- Indexes for table `track_plat`
--
ALTER TABLE `track_plat`
  ADD PRIMARY KEY (`id_track`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `plat_nomor`
--
ALTER TABLE `plat_nomor`
  MODIFY `id_plat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `track_plat`
--
ALTER TABLE `track_plat`
  MODIFY `id_track` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `pindah_data` ON SCHEDULE EVERY 1 DAY STARTS '2018-01-29 14:00:07' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO backup_track_plat (id_track, plat_no, waktu) SELECT id_track, plat_no, waktu FROM track_plat$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
