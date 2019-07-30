<?php

namespace Alley\Modules\Vendor\Api\v1\Controllers;

use Alley\Modules\Vendor\Api\v1\Repositories\VendorRepository;
use Alley\Modules\Vendor\Api\v1\Requests\VendorRegisterRequest;
use Alley\Modules\Vendor\Api\v1\Requests\VendorUpdateRequest;
use Alley\Modules\Vendor\Api\v1\Requests\VendorLoginRequest;
use Alley\Modules\Vendor\Api\v1\Transformers\VendorTransformer;
use Alley\Modules\BaseController;

class VendorController extends BaseController
{
    private $vendorRepository;

    private $vendorTransformer;

    public function __construct(VendorRepository $vendorRepository, VendorTransformer $vendorTransformer)
    {

        $this->vendorRepository=$vendorRepository;

        $this->vendorTransformer=$vendorTransformer;
    }

    public function index()
    {
        $vendor = $this->vendorRepository->index();
        return $this->success($vendor,$this->vendorTransformer);
    }

    public function getById($id)
    {
        $vendor = $this->vendorRepository->getById($id);
        return $this->success($vendor,$this->vendorTransformer);
    }

    public function register(VendorRegisterRequest $request)
    {
        $vendor = $this->vendorRepository->register($request->all());

        if ($vendor){
            return $vendor;
        }
        return $this->error('Vendor Registration Fail');
    }

    public function login(VendorLoginRequest $request)
    {
        return $this->vendorRepository->login($request->all());
    }

    public function update( VendorUpdateRequest $request, $id)
    {
        $vendor = $this->vendorRepository->update($request->all(),$id);

        if ($vendor){
            return $vendor;
        }
        return $this->error('Vendor Update Fail');
    }

    public function delete($id)
    {
        return $this->vendorRepository->delete($id);
    }

}
