-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2024 at 04:01 PM
-- Server version: 10.5.23-MariaDB-0+deb11u1-log
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wouafwouaf_casino`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `IdUtilisateur` int(11) NOT NULL,
  `pseudo` varchar(99) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mdp` varchar(999) DEFAULT NULL,
  `DateCreationCompte` timestamp NULL DEFAULT NULL,
  `AdresseIP` varchar(45) DEFAULT NULL,
  `coins` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `pseudo`, `Nom`, `Prenom`, `email`, `mdp`, `DateCreationCompte`, `AdresseIP`, `coins`) VALUES
(1, 'Lyxow', 'Reinee', 'Enzo', 'enzo.reine35@gmail.com', '$2y$10$UNYzak8U5oXK15EzpUVjFuwYTOTA0okwMa2zu5gUrx8wci1P8RC.i', '2024-03-26 15:35:01', '::1', 100015),
(2, 'Blytepro', 'Capodano', 'Yann', 'yznn.capo@ecoles-epsi.net', 'azerty', '2024-03-26 15:35:01', '', 115),
(3, 'Lyxowwwwwww', 'fqfs', 'enzooo', 'enzo.reine@ecolefqdfs-epsi.net', '', '2024-04-02 08:59:20', '::1', 100),
(4, 'Lyxowwwwwwwwww', 'fqfsfqds', 'enzoooqfqf', 'enzo.reine@ecolefqdfs-epsi.netttt', '', '2024-04-02 09:00:41', '::1', 100),
(6, 'qsfsqf', 'fqsfqsf', 'qfsqfqsf', 'enzo.reine38@gmail.com', '', '2024-04-02 09:31:18', '82.210.63.58', 100),
(7, 'jjfjifjijij', 'kkkkkk', 'kkkkkk', 'enzo.reine39@gmail.com', '', '2024-04-25 14:50:14', '79.95.86.4', 100),
(8, 'TEST', 'testttt', 'test', 'test@t.com', '', '2024-04-25 14:58:40', '::1', 100),
(9, 'moi', 't', 't', 'moi@moi.moi', 'azerty', '2024-04-25 15:02:21', '::1', 100),
(10, 'toi', 'toi', 'toi', 'toi@toi.com', 'azerty', '2024-04-25 15:04:08', '::1', 100),
(11, 'zapaz', 'sidaa', 'rihannaa', 'zapaz@gmail.com', 'azerty01', '2024-04-25 15:14:50', '79.95.86.4', 65),
(12, 'Just1test', 'tkt', 'cmoi', 'test@test.com', 'azerty', '2024-04-30 13:40:57', '79.95.86.121', 105),
(13, 'tototata', 'tata', 'toto', 'toto@mail.tld', 'toto@toto', '2024-06-04 13:51:51', '92.174.88.93', 100),
(14, 'testttt', 'hash', 'hhh', 'hash@hash.com', '$2y$10$f.5h6U5V0IQ6KWjXUtUjM.67weBcp.sghvgiLVP1gLxdVnTJKqwZa', '2024-06-04 14:08:00', '::1', 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`IdUtilisateur`),
  ADD UNIQUE KEY `IdUtilisateur` (`IdUtilisateur`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `IdUtilisateur_UNIQUE` (`IdUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
