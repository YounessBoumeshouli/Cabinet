<?php
namespace Core;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = require_once '../config/config.php';
        $db = $config['db'];
        
        try {
            $this->connection = new \PDO(
                "{$db['type']}:host={$db['host']};dbname={$db['name']}",
                $db['user'],
                $db['pass']
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            throw new \Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

