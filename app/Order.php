<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['delete_flg', 'user_id', 'product_id'];

    public function users(){
      return $this->belongsTo('App\User');
    }

    public function product(){
      return $this->belongsTo('App\Product');
    }
}
