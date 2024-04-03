

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
  `HeureDebutPartie` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gamename`
--

DROP TABLE IF EXISTS `gamename`;
CREATE TABLE IF NOT EXISTS `gamename` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NomJeu` varchar(99) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gamename`
--

INSERT INTO `gamename` (`Id`, `NomJeu`) VALUES
(1, 'BlackJack'),
(2, 'Shifumi'),
(3, 'Pile ou Face');

-- --------------------------------------------------------

--
-- Structure de la table `games_history`
--

DROP TABLE IF EXISTS `games_history`;
CREATE TABLE IF NOT EXISTS `games_history` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `IdJoueur` int NOT NULL,
  `GameName` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Resultat` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Points` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `games_history`
--

INSERT INTO `games_history` (`Id`, `IdJoueur`, `GameName`, `Resultat`, `Points`) VALUES
(1, 1, 'Pile ou Face', 'Gagné', '5'),
(2, 1, 'Pile ou Face', 'Gagné', '5'),
(3, 1, 'Pile ou Face', 'Perdu', '-5'),
(4, 1, 'Pile ou Face', 'Gagné', '5'),
(5, 1, 'Pile ou Face', 'Perdu', '-5'),
(6, 1, 'Pile ou Face', 'Perdu', '-5'),
(7, 1, 'Pile ou Face', 'Gagné', '5'),
(8, 1, 'Pile ou Face', 'Gagné', '5'),
(9, 1, 'Pile ou Face', 'Perdu', '-5'),
(10, 1, 'Pile ou Face', 'Gagné', '5'),
(11, 1, 'Pile ou Face', 'Gagné', '5'),
(12, 1, 'Pile ou Face', 'Perdu', '-5'),
(13, 2, 'Pile ou Face', 'Gagné', '5'),
(14, 2, 'Pile ou Face', 'Perdu', '-5'),
(15, 2, 'Pile ou Face', 'Gagné', '5'),
(16, 2, 'Shifumi', 'Égalité', '0'),
(17, 2, 'Shifumi', 'Égalité', '0'),
(18, 2, 'Shifumi', 'Victoire', '5'),
(19, 2, 'Shifumi', 'Égalité', '0'),
(20, 2, 'Shifumi', 'Victoire', '5'),
(21, 2, 'Shifumi', 'Victoire', '5'),
(22, 2, 'Shifumi', 'Victoire', '5'),
(23, 2, 'Shifumi', 'Égalité', '0'),
(24, 2, 'Shifumi', 'Victoire', '5'),
(25, 2, 'Shifumi', 'Égalité', '0'),
(26, 2, 'Shifumi', 'Victoire', '5'),
(27, 2, 'Shifumi', 'Défaite', '-5'),
(28, 2, 'Shifumi', 'Victoire', '5'),
(29, 2, 'Shifumi', 'Victoire', '5'),
(30, 1, 'Shifumi', 'Victoire', '5'),
(31, 1, 'Shifumi', 'Égalité', '0'),
(32, 1, 'Shifumi', 'Victoire', '5'),
(33, 1, 'Shifumi', 'Victoire', '5'),
(34, 1, 'Shifumi', 'Défaite', '-5'),
(35, 1, 'Shifumi', 'Défaite', '-5'),
(36, 1, 'Shifumi', 'Égalité', '0'),
(37, 1, 'Shifumi', 'Défaite', '-5'),
(38, 1, 'Shifumi', 'Défaite', '-5'),
(39, 1, 'Shifumi', 'Égalité', '0'),
(40, 1, 'Shifumi', 'Défaite', '-5'),
(41, 1, 'Shifumi', 'Victoire', '5'),
(42, 2, 'Shifumi', 'Égalité', '0'),
(43, 2, 'Shifumi', 'Égalité', '0'),
(44, 2, 'Shifumi', 'Égalité', '0'),
(45, 2, 'Shifumi', 'Égalité', '0'),
(46, 2, 'Shifumi', 'Victoire', '5'),
(47, 2, 'Shifumi', 'Défaite', '-5'),
(48, 2, 'Blackjack', 'Gagné', '5'),
(49, 2, 'Blackjack', 'Gagné', '5'),
(50, 2, 'Blackjack', 'Gagné', '5'),
(51, 2, 'Blackjack', 'Perdu', '-5'),
(52, 2, 'Blackjack', 'Perdu', '-5'),
(53, 1, 'Blackjack', 'Perdu', '-5'),
(54, 1, 'Pile ou Face', 'Gagné', '5'),
(55, 1, 'Blackjack', 'Perdu', '-5'),
(56, 2, 'Blackjack', 'Perdu', '-5'),
(57, 2, 'Blackjack', 'Perdu', '-5'),
(58, 2, 'Blackjack', 'Perdu', '-5'),
(59, 2, 'Blackjack', 'Gagné', '5'),
(60, 2, 'Shifumi', 'Égalité', '0'),
(61, 2, 'Shifumi', 'Victoire', '5'),
(62, 2, 'Shifumi', 'Égalité', '0'),
(63, 2, 'Shifumi', 'Défaite', '-5'),
(64, 2, 'Shifumi', 'Défaite', '-5'),
(65, 2, 'Shifumi', 'Défaite', '-5'),
(66, 2, 'Shifumi', 'Égalité', '0'),
(67, 2, 'Shifumi', 'Égalité', '0'),
(68, 2, 'Shifumi', 'Victoire', '5'),
(69, 2, 'Shifumi', 'Défaite', '-5'),
(70, 2, 'Shifumi', 'Défaite', '-5'),
(71, 2, 'Shifumi', 'Victoire', '5'),
(72, 2, 'Pile ou Face', 'Gagné', '5'),
(73, 2, 'Pile ou Face', 'Gagné', '5'),
(74, 2, 'Pile ou Face', 'Gagné', '5'),
(75, 2, 'Pile ou Face', 'Perdu', '-5'),
(76, 2, 'Pile ou Face', 'Gagné', '5'),
(77, 2, 'Pile ou Face', 'Gagné', '5'),
(78, 2, 'Pile ou Face', 'Gagné', '5'),
(79, 2, 'Pile ou Face', 'Perdu', '-5'),
(80, 2, 'Pile ou Face', 'Gagné', '5'),
(81, 2, 'Pile ou Face', 'Gagné', '5'),
(82, 2, 'Shifumi', 'Égalité', '0'),
(83, 2, 'Shifumi', 'Victoire', '5'),
(84, 2, 'Shifumi', 'Égalité', '0'),
(85, 2, 'Shifumi', 'Égalité', '0'),
(86, 2, 'Shifumi', 'Égalité', '0'),
(87, 2, 'Shifumi', 'Défaite', '-5'),
(88, 2, 'Shifumi', 'Défaite', '-5'),
(89, 2, 'Shifumi', 'Égalité', '0');

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `HeureDebutPartie` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistic`
--

DROP TABLE IF EXISTS `statistic`;
CREATE TABLE IF NOT EXISTS `statistic` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `IdJoueur` int NOT NULL,
  `StatLabel` varchar(99) COLLATE utf8mb4_general_ci NOT NULL,
  `StatValue` int NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtilisateur` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(99) COLLATE utf8mb4_general_ci NOT NULL,
  `Nom` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Prenom` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `DateCreationCompte` timestamp NULL DEFAULT NULL,
  `AdresseIP` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coins` int NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  UNIQUE KEY `IdUtilisateur` (`IdUtilisateur`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `IdUtilisateur_UNIQUE` (`IdUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE utilisateur MODIFY COLUMN mdp VARCHAR(255);

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `pseudo`, `Nom`, `Prenom`, `email`, `mdp`, `DateCreationCompte`, `AdresseIP`, `coins`) VALUES
(1, 'Lyxow', 'Reine', 'Enzo', 'enzo.reine@ecoles-epsi.net', 'azerty', '2024-03-26 15:35:01', '', 100),
(2, 'Blytepro', 'Capodano', 'Yann', 'yznn.capo@ecoles-epsi.net', 'azerty', '2024-03-26 15:35:01', '', 115);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
