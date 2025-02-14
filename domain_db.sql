-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2025 pada 04.39
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domain_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `ssl_expiry` date DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `domains`
--

INSERT INTO `domains` (`id`, `domain_name`, `ssl_expiry`, `email`) VALUES
(1, 'bandaaceh.go.id', NULL, ''),
(2, 'acehutara.ac.id', NULL, ''),
(3, 'pidiejaya.go.id', NULL, ''),
(4, 'bireuen.go.id', NULL, ''),
(5, 'lhokseumawe.go.id', NULL, ''),
(6, 'sabang.go.id', NULL, ''),
(7, 'langsa.go.id', NULL, ''),
(8, 'acehtamiang.go.id', NULL, ''),
(9, 'acehselatan.go.id', NULL, ''),
(10, 'acehbarat.go.id', NULL, ''),
(11, 'naganraya.go.id', NULL, ''),
(12, 'acehtengah.go.id', NULL, ''),
(13, 'benermeriah.go.id', NULL, ''),
(14, 'gayo.go.id', NULL, ''),
(15, 'singkil.go.id', NULL, ''),
(16, 'subulussalam.go.id', NULL, ''),
(17, 'acehjaya.go.id', NULL, ''),
(18, 'simeulue.go.id', NULL, ''),
(19, 'acehtimur.go.id', NULL, ''),
(20, 'acehbaratdaya.go.id', NULL, ''),
(21, 'acehselatantimur.go.id', '2025-02-21', 'test@gmail.com'),
(22, 'acehutara.go.id', '2025-03-06', 'apa@gmail.com'),
(24, 'usk.ac.id', '2025-02-28', ''),
(25, 'test.ac.id', '2025-02-28', ''),
(27, 'rudy@usk.ac.id', '2025-02-12', 'muhammadrudyhidayat@gmai.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
