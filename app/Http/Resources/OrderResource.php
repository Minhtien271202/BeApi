<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $collection = Order::where('code', $this->code)->selectRaw('orders.*, sum(total) as total')->first(); // Lấy collection của của order
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'code' => $this->code,
            'count' => count(Order::where('code', $this->code)->get()),
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'total' => number_format($collection->total),
            'user_name' => $this->user->name,
            'data' => Order::where('code', $this->code)->get()->map(function ($item) {
                // Chỉnh sửa giá trị trả về của mỗi phần tử trong 'data'
                return [
                    'id' => $item->id,
                    'name' => $item->product->name,
                    'price' => number_format($item->product->price),
                    'total' => number_format($item->total),
                    'quantity' => $item->quantity,
                    'code' => $item->code,
                    'product_code' => $item->product->code,
                    // Thêm các thuộc tính khác của phần tử tại đây
                ];
            }),
        ];
    }
}
