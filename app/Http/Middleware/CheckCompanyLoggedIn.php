<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompanyLoggedIn
//オーナーがログインしているかチェックするクラス
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    //コントローラーの処理の前にオーナーがログインしているかチェックするメソッド
    {

      if (!Auth::guard('company')->check()){
        return redirect('/companies/login');
      }

        return $next($request);
    }
}
