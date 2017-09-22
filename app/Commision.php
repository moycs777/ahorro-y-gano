<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commision extends Model
{
    protected $fillable = ['admin_id','coupon_id','payed','price','payed_at','age'];

    public function admin() {
        return $this->belongsTo('App\Model\admin\admin');
    }
    
}
