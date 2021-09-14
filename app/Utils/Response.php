<?php
namespace App\Utils;
use App\Constants\StatusCodes;

class Response 
{
    public static function success(string $message, $data = null, $status = StatusCodes::OK)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $status);
    }

    public static function error(string $message, $status = StatusCodes::INTERNAL_ERROR)
    {
        return response()->json([
            'status' => $status,
            'error' => $message
        ], $status);
    }
}