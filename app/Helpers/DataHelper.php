<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

if (!function_exists('apiResource')) {
    /**
     * @param string $data
     * @param string $message
     * @param int $status
     * @param string $Httpstatus
     */
    // lưu ý nho nhỏ là các dữ liệu trả về từ controller phải sắp xếp đúng thứ tự
    function apiResource($data = [], $messages = '', $status = 200, $Httpstatus = 200, $headers = [], $options = 0)
    {
        return response()->json([
            'status' => $status,
            'message' => $messages,
            'data' => $data,
        ], $Httpstatus, $headers, $options);
    }
}
if (!function_exists('createApiResource')) {
    /**
     * @param string $message
     * @param int $status
     */
    function createApiResource($message, $status = 200)
    {
        try {
            // Trả về dữ liệu API thành công
            return response()->json([
                'message' => $message,
                'status' => $status,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về trạng thái
            return response()->json([
                'error' => "Thêm mới không thành công",
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
if (!function_exists('destroyApiResource')) {
    function destroyApiResource($responseData)
    {
        try {
            if ($responseData['success'] === true) {
                return response()->json([
                    'status' => $responseData['status'],
                    'message' => $responseData['message'],
                ],Response::HTTP_OK);
                // Trả về true nếu xóa thành công
            } else {
                return response()->json([
                    'status' => $responseData['status'],
                    'message' => $responseData['message'],
                ],Response::HTTP_NOT_FOUND);
                // return false;  Trả về false nếu sản phẩm tồn tại trong bảng khác
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Lỗi máy chủ nội bộ",
            ],Response::HTTP_INTERNAL_SERVER_ERROR); // Trả về false nếu xảy ra lỗi
        }
    }
}
