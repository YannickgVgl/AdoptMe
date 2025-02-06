-- Utiliser la base AdoptMeSecondaire
USE `ExaBlancTPI-AdoptMe`;

-- Insérer des espèces
INSERT INTO `Espece` (`nom`) VALUES
('Hamster'),
('Oiseau'),
('Chien'),
('Furet'),
('Poisson'),
('Lapin'),
('Chat');

-- Insérer des employés
INSERT INTO `Employe` (`nomUtilisateur`, `motDePasse`) VALUES
('Admin', 'Super'),
('Rebecca', 'SuperR'),
('Mambella', 'SuperM'),
('Vincent', 'SuperV');

-- Insérer des animaux
INSERT INTO `Animal` (`nom`, `dateNaissance`, `sexe`, `idEspece`) VALUES
('Dana', '2014-11-15', 'M', 1),
('Renee', '2021-05-30', 'F', 2),
('Daniel', '2014-03-19', 'M', 3),
('Jonathan', '2015-09-22', 'F', 4),
('Sheila', '2017-06-28', 'F', 2),
('Gregory', '2023-08-02', 'M', 5),
('Christina', '2017-02-08', 'F', 6),
('Amanda', '2020-06-18', 'M', 2),
('Sophia', '2021-05-27', 'M', 6),
('Christina', '2018-02-06', 'F', 4),
('Kaitlyn', '2015-01-26', 'F', 2),
('Mary', '2017-10-21', 'M', 1),
('Patrick', '2020-10-22', 'M', 1),
('Travis', '2018-05-10', 'M', 3),
('Laura', '2014-11-06', 'M', 2),
('Tina', '2020-01-09', 'F', 7),
('Tracy', '2022-10-23', 'F', 4),
('Julie', '2021-12-09', 'M', 4),
('Timothy', '2018-12-03', 'M', 3),
('Miranda', '2018-05-18', 'M', 7);

-- Insérer des propriétaires
INSERT INTO `Proprietaire` (`nom`, `prenom`, `email`, `numeroTelephone`) VALUES
('Caldwell', 'Thomas', 'kimberly68@lambert.com', '862-701-1542'),
('Little', 'Angela', 'millergary@gmail.com', '+1-776-051-646'),
('Howard', 'Lisa', 'lmendoza@yahoo.com', '054-996-8232'),
('Richardson', 'Tara', 'voconnor@gmail.com', '271-458-3136'),
('Owens', 'Jeanette', 'okirk@gutierrez.biz', '300-984-2157'),
('Williams', 'Stephanie', 'agarcia@fernandez-white.net', '870-064-7455'),
('Gibson', 'Joseph', 'stevenbaker@gmail.com', '642-260-9016'),
('Barnes', 'Kirk', 'kroth@yahoo.com', '+1-105-598-465'),
('Juarez', 'David', 'danielgary@harrison.com', '981-060-7555'),
('Townsend', 'Jennifer', 'mbowman@reyes.com', '138-998-9615');

-- Insérer des adoptions (liens entre employé, animal et propriétaire)
INSERT INTO `Adoption` (`dateAdoption`, `idEmploye`, `idAnimal`, `idProprietaire`) VALUES
('2023-01-15', 1, 1, 1),
('2021-06-10', 2, 2, 2),
('2022-05-14', 3, 3, 3),
('2020-07-22', 1, 4, 4),
('2021-02-12', 2, 5, 5),
('2023-02-01', 3, 6, 6),
('2020-08-09', 1, 7, 7),
('2022-10-15', 2, 8, 8),
('2021-05-13', 3, 9, 9),
('2022-12-30', 1, 10, 10);

