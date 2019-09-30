<?php

namespace Alley\Modules\Vendor\Api\v1\Controllers;

use Alley\Modules\Vendor\Api\v1\Repositories\OrderRepository;
use Alley\Modules\Vendor\Api\v1\Transformers\OrderTransformer;
use Alley\Modules\BaseController;
use Alley\Modules\Vendor\Api\v1\Requests\OrderRequest;


class OrderController extends BaseController
{
    private $orderRepository;
    private $orderTransformer;

    public function __construct(OrderRepository $orderRepository,OrderTransformer $orderTransformer)
    {
        $this->orderRepository=$orderRepository;
        $this->orderTransformer=$orderTransformer;
    }

    public function getAllOrders()
    {
        $order = $this->orderRepository->getAllOrders();

        return $this->success($order,$this->orderTransformer);
    }

    public function getOrderById($id)
    {
        $order = $this->orderRepository->getOrderById($id);

        return $order;
    }

    public function makeOrder(OrderRequest $request,$id)
    {
        $order = $this->orderRepository->makeOrder($request->all(),$id);

        if ($order){
            return $order;
        }
        return Response()->json('Unable To Make Order');
    }


}
