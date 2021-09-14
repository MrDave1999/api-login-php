<?php 
namespace App\Http\BusinessLayer;

use App\Http\Repositories\UserRepository;
use App\Jwt\UserToken;
use App\Utils\Response;

class Auth 
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $data)
    {
        $user = $this->userRepository->get($data['username']);
        if(is_null($user) || !password_verify($data['password'], $user['password']))
            return Response::error('The username or password is incorrect!');
        $user->token = UserToken::encode($user);
        
        return Response::success('You have successfully logged in!', $user);
    }
}