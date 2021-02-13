-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 13 fév. 2021 à 18:11
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `dogmaxx3000`
--

-- --------------------------------------------------------

--
-- Structure de la table `alertsUser`
--

CREATE TABLE `alertsUser` (
  `alertID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `alertDate` varchar(50) NOT NULL,
  `alertTime` varchar(50) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `alertsUser`
--

INSERT INTO `alertsUser` (`alertID`, `userID`, `type`, `alertDate`, `alertTime`, `code`) VALUES
(8, 5, 'croquettes', '18/10/2020', '15:07', 0),
(9, 5, 'aboi', '18/10/2020', '15:07', 0),
(10, 5, 'croquettes', '18/10/2020', '15:08', 0),
(11, 5, 'aboi', '18/10/2020', '15:08', 0),
(12, 5, 'croquettes', '18/10/2020', '15:26', 0),
(13, 5, 'croquettes', '18/10/2020', '19:13', 0),
(14, 5, 'aboi', '18/10/2020', '19:13', 0),
(15, 5, 'croquettes', '18/10/2020', '19:14', 0),
(16, 5, 'croquettes', '18/10/2020', '19:16', 0),
(17, 5, 'aboi', '18/10/2020', '19:16', 0),
(18, 5, 'aboi', '25/10/2020', '10:43', 0),
(19, 5, 'aboi', '25/10/2020', '10:43', 0),
(20, 5, 'croquettes', '05/01/2021', '13:43', 0),
(21, 5, 'aboi', '05/01/2021', '13:44', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user `
--

CREATE TABLE `user ` (
  `userID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordUser` varchar(255) NOT NULL,
  `alertUser` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user `
--

INSERT INTO `user ` (`userID`, `fname`, `lname`, `email`, `passwordUser`, `alertUser`) VALUES
(4, 'Nicolas', 'Martinelli', 'ncl.martinelli@gmail.com', '43ffcf8ace9e22c150ff9bec00bc162c07e7eae7', '0'),
(5, 'Nicolas', 'Martinelli', 'nicolas.martinelli@next-u.fr', '43ffcf8ace9e22c150ff9bec00bc162c07e7eae7', '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alertsUser`
--
ALTER TABLE `alertsUser`
  ADD PRIMARY KEY (`alertID`);

--
-- Index pour la table `user `
--
ALTER TABLE `user `
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alertsUser`
--
ALTER TABLE `alertsUser`
  MODIFY `alertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user `
--
ALTER TABLE `user `
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
