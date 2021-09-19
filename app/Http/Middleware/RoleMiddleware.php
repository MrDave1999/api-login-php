<?php 
namespace App\Http\Middleware;

use App\Constants\StatusCodes;
use App\Utils\IResponse;
use Closure;

class RoleMiddleware
{
    public function __construct(private IResponse $response)
    {

    }

    public function handle($request, Closure $next, string $role)
    {
        if(!$request->user()->hasRole($role))
            return $this->response->error("You are not $role!", StatusCodes::UNAUTHORIZED);

        return $next($request);
    }
}