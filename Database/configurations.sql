-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Cze 2023, 18:38
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `peryferia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `configurations`
--

CREATE TABLE `configurations` (
  `ID` int(11) NOT NULL,
  `ID_account` int(11) NOT NULL,
  `ID_cpu` int(11) NOT NULL,
  `ID_mb` int(11) NOT NULL,
  `ID_ram` int(11) NOT NULL,
  `ID_gpu` int(11) NOT NULL,
  `ID_zasilacz` int(11) NOT NULL,
  `ID_chlodzenie` int(11) NOT NULL,
  `ID_hdd` int(11) NOT NULL,
  `ID_ssd` int(11) NOT NULL,
  `ID_obudowa` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `configurations`
--
ALTER TABLE `configurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
