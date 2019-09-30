<?php
namespace Alley\Modules\Account\Api\v1\Controllers;

use Alley\Modules\Account\Api\v1\Repositories\UserRepository;
use Alley\Modules\Account\Api\v1\Requests\AdminLoginRequest;
use Alley\Modules\Account\Api\v1\Requests\VendorRegistrationRequest;
use Alley\Modules\Account\Api\v1\Requests\VendorUpdateRequest;
use Alley\Modules\Account\Api\v1\Requests\VendorLoginRequest;
use Alley\Modules\Account\Api\v1\Transformers\UserTransformer;
use Alley\Modules\BaseController;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    private $userRepository;
    private $userTransformer;

    public function __construct(UserRepository $userRepository,UserTransformer $userTransformer)
    {
        $this->userRepository=$userRepository;
        $this->userTransformer=$userTransformer;
    }

    public function registerVendor(VendorRegistrationRequest $request)
    {
        $user = $this->userRepository->registerVendor($request->all());

        if ($user){
            return $user;
        }
        return Response()->json('Unable To RegisterVendor!');
    }

    public function vendorLogin(VendorLoginRequest $request)
    {
        return $this->userRepository->vendorLogin($request->all());
    }

    public function adminLogin(AdminLoginRequest $request)
    {
        return $this->userRepository->adminLogin($request->all());
    }

    public function getAllVendor()
    {
        $user = $this->userRepository->getAllVendor();
        return $this->success($user,$this->userTransformer);
    }

    public function getVendorById($id)
    {
        $user = $this->userRepository->getVendorById($id);
        return $this->success($user,$this->userTransformer);
    }


    public function updateVendor(VendorUpdateRequest $request, $id)
    {
        $user =  $this->userRepository->updateVendor($request->all(),$id);
        if ($user){
            return $user;
        }
        return response()->json('Unable To Update User');
    }

    public function deleteVendor($id)
    {
        return $this->userRepository->deleteVendor($id);
    }
}
