<?php 
namespace App\Http\BusinessLayer;

use App\Constants\StatusCodes;
use App\Http\Repositories\UserRepository;
use App\Jwt\UserToken;
use App\Utils\Response;
use Illuminate\Support\Facades\Auth;

class User 
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return Response::success('The list of users was successfully obtained!', $users);
    }

    public function create(array $data)
    {
        if($this->userRepository->isExists('username', $data['username']))
            return Response::error('The user name '. $data['username'] . ' already exists!');
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = $this->userRepository->save($data);
        $token = UserToken::encode($user);
        $data = ['user_id' => $user->id, 'token' => $token];

        return Response::success('You have successfully registered!', $data, StatusCodes::CREATED);
    }

    public function show(string $name)
    {
        $user = $this->userRepository->get($name);
        if(is_null($user))
            return Response::error('The user is incorrect!');

        return Response::success('User information successfully obtained!', $user);
    }

    public function get()
    {
       return Response::success('Information successfully retrieved!', Auth::user());
    }
}