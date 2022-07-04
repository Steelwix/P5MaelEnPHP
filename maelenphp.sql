-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 04 juil. 2022 à 10:54
-- Version du serveur : 8.0.29
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maelenphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `idComment` int NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `comDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `isValid` tinyint(1) NOT NULL,
  `id` int NOT NULL,
  `idPost` int NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `idPost` (`idPost`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`idComment`, `comment`, `comDate`, `isValid`, `id`, `idPost`) VALUES
(63, 'yo', '2022-05-22 16:57:46', 1, 25, 16),
(75, 'Merci', '2022-05-23 13:53:07', 1, 1, 7),
(77, 'Aya', '2022-05-23 14:32:32', 1, 1, 17),
(81, 'Alors', '2022-05-23 16:08:55', 1, 1, 7),
(91, 'Il est valide?', '2022-05-31 13:15:10', 1, 1, 6),
(92, 'RER', '2022-05-31 13:16:29', 1, 1, 6),
(93, 'z', '2022-05-31 13:16:47', 1, 1, 6),
(95, 'c\'ccc', '2022-06-03 11:01:35', 1, 1, 6),
(96, 'no bin param', '2022-06-03 11:01:50', 1, 1, 6),
(97, 'pas de bind', '2022-06-03 14:31:05', 1, 1, 6),
(98, 'no\'bind', '2022-06-03 14:31:27', 1, 1, 6),
(99, 'No\'pe', '2022-06-03 14:49:00', 1, 1, 6),
(100, 'Nouveau post', '2022-06-04 17:22:51', 1, 1, 19),
(101, 'MAIS OUI', '2022-06-05 14:12:53', 1, 1, 6),
(102, 'Mais oui', '2022-06-15 14:43:54', 1, 1, 6),
(103, 'yo', '2022-06-16 14:56:32', 1, 1, 6),
(104, 'Oui j\'écris', '2022-06-16 16:13:11', 1, 1, 6),
(105, 'Et la?', '2022-06-16 16:13:44', 1, 1, 21),
(106, 'Impossible', '2022-06-16 16:30:02', 1, 1, 21),
(111, 'Crotte', '2022-06-26 22:37:35', 1, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `idPost` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `hat` varchar(300) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`idPost`, `title`, `hat`, `content`, `updateDate`, `id`) VALUES
(6, 'COMMENTAIRE', 'La méthode simple est rapide, mais le détail est là pour tous les curieux', 'qsdfgh', '2022-07-01', 1),
(7, 'Ceee', 's autres functions mais pas ici', 'dz', '2022-05-18', 1),
(11, 'Le forrmulaire de contact et de creation de post bug', 'Pourtant la technique marche avec le login', 'hh', '2022-05-19', 1),
(16, 'Jai compris mon problem', 'cest bien le header', 'Et jai tjrs pas ajouté la fonction de mailing', '2022-05-19', 1),
(17, 'zzzzzzz', 'aaaaaaaaaa', 'eeeeeeeee', '2022-05-22', 1),
(19, 'Organiser un site', 'on va tout ranger', 'trier php et html, et les details qui vont avec', '2022-05-28', 1),
(21, 'La superglobale Session', 'elle n\'a pa de filter input array, comment l\'utiliser?', 'Je travaille la dessus', '2022-06-15', 1),
(23, 'I can\'t edit posts', 'it used to work', 'it work now', '2022-06-23', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `isAdmin`) VALUES
(1, 'Steelwix', 'mhunmael@hotmail.com', 'motdepasse', '2022-05-05 19:07:42', 1),
(4, 'Ruby', 'rubysaphir@gmail.com', '123456', '2022-05-10 14:59:13', 1),
(25, 'BadOmen', 'exagon@gmail.com', 'omen', '2022-05-19 14:16:22', 0),
(29, 'Chach', 'rubyvoyance@gmail.com', '123', '2022-05-25 14:34:44', 0),
(42, 'Areeer', 'Thearrs@gmail.com', '987654321', '2022-06-03 11:12:22', 0),
(43, 'Alkan', 'vegereton@gmail.com', 'azert', '2022-06-05 14:56:34', 0),
(44, 'Bereta', 'zrdaofdrzz@gmail.com', '123', '2022-06-05 14:59:44', 0),
(45, 'Delta', 'deltavanilla@gmail.com', 'azer', '2022-06-05 15:04:01', 0),
(46, 'Egira', 'egiravanilla@gmail.com', 'aze', '2022-06-05 15:04:17', 0),
(47, 'Haska', 'Zedka@gmail.com', 'wix', '2022-06-16 15:51:15', 0),
(54, 'Kaza', 'cs.sabycamille@gmail.com', 'caca', '2022-06-22 00:08:06', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
