<?php

namespace App\Http\Middleware;

use App\Constants\StatusCodes;
use App\Jwt\IUserToken;
use App\Utils\IResponse;
use Firebase\JWT\ExpiredException;
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
            return $this->response->error('Token is required!');
        try 
        {
            $payload = $this->userToken->decode($jwt);
            $user = $request->user();
            $user->id        = $payload['user_id'];
            $user->username  = $payload['username'];
            $user->role_id   = $payload['role_id'];
            $user->role_name = $payload['role_name'];
        }
        catch(\Exception $e)
        {
            if($e instanceof ExpiredException)
                return $this->response->error('Token has expired!', StatusCodes::UNAUTHORIZED);
            
            return $this->response->error('Token is invalid!', StatusCodes::UNAUTHORIZED);
        }
        return $next($request);
    }
}