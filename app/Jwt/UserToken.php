<?php
namespace App\Jwt;

use App\Models\User;
use Firebase\JWT\JWT;

class UserToken
{
    public static function encode(User $user)
    {
        $payload = Payload::create($user);
        return JWT::encode($payload, $_ENV['JWT_SECRET'], $_ENV['JWT_ALLOWED_ALG']);
    }

    public static function decode(string $jwt)
    {
        $payload = JWT::decode($jwt, $_ENV['JWT_SECRET'], [$_ENV['JWT_ALLOWED_ALG']]);
        return (array)$payload->data;
    }
}