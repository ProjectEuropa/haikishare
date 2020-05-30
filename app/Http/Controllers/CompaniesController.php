<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCompanyRequest;
use Carbon\Carbon;
use App\Company;
use App\Prefecture;
use App\Product;
use App\Order;


class CompaniesController extends Controller
//オーナー情報を扱うためのクラス
{
  public function edit($id) {
  //オーナーのプロフィール変更画面を表示するためのメソッド

    $company = Company::find($id);
    $prefectures = Prefecture::all();

    return view('/companies/edit', compact('company', 'prefectures') );
  }
  public function update(UpdateCompanyRequest $request, $id) {
    //オーナープロフィール変更画面からpostされた情報を基にオーナーのプロフィールを更新するためのメソッド
    $company = Company::find($id);
    // dd($request->all());
    $company->fill($request->all())->save();

    return redirect('/companies/home');
  }
  public function list($id) {
    //オーナーが出品した商品一覧情報をviewに渡すためのメソッド
    $productList = Product::where('company_id', $id)->where('delete_flg', '0')->orderBy('id', 'desc')->paginate(10);
    $productCount = Product::where('company_id', $id)->where('delete_flg', '0')->count();
    foreach($productList as $key){
      $key->date = $key->created_at->format('Y年n月j日');
    }

    return view('/companies/list', compact('productList', 'productCount'));
  }
  public function sell($id) {
    //オーナーが出品して、購入された商品一覧情報をviewに渡すためのメソッド
    $productList = Product::where('products.sold_flg', '1')
                          ->where('orders.delete_flg', '0')
                          ->where('products.company_id', $id)
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
                                   ->paginate(10);
    foreach($productList as $key){
      $key->date = $key->order_time->format('Y年n月j日');
    }
    return view('/companies/sell', compact('productList'));
  }
}
