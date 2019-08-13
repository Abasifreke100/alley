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
        $order = Order::where('id',$id)->first();

        return $order;
    }

    public function order(array $request,$id)
    {
        $data = (object) $request;

        $product       =$this->product->where('id',$id)->first();
        $order         = Order::create([
           'id'        =>$this->generateUuid(),
           'user_id'   =>$data->id,
           'product_id'=>$product->id,
           'status'    =>'pending'
        ]);

        if ($order){
            return $order;
        }
        return response()->json(['status'=>200],['message'=>'Product Successfully Ordered !!']);
    }

    public function delete($id)
    {
        $order = $this->order->findOrFail($id);

        $order->delete();
        return response()->json(['status'=>200],['message'=>'Order Deleted Successfully']);
    }


}
