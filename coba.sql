-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2021 pada 22.40
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `deskripsi`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Struktur dari tabel `urls`
--

CREATE TABLE `urls` (
  `hash` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `original_link` varchar(255) NOT NULL,
  `total_clicked` varchar(255) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `urls`
--

INSERT INTO `urls` (`hash`, `title`, `original_link`, `total_clicked`, `user_id`) VALUES
('ggl', 'gigell', 'http://google.com', '1', 2),
('ytb', 'yitub', 'http://youtube.com', '1', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `urls_guest`
--

CREATE TABLE `urls_guest` (
  `hash` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `original_link` varchar(255) NOT NULL,
  `total_clicked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `urls_guest`
--

INSERT INTO `urls_guest` (`hash`, `title`, `original_link`, `total_clicked`) VALUES
('60e8467a73953guest', 'Guugle', 'http://google.com', 5),
('60e84c7fed862guest', 'Pesbuk', 'http://facebook.com', 1),
('60e861adc0355guest', 'Detikkkk', 'http://detik.com', 2),
('60eda0e486336guest', 'wokepedia', 'http://wikipedia.org', 1),
('60ef3c42a8443', 'Yitub', 'http://youtube.com', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role_id`) VALUES
(2, 'nickoaji23@gmail.com', 'nicko', 'c7f2e41933586299b5fd4ac8ce2ce6f6d3e3c5d8', 2),
(4, 'admin@mail.com', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`hash`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `id_users_fk` (`user_id`);

--
-- Indeks untuk tabel `urls_guest`
--
ALTER TABLE `urls_guest`
  ADD PRIMARY KEY (`hash`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_roles_fk` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `urls`
--
ALTER TABLE `urls`
  ADD CONSTRAINT `id_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_roles_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
