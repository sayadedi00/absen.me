-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Agu 2021 pada 16.37
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abesent`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absent`
--

CREATE TABLE `absent` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `type` varchar(256) NOT NULL,
  `late` int(11) NOT NULL,
  `day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `jabatan` varchar(256) NOT NULL DEFAULT 'Karyawan',
  `fingerprint_id` int(11) NOT NULL DEFAULT 0,
  `date` text NOT NULL,
  `gender` int(11) NOT NULL,
  `delete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `admin`, `jabatan`, `fingerprint_id`, `date`, `gender`, `delete_id`) VALUES
(1, 'Admin', 'admin@localhost.com', '202cb962ac59075b964b07152d234b70', 1, 'Manager', 1, '2021-08-25 12:38:22', 0, 0),
(2, '', '', '', 0, 'Karyawan', 0, '', 0, 2),
(3, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(4, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(5, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(6, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(7, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(8, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(9, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(10, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(11, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(12, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(13, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(14, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(15, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(16, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(17, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(18, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(19, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(20, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(21, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(22, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(23, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(24, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(25, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(26, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(27, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(28, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(29, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(30, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(31, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(32, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(33, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(34, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(35, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(36, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(37, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(38, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(39, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(40, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(41, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(42, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(43, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(44, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(45, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(46, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(47, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(48, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(49, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(50, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(51, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(52, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(53, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(54, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(55, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(56, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(57, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(58, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(59, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(60, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(61, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(62, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(63, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(64, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(65, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(66, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(67, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(68, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(69, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(70, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(71, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(72, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(73, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(74, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(75, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(76, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(77, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(78, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(79, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(80, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(81, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(82, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(83, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(84, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(85, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(86, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(87, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(88, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(89, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(90, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(91, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(92, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(93, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(94, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(95, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(96, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(97, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(98, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(99, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(100, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(101, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(102, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(103, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(104, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(105, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(106, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(107, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(108, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(109, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(110, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(111, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(112, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(113, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(114, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(115, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(116, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(117, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(118, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(119, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(120, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(121, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(122, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(123, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(124, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(125, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(126, '', '', '', 0, 'Karyawan', 0, '', 0, 0),
(127, '', '', '', 0, 'Karyawan', 0, '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absent`
--
ALTER TABLE `absent`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absent`
--
ALTER TABLE `absent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
