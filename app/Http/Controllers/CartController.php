<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Repositories\Repository\CartRepository;
use App\Services\CartServices;
use Illuminate\Http\Request;

use function App\Helpers\ApiResource;
use function App\Helpers\CreateApiResource;
use function App\Helpers\getApiResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $CartServices;
    public function __construct(CartServices $CartServices){
        $this->CartServices = $CartServices;
    }
    public function index()
    {
        $collection = $this->CartServices->GetAllCart();
        $data = CartResource::collection($collection);
        return apiResource($data,$message = "Nót không found");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_id = json_decode($request->product_id);
        $quantity = json_decode($request->quantity);
        $result = array_map(function ($a, $b) {
            return [
                'product_id' => $a,
                'quantity' => $b
            ];
        }, $product_id, $quantity);
        foreach ($result as $row) {
            $data = $this->CartServices->CreateCart([
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity'],
                'user_id' => 1
            ]);
        }
        $message = "Thêm sản phẩm vào giỏ hàng thành công";
        return createApiResource($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
