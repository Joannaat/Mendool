-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : ven. 14 avr. 2023 à 19:25
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `joannaattali_mendool`
--

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE `commenter` (
  `id_video` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commenter`
--

INSERT INTO `commenter` (`id_video`, `id_personne`, `commentaire`, `date`) VALUES
(19, 2, 'c\'est super', '2023-03-16 13:12:07'),
(19, 114, 'J aime trop ce mec!', '2023-04-10 16:30:16'),
(30, 114, 'J adore kavanagh', '2023-04-10 16:30:34'),
(47, 96, 'J&#039;adore', '2023-04-02 08:26:12'),
(47, 112, 'super!', '2023-04-09 17:03:55'),
(47, 115, 'kikou', '2023-04-11 10:42:06'),
(47, 120, 'genial', '2023-04-14 09:25:16'),
(49, 35, 'Trop drole!', '2023-03-22 13:51:31');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom_tournee` varchar(200) NOT NULL,
  `nombre_personnes` int(11) NOT NULL,
  `date` date NOT NULL,
  `localisation` varchar(20) NOT NULL,
  `duree` int(11) NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom_tournee`, `nombre_personnes`, `date`, `localisation`, `duree`, `heure`) VALUES
(12, 'Théatre Femina', 500, '2023-05-24', 'Bordeaux', 120, '20:00:00'),
(13, 'Théatre du Capitole', 300, '2023-05-24', 'Toulouse', 120, '20:10:00'),
(14, 'Théatre Tête d\'Or', 250, '2023-05-23', 'Lyon', 120, '21:00:00'),
(16, 'Zenith Paris', 600, '2023-03-17', 'Paris', 120, '13:30:00'),
(18, 'Zenith Lyon', 500, '2023-04-28', 'Lyon', 120, '20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id` int(11) NOT NULL,
  `nom` varchar(500) NOT NULL,
  `prenom` varchar(500) NOT NULL,
  `mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `mail`) VALUES
(118, 'Mendy', 'Mendel', 'ytgytfyt@hotmail.fr'),
(119, 'Attali', 'Joanna', 'uyguygyu@hhy.fr'),
(120, 'allen', 'bruno', 'iuhiuh@hooij.fr'),
(121, 'Attali', 'Joannabdjduucjjckkck', 'jess-lets-go@hotmail.fr'),
(122, 'testyo', 'testyo', 'testyo@mail.com'),
(123, 'Yrxyrxyfxufxutxvhhhh', 'Hhvyhh', 'labo.lormont@biolab33.com'),
(124, 'Azaazzzzaaaaazaazzaa', 'Aaaazzzzaaeeeeerrfez', 'test@mail.com'),
(125, 'Bb', 'Bryanthebeaugossedef', 'b@b.com'),
(126, 'Joanna', 'Joanna', 'yvonattali@sfr.fr'),
(127, 'Ejjfjjjjjjfjfjjjjj', 'Ndnjdnjdnbbbd', 'dominiqueguedj1947@gmail.com'),
(128, 'Jdjduufuxucucuucuuc', 'Nndbjdnf', 'joanna.attali@3wa.io'),
(129, 'courgette', 'bouboule', 'thibault.altaber@gmail.com'),
(130, 'Mounettteejjfjjxjxjj', 'Ndjjdnd', 'yvonattali@sfr.fr'),
(131, 'Fjfjjdj', 'Hfufjf', 'yvonattali@sfr.fr'),
(132, 'Djjdfjjtjrjruurufu', 'Jdjfjd', 'jess-lets-go@hotmail.fr'),
(133, 'Djdjdjf', 'Jxjxjxjxjxjjxjxjjxjx', 'jess-lets-go@hotmail.fr'),
(134, 'Fjfjfjfjfjjfjfjcjcjc', 'Jfjfjf', 'jess-lets-go@hotmail.fr'),
(135, 'Tuthyyuhhgggggghhhhh', 'Vhghhh', 'jess-lets-go@hotmail.fr'),
(136, 'Jujujujujujujujujuju', 'Khciycitcit', 'dominiqueguedj1947@gmail.com'),
(137, 'Jojo', 'Jojo', 'jess-lets-go@hotmail.fr'),
(138, 'Mickaelounetteutejij', 'Mickaelounetteutejij', 'yvonattali@sfr.fr'),
(139, 'Hujujujujujujujujuju', 'Tuxutxux', 'dominiqueguedj1947@gmail.com'),
(140, 'jnniuhiuhuihiuhiuhui', 'jfioijoij', 'rofl.arg@hotmail.fr'),
(141, 'jkjhbjh', 'ikjiuhui', 'joanna.attali@3wa.io');

-- --------------------------------------------------------

--
-- Structure de la table `reserver_evenement`
--

CREATE TABLE `reserver_evenement` (
  `id` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `nombre_billet` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_video`
--

CREATE TABLE `type_video` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_video`
--

INSERT INTO `type_video` (`id`, `libelle`) VALUES
(1, 'Chronique'),
(2, 'Sketch');

-- --------------------------------------------------------

--
-- Structure de la table `userauth`
--

CREATE TABLE `userauth` (
  `id` int(11) NOT NULL,
  `login` varchar(250) NOT NULL,
  `mdp` varchar(400) NOT NULL,
  `visiteur` tinyint(1) NOT NULL DEFAULT '1',
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `userauth`
--

INSERT INTO `userauth` (`id`, `login`, `mdp`, `visiteur`, `id_personne`) VALUES
(119, 'Mendool', '$argon2id$v=19$m=65536,t=4,p=1$ZnlwbWtDU3pVNVJ1bEdVbA$gCzdyYQSJYzRYhIqf+Qp8mLMbX66vwIRgr7BVB1b8ac', 0, 118),
(120, 'jojo', '$argon2id$v=19$m=65536,t=4,p=1$NGp6bXBUdHg3Z0FmU0w5TQ$TKwkn2VCA9E9aRsmX5XRSdSZBGD3DA5uR8YfgGbBlbk', 1, 119),
(121, 'lolo', '$argon2id$v=19$m=65536,t=4,p=1$NnhaQVNHWnhKMVprUTN4aQ$J+wSsQza2F9Rpb3KXuCHWNJDE/5VRMPqRhWAmPE2JZc', 1, 120),
(122, 'Jjjjj', '$argon2id$v=19$m=65536,t=4,p=1$SUxpY2lhRjliY0tQMnp4cA$u4Trv2IsdgWcQH6VAl+U82mLgSwly+F7LvqjhTWRXrQ', 1, 121),
(123, 'testyo', '$argon2id$v=19$m=65536,t=4,p=1$L05RbnNJTU5ldXdmMFh0QQ$aH+YWUiOoYSEP/nIr7RZxVhq8QLjlgNAif6d9NmkYsY', 1, 122),
(124, 'Jbggt', '$argon2id$v=19$m=65536,t=4,p=1$OFRDYzNkS1d5NkUuYldxYw$WkJq0HBfNfG+cI7GRaZrPr4VT31NaoLe2AiKoShjPhE', 1, 123),
(125, 'Yo', '$argon2id$v=19$m=65536,t=4,p=1$bk1tdkE2NFhlLkFqL3lCaQ$hOaC6QvXsMigE4QNCgMBcaU6LQD6RxFR8RU3dk9UuIg', 1, 124),
(126, 'Bb', '$argon2id$v=19$m=65536,t=4,p=1$RFhVUEk3ekpPNnZ5T000MQ$Q0pq21eoqMrKxtVX4rBOhS5bNmtvtebgik4dZQF1AVU', 1, 125),
(127, 'Jdjjf', '$argon2id$v=19$m=65536,t=4,p=1$Y01tWTlXeWNaN1FDVmtUNA$BNCJA7s+Zhej7C4+LEZz+qGVyUTF7alNClOJAMOLNlE', 1, 126),
(128, 'Kiku', '$argon2id$v=19$m=65536,t=4,p=1$MHpBV2lDR1Q4LmNOcmh5TQ$/TG6Hqc9om9EtTJnNErLBF9CquBIKa/OPQQka2Bt2XU', 1, 127),
(129, 'Juju', '$argon2id$v=19$m=65536,t=4,p=1$LktHU2gvN2x0S1BBLmNJTA$DpHhFSzoyPDwV+LgKEiG/nmmrXXC/0955yGV7NDJU8Y', 1, 128),
(130, 'kiki', '$argon2id$v=19$m=65536,t=4,p=1$TmcxUEU3ZmE0VGhkbVhBZw$AF6ZJ8Apbf/m+PYfGSpPRsYO6MVr7MWDD7UVwUUPY70', 1, 129),
(131, 'Bbfbdjd', '$argon2id$v=19$m=65536,t=4,p=1$bG9zd3drUm90SXZ1aUxvag$7Pml/Ip0/ccwuoY2yfHkokzzf3uoX5AZxjK3+49eGjk', 1, 130),
(132, 'Jrir', '$argon2id$v=19$m=65536,t=4,p=1$clFrUVJUbnRzbi4wNmFBNA$k/rtT+odOhDOEqP3BrSwwA/JvK9KK6W6AA9oa5rHqFw', 1, 131),
(133, 'Eyruur', '$argon2id$v=19$m=65536,t=4,p=1$QlhmWDNmSy45dElHaGFmZQ$X6+p+avDevKdXH6Pam3HgIy9wu0Me74TZp+PDd0mcuA', 1, 132),
(134, 'Ruru', '$argon2id$v=19$m=65536,t=4,p=1$SUFnckpDZXViUmwvL0lWYg$XotdTTjakiBSDyEMg/bA21PeAWk3QCSbPx/I6RxcoRo', 1, 133),
(135, 'Jiji', '$argon2id$v=19$m=65536,t=4,p=1$ZHlGRnN3dlRVdEJySklBTw$eqnj+2HZYe4dsxdrwEQtBn3rs3Wwp4uRg+Awltvu5wo', 1, 134),
(136, 'Hij', '$argon2id$v=19$m=65536,t=4,p=1$Qlp3SE1ZUExaa1VhMzdoTw$Kln9q895hPpisXUpkSXGU+BVnn/k15QPWHqn5CFq61g', 1, 135),
(137, 'Huj', '$argon2id$v=19$m=65536,t=4,p=1$dnRLNjdzaUhQLmRCckVWNg$AaJxc+WnoxSpzrjDMrwvWPWzcFRi5uO+ATocaFKVWUg', 1, 136),
(138, 'Koji', '$argon2id$v=19$m=65536,t=4,p=1$dFdXaE1tb1hQdHUvaDhiNQ$BqwCrQ7p9cb6IsiUNld2XEbXLAwpEzG08Lloa9R279Y', 1, 137),
(139, 'Jfjf', '$argon2id$v=19$m=65536,t=4,p=1$QlV5WmFVLkVtMXR1VjFvQQ$Cr77p7e4P1CFtFD7saMHOiqVdqg6BlaKnmduaegOdx4', 1, 138),
(140, 'Jii', '$argon2id$v=19$m=65536,t=4,p=1$amEvQTZzSk8vM3dZMUhGcg$eCCyHSSR/8rFLZB41Q2HWwQtagMFUcZzbU8QZUv2byk', 1, 139),
(141, 'ijiuj', '$argon2id$v=19$m=65536,t=4,p=1$QVlQeXc3NjJSb2FjdVZybw$wL+XHML9kXolsC8v3Cs1Msz1d95CHzf3j+rUFx5pVpo', 1, 140),
(142, 'hhhuyhyu', '$argon2id$v=19$m=65536,t=4,p=1$NUZOR0hEMDFtcjUxVWp6eg$4Sjf9KV774GGun+OJz2zuv9Q16yzhl9uAGccC7MCaW4', 1, 141);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `titre` varchar(500) NOT NULL,
  `lien_video` varchar(500) NOT NULL,
  `id_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `titre`, `lien_video`, `id_type`) VALUES
(19, 'L\'hypochondriaque', 'https://www.youtube.com/embed/mFKvKfyeHMQ', 2),
(30, 'Radio J : Anthony Kavanagh', 'https://www.youtube.com/embed/LdD6UKnWrZ4', 1),
(41, 'Radio J :  Isabelle Carre', 'https://www.youtube.com/embed/nBL_7JOLVbE', 1),
(42, 'Radio J :  Valerie Damidot', 'https://www.youtube.com/embed/xZ2Xp-pSUKs', 1),
(43, 'Radio J :  Melody Madar', 'https://www.youtube.com/embed/1ba-vBpmt3s', 1),
(44, 'Radio J :  Mathieu Chedid', 'https://www.youtube.com/embed/kiuyZ7ul9KQ', 1),
(47, 'Je reste en vacances!', 'https://www.youtube.com/embed/FwuZJyGbm7g', 2),
(48, 'Prolongation des vacances', 'https://www.youtube.com/embed/FwuZJyGbm7g', 2),
(49, 'Coronavirus', 'https://www.youtube.com/embed/1FNWRBhEeOc', 2),
(54, 'S\'endormir sur un inconnu', 'https://www.youtube.com/embed/rbMIVvLBHNU ', 2),
(58, 'Les agents de santé', 'https://www.youtube.com/embed/J1rLxNpkDi8', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`id_video`,`id_personne`,`date`),
  ADD KEY `commenter_FK` (`id_personne`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reserver_evenement`
--
ALTER TABLE `reserver_evenement`
  ADD PRIMARY KEY (`id`,`id_personne`),
  ADD KEY `reserver_evenement_personne0_FK` (`id_personne`);

--
-- Index pour la table `type_video`
--
ALTER TABLE `type_video`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userauth`
--
ALTER TABLE `userauth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userauth_FK` (`id_personne`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_FK` (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT pour la table `type_video`
--
ALTER TABLE `type_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `userauth`
--
ALTER TABLE `userauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_FK` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `commenter_FK_1` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id`);

--
-- Contraintes pour la table `reserver_evenement`
--
ALTER TABLE `reserver_evenement`
  ADD CONSTRAINT `reserver_evenement_evenement_FK` FOREIGN KEY (`id`) REFERENCES `evenement` (`id`),
  ADD CONSTRAINT `reserver_evenement_personne0_FK` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`);

--
-- Contraintes pour la table `userauth`
--
ALTER TABLE `userauth`
  ADD CONSTRAINT `userauth_FK` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`);

--
-- Contraintes pour la table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_FK` FOREIGN KEY (`id_type`) REFERENCES `type_video` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
