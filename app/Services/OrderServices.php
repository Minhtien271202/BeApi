<?php

namespace App\Services;

use App\Repositories\Repository\OrderRepository;

class OrderServices
{
    protected $OrderRepository;
    public function __construct(OrderRepository $OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;
    }
    public function GetAllOrder(){
        return $this->OrderRepository->all();
    }
    public function FindOrder($id){
        return $this->OrderRepository->find($id);
    }
    public function CreateOrder(array $data){
        return $this->OrderRepository->create($data);
    }
    public function UpdateOrder(int $id  ,array $data){
        return $this->OrderRepository->update($id,$data);
    }
    public function DeleteOrder(int $id){
        return $this->OrderRepository->delete($id);
    }
    public function GroupBy(){
        return $this->OrderRepository->Order();
    }
}
