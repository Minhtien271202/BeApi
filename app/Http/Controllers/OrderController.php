<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function App\Helpers\ApiResource;

class OrderController extends Controller
{
    protected $OrderServices;

    public function __construct(OrderServices $OrderServices)
    {
        $this->OrderServices = $OrderServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OrderResource::collection($this->OrderServices->GroupBy());
        return apiResource($data);
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
        $result = array_map(function ($a, $b, $c) {
            return [
                'product_id' => $a,
                'quantity' => $b,
                'total' => $c
            ];
        }, json_decode($request->product_id), json_decode($request->quantity), json_decode($request->total));
        //check mã đơn hàng
        $arrOrder = Order::pluck('code')->toArray();
        $randomOrderCode = null;
        do {
            $code = "ORDER-" . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT); // Tạo mã đơn hàng ngẫu nhiên
        } while (in_array($code, $arrOrder));
        foreach ($result as $row) {
            $data = $this->OrderServices->CreateOrder([
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity'],
                'total' => $row['total'],
                'user_id' => 1,
                'code' => $code
            ]);
        }
        return response()->json(['status' => 200, 'success' => "Đặt hàng thành công"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {
        $order = Order::where('code', $id)->get();
        return response()->json(['data' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
