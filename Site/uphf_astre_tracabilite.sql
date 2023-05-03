-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 01 mai 2023 à 18:15
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `uphf_astre_tracabilite`
--

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `nom_produit` varchar(255) NOT NULL,
  `code_EAN13` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qte_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`nom_produit`, `code_EAN13`, `image`, `qte_stock`) VALUES
('Lindt - Lapin au chocolat blanc', '4000539670008', 'img/lapin_lindt_blanc.png', 350),
('Haribo - Dragibus XXL Pack', '3103220041062', 'img/haribo_dragibus_xxl.png', 795),
('Anti-Dust Spray', '8715342031903', 'img/anti_dust_spray.png', 29),
('Alcool à brûler à 90°', '3256630030413', 'img/alcool_bruler_90.png', 3),
('Vittel 1.5L', '7613036249928', 'img/vittel_1-5L.png', 39);

-- --------------------------------------------------------

--
-- Structure de la table `ticket_client`
--

CREATE TABLE `ticket_client` (
  `id` int(11) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `mail_client` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `produits` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ticket_client`
--

INSERT INTO `ticket_client` (`id`, `nom_client`, `mail_client`, `date`, `produits`) VALUES
(1, '', '', '2023-04-07 13:04:44', '4000539670008'),
(2, '', '', '2023-04-07 13:09:05', '4000539670008'),
(3, 'MisterNH', 'mister@nh.mail', '2023-04-08 13:10:07', '4000539670008;4000539670008;4000539670008;4000539670008;3103220041062;3103220041062;3103220041062;8715342031903'),
(4, 'DinoLio147', 'dino@lio.147', '2023-04-10 13:16:14', '3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;3103220041062;'),
(5, 'test', '', '2023-04-10 13:26:53', '3103220041062;3103220041062;3103220041062;3103220041062;8715342031903;4000539670008'),
(8, 'Floksy', 'floksy@test.mail', '2023-04-11 13:57:21', '4000539670008;4000539670008;4000539670008;4000539670008;4000539670008;4000539670008;4000539670008;4000539670008;8715342031903;8715342031903;3103220041062;3103220041062;3103220041062'),
(10, 'Jarod', 'ja@ro.d', '2023-04-11 19:01:44', '7613036249928;7613036249928;3256630030413;3103220041062;3103220041062;8715342031903;4000539670008;4000539670008;'),
(11, 'test', 'test', '2023-04-12 19:04:06', '7613036249928;7613036249928;3256630030413;3256630030413;'),
(12, 'test', 'test', '2023-04-12 19:06:53', '1234567890123'),
(13, 'test', 'test', '2023-04-13 14:07:09', '1234567890123;'),
(14, 'test', 'test', '2023-04-13 14:08:11', '7613036249928;7613036249928;3256630030413;3103220041062;3103220041062;4000539670008;8715342031903;'),
(18, 'test', '', '2023-04-13 15:22:27', '7613036249928;7613036249928;3103220041062;3103220041062;3256630030413;'),
(19, 'Flo', 'flo@flo.flo', '2023-04-15 19:24:36', '3103220041062;3103220041062;3103220041062;4000539670008;4000539670008;3256630030413;7613036249928;');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ticket_client`
--
ALTER TABLE `ticket_client`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ticket_client`
--
ALTER TABLE `ticket_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
