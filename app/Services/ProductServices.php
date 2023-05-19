<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\Repository\ProductRepository;

class ProductServices
{
    protected $ProductRepositoty;
    public function __construct(ProductRepository $ProductRepositoty)
    {
        $this->ProductRepositoty = $ProductRepositoty;
    }
    public function GetAllProduct(){
        return $this->ProductRepositoty->all();
    }
    public function FindProduct($id){
        return $this->ProductRepositoty->find($id);
    }
    public function CreateProduct(array $data){
        return $this->ProductRepositoty->create($data);
    }
    public function UpdateProduct(int $id  ,array $data){
        return $this->ProductRepositoty->update($id,$data);
    }
    public function DeleteProduct(int $id){
        return $this->ProductRepositoty->delete($id);
    }
    public function GetOrder($id){
        return Order::where('product_id',$id)->first();
    }
}
