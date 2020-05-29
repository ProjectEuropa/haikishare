<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//商品検索条件のバリデーション
class SearchRequest extends FormRequest
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
    //商品検索条件のバリデーション
    {
        return [
            'category_id' => 'nullable|regex:/^([0-9]{1,2})$/',
            'prefecture_id' => 'nullable|regex:/^([0-9]{1,2})$/',
            'price_bottom' => 'nullable|regex:/^([0-9]{1,5})$/',
            'price_top' => 'nullable|regex:/^([0-9]{1,5})$/',
            'expiration' => 'nullable|regex:/^([1])$/'
        ];
    }
}
