-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2022 at 01:41 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_lprs`
--

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `idClasse` int(11) NOT NULL,
  `libelle` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`idClasse`, `libelle`) VALUES
(1, '3VERTE'),
(2, '3JAUNE'),
(3, '2SN'),
(4, '2MSCP'),
(5, '2TRPM'),
(6, '1SN'),
(7, '1TU'),
(8, '1MEI'),
(9, '1STI2D'),
(10, 'TSN'),
(11, 'TMEI'),
(12, 'TTU'),
(13, 'TSTI2D'),
(14, '1BTSSIOSLAM'),
(15, '1BTSSIOSISR'),
(16, '1BTSCPRP'),
(17, '2BTSSIOSLAM'),
(18, '2BTSSIOSISR'),
(19, '2BTSCPRP'),
(21, 'AUTRE');

-- --------------------------------------------------------

--
-- Table structure for table `creation`
--

CREATE TABLE `creation` (
  `user` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `creation` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `organisateur` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `idEvent` int(11) NOT NULL,
  `libelle` varchar(200) COLLATE utf8_bin NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `lien`
--

CREATE TABLE `lien` (
  `idLien` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `idMessage` int(11) NOT NULL,
  `userExp` int(11) NOT NULL,
  `userDest` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`idMessage`, `userExp`, `userDest`, `message`, `date`) VALUES
(8, 5, 4, ' test', '2021-11-16 07:55:34'),
(9, 8, 4, 'Fait tes devoirs ', '2021-12-07 07:51:14'),
(10, 5, 4, ' caca', '2021-12-09 09:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `projet_ed`
--

CREATE TABLE `projet_ed` (
  `idProjet` int(11) NOT NULL,
  `libelle` varchar(200) COLLATE utf8_bin NOT NULL,
  `cours` varchar(200) COLLATE utf8_bin NOT NULL,
  `classe` int(11) NOT NULL,
  `prof` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `projet_ed`
--

INSERT INTO `projet_ed` (`idProjet`, `libelle`, `cours`, `classe`, `prof`, `date`) VALUES
(6, 'Projet annuel Web', 'E4', 17, 5, '2021-12-07'),
(7, 'Journée intégration', 'Vie scolaire', 1, 8, '2021-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE `rdv` (
  `idRdv` int(11) NOT NULL,
  `professeur` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `libelle` varchar(200) COLLATE utf8_bin NOT NULL,
  `horaire` datetime NOT NULL,
  `compterendu` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `rdv`
--

INSERT INTO `rdv` (`idRdv`, `professeur`, `parent`, `libelle`, `horaire`, `compterendu`) VALUES
(2, 8, 10, 'Reunion', '2021-12-04 09:00:00', 'Test d\'un ajout de compte-rendu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(200) COLLATE utf8_bin NOT NULL,
  `mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `profil` varchar(200) COLLATE utf8_bin NOT NULL,
  `classe` int(11) DEFAULT '21',
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `mdp` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `nom`, `prenom`, `mail`, `profil`, `classe`, `valide`, `mdp`) VALUES
(4, 'LEFEBVRE', 'Ryan', 'r.lefebvre@lprs.fr', 'etudiant', 17, 1, 'test'),
(5, 'DEV', 'Thanu', 'thanudi.m@gmail.com', 'admin', 21, 1, '$2y$10$lZYO3TjzRQfuFSO7fQRgU.Z0lqy0A/9jsdBz9hi88SdAPNDjIqQUa'),
(8, 'testprof', 'testprof', 'prof@prof.fr', 'prof', 21, 1, '$2y$10$xEUMcaM3wJtxcE029jtaOuQikG9zkZUJ.J34h3OcXsw6Y/q8Lk9lW'),
(10, 'test', 'parenttest', 'parent@parent.fr', 'parent', 21, 1, '$2y$10$xiguRb2pwC2ChLs7VU6fCu3m/jeLi5L36ERLQeeVVm4HavcN8ieMK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`idClasse`);

--
-- Indexes for table `creation`
--
ALTER TABLE `creation`
  ADD KEY `user` (`user`),
  ADD KEY `event` (`event`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idEvent`);

--
-- Indexes for table `lien`
--
ALTER TABLE `lien`
  ADD PRIMARY KEY (`idLien`),
  ADD KEY `parent` (`parent`),
  ADD KEY `eleve` (`eleve`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `userExp` (`userExp`),
  ADD KEY `userDest` (`userDest`);

--
-- Indexes for table `projet_ed`
--
ALTER TABLE `projet_ed`
  ADD PRIMARY KEY (`idProjet`),
  ADD KEY `prof` (`prof`),
  ADD KEY `classe` (`classe`);

--
-- Indexes for table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`idRdv`),
  ADD KEY `professeur` (`professeur`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `classe` (`classe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lien`
--
ALTER TABLE `lien`
  MODIFY `idLien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projet_ed`
--
ALTER TABLE `projet_ed`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `idRdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creation`
--
ALTER TABLE `creation`
  ADD CONSTRAINT `creation_ibfk_1` FOREIGN KEY (`event`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `creation_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `lien`
--
ALTER TABLE `lien`
  ADD CONSTRAINT `lien_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `lien_ibfk_2` FOREIGN KEY (`eleve`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`userExp`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`userDest`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `projet_ed`
--
ALTER TABLE `projet_ed`
  ADD CONSTRAINT `projet_ed_ibfk_1` FOREIGN KEY (`classe`) REFERENCES `classe` (`idClasse`),
  ADD CONSTRAINT `projet_ed_ibfk_2` FOREIGN KEY (`prof`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`professeur`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`classe`) REFERENCES `classe` (`idClasse`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
