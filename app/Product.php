<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';

  //コントローラー内でproductsテーブルとinnerjoinしたordersテーブルの(orders.created_at as order_time)をformat()するために必要
  protected $dates = [
    'order_time'
  ];

  protected $fillable = ['name', 'price', 'discount', 'pic1', 'year', 'month', 'day','hour', 'expiration','sold_flg', 'delete_flg', 'category_id', 'company_id'];
  //Categoryと一対多のリレーション
  public function category(){
    return $this->belongsTo('App\Category');
  }
  //Companyと一対多のリレーション
  public function company(){
    return $this->belongsTo('App\Company');
  }

  //Companyと一対多のリレーション
  public function orders(){
    return $this->hasOne('App\Order');
  }
}
