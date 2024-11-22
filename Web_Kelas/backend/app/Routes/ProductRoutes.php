<?php
require_once __DIR__ . '/../Controller/ProductController.php';

header('Content-Type: application/json'); // Set header untuk JSON response

$controller = new ProductController();
$action = $_GET['action'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($action === 'getProducts' && $method === 'GET') {
        $controller->getProducts();
    } elseif ($action === 'createProduct' && $method === 'POST') {
        $controller->createProduct();
    } elseif ($action === 'updateProduct' && $method === 'PUT') {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->updateProduct($id);
        } else {
            // http_response_code(400);
            echo json_encode(['message' => 'Product ID is required']);
        }
    } elseif ($action === 'deleteProduct' && $method === 'DELETE') {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->deleteProduct($id);
        } else {
            // http_response_code(400);
            echo json_encode(['message' => 'Product ID is required']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Action not found']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'An error occurred', 'error' => $e->getMessage()]);
}
