<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'reffer_id','confirmed','confirmation_code'
    ];
    
    public function coupon(){
        return $this->hasMany('App\Coupon');
    }

    public function competition_user(){
        return $this->hasMany('App\Competition');
    }

    public function ranking(){
        return $this->hasMany('App\Ranking');
    }

    public function reffers(){
        return $this->hasMany('App\Reffer', 'user_id');
    }
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
