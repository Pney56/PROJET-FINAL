-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 03 juin 2023 à 15:36
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
-- Structure de la table `favori`
--

CREATE TABLE `favori` (
  `username` varchar(255) NOT NULL,
  `api_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`username`, `api_id`) VALUES
('test', 14),
('test', 750),
('test', 10789),
('test', 93530),
('test', 96042),
('test', 99007),
('test', 110128);

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `api_id` int(11) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `isSelected` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`api_id`, `Titre`, `isSelected`) VALUES
(14, 'Rave', 0),
(750, 'DVD', 0),
(10789, 'My Favorite Girl', 0),
(93530, 'Komi-san wa Comyushou desu.', 0),
(96042, NULL, 0),
(99007, 'Komi-san wa, Comyushou desu.', 0),
(110128, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `note_personnel`
--

CREATE TABLE `note_personnel` (
  `id_note` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `api_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `note_personnel`
--

INSERT INTO `note_personnel` (`id_note`, `note`, `api_id`, `username`) VALUES
(1, 'test note RAVE', 14, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`username`, `email`, `mot_de_passe`, `isAdmin`) VALUES
('admin', 'admin@raiburari.fr', '$2y$10$CrFLY28JLMZ6JmnPBx1k0.jcftahIxAyK7m5gHw2g3nwIdIwHsGZm', 1),
('nico', 'nico@nico.fr', '$2y$10$MUTWtuYoj39aWwPlrMTxMutoTWAyj4NsUS3qt6EqM0927o9xKf4gi', 0),
('test', 'test@test.fr', '$2y$10$cHbnXEfHCLfy/oZDcF8qXeRybngO4xynIuFS8fHhGobxcVV5D.9CK', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`username`,`api_id`),
  ADD KEY `api_id` (`api_id`);

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
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `note_personnel`
--
ALTER TABLE `note_personnel`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `favori_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`),
  ADD CONSTRAINT `favori_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`);

--
-- Contraintes pour la table `note_personnel`
--
ALTER TABLE `note_personnel`
  ADD CONSTRAINT `note_personnel_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `manga` (`api_id`),
  ADD CONSTRAINT `note_personnel_ibfk_2` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
