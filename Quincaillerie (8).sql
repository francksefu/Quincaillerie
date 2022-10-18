-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 18 oct. 2022 à 18:39
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Quincaillerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `Approvisionnement`
--

CREATE TABLE `Approvisionnement` (
  `idApprov` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `PrixA` float NOT NULL,
  `QuantiteApprov` int(11) NOT NULL,
  `DatesApprov` date NOT NULL,
  `Operation` int(11) NOT NULL,
  `TotalFacture` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Approvisionnement`
--

INSERT INTO `Approvisionnement` (`idApprov`, `idProduit`, `PrixA`, `QuantiteApprov`, `DatesApprov`, `Operation`, `TotalFacture`) VALUES
(2, 15, 10, 40, '2022-06-16', 200000, 1200),
(3, 16, 20, 40, '2022-06-16', 200000, 1200),
(4, 17, 3, 50, '2022-06-24', 200003, 200),
(5, 14, 1, 50, '2022-06-24', 200003, 200),
(8, 17, 3, 40, '2022-06-24', 200005, 920),
(9, 16, 20, 40, '2022-06-24', 200005, 920),
(10, 18, 100, 20, '2022-07-01', 200009, 2060),
(11, 17, 3, 20, '2022-07-01', 200009, 2060);

-- --------------------------------------------------------

--
-- Structure de la table `BonusPerte`
--

CREATE TABLE `BonusPerte` (
  `idBonusPerte` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `QuantitePerdu` int(11) NOT NULL,
  `QuantiteGagne` int(11) NOT NULL,
  `DatesD` date NOT NULL,
  `Motif` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `BonusPerte`
--

INSERT INTO `BonusPerte` (`idBonusPerte`, `idProduit`, `QuantitePerdu`, `QuantiteGagne`, `DatesD`, `Motif`) VALUES
(1, 14, 1, 0, '2022-06-24', 'motif: vide'),
(2, 15, 3, 0, '2022-06-24', ' Cassees '),
(3, 18, 1, 0, '2022-07-01', 'motif: ne s allume pas');

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `idClient` int(11) NOT NULL,
  `NomClient` varchar(20) NOT NULL,
  `Telephone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`idClient`, `NomClient`, `Telephone`) VALUES
(17, 'Francky', '+243'),
(18, 'Henri', '+243'),
(19, 'Janvier', '888888888'),
(20, 'Joyce', '+243'),
(21, 'Stella', '+243');

-- --------------------------------------------------------

--
-- Structure de la table `Commandant`
--

CREATE TABLE `Commandant` (
  `idCommande` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Commandant`
--

INSERT INTO `Commandant` (`idCommande`, `email`, `code`) VALUES
(1, 'franck', 'franck');

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `idContrat` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `PU` float NOT NULL,
  `PT` float NOT NULL,
  `Source` varchar(20) NOT NULL,
  `PAU` float NOT NULL,
  `PAT` float NOT NULL,
  `Operation` int(11) NOT NULL,
  `Observation` varchar(100) DEFAULT NULL,
  `DatesContrat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Contrat`
--

INSERT INTO `Contrat` (`idContrat`, `idProduit`, `idClient`, `Quantite`, `PU`, `PT`, `Source`, `PAU`, `PAT`, `Operation`, `Observation`, `DatesContrat`) VALUES
(1, 14, 17, 2, 10, 20, 'chez moi', 1, 2, 500000, NULL, '2022-10-13'),
(2, 15, 17, 3, 15, 45, 'chez moi', 10, 30, 500000, NULL, '2022-10-13'),
(3, 17, 17, 2, 5, 10, 'papa franck', 3, 6, 500002, NULL, '2022-10-13'),
(4, 15, 17, 1, 15, 15, 'chez moi', 10, 10, 500002, NULL, '2022-10-13'),
(5, 16, 18, 2, 29, 58, 'chez moi', 20, 40, 500004, NULL, '2022-10-14'),
(6, 17, 18, 2, 5, 10, 'chez moi', 3, 6, 500004, NULL, '2022-10-14');

-- --------------------------------------------------------

--
-- Structure de la table `Controleur`
--

CREATE TABLE `Controleur` (
  `idControleur` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `DatesControleur` date NOT NULL,
  `QuantiteAvant` int(11) NOT NULL,
  `QuantiteApres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `DetteEntreprise`
--

CREATE TABLE `DetteEntreprise` (
  `idDette` int(11) NOT NULL,
  `TypeD` varchar(20) NOT NULL,
  `ValeurDette` float NOT NULL,
  `MontantPaye` float NOT NULL,
  `Reste` float NOT NULL,
  `il_pris_quoi` varchar(110) DEFAULT NULL,
  `DatesD` date NOT NULL,
  `DatesRNew` date DEFAULT NULL,
  `MontantPayeHold` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `DetteEntreprise`
--

INSERT INTO `DetteEntreprise` (`idDette`, `TypeD`, `ValeurDette`, `MontantPaye`, `Reste`, `il_pris_quoi`, `DatesD`, `DatesRNew`, `MontantPayeHold`) VALUES
(1, 'Argent', 10, 10, 0, 'motif:makala', '2022-06-24', NULL, NULL),
(2, 'Argent', 10, 0, 10, 'motif: Bulire m a emprunter pour payer la dgi ', '2022-06-25', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Operation`
--

CREATE TABLE `Operation` (
  `idOperation` int(11) NOT NULL,
  `Code` int(11) NOT NULL,
  `Somme` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `PaiementContrat`
--

CREATE TABLE `PaiementContrat` (
  `idPaieContrat` int(11) NOT NULL,
  `DatesPaieContrat` date NOT NULL,
  `Montant` float NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `PaiementContrat`
--

INSERT INTO `PaiementContrat` (`idPaieContrat`, `DatesPaieContrat`, `Montant`, `idClient`) VALUES
(1, '2022-10-18', 200, 17),
(3, '2022-10-15', 300, 20);

-- --------------------------------------------------------

--
-- Structure de la table `Paiements`
--

CREATE TABLE `Paiements` (
  `idPaiements` int(11) NOT NULL,
  `DatesPaie` date NOT NULL,
  `Montant` float NOT NULL,
  `Operation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Paiements`
--

INSERT INTO `Paiements` (`idPaiements`, `DatesPaie`, `Montant`, `Operation`) VALUES
(1, '2022-06-24', 20, 100004),
(2, '2022-06-24', 20, 100004),
(4, '2022-06-24', 1, 100004),
(5, '2022-06-24', 1, 100004),
(6, '2022-06-24', 1, 100004),
(7, '2022-06-24', 1, 100004),
(8, '2022-06-24', 1, 100004),
(9, '2022-06-24', 1, 100004),
(10, '2022-06-24', 1, 100004),
(11, '2022-06-24', 1, 100004),
(12, '2022-06-24', 1, 100004),
(13, '2022-06-24', 1, 100004),
(14, '2022-06-24', 1, 100004),
(15, '2022-06-24', 1, 100004),
(16, '2022-06-24', 2, 100004),
(18, '2022-06-25', 15, 100011),
(19, '2022-07-01', 100, 100015);

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `idProduit` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `PrixAchat` float NOT NULL,
  `PrixVente` float NOT NULL,
  `PrixVmin` float NOT NULL,
  `QuantiteStock` int(11) NOT NULL,
  `DescriptionP` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`idProduit`, `Nom`, `PrixAchat`, `PrixVente`, `PrixVmin`, `QuantiteStock`, `DescriptionP`) VALUES
(14, 'maracuja', 1, 10, 10, 48, ''),
(15, 'Marteau', 10, 15, 11, 48, ''),
(16, 'pince', 20, 29, 25, 114, ''),
(17, 'Babouche', 3, 5, 4.5, 155, 'Masai'),
(18, 'Ordinateur', 100, 150, 120, 26, '');

-- --------------------------------------------------------

--
-- Structure de la table `Resume`
--

CREATE TABLE `Resume` (
  `idResume` int(11) NOT NULL,
  `DatesResume` date NOT NULL,
  `Dates2Resume` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Resume`
--

INSERT INTO `Resume` (`idResume`, `DatesResume`, `Dates2Resume`) VALUES
(1, '2022-06-17', '2022-07-02');

-- --------------------------------------------------------

--
-- Structure de la table `Sortie`
--

CREATE TABLE `Sortie` (
  `idSortie` int(11) NOT NULL,
  `TypeD` varchar(25) NOT NULL,
  `Montant` float NOT NULL,
  `il_pris_quoi` varchar(200) DEFAULT NULL,
  `DatesD` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Sortie`
--

INSERT INTO `Sortie` (`idSortie`, `TypeD`, `Montant`, `il_pris_quoi`, `DatesD`) VALUES
(1, 'Charge', 10, 'motif: Paie de la facture d electricite', '2022-06-24'),
(2, 'Depense', 50, 'motif: frais scolaire de mon de mon premier fils', '2022-06-24'),
(3, 'Charge', 300, 'motif:location maison', '2022-07-01');

-- --------------------------------------------------------

--
-- Structure de la table `Ventes`
--

CREATE TABLE `Ventes` (
  `idVentes` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `QuantiteVendu` int(11) NOT NULL,
  `PU` float NOT NULL,
  `PT` float NOT NULL,
  `DatesVente` date NOT NULL,
  `Operation` int(11) NOT NULL,
  `Dette` varchar(20) NOT NULL,
  `TotalFacture` float DEFAULT NULL,
  `MontantPaye` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Ventes`
--

INSERT INTO `Ventes` (`idVentes`, `idProduit`, `idClient`, `QuantiteVendu`, `PU`, `PT`, `DatesVente`, `Operation`, `Dette`, `TotalFacture`, `MontantPaye`) VALUES
(1, 14, 2, 1, 10, 10, '2022-06-12', 100000, 'Non', 30, NULL),
(2, 14, 2, 2, 10, 20, '2022-06-12', 100000, 'Non', 30, NULL),
(3, 14, 2, 1, 10, 10, '2022-06-12', 100002, 'Non', 30, NULL),
(4, 14, 2, 2, 10, 20, '2022-06-12', 100002, 'Non', 30, NULL),
(5, 16, 17, 2, 29, 58, '2022-06-24', 100004, 'Oui', 58, 54),
(6, 17, 18, 3, 4.8, 14.4, '2022-06-24', 100005, 'Non', 44.4, NULL),
(7, 15, 18, 2, 15, 30, '2022-06-24', 100005, 'Non', 44.4, NULL),
(10, 16, 17, 2, 29, 58, '2022-06-24', 100007, 'Non', 84, NULL),
(11, 15, 17, 2, 13, 26, '2022-06-24', 100007, 'Non', 84, NULL),
(12, 17, 18, 3, 5, 15, '2022-06-24', 100011, 'Oui', 35, 15),
(13, 14, 18, 2, 10, 20, '2022-06-24', 100011, 'Oui', 35, 15),
(14, 18, 17, 1, 140, 140, '2022-07-01', 100013, 'Non', 150, NULL),
(15, 17, 17, 2, 5, 10, '2022-07-01', 100013, 'Non', 150, NULL),
(16, 18, 20, 1, 150, 150, '2022-07-01', 100015, 'Oui', 150, 100),
(17, 15, 17, 1, 14, 14, '2022-10-13', 100016, 'Non', 81, NULL),
(18, 16, 17, 2, 26, 52, '2022-10-13', 100016, 'Non', 81, NULL),
(19, 17, 17, 3, 5, 15, '2022-10-13', 100016, 'Non', 81, NULL),
(20, 17, 21, 2, 5, 10, '2022-10-13', 100019, 'Non', 170, NULL),
(21, 18, 21, 1, 150, 150, '2022-10-13', 100019, 'Non', 170, NULL),
(22, 14, 21, 1, 10, 10, '2022-10-13', 100019, 'Non', 170, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Approvisionnement`
--
ALTER TABLE `Approvisionnement`
  ADD PRIMARY KEY (`idApprov`),
  ADD KEY `Approvisionnement_ibfk_1` (`idProduit`);

--
-- Index pour la table `BonusPerte`
--
ALTER TABLE `BonusPerte`
  ADD PRIMARY KEY (`idBonusPerte`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `Commandant`
--
ALTER TABLE `Commandant`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`idContrat`);

--
-- Index pour la table `Controleur`
--
ALTER TABLE `Controleur`
  ADD PRIMARY KEY (`idControleur`);

--
-- Index pour la table `DetteEntreprise`
--
ALTER TABLE `DetteEntreprise`
  ADD PRIMARY KEY (`idDette`);

--
-- Index pour la table `Operation`
--
ALTER TABLE `Operation`
  ADD PRIMARY KEY (`idOperation`);

--
-- Index pour la table `PaiementContrat`
--
ALTER TABLE `PaiementContrat`
  ADD PRIMARY KEY (`idPaieContrat`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `Paiements`
--
ALTER TABLE `Paiements`
  ADD PRIMARY KEY (`idPaiements`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`idProduit`);

--
-- Index pour la table `Resume`
--
ALTER TABLE `Resume`
  ADD PRIMARY KEY (`idResume`);

--
-- Index pour la table `Sortie`
--
ALTER TABLE `Sortie`
  ADD PRIMARY KEY (`idSortie`);

--
-- Index pour la table `Ventes`
--
ALTER TABLE `Ventes`
  ADD PRIMARY KEY (`idVentes`),
  ADD KEY `Ventes_ibfk_1` (`idClient`),
  ADD KEY `Ventes_ibfk_2` (`idProduit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Approvisionnement`
--
ALTER TABLE `Approvisionnement`
  MODIFY `idApprov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `BonusPerte`
--
ALTER TABLE `BonusPerte`
  MODIFY `idBonusPerte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `Commandant`
--
ALTER TABLE `Commandant`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Contrat`
--
ALTER TABLE `Contrat`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Controleur`
--
ALTER TABLE `Controleur`
  MODIFY `idControleur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `DetteEntreprise`
--
ALTER TABLE `DetteEntreprise`
  MODIFY `idDette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Operation`
--
ALTER TABLE `Operation`
  MODIFY `idOperation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `PaiementContrat`
--
ALTER TABLE `PaiementContrat`
  MODIFY `idPaieContrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Paiements`
--
ALTER TABLE `Paiements`
  MODIFY `idPaiements` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Resume`
--
ALTER TABLE `Resume`
  MODIFY `idResume` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Sortie`
--
ALTER TABLE `Sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Ventes`
--
ALTER TABLE `Ventes`
  MODIFY `idVentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Approvisionnement`
--
ALTER TABLE `Approvisionnement`
  ADD CONSTRAINT `Approvisionnement_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `Produit` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `PaiementContrat`
--
ALTER TABLE `PaiementContrat`
  ADD CONSTRAINT `PaiementContrat_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
