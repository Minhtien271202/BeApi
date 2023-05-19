<?php

namespace App\Repositories\Repository;

use App\Models\Cart;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }
}
