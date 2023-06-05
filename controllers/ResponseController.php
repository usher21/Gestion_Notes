<?php

namespace Controller;

class ResponseController
{
    public static function generate(int $statusCode, $message, $data)
    {
        echo json_encode([
            "statusCode" => $statusCode,
            "message" => $message,
            "data" => $data
        ]);
    }
}

