-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 21 mars 2018 à 12:20
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
-- Structure de la table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
  `id_avatar` int(20) NOT NULL,
  `perso` varchar(255) NOT NULL,
  `stuff` varchar(255) NOT NULL,
  `id_u` int(20) NOT NULL,
  KEY `id_u` (`id_u`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` longtext NOT NULL,
  `date_commentaire` date NOT NULL,
  `id_rubrique` int(11) NOT NULL,
  `id_user_posteur` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `FK_commentaire_id_rubrique` (`id_rubrique`),
  KEY `FK_commentaire_id_user_posteur` (`id_user_posteur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `commentaire`, `date_commentaire`, `id_rubrique`, `id_user_posteur`) VALUES
(1, 'Je trouve cette base de données vraiment bien', '2015-04-18', 1, 2),
(2, 'les cours sont vraiment bien à l\'EPSI', '2030-03-18', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_poste`
--

DROP TABLE IF EXISTS `commentaire_poste`;
CREATE TABLE IF NOT EXISTS `commentaire_poste` (
  `id_u` int(20) NOT NULL,
  `id_c` int(20) NOT NULL,
  UNIQUE KEY `id_c` (`id_c`),
  KEY `id_u` (`id_u`)
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id_competence`, `nom_competence`, `theme`) VALUES
(1, 'PHP', 'Développement Web'),
(2, 'HTML', 'Développement Web'),
(3, 'CSS', 'Développement Web'),
(4, 'CMS', 'Développement Web'),
(5, 'JavaScript', 'Développement Web'),
(6, 'C#', 'Programmation Objet'),
(7, 'C++', 'Programmation Objet'),
(8, 'C', 'Programmation Objet'),
(9, 'JAVA', 'Programmation Objet'),
(10, 'PHP', 'Programmation Objet'),
(11, 'IOS', 'Programmation mobile'),
(12, 'Android', 'Programmation mobile'),
(13, 'UML', 'Modélisation'),
(14, 'Merise', 'Modélisation'),
(15, 'TCP/IP', 'Réseaux'),
(16, 'Firewall', 'Réseaux'),
(17, 'NAT/PAT', 'Réseaux');

-- --------------------------------------------------------

--
-- Structure de la table `competence_lvl`
--

DROP TABLE IF EXISTS `competence_lvl`;
CREATE TABLE IF NOT EXISTS `competence_lvl` (
  `niveau` int(11) DEFAULT NULL,
  `id_competence` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `FK_Possede_id_competence` (`id_competence`),
  KEY `FK_Possede_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence_lvl`
--

INSERT INTO `competence_lvl` (`niveau`, `id_competence`, `id_user`) VALUES
(15, 10, 2),
(3, 1, 1),
(25, 12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(11) NOT NULL AUTO_INCREMENT,
  `date_cours` date NOT NULL,
  `horaire` varchar(25) DEFAULT NULL,
  `texte_cours` longtext,
  `id_competence` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `FK_Cours_id_competence` (`id_competence`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `date_cours`, `horaire`, `texte_cours`, `id_competence`) VALUES
(1, '2015-06-18', '16h30', 'Voici un petit cours en PHP pour les débutants', 1),
(2, '2013-03-18', '10h00', 'Un cours de C pour apprendre la programmation objet', 8),
(3, '2030-03-18', '15h00', 'Un cours en HTML pour les débutants en développement web', 2),
(4, '2005-04-18', '12h00', 'Un cours d\'IOS pour le développement d\'application mobile sur iPhone', 11);

-- --------------------------------------------------------

--
-- Structure de la table `cours_participe`
--

DROP TABLE IF EXISTS `cours_participe`;
CREATE TABLE IF NOT EXISTS `cours_participe` (
  `id_cours` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `FK_Participe_id_cours` (`id_cours`),
  KEY `FK_Participe_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours_participe`
--

INSERT INTO `cours_participe` (`id_cours`, `id_user`) VALUES
(1, 1),
(2, 2),
(2, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cours_propose`
--

DROP TABLE IF EXISTS `cours_propose`;
CREATE TABLE IF NOT EXISTS `cours_propose` (
  `id_u` int(20) NOT NULL,
  `id_c` int(11) NOT NULL,
  UNIQUE KEY `id_u` (`id_u`),
  UNIQUE KEY `id_c` (`id_c`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `haut_fait`
--

DROP TABLE IF EXISTS `haut_fait`;
CREATE TABLE IF NOT EXISTS `haut_fait` (
  `id_hf` int(11) NOT NULL AUTO_INCREMENT,
  `nom_hf` varchar(255) DEFAULT NULL,
  `value_exp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_hf`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `haut_fait`
--

INSERT INTO `haut_fait` (`id_hf`, `nom_hf`, `value_exp`) VALUES
(1, 'Premier niveau réussi', 10),
(2, 'Assisté à son 1er cours', 20),
(3, 'Premier cours donné', 30),
(4, 'Bompard', 100);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(250) DEFAULT NULL,
  `date_message` date DEFAULT NULL,
  `id_user_envoie` int(11) NOT NULL,
  `id_user_recoie` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `FK_Message_id_user_envoie` (`id_user_envoie`),
  KEY `FK_Message_id_user_recoie` (`id_user_recoie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `message`, `date_message`, `id_user_envoie`, `id_user_recoie`) VALUES
(1, 'Bonjour, veux-tu suivre les cours de PHP avec moi ?', '2020-03-18', 1, 2),
(2, 'Bonjour, j\'aimerai vraiment venir suivre ce cours sur Open Classroom', '2020-03-18', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `note_rubrique`
--

DROP TABLE IF EXISTS `note_rubrique`;
CREATE TABLE IF NOT EXISTS `note_rubrique` (
  `id_u` int(20) NOT NULL,
  `id_r` int(20) NOT NULL,
  `note` int(20) NOT NULL,
  KEY `id_u` (`id_u`),
  KEY `id_r` (`id_r`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `note_user`
--

DROP TABLE IF EXISTS `note_user`;
CREATE TABLE IF NOT EXISTS `note_user` (
  `id_u_note` int(20) NOT NULL,
  `id_u_notant` int(20) NOT NULL,
  `note` int(20) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  KEY `id_u_note` (`id_u_note`),
  KEY `id_u_notant` (`id_u_notant`)
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
  `id_competence` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_rubrique`),
  KEY `FK_Rubrique_id_competence` (`id_competence`),
  KEY `FK_Rubrique_id_user_createur` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rubrique`
--

INSERT INTO `rubrique` (`id_rubrique`, `image`, `video`, `texte_r`, `id_competence`, `id_user`) VALUES
(1, 'lien d\'une image', NULL, 'rubrique de test', 2, 2),
(2, NULL, 'lien d\'une vidéo', 'rubrique test de vidéo', 13, 1);

-- --------------------------------------------------------

--
-- Structure de la table `uhf`
--

DROP TABLE IF EXISTS `uhf`;
CREATE TABLE IF NOT EXISTS `uhf` (
  `id_u` int(11) NOT NULL,
  `id_hf` int(11) NOT NULL,
  KEY `id_u` (`id_u`),
  KEY `id_hf` (`id_hf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `num_tel` varchar(10) DEFAULT NULL,
  `avatar` varchar(25) DEFAULT NULL,
  `niveau_user` int(11) DEFAULT NULL,
  `exp` bigint(20) DEFAULT NULL,
  `cours_propose` int(11) DEFAULT NULL,
  `cours_participe` int(11) DEFAULT NULL,
  `mdp` varchar(50) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `pseudo`, `mail`, `date_naissance`, `num_tel`, `avatar`, `niveau_user`, `exp`, `cours_propose`, `cours_participe`, `mdp`, `date_creation`) VALUES
(1, 'Boyer', 'Clément', 'Aerocloud', 'clementboyer@epsi.fr', '0001-01-01', '0612345678', 'test_avatar', 10, 0, 0, 0, '1234', '1998-03-02 23:00:00'),
(2, 'Martin', 'Gabriel', 'Nigdor', 'gabrielmartin@epsi.fr', '2006-06-18', '0613425678', 'avatar_gab', 15, 0, 2, 3, '1234', '1999-05-10 22:00:00'),
(3, 'Prangère', 'Romain', 'Prangerson', 'romainprangere@epsi.fr', NULL, '0611223344', NULL, 20, 130, 3, 5, '1234', '1994-01-10 23:00:00'),
(5, 'Marignier', 'Vincent', 'vinsmgn', 'vincentmarignier@epsi.fr', '1996-05-06', '0622334455', NULL, NULL, NULL, NULL, NULL, '1234', '2018-03-21 10:58:58'),
(6, 'Calmes', 'Mathéo', 'matyrox', 'matheocalmes@epsi.fr', '1999-02-02', '0612345690', NULL, NULL, NULL, NULL, NULL, 'abcd', '2018-03-21 10:58:58'),
(7, 'Gimenez', 'Tony', 'tonytony', 'tonygimenez@epsi.fr', '2012-11-20', '0630030545', NULL, NULL, NULL, NULL, NULL, '1234', '2018-03-21 10:58:58'),
(8, 'Figueiredo', 'Adrien', 'trobyss', 'adrienf@epsi.fr', '1998-03-30', '0600000000', NULL, NULL, NULL, NULL, NULL, 'e2fc714c4727ee9395f324cd2e7f331f', '2018-03-21 11:16:23');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `avatar_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_commentaire_id_rubrique` FOREIGN KEY (`id_rubrique`) REFERENCES `rubrique` (`id_rubrique`),
  ADD CONSTRAINT `FK_commentaire_id_user_posteur` FOREIGN KEY (`id_user_posteur`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `commentaire_poste`
--
ALTER TABLE `commentaire_poste`
  ADD CONSTRAINT `commentaire_poste_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `commentaire` (`id_commentaire`),
  ADD CONSTRAINT `commentaire_poste_ibfk_2` FOREIGN KEY (`id_u`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `competence_lvl`
--
ALTER TABLE `competence_lvl`
  ADD CONSTRAINT `FK_Possede_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`),
  ADD CONSTRAINT `FK_Possede_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_Cours_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`);

--
-- Contraintes pour la table `cours_participe`
--
ALTER TABLE `cours_participe`
  ADD CONSTRAINT `FK_Participe_id_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `FK_Participe_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `cours_propose`
--
ALTER TABLE `cours_propose`
  ADD CONSTRAINT `cours_propose_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `cours_propose_ibfk_2` FOREIGN KEY (`id_u`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_Message_id_user_envoie` FOREIGN KEY (`id_user_envoie`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `FK_Message_id_user_recoie` FOREIGN KEY (`id_user_recoie`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `note_rubrique`
--
ALTER TABLE `note_rubrique`
  ADD CONSTRAINT `note_rubrique_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `note_rubrique_ibfk_2` FOREIGN KEY (`id_r`) REFERENCES `rubrique` (`id_rubrique`);

--
-- Contraintes pour la table `note_user`
--
ALTER TABLE `note_user`
  ADD CONSTRAINT `note_user_ibfk_1` FOREIGN KEY (`id_u_note`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `note_user_ibfk_2` FOREIGN KEY (`id_u_notant`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD CONSTRAINT `FK_Rubrique_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`),
  ADD CONSTRAINT `FK_Rubrique_id_user_createur` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `uhf`
--
ALTER TABLE `uhf`
  ADD CONSTRAINT `uhf_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `uhf_ibfk_2` FOREIGN KEY (`id_hf`) REFERENCES `haut_fait` (`id_hf`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
