<?php
namespace App\Jwt;

use App\Models\User;

class Payload 
{
    public static function get()
    {
        $jwt = request()->header('Authorization');
        $payload = explode('.', $jwt)[1];
        return json_decode(base64_decode($payload), true)['data'];
    }

    public static function create(User $user)
    {
        $issuedAt   = new \DateTimeImmutable();
        $expire     = $issuedAt->modify($_ENV['JWT_EXPIRE'])->getTimestamp();
        return [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $_ENV['APP_URL'],                  // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,                           // Expire
            'data' => $user                              // Data User
        ];
    }
}