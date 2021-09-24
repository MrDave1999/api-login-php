<?php 
namespace App\Http\BusinessLayer;

use App\Http\Repositories\IUserRepository;
use App\Jwt\IUserToken;
use App\Utils\IResponse;

class Auth implements IAuth
{
    public function __construct(
        private IUserRepository $userRepository, 
        private IResponse $response,
        private IUserToken $userToken)
    {
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