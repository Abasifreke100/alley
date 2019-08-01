<?php

namespace Alley\Modules\Account\Api\v1\Transformers;

use Alley\Modules\Account\Models\Order;
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

            'order_id'     =>$order->order_id,
            'user_id'      =>$order->user_id,
            'product_id'   =>$order->product_id,
            'status'       =>$order->status,
        ];
    }
}
