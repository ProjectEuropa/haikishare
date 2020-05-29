<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\CompanyPasswordResetNotification;



class Company extends Authenticatable
{
    use Notifiable;

    //オーナー用のメールを送信するために必要なメソッド
    public function sendPasswordResetNotification($token)
{
    $this->notify(new CompanyPasswordResetNotification($token));
}
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'store', 'zip', 'address', 'email', 'password', 'prefecture_id', 'delete_flg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Orderと一対多のリレーション
    public function orders(){
      return $this->hasMany('App\Order');
    }
    //Productと一対多のリレーション
    public function products(){
      return $this->hasMany('App\Product');
    }

    //Productと一対一のリレーション
    public function prefecture(){
      return $this->belongsTo('App\Prefecture');
    }

  }
