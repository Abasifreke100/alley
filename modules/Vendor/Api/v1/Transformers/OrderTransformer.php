<?php

namespace Alley\Modules\Vendor\Api\v1\Transformers;

use Alley\Modules\Vendor\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [

            'id'           =>$order->id,
            'product_id'   =>$order->product_id,
            'status'       =>$order->status,
            'first_name'   =>$order->first_name,
            'last_name'    =>$order->last_name,
            'email'        =>$order->email,
            'phone'        =>$order->phone,
            'gender'       =>$order->gender,
            'location'     =>$order->location,

        ];
    }
}
