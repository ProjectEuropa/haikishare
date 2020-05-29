<?php

namespace App\Http\Controllers\AuthCompany;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
//ユーザーのログインに関するクラス
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
    //ガードの指定をオーナーにする
    {
        $this->middleware('guest:company')->except('logout');
    }




    public function showLoginForm()
    //オーナーログインのviewそを指定する
{
    return view('company_auth.login');
}

protected function guard()
{
    return Auth::guard('company');
}

public function logout(Request $request)
//オーナーがログアウトする時のメソッド
{
    \Auth::guard('company')->logout();
    // $this->guard()->logout();
    return redirect('/companies/login');
}




}
