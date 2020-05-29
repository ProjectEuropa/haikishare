<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Company;
use App\Product;
use App\User;


class HomeController extends Controller
//ユーザーのマイページに関するクラス
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    //購入商品一覧を表示するための情報をユーザーのマイページに渡すためのメソッド
    {
      $id = Auth::user()->id;


      $productList = Auth::user()->product()->where('orders.delete_flg', '0')->orderBy('orders.created_at', 'desc')->paginate(30);
      foreach($productList as $key){
        $key->date = $key->orders()->value('created_at')->format('Y年m月d日');
        $key->discountRate = round(($key->price - $key->discount) / $key->price * 100);

        $company_id = Product::find($key->id)->company_id;

        $key->company = Company::where('id', $company_id)->value('name');
        // dd($key->orders()->get());
      }
        return view('home', compact('productList') );
    }
}
