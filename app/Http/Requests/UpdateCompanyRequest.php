<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//オーナー情報変更時のバリデーション
class UpdateCompanyRequest extends FormRequest
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
    //オーナー情報変更時のバリデーションルール
    {
        return [
          'name' => 'required|string|max:255',
          'store' => 'required|string|max:255',
          'prefecture_id' => 'required',
          'zip' => 'required|string|regex:/[0-9]{7}/',
          'address' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
        ];
    }
}
