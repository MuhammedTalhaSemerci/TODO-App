-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Kas 2021, 20:34:34
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `todolist`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `listDate` text COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `listName` text COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `listContent` longtext COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `listStress` int(11) DEFAULT NULL,
  `listKeywords` mediumtext COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `lists`
--

INSERT INTO `lists` (`id`, `listDate`, `listName`, `listContent`, `listStress`, `listKeywords`) VALUES
(85, '2021-11-19', 'deneemdgfd', '<p>ssdfdsf</p>', 1, '[\"matematik\",\"   ödev\",\"ıdıhxjogdıc\",\"fkgıcgo\"]'),
(86, '2021-11-24', 'dfgfdgg', '<p>dgfddsf</p>', 3, '[\"sdsdfds\"]'),
(89, '2021-11-12', 'denemesdfsdfdsfdfg', '<p>ghhjhhgjgh</p>', 3, '[\"sdfdsgf\",\"  deneme\",\"  kitap\",\"hbbjn\",\"hjb\"]');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `listName1` (`listName`) USING HASH;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
