<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['store_id', 'name', 'description', 'price_not_offert', 'price_with_offert', 'picture', 'location', 'expires', 'points', 'type'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function store() {
        return $this->belongsTo('App\Store');
    }

    public function coupon(){
        return $this->hasMany('App\Coupon');
    }

}


