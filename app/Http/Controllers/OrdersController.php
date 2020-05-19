<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function create($id){

      \App\Order::create([
        'user_id' => Auth::user()->id,
        'product_id' => $id
      ]);

      $product = Product::find($id);
      $company = $product->company()->get()[0];
      $product->update(['sold_flg' => '1' ]);

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
}
