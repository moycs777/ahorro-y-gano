<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['store_id', 'promotion_id', 'user_id', 'consolidated', 'payed', 'payed_at','invoice'];

    public function store(){
        return $this->belongsTo('App\Store');
    }

    public function user(){
        return $this->belongsTo('App\Model\user\user');
    }

    public function promotion()
    {
        return $this->hasOne('App\Promotion','id', 'promotion_id');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
