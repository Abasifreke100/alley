<?php

namespace Alley\Modules\Account\Api\v1\Controllers;

use Alley\Modules\Account\Api\v1\Repositories\OrderRepository;
use Alley\Modules\Account\Api\v1\Transformers\OrderTransformer;
use Alley\Modules\BaseController;
use Dingo\Api\Http\Request;

class OrderController extends BaseController
{
    private $orderRepository;
    private $orderTransformer;

    public function __construct(OrderRepository $orderRepository,OrderTransformer $orderTransformer)
    {
        $this->orderRepository=$orderRepository;
        $this->orderTransformer=$orderTransformer;
    }

    public function index()
    {
        $order = $this->orderRepository->index();

        return $this->success($order,$this->orderTransformer);
    }

    public function getById($id)
    {
        $order = $this->orderRepository->getById($id);

        return $order;
    }
    
}
