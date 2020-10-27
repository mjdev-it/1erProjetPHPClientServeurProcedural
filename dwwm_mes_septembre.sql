-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 29 Septembre 2020 à 09:21
-- Version du serveur :  10.1.44-MariaDB-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dwwm_mes_septembre`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `nom` varchar(55) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `passwrd` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `passwrd`) VALUES
(2, 'Mitchum', 'Robert', 'rm@gmail.com', 'ec22d36827be79bc92b4ffc3bbcea8f9f47fa824'),
(3, 'Christie', 'Agatha', 'ag@gmail.com', 'cc2a5a0c3fb70fc60df512c1092d6b2ae487c580'),
(5, 'Leconpté', 'Simon', 'jl@gmail.com', 'd0c64e4ad124e0a8c39a43d3dd8f7ab79f3c5d91'),
(6, 'Mackerot', 'François', 'fm@gmail.com', 'd0c64e4ad124e0a8c39a43d3dd8f7ab79f3c5d91'),
(7, 'Mackeroylespetitspois', 'François', 'fmck@gmail.com', 'ca63b0f3fa61f3c5a82d2d56afeb69b0d2724ad5'),
(8, 'Pétun', 'François', 'fp@gmail.com', 'a5316fe01727ad442520c391385261ab2fdb82dd'),
(9, 'Marceau', 'Sophie', 'sm@net', 'b7bc866b462f834997d227521f9fb172229019cc'),
(11, 'Hendricks', 'Barbara', 'barbarah@fr.uk', '4d2d7c83f702ee3d7eaa66555e6c6011ed0175d7'),
(12, 'Hendaye', 'Louisa', 'louosahend@fr.uk', '7ecb923dcc4165b8ab9da00fcf9cc4a4ad79cf4d'),
(13, 'Dedereti', 'Martha', 'louosahend@fr.uk', '7ecb923dcc4165b8ab9da00fcf9cc4a4ad79cf4d'),
(14, 'Badoit', 'Maria', 'mariabad@fr.uk.net', '2de77576b777ab5154ff766d3dfd15428111183c'),
(15, 'Badoit', 'Paola', 'paodoit@fr.uk.net', 'f094daaea64a059a3b48583c294afea0430c197b'),
(16, 'Patoinimoi', 'Bernard', 'patoi@uk.net', '794fcb2980549c31b0f39ed695432fcf12f4e69f'),
(17, 'Fourcadetort', 'Gauthier', 'com6s35@uk.net', 'b16c74047b3f1d968e9e61f073d8f14267f7d0c2');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
