-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 21 fév. 2024 à 09:30
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `casino`
--

-- --------------------------------------------------------

--
-- Structure de la table `blackjack`
--

DROP TABLE IF EXISTS `blackjack`;
CREATE TABLE IF NOT EXISTS `blackjack` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `HeureDebutPartie` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `games_history`
--

DROP TABLE IF EXISTS `games_history`;
CREATE TABLE IF NOT EXISTS `games_history` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `IdJoueur` int NOT NULL,
  `GameName` varchar(45) NOT NULL,
  `Resultat` varchar(45) NOT NULL,
  `Points` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id`, `score`) VALUES
(1, 133);

-- --------------------------------------------------------

--
-- Structure de la table `shifumi`
--

DROP TABLE IF EXISTS `shifumi`;
CREATE TABLE IF NOT EXISTS `shifumi` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NbVictoire` int NOT NULL,
  `NbDefaite` int NOT NULL,
  `RatioVictoire` int NOT NULL,
  `HeureDebutPartie` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistic`
--

DROP TABLE IF EXISTS `statistic`;
CREATE TABLE IF NOT EXISTS `statistic` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `IdJoueur` int NOT NULL,
  `StatLabel` varchar(99) NOT NULL,
  `StatValue` int NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `GameName`;
CREATE TABLE IF NOT EXISTS `GameName` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NomJeu` varchar(99) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `GameName` (`NomJeu`) VALUES
('BlackJack'),
('Shifumi'),
('Pile ou Face');
COMMIT;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtilisateur` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(99) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mdp` varchar(45) NOT NULL,
  `DateCreationCompte` TIMESTAMP NULL,
  `AdresseIP` varchar(45) DEFAULT NULL,
  `coins` int NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  UNIQUE KEY `IdUtilisateur` (`IdUtilisateur`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `IdUtilisateur_UNIQUE` (`IdUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `Nom`, `Prenom`, `email`, `mdp`, `DateCreationCompte`, `AdresseIP`, `coins`) VALUES
('Lyxow', 'Reine', 'Enzo', 'enzo.reine@ecoles-epsi.net', 'azerty', NOW(), '', 100),
('Blytepro', 'Capodano', 'Yann', 'yann.capo@ecoles-epsi.net', 'azerty', NOW(), '', 100);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
