<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\SearchRequest;
use App\Category;
use Carbon\Carbon;
use App\Product;
use App\Prefecture;
use App\Company;
use App\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $productList = Product::where('products.delete_flg', '0')
                                    ->select('products.name as product_name',
                                             'companies.name as company_name',
                                             'prefectures.name as prefecture_name',
                                             'products.id as product_id',
                                             'orders.user_id as user_id',
                                             'pic1',
                                             'year',
                                             'month',
                                             'day',
                                             'expiration',
                                             'store',
                                             'discount',
                                             'price',
                                             'sold_flg')
                                             ->leftjoin('companies', 'companies.id', '=', 'products.company_id')
                                             ->leftjoin('prefectures', 'prefectures.id', '=', 'companies.prefecture_id')
                                             ->leftjoin('orders', 'orders.product_id', '=', 'products.id')->orderBy('product_id', 'desc')->paginate(10);
      $categories = Category::all();
      $prefectures = Prefecture::all();






      return view('/products/index', compact('productList', 'categories', 'prefectures') );
    }
    public function search(SearchRequest $request){
    $query = Product::query();

     $prefecture_id = $request->prefecture_id;
     $category_id = $request->category_id;
     $price_bottom = $request->price_bottom;
     $price_top = $request->price_top;
     $expiration = $request->expiration;
     $sold = $request->sold;

     $date = Carbon::now()->format('Y-m-d');




     $productList = Product::where('products.delete_flg', '0')
                           ->select('products.name as product_name',
                                    'companies.name as company_name',
                                    'prefectures.name as prefecture_name',
                                    'products.id as product_id',
                                    'orders.user_id as user_id',
                                    'pic1',
                                    'year',
                                    'month',
                                    'day',
                                    'expiration',
                                    'store',
                                    'discount',
                                    'price',
                                    'sold_flg')
                            ->leftjoin('companies', 'companies.id', '=', 'products.company_id')
                            ->leftjoin('prefectures', 'prefectures.id', '=', 'companies.prefecture_id')
                            ->leftjoin('orders', 'orders.product_id', '=', 'products.id')
                            ->orderBy('product_id', 'desc')
      ->when($category_id, function($query) use ($category_id){
        return $query->where('category_id', $category_id);
      })

      ->when(!$expiration, function($query) use ($date){
        return $query->whereDate('expiration', '>', $date);
      })

       ->when($price_bottom && $price_top, function($query) use ($price_top, $price_bottom){
        return $query->whereBetween('discount', [$price_bottom, $price_top]);
       })

       ->when(!$sold, function($query) use ($sold){
         return $query->where('sold_flg', '0');
       })

       ->when($prefecture_id, function($query) use ($prefecture_id){
        return $query->where('prefecture_id', $prefecture_id);
      });
       $productList = $productList->paginate(10);
       $categories = Category::all();
       $prefectures = Prefecture::all();
        return view('/products/index', compact('productList', 'categories', 'prefectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('/products/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
      dd($request->all());
      $category = Category::where('id', $request->category_id)->get();
      $category_id = $category[0]->id;

      $company_id = Auth::guard('company')->user()->id;

      $filePath = $request->pic1->store('public');
      $path = str_replace('public/', '', $filePath);

      $validatedMonth = sprintf('%02d', $request->month);
      $validatedDay = sprintf('%02d', $request->day);

      $product = Auth::guard('company')->user()->products()->create([
        'name' => $request->name,
        'price' => $request->price,
        'discount' => $request->discount,
        'pic1' => $path,
        'year' => $request->year,
        'month' => $request->month,
        'day' => $request->day,
        'expiration' => $request->year.'-'.$validatedMonth.'-'.$validatedDay,
        'category_id' => $category_id,
        'company_id' => $company_id
      ]);

      return redirect('/companies/home')->with('flash_message', '商品を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Product::find($id);
      $company = $product->company()->get();
      $company = $company[0];
      $prefecture = Prefecture::where('id', $company->prefecture_id)->get();
      $prefecture = $prefecture[0]->name;

      $category = Category::where('id', $product->category_id)->get();
      $category = $category[0]->name;
      if (isset(Auth::user()->id)) {
        $login_flg = 2;
      }elseif (!empty(Auth::guard('company')->user()->id)){
        $login_flg = 3;
        if( Auth::guard('company')->user()->products()->where('id', $id)->get() == true ) {
          $login_flg = 1;
        }
      }



      return view('/products/show', compact('product', 'company', 'prefecture', 'category', 'login_flg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        return view('/products/edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
      $product = Product::find($id);
      if (isset($request->pic1)){
        $filePath = $request->pic1->store('public');
        $path = str_replace('public/', '', $filePath);
      }


      $product->fill($request->all())->save();

      if (isset($request->pic1)){
      $product->fill(['pic1' => $path])->save();
      }

      return redirect('/companies/home')->with('flash_message', '商品情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function destroytoggle($id)
    {
      $product = Product::find($id);
      $product->update(['delete_flg' => '1' ]);

      return redirect('/companies/home')->with('flash_message', '商品を削除しました');
    }
}
