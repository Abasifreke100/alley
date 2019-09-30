<?php

namespace Alley\Modules\Vendor\Api\v1\Repositories;

use Alley\Events\NewProductOrder;
use Alley\Modules\Vendor\Models\Order;
use Alley\Modules\Vendor\Models\Product;
use Alley\Modules\BaseRepository;

class OrderRepository extends BaseRepository
{
    private $order;

    private $product;

    public function __construct(Order $order,Product $product)
    {
        $this->order=$order;

        $this->product=$product;
    }

    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrderById($id)
    {
        $order = Order::where('id',$id)->first();

        return $order;
    }

    public function makeOrder(array $request,$id)
    {
        $data = (object) $request;

        $product =$this->product->where('id',$id)->first();
        $order   = Order::create([
           'id'         =>$this->generateUuid(),
           'product_id' =>$product->id,
           'status'     =>'pending',
            'first_name'=>$data->first_name,
            'last_name' =>$data->last_name,
            'email'     =>$data->email,
            'phone'     =>$data->phone,
            'gender'    =>$data->gender,
            'location'  =>$data->location,
        ]);

        if ($order){
            event(new NewProductOrder($order));
            return $order;
        }
        return response()->json(['status'=>200,],['message'=>'Product Successfully Ordered !!']);
    }


}
