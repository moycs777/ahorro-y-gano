<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clasification extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clasifications';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'doubt_percentage', 'min_points','status'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function store()
    {
        return $this->belongsToMany('App\Store');
    }

}
