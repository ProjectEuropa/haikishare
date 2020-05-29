<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
  protected $table = 'prefectures';

  protected $fillable = ['name'];

  //Companyと一対多のリレーション
  public function companies(){
    return $this->hasMany('App\Company');
  }
}
