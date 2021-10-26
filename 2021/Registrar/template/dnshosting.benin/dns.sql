-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 22 oct. 2021 à 20:38
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dns`
--

-- --------------------------------------------------------

--
-- Structure de la table `domain`
--

CREATE TABLE `domain` (
  `id` int(11) NOT NULL,
  `domain` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `domain`
--

INSERT INTO `domain` (`id`, `domain`) VALUES
(1, 'toto.benin'),
(2, 'toto.benin'),
(3, 'tot.benin'),
(4, 'toto.cotonou');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(22) NOT NULL,
  `email` varchar(22) NOT NULL,
  `domain` varchar(22) NOT NULL,
  `create_at` varchar(22) NOT NULL,
  `adress` varchar(22) NOT NULL,
  `nbrAn` int(11) NOT NULL,
  `ns1` varchar(20) NOT NULL DEFAULT 'ns1.dnshosting.benin',
  `ns2` varchar(22) NOT NULL DEFAULT 'ns2.dnshosting.benin',
  `pass` varchar(22) NOT NULL,
  `cpass` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `domain`, `create_at`, `adress`, `nbrAn`, `ns1`, `ns2`, `pass`, `cpass`) VALUES
(1, 'toni', 'momo', 'tmomo@gg', 'tinos.benin', '2021-10-22 16:02:26', '', 0, 'ns1.dnshosting.benin', 'ns2.dnshosting.benin', '', ''),
(2, 'tot', 'ti', 'ti@j', 'toto.cotonou', '2021-10-22 16:05:39', '', 0, 'ns1.dnshosting.benin', 'ns2.dnshosting.benin', '', ''),
(3, 'tonp', 'uiu', 'esa@rtyui.ft', 'tot.benin', '2021-10-22 16:16:36', '', 0, 'ns1.dnshosting.benin', 'ns2.dnshosting.benin', '', ''),
(4, 'toto', 'utitui', 'utut@gm', 'toto.cotonou', '2021-10-22 16:23:03', '', 0, 'ns1.dnshosting.benin', 'ns2.dnshosting.benin', '', ''),
(5, 'toto', 'tata', 'tata@gmail.com', 'tata.tata', 'aujouid\'hui', 'rien', 2, 'ns1.dnshosting.benin', 'ns2.dnshosting.benin', '1234', '1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `domain`
--
ALTER TABLE `domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
