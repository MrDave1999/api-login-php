<?php 
namespace App\Http\Middleware;

use App\Constants\StatusCodes;
use App\Utils\Response;
use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, string $role)
    {
        if(!$request->user()->hasRole($role))
            return Response::error("You are not $role!", StatusCodes::UNAUTHORIZED);

        return $next($request);
    }
}