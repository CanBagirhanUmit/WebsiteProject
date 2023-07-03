-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 May 2023, 14:28:57
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `webproje`
--
CREATE DATABASE IF NOT EXISTS `webproje` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webproje`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'admin', '2023-03-30 00:00:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `date`) VALUES
(18, 'asdsdsa', 'dasdsaad@adsdasdsdas', 'aASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDASASDSAASDSaASDA', '2023-04-25 02:21:51'),
(19, 'DSADASDSADSADSA', 'DASDASDSADSA@ADSADSASDDSA', 'DASDASDASDAS', '2023-04-25 02:22:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `img` blob NOT NULL,
  `link` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `games`
--

INSERT INTO `games` (`id`, `name`, `price`, `img`, `link`, `quantity`, `date`) VALUES
(91, 'Dishonored - Definitive Edition', 179, 0x312e6a706567, 'http://localhost:8080/webproje/dishonored.php', 97, '2023-05-08 18:45:35'),
(92, 'Dishonored 2 ', 259, 0x363436333163396233643533382e6a706567, 'http://localhost:8080/webproje/dishonored2.php', 97, '2023-04-17 15:48:55'),
(93, 'Dishonored: Death of the Outsider', 259, 0x363435393435653535623638632e6a7067, 'http://localhost:8080/webproje/dishonored_death-of-the-outsider.php', 95, '2023-04-17 15:51:25'),
(94, 'Prey', 259, 0x332e6a706567, 'http://localhost:8080/webproje/prey.php', 100, '2023-04-17 15:52:50'),
(95, 'Deathloop', 539, 0x352e6a7067, 'http://localhost:8080/webproje/deathloop.php', 99, '2023-04-17 15:53:36'),
(96, 'Doom', 179, 0x363435393435666439376364612e6a7067, 'http://localhost:8080/webproje/doom.php', 100, '2023-04-17 16:01:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(55) NOT NULL,
  `game_id` varchar(55) NOT NULL,
  `game_name` varchar(55) NOT NULL,
  `game_price` varchar(55) NOT NULL,
  `card_no` varchar(20) NOT NULL,
  `card_name` varchar(55) NOT NULL,
  `exp_date` varchar(5) NOT NULL,
  `cvc` varchar(5) NOT NULL,
  `status` varchar(55) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_edit` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `username`, `email`, `game_id`, `game_name`, `game_price`, `card_no`, `card_name`, `exp_date`, `cvc`, `status`, `quantity`, `date`, `last_edit`) VALUES
(163, '73', 'asd', 'asd@asd', '91', 'Dishonored - Definitive Edition', '179', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'Gönderildi', 0, '2023-05-08 17:26:06', '2023-05-09 10:00:33'),
(164, '73', 'asd', 'asd@asd', '91', 'Dishonored - Definitive Edition', '179', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'İptal Edildi (Stokta Kalmadı)', 0, '2023-05-08 17:26:06', '2023-05-09 10:01:03'),
(166, '73', 'asd', 'asd@asd', '93', 'Dishonored: Death of the Outsider', '259', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'Gönderildi', 0, '2023-05-08 17:26:06', '2023-05-23 09:55:36'),
(167, '73', 'asd', 'asd@asd', '91', 'Dishonored - Definitive Edition', '179', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'Beklemede', 0, '2023-05-09 09:01:28', '2023-05-09 10:01:28'),
(168, '73', 'asd', 'asd@asd', '91', 'Dishonored - Definitive Edition', '179', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'Gönderildi', 0, '2023-05-09 23:37:01', '2023-05-10 00:37:32'),
(169, '73', 'asd', 'asd@asd', '91', 'Dishonored - Definitive Edition', '179', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'Sipariş Kullanıcı Tarafından İptal Edildi', 0, '2023-05-16 06:35:09', '2023-05-16 07:35:15'),
(170, '73', 'asd', 'asd@asd', '91', 'Dishonored - Definitive Edition', '179', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 'Sipariş Kullanıcı Tarafından İptal Edildi', 0, '2023-05-16 06:35:09', '2023-05-16 07:35:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `card_no` varchar(16) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `exp_date` varchar(5) NOT NULL,
  `cvc` varchar(5) NOT NULL,
  `img` longblob NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_edit` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `logout` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `card_no`, `card_name`, `exp_date`, `cvc`, `img`, `date`, `last_edit`, `last_login`, `logout`) VALUES
(73, 'asd', 'asd@asd', 'asd', '5555555555555555', 'Can Bagırhan Ümit', '11/55', '555', 0x363436633566666263373632642e706e67, '2023-04-07 15:30:08', '2023-05-23 10:49:46', '2023-05-26 18:08:45', '2023-05-26 18:11:33'),
(75, 'a', 'asd@asd', 'asd', '', '', '', '', 0x363435393433336563613131392e69636f, '2023-04-07 17:57:53', '2023-05-08 21:47:23', '2023-05-08 21:43:40', '2023-05-08 21:47:26'),
(112, 'as', 'as@as', 'as', '', '', '', '', '', '2023-04-09 20:39:45', '2023-05-02 10:52:15', '2023-05-08 21:43:36', '2023-05-08 21:43:38'),
(127, 'ADSADSDASDASDASADSAD', 'ADSADSDASDASDASADSADSDASDASDAS@ADSADSDASDASDASADSADSDAS', 'ADSADSDASDASDASADSADSDASDASDASADSADSDASDASDAS', '', '', '', '', '', '2023-05-08 22:14:03', '2023-05-08 22:14:03', '2023-05-08 22:14:03', '2023-05-08 22:14:03');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
