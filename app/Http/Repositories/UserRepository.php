<?php 
namespace App\Http\Repositories;
use App\Models\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function get(string $username)
    {
        return $this->model
                        ->select('users.*', 'roles.name AS role_name')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->where('users.username', $username)
                        ->first();
    }

    public function getAll()
    {
        return $this->model
                        ->select('users.*', 'roles.name AS role_name')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->get()
                        ->toArray();
    }

    public function save(array $data)
    {
        $this->model->role_id = 1;
        $this->model->fill($data);
        $this->model->save();
        $this->model->role_name = 'user';
        return $this->model;
    }

    public function update(string $username, array $data)
    {
        $user = $this->model->where('username', $username)->first();
        if(is_null($user))
            return false;
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function delete(string $username)
    {
        return $this->model->where('username', $username)->delete();
    }
}
