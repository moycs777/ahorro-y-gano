<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition_user extends Model
{
    public function user(){
        return $this->belongsTo('App\Model\user\User');
    }

    public function competition(){
        return $this->belongsTo('App\Competition');
    }


}
