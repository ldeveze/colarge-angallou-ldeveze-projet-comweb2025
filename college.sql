-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 mai 2025 à 17:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `college`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `libelle`) VALUES
(1, '6A'),
(2, '6B'),
(3, '6C'),
(4, '6D'),
(5, '5A'),
(6, '5B'),
(7, '5C'),
(8, '5D'),
(9, '4A'),
(10, '4B'),
(11, '4C'),
(12, '4D'),
(13, '3A'),
(14, '3B'),
(15, '3C'),
(16, '3D');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `motdepasse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `id_classe`, `pseudo`, `motdepasse`) VALUES
(1, 'Menvussa', 'Gérard', 1, 'gemenvussa', 'pantoufle'),
(2, 'Maguire', 'Toby', 3, 'tomaguire', 'apagnan'),
(3, 'Sunrise', 'Teckilou', 15, 'tesunrise', 'woufwouf'),
(4, 'Tortue', 'Raphaël', 9, 'ratortue', 'bushido87');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`) VALUES
(1, 'Français'),
(2, 'Mathématiques'),
(3, 'Histoire-Géographie'),
(4, 'EMC'),
(5, 'Anglais'),
(6, 'Allemand'),
(7, 'Espagnol'),
(8, 'SVT'),
(9, 'Physique-chimie'),
(10, 'Technologie'),
(11, 'EPS'),
(12, 'Arts plastiques'),
(13, 'Education musicale');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `valeur` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `libelle`, `valeur`, `id_eleve`, `id_matiere`) VALUES
(1, 'Interrogation surprise', 11, 2, 12),
(2, 'Examen final', 14, 3, 5),
(3, 'Oral', 8, 1, 7),
(4, 'Dissertation', 17, 4, 1),
(5, 'Projet', 20, 3, 8),
(6, 'Examen intermédiaire', 6, 4, 3),
(7, 'Participation orale', 10, 1, 10),
(8, 'Travail maison', 13, 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE `prof` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `motdepasse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prof`
--

INSERT INTO `prof` (`id`, `nom`, `prenom`, `id_matiere`, `pseudo`, `motdepasse`) VALUES
(1, 'Faragonda', 'Alma', 8, 'alfaragonda', 'surmulot452'),
(2, 'Griffin', 'Isabelle', 1, 'isgriffin', 'darksasuke33'),
(3, 'Stiti', 'Louise', 2, 'lostiti', 'singerie985'),
(4, 'Bolet', 'Loïc', 3, 'lobolet', 'amanite42'),
(5, 'Raton', 'Candy', 4, 'caraton', '36berlingot36'),
(6, 'Bonbeurre', 'Jean', 5, 'jebonbeurre', 'sauciflar89'),
(7, 'Ptitegoutte', 'Justine', 6, 'juptitegoutte', 'jadoreleau'),
(8, 'Bambelle', 'Larry', 7, 'labambelle', 'farfadet652'),
(9, 'Khaman', 'Mehdi', 9, 'mekhaman', 'aspirine33'),
(10, 'Graf', 'Otto', 10, 'otgraf', 'star2fou'),
(11, 'Metrehé', 'Sandy', 11, 'sametrehé', 'hypervitesse'),
(12, 'Auzaur', 'Amandine', 12, 'amauzaur', 'diplo758'),
(13, 'Tatouille', 'Lara', 13, 'latatouille', 'legume845');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `prof`
--
ALTER TABLE `prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
