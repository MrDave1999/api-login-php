<?php
namespace App\Http\Controllers;

use App\Http\BusinessLayer\IAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private IAuth $auth)
    {
        
    }

    public function login(Request $request)
    {
        return $this->auth->login($request->all());
    }
}
