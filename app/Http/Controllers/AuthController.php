<?php
namespace App\Http\Controllers;

use App\Http\BusinessLayer\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        return $this->auth->login($request->all());
    }
}