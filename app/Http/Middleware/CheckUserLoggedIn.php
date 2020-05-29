<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLoggedIn
//ユーザーがログインしているかチェックするクラス
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    //コントローラーの処理の前にユーザーがログインしているかチェックするメソッド
    {

      if (!Auth::check()){
        return redirect('login');
      }

        return $next($request);
    }
}
