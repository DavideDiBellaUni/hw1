-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 24, 2021 alle 10:29
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concept_hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `cod_articolo` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `sezione` varchar(30) DEFAULT NULL,
  `titolo` varchar(30) DEFAULT NULL,
  `nomefile` varchar(60) DEFAULT NULL,
  `data_pubblicazione` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`cod_articolo`, `username`, `sezione`, `titolo`, `nomefile`, `data_pubblicazione`) VALUES
(11, 'davidedibella', 'Arte', 'Il paradosso della tolleranza', 'Ilparadossodellatolleranza.docx', '2021-05-23'),
(12, 'mcrao', 'Lifestyle', 'Rolex', 'Rolex.docx', '2021-05-23'),
(13, 'samuelmedicina', 'Attualita', 'Mining-Il problema delle gpu', 'Mining - Problema GPU.docx', '2021-05-23'),
(16, 'giovigrava', 'Musica', 'Inuyasha', 'inuyasha.docx', '2021-05-23'),
(17, 'chiararusso', 'Attualita', 'La prima casa in \"3D\"', 'La prima casa d’Europa stampata in 3d.docx', '2021-05-23'),
(19, 'davidedibella', 'Arte', 'Il principe Filippo', 'Principe Filippo.docx', '2021-05-23'),
(21, 'mariorossi', 'Musica', 'Pinguini tattici nucleari', 'AHIA!.docx', '2021-05-23'),
(22, 'greygoy', 'Lifestyle', 'Il robot del futuro!', 'Hifusk, il robot del futuro!.docx', '2021-05-23');

--
-- Trigger `articolo`
--
DELIMITER $$
CREATE TRIGGER `addarticolo` AFTER INSERT ON `articolo` FOR EACH ROW begin
update utente set num_articoli=num_articoli+1 where username= new.username;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removearticolo` AFTER DELETE ON `articolo` FOR EACH ROW begin
update utente set num_articoli=num_articoli-1 where username= old.username;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `artpref`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `artpref` (
`cod_articolo` int(11)
,`userpref` varchar(30)
,`autore` varchar(30)
,`titolo` varchar(30)
,`sezione` varchar(30)
,`nomefile` varchar(60)
,`data_pubblicazione` date
);

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `cod_articolo` int(11) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`cod_articolo`, `username`) VALUES
(11, 'greygoy'),
(12, 'greygoy'),
(13, 'davidedibella'),
(16, 'davidedibella'),
(17, 'mcrao'),
(21, 'mcrao'),
(22, 'davidedibella');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `username` varchar(30) NOT NULL,
  `password` varchar(70) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `num_articoli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `password`, `nome`, `cognome`, `email`, `num_articoli`) VALUES
('chiararusso', '$2y$10$DO.0i1w509h1LcssZG4TLu1WXmx1sBNEIc4gdz7b9ckFETK26m7P6', 'Chiara', 'Russo', 'chiarusso@hotmail.it', 1),
('ciccio', '$2y$10$qlmeNRNQVnlHElcAmL1lnuG40E8Zzpn2uMFZQtI41ymr55ot4Qebi', 'Davide', 'Di Bella', 'dibbi27@outlook.it', 0),
('davidedibella', '$2y$10$ZbVyTQvOjJVMpD3iaqk21utmObG12bCUxDo4pJzWkzjQ3dDQV/zkK', 'Davide', 'Di Bella', 'dibbi27@outlook.it', 2),
('giacomopresti', '$2y$10$8usIs806IyNUe70XuIDOxO01zPpjfcvonNT.IQ/HjU7udHDD1InSu', 'Giacomo', 'Presti', 'giacomopresti@gmail.com', 0),
('giovigrava', '$2y$10$6LNk30sXCtrZ8/t5B9.pcez.kEMzLHml5fZ8PtEw8HURUyqxgyq9e', 'Giovanni', 'Galanna', 'giovigrava@gmail.com', 1),
('greygoy', '$2y$10$v94U61vF9nzpaIlX/Cd0OOx8OHdOja0k7ji6NS/QbiS9HhJ8zlLm2', 'Filippo', 'Costanzo', 'filippocostanzo@gmail.com', 1),
('mariorossi', '$2y$10$NAj3gDYlPWNd/hThVLMXLeyiB6sA/yKdDlc5EV3Isb1B8J.D9MtDG', 'Mario', 'Rossi', 'mariorossi@gmail.com', 1),
('mcrao', '$2y$10$DhguB/2nwHO7QCKSMlNweuMjk1F5T7KFnBvE4.t/ybESO8u/x1J6O', 'Marco', 'Di Raimondo', 'mcrao@outlook.it', 1),
('samuelmedicina', '$2y$10$NeiCQaVKEtD8W7YwssGdOOfuMN8mZKnA1pHPyszbwVjoUCscxyTfi', 'Samuel', 'Medicina', 'samumed@tiscali.it', 1);

-- --------------------------------------------------------

--
-- Struttura per vista `artpref`
--
DROP TABLE IF EXISTS `artpref`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `artpref`  AS SELECT `l`.`cod_articolo` AS `cod_articolo`, `p`.`username` AS `userpref`, `l`.`username` AS `autore`, `l`.`titolo` AS `titolo`, `l`.`sezione` AS `sezione`, `l`.`nomefile` AS `nomefile`, `l`.`data_pubblicazione` AS `data_pubblicazione` FROM (`articolo` `l` join `preferiti` `p` on(`l`.`cod_articolo` = `p`.`cod_articolo`)) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`cod_articolo`),
  ADD KEY `username` (`username`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`cod_articolo`,`username`),
  ADD KEY `username` (`username`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `cod_articolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utente` (`username`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utente` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`cod_articolo`) REFERENCES `articolo` (`cod_articolo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
