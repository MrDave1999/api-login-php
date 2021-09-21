<?php
namespace App\Jwt;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

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
        try 
        {
            $payload = JWT::decode($jwt, ENV('JWT_SECRET'), [ENV('JWT_ALLOWED_ALG')]);
            return ['error' => false, 'payload' => (array)$payload->sub];
        }
        catch(\Exception $e)
        {
            if($e instanceof ExpiredException)
                return ['error' => true, 'message' => 'Token has expired!'];
            
            return ['error' => true, 'message' => 'Token is invalid!'];
        }
    }
}