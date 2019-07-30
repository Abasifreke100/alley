<?php

namespace Alley\Modules\Vendor\Api\v1\Transformers;

use League\Fractal\TransformerAbstract;
use Alley\Modules\Vendor\Models\Vendor;

class VendorTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Vendor $vendor)
    {
        return [
            'id'            =>$vendor->id,
            'vendor_name'   =>$vendor->vendor_name,
            'email'         =>$vendor->email,
            'phone_number'  =>$vendor->phone_number,
            'location'      =>$vendor->location,

        ];
    }
}
