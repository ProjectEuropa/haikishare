<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $dates = [
    'public_date',
];

    protected $fillable = ['delete_flg', 'user_id', 'product_id', 'company_id'];
    //Userと一対多のリレーション
    public function user(){
      return $this->belongsTo('App\User');
    }

    //Productと一対多のリレーション
    public function product(){
      return $this->belongsTo('App\Product');
    }
    //Productと一対多のリレーション
    public function company(){
      return $this->belongsTo('App\Company');
    }
}
