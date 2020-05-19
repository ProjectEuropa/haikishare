<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCompanyRequest;
use Carbon\Carbon;
use App\Company;
use App\Prefecture;
use App\Product;


class CompaniesController extends Controller
{
  public function edit($id) {

    $company = Company::find($id);
    $prefectures = Prefecture::all();

    return view('/companies/edit', compact('company', 'prefectures') );
  }
  public function update(UpdateCompanyRequest $request, $id) {
    $company = Company::find($id);
    // dd($request->all());
    $company->fill($request->all())->save();

    return redirect('/companies/home');
  }
  public function list($id) {
    $productList = Product::where('company_id', $id)->where('delete_flg', '0')->orderBy('id', 'desc')->paginate(5);
    $productCount = Product::where('company_id', $id)->where('delete_flg', '0')->count();
    foreach($productList as $key){
      $key->date = $key->created_at->format('Y年m月d日');
    }

    return view('/companies/list', compact('productList', 'productCount'));
  }
  public function sell($id) {
    $productList = Product::where('company_id', $id)->where('sold_flg', 1)->paginate(4);
    $productCount = Product::where('company_id', $id)->where('sold_flg', 1)->count();
    foreach($productList as $key){
      $key->date = $key->order()->where('product_id', $key->id)->value('created_at')->format('Y年m月d日');
    }

    return view('/companies/sell', compact('productList', 'productCount'));
  }
}
