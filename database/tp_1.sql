-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 25 sep. 2023 à 19:58
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
-- Base de données : `tp_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `lampe`
--

CREATE TABLE `lampe` (
  `id` int(11) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `lampe`
--

INSERT INTO `lampe` (`id`, `brand`, `type`, `model`, `price`) VALUES
(1, 'Philips', 'Lampe de bureau', 'DeskLite', 49.99),
(2, 'IKEA', 'Lampe sur pied', 'FloorLamp', 79.99),
(3, 'Osram', 'Lampe de chevet', 'NightGlow', 29.99),
(4, 'Hue', 'Lampe connectée', 'SmartLight', 99.99),
(5, 'Lutron', 'Lampe de salon', 'LivingRoomLux', 149.99),
(11, 'test 2', 'test test 2', 'test 2', 30.95);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lampe`
--
ALTER TABLE `lampe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lampe`
--
ALTER TABLE `lampe`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
