-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 12 Mai 2013 à 22:33
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `3tid2_2013`
--

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE IF NOT EXISTS `emprunts` (
  `emprunt` int(11) NOT NULL AUTO_INCREMENT,
  `livre` varchar(120) NOT NULL,
  `membre` varchar(90) NOT NULL,
  `date` date NOT NULL,
  `duree` int(3) NOT NULL,
  PRIMARY KEY (`emprunt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `emprunts`
--

INSERT INTO `emprunts` (`emprunt`, `livre`, `membre`, `date`, `duree`) VALUES
(2, '2', '1', '2013-04-18', 35),
(3, '3', '3', '2013-04-23', 14),
(10, '4', '1', '2013-03-06', 7);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE IF NOT EXISTS `livres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(35) NOT NULL,
  `auteur` varchar(40) NOT NULL,
  `genre` varchar(25) NOT NULL,
  `resume` varchar(600) NOT NULL,
  `libre` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`, `genre`, `resume`, `libre`) VALUES
(1, 'Richard Yates', 'Tao Lin', 'aventure', 'Ce livre raconte l''histoire de Haley Joel Osment et Dakota Fanning', 1),
(2, 'EEE EEE EEE', 'Tao Lin', 'Aventure', 'Andrew travail chez domino pizza', 0),
(3, 'Jean-marie', 'Patrick Jane', 'Science-fi', 'Jean-marie est un chasseur de 78ans', 0),
(4, 'Elise', 'Vincent Vandy', 'Action', 'Elise grandit et se marie', 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `cp` int(8) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `admin` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `prenom`, `nom`, `cp`, `mail`, `tel`, `admin`) VALUES
(1, 'Billy', 'Thekid', 5000, 'billy@yahoo.fr', '0478965588', 0),
(2, 'gaby', 'abdel', 5000, 'gaby@gmail.com', '0458586920', 0),
(3, 'Jack', 'Jean', 1001, 'jenapierre@gmail.com', '022586699', 0),
(4, 'Pierre', 'Henrion', 5000, 'pierre@gmail.com', '0475889966', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
