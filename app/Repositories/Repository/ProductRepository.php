<?php

namespace App\Repositories\Repository;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\interface\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
}
