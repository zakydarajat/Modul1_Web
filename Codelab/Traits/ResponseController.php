<?php

namespace Traits;

trait ResponseFormatter
{
    public function responseFormatter($code, $message, $data = null)
    {
        return [
            "code" => $code,
            "message" => $message,
            "data" => $data
        ];
    }
}
