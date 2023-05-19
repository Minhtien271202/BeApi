<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function App\Helpers\ApiResource;
use function App\Helpers\CreateApiResource;
use function App\Helpers\DestroyApiResource;

class ProductController extends Controller
{
    protected $ProductService;

    public function __construct(ProductServices $ProductService)
    {
        $this->ProductService = $ProductService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductResource::collection($this->ProductService->GetAllProduct());
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
    public function store(ProductRequest $request)
    {
        $formData = $request->validated();
        //xóa dấu ký tự đầu tiên của mỗi từ
        $cleanName = Str::of($request->name)->explode(' ')->map(function ($word) {
            $cleanWord = Str::remove([' ', '.'], $word);
            $firstLetter = Str::substr($cleanWord, 0, 1);
            return Str::ascii($firstLetter);
        })->implode('');
        $randomCode = $cleanName . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $randomCode = Str::upper($randomCode);
        $data = $this->ProductService->CreateProduct([
            'name' => $formData['name'],
            'quantity' => $formData['quantity'],
            'price' => $formData['price'],
            'code' => $randomCode
        ]);
        $message = "Thêm mới sản phẩm thành công";
        return createApiResource($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = DB::table('orders')
            ->where('product_id', $id)
            ->orWhere(function ($query) use ($id) {
                $query->where('product_id', $id)->from('carts');
            })
            ->exists();
        if ($data) {
            $responseData = [
                'success' => false,
                'message' => "Xóa không thành công",
                'status' => 400,
            ];
            return destroyApiResource($responseData);
        }
        $product = Product::where('id', $id)->first();
        if (!$product) {
            $responseData = [
                'success' => false,
                'message' => "Sản phẩm không tồn tại",
                'status' => 404,
            ];
            return destroyApiResource($responseData);
        }
        $data = Product::where('id', $id)->delete();
        $success = true;
        $message = "Xóa thành công";
        $responseData = [
            'success' => $success,
            'message' => $message,
            'status' => 200,
        ];
        return DestroyApiResource($responseData);
    }
}
