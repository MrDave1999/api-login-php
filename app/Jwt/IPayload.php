<?php
namespace App\Jwt;

use App\Models\User;

interface IPayload
{
    function get();
    function create(User $user);
}