<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//商品情報変更時のバリデーション
class UpdateProductRequest extends FormRequest
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
     //ユーザー情報変更時のバリデーションルール
     {
         return [
             'name' => 'required|max:20',
             'price' => 'required|regex:/^([0-9]{1,5})$/',
             'discount' => 'required|regex:/^([0-9]{1,5})$/',
             'pic1' => 'image',
             'year' => 'required|regex:/^([0-9]{4})$/',
             'month' => 'required|regex:/^([0-9]{1,2})$/',
             'day' => 'required|regex:/^([0-9]{1,2})$/',
             'hour' => 'regex:/^([0-9]{1,2})$/',
             'category_id' => 'required',
         ];
     }
}
