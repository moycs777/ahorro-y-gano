<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reffer extends Model
{
    protected $table = 'reffers';

	protected $fillable = ['user_id', 'reffered_id'];

	public function padre()
    {
	    return $this->belongsTo('App\Model\user\user', 'user_id	');
    }

	

	
}
