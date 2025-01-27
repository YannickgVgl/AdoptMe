-- Création du schéma
CREATE SCHEMA IF NOT EXISTS `ExaBlancTPI-AdoptMe`;
USE `ExaBlancTPI-AdoptMe`;

-- Création de la table Employé
CREATE TABLE IF NOT EXISTS `Employe` (
    `idEmploye` INT AUTO_INCREMENT PRIMARY KEY,
    `nomUtilisateur` VARCHAR(255) NOT NULL,
    `motDePasse` VARCHAR(255) NOT NULL
);

-- Création de la table Espèce
CREATE TABLE IF NOT EXISTS `Espece` (
    `idEspece` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL
);

-- Création de la table Animal
CREATE TABLE IF NOT EXISTS `Animal` (
    `idAnimal` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `dateNaissance` DATE NOT NULL,
    `sexe` ENUM('M', 'F') NOT NULL,
    `idEspece` INT NOT NULL,
    FOREIGN KEY (`idEspece`) REFERENCES `Espece`(`idEspece`)
);

-- Création de la table Propriétaire
CREATE TABLE IF NOT EXISTS `Proprietaire` (
    `idProprietaire` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `numeroTelephone` VARCHAR(15) NOT NULL
);

-- Création de la table Adoption
CREATE TABLE IF NOT EXISTS `Adoption` (
    `idAdoption` INT AUTO_INCREMENT PRIMARY KEY,
    `dateAdoption` DATE NOT NULL,
    `idEmploye` INT NOT NULL,
    `idAnimal` INT NOT NULL,
    `idProprietaire` INT NOT NULL,
    FOREIGN KEY (`idEmploye`) REFERENCES `Employe`(`idEmploye`),
    FOREIGN KEY (`idAnimal`) REFERENCES `Animal`(`idAnimal`),
    FOREIGN KEY (`idProprietaire`) REFERENCES `Proprietaire`(`idProprietaire`)
);