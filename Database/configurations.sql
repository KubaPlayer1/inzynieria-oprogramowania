-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Cze 2023, 02:16
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

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `configurations`
--
ALTER TABLE `configurations`
  ADD CONSTRAINT `account_fk` FOREIGN KEY (`ID_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `chlodzenie_fk` FOREIGN KEY (`ID_chlodzenie`) REFERENCES `chlodzenie_cpu` (`id_chlodzenie_cpu`),
  ADD CONSTRAINT `cpu_fk` FOREIGN KEY (`ID_cpu`) REFERENCES `cpu` (`id_cpu`),
  ADD CONSTRAINT `gpu_fk` FOREIGN KEY (`ID_gpu`) REFERENCES `gpu` (`id_gpu`),
  ADD CONSTRAINT `hdd_fk` FOREIGN KEY (`ID_hdd`) REFERENCES `hdd` (`id_hdd`),
  ADD CONSTRAINT `mb_fk` FOREIGN KEY (`ID_mb`) REFERENCES `mb` (`id_mb`),
  ADD CONSTRAINT `obudowa_fk` FOREIGN KEY (`ID_obudowa`) REFERENCES `obudowa` (`id_obudowa`),
  ADD CONSTRAINT `ram_fk` FOREIGN KEY (`ID_ram`) REFERENCES `ram` (`id_ram`),
  ADD CONSTRAINT `ssd_fk` FOREIGN KEY (`ID_ssd`) REFERENCES `ssd` (`id`),
  ADD CONSTRAINT `zasilacz_fk` FOREIGN KEY (`ID_zasilacz`) REFERENCES `zasilacz` (`id_zasilacz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
