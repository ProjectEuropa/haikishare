<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;

class CompanyHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $productList = Auth::guard('company')->user()->products()->where('delete_flg', '0')->take(5)->orderBy('id', 'desc')->get();
      $list_flg = ( Auth::guard('company')->user()->products()->first() ) ? true : false;
      // dd($productList);
      $productSell = Auth::guard('company')->user()->products()->where('delete_flg', '0')->where('sold_flg', '1')->take(5)->orderBy('id', 'desc')->get();
      // dd($productSell);
      $sell_flg = ( Auth::guard('company')->user()->products()->where('sold_flg', '1')->first() ) ? true : false;
        return view('companies.home', compact('productList', 'productSell', 'list_flg', 'sell_flg'));
    }
}
