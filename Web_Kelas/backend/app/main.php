<?php
header("Access-Control-Allow-Origin: *"); // Izinkan semua origin
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Autoloading atau manual include untuk semua file yang diperlukan
require_once __DIR__ . '/Config/DatabaseConfiguration.php';
require_once __DIR__ . '/Models/Product.php';
require_once __DIR__ . '/Controller/ProductController.php';
require_once __DIR__ . '/Routes/ProductRoutes.php';
require_once __DIR__ . '/Traits/ApiResponseFormatter.php';

// Header untuk memastikan respons dalam format JSON
header('Content-Type: application/json');

try {
    // Routing berdasarkan query string
    if (isset($_GET['module'])) {
        $module = $_GET['module'];

        switch ($module) {
            case 'product':
                require_once __DIR__ . '/Routes/ProductRoutes.php';
                break;

            // Tambahkan module lain jika diperlukan
            default:
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Module not found'
                ]);
                break;
        }
    } else {
        // Tampilkan pesan default jika parameter module tidak ada
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'No module specified'
        ]);
    }
} catch (Exception $e) {
    // Penanganan error global
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'An unexpected error occurred',
        'error' => $e->getMessage()
    ]);
}
