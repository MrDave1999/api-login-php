<?php
namespace App\Http\Repositories;

interface IUserRepository extends IBaseRepository
{
    function get(string $username);
    function getAll();
    function save(array $data);
    function update(string $username, array $data);
    function delete(string $username);
}