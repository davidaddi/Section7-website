-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 fév. 2023 à 12:05
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_section7`
--

-- --------------------------------------------------------

--
-- Structure de la table `bans`
--

CREATE TABLE `bans` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `github` varchar(255) DEFAULT NULL,
  `discord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bans`
--

INSERT INTO `bans` (`id`, `email`, `username`, `password`, `role`, `github`, `discord`) VALUES
(2, 'david.addi@yahaoo.fr', 'daaaaaaa', '$2y$10$V8cMncDiUPtfyTL6l10o9OvqNEK5wxqbjek3trMDVlFYrzfTCyrFO', 'user', 'https://github.com/legoatdegithubaaa', 'smvckay#0000');

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `image` varchar(55) NOT NULL DEFAULT 'helmet',
  `nom` varchar(55) NOT NULL,
  `dc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`image`, `nom`, `dc`) VALUES
('helmet', 'Soldat', 100),
('caporal', 'Caporal', 200),
('caporal-chef', 'Caporal Chef', 300),
('sergent', 'Sergent', 400),
('sergent-chef', 'Sergent Chef', 500),
('adjudant', 'Adjudant', 600),
('adjudant-chef', 'Adjudant Chef', 700),
('major', 'Major', 800),
('sous-lieutenant', 'Sous Lieutenant', 900),
('capitaine', 'Capitaine', 1000),
('commandant', 'Commandant', 1100),
('lieutenant-colonel', 'Lieutenant Colonel', 1200),
('general-de-brigade', 'Général de Brigade', 1300),
('chef-etat-major', 'Chef d\'Etat Major', 1400),
('general-division', 'Général de Division', 1500);

-- --------------------------------------------------------

--
-- Structure de la table `missions_desc`
--

CREATE TABLE `missions_desc` (
  `idMission` int(11) NOT NULL,
  `nomMission` varchar(300) NOT NULL,
  `rangMission` varchar(1) NOT NULL,
  `objectifMission` mediumtext NOT NULL,
  `recompense` int(11) NOT NULL,
  `enonce` text NOT NULL DEFAULT '  ',
  `statut` varchar(10000) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `missions_desc`
--

INSERT INTO `missions_desc` (`idMission`, `nomMission`, `rangMission`, `objectifMission`, `recompense`, `enonce`, `statut`, `deadline`) VALUES
(2, 'DB de la Section 7', 'S', 'Mettre en place un système efficace pour suivre les missions de la Section 7 et enregistrer les contributions de chaque membre de la communauté.', 100, 'Développement d\'un site / application / logiciel : Ce système sera développé sous forme de site / application / logiciel qui permettra de répertorier les missions au fur et à mesure de leur arrivée. Il sera également possible de suivre les liens vers les différents repositories GitHub des participants.\r\n\r\nListe des préceptes de la Section 7 : La base de données inclura également une liste des préceptes de la Section 7, ce qui permettra aux membres de la communauté de s\'y référer en tout temps.\r\n\r\nDesign propre : Le site / application / logiciel sera conçu de manière claire et attrayante, afin de permettre une utilisation facile et intuitive.\r\n\r\nPortfolio de la Section 7 : Ce projet servira de portfolio pour la Section 7 et de vitrine pour les contributions de chaque membre. Il permettra également de montrer les réalisations de la communauté à l\'extérieur.', 'A', '2023-02-19 18:00:00'),
(1, 'Jeu de Drapeux', 'B', 'Réaliser une app/site/logiciel qui génère aléatoirement un drapeau, le joueur doit tenter de trouver le nom du pays du drapeau en question, vous avez le droit d’ajouter autant de fonctionnalités que vous voulez.', 25, '  ', 'F', '2023-02-04 22:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `missions_submissions`
--

CREATE TABLE `missions_submissions` (
  `user` text NOT NULL,
  `nomMission` varchar(500) NOT NULL,
  `discord` varchar(500) NOT NULL,
  `lien_repo_github` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `missions_submissions`
--

INSERT INTO `missions_submissions` (`user`, `nomMission`, `discord`, `lien_repo_github`) VALUES
('smvcky', 'DB de la Section 7', 'smvcky#9438', 'https://github.com/davidaddi/Section7-website');

-- --------------------------------------------------------

--
-- Structure de la table `preceptes`
--

CREATE TABLE `preceptes` (
  `precepte` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `preceptes`
--

INSERT INTO `preceptes` (`precepte`, `description`, `image`) VALUES
('La Matrixe', 'Chaque soldat de la Section 7 doit être passionné par la technologie, le développement et la programmation à un niveau qui peut être considéré comme la matrixe.', 'matrix'),
('Les missions', 'Les missions de la Section 7 visent à propager la technologie en France et à améliorer la vie des gens. Les soldats sont encouragés à participer à autant de missions que possible pour augmenter leur DevCred(Crédibilité du développeur).', 'mission'),
('L\'innovation', 'La Section 7 est un mouvement culturel qui célèbre l\'innovation et encourage les soldats à créer des outils et des technologies innovantes.', 'innovation'),
('La Passion', 'La passion est au cœur de la Section 7. Les soldats doivent être passionnés par leur travail et inspirer les générations futures de développeurs et de programmeurs.', 'passion'),
('La coopération', 'La Section 7 est une communauté de développeurs et de programmeurs qui travaillent ensemble pour atteindre leurs objectifs. La coopération est encouragée et les soldats sont invités à partager leurs connaissances et leur expertise avec les autres membres de la communauté.', 'cooperation');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `github` mediumtext NOT NULL,
  `discord` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`, `github`, `discord`) VALUES
(1, 'mauvetech@gmail.com', 'mauvetech', '$2y$10$bcVvRxe0Lnvx9/xPIBaJpOPNfTvKGB998EgBhPzwq6AqHxcKP7Tnq', 'admin', 'https://github.com/mauvetech', 'Mauvetech#9214'),
(2, 'david.addi@yahoo.fr', 'smvcky', '$2y$10$E9ejwrdjWxN3mU0gdAftE.kUXoJMBnhHLZKy/bed.no/YHqb1YYXS', 'user', 'https://github.com/davidaddi', 'smvcky#9438'),
(3, 'test@test.fr', 'test', '$2y$10$CZakeS7KiJdCa87cAxLZyeV9x1cBCTjPozJx.vXZCTrQYeRvXJE/q', 'user', 'http://github.com/testtest', 'testes#0000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `missions_desc`
--
ALTER TABLE `missions_desc`
  ADD PRIMARY KEY (`nomMission`);

--
-- Index pour la table `missions_submissions`
--
ALTER TABLE `missions_submissions`
  ADD KEY `FK_Mision` (`nomMission`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `missions_submissions`
--
ALTER TABLE `missions_submissions`
  ADD CONSTRAINT `FK_Mision` FOREIGN KEY (`nomMission`) REFERENCES `missions_desc` (`nomMission`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
