<?php

namespace App\Repositories\Repository;

use App\Models\Cart;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function Order(){
        return Order::groupBy('code')->get();
    }
}
