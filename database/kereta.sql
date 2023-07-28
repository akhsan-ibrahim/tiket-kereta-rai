-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2023 pada 02.35
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kereta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `km_location` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `station`
--

INSERT INTO `station` (`id`, `name`, `km_location`) VALUES
(1, 'Solo', 0),
(2, 'Sragen', 30),
(3, 'Ngawi', 80),
(4, 'Madiun', 110),
(5, 'Nganjuk', 140),
(6, 'Kertosono', 170),
(12, 'Surabaya', 210),
(13, 'Karanganyar', 100),
(14, 'Kutoarjo', 80),
(15, 'Klaten', 40),
(16, 'Yogyakarta', 55),
(18, 'Semarang', 110),
(19, 'Pekalongan', 200),
(20, 'Cirebon', 390),
(21, 'Jakarta', 550);

-- --------------------------------------------------------

--
-- Struktur dari tabel `train`
--

CREATE TABLE `train` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `finish` varchar(255) NOT NULL,
  `wagon` int(11) NOT NULL,
  `wagon_capacity` int(11) NOT NULL,
  `km_cost` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `train`
--

INSERT INTO `train` (`id`, `name`, `start`, `finish`, `wagon`, `wagon_capacity`, `km_cost`, `start_time`, `picture`) VALUES
(1, 'Thomas', 'Solo', 'Kertosono', 4, 40, 500, '08:00:00', 'thomas.jpeg'),
(2, 'Merah', 'Solo', 'Karanganyar', 5, 40, 700, '10:00:00', 'james.png'),
(3, 'Mirip Thomas', 'Solo', 'Jakarta', 3, 40, 500, '10:43:15', 'gordon.jfif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `train_stations`
--

CREATE TABLE `train_stations` (
  `id` int(11) NOT NULL,
  `train_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `stop_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `train_stations`
--

INSERT INTO `train_stations` (`id`, `train_id`, `station_id`, `stop_time`) VALUES
(1, 1, 1, '00:00:00'),
(2, 1, 2, '00:00:00'),
(3, 1, 3, '00:00:00'),
(4, 1, 4, '00:00:00'),
(5, 1, 5, '00:00:00'),
(6, 1, 6, '00:00:00'),
(7, 2, 1, '00:00:00'),
(8, 2, 15, '00:00:00'),
(9, 2, 16, '00:00:00'),
(10, 2, 14, '00:00:00'),
(11, 2, 13, '00:00:00'),
(13, 3, 18, '00:00:00'),
(14, 3, 19, '00:00:00'),
(15, 3, 20, '00:00:00'),
(16, 3, 21, '00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `train` varchar(100) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `departure` time NOT NULL,
  `arrive` time NOT NULL,
  `destination` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `wagon` int(11) NOT NULL,
  `seat` int(11) NOT NULL,
  `ticket_date` date NOT NULL,
  `transaction_date` datetime NOT NULL,
  `payment` enum('Mobile Banking','E-Wallet') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `train`, `origin`, `departure`, `arrive`, `destination`, `price`, `wagon`, `seat`, `ticket_date`, `transaction_date`, `payment`) VALUES
('12230727003221', 12, 'Merah', 'Solo', '10:00:00', '10:28:00', 'Yogyakarta', 38500, 1, 1, '2023-07-28', '2023-07-27 00:32:21', 'Mobile Banking'),
('16230727004728', 16, 'Thomas', 'Solo', '08:00:00', '09:10:00', 'Nganjuk', 70000, 2, 11, '2023-07-28', '2023-07-27 00:47:28', 'Mobile Banking'),
('16230727010727', 16, 'Thomas', 'Nganjuk', '16:00:00', '17:10:00', 'Solo', 70000, 1, 10, '2023-07-28', '2023-07-27 01:07:27', 'E-Wallet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `role` enum('customer','admin','guest') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `contact`, `email`, `password`, `role`) VALUES
(10, 'Admin RAI', '081234567890', 'adminrai@gmail.com', 'admin123', 'admin'),
(12, 'Ilham Rian', '087654321910', 'il@mail.com', '1', 'customer'),
(16, 'Asan Ibra', '087654321913', 'as@mail', '1', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `train_stations`
--
ALTER TABLE `train_stations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `station_id` (`station_id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `train`
--
ALTER TABLE `train`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `train_stations`
--
ALTER TABLE `train_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `train_stations`
--
ALTER TABLE `train_stations`
  ADD CONSTRAINT `train_stations_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_stations_ibfk_2` FOREIGN KEY (`station_id`) REFERENCES `station` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
