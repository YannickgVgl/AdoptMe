<?php

namespace Yannickvgl\AdoptMe\Models;

use Yannickvgl\AdoptMe\Models\DatabaseDB as DatabaseDB;
use PDO;

class EmployeModel
{
    public ?int $idEmploye = null;
    public ?string $nomUtilisateur = null;
    public ?string $motDePasse = null;
    
    /**
     * Retrieves all employee records from the database.
     * 
     * This method prepares and executes a SQL query to fetch all employee records
     * from the `Employe` table. The result is fetched as an array of objects.
     * 
     * @return array An array of employee objects.
     */
    public static function getAll()
    {
        $db = DatabaseDB::getConnection();
        $stmt = $db->query('SELECT * FROM Employe');
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
    

    /**
     * Retrieves an employee record from the database based on the provided username.
     *
     * This method prepares and executes a SQL query to fetch an employee's details
     * from the `Employe` table where the `nomUtilisateur` matches the provided value.
     * The result is fetched as an instance of the calling class.
     *
     * @param string $nomUtilisateur The username of the employee to retrieve.
     * @return static|null The employee object if found, or null if no matching record is found.
     */
    public static function getEmploye(string $nomUtilisateur)
    {
        $pdo = DatabaseDB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM Employe WHERE nomUtilisateur = :nomUtilisateur");
        $stmt->execute(['nomUtilisateur' => $nomUtilisateur]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,static::class);
        return $stmt->fetch();
    }

    /**
     * Updates the password of an employee in the database.
     *
     * This method prepares and executes a SQL query to update the `motDePasse` field
     * of an employee record in the `Employe` table where the `idEmploye` matches the provided value.
     *
     * @param int $idEmploye The ID of the employee whose password should be updated.
     * @param string $motDePasse The new password to set for the employee.
     */
    public static function updatePassword(int $idEmploye, string $motDePasse)
    {
        $stmt = DatabaseDB::getConnection()
        ->prepare("UPDATE Employe SET motDePasse = :motDePasse WHERE idEmploye = :idEmploye");
        $stmt->execute(['idEmploye' => $idEmploye, 'motDePasse' => $motDePasse]);
    }
}