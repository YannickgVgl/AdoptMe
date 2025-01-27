-- Insertion de données dans la table Employé
INSERT INTO `Employe` (`nomUtilisateur`, `motDePasse`) VALUES
('Admin', 'LeSuperAmour');

-- Insertion de données dans la table Espèce
INSERT INTO `Espece` (`nom`) VALUES
('Chien'),
('Chat'),
('Lapin');

-- Insertion de données dans la table Animal
INSERT INTO `Animal` (`nom`, `dateNaissance`, `sexe`, `idEspece`) VALUES
('Rex', '2020-05-10', 'M', 1),
('Mimi', '2021-03-15', 'F', 2),
('Coco', '2022-01-20', 'M', 3);

-- Insertion de données dans la table Propriétaire
INSERT INTO `Proprietaire` (`nom`, `prenom`, `email`, `numeroTelephone`) VALUES
('Smith', 'John', 'john.smith@example.com', '123456789'),
('Doe', 'Jane', 'jane.doe@example.com', '987654321');

-- Insertion de données dans la table Adoption
INSERT INTO `Adoption` (`dateAdoption`, `idEmploye`, `idAnimal`, `idProprietaire`) VALUES
('2023-01-15', 1, 1, 1),
('2023-06-20', 2, 2, 2);
