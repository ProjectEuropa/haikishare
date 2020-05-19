<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompanyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $response = $next($request);

      if (!Auth::guard('company')->user()->check()){
        return redirect('/companies/login');
      }

        return $next($request);
    }
}
