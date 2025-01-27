<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;


class AdoptionModel
{
    public ?int $idAdoption = null;
    public ?string $dateAdoption = null;
    public ?int $idEmploye = null;
    public ?int $idAnimal = null;
    public ?int $idProprietaire = null;
    public static function getAll()
    {
        $db = Database::getConnection();
        $stmt = $db->query('SELECT * FROM Adoption');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function add($idAdoption, $dateAdoption, $idEmploye, $idAnimal, $idProprietaire)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('INSERT INTO Adoption (idAdoption, dateAdoption, idEmploye, idAnimal, idProprietaire) VALUES (:idAdoption, :dateAdoption, :idEmploye, :idAnimal, :idProprietaire)');
        return $stmt->execute(['idAdoption' => $idAdoption, 'dateAdoption' => $dateAdoption, 'idEmploye' => $idEmploye, 'idAnimal' => $idAnimal, 'idProprietaire' => $idProprietaire]);
    }

    public static function delete($idAdoption)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM Adoption WHERE idAdoption = :idAdoption');
        return $stmt->execute(['id' => $idAdoption]);
    }
}