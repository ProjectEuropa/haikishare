<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    //ガードの指定をユーザーにする
    {
        $this->middleware('guest:user')->except('logout');
    }

    /** 以下追記 **/
   public function showLoginForm()
   //ユーザーログインのviewそを指定する
   {
       return view('auth.login');
   }

   protected function guard()
   {
       return \Auth::guard('user');
   }

   public function logout(Request $request)
   //ユーザーがログアウトする時のメソッド
   {
       \Auth::guard('user')->logout();
       return redirect('/login');
   }
   /** ここまで **/
}
