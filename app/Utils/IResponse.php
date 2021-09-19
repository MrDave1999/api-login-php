<?php
namespace App\Utils;
use App\Constants\StatusCodes;

interface IResponse
{
    function success(string $message, $data = null, $status = StatusCodes::OK);
    function error(string $message, $status = StatusCodes::INTERNAL_ERROR);
}