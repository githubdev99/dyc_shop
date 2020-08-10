-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2020 pada 15.25
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(20) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
('ADMIN', 'Admin DYC Shop', 'admin', '$2y$10$w17rhAc1XoRRPz1k3nZozuY0WfAZbLowMHoLjW415z5mYwhWKHU6y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` char(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `email` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `harga` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_sub_kategori`, `kode_sku`, `nama_produk`, `harga`, `foto`, `stok`, `deskripsi`, `created_datetime`) VALUES
('P-202008021196', 'K-202007319642', 'KS-202007317214', 'PE-1233002', 'Anting Bulat Corak Macan Tutul', 10000, 'IMG-202008028225.jpg', 34, 'Anting Bulat Corak Macan Tutul', '2020-08-02 11:10:00'),
('P-202008021278', 'K-202007314314', 'KS-202007316494', 'SK-55235905', 'Bros Flower Circle', 10000, 'IMG-202008021131.jpg', 10, 'Bros Flower Circle', '2020-08-02 11:18:18'),
('P-202008021569', 'K-202007312820', 'KS-202007312744', 'CH-800102', 'Ikat Rambut Spiral Cat', 10000, 'IMG-202008028282.jpg', 25, 'Ikat Rambut Spiral Cat', '2020-08-02 11:20:32'),
('P-202008021826', 'K-202007319642', 'KS-202007312650', 'PR-122005', 'Anting Panjang Gradasi Coklat Biru', 10000, 'IMG-202008026664.jpg', 30, 'Anting Panjang Gradasi Coklat Biru', '2020-08-02 10:59:36'),
('P-202008022019', 'K-202007319642', 'KS-202007312650', 'PR-122002', 'Anting Matahari Kuning', 10000, 'IMG-202008023277.jpg', 30, 'Anting Matahari Kuning', '2020-08-02 10:55:40'),
('P-202008022024', 'K-202007319642', 'KS-202007317214', 'PE-1233002', 'Anting Bunga Corak Macan Tutul', 10000, 'IMG-202008026160.jpg', 34, 'Anting Bunga Corak Macan Tutul', '2020-08-02 11:09:34'),
('P-202008022490', 'K-202007319642', 'KS-202007317214', 'PE-1233003', 'Anting Drop Heart', 10000, 'IMG-202008026403.jpg', 34, 'Anting Drop Heart', '2020-08-02 11:11:44'),
('P-202008023302', 'K-202007314314', 'KS-202007316494', 'SK-55235904', 'Bros Butterfly', 10000, 'IMG-202008021320.jpg', 10, 'Bros Butterfly', '2020-08-02 11:17:46'),
('P-202008023516', 'K-202007314314', 'KS-202007316494', 'SK-55235902', 'Bros Cameo Vintage', 10000, 'IMG-202008024724.jpg', 10, 'Bros Cameo Vintage', '2020-08-02 11:16:38'),
('P-202008023788', 'K-202007319642', 'KS-202007312650', 'PR-122004', 'Anting Oval Ungu', 10000, 'IMG-202008028289.jpg', 30, 'Anting Oval Ungu', '2020-08-02 10:58:28'),
('P-202008024415', 'K-202007314314', 'KS-202007316494', 'SK-55235901', 'Bros Blue Flower', 10000, 'IMG-202008026927.jpg', 10, 'Bros Blue Flower', '2020-08-02 11:16:06'),
('P-202008024698', 'K-202007319642', 'KS-202007312650', 'PR-122003', 'Anting Huruf T', 10000, 'IMG-202008027460.jpg', 30, 'Anting Huruf T', '2020-08-02 10:57:16'),
('P-202008025183', 'K-202007319642', 'KS-202007317214', 'PE-1233005', 'Anting Balon Kerlip Ungu', 10000, 'IMG-202008025886.jpg', 34, 'Anting Balon Kerlip Ungu', '2020-08-02 11:14:27'),
('P-202008025214', 'K-202007319642', 'KS-202007317214', 'PE-1233005', 'Anting Balon Kerlip Pink', 10000, 'IMG-202008021768.jpg', 34, 'Anting Balon Kerlip Pink', '2020-08-02 11:14:54'),
('P-202008025891', 'K-202007312820', 'KS-202007312744', 'CH-800101', 'Ikat Rambut Cutie', 10000, 'IMG-202008021341.png', 25, 'Ikat Rambut Cutie', '2020-08-02 11:19:53'),
('P-202008025954', 'K-202007319642', 'KS-202007312650', 'PR-122001', 'Anting Belimbing', 10000, 'IMG-202008027330.jpg', 30, 'Anting Belimbing', '2020-08-02 10:53:06'),
('P-202008026160', 'K-202007312820', 'KS-202007312744', 'CH-800103', 'Ikat Rambut Kristal', 10000, 'IMG-202008023828.jpg', 25, 'Ikat Rambut Kristal', '2020-08-02 11:21:13'),
('P-202008026377', 'K-202007314314', 'KS-202007316494', 'SK-55235903', 'Bros Cartoon Love', 10000, 'IMG-202008026651.jpg', 10, 'Bros Cartoon Love', '2020-08-02 11:17:08'),
('P-202008026811', 'K-202007319642', 'KS-202007317214', 'PE-1233004', 'Anting Batu Druzy Hijau', 10000, 'IMG-202008022461.jpg', 34, 'Anting Batu Druzy Hijau', '2020-08-02 11:13:31'),
('P-202008027106', 'K-202007319642', 'KS-202007312650', 'PR-122001', 'Anting Bawang', 10000, 'IMG-202008027371.jpg', 30, 'Anting Bawang', '2020-08-02 10:54:45'),
('P-202008027504', 'K-202007319642', 'KS-202007317214', 'PE-1233003', 'Anting Drop Geometri', 10000, 'IMG-202008024800.jpg', 34, 'Anting Drop Geometri', '2020-08-02 11:12:13'),
('P-202008027578', 'K-202007319642', 'KS-202007317214', 'PE-1233001', 'Anting Black Ketupat', 10000, 'IMG-202008025461.jpg', 34, 'Anting Black Ketupat', '2020-08-02 11:07:51'),
('P-202008027809', 'K-202007319642', 'KS-202007312650', 'PR-122003', 'Anting Huruf F', 10000, 'IMG-202008029634.jpg', 30, 'Anting Huruf F', '2020-08-02 10:57:45'),
('P-202008028080', 'K-202007319642', 'KS-202007312650', 'PR-122005', 'Anting Segitiga Gradasi Coklat Hijau', 10000, 'IMG-202008021592.jpg', 30, 'Anting Panjang Gradasi Coklat Hijau', '2020-08-02 11:00:13'),
('P-202008028396', 'K-202007319642', 'KS-202007317214', 'PE-1233001', 'Anting Oval Love', 10000, 'IMG-202008022489.jpg', 34, 'Anting Oval Love', '2020-08-02 11:08:32'),
('P-202008028485', 'K-202007312820', 'KS-202007312744', 'CH-800104', 'Ikat Rambut Love Sea', 10000, 'IMG-202008023253.jpg', 25, 'Ikat Rambut Love Sea', '2020-08-02 11:21:51'),
('P-202008028601', 'K-202007312820', 'KS-202007312744', 'CH-800105', 'Ikat Rambut Mixed Colour Wood', 10000, 'IMG-202008026184.jpg', 25, 'Ikat Rambut Mixed Colour Wood', '2020-08-02 11:23:00'),
('P-202008028933', 'K-202007319642', 'KS-202007312650', 'PR-122004', 'Anting Oval Merah', 10000, 'IMG-202008024142.jpg', 30, 'Anting Oval Merah', '2020-08-02 10:58:51'),
('P-202008029581', 'K-202007319642', 'KS-202007312650', 'PR-122002', 'Anting Matahari Putih', 10000, 'IMG-202008029205.jpg', 30, 'Anting Matahari Putih', '2020-08-02 10:56:27'),
('P-202008029985', 'K-202007319642', 'KS-202007317214', 'PE-1233004', 'Anting Batu Druzy Pink', 10000, 'IMG-202008024014.jpg', 34, 'Anting Batu Druzy Pink', '2020-08-02 11:13:08'),
('P-202008103200', 'K-202007312495', 'KS-202007314022', 'IN-173401', 'Kalung Bulan Sabit Biru', 10000, 'IMG-202008105937.jpg', 30, 'Kalung Bulan Sabit Biru', '2020-08-10 00:08:01'),
('P-202008103286', 'K-202007318991', 'KS-202007316483', 'BF-561440401', 'Gelang Batik Merah Coklat', 10000, 'IMG-202008104445.jpg', 20, 'Gelang Batik Merah Coklat', '2020-08-10 00:09:15'),
('P-202008103433', 'K-202007312495', 'KS-202007314022', 'IN-173401', 'Kalung Air Laut Bulat', 10000, 'IMG-202008104315.jpg', 30, 'Kalung Air Laut Bulat', '2020-08-10 00:05:28');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(20) NOT NULL,
  `id_customer` char(20) NOT NULL,
  `id_produk` char(20) NOT NULL,
  `no_order` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_transaksi` int(11) NOT NULL,
  `harga_ongkir` int(11) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `status` enum('Belum Dibayar','Sudah Dibayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_produk` (`id_produk`);

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
