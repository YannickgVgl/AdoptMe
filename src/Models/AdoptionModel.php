<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB;
use PDO;

class AdoptionModel
{
    public ?int $idAdoption = null;
    public ?string $dateAdoption = null;
    public ?int $idEmploye = null;
    public ?int $idAnimal = null;
    public ?int $idProprietaire = null;
    
    public static function getAll()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('
            SELECT 
                a.idAdoption, 
                a.dateAdoption, 
                e.nomUtilisateur AS employeNom, 
                an.nom AS animalNom, 
                an.dateNaissance AS animalDateNaissance, 
                an.sexe AS animalSexe, 
                es.nom AS especeNom, 
                p.nom AS proprietaireNom, 
                p.prenom AS proprietairePrenom, 
                p.email AS proprietaireEmail, 
                p.numeroTelephone AS proprietaireTelephone
            FROM Adoption a
            JOIN Employe e ON a.idEmploye = e.idEmploye
            JOIN Animal an ON a.idAnimal = an.idAnimal
            JOIN Espece es ON an.idEspece = es.idEspece
            JOIN Proprietaire p ON a.idProprietaire = p.idProprietaire
        ');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function getAllWithAdoption()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query("
            SELECT 
                an.idAnimal, 
                an.nom, 
                an.dateNaissance, 
                an.sexe, 
                es.nom AS especeNom, 
                ad.dateAdoption 
            FROM Animal an
            JOIN Espece es ON an.idEspece = es.idEspece
            LEFT JOIN Adoption ad ON an.idAnimal = ad.idAnimal
        ");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function add($dateAdoption, $idEmploye, $idAnimal, $idProprietaire)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('INSERT INTO Adoption (dateAdoption, idEmploye, idAnimal, idProprietaire) VALUES (:dateAdoption, :idEmploye, :idAnimal, :idProprietaire)');
        return $stmt->execute([
            'dateAdoption' => $dateAdoption,
            'idEmploye' => $idEmploye,
            'idAnimal' => $idAnimal,
            'idProprietaire' => $idProprietaire
        ]);
    }    
    

    public static function delete($idAdoption)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('DELETE FROM Adoption WHERE idAdoption = :idAdoption');
        return $stmt->execute(['idAdoption' => $idAdoption]);
    }
}