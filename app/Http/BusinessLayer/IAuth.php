<?php 
namespace App\Http\BusinessLayer;

interface IAuth
{
    function login(array $data);
}