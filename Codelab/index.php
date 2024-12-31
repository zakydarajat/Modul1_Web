<?php
require_once __DIR__ . '/Controllers/ProductController.php';

use Controller\ProductController;

header('Content-Type: application/json');

$productController = new ProductController();
echo json_encode($productController->getAllProduct(), JSON_PRETTY_PRINT);
