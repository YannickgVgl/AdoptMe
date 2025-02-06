<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;
use PDO;

class EmployeModel
{
    public ?int $idEmploye = null;
    public ?string $nomUtilisateur = null;
    public ?string $motDePasse = null;
    
    public static function getAll()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('SELECT * FROM Employe');
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // function to get all the employees by their username
    public static function getEmploye(string $nomUtilisateur)
    {
        $pdo = DatabaseDB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM Employe WHERE nomUtilisateur = :nomUtilisateur");
        $stmt->execute(['nomUtilisateur' => $nomUtilisateur]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,static::class);
        return $stmt->fetch();
    }

    public static function verifyLogin($nomUtilisateur)
    {
        $stmt = DatabaseDB::getConnection()
        ->prepare("SELECT * FROM Employe WHERE nomUtilisateur = :nomUtilisateur");
        $stmt->execute(['nomUtilisateur' => $nomUtilisateur]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,static::class);
        return $stmt->fetch();
    }

    public static function updatePassword(int $idEmploye, string $motDePasse)
    {
        $stmt = DatabaseDB::getConnection()
        ->prepare("UPDATE Employe SET motDePasse = :motDePasse WHERE idEmploye = :idEmploye");
        $stmt->execute(['idEmploye' => $idEmploye, 'motDePasse' => $motDePasse]);
    }
}