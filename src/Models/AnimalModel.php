<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;
use PDO;

/**
 * Class AnimalModel
 * @package Yannickvgl\AdoptMe\Models
 * This class is used to manage the animals
 */
class AnimalModel
{
    /**
     * @var int|null $idAnimal
     * @var string|null $nom
     * @var string|null $dateNaissance
     * @var string|null $sexe
     * @var int|null $idEspece
     * These are the attributes of the class
     */
    public ?int $idAnimal = null;
    public ?string $nom = null;
    public ?string $dateNaissance = null;
    public ?string $sexe = null;
    public ?int $idEspece = null;

    /**
     * This function is used to get all the animals with their species
     */
    public static function getAll()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('
            SELECT Animal.*, Espece.nom AS nomEspece
            FROM Animal
            JOIN Espece ON Animal.idEspece = Espece.idEspece
        ');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * This function is used to get an animal by its id
     * @param int $id
     */
    public static function getById(int $id)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('
            SELECT Animal.*, Espece.nom AS nomEspece
            FROM Animal
            JOIN Espece ON Animal.idEspece = Espece.idEspece
            WHERE Animal.idAnimal = :id
        ');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * This function is used to get all the species
     */
    public static function getAllSpecies()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('SELECT idEspece, nom FROM Espece');
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    /**
     * This function is used to add an animal
     * @param string $nom
     * @param string $dateNaissance
     * @param string $sexe
     * @param int $idEspece
     */
    public static function add($nom, $dateNaissance, $sexe, $idEspece)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('INSERT INTO Animal (nom, dateNaissance, sexe, idEspece) VALUES (:nom, :dateNaissance, :sexe, :idEspece)');
        return $stmt->execute(['nom' => $nom, 'dateNaissance' => $dateNaissance, 'sexe' => $sexe, 'idEspece' => $idEspece]);
    }

    /**
     * This function is used to update an animal
     * @param int $idAnimal
     * @param string $nom
     * @param string $dateNaissance
     * @param string $sexe
     * @param int $idEspece
     */
    public static function update($idAnimal, $nom, $dateNaissance, $sexe, $idEspece)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('UPDATE Animal SET nom = :nom, dateNaissance = :dateNaissance, sexe = :sexe, idEspece = :idEspece WHERE idAnimal = :idAnimal');
        return $stmt->execute(['idAnimal' => $idAnimal, 'nom' => $nom, 'dateNaissance' => $dateNaissance, 'sexe' => $sexe, 'idEspece' => $idEspece]);
    }

    /**
     * This function is used to delete an animal
     * @param int $idAnimal
     */
    public static function delete($idAnimal)
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->prepare('DELETE FROM Animal WHERE idAnimal = :idAnimal');
        return $stmt->execute(['idAnimal' => $idAnimal]);
    }
}