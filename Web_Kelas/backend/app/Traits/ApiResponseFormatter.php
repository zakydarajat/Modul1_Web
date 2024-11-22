<?php

namespace app\Traits;

// Trait untuk format respons API
trait ApiResponseFormatter
{
    /**
     * Membuat format respons API
     *
     * @param int $code HTTP status code
     * @param string $message Pesan respons
     * @param mixed $data Data yang akan dikirimkan (opsional)
     * @param array $errors Daftar error jika ada (opsional)
     * @return string JSON formatted response
     */
    public function apiResponse($code = 200, $message = "success", $data = [], $errors = [])
    {
        // Struktur respons API
        $response = [
            "code" => $code,
            "message" => $message,
        ];

        // Tambahkan data jika ada
        if (!empty($data)) {
            $response["data"] = $data;
        }

        // Tambahkan error jika ada
        if (!empty($errors)) {
            $response["errors"] = $errors;
        }

        // Set kode status HTTP
        http_response_code($code);

        // Mengembalikan respons dalam format JSON
        return json_encode($response);
    }
}
