<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;



class EmployeModel
{
    public ?int $idEmploye = null;
    public ?string $nomUtilisateur = null;
    public ?string $motDePasse = null;
    
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