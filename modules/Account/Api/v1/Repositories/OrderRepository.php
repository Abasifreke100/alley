<?php

namespace Alley\Modules\Account\Api\v1\Repositories;

use Alley\Modules\Account\Models\Order;
use Alley\Modules\BaseRepository;
use Alley\Modules\Vendor\Models\Product;

class OrderRepository extends BaseRepository
{
    private $order;

    private $product;

    public function __construct(Order $order,Product $product)
    {
        $this->order=$order;

        $this->product=$product;
    }

    public function index()
    {
        return Order::all();
    }

    public function getById($id)
    {
        $order = Order::where('id',$id);

        return $order;
    }

    public function order(array $request,$id)
    {
        $data = (object) $request;

        $product =$this->product->where('id',$id);
        $order = Order::create([
           'order_id'=>$this->generateUuid(),
           'user_id'=>$data->id,
           'product_id'=>$product->id,
           'status'=>'pending'
        ]);

        if ($order){
            return $order;
        }
        return response()->json(['status'=>200],['message'=>'Product Successfully Ordered !!']);

    }





    //    public function order(array $request, $id){
//        $data=(object)$request;
//        $product_id=$this->product->where('id', $id);
//        $order=Order::Create([
//            "order_id"=>$this->generateUuid(),
//            "user_id"=>$data->id,
//            "product_id"=>$product_id->id,
//            "status"=>"pending",
//        ]);
//
//    }
}
