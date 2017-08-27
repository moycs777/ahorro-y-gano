<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trading extends Model
{
    protected $fillable = ['user_id', 'receptor_id' ,'competition_id', 'points'];
}
