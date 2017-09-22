<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RankingHijo extends Model
{
    protected $table = 'ranking_hijos';

	protected $fillable = ['user_id', 'son_id', 'competition_id', 'points', 'active'];

	public function user(){
	    return $this->belongsTo('App\Model\user\User');
	}

	public function competition(){
	    return $this->belongsTo('App\Competition');
	}
}
