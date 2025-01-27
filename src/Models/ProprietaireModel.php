<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;


class ProprietaireModel
{
    public ?int $idProprietaire = null;
    public ?string $nom = null;
    public ?string $prenom = null;
    public ?string $email = null;
    public ?string $telephone = null;
    
    public static function getAll()
    {
        $db = Database::getConnection();
        $stmt = $db->query('SELECT * FROM Proprietaire');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function add($nom, $prenom, $email, $telephone)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('INSERT INTO Proprietaire (nom, prenom, email, telephone) VALUES (:nom, :prenom, :email, :telephone)');
        return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'telephone' => $telephone]);
    }

    public static function update($id, $nom, $prenom, $email, $telephone)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE Proprietaire SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE idProprietaire = :id');
        return $stmt->execute(['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'telephone' => $telephone]);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM Proprietaire WHERE idProprietaire = :id');
        return $stmt->execute(['id' => $id]);
    }
}