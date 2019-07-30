<?php

namespace Alley\Modules\Admin\Api\v1\Controllers;

use Alley\Modules\Admin\Api\v1\Repositories\AdminRepository;
use Alley\Modules\Admin\Api\v1\Requests\AdminRegistrationRequest;
use Alley\Modules\Admin\Api\v1\Requests\AdminUpdateRequest;
use Alley\Modules\Admin\Api\v1\Requests\AdminLoginRequest;
use Alley\Modules\Admin\Api\v1\Transformers\AdminTransformer;
use Alley\Modules\BaseController;

class AdminController extends BaseController
{
    private $adminRepository;

    private $adminTransformer;

    public function __construct(AdminRepository $adminRepository,AdminTransformer $adminTransformer)
    {
        $this->adminRepository=$adminRepository;

        $this->adminTransformer=$adminTransformer;
    }

    public function index()
    {
        $admin = $this->adminRepository->index();

        return $this->success($admin,$this->adminTransformer);
    }

    public function getById($id)
    {
        $admin = $this->adminRepository->getById($id);

        return $this->success($admin,$this->adminTransformer);
    }

    public function register(AdminRegistrationRequest $request)
    {
        $admin = $this->adminRepository->register($request->all());

        if ($admin)
            return $request;
        return $this->error('Admin Registration Fail');
    }


    public function login(AdminLoginRequest $request)
    {
        return $this->adminRepository->login($request->all());
    }

    public function update(AdminUpdateRequest $request,$id)
    {
        $admin = $this->adminRepository->update($request->all(),$id);

        if ($admin)
            return $request;
        return $this->error('Admin Update Fail !!');
    }

    public function delete($id)
    {
        return $this->adminRepository->delete($id);
    }
}
