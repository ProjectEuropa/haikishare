<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';

  protected $fillable = ['name', 'price', 'discount', 'pic1', 'year', 'month', 'day', 'expiration','sold_flg', 'delete_flg', 'category_id', 'company_id'];

  public function categories(){
    return $this->belongsTo('App\Category');
  }
  public function company(){
    return $this->belongsTo('App\Company');
  }

  public function order(){
    return $this->hasOne('App\Order');
  }
}
