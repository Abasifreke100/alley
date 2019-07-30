<?php

namespace Alley\Modules\Account\Api\v1\Controllers;

use Alley\Modules\Account\Api\v1\Repositories\UserRepository;
use Alley\Modules\Account\Api\v1\Requests\UserRegisterRequest;
use Alley\Modules\Account\Api\v1\Requests\UserUpdateRequest;
use Alley\Modules\Account\Api\v1\Requests\UserLoginRequest;
use Alley\Modules\Account\Api\v1\Transformers\UserTransformer;
use Alley\Modules\BaseController;

class UserController extends BaseController
{

    private $userRepository;

    private $userTransformer;

    public function __construct(UserRepository $userRepository,UserTransformer $userTransformer)
    {
        $this->userRepository=$userRepository;
        $this->userTransformer=$userTransformer;
    }

    public function index()
    {
        $user = $this->userRepository->index();
        return $this->success($user, $this->userTransformer);
    }

    public function getById($id)
    {
        $user = $this->userRepository->getById($id);
        return $this->success($user, $this->userTransformer);
    }


    public function register(UserRegisterRequest $request)
    {
        $user = $this->userRepository->register($request->all());

        if ($user){
            return $user;
        }
        return $this->error('UserRegistration Fail !!');
    }


    public function login(UserLoginRequest $request)
    {
        return $this->userRepository->login($request->all());
    }


    public function update(UserUpdateRequest $request,$id)
    {
        $user = $this->userRepository->update($request->all(),$id);

        if ($user){
            return $user;
        }
        return $this->error('UserUpdate Fail !!');
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

}
