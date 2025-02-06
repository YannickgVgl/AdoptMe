<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;
use PDO;

class ProprietaireModel
{
    public ?int $idProprietaire = null;
    public ?string $nom = null;
    public ?string $prenom = null;
    public ?string $email = null;
    public ?string $numeroTelephone = null;
    
    public static function getAll()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('SELECT * FROM Proprietaire');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getAdoptedAnimals()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('
            SELECT 
                a.idAnimal, 
                a.nom, 
                a.dateNaissance, 
                a.sexe, 
                e.nom AS especeNom, 
                ad.dateAdoption 
            FROM Animal a
            JOIN Espece e ON a.idEspece = e.idEspece
            LEFT JOIN Adoption ad ON a.idAnimal = ad.idAnimal
        ');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }   

    public static function add($nom, $prenom, $email, $numeroTelephone)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('INSERT INTO Proprietaire (nom, prenom, email, numeroTelephone) VALUES (:nom, :prenom, :email, :numeroTelephone)');
        return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'numeroTelephone' => $numeroTelephone]);
    }

    public static function update($id, $nom, $prenom, $email, $numeroTelephone)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('UPDATE Proprietaire SET nom = :nom, prenom = :prenom, email = :email, numeroTelephone = :numeroTelephone WHERE idProprietaire = :id');
        return $stmt->execute(['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'numeroTelephone' => $numeroTelephone]);
    }

    public static function delete($id)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('DELETE FROM Proprietaire WHERE idProprietaire = :id');
        return $stmt->execute(['id' => $id]);
    }
}