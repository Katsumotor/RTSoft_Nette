-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 26. zář 2017, 08:55
-- Verze serveru: 10.1.10-MariaDB
-- Verze PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `project`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `project`
--

CREATE TABLE `project` (
  `id` int(10) NOT NULL,
  `NazevProjektu` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `DatumOdevzdaniProjektu` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `TypProjektu` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `WebovyProjekt` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `project`
--

INSERT INTO `project` (`id`, `NazevProjektu`, `DatumOdevzdaniProjektu`, `TypProjektu`, `WebovyProjekt`) VALUES
(3, 'qq', '1.1.2018', 'Časově omezený projekt', 0),
(7, 'qq', 'qq', 'Časově omezený projekt', 0),
(8, 'qaq', 'qq', 'Časově omezený projekt', 0),
(9, 'qq', 'qq', 'Časově omezený projekt', 0),
(12, 'qq', 'q', 'Časově omezený projekt', 0),
(13, 'qq', '', 'Časově omezený projekt', 0),
(14, 'krasko', '1.12.2010', 'Časově omezený projekt', 1),
(17, '11', '1.1.1990', 'Continous integration', 1),
(18, 'qqq', '1.1.1922', 'Časově omezený projekt', 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
