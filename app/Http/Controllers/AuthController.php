<?php
namespace App\Http\Controllers;

use App\Http\BusinessLayer\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private Auth $auth)
    {
        
    }

    public function login(Request $request)
    {
        return $this->auth->login($request->all());
    }
}
