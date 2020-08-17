-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2020 pada 21.16
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
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` char(20) CHARACTER SET utf8mb4 NOT NULL,
  `id_produk` char(20) CHARACTER SET utf8mb4 NOT NULL,
  `id_customer` char(20) CHARACTER SET utf8mb4 NOT NULL,
  `qty` int(11) NOT NULL,
  `status_pilih` enum('Y','T') CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `id_produk`, `id_customer`, `qty`, `status_pilih`) VALUES
('PC-202008182413', 'P-202008025954', 'C-202008112064', 4, 'T'),
('PC-202008185591', 'P-202008025183', 'C-202008112064', 1, 'T'),
('PC-202008188510', 'P-202008021278', 'C-202008112064', 1, 'T'),
('PC-202008188614', 'P-202008027504', 'C-202008112064', 3, 'T');

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

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `email`, `no_telp`, `alamat`) VALUES
('C-202008112064', 'devan', '$2y$10$Qf/J5vPE3wQvBtRKkYhhWOS7VYQhvxGWxvbNKwZjr7sBEW4Nalldy', 'Devan Ramadhan', 'Laki-Laki', 'devan@gmail.com', '012345', 'Jl. Bintara'),
('C-202008117553', 'dycyeni', '$2y$10$iuVfHNirHM3ownA.KBhcN.dE5KlOwg64lEkBKT8l9Ca1D4byxUcVu', 'Yeni Anggraini', 'Perempuan', 'ayeni0566@gmail.com', '082112422030', 'Jl. Bintara 14 Rt 001/Rw 014, Bekasi Barat');

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
('P-202008021278', 'K-202007318991', 'KS-202007311787', 'TN-1994502', 'Gelang Bandul Bening', 31000, 'IMG-202008118516.jpg', 50, 'Gelang Titanium dengan bandul resin bening.', '2020-08-02 11:18:18'),
('P-202008021569', 'K-202007312820', 'KS-202007312744', 'CH-800102', 'Ikat Rambut Oval Orange', 37500, 'IMG-202008116607.jpeg', 40, 'Ikat Rambut dengan bandul resin yang berbentuk oval dengan gliter warna orange.', '2020-08-02 11:20:32'),
('P-202008021826', 'K-202007312495', 'KS-202007314022', 'IN-173405', 'Kalung Coklat Bunga Hitam', 30000, 'IMG-202008106382.jpg', 20, 'Kalung Resin dengan warna coklat dihiasi manik bunga hitam.', '2020-08-02 10:59:36'),
('P-202008022019', 'K-202007318991', 'KS-202007311787', 'TN-1994503', 'Gelang Bulat Merah dan Bening', 31000, 'IMG-202008113977.jpeg', 50, 'Gelang Titanium dengan bandul resin bening dan didalamnya ditambahkan gradasi warna merah dan orange.', '2020-08-02 10:55:40'),
('P-202008023302', 'K-202007318991', 'KS-202007311787', 'TN-1994501', 'Gelang Bintang Biru', 31000, 'IMG-202008111687.jpg', 55, 'Gelang Titanium dengan bandul resin bintang yang berwarna biru.', '2020-08-02 11:17:46'),
('P-202008023516', 'K-202007314314', 'KS-202007316494', 'SK-55235902', 'Bros Kipas Sakura', 21500, 'IMG-202008118670.jpeg', 50, 'Bros Resin dengan bingkai kipas sakura jepang.', '2020-08-02 11:16:38'),
('P-202008023788', 'K-202007312495', 'KS-202007314022', 'IN-173404', 'Kalung Love Pink', 30000, 'IMG-202008102682.jpg', 20, 'Kalung Resin dengan Bentuk Love dengan Manik bibir menambah kesan cute dan feminin.', '2020-08-02 10:58:28'),
('P-202008024415', 'K-202007314314', 'KS-202007316494', 'SK-55235901', 'Bros Batu Kristal', 21500, 'IMG-202008117279.jpeg', 80, 'Bros resin dengan bingkai batu kristal dan dihiasi berbagai macam warna yang cantik.', '2020-08-02 11:16:06'),
('P-202008024698', 'K-202007318991', 'KS-202007316483', 'BF-561440403', 'Gelang Daun Bening', 29000, 'IMG-202008117380.jpg', 30, 'Gelang Rantai dengan bandul resin yang berbentuk daun berwarna bening dan didalamnya terdapat tangkai/ranting tanaman.', '2020-08-02 10:57:16'),
('P-202008025183', 'K-202007319642', 'KS-202007317214', 'PE-1233004', 'Anting Balon Kerlip Ungu', 42500, 'IMG-202008025886.jpg', 34, 'Anting Balon Kerlip Ungu', '2020-08-02 11:14:27'),
('P-202008025214', 'K-202007319642', 'KS-202007317214', 'PE-1233005', 'Anting Batu Permata', 42500, 'IMG-202008109405.jpeg', 45, 'Anting Resin dengan desain bingkai batu permata dihiasi berbagai macam warna yang cantik.', '2020-08-02 11:14:54'),
('P-202008025891', 'K-202007312820', 'KS-202007312744', 'CH-800101', 'Ikat Rambut Glassy', 37500, 'IMG-202008116443.jpg', 40, 'Ikat Rambut dengan bandul resin yang perpaduan gradasi warna merah dan kuning.', '2020-08-02 11:19:53'),
('P-202008025954', 'K-202007319642', 'KS-202007312650', 'PR-122001', 'Anting Bunga Bening', 32000, 'IMG-202008102710.jpeg', 30, 'Anting Resin bening yang dihiasi dengan bunga kering berwarna pink yang cantik.', '2020-08-02 10:53:06'),
('P-202008026160', 'K-202007312495', 'KS-202007319193', 'ST-188903', 'Kalung Bunga Sakura', 34500, 'IMG-202008111166.jpg', 20, 'Kalung Resin dengan desain bingkai bunga sakura membuat penampilan terlihat semakin menawan.', '2020-08-02 11:21:13'),
('P-202008026377', 'K-202007312820', 'KS-202007312744', 'CH-800106', 'Ikat Rambut Bulan Sabit Kerlip', 37500, 'IMG-202008115409.jpeg', 30, 'Ikat Rambut dengan bandul resin bentuk bulan sabit dengan hiasan pernak-pernik permata.', '2020-08-02 11:17:08'),
('P-202008026811', 'K-202007319642', 'KS-202007317214', 'PE-1233006', 'Anting Daun Pelangi', 42500, 'IMG-202008103224.jpeg', 35, 'Anting Resin dengan bingkai daun dan dihiasi berbagai macam warna seperti pelangi.', '2020-08-02 11:13:31'),
('P-202008027106', 'K-202007319642', 'KS-202007312650', 'PR-122001', 'Anting Bunga Rantai Panjang', 32000, 'IMG-202008108160.jpeg', 85, 'Anting Resin dengan desain panjang dan dihiasi manik bunga', '2020-08-02 10:54:45'),
('P-202008027504', 'K-202007319642', 'KS-202007317214', 'PE-1233003', 'Anting Drop Geometri', 42500, 'IMG-202008024800.jpg', 35, 'Anting Drop Geometri', '2020-08-02 11:12:13'),
('P-202008027578', 'K-202007319642', 'KS-202007317214', 'PE-1233001', 'Anting Black Ketupat', 42500, 'IMG-202008025461.jpg', 35, 'Anting Black Ketupat', '2020-08-02 11:07:51'),
('P-202008027809', 'K-202007318991', 'KS-202007316483', 'BF-561440402', 'Gelang Segitiga Biru', 29000, 'IMG-202008117874.jpg', 30, 'Gelang Rantai dengan bandul resin berbentuk segitiga yang berwarna biru.', '2020-08-02 10:57:45'),
('P-202008028080', 'K-202007312495', 'KS-202007319193', 'ST-188901', 'Kalung Kunci Bintang Biru', 34500, 'IMG-202008104183.jpeg', 20, 'Kalung Resin dengan desain kunci bulan sabit dengan gradasi warna biru dan hijau.', '2020-08-02 11:00:13'),
('P-202008028396', 'K-202007312495', 'KS-202007314022', 'IN-173402', 'Kalung Love', 30000, 'IMG-202008104752.jpg', 20, 'Kalung Resin dengan bentuk Love.', '2020-08-02 11:08:32'),
('P-202008028485', 'K-202007318991', 'KS-202007316483', 'BF-561440401', 'Gelang Oval Batu Bening', 29000, 'IMG-202008111890.jpeg', 30, 'Gelang Rantai Resin dengan bandul oval bening.', '2020-08-02 11:21:51'),
('P-202008028601', 'K-202007312495', 'KS-202007319193', 'ST-188902', 'Kalung Kunci Bintang', 34500, 'IMG-202008107470.jpeg', 20, 'Kalung Resin dengan desain kunci bintang', '2020-08-02 11:23:00'),
('P-202008028933', 'K-202007312495', 'KS-202007314022', 'IN-173403', 'Kalung Oval Langit', 30000, 'IMG-202008106296.jpg', 20, 'Kalung Resin dengan warna biru seperti langit.', '2020-08-02 10:58:51'),
('P-202008029581', 'K-202007312495', 'KS-202007314022', 'IN-173401', 'Kalung Bunga Biru', 30000, 'IMG-202008101119.jpg', 50, 'Anting Resin bulat dengan warna biru muda dihiasi dengan manik bunga.', '2020-08-02 10:56:27'),
('P-202008103200', 'K-202007312495', 'KS-202007319193', 'ST-188904', 'Kalung Kunci Bulan Sabit Cutie', 34500, 'IMG-202008117819.jpg', 20, 'Kalung Resin dengan bingkai kunci bulan sabit dan perpaduan warna pink dan biru.', '2020-08-10 00:08:01'),
('P-202008103286', 'K-202007318991', 'KS-202007316483', 'BF-561440401', 'Gelang Bunga Hijau', 29000, 'IMG-202008111375.jpeg', 40, 'Gelang Rantai Resin dengan bandul bunga hijau', '2020-08-10 00:09:15'),
('P-202008103433', 'K-202007312495', 'KS-202007319193', 'ST-188905', 'Kalung Kunci Love', 34500, 'IMG-202008111976.jpg', 20, 'Kalung Resin dengan bingkai kunci love dan perpaduan warna biru dan pink.', '2020-08-10 00:05:28');

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
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_customer` (`id_customer`);

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
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `produk_sub_kategori`
--
ALTER TABLE `produk_sub_kategori`
  ADD CONSTRAINT `produk_sub_kategori_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `produk_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
