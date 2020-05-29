<?php

namespace App\Http\Controllers\AuthCompany;

use App\Compnay;
use App\Prefecture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
//オーナー登録に関するクラス
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/companies/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:company');
    }

    public function showRegisterForm() {
      //オーナー登録画面に必要な情報をviewに渡している
      $prefectures = Prefecture::all();
      return view('company_auth.register', compact('prefectures'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    //オーナー登録情報のバリデーションルール
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'store' => ['required', 'string', 'max:255'],
            'prefecture' => ['required'],
            'zip' => ['required', 'string', 'regex:/[0-9]{7}/'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    //バリデーション後のオーナー情報をデータベースに保存する
    {
        return \App\Company::create([
            'name' => $data['name'],
            'store' => $data['store'],
            'prefecture_id' => Prefecture::where('id', $data['prefecture'])->value('id'),
            'zip' => $data['zip'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    protected function guard() {
      return Auth::guard('company'); //オーナー用のguardを設定
    }
}
