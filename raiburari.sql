-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 mai 2023 à 16:13
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `raiburari`
--

-- --------------------------------------------------------

--
-- Structure de la table `concerne`
--

CREATE TABLE `concerne` (
  `api_id` varchar(255) NOT NULL,
  `id_selection` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE `favori` (
  `username` varchar(255) NOT NULL,
  `api_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`username`, `api_id`) VALUES
('admin', '121197'),
('admin', '3271'),
('admin', '76143'),
('Karlito', '13'),
('nicolas', '89265'),
('test', '57765');

-- --------------------------------------------------------

--
-- Structure de la table `lire`
--

CREATE TABLE `lire` (
  `username` varchar(255) NOT NULL,
  `tome_id` varchar(255) NOT NULL,
  `date_de_lecture` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `api_id` varchar(255) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`api_id`, `Titre`) VALUES
('121197', 'Shy'),
('13', 'One Piece'),
('3271', 'Kenja no Nagaki Fuzai'),
('3889', 'Magical JxR'),
('57765', 'UQ Holder!'),
('76143', 'Kuang Shen'),
('89265', 'Classi9');

-- --------------------------------------------------------

--
-- Structure de la table `note_personnel`
--


CREATE TABLE `note_personnel` (
  `id_note` INT(11) NOT NULL AUTO_INCREMENT,
  `note` TEXT DEFAULT NULL,
  `api_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `api_id` (`api_id`),
  KEY `username` (`username`),
  CONSTRAINT `fk_note_personnel_manga` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`),
  CONSTRAINT `fk_note_personnel_utilisateur` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `selection`
--

CREATE TABLE `selection` (
  `id_selection` varchar(255) NOT NULL,
  `date_selection` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tome`
--

CREATE TABLE `tome` (
  `tome_id` varchar(255) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `api_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`username`, `email`, `mot_de_passe`, `isAdmin`) VALUES
('admin', 'admin@raiburari.fr', '$2y$10$CrFLY28JLMZ6JmnPBx1k0.jcftahIxAyK7m5gHw2g3nwIdIwHsGZm', 1),
('Karlito', 'thomaskarl@hotmail.com', '$2y$10$ioCBO2eaaXtGvnOXB9FbFO3BCgLHsvVtXaUwbGr5mhy9gyOrHUi0m', 0),
('nicolas', 'nicolas@hotmail.fr', '$2y$10$5Ahc0Zd4DCrwspPtp1olW.50g2U3UJUigFuDZREnPX2zYiw/3Kr86', 0),
('test', 'test@test.fr', '$2y$10$cHbnXEfHCLfy/oZDcF8qXeRybngO4xynIuFS8fHhGobxcVV5D.9CK', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `concerne`
--
ALTER TABLE `concerne`
  ADD PRIMARY KEY (`api_id`,`id_selection`),
  ADD KEY `id_selection` (`id_selection`);

--
-- Index pour la table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`username`,`api_id`),
  ADD KEY `favori_ibfk_2` (`api_id`);

--
-- Index pour la table `lire`
--
ALTER TABLE `lire`
  ADD PRIMARY KEY (`username`,`tome_id`),
  ADD KEY `tome_id` (`tome_id`);

--
-- Index pour la table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`api_id`);

--
-- Index pour la table `note_personnel`
--
ALTER TABLE `note_personnel`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `api_id` (`api_id`),
  ADD KEY `username` (`username`);

--
-- Index pour la table `selection`
--
ALTER TABLE `selection`
  ADD PRIMARY KEY (`id_selection`);

--
-- Index pour la table `tome`
--
ALTER TABLE `tome`
  ADD PRIMARY KEY (`tome_id`),
  ADD KEY `api_id` (`api_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`username`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `concerne`
--
ALTER TABLE `concerne`
  ADD CONSTRAINT `concerne_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`),
  ADD CONSTRAINT `concerne_ibfk_2` FOREIGN KEY (`id_selection`) REFERENCES `selection` (`id_selection`);

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `favori_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `favori_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lire`
--
ALTER TABLE `lire`
  ADD CONSTRAINT `lire_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`),
  ADD CONSTRAINT `lire_ibfk_2` FOREIGN KEY (`tome_id`) REFERENCES `tome` (`tome_id`);

--
-- Contraintes pour la table `note_personnel`
--
ALTER TABLE `note_personnel`
  ADD CONSTRAINT `note_personnel_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`),
  ADD CONSTRAINT `note_personnel_ibfk_2` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`);

--
-- Contraintes pour la table `tome`
--
ALTER TABLE `tome`
  ADD CONSTRAINT `tome_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
