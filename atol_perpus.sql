-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Jul 2018 pada 08.06
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atol_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `nim` int(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `program_studi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`nim`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `program_studi`) VALUES
(10116121, 'Dzaki', '2018-07-02', 'Perempuan', 'Akuntansi'),
(10116123, 'Anissa', '1996-08-07', 'Perempuan', 'Akuntansi'),
(10116130, 'Affif ', '1996-12-21', 'Laki-laki', 'Manajemen'),
(10116133, 'Rahmad', '1997-07-12', 'Laki-laki', 'Teknik Komputer'),
(10116134, 'Fuji Muti', '1998-07-03', 'Perempuan', 'Akuntansi'),
(10116138, 'Satria Adi', '1997-05-23', 'Laki-laki', 'Akuntansi'),
(10116154, 'Ricky fahmi', '1996-04-06', 'Laki-laki', 'Akuntansi'),
(10116155, 'Ferri', '1997-05-08', 'Laki-laki', 'Teknik Komputer'),
(10116177, 'Rani M', '1995-06-12', 'Perempuan', 'Manajemen'),
(10116188, 'Iedul Mubaraq', '1996-08-23', 'Laki-laki', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `kode_buku` varchar(11) NOT NULL,
  `judul` varchar(25) NOT NULL,
  `pengarang` varchar(25) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `jml_buku` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `penerbit`, `jml_buku`) VALUES
('BK001', 'RPL', 'Suwito', 'Gramedia', 7),
('BK003', 'Kalkulus', 'Maksudi', 'Elex Media', 9),
('BK005', 'Sistem Informasi', 'Anna', 'Elex Media', 9),
('BK006', 'Operasi Sistem', 'Taryana', 'Gramedia', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `judul` varchar(25) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nama`, `judul`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(7, 'Rahmad', 'RPL', '2018-07-09', '2018-07-25'),
(8, 'Rani M', 'Operasi Sistem', '2018-07-02', '2018-07-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
