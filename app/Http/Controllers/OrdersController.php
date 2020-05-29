<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Company;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

//注文を扱うためのクラス
class OrdersController extends Controller
{
    public function create(Request $request, $id){
      //ユーザーが商品を購入する時の処理

      $request->session()->regenerateToken();
      //二重送信対策

      $product = Product::find($id);
      $company = $product->company()->get()[0];
      $product->update(['sold_flg' => '1' ]);

      \App\Order::create([
        'user_id' => Auth::user()->id,
        'product_id' => $id,
        'company_id' => $company->id
      ]);

      //注文ID生成
      function generatePassword($length = 5) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
          $index = rand(0, $count - 1);
          $result .= mb_substr($chars, $index, 1);
        }
        return $result;
        }

        $password = generatePassword();

      //メールで購入情報をユーザーへ送信
      Mail::send('mail.mail-to-user', [
          "textName" => Auth::user()->name,
          "product" => $product,
          "company" => $company,
          "password" => $password,

      ], function($message) use ($company){
          $message
              ->to(Auth::user()->email)
              ->from($company->email)
              ->subject("ご購入ありがとうございます");
      });

      //メールで販売情報をオーナーへ送信
      Mail::send('mail.mail-to-company', [
          "product" => $product,
          "company" => $company,
          "password" => $password,

      ], function($message) use ($company){
          $message
              ->to($company->email)
              ->subject("商品が購入されました");
      });


      return redirect('/home')->with('flash_message', '商品を購入しました');
    }
    public function destroy($id)
    //ユーザーが注文をキャンセルした時の処理に関するメソッド
    {
      $product = Product::find($id);
      $product->update(['sold_flg' => '0' ]);

      $order = Order::where('product_id', $id)->where('delete_flg', '0')->where('user_id', Auth::user()->id)->first();
      $order->update(['delete_flg' => '1']);

      return redirect('/home')->with('flash_message', '商品をキャンセルしました');
    }
}
