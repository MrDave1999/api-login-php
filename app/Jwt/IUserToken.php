<?php 
namespace App\Jwt;

use App\Models\User;

interface IUserToken
{
    function encode(User $user);
    function decode(string $jwt);
}