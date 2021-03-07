-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 03, 2021 alle 00:15
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_grafico`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_istogramma`
--

CREATE TABLE `tbl_istogramma` (
  `SalesId` int(11) NOT NULL,
  `Product` varchar(90) NOT NULL,
  `TotalSales` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tbl_istogramma`
--

INSERT INTO `tbl_istogramma` (`SalesId`, `Product`, `TotalSales`) VALUES
(1, 'Surf Powder', 1400),
(2, 'Mr. Clean Powder', 800),
(3, 'Tide Powder', 5052),
(4, 'Ariel Powder', 8030);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_linea`
--

CREATE TABLE `tbl_linea` (
  `SalesId` int(11) NOT NULL,
  `TRANSDATE` date NOT NULL,
  `Product` varchar(90) NOT NULL,
  `TotalSales` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tbl_linea`
--

INSERT INTO `tbl_linea` (`SalesId`, `TRANSDATE`, `Product`, `TotalSales`) VALUES
(1, '2018-01-30', 'Surf Powder', 1400),
(2, '2018-02-28', 'Surf Powder', 800),
(3, '2018-03-31', 'Surf Powder', 5052),
(4, '2019-04-30', 'Surf Powder', 8030),
(5, '2019-05-31', 'Surf Powder', 10000);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_torta`
--

CREATE TABLE `tbl_torta` (
  `SalesId` int(11) NOT NULL,
  `Product` varchar(90) NOT NULL,
  `TotalSales` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tbl_torta`
--

INSERT INTO `tbl_torta` (`SalesId`, `Product`, `TotalSales`) VALUES
(1, 'Surf Powder', 1400),
(2, 'Mr. Clean Powder', 800),
(3, 'Tide Powder', 5052),
(4, 'Ariel Powder', 8030);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tbl_istogramma`
--
ALTER TABLE `tbl_istogramma`
  ADD PRIMARY KEY (`SalesId`);

--
-- Indici per le tabelle `tbl_torta`
--
ALTER TABLE `tbl_torta`
  ADD PRIMARY KEY (`SalesId`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tbl_istogramma`
--
ALTER TABLE `tbl_istogramma`
  MODIFY `SalesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tbl_torta`
--
ALTER TABLE `tbl_torta`
  MODIFY `SalesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
