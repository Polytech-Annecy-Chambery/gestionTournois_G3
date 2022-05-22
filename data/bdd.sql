-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3308
-- Généré le : ven. 20 mai 2022 à 16:44
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

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`orsete`@`%` PROCEDURE `capteurs_actionneurs_zone` (`nomzone` VARCHAR(10))  begin
    drop table if exists capt_act_zone;
    create table capt_act_zone(nomzone varchar(10), nom varchar(10), type varchar(10));
    insert into capt_act_zone
    select nomzone, nom, 'capteur' as type
    from capteur
    where id_zone = (select id_zone from zone where nom like nomzone)
    union
    select nomzone, nom, 'actionneur' as type
    from actionneur2zone az JOIN actionneur a ON az.id_actionneur=a.id_actionneur
    where id_zone = (select id_zone from zone where nom like nomzone)
    order by nom, type;
end$$

CREATE DEFINER=`orsete`@`%` PROCEDURE `p_create_membre_annees` (`vNom` VARCHAR(30), `vPrenom` VARCHAR(30))  BEGIN 
    
    drop table if exists membre_annees;
    create table membre_annees(nom VARCHAR(30), prenom VARCHAR(30), annee integer);
    
    insert into membre_annees 
    select m.nom, m.prenom, s.annee
    from membre m
    join adherer a on a.id1=m.id1
    join saison s on s.id2=a.id2
    where m.nom like vNom AND m.prenom like vPrenom;
    
    end$$

CREATE DEFINER=`orsete`@`%` PROCEDURE `trouver_zones_sans_confort` ()  begin
    drop table if exists zones_sans_confort;
    create table zones_sans_confort (nomzone varchar(10), nomcapteur varchar(10), valeurmesuree numeric, instantmesure timestamp);
 
    insert into zones_sans_confort select z.nom, c.nom, m.valeur, m.instant 
            from mesure m JOIN capteur c ON m.id_capteur = c.id_capteur JOIN zone z ON z.id_zone=c.id_zone 
            where (m.instant between (SELECT timestampadd(MONTH, -1, now())) and now()) 
            # ou Timestamp(DAY, -30, now())
                   and ((c.type_capteur like 'temperature' and m.valeur < 19) 
	                 or (c.type_capteur like 'humidite' and m.valeur between 30 and 70) 
 	                 or (c.type_capteur like 'CO2' and m.valeur > 500));
   end$$

--
-- Fonctions
--
CREATE DEFINER=`orsete`@`%` FUNCTION `moyenne_capteur` (`nomcapt` VARCHAR(10)) RETURNS DECIMAL(5,2) begin
      declare vmoy decimal(5,2);
      select round(avg(m.valeur),2) into vmoy
      from mesure m JOIN capteur c ON m.id_capteur = c.id_capteur
      group by m.id_capteur, c.nom
      having c.nom = nomcapt;
  return vmoy;
  end$$

CREATE DEFINER=`orsete`@`%` FUNCTION `nbsszones_zone` (`nomzone` VARCHAR(10)) RETURNS INT(11) begin
      declare vnb integer;
      select count(id_zone) into vnb
      from zone z 
      where z.id_zone_container = (select id_zone from zone where nom = nomzone);
  return vnb;
  end$$

CREATE DEFINER=`orsete`@`%` FUNCTION `somme_montants_saison` (`year` INTEGER) RETURNS FLOAT BEGIN
	declare somme float;
    
    select sum(count_licence) as "somme" into somme from saison where year = saison.annee;
    return somme;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `id_a` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `id_e` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`id_a`, `id_t`, `id_e`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 1),
(6, 1, 2),
(7, 1, 3),
(8, 1, 4),
(9, 1, 5),
(10, 1, 6),
(11, 1, 7),
(12, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_e` int(11) NOT NULL,
  `nom_e` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_e`, `nom_e`) VALUES
(1, 'equipe1'),
(2, 'equipe2'),
(3, 'equipe3'),
(4, 'equipe4'),
(5, 'equipe5'),
(6, 'equipe6'),
(7, 'equipe7'),
(8, 'equipe8'),
(9, 'equipe10'),
(10, 'equipe11'),
(11, 'fhg');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id_j` int(11) NOT NULL,
  `nom_j` varchar(50) NOT NULL,
  `prenom_j` varchar(50) NOT NULL,
  `id_e` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id_j`, `nom_j`, `prenom_j`, `id_e`) VALUES
(2, 'Faska', 'Rachid', 2),
(3, 'Orset', 'Emma', 2),
(4, 'Gonay', 'Arthur', 2),
(5, 'Ribes', 'Maël', 1),
(6, 'JAIOUBLIESONNOMDEFAMILLE', 'Ouilliam', 1),
(7, 'Takahashi', 'Vincent', 1);

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `id_manga` int(11) NOT NULL,
  `titre_manga` varchar(100) NOT NULL,
  `auteur_manga` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id_manga`, `titre_manga`, `auteur_manga`) VALUES
(1, 'Fullmetal Alchemist', 'Hiromu Arakawa'),
(4, 'One Piece', 'Eiichiro Oda'),
(8, 'vv', 'v');

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

CREATE TABLE `rencontre` (
  `id_r` int(11) NOT NULL,
  `id_e1` int(11) NOT NULL,
  `id_e2` int(11) NOT NULL,
  `score_e1_r` int(11) DEFAULT NULL,
  `score_e2_r` int(11) DEFAULT NULL,
  `tour_r` int(11) NOT NULL,
  `commentaire_r` varchar(400) DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT '0',
  `id_t` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rencontre`
--

INSERT INTO `rencontre` (`id_r`, `id_e1`, `id_e2`, `score_e1_r`, `score_e2_r`, `tour_r`, `commentaire_r`, `isDone`, `id_t`) VALUES
(1, 1, 2, 4, 0, 1, '4 buts a 0 easy', 0, 2),
(2, 3, 4, 1, 0, 1, '1 buts a 0 c etait serré', 0, 2),
(3, 1, 3, 2, 0, 2, '2 buts a 0 joli', 0, 2),
(4, 1, 2, 4, 0, 1, NULL, 1, 1),
(5, 3, 4, 0, 0, 1, NULL, 0, 1),
(6, 5, 6, 0, 0, 1, NULL, 0, 1),
(7, 7, 8, 0, 0, 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

CREATE TABLE `tournois` (
  `id_t` int(11) NOT NULL,
  `sport_t` varchar(50) NOT NULL,
  `capacite_t` enum('4','8','16') NOT NULL,
  `nom_t` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tournois`
--

INSERT INTO `tournois` (`id_t`, `sport_t`, `capacite_t`, `nom_t`) VALUES
(1, 'basket', '8', 'tournoi de basket de la ville'),
(2, 'Football', '4', 'LA COUPE DU MONDE'),
(3, 'MMA', '16', 'UFC');

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
-- Index pour la table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id_manga`);

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
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_j` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `manga`
--
ALTER TABLE `manga`
  MODIFY `id_manga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `tournois`
--
ALTER TABLE `tournois`
  MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

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
  ADD CONSTRAINT `rencontre_ibfk_2` FOREIGN KEY (`id_e2`) REFERENCES `equipe` (`id_e`),
  ADD CONSTRAINT `rencontre_ibfk_3` FOREIGN KEY (`id_t`) REFERENCES `tournois` (`id_t`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
