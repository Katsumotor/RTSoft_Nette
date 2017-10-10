-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 05. říj 2017, 15:13
-- Verze serveru: 10.1.26-MariaDB
-- Verze PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktura tabulky `person`
--

CREATE TABLE `person` (
  `id_person` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `person`
--

INSERT INTO `person` (`id_person`, `name`, `surname`) VALUES
(1, 'Miroslav', 'Lang'),
(2, 'Pavel', 'Novak'),
(3, 'Jirka', 'Kralík'),
(4, 'Dominik', 'Hašek'),
(5, 'Pavel', 'Nedvěd'),
(6, 'Tomáš', 'Rosický');

-- --------------------------------------------------------

--
-- Struktura tabulky `persononproject`
--

CREATE TABLE `persononproject` (
  `id` int(100) NOT NULL,
  `id_project` int(100) NOT NULL,
  `id_person` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `persononproject`
--

INSERT INTO `persononproject` (`id`, `id_project`, `id_person`) VALUES
(115, 136, 1),
(116, 136, 2),
(117, 136, 4),
(120, 138, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `project`
--

CREATE TABLE `project` (
  `id` int(10) NOT NULL,
  `NazevProjektu` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `DatumOdevzdaniProjektu` date NOT NULL,
  `TypProjektu` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `WebovyProjekt` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `project`
--

INSERT INTO `project` (`id`, `NazevProjektu`, `DatumOdevzdaniProjektu`, `TypProjektu`, `WebovyProjekt`) VALUES
(136, 'Projekt jedna', '1990-06-22', 'Continous integration', 1),
(138, 'Projekt dva', '2016-06-10', 'Continous integration', 0),
(139, 'Projekt tri', '2016-10-10', 'Časově omezený projekt', 1),
(140, 'Projekt 5', '2017-10-02', 'Continous integration', 0),
(141, 'Projekt 6', '2017-10-16', 'Časově omezený projekt', 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`);

--
-- Klíče pro tabulku `persononproject`
--
ALTER TABLE `persononproject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_person` (`id_person`);

--
-- Klíče pro tabulku `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `persononproject`
--
ALTER TABLE `persononproject`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pro tabulku `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `persononproject`
--
ALTER TABLE `persononproject`
  ADD CONSTRAINT `persononproject_ibfk_3` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persononproject_ibfk_4` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
