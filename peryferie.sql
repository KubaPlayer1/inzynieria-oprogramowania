-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Mar 2023, 22:16
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `peryferie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chlodzenie_cpu`
--

CREATE TABLE `chlodzenie_cpu` (
  `id_chlodzenie_cpu` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `maks_TDP` float NOT NULL,
  `socket` varchar(30) NOT NULL,
  `wysokosc` float NOT NULL,
  `szerokosc` float NOT NULL,
  `glebokosc` float NOT NULL,
  `ilosc_cieplowodow` float NOT NULL,
  `srednica_cieplowodow` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `chlodzenie_cpu`
--

INSERT INTO `chlodzenie_cpu` (`id_chlodzenie_cpu`, `nazwa`, `maks_TDP`, `socket`, `wysokosc`, `szerokosc`, `glebokosc`, `ilosc_cieplowodow`, `srednica_cieplowodow`) VALUES
(601, 'Endorfy Fera 5', 220, 'intel', 15.5, 127, 7.7, 4, 0.6),
(602, 'be quiet! Dark Rock 4 Pro', 250, 'intel', 16.3, 13.6, 14.6, 7, 0.6),
(603, 'SilentiumPC Fortis 5', 220, 'intel', 15.9, 14.9, 10.7, 6, 0.6),
(604, 'CPU be quiet! Shadow Rock Slim 2', 160, 'intel', 16.1, 13.7, 7.4, 4, 0.6),
(605, 'be quiet! Dark Rock 4', 200, 'amd', 16, 13.6, 9.6, 6, 0.8),
(607, 'Gigabyte Aorus ATC800', 200, 'amd', 16.3, 13.9, 10.7, 4, 0.6),
(608, 'Deepcool AK500', 240, 'amd', 15.8, 12.7, 9, 5, 0.6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cpu`
--

CREATE TABLE `cpu` (
  `id_cpu` int(30) NOT NULL,
  `nazwa` varchar(70) NOT NULL,
  `socket` varchar(20) NOT NULL,
  `zegar` float NOT NULL,
  `turbo` float NOT NULL,
  `rdzenie` float NOT NULL,
  `watki` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `cpu`
--

INSERT INTO `cpu` (`id_cpu`, `nazwa`, `socket`, `zegar`, `turbo`, `rdzenie`, `watki`) VALUES
(101, ' AMD Ryzen 5 7600', 'AM5 ', 3.8, 5.1, 6, 2),
(102, ' AMD Ryzen 5 7600X', 'AM5 ', 4.7, 5.3, 6, 2),
(103, ' AMD Ryzen 7 7700', 'AM5 ', 3.8, 5.3, 8, 6),
(104, ' AMD Ryzen 7 7700X', 'AM5 ', 4.5, 5.4, 8, 6),
(105, ' AMD Ryzen 9 7900', 'AM5 ', 3.7, 5.4, 12, 24),
(106, ' AMD Ryzen 9 7900X', 'AM5 ', 4.7, 5.6, 12, 24),
(107, ' AMD Ryzen 9 7950X', 'AM5 ', 4.5, 5.7, 16, 32),
(108, ' AMD Ryzen 5 5600X', 'AM4 ', 3.7, 4.6, 6, 2),
(109, ' AMD Ryzen 5 5500', 'AM4 ', 3.6, 4.2, 6, 2),
(110, ' AMD Ryzen 5 5600', 'AM4 ', 3.5, 4.4, 6, 2),
(111, ' AMD Ryzen 5 5600G', 'AM4 ', 3.9, 4.4, 6, 2),
(112, ' AMD Ryzen 7 5700G', 'AM4 ', 3.8, 4.6, 8, 6),
(113, ' AMD Ryzen 7 5700X', 'AM4 ', 3.4, 4.6, 8, 6),
(114, ' AMD Ryzen 7 5800X', 'AM4 ', 3.8, 4.7, 8, 6),
(115, ' AMD Ryzen 7 5800X3D', 'AM4 ', 3.4, 4.5, 8, 6),
(116, ' AMD Ryzen 9 5900X', 'AM4 ', 3.7, 4.8, 12, 24),
(117, ' AMD Ryzen 9 5950X', 'AM4 ', 3.4, 4.9, 16, 32),
(118, ' AMD Ryzen 3 3200G', 'AM4 ', 3.6, 4, 4, 0),
(119, ' AMD Ryzen 5 3400G', 'AM4 ', 3.7, 4.2, 4, 0),
(120, ' AMD Ryzen 5 3600', 'AM4 ', 3.6, 4.2, 6, 2),
(121, ' AMD Ryzen 5 3600X', 'AM4 ', 3.8, 4.4, 6, 2),
(122, ' AMD Ryzen 7 3700X', 'AM4 ', 3.6, 4.4, 8, 6),
(123, ' AMD Ryzen 7 3800X', 'AM4 ', 3.9, 4.5, 8, 6),
(124, ' AMD Ryzen 9 3900X', 'AM4 ', 3.8, 4.6, 12, 24),
(125, ' AMD Ryzen 3 3300X', 'AM4 ', 3.8, 4.3, 4, 0),
(126, ' Intel Core i3-12100', '1700', 3.3, 4.3, 4, 8),
(127, ' Intel Core i3-12100F', '1700', 3.3, 4.3, 4, 8),
(128, ' Intel Core i5-12400', '1700', 2.5, 4.4, 6, 12),
(129, ' Intel Core i5-12400F', '1700', 2.5, 4.4, 6, 12),
(130, ' Intel Core i5-12600K', '1700', 3.6, 4.9, 6, 12),
(131, ' Intel Core i5-12600KF', '1700', 3.7, 4.9, 6, 12),
(132, ' Intel Core i7-13700K', '1700', 3.4, 3, 8, 16),
(133, ' Intel Core i7-13700KF', '1700', 3.4, 3, 8, 16),
(134, ' Intel Core i9-12900', '1700', 2.4, 5.1, 8, 16),
(135, ' Intel Core i9-12900KF', '1700', 3.2, 5.2, 8, 16),
(136, ' Intel Core i9-13900K', '1700', 3, 3, 8, 16),
(137, ' Intel Core i9-12900K', '1700', 3.2, 5.2, 8, 16),
(138, ' Intel Core i7-12700F', '1700', 2.1, 4.9, 8, 16),
(139, ' Intel Core i7-12700KF', '1700', 3.6, 5, 8, 16),
(140, ' Intel Core i9-12900KS', '1700', 3.4, 5.5, 8, 16),
(141, ' Intel Core i5-12500', '1700', 3, 4.6, 6, 12),
(142, ' Intel Core i5-12600', '1700', 3.3, 4.8, 6, 12),
(143, ' Intel Core i7-12700', '1700', 2.1, 4.9, 8, 16),
(144, ' Intel Core i9-13900KF', '1700', 3, 3, 8, 16),
(145, ' Intel Core i7-12700K', '1700', 3.6, 5, 8, 16),
(146, ' Intel Core i9-12900F', '1700', 2.4, 5.1, 8, 16),
(147, ' Intel Core i5-9400F', '1151', 2.9, 4.1, 6, 6),
(148, ' Intel Core i7-6700K', '1151', 4, 4.2, 4, 8),
(149, ' Intel Core i7-9700K', '1151', 3.6, 4.9, 8, 8),
(150, ' Intel Core i9-9900K', '1151', 3.6, 5, 8, 16),
(151, ' Intel Core i3-9100', '1151', 3.6, 4.2, 4, 4),
(152, ' Intel Core i3-9100F', '1151', 3.6, 4.2, 4, 4),
(153, ' Intel Core i3-9300', '1151', 3.7, 4.3, 4, 4),
(154, ' Intel Core i3-9320', '1151', 3.7, 4.4, 4, 4),
(155, ' Intel Core i3-9350KF', '1151', 4, 4.6, 4, 4),
(156, ' Intel Core i5-6400', '1151', 2.7, 3.3, 4, 4),
(157, ' Intel Core i5-6500', '1151', 3.2, 3.6, 4, 4),
(158, ' Intel Core i5-6600', '1151', 3.3, 3.9, 4, 4),
(159, ' Intel Core i5-6600K', '1151', 3.5, 3.9, 4, 4),
(160, ' Intel Core i5-7400', '1151', 3, 3.5, 4, 4),
(161, ' Intel Core i5-7500', '1151', 3.4, 3.8, 4, 4),
(162, ' Intel Core i5-7600', '1151', 3.5, 4.1, 4, 4),
(163, ' Intel Core i5-7600K', '1151', 3.8, 4.2, 4, 4),
(164, ' Intel Core i5-8400', '1151', 2.8, 4, 6, 6),
(165, ' Intel Core i5-8500', '1151', 3, 4.1, 6, 6),
(166, ' Intel Core i5-8600', '1151', 3.1, 4.3, 6, 6),
(167, ' Intel Core i5-8600K', '1151', 3.6, 4.3, 6, 6),
(168, ' Intel Core i5-9400', '1151', 2.9, 4.1, 6, 6),
(169, ' Intel Core i5-9500', '1151', 3, 4.4, 6, 6),
(170, ' Intel Core i5-9600', '1151', 3.1, 4.6, 6, 6),
(171, ' Intel Core i5-9600KF', '1151', 3.7, 4.6, 6, 6),
(172, ' Intel Core i7-6700', '1151', 3.4, 4, 4, 8),
(173, ' Intel Core i7-7700', '1151', 3.6, 4.2, 4, 8),
(174, ' Intel Core i7-7700K', '1151', 4.2, 4.5, 4, 8),
(175, ' Intel Core i7-8086K', '1151', 4, 5, 6, 12),
(176, ' Intel Core i7-8700', '1151', 3.2, 4.6, 6, 12),
(177, ' Intel Core i7-8700K', '1151', 3.7, 4.7, 6, 12),
(178, ' Intel Core i7-9700KF', '1151', 3.6, 4.9, 8, 8),
(179, ' Intel Core i9-9900KF', '1151', 3.6, 5, 8, 16),
(180, ' Intel Core i9-9900KS', '1151', 4, 5, 8, 16),
(181, ' Intel Core i5-10400', '1200', 2.9, 4, 6, 12),
(182, ' Intel Core i7-10700K', '1200', 3.8, 5.1, 8, 16),
(183, ' Intel Core i7-10700KF', '1200', 3.8, 5.1, 8, 16),
(184, ' Intel Core i9-10850K', '1200', 3.6, 5.2, 1, 2),
(185, ' Intel Core i9-10900K', '1200', 3.7, 5.3, 1, 2),
(186, ' Intel Core i9-11900K', '1200', 3.5, 5.2, 8, 16),
(187, ' Intel Core i3-10100', '1200', 3.6, 4.1, 4, 8),
(188, ' Intel Core i3-10100F', '1200', 3.6, 4.3, 4, 8),
(189, ' Intel Core i3-10300', '1200', 3.7, 4.2, 4, 8),
(190, ' Intel Core i3-10320', '1200', 3.8, 4.4, 4, 8),
(191, ' Intel Core i5-10400F', '1200', 2.9, 4, 6, 12),
(192, ' Intel Core i5-10600K', '1200', 4.1, 4.8, 6, 12),
(193, ' Intel Core i5-10600KF', '1200', 4.1, 4.8, 6, 12),
(194, ' Intel Core i9-10900KF', '1200', 3.7, 5.3, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gpu`
--

CREATE TABLE `gpu` (
  `id_gpu` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `producent_chipsetu` varchar(20) NOT NULL,
  `dlugosc_karty` float NOT NULL,
  `ilosc_ram` int(10) NOT NULL,
  `rodzaj_chipsetu` varchar(30) NOT NULL,
  `Rekomendowana_moc_zasilacza` float NOT NULL,
  `Taktowanie_rdzenia_boost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `gpu`
--

INSERT INTO `gpu` (`id_gpu`, `nazwa`, `producent_chipsetu`, `dlugosc_karty`, `ilosc_ram`, `rodzaj_chipsetu`, `Rekomendowana_moc_zasilacza`, `Taktowanie_rdzenia_boost`) VALUES
(401, 'Gigabyte GeForce RTX 3060 Eagle ', ' Gigabyte', 24.2, 12, 'GeForce RTX 3060', 550, 1807),
(402, 'MSI GeForce GTX 1660 SUPER Ventus XS OC ', ' MSI', 20.4, 6, 'GeForce GTX 1660 Super', 450, 1815),
(403, 'Gigabyte GeForce GTX 1050 Ti D5 ', ' Gigabyte', 17.2, 4, 'GeForce GTX 1050 Ti', 300, 1430),
(404, 'Gainward GeForce RTX 2060 SUPER Ghost', ' Gainward', 23.5, 8, 'GeForce RTX 2060 Super', 550, 1650),
(405, 'MSI GeForce RTX 3090 Ti Black Trio', ' MSI', 32.5, 24, 'GeForce RTX 3090 Ti', 850, 1860),
(406, 'Zotac Gaming GeForce RTX 4090 AMP Extreme AIRO', ' Zotac', 33.6, 24, 'GeForce RTX 4090', 1000, 2580);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hdd`
--

CREATE TABLE `hdd` (
  `id_hdd` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `format` varchar(30) NOT NULL,
  `interfejs` varchar(20) NOT NULL,
  `pamiec_podreczna` float NOT NULL,
  `pojemnosc` float NOT NULL,
  `predkosc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `hdd`
--

INSERT INTO `hdd` (`id_hdd`, `nazwa`, `format`, `interfejs`, `pamiec_podreczna`, `pojemnosc`, `predkosc`) VALUES
(1001, 'Seagate BarraCuda', ' 3.5\"', 'SATA III', 64, 1024, 7200),
(1002, 'Toshiba P300', '3.5\"', ' SATA III', 64, 1024, 7200),
(1003, 'WD Blue', '2.5\"', 'SATA III ', 128, 1024, 5400),
(1004, 'Seagate FireCuda', '3.5\"', 'SATA III', 256, 8192, 7200),
(1007, 'Toshiba X300 Performance', '3.5\"', 'SATA III', 256, 14336, 7200);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mb`
--

CREATE TABLE `mb` (
  `id_mb` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `chipset_plyty` varchar(20) NOT NULL,
  `gniazdo_procesora` varchar(20) NOT NULL,
  `liczba_slotow_pamieci` int(11) NOT NULL,
  `standard_plyty` varchar(20) NOT NULL,
  `standard_pamieci` varchar(20) NOT NULL,
  `maks_ilosc_pamieci_ram` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `mb`
--

INSERT INTO `mb` (`id_mb`, `nazwa`, `chipset_plyty`, `gniazdo_procesora`, `liczba_slotow_pamieci`, `standard_plyty`, `standard_pamieci`, `maks_ilosc_pamieci_ram`) VALUES
(201, 'Płyta główna Gigabyte B660M DS', 'Intel B660', 'Socket 1700', 4, 'Micro ATX', ' DDR4', 128),
(202, 'Płyta główna MSI PRO B660M-G', 'Intel B660', 'Socket 1700', 2, 'Micro ATX', ' DDR4', 64),
(203, 'Płyta główna Asus PRIME B450-P', 'AMD B450', 'Socket AM4', 4, 'ATX', ' DDR4', 128),
(204, 'Płyta główna Gigabyte B450 AORUS ELITE V2', 'AMD B450', 'Socket AM4', 4, 'ATX', ' DDR4', 128),
(205, 'Płyta główna MSI MPG Z490 GAMING PLUS', 'Intel Z490', 'Socket 1200', 4, 'ATX', 'DDR4', 128),
(206, 'Płyta główna Gigabyte Z590 UD AC', 'Intel Z590', 'Socket 1200', 4, 'ATX', 'DDR4', 128),
(207, 'Płyta główna Asus TUF GAMING X670E-PLUS WIFI', 'AMD X670E', 'Socket AM5', 4, 'ATX', 'DDR5', 128),
(208, 'Płyta główna Gigabyte B650 GAMING X AX', 'AMD B650', 'Socket AM5', 4, 'ATX', 'DDR5', 128),
(209, 'Płyta główna ASRock Q270 PRO BTC+', 'Intel Q270', 'Socket 1151', 2, 'ATX', 'DDR4', 32),
(210, 'Płyta główna Biostar TB250-BTC PRO', 'Intel B250', 'Socket 1151', 2, 'ATX', 'DDR4', 32);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obudowa`
--

CREATE TABLE `obudowa` (
  `id_obudowa` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `standard` varchar(20) NOT NULL,
  `maks_dlugosc_karty_graf` float NOT NULL,
  `typ_obudowy` varchar(25) NOT NULL,
  `wysokosc` float NOT NULL,
  `szerokosc` float NOT NULL,
  `glebokosc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `obudowa`
--

INSERT INTO `obudowa` (`id_obudowa`, `nazwa`, `standard`, `maks_dlugosc_karty_graf`, `typ_obudowy`, `wysokosc`, `szerokosc`, `glebokosc`) VALUES
(301, 'Endorfy Regnum 400 ARGB (EY2A009)', 'ATX', 37, 'Midi Tower', 47.2, 22, 44.2),
(302, 'Krux Vortex ARGB (KRX0094)', 'ATX', 34.5, 'Midi Tower', 49, 21.5, 41.6),
(303, 'be quiet! Pure Base 600 Window (BGW20)', 'ATX', 42.5, 'Midi Tower', 47, 22, 49.2),
(304, 'Krux Astro ARGB (KRX0016)', 'Micro ATX', 28, 'Midi Tower', 35.9, 18.4, 2.8),
(305, 'Cooler Master N200 (NSE-200-KKN1)', 'Micro ATX', 27, 'Mini Tower', 37.8, 20.2, 44.5),
(306, 'Fractal Design Torrent Nano TG Dark Tint (FD-C-TOR', 'Mini ITX', 33.5, 'Micro Tower', 37.4, 22.2, 41.7),
(307, 'Fractal Design Torrent (FD-C-TOR1N-01)', 'Mini ITX', 33.5, 'Micro Tower', 37.4, 22.2, 41.7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ram`
--

CREATE TABLE `ram` (
  `id_ram` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `czestotliwosc` float NOT NULL,
  `liczba_modulow` int(10) NOT NULL,
  `laczna_pamiec` int(10) NOT NULL,
  `opoznienie` varchar(10) NOT NULL,
  `typ_pamieci` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ram`
--

INSERT INTO `ram` (`id_ram`, `nazwa`, `czestotliwosc`, `liczba_modulow`, `laczna_pamiec`, `opoznienie`, `typ_pamieci`) VALUES
(801, 'Patriot Viper Steel', 3600, 2, 16, 'CL17', 'DDR4'),
(802, 'Kingston Fury Beast', 3200, 2, 16, 'CL16', 'DDR4'),
(803, 'Patriot Viper Venom', 6200, 2, 32, 'CL40', 'DDR5'),
(804, 'Gigabyte AORUS RGB', 3333, 2, 16, 'CL18', 'DDR4'),
(805, 'Kingston Fury Renegade RGB', 3600, 2, 16, 'CL16', 'DDR4'),
(806, 'Corsair Vengeance', 5600, 2, 32, 'CL36', 'DDR5'),
(807, 'G.Skill Trident Z5 RGB', 5600, 2, 32, 'CL36', 'DDR5');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ssd`
--

CREATE TABLE `ssd` (
  `id` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `interfejs` varchar(30) NOT NULL,
  `pojemnosc` float NOT NULL,
  `format` varchar(30) NOT NULL,
  `odczyt` float NOT NULL,
  `zapis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ssd`
--

INSERT INTO `ssd` (`id`, `nazwa`, `interfejs`, `pojemnosc`, `format`, `odczyt`, `zapis`) VALUES
(901, 'GoodRam CX400 gen.2', 'SATA III', 512, '2.5\"', 550, 500),
(902, 'Kingston KC3000', 'PCI-E x4 Gen4 NVMe', 1024, 'M.2 2280', 7000, 6000),
(903, 'Samsung 980', 'PCI-E x4 Gen3 NVMe', 1024, 'M.2 2280', 3000, 3500),
(904, 'Kingston NV2', 'PCI-E x4 Gen4 NVMe', 1024, 'M.2 2280', 3500, 2100),
(905, 'ADATA Ultimate SU650', 'SATA III', 1024, '2.5\"', 520, 450),
(906, 'Samsung 990 PRO', 'PCI-E x4 Gen4 NVMe', 2048, 'M.2 2280', 7450, 6900),
(907, 'MSI Spatium M371', 'PCI-E x4 Gen3 NVMe', 1024, 'M.2 2280', 2350, 1700);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zasilacz`
--

CREATE TABLE `zasilacz` (
  `id_zasilacz` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `certyfikat` varchar(40) NOT NULL,
  `srednica_wentylatora` float NOT NULL,
  `moc` int(10) NOT NULL,
  `standard` varchar(20) NOT NULL,
  `wysokosc` float NOT NULL,
  `szerokosc` float NOT NULL,
  `glebokosc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zasilacz`
--

INSERT INTO `zasilacz` (`id_zasilacz`, `nazwa`, `certyfikat`, `srednica_wentylatora`, `moc`, `standard`, `wysokosc`, `szerokosc`, `glebokosc`) VALUES
(501, 'Thermaltake Smart SE', 'brak', 14, 530, 'ATX', 8.6, 15, 16),
(502, 'Corsair RM850e', '80 Plus Gold', 12, 850, 'ATX', 8.6, 15, 14),
(503, 'MSI MPG A850G PCIE5', '80 Plus Gold', 13.5, 850, 'ATX', 8.6, 15, 15),
(504, 'Gigabyte UD1000GM PG5 1000W ATX 3.0', '80 Plus Gold', 12, 1000, 'ATX', 8.6, 15, 14),
(505, 'Gigabyte UD750GM', '80 Plus Gold', 12, 750, 'ATX', 9, 14, 14),
(506, 'SilentiumPC Vero L3', '80 Plus Bronze', 12, 500, 'ATX', 8.6, 15, 14);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `chlodzenie_cpu`
--
ALTER TABLE `chlodzenie_cpu`
  ADD PRIMARY KEY (`id_chlodzenie_cpu`);

--
-- Indeksy dla tabeli `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id_cpu`);

--
-- Indeksy dla tabeli `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`id_gpu`);

--
-- Indeksy dla tabeli `hdd`
--
ALTER TABLE `hdd`
  ADD PRIMARY KEY (`id_hdd`);

--
-- Indeksy dla tabeli `mb`
--
ALTER TABLE `mb`
  ADD PRIMARY KEY (`id_mb`);

--
-- Indeksy dla tabeli `obudowa`
--
ALTER TABLE `obudowa`
  ADD PRIMARY KEY (`id_obudowa`);

--
-- Indeksy dla tabeli `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id_ram`);

--
-- Indeksy dla tabeli `ssd`
--
ALTER TABLE `ssd`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zasilacz`
--
ALTER TABLE `zasilacz`
  ADD PRIMARY KEY (`id_zasilacz`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `chlodzenie_cpu`
--
ALTER TABLE `chlodzenie_cpu`
  MODIFY `id_chlodzenie_cpu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT dla tabeli `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id_cpu` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT dla tabeli `gpu`
--
ALTER TABLE `gpu`
  MODIFY `id_gpu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=407;

--
-- AUTO_INCREMENT dla tabeli `hdd`
--
ALTER TABLE `hdd`
  MODIFY `id_hdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT dla tabeli `mb`
--
ALTER TABLE `mb`
  MODIFY `id_mb` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT dla tabeli `obudowa`
--
ALTER TABLE `obudowa`
  MODIFY `id_obudowa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT dla tabeli `ram`
--
ALTER TABLE `ram`
  MODIFY `id_ram` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=808;

--
-- AUTO_INCREMENT dla tabeli `ssd`
--
ALTER TABLE `ssd`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=908;

--
-- AUTO_INCREMENT dla tabeli `zasilacz`
--
ALTER TABLE `zasilacz`
  MODIFY `id_zasilacz` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
