<?php
require_once __DIR__ . '/../Config/DatabaseConfiguration.php';

use app\Config\DatabaseConfig;

class Product {
    private $conn;

    public function __construct() {
        $db = new DatabaseConfig();
        $this->conn = $db->connect();
    }

    public function getAllProducts() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM data_cowfee ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createProduct($name, $description, $image_url) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO data_cowfee (name, description, image_url) VALUES (?, ?, ?)");
            return $stmt->execute([$name, $description, $image_url]);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateProduct($id, $name, $description, $image_url) {
        try {
            $stmt = $this->conn->prepare("UPDATE data_cowfee SET name = ?, description = ?, image_url = ? WHERE id = ?");
            return $stmt->execute([$name, $description, $image_url, $id]);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteProduct($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM data_cowfee WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getProductById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM data_cowfee WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
