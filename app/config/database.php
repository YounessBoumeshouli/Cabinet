<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'cabinet_medical');
define('DB_USER', 'root');
define('DB_PASS', '');

// Classe de connexion à la base de données
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

