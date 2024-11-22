<?php

namespace app\Config;

use PDO;
use PDOException;

class DatabaseConfig
{
    // Database connection settings
    public $host         = "localhost";
    public $user         = "root";
    public $password     = "";
    public $databaseName = "web4_demo";
    public $port         = 3306;

    private $connection;

    // Method to establish connection
    public function connect()
    {
        try {
            $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->databaseName;charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
