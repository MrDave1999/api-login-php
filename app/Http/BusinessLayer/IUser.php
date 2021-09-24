<?php
namespace App\Http\BusinessLayer;

interface IUser
{
    function index();
    function create(array $data);
    function show(string $name);
    function get(string $username);
    function edit(string $username, array $data);
    function delete(string $username);
}