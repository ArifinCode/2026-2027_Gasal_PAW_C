-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Nov 2026 pada 07.59
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Beras Premium 5kg', 65000, 50, 1),
(2, 'BRG002', 'Minyak Goreng 2L', 38000, 40, 2),
(3, 'BRG003', 'Gula Pasir 1kg', 17000, 60, 1),
(4, 'BRG004', 'Telur Ayam 1kg', 28000, 35, 3),
(5, 'BRG005', 'Kopi Bubuk 200g', 22000, 45, 4),
(6, 'BRG006', 'Teh Celup 25s', 9000, 80, 4),
(7, 'BRG007', 'Mie Instan', 3500, 200, 5),
(8, 'BRG008', 'Sabun Mandi', 4500, 90, 6),
(9, 'BRG009', 'Deterjen 800g', 21000, 55, 7),
(10, 'BRG010', 'Air Mineral 600ml', 3500, 150, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Budi Santoso', 'L', '081234567801', 'Gresik'),
('PLG002', 'Siti Aminah', 'P', '081234567802', 'Surabaya'),
('PLG003', 'Andi Wijaya', 'L', '081234567803', 'Bangkalan'),
('PLG004', 'Dewi Lestari', 'P', '081234567804', 'Sidoarjo'),
('PLG005', 'Rizky Pratama', 'L', '081234567805', 'Lamongan'),
('PLG006', 'Nur Hidayati', 'P', '081234567806', 'Gresik'),
('PLG007', 'Agus Setiawan', 'L', '081234567807', 'Surabaya'),
('PLG008', 'Lina Marlina', 'P', '081234567808', 'Mojokerto'),
('PLG009', 'Fajar Nugroho', 'L', '081234567809', 'Pasuruan'),
('PLG010', 'Rina Kusuma', 'P', '081234567810', 'Madura');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 09:15:00', 130000, 'TUNAI', 1),
(2, '2026-11-01 11:30:00', 114000, 'TRANSFER', 2),
(3, '2026-11-02 10:05:00', 85000, 'TUNAI', 3),
(4, '2026-11-03 13:20:00', 112000, 'EDC', 4),
(5, '2026-11-03 15:45:00', 44000, 'TUNAI', 5),
(6, '2026-11-05 08:50:00', 70000, 'TRANSFER', 6),
(7, '2026-11-07 14:10:00', 126000, 'EDC', 7),
(8, '2026-11-10 16:25:00', 45000, 'TUNAI', 8),
(9, '2026-11-12 12:00:00', 45000, 'TRANSFER', 9),
(10, '2026-11-14 17:40:00', 84000, 'EDC', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Pangan', '031555001', 'Jl. Raya Gresik No. 12, Gresik'),
(2, 'CV Minyak Makmur', '031555002', 'Jl. Veteran No. 45, Gresik'),
(3, 'UD Telur Sejahtera', '031555003', 'Jl. Pahlawan No. 8, Lamongan'),
(4, 'PT Kopi Nusantara', '031555004', 'Jl. Diponegoro No. 21, Surabaya'),
(5, 'CV Mie Jaya', '031555005', 'Jl. Ahmad Yani No. 77, Surabaya'),
(6, 'PT Bersih Sejahtera', '031555006', 'Jl. Rungkut No. 30, Surabaya'),
(7, 'CV Cuci Bersih', '031555007', 'Jl. Gubeng No. 15, Surabaya'),
(8, 'PT Air Murni', '031555008', 'Jl. Raya Manyar No. 9, Gresik'),
(9, 'UD Snack Mantap', '031555009', 'Jl. Kenjeran No. 50, Surabaya'),
(10, 'CV Rempah Nusantara', '031555010', 'Jl. Panglima Sudirman No. 3, Sidoarjo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Pembelian harian', 130000, 'PLG001'),
(2, '2026-11-01', 'Pembelian harian', 114000, 'PLG002'),
(3, '2026-11-02', 'Pembelian harian', 85000, 'PLG001'),
(4, '2026-11-03', 'Pembelian harian', 112000, 'PLG003'),
(5, '2026-11-03', 'Pembelian harian', 44000, 'PLG004'),
(6, '2026-11-05', 'Pembelian harian', 70000, 'PLG005'),
(7, '2026-11-07', 'Pembelian harian', 126000, 'PLG006'),
(8, '2026-11-10', 'Pembelian harian', 45000, 'PLG007'),
(9, '2026-11-12', 'Pembelian harian', 45000, 'PLG008'),
(10, '2026-11-14', 'Pembelian harian', 84000, 'PLG002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 65000, 2),
(2, 2, 38000, 3),
(3, 3, 17000, 5),
(4, 4, 28000, 4),
(5, 5, 22000, 2),
(6, 7, 3500, 20),
(7, 9, 21000, 6),
(8, 8, 4500, 10),
(9, 6, 9000, 5),
(10, 10, 3500, 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'Jl. Raya Gresik No. 1', '081300000001', 1),
(2, 'kasir1', 'de28f8f7998f23ab4194b51a6029416f', 'Dewi Kasir', 'Jl. Veteran No. 10, Gresik', '081300000002', 0),
(3, 'kasir2', 'de28f8f7998f23ab4194b51a6029416f', 'Rudi Kasir', 'Jl. Pahlawan No. 5, Gresik', '081300000003', 0),
(4, 'kasir3', 'de28f8f7998f23ab4194b51a6029416f', 'Sari Kasir', 'Jl. Diponegoro No. 7', '081300000004', 0),
(5, 'gudang1', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Joko Gudang', 'Jl. Ahmad Yani No. 22', '081300000005', 0),
(6, 'gudang2', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Tono Gudang', 'Jl. Rungkut No. 14', '081300000006', 0),
(7, 'manager', '0795151defba7a4b5dfa89170de46277', 'Hendra Manager', 'Jl. Gubeng No. 18', '081300000007', 1),
(8, 'owner', '5be057accb25758101fa5eadbbd79503', 'Bapak Owner', 'Jl. Manyar No. 3', '081300000008', 1),
(9, 'staff1', 'de9bf5643eabf80f4a56fda3bbb84483', 'Lia Staff', 'Jl. Kenjeran No. 40', '081300000009', 0),
(10, 'staff2', 'de9bf5643eabf80f4a56fda3bbb84483', 'Bima Staff', 'Jl. Panglima Sudirman No. 6', '081300000010', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `fk_barang_supplier` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_transaksi` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_pelanggan` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `fk_detail_barang` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
