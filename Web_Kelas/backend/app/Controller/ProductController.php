<?php

require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Traits/ApiResponseFormatter.php';

use app\Traits\ApiResponseFormatter;

class ProductController {
    use ApiResponseFormatter;

    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    /**
     * Retrieve all products
     */
    public function getProducts() {
        try {
            $data = $this->product->getAllProducts();
            echo $this->apiResponse(200, "Products retrieved successfully", $data);
        } catch (Exception $e) {
            echo $this->apiResponse(500, "Failed to retrieve products", null, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Create a new product
     */
    public function createProduct() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$this->validateProductData($data)) {
                echo $this->apiResponse(400, "Invalid product data", null);
                return;
            }

            $result = $this->product->createProduct($data['name'], $data['description'], $data['image_url']);
            echo $this->apiResponse(
                $result ? 201 : 500,
                $result ? "Product created successfully" : "Failed to create product",
                null
            );
        } catch (Exception $e) {
            echo $this->apiResponse(500, "An error occurred while creating the product", null, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update a product by ID
     */
    public function updateProduct($id) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$this->validateProductData($data)) {
                echo $this->apiResponse(400, "Invalid product data", null);
                return;
            }

            $result = $this->product->updateProduct($id, $data['name'], $data['description'], $data['image_url']);
            echo $this->apiResponse(
                $result ? 200 : 404,
                $result ? "Product updated successfully" : "Product not found or failed to update",
                null
            );
        } catch (Exception $e) {
            echo $this->apiResponse(500, "An error occurred while updating the product", null, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Delete a product by ID
     */
    public function deleteProduct($id) {
        try {
            $result = $this->product->deleteProduct($id);
            echo $this->apiResponse(
                $result ? 200 : 404,
                $result ? "Product deleted successfully" : "Product not found or failed to delete",
                null
            );
        } catch (Exception $e) {
            echo $this->apiResponse(500, "An error occurred while deleting the product", null, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Get a single product by ID
     */
    public function getProductById($id) {
        try {
            $data = $this->product->getProductById($id);
            if ($data) {
                echo $this->apiResponse(200, "Product retrieved successfully", $data);
            } else {
                echo $this->apiResponse(404, "Product not found", null);
            }
        } catch (Exception $e) {
            echo $this->apiResponse(500, "An error occurred while retrieving the product", null, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Validate product data
     */
    private function validateProductData($data) {
        return isset($data['name'], $data['description'], $data['image_url']) &&
               !empty($data['name']) &&
               !empty($data['description']) &&
               !empty($data['image_url']);
    }
}
