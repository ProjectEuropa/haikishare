<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
  public function index(){
    if(Auth::check())
      return redirect('/home');
    elseif(Auth::guard('company')->check())
      return redirect('/companies/home');
    else {
      return redirect('/login');
    }
  }
}
