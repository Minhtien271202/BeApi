<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên sản phẩm không được để trống",
            'quantity.required' => "Số lượng sản phẩm không được để trống",
            'price.required' => "Giá sản phẩm không được để trống"
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
            ], 422));
        }
        parent::failedValidation($validator);
    }
}
