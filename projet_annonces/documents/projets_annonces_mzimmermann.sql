-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2023 at 02:01 PM
-- Server version: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projets_annonces_mzimmermann`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonce`
--

CREATE TABLE `annonce` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `publication` date DEFAULT NULL,
  `etat` varchar(100) DEFAULT NULL,
  `utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `annonce`
--

INSERT INTO `annonce` (`id`, `titre`, `description`, `photo`, `prix`, `publication`, `etat`, `utilisateur`) VALUES
(1, 'Vends Triumph III 1967', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'triumph_spitfire_3.jpg', '12450.00', '2023-04-04', 'en_cours', 1),
(2, 'Carte Magic Lotus noir', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'black_lotus.jpg', '10000.00', '2023-04-04', 'en_cours', 2),
(3, 'Jeu d\'échecs F1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'jeu_echecs_f1.jpg', '39523.00', '2022-06-08', 'en_cours', 1),
(4, 'Pot tonnelet du 1er siècle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'pot_tonnelet.jpg', '1250.00', '2022-09-15', 'termine', 1),
(5, 'Machine d\'Anticythère', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'machine_d_anticythère.jpg', '5200.00', '2023-02-08', 'en_cours', 2),
(6, 'Pièce de 10 centimes de francs de 1945', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'piece_10_centimes.jpeg', '36.00', '2022-12-14', 'en_cours', 4);

-- --------------------------------------------------------

--
-- Table structure for table `offre`
--

CREATE TABLE `offre` (
  `id` int(11) NOT NULL,
  `utilisateur` int(11) DEFAULT NULL,
  `annonce` int(11) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offre`
--

INSERT INTO `offre` (`id`, `utilisateur`, `annonce`, `montant`, `statut`) VALUES
(1, 3, 4, '1160.00', 'accepte'),
(2, 2, 3, '22500.00', 'refuse'),
(3, 1, 1, '10000.00', 'accepte'),
(4, 1, 1, '9500.00', 'refuse'),
(5, 1, 1, '9600.00', 'refuse'),
(6, 1, 1, '9650.00', 'refuse'),
(7, 1, 2, '9500.00', 'attente');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `actif` int(11) DEFAULT NULL,
  `cle` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `password`, `email`, `actif`, `cle`) VALUES
(1, 'Micka', '1234@', 'mzimmermann@mywebecom.ovh', NULL, NULL),
(2, 'Dany', '1234@', 'mzimmermann@mywebecom.ovh', NULL, NULL),
(3, 'Sven', '1234@', 'mzimmermann@mywebecom.ovh', NULL, NULL),
(4, 'Rick', '1234@', 'mzimmermann@mywebecom.ovh', NULL, NULL),
(6, 'Mickael', '$2y$10$UMLKyQ2KOaLgMMpuGZajxewJWud2ksMC.U/gwmycwlNNKt7FfH.dm', 'mzimmermann@mywebecom.ovh', 0, '63834e7adeefd6a5f9a306229a9a7dad'),
(7, 'Mickael2', '$2y$10$buf82XSJoFwVEU9gvZfaQOSF6Aej2M/i0kHlbOlafk8CeipqFYgsS', 'mzimmermann@mywebecom.ovh', 0, '260638f0154d08d5422e90d319ab6448'),
(8, 'Mickael3', '$2y$10$igP1QyKvu5xMuUUJ5Wn9qeSKfTDJr2Zfiv5Z75o832gViCcVXUvwe', 'mzimmermann@mywebecom.ovh', 0, '8e3041509eed025b4bb9c38a424327a2'),
(9, 'Mickael3', '$2y$10$wvErbPFu2nef5jje9fJX3O4qpym38PyBkLz6/bpYmYpXE5Fmq.7vi', 'mzimmermann@mywebecom.ovh', 0, '793cf11223b3ff20d9dcd5c6e3c59bbd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
