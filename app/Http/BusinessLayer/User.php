<?php 
namespace App\Http\BusinessLayer;

use App\Constants\StatusCodes;
use App\Http\Repositories\UserRepository;
use App\Jwt\IUserToken;
use App\Utils\Response;

class User 
{
    public function __construct(
        private UserRepository $userRepository, 
        private IUserToken $userToken)
    {
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
        $token = $this->userToken->encode($user);
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

    public function get(string $username)
    {
        $user = $this->userRepository->get($username);
       return Response::success('Information successfully retrieved!', $user);
    }

    public function edit(string $username, array $data)
    {
        if(isset($data['username']) && $this->userRepository->isExists('username', $data['username']))
            return Response::error('The ' . $data['username'] . ' user already exists!');

        if(isset($data['password']))
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $user = $this->userRepository->update($username, $data);
        if(!$user)
            return Response::error('The ' . $username . ' user is incorrect!');

        return Response::success('The information was successfully updated!', $user);
    }

    public function delete(string $username)
    {
        if($this->userRepository->delete($username) === 0)
            return Response::error('The ' . $username . ' user does not exist!');
        
        return Response::success('The account was successfully deleted!');
    }
}
