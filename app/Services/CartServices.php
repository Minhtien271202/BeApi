<?php

namespace App\Services;

use App\Repositories\Repository\CartRepository;

class CartServices
{
    protected $CartRepository;
    public function __construct(CartRepository $CartReposiroty)
    {
        $this->CartRepository = $CartReposiroty;
    }
    public function GetAllCart(){
        return $this->CartRepository->all();
    }
    public function FindCart($id){
        return $this->CartRepository->find($id);
    }
    public function CreateCart(array $data){
        return $this->CartRepository->create($data);
    }
    public function UpdateCart(int $id  ,array $data){
        return $this->CartRepository->update($id,$data);
    }
    public function DeleteCart(int $id){
        return $this->CartRepository->delete($id);
    }
}
