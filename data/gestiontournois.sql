-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 mai 2022 à 09:52
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestiontournois`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `id_a` int(11) NOT NULL AUTO_INCREMENT,
  `id_t` int(11) NOT NULL,
  `id_e` int(11) NOT NULL,
  PRIMARY KEY (`id_a`),
  KEY `id_t` (`id_t`),
  KEY `id_e` (`id_e`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `id_e` int(11) NOT NULL AUTO_INCREMENT,
  `nom_e` int(11) NOT NULL,
  PRIMARY KEY (`id_e`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `id_j` int(11) NOT NULL AUTO_INCREMENT,
  `nom_j` varchar(50) NOT NULL,
  `prenom_j` varchar(50) NOT NULL,
  `id_e` int(11) NOT NULL,
  PRIMARY KEY (`id_j`),
  KEY `id_e` (`id_e`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

DROP TABLE IF EXISTS `rencontre`;
CREATE TABLE IF NOT EXISTS `rencontre` (
  `id_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_e1` int(11) NOT NULL,
  `id_e2` int(11) NOT NULL,
  `score_e1_r` int(11) DEFAULT NULL,
  `score_e2_r` int(11) DEFAULT NULL,
  `tour_r` int(11) NOT NULL,
  PRIMARY KEY (`id_r`),
  KEY `id_e1` (`id_e1`),
  KEY `id_e2` (`id_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

DROP TABLE IF EXISTS `tournois`;
CREATE TABLE IF NOT EXISTS `tournois` (
  `id_t` int(11) NOT NULL AUTO_INCREMENT,
  `sport_t` varchar(50) NOT NULL,
  `capacite_t` int(11) NOT NULL,
  `nom_t` varchar(100) NOT NULL,
  PRIMARY KEY (`id_t`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`id_t`) REFERENCES `tournois` (`id_t`),
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`id_e`) REFERENCES `equipe` (`id_e`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `joueur_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `equipe` (`id_e`);

--
-- Contraintes pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `rencontre_ibfk_1` FOREIGN KEY (`id_e1`) REFERENCES `equipe` (`id_e`),
  ADD CONSTRAINT `rencontre_ibfk_2` FOREIGN KEY (`id_e2`) REFERENCES `equipe` (`id_e`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
