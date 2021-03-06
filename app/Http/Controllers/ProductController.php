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
//商品を扱うクラス
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    //商品一覧画面で表示させる商品情報をviewに返すためのメソッド
    {
      $productList = Product::where('products.delete_flg', '0')
                            ->where('products.sold_flg', '0')
                            ->select('products.name as product_name',
                                     'companies.name as company_name',
                                     'prefectures.name as prefecture_name',
                                     'products.id as product_id',
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
                                     ->orderBy('product_id', 'desc')->paginate(10);
      $categories = Category::all();
      $prefectures = Prefecture::all();
      $searchConditions[] = '賞味期限切れ：含む';




      return view('/products/index', compact('productList', 'categories', 'prefectures', 'searchConditions') );
    }
    public function search(SearchRequest $request){
      //商品一覧画面で、検索条件を基に表示させる商品情報と、検索条件をviewに返すためのメソッド
    $query = Product::query();

     $prefecture_id = $request->prefecture_id;
     if (isset($prefecture_id)){
       $searchConditions[] = '都道府県：'.Prefecture::find($prefecture_id)->name;
     }
     $category_id = $request->category_id;
     if (isset($category_id)){
       $searchConditions[] = 'カテゴリー：'.Category::find($category_id)->name;
     }
     $price_bottom = $request->price_bottom;
     $price_top = $request->price_top;
     if (isset($price_top) && isset($price_bottom)){
       $searchConditions[] = '値段：'.$price_bottom.'から'.$price_top.'円';
     }
     $expiration = $request->expiration;
     if (isset($expiration)){
       $searchConditions[] = '賞味期限切れ：含む';
     }else{
       $searchConditions[] = '賞味期限切れ：含まない';
     }
     $sold = $request->sold;
     if (isset($sold)){
       $searchConditions[] = '在庫なし：含む';
     }else{
     }


     $date = Carbon::now()->format('Y-m-d');




     $productList = Product::where('products.delete_flg', '0')
                           ->select('products.name as product_name',
                                    'companies.name as company_name',
                                    'prefectures.name as prefecture_name',
                                    'products.id as product_id',
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
        return view('/products/index', compact('productList', 'categories', 'prefectures', 'searchConditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    //商品追加画面を表示するためのメソッド
    {
      if (!Auth::guard('company')->check()){
        return redirect('/companies/login');
      }

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
    //商品追加画面からpostされた情報をデータベースに保存するためのメソッド
    {
      if (!Auth::guard('company')->check()){
        return redirect('/companies/login');
      }
      $request->session()->regenerateToken();

      $category = Category::where('id', $request->category_id)->get();
      $category_id = $category[0]->id;

      $company_id = Auth::guard('company')->user()->id;

      //ファイルの保存先をstorage下にするために文字列からpublic/を除外する
      // $filePath = $request->pic1->store('public');
      // $path = str_replace('public/', '', $filePath);

      // 画像のバイナリデータを直接入れる
      $path = base64_encode(file_get_contents($request->pic1));

      //expirationを保存する時に、月と日にちがもし一桁だった場合にそれぞれ０を付け加えるようにする(format関数で比較する時に必要になる)
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
        'hour' => $request->hour,
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
    //商品詳細画面で必要な一つの商品情報と、ログイン情報をviewに変えしている。
    {
      $product = Product::find($id);
      $company = $product->company()->get();
      $company = $company[0];
      $prefecture = Prefecture::where('id', $company->prefecture_id)->get();
      $prefecture = $prefecture[0]->name;

      $category = Category::where('id', $product->category_id)->get();
      $category = $category[0]->name;

      if (!isset(Auth::user()->id) && isset(Auth::guard('company')->user()->id)){
        $loginInfo = Auth::guard('company')->user()->products()->where('id', $id)->value('name');
      }

      //ユーザーがログインしており、かつユーザーが買った商品だった場合はorder_flg = trueそうでない場合はfalse
      $order_flg = false;
      $order_user_id = $product->orders()->where('orders.delete_flg', '0')->value('user_id');
      if (Auth::check() && $order_user_id === Auth::user()->id){
        $order_flg = true;
      }

      if (isset(Auth::user()->id)) {
        //ユーザーがログインしている場合
        $login_flg = 1;

        if ($order_flg === true){
          $login_flg = 2;
        }
      }elseif (isset(Auth::guard('company')->user()->id)){
        //オーナーがログインしている場合
        $login_flg = 3;
        if( !empty($loginInfo) ) {
          //オーナーがログインしており、かつ自分が出品した商品を見る場合
          $login_flg = 4;
        }
      }else{
        //オーナーもユーザーもログインしていない場合
        $login_flg = 5;
      }
// dd($login_flg);

      return view('/products/show', compact('product', 'company', 'prefecture', 'category', 'login_flg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    //商品変更画面に必要な情報をviewに返している
    {
      if (!Auth::guard('company')->check()){
        return redirect('/companies/login');
      }

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
    //商品変更画面からpostされた商品情報を基に商品情報を変更する
    {
      if (!Auth::guard('company')->check()){
        return redirect('/companies/login');
      }
      $product = Product::find($id);
      //ファイルがある時にはstorage下に保存するために文字列からpublic/を除外する
      if (isset($request->pic1)){
        // $filePath = $request->pic1->store('public');
        // $path = str_replace('public/', '', $filePath);

        // 画像のバイナリデータを直接入れる
        $path = base64_encode(file_get_contents($request->pic1));
      }

      //ファイルはバリデーション時にnullableにしているため、ここでは保存しない。
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
    //商品変更画面から商品を削除するためのメソッド
    {
      $product = Product::find($id);
      $product->update(['delete_flg' => '1' ]);

      return redirect('/companies/home')->with('flash_message', '商品を削除しました');
    }
}
