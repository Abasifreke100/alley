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
            'id'            =>$product->id,
            'names'         =>$product->names,
            'category'      =>$product->category,
            'location'      =>$product->location,
            'monthly_price' =>$product->moonthly_price,
            'description'   =>$product->description,
        ];
    }
}
