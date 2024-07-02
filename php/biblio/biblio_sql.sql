-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 10:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblio_sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Roman'),
(2, 'Policier'),
(3, 'Science-fiction'),
(4, 'Roman'),
(5, 'Policier'),
(6, 'Fantastique');

-- --------------------------------------------------------

--
-- Table structure for table `cat_livre`
--

CREATE TABLE `cat_livre` (
  `id` int(11) NOT NULL,
  `livre_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cat_livre`
--

INSERT INTO `cat_livre` (`id`, `livre_id`, `categorie_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `emprunts`
--

CREATE TABLE `emprunts` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `livre_id` int(11) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date DEFAULT NULL,
  `delai_de_pret` date DEFAULT NULL,
  `amende` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprunts`
--

INSERT INTO `emprunts` (`id`, `utilisateur_id`, `livre_id`, `date_emprunt`, `date_retour`, `delai_de_pret`, `amende`) VALUES
(1, 1, 3, '2022-01-01', '2022-02-01', '2022-02-15', 0),
(2, 1, 2, '2022-01-01', '2022-02-01', '2022-01-15', 5),
(3, 2, 1, '2022-03-01', '2022-04-07', '2022-03-15', 5),
(4, 2, 2, '2022-05-01', NULL, '2022-07-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE `livres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `dispo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`, `dispo`) VALUES
(1, 'Le Seigneur des anneaux', 'Tolkien', 1),
(2, 'Le Puits', 'Tolkien', 1),
(3, 'Le retour du roi', 'Tolkien', 0),
(4, 'My book', 'Me OfCourse', 1),
(13, '4356gdfsgf', 'hsfgh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `num_tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amendes` float DEFAULT NULL,
  `niveau_acces` int(11) NOT NULL,
  `mot_de_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `adresse`, `num_tel`, `email`, `amendes`, `niveau_acces`, `mot_de_pass`) VALUES
(1, 'Doe', 'John', '123 Main St', '123-456-7890', 'jdoe@ex.com', 0, 0, '1234'),
(2, 'Doe', 'Jane', '456 Oak St', '123-456-7890', 'jdo@ex.com', 0, 0, '123'),
(3, 'Doe', 'Joe', '789 Elm St', '123-456-7890', 'jd@ex.com', 0, 1, '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_livre`
--
ALTER TABLE `cat_livre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livre_id` (`livre_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexes for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `livre_id` (`livre_id`);

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cat_livre`
--
ALTER TABLE `cat_livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cat_livre`
--
ALTER TABLE `cat_livre`
  ADD CONSTRAINT `cat_livre_ibfk_1` FOREIGN KEY (`livre_id`) REFERENCES `livres` (`id`),
  ADD CONSTRAINT `cat_livre_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`livre_id`) REFERENCES `livres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
