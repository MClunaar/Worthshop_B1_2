-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 20 mars 2018 à 10:18
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
  `date_commentaire` varchar(255) NOT NULL,
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
(1, 'Je trouve cette base de données vraiment bien', '15/04/2018', 1, 2),
(2, 'les cours sont vraiment bien à l\'EPSI', '30/03/2018', 1, 1);

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
  `date_cours` varchar(255) DEFAULT NULL,
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
(1, '15/06/2018', '16h30', 'Voici un petit cours en PHP pour les débutants', 1),
(2, '13/03/2018', '10h00', 'Un cours de C pour apprendre la programmation objet', 8),
(3, '30/03/2018', '15h00', 'Un cours en HTML pour les débutants en développement web', 2),
(4, '05/04/2018', '12h00', 'Un cours d\'IOS pour le développement d\'application mobile sur iPhone', 11);

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
  `message` varchar(250) DEFAULT NULL,
  `date_message` varchar(255) DEFAULT NULL,
  `id_user_envoie` int(11) NOT NULL,
  `id_user_recoie` int(11) NOT NULL,
  KEY `FK_Message_id_user_envoie` (`id_user_envoie`),
  KEY `FK_Message_id_user_recoie` (`id_user_recoie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message`, `date_message`, `id_user_envoie`, `id_user_recoie`) VALUES
('Bonjour, veux-tu suivre les cours de PHP avec moi ?', '20/03/2018', 1, 2),
('Bonjour, j\'aimerai vraiment venir suivre ce cours sur Open Classroom', '20/03/2018', 2, 1);

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

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`id_cours`, `id_user`) VALUES
(1, 1),
(2, 2),
(2, 1),
(1, 2);

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
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `date_create` varchar(255) DEFAULT NULL,
  `num_tel` varchar(10) DEFAULT NULL,
  `avatar` varchar(25) DEFAULT NULL,
  `niveau_user` int(11) DEFAULT NULL,
  `exp` bigint(20) DEFAULT NULL,
  `cours_propose` int(11) DEFAULT NULL,
  `cours_participe` int(11) DEFAULT NULL,
  `id_cours` int(11) DEFAULT NULL,
  `id_hf` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_Utilisateur_id_cours` (`id_cours`),
  KEY `FK_Utilisateur_id_hf` (`id_hf`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `pseudo`, `mail`, `date_create`, `num_tel`, `avatar`, `niveau_user`, `exp`, `cours_propose`, `cours_participe`, `id_cours`, `id_hf`) VALUES
(1, 'Boyer', 'Clément', 'AeroCloud', 'clementboyer@epsi.fr', '05/03/2018', '0612345678', 'test_avatar', 10, 0, 0, 0, 2, 2),
(2, 'Martin', 'Gabriel', 'Nigdor', 'gabrielmartin@epsi.fr', '15/03/2018', '0613425678', 'avatar_gab', 15, 0, 2, 3, 3, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_commentaire_id_rubrique` FOREIGN KEY (`id_rubrique`) REFERENCES `rubrique` (`id_rubrique`),
  ADD CONSTRAINT `FK_commentaire_id_user_posteur` FOREIGN KEY (`id_user_posteur`) REFERENCES `utilisateur` (`id_user`);

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
  ADD CONSTRAINT `FK_Utilisateur_id_hf` FOREIGN KEY (`id_hf`) REFERENCES `haut_fait` (`id_hf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
