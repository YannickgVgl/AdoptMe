<?php

namespace Yannickvgl\AdoptMe\Models;
use PDO;
if (!class_exists('DatabaseDB')) {
    class DatabaseDB {
        // Proprieties of the class DatabaseDB for the connection to the database 
        private static $host = "localhost";
        private static $db_name = "ExaBlancTPI-AdoptMe";
        private static $username = "root";
        private static $password = "Super";
        private static $pdo = null;
        
        // Connexion à la base de données
        public static function getConnection()     
        {
            if (self::$pdo === null) {
                try {
                    $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db_name . ';charset=utf8';
                    $options = [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_EMULATE_PREPARES => false,
                    ];

                    self::$pdo = new \PDO($dsn, self::$username, self::$password, $options);
                } catch (\Throwable $th) {
                    // @todo Add log entry
                    var_dump($th->getMessage());
                    die("Can't connect to database");
                }
            }

            return self::$pdo;
        }
    }
}