-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 20 mars 2018 à 08:12
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `udepsi`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` longtext NOT NULL,
  `note_c` float NOT NULL,
  `date_commentaire` date NOT NULL,
  `id_rubrique` int(11) NOT NULL,
  `id_user_posteur` int(11) NOT NULL,
  `id_user_noteur` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `FK_commentaire_id_rubrique` (`id_rubrique`),
  KEY `FK_commentaire_id_user_posteur` (`id_user_posteur`),
  KEY `FK_commentaire_id_user_noteur` (`id_user_noteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id_competence` int(11) NOT NULL AUTO_INCREMENT,
  `nom_competence` varchar(25) DEFAULT NULL,
  `theme` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_competence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(11) NOT NULL AUTO_INCREMENT,
  `date_cours` date DEFAULT NULL,
  `horaire` varchar(25) DEFAULT NULL,
  `texte_cours` longtext,
  `id_competence` int(11) NOT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `FK_Cours_id_competence` (`id_competence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `haut_fait`
--

DROP TABLE IF EXISTS `haut_fait`;
CREATE TABLE IF NOT EXISTS `haut_fait` (
  `id_hf` int(11) NOT NULL AUTO_INCREMENT,
  `nom_hf` varchar(25) DEFAULT NULL,
  `value_exp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_hf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message` varchar(250) DEFAULT NULL,
  `date_message` date DEFAULT NULL,
  `id_user_envoie` int(11) NOT NULL,
  `id_user_recoie` int(11) NOT NULL,
  KEY `FK_Message_id_user_envoie` (`id_user_envoie`),
  KEY `FK_Message_id_user_recoie` (`id_user_recoie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `id_cours` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `FK_Participe_id_cours` (`id_cours`),
  KEY `FK_Participe_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

DROP TABLE IF EXISTS `possede`;
CREATE TABLE IF NOT EXISTS `possede` (
  `niveau` int(11) DEFAULT NULL,
  `id_competence` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `FK_Possede_id_competence` (`id_competence`),
  KEY `FK_Possede_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

DROP TABLE IF EXISTS `rubrique`;
CREATE TABLE IF NOT EXISTS `rubrique` (
  `id_rubrique` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `texte_r` longtext,
  `note_r` float DEFAULT NULL,
  `id_competence` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_rubrique`),
  KEY `FK_Rubrique_id_competence` (`id_competence`),
  KEY `FK_Rubrique_id_user_createur` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `pseudo` varchar(25) DEFAULT NULL,
  `mail` varchar(25) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `num_tel` int(11) DEFAULT NULL,
  `avatar` varchar(25) DEFAULT NULL,
  `niveau_user` int(11) DEFAULT NULL,
  `exp` bigint(20) DEFAULT NULL,
  `cours_propose` int(11) DEFAULT NULL,
  `cours_participe` int(11) DEFAULT NULL,
  `id_cours` int(11) NOT NULL,
  `id_rubrique` int(11) NOT NULL,
  `id_hf` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_Utilisateur_id_cours` (`id_cours`),
  KEY `FK_Utilisateur_id_rubrique_evaluer` (`id_rubrique`),
  KEY `FK_Utilisateur_id_hf` (`id_hf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_commentaire_id_rubrique` FOREIGN KEY (`id_rubrique`) REFERENCES `rubrique` (`id_rubrique`),
  ADD CONSTRAINT `FK_commentaire_id_user_noteur` FOREIGN KEY (`id_user_noteur`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `FK_commentaire_id_user_posteur` FOREIGN KEY (`id_user_posteur`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_Cours_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_Message_id_user_envoie` FOREIGN KEY (`id_user_envoie`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `FK_Message_id_user_recoie` FOREIGN KEY (`id_user_recoie`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `FK_Participe_id_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `FK_Participe_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `FK_Possede_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`),
  ADD CONSTRAINT `FK_Possede_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD CONSTRAINT `FK_Rubrique_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`),
  ADD CONSTRAINT `FK_Rubrique_id_user_createur` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_id_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `FK_Utilisateur_id_hf` FOREIGN KEY (`id_hf`) REFERENCES `haut_fait` (`id_hf`),
  ADD CONSTRAINT `FK_Utilisateur_id_rubrique_evaluer` FOREIGN KEY (`id_rubrique`) REFERENCES `rubrique` (`id_rubrique`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
