<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    
    protected $fillable = ['name', 'goal', 'active', 'reward'];
    //protected $with = ['user', 'competition'];

    public function user(){
        return $this->belongsTo('App\Model\user\user');
    }

    public function ranking(){
        return $this->hasMany('App\Ranking');
    }

    

}
