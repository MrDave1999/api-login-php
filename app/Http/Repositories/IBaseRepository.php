<?php
namespace App\Http\Repositories;

interface IBaseRepository
{
    function isExists(string $attribute, $value);
}