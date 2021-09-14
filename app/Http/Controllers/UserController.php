<?php

namespace App\Http\Controllers;

use App\Http\BusinessLayer\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->index();
    }

    public function create(Request $request)
    {
        return $this->user->create($request->all());
    }

    public function show(string $name)
    {
        return $this->user->show($name);
    }

    public function get()
    {
        return $this->user->get();
    }
}
