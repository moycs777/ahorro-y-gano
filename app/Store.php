<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'admin_id','auth_id', 'nif_cif', 'clasification_id', 'address', 'billing_address', 'state', 'city', 'location', 'zip', 'phone_1', 'phone_2', 'email', 'contact', 'debt_level', 'status'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function promotion(){
        return $this->hasMany('App\Promotion');
    }

    public function admin() {
        return $this->belongsTo('App\Model\admin', 'id', 'admin_id');
    }

    public function coupon(){
        return $this->hasMany('App\Coupon');
    }

    public function clasification()
    {
        return $this->belongsToMany('App\Clasification', 'clasification_store',  'store_id', 'clasification_id');
    }

    

}
