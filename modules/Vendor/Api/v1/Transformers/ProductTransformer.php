<?php
namespace Alley\Modules\Vendor\Api\v1\Transformers;

use Alley\Modules\Vendor\Models\Product;
use League\Fractal\TransformerAbstract;


class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id'         =>$product->id,
            'description'=>$product->description,
            'category'   =>$product->category,
            'street'     =>$product->street,
            'city'       =>$product->city,
            'state'      =>$product->state,
            'feature'    =>$product->feature,
            'price'      =>$product->price,
            'filename'   =>$this->imageUploader($product),

        ];
    }

    private function imageUploader($product)
    {
        $images = $product->with('productImage')->first();

        foreach ($images->productImage as $image)
        {
//            dd($image->filename);
            return $image->filename;
        }

    }
}
