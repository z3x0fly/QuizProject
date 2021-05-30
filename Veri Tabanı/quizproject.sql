-- phpMyAdmin SQL Dump
-- version 5.1.0-3.el7.remi
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 30 May 2021, 17:57:48
-- Sunucu sürümü: 5.5.68-MariaDB
-- PHP Sürümü: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `quizproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usn` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `usn`, `pass`, `mail`, `name`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'Sistem Yöneticisi');
-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(4, 'Fen Bilimeri'),
(5, 'Kimya'),
(7, 'Matematik'),
(8, 'Sosyal Bilimler'),
(9, 'Din Kültürü & Ahlak Bilgisi'),
(10, 'Bilişim Teknik Resmi'),
(11, 'Tarih'),
(12, 'Seçmeli İngilizce'),
(13, 'Fizik'),
(14, 'Görsel Programlama');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(7, '12A-Matematik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `corps`
--

CREATE TABLE `corps` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `corps`
--

INSERT INTO `corps` (`id`, `name`) VALUES
(2, 'ABC Kurumları');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `educators`
--

CREATE TABLE `educators` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `last` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cat` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `educators`
--

INSERT INTO `educators` (`id`, `name`, `last`, `class`, `cat`, `mail`, `pass`, `tarih`, `status`) VALUES
(29, 'Deneme', 'Deneme2', '12A-Matematik', 'Matematik', 'deneme@gmail.com', '8f10d078b2799206cfe914b32cc6a5e9', '2021-05-30', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questsions`
--

CREATE TABLE `questsions` (
  `id` int(255) NOT NULL,
  `ques` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cat` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `subcat` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `questsions`
--

INSERT INTO `questsions` (`id`, `ques`, `answer`, `cat`, `subcat`, `class`) VALUES
(8, 'Fen nedir ?', 'Fendir', 'Fen Bilimeri', 'Hayatımızda Elektrik', '12A-Matematik'),
(9, 'Matematik Nedir ?', 'Matematiktir', 'Matematik', 'Osmanlı Tarihi', '12A-Matematik'),
(10, 'مرحبا kelimesinin Türkçe meali nedir?', 'Selam', 'Matematik', 'Osmanlı Tarihi', '12A-Matematik'),
(11, 'Nükler enerji nedir ?', 'Enerjidir', 'Fen Bilimeri', 'Hayatımızda Elektrik', '12A-Matematik'),
(12, 'Eşeyli üreme ve eşeysiz üremeye örnek veriniz', 'Tamam', 'Fen Bilimeri', 'Canlılarda Üreme', '12A-Matematik'),
(13, 'Deneme 1', 'Deneme 1', 'Matematik', 'Deneme1', '12A-Matematik'),
(14, 'Deneme 1-2', 'Deneme 1-2', 'Matematik', 'Deneme1', '12A-Matematik'),
(15, 'Deneme 1-3', 'Deneme 1-3', 'Matematik', 'Deneme1', '12A-Matematik'),
(16, 'Deneme 1-5', 'Deneme 1-5', 'Matematik', 'Deneme1', '12A-Matematik'),
(17, 'Deneme 2', 'Deneme 2', 'Matematik', 'Deneme2', '12A-Matematik'),
(18, 'Deneme 2-1', 'Deneme 2-1', 'Matematik', 'Deneme2', '12A-Matematik'),
(19, 'Deneme 2-3', 'Deneme 2-3', 'Matematik', 'Deneme2', '12A-Matematik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `quizplans`
--

CREATE TABLE `quizplans` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `sub` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `list` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `limiti` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `quizplans`
--

INSERT INTO `quizplans` (`id`, `name`, `sub`, `list`, `limiti`, `class`) VALUES
(4, 'Matematik', 'Deneme1', '1', '3', '12A-Matematik'),
(5, 'Matematik', 'Deneme2', '2', '2', '12A-Matematik'),
(6, 'Fen Bilimeri', 'Hayatımızda Elektrik', '3', '1', '12A-Matematik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `last` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `grup` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `corp` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `q1` int(255) NOT NULL,
  `q2` int(255) NOT NULL,
  `q3` int(255) NOT NULL,
  `q4` int(255) NOT NULL,
  `q5` int(255) NOT NULL,
  `q6` int(255) NOT NULL,
  `q7` int(255) NOT NULL,
  `q8` int(255) NOT NULL,
  `q9` int(255) NOT NULL,
  `q10` int(255) NOT NULL,
  `q11` int(255) NOT NULL,
  `q12` int(255) NOT NULL,
  `q13` int(255) NOT NULL,
  `q14` int(255) NOT NULL,
  `q15` int(255) NOT NULL,
  `q16` int(255) NOT NULL,
  `q17` int(255) NOT NULL,
  `q18` int(255) NOT NULL,
  `q19` int(255) NOT NULL,
  `q20` int(255) NOT NULL,
  `q21` int(255) NOT NULL,
  `q22` int(255) NOT NULL,
  `q23` int(255) NOT NULL,
  `q24` int(255) NOT NULL,
  `q25` int(255) NOT NULL,
  `qname` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `student`
--

INSERT INTO `student` (`id`, `name`, `last`, `class`, `grup`, `corp`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q18`, `q19`, `q20`, `q21`, `q22`, `q23`, `q24`, `q25`, `qname`) VALUES
(7, 'Deneme', 'Denemeoğlu', '12A-Matematik', 'C Grubu', 'ABC Kurumları', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sub_cats`
--

CREATE TABLE `sub_cats` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cat` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `sub_cats`
--

INSERT INTO `sub_cats` (`id`, `name`, `cat`) VALUES
(5, 'Hayatımızda Elektrik', 'Fen Bilimeri'),
(6, 'Osmanlı Tarihi', 'Tarih'),
(7, 'Canlılarda Üreme', 'Fen Bilimeri'),
(9, 'Deneme1', 'Kimya'),
(10, 'Deneme2', 'Matematik'),
(11, 'Deneme3', 'Matematik'),
(12, 'Deneme4', 'Matematik'),
(13, 'Deneme5', 'Matematik'),
(14, 'Deneme6', 'Matematik');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `corps`
--
ALTER TABLE `corps`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `educators`
--
ALTER TABLE `educators`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `questsions`
--
ALTER TABLE `questsions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `quizplans`
--
ALTER TABLE `quizplans`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sub_cats`
--
ALTER TABLE `sub_cats`
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
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `corps`
--
ALTER TABLE `corps`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `educators`
--
ALTER TABLE `educators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `questsions`
--
ALTER TABLE `questsions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `quizplans`
--
ALTER TABLE `quizplans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `sub_cats`
--
ALTER TABLE `sub_cats`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
