-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 14 déc. 2017 à 13:13
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_orange`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `Date_abonnement` date NOT NULL,
  `type_abonnement` varchar(10) NOT NULL,
  `Id_adherent` int(11) NOT NULL,
  PRIMARY KEY (`Date_abonnement`),
  KEY `FK_Abonnement_Id_adherent` (`Id_adherent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `Id_adherent` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_adherent` varchar(25) NOT NULL,
  `Prenom_adherent` varchar(25) NOT NULL,
  `adresse1_adherent` varchar(50) NOT NULL,
  `Adresse2_adherent` varchar(50) NOT NULL,
  `CP_adherent` varchar(5) NOT NULL,
  `Ville_adherent` varchar(50) NOT NULL,
  `Numero_adherent` varchar(10) NOT NULL,
  `AdresseMail_adherent` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_adherent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `Id_auteur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_auteur` varchar(25) NOT NULL,
  `Prenom_auteur` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`Id_auteur`, `Nom_auteur`, `Prenom_auteur`) VALUES
(1, 'Baudelaire', 'Charles'),
(2, 'Baudelaire', 'Charles'),
(3, 'Hugo', 'Victor'),
(4, 'Zola', 'Emile'),
(5, 'Orwell', 'George'),
(6, 'Moore', 'Alan'),
(7, 'Moore', 'Alan'),
(8, 'Dickens', 'Charles'),
(9, 'Hitler', 'Adolf'),
(10, 'Hitler', 'Adolf');

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `Id_editeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_editeur` varchar(25) DEFAULT NULL,
  `adresse_editeur` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_editeur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`Id_editeur`, `nom_editeur`, `adresse_editeur`) VALUES
(1, 'Jai lu', 'Paris'),
(5, 'Larousse', 'Paris'),
(6, 'Ankama', 'Roubaix'),
(7, 'DC Comics', 'Broadway'),
(8, 'Hachette Livre', 'Vanves');

-- --------------------------------------------------------

--
-- Structure de la table `emprunte`
--

DROP TABLE IF EXISTS `emprunte`;
CREATE TABLE IF NOT EXISTS `emprunte` (
  `date_retour` date DEFAULT NULL,
  `Id_Exemplaire` int(11) NOT NULL,
  `Id_adherent` int(11) NOT NULL,
  PRIMARY KEY (`Id_Exemplaire`,`Id_adherent`),
  KEY `FK_emprunte_Id_adherent` (`Id_adherent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `Id_Exemplaire` int(11) NOT NULL AUTO_INCREMENT,
  `Etat_Exemplaire` text,
  PRIMARY KEY (`Id_Exemplaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `Id_livre` int(11) NOT NULL AUTO_INCREMENT,
  `Titre_livre` varchar(50) NOT NULL,
  `DatePublication_livre` date NOT NULL,
  `genre_livre` varchar(20) NOT NULL,
  `type_livre` varchar(25) DEFAULT NULL,
  `Id_auteur` int(11) NOT NULL,
  `Id_Exemplaire` int(11) DEFAULT NULL,
  `Id_editeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_livre`),
  KEY `FK_Livre_Id_auteur` (`Id_auteur`),
  KEY `FK_Livre_Id_Exemplaire` (`Id_Exemplaire`),
  KEY `FK_Livre_Id_editeur` (`Id_editeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `FK_Abonnement_Id_adherent` FOREIGN KEY (`Id_adherent`) REFERENCES `adherent` (`Id_adherent`);

--
-- Contraintes pour la table `emprunte`
--
ALTER TABLE `emprunte`
  ADD CONSTRAINT `FK_emprunte_Id_Exemplaire` FOREIGN KEY (`Id_Exemplaire`) REFERENCES `exemplaire` (`Id_Exemplaire`),
  ADD CONSTRAINT `FK_emprunte_Id_adherent` FOREIGN KEY (`Id_adherent`) REFERENCES `adherent` (`Id_adherent`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_Livre_Id_Exemplaire` FOREIGN KEY (`Id_Exemplaire`) REFERENCES `exemplaire` (`Id_Exemplaire`),
  ADD CONSTRAINT `FK_Livre_Id_auteur` FOREIGN KEY (`Id_auteur`) REFERENCES `auteur` (`Id_auteur`),
  ADD CONSTRAINT `FK_Livre_Id_editeur` FOREIGN KEY (`Id_editeur`) REFERENCES `editeur` (`Id_editeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
