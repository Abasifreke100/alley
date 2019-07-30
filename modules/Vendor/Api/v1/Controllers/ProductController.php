<?php

namespace Alley\Modules\Vendor\Api\v1\Controllers;

use Alley\Modules\Vendor\Api\v1\Repositories\ProductRepository;
use Alley\Modules\Vendor\Api\v1\Requests\UploadProductRequest;
use Alley\Modules\Vendor\Api\v1\Requests\UpdateProductRequest;
use Alley\Modules\Vendor\Api\v1\Transformers\ProductTransformer;
use Alley\Modules\BaseController;

class ProductController extends BaseController
{
    private $productRepository;

    private $productTransformer;

    public function __construct(ProductRepository $productRepository, ProductTransformer $productTransformer)
    {
        $this->productRepository=$productRepository;

        $this->productTransformer=$productTransformer;
    }

    public function index()
    {
        $product = $this->productRepository->index();
        return $this->success($product,$this->productTransformer);
    }

    public function getById($id)
    {
        $product = $this->productRepository->getById($id);
        return $this->success($product,$this->productTransformer);
    }

    public function upload(UploadProductRequest $request)
    {
        $product = $this->productRepository->upload($request->all());

        if ($product){
            return $product;
        }
        return $this->error('Product Upload Fail !!');
    }

    public function update(UpdateProductRequest $request,$id)
    {
        $product = $this->productRepository->update($request->all(),$id);
        if ($product){
            return $product;
        }
        return $this->error('Product Update Fail');
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}


