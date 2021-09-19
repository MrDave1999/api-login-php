<?php
namespace App\Jwt;

use App\Models\User;
use Firebase\JWT\JWT;

class UserToken implements IUserToken
{
    public function __construct(private IPayload $payload)
    {

    }

    public function encode(User $user)
    {
        $payload = $this->payload->create($user);
        return JWT::encode($payload, ENV('JWT_SECRET'), ENV('JWT_ALLOWED_ALG'));
    }

    public function decode(string $jwt)
    {
        $payload = JWT::decode($jwt, ENV('JWT_SECRET'), [ENV('JWT_ALLOWED_ALG')]);
        return (array)$payload->data;
    }
}