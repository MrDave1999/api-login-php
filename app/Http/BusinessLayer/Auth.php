<?php 
namespace App\Http\BusinessLayer;

use App\Http\Repositories\UserRepository;
use App\Jwt\IUserToken;
use App\Utils\IResponse;

class Auth 
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository, 
        private IResponse $response,
        private IUserToken $userToken)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $data)
    {
        $user = $this->userRepository->get($data['username']);
        if(is_null($user) || !password_verify($data['password'], $user['password']))
            return $this->response->error('The username or password is incorrect!');
        $user->token = $this->userToken->encode($user);
        
        return $this->response->success('You have successfully logged in!', $user);
    }
}