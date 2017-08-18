<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rodolfo extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rodolfos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'ci'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
