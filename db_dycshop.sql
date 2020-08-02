-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2020 pada 18.39
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dycshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` char(20) NOT NULL,
  `id_kategori` char(20) NOT NULL,
  `id_sub_kategori` char(20) DEFAULT NULL,
  `kode_sku` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id_kategori` char(20) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_kategori`
--

INSERT INTO `produk_kategori` (`id_kategori`, `nama_kategori`, `created_datetime`) VALUES
('K-202007312495', 'Kalung', '2020-07-31 23:22:59'),
('K-202007312820', 'Ikat Rambut', '2020-07-31 23:23:08'),
('K-202007314314', 'Bros', '2020-08-01 19:10:43'),
('K-202007318991', 'Gelang', '2020-07-31 23:46:30'),
('K-202007319642', 'Anting', '2020-07-31 23:22:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_sub_kategori`
--

CREATE TABLE `produk_sub_kategori` (
  `id_sub_kategori` char(20) NOT NULL,
  `id_kategori` char(20) NOT NULL,
  `nama_sub_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_sub_kategori`
--

INSERT INTO `produk_sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`) VALUES
('KS-202007311787', 'K-202007318991', 'Titanium Bracelets'),
('KS-202007312650', 'K-202007319642', 'Pretty Earrings'),
('KS-202007312744', 'K-202007312820', 'Charming Hairbands'),
('KS-202007314022', 'K-202007312495', 'Interesting Necklaces'),
('KS-202007316483', 'K-202007318991', 'Beautiful Bracelets'),
('KS-202007316494', 'K-202007314314', 'Sparkle Broochs'),
('KS-202007317214', 'K-202007319642', 'Perfect Earrings'),
('KS-202007319193', 'K-202007312495', 'Stunning Necklaces');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_sub_kategori` (`id_sub_kategori`);

--
-- Indeks untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `produk_sub_kategori`
--
ALTER TABLE `produk_sub_kategori`
  ADD PRIMARY KEY (`id_sub_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk_sub_kategori`
--
ALTER TABLE `produk_sub_kategori`
  ADD CONSTRAINT `produk_sub_kategori_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `produk_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
