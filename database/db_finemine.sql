-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2024 pada 05.45
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_finemine`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `lok_pen` varchar(200) NOT NULL,
  `jenis_brg` varchar(100) NOT NULL,
  `isi_brg` text NOT NULL,
  `warna_brg` varchar(30) NOT NULL,
  `merk_brg` varchar(50) NOT NULL,
  `ket_penyimpanan` text NOT NULL,
  `foto_brg` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `tanggal`, `lok_pen`, `jenis_brg`, `isi_brg`, `warna_brg`, `merk_brg`, `ket_penyimpanan`, `foto_brg`, `status`) VALUES
(2, '2024-01-21', 'Test', 'Tas', 'Test', 'Hitam', 'Abibas', 'Test', '65acaee4b98a8.jpg', 'Belum Diambil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `whatsapp` varchar(25) NOT NULL,
  `telegram` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id`, `whatsapp`, `telegram`) VALUES
(1, '081272581081', 'Angkasapura2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` varchar(6) NOT NULL,
  `n_pelapor` varchar(30) NOT NULL,
  `n_pemilik` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_kjd` date NOT NULL,
  `detail_lok` text NOT NULL,
  `rute` varchar(200) NOT NULL,
  `maskapai` varchar(200) NOT NULL,
  `nopen` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kd_pos` varchar(10) NOT NULL,
  `ciri_pemilik` text NOT NULL,
  `ciri_barang` text NOT NULL,
  `foto_brg` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `isi_brg` text NOT NULL,
  `lok_pen` text NOT NULL,
  `jenis_brg` varchar(100) NOT NULL,
  `warna_brg` varchar(100) NOT NULL,
  `merk_brg` varchar(100) NOT NULL,
  `ket_penyimpanan` varchar(100) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `tgl_lapor` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `n_pelapor`, `n_pemilik`, `email`, `no_telp`, `tgl_kjd`, `detail_lok`, `rute`, `maskapai`, `nopen`, `alamat`, `kd_pos`, `ciri_pemilik`, `ciri_barang`, `foto_brg`, `status`, `isi_brg`, `lok_pen`, `jenis_brg`, `warna_brg`, `merk_brg`, `ket_penyimpanan`, `keterangan`, `tgl_lapor`) VALUES
('NP0006', 'Angga', 'Angga Tenyom', 'anggatenyom0@gmail.com', '081272581081', '2024-01-17', 'test', 'dari jakarta ke mekah', 'test', 'B00019', 'Karang Anyar', '35365', 'test', 'test', '', 'Sedang diajukan', '-', '-', '-', '-', '-', '-', '', '2024-01-18'),
('NP0008', 'Test2', 'Test2', 'test2@gmail.com', '0812222222', '2024-01-21', 'test2', 'test2', 'test2', 'test2', 'Karang Anyar 2', '35365', 'test 2', 'test 2', '', 'Selesai diproses', '- test', 'Test', 'Test', 'Test', 'test', 'Test', 'Belum Diambil', '2024-01-21'),
('NP0009', 'Pak Permata', 'Permata', 'permata@gmail.com', '0812773993', '2024-01-27', 'Saat ingin mengambil barang di tempat pengambilan barang tidak ada', 'Lampung ke Singapure', 'Garuda Indonesia', 'B00020', 'Bandar Lampung, Lampung', '35365', '- Tinggi badan 165 cm\r\n- Laki-laki\r\n- Baju hitam celana levis\r\n- rambut pendek warna hitam', '- Tas Ransel warna Coklat', '65b52dd3398ba.png', 'Selesai diproses', '- Laptop\r\n- Dompet\r\n- Pasport', '- Di dalam kargo pesawat', '- Tas Ransel', '- Coklat', '- Hexa', '- Diruang Security B2', 'Sudah Diambil', '2024-01-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `img`, `status`) VALUES
(1, 'angga', '$2y$10$OsJXTwr2MvGIjprccM29eeodg45Xk476j9pp43li4aKLAduH.gRB.', 'Alfian Angga Nugroho', '525602707_WhatsApp Image 2023-11-09 at 23.50.27.jpeg', 1),
(2, 'admin', '$2y$10$vx9rULGqEcbI1khsJ2su8eRHIhZlpmvQW5sPZu3jmk471MtfaNqrm', 'Pengguna', '168846764_Pas Foto.jpeg', 1),
(4, 'mely', '$2y$10$JOktSPnjxIJiDKdohvQyI.86MCFjuRrQARGW220YmyFMft.geibQG', 'Mely Noviani', '1348386780_WhatsApp Image 2023-11-10 at 00.28.32.jpeg', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
