<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use App\Order;

class CompanyHomeController extends Controller
//オーナーのマイページに関するクラス
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
    //販売商品、出品商品を表示するための情報をオーナーのマイページに渡すためのメソッド
    {
      $productList = Auth::guard('company')->user()->products()->where('delete_flg', '0')->take(5)->orderBy('id', 'desc')->get();
      foreach($productList as $product){
        $product->createDay = $product->created_at->format('Y年m月d日');
      }
      $productSell = Product::where('products.sold_flg', '1')
                            ->where('orders.delete_flg', '0')
                            ->where('products.company_id', Auth::guard('company')->user()->id )
                            ->select('products.name as product_name',
                                     'products.id as product_id',
                                     'orders.created_at as order_time',
                                     'pic1',
                                     'expiration',
                                     'discount',
                                     'price',
                                     'sold_flg')
                                     ->leftjoin('orders', 'orders.product_id', '=', 'products.id')
                                     ->orderBy('order_time', 'desc')
                                     ->take(5)
                                     ->get();
     foreach($productSell as $key){
       $key->date = $key->order_time->format('Y年m月d日');
     }
        return view('companies.home', compact('productList', 'productSell'));
    }
}
