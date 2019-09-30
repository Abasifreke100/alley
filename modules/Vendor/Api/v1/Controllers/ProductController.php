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

    public function getAllProduct()
    {
        $product = $this->productRepository->getAllProduct();
        return $this->success($product,$this->productTransformer);
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->getProductById($id);
        return $this->success($product,$this->productTransformer);
    }

    public function createProduct(UploadProductRequest $request)
    {
        $product = $this->productRepository->createProduct($request->all());
        if ($product){
            return $this->transform($product, $this->productTransformer);
        }

    }


    public function updateProduct(UpdateProductRequest $request,$id)
    {
        $product = $this->productRepository->updateProduct($request->all(),$id);
        if ($product){
            return $product;
        }
        return $this->error('Product Update Fail');
    }


    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}


