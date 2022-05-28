-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3308
-- Généré le : sam. 28 mai 2022 à 13:28
-- Version du serveur :  5.7.33
-- Version de PHP : 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `orsete`
--
CREATE DATABASE IF NOT EXISTS `orsete` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `orsete`;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE `appartient` (
  `id_a` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `id_e` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE `equipe` (
  `id_e` int(11) NOT NULL,
  `nom_e` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE `joueur` (
  `id_j` int(11) NOT NULL,
  `nom_j` varchar(30) NOT NULL,
  `prenom_j` varchar(30) NOT NULL,
  `id_e` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

DROP TABLE IF EXISTS `rencontre`;
CREATE TABLE `rencontre` (
  `id_r` int(11) NOT NULL,
  `id_e1` int(11) DEFAULT NULL,
  `id_e2` int(11) DEFAULT NULL,
  `score_e1_r` int(11) DEFAULT NULL,
  `score_e2_r` int(11) DEFAULT NULL,
  `tour_r` int(11) NOT NULL,
  `commentaire_r` varchar(400) DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT '0',
  `id_t` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

DROP TABLE IF EXISTS `tournois`;
CREATE TABLE `tournois` (
  `id_t` int(11) NOT NULL,
  `sport_t` varchar(15) NOT NULL,
  `capacite_t` enum('4','8','16') NOT NULL,
  `nom_t` varchar(100) NOT NULL,
  `started` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`id_a`),
  ADD KEY `id_t` (`id_t`),
  ADD KEY `id_e` (`id_e`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_e`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id_j`),
  ADD KEY `id_e` (`id_e`);

--
-- Index pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD PRIMARY KEY (`id_r`),
  ADD KEY `id_e1` (`id_e1`),
  ADD KEY `id_e2` (`id_e2`),
  ADD KEY `id_t` (`id_t`);

--
-- Index pour la table `tournois`
--
ALTER TABLE `tournois`
  ADD PRIMARY KEY (`id_t`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartient`
--
ALTER TABLE `appartient`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_j` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tournois`
--
ALTER TABLE `tournois`
  MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `joueur_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `equipe` (`id_e`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `rencontre_ibfk_1` FOREIGN KEY (`id_e1`) REFERENCES `equipe` (`id_e`) ON DELETE CASCADE,
  ADD CONSTRAINT `rencontre_ibfk_2` FOREIGN KEY (`id_e2`) REFERENCES `equipe` (`id_e`) ON DELETE CASCADE,
  ADD CONSTRAINT `rencontre_ibfk_3` FOREIGN KEY (`id_t`) REFERENCES `tournois` (`id_t`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
