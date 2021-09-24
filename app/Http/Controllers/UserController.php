<?php

namespace App\Http\Controllers;

use App\Http\BusinessLayer\IUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private IUser $user)
    {

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

    public function get(Request $request)
    {
        return $this->user->get($request->user()->username);
    }

    public function edit(Request $request)
    {
        return $this->user->edit($request->user()->username, $request->all());
    }

    public function update(Request $request, string $name)
    {
        return $this->user->edit($name, $request->all());
    }

    public function delete(Request $request)
    {
        return $this->user->delete($request->user()->username);
    }

    public function destroy(string $name)
    {
        return $this->user->delete($name);
    }
}
