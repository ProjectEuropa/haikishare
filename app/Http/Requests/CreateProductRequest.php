<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//商品追加のバリデーション
class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    //商品追加のバリデーションルール
    {
        return [
            'name' => 'required|max:20',
            'price' => 'required|regex:/^([0-9]{1,5})$/',
            'discount' => 'required|regex:/^([0-9]{1,5})$/',
            'pic1' => 'required|image',
            'year' => 'required|regex:/^([0-9]{4})$/',
            'month' => 'required|regex:/^([0-9]{1,2})$/',
            'day' => 'required|regex:/^([0-9]{1,2})$/',
            'hour' => 'nullable|regex:/^([0-9]{1,2})$/',
            'category_id' => 'required',
        ];
    }
    // public function messages() {
    //   return [
    //   "required" => "必須項目です。",
    //   ];
    // }
}
