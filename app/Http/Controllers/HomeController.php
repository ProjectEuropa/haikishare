<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Company;
use App\Product;
use App\User;


class HomeController extends Controller
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
    {
      $id = Auth::user()->id;

      $productList = Auth::user()->product()->paginate(4);
      $productCount = Auth::user()->product()->count();
      foreach($productList as $key){
        $key->date = Auth::user()->orders()->where('user_id', $id)->value('created_at')->format('Y年m月d日');
        $key->discountRate = round(($key->price - $key->discount) / $key->price * 100);

        $company_id = Product::find($key->id)->company_id;

        $key->company = Company::where('id', $company_id)->value('name');
      }
        return view('home', compact('productList', 'productCount') );
    }
}
