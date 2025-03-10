<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;
use PDO;

/**
 * Class ProprietaireModel
 * @package Yannickvgl\AdoptMe\Models
 * This class is used to manage the owners
 */
class ProprietaireModel
{
    /**
     * @var int|null $idProprietaire
     * @var string|null $nom
     * @var string|null $prenom
     * @var string|null $email
     * @var string|null $numeroTelephone
     * These are the attributes of the class
     */
    public ?int $idProprietaire = null;
    public ?string $nom = null;
    public ?string $prenom = null;
    public ?string $email = null;
    public ?string $numeroTelephone = null;
    
    /**
     * This function is used to get all the owners
     */
    public static function getAll()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('SELECT * FROM Proprietaire');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * This function is used to add an owner
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $numeroTelephone
     */
    public static function add($nom, $prenom, $email, $numeroTelephone)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('INSERT INTO Proprietaire (nom, prenom, email, numeroTelephone) VALUES (:nom, :prenom, :email, :numeroTelephone)');
        return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'numeroTelephone' => $numeroTelephone]);
    }

    /**
     * This function is used to update an owner
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $numeroTelephone
     */
    public static function update($id, $nom, $prenom, $email, $numeroTelephone)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('UPDATE Proprietaire SET nom = :nom, prenom = :prenom, email = :email, numeroTelephone = :numeroTelephone WHERE idProprietaire = :id');
        return $stmt->execute(['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'numeroTelephone' => $numeroTelephone]);
    }

    /**
     * This function is used to delete an owner
     * @param int $id
     */
    public static function delete($id)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('DELETE FROM Proprietaire WHERE idProprietaire = :id');
        return $stmt->execute(['id' => $id]);
    }
}