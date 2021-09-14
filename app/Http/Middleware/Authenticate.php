<?php

namespace App\Http\Middleware;

use App\Constants\StatusCodes;
use App\Jwt\UserToken;
use App\Utils\Response;
use Firebase\JWT\ExpiredException;
use Closure;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        $jwt = $request->header('authorization');
        if(!$jwt)
            return Response::error('Token is required!');
        try 
        {
            $payload = UserToken::decode($jwt);
            $user = $request->user();
            $user->fill($payload);
            $user->role_id = $payload['role_id'];
            $user->role_name = $payload['role_name'];
        }
        catch(\Exception $e)
        {
            if($e instanceof ExpiredException)
                return Response::error('Token has expired!', StatusCodes::UNAUTHORIZED);
            
            return Response::error('Token is invalid!', StatusCodes::UNAUTHORIZED);
        }
        return $next($request);
    }
}