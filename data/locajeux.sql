-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 08 avr. 2023 à 08:17
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `locajeux`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_c` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_c` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_c`, `name_c`) VALUES
(1, 'Expert'),
(2, 'Initié'),
(3, 'Familiale'),
(4, 'Extension');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id_j` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_j` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_j` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rules_j` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loc_j` float NOT NULL,
  `caution_j` float NOT NULL,
  `id_j_p` int(10) UNSIGNED DEFAULT NULL,
  `id_t` int(10) UNSIGNED NOT NULL,
  `id_c` int(10) UNSIGNED NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_j`),
  KEY `id_j_p` (`id_j_p`),
  KEY `id_c` (`id_c`) USING BTREE,
  KEY `id_t` (`id_t`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id_j`, `name_j`, `img_j`, `rules_j`, `loc_j`, `caution_j`, `id_j_p`, `id_t`, `id_c`, `disponible`) VALUES
(1, 'SubTerra', 'sub_terra.png', 'Sub-terra.pdf', 10, 40, NULL, 1, 1, 1),
(2, '7 Wonders', '7_wonders.jpg', '7-wonders.pdf', 10, 30, NULL, 2, 1, 1),
(3, 'Esquisse', 'Esquisse.jpg', 'esquisse.pdf', 7, 50, NULL, 3, 3, 1),
(4, 'Sound Box', 'sound_box.jpg', 'sound-box.pdf', 5, 25, NULL, 3, 3, 1),
(5, 'Aeons End', 'aeon_s_end.jpg', 'Aeons-end.pdf', 12, 60, NULL, 1, 1, 1),
(6, 'Andor', 'andor.jpg', 'andor.pdf', 10, 50, NULL, 1, 1, 1),
(7, 'Call to adventure', 'call_to_adventure.jpeg', 'call-to-adventure.pdf', 5, 40, NULL, 2, 2, 1),
(8, 'Andor héros Sombres', 'andor_heros_sombres.jpg', 'andor-heros-sombres.pdf', 8, 30, 6, 1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `l_jeux_utilisateurs`
--

DROP TABLE IF EXISTS `l_jeux_utilisateurs`;
CREATE TABLE IF NOT EXISTS `l_jeux_utilisateurs` (
  `id_loc` int(11) NOT NULL AUTO_INCREMENT,
  `id_j` int(10) UNSIGNED NOT NULL,
  `id_u` int(10) UNSIGNED NOT NULL,
  `note` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'note entre 0 et 5',
  `com` text COLLATE utf8mb4_unicode_ci,
  `date_loc` date DEFAULT NULL,
  `date_dispo` date DEFAULT NULL,
  PRIMARY KEY (`id_loc`),
  KEY `id_j` (`id_j`),
  KEY `id_u` (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `l_jeux_utilisateurs`
--

INSERT INTO `l_jeux_utilisateurs` (`id_loc`, `id_j`, `id_u`, `note`, `com`, `date_loc`, `date_dispo`) VALUES
(20, 1, 5, 4, 'zfez', '2023-03-29', NULL),
(21, 8, 1, 2, 'N\'apporte pas grand chose au jeu de base', '2023-03-29', NULL),
(22, 6, 1, 4, 'Super jeu avec une grosse difficulté, peut être parfois trop punitif', '2023-03-29', NULL),
(23, 3, 1, 5, 'Vraiment trop drôle', '2023-03-29', NULL),
(24, 3, 5, 5, 'MOUHAHAHAHAHahahahahaha.......', '2023-03-29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id_t` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_t` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_t`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id_t`, `name_t`) VALUES
(1, 'Coopératif'),
(2, 'Compétitif'),
(3, 'Ambiance');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_u` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_u` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname_u` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naissance_u` date NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_u` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp_u` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Doit être haché',
  PRIMARY KEY (`id_u`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_u`, `name_u`, `firstname_u`, `naissance_u`, `email`, `address_u`, `mdp_u`) VALUES
(1, 'Serain', 'Tommy', '1987-01-28', 'tommyserain@yahoo.fr', '49 rue duguesclin', '$2y$10$zTNmozHdFo6iYH0CoQd04.Jyt1vobHe5gScKhjJRbUWv9RMlLKPy.'),
(5, 'test-nom', 'test-prenom', '2023-03-10', 'test@test.fr', 'test', '$2y$10$NhM8AnCwbdgROueJ5oRFM.egvdJWttfrgl3M2BuKc4Z.zjIwcaSD.'),
(13, 'test2', 'test2', '2000-01-01', 'test2@test.fr', 'tes2', '$2y$10$izj0Hu823n4g.Q6UVqNV/OX4v0YRPXX/iCwsFXLYcoGLnb8X3uJUO'),
(14, 'Serain', 'Marie-fleur', '1987-04-07', 'ptiteBouboule@gmail.com', '49 rue duguesclin', '$2y$10$ypEpWFrefj3sx.UbFi7KpeHhL2oCFCss5C4imPDMo8dW0HTwKEfHa'),
(15, 'momo', 'le sorcier', '1995-06-07', 'momo@poudlard.com', 'poudlard', '$2y$10$LZMruLOa9xgKtDrzuyB23uXexkJce2V2qbR/nW1GUxk6ryfqm/Iqa'),
(21, 'Serain', 'test', '1999-01-01', 'tommyserain2@yahoo.fr', '49 rue duguesclin', '$2y$10$7D4M7YkaHUGBoLDQhsEGIePpkQdzqjS3BDt3F5LlYmgeMlRBO1Muq'),
(22, 'Serain', 'tomtom', '1956-01-01', 'tommyserain3@yahoo.fr', '49 rue duguesclin', '$2y$10$ED603J0NqajAWlucW.ZDGOTvORMYoLbH3F.fZ0ZifQ8In7rhdWkzK'),
(23, 'New', 'test19542575445546', '1989-01-01', 'tommyserain65@yahoo.fr', '49 rue duguesclin', '$2y$10$y.rLKpzkDjDZkITOBcCR/.e7jLvyam4UPEEP3sPTPtkqgSsQLzSKi');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `jeux_ibfk_2` FOREIGN KEY (`id_t`) REFERENCES `types` (`id_t`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jeux_ibfk_3` FOREIGN KEY (`id_c`) REFERENCES `categories` (`id_c`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jeux_ibfk_4` FOREIGN KEY (`id_j_p`) REFERENCES `jeux` (`id_j`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `l_jeux_utilisateurs`
--
ALTER TABLE `l_jeux_utilisateurs`
  ADD CONSTRAINT `l_jeux_utilisateurs_ibfk_2` FOREIGN KEY (`id_j`) REFERENCES `jeux` (`id_j`) ON UPDATE CASCADE,
  ADD CONSTRAINT `l_jeux_utilisateurs_ibfk_3` FOREIGN KEY (`id_u`) REFERENCES `utilisateurs` (`id_u`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
