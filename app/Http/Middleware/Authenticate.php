<?php

namespace App\Http\Middleware;

use App\Constants\StatusCodes;
use App\Jwt\IUserToken;
use App\Utils\IResponse;
use Closure;

class Authenticate
{
    public function __construct(private IUserToken $userToken, private IResponse $response)
    {
        
    }

    public function handle($request, Closure $next)
    {
        $jwt = $request->header('authorization');
        if(!$jwt)
            return $this->response->error('Token is required!', StatusCodes::UNAUTHORIZED);

        $result = $this->userToken->decode($jwt);
        if($result['error'])
            return $this->response->error($result['message'], StatusCodes::UNAUTHORIZED);
        
        $payload = $result['payload'];
        $user = $request->user();
        $user->id        = $payload['user_id'];
        $user->username  = $payload['username'];
        $user->role_id   = $payload['role_id'];
        $user->role_name = $payload['role_name'];

        return $next($request);
    }
}